@extends('frontend.layouts.master')

@section('title', 'Home')

@section('frontend_content')
    <div>
        <section class="section newitem-part mb-1">
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
                                            <button class="btn btn-block border-0 w-100 p-1"
                                                style="background: linear-gradient(90deg, #8E2EF5 51.99%, #FF5A5A 100%); border: none; color: white; transition: all 0.3s ease;"
                                                onclick="addToCart({{ $product->id }},'{{ $product->name }}',{{ $product->sale_price }})"
                                                onmouseover="this.style.background='linear-gradient(90deg, #7a25d9 51.99%, #e64a4a 100%)'; this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 8px rgba(0,0,0,0.2)';"
                                                onmouseout="this.style.background='linear-gradient(90deg, #8E2EF5 51.99%, #FF5A5A 100%)'; this.style.transform='translateY(0)'; this.style.boxShadow='none';">
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
                                    <button class="btn btn-block border-0 w-100 p-1"
                                        style="background: linear-gradient(90deg, #8E2EF5 51.99%, #FF5A5A 100%); border: none; color: white; transition: all 0.3s ease;"
                                        onclick="addToCart({{ $product->id }},'{{ $product->name }}',{{ $product->sale_price }})"
                                        wire:click="orderNow({{ $product->id }})"
                                        onmouseover="this.style.background='linear-gradient(90deg, #7a25d9 51.99%, #e64a4a 100%)'; this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 8px rgba(0,0,0,0.2)';"
                                        onmouseout="this.style.background='linear-gradient(90deg, #8E2EF5 51.99%, #FF5A5A 100%)'; this.style.transform='translateY(0)'; this.style.boxShadow='none';">
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
