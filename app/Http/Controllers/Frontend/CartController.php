<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    /**
     * Display cart page
     */
    public function index()
    {
        $cartItems = $this->cartService->getCart();
        $cartTotal = $this->cartService->getTotal();
        $cartCount = $this->cartService->getCount();

        // Convert array to collection for compatibility with the view
        $cartItems = collect($cartItems);

        return view('frontend.pages.cart.index', compact('cartItems', 'cartTotal', 'cartCount'));
    }

    /**
     * Add product to cart
     */
    public function add(Request $request)
    {
        // If it's a GET request, just return the cart count
        if ($request->isMethod('get')) {
            $cartCount = $this->cartService->getCount();

            return response()->json([
                'success' => true,
                'cartCount' => $cartCount
            ]);
        }

        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $cartItems = $this->cartService->add($request->product_id, $request->quantity);
        $cartCount = $this->cartService->getCount();

        return response()->json([
            'success' => true,
            'message' => 'Product added to cart successfully!',
            'cartCount' => $cartCount
        ]);
    }

    /**
     * Get cart count
     */
    public function getCartCount()
    {
        $cartCount = $this->cartService->getCount();

        return response()->json([
            'success' => true,
            'cartCount' => $cartCount
        ]);
    }

    /**
     * Update cart item quantity
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $cartItems = $this->cartService->update($id, $request->quantity);
        $cartTotal = $this->cartService->getTotal();
        $cartCount = $this->cartService->getCount();

        return response()->json([
            'success' => true,
            'message' => 'Cart updated successfully!',
            'cartTotal' => $cartTotal,
            'cartCount' => $cartCount
        ]);
    }

    /**
     * Remove item from cart
     */
    public function remove($id)
    {
        $cartItems = $this->cartService->remove($id);
        $cartTotal = $this->cartService->getTotal();
        $cartCount = $this->cartService->getCount();

        return response()->json([
            'success' => true,
            'message' => 'Item removed from cart!',
            'cartTotal' => $cartTotal,
            'cartCount' => $cartCount
        ]);
    }

    /**
     * Clear cart
     */
    public function clear()
    {
        $this->cartService->clear();

        return response()->json([
            'success' => true,
            'message' => 'Cart cleared successfully!'
        ]);
    }


}
