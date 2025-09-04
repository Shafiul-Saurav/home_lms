@extends('frontend.layouts.master')

@section('title', 'Shopping Cart')

@section('frontend_content')
<div class="container mt-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
        </ol>
    </nav>

    <h2 class="mb-4">Your Shopping Cart</h2>

    @if($cartItems->count() > 0)
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Cart Items ({{ $cartCount }} items)</h5>
                </div>
                <div class="card-body">
                    @foreach($cartItems as $item)
                    <div class="row mb-4 pb-4 border-bottom" data-cart-id="{{ $item['id'] }}">
                        <div class="col-md-3">
                            @php
                                $product = \App\Models\Product::find($item['product_id']);
                            @endphp
                            @if($product && $product->productImages->first())
                                <img src="{{ asset('uploads/products/' . $product->productImages->first()->multiple_image) }}" 
                                     alt="{{ $item['product_name'] }}" 
                                     class="img-fluid rounded" 
                                     style="height: 120px; width: 100%; object-fit: cover;">
                            @else
                                <img src="https://via.placeholder.com/150x150.png?text=No+Image" 
                                     alt="{{ $item['product_name'] }}" 
                                     class="img-fluid rounded" 
                                     style="height: 120px; width: 100%; object-fit: cover;">
                            @endif
                        </div>
                        <div class="col-md-9">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h5 class="mb-1">{{ $item['product_name'] }}</h5>
                                    <p class="mb-2 text-muted">Price: Tk {{ number_format($item['price']) }}</p>
                                </div>
                                <div>
                                    <button class="btn btn-sm btn-outline-danger remove-item" data-id="{{ $item['id'] }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                            
                            <div class="d-flex align-items-center mt-3">
                                <div class="input-group" style="width: 150px;">
                                    <button class="btn btn-outline-secondary decrement" type="button" data-id="{{ $item['id'] }}">-</button>
                                    <input type="text" class="form-control text-center quantity-input" 
                                           value="{{ $item['quantity'] }}" 
                                           data-id="{{ $item['id'] }}" 
                                           style="max-width: 60px;">
                                    <button class="btn btn-outline-secondary increment" type="button" data-id="{{ $item['id'] }}">+</button>
                                </div>
                                <div class="ms-4">
                                    <strong>Total: Tk <span class="item-total">{{ number_format($item['price'] * $item['quantity']) }}</span></strong>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="card-footer bg-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{ route('home') }}" class="btn btn-outline-primary">
                            <i class="fas fa-arrow-left me-2"></i>Continue Shopping
                        </a>
                        <button id="clear-cart" class="btn btn-outline-danger">
                            <i class="fas fa-trash me-2"></i>Clear Cart
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Order Summary</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-2">
                        <span>Subtotal:</span>
                        <span>Tk <span id="cart-subtotal">{{ number_format($cartTotal) }}</span></span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Shipping:</span>
                        <span>Tk 80</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between mb-3">
                        <h5 class="mb-0">Total:</h5>
                        <h5 class="mb-0">Tk <span id="cart-total">{{ number_format($cartTotal + 80) }}</span></h5>
                    </div>
                    <a href="{{ route('checkout.index') }}" class="btn btn-success w-100 btn-lg">
                        <i class="fas fa-lock me-2"></i>Proceed to Checkout
                    </a>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="text-center py-5">
        <div class="mb-4">
            <i class="fas fa-shopping-cart text-muted" style="font-size: 4rem;"></i>
        </div>
        <h3 class="mb-3">Your cart is empty</h3>
        <p class="mb-4 text-muted">Looks like you haven't added any items to your cart yet.</p>
        <a href="{{ route('home') }}" class="btn btn-primary btn-lg">
            <i class="fas fa-shopping-bag me-2"></i>Start Shopping
        </a>
    </div>
    @endif
</div>

@push('frontendscript')
<script>
$(document).ready(function() {
    // Update quantity
    $(document).on('click', '.increment, .decrement', function() {
        var itemId = $(this).data('id');
        var input = $('.quantity-input[data-id="' + itemId + '"]');
        var currentValue = parseInt(input.val());
        var newValue = $(this).hasClass('increment') ? currentValue + 1 : currentValue - 1;
        
        if (newValue < 1) newValue = 1;
        
        updateQuantity(itemId, newValue);
    });
    
    // Manual input change
    $(document).on('change', '.quantity-input', function() {
        var itemId = $(this).data('id');
        var newValue = parseInt($(this).val());
        
        if (isNaN(newValue) || newValue < 1) {
            newValue = 1;
        }
        
        updateQuantity(itemId, newValue);
    });
    
    // Remove item
    $(document).on('click', '.remove-item', function() {
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
                    $('.quantity-input[data-id="' + itemId + '"]').val(quantity);
                    
                    // Update item total
                    var itemPrice = parseFloat($('.quantity-input[data-id="' + itemId + '"]').closest('.row').find('.text-muted').text().replace('Price: Tk ', '').replace(/,/g, ''));
                    var itemTotal = itemPrice * quantity;
                    $('.quantity-input[data-id="' + itemId + '"]').closest('.row').find('.item-total').text(itemTotal.toLocaleString());
                    
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
            method: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                _method: 'DELETE'
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
            method: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                _method: 'DELETE'
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

<style>
.quantity-input::-webkit-outer-spin-button,
.quantity-input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

.quantity-input[type=number] {
    -moz-appearance: textfield;
}
</style>
@endsection