<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\HomeSlider;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class HomeSliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
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
        $home_slider = HomeSlider::where('id', $id)->first();
        return view('backend.pages.general.home_slider.edit', compact('home_slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
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
        $home_slider = HomeSlider::where('id', $id)->first();
        if($home_slider->slider_image != 'default_home_slider.jpg'){
            $photo_location = 'uploads/home_slider/'.$home_slider->slider_image;
            unlink($photo_location);
        }
        $home_slider->delete();
        return redirect()->back()->with('error', 'Slider Deleted Successfully');
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
        // dd($request->all(), $home_slider, $request->hasFile('slider_image'));
        if ($request->hasFile('slider_image')) {
            if ($home_slider->slider_image != 'default_home_slider.jpg') {
                //delete old photo
                $photo_location = 'public/uploads/home_slider/';
                $old_photo_location = $photo_location . $home_slider->slider_image;
                unlink(base_path($old_photo_location));
            }
            $photo_location = 'public/uploads/home_slider/';
            $uploaded_photo = $request->file('slider_image');
            $new_photo_name = $home_slider->id . '.' . $uploaded_photo->getClientOriginalExtension();
            $new_photo_location = $photo_location . $new_photo_name;
            Image::make($uploaded_photo)->resize(1920,576)->save(base_path($new_photo_location), 40);
            //$user = User::find($home_slider->id);
            $check = $home_slider->update([
                'slider_image' => $new_photo_name,
            ]);
        }
    }

}
