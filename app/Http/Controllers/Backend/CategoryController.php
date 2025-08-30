<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::latest('id')->paginate('50');
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
        // Validation
        $request->validate([
            'name' => 'required|string|max:255',
            'file' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $category = Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'is_active' => 0, // Default to inactive
        ]);

        $this->image_upload($request, $category->id);

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
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);

        return view('backend.pages.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validation
        $request->validate([
            'name' => 'required|string|max:255',
            'file' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $category = Category::findOrFail($id);

        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        $this->image_upload($request, $category->id);

        return redirect()->back()->with('message', 'Category Updated Successfully 🙂');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);

        // Delete file if exists
        // if ($category->file && file_exists(public_path('uploads/categories/' . $category->file))) {
        //     unlink(public_path('uploads/categories/' . $category->file));
        // }

        $category->delete();
        return redirect()->back()->with('warning', 'Category Deleted Successfully');
    }

    /**
     * Store/Update the Image file.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function image_upload($request, $category_id)
    {
        $category = Category::findOrFail($category_id);

        if ($request->hasFile('file')) {
            if ($category->file && $category->file != 'default_category_image.jpg') {
                //delete old photo
                $photo_location = 'uploads/categories/';
                $old_photo_location = $photo_location . $category->file;
                if (file_exists(public_path($old_photo_location))) {
                    unlink(public_path($old_photo_location));
                }
            }

            $photo_location = 'uploads/categories/';
            $uploaded_photo = $request->file('file');
            $new_photo_name = $category->id . '.' . $uploaded_photo->getClientOriginalExtension();
            $new_photo_location = $photo_location . $new_photo_name;

            // Create directory if it doesn't exist
            if (!file_exists(public_path($photo_location))) {
                mkdir(public_path($photo_location), 0755, true);
            }

            Image::make($uploaded_photo)->resize(300, 300)->save(public_path($new_photo_location), 80);

            $category->update([
                'file' => $new_photo_name,
            ]);
        }
    }

    public function checkActiveActive($category_id)
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
}
