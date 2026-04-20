<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BookCategory;
use Illuminate\Support\Str;
use App\Http\Requests\BookCategoryStoreRequest;
use App\Http\Requests\BookCategoryUpdateRequest;

class BookCategoryController extends Controller
{
    public function index()
    {
        $categories = BookCategory::latest('id')->paginate(30);
        return view('backend.pages.bookcategory.category', compact('categories'));
    }

    public function create()
    {
        return redirect()->route('book_categories.index');
    }

    public function store(BookCategoryStoreRequest $request)
    {
        $fileName = null;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/bookcategories'), $fileName);
        }

        BookCategory::create([
            'name' => $request->name,
            'slug' => preg_replace('/\s+/u', '-', trim($request->name)),
            'file' => $fileName,
            'is_active' => $request->has('is_active') ? 1 : 0,
            'is_home' => $request->has('is_home') ? 1 : 0,
        ]);

        return redirect()->back()->with('message', 'Book Category Created Successfully');
    }

    public function show(string $id)
    {
        return redirect()->route('book_categories.index');
    }

    public function edit(string $id)
    {
        $category = BookCategory::findOrFail($id);
        return view('backend.pages.bookcategory.edit', compact('category'));
    }

    public function update(BookCategoryUpdateRequest $request, string $id)
    {
        $category = BookCategory::findOrFail($id);

        $fileName = $category->file;
        if ($request->hasFile('file')) {
            if ($category->file && file_exists(public_path('uploads/bookcategories/' . $category->file))) {
                unlink(public_path('uploads/bookcategories/' . $category->file));
            }

            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/bookcategories'), $fileName);
        }

        $category->update([
            'name' => $request->name,
            'slug' => preg_replace('/\s+/u', '-', trim($request->name)),
            'file' => $fileName,
            'is_active' => $request->has('is_active') ? 1 : 0,
            'is_home' => $request->has('is_home') ? 1 : 0,
        ]);

        return redirect()->route('book_categories.index')->with('message', 'Book Category Updated Successfully');
    }

    public function destroy(string $id)
    {
        $category = BookCategory::findOrFail($id);
        $category->delete();

        return redirect()->back()->with('warning', 'Book Category moved to trash');
    }

    public function checkActive($category_id)
    {
        $category = BookCategory::find($category_id);
        if (!$category) {
            return response()->json(['type' => 'error', 'message' => 'Not found'], 404);
        }
        $category->is_active = $category->is_active ? 0 : 1;
        $category->save();
        return response()->json(['type' => 'success', 'message' => 'Status Updated']);
    }

    public function checkHome($category_id)
    {
        $category = BookCategory::find($category_id);
        if (!$category) {
            return response()->json(['type' => 'error', 'message' => 'Not found'], 404);
        }
        $category->is_home = $category->is_home ? 0 : 1;
        $category->save();
        return response()->json(['type' => 'success', 'message' => 'Home Status Updated']);
    }
}
