<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Bootstrap demo')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="{{ asset('landingpage/assets/css/style.css') }}" rel="stylesheet">
</head>

<body>
    <!-- START: Main Header Section -->
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-2">
                <h2 class="heading-text">সন্ধি মনি- মৌমাছির বিষ/বি ভেনমসহ ৩০+
                    প্রাকৃতিক
                    উপাদানে ব্যথামুক্ত জীবন!</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="video-container text-center py-3">
                    <div class="embed-responsive embed-responsive-16by9 rounded-4 overflow-hidden">
                        <iframe class="embed-responsive-item rounded-4" width="100%" height="500"
                            src="https://www.youtube.com/embed/_Do4haI6aUY?start=1" frameborder="0"
                            allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="text-center">
                    <h3 class="text-success">আয়ুর্বেদিক বিশেষজ্ঞ এবং আয়ুর্বেদিক গবেষকরা দীর্ঘদিন গবেষণা করে এটি
                        প্রস্তুত করেছে।</h3>
                    <a href="{{ route('order.index') }}" class="btn btn-success btn-lg mt-3">অর্ডার করুন</a>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Main Header Section -->

    <!-- START: Benefits Section -->
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <h2 class="heading-text">সন্ধি মনি অয়েলের " উপকারিতা</h2>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">মাংসপেশিজনিত ব্যথা নিরাময় করে</li>
                    <li class="list-group-item">হাঁটু ও জয়েন্টের ব্যথা উপশম করে</li>
                    <li class="list-group-item">ফোলা জয়েন্ট স্বাভাবিক করে</li>
                    <li class="list-group-item">রক্ত সঞ্চালন বৃদ্ধি করে</li>
                    <li class="list-group-item">শিরশিরে ব্যথা দূর করে</li>
                    <li class="list-group-item">ঝিমঝিম বা অবশভাব দূর করে</li>
                    <li class="list-group-item">কোমর বা মাজার ব্যথা উপশম করে</li>
                    <li class="list-group-item">ঘাড়ের ব্যথা উপশম করে</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- END: Benefits Section -->

    <!-- START: Why Buy Section -->
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <h2 class="heading-text">কেন আপনি " সন্ধি মনি অয়েলের " কিনবেন ?
                </h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 mb-4">
                <img src="{{ asset('landingpage/assets/images/1-2-1-1024x759.jpg') }}" class="img-fluid" alt="Benefit 1">
            </div>
            <div class="col-md-4">
                <img src="{{ asset('landingpage/assets/images/2-3-1-1024x759.jpg') }}" class="img-fluid" alt="Benefit 2">
            </div>
            <div class="col-md-4">
                <img src="{{ asset('landingpage/assets/images/3-2-1-1024x759.jpg') }}" class="img-fluid" alt="Benefit 3">
            </div>
            <div class="col-md-4">
                <img src="{{ asset('landingpage/assets/images/4-2-1-1024x759.jpg') }}" class="img-fluid" alt="Benefit 4">
            </div>
            <div class="col-md-4">
                <img src="{{ asset('landingpage/assets/images/5-5-1-1024x759.jpg') }}" class="img-fluid" alt="Benefit 5">
            </div>
            <div class="col-md-4">
                <img src="{{ asset('landingpage/assets/images/6-5-1-1024x759.jpg') }}" class="img-fluid" alt="Benefit 6">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center py-4">প্রায় ৭০০০০+ মানুষের হাঁটু ব্যথা, বাত ব্যথা, কাঁধ ব্যথা, হাড় ক্ষয়ের
                    ব্যথা, পুরনো কোমর ব্যথা ভালো হয়েছে " সন্ধি মনি অয়েলের " এর মাধ্যমে।</h2>
                <div class="text-center">
                    <a href="#" class="btn btn-success btn-lg mt-3">অর্ডার করুন</a>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Why Buy Section -->

    <!-- START: Usage Instructions Section -->
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <h2 class="heading-text">কিভাবে ব্যবহার করবেন?</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-center">প্রতিদিন ২/৩ বেলা আক্রান্ত সাথে পরিমানমতো তেল নিয়ে, আলতোভাবে কয়েক মিনিট মাসাজ
                    করতে হবে। দ্রুত ফলাফলের জন্য ব্যথার স্থানে গরম সেঁক দিতে হবে।</h3>
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
    <!-- END: Usage Instructions Section -->

    <!-- START: Certificate Section -->
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12 text-center">
                <h1 class="text-success">প্রাকৃতিক উপাদান ব্যবহার করুন, ব্যথা মুক্ত ও নিরাপদ থাকুন।</h1>
                <h3 class="text-muted">BCSIR - কতৃক পরিক্ষিত</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center mt-4">
                <div class="certificate-card border border-3 rounded-4 border-success">
                    <img src="{{ asset('landingpage/assets/images/certificate-main.webp') }}" class="img-fluid rounded-4" alt="Certificate">
                </div>
            </div>
        </div>
    </div>
    <!-- END: Certificate Section -->

    <!-- START: Customer Reviews Section -->
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <h2 class="heading-text">আমাদের কাস্টমার রিভিউ</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="owl-carousel owl-theme" id="customerReviews">
                    <div class="item">
                        <img src="{{ asset('landingpage/assets/images/1.webp') }}" class="img-fluid rounded-4" alt="Customer Review 1">
                    </div>
                    <div class="item">
                        <img src="{{ asset('landingpage/assets/images/2.webp') }}" class="img-fluid rounded-4" alt="Customer Review 2">
                    </div>
                    <div class="item">
                        <img src="{{ asset('landingpage/assets/images/3.webp') }}" class="img-fluid rounded-4" alt="Customer Review 3">
                    </div>
                    <div class="item">
                        <img src="{{ asset('landingpage/assets/images/4.webp') }}" class="img-fluid rounded-4" alt="Customer Review 4">
                    </div>
                    <div class="item">
                        <img src="{{ asset('landingpage/assets/images/5.webp') }}" class="img-fluid rounded-4" alt="Customer Review 5">
                    </div>
                    <div class="item">
                        <img src="{{ asset('landingpage/assets/images/6.webp') }}" class="img-fluid rounded-4" alt="Customer Review 6">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Customer Reviews Section -->

    <!-- START: Cover Image & Pricing Section -->
    <div class="bg-success py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <img src="{{ asset('landingpage/assets/images/cover-1-1536x674.webp') }}" class="img-fluid rounded-4" alt="Cover Image">
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-12 text-center">
                    <h3 class="text-white">২০০ মি.লি. সন্ধি মনি অয়েলের পূর্বের মূল্য ২১০০ টাকা</h3>
                    <h2 class="text-warning display-4 my-3 offer-price">অফার মূল্য ৮৯০ টাকা</h2>
                    <h4 class="text-white">( সারা বাংলাদেশ হোম ডেলিভারি ফ্রি )</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="text-center">
                        <a href="{{ route('order.index') }}" class="btn btn-success btn-lg mt-3">অর্ডার করুন</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Cover Image & Pricing Section -->

    <!-- START: Order Form Section -->
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <h2 class="heading-text">অর্ডার করতে নিচের ফর্মে আপনার নাম, পূর্ণ
                    ঠিকানা এবং মোবাইল নাম্বার লিখুন। তারপর নিচে Order Now বাটনে ক্লিক করে আপনার অর্ডারটি সম্পন্ন করুন।
                </h2>
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
                                    <label for="billingName" class="form-label">আপনার নাম লিখুন *</label>
                                    <input type="text" class="form-control" id="billingName" name="billingName" placeholder="আপনার নাম লিখুন" value="{{ old('billingName') }}">
                                    @error('billingName')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="billingAddress" class="form-label">আপনার ঠিকানা লিখুন *</label>
                                    <textarea class="form-control" id="billingAddress" name="billingAddress" rows="3"
                                        placeholder="আপনার ঠিকানা লিখুন">{{ old('billingAddress') }}</textarea>
                                    @error('billingAddress')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="billingPhone" class="form-label">আপনার মোবাইল নাম্বার লিখুন *</label>
                                    <input type="tel" class="form-control" id="billingPhone" name="billingPhone"
                                        placeholder="আপনার মোবাইল নাম্বার লিখুন" value="{{ old('billingPhone') }}">
                                    @error('billingPhone')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="deliveryArea" class="form-label">Shipping</label>
                                    <select class="form-select" id="deliveryArea" name="deliveryArea">
                                        <option value="">নির্বাচন করুন</option>
                                        <option value="dhaka-city" {{ old('deliveryArea') == 'dhaka-city' ? 'selected' : '' }}>ঢাকার ভিতরে</option>
                                        <option value="dhaka-outside" {{ old('deliveryArea') == 'dhaka-outside' ? 'selected' : '' }}>ঢাকার বাইরে</option>
                                    </select>
                                    @error('deliveryArea')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h4>Product Information</h4>
                                <div class="row d-flex align-items-center mb-3">
                                    <div class="col-1 px-1 text-center">
                                        <input type="checkbox" class="form-check-input me-3" id="productCheck" name="product_id" value="1" checked>
                                    </div>
                                    <div class="col-1 px-1 text-center">
                                        <img src="{{ asset('landingpage/assets/images/1-2-1-1024x759.jpg') }}" class="img-fluid me-3"
                                            alt="Product" style="max-width: 30px; height: 30px">
                                    </div>
                                    <div class="col-4 px-1 text-center">
                                        <p style="font-size: 12px;" class="mb-1">সন্ধি মনি অয়েল</p>
                                    </div>
                                    <div class="col-4 d-flex align-items-center px-1">
                                        <span class="me-2">Qty:</span>
                                        <div class="input-group w-auto">
                                            <button class="btn btn-outline-success" type="button"
                                                id="decreaseQty">-</button>
                                            <input type="number" class="form-control text-center" value="1" id="quantity" name="quantity"
                                                style="width: 40px;" min="1">
                                            <button class="btn btn-outline-success" type="button"
                                                id="increaseQty">+</button>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        ৮৯০
                                    </div>
                                </div>
                                <div class="row mt-5 mb-3">
                                    <div class="col-6">
                                        <p class="mb-0">Price per unit:</p>
                                    </div>
                                    <div class="col-6 text-end">
                                        <p class="mb-0"><strong>৮৯০ টাকা</strong></p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <p class="mb-0">Subtotal:</p>
                                    </div>
                                    <div class="col-6 text-end">
                                        <p class="mb-0"><strong>৮৯০ টাকা</strong></p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <p class="mb-0">Shipping:</p>
                                    </div>
                                    <div class="col-6 text-end">
                                        <p class="mb-0"><strong>০ টাকা</strong></p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <p class="mb-0">Total:</p>
                                    </div>
                                    <div class="col-6 text-end">
                                        <p class="mb-0"><strong>৮৯০ টাকা</strong></p>
                                    </div>
                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-success btn-lg">অর্ডার কনফার্ম করুন</button>
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
    <div class="cta-banner" style="background-image: url('{{ asset('landingpage/assets/images/cta-banner.jpg') }}'); background-size: cover; background-position: center; padding: 100px 0 50px 0;">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h2 class="text-success">সরাসরি অর্ডার করতে ও ফ্রি কনসাল্টেশন পেতে কল করুন</h2>
                    <a href="tel:01901-092655" class="text-success"> <h1><i class="fas fa-phone-alt fa-flip-horizontal me-2"></i>01901-092655</a></h1>
                </div>
            </div>
        </div>
    </div>
    <!-- END: CTA Banner Section -->

    <!-- START: Footer Section -->
    <footer class="footer bg-success text-white py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <p class="mb-0">&copy; <script>document.write(new Date().getFullYear());</script> All Rights Reserved. | Designed and Developed by Shafiul Saurav</p>
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
    <script src="{{ asset('landingpage/assets/js/script.js') }}"></script>
</body>

</html>
