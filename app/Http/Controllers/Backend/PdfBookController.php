<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\PdfBookStoreRequest;
use App\Http\Requests\PdfBookUpdateRequest;
use App\Models\PdfBookCategory;
use App\Models\PdfBook;
use App\Models\PdfBookSubcategory;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class PdfBookController extends Controller
{
    public function index()
    {
        $books = PdfBook::with('pdfBookCategory', 'pdfBookSubcategory')->whereNull('deleted_at')->latest('id')->paginate(100);
        $categories = PdfBookCategory::where('is_active', 1)->get();

        return view('backend.pages.pdfbook.pdfbook', compact('books', 'categories'));
    }

    public function create()
    {
        return redirect()->route('pdf_books.index');
    }

    public function store(PdfBookStoreRequest $request)
    {
        $book = PdfBook::create([
            'pdf_book_category_id' => $request->pdf_book_category_id,
            'pdf_book_subcategory_id' => $request->pdf_book_subcategory_id,
            'name' => $request->name,
            'slug' => preg_replace('/\s+/u', '-', trim($request->name)),
            'price' => $request->price,
            'discount_amount' => $request->discount_amount,
            'image' => 'default_book.jpg',
            'pdf_file' => null,
            'description' => $request->description,
            'author_name' => $request->author_name,
            'author_description' => $request->author_description,
            'is_active' => $request->has('is_active') ? $request->is_active : 1,
        ]);

        $this->imageUpload($request, $book->id);
        $this->pdfUpload($request, $book->id);
        $this->authorProfileUpload($request, $book->id);

        return redirect()->back()->with('message', 'PDF Book Created Successfully');
    }

    public function show(string $id)
    {
        $book = PdfBook::with('pdfBookCategory', 'pdfBookSubcategory')->findOrFail($id);
        return view('backend.pages.pdfbook.show', compact('book'));
    }

    public function edit(string $id)
    {
        $book = PdfBook::findOrFail($id);
        $categories = PdfBookCategory::where('is_active', 1)->get();
        $subcategories = [];

        if ($book->pdf_book_category_id) {
            $subcategories = PdfBookSubcategory::where('pdf_book_category_id', $book->pdf_book_category_id)
                ->where('is_active', 1)
                ->get();
        }

        return view('backend.pages.pdfbook.edit', compact('book', 'categories', 'subcategories'));
    }

    public function update(PdfBookUpdateRequest $request, string $id)
    {
        $book = PdfBook::findOrFail($id);

        $book->update([
            'pdf_book_category_id' => $request->pdf_book_category_id,
            'pdf_book_subcategory_id' => $request->pdf_book_subcategory_id,
            'name' => $request->name,
            'slug' => preg_replace('/\s+/u', '-', trim($request->name)),
            'price' => $request->price,
            'discount_amount' => $request->discount_amount,
            'description' => $request->description,
            'author_name' => $request->author_name,
            'author_description' => $request->author_description,
            'is_active' => $request->has('is_active') ? $request->is_active : 0,
        ]);

        $this->imageUpload($request, $book->id);
        $this->pdfUpload($request, $book->id);
        $this->authorProfileUpload($request, $book->id);

        return redirect()->back()->with('message', 'PDF Book Updated Successfully');
    }

    public function destroy(string $id)
    {
        $book = PdfBook::findOrFail($id);
        $book->delete();

        return redirect()->back()->with('error', 'PDF Book moved to trash');
    }

    public function imageUpload(Request $request, int $bookId): void
    {
        $book = PdfBook::findOrFail($bookId);

        if ($request->hasFile('image')) {
            if ($book->image && $book->image !== 'default_book.jpg') {
                $oldImagePath = public_path('uploads/pdfbooks/images/' . $book->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $imageLocation = public_path('uploads/pdfbooks/images/');
            $uploadedImage = $request->file('image');
            $newImageName = $book->id . '_' . time() . '.' . $uploadedImage->getClientOriginalExtension();

            if (!file_exists($imageLocation)) {
                mkdir($imageLocation, 0755, true);
            }

            $newImageLocation = $imageLocation . $newImageName;

            Image::make($uploadedImage)->resize(800, 800)->save($newImageLocation, 80);

            $book->update([
                'image' => $newImageName,
            ]);
        }
    }

    public function pdfUpload(Request $request, int $bookId): void
    {
        $book = PdfBook::findOrFail($bookId);

        if ($request->hasFile('pdf_file')) {
            if ($book->pdf_file && file_exists(public_path('uploads/pdfbooks/files/' . $book->pdf_file))) {
                unlink(public_path('uploads/pdfbooks/files/' . $book->pdf_file));
            }

            $fileLocation = public_path('uploads/pdfbooks/files/');
            $uploadedFile = $request->file('pdf_file');
            $newFileName = $book->id . '_' . time() . '.' . $uploadedFile->getClientOriginalExtension();

            if (!file_exists($fileLocation)) {
                mkdir($fileLocation, 0755, true);
            }

            $uploadedFile->move($fileLocation, $newFileName);

            $book->update([
                'pdf_file' => $newFileName,
            ]);
        }
    }

    public function authorProfileUpload(Request $request, int $bookId): void
    {
        $book = PdfBook::findOrFail($bookId);

        if ($request->hasFile('author_profile')) {
            if ($book->author_profile) {
                $oldImagePath = public_path('uploads/pdfbooks/authors/' . $book->author_profile);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $imageLocation = public_path('uploads/pdfbooks/authors/');
            $uploadedImage = $request->file('author_profile');
            $newImageName = $book->id . '_author.' . $uploadedImage->getClientOriginalExtension();

            if (!file_exists($imageLocation)) {
                mkdir($imageLocation, 0755, true);
            }

            $newImageLocation = $imageLocation . $newImageName;

            if ($uploadedImage->getClientOriginalExtension() === 'webp') {
                Image::make($uploadedImage)->resize(300, 300)->save($newImageLocation);
            } else {
                Image::make($uploadedImage)->resize(300, 300)->save($newImageLocation, 80);
            }

            $book->update([
                'author_profile' => $newImageName,
            ]);
        }
    }

    public function getSubcategories($categoryId)
    {
        $subcategories = PdfBookSubcategory::where('pdf_book_category_id', $categoryId)
            ->where('is_active', 1)
            ->select('id', 'name')
            ->get();

        return response()->json($subcategories);
    }

    public function checkActive($bookId)
    {
        $book = PdfBook::find($bookId);

        if (!$book) {
            return response()->json(['type' => 'error', 'message' => 'Not found'], 404);
        }

        $book->is_active = $book->is_active ? 0 : 1;
        $book->save();

        return response()->json(['type' => 'success', 'message' => 'Status Updated Successfully']);
    }
}
