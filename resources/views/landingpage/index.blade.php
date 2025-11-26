<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @php
        $logo_fav = \App\Models\LogoFavicon::first();
    @endphp
    <title>@yield('title', ($landingPage->main_heading ? $landingPage->main_heading . ' | ' : '') . ($logo_fav->web_name ?? 'Dynamic Landing Page'))</title>
    <meta name="description" content="{{ $landingPage->main_description ? strip_tags($landingPage->main_description) : ($logo_fav->web_name ?? 'Online Shopping In Bangladesh With Home Delivery') }}">

    <!-- Primary Meta Tags -->
    <meta name="robots" content="all" />
    <meta name="keywords" content="Landing Page, {{ $logo_fav->web_name ?? 'Online Shopping, Bangladesh, Home Delivery' }}" />

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:title" content="{{ $landingPage->main_heading ?? $logo_fav->web_name ?? 'Landing Page' }}" />
    <meta property="og:description" content="{{ $landingPage->main_description ? strip_tags($landingPage->main_description) : ($logo_fav->web_name ?? 'Online Shopping In Bangladesh With Home Delivery') }}" />
    <meta property="og:image" content="{{ $landingPage->products->first()->image ? asset('uploads/products/' . $landingPage->products->first()->image) : asset($logo_fav->logo ?? 'uploads/logos/default.png') }}" />

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="{{ $landingPage->main_heading ?? $logo_fav->web_name ?? 'Landing Page' }}">
    <meta property="twitter:description" content="{{ $landingPage->main_description ? strip_tags($landingPage->main_description) : ($logo_fav->web_name ?? 'Online Shopping In Bangladesh With Home Delivery') }}">
    <meta property="twitter:image" content="{{ $landingPage->products->first()->image ? asset('uploads/products/' . $landingPage->products->first()->image) : asset($logo_fav->logo ?? 'uploads/logos/default.png') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="{{ asset('assets/landingpage/assets/css/style.css') }}" rel="stylesheet">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon"
        href="{{ asset($logo_fav->favicon ?? 'uploads/favicons/default.png') }}" />
</head>

