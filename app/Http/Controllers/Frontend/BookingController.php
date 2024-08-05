<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{

    public function bookingStore(Request $request)
    {
        // dd($request->all());

        Booking::create([
            'user_id' => Auth::user()->id,
            'room_id' => $request->room_id,
            'checkin_date' => $request->checkin_date,
            'checkout_date' => $request->checkout_date,
            'total_adults' => $request->total_adults,
            'total_children' => $request->total_children,
        ]);

        return redirect()->back()->with('message', 'Room Has Been Booked Successfully 🙂');
    }
}
