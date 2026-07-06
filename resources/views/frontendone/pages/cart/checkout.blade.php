@extends('frontendone.layouts.master')

@section('title', 'Checkout')

@section('frontendone_content')
    <main class="main">
        <x-frontend.pages.common.breadcrumb
            :title="'Checkout'"
            :breadcrumb="[
                ['name' => 'Home', 'url' => route('home')],
                ['name' => 'Checkout', 'url' => '#']
            ]"
        />

        <section class="section-padding py-5">
            <div class="container">
                <div class="row g-4">
                    <div class="col-lg-7">
                        <div class="card p-4">
                            <h4 class="mb-4">Billing Details</h4>
                            <form action="{{ route('cart.checkout.process') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Phone</label>
                                    <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Address</label>
                                    <textarea name="address" class="form-control" rows="4" required>{{ old('address') }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Order Notes (Optional)</label>
                                    <textarea name="notes" class="form-control" rows="3">{{ old('notes') }}</textarea>
                                </div>
                                <button type="submit" class="btn btn-success">Place Order</button>
                            </form>
                        </div>
                    </div>

                    <div class="col-lg-5">
                        <div class="card p-4">
                            <h4 class="mb-4">Order Summary</h4>
                            @foreach($cart as $item)
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">{{ $item['name'] }}</h6>
                                        <small>Qty: {{ $item['qty'] }}</small>
                                    </div>
                                    <div>${{ number_format($item['price'] * $item['qty'], 2) }}</div>
                                </div>
                            @endforeach

                            <hr>
                            <div class="d-flex justify-content-between align-items-center">
                                <strong>Total</strong>
                                <strong>${{ number_format($total, 2) }}</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
