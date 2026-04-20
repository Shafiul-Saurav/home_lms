<?php

namespace App\Http\Controllers\Trash;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookCategoryTrashController extends Controller
{
    public function trash()
    {
        $categories = \App\Models\BookCategory::onlyTrashed()->latest('id')->paginate(30);
        return view('backend.pages.bookcategory.trash', compact('categories'));
    }

    public function restore($id)
    {
        $category = \App\Models\BookCategory::onlyTrashed()->findOrFail($id);
        $category->restore();
        return redirect()->back()->with('message', 'Book Category restored successfully');
    }

    public function forceDelete($id)
    {
        $category = \App\Models\BookCategory::onlyTrashed()->findOrFail($id);
        if ($category->file && file_exists(public_path('uploads/bookcategories/' . $category->file))) {
            unlink(public_path('uploads/bookcategories/' . $category->file));
        }
        $category->forceDelete();
        return redirect()->back()->with('error', 'Book Category permanently deleted');
    }
}
