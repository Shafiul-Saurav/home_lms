<?php

namespace App\Http\Controllers\Backend;

use App\Models\About;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $about = About::first();
        return view('backend.pages.about.about', compact('about'));
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
        $about = About::firstOrNew();
        $about->title = $request->title;
        $about->sub_title = $request->sub_title;
        $about->description = $request->description;

        if ($request->hasFile('about_image')) {
            // Delete old about_image if it exists
            if ($about->about_image && File::exists(public_path($about->about_image))) {
                File::delete(public_path($about->about_image));
            }

            $aboutPath = 'uploads/abouts/' . uniqid() . '.' . $request->about_image->extension();
            $request->about_image->move(public_path('uploads/abouts'), $aboutPath);
            $about->about_image = $aboutPath;
        }

        $about->save();

        return redirect()->back()->with('message', 'About Info Updated successfully');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
