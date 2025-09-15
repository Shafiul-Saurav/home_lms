@extends('frontend.layouts.master')

@section('title', 'Shopping Cart')

@push('frontendstyle')
<style>
/* Enhanced cart page styling */
thead tr th:first-child {
    border-radius: 0 !important;
}

thead tr th:last-child {
    border-radius: 0 !important;
}
.cart-page-container {
    padding: 2rem 0;
}

.cart-header {
    margin-bottom: 2rem;
}

.cart-header h2 {
    font-weight: 700;
    color: #333;
}

.breadcrumb {
    background: #f8f9fa;
    padding: 0.75rem 1rem;
    border-radius: 0.5rem;
}

/* Cart table styling */
.cart-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    background: #fff;
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    overflow: hidden;
}
.cart-table thead th {
    background: #e6e5e5;
    padding: 5px;
    border-radius: 0;
}

.cart-table tbody td {
    padding: 1rem;
    vertical-align: middle;
    border-bottom: 1px solid #eee;
}

.cart-table tbody tr:last-child td {
    border-bottom: none;
}

.cart-table tbody tr:hover {
    background-color: #f8f9fa;
}

/* Product image in table */
.product-image-table {
    border-radius: 0.5rem;
    overflow: hidden;
    width: 60px;
    height: 60px;
    object-fit: cover;
}

/* Product info in table */
.product-info-table h5 {
    font-weight: 600;
    margin-bottom: 0.25rem;
    font-size: 1rem;
}

.product-info-table .product-category {
    font-size: 0.8rem;
    color: #6c757d;
    margin-bottom: 0;
}

.product-price-table {
    font-weight: 500;
    color: #6c757d;
    margin-bottom: 0;
    font-size: 0.9rem;
}

/* Quantity controls in table */
.quantity-controls-table {
    display: flex;
    width: 100px;
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    border-radius: 0.25rem;
    overflow: hidden;
}

