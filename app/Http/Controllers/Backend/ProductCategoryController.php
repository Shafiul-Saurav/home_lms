<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('index-course-category');

        $categories = ProductCategory::latest('id')->paginate(30);

        return view('backend.pages.productcategory.category', compact('categories'));
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
        Gate::authorize('create-course-category');

        $request->validate([
            'name' => 'required|unique:product_categories,name',
        ]);

        $fileName = null;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/product_categories'), $fileName);
        }

        ProductCategory::create([
            'name' => $request->name,
            'slug' => preg_replace('/\s+/u', '-', trim($request->name)),
            'file' => $fileName,
        ]);

        return redirect()->back()->with('message', 'Product Category Created Successfully 🙂');
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
        Gate::authorize('edit-course-category');

        $category = ProductCategory::where('slug', $slug)->firstOrFail();

        return view('backend.pages.productcategory.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $slug)
    {
        Gate::authorize('edit-course-category');

        $category = ProductCategory::where('slug', $slug)->firstOrFail();

        $request->validate([
            'name' => 'required|unique:product_categories,name,' . $category->id,
        ]);

        $fileName = $category->file;
        if ($request->hasFile('file')) {
            if ($category->file && file_exists(public_path('uploads/product_categories/' . $category->file))) {
                unlink(public_path('uploads/product_categories/' . $category->file));
            }

            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/product_categories'), $fileName);
        }

        $category->update([
            'name' => $request->name,
            'slug' => preg_replace('/\s+/u', '-', trim($request->name)),
            'file' => $fileName,
        ]);

        return redirect()->route('product_categories.index')->with('message', 'Product Category Updated Successfully 🙂');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug)
    {
        Gate::authorize('delete-course-category');

        $category = ProductCategory::where('slug', $slug)->firstOrFail();
        $category->delete();

        return redirect()->back()->with('warning', 'Product Category Deleted Successfully');
    }

    public function checkActive($category_id)
    {
        $category = ProductCategory::find($category_id);
        if (! $category) {
            return response()->json([
                'type' => 'error',
                'message' => 'Product Category not found',
            ], 404);
        }

        $category->is_active = $category->is_active ? 0 : 1;
        $category->save();

        return response()->json([
            'type' => 'success',
            'message' => 'Status Updated',
        ]);
    }

    public function checkHome($category_id)
    {
        $category = ProductCategory::find($category_id);
        if (! $category) {
            return response()->json([
                'type' => 'error',
                'message' => 'Product Category not found',
            ], 404);
        }

        $category->is_home = $category->is_home ? 0 : 1;
        $category->save();

        return response()->json([
            'type' => 'success',
            'message' => 'Home Status Updated',
        ]);
    }
}
