<?php

namespace App\Http\Controllers\Trash;

use App\Models\Postcategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostCategoryTrashController extends Controller
{
    public function trash()
    {
        $categories = Postcategory::onlyTrashed()->latest('id')->paginate('50');
        return view('backend.pages.postcategory.trash', compact('categories'));
    }

    public function restore($id)
    {
        $category = Postcategory::onlyTrashed()->findOrFail($id);
        $category->restore();

        return redirect()->back()->with('info', 'Post Category Restored Successfully 🙂');
    }

    public function forceDelete(string $id)
    {
        $category = Postcategory::onlyTrashed()->findOrFail($id);
        $category->forceDelete();

        return redirect()->back()->with('error', 'Post Category Deleted Permanently');

    }
}
