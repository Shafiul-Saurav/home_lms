@extends('frontend.layouts.master')

@section('title', 'Checkout')

@push('frontendstyle')
<style>
/* Enhanced checkout page styling to match cart page */
.checkout-page-container {
    padding: 2rem 0;
}

.checkout-header {
    margin-bottom: 2rem;
}

.checkout-header h2 {
    font-weight: 700;
    color: #333;
}

.breadcrumb {
    background: #f8f9fa;
    padding: 0.75rem 1rem;
    border-radius: 0.5rem;
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

/* Form styling */
.form-label {
    font-weight: 500;
    margin-bottom: 0.5rem;
}

.form-control {
    border-radius: 0.5rem;
    padding: 0.75rem 1rem;
    border: 1px solid #dee2e6;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.form-control:focus {
    border-color: #684eff;
    box-shadow: 0 0 0 0.25rem rgba(104, 78, 255, 0.25);
}

/* Checkout button */

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

/* Empty checkout styling */
.empty-checkout {
    background: #f8f9fa;
    border-radius: 0.75rem;
    margin-top: 2rem;
    padding: 2rem;
    text-align: center;
}

.empty-checkout i {
    font-size: 3rem;
    color: #ced4da;
    margin-bottom: 1rem;
}

.empty-checkout h3 {
    font-weight: 600;
    margin-bottom: 0.75rem;
    font-size: 1.5rem;
}

.empty-checkout p {
    color: #6c757d;
    margin-bottom: 1.5rem;
    font-size: 1rem;
}

.btn-start-shopping {
    border-radius: 0.5rem;
    font-weight: 500;
    padding: 0.5rem 1.25rem;
    transition: all 0.2s ease-in-out;
    font-size: 0.9rem;
    background: linear-gradient(135deg, #00a6ff, #7b2fff);
    border: none;
    color: white;
}

.btn-start-shopping:hover {
    background: linear-gradient(135deg, #0095e6, #6a28e6);
    transform: translateY(-2px);
    box-shadow: 0 0.25rem 0.5rem rgba(0, 166, 255, 0.3);
    color: white;
}

.breadcrumb-item+.breadcrumb-item::before {
    color: #684eff;
}

/* Focus states for accessibility */
.form-control:focus {
    outline: 2px solid #0d6efd;
    outline-offset: 2px;
}
</style>
@endpush

@section('frontend_content')
<div class="container checkout-page-container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" style="color: #684eff !important;">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('cart.index') }}" style="color: #684eff !important;">Shopping Cart</a></li>
            <li class="breadcrumb-item active" aria-current="page">Checkout</li>
        </ol>
    </nav>
</div>

<div class="container py-5">
    <div class="py-4">
        <h2 style="color: #684eff; text-align: center">CHECKOUT</h2>
    </div>

    @if($cartItems && count($cartItems) > 0)
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow-sm mb-4">
                <div class="card-header py-3" style="background-color: #684eff; color: white;">
                    <h5 class="mb-0" style="color: #fff">Billing Information</h5>
                </div>
                <div class="card-body p-4">
                    <form id="checkout-form" action="{{ route('checkout.process') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name *</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email (Optional)</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone Number *</label>
                            <input type="tel" class="form-control" id="phone" name="phone" required>
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Address *</label>
                            <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4 order-summary">
            <div class="card shadow-sm">
                <div class="card-header" style="background-color: #684eff;">
                    <h5 class="mb-0 text-white">Your Order</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="bg-light">
                                <tr>
                                    <th>Product</th>
                                    <th>Qty</th>
                                    <th class="text-end">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cartItems as $item)
                                <tr>
                                    <td>{{ $item['product_name'] }}</td>
                                    <td>{{ $item['quantity'] }}</td>
                                    <td class="text-end">Tk {{ number_format($item['price'] * $item['quantity']) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="border-top pt-3">
                        <div class="order-summary-item">
                            <span>Subtotal:</span>
                            <span>Tk {{ number_format($cartTotal) }}</span>
                        </div>
                        <div class="order-summary-item">
                            <span>Shipping:</span>
                            <span>Tk 80</span>
                        </div>
                        <hr class="order-summary-divider">
                        <div class="order-summary-item">
                            <h5 class="mb-0 order-total">Total:</h5>
                            <h5 class="mb-0 order-total">Tk {{ number_format($cartTotal + 80) }}</h5>
                        </div>
                    </div>

                    <button type="submit" form="checkout-form" class="btn btn-success w-100 btn-sm mt-3">
                        <i class="fas fa-lock me-2"></i>Place Order
                    </button>

                    <div class="text-center mt-3">
                        <small class="text-muted">
                            <i class="fas fa-lock me-1"></i>
                            Secure checkout powered by SSL encryption
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="empty-checkout">
        <div>
            <i class="fas fa-shopping-cart"></i>
        </div>
        <h3>Your cart is empty</h3>
        <p>You need to add items to your cart before checking out.</p>
        <a href="{{ route('home') }}" class="btn btn-primary btn-lg btn-start-shopping">
            <i class="fas fa-shopping-bag me-1"></i>Start Shopping
        </a>
    </div>
    @endif
</div>
@endsection
