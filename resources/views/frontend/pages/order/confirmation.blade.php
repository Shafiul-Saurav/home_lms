@extends('frontend.layouts.master')

@section('title', 'Order Confirmation')

@section('frontend_content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header text-white" style="background-color: #684eff;">
                    <h4 class="mb-0 text-center text-light">Order Confirmation</h4>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        <i class="fas fa-check-circle text-success" style="font-size: 4rem;"></i>
                        <h2 class="mt-3">Thank You For Your Order!</h2>
                        <p class="text-muted">Your order has been received and is being processed.</p>
                    </div>

                    <div class="order-details mb-4">
                        <h5>Order Details</h5>
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th>Order Number:</th>
                                    <td>{{ $order->order_number }}</td>
                                </tr>
                                <tr>
                                    <th>Date:</th>
                                    <td>{{ $order->created_at->format('F d, Y') }}</td>
                                </tr>
                                <tr>
                                    <th>Status:</th>
                                    <td><span class="badge bg-warning">Pending</span></td>
                                </tr>
                                <tr>
                                    <th>Name:</th>
                                    <td>{{ $order->name }}</td>
                                </tr>
                                <tr>
                                    <th>Email:</th>
                                    <td>{{ $order->email ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Phone:</th>
                                    <td>{{ $order->phone }}</td>
                                </tr>
                                <tr>
                                    <th>Address:</th>
                                    <td>{{ $order->address }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="order-items mb-4">
                        <h5>Order Items</h5>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-light">Product</th>
                                        <th class="text-light">Price</th>
                                        <th class="text-light">Quantity</th>
                                        <th class="text-light">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order->orderItems as $item)
                                    <tr>
                                        <td>{{ $item->product_name }}</td>
                                        <td>Tk {{ number_format($item->price) }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>Tk {{ number_format($item->total) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="3" class="text-end">Subtotal:</th>
                                        <th>Tk {{ number_format($order->subtotal) }}</th>
                                    </tr>
                                    <tr>
                                        <th colspan="3" class="text-end">Shipping:</th>
                                        <th>Tk {{ number_format($order->shipping_cost) }}</th>
                                    </tr>
                                    <tr>
                                        <th colspan="3" class="text-end">Total:</th>
                                        <th>Tk {{ number_format($order->total) }}</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <div class="text-center">
                        <a href="{{ route('home') }}" class="btn btn-gradient">Continue Shopping</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
