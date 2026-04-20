<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PdfBookCategory;
use App\Http\Requests\PdfBookCategoryStoreRequest;
use App\Http\Requests\PdfBookCategoryUpdateRequest;
use Illuminate\Support\Str;

class PdfBookCategoryController extends Controller
{
    public function index()
    {
        $categories = PdfBookCategory::latest('id')->paginate(30);
        return view('backend.pages.pdfbookcategory.category', compact('categories'));
    }

    public function create()
    {
        return redirect()->route('pdf_book_categories.index');
    }

    public function store(PdfBookCategoryStoreRequest $request)
    {
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
        return redirect()->route('pdf_book_categories.index');
    }

    public function edit(string $id)
    {
        $category = PdfBookCategory::findOrFail($id);
        return view('backend.pages.pdfbookcategory.edit', compact('category'));
    }

    public function update(PdfBookCategoryUpdateRequest $request, string $id)
    {
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
        $category = PdfBookCategory::findOrFail($id);
        $category->delete();

        return redirect()->back()->with('warning', 'PDF Book Category moved to trash');
    }

    public function checkActive($id)
    {
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
        $category = PdfBookCategory::find($id);
        if (!$category) {
            return response()->json(['type' => 'error', 'message' => 'Not found'], 404);
        }
        $category->is_home = $category->is_home ? 0 : 1;
        $category->save();
        return response()->json(['type' => 'success', 'message' => 'Home Status Updated']);
    }
}
