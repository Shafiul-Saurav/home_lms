@extends('frontend.layouts.master')

@section('title', $product->name)

@section('frontend_content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-4">
            <!-- Main Image Display with Zoom -->
            <div class="product-image-detail mb-3 position-relative" style="overflow: hidden;">
                @if($product->productImages->first())
                    <img id="mainImage" src="{{ asset('uploads/products/' . $product->productImages->first()->multiple_image) }}"
                         class="img-fluid rounded main-product-image"
                         alt="{{ $product->name }}"
                         data-zoom-image="{{ asset('uploads/products/' . $product->productImages->first()->multiple_image) }}"
                         style="width: 100%; height: 400px; object-fit: cover; cursor: zoom-in;">
                @else
                    <img id="mainImage" src="https://via.placeholder.com/500x500.png?text=No+Image"
                         class="img-fluid rounded main-product-image"
                         alt="{{ $product->name }}"
                         style="width: 100%; height: 400px; object-fit: cover;">
                @endif
            </div>

            <!-- Thumbnail Slider -->
            @if($product->productImages->count() > 1)
            <div class="product-thumbnails mt-2">
                <div class="row g-2">
                    @foreach($product->productImages as $index => $image)
                    <div class="col-3">
                        <img src="{{ asset('uploads/products/' . $image->multiple_image) }}"
                             class="img-thumbnail thumbnail-image {{ $index === 0 ? 'active' : '' }}"
                             alt="{{ $product->name }}"
                             onclick="changeImage('{{ asset('uploads/products/' . $image->multiple_image) }}')"
                             style="cursor: pointer; height: 80px; width: 100%; object-fit: cover; border: 2px solid #ddd;">
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
        <div class="col-md-8">
            <h2>{{ $product->name }}</h2>
            <div class="product-price">
                @if($product->discount_percentage > 0)
                    <span class="new-price"><b>Tk {{ number_format($product->sale_price) }}</b></span>
                    <del class="old-price">Tk {{ number_format($product->regular_price) }}</del>
                    <span class="discount">({{ $product->discount_percentage }}% off)</span>
                @else
                    <span class="price"><b>Tk {{ number_format($product->sale_price) }}</b></span>
                @endif
            </div>
            <div class="mt-3">
                <p>{!! $product->description !!}</p>
            </div>
            <div class="mt-4">
                <button class="btn btn-primary btn-lg" onclick="addToCart({{ $product->id }},'{{ $product->name }}',{{ $product->sale_price }})">
                    Add to Cart
                </button>
                <button class="btn btn-success btn-lg" wire:click="orderNow({{ $product->id }})">
                    Buy Now
                </button>
            </div>
        </div>
    </div>

    <!-- Related Products Section -->
    <div class="row mt-5">
        <div class="col-12">
            <h4>Related Products</h4>
            <div class="row g-3">
                @php
                    $relatedProducts = \App\Models\Product::where('category_id', $product->category_id)
                        ->where('id', '!=', $product->id)
                        ->where('is_active', 1)
                        ->where('is_stock', 1)
                        ->limit(4)
                        ->get();
                @endphp
                @foreach($relatedProducts as $relatedProduct)
                <div class="col-md-3 col-6">
                    <div class="product-card shadow-sm rounded h-100">
                        <div class="product-media position-relative">
                            <a href="{{ route('product.details', $relatedProduct->id) }}">
                                @if($relatedProduct->productImages->first())
                                    <img loading="lazy" src="{{ asset('uploads/products/' . $relatedProduct->productImages->first()->multiple_image) }}" alt="{{ $relatedProduct->name }}" class="img-fluid" style="height: 200px; width: 100%; object-fit: cover;">
                                @else
                                    <img loading="lazy" src="https://via.placeholder.com/200x200.png?text=No+Image" alt="{{ $relatedProduct->name }}" class="img-fluid" style="height: 200px; width: 100%; object-fit: cover;">
                                @endif
                            </a>
                            @if($relatedProduct->discount_percentage > 0)
                                <div class="badge bg-danger position-absolute" style="top: 10px; right: 10px;"><span class="red">-{{ $relatedProduct->discount_percentage }}%</span></div>
                            @endif
                        </div>
                        <div class="product-content p-2">
                            <h6 class="product-name mb-1">
                                <a href="{{ route('product.details', $relatedProduct->id) }}" class="text-decoration-none">{{ substr($relatedProduct->name, 0, 30) }}{{ strlen($relatedProduct->name) > 30 ? '...' : '' }}</a>
                            </h6>
                            <h6 class="product-price mb-0">
                                @if($relatedProduct->discount_percentage > 0)
                                    <span class="new-price fw-bold">Tk {{ number_format($relatedProduct->sale_price) }}</span>
                                    <del class="old-price small text-muted ms-1">Tk {{ number_format($relatedProduct->regular_price) }}</del>
                                @else
                                    <span class="price fw-bold">Tk {{ number_format($relatedProduct->sale_price) }}</span>
                                @endif
                            </h6>
                        </div>
                    </div>
                </div>
                @endforeach

                @if($relatedProducts->count() == 0)
                <div class="col-12">
                    <p class="text-muted text-center">No related products found.</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
function changeImage(imageSrc) {
    const mainImage = document.getElementById('mainImage');
    mainImage.src = imageSrc;
    mainImage.setAttribute('data-zoom-image', imageSrc);

    // Update active class on thumbnails
    const thumbnails = document.querySelectorAll('.thumbnail-image');
    thumbnails.forEach(thumb => thumb.classList.remove('active'));
    event.target.classList.add('active');
}

// Simple zoom effect on hover
document.addEventListener('DOMContentLoaded', function() {
    const mainImage = document.querySelector('.main-product-image');
    if (mainImage) {
        let scale = 1;
        mainImage.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.1)';
            this.style.transition = 'transform 0.3s ease';
        });

        mainImage.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1)';
        });

        mainImage.addEventListener('mousemove', function(e) {
            // Simple pan effect
            const rect = this.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;

            const xPercent = x / rect.width;
            const yPercent = y / rect.height;

            const xOffset = (xPercent - 0.5) * 20;
            const yOffset = (yPercent - 0.5) * 20;

            this.style.transform = `scale(1.1) translate(${xOffset}px, ${yOffset}px)`;
        });
    }
});
</script>

<style>
.thumbnail-image.active {
    border: 2px solid #007bff !important;
    opacity: 1;
}

.thumbnail-image {
    opacity: 0.7;
    transition: opacity 0.3s, border-color 0.3s;
    border: 2px solid #ddd;
}

.thumbnail-image:hover {
    opacity: 1;
    border-color: #007bff !important;
}

.main-product-image {
    transition: transform 0.3s ease;
    display: block;
}

.product-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.15) !important;
}

.product-name a {
    transition: color 0.2s ease;
}

.product-name a:hover {
    color: #007bff !important;
}

@media (max-width: 768px) {
    .main-product-image {
        height: 300px !important;
    }

    .thumbnail-image {
        height: 60px !important;
    }

    .product-card .product-media img {
        height: 150px !important;
    }
}
</style>
@endsection