.btn-quantity-table {
    background: linear-gradient(135deg, #00a6ff, #7b2fff);
    border: 1px solid #dee2e6;
    color: white;
    font-weight: bold;
    padding: 0;
    transition: all 0.2s ease-in-out;
    display: flex;
    align-items: center;
    justify-content: center;
    flex: 1;
    font-size: 0.75rem;
    width: 30px;
    height: 30px;
    min-width: 30px;
    min-height: 30px;
}

.btn-quantity-table:hover {
    background: linear-gradient(135deg, #0095e6, #6a28e6);
    border-color: #adb5bd;
    color: white;
}

.btn-quantity-table:active {
    transform: scale(0.95);
}

.btn-decrement-table {
    border-radius: 0.25rem 0 0 0.25rem;
}

.btn-increment-table {
    border-radius: 0 0.25rem 0.25rem 0;
}

.quantity-input-table {
    border-left: none;
    border-right: none;
    background: #fff;
    font-weight: 500;
    padding: 0.25rem;
    text-align: center;
    flex: 1;
    font-size: 0.875rem;
    width: 40px;
    height: 30px;
    min-width: 40px;
    min-height: 30px;
}

/* Remove item button in table */
.remove-item-table {
    transition: all 0.2s ease-in-out;
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: transparent;
    border: none;
    color: #dc3545;
    font-size: 1.2rem;
    min-width: 30px;
    min-height: 30px;
    padding: 0;
    cursor: pointer;
}

.remove-item-table:hover {
    transform: scale(1.1);
    color: #a71d2a;
}

.remove-item-table i {
    font-size: 1.2rem;
}

/* Item total in table */
.item-total-table {
    font-weight: 600;
    font-size: 1rem;
}

/* Card enhancements */
.card {
    border: none;
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.05);
    border-radius: 0.75rem;
    overflow: hidden;
}

.card-header {
    background: #f8f9fa;
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    font-weight: 600;
    padding: 1rem 1.5rem;
    color: #333;
}

.card-header h5 {
    color: #333;
}

/* Continue Shopping and Clear Cart buttons */
.btn-outline-primary, .btn-outline-danger {
    border-radius: 0.5rem;
    font-weight: 500;
    padding: 0.5rem 1.25rem;
    transition: all 0.2s ease-in-out;
    border-width: 2px;
    font-size: 0.9rem;
}

.btn-outline-primary:hover {
    background: #0d6efd;
    border-color: #0d6efd;
    color: white;
}

.btn-outline-danger:hover {
    background: #dc3545;
    border-color: #dc3545;
    color: white;
}

/* Order summary */
.order-summary .card-body {
    padding: 1.25rem;
}

.order-summary-item {
    display: flex;
    justify-content: space-between;
    margin-bottom: 0.75rem;
    font-size: 0.9rem;
}

.order-summary-divider {
    margin: 0.75rem 0;
}

.order-total {
    font-weight: 700;
    font-size: 1.1rem;
}

/* Empty cart styling */
.empty-cart {
    background: #f8f9fa;
    border-radius: 0.75rem;
    margin-top: 2rem;
    padding: 2rem;
    text-align: center;
}

.empty-cart i {
    font-size: 3rem;
    color: #ced4da;
    margin-bottom: 1rem;
}

.empty-cart h3 {
    font-weight: 600;
    margin-bottom: 0.75rem;
    font-size: 1.5rem;
}

.empty-cart p {
    color: #6c757d;
    margin-bottom: 1.5rem;
    font-size: 1rem;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .cart-table thead {
        display: none;
    }

    .cart-table, .cart-table tbody, .cart-table tr, .cart-table td {
        display: block;
    }

    .cart-table tr {
        margin-bottom: 1rem;
        border-radius: 0.75rem;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        padding: 0.75rem;
        background: #fff;
    }

    .cart-table tbody tr:last-child {
        margin-bottom: 0;
    }

    .cart-table td {
        padding: 0.5rem 0;
        border: none;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .cart-table td:before {
        content: attr(data-label) ": ";
        font-weight: 600;
        margin-right: 1rem;
        min-width: 80px;
        font-size: 0.875rem;
    }

    .quantity-controls-table {
        width: 100px;
        max-width: 100px;
    }

    .order-summary {
        margin-top: 1.5rem;
    }

    .empty-cart {
        padding: 1.5rem 1rem;
    }

    .product-image-table {
        width: 60px;
        height: 50px;
    }
}

/* Focus states for accessibility */
.btn-quantity-table:focus,
.remove-item-table:focus {
    outline: 2px solid #0d6efd;
    outline-offset: 2px;
}

.quantity-input-table::-webkit-outer-spin-button,
.quantity-input-table::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

.quantity-input-table[type=number] {
    -moz-appearance: textfield;
}

.quantity-input-table::-webkit-outer-spin-button,
.quantity-input-table::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

.quantity-input-table[type=number] {
    -moz-appearance: textfield;
}

.breadcrumb-item+.breadcrumb-item::before {
    color: #684eff;
}
</style>
@endpush

@section('frontend_content')
<div class="container cart-page-container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" style="color: #684eff !important;">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
        </ol>
    </nav>
</div>
<div class="container py-5">
    <div class="py-4">
        <h2 style="color: #684eff; text-align: center">YOUR SHOPPING CART</h2>
    </div>

    @if($cartItems->count() > 0)
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header py-3" style="background-color: #684eff; color: white;">
                    <h5 class="mb-0" style="color: #fff">Cart Items ({{ $cartCount }} items)</h5>
                </div>
                <div class="card-body p-0">
                    <table class="cart-table">
                        <thead class="bg-light">
                            <tr>
                                <th>Product</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cartItems as $item)
                            <tr data-cart-id="{{ $item['id'] }}">
                                <td data-label="Product">
                                    <div class="d-flex align-items-center">
                                        @php
                                            $product = \App\Models\Product::find($item['product_id']);
                                        @endphp
                                        @if($product && $product->productImages->first())
                                            <img src="{{ asset('uploads/products/' . $product->productImages->first()->multiple_image) }}"
                                                 alt="{{ $item['product_name'] }}"
                                                 class="img-fluid rounded product-image-table">
                                        @else
                                            <img src=""
                                                 alt="{{ $item['product_name'] }}"
                                                 class="img-fluid rounded product-image-table">
                                        @endif
                                    </div>
                                </td>
                                <td data-label="Category">
                                    @if($product)
                                        <p class="mb-0 product-info-table product-category">{{ $product->name ?? 'N/A' }}</p>
                                    @else
                                        <p class="mb-0 product-info-table product-category">N/A</p>
                                    @endif
                                </td>
                                <td data-label="Price">
                                    <p class="mb-0 product-price-table">Tk {{ number_format($item['price']) }}</p>
                                </td>
                                <td data-label="Quantity">
                                    <div class="quantity-controls-table">
                                        <button class="btn btn-quantity-table btn-decrement-table" type="button" data-id="{{ $item['id'] }}">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <input type="text" class="form-control text-center quantity-input-table"
                                               value="{{ $item['quantity'] }}"
                                               data-id="{{ $item['id'] }}"
                                               readonly>
                                        <button class="btn btn-quantity-table btn-increment-table" type="button" data-id="{{ $item['id'] }}">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </td>
                                <td data-label="Total">
                                    <strong class="item-total-table">Tk <span class="item-total">{{ number_format($item['price'] * $item['quantity']) }}</span></strong>
                                </td>
                                <td data-label="Action">
                                    <button class="remove-item-table" data-id="{{ $item['id'] }}">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{ route('home') }}" class="btn btn-outline-primary">
                            <i class="fas fa-arrow-left me-1"></i>Continue Shopping
                        </a>
                        <button id="clear-cart" class="btn btn-outline-danger">
                            <i class="fas fa-trash me-1"></i>Clear Cart
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 order-summary">
            <div class="card shadow-sm">
                <div class="card-header" style="background-color: #684eff;">
                    <h5 class="mb-0 text-white">Order Summary</h5>
                </div>
                <div class="card-body">
                    <div class="order-summary-item">
                        <span>Subtotal:</span>
                        <span>Tk <span id="cart-subtotal">{{ number_format($cartTotal) }}</span></span>
                    </div>
                    <div class="order-summary-item">
                        <span>Shipping:</span>
                        <span>Tk 80</span>
                    </div>
                    <hr class="order-summary-divider">
                    <div class="order-summary-item">
                        <h5 class="mb-0 order-total">Total:</h5>
                        <h5 class="mb-0 order-total">Tk <span id="cart-total">{{ number_format($cartTotal + 80) }}</span></h5>
                    </div>
                    <a href="{{ route('checkout.index') }}" class="btn btn-gradient py-2 w-100 mt-3">
                        <i class="fas fa-lock me-1"></i>Proceed to Checkout
                    </a>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="empty-cart">
        <div>
            <i class="fas fa-shopping-cart"></i>
        </div>
        <h3>Your cart is empty</h3>
        <p>Looks like you haven't added any items to your cart yet.</p>
        <a href="{{ route('home') }}" class="btn btn-gradient btn-lg">
            <i class="fas fa-shopping-bag me-1"></i>Start Shopping
        </a>
    </div>
    @endif
