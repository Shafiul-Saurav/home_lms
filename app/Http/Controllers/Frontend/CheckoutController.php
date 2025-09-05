<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class CheckoutController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    /**
     * Display checkout page
     */
    public function index()
    {
        $cartItems = $this->cartService->getCart();
        $cartTotal = $this->cartService->getTotal();
        $cartCount = $this->cartService->getCount();

        // If cart is empty, redirect to cart page
        if ($cartCount == 0) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }

        // Convert array to collection for compatibility with the view
        $cartItems = collect($cartItems);

        return view('frontend.pages.checkout.index', compact('cartItems', 'cartTotal', 'cartCount'));
    }

    /**
     * Process checkout
     */
    public function process(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
        ]);

        // Here you would process the order
        // For now, we'll just clear the cart and show a success message
        
        $this->cartService->clear();

        return redirect()->route('home')->with('success', 'Order placed successfully! Thank you for your purchase.');
    }
}
