<?php

namespace App\Http\Controllers\Trash;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class CategoryTrashController extends Controller
{
    public function trash()
    {
        Gate::authorize('delete-product-category');
        
        $categories = Category::onlyTrashed()->latest('id')->paginate(50);
        return view('backend.pages.category.trash', compact('categories'));
    }

    public function restore(string $id)
    {
        Gate::authorize('delete-product-category');
        
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->restore();

        return redirect()->back()->with('info', 'Category Restored Successfully 🙂');
    }

    public function forceDelete(string $id)
    {
        Gate::authorize('delete-product-category');
        
        $category = Category::onlyTrashed()->findOrFail($id);

        // Delete category image if it exists
        if ($category->file && $category->file != 'default_category_image.jpg') {
            $photo_location = 'uploads/categories/' . $category->file;
            if (file_exists(public_path($photo_location))) {
                unlink(public_path($photo_location));
            }
        }

        $category->forceDelete();

        return redirect()->back()->with('error', 'Category Permanently Deleted');
    }
}
