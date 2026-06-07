<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Photocategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class PhotoCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('index-gallery-category');

        $categories = Photocategory::latest('id')->paginate(30);
        return view('backend.pages.photocategory.photocategory', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('create-gallery-category');

        // dd($request->all());

        Photocategory::create([
            'category_name' => $request->category_name,
            'category_slug' => preg_replace('/\s+/u', '-', trim($request->category_name)),
        ]);

        return redirect()->back()->with('message', 'Photo Category Created Successfully 🙂');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $category_slug)
    {
        Gate::authorize('edit-gallery-category');

        $category = Photocategory::where('category_slug', $category_slug)->first();
        return view('backend.pages.photocategory.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $category_slug)
    {
        Gate::authorize('edit-gallery-category');

        // dd($request->all());
        $category = Photocategory::where('category_slug', $category_slug)->first();

        $category->update([
            'category_name' => $request->category_name,
            'category_slug' => preg_replace('/\s+/u', '-', trim($request->category_name)),
        ]);

        return redirect()->route('photocategories.index')->with('message', 'Photo Category Updated Successfully 🙂');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $category_slug)
    {
        Gate::authorize('delete-gallery-category');

        $category = Photocategory::where('category_slug', $category_slug)->first();
        $category->delete();

        return redirect()->back()->with('warning', 'Photo Category Moved to Trash Successfully');
    }

    public function checkActiveActive($category_id)
    {
        $category = Photocategory::find($category_id);
        if (!$category) {
            return response()->json([
                'type' => 'error',
                'message' => 'User not found'
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
        $category = Photocategory::find($category_id);
        if (!$category) {
            return response()->json([
                'type' => 'error',
                'message' => 'User not found'
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

