<?php

namespace App\Http\Controllers\Backend;

use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Childcategory;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('index-product');

        $products = Product::with(['category', 'subcategory', 'childcategory'])->whereNull('deleted_at')->latest('id')->paginate(100);
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
        $subcategories = Subcategory::where('is_active', 1)->get();
        $childcategories = Childcategory::where('is_active', 1)->get();
        return view('backend.pages.product.create', compact('categories', 'subcategories', 'childcategories'));
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
            'type' => 'nullable|string|in:normal,variable',
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'nullable|exists:subcategories,id',
            'childcategory_id' => 'nullable|exists:childcategories,id',
            'purchase_price' => 'required|numeric|min:0',
            'sell_price' => 'required|numeric|min:0',
            'product_price' => 'required|numeric|min:0',
            'product_discount' => 'nullable|numeric|min:0',
            'product_quantity' => 'required|string|max:255',
            'color' => 'nullable|string|max:50',
            'size' => 'nullable|string|max:50',
            'discount_type' => 'nullable|string|in:percentage,fixed',
            'discount_amount' => 'nullable|numeric|min:0',
            'is_stock' => 'required|boolean',
            'is_active' => 'required|boolean',
            'is_home' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:2048',
            'product_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:2048',
            'multiple_image' => 'nullable',
            'multiple_image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:2048',
        ], [
            'type.in' => 'The product type must be either normal or variable.',
            'discount_type.in' => 'The discount type must be either percentage or fixed.',
        ]);

        $product = Product::create([
            'name' => $request->name,
            'slug' => $request->slug ?? Str::slug($request->name),
            'description' => $request->description,
            'type' => $request->type,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'childcategory_id' => $request->childcategory_id,
            'purchase_price' => $request->purchase_price,
            'sell_price' => $request->sell_price,
            'product_price' => $request->product_price,
            'product_discount' => $request->product_discount,
            'product_quantity' => $request->product_quantity,
            'color' => $request->type === 'variable' ? $request->color : null,
            'size' => $request->type === 'variable' ? $request->size : null,
            'discount_type' => $request->discount_type,
            'discount_amount' => $request->discount_amount,
            'is_stock' => $request->is_stock,
            'is_active' => $request->is_active,
            'is_home' => $request->is_home,
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
        $product = Product::with(['category', 'subcategory', 'childcategory', 'productImages'])->findOrFail($id);
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
        $subcategories = Subcategory::where('category_id', $product->category_id)->where('is_active', 1)->get();
        $childcategories = Childcategory::where('subcategory_id', $product->subcategory_id)->where('is_active', 1)->get();
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
            'type' => 'nullable|string|in:normal,variable',
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'nullable|exists:subcategories,id',
            'childcategory_id' => 'nullable|exists:childcategories,id',
            'purchase_price' => 'required|numeric|min:0',
            'sell_price' => 'required|numeric|min:0',
            'product_price' => 'required|numeric|min:0',
            'product_discount' => 'nullable|numeric|min:0',
            'product_quantity' => 'required|string|max:255',
            'color' => 'nullable|string|max:50',
            'size' => 'nullable|string|max:50',
            'discount_type' => 'nullable|string|in:percentage,fixed',
            'discount_amount' => 'nullable|numeric|min:0',
            'is_stock' => 'required|boolean',
            'is_active' => 'required|boolean',
            'is_home' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:2048',
            'product_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:2048',
            'multiple_image' => 'nullable',
            'multiple_image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:2048',
        ], [
            'type.in' => 'The product type must be either normal or variable.',
            'discount_type.in' => 'The discount type must be either percentage or fixed.',
        ]);

        $product = Product::findOrFail($id);

        $product->update([
            'name' => $request->name,
            'slug' => $request->slug ?? Str::slug($request->name),
            'description' => $request->description,
            'type' => $request->type,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'childcategory_id' => $request->childcategory_id,
            'purchase_price' => $request->purchase_price,
            'sell_price' => $request->sell_price,
            'product_price' => $request->product_price,
            'product_discount' => $request->product_discount,
            'product_quantity' => $request->product_quantity,
            'color' => $request->type === 'variable' ? $request->color : null,
            'size' => $request->type === 'variable' ? $request->size : null,
            'discount_type' => $request->discount_type,
            'discount_amount' => $request->discount_amount,
            'is_stock' => $request->is_stock,
            'is_active' => $request->is_active,
            'is_home' => $request->is_home,
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
        Gate::authorize('delete-product');

        $product = Product::findOrFail($id);

        // Soft delete the product record
        $product->delete();

        return redirect()->back()->with('error', 'Product moved to trash successfully');
    }

    /**
     * Restore the specified resource from trash.
     */
    public function restore($id)
    {
        Gate::authorize('delete-product');

        $product = Product::withTrashed()->findOrFail($id);
        $product->restore();

        return redirect()->back()->with('info', 'Product Restored Successfully 🙂');
    }

    /**
     * Force delete the specified resource from storage.
     */
    public function forceDelete(string $id)
    {
        Gate::authorize('delete-product');

        $product = Product::withTrashed()->findOrFail($id);

        // Delete product images if they exist
        if ($product->productImages) {
            foreach ($product->productImages as $image) {
                if ($image->multiple_image && Storage::disk('public')->exists('uploads/products/' . $image->multiple_image)) {
                    Storage::disk('public')->delete('uploads/products/' . $image->multiple_image);
                }
                $image->delete();
            }
        }

        // Delete main images if they exist
        if ($product->image && Storage::disk('public')->exists('uploads/products/' . $product->image)) {
            Storage::disk('public')->delete('uploads/products/' . $product->image);
        }
        
        if ($product->product_image && $product->product_image !== 'default_product.webp' && Storage::disk('public')->exists('uploads/products/' . $product->product_image)) {
            Storage::disk('public')->delete('uploads/products/' . $product->product_image);
        }

        $product->forceDelete();

        return redirect()->back()->with('error', 'Product Deleted Permanently');
    }

    /**
     * Display trashed products.
     */
    public function trash()
    {
        Gate::authorize('delete-product');

        $products = Product::with(['category', 'subcategory', 'childcategory'])->onlyTrashed()->latest('id')->paginate(100);
        return view('backend.pages.product.trash', compact('products'));
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

            $uploaded_photo = $request->file('image');
            $new_photo_name = $product->id . '_main_' . time() . '.' . $uploaded_photo->getClientOriginalExtension();
            $new_photo_location = public_path('uploads/products/' . $new_photo_name);
            Image::make($uploaded_photo)->resize(800, 800)->save($new_photo_location);
            $product->update([
                'image' => $new_photo_name,
            ]);
        }

        if ($request->hasFile('product_image')) {
            if ($product->product_image && $product->product_image != 'default_product.webp') {
                //delete old photo
                $photo_location = public_path('uploads/products/' . $product->product_image);
                if (file_exists($photo_location)) {
                    unlink($photo_location);
                }
            }

            $uploaded_photo = $request->file('product_image');
            $new_photo_name = $product->id . '_product_' . time() . '.' . $uploaded_photo->getClientOriginalExtension();
            $new_photo_location = public_path('uploads/products/' . $new_photo_name);
            Image::make($uploaded_photo)->resize(800, 800)->save($new_photo_location);
            $product->update([
                'product_image' => $new_photo_name,
            ]);
        }
    }

    /**
     * Store/Update the Multiple Image file.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function multiple_image_upload($request, $product_id)
    {
        if ($request->hasFile('multiple_image')) {
            // delete old photos first
            $multiple_images = ProductImage::where('product_id', $product_id)->get();
            foreach ($multiple_images as $multiple_image) {
                if ($multiple_image->multiple_image && Storage::disk('public')->exists('uploads/products/' . $multiple_image->multiple_image)) {
                    Storage::disk('public')->delete('uploads/products/' . $multiple_image->multiple_image);
                }
                // delete old value of db table
                $multiple_image->delete();
            }

            $flag = 1; // Assign a flag variable

            foreach ($request->file('multiple_image') as $single_photo) {
                $new_photo_name = $product_id . '-multiple-' . $flag . '.' . $single_photo->getClientOriginalExtension();
                $new_photo_location = public_path('uploads/products/' . $new_photo_name);
                Image::make($single_photo)->resize(800, 800)->save($new_photo_location);
                ProductImage::create([
                    'product_id' => $product_id,
                    'multiple_image' => $new_photo_name,
                ]);
                $flag++;
            }
        }
    }

    /**
     * Toggle active status
     */
    public function checkActive($product_id)
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
            'message' => 'Status Updated'
        ]);
    }

    /**
     * Toggle home status
     */
    public function checkHome($product_id)
    {
        $product = Product::find($product_id);
        if (!$product) {
            return response()->json([
                'type' => 'error',
                'message' => 'Product not found'
            ], 404);
        }

        // Toggle the is_home status
        $product->is_home = $product->is_home ? 0 : 1;
        $product->save();

        return response()->json([
            'type' => 'success',
            'message' => 'Home Status Updated'
        ]);
    }
}