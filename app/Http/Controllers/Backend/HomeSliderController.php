<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\HomeSlider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Intervention\Image\Laravel\Facades\Image;

class HomeSliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('index-home-slider');
        $home_sliders = HomeSlider::latest('id')->paginate(50);
        return view('backend.pages.general.home_slider.home_slider', compact('home_sliders'));
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
        Gate::authorize('create-home-slider');
        // dd($request->all());
        $home_slider = HomeSlider::create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        $this->image_upload($request, $home_slider->id);
        return redirect()->back()->with('message', 'Slider Created Successfully 🙂');
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
        Gate::authorize('edit-home-slider');
        $home_slider = HomeSlider::where('id', $id)->first();
        return view('backend.pages.general.home_slider.edit', compact('home_slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Gate::authorize('edit-home-slider');
        $home_slider = HomeSlider::where('id', $id)->first();
        $home_slider->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);
        $this->image_upload($request, $home_slider->id);
        return redirect()->route('home_slider.index')->with('message', 'Slider Updated Successfully 🙂');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Gate::authorize('delete-home-slider');
        $home_slider = HomeSlider::where('id', $id)->first();
        if($home_slider->slider_image != 'default_home_slider.jpg'){
            $photo_location = 'uploads/home_slider/'.$home_slider->slider_image;
            unlink($photo_location);
        }
        $home_slider->delete();
        return redirect()->back()->with('error', 'Slider Moved to Trash Successfully');
    }

    /**
     * Store/Update the Image file.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function image_upload($request, $home_slider_id)
    {
        $home_slider = HomeSlider::findOrFail($home_slider_id);

        if ($request->hasFile('slider_image')) {
            $photo_location = public_path('uploads/home_slider/');

            // পুরোনো ছবি ডিলিট করার সেফটি চেক
            if ($home_slider->slider_image && $home_slider->slider_image !== 'default_home_slider.jpg') {
                $old_photo_path = $photo_location . $home_slider->slider_image;
                if (file_exists($old_photo_path)) {
                    unlink($old_photo_path);
                }
            }

            // ডিরেক্টরি না থাকলে তৈরি করে নেওয়া
            if (!file_exists($photo_location)) {
                mkdir($photo_location, 0755, true);
            }

            $uploaded_photo = $request->file('slider_image');
            $extension = strtolower($uploaded_photo->getClientOriginalExtension());
            $new_photo_name = $home_slider->id . '.' . $extension;
            $new_photo_path = $photo_location . $new_photo_name;

            // Intervention Image v3/v4 সিনট্যাক্স
            $img = Image::read($uploaded_photo)->resize(1920, 335);

            if ($extension === 'webp') {
                $img->toWebp(40)->save($new_photo_path);
            } else {
                $img->toJpeg(40)->save($new_photo_path);
            }

            $home_slider->update([
                'slider_image' => $new_photo_name,
            ]);
        }
    }

}
