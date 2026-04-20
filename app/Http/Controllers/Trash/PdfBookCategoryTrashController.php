<?php

namespace App\Http\Controllers\Trash;

use App\Http\Controllers\Controller;
use App\Models\PdfBookCategory;
use Illuminate\Http\Request;

class PdfBookCategoryTrashController extends Controller
{
    public function trash()
    {
        $categories = PdfBookCategory::onlyTrashed()->latest('id')->paginate(30);
        return view('backend.pages.pdfbookcategory.trash', compact('categories'));
    }

    public function restore($id)
    {
        $category = PdfBookCategory::onlyTrashed()->findOrFail($id);
        $category->restore();
        return redirect()->back()->with('message', 'Category Restored Successfully');
    }

    public function forceDelete($id)
    {
        $category = PdfBookCategory::onlyTrashed()->findOrFail($id);
        if ($category->file && file_exists(public_path('uploads/pdfbookcategories/' . $category->file))) {
            unlink(public_path('uploads/pdfbookcategories/' . $category->file));
        }
        $category->forceDelete();
        return redirect()->back()->with('error', 'Category Permanently Deleted');
    }
}
