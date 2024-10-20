<?php

namespace App\Http\Controllers\Backend;

use App\Models\Photogallery;
use Illuminate\Http\Request;
use App\Models\Photocategory;
use App\Http\Controllers\Controller;
use App\Http\Requests\PhotoGalleryStoreRequest;
use Intervention\Image\Facades\Image;

class PhotoGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $galleries = Photogallery::with(['photoCategory'])->latest('id')->paginate(100);
        $categories = Photocategory::get();
        return view('backend.pages.photogallery.photogallery', compact('categories', 'galleries'));
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
    public function store(PhotoGalleryStoreRequest $request)
    {
        // dd($request->all());

        $gallery = Photogallery::create([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'price' => $request->price,
            'description' => $request->description,
        ]);

        $this->image_upload($request, $gallery->id);

        return redirect()->back()->with('message', 'Photo Gallery Created Successfully 🙂');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $gallery = Photogallery::findOrFail($id);

        return view('backend.pages.photogallery.view', compact('gallery'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $gallery = Photogallery::findOrFail($id);
        $categories = Photocategory::get();
        return view('backend.pages.photogallery.edit', compact('gallery', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());

        $gallery = Photogallery::findOrFail($id);
        $gallery->update([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'price' => $request->price,
            'description' => $request->description,
        ]);

        $this->image_upload($request, $gallery->id);

        return redirect()->route('photogalleries.index')->with('message', 'Photo Gallery Updated Successfully 🙂');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $gallery = Photogallery::findOrFail($id);
        $gallery->delete();

        return redirect()->back()->with('warning', 'Photo Gallery Deleted Successfully');
    }

    /**
     * Store/Update the Image file.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function image_upload($request, $gallery_id)
    {
        $gallery = Photogallery::findOrFail($gallery_id);
        // dd($request->all(), $gallery, $request->hasFile('gall_image'));
        if ($request->hasFile('gall_image')) {
            if ($gallery->gall_image != 'default_gall_image.jpg') {
                //delete old photo
                $photo_location = 'public/uploads/photogalleries/';
                $old_photo_location = $photo_location . $gallery->gall_image;
                unlink(base_path($old_photo_location));
            }
            $photo_location = 'public/uploads/photogalleries/';
            $uploaded_photo = $request->file('gall_image');
            $new_photo_name = $gallery->id . '.' . $uploaded_photo->getClientOriginalExtension();
            $new_photo_location = $photo_location . $new_photo_name;
            Image::make($uploaded_photo)->resize(380,400)->save(base_path($new_photo_location), 40);
            //$user = User::find($gallery->id);
            $check = $gallery->update([
                'gall_image' => $new_photo_name,
            ]);
        }
    }

    public function checkActiveActive($gallery_id)
    {
        $gallery = Photogallery::find($gallery_id);
        if (!$gallery) {
            return response()->json([
                'type' => 'error',
                'message' => 'User not found'
            ], 404);
        }

        // Toggle the is_active status
        $gallery->is_active = $gallery->is_active ? 0 : 1;
        $gallery->save();

        return response()->json([
            'type' => 'success',
            'message' => 'Status Updated'
        ]);
    }

    public function checkActiveHome($gallery_id)
    {
        $gallery = Photogallery::find($gallery_id);
        if (!$gallery) {
            return response()->json([
                'type' => 'error',
                'message' => 'User not found'
            ], 404);
        }

        // Toggle the is_active status
        $gallery->is_home = $gallery->is_home ? 0 : 1;
        $gallery->save();

        return response()->json([
            'type' => 'success',
            'message' => 'Status Updated'
        ]);
    }

}
