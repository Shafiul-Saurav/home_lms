@extends('frontend.layouts.master')

@section('title', $category->name . ' Products')

@section('frontend_content')
<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <h2>{{ $category->name }} Products</h2>
            <div class="row g-4">
                @forelse($products as $product)
                <div class="col-md-3 col-6">
                    <div class="product-card shadow-sm rounded h-100">
                        <div class="product-media position-relative">
                            <a href="{{ route('product.details', $product->id) }}">
                                @if($product->productImages->first())
                                    <img loading="lazy" src="{{ asset('uploads/products/' . $product->productImages->first()->multiple_image) }}" alt="{{ $product->name }}" class="img-fluid" style="height: 200px; width: 100%; object-fit: cover;">
                                @else
                                    <img loading="lazy" src="https://via.placeholder.com/200x200.png?text=No+Image" alt="{{ $product->name }}" class="img-fluid" style="height: 200px; width: 100%; object-fit: cover;">
                                @endif
                            </a>
                            @if($product->discount_percentage > 0)
                                <div class="badge bg-danger position-absolute" style="top: 10px; right: 10px;">
                                    <span class="red">-{{ $product->discount_percentage }}%</span>
                                </div>
                            @endif
                        </div>
                        <div class="product-content p-2">
                            <h6 class="product-name mb-1">
                                <a href="{{ route('product.details', $product->id) }}" class="text-decoration-none">
                                    {{ substr($product->name, 0, 30) }}{{ strlen($product->name) > 30 ? '...' : '' }}
                                </a>
                            </h6>
                            <h6 class="product-price mb-0">
                                @if($product->discount_percentage > 0)
                                    <span class="new-price fw-bold">Tk {{ number_format($product->sale_price) }}</span>
                                    <del class="old-price small text-muted ms-1">Tk {{ number_format($product->regular_price) }}</del>
                                @else
                                    <span class="price fw-bold">Tk {{ number_format($product->sale_price) }}</span>
                                @endif
                            </h6>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <p class="text-muted text-center">No products found in this category.</p>
                </div>
                @endforelse
            </div>
            
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