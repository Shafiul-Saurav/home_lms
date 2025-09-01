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

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category')->latest('id')->paginate(100);
        $categories = Category::where('is_active', 1)->get();
        return view('backend.pages.product.product', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('is_active', 1)->get();
        return view('backend.pages.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'nullable|string|in:normal,variable',
            'category_id' => 'nullable|exists:categories,id',
            'purchase_price' => 'required|numeric|min:0',
            'sell_price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'multiple_image' => 'nullable',
            'multiple_image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'color' => 'nullable|string|max:50',
            'size' => 'nullable|string|max:50',
            'discount_type' => 'nullable|string|in:percentage,fixed',
            'discount_amount' => 'nullable|numeric|min:0',
            'is_stock' => 'required|boolean',
        ], [
            'type.in' => 'The product type must be either normal or variable.',
            'discount_type.in' => 'The discount type must be either percentage or fixed.',
        ]);

        $product = Product::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'type' => $request->type,
            'category_id' => $request->category_id,
            'purchase_price' => $request->purchase_price,
            'sell_price' => $request->sell_price,
            'color' => $request->type === 'variable' ? $request->color : null,
            'size' => $request->type === 'variable' ? $request->size : null,
            'discount_type' => $request->discount_type,
            'discount_amount' => $request->discount_amount,
            'is_stock' => $request->is_stock,
            'is_active' => 1, // Default to active
        ]);

        $this->image_upload($request, $product->id);
        $this->multiple_image_upload($request, $product->id);

        return redirect()->back()->with('message', 'Product Created Successfully 🙂');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::with('category', 'productImages')->findOrFail($id);
        return view('backend.pages.product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::where('is_active', 1)->get();
        return view('backend.pages.product.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validation
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'nullable|string|in:normal,variable',
            'category_id' => 'nullable|exists:categories,id',
            'purchase_price' => 'required|numeric|min:0',
            'sell_price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'multiple_image' => 'nullable',
            'multiple_image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'color' => 'nullable|string|max:50',
            'size' => 'nullable|string|max:50',
            'discount_type' => 'nullable|string|in:percentage,fixed',
            'discount_amount' => 'nullable|numeric|min:0',
            'is_stock' => 'required|boolean',
        ], [
            'type.in' => 'The product type must be either normal or variable.',
            'discount_type.in' => 'The discount type must be either percentage or fixed.',
        ]);

        $product = Product::findOrFail($id);

        $product->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'type' => $request->type,
            'category_id' => $request->category_id,
            'purchase_price' => $request->purchase_price,
            'sell_price' => $request->sell_price,
            'color' => $request->type === 'variable' ? $request->color : null,
            'size' => $request->type === 'variable' ? $request->size : null,
            'discount_type' => $request->discount_type,
            'discount_amount' => $request->discount_amount,
            'is_stock' => $request->is_stock,
        ]);

        $this->image_upload($request, $product->id);
        $this->multiple_image_upload($request, $product->id);

        return redirect()->route('products.index')->with('message', 'Product Updated Successfully 🙂');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);

        // Delete main product image if it exists and is not the default
        if ($product->image && $product->image != 'default_product.jpg') {
            $photo_location = public_path('uploads/products/' . $product->image);
            if (file_exists($photo_location)) {
                unlink($photo_location);
            }
        }

        // Delete multiple product images and their associated files
        foreach ($product->productImages as $productImage) {
            $image_path = public_path('uploads/products/' . $productImage->multiple_image);
            if (file_exists($image_path)) {
                unlink($image_path);
                Log::info('Product image deleted: ' . $image_path);
            } else {
                Log::warning('Product image not found or could not delete: ' . $image_path);
            }
            $productImage->delete();
        }

        // Delete the product record
        $product->delete();

        return redirect()->back()->with('error', 'Product deleted successfully');
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
            Image::make($uploaded_photo)->resize(380, 400)->save($new_photo_location, 80);

            $product->update([
                'image' => $new_photo_name,
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
                    Image::make($uploaded_photo)->resize(760, 400)->save($new_photo_location, 80);

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
