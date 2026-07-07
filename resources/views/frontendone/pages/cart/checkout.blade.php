@extends('frontendone.layouts.master')

@section('title', 'Checkout')

@push('frontendone_style')
    @include('frontend.pages.common.style')
    <style>
        .checkout-area {
            background: #f8fafc;
            padding: 60px 0;
        }

        .checkout-card,
        .checkout-summary {
            background: #fff;
            border: 1px solid #edf0f5;
            border-radius: 24px;
            padding: 32px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.05);
        }

        .checkout-card h4,
        .checkout-summary h4 {
            font-weight: 700;
            margin-bottom: 28px;
        }

        .checkout-card .form-label,
        .checkout-summary .summary-title {
            font-weight: 600;
            color: #374151;
        }

        .checkout-card .form-control,
        .checkout-card .form-select {
            border-radius: 14px;
            border: 1px solid #edf0f5;
            height: 54px;
            padding: 0 18px;
            font-size: 14px;
            color: #111827;
        }

        .checkout-card textarea.form-control {
            min-height: 130px;
            padding-top: 14px;
            padding-bottom: 14px;
        }

        .checkout-card .form-control:focus,
        .checkout-card .form-select:focus {
            border-color: #76bd10;
            box-shadow: 0 0 0 4px rgba(118, 189, 16, 0.12);
            outline: none;
        }

        .checkout-summary .summary-line {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
            margin-bottom: 16px;
        }

        .checkout-summary .grand-total {
            font-size: 1.35rem;
            font-weight: 700;
        }

        .checkout-actions {
            display: flex;
            justify-content: flex-end;
            margin-top: 24px;
        }

        .checkout-actions .btn {
            min-width: 180px;
        }
    </style>
@endpush

@section('frontendone_content')
    <main class="main">
        <x-frontend.pages.common.breadcrumb :title="'Checkout'" :breadcrumb="[['name' => 'Home', 'url' => route('home')], ['name' => 'Checkout', 'url' => '#']]" />

        <section class="section-padding py-5 checkout-area">
            <div class="container">
                <div class="row g-4">
                    <div class="col-lg-7">
                        <div class="checkout-card">
                            <h4>Billing Details</h4>
                            <form action="{{ route('cart.checkout.process') }}" method="POST" id="checkout-form">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Name</label>
                                            <input type="text" name="name" class="form-control"
                                                value="{{ old('name') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Email</label>
                                            <input type="email" name="email" class="form-control"
                                                value="{{ old('email') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Phone</label>
                                            <input type="text" name="phone" class="form-control"
                                                value="{{ old('phone') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Address</label>
                                            <input type="text" name="address" class="form-control"
                                                value="{{ old('address') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Shipping</label>
                                            <select name="shipping_option" id="shipping_option" class="form-select"
                                                required>
                                                <option value="70">Inside Dhaka (৳70)</option>
                                                <option value="130">Outside Dhaka (৳130)</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Order Notes (Optional)</label>
                                            <input type="text" name="notes" class="form-control"
                                                value="{{ old('notes') }}">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="col-lg-5">
                        <div class="checkout-summary">
                            <h4>Order Summary</h4>
                            @php
                                $discountTotal = 0;
                            @endphp
                            @foreach ($cart as $item)
                                @php
                                    $lineTotal = $item['price'] * $item['qty'];
                                    if (isset($item['original_price']) && $item['original_price'] > $item['price']) {
                                        $discountTotal += ($item['original_price'] - $item['price']) * $item['qty'];
                                    }
                                @endphp
                                <div class="summary-line">
                                    <div>
                                        <h6 class="mb-1">{{ $item['name'] }}</h6>
                                        <small>Qty: {{ $item['qty'] }}</small>
                                    </div>
                                    <div>${{ number_format($lineTotal, 2) }}</div>
                                </div>
                            @endforeach

                            <hr>
                            <div class="summary-line">
                                <span class="summary-title">Subtotal</span>
                                <span id="summary-subtotal">${{ number_format($total, 2) }}</span>
                            </div>
                            <div class="summary-line">
                                <span class="summary-title">Discount</span>
                                <span id="summary-discount">-${{ number_format($discountTotal, 2) }}</span>
                            </div>
                            <div class="summary-line">
                                <span class="summary-title">Shipping</span>
                                <span id="summary-shipping">৳70</span>
                            </div>
                            <div class="summary-line grand-total">
                                <span>Total</span>
                                <span id="summary-grand-total">${{ number_format($total - $discountTotal + 70, 2) }}</span>
                            </div>
                            <div class="mt-3 text-end">
                                <button type="submit" form="checkout-form" class="btn btn-success w-100">Place Order</button>
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
    <script>
        $(function() {
            function updateCheckoutTotals() {
                var subtotal = parseFloat({{ number_format($total, 2, '.', '') }});
                var discount = parseFloat({{ number_format($discountTotal ?? 0, 2, '.', '') }});
                var shipping = parseFloat($('#shipping_option').val() || 70);
                var grandTotal = subtotal - discount + shipping;

                $('#summary-shipping').text('৳' + shipping.toFixed(0));
                $('#summary-discount').text('-$' + discount.toFixed(2));
                $('#summary-grand-total').text('$' + grandTotal.toFixed(2));
            }

            $('#shipping_option').on('change', updateCheckoutTotals);
            updateCheckoutTotals();
        });
    </script>
@endpush
