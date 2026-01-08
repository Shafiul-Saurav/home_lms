<?php

namespace App\Http\Controllers\Trash;

use Illuminate\Http\Request;
use App\Models\Childcategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class ChildcategoryTrashController extends Controller
{
    public function trash()
    {
        Gate::authorize('delete-product-category');

        $childcategories = Childcategory::with(['category', 'subcategory'])->onlyTrashed()->latest('id')->paginate(30);
        return view('backend.pages.childcategory.trash', compact('childcategories'));
    }

    public function restore($id)
    {
        Gate::authorize('delete-product-category');

        $childcategory = Childcategory::onlyTrashed()->findOrFail($id);
        $childcategory->restore();

        return redirect()->back()->with('info', 'Childcategory Restored Successfully 🙂');
    }

    public function forceDelete(string $id)
    {
        Gate::authorize('delete-product-category');

        $childcategory = Childcategory::onlyTrashed()->findOrFail($id);

        // Delete file if exists
        if ($childcategory->file && file_exists(public_path('uploads/childcategories/' . $childcategory->file))) {
            unlink(public_path('uploads/childcategories/' . $childcategory->file));
        }

        $childcategory->forceDelete();

        return redirect()->back()->with('error', 'Childcategory Deleted Permanently');
    }
}