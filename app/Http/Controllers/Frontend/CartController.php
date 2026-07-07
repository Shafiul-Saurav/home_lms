<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductOrder;
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

        // Calculate final price based on discount type
        $originalPrice = $product->sell_price;
        $discountedPrice = $originalPrice;

        if ($product->discount_amount && $product->discount_amount > 0) {
            if (strtolower(trim($product->discount_type)) === 'percentage') {
                $discountedPrice = $originalPrice * (1 - $product->discount_amount / 100);
            } else {
                $discountedPrice = $originalPrice - $product->discount_amount;
            }
        }

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
                'original_price' => $originalPrice,
                'price' => $discountedPrice,
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
            'shipping_option' => 'required|in:inside_dhaka,outside_dhaka',
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('warning', 'Your cart is empty.');
        }

        $shippingAmount = $data['shipping_option'] === 'outside_dhaka' ? 130 : 70;
        $total = collect($cart)->sum(function ($item) {
            return $item['price'] * $item['qty'];
        });
        $discountTotal = collect($cart)->sum(function ($item) {
            return isset($item['original_price']) && $item['original_price'] > $item['price']
                ? ($item['original_price'] - $item['price']) * $item['qty']
                : 0;
        });

        foreach ($cart as $item) {
            ProductOrder::create([
                'user_id' => auth()->id(),
                'product_id' => $item['id'],
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'address' => $data['address'],
                'order_number' => 'PROD-' . strtoupper(uniqid()),
                'transaction_id' => null,
                'currency' => 'BDT',
                'amount' => ($item['price'] * $item['qty']) + $shippingAmount - ($item['discount_amount'] ?? 0) * $item['qty'],
                'price' => $item['price'],
                'discount_amount' => isset($item['original_price']) && $item['original_price'] > $item['price']
                    ? ($item['original_price'] - $item['price']) * $item['qty']
                    : 0,
                'shipping_amount' => $shippingAmount,
                'shipping_type' => $data['shipping_option'],
                'coupon_name' => null,
                'qty' => $item['qty'],
                'date' => now()->toDateString(),
                'agree' => true,
                'status' => 'pending',
                'payment_status' => 'Pending',
                'payment_method' => 'COD',
            ]);
        }

        $checkoutData = array_merge($data, [
            'total' => $total,
            'discount_total' => $discountTotal,
            'shipping_amount' => $shippingAmount,
            'items' => $cart,
        ]);

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
