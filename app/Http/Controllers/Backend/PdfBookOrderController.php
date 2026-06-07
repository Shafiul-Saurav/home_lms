<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PdfBookOrder;
use Illuminate\Http\Request;

class PdfBookOrderController extends Controller
{
    public function index()
    {
        $orders = PdfBookOrder::with(['user', 'pdfBook'])->latest('id')->paginate(30);
        return view('backend.pages.orders.pdfbookorders.index', compact('orders'));
    }

    public function edit(string $id)
    {
        $order = PdfBookOrder::with(['user', 'pdfBook'])->findOrFail($id);
        return view('backend.pages.orders.pdfbookorders.edit', compact('order'));
    }

    public function update(Request $request, string $id)
    {
        $order = PdfBookOrder::findOrFail($id);

        $request->validate([
            'payment_status' => 'required|in:Pending,Completed,Failed,Cancelled',
        ]);

        $order->update([
            'payment_status' => $request->payment_status,
        ]);

        return redirect()->route('orders.pdfbookorders')->with('message', 'PDF book order updated successfully');
    }

    public function destroy(string $id)
    {
        $order = PdfBookOrder::findOrFail($id);
        $order->delete();

        return redirect()->route('orders.pdfbookorders')->with('warning', 'PDF book order deleted successfully');
    }
}
