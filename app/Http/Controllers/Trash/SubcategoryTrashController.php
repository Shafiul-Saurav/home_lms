<?php

namespace App\Http\Controllers\Trash;

use Illuminate\Http\Request;
use App\Models\Subcategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class SubcategoryTrashController extends Controller
{
    public function trash()
    {
        Gate::authorize('delete-product-subcategory');

        $subcategories = Subcategory::onlyTrashed()->with('category')->latest('id')->paginate(30);
        return view('backend.pages.subcategory.trash', compact('subcategories'));
    }

    public function restore($id)
    {
        Gate::authorize('delete-product-subcategory');

        $subcategory = Subcategory::onlyTrashed()->findOrFail($id);
        $subcategory->restore();

        return redirect()->back()->with('info', 'Subcategory Restored Successfully 🙂');
    }

    public function forceDelete(string $id)
    {
        Gate::authorize('delete-product-subcategory');

        $subcategory = Subcategory::onlyTrashed()->findOrFail($id);

        // Delete file if exists
        if ($subcategory->file && file_exists(public_path('uploads/subcategories/' . $subcategory->file))) {
            unlink(public_path('uploads/subcategories/' . $subcategory->file));
        }

        $subcategory->forceDelete();

        return redirect()->back()->with('error', 'Subcategory Deleted Permanently');
    }
}