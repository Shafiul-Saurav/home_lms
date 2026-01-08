<?php

namespace App\Http\Controllers\Backend;

use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Gate;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('index-product');

        $products = Product::with('category', 'subcategory', 'childcategory')->whereNull('deleted_at')->latest('id')->paginate(100);
        $categories = Category::where('is_active', 1)->get();
        return view('backend.pages.product.product', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create-product');

        $categories = Category::where('is_active', 1)->get();
        return view('backend.pages.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('create-product');

        // Validation
        $request->validate([
            'name' => 'required|string|unique:products|max:255',
            'slug' => 'nullable|string|unique:products|max:255',
            'description' => 'nullable|string',
            'short_description' => 'nullable|string',
            'long_description' => 'nullable|string',
            'additional_info' => 'nullable|string',
            'type' => 'nullable|string|in:normal,variable',
            'category_id' => 'nullable|exists:categories,id',
            'subcategory_id' => 'nullable|exists:subcategories,id',
            'childcategory_id' => 'nullable|exists:childcategories,id',
            'purchase_price' => 'required|numeric|min:0',
            'sell_price' => 'required|numeric|min:0',
            'product_quantity' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:2048',
            'video' => 'nullable|file|mimes:mp4,mov,avi,wmv,flv|max:27648', // 27MB limit
            'multiple_image' => 'nullable',
            'multiple_image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:2048',
            'color' => 'nullable|string|max:50',
            'size' => 'nullable|string|max:50',
            'discount_type' => 'nullable|string|in:percentage,fixed',
            'discount_amount' => 'nullable|numeric|min:0',
            'is_stock' => 'required|boolean',
            'is_home' => 'nullable|boolean',
        ], [
            'type.in' => 'The product type must be either normal or variable.',
            'discount_type.in' => 'The discount type must be either percentage or fixed.',
        ]);

        $product = Product::create([
            'name' => $request->name,
            'slug' => $request->slug ?? Str::slug($request->name),
            'description' => $request->description,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
            'additional_info' => $request->additional_info,
            'type' => $request->type,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'childcategory_id' => $request->childcategory_id,
            'purchase_price' => $request->purchase_price,
            'sell_price' => $request->sell_price,
            'product_quantity' => $request->product_quantity,
            'color' => $request->type === 'variable' ? $request->color : null,
            'size' => $request->type === 'variable' ? $request->size : null,
            'discount_type' => $request->discount_type,
            'discount_amount' => $request->discount_amount,
            'is_stock' => $request->is_stock,
            'is_home' => $request->is_home ?? 0,
            'is_active' => 1, // Default to active
        ]);

        $this->image_upload($request, $product->id);
        $this->video_upload($request, $product->id);
        $this->multiple_image_upload($request, $product->id);

        return redirect()->back()->with('message', 'Product Created Successfully 🙂');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::with('category', 'subcategory', 'childcategory', 'productImages')->findOrFail($id);
        return view('backend.pages.product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        Gate::authorize('edit-product');

        $product = Product::findOrFail($id);
        $categories = Category::where('is_active', 1)->get();

        // Get subcategories based on selected category
        $subcategories = [];
        if($product->category_id) {
            $subcategories = \App\Models\Subcategory::where('category_id', $product->category_id)->where('is_active', 1)->get();
        }

        // Get childcategories based on selected subcategory
        $childcategories = [];
        if($product->subcategory_id) {
            $childcategories = \App\Models\Childcategory::where('subcategory_id', $product->subcategory_id)->where('is_active', 1)->get();
        }

        return view('backend.pages.product.edit', compact('product', 'categories', 'subcategories', 'childcategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Gate::authorize('edit-product');

        // Validation
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:products,slug,' . $id,
            'description' => 'nullable|string',
            'short_description' => 'nullable|string',
            'long_description' => 'nullable|string',
            'additional_info' => 'nullable|string',
            'type' => 'nullable|string|in:normal,variable',
            'category_id' => 'nullable|exists:categories,id',
            'subcategory_id' => 'nullable|exists:subcategories,id',
            'childcategory_id' => 'nullable|exists:childcategories,id',
            'purchase_price' => 'required|numeric|min:0',
            'sell_price' => 'required|numeric|min:0',
            'product_quantity' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:2048',
            'video' => 'nullable|file|mimes:mp4,mov,avi,wmv,flv|max:27648', // 27MB limit
            'multiple_image' => 'nullable',
            'multiple_image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:2048',
            'color' => 'nullable|string|max:50',
            'size' => 'nullable|string|max:50',
            'discount_type' => 'nullable|string|in:percentage,fixed',
            'discount_amount' => 'nullable|numeric|min:0',
            'is_stock' => 'required|boolean',
            'is_home' => 'nullable|boolean',
        ], [
            'type.in' => 'The product type must be either normal or variable.',
            'discount_type.in' => 'The discount type must be either percentage or fixed.',
        ]);

        $product = Product::findOrFail($id);

        $product->update([
            'name' => $request->name,
            'slug' => $request->slug ?? Str::slug($request->name),
            'description' => $request->description,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
            'additional_info' => $request->additional_info,
            'type' => $request->type,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'childcategory_id' => $request->childcategory_id,
            'purchase_price' => $request->purchase_price,
            'sell_price' => $request->sell_price,
            'product_quantity' => $request->product_quantity,
            'color' => $request->type === 'variable' ? $request->color : null,
            'size' => $request->type === 'variable' ? $request->size : null,
            'discount_type' => $request->discount_type,
            'discount_amount' => $request->discount_amount,
            'is_stock' => $request->is_stock,
            'is_home' => $request->is_home ?? 0,
        ]);

        $this->image_upload($request, $product->id);
        $this->video_upload($request, $product->id);
        $this->multiple_image_upload($request, $product->id);

        return redirect()->route('products.index')->with('message', 'Product Updated Successfully 🙂');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Gate::authorize('delete-product');

        $product = Product::findOrFail($id);

        // Soft delete the product record (don't delete files yet)
        $product->delete();

        return redirect()->back()->with('error', 'Product moved to trash successfully');
    }

    /**
     * Store/Update the main Image file.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function image_upload($request, $product_id)
    {
        $product = Product::findOrFail($product_id);

        if ($request->hasFile('image')) {
            if ($product->image && $product->image != 'default_product.jpg') {
                //delete old photo
                $photo_location = public_path('uploads/products/' . $product->image);
                if (file_exists($photo_location)) {
                    unlink($photo_location);
                }
            }

            $photo_location = public_path('uploads/products/');
            $uploaded_photo = $request->file('image');
            $new_photo_name = $product->id . '.' . $uploaded_photo->getClientOriginalExtension();

            // Create directory if it doesn't exist
            if (!file_exists($photo_location)) {
                mkdir($photo_location, 0755, true);
            }

            $new_photo_location = $photo_location . $new_photo_name;

            // Handle WebP format properly
            if ($uploaded_photo->getClientOriginalExtension() == 'webp') {
                Image::make($uploaded_photo)->resize(800, 800)->save($new_photo_location);
            } else {
                Image::make($uploaded_photo)->resize(800, 800)->save($new_photo_location, 80);
            }

            $product->update([
                'image' => $new_photo_name,
            ]);
        }
    }

    /**
     * Store/Update the video file.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $product_id
     * @return void
     */
    public function video_upload($request, $product_id)
    {
        $product = Product::findOrFail($product_id);

        if ($request->hasFile('video')) {
            // Delete old video if exists
            if ($product->video) {
                $video_location = public_path('uploads/products/' . $product->video);
                if (file_exists($video_location)) {
                    unlink($video_location);
                }
            }

            $video_location = public_path('uploads/products/');
            $uploaded_video = $request->file('video');
            $new_video_name = $product->id . '_video.' . $uploaded_video->getClientOriginalExtension();

            // Create directory if it doesn't exist
            if (!file_exists($video_location)) {
                mkdir($video_location, 0755, true);
            }

            // Move the uploaded video to the products directory
            $uploaded_video->move($video_location, $new_video_name);

            $product->update([
                'video' => $new_video_name,
            ]);
        }
    }

    /**
     * Store multiple images for the product.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $product_id
     * @return void
     */
    protected function multiple_image_upload($request, $product_id)
    {
        $product = Product::findOrFail($product_id);

        if ($request->hasFile('multiple_image')) {
            foreach ($request->file('multiple_image') as $uploaded_photo) {
                if ($uploaded_photo->isValid()) {
                    // Handle each multiple image upload
                    $photo_location = public_path('uploads/products/');
                    $new_photo_name = $product->id . '_' . time() . '_' . uniqid() . '.' . $uploaded_photo->getClientOriginalExtension();

                    // Create directory if it doesn't exist
                    if (!file_exists($photo_location)) {
                        mkdir($photo_location, 0755, true);
                    }

                    $new_photo_location = $photo_location . $new_photo_name;

                    // Resize and save the image
                    // Handle WebP format properly
                    if ($uploaded_photo->getClientOriginalExtension() == 'webp') {
                        Image::make($uploaded_photo)->resize(800, 800)->save($new_photo_location);
                    } else {
                        Image::make($uploaded_photo)->resize(800, 800)->save($new_photo_location, 80);
                    }

                    // Save image to ProductImage model
                    $product->productImages()->create([
                        'multiple_image' => $new_photo_name,
                    ]);
                } else {
                    Log::warning('Invalid image file: ' . $uploaded_photo->getClientOriginalName());
                }
            }
        }
    }

    /**
     * Delete a single multiple image.
     */
    public function deleteProductImage($id)
    {
        $productImage = ProductImage::findOrFail($id);

        // Delete the image file from the public directory if it exists
        $imagePath = public_path('uploads/products/' . $productImage->multiple_image);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        // Delete the record from the database
        $productImage->delete();

        return response()->json(['success' => 'Image deleted successfully.']);
    }

    /**
     * Get subcategories by category ID for dependent dropdown
     */
    public function getSubcategories($categoryId)
    {
        $subcategories = \App\Models\Subcategory::where('category_id', $categoryId)
            ->where('is_active', 1)
            ->select('id', 'name')
            ->get();

        return response()->json($subcategories);
    }

    /**
     * Get childcategories by subcategory ID for dependent dropdown
     */
    public function getChildcategories($subcategoryId)
    {
        $childcategories = \App\Models\Childcategory::where('subcategory_id', $subcategoryId)
            ->where('is_active', 1)
            ->select('id', 'name')
            ->get();

        return response()->json($childcategories);
    }

    /**
     * Toggle product active status.
     */
    public function checkActiveActive($product_id)
    {
        $product = Product::find($product_id);
        if (!$product) {
            return response()->json([
                'type' => 'error',
                'message' => 'Product not found'
            ], 404);
        }

        // Toggle the is_active status
        $product->is_active = $product->is_active ? 0 : 1;
        $product->save();

        return response()->json([
            'type' => 'success',
            'message' => 'Status Updated Successfully'
        ]);
    }
}
