<div class="col-xl-4 col-lg-6">
    <div class="product-card-modern">
        <div class="product-thumb">
            <a href="{{ route('product.details', $product->slug) }}">
                @if(!empty($product->image))
                    <img src="{{ asset('uploads/products/' . $product->image) }}" alt="{{ $product->name }}">
                @elseif($product->productImages->first())
                    <img src="{{ asset('uploads/products/' . $product->productImages->first()->multiple_image) }}" alt="{{ $product->name }}">
                @else
                    <img src="{{ asset('assets/frontend/img/default-product.png') }}" alt="{{ $product->name }}">
                @endif
            </a>
        </div>
        <div class="product-content">
            <span class="text-uppercase" style="font-size:12px;color:#74bd0d;font-weight:700;">{{ $product->category->name ?? 'Uncategorized' }}</span>
            <h3><a href="{{ route('product.details', $product->slug) }}">{{ Str::limit($product->name, 55) }}</a></h3>
            <p class="desc">{{ Str::limit(strip_tags($product->short_description ?? $product->description), 80) }}</p>
            <div class="price-box">
                @if($product->discount_amount && $product->discount_amount > 0)
                    <h4>${{ number_format($product->sell_price - $product->discount_amount, 2) }}</h4>
                    <div class="price-old-row">
                        <del>${{ number_format($product->sell_price, 2) }}</del>
                        <span class="discount">{{ round(($product->discount_amount / max($product->sell_price, 1)) * 100) }}% OFF</span>
                    </div>
                @elseif($product->sell_price > 0)
                    <h4>${{ number_format($product->sell_price, 2) }}</h4>
                @else
                    <h4 class="text-success">Free</h4>
                @endif
            </div>
            <form action="{{ route('cart.add') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="qty" value="1">
                <button type="submit" class="enroll-btn">Add to Cart</button>
            </form>
        </div>
    </div>
</div>
