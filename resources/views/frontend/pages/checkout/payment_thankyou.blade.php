@extends('frontend.layouts.master')

@section('title', 'Payment Success')

@section('frontend_content')
    <main class="main">
        <x-frontend.pages.common.breadcrumb :title="'Payment Success'" :breadcrumb="[['name' => 'Home', 'url' => route('home')], ['name' => 'Payment Success', 'url' => '#']]" />

        <section class="mt-50 mb-50 py-120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 m-auto">
                        <div class="card shadow-sm border-0 rounded-10">
                            <div class="card-header bg-success text-white text-center py-4 rounded-top-10">
                                <h3 class="mb-0">Payment Successful!</h3>
                            </div>
                            <div class="card-body text-center p-5">
                                <i class="fas fa-check-circle text-success mb-4" style="font-size: 80px;"></i>
                                <h4 class="mt-3">Thank you for your purchase!</h4>
                                <p class="text-muted">You have successfully enrolled in the course. You can now access your content.</p>
                                
                                <div class="order-info my-4 p-4 bg-light rounded">
                                    <p class="mb-2"><strong>Order Number:</strong> {{ $order->order_number }}</p>
                                    @if($order->transaction_id)
                                        <p class="mb-2"><strong>Transaction ID:</strong> {{ $order->transaction_id }}</p>
                                    @endif
                                    <p class="mb-0"><strong>Amount Paid:</strong> ৳{{ number_format($order->amount, 2) }}</p>
                                </div>

                                <div class="d-flex justify-content-center gap-3">
                                    <a href="{{ route('user.dashboard') }}" class="theme-btn">Go to Dashboard</a>
                                    <a href="{{ route('home') }}" class="theme-btn" style="background: #6c757d;">Back to Home</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
