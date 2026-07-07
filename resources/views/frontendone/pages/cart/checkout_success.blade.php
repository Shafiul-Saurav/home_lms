@extends('frontendone.layouts.master')

@section('title', 'Order Confirmed')

@push('frontendone_style')
    @include('frontend.pages.common.style')
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

        <section class="section-padding py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="card p-4 text-center">
                            <h2 class="mb-3">Thank you for your order!</h2>
                            <p class="mb-4">Your order has been placed successfully. We will contact you soon to confirm the details.</p>
                            <div class="text-start">
                                <p><strong>Name:</strong> {{ $checkoutData['name'] }}</p>
                                <p><strong>Email:</strong> {{ $checkoutData['email'] }}</p>
                                <p><strong>Phone:</strong> {{ $checkoutData['phone'] }}</p>
                                <p><strong>Address:</strong> {{ $checkoutData['address'] }}</p>
                                <p><strong>Total:</strong> ${{ number_format($checkoutData['total'], 2) }}</p>
                            </div>

                            <a href="{{ route('home') }}" class="btn btn-primary mt-4">Continue Shopping</a>
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
