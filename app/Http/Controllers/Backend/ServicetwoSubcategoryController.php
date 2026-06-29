<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ServicetwoCategory;
use App\Models\ServicetwoSubcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServicetwoSubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subcategories = ServicetwoSubcategory::with('category')->latest('id')->paginate(30);
        $categories = ServicetwoCategory::get();
        return view('backend.pages.servicetwosubcategories.index', compact('subcategories', 'categories'));
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
        // dd($request->all());
        // Validate the request
        $request->validate([
            'category_id' => 'required|exists:servicetwocategories,id',
            'name' => 'required|unique:servicetwosubcategories,name',
        ]);

        ServicetwoSubcategory::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
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
    public function edit(string $id)
    {
        $subcategory = ServicetwoSubcategory::findOrFail($id);
        $categories = ServicetwoCategory::get();
        return view('backend.pages.servicetwosubcategories.edit', compact('subcategory', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $subcategory = ServicetwoSubcategory::findOrFail($id);

        $request->validate([
            'category_id' => 'required|exists:servicetwocategories,id',
            'name'        => 'required|unique:servicetwosubcategories,name,' . $id,
        ]);

        $subcategory->update([
            'category_id' => $request->category_id,
            'name'        => $request->name,
            'slug'        => Str::slug($request->name),
        ]);

        return redirect()->route('servicetwosubcategories.index')->with('message', 'Subcategory Updated Successfully 🙂');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        ServicetwoSubcategory::findOrFail($id)->delete();
        return redirect()->back()->with('warning', 'Subcategory Deleted Successfully');
    }

    /**
     * Return subcategories for a given category (AJAX).
     */
    public function getSubcategories($category_id)
    {
        $subcategories = ServicetwoSubcategory::where('category_id', $category_id)
            ->orderBy('name')
            ->get(['id', 'name']);
        return response()->json($subcategories);
    }

    public function checkActive($subcategory_id)
    {
        $subcategory = ServicetwoSubcategory::find($subcategory_id);
        if (!$subcategory) {
            return response()->json([
                'type'    => 'error',
                'message' => 'Subcategory not found'
            ], 404);
        }

        $subcategory->is_active = $subcategory->is_active ? 0 : 1;
        $subcategory->save();

        return response()->json([
            'type'    => 'success',
            'message' => 'Status Updated Successfully'
        ]);
    }
}
