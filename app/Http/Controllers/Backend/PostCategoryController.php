<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Postcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PostCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('index-post-category');
        
        $categories = Postcategory::latest('id')->paginate('50');
        return view('backend.pages.postcategory.postcategory', compact('categories'));
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
        Gate::authorize('create-post-category');
        
        // dd($request->all());
        Postcategory::create([
            'title' => $request->title,
        ]);

        return redirect()->back()->with('message', 'Post Category Created Successfully 🙂');
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
    public function edit(string $id)
    {
        Gate::authorize('edit-post-category');
        
        $category = Postcategory::findOrFail($id);

        return view('backend.pages.postcategory.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Gate::authorize('edit-post-category');
        
        // dd($request->all());
        $category = Postcategory::findOrFail($id);

        $category->update([
            'title' => $request->title,
        ]);
        return redirect()->back()->with('message', 'Post Category Updated Successfully 🙂');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Gate::authorize('delete-post-category');
        
        $category = Postcategory::findOrFail($id);

        $category->delete();
        return redirect()->back()->with('warning', 'Post Category Moved to Trash Successfully');
    }

    public function checkActiveActive($category_id)
    {
        $category = Postcategory::find($category_id);
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
        $category = Postcategory::find($category_id);
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
