<?php

namespace App\Http\Controllers\Backend;

use App\Models\Roomtype;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
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

        $room_type = Roomtype::create([
            'title' => $request->title,
            'occupancy' => $request->occupancy,
            'bed_type' => $request->bed_type,
            'description' => $request->description,
        ]);
        $this->image_upload($request, $room_type->id);

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

        $this->image_upload($request, $room_type->id);
        return redirect()->route('room_types.index')->with('message', 'Room Type Update Successfully 🙂');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $room_type = Roomtype::where('id', $id)->first();

        // Delete main room image if it's not the default
        if($room_type->sm_image != 'default_sm_image.jpg'){
            $photo_location = 'uploads/room_types/'.$room_type->sm_image;
            unlink($photo_location);
        }
        if($room_type->lg_image != 'default_lg_image.jpg'){
            $photo_location = 'uploads/room_types/'.$room_type->lg_image;
            unlink($photo_location);
        }

        $room_type->delete();

        return redirect()->back()->with('error', 'Room Type Deleted Successfully');
    }

    /**
     * Store/Update the Image file.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function image_upload($request, $room_type_id)
    {
        $room_type = Roomtype::findOrFail($room_type_id);
        $photo_location = 'public/uploads/room_types/';

        // Ensure the directory exists
        if (!file_exists(base_path($photo_location))) {
            mkdir(base_path($photo_location), 0755, true);
        }

        // Handle small image (sm_image)
        if ($request->hasFile('sm_image')) {
            // Delete the old image if it's not the default
            if ($room_type->sm_image && $room_type->sm_image != 'default_sm_image.jpg') {
                $old_photo_location = $photo_location . $room_type->sm_image;
                if (file_exists(base_path($old_photo_location))) {
                    unlink(base_path($old_photo_location));
                }
            }

            // Process and save new image
            $uploaded_photo = $request->file('sm_image');
            $new_photo_name = $room_type->id . '_' . time() . '_sm.' . $uploaded_photo->getClientOriginalExtension();
            $new_photo_location = $photo_location . $new_photo_name;
            Image::make($uploaded_photo)->resize(165, 80)->save(base_path($new_photo_location), 40);

            // Update room type with the new image name
            $room_type->update(['sm_image' => $new_photo_name]);
        }

        // Handle large image (lg_image)
        if ($request->hasFile('lg_image')) {
            // Delete the old image if it's not the default
            if ($room_type->lg_image && $room_type->lg_image != 'default_lg_image.jpg') {
                $old_photo_location = $photo_location . $room_type->lg_image;
                if (file_exists(base_path($old_photo_location))) {
                    unlink(base_path($old_photo_location));
                }
            }

            // Process and save new image
            $uploaded_photo = $request->file('lg_image');
            $new_photo_name = $room_type->id . '_' . time() . '_lg.' . $uploaded_photo->getClientOriginalExtension();
            $new_photo_location = $photo_location . $new_photo_name;
            Image::make($uploaded_photo)->resize(730, 705)->save(base_path($new_photo_location), 40);

            // Update room type with the new image name
            $room_type->update(['lg_image' => $new_photo_name]);
        }
    }

}
