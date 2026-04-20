<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookStoreRequest;
use App\Http\Requests\BookUpdateRequest;
use App\Models\BookCategory;
use App\Models\Book;
use App\Models\BookSubcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Intervention\Image\Facades\Image;

class BookController extends Controller
{
    public function index()
    {

        $books = Book::with('bookCategory', 'bookSubcategory')->whereNull('deleted_at')->latest('id')->paginate(100);
        $categories = BookCategory::where('is_active', 1)->get();

        return view('backend.pages.book.book', compact('books', 'categories'));
    }

    public function create()
    {
        return redirect()->route('books.index');
    }

    public function store(BookStoreRequest $request)
    {

        $book = Book::create([
            'book_category_id' => $request->book_category_id,
            'book_subcategory_id' => $request->book_subcategory_id,
            'name' => $request->name,
            'price' => $request->price,
            'discount_amount' => $request->discount_amount,
            'image' => 'default_book.jpg',
            'description' => $request->description,
            'is_active' => $request->has('is_active') ? $request->is_active : 1,
        ]);

        $this->imageUpload($request, $book->id);

        return redirect()->back()->with('message', 'Book Created Successfully');
    }

    public function show(string $id)
    {
        $book = Book::with('bookCategory', 'bookSubcategory')->findOrFail($id);

        return view('backend.pages.book.show', compact('book'));
    }

    public function edit(string $id)
    {

        $book = Book::findOrFail($id);
        $categories = BookCategory::where('is_active', 1)->get();
        $subcategories = [];

        if ($book->book_category_id) {
            $subcategories = BookSubcategory::where('book_category_id', $book->book_category_id)
                ->where('is_active', 1)
                ->get();
        }

        return view('backend.pages.book.edit', compact('book', 'categories', 'subcategories'));
    }

    public function update(BookUpdateRequest $request, string $id)
    {

        $book = Book::findOrFail($id);

        $book->update([
            'book_category_id' => $request->book_category_id,
            'book_subcategory_id' => $request->book_subcategory_id,
            'name' => $request->name,
            'price' => $request->price,
            'discount_amount' => $request->discount_amount,
            'description' => $request->description,
            'is_active' => $request->has('is_active') ? $request->is_active : 0,
        ]);

        $this->imageUpload($request, $book->id);

        return redirect()->back()->with('message', 'Book Updated Successfully');
    }

    public function destroy(string $id)
    {

        $book = Book::findOrFail($id);
        $book->delete();

        return redirect()->back()->with('error', 'Book moved to trash successfully');
    }

    public function imageUpload(Request $request, int $bookId): void
    {
        $book = Book::findOrFail($bookId);

        if ($request->hasFile('image')) {
            if ($book->image && $book->image !== 'default_book.jpg') {
                $oldImagePath = public_path('uploads/books/' . $book->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $imageLocation = public_path('uploads/books/');
            $uploadedImage = $request->file('image');
            $newImageName = $book->id . '.' . $uploadedImage->getClientOriginalExtension();

            if (!file_exists($imageLocation)) {
                mkdir($imageLocation, 0755, true);
            }

            $newImageLocation = $imageLocation . $newImageName;

            if ($uploadedImage->getClientOriginalExtension() === 'webp') {
                Image::make($uploadedImage)->resize(800, 800)->save($newImageLocation);
            } else {
                Image::make($uploadedImage)->resize(800, 800)->save($newImageLocation, 80);
            }

            $book->update([
                'image' => $newImageName,
            ]);
        }
    }

    public function getSubcategories($categoryId)
    {
        $subcategories = BookSubcategory::where('book_category_id', $categoryId)
            ->where('is_active', 1)
            ->select('id', 'name')
            ->get();

        return response()->json($subcategories);
    }

    public function checkActive($bookId)
    {
        $book = Book::find($bookId);

        if (! $book) {
            return response()->json([
                'type' => 'error',
                'message' => 'Book not found',
            ], 404);
        }

        $book->is_active = $book->is_active ? 0 : 1;
        $book->save();

        return response()->json([
            'type' => 'success',
            'message' => 'Status Updated Successfully',
        ]);
    }
}
