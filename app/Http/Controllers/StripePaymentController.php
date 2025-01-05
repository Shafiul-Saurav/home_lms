<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookingStoreRequest;
use Stripe;
use Session;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\PaymentConfirmationMail;
use App\Mail\UserBookingConfirmationMail;
use App\Mail\AdminBookingNotificationMail;

class StripePaymentController extends Controller

{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe(Request $data)
    {
        $existingBooking = Booking::where('room_id', $data->room_id)
        ->where(function($query) use ($data) {
            $query->whereBetween('checkin_date', [$data->checkin_date, $data->checkout_date])
                  ->orWhereBetween('checkout_date', [$data->checkin_date, $data->checkout_date])
                  ->orWhere(function($query) use ($data) {
                      $query->where('checkin_date', '<', $data->checkin_date)
                            ->where('checkout_date', '>', $data->checkout_date);
                  });
        })->exists();
        if (!$existingBooking) {
            $room_id = $data->input('room_id');
            $total_amount = $data->input('total_amount');
            $checkin_date = $data->input('checkin_date');
            $checkout_date = $data->input('checkout_date');
            $total_adults = $data->input('total_adults');
            $total_children = $data->input('total_children');
            return view('stripe', compact(
                'room_id',
                'total_amount',
                'checkin_date',
                'checkout_date',
                'total_adults',
                'total_children'
            ));

        } else {
            return redirect()->back()->with('error', 'This room is already booked for the selected dates.');
        }

    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(BookingStoreRequest $request)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        Stripe\Charge::create ([
                "amount" => $request->input('total_amount') * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Test payment from itsolutionstuff.com."
        ]);

        $existingBooking = Booking::where('room_id', $request->room_id)
            ->where(function($query) use ($request) {
                $query->whereBetween('checkin_date', [$request->checkin_date, $request->checkout_date])
                      ->orWhereBetween('checkout_date', [$request->checkin_date, $request->checkout_date])
                      ->orWhere(function($query) use ($request) {
                          $query->where('checkin_date', '<', $request->checkin_date)
                                ->where('checkout_date', '>', $request->checkout_date);
                      });
            })->exists();

        if ($existingBooking) {
            return redirect()->back()->with('error', 'This room is already booked for the selected dates.');
        }

        // Create new booking
        $booking = Booking::create([
            'user_id' => Auth::user()->id,
            'room_id' => $request->room_id,
            'checkin_date' => $request->checkin_date,
            'checkout_date' => $request->checkout_date,
            'total_adults' => $request->total_adults,
            'total_children' => $request->total_children,
            'total_amount' => $request->total_amount,
        ]);

        // Send confirmation email to user
        Mail::to(Auth::user()->email)->send(new PaymentConfirmationMail($booking));

        // Send notification email to admin
        $adminEmail = 'shafiulsaurav8@gmail.com'; // Replace with the actual admin email
        Mail::to($adminEmail)->send(new AdminBookingNotificationMail($booking));

        return redirect()->route('booking.success', ['id' => $booking->id])->with('message', 'Room has been booked successfully 🙂');

        // Session::flash('success', 'Payment successful!');

        // return back();

    }

}
