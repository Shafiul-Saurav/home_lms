<?php

namespace App\Http\Controllers\Trash;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Gate;

class ProductTrashController extends Controller
{
    public function trash()
    {
        Gate::authorize('delete-product');

        $products = Product::onlyTrashed()->with('category')->latest('id')->paginate(100);
        return view('backend.pages.product.trash', compact('products'));
    }

    public function restore(string $id)
    {
        Gate::authorize('delete-product');

        $product = Product::onlyTrashed()->findOrFail($id);
        $product->restore();

        return redirect()->back()->with('info', 'Product Restored Successfully 🙂');
    }

    public function forceDelete(string $id)
    {
        Gate::authorize('delete-product');

        $product = Product::onlyTrashed()->findOrFail($id);

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
            $productImage->forceDelete();
        }

        $product->forceDelete();

        return redirect()->back()->with('error', 'Product Permanently Deleted');
    }
}
