@extends('frontend.layouts.master')

@section('title', $logo_fav->web_name ?? 'MeenaMart')

@section('meta_description', 'Online Shopping In Bangladesh With Home Delivery. Find the best products at competitive prices with fast home delivery.')

@section('meta_keywords', 'Online Shopping, Bangladesh, Home Delivery, E-commerce, MeenaMart, Buy Online')

@push('frontendstyle')
    <style>
        /* Home page specific styles */
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

        .new-slider li {
            margin: 0 4px;
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

        /* Home Slider Carousel Styles */
        .home-slider-part {
            position: relative;
        }

        .carousel-indicators button {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.5);
            /* Semi-transparent white for inactive dots */
            margin: 0 5px;
            transition: all 0.3s ease;
        }

        .carousel-indicators .active {
            background-color: white;
            transform: scale(1.2);
        }

        @media (max-width: 768px) {
            .header-media-group{
                text-align: center !important;
            }
            .header-media-group img{
                width: 30% !important;
            }

            .carousel-indicators {
                bottom: 5px !important;
            }

            .carousel-indicators button {
                width: 10px;
                height: 10px;
                background-color: rgba(255, 255, 255, 0.5);
            }

            .carousel-indicators .active {
                background-color: white;
            }
        }

        /* Smooth carousel transition */
        .carousel-item {
            transition: opacity 0.5s ease-in-out;
        }

        .carousel-item-next,
        .carousel-item-prev,
        .carousel-item.active {
            display: block;
        }

        .carousel-fade .carousel-item {
            opacity: 0;
            transition-property: opacity;
            transform: none;
        }

        .carousel-fade .carousel-item.active {
            opacity: 1;
        }

        .carousel-fade .carousel-item-next.carousel-item-start,
        .carousel-fade .carousel-item-prev.carousel-item-end {
            opacity: 1;
        }

        .carousel-fade .carousel-item-next,
        .carousel-fade .carousel-item-prev,
        .carousel-fade .carousel-item.active,
        .carousel-fade .carousel-item-start,
        .carousel-fade .carousel-item-end {
            transform: none;
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
            .header-media-group img{
                width: 100% !important;
            }
            .home-slider-part .carousel-item {
                height: 150px !important;
            }

            .carousel-indicators {
                bottom: 0px !important;
            }
        }
        
        /* Additional fix for very small mobile screens (320px - 575px) */
        @media (max-width: 575px) and (min-width: 320px) {
            .home-slider-part .carousel-item {
                height: 140px !important;
            }
        }
        
        @media (max-width: 480px) {
            .home-slider-part .carousel-item {
                height: 130px !important;
            }
        }
        
        @media (max-width: 400px) {
            .home-slider-part .carousel-item {
                height: 120px !important;
            }
        }
        
        @media (max-width: 350px) {
            .home-slider-part .carousel-item {
                height: 110px !important;
            }
        }
        
        /* Ensure background images cover the entire carousel item */
        .home-slider-part .carousel-item > div {
            width: 100%;
            height: 100%;
            background-size: cover !important;
            background-position: center !important;
        }
        
        /* Make sure carousel maintains proper aspect ratio */
        .home-slider-part .carousel-item {
            height: 250px;
        }
        
        /* Ensure proper display on all mobile devices */
        @media (max-width: 768px) {
            .home-slider-part .carousel-item > div {
                background-size: contain !important;
                background-repeat: no-repeat !important;
                background-position: center !important;
            }
        }
        
        /* For very small screens, use cover to ensure full display */
        @media (max-width: 400px) {
            .home-slider-part .carousel-item > div {
                background-size: cover !important;
            }
        }

        /* Custom Slider Styles */
        .custom-slider-container {
            position: relative;
            overflow: hidden;
        }

        .custom-slider-wrapper {
            overflow: hidden;
            position: relative;
            touch-action: pan-y; /* Allow vertical scrolling */
            cursor: grab;
        }

        .custom-slider-wrapper:active {
            cursor: grabbing;
        }

        .custom-slider {
            display: flex;
            transition: transform 0.5s ease-out;
            list-style: none;
            padding: 0;
            margin: 0;
            position: relative;
        }

        .custom-slider.dragging {
            transition: none;
            cursor: grabbing;
        }

        .custom-slider-item {
            flex: 0 0 auto;
            width: calc((100% / 6) - 8px);
            margin-right: 8px;
        }

        /* Center products in slider */
        .custom-slider-item .product-card {
            margin: 0 auto;
        }

        /* Remove margin from the last item to prevent overflow */
        .custom-slider-item:last-child {
            margin-right: 0;
        }

        /* Slider Navigation Arrows */
        .slider-arrow {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 50%;
            display: none; /* Hidden by default */
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 10;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .slider-arrow:hover {
            background: #684EFF;
            color: white;
        }

        .slider-arrow.active {
            background: rgba(104, 78, 255, 0.9); /* Purple color for active state */
            color: white;
        }

        .slider-arrow.active:hover {
            background: #684EFF; /* Darker purple on hover */
            transform: translateY(-50%) scale(1.1);
        }

        .arrow-left {
            left: 10px;
        }

        .arrow-right {
            right: 10px;
        }

        /* Show arrows when container has the show-arrows class */
        .show-arrows-xl .slider-arrow {
            display: flex;
        }

        @media (max-width: 1200px) {
            .show-arrows-lg .slider-arrow {
                display: flex;
            }
        }

        @media (max-width: 992px) {
            .show-arrows-md .slider-arrow {
                display: flex;
            }
        }

        @media (max-width: 576px) {
            .show-arrows-mobile .slider-arrow {
                display: flex;
            }
        }

        /* Responsive adjustments */
        @media (max-width: 1200px) {
            .custom-slider-item {
                width: calc((100% / 4) - 8px);
            }
        }

        @media (max-width: 992px) {
            .custom-slider-item {
                width: calc((100% / 3) - 8px);
            }
        }

        @media (max-width: 768px) {
            .custom-slider-item {
                width: calc((100% / 3) - 8px);
            }
        }

        @media (max-width: 576px) {
            .custom-slider-item {
                width: calc((100% / 2) - 8px);
            }
        }
    </style>
@endpush

@section('frontend_content')
    <div>
        <!-- Home Slider Carousel -->
        @if ($homeSliders && $homeSliders->count() > 0)
            <section class="section home-slider-part mb-0 bg-white">
                <div id="homeCarousel" class="carousel slide carousel-fade relative" data-bs-ride="carousel">
                    <!-- Indicators -->
                    <div class="carousel-indicators absolute right-0 bottom-0 left-0 flex justify-center p-0 mb-2">
                        @foreach ($homeSliders as $index => $slider)
                            <button type="button" data-bs-target="#homeCarousel" data-bs-slide-to="{{ $index }}"
                                class="{{ $index == 0 ? 'active' : '' }} rounded-full h-3 w-3 border-0"
                                aria-current="{{ $index == 0 ? 'true' : 'false' }}" aria-label="Slide {{ $index + 1 }}">
                            </button>
                        @endforeach
                    </div>

                    <!-- Slides -->
                    <div class="carousel-inner relative w-full overflow-hidden">
                        @foreach ($homeSliders as $index => $slider)
                            <div class="carousel-item {{ $index == 0 ? 'active' : '' }} relative float-left w-full">
                                <div class="relative overflow-hidden bg-cover bg-no-repeat w-full h-full"
                                    style="background-image: url('{{ asset('uploads/home_slider/' . $slider->slider_image) }}');
                                    background-size: cover;
                                    background-position: center;
                                    height: 100%;">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        <section class="section newitem-part mb-1 bg-white py-5">
            <div class="container mb-3">
                <div class="row gx-0">
                    <div class="col-lg-12">
                        <h4>Flash Sale</h4>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="custom-slider-container">
                            <!-- Navigation Arrows -->
                            <div class="slider-arrow arrow-left">
                                <i class="fas fa-chevron-left"></i>
                            </div>
                            <div class="slider-arrow arrow-right">
                                <i class="fas fa-chevron-right"></i>
                            </div>

                            <div class="custom-slider-wrapper">
                                <ul class="custom-slider justify-content-lg-center justify-content-start">
                                    @foreach ($products->where('is_active', 1) as $product)
                                        <li class="custom-slider-item py-2">
                                            <div class="product-card shadow-sm rounded-lg">
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
                                                            href="{{ route('product.details', $product->slug) }}">{{ $product->name }}</a>
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
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section recent-part mb-4">
            <div class="container mb-3">
                <div class="row gx-0">
                    <div class="col-lg-12">
                        <h4>All Products</h4>
                    </div>
                </div>
            </div>
            <div class="container">
                @livewire('product-listing', key('product-listing-main'))
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
                    interval: 3000, // Changed to 2.5 seconds for faster transitions
                    pause: 'hover',
                    wrap: true,
                    keyboard: true
                });
            }

            // Custom Slider with Arrow Navigation (Simplified Approach)
            const slider = document.querySelector('.custom-slider');
            const items = document.querySelectorAll('.custom-slider-item');
            const sliderContainer = document.querySelector('.custom-slider-container');
            const arrowLeft = document.querySelector('.arrow-left');
            const arrowRight = document.querySelector('.arrow-right');
            const sliderWrapper = document.querySelector('.custom-slider-wrapper');

            if (slider && items.length > 0) {
                let currentIndex = 0;
                let itemsPerView = 6; // Default for large screens
                let itemWidth = 0;
                let isDragging = false;
                let startPos = 0;
                let startYPos = 0;
                let currentTranslate = 0;
                let prevTranslate = 0;
                let animationID = 0;
                let startX = 0;
                let startY = 0;

                // Update items per view based on screen size
                function updateItemsPerView() {
                    const width = window.innerWidth;
                    if (width <= 576) {
                        itemsPerView = 2;      // Mobile screens
                    } else if (width <= 768) {
                        itemsPerView = 3;      // 768px screens
                    } else if (width <= 992) {
                        itemsPerView = 3;      // Small desktop screens
                    } else if (width <= 1200) {
                        itemsPerView = 4;      // Medium screens
                    } else {
                        itemsPerView = 6;      // Large screens
                    }
                }

                // Check if arrows should be shown
                function updateArrowVisibility() {
                    // Remove all visibility classes first
                    sliderContainer.classList.remove('show-arrows-xl', 'show-arrows-lg', 'show-arrows-md', 'show-arrows-mobile');

                    // Check product count based on screen size
                    const width = window.innerWidth;
                    let minItemsToShowArrows = 6; // Default for XL screens

                    if (width <= 576) {
                        minItemsToShowArrows = 2; // Mobile screens
                    } else if (width <= 768) {
                        minItemsToShowArrows = 3; // MD screens
                    } else if (width <= 992) {
                        minItemsToShowArrows = 4; // LG screens
                    } else if (width <= 1200) {
                        minItemsToShowArrows = 4; // LG screens
                    }

                    // Show arrows only if there are more items than the minimum threshold
                    if (items.length > minItemsToShowArrows) {
                        if (width <= 576) {
                            sliderContainer.classList.add('show-arrows-mobile');
                        } else if (width <= 768) {
                            sliderContainer.classList.add('show-arrows-md');
                        } else if (width <= 1200) {
                            sliderContainer.classList.add('show-arrows-lg');
                        } else {
                            sliderContainer.classList.add('show-arrows-xl');
                        }
                    }
                }

                // Move slider to the left (previous items)
                function moveLeft() {
                    if (currentIndex > 0) {
                        currentIndex--;
                        updateSliderPosition();
                        updateArrowStates(); // Update arrow states after moving
                    }
                }

                // Move slider to the right (next items)
                function moveRight() {
                    const maxIndex = Math.max(0, items.length - itemsPerView);
                    if (currentIndex < maxIndex) {
                        currentIndex++;
                        updateSliderPosition();
                        updateArrowStates(); // Update arrow states after moving
                    }
                }

                // Update arrow active states (pagination style)
                function updateArrowStates() {
                    // Calculate max index
                    const maxIndex = Math.max(0, items.length - itemsPerView);

                    // Left arrow - active when we can move left (currentIndex > 0)
                    if (arrowLeft) {
                        if (currentIndex > 0) {
                            arrowLeft.classList.add('active');
                        } else {
                            arrowLeft.classList.remove('active');
                        }
                    }

                    // Right arrow - active when we can move right (currentIndex < maxIndex)
                    if (arrowRight) {
                        if (currentIndex < maxIndex) {
                            arrowRight.classList.add('active');
                        } else {
                            arrowRight.classList.remove('active');
                        }
                    }
                }

                // Update slider position (new simplified approach)
                function updateSliderPosition() {
                    // Get the actual width of the first item (more reliable)
                    if (items.length > 0) {
                        const firstItem = items[0];
                        const itemStyle = window.getComputedStyle(firstItem);
                        const itemWidth = firstItem.offsetWidth + parseInt(itemStyle.marginRight);

                        // Calculate and apply transformation
                        const offset = currentIndex * itemWidth;
                        slider.style.transform = `translateX(-${offset}px)`;
                        currentTranslate = -offset;
                        prevTranslate = -offset;
                    }
                }

                // Touch and mouse events for swipe/drag functionality
                function getPositionX(event) {
                    return event.type.includes('mouse') ? event.pageX : event.touches[0].clientX;
                }

                function getPositionY(event) {
                    return event.type.includes('mouse') ? event.pageY : event.touches[0].clientY;
                }

                function touchStart(index, event) {
                    startPos = getPositionX(event);
                    startYPos = getPositionY(event);
                    isDragging = true;
                    slider.classList.add('dragging');
                    animationID = requestAnimationFrame(animation);
                }

                function touchMove(event) {
                    if (isDragging) {
                        const currentPosition = getPositionX(event);
                        const currentYPosition = getPositionY(event);

                        // Calculate movement in both directions
                        const moveX = Math.abs(currentPosition - startPos);
                        const moveY = Math.abs(currentYPosition - startYPos);

                        // If horizontal movement is greater than vertical, prevent vertical scroll
                        if (moveX > moveY && moveX > 5) {
                            event.preventDefault();
                            currentTranslate = prevTranslate + currentPosition - startPos;
                            slider.style.transform = `translateX(${currentTranslate}px)`;
                        }
                    }
                }

                function touchEnd() {
                    cancelAnimationFrame(animationID);
                    isDragging = false;
                    slider.classList.remove('dragging');
                    const movedBy = currentTranslate - prevTranslate;

                    // If moved enough, update currentIndex
                    if (movedBy < -50) {
                        // Swipe left - move to next slide
                        moveRight();
                    }
                    if (movedBy > 50) {
                        // Swipe right - move to previous slide
                        moveLeft();
                    }

                    // Update position
                    updateSliderPosition();
                }

                function animation() {
                    if (isDragging) {
                        slider.style.transform = `translateX(${currentTranslate}px)`;
                        requestAnimationFrame(animation);
                    }
                }

                // Mouse events
                function mouseStart(event) {
                    // Only for left mouse button
                    if (event.button !== 0) return;
                    touchStart(0, event);
                }

                function mouseMove(event) {
                    touchMove(event);
                }

                function mouseEnd() {
                    touchEnd();
                }

                // Prevent click when dragging
                function preventClick(event) {
                    if (Math.abs(currentTranslate - prevTranslate) > 5) {
                        event.preventDefault();
                    }
                }

                // Initialize slider
                function initSlider() {
                    updateItemsPerView();
                    currentIndex = 0; // Start at beginning
                    updateArrowVisibility();

                    // Small delay to ensure DOM is ready
                    setTimeout(() => {
                        updateSliderPosition();
                        updateArrowStates(); // Set initial arrow states
                    }, 50);

                    // Add event listeners for arrows
                    if (arrowLeft && arrowRight) {
                        arrowLeft.addEventListener('click', moveLeft);
                        arrowRight.addEventListener('click', moveRight);
                    }

                    // Add touch and mouse event listeners
                    sliderWrapper.addEventListener('touchstart', function(e) { touchStart(0, e); }, { passive: false });
                    sliderWrapper.addEventListener('touchmove', touchMove, { passive: false });
                    sliderWrapper.addEventListener('touchend', touchEnd);

                    sliderWrapper.addEventListener('mousedown', mouseStart);
                    window.addEventListener('mousemove', mouseMove);
                    window.addEventListener('mouseup', mouseEnd);
                    sliderWrapper.addEventListener('click', preventClick, true);
                }

                // Initialize
                initSlider();

                // Update on resize
                window.addEventListener('resize', function() {
                    const oldItemsPerView = itemsPerView;
                    updateItemsPerView();

                    // If the number of items per view changed, adjust currentIndex if needed
                    if (oldItemsPerView !== itemsPerView) {
                        const maxIndex = Math.max(0, items.length - itemsPerView);
                        currentIndex = Math.min(currentIndex, maxIndex);
                    }

                    updateSliderPosition();
                    updateArrowVisibility(); // Check if arrows should be visible based on new screen size
                    updateArrowStates(); // Update arrow states on resize
                });
            }
        });
    </script>
@endpush
