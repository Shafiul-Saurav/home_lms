<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

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
            'shipping_cost' => 'required|numeric|min:0',
        ]);

        // Get cart items
        $cartItems = $this->cartService->getCart();
        $cartTotal = $this->cartService->getTotal();
        $cartCount = $this->cartService->getCount();

        // If cart is empty, redirect to cart page
        if ($cartCount == 0) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }

        // Get shipping cost from the form
        $shippingCost = $request->shipping_cost;

        // Create order
        $order = new Order();
        $order->user_id = Auth::check() ? Auth::id() : null;
        $order->order_number = Order::generateOrderNumber();
        $order->name = $request->name;
        $order->email = $request->email;
        $order->phone = $request->phone;
        $order->address = $request->address;
        $order->subtotal = $cartTotal;
        $order->shipping_cost = $shippingCost;
        $order->total = $cartTotal + $shippingCost;
        $order->status = 'pending';
        $order->save();

        // Create order items
        foreach ($cartItems as $item) {
            $product = Product::find($item['product_id']);
            
            $orderItem = new OrderItem();
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $item['product_id'];
            $orderItem->product_name = $item['product_name'];
            $orderItem->quantity = $item['quantity'];
            $orderItem->price = $item['price'];
            $orderItem->total = $item['price'] * $item['quantity'];
            $orderItem->save();
        }

        // Clear cart
        $this->cartService->clear();

        // Redirect to order confirmation page
        return redirect()->route('order.confirmation', $order->id)->with('success', 'Order placed successfully! Thank you for your purchase.');
    }

    /**
     * Display order confirmation
     */
    public function confirmation(Order $order)
    {
        return view('frontend.pages.order.confirmation', compact('order'));
    }
}
