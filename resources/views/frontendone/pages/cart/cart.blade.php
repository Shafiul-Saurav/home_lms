@extends('frontendone.layouts.master')

@section('title', 'Shopping Cart')

@push('frontendone_style')
    @include('frontend.pages.common.style')
    <style>
        td a {
            color: #76bd10 !important;
        }

        .cart-remove-btn {
            border: 1px solid #ff4d24;
            color: #ff4d24;
            background: transparent;
            min-width: 38px;
            min-height: 38px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
        }

        .cart-summary-box {
            min-width: 220px;
            text-align: right;
        }

        .cart-summary-row {
            justify-content: flex-end;
            align-items: center;
            gap: 1rem;
            margin-top: 1.5rem;
            flex-wrap: wrap;
        }
    </style>
@endpush

@section('frontendone_content')
    <main class="main">
        <x-frontend.pages.common.breadcrumb
            :title="'Shopping Cart'"
            :breadcrumb="[
                ['name' => 'Home', 'url' => route('home')],
                ['name' => 'Shopping Cart', 'url' => '#']
            ]"
        />

        <section class="section-padding py-5">
            <div class="container">
                <div class="row g-4">
                    <div class="col-12">
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if(session('warning'))
                            <div class="alert alert-warning">{{ session('warning') }}</div>
                        @endif

                        @if(count($cart) > 0)
                            <form action="{{ route('cart.update') }}" method="POST">
                                @csrf
                                <div class="table-responsive">
                                    <table class="table align-middle">
                                        <thead>
                                            <tr>
                                                <th>Product</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th>Subtotal</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($cart as $item)
                                                <tr>
                                                    <td class="d-flex align-items-center gap-3">
                                                        <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="rounded-4" style="width:80px; height:80px; object-fit:cover;">
                                                        <div>
                                                            <a href="{{ route('product.details', $item['slug']) }}" class="fw-semibold">{{ $item['name'] }}</a>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span @if(isset($item['original_price']) && $item['original_price'] > $item['price']) style="color: #76bd10; font-weight: 600;" @endif>${{ number_format($item['price'], 2) }}</span>
                                                        @if(isset($item['original_price']) && $item['original_price'] > $item['price'])
                                                            <del class="text-muted ms-2 d-block" style="font-size: 0.85rem;">${{ number_format($item['original_price'], 2) }}</del>
                                                        @endif
                                                    </td>
                                                    <td style="width:120px;">
                                                        <input type="hidden" name="product_id[]" value="{{ $item['id'] }}">
                                                        <input type="number" name="qty[]" value="{{ $item['qty'] }}" min="1" class="form-control form-control-sm">
                                                    </td>
                                                    <td>${{ number_format($item['price'] * $item['qty'], 2) }}</td>
                                                    <td>
                                                        <button type="submit" formaction="{{ route('cart.remove') }}" formmethod="POST" class="cart-remove-btn" name="remove_product_id" value="{{ $item['id'] }}" aria-label="Remove item">
                                                            <i class="fa-solid fa-xmark"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn mb-2" style="background-color: #ff4d24; color: white; border: none;">Update Cart</button>
                                </div>
                            </form>

                            <div class="d-flex justify-content-end gap-3 mt-4 flex-column flex-sm-row align-items-sm-center text-sm-end">
                                <div class="cart-summary-box">
                                    <p class="mb-1 text-muted">Total</p>
                                    <h4 class="mb-0">${{ number_format($total, 2) }}</h4>
                                </div>
                                <a href="{{ route('cart.checkout') }}" class="btn theme-btn" style="background-color: #76bd10; color: white; border: none;">Proceed to Checkout</a>
                            </div>
                        @else
                            <div class="alert alert-info text-center">
                                Your cart is empty. <a href="{{ route('products') }}">Browse products</a> to add items.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@push('frontendone_script')
    @include('frontend.pages.common.script')
@endpush
