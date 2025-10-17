@extends('frontend.layouts.master')

@section('title', $seoData['title'] ?? $product->name)

@section('meta_description', $seoData['description'] ?? $product->name)

@section('meta_keywords', $seoData['keywords'] ?? 'Online Shopping In Bangladesh With Home Delivery')

@section('canonical_url', $seoData['canonicalUrl'] ?? route('product.details', $product->slug))

@section('og_type', 'product')
@section('og_url', $seoData['ogData']['url'] ?? route('product.details', $product->slug))
@section('og_title', $seoData['ogData']['title'] ?? $product->name)
@section('og_description', $seoData['ogData']['description'] ?? $product->name)
@section('og_image', $seoData['ogData']['image'] ?? asset('uploads/logos/default.png'))

@section('structured_data')
    {!! json_encode($seoData['structuredData'] ?? []) !!}
@endsection

@push('frontendstyle')
    <style>
        .fa-chevron-right:before {
            color: white;
        }

        .fa-chevron-left:before {
            color: white;
        }

        .details-preview li {
            display: grid;
            place-items: center;
            aspect-ratio: 1/1;
            width: 100%;
        }

        .details-preview li img {
            max-width: 100%;
            max-height: 100%;
            width: 100%;
            height: 100%;
            object-fit: contain;
            aspect-ratio: 1/1;
        }

        /* Ensure main image fills container on mobile */
        @media (max-width: 768px) {
            .details-preview li {
                place-items: stretch;
            }

            .details-preview li img {
                object-fit: contain;
                width: 100%;
                height: 100%;
            }
        }

        .details-thumb li {
            aspect-ratio: 1/1;
            padding: 5px;
            cursor: pointer;
        }

        .details-thumb li img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border: 1px solid #684EFF;
        }

        /* Responsive thumbnail sizing for mobile */
        @media (max-width: 768px) {
            .details-thumb li {
                width: 70px !important;
                height: 70px !important;
                min-width: 70px !important;
                min-height: 70px !important;
            }
        }

        @media (max-width: 576px) {
            .details-thumb li {
                width: 60px !important;
                height: 60px !important;
                min-width: 60px !important;
                min-height: 60px !important;
            }
        }

        @media (max-width: 400px) {
            .details-thumb li {
                width: 50px !important;
                height: 50px !important;
                min-width: 50px !important;
                min-height: 50px !important;
                padding: 3px;
            }

            .details-thumb {
                margin-top: 10px;
            }
        }

        .details-thumb li.slick-current img {
            border-color: red;
        }

        /* Slick slider arrows customization */
        .details-preview .slick-prev,
        .details-preview .slick-next {
            width: 40px;
            height: 40px;
            background: #684eff;
            border-radius: 50%;
            z-index: 10;
        }

        .details-preview .slick-prev:before,
        .details-preview .slick-next:before {
            color: white;
            font-size: 20px;
        }

        .details-preview .slick-prev {
            left: 10px;
        }

        .details-preview .slick-next {
            right: 10px;
        }

        .details-thumb .slick-prev,
        .details-thumb .slick-next {
            width: 30px;
            height: 30px;
            background: #684eff;
            border-radius: 50%;
            z-index: 10;
        }

        .details-thumb .slick-prev:before,
        .details-thumb .slick-next:before {
            color: white;
            font-size: 16px;
        }

        .details-thumb .slick-prev {
            left: 5px;
        }

        .details-thumb .slick-next {
            right: 5px;
        }

        /* Ensure proper spacing for thumbnails */
        .details-thumb {
            margin-top: 15px;
            margin-left: 40px;
            margin-right: 40px;
        }

        .details-preview {
            margin-left: 40px;
            margin-right: 40px;
        }

        .details-thumb-wrapper {
            position: relative;
            margin-top: 15px;
        }

        .details-thumb {
            margin: 0;
        }

        /* Slick slider arrows customization for wrapper */
        .details-preview-wrapper {
            position: relative;
        }

        .details-preview-wrapper .slick-prev,
        .details-preview-wrapper .slick-next {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 40px;
            height: 40px;
            background: #684eff;
            border-radius: 50%;
            z-index: 10;
            border: none;
            cursor: pointer;
        }

        .details-preview-wrapper .slick-prev:before,
        .details-preview-wrapper .slick-next:before {
            color: white;
            font-size: 20px;
            font-family: 'Font Awesome 5 Free';
            font-weight: 900;
            display: inline-block;
        }

        .details-preview-wrapper .slick-prev {
            left: 10px;
        }

        .details-preview-wrapper .slick-next {
            right: 10px;
        }

        /* Mobile main image navigation arrows */
        .details-preview-container {
            position: relative;
        }

        .thumb-nav.main-image-prev,
        .thumb-nav.main-image-next {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 40px;
            height: 40px;
            background: #684eff;
            border-radius: 50%;
            z-index: 15;
            border: none;
            cursor: pointer;
        }

        .thumb-nav.main-image-prev:before,
        .thumb-nav.main-image-next:before {
            color: white;
            font-size: 20px;
            font-family: 'Font Awesome 5 Free';
            font-weight: 900;
            display: inline-block;
        }

        .thumb-nav.main-image-prev {
            left: 10px;
        }

        .thumb-nav.main-image-next {
            right: 10px;
        }

        .thumb-nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: #684eff;
            border: none;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 10;
        }

        .thumb-nav i {
            color: white;
            font-size: 16px;
        }

        .thumb-nav:disabled {
            background: #684eff;
            cursor: not-allowed;
        }

        .thumb-prev {
            left: 5px;
        }

        .thumb-next {
            right: 5px;
        }

        .details-thumb-wrapper .slick-prev,
        .details-thumb-wrapper .slick-next {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 30px;
            height: 30px;
            background: #684eff;
            border-radius: 50%;
            z-index: 10;
            border: none;
            cursor: pointer;
        }

        .details-thumb-wrapper .slick-prev:before,
        .details-thumb-wrapper .slick-next:before {
            color: white;
            font-size: 16px;
            font-family: 'Font Awesome 5 Free';
            font-weight: 900;
            display: inline-block;
        }

        .details-thumb-wrapper .slick-prev {
            left: 5px;
        }

        .details-thumb-wrapper .slick-next {
            right: 5px;
        }

        /* Make sure slick arrows are visible and properly colored */
        .slick-prev,
        .slick-next {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            z-index: 10;
            background: #684eff;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            border: none;
        }

        .slick-prev:before,
        .slick-next:before {
            color: white;
            font-family: 'Font Awesome 5 Free';
            font-weight: 900;
            font-size: 20px;
        }

        .slick-prev {
            left: 10px;
        }

        .slick-next {
            right: 10px;
        }

        .slick-prev:hover,
        .slick-next:hover {
            background: #5a3ce0;
        }

        .slick-disabled {
            opacity: 0.5;
            pointer-events: none;
        }

        /* Mobile touch fixes */
        @media (max-width: 768px) {
            .details-gallery {
                touch-action: pan-y;
                /* Allow vertical scrolling only */
                position: relative;
                z-index: 10;
            }

            .details-thumb-container {
                touch-action: pan-x;
                /* Allow horizontal scrolling only for thumbnails */
                -webkit-overflow-scrolling: touch;
                position: relative;
                z-index: 11;
            }

            .thumb-item {
                -webkit-touch-callout: none;
                -webkit-user-select: none;
                -khtml-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
                position: relative;
                z-index: 12;
            }

            /* Lock gallery positioning */
            .details-preview-container {
                position: relative;
                z-index: 9;
                touch-action: pan-y;
                /* Allow vertical scrolling */
            }

            /* Prevent gallery from moving */
            .details-gallery,
            .details-preview-container,
            .details-thumb-container {
                -webkit-transform: translateZ(0);
                -moz-transform: translateZ(0);
                -ms-transform: translateZ(0);
                -o-transform: translateZ(0);
                transform: translateZ(0);
                -webkit-backface-visibility: hidden;
                -moz-backface-visibility: hidden;
                -ms-backface-visibility: hidden;
                backface-visibility: hidden;
                -webkit-perspective: 1000;
                -moz-perspective: 1000;
                -ms-perspective: 1000;
                perspective: 1000;
            }

            /* Mobile main image navigation arrows */
            .details-preview-container {
                position: relative;
            }

            .thumb-nav.main-image-prev,
            .thumb-nav.main-image-next {
                position: absolute;
                top: 50%;
                transform: translateY(-50%);
                width: 40px;
                height: 40px;
                background: #684eff;
                border-radius: 50%;
                z-index: 15;
                border: none;
                cursor: pointer;
            }

            .thumb-nav.main-image-prev:before,
            .thumb-nav.main-image-next:before {
                color: white;
                font-size: 20px;
                font-family: 'Font Awesome 5 Free';
                font-weight: 900;
                display: inline-block;
            }

            .thumb-nav.main-image-prev {
                left: 10px;
            }

            .thumb-nav.main-image-next {
                right: 10px;
            }

            /* Mobile thumbnail navigation arrows */
            .details-thumb-wrapper {
                display: flex;
                align-items: center;
                gap: 10px;
                margin-top: 15px;
            }

            .thumb-prev,
            .thumb-next {
                position: relative;
                transform: none;
                width: 30px;
                height: 30px;
                flex-shrink: 0;
            }

            /* But keep main image arrows absolutely positioned */
            .thumb-nav.main-image-prev,
            .thumb-nav.main-image-next {
                position: absolute !important;
                top: 50% !important;
                transform: translateY(-50%) !important;
                width: 40px;
                height: 40px;
                background: #684eff;
                border-radius: 50%;
                z-index: 15;
                border: none;
                cursor: pointer;
            }

            .details-thumb-container {
                flex: 1;
            }
        }

        /* Custom Gallery CSS - replaces Slick slider for mobile */
        @media (max-width: 768px) {
            .details-preview-container {
                display: grid;
                place-items: center;
                aspect-ratio: 1/1;
                width: 100%;
                position: relative;
                overflow: hidden;
            }

            .preview-item {
                display: none;
                max-width: 100%;
                max-height: 100%;
                width: 100%;
                height: 100%;
                object-fit: contain;
                aspect-ratio: 1/1;
                position: absolute;
                top: 0;
                left: 0;
            }

            .preview-item.active {
                display: block;
            }

            .preview-item img,
            .preview-item video {
                max-width: 100%;
                max-height: 100%;
                width: 100%;
                height: 100%;
                object-fit: contain;
                aspect-ratio: 1/1;
            }

            .details-thumb-wrapper {
                display: flex;
                align-items: center;
                gap: 10px;
                margin-top: 15px;
            }

            .details-thumb-container {
                display: flex;
                flex-wrap: nowrap;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
                gap: 10px;
                padding: 5px 0;
                flex: 1;
            }

            .thumb-item {
                aspect-ratio: 1/1;
                min-width: 70px;
                width: 70px;
                height: 70px;
                cursor: pointer;
                border: 2px solid transparent;
                flex-shrink: 0;
            }

            .thumb-item img {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }

            .thumb-item.active {
                border-color: red;
            }

            .thumb-nav {
                background: #684eff;
                border: none;
                border-radius: 50%;
                width: 30px;
                height: 30px;
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                flex-shrink: 0;
            }

            .thumb-nav i {
                color: white;
                font-size: 16px;
            }

            .thumb-nav:disabled {
                background: #684eff;
                cursor: not-allowed;
            }

            .details-thumb-container {
                touch-action: pan-x;
                /* Allow horizontal scrolling only */
                -webkit-overflow-scrolling: touch;
                position: relative;
                z-index: 11;
            }

            .thumb-item {
                -webkit-touch-callout: none;
                -webkit-user-select: none;
                -khtml-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
                position: relative;
                z-index: 12;
            }
        }

        .slick-prev:hover,
        .slick-next:hover {
            background: #5a3ce0;
        }

        .slick-prev:before,
        .slick-next:before {
            font-family: 'Font Awesome 5 Free';
            font-weight: 900;
            display: inline-block;
        }

        .slick-disabled {
            opacity: 0.5;
            pointer-events: none;
        }

        /* Related Products Section Styles */
        .related-products-section {
            background-color: #f8f9fa;
            padding: 2rem 0;
        }

        .section-title {
            font-weight: 700;
            color: #333;
            margin-bottom: 1rem;
            position: relative;
            padding-bottom: 10px;
        }

        .section-title:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 3px;
            background: #684EFF;
            border-radius: 3px;
        }

        .product-card {
            transition: all 0.3s ease;
            background: #fff;
            border-radius: 0.5rem;
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
            display: block;
            height: 200px;
            overflow: hidden;
        }

        .product-image img {
            transition: transform 0.3s ease;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .product-card:hover .product-image img {
            transform: scale(1.05);
        }

        .product-name a {
            color: #333;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s ease;
            display: block;
            min-height: 2.5em;
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
@endpush

@section('frontend_content')
    <!-- Debug: Check if relatedProducts variable exists and its count -->
    <?php
    if (isset($relatedProducts)) {
        \Log::info('Related products variable exists with count: ' . $relatedProducts->count());
    } else {
        \Log::info('Related products variable does not exist');
    }
    ?>

    <!-- Product Details Section -->
    <section class="inner-section mb-5 mt-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="details-gallery">
                        <!-- Desktop gallery (Slick slider) -->
                        <div class="details-preview-wrapper d-none d-md-block">
                            <button type="button" class="thumb-nav thumb-prev slick-prev main-image-prev">
                                <i class="fas fa-chevron-left"></i>
                            </button>
                            <ul class="details-preview mb-1" wire:ignore>
                                @if ($product->video)
                                    <li>
                                        <video controls autoplay muted
                                            style="width: 100%; height: 100%; object-fit: contain;" preload="auto">
                                            <source src="{{ asset('uploads/products') }}/{{ $product->video }}"
                                                type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                    </li>
                                @endif
                                @if ($product->image && $product->image != 'default_product.jpg')
                                    <li>
                                        <img loading="lazy" src="{{ asset('uploads/products/' . $product->image) }}"
                                            alt="{{ $product->name }}">
                                    </li>
                                @endif
                                @foreach ($product->productImages as $image)
                                    <li>
                                        <img loading="lazy" src="{{ asset('uploads/products/' . $image->multiple_image) }}"
                                            alt="{{ $product->name }}">
                                    </li>
                                @endforeach
                            </ul>
                            <button type="button" class="thumb-nav thumb-next slick-next main-image-next">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                        </div>
                        <div class="details-thumb-wrapper d-none d-md-block">
                            <button type="button" class="thumb-nav thumb-prev slick-prev">
                                <i class="fas fa-chevron-left"></i>
                            </button>
                            <ul class="details-thumb mb-1">
                                @if ($product->video)
                                    <li>
                                        <div
                                            style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; background: #f0f0f0;">
                                            <i class="fas fa-video" style="font-size: 24px; color: #684EFF;"></i>
                                        </div>
                                    </li>
                                @endif
                                @if ($product->image && $product->image != 'default_product.jpg')
                                    @php
                                        $mainImagePath = $product->image;
                                        $isMainWebP = pathinfo($mainImagePath, PATHINFO_EXTENSION) === 'webp';
                                    @endphp
                                    <li>
                                        <img loading="lazy" src="{{ asset('uploads/products') }}/{{ $mainImagePath }}"
                                            alt="{{ $product->name }}"
                                            @if ($isMainWebP) style="width:100%; height:100%; object-fit:cover;" @endif>
                                    </li>
                                @endif
                                @foreach ($product->productImages as $image)
                                    @php
                                        $imagePath = $image->multiple_image;
                                        $isWebP = pathinfo($imagePath, PATHINFO_EXTENSION) === 'webp';
                                    @endphp
                                    <li>
                                        <img loading="lazy" src="{{ asset('uploads/products') }}/{{ $imagePath }}"
                                            alt="{{ $product->name }}"
                                            @if ($isWebP) style="width:100%; height:100%; object-fit:cover;" @endif>
                                    </li>
                                @endforeach
                            </ul>
                            <button type="button" class="thumb-nav thumb-next slick-next">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                        </div>

                        <!-- Mobile gallery (custom) -->
                        <div class="mobile-gallery-wrapper d-md-none">
                            <button class="thumb-nav thumb-prev main-image-prev" aria-label="Previous image">
                                <i class="fas fa-chevron-left"></i>
                            </button>
                            <div class="details-preview-container mb-1">
                                @if ($product->video)
                                    @php
                                        $videoIndex = 0;
                                        $shouldVideoBeActive = true; // Video is first item, so it should be active
                                    @endphp
                                    <div class="preview-item {{ $shouldVideoBeActive ? 'active' : '' }}" data-index="{{ $videoIndex }}">
                                        <video controls autoplay muted style="width: 100%; height: 100%; object-fit: contain;"
                                            preload="auto">
                                            <source src="{{ asset('uploads/products') }}/{{ $product->video }}"
                                                type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                    </div>
                                @endif
                                @if ($product->image && $product->image != 'default_product.jpg')
                                    @php
                                        $mainImagePath = $product->image;
                                        $isMainWebP = pathinfo($mainImagePath, PATHINFO_EXTENSION) === 'webp';
                                        $imageIndex = $product->video ? 1 : 0;
                                        $shouldImageBeActive = (!$product->video && $imageIndex == 0); // Image should be active only if there's no video and it's the first item
                                    @endphp
                                    <div class="preview-item {{ $shouldImageBeActive ? 'active' : '' }}"
                                        data-index="{{ $imageIndex }}">
                                        <img loading="lazy" src="{{ asset('uploads/products/' . $mainImagePath) }}"
                                            alt="{{ $product->name }}">
                                    </div>
                                @endif
                                @foreach ($product->productImages as $index => $image)
                                    @php
                                        $imagePath = $image->multiple_image;
                                        $isWebP = pathinfo($imagePath, PATHINFO_EXTENSION) === 'webp';
                                        $additionalImageIndex =
                                            ($product->video ? 1 : 0) +
                                            ($product->image && $product->image != 'default_product.jpg' ? 1 : 0) +
                                            $index;
                                        // Additional images should never be active by default
                                        $shouldAdditionalImageBeActive = false;
                                    @endphp
                                    <div class="preview-item {{ $shouldAdditionalImageBeActive ? 'active' : '' }}"
                                        data-index="{{ $additionalImageIndex }}">
                                        <img loading="lazy" src="{{ asset('uploads/products/' . $imagePath) }}"
                                            alt="{{ $product->name }}">
                                    </div>
                                @endforeach
                            </div>
                            <button class="thumb-nav thumb-next main-image-next" aria-label="Next image">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                        </div>
                        <div class="details-thumb-wrapper d-md-none">
                            <button class="thumb-nav thumb-prev" aria-label="Previous thumbnails">
                                <i class="fas fa-chevron-left"></i>
                            </button>
                            <div class="details-thumb-container mb-1">
                                @if ($product->video)
                                    @php
                                        $videoIndex = 0;
                                        $shouldVideoBeActive = true; // Video is first item, so it should be active
                                    @endphp
                                    <div class="thumb-item {{ $shouldVideoBeActive ? 'active' : '' }}" data-target="{{ $videoIndex }}">
                                        <div
                                            style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; background: #f0f0f0;">
                                            <i class="fas fa-video" style="font-size: 24px; color: #684EFF;"></i>
                                        </div>
                                    </div>
                                @endif
                                @if ($product->image && $product->image != 'default_product.jpg')
                                    @php
                                        $mainImagePath = $product->image;
                                        $isMainWebP = pathinfo($mainImagePath, PATHINFO_EXTENSION) === 'webp';
                                        $imageIndex = $product->video ? 1 : 0;
                                        $shouldImageBeActive = (!$product->video && $imageIndex == 0); // Image should be active only if there's no video and it's the first item
                                    @endphp
                                    <div class="thumb-item {{ $shouldImageBeActive ? 'active' : '' }}"
                                        data-target="{{ $imageIndex }}">
                                        <img loading="lazy" src="{{ asset('uploads/products') }}/{{ $mainImagePath }}"
                                            alt="{{ $product->name }}"
                                            @if ($isMainWebP) style="width:100%; height:100%; object-fit:cover;" @endif>
                                    </div>
                                @endif
                                @foreach ($product->productImages as $index => $image)
                                    @php
                                        $imagePath = $image->multiple_image;
                                        $isWebP = pathinfo($imagePath, PATHINFO_EXTENSION) === 'webp';
                                        $additionalImageIndex =
                                            ($product->video ? 1 : 0) +
                                            ($product->image && $product->image != 'default_product.jpg' ? 1 : 0) +
                                            $index;
                                        // Additional images should never be active by default
                                        $shouldAdditionalImageBeActive = false;
                                    @endphp
                                    <div class="thumb-item {{ $shouldAdditionalImageBeActive ? 'active' : '' }}"
                                        data-target="{{ $additionalImageIndex }}">
                                        <img loading="lazy" src="{{ asset('uploads/products') }}/{{ $imagePath }}"
                                            alt="{{ $product->name }}"
                                            @if ($isWebP) style="width:100%; height:100%; object-fit:cover;" @endif>
                                    </div>
                                @endforeach
                            </div>
                            <button class="thumb-nav thumb-next" aria-label="Next thumbnails">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="details-content">
                        <h4 class="details-name">{{ $product->name }}</h4>

                        <h3 class="details-price">
                            @if ($product->discount_percentage > 0)
                                <span class="new-price mr-2 bold"><b>Tk
                                        {{ number_format($product->sale_price) }}</b></span>
                                <del class="old-price">Tk {{ number_format($product->regular_price) }}</del>
                            @else
                                <span class="price mr-2 bold"><b>Tk {{ number_format($product->sale_price) }}</b></span>
                            @endif
                        </h3>

                        <div class="mb-2">
                            <!-- Stock status could be added here if available -->
                        </div>

                        @livewire('buy-now-button', ['productId' => $product->id, 'productName' => $product->name, 'price' => $product->sale_price])
                        <button
                            onclick="addToCart({{ $product->id }}, '{{ addslashes($product->name) }}', {{ $product->sale_price }})"
                            class="btn-block w-100 btn btn-primary bg-primary text-white border-0 p-2 mt-2">
                            <i class="fas fa-shopping-cart"></i> কার্টে যোগ করুন
                        </button>

                        <a href="tel:{{ $website_link->number ?? '01859084364' }}"
                            class="btn btn-info btn-block w-100 border-0 p-2 mb-2 mt-2">
                            <i class="fa fa-phone-alt"></i> কল করুন : {{ $website_link->number ?? '01859084364' }}
                        </a>

                        <div class="mt-2 mb-3">
                            <span style="color: rgb(255, 0, 0);">
                                বিঃদ্রঃ- ছবি এবং বর্ণনার সাথে পণ্যের মিল থাকা সত্যেও আপনি পণ্য গ্রহন করতে না চাইলে কুরিয়ার
                                চার্জ 150 টাকা কুরিয়ার ডেলিভারি ম্যানকে প্রদান করে পণ্য সাথে সাথে রিটার্ন করবেন। পরে কোন
                                কমপ্লেইন/রিটার্ন গ্রহণযোগ্য নয়!
                            </span>
                        </div>

                        <div class="details-meta">
                            <h6>Product Category: <span>{!! $product->category->name ?? 'N/A' !!}</span></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="inner-section mb-5 product-details-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="nav nav-tabs justify-content-start">
                        <li><a href="#tab-desc" class="tab-link active" data-bs-toggle="tab">পণ্যের বিস্তারিত</a></li>
                        <li><a href="#tab-spec" class="tab-link" data-bs-toggle="tab">ডেলিভারি এবং রিটার্ন পলিসি</a></li>
                        <li><a href="#tab-review" class="tab-link" data-bs-toggle="tab">রিভিউ</a></li>
                    </ul>
                    <hr class="m-0">

                    <div class="tab-content">
                        <div class="tab-pane fade active show p-3 bg-white" id="tab-desc">
                            {!! $product->description !!}
                        </div>

                        <div class="tab-pane fade p-3 bg-white" id="tab-spec">
                            <ul>
                                <li>আপনার যত প্রশ্ন আছে তা বর্ননার সাথে মিলিয়ে অথবা আমাদের কাছ থেকে জেনে পন্য অর্ডার করুন।
                                </li>
                                <li>ছবি এবং বর্ণনার সাথে পন্যের মিল থাকলে পণ্য ফেরত নেয়া হবে না ।</li>
                                <li>তবে আপনি চাইলে আপনার গ্রহন করা পন্যের সম মুল্যের কি বা বেশি মুল্যের পণ্য নিতে পারবেন (যে
                                    টাকা বেশি হবে তা প্রদান করতে হবে ) ।</li>
                                <li>কম মুল্যের পণ্য নেয়া যাবে না ।</li>
                                <li>পণ্য আনা নেয়ার খরচ আপনাকে দিতে হবে।</li>
                                <li>যে সকল পন্যে ওয়ারেন্টি আছে তার ওয়ারেন্টি সার্ভিস আমরা প্রদান করবো।তবে কিছু কিছু
                                    ক্ষেত্রে পন্যের ব্রান্ড আপনাকে সার্ভিস প্রদান করবে তবে সে ক্ষেত্রে আপনার নিকটস্থ সার্ভিস
                                    পয়েন্ট থেকে সার্ভিস নিতে পারবেন।</li>
                                <li>পণ্য সার্ভিস করতে যাওয়া আসা বা পাঠানো এবং রিটার্ন করার খরজ আপনাকে বহন করতে হবে।</li>
                            </ul>
                        </div>

                        <div class="tab-pane fade p-3 bg-white" id="tab-review">
                            <!-- Reviews section - can be implemented later -->
                            <p>রিভিউ সংযুক্ত করা হবে।</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Products Section -->
    <section class="section newitem-part mb-4 related-products-section">
        <div class="container mb-3">
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="section-title">Related Products</h4>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                @forelse ($relatedProducts as $product)
                    <div class="col-xl-2 col-lg-3 col-md-4 col-6 mb-4">
                        <div class="product-card shadow-sm">
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
                                    <a
                                        href="{{ route('product.details', $product->slug) }}">{{ Str::limit($product->name, 40) }}</a>
                                </h6>
                                <h6 class="product-price">
                                    <span class="new-price mr-2 bold"><b> Tk
                                            {{ number_format($product->sale_price) }}</b></span>
                                    @if ($product->discount_percentage > 0)
                                        <del class="old-price"> Tk
                                            {{ number_format($product->regular_price) }}</del>
                                    @endif
                                </h6>
                                @livewire('buy-now-button', ['productId' => $product->id, 'productName' => $product->name, 'price' => $product->sale_price])
                            </div>
                        </div>
                    </div>
                @empty
                @endforelse
            </div>
        </div>
    </section>
@endsection

@push('frontendscript')
    <script>
        // Store video states to remember playback positions
        var videoStates = {};

        // Custom gallery navigation for mobile devices
        function initializeCustomMobileGallery() {
            // Check if we're on a mobile device
            var isMobile = /Mobi|Android/i.test(navigator.userAgent);

            if (isMobile) {
                // Add click handlers for thumbnails
                $('.thumb-item').on('click touch', function(e) {
                    e.preventDefault();
                    e.stopPropagation();

                    var targetIndex = $(this).data('target');

                    // Remove active class from all items
                    $('.thumb-item').removeClass('active');
                    $('.preview-item').removeClass('active');

                    // Add active class to clicked thumbnail
                    $(this).addClass('active');

                    // Show corresponding preview item
                    $('.preview-item[data-index="' + targetIndex + '"]').addClass('active');

                    return false;
                });

                // Add click handlers for main image navigation arrows
                $('.main-image-prev').on('click touch', function(e) {
                    e.preventDefault();
                    e.stopPropagation();

                    var $activeItem = $('.preview-item.active');
                    var currentIndex = parseInt($activeItem.data('index'));
                    var prevIndex = currentIndex - 1;

                    // If we're at the first item, go to the last item
                    if (prevIndex < 0) {
                        var lastIndex = $('.preview-item').length - 1;
                        prevIndex = lastIndex;
                    }

                    // Remove active class from all items
                    $('.preview-item').removeClass('active');
                    $('.thumb-item').removeClass('active');

                    // Show previous item
                    $('.preview-item[data-index="' + prevIndex + '"]').addClass('active');

                    // Update active thumbnail
                    $('.thumb-item[data-target="' + prevIndex + '"]').addClass('active');

                    return false;
                });

                $('.main-image-next').on('click touch', function(e) {
                    e.preventDefault();
                    e.stopPropagation();

                    var $activeItem = $('.preview-item.active');
                    var currentIndex = parseInt($activeItem.data('index'));
                    var nextIndex = currentIndex + 1;
                    var lastIndex = $('.preview-item').length - 1;

                    // If we're at the last item, go to the first item
                    if (nextIndex > lastIndex) {
                        nextIndex = 0;
                    }

                    // Remove active class from all items
                    $('.preview-item').removeClass('active');
                    $('.thumb-item').removeClass('active');

                    // Show next item
                    $('.preview-item[data-index="' + nextIndex + '"]').addClass('active');

                    // Update active thumbnail
                    $('.thumb-item[data-target="' + nextIndex + '"]').addClass('active');

                    return false;
                });

                // Add click handlers for thumbnail navigation arrows
                $('.thumb-prev').on('click touch', function(e) {
                    e.preventDefault();
                    e.stopPropagation();

                    var container = $('.details-thumb-container');
                    // Scroll left by 70px (thumbnail width) + 10px (gap)
                    container.scrollLeft(container.scrollLeft() - 80);

                    // Update navigation buttons from global scope
                    if (typeof updateNavButtons === 'function') {
                        updateNavButtons();
                    }

                    return false;
                });

                $('.thumb-next').on('click touch', function(e) {
                    e.preventDefault();
                    e.stopPropagation();

                    var container = $('.details-thumb-container');
                    // Scroll right by 70px (thumbnail width) + 10px (gap)
                    container.scrollLeft(container.scrollLeft() + 80);

                    // Update navigation buttons from global scope
                    if (typeof updateNavButtons === 'function') {
                        updateNavButtons();
                    }

                    return false;
                });

                // Remove the updateNavButtons function since it's now in global scope
                // Initialize navigation button states
                if (typeof updateNavButtons === 'function') {
                    updateNavButtons();
                }

                // Update navigation buttons when scrolling
                $('.details-thumb-container').on('scroll', function() {
                    if (typeof updateNavButtons === 'function') {
                        updateNavButtons();
                    }
                });

                // Prevent all touch events from propagating on gallery elements
                $('.details-gallery, .details-preview-container, .details-thumb-container').on(
                    'touchstart touchmove touchend',
                    function(e) {
                        e.stopPropagation();
                    });

                // Special handling for thumbnail container
                $('.details-thumb-container').on('scroll', function(e) {
                    e.stopPropagation();
                });
            }
        }

        // Initialize Slick sliders for product gallery with a more robust approach
        function initializeProductSliders() {
            // Check if jQuery and Slick are available
            if (typeof $ === 'undefined' || typeof $.fn.slick === 'undefined') {
                setTimeout(initializeProductSliders, 500);
                return;
            }

            // Check if we have images to sliderize
            if ($('.details-preview li').length === 0) {
                return;
            }

            // Destroy existing instances if they exist
            if ($('.details-preview').hasClass('slick-initialized')) {
                $('.details-preview').slick('unslick');
            }

            if ($('.details-thumb').hasClass('slick-initialized')) {
                $('.details-thumb').slick('unslick');
            }

            // Initialize the preview slider (main image)
            $('.details-preview').not('.slick-initialized').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: true,
                infinite: true,
                autoplay: false,
                fade: true,
                asNavFor: '.details-thumb',
                swipe: false, // Disable swipe to prevent conflicts
                touchMove: false, // Disable touch move
                draggable: false, // Disable dragging
                accessibility: false, // Disable accessibility navigation
                prevArrow: $('.details-preview-wrapper .main-image-prev'),
                nextArrow: $('.details-preview-wrapper .main-image-next'),
                beforeChange: function(event, slick, currentSlide, nextSlide) {
                    // Save video state before slide changes
                    var currentVideo = $('.details-preview .slick-slide').eq(currentSlide).find('video')[0];
                    if (currentVideo) {
                        videoStates['main-video'] = {
                            currentTime: currentVideo.currentTime,
                            paused: currentVideo.paused
                        };
                    }

                    // Pause any playing videos when slider changes
                    $('.details-preview video').each(function() {
                        this.pause();
                    });
                }
            });

            // Initialize the thumbnail slider
            $('.details-thumb').not('.slick-initialized').slick({
                slidesToShow: 5,
                slidesToScroll: 1,
                asNavFor: '.details-preview',
                dots: false,
                arrows: true,
                centerMode: false,
                focusOnSelect: true, // Enable focus on select for proper thumbnail clicking
                vertical: false,
                infinite: true,
                swipe: false, // Disable swipe to prevent conflicts
                swipeToSlide: false, // Disable swipe to slide
                touchMove: false, // Disable touch move
                draggable: false, // Disable dragging
                accessibility: false, // Disable accessibility navigation
                prevArrow: $('.details-thumb-wrapper .slick-prev'),
                nextArrow: $('.details-thumb-wrapper .slick-next'),
                responsive: [{
                        breakpoint: 1200,
                        settings: {
                            slidesToShow: 4,
                            swipe: false,
                            swipeToSlide: false,
                            touchMove: false,
                            draggable: false
                        }
                    },
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 5,
                            swipe: false,
                            swipeToSlide: false,
                            touchMove: false,
                            draggable: false
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 4,
                            swipe: false,
                            swipeToSlide: false,
                            touchMove: false,
                            draggable: false
                        }
                    },
                    {
                        breakpoint: 576,
                        settings: {
                            slidesToShow: 3,
                            swipe: false,
                            swipeToSlide: false,
                            touchMove: false,
                            draggable: false
                        }
                    },
                    {
                        breakpoint: 400,
                        settings: {
                            slidesToShow: 2,
                            swipe: false,
                            swipeToSlide: false,
                            touchMove: false,
                            draggable: false
                        }
                    }
                ]
            });

            // Add event listeners to videos to track their state
            $('.details-preview video').each(function() {
                var video = this;

                // Save state when video is played
                video.addEventListener('play', function() {
                    videoStates['main-video'] = {
                        currentTime: video.currentTime,
                        paused: false
                    };
                });

                // Save state when video is paused
                video.addEventListener('pause', function() {
                    videoStates['main-video'] = {
                        currentTime: video.currentTime,
                        paused: true
                    };
                });

                // Save state when video time updates (for more accurate position tracking)
                video.addEventListener('timeupdate', function() {
                    // Only update if video is playing
                    if (!video.paused) {
                        videoStates['main-video'] = {
                            currentTime: video.currentTime,
                            paused: false
                        };
                    }
                });

                // Remove muted attribute after first user interaction to allow audio
                video.addEventListener('play', function() {
                    if (video.muted) {
                        video.muted = false;
                    }
                });
            });

            // Handle video playback when slide becomes active
            $('.details-preview').on('afterChange', function(event, slick, currentSlide) {
                var currentVideo = $(slick.$slides[currentSlide]).find('video')[0];
                if (currentVideo && videoStates['main-video']) {
                    // Restore video state
                    currentVideo.currentTime = videoStates['main-video'].currentTime;
                    // Only play if it was playing before
                    if (!videoStates['main-video'].paused) {
                        // Wait for video to be ready before playing
                        if (currentVideo.readyState >= 2) { // HAVE_CURRENT_DATA or better
                            currentVideo.play().catch(function(error) {
                                // Handle autoplay restrictions
                                console.log('Autoplay prevented:', error);
                            });
                        } else {
                            // Wait for video to be ready
                            currentVideo.addEventListener('canplay', function() {
                                currentVideo.play().catch(function(error) {
                                    // Handle autoplay restrictions
                                    console.log('Autoplay prevented:', error);
                                });
                            }, {
                                once: true
                            });
                        }
                    }
                }
            });

            // Handle thumbnail clicks to set video to play when selected
            $('.details-thumb').on('click', 'li', function() {
                // Check if clicked thumbnail is for video (has video icon)
                if ($(this).find('.fa-video').length > 0) {
                    // Set the video state to playing when video thumbnail is clicked
                    if (videoStates['main-video']) {
                        videoStates['main-video'].paused = false;
                    } else {
                        videoStates['main-video'] = {
                            currentTime: 0,
                            paused: false
                        };
                    }

                    // Save current slide video state before changing
                    var currentSlide = $('.details-preview').slick('slickCurrentSlide');
                    var currentVideo = $('.details-preview .slick-slide').eq(currentSlide).find('video')[0];
                    if (currentVideo) {
                        videoStates['main-video'] = {
                            currentTime: currentVideo.currentTime,
                            paused: false
                        };
                    }
                } else {
                    // Pause all videos if selecting an image
                    $('.details-preview video').each(function() {
                        this.pause();
                    });
                }
            });
        }

        // Initialize on document ready
        $(document).ready(function() {
            // Check if we're on a mobile device
            var isMobile = /Mobi|Android/i.test(navigator.userAgent);

            // Update navigation button states based on scroll position (needed for mobile)
            function updateNavButtons() {
                var container = $('.details-thumb-container');
                var scrollLeft = container.scrollLeft();
                var scrollWidth = container[0].scrollWidth;
                var clientWidth = container[0].clientWidth;

                // Disable/enable previous button
                if (scrollLeft <= 0) {
                    $('.thumb-prev').prop('disabled', true);
                } else {
                    $('.thumb-prev').prop('disabled', false);
                }

                // Disable/enable next button
                if (scrollLeft + clientWidth >= scrollWidth) {
                    $('.thumb-next').prop('disabled', true);
                } else {
                    $('.thumb-next').prop('disabled', false);
                }
            }

            if (isMobile) {
                // Initialize custom mobile gallery
                initializeCustomMobileGallery();
            } else {
                // Initialize Slick sliders for desktop
                initializeProductSliders();
            }

            // Handle autoplay policy - unmute on first user interaction
            $(document).one('click touch', function() {
                if (isMobile) {
                    $('.preview-item video').each(function() {
                        if (this.muted) {
                            this.muted = false;
                        }
                    });
                } else {
                    $('.details-preview video').each(function() {
                        if (this.muted) {
                            this.muted = false;
                        }
                    });
                }
            });

            // Comprehensive touch fix - allow vertical scrolling while maintaining gallery functionality
            if (isMobile) {
                // Initialize navigation button states
                updateNavButtons();

                // Update navigation buttons when scrolling
                $('.details-thumb-container').on('scroll', function() {
                    updateNavButtons();
                });

                // Variables to track touch movement
                var startX = 0;
                var startY = 0;
                var isSwipe = false;

                // Handle touch events on gallery elements
                $('.details-gallery, .details-preview-container, .details-thumb-container').on(
                    'touchstart',
                    function(e) {
                        // Store touch start position
                        startX = e.originalEvent.touches[0].clientX;
                        startY = e.originalEvent.touches[0].clientY;
                        isSwipe = false;
                    });

                $('.details-gallery, .details-preview-container, .details-thumb-container').on(
                    'touchmove',
                    function(e) {
                        // Calculate movement distance
                        var moveX = e.originalEvent.touches[0].clientX;
                        var moveY = e.originalEvent.touches[0].clientY;
                        var diffX = Math.abs(moveX - startX);
                        var diffY = Math.abs(moveY - startY);

                        // If horizontal movement is greater than vertical, prevent default (for swipe)
                        if (diffX > diffY && diffX > 10) {
                            isSwipe = true;
                            // Only prevent default for horizontal swipes
                            e.preventDefault();
                        }
                        // For vertical movements (scrolling), don't prevent default to allow page scrolling
                    });

                $('.details-gallery, .details-preview-container, .details-thumb-container').on(
                    'touchend',
                    function(e) {
                        // Reset swipe flag
                        isSwipe = false;
                    });

                // Handle touch events for gallery controls - only prevent default for actual interactions
                $('.thumb-item, .main-image-prev, .main-image-next, .thumb-prev, .thumb-next').on(
                    'touchstart touchend click',
                    function(e) {
                        var $this = $(this);

                        // Only prevent default and stop propagation for actual control interactions
                        if (e.type === 'touchstart' || e.type === 'click') {
                            e.stopPropagation();

                            if ($this.hasClass('thumb-item')) {
                                // Handle thumbnail selection
                                e.preventDefault();
                                var targetIndex = $this.data('target');

                                // Remove active class from all items
                                $('.thumb-item').removeClass('active');
                                $('.preview-item').removeClass('active');

                                // Add active class to clicked thumbnail
                                $this.addClass('active');

                                // Show corresponding preview item
                                $('.preview-item[data-index="' + targetIndex + '"]').addClass('active');
                            } else if ($this.hasClass('main-image-prev')) {
                                // Handle main image previous arrow
                                e.preventDefault();
                                var $activeItem = $('.preview-item.active');
                                var currentIndex = parseInt($activeItem.data('index'));
                                var prevIndex = currentIndex - 1;

                                // If we're at the first item, go to the last item
                                if (prevIndex < 0) {
                                    var lastIndex = $('.preview-item').length - 1;
                                    prevIndex = lastIndex;
                                }

                                // Remove active class from all items
                                $('.preview-item').removeClass('active');
                                $('.thumb-item').removeClass('active');

                                // Show previous item
                                $('.preview-item[data-index="' + prevIndex + '"]').addClass('active');

                                // Update active thumbnail
                                $('.thumb-item[data-target="' + prevIndex + '"]').addClass('active');
                            } else if ($this.hasClass('main-image-next')) {
                                // Handle main image next arrow
                                e.preventDefault();
                                var $activeItem = $('.preview-item.active');
                                var currentIndex = parseInt($activeItem.data('index'));
                                var nextIndex = currentIndex + 1;
                                var lastIndex = $('.preview-item').length - 1;

                                // If we're at the last item, go to the first item
                                if (nextIndex > lastIndex) {
                                    nextIndex = 0;
                                }

                                // Remove active class from all items
                                $('.preview-item').removeClass('active');
                                $('.thumb-item').removeClass('active');

                                // Show next item
                                $('.preview-item[data-index="' + nextIndex + '"]').addClass('active');

                                // Update active thumbnail
                                $('.thumb-item[data-target="' + nextIndex + '"]').addClass('active');
                            } else if ($this.hasClass('thumb-prev')) {
                                // Handle thumbnail previous arrow
                                e.preventDefault();
                                var container = $('.details-thumb-container');
                                container.scrollLeft(container.scrollLeft() - 80);
                                updateNavButtons();
                            } else if ($this.hasClass('thumb-next')) {
                                // Handle thumbnail next arrow
                                e.preventDefault();
                                var container = $('.details-thumb-container');
                                container.scrollLeft(container.scrollLeft() + 80);
                                updateNavButtons();
                            }
                        }

                        // Don't return false to allow event bubbling for scrolling
                    });
            }
        });

        // Also initialize on window load for safety
        $(window).on('load', function() {
            // Check if we're on a mobile device
            var isMobile = /Mobi|Android/i.test(navigator.userAgent);

            if (isMobile) {
                setTimeout(initializeCustomMobileGallery, 100);
            } else {
                setTimeout(initializeProductSliders, 100);
            }
        });

        // Reinitialize after Livewire updates if applicable
        if (typeof Livewire !== 'undefined') {
            Livewire.hook('message.processed', (message, component) => {
                // Check if we're on a mobile device
                var isMobile = /Mobi|Android/i.test(navigator.userAgent);

                if (isMobile) {
                    setTimeout(initializeCustomMobileGallery, 100);
                } else {
                    setTimeout(initializeProductSliders, 100);
                }
            });
        }

        // Fallback for dynamic content
        setTimeout(function() {
            // Check if we're on a mobile device
            var isMobile = /Mobi|Android/i.test(navigator.userAgent);

            if (isMobile) {
                initializeCustomMobileGallery();
            } else {
                initializeProductSliders();
            }
        }, 2000);
    </script>
@endpush
