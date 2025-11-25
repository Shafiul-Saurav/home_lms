<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dynamic Landing Page')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="{{ asset('assets/landingpage/assets/css/style.css') }}" rel="stylesheet">
</head>

<body>
    <!-- START: Main Header Section -->
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-2">
                <h2 class="heading-text">{{ $landingPage->main_heading ?? 'Default Heading' }}</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="video-container text-center py-3">
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
        <div class="row">
            <div class="col-md-12">
                <div class="text-center">
                    {!! $landingPage->main_description !!}
                    <a href="#" class="btn btn-success btn-lg mt-3">অর্ডার করুন</a>
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
                    <a href="#" class="btn btn-success btn-lg mt-3">অর্ডার করুন</a>
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
                    <a href="#" class="btn btn-success btn-lg mt-3">অর্ডার করুন</a>
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
                <h1 class="text-success">{{ $landingPage->certificate_title ?? 'Certificate Title' }}</h1>
                <h3 class="text-muted">{{ $landingPage->certificate_subtitle ?? 'Certificate Subtitle' }}</h3>
            </div>
        </div>
        @if($landingPage->certificate_image)
        <div class="row">
            <div class="col-md-12 text-center mt-4">
                <div class="certificate-card border border-3 rounded-4 border-success">
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
    <div class="bg-success py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    @if($landingPage->products->first()->image)
                        <img src="{{ asset('uploads/products/' . $landingPage->products->first()->image) }}" class="img-fluid rounded-4" alt="{{ $landingPage->products->first()->name }}">
                    @else
                        <!-- Default placeholder if no product image provided -->
                        <img src="{{ asset('assets/landingpage/assets/images/cover-1-1536x674.webp') }}" class="img-fluid rounded-4" alt="Product Image">
                    @endif
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-12 text-center">
                    <h3 class="text-white">Original Price: {{ $landingPage->products->first()->purchase_price ?? 'N/A' }} BDT</h3>
                    <h2 class="text-warning display-4 my-3 offer-price">Offer Price: {{ $landingPage->products->first()->sell_price ?? 'N/A' }} BDT</h2>
                    <h4 class="text-white">{{ $landingPage->footer_text ?? '( Free Delivery Across Bangladesh )' }}</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="text-center">
                        <a href="#" class="btn btn-success btn-lg mt-3">অর্ডার করুন</a>
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
        <div class="row mt-4 order-card rounded-4 border border-3 border-success">
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
                                            <input type="checkbox" class="form-check-input me-3" id="productCheck" name="product_id" value="{{ $product->id }}" checked>
                                        </div>
                                        <div class="col-1 px-1 text-center">
                                            @if($product->image)
                                                <img src="{{ asset('uploads/products/' . $product->image) }}" class="img-fluid me-3"
                                                    alt="{{ $product->name }}" style="max-width: 30px; height: 30px">
                                            @else
                                                <img src="{{ asset('assets/landingpage/assets/images/1-2-1-1024x759.jpg') }}" class="img-fluid me-3"
                                                    alt="{{ $product->name }}" style="max-width: 30px; height: 30px">
                                            @endif
                                        </div>
                                        <div class="col-4 px-1 text-center">
                                            <p style="font-size: 12px;" class="mb-1">{{ $product->name ?? 'Product Name' }}</p>
                                        </div>
                                        <div class="col-4 d-flex align-items-center px-1">
                                            <span class="me-2">Qty:</span>
                                            <div class="input-group w-auto">
                                                <button class="btn btn-outline-success" type="button"
                                                    id="decreaseQty">-</button>
                                                <input type="text" class="form-control text-center" value="1" id="quantity" name="quantity"
                                                    style="width: 40px; text-align: center; -moz-appearance: textfield; -webkit-appearance: none;" min="1" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                                                <button class="btn btn-outline-success" type="button"
                                                    id="increaseQty">+</button>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            {{ $product->selling_price ?? 890 }}
                                        </div>
                                    </div>
                                    <div class="row mt-5 mb-3">
                                        <div class="col-6">
                                            <p class="mb-0">Price per unit:</p>
                                        </div>
                                        <div class="col-6 text-end">
                                            <p class="mb-0"><strong>{{ $product->sell_price ?? 890 }} BDT</strong></p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row mb-3">
                                        <div class="col-6">
                                            <p class="mb-0">Subtotal:</p>
                                        </div>
                                        <div class="col-6 text-end">
                                            <p class="mb-0"><strong>{{ $product->sell_price ?? 890 }} BDT</strong></p>
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
                                            <p class="mb-0"><strong>{{ $product->sell_price ?? 890 }} BDT</strong></p>
                                        </div>
                                    </div>
                                @else
                                    <p>No product associated with this landing page.</p>
                                @endif
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-success btn-lg">Confirm Order</button>
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
                    <a href="https://wa.me/8801849382288" class="text-success">
                        <h1><i class="fab fa-whatsapp fa-flip-horizontal me-2"></i>+8801849382288</a></h1>
                </div>
            </div>
        </div>
    </div>
    @endif
    <!-- END: CTA Banner Section -->

    <!-- START: Footer Section -->
    <footer class="footer bg-success text-white py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <p class="mb-0">&copy; <script>document.write(new Date().getFullYear());</script> {{ $landingPage->footer_text ?? 'All Rights Reserved' }}. | Designed and Developed by Shafiul Saurav</p>
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
</body>

</html>
