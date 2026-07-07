@extends('frontendone.layouts.master')

@section('title', 'Shopping Cart')

@push('frontendone_style')
    @include('frontend.pages.common.style')
    <style>
        td a {
            color: #76bd10 !important;

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
                                                    <td>${{ number_format($item['price'], 2) }}
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
                                                        <button type="submit" formaction="{{ route('cart.remove') }}" formmethod="POST" class="btn btn-danger btn-sm" name="remove_product_id" value="{{ $item['id'] }}">Remove</button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">Update Cart</button>
                                </div>
                            </form>

                            <div class="d-flex justify-content-end align-items-center gap-3 mt-4">
                                <div class="text-end">
                                    <p class="mb-1 text-muted">Total</p>
                                    <h4>${{ number_format($total, 2) }}</h4>
                                </div>
                                <a href="{{ route('cart.checkout') }}" class="btn btn-success btn-lg">Proceed to Checkout</a>
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
