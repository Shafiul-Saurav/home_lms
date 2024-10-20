<?php

namespace App\Http\Controllers\Trash;

use App\Models\Photogallery;
use Illuminate\Http\Request;
use App\Models\Photocategory;
use App\Http\Controllers\Controller;

class PhotoGalleryTrashController extends Controller
{
    public function trash()
    {
        $galleries = Photogallery::onlyTrashed()->with(['photoCategory'])->latest('id')->paginate(100);
        return view('backend.pages.photogallery.trash', compact('galleries'));
    }

    public function restore(string $id)
    {
        $gallery = Photogallery::onlyTrashed()->findOrFail($id);
        $gallery->restore();

        return redirect()->back()->with('info', 'Photo Gallery Restored Successfully 🙂');

    }

    public function forceDelete(string $id)
    {
        $gallery = Photogallery::onlyTrashed()->findOrFail($id);

        // Delete main room image if it's not the default
        if($gallery->gall_image != 'default_gall_image.jpg'){
            $photo_location = 'uploads/photogalleries/'.$gallery->gall_image;
            unlink($photo_location);
        }

        $gallery->forceDelete();

        return redirect()->back()->with('error', 'Photo Gallery Permanently');

    }
}
