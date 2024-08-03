<?php

namespace App\Http\Controllers\Backend;

use App\Models\Roomtype;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RoomTypeStoreRequest;

class RoomTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $room_types = Roomtype::latest('id')->paginate(100);
        return view('backend.pages.roomtype.roomtype', compact('room_types'));
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
    public function store(RoomTypeStoreRequest $request)
    {
        // dd($request->all());

        Roomtype::create([
            'title' => $request->title,
            'occupancy' => $request->occupancy,
            'bed_type' => $request->bed_type,
            'description' => $request->description,
        ]);

        return redirect()->back()->with('message', 'Room Type Created Successfully 🙂');
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
    public function edit(string $id)
    {
        $room_type = Roomtype::where('id', $id)->first();
        return view('backend.pages.roomtype.edit', compact('room_type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoomTypeStoreRequest $request, string $id)
    {
        // dd($request->all());
        $room_type = Roomtype::where('id', $id)->first();
        $room_type->update([
            'title' => $request->title,
            'occupancy' => $request->occupancy,
            'bed_type' => $request->bed_type,
            'description' => $request->description,
        ]);
        return redirect()->route('room_types.index')->with('message', 'Room Type Update Successfully 🙂');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $room_type = Roomtype::where('id', $id)->first();
        $room_type->delete();

        return redirect()->back()->with('error', 'Room Type Deleted Successfully');
    }
}
