<div class="col-xl-4 col-lg-6 col-md-6 col-6 px-1 px-md-2">
    <div class="course-card-modern">
        <div class="course-thumb">
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
        <div class="course-content">
            <span class="text-uppercase" style="font-size: 12px; font-weight: 700; color: #ff4d24; display: block; margin-bottom: 6px;">{{ $product->category->name ?? 'Uncategorized' }}</span>
            <h3><a href="{{ route('product.details', $product->slug) }}">{{ Str::limit($product->name, 55) }}</a></h3>
            <p class="desc">{{ Str::limit(strip_tags($product->short_description ?? $product->description), 50) }}</p>

            <div class="course-bottom">
                <div class="price-box">
                    @if($product->discount_amount && $product->discount_amount > 0)
                        @php
                            if(strtolower(trim($product->discount_type)) === 'percentage') {
                                $discountPercentage = $product->discount_amount;
                                $finalPrice = $product->sell_price * (1 - $discountPercentage / 100);
                            } else {
                                $finalPrice = $product->sell_price - $product->discount_amount;
                                $discountPercentage = round(($product->discount_amount / max($product->sell_price, 1)) * 100);
                            }
                        @endphp
                        <h4>{{ number_format($finalPrice) }} Tk</h4>
                        <div class="price-old-row">
                            <del>{{ number_format($product->sell_price) }} Tk</del>
                            <span class="discount">{{ $discountPercentage }}% OFF</span>
                        </div>
                    @elseif($product->sell_price > 0)
                        <h4>{{ number_format($product->sell_price) }} Tk</h4>
                    @else
                        <h4>Free</h4>
                    @endif
                </div>
                <form action="{{ route('cart.add') }}" method="POST" class="m-0">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="qty" value="1">
                    <button type="submit" class="enroll-btn border-0">
                        Add to Cart
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
