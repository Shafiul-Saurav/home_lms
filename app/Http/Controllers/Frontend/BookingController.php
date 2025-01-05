<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserBookingConfirmationMail;
use App\Http\Requests\BookingStoreRequest;
use App\Mail\AdminBookingNotificationMail;

class BookingController extends Controller
{

    public function bookingHistory()
    {
        $bookings = Booking::where('user_id', Auth::user()->id)->paginate(10);
        return view('frontend.pages.user.booking_history.booking_history', compact('bookings'));
    }

    public function bookingStore(BookingStoreRequest $request)
    {
        // dd($request->all());
        // Check if the room is already booked between the specified dates
        // $existingBooking = Booking::where('room_id', $request->room_id)
        //     ->where(function($query) use ($request) {
        //         $query->whereBetween('checkin_date', [$request->checkin_date, $request->checkout_date])
        //               ->orWhereBetween('checkout_date', [$request->checkin_date, $request->checkout_date])
        //               ->orWhere(function($query) use ($request) {
        //                   $query->where('checkin_date', '<', $request->checkin_date)
        //                         ->where('checkout_date', '>', $request->checkout_date);
        //               });
        //     })->exists();

        // if ($existingBooking) {
        //     return redirect()->back()->with('error', 'This room is already booked for the selected dates.');
        // }

        // Create new booking
        // $booking = Booking::create([
        //     'user_id' => Auth::user()->id,
        //     'room_id' => $request->room_id,
        //     'checkin_date' => $request->checkin_date,
        //     'checkout_date' => $request->checkout_date,
        //     'total_adults' => $request->total_adults,
        //     'total_children' => $request->total_children,
        //     'total_amount' => $request->total_amount,
        // ]);

        // // Send confirmation email to user
        // Mail::to(Auth::user()->email)->send(new UserBookingConfirmationMail($booking));

        // // Send notification email to admin
        // $adminEmail = 'shafiulsaurav8@gmail.com'; // Replace with the actual admin email
        // Mail::to($adminEmail)->send(new AdminBookingNotificationMail($booking));

        // return redirect()->back()->with('message', 'Room has been booked successfully 🙂');
    }

    public function cancelBooking($id)
    {
        $booking = Booking::find($id);

        if (!$booking) {
            return redirect()->back()->with('error', 'Booking not found.');
        }

        $bookingCreatedAt = $booking->created_at;
        $currentTime = now();
        $difference = $currentTime->diffInHours($bookingCreatedAt);

        if ($difference > 6) {
            return redirect()->back()->with('error', 'You can only cancel the booking within 6 hours of its creation.');
        }

        $booking->delete();

        return redirect()->back()->with('message', 'Booking has been canceled successfully.');
    }
}
