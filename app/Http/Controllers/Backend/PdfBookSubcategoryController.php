<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PdfBookCategory;
use App\Models\PdfBookSubcategory;
use App\Http\Requests\PdfBookSubcategoryStoreRequest;
use App\Http\Requests\PdfBookSubcategoryUpdateRequest;

class PdfBookSubcategoryController extends Controller
{
    public function index()
    {
        $subcategories = PdfBookSubcategory::with('pdfBookCategory')->latest('id')->paginate(30);
        $categories = PdfBookCategory::where('is_active', 1)->get();
        return view('backend.pages.pdfbooksubcategory.subcategory', compact('subcategories', 'categories'));
    }

    public function create()
    {
        return redirect()->route('pdf_book_subcategories.index');
    }

    public function store(PdfBookSubcategoryStoreRequest $request)
    {
        $fileName = null;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/pdfbooksubcategories'), $fileName);
        }

        PdfBookSubcategory::create([
            'pdf_book_category_id' => $request->pdf_book_category_id,
            'name' => $request->name,
            'slug' => preg_replace('/\s+/u', '-', trim($request->name)),
            'file' => $fileName,
            'is_active' => $request->has('is_active') ? 1 : 0,
            'is_home' => $request->has('is_home') ? 1 : 0,
        ]);

        return redirect()->back()->with('message', 'PDF Book Subcategory Created Successfully');
    }

    public function show(string $id)
    {
        return redirect()->route('pdf_book_subcategories.index');
    }

    public function edit(string $id)
    {
        $subcategory = PdfBookSubcategory::findOrFail($id);
        $categories = PdfBookCategory::where('is_active', 1)->get();
        return view('backend.pages.pdfbooksubcategory.edit', compact('subcategory', 'categories'));
    }

    public function update(PdfBookSubcategoryUpdateRequest $request, string $id)
    {
        $subcategory = PdfBookSubcategory::findOrFail($id);

        $fileName = $subcategory->file;
        if ($request->hasFile('file')) {
            if ($subcategory->file && file_exists(public_path('uploads/pdfbooksubcategories/' . $subcategory->file))) {
                unlink(public_path('uploads/pdfbooksubcategories/' . $subcategory->file));
            }

            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/pdfbooksubcategories'), $fileName);
        }

        $subcategory->update([
            'pdf_book_category_id' => $request->pdf_book_category_id,
            'name' => $request->name,
            'slug' => preg_replace('/\s+/u', '-', trim($request->name)),
            'file' => $fileName,
            'is_active' => $request->has('is_active') ? 1 : 0,
            'is_home' => $request->has('is_home') ? 1 : 0,
        ]);

        return redirect()->route('pdf_book_subcategories.index')->with('message', 'PDF Book Subcategory Updated Successfully');
    }

    public function destroy(string $id)
    {
        $subcategory = PdfBookSubcategory::findOrFail($id);
        $subcategory->delete();

        return redirect()->back()->with('warning', 'PDF Book Subcategory Moved to Trash Successfully');
    }

    public function checkActive($id)
    {
        $subcategory = PdfBookSubcategory::find($id);
        if (!$subcategory) {
            return response()->json(['type' => 'error', 'message' => 'Not found'], 404);
        }
        $subcategory->is_active = $subcategory->is_active ? 0 : 1;
        $subcategory->save();
        return response()->json(['type' => 'success', 'message' => 'Status Updated']);
    }

    public function checkHome($id)
    {
        $subcategory = PdfBookSubcategory::find($id);
        if (!$subcategory) {
            return response()->json(['type' => 'error', 'message' => 'Not found'], 404);
        }
        $subcategory->is_home = $subcategory->is_home ? 0 : 1;
        $subcategory->save();
        return response()->json(['type' => 'success', 'message' => 'Home Status Updated']);
    }
}
