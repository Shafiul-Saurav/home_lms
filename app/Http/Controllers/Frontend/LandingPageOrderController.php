<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LandingPageOrderController extends Controller
{
    /**
     * Process landing page order
     */
    public function process(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'shipping_cost' => 'required|numeric|min:0',
            'unit_price' => 'required|numeric|min:0', // Added unit price validation
        ]);

        // Get product info
        $product = Product::find($request->product_id);

        if (!$product) {
            return redirect()->back()->with('error', 'Product not found!');
        }

        // Get shipping cost and unit price from the form
        $shippingCost = $request->shipping_cost;
        $unitPrice = $request->unit_price; // Use the price from the form which is the discounted price

        // Calculate totals
        $subtotal = $unitPrice * $request->quantity;
        $total = $subtotal + $shippingCost;

        // Create order
        $order = new Order();
        $order->user_id = Auth::check() ? Auth::id() : null;
        $order->order_number = Order::generateOrderNumber();
        $order->name = $request->name;
        $order->email = $request->email;
        $order->phone = $request->phone;
        $order->address = $request->address;
        $order->subtotal = $subtotal;
        $order->shipping_cost = $shippingCost;
        $order->total = $total;
        $order->status = 'pending';
        $order->save();

        // Create order item
        $orderItem = new OrderItem();
        $orderItem->order_id = $order->id;
        $orderItem->product_id = $product->id;
        $orderItem->product_name = $product->name;
        $orderItem->quantity = $request->quantity;
        $orderItem->price = $unitPrice;
        $orderItem->total = $unitPrice * $request->quantity;
        $orderItem->save();

        // Redirect to order confirmation page
        return redirect()->route('order.confirmation', $order->id)->with('success', 'Order placed successfully! Thank you for your purchase.');
    }
}