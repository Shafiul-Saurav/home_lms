<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Childcategory;
use App\Models\Category;
use App\Models\Subcategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class ChildcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('index-course-category');

        $childcategories = Childcategory::with(['category', 'subcategory'])->latest('id')->paginate(30);
        $categories = Category::all();
        return view('backend.pages.childcategory.childcategory', compact('childcategories', 'categories'));
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

        // Handle file upload if present
        $fileName = null;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/childcategories'), $fileName);
        }

        Childcategory::create([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'name' => $request->name,
            'slug' => preg_replace('/\s+/u', '-', trim($request->name)),
            'file' => $fileName,
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]);

        return redirect()->back()->with('message', 'Childcategory Created Successfully 🙂');
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

        $childcategory = Childcategory::with(['category', 'subcategory'])->where('slug', $slug)->first();
        $categories = Category::all();
        $subcategories_by_category = Subcategory::where('category_id', $childcategory->category_id)->get();
        return view('backend.pages.childcategory.edit', compact('childcategory', 'categories', 'subcategories_by_category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $slug)
    {
        Gate::authorize('edit-course-category');

        $childcategory = Childcategory::where('slug', $slug)->first();

        // Handle file upload if present
        $fileName = $childcategory->file;
        if ($request->hasFile('file')) {
            // Delete old file if exists
            if ($childcategory->file && file_exists(public_path('uploads/childcategories/' . $childcategory->file))) {
                unlink(public_path('uploads/childcategories/' . $childcategory->file));
            }

            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/childcategories'), $fileName);
        }

        $childcategory->update([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'name' => $request->name,
            'slug' => preg_replace('/\s+/u', '-', trim($request->name)),
            'file' => $fileName,
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]);

        return redirect()->route('childcategories.index')->with('message', 'Childcategory Updated Successfully 🙂');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug)
    {
        Gate::authorize('delete-course-category');

        $childcategory = Childcategory::where('slug', $slug)->first();
        $childcategory->delete();

        return redirect()->back()->with('warning', 'Childcategory Moved to Trash Successfully');
    }

    public function checkActive($childcategory_id)
    {
        $childcategory = Childcategory::find($childcategory_id);
        if (!$childcategory) {
            return response()->json([
                'type' => 'error',
                'message' => 'Childcategory not found'
            ], 404);
        }

        // Toggle the is_active status
        $childcategory->is_active = $childcategory->is_active ? 0 : 1;
        $childcategory->save();

        return response()->json([
            'type' => 'success',
            'message' => 'Status Updated'
        ]);
    }

    public function checkHome($childcategory_id)
    {
        $childcategory = Childcategory::find($childcategory_id);
        if (!$childcategory) {
            return response()->json([
                'type' => 'error',
                'message' => 'Childcategory not found'
            ], 404);
        }

        // Toggle the is_home status
        $childcategory->is_home = $childcategory->is_home ? 0 : 1;
        $childcategory->save();

        return response()->json([
            'type' => 'success',
            'message' => 'Home Status Updated'
        ]);
    }

    public function getChildcategories($subcategory_id)
    {
        $childcategories = Childcategory::select(['id', 'name'])->where('subcategory_id', $subcategory_id)->get();
        return response()->json($childcategories);
    }
}
