<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BookOrder;
use Illuminate\Http\Request;

class BookOrderController extends Controller
{
    public function index()
    {
        $orders = BookOrder::with(['user', 'book'])->latest('id')->paginate(30);
        return view('backend.pages.orders.bookorders.index', compact('orders'));
    }

    public function edit(string $id)
    {
        $order = BookOrder::with(['user', 'book'])->findOrFail($id);
        return view('backend.pages.orders.bookorders.edit', compact('order'));
    }

    public function update(Request $request, string $id)
    {
        $order = BookOrder::findOrFail($id);

        $request->validate([
            'status' => 'required|in:pending,Processing,Shipped,Delivered,Cancelled',
            'payment_status' => 'required|in:Pending,Completed,Failed,Cancelled',
        ]);

        $order->update([
            'status' => $request->status,
            'payment_status' => $request->payment_status,
        ]);

        return redirect()->route('orders.bookorders')->with('message', 'Book order updated successfully');
    }

    public function destroy(string $id)
    {
        $order = BookOrder::findOrFail($id);
        $order->delete();

        return redirect()->route('orders.bookorders')->with('warning', 'Book order deleted successfully');
    }
}
