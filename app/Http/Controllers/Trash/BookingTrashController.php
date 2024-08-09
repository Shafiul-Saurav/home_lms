<?php

namespace App\Http\Controllers\Trash;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookingTrashController extends Controller
{
    public function trash()
    {
        $bookings = Booking::onlyTrashed()->latest('id')->with(['room', 'user'])->paginate();
        return view('backend.pages.booking.trash', compact('bookings'));
    }

    // public function restore($id)
    // {
    //     $booking = Booking::onlyTrashed()->where('id', $id)->first();
    //     $booking->restore();

    //     return redirect()->back()->with('info', 'Booking Restored Successfully 🙂');
    // }

    public function forceDelete($id)
    {
        $booking = Booking::onlyTrashed()->where('id', $id)->first();
        $booking->forceDelete();

        return redirect()->back()->with('error', 'Booking Deleted Permanently');
    }
}
