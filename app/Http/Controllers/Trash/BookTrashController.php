<?php

namespace App\Http\Controllers\Trash;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class BookTrashController extends Controller
{
    public function trash()
    {
        Gate::authorize('delete-book');

        $books = Book::with('bookCategory', 'bookSubcategory')->onlyTrashed()->latest('id')->paginate(100);

        return view('backend.pages.book.trash', compact('books'));
    }

    public function restore($id)
    {
        Gate::authorize('delete-book');

        $book = Book::onlyTrashed()->findOrFail($id);
        $book->restore();

        return redirect()->back()->with('message', 'Book restored successfully');
    }

    public function forceDelete($id)
    {
        Gate::authorize('delete-book');

        $book = Book::onlyTrashed()->findOrFail($id);

        if ($book->image && $book->image !== 'default_book.jpg') {
            $imagePath = public_path('uploads/books/' . $book->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $book->forceDelete();

        return redirect()->back()->with('error', 'Book permanently deleted');
    }
}