<body>
    <!-- START: Main Header Section -->
    <div class="header-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center mb-4">
                    <h2 class="heading-text">{{ $landingPage->main_heading ?? 'Default Heading' }}</h2>
                    <div class="col-md-8 mx-auto">
                        <div class="video-container text-center">
                            <div class="embed-responsive embed-responsive-16by9 rounded-4 overflow-hidden">
                                @if($landingPage->video_url)
                                    <video width="100%" height="500" controls class="embed-responsive-item rounded-4" preload="metadata">
                                        <source src="{{ asset('uploads/landingpages/' . $landingPage->video_url) }}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                @else
                                    <!-- Default video or placeholder if no video uploaded -->
                                    <iframe class="embed-responsive-item rounded-4" width="100%" height="500"
                                        src="https://www.youtube.com/embed/_Do4haI6aUY?start=1" frameborder="0"
                                        allowfullscreen></iframe>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 mx-auto">
                    <div class="text-center">
                        <div class="main-description mb-5">
                            <h4>{!! $landingPage->main_description !!}</h4>
                        </div>
                        <a href="#" class="btn btn-gradient btn-lg mt-3 px-5 py-3 fs-5">অর্ডার করুন</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Main Header Section -->

    <!-- START: Benefits Section -->
    @if($landingPage->benefits_title || ($landingPage->benefits_list && is_array($landingPage->benefits_list) && count($landingPage->benefits_list) > 0))
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <h2 class="heading-text">{{ $landingPage->benefits_title ?? 'Benefits' }}</h2>
                @if($landingPage->benefits_list && is_array($landingPage->benefits_list) && count($landingPage->benefits_list) > 0)
                    <ul class="list-group list-group-flush">
                        @foreach($landingPage->benefits_list as $benefit)
                            <li class="list-group-item">{{ $benefit }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
    @endif
    <!-- END: Benefits Section -->

    <!-- START: Why Buy Section -->
    @if($landingPage->why_buy_title || $landingPage->whyBuyImages->count() > 0 || $landingPage->why_buy_description)
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <h2 class="heading-text">{{ $landingPage->why_buy_title ?? 'Why Buy' }}</h2>
            </div>
        </div>
        @if($landingPage->whyBuyImages->count() > 0)
        <div class="row">
            @foreach($landingPage->whyBuyImages as $image)
                <div class="col-md-4 mb-4">
                    <img src="{{ asset('uploads/landingpages/' . $image->image_path) }}" class="img-fluid" alt="Why Buy Image">
                </div>
            @endforeach
        </div>
        @endif
        @if($landingPage->why_buy_description)
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center py-4">{{ $landingPage->why_buy_description }}</h2>
                <div class="text-center">
                    <a href="#" class="btn btn-gradient btn-lg mt-3">অর্ডার করুন</a>
                </div>
            </div>
        </div>
        @endif
    </div>
    @endif
    <!-- END: Why Buy Section -->

    <!-- START: Usage Instructions Section -->
    @if($landingPage->usage_title || $landingPage->usage_instructions)
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <h2 class="heading-text">{{ $landingPage->usage_title ?? 'Usage Instructions' }}</h2>
            </div>
        </div>
        @if($landingPage->usage_instructions)
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-center">{{ $landingPage->usage_instructions }}</h3>
            </div>
        </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="text-center">
                    <a href="#" class="btn btn-gradient btn-lg mt-3">অর্ডার করুন</a>
                </div>
            </div>
        </div>
    </div>
    @endif
    <!-- END: Usage Instructions Section -->

    <!-- START: Certificate Section -->
    @if($landingPage->certificate_title || $landingPage->certificate_subtitle || $landingPage->certificate_image)
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12 text-center">
                <h1 style="color: #684EFF;">{{ $landingPage->certificate_title ?? 'Certificate Title' }}</h1>
                <h3 style="color: #684EFF;">{{ $landingPage->certificate_subtitle ?? 'Certificate Subtitle' }}</h3>
            </div>
        </div>
        @if($landingPage->certificate_image)
        <div class="row">
            <div class="col-md-12 text-center mt-4">
                <div class="certificate-card border border-3 rounded-4" style="border-color: #684EFF !important;">
                    <img src="{{ asset('uploads/landingpages/' . $landingPage->certificate_image) }}" class="img-fluid rounded-4" alt="Certificate">
                </div>
            </div>
        </div>
        @endif
    </div>
    @endif
    <!-- END: Certificate Section -->

    <!-- START: Review Images Section -->
    @if($landingPage->reviewImages->count() > 0)
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <h2 class="heading-text">Review Images / Screenshots</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="owl-carousel owl-theme" id="customerReviews">
                    @foreach($landingPage->reviewImages as $reviewImage)
                        <div class="item">
                            <img src="{{ asset('uploads/landingpages/' . $reviewImage->image_path) }}" class="img-fluid rounded-4" alt="Review Image">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @endif
    <!-- END: Review Images Section -->

    <!-- START: Product Information Section -->
    @if($landingPage->products && $landingPage->products->count() > 0)
    <div class="py-5" style="background: linear-gradient(135deg, #28a745 0%, #219a3a 100%);">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-md-6 text-center">
                    @if($landingPage->products->first()->image)
                        <img src="{{ asset('uploads/products/' . $landingPage->products->first()->image) }}" class="img-fluid rounded-4 shadow-lg" alt="{{ $landingPage->products->first()->name }}" style="max-width: 400px; transition: transform 0.3s ease;">
                    @else
                        <!-- Default placeholder if no product image provided -->
                        <img src="{{ asset('assets/landingpage/assets/images/cover-1-1536x674.webp') }}" class="img-fluid rounded-4 shadow-lg" alt="Product Image" style="max-width: 400px;">
                    @endif
                </div>
                <div class="col-md-6 text-center text-md-start">
                    <h3 class="text-white mb-3">Original Price: <del>{{ number_format($landingPage->products->first()->purchase_price ?? 0, 2) }} BDT</del></h3>
                    <h2 class="text-light display-4 fw-bold my-3 offer-price">Offer Price: {{ number_format($landingPage->products->first()->sale_price ?? 0, 2) }} BDT</h2>
                    <h4 class="text-white mb-4">{{ $landingPage->footer_text ?? '( Free Delivery Across Bangladesh )' }}</h4>
                    <div class="d-grid d-md-block">
                        <a href="#" class="btn btn-gradient btn-lg px-5 py-3 fs-5">অর্ডার করুন</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    <!-- END: Product Information Section -->

    <!-- START: Order Form Section -->
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <h2 class="heading-text">To order, write your name, full address and mobile number in the form below. Then click on the 'Order Now' button to complete your order.</h2>
            </div>
        </div>
        <div class="row mt-4 order-card rounded-4 border border-3" style="border-color: #684EFF !important;">
            <div class="col-md-12">
                <form id="orderForm" action="" method="POST">
                    @csrf
                    <div class="p-4">
                        <div class="row">
                            <div class="col-md-6">
                                <h4>Billing details</h4>
                                <div class="mb-3">
                                    <label for="billingName" class="form-label">Write your name *</label>
                                    <input type="text" class="form-control" id="billingName" name="billingName" placeholder="Write your name" value="{{ old('billingName') }}">
                                    @error('billingName')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="billingAddress" class="form-label">Write your address *</label>
                                    <textarea class="form-control" id="billingAddress" name="billingAddress" rows="3"
                                        placeholder="Write your address">{{ old('billingAddress') }}</textarea>
                                    @error('billingAddress')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="billingPhone" class="form-label">Write your mobile number *</label>
                                    <input type="tel" class="form-control" id="billingPhone" name="billingPhone"
                                        placeholder="Write your mobile number" value="{{ old('billingPhone') }}">
                                    @error('billingPhone')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="deliveryArea" class="form-label">Shipping</label>
                                    <select class="form-select" id="deliveryArea" name="deliveryArea">
                                        <option value="">Select</option>
                                        <option value="dhaka-city" {{ old('deliveryArea') == 'dhaka-city' ? 'selected' : '' }}>Inside Dhaka</option>
                                        <option value="dhaka-outside" {{ old('deliveryArea') == 'dhaka-outside' ? 'selected' : '' }}>Outside Dhaka</option>
                                    </select>
                                    @error('deliveryArea')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h4>Product Information</h4>
                                @if($landingPage->products && $landingPage->products->count() > 0)
                                    @php
                                        $product = $landingPage->products->first();
                                    @endphp
                                    <div class="row d-flex align-items-center mb-3">
                                        <div class="col-1 px-1 text-center">
                                            @if($product->image)
                                                <img src="{{ asset('uploads/products/' . $product->image) }}" class="img-fluid me-3"
                                                    alt="{{ $product->name }}" style="max-width: 40px; height: 40px">
                                            @else
                                                <img src="{{ asset('assets/landingpage/assets/images/1-2-1-1024x759.jpg') }}" class="img-fluid me-3"
                                                    alt="{{ $product->name }}" style="max-width: 40px; height: 40px">
                                            @endif
                                            <!-- Hidden input to pass product ID to the form -->
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        </div>
                                        <div class="col-5 px-1 text-center">
                                            <p style="font-size: 12px;" class="mb-1">{{ $product->name ?? 'Product Name' }}</p>
                                        </div>
                                        <div class="col-5 d-flex align-items-center justify-content-center px-1">
                                            <span class="me-2 d-none d-sm-block">Qty:</span>
                                            <div class="input-group w-auto">
                                                <button class="btn btn-outline-success" type="button"
                                                    id="decreaseQty">-</button>
                                                <input type="text" class="form-control text-center" value="1" id="quantity" name="quantity"
                                                    style="width: 40px; text-align: center; -moz-appearance: textfield; -webkit-appearance: none;" min="1" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                                                <button class="btn btn-outline-success" type="button"
                                                    id="increaseQty">+</button>
                                            </div>
                                        </div>
                                        <div class="col-1">
                                            {{ number_format($product->sell_price ?? 0, 2) }}
                                        </div>
                                    </div>
                                    <!-- Hidden span to pass product price and discount info to JavaScript -->
                                    <span id="product-price" style="display: none;"
                                          data-price="{{ $product->sell_price ?? 0 }}"
                                          data-original-price="{{ $product->purchase_price ?? 0 }}"
                                          data-discount-type="{{ $product->discount_type ?? '' }}"
                                          data-discount-amount="{{ $product->discount_amount ?? 0 }}"></span>
                                    <div class="row mt-5 mb-3">
                                        <div class="col-6">
                                            <p class="mb-0">Discounted Price per unit:</p>
                                        </div>
                                        <div class="col-6 text-end">
                                            <p class="mb-0"><strong>{{ number_format($product->sell_price ?? 0, 2) }} BDT</strong></p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row mb-3">
                                        <div class="col-6">
                                            <p class="mb-0">Subtotal:</p>
                                        </div>
                                        <div class="col-6 text-end">
                                            <p class="mb-0"><strong>{{ number_format($product->sell_price ?? 0, 2) }} BDT</strong></p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row mb-3">
                                        <div class="col-6">
                                            <p class="mb-0">Shipping:</p>
                                        </div>
                                        <div class="col-6 text-end">
                                            <p class="mb-0"><strong>0 BDT</strong></p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row mb-3">
                                        <div class="col-6">
                                            <p class="mb-0">Total:</p>
                                        </div>
                                        <div class="col-6 text-end">
                                            <p class="mb-0"><strong>{{ number_format($product->sell_price ?? 0, 2) }} BDT</strong></p>
                                        </div>
                                    </div>
                                @else
                                    <p>No product associated with this landing page.</p>
                                @endif
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-gradient btn-lg">Confirm Order</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- END: Order Form Section -->

    <!-- Adding CSRF Token -->
    <script>
        // Adding CSRF token to AJAX requests or forms if needed
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- START: CTA Banner Section -->
    @if($landingPage->cta_banner_image || $landingPage->cta_banner_text)
    <div class="cta-banner" style="background-image: url('{{ $landingPage->cta_banner_image ? asset('uploads/landingpages/' . $landingPage->cta_banner_image) : asset('assets/landingpage/assets/images/cta-banner.jpg') }}'); background-size: cover; background-position: center; padding: 100px 0 50px 0;">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h2 class="text-success">{{ $landingPage->cta_banner_text ?? 'Call for free consultation' }}</h2>
                    @php
                        $website_link = \App\Models\WebsiteLink::first();
                    @endphp
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $website_link->number ?? '8801849382288') }}" class="text-success" target="_blank">
                        <h1><i class="fab fa-whatsapp fa-flip-horizontal me-2"></i>{{ $website_link->number ?? '+8801849382288' }}</a></h1>
                </div>
            </div>
        </div>
    </div>
    @endif
    <!-- END: CTA Banner Section -->

    <!-- START: Footer Section -->
    <footer class="footer" style="background-color: #684EFF; color: white; padding: 1rem 0;">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    @php
                        $logo_fav = \App\Models\LogoFavicon::first();
                        $website_link = \App\Models\WebsiteLink::first();
                    @endphp
                    <p class="mb-0">&copy; All Rights Reserved {{ $logo_fav->web_name ?? 'All Rights Reserved' }} <script>document.write(new Date().getFullYear());</script>. | Designed and Developed by <a class="text-white" href="" target="_blank">Shafiul Saurav</a></p>
                </div>
            </div>
        </div>
    </footer>
    <!-- END: Footer Section -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="{{ asset('assets/landingpage/assets/js/script.js') }}"></script>

    <script>
        $(document).ready(function() {
            // Prevent original event handlers from interfering by removing them
            $('#increaseQty, #decreaseQty').off('click');
            $('#quantity').off('input change');

            // Custom function to calculate and update prices
            function updatePriceCalculations() {
                // Get the product info from the data attribute
                var originalPrice = parseFloat($('#product-price').data('original-price')) || 0;
                var discountType = $('#product-price').data('discount-type') || '';
                var discountAmount = parseFloat($('#product-price').data('discount-amount')) || 0;

                // Calculate the actual price per unit based on discount
                var pricePerUnit = originalPrice;

                if(discountType === 'percentage') {
                    // Apply percentage discount
                    pricePerUnit = originalPrice - (originalPrice * (discountAmount / 100));
                } else if(discountType === 'fixed') {
                    // Apply fixed amount discount
                    pricePerUnit = originalPrice - discountAmount;
                } else {
                    // If no discount type is specified, use the sell_price
                    pricePerUnit = parseFloat($('#product-price').data('price')) || originalPrice;
                }

                // Ensure price doesn't go below 0
                pricePerUnit = Math.max(pricePerUnit, 0);

                var quantity = parseInt($('#quantity').val());
                if(isNaN(quantity) || quantity < 1) {
                    quantity = 1;
                    $('#quantity').val(quantity);
                }

                // Calculate subtotal
                var subtotal = pricePerUnit * quantity;

                // Determine shipping cost based on delivery area
                var shipping = 0;
                var selectedDeliveryArea = $('#deliveryArea').val();
                if(selectedDeliveryArea === 'dhaka-city') {
                    shipping = 70; // 70 BDT for Inside Dhaka
                } else if(selectedDeliveryArea === 'dhaka-outside') {
                    shipping = 120; // 120 BDT for Outside Dhaka
                }

                // Calculate total
                var total = subtotal + shipping;

                // Update the values in the UI using text labels instead of fixed indices
                $('.col-6.text-end').each(function() {
                    var label = $(this).prev().text().trim();
                    if(label === 'Subtotal:') {
                        $(this).find('strong').text(subtotal.toFixed(2) + ' BDT');
                    } else if(label === 'Shipping:') {
                        $(this).find('strong').text(shipping.toFixed(2) + ' BDT');
                    } else if(label === 'Total:') {
                        $(this).find('strong').text(total.toFixed(2) + ' BDT');
                    }
                });

                // Also update the "Discounted Price per unit" display
                $('.col-6').each(function() {
                    if($(this).text().trim() === 'Discounted Price per unit:') {
                        $(this).next().find('strong').text(pricePerUnit.toFixed(2) + ' BDT');
                    }
                });
            }

            // Set up our own event handlers for quantity buttons
            $('#increaseQty').on('click', function() {
                var currentVal = parseInt($('#quantity').val());
                if(isNaN(currentVal)) currentVal = 1;
                $('#quantity').val(currentVal + 1);
                updatePriceCalculations();
            });

            $('#decreaseQty').on('click', function() {
                var currentVal = parseInt($('#quantity').val());
                if(isNaN(currentVal)) currentVal = 1;
                if(currentVal > 1) {
                    $('#quantity').val(currentVal - 1);
                    updatePriceCalculations();
                }
            });

            // Update when quantity input changes
            $('#quantity').on('input change', function() {
                var val = parseInt($(this).val());
                if(isNaN(val) || val < 1) {
                    $(this).val(1);
                }
                updatePriceCalculations();
            });

            // Also update when delivery area changes
            $('#deliveryArea').on('change', function() {
                updatePriceCalculations();
            });

            // Initialize the calculations on page load
            updatePriceCalculations();
        });
    </script>
</body>

</html>
