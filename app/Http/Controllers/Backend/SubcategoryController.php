<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Models\Subcategory;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('index-course-subcategory');

        $subcategories = Subcategory::with('category')->latest('id')->paginate(30);
        $categories = Category::get();
        return view('backend.pages.subcategory.subcategory', compact('subcategories', 'categories'));
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

        // Validate the request
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|unique:subcategories,name',
        ]);

        // Handle file upload if present
        $fileName = null;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/subcategories'), $fileName);
        }

        Subcategory::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => preg_replace('/\s+/u', '-', trim($request->name)),
            'file' => $fileName,
        ]);

        return redirect()->back()->with('message', 'Subcategory Created Successfully 🙂');
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

        $subcategory = Subcategory::with('category')->where('slug', $slug)->first();
        $categories = Category::where('is_active', 1)->get(); // Only active categories
        return view('backend.pages.subcategory.edit', compact('subcategory', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $slug)
    {
        Gate::authorize('edit-course-subcategory');

        $subcategory = Subcategory::where('slug', $slug)->first();

        // Validate the request
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|unique:subcategories,name,'.$subcategory->id,
        ]);

        // Handle file upload if present
        $fileName = $subcategory->file;
        if ($request->hasFile('file')) {
            // Delete old file if exists
            if ($subcategory->file && file_exists(public_path('uploads/subcategories/' . $subcategory->file))) {
                unlink(public_path('uploads/subcategories/' . $subcategory->file));
            }

            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/subcategories'), $fileName);
        }

        $subcategory->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => preg_replace('/\s+/u', '-', trim($request->name)),
            'file' => $fileName,
        ]);

        return redirect()->route('subcategories.index')->with('message', 'Subcategory Updated Successfully 🙂');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug)
    {
        Gate::authorize('delete-course-subcategory');

        $subcategory = Subcategory::where('slug', $slug)->first();
        $subcategory->delete();

        return redirect()->back()->with('warning', 'Subcategory Moved to Trash Successfully');
    }

    public function checkActive($subcategory_id)
    {
        $subcategory = Subcategory::find($subcategory_id);
        if (!$subcategory) {
            return response()->json([
                'type' => 'error',
                'message' => 'Subcategory not found'
            ], 404);
        }

        // Toggle the is_active status
        $subcategory->is_active = $subcategory->is_active ? 0 : 1;
        $subcategory->save();

        return response()->json([
            'type' => 'success',
            'message' => 'Status Updated'
        ]);
    }

    public function checkHome($subcategory_id)
    {
        $subcategory = Subcategory::find($subcategory_id);
        if (!$subcategory) {
            return response()->json([
                'type' => 'error',
                'message' => 'Subcategory not found'
            ], 404);
        }

        // Toggle the is_home status
        $subcategory->is_home = $subcategory->is_home ? 0 : 1;
        $subcategory->save();

        return response()->json([
            'type' => 'success',
            'message' => 'Status Updated'
        ]);
    }

    public function getSubcategoriesByCategory($category_id)
    {
        $subcategories = Subcategory::select(['id', 'name'])->where('category_id', $category_id)->get();
        return response()->json($subcategories);
    }
}

