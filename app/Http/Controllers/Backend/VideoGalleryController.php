<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Videogallery;
use Illuminate\Http\Request;

class VideoGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $videos = Videogallery::latest('id')->paginate(50);
        return view('backend.pages.videogallery.videogallery', compact('videos'));
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

        Videogallery::create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->back()->with('message', 'Video Gallery Created Successfully 🙂');
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
        $video = Videogallery::findOrFail($id);
        return view('backend.pages.videogallery.edit', compact('video'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());
        $video = Videogallery::findOrFail($id);
        $video->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('videogalleries.index')->with('message', 'Video Gallery Updated Successfully 🙂');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $video = Videogallery::findOrFail($id);
        $video->delete();

        return redirect()->back()->with('warning', 'Video Gallery Deleted Successfully');
    }

    public function checkActiveActive($video_id)
    {
        $video = Videogallery::find($video_id);
        if (!$video) {
            return response()->json([
                'type' => 'error',
                'message' => 'User not found'
            ], 404);
        }

        // Toggle the is_active status
        $video->is_active = $video->is_active ? 0 : 1;
        $video->save();

        return response()->json([
            'type' => 'success',
            'message' => 'Status Updated'
        ]);
    }

    public function checkActiveHome($video_id)
    {
        $video = Videogallery::find($video_id);
        if (!$video) {
            return response()->json([
                'type' => 'error',
                'message' => 'User not found'
            ], 404);
        }

        // Toggle the is_active status
        $video->is_home = $video->is_home ? 0 : 1;
        $video->save();

        return response()->json([
            'type' => 'success',
            'message' => 'Status Updated'
        ]);
    }
}
