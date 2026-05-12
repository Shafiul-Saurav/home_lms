@extends('frontend.layouts.master')

@section('title', 'Thank You')

@push('frontend_style')
    <style>
        .thank-you-area {
            padding: 100px 0;
            background: #f8f9fa;
        }
        .success-card {
            background: #fff;
            padding: 50px;
            border-radius: 20px;
            box-shadow: 0 0 40px rgba(0,0,0,0.05);
            text-align: center;
        }
        .success-icon {
            width: 80px;
            height: 80px;
            background: #28a745;
            color: #fff;
            font-size: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            margin: 0 auto 30px;
        }
        .order-details-box {
            background: #f9f9ff;
            padding: 30px;
            border-radius: 15px;
            text-align: left;
            margin: 30px 0;
        }
    </style>
@endpush

@section('frontend_content')
    <main class="main">
        <section class="thank-you-area">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-7">
                        <div class="success-card">
                            <div class="success-icon">
                                <i class="fas fa-check"></i>
                            </div>
                            <h2 class="fw-bold">Payment Successful!</h2>
                            <p class="text-muted">Thank you for your purchase. Your order has been received.</p>

                            <div class="order-details-box">
                                <h5 class="fw-bold mb-3 border-bottom pb-2">Order Information</h5>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Order Number:</span>
                                    <span class="fw-bold text-dark">{{ $order->order_number }}</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Transaction ID:</span>
                                    <span class="fw-bold text-dark">{{ $order->transaction_id }}</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Book:</span>
                                    <span class="fw-bold text-dark">{{ $order->book->name }}</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Quantity:</span>
                                    <span class="fw-bold text-dark">{{ $order->qty }}</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Total Amount:</span>
                                    <span class="fw-bold text-primary">৳{{ number_format($order->amount, 2) }}</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span>Date:</span>
                                    <span class="fw-bold text-dark">{{ $order->date }}</span>
                                </div>
                            </div>

                            <div class="d-flex gap-3 justify-content-center">
                                <a href="{{ route('books') }}" class="theme-btn">Browse More Books</a>
                                <a href="{{ route('user.dashboard') }}" class="theme-btn" style="background: #333;">Go to Dashboard</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
