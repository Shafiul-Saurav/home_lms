@extends('frontendone.layouts.master')

@section('title', 'Order Confirmed')

@push('frontendone_style')
    @include('frontend.pages.common.style')
    <style>
        .success-area {
            background: #f8fafc;
            padding: 90px 0;
        }

        .success-card {
            background: #fff;
            border: 1px solid #edf0f5;
            border-radius: 24px;
            padding: 40px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.05);
            transition: 0.3s ease;
        }

        .success-card:hover {
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.1);
        }

        .success-icon {
            width: 90px;
            height: 90px;
            margin: 0 auto 24px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: #e6f7ed;
            color: #1f7a36;
            font-size: 2.2rem;
            border: 2px solid #c7eed3;
        }

        .success-card h2 {
            font-size: 2.25rem;
            font-weight: 800;
            margin-bottom: 16px;
            color: #0f172a;
        }

        .success-card p.lead {
            color: #475569;
            font-size: 1rem;
            line-height: 1.8;
            margin-bottom: 30px;
        }

        .success-details {
            text-align: left;
            margin-top: 20px;
            padding: 24px;
            border-radius: 18px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
        }

        .success-details p {
            margin-bottom: 12px;
            color: #334155;
            font-size: 0.98rem;
        }

        .success-details strong {
            color: #0f172a;
        }

        .success-actions {
            margin-top: 30px;
        }
    </style>
@endpush

@section('frontendone_content')
    <main class="main">
        <x-frontend.pages.common.breadcrumb
            :title="'Order Confirmed'"
            :breadcrumb="[
                ['name' => 'Home', 'url' => route('home')],
                ['name' => 'Order Confirmed', 'url' => '#']
            ]"
        />

        <section class="section-padding py-5 success-area">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-7">
                        <div class="success-card text-center">
                            <div class="success-icon">
                                <i class="fa-solid fa-check"></i>
                            </div>
                            <h2>Thank you for your order!</h2>
                            <p class="lead">Your order has been placed successfully. We’ll contact you soon with confirmation and shipping details.</p>

                            <div class="success-details">
                                <p><strong>Name:</strong> {{ $checkoutData['name'] }}</p>
                                <p><strong>Email:</strong> {{ $checkoutData['email'] }}</p>
                                <p><strong>Phone:</strong> {{ $checkoutData['phone'] }}</p>
                                <p><strong>Address:</strong> {{ $checkoutData['address'] }}</p>
                                <p><strong>Total:</strong> ${{ number_format($checkoutData['total'], 2) }}</p>
                            </div>

                            <div class="success-actions">
                                <a href="{{ route('home') }}" class="enroll-btn p-3">Continue Shopping</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@push('frontendone_script')
    @include('frontend.pages.common.script')
@endpush
