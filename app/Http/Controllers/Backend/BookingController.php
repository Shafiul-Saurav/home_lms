<?php

namespace App\Http\Controllers\Backend;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserBookingConfirmationMail;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = Booking::latest('id')->with(['room', 'user'])->paginate();
        return view('backend.pages.booking.booking', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(string $id)
    // {
    //     $booking = Booking::where('id', $id)->first();
    //     return view('backend.pages.booking.edit', compact('booking'));
    // }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, string $id)
    // {
    //     dd($request->all());
    //     $booking = Booking::findOrFail($id);
    //     $booking->update([
    //         'checkin_date' => $request->checkin_date,
    //         'checkout_date' => $request->checkout_date,
    //         'total_adults' => $request->total_adults,
    //         'total_children' => $request->total_children,
    //     ]);

    //     return redirect()->back()->with('message', 'booking Updated Successfully 🙂');
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return redirect()->back()->with('warning', 'Booking Deleted Successfully');
    }

    public function checkActivePaymentStatus($booking_id)
    {
        $booking = Booking::find($booking_id);
        if (!$booking) {
            return response()->json([
                'type' => 'error',
                'message' => 'Booking not found'
            ], 404);
        }

        // Toggle the is_active status
        $booking->payment_status = $booking->payment_status ? 0 : 1;
        $booking->save();
        // Send confirmation email to user
        Mail::to($booking->user->email)->send(new UserBookingConfirmationMail($booking));
        return response()->json([
            'type' => 'success',
            'message' => 'Status Updated'
        ]);
    }
}
