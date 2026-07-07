@php
    $cartItems = session('cart', []);
    $cartCount = count($cartItems);
    $cartTotal = collect($cartItems)->sum(function ($item) {
        return $item['price'] * $item['qty'];
    });
@endphp

<div class="fixed-cart-panel">
    <button class="fixed-cart-card text-start" type="button" data-bs-toggle="offcanvas" data-bs-target="#cartSidebar" aria-controls="cartSidebar">
        <div class="text-center">
            <div class="cart-card-icon-wrap text-center">
                <i class="fa-solid fa-shopping-bag cart-card-icon"></i>
            </div>
            <div class="text-center mt-1">
                <div class="cart-card-count">{{ $cartCount }} Item{{ $cartCount === 1 ? '' : 's' }}</div>
                <div class="cart-card-total">৳{{ number_format($cartTotal, 2) }}</div>
            </div>
        </div>
    </button>
</div>

<div class="offcanvas offcanvas-end cart-sidebar" tabindex="-1" id="cartSidebar" aria-labelledby="cartSidebarLabel">
    <div class="offcanvas-header border-bottom">
        <h5 class="offcanvas-title" id="cartSidebarLabel">Shopping Cart</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body py-4">
        @if($cartCount > 0)
            <div class="cart-sidebar-items">
                @foreach($cartItems as $item)
                    <div class="cart-sidebar-item d-flex align-items-start gap-3 mb-3 pb-3 border-bottom">
                        <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="rounded-3" style="width:64px; height:64px; object-fit:cover;">
                        <div class="flex-grow-1">
                            <div class="fw-semibold text-dark">{{ Str::limit($item['name'], 30) }}</div>
                            <div class="text-muted small">Qty: {{ $item['qty'] }} • ৳{{ number_format($item['price'], 2) }}</div>
                        </div>
                        <form action="{{ route('cart.remove') }}" method="POST" class="m-0">
                            @csrf
                            <input type="hidden" name="remove_product_id" value="{{ $item['id'] }}">
                            <button type="submit" class="btn btn-sm p-2" style="border: 1px solid #ff4d24; color: #ff4d24; background: transparent;" aria-label="Remove item">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
            <div class="cart-sidebar-footer pt-3 mt-3 border-top">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Total</span>
                    <strong>৳{{ number_format($cartTotal, 2) }}</strong>
                </div>
                <a href="{{ route('cart.index') }}" class="btn w-100 mb-2" style="background-color: #ff4d24; color: white; border: none;">View Cart</a>
                <a href="{{ route('cart.checkout') }}" class="btn theme-btn w-100" style="background-color: #76bd10; color: white; border: none;">Checkout</a>
            </div>
        @else
            <div class="alert alert-warning mb-4">
                <strong>Your Cart Is Empty !!</strong>
            </div>
            <a href="{{ route('products') }}" class="enroll-btn w-100" data-bs-dismiss="offcanvas">Continue Shopping</a>
        @endif
    </div>
</div>
