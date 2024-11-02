<?php

namespace App\Http\Controllers\Trash;

use App\Models\Videogallery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VideoGalleryTrashController extends Controller
{
    public function trash()
    {
        $videos = Videogallery::onlyTrashed()->latest('id')->paginate(50);
        return view('backend.pages.videogallery.trash', compact('videos'));
    }

    public function restore(string $id)
    {
        $videos = Videogallery::onlyTrashed()->findOrFail($id);
        $videos->restore();

        return redirect()->back()->with('info', 'Video Gallery Restored Successfully 🙂');

    }

    public function forceDelete(string $id)
    {
        $gallery = Videogallery::onlyTrashed()->findOrFail($id);
        $gallery->forceDelete();

        return redirect()->back()->with('error', 'Video Gallery Deleted Permanently');

    }
}
