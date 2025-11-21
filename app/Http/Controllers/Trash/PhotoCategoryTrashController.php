<?php

namespace App\Http\Controllers\Trash;

use Illuminate\Http\Request;
use App\Models\Photocategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class PhotoCategoryTrashController extends Controller
{
    public function trash()
    {
        Gate::authorize('delete-photo-category');
        
        $categories = Photocategory::onlyTrashed()->latest('id')->paginate(30);
        return view('backend.pages.photocategory.trash', compact('categories'));
    }

    public function restore($id)
    {
        Gate::authorize('delete-photo-category');
        
        $category = Photocategory::onlyTrashed()->findOrFail($id);
        $category->restore();

        return redirect()->back()->with('info', 'Photo Category Restored Successfully 🙂');
    }

    public function forceDelete(string $id)
    {
        Gate::authorize('delete-photo-category');
        
        $category = Photocategory::onlyTrashed()->findOrFail($id);
        $category->forceDelete();

        return redirect()->back()->with('error', 'Photo Category Deleted Permanently');

    }


}
