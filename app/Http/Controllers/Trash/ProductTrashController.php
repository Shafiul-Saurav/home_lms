<?php

namespace App\Http\Controllers\Trash;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class ProductTrashController extends Controller
{
    public function trash()
    {
        Gate::authorize('delete-product');

        $products = Product::with(['category', 'subcategory', 'childcategory'])->onlyTrashed()->latest('id')->paginate(100);
        return view('backend.pages.product.trash', compact('products'));
    }

    public function restore($id)
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
}