</div>

@push('frontendscript')
<script>
$(document).ready(function() {
    // Update quantity
    $(document).on('click', '.btn-increment-table, .btn-decrement-table', function() {
        var itemId = $(this).data('id');
        var input = $('.quantity-input-table[data-id="' + itemId + '"]');
        var currentValue = parseInt(input.val());
        var newValue = $(this).hasClass('btn-increment-table') ? currentValue + 1 : currentValue - 1;

        if (newValue < 1) newValue = 1;

        updateQuantity(itemId, newValue);
    });

    // Manual input change
    $(document).on('change', '.quantity-input-table', function() {
        var itemId = $(this).data('id');
        var newValue = parseInt($(this).val());

        if (isNaN(newValue) || newValue < 1) {
            newValue = 1;
        }

        updateQuantity(itemId, newValue);
    });

    // Remove item
    $(document).on('click', '.remove-item-table', function() {
        var itemId = $(this).data('id');
        removeItem(itemId);
    });

    // Clear cart
    $(document).on('click', '#clear-cart', function() {
        if (confirm('Are you sure you want to clear your cart?')) {
            clearCart();
        }
    });

    // Update quantity function
    function updateQuantity(itemId, quantity) {
        $.ajax({
            url: '/cart/update/' + itemId,
            method: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                quantity: quantity
            },
            success: function(response) {
                if (response.success) {
                    // Update input value
                    $('.quantity-input-table[data-id="' + itemId + '"]').val(quantity);

                    // Update item total
                    var itemPrice = parseFloat($('.quantity-input-table[data-id="' + itemId + '"]').closest('tr').find('.product-price-table').text().replace('Price: Tk ', '').replace('Tk ', '').replace(/,/g, ''));
                    var itemTotal = itemPrice * quantity;
                    $('.quantity-input-table[data-id="' + itemId + '"]').closest('tr').find('.item-total').text(itemTotal.toLocaleString());

                    // Update cart totals
                    $('#cart-subtotal').text(response.cartTotal.toLocaleString());
                    $('#cart-total').text((response.cartTotal + 80).toLocaleString());
                    $('.cart-count').text(response.cartCount);

                    // Show success message
                    Swal.fire({
                        icon: 'success',
                        title: 'Updated!',
                        text: response.message,
                        timer: 1500,
                        showConfirmButton: false
                    });
                }
            },
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!',
                    timer: 1500,
                    showConfirmButton: false
                });
            }
        });
    }

    // Remove item function
    function removeItem(itemId) {
        $.ajax({
            url: '/cart/remove/' + itemId,
            method: 'DELETE',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    // Remove item from DOM
                    $('[data-cart-id="' + itemId + '"]').fadeOut(300, function() {
                        $(this).remove();

                        // Update cart totals
                        $('#cart-subtotal').text(response.cartTotal.toLocaleString());
                        $('#cart-total').text((response.cartTotal + 80).toLocaleString());
                        $('.cart-count').text(response.cartCount);

                        // Show success message
                        Swal.fire({
                            icon: 'success',
                            title: 'Removed!',
                            text: response.message,
                            timer: 1500,
                            showConfirmButton: false
                        });

                        // If cart is empty, refresh page
                        if (response.cartCount == 0) {
                            setTimeout(function() {
                                location.reload();
                            }, 1500);
                        }
                    });
                }
            },
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!',
                    timer: 1500,
                    showConfirmButton: false
                });
            }
        });
    }

    // Clear cart function
    function clearCart() {
        $.ajax({
            url: '/cart/clear',
            method: 'DELETE',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    // Show success message and reload
                    Swal.fire({
                        icon: 'success',
                        title: 'Cleared!',
                        text: response.message,
                        timer: 1500,
                        showConfirmButton: false
                    }).then(function() {
                        location.reload();
                    });
                }
            },
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!',
                    timer: 1500,
                    showConfirmButton: false
                });
            }
        });
    }
});
</script>
@endpush
@endsection
