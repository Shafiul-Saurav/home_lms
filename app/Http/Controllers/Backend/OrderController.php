<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class OrderController extends Controller
{
    /**
     * Display a listing of the orders.
     */
    public function index()
    {
        Gate::authorize('index-order');
        
        $orders = Order::with('orderItems')->orderBy('id', 'desc')->paginate(1000);
        return view('backend.pages.orders.index', compact('orders'));
    }

    /**
     * Display the specified order.
     */
    public function show(Order $order)
    {
        Gate::authorize('index-order');
        
        $order->load('orderItems.product.productImages');
        $website_link = \App\Models\WebsiteLink::first();
        $logo_favicon = \App\Models\LogoFavicon::first();
        
        return view('backend.pages.orders.show', compact('order', 'website_link', 'logo_favicon'));
    }

    /**
     * Show the form for editing the specified order.
     */
    public function edit(Order $order)
    {
        Gate::authorize('edit-order');
        
        $order->load('orderItems.product');
        return view('backend.pages.orders.edit', compact('order'));
    }

    /**
     * Update the status of the specified order.
     */
    public function update(Request $request, Order $order)
    {
        Gate::authorize('edit-order');
        
        $request->validate([
            'status' => 'required|in:pending,confirmed,processing,shipped,delivered,cancelled'
        ]);

        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with('success', 'Order status updated successfully.');
    }

    /**
     * Remove the specified order from storage.
     */
    public function destroy(Order $order)
    {
        Gate::authorize('delete-order');
        
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');
    }
}
