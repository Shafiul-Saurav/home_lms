<?php

namespace App\Http\Controllers\Trash;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookSubcategoryTrashController extends Controller
{
    public function trash()
    {
        $subcategories = \App\Models\BookSubcategory::with('bookCategory')->onlyTrashed()->latest('id')->paginate(30);
        return view('backend.pages.booksubcategory.trash', compact('subcategories'));
    }

    public function restore($id)
    {
        $subcategory = \App\Models\BookSubcategory::onlyTrashed()->findOrFail($id);
        $subcategory->restore();
        return redirect()->back()->with('message', 'Book Subcategory restored successfully');
    }

    public function forceDelete($id)
    {
        $subcategory = \App\Models\BookSubcategory::onlyTrashed()->findOrFail($id);
        if ($subcategory->file && file_exists(public_path('uploads/booksubcategories/' . $subcategory->file))) {
            unlink(public_path('uploads/booksubcategories/' . $subcategory->file));
        }
        $subcategory->forceDelete();
        return redirect()->back()->with('error', 'Book Subcategory permanently deleted');
    }
}
