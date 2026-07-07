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
            cursor: pointer;
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

        /* ── Mobile Card Layout ── */
        @media (max-width: 575.98px) {

            /* Hide normal table headers */
            .cart-table thead {
                display: none;
            }

            /* Each row becomes a card */
            .cart-table tbody tr {
                display: block;
                background: #fff;
                border-radius: 16px;
                box-shadow: 0 8px 24px rgba(8, 15, 30, 0.08);
                margin-bottom: 16px;
                padding: 14px;
                border: none;
            }

            /* Each cell becomes a labeled row */
            .cart-table tbody td {
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 8px 0;
                border: none;
                border-bottom: 1px solid #f0f0f0;
                font-size: 14px;
            }

            .cart-table tbody td:last-child {
                border-bottom: none;
            }

            /* Add a label before each cell using data-label */
            .cart-table tbody td::before {
                content: attr(data-label);
                font-weight: 700;
                color: #555;
                font-size: 12px;
                text-transform: uppercase;
                letter-spacing: 0.5px;
                flex-shrink: 0;
                margin-right: 10px;
            }

            /* Product cell — stack image + name vertically */
            .cart-table tbody td.cart-product-cell {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            .cart-table tbody td.cart-product-cell::before {
                display: none;
            }

            .cart-table tbody td.cart-product-cell .cart-product-inner {
                display: flex;
                align-items: center;
                gap: 12px;
                width: 100%;
            }

            /* Qty input full width area */
            .cart-table tbody td.cart-qty-cell {
                gap: 10px;
            }

            .cart-table tbody td.cart-qty-cell input {
                width: 80px;
            }

            /* Remove cell */
            .cart-table tbody td.cart-action-cell {
                justify-content: flex-end;
                border-bottom: none;
            }

            .cart-table tbody td.cart-action-cell::before {
                display: none;
            }

            /* Footer row */
            .cart-table tfoot tr {
                display: block;
                text-align: right;
            }

            .cart-table tfoot td {
                display: inline-block;
                border: none;
                font-weight: 700;
                padding: 4px 8px;
            }

            /* Action buttons */
            .cart-action-buttons {
                display: flex;
                flex-direction: column;
                gap: 10px;
                margin-top: 16px;
            }

            .cart-action-buttons .btn {
                width: 100%;
                text-align: center;
            }
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
                                    <table class="table align-middle cart-table">
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
                                                    {{-- Product --}}
                                                    <td class="cart-product-cell">
                                                        <div class="cart-product-inner">
                                                            <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}"
                                                                 class="rounded-4"
                                                                 style="width:80px; height:80px; object-fit:cover; flex-shrink:0;">
                                                            <div>
                                                                <a href="{{ route('product.details', $item['slug']) }}"
                                                                   class="fw-semibold">{{ $item['name'] }}</a>
                                                            </div>
                                                        </div>
                                                    </td>

                                                    {{-- Price --}}
                                                    <td data-label="Price">
                                                        <span @if(isset($item['original_price']) && $item['original_price'] > $item['price']) style="color: #76bd10; font-weight: 600;" @endif>
                                                            ${{ number_format($item['price'], 2) }}
                                                        </span>
                                                        @if(isset($item['original_price']) && $item['original_price'] > $item['price'])
                                                            <del class="text-muted ms-2 d-block" style="font-size: 0.85rem;">
                                                                ${{ number_format($item['original_price'], 2) }}
                                                            </del>
                                                        @endif
                                                    </td>

                                                    {{-- Quantity --}}
                                                    <td class="cart-qty-cell" data-label="Qty" style="width:120px;">
                                                        <input type="hidden" name="product_id[]" value="{{ $item['id'] }}">
                                                        <input type="number" name="qty[]" value="{{ $item['qty'] }}"
                                                               min="1" class="form-control form-control-sm">
                                                    </td>

                                                    {{-- Subtotal --}}
                                                    <td data-label="Subtotal">
                                                        ${{ number_format($item['price'] * $item['qty'], 2) }}
                                                    </td>

                                                    {{-- Remove --}}
                                                    <td class="cart-action-cell">
                                                        <button type="submit"
                                                                formaction="{{ route('cart.remove') }}"
                                                                formmethod="POST"
                                                                class="cart-remove-btn"
                                                                name="remove_product_id"
                                                                value="{{ $item['id'] }}"
                                                                aria-label="Remove item">
                                                            <i class="fa-solid fa-xmark"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="3" class="text-end fw-semibold">Total</td>
                                                <td colspan="2" class="fw-semibold">
                                                    ${{ number_format($total, 2) }}
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>

                                {{-- Action Buttons --}}
                                <div class="text-end cart-action-buttons">
                                    <button type="submit" class="btn me-md-1"
                                            style="background-color: #ff4d24; color: white; border: none;">
                                        Update Cart
                                    </button>
                                    <a href="{{ route('cart.checkout') }}" class="btn theme-btn"
                                       style="background-color: #76bd10; color: white; border: none;">
                                        Proceed to Checkout
                                    </a>
                                </div>
                            </form>
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
