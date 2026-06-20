<?php

namespace App\Http\Controllers\Trash;

use App\Http\Controllers\Controller;
use App\Models\PdfBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PdfBookTrashController extends Controller
{
    public function trash()
    {
        Gate::authorize('delete-pdf-book');

        $books = PdfBook::onlyTrashed()->with('pdfBookCategory', 'pdfBookSubcategory')->latest('id')->paginate(30);
        return view('backend.pages.pdfbook.trash', compact('books'));
    }

    public function restore($id)
    {
        Gate::authorize('delete-pdf-book');

        $book = PdfBook::onlyTrashed()->findOrFail($id);
        $book->restore();
        return redirect()->back()->with('message', 'PDF Book Restored Successfully');
    }

    public function forceDelete($id)
    {
        Gate::authorize('delete-pdf-book');

        $book = PdfBook::onlyTrashed()->findOrFail($id);
        
        // Delete image
        if ($book->image && $book->image !== 'default_book.jpg') {
            $imagePath = public_path('uploads/pdfbooks/images/' . $book->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        // Delete PDF file
        if ($book->pdf_file) {
            $pdfPath = public_path('uploads/pdfbooks/files/' . $book->pdf_file);
            if (file_exists($pdfPath)) {
                unlink($pdfPath);
            }
        }

        $book->forceDelete();
        return redirect()->back()->with('error', 'PDF Book Permanently Deleted');
    }
}
