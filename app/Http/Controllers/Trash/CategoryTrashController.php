<?php

namespace App\Http\Controllers\Trash;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class CategoryTrashController extends Controller
{
    public function trash()
    {
        Gate::authorize('delete-product-category');

        $categories = Category::onlyTrashed()->latest('id')->paginate(30);
        return view('backend.pages.category.trash', compact('categories'));
    }

    public function restore($id)
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

        // Delete file if exists
        if ($category->file && file_exists(public_path('uploads/categories/' . $category->file))) {
            unlink(public_path('uploads/categories/' . $category->file));
        }

        $category->forceDelete();

        return redirect()->back()->with('error', 'Category Deleted Permanently');
    }
}