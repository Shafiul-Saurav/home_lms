<?php

namespace App\Http\Controllers\Trash;

use Illuminate\Http\Request;
use App\Models\Photocategory;
use App\Http\Controllers\Controller;

class PhotoCategoryTrashController extends Controller
{
    public function trash()
    {
        $categories = Photocategory::onlyTrashed()->latest('id')->paginate(30);
        return view('backend.pages.photocategory.trash', compact('categories'));
    }

    public function restore($id)
    {
        $category = Photocategory::onlyTrashed()->findOrFail($id);
        $category->restore();

        return redirect()->back()->with('info', 'Photo Category Restored Successfully 🙂');
    }

    public function forceDelete(string $id)
    {
        $category = Photocategory::onlyTrashed()->findOrFail($id);
        $category->forceDelete();

        return redirect()->back()->with('error', 'Photo Category Deleted Permanently');

    }


}
