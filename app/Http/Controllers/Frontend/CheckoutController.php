<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Services\CartService;
use Illuminate\Http\Request;

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

        return view('frontend.pages.checkout.index', compact('cartItems', 'cartTotal', 'cartCount'));
    }

    /**
     * Process checkout
     */
    public function process(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'city' => 'required|string|max:255',
            'zip_code' => 'required|string|max:10',
        ]);

        // Here you would process the order
        // For now, we'll just clear the cart and show a success message
        
        $this->cartService->clear();

        return redirect()->route('home')->with('success', 'Order placed successfully! Thank you for your purchase.');
    }
}
