<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BookSubcategory;
use App\Models\BookCategory;
use App\Http\Requests\BookSubcategoryStoreRequest;
use App\Http\Requests\BookSubcategoryUpdateRequest;

class BookSubcategoryController extends Controller
{
    public function index()
    {
        $subcategories = BookSubcategory::with('bookCategory')->latest('id')->paginate(30);
        $categories = BookCategory::where('is_active', 1)->get();
        return view('backend.pages.booksubcategory.subcategory', compact('subcategories', 'categories'));
    }

    public function create()
    {
        return redirect()->route('book_subcategories.index');
    }

    public function store(BookSubcategoryStoreRequest $request)
    {
        $fileName = null;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/booksubcategories'), $fileName);
        }

        BookSubcategory::create([
            'book_category_id' => $request->book_category_id,
            'name' => $request->name,
            'slug' => preg_replace('/\s+/u', '-', trim($request->name)),
            'file' => $fileName,
            'is_active' => $request->has('is_active') ? 1 : 0,
            'is_home' => $request->has('is_home') ? 1 : 0,
        ]);

        return redirect()->back()->with('message', 'Book Subcategory Created Successfully');
    }

    public function show(string $id)
    {
        return redirect()->route('book_subcategories.index');
    }

    public function edit(string $id)
    {
        $subcategory = BookSubcategory::findOrFail($id);
        $categories = BookCategory::where('is_active', 1)->get();
        return view('backend.pages.booksubcategory.edit', compact('subcategory', 'categories'));
    }

    public function update(BookSubcategoryUpdateRequest $request, string $id)
    {
        $subcategory = BookSubcategory::findOrFail($id);

        $fileName = $subcategory->file;
        if ($request->hasFile('file')) {
            if ($subcategory->file && file_exists(public_path('uploads/booksubcategories/' . $subcategory->file))) {
                unlink(public_path('uploads/booksubcategories/' . $subcategory->file));
            }

            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/booksubcategories'), $fileName);
        }

        $subcategory->update([
            'book_category_id' => $request->book_category_id,
            'name' => $request->name,
            'slug' => preg_replace('/\s+/u', '-', trim($request->name)),
            'file' => $fileName,
            'is_active' => $request->has('is_active') ? 1 : 0,
            'is_home' => $request->has('is_home') ? 1 : 0,
        ]);

        return redirect()->route('book_subcategories.index')->with('message', 'Book Subcategory Updated Successfully');
    }

    public function destroy(string $id)
    {
        $subcategory = BookSubcategory::findOrFail($id);
        $subcategory->delete();

        return redirect()->back()->with('warning', 'Book Subcategory Moved to Trash Successfully');
    }

    public function checkActive($subcategory_id)
    {
        $subcategory = BookSubcategory::find($subcategory_id);
        if (!$subcategory) {
            return response()->json(['type' => 'error', 'message' => 'Not found'], 404);
        }
        $subcategory->is_active = $subcategory->is_active ? 0 : 1;
        $subcategory->save();
        return response()->json(['type' => 'success', 'message' => 'Status Updated']);
    }

    public function checkHome($subcategory_id)
    {
        $subcategory = BookSubcategory::find($subcategory_id);
        if (!$subcategory) {
            return response()->json(['type' => 'error', 'message' => 'Not found'], 404);
        }
        $subcategory->is_home = $subcategory->is_home ? 0 : 1;
        $subcategory->save();
        return response()->json(['type' => 'success', 'message' => 'Home Status Updated']);
    }

    public function getSubcategoriesByCategory($category_id)
    {
        $subcategories = BookSubcategory::where('book_category_id', $category_id)
            ->where('is_active', 1)
            ->select('id', 'name')
            ->get();
        return response()->json($subcategories);
    }
}
