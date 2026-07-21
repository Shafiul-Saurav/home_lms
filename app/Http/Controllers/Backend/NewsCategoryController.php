<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Newscategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class NewsCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Gate::authorize('index-news-category');

        $categories = Newscategory::latest('id')->paginate('50');
        return view('backend.pages.newscategory.newscategory', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Gate::authorize('create-news-category');

        Newscategory::create([
            'title' => $request->title,
        ]);

        return redirect()->back()->with('message', 'News Category Created Successfully 🙂');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Gate::authorize('edit-news-category');

        $category = Newscategory::findOrFail($id);

        return view('backend.pages.newscategory.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Gate::authorize('edit-news-category');

        $category = Newscategory::findOrFail($id);

        $category->update([
            'title' => $request->title,
        ]);
        return redirect()->back()->with('message', 'News Category Updated Successfully 🙂');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Gate::authorize('delete-news-category');

        $category = Newscategory::findOrFail($id);

        $category->delete();
        return redirect()->back()->with('warning', 'News Category Moved to Trash Successfully');
    }

    public function checkActiveActive($category_id)
    {
        $category = Newscategory::find($category_id);
        if (!$category) {
            return response()->json([
                'type' => 'error',
                'message' => 'Category not found'
            ], 404);
        }

        // Toggle the is_active status
        $category->is_active = $category->is_active ? 0 : 1;
        $category->save();

        return response()->json([
            'type' => 'success',
            'message' => 'Status Updated'
        ]);
    }

    public function checkActiveHome($category_id)
    {
        $category = Newscategory::find($category_id);
        if (!$category) {
            return response()->json([
                'type' => 'error',
                'message' => 'Category not found'
            ], 404);
        }

        // Toggle the is_active status
        $category->is_home = $category->is_home ? 0 : 1;
        $category->save();

        return response()->json([
            'type' => 'success',
            'message' => 'Status Updated'
        ]);
    }
}
