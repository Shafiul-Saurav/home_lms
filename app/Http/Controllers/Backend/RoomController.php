<?php

namespace App\Http\Controllers\Backend;

use App\Models\Room;
use App\Models\Roomtype;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RoomStoreUpdateRequest;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

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
    public function store(RoomStoreUpdateRequest $request)
    {
        // dd($request->all());

        $room = Room::create([
            'roomtype_id' => $request->roomtype_id,
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
        ]);

        $this->image_upload($request, $room->id);
        $this->multiple_image_upload($request, $room->id);
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
    public function update(RoomStoreUpdateRequest $request, string $id)
    {
        $room = Room::where('id', $id)->first();
        $room->update([
            'roomtype_id' => $request->roomtype_id,
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
        ]);

        $this->image_upload($request, $room->id);
        $this->multiple_image_upload($request, $room->id);
        return redirect()->route('rooms.index')->with('message', 'Room Updated Successfully 🙂');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $room = Room::findOrFail($id);

        // Delete main room image if it's not the default
        if($room->image != 'default_room.jpg'){
            $photo_location = 'uploads/rooms/'.$room->image;
            unlink($photo_location);
        }

        // Delete multiple room images and their associated files
        foreach ($room->roomImages as $roomImage) {
            $image_path = public_path('uploads/rooms/' . $roomImage->multiple_image);
            if (file_exists($image_path)) {
                unlink($image_path);
                Log::info('Room image deleted: ' . $image_path);
            } else {
                Log::warning('Room image not found or could not delete: ' . $image_path);
            }
            $roomImage->delete();
        }

        // Delete the room record
        $room->delete();

        return redirect()->back()->with('error', 'Room deleted successfully');
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

    protected function multiple_image_upload($request, $room_id)
    {
        $room = Room::findOrFail($room_id);

        if ($request->hasFile('multiple_image')) {
            // Optionally, delete old images here if necessary
            foreach ($room->roomImages as $roomImage) {
                $image_path = public_path('uploads/rooms/' . $roomImage->multiple_image);
                if (file_exists($image_path)) {
                    unlink($image_path);
                }
                $roomImage->delete();
            }

            foreach ($request->file('multiple_image') as $uploaded_photo) {
                if ($uploaded_photo->isValid()) {
                    // Handle each multiple image upload
                    $photo_location = 'public/uploads/rooms/';
                    $new_photo_name = $room->id . '_' . time() . '_' . uniqid() . '.' . $uploaded_photo->getClientOriginalExtension();
                    $new_photo_location = $photo_location . $new_photo_name;

                    // Resize and save the image
                    Image::make($uploaded_photo)->resize(380, 400)->save(base_path($new_photo_location), 40);

                    // Save image to RoomImage model
                    $room->roomImages()->create([
                        'multiple_image' => $new_photo_name,
                    ]);
                } else {
                    Log::warning('Invalid image file: ' . $uploaded_photo->getClientOriginalName());
                }
            }
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

    public function checkActiveAC($room_id)
    {
        $room = Room::find($room_id);
        if (!$room) {
            return response()->json([
                'type' => 'error',
                'message' => 'Room not found'
            ], 404);
        }

        $room->is_ac = $room->is_ac ? 0 : 1;
        $room->save();

        return response()->json([
            'type' => 'success',
            'message' => 'AC status updated'
        ]);
    }

    public function checkActiveTV($room_id)
    {
        $room = Room::find($room_id);
        if (!$room) {
            return response()->json([
                'type' => 'error',
                'message' => 'Room not found'
            ], 404);
        }

        $room->is_tv = $room->is_tv ? 0 : 1;
        $room->save();

        return response()->json([
            'type' => 'success',
            'message' => 'TV status updated'
        ]);
    }

    public function checkActiveBalcony($room_id)
    {
        $room = Room::find($room_id);
        if (!$room) {
            return response()->json([
                'type' => 'error',
                'message' => 'Room not found'
            ], 404);
        }

        $room->is_balcony = $room->is_balcony ? 0 : 1;
        $room->save();

        return response()->json([
            'type' => 'success',
            'message' => 'Balcony status updated'
        ]);
    }

    public function checkActiveMiniFridge($room_id)
    {
        $room = Room::find($room_id);
        if (!$room) {
            return response()->json([
                'type' => 'error',
                'message' => 'Room not found'
            ], 404);
        }

        $room->is_mini_fridge = $room->is_mini_fridge ? 0 : 1;
        $room->save();

        return response()->json([
            'type' => 'success',
            'message' => 'Mini Fridge status updated'
        ]);
    }

    public function checkActiveKitchenette($room_id)
    {
        $room = Room::find($room_id);
        if (!$room) {
            return response()->json([
                'type' => 'error',
                'message' => 'Room not found'
            ], 404);
        }

        $room->is_kitchenette = $room->is_kitchenette ? 0 : 1;
        $room->save();

        return response()->json([
            'type' => 'success',
            'message' => 'Kitchenette status updated'
        ]);
    }

    public function checkActiveLivingArea($room_id)
    {
        $room = Room::find($room_id);
        if (!$room) {
            return response()->json([
                'type' => 'error',
                'message' => 'Room not found'
            ], 404);
        }

        $room->is_living_area = $room->is_living_area ? 0 : 1;
        $room->save();

        return response()->json([
            'type' => 'success',
            'message' => 'Living Area status updated'
        ]);
    }

}
