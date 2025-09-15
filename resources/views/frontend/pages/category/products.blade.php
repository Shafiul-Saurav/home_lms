@extends('frontend.layouts.master')

@section('title', $category->name . ' Products')

@push('frontendstyle')
<style>
    /* Category page specific styles */
    .product-card {
        transition: all 0.3s ease;
        border-radius: 0.5rem;
    }

    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }

    .product-media {
        position: relative;
        overflow: hidden;
    }

    .product-image {
        transition: transform 0.3s ease;
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .product-card:hover .product-image {
        transform: scale(1.05);
    }

    .product-name a {
        color: #333;
        text-decoration: none;
        font-weight: 600;
        transition: color 0.2s ease;
    }

    .product-name a:hover {
        color: #684EFF;
    }

    .product-price {
        margin: 0.5rem 0;
        font-size: 1.1rem;
    }

    .new-price {
        color: #684EFF;
        font-weight: 700;
    }

    .old-price {
        color: #999;
        text-decoration: line-through;
        font-size: 0.9rem;
    }

    .section {
        margin-bottom: 2rem;
    }

    .section h4 {
        font-weight: 700;
        color: #333;
        margin-bottom: 1rem;
        position: relative;
        padding-bottom: 10px;
    }

    .section h4:after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 50px;
        height: 3px;
        background: #684EFF;
        border-radius: 3px;
    }

    .btn-gradient {
        background: linear-gradient(to right, #684EFF, #8A6CFF);
        color: white;
        border: none;
        transition: all 0.3s ease;
    }

    .btn-gradient:hover {
        background: linear-gradient(to right, #5A3CE0, #7B5CE0);
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    @media (max-width: 768px) {
        .product-card {
            margin-bottom: 1rem;
        }
    }
</style>
@endpush

@section('frontend_content')
<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <section class="section">
                <div class="container mb-3">
                    <div class="row">
                        <div class="col-lg-12">
                            <h4>{{ $category->name }} Products</h4>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row g-4">
                        @forelse($products as $product)
                        <div class="col-md-3 col-6 col-lg-2">
                            <div class="product-card shadow-sm rounded-lg">
                                <div class="product-media">
                                    <a class="product-image" href="{{ route('product.details', $product->id) }}">
                                        @if($product->productImages->first())
                                            <img loading="lazy" src="{{ asset('uploads/products/' . $product->productImages->first()->multiple_image) }}" alt="{{ $product->name }}" class="product-image" />
                                        @else
                                            <img loading="lazy" src="https://via.placeholder.com/300x300.png?text=No+Image" alt="{{ $product->name }}" class="product-image" />
                                        @endif
                                    </a>
                                    @if($product->discount_percentage > 0)
                                        <div class="badge bg-danger position-absolute zindex-2"><span class="red">-{{ $product->discount_percentage }} %</span></div>
                                    @endif
                                </div>
                                <div class="product-content">
                                    <h6 class="product-name">
                                        <a href="{{ route('product.details', $product->id) }}">{{ $product->name }}</a>
                                    </h6>
                                    <h6 class="product-price">
                                        <span class="new-price mr-2 bold"><b> Tk {{ number_format($product->sale_price) }}</b></span>
                                        @if($product->discount_percentage > 0)
                                            <del class="old-price"> Tk {{ number_format($product->regular_price) }}</del>
                                        @endif
                                    </h6>
                                    <button class="btn btn-block border-0 w-100 p-1 btn-gradient"
                                        onclick="addToCart({{ $product->id }},'{{ $product->name }}',{{ $product->sale_price }})">
                                        অর্ডার করুন
                                    </button>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="col-12">
                            <p class="text-muted text-center">No products found in this category.</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </section>

            <!-- Pagination -->
            @if($products->hasPages())
            <div class="row mt-4">
                <div class="col-12 d-flex justify-content-center">
                    {{ $products->links() }}
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('frontendscript')
<script>
    // Add any specific JavaScript for the category page if needed
</script>
@endpush
