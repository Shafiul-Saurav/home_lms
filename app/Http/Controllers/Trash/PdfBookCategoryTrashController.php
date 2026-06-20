<?php

namespace App\Http\Controllers\Trash;

use App\Http\Controllers\Controller;
use App\Models\PdfBookCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PdfBookCategoryTrashController extends Controller
{
    public function trash()
    {
        Gate::authorize('delete-pdf-book-category');

        $categories = PdfBookCategory::onlyTrashed()->latest('id')->paginate(30);
        return view('backend.pages.pdfbookcategory.trash', compact('categories'));
    }

    public function restore($id)
    {
        Gate::authorize('delete-pdf-book-category');

        $category = PdfBookCategory::onlyTrashed()->findOrFail($id);
        $category->restore();
        return redirect()->back()->with('message', 'Category Restored Successfully');
    }

    public function forceDelete($id)
    {
        Gate::authorize('delete-pdf-book-category');

        $category = PdfBookCategory::onlyTrashed()->findOrFail($id);
        if ($category->file && file_exists(public_path('uploads/pdfbookcategories/' . $category->file))) {
            unlink(public_path('uploads/pdfbookcategories/' . $category->file));
        }
        $category->forceDelete();
        return redirect()->back()->with('error', 'Category Permanently Deleted');
    }
}
