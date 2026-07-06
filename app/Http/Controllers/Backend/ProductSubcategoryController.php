<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use App\Models\ProductSubcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ProductSubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('index-course-subcategory');

        $subcategories = ProductSubcategory::with('category')->latest('id')->paginate(30);
        $categories = ProductCategory::get();

        return view('backend.pages.productsubcategory.subcategory', compact('subcategories', 'categories'));
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
        Gate::authorize('create-course-subcategory');

        $request->validate([
            'product_category_id' => 'required|exists:product_categories,id',
            'name' => 'required|unique:product_subcategories,name',
        ]);

        $fileName = null;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/product_subcategories'), $fileName);
        }

        ProductSubcategory::create([
            'product_category_id' => $request->product_category_id,
            'name' => $request->name,
            'slug' => preg_replace('/\s+/u', '-', trim($request->name)),
            'file' => $fileName,
        ]);

        return redirect()->back()->with('message', 'Product Subcategory Created Successfully 🙂');
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
        Gate::authorize('edit-course-subcategory');

        $subcategory = ProductSubcategory::with('category')->where('slug', $slug)->firstOrFail();
        $categories = ProductCategory::where('is_active', 1)->get();

        return view('backend.pages.productsubcategory.edit', compact('subcategory', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $slug)
    {
        Gate::authorize('edit-course-subcategory');

        $subcategory = ProductSubcategory::where('slug', $slug)->firstOrFail();

        $request->validate([
            'product_category_id' => 'required|exists:product_categories,id',
            'name' => 'required|unique:product_subcategories,name,' . $subcategory->id,
        ]);

        $fileName = $subcategory->file;
        if ($request->hasFile('file')) {
            if ($subcategory->file && file_exists(public_path('uploads/product_subcategories/' . $subcategory->file))) {
                unlink(public_path('uploads/product_subcategories/' . $subcategory->file));
            }

            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/product_subcategories'), $fileName);
        }

        $subcategory->update([
            'product_category_id' => $request->product_category_id,
            'name' => $request->name,
            'slug' => preg_replace('/\s+/u', '-', trim($request->name)),
            'file' => $fileName,
        ]);

        return redirect()->route('product_subcategories.index')->with('message', 'Product Subcategory Updated Successfully 🙂');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug)
    {
        Gate::authorize('delete-course-subcategory');

        $subcategory = ProductSubcategory::where('slug', $slug)->firstOrFail();
        $subcategory->delete();

        return redirect()->back()->with('warning', 'Product Subcategory Deleted Successfully');
    }

    public function checkActive($subcategory_id)
    {
        $subcategory = ProductSubcategory::find($subcategory_id);
        if (! $subcategory) {
            return response()->json([
                'type' => 'error',
                'message' => 'Product Subcategory not found',
            ], 404);
        }

        $subcategory->is_active = $subcategory->is_active ? 0 : 1;
        $subcategory->save();

        return response()->json([
            'type' => 'success',
            'message' => 'Status Updated',
        ]);
    }

    public function checkHome($subcategory_id)
    {
        $subcategory = ProductSubcategory::find($subcategory_id);
        if (! $subcategory) {
            return response()->json([
                'type' => 'error',
                'message' => 'Product Subcategory not found',
            ], 404);
        }

        $subcategory->is_home = $subcategory->is_home ? 0 : 1;
        $subcategory->save();

        return response()->json([
            'type' => 'success',
            'message' => 'Status Updated',
        ]);
    }
}
