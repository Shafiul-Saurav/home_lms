@extends('frontend.layouts.master')

@section('title', 'Home')

@push('frontendstyle')
<style>
    /* Home page specific styles */
    .product-card {
        transition: all 0.3s ease;
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
    }

    .product-card:hover .product-image {
        transform: scale(1.05);
    }

    .product-content {
        padding: 1rem;
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

    .new-slider li {
        margin: 0 10px;
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

    .intro-part {
        background: #f8f9fa;
        padding: 2rem 0;
        margin-top: 2rem;
    }

    .intro-wrap {
        display: flex;
        align-items: center;
        padding: 1rem;
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        transition: transform 0.3s ease;
    }

    .intro-wrap:hover {
        transform: translateY(-5px);
    }

    .intro-icon {
        margin-right: 1rem;
        font-size: 1.5rem;
        color: #684EFF;
    }

    .intro-content h5 {
        font-weight: 600;
        margin-bottom: 0.25rem;
    }

    .intro-content p {
        font-size: 0.9rem;
        color: #666;
        margin: 0;
    }

    /* Home Slider Carousel Styles */
    .home-slider-part {
        position: relative;
    }

    .carousel-indicators button {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background-color: rgba(255, 255, 255, 0.5);
        margin: 0 5px;
        transition: all 0.3s ease;
    }

    .carousel-indicators .active {
        background-color: white;
        transform: scale(1.2);
    }

    @media (max-width: 992px) {
        .home-slider-part .carousel-item {
            height: 200px !important;
        }
    }

    @media (max-width: 768px) {
        .intro-wrap {
            margin-bottom: 1rem;
        }
        
        .home-slider-part .carousel-item {
            height: 175px !important;
        }
    }

    @media (max-width: 576px) {
        .home-slider-part .carousel-item {
            height: 125px !important;
        }
    }
</style>
@endpush

@section('frontend_content')
    <div>
        <!-- Home Slider Carousel -->
        @if($homeSliders && $homeSliders->count() > 0)
        <section class="section home-slider-part mb-4">
            <div id="homeCarousel" class="carousel slide carousel-fade relative" data-bs-ride="carousel">
                <!-- Indicators -->
                <div class="carousel-indicators absolute right-0 bottom-0 left-0 flex justify-center p-0 mb-4">
                    @foreach($homeSliders as $index => $slider)
                    <button
                        type="button"
                        data-bs-target="#homeCarousel"
                        data-bs-slide-to="{{ $index }}"
                        class="{{ $index == 0 ? 'active' : '' }} rounded-full h-3 w-3 bg-white border-0"
                        aria-current="{{ $index == 0 ? 'true' : 'false' }}"
                        aria-label="Slide {{ $index + 1 }}">
                    </button>
                    @endforeach
                </div>

                <!-- Slides -->
                <div class="carousel-inner relative w-full overflow-hidden">
                    @foreach($homeSliders as $index => $slider)
                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }} relative float-left w-full">
                        <div class="relative overflow-hidden bg-cover bg-no-repeat" 
                             style="background-image: url('{{ asset('uploads/home_slider/' . $slider->slider_image) }}'); 
                                    background-size: cover; 
                                    background-position: center;
                                    height: 250px;">
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
        @endif

        <section class="section newitem-part mb-1 bg-white py-5">
            <div class="container mb-3">
                <div class="row">
                    <div class="col-lg-12">
                        <h4>Flash Sale</h4>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col">
                        <ul class="new-slider">
                            @foreach ($products->take(5) as $product)
                                <li>
                                    <div class="product-card shadow-sm rounded-lg">
                                        <div class="product-media">
                                            <a class="product-image" href="{{ route('product.details', $product->id) }}">
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
                                                <a
                                                    href="{{ route('product.details', $product->id) }}">{{ $product->name }}</a>
                                            </h6>
                                            <h6 class="product-price">
                                                <span class="new-price mr-2 bold"><b> Tk
                                                        {{ number_format($product->sale_price) }}</b></span>
                                                @if ($product->discount_percentage > 0)
                                                    <del class="old-price"> Tk
                                                        {{ number_format($product->regular_price) }}</del>
                                                @endif
                                            </h6>
                                            <button class="btn btn-block border-0 w-100 p-1 btn-gradient"
                                                onclick="addToCart({{ $product->id }},'{{ $product->name }}',{{ $product->sale_price }})">
                                                অর্ডার করুন
                                            </button>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <section class="section recent-part mb-4">
            <div class="container mb-3">
                <div class="row">
                    <div class="col-lg-12">
                        <h4>All Products</h4>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-6">
                    @foreach ($products as $product)
                        <div class="col">
                            <div class="product-card shadow-lg">
                                <div class="product-media">
                                    <a class="product-image" href="{{ route('product.details', $product->id) }}">
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
                                        <a href="{{ route('product.details', $product->id) }}">{{ $product->name }}</a>
                                    </h6>
                                    <h6 class="product-price">
                                        <span class="new-price mr-2 bold"><b> Tk
                                                {{ number_format($product->sale_price) }}</b></span>
                                        @if ($product->discount_percentage > 0)
                                            <del class="old-price"> Tk {{ number_format($product->regular_price) }}</del>
                                        @endif
                                    </h6>
                                    <button class="btn btn-block border-0 w-100 p-1 btn-gradient"
                                        onclick="addToCart({{ $product->id }},'{{ $product->name }}',{{ $product->sale_price }})"
                                        wire:click="orderNow({{ $product->id }})">
                                        অর্ডার করুন
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-btn-25 mt-2">
                            <nav role="navigation" aria-label="Pagination Navigation"
                                class="flex items-center justify-between">
                                <div class="flex justify-between flex-1 sm:hidden">
                                    <span
                                        class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md dark:text-gray-600 dark:bg-gray-800 dark:border-gray-600">
                                        &laquo; Previous
                                    </span>


                                    <a href="#"
                                        class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:focus:border-blue-700 dark:active:bg-gray-700 dark:active:text-gray-300">
                                        Next &raquo;
                                    </a>

                                </div>

                                <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                                    <div>
                                        <p class="text-sm text-gray-700 leading-5 dark:text-gray-400">
                                            Showing
                                            <span class="font-medium">1</span> to
                                            <span class="font-medium">{{ $products->count() }}</span>

                                            of
                                            <span class="font-medium">{{ $products->count() }}</span> results
                                        </p>
                                    </div>

                                    <div>
                                        <span class="relative z-0 inline-flex rtl:flex-row-reverse shadow-sm rounded-md">
                                            <span aria-disabled="true" aria-label="&amp;laquo; Previous">
                                                <span
                                                    class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default rounded-l-md leading-5 dark:bg-gray-800 dark:border-gray-600"
                                                    aria-hidden="true">
                                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </span>
                                            </span>
                                            <span aria-current="page">
                                                <span
                                                    class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 dark:bg-gray-800 dark:border-gray-600">1</span>
                                            </span>
                                        </span>
                                    </div>
                                </div>
                            </nav>


                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('frontendscript')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize carousel with custom options
        var carouselElement = document.querySelector('#homeCarousel');
        if (carouselElement) {
            var carousel = new bootstrap.Carousel(carouselElement, {
                interval: 5000, // 5 seconds
                pause: 'hover',
                wrap: true,
                keyboard: true
            });
        }
    });
</script>
@endpush
