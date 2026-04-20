<?php

namespace App\Http\Controllers\Trash;

use App\Http\Controllers\Controller;
use App\Models\PdfBookSubcategory;
use Illuminate\Http\Request;

class PdfBookSubcategoryTrashController extends Controller
{
    public function trash()
    {
        $subcategories = PdfBookSubcategory::onlyTrashed()->with('pdfBookCategory')->latest('id')->paginate(30);
        return view('backend.pages.pdfbooksubcategory.trash', compact('subcategories'));
    }

    public function restore($id)
    {
        $subcategory = PdfBookSubcategory::onlyTrashed()->findOrFail($id);
        $subcategory->restore();
        return redirect()->back()->with('message', 'Subcategory Restored Successfully');
    }

    public function forceDelete($id)
    {
        $subcategory = PdfBookSubcategory::onlyTrashed()->findOrFail($id);
        if ($subcategory->file && file_exists(public_path('uploads/pdfbooksubcategories/' . $subcategory->file))) {
            unlink(public_path('uploads/pdfbooksubcategories/' . $subcategory->file));
        }
        $subcategory->forceDelete();
        return redirect()->back()->with('error', 'Subcategory Permanently Deleted');
    }
}
