<div>
    <div class="container py-4">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="mb-4">Search Results for "{{ $searchQuery }}"</h4>

                @if($products->count() > 0)
                    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-6">
                        @foreach ($products as $product)
                            <div class="col mb-4">
                                <div class="product-card shadow-lg h-100">
                                    <div class="product-media">
                                        <a class="product-image" href="{{ route('product.details', $product->slug) }}">
                                            @if ($product->productImages->first())
                                                <img loading="lazy"
                                                    src="{{ asset('uploads/products/' . $product->productImages->first()->multiple_image) }}"
                                                    alt="{{ $product->name }}" />
                                            @else
                                                <img loading="lazy" src="" alt="{{ $product->name }}" />
                                            @endif
                                        </a>
                                        @if ($product->discount_percentage > 0)
                                            <div class="badge bg-danger position-absolute zindex-2"><span
                                                    class="red">-{{ $product->discount_percentage }} %</span></div>
                                        @endif
                                    </div>
                                    <div class="product-content">
                                        <h6 class="product-name">
                                            <a href="{{ route('product.details', $product->slug) }}">{{ $product->name }}</a>
                                        </h6>
                                        <h6 class="product-price">
                                            <span class="new-price mr-2 bold"><b> Tk
                                                    {{ number_format($product->sale_price) }}</b></span>
                                            @if ($product->discount_percentage > 0)
                                                <del class="old-price"> Tk {{ number_format($product->regular_price) }}</del>
                                            @endif
                                        </h6>
                                        @livewire('buy-now-button', ['productId' => $product->id, 'productName' => $product->name, 'price' => $product->sale_price])
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="row mt-4">
                        <div class="col-lg-12">
                            <div class="section-btn-25">
                                {{ $products->links() }}
                            </div>
                        </div>
                    </div>
                @else
                    <div class="alert alert-info text-center">
                        <h5>No products found for "{{ $searchQuery }}"</h5>
                        <p>Try searching with different keywords.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <style>
        .product-card {
            transition: all 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
        }

        .product-media {
            position: relative;
            overflow: hidden;
        }

        .product-image {
            transition: transform 0.3s ease;
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
    </style>

    <script>
        function addToCart(productId, productName, productPrice) {
            // Add to cart functionality
            // This is just a placeholder - implement according to your cart system
            alert('Added ' + productName + ' to cart');
        }
    </script>
</div>
