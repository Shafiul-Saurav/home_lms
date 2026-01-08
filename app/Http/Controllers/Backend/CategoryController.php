<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('index-product-category');

        $categories = Category::latest('id')->paginate(30);
        return view('backend.pages.category.category', compact('categories'));
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
        Gate::authorize('create-product-category');

        // Handle file upload if present
        $fileName = null;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/categories'), $fileName);
        }

        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'file' => $fileName,
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]);

        return redirect()->back()->with('message', 'Category Created Successfully 🙂');
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
    public function edit(string $slug)
    {
        Gate::authorize('edit-product-category');

        $category = Category::where('slug', $slug)->first();
        return view('backend.pages.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $slug)
    {
        Gate::authorize('edit-product-category');

        $category = Category::where('slug', $slug)->first();

        // Handle file upload if present
        $fileName = $category->file;
        if ($request->hasFile('file')) {
            // Delete old file if exists
            if ($category->file && file_exists(public_path('uploads/categories/' . $category->file))) {
                unlink(public_path('uploads/categories/' . $category->file));
            }

            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/categories'), $fileName);
        }

        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'file' => $fileName,
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]);

        return redirect()->route('categories.index')->with('message', 'Category Updated Successfully 🙂');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug)
    {
        Gate::authorize('delete-product-category');

        $category = Category::where('slug', $slug)->first();
        $category->delete();

        return redirect()->back()->with('warning', 'Category Deleted Successfully');
    }

    public function checkActive($category_id)
    {
        $category = Category::find($category_id);
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

    public function checkHome($category_id)
    {
        $category = Category::find($category_id);
        if (!$category) {
            return response()->json([
                'type' => 'error',
                'message' => 'Category not found'
            ], 404);
        }

        // Toggle the is_home status
        $category->is_home = $category->is_home ? 0 : 1;
        $category->save();

        return response()->json([
            'type' => 'success',
            'message' => 'Home Status Updated'
        ]);
    }
}