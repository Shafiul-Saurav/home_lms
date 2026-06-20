<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PdfBookCategory;
use App\Http\Requests\PdfBookCategoryStoreRequest;
use App\Http\Requests\PdfBookCategoryUpdateRequest;
use Illuminate\Support\Facades\Gate;

class PdfBookCategoryController extends Controller
{
    public function index()
    {
        Gate::authorize('index-pdf-book-category');

        $categories = PdfBookCategory::latest('id')->paginate(30);
        return view('backend.pages.pdfbookcategory.category', compact('categories'));
    }

    public function create()
    {
        Gate::authorize('create-pdf-book-category');

        return redirect()->route('pdf_book_categories.index');
    }

    public function store(PdfBookCategoryStoreRequest $request)
    {
        Gate::authorize('create-pdf-book-category');

        $fileName = null;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/pdfbookcategories'), $fileName);
        }

        PdfBookCategory::create([
            'name' => $request->name,
            'slug' => preg_replace('/\s+/u', '-', trim($request->name)),
            'file' => $fileName,
            'is_active' => $request->has('is_active') ? 1 : 0,
            'is_home' => $request->has('is_home') ? 1 : 0,
        ]);

        return redirect()->back()->with('message', 'PDF Book Category Created Successfully');
    }

    public function show(string $id)
    {
        Gate::authorize('index-pdf-book-category');

        return redirect()->route('pdf_book_categories.index');
    }

    public function edit(string $id)
    {
        Gate::authorize('edit-pdf-book-category');

        $category = PdfBookCategory::findOrFail($id);
        return view('backend.pages.pdfbookcategory.edit', compact('category'));
    }

    public function update(PdfBookCategoryUpdateRequest $request, string $id)
    {
        Gate::authorize('edit-pdf-book-category');

        $category = PdfBookCategory::findOrFail($id);

        $fileName = $category->file;
        if ($request->hasFile('file')) {
            if ($category->file && file_exists(public_path('uploads/pdfbookcategories/' . $category->file))) {
                unlink(public_path('uploads/pdfbookcategories/' . $category->file));
            }

            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/pdfbookcategories'), $fileName);
        }

        $category->update([
            'name' => $request->name,
            'slug' => preg_replace('/\s+/u', '-', trim($request->name)),
            'file' => $fileName,
            'is_active' => $request->has('is_active') ? 1 : 0,
            'is_home' => $request->has('is_home') ? 1 : 0,
        ]);

        return redirect()->route('pdf_book_categories.index')->with('message', 'PDF Book Category Updated Successfully');
    }

    public function destroy(string $id)
    {
        Gate::authorize('delete-pdf-book-category');

        $category = PdfBookCategory::findOrFail($id);
        $category->delete();

        return redirect()->back()->with('warning', 'PDF Book Category Moved to Trash Successfully');
    }

    public function checkActive($id)
    {
        Gate::authorize('edit-pdf-book-category');

        $category = PdfBookCategory::find($id);
        if (!$category) {
            return response()->json(['type' => 'error', 'message' => 'Not found'], 404);
        }
        $category->is_active = $category->is_active ? 0 : 1;
        $category->save();
        return response()->json(['type' => 'success', 'message' => 'Status Updated']);
    }

    public function checkHome($id)
    {
        Gate::authorize('edit-pdf-book-category');

        $category = PdfBookCategory::find($id);
        if (!$category) {
            return response()->json(['type' => 'error', 'message' => 'Not found'], 404);
        }
        $category->is_home = $category->is_home ? 0 : 1;
        $category->save();
        return response()->json(['type' => 'success', 'message' => 'Home Status Updated']);
    }
}
