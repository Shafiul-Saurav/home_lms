<?php

namespace App\Http\Controllers\Trash;

use App\Models\Videogallery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class VideoGalleryTrashController extends Controller
{
    public function trash()
    {
        Gate::authorize('delete-video-gallery');
        
        $videos = Videogallery::onlyTrashed()->latest('id')->paginate(50);
        return view('backend.pages.videogallery.trash', compact('videos'));
    }

    public function restore(string $id)
    {
        Gate::authorize('delete-video-gallery');
        
        $videos = Videogallery::onlyTrashed()->findOrFail($id);
        $videos->restore();

        return redirect()->back()->with('info', 'Video Gallery Restored Successfully 🙂');

    }

    public function forceDelete(string $id)
    {
        Gate::authorize('delete-video-gallery');
        
        $gallery = Videogallery::onlyTrashed()->findOrFail($id);
        $gallery->forceDelete();

        return redirect()->back()->with('error', 'Video Gallery Deleted Permanently');

    }
}
