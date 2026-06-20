<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BookCategory;
use App\Http\Requests\BookCategoryStoreRequest;
use App\Http\Requests\BookCategoryUpdateRequest;
use Illuminate\Support\Facades\Gate;

class BookCategoryController extends Controller
{
    public function index()
    {
        Gate::authorize('index-book-category');

        $categories = BookCategory::latest('id')->paginate(30);
        return view('backend.pages.bookcategory.category', compact('categories'));
    }

    public function create()
    {
        Gate::authorize('create-book-category');

        return redirect()->route('book_categories.index');
    }

    public function store(BookCategoryStoreRequest $request)
    {
        Gate::authorize('create-book-category');

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
        Gate::authorize('index-book-category');

        return redirect()->route('book_categories.index');
    }

    public function edit(string $id)
    {
        Gate::authorize('edit-book-category');

        $category = BookCategory::findOrFail($id);
        return view('backend.pages.bookcategory.edit', compact('category'));
    }

    public function update(BookCategoryUpdateRequest $request, string $id)
    {
        Gate::authorize('edit-book-category');

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
        Gate::authorize('delete-book-category');

        $category = BookCategory::findOrFail($id);
        $category->delete();

        return redirect()->back()->with('warning', 'Book Category Moved to Trash Successfully');
    }

    public function checkActive($category_id)
    {
        Gate::authorize('edit-book-category');

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
        Gate::authorize('edit-book-category');

        $category = BookCategory::find($category_id);
        if (!$category) {
            return response()->json(['type' => 'error', 'message' => 'Not found'], 404);
        }
        $category->is_home = $category->is_home ? 0 : 1;
        $category->save();
        return response()->json(['type' => 'success', 'message' => 'Home Status Updated']);
    }
}
