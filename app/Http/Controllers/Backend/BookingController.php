<?php

namespace App\Http\Controllers\Backend;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        //
    }
}
