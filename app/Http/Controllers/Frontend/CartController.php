<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cart()
    {
        $cart = session()->get('cart', []);
        $total = collect($cart)->sum(function ($item) {
            return $item['price'] * $item['qty'];
        });

        return view('frontendone.pages.cart.cart', compact('cart', 'total'));
    }

    public function addToCart(Request $request)
    {
        $data = $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'qty' => 'sometimes|integer|min:1'
        ]);

        $product = Product::with('productImages')->where('is_active', 1)->findOrFail($data['product_id']);

        $price = $product->discount_amount && $product->discount_amount > 0
            ? $product->sell_price - $product->discount_amount
            : $product->sell_price;

        $image = $product->image
            ? asset('uploads/products/' . $product->image)
            : ($product->productImages->first()
                ? asset('uploads/products/' . $product->productImages->first()->multiple_image)
                : asset('assets/frontend/img/default-product.png'));

        $qty = $data['qty'] ?? 1;

        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['qty'] += $qty;
        } else {
            $cart[$product->id] = [
                'id' => $product->id,
                'name' => $product->name,
                'slug' => $product->slug,
                'price' => $price,
                'qty' => $qty,
                'image' => $image,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart.');
    }

    public function updateCart(Request $request)
    {
        $data = $request->validate([
            'product_id' => 'required|array',
            'product_id.*' => 'integer|exists:products,id',
            'qty' => 'required|array',
            'qty.*' => 'integer|min:1'
        ]);

        $cart = session()->get('cart', []);

        foreach ($data['product_id'] as $index => $productId) {
            if (isset($cart[$productId]) && isset($data['qty'][$index])) {
                $cart[$productId]['qty'] = max(1, intval($data['qty'][$index]));
            }
        }

        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Cart updated successfully.');
    }

    public function removeFromCart(Request $request)
    {
        $productId = $request->input('remove_product_id');

        if (!$productId) {
            return redirect()->route('cart.index')->with('warning', 'No product selected for removal.');
        }

        $request->merge(['product_id' => $productId]);

        $data = $request->validate([
            'product_id' => 'required|integer|exists:products,id'
        ]);

        $cart = session()->get('cart', []);

        if (isset($cart[$data['product_id']])) {
            unset($cart[$data['product_id']]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Product removed from cart.');
    }

    public function checkout()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('warning', 'Your cart is empty. Add products before checking out.');
        }

        $total = collect($cart)->sum(function ($item) {
            return $item['price'] * $item['qty'];
        });

        return view('frontendone.pages.cart.checkout', compact('cart', 'total'));
    }

    public function processCheckout(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:50',
            'address' => 'required|string|max:500',
            'notes' => 'nullable|string|max:1000',
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('warning', 'Your cart is empty.');
        }

        $total = collect($cart)->sum(function ($item) {
            return $item['price'] * $item['qty'];
        });

        $checkoutData = array_merge($data, ['total' => $total, 'items' => $cart]);

        session()->forget('cart');
        session()->flash('checkout_data', $checkoutData);

        return redirect()->route('cart.checkout.success');
    }

    public function success()
    {
        $checkoutData = session('checkout_data');

        if (!$checkoutData) {
            return redirect()->route('cart.index');
        }

        return view('frontendone.pages.cart.checkout_success', compact('checkoutData'));
    }
}
