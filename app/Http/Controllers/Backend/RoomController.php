<?php

namespace App\Http\Controllers\Backend;

use App\Models\Room;
use App\Models\Roomtype;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rooms = Room::latest('id')->paginate(100);
        $room_types = Roomtype::get();
        return view('backend.pages.room.room', compact('rooms', 'room_types'));
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
        // dd($request->all());

        $room = Room::create([
            'roomtype_id' => $request->roomtype_id,
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
        ]);

        $this->image_upload($request, $room->id);
        return redirect()->back()->with('message', 'Room Created Successfully 🙂');
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
        $room = Room::where('id', $id)->first();
        $room_types = Roomtype::get();
        return view('backend.pages.room.edit', compact('room', 'room_types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $room = Room::where('id', $id)->first();
        $room->update([
            'roomtype_id' => $request->roomtype_id,
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
        ]);

        $this->image_upload($request, $room->id);
        return redirect()->route('rooms.index')->with('message', 'Room Updated Successfully 🙂');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $room = Room::where('id', $id)->first();
        if($room->image != 'default_home_slider.jpg'){
            $photo_location = 'uploads/rooms/'.$room->image;
            unlink($photo_location);
        }
        $room->delete();
        return redirect()->back()->with('error', 'Room Deleted Successfully');
    }

     /**
     * Store/Update the Image file.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function image_upload($request, $room_id)
    {
        $room = Room::findOrFail($room_id);
        // dd($request->all(), $room, $request->hasFile('image'));
        if ($request->hasFile('image')) {
            if ($room->image != 'default_room.jpg') {
                //delete old photo
                $photo_location = 'public/uploads/rooms/';
                $old_photo_location = $photo_location . $room->image;
                unlink(base_path($old_photo_location));
            }
            $photo_location = 'public/uploads/rooms/';
            $uploaded_photo = $request->file('image');
            $new_photo_name = $room->id . '.' . $uploaded_photo->getClientOriginalExtension();
            $new_photo_location = $photo_location . $new_photo_name;
            Image::make($uploaded_photo)->resize(380,400)->save(base_path($new_photo_location), 40);
            //$user = User::find($room->id);
            $check = $room->update([
                'image' => $new_photo_name,
            ]);
        }
    }

    public function checkActiveWifi($room_id)
    {
        $room = Room::find($room_id);
        if (!$room) {
            return response()->json([
                'type' => 'error',
                'message' => 'User not found'
            ], 404);
        }

        // Toggle the is_active status
        $room->is_wifi = $room->is_wifi ? 0 : 1;
        $room->save();

        return response()->json([
            'type' => 'success',
            'message' => 'Status Updated'
        ]);
    }

}
