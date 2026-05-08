@extends('frontend.layouts.master')

@section('title', 'Course Checkout')

@push('frontend_style')

@endpush

@section('frontend_content')
    <main class="main">
        <!-- breadcrumb -->
        <x-frontend.pages.common.breadcrumb :title="'Course Checkout'" :breadcrumb="[['name' => 'Home', 'url' => route('home')], ['name' => 'Course Checkout', 'url' => '#']]" />
        <!-- breadcrumb end -->

        <section class="checkout-area">
            <div class="container">
                <div class="checkout-wrap">
                    <form id="checkout-form" method="POST" action="{{ route('course.payment.process') }}">
                        @csrf
                        <input type="hidden" name="course_id" value="{{ $course->id }}">
                        <input type="hidden" name="applied_coupon" id="applied_coupon_hidden">
                        <input type="hidden" name="payment_method" id="selected_payment_method" value="SSLCommerz">

                        <div class="row">
                            <div class="col-lg-7">
                                <div class="billing-details">
                                    <h4 class="mb-30">Billing Details</h4>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group mb-3">
                                                <label class="form-label">Full Name <span class="text-danger">*</span></label>
                                                <input type="text" name="name" class="form-control" placeholder="Full Name" required value="{{ Auth::user()->name ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group mb-3">
                                                <label class="form-label">Email Address <span class="text-danger">*</span></label>
                                                <input type="email" name="email" class="form-control" placeholder="Email Address" required value="{{ Auth::user()->email ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group mb-3">
                                                <label class="form-label">Phone Number <span class="text-danger">*</span></label>
                                                <input type="text" name="phone" class="form-control" placeholder="Phone Number" required value="{{ Auth::user()->phone ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group mb-3">
                                                <label class="form-label">Address</label>
                                                <textarea name="address" class="form-control" rows="3" placeholder="Address"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" type="checkbox" name="agree" id="agree" required>
                                                <label class="form-check-label" for="agree">
                                                    I agree to the terms and conditions
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-5">
                                <div class="order-summary">
                                    <h5>Order Summary</h5>
                                    <div class="course-item d-flex align-items-center mb-4">
                                        <img src="{{ asset('uploads/courses/' . $course->image) }}" alt="{{ $course->name }}" style="width: 80px; height: 60px; object-fit: cover; border-radius: 5px; margin-right: 15px;">
                                        <div>
                                            <h6 class="mb-0">{{ $course->name }}</h6>
                                            <p class="mb-0 text-muted">Price: ৳{{ number_format($course->price, 2) }}</p>
                                        </div>
                                    </div>

                                    <div class="coupon-section mb-4">
                                        <div class="input-group">
                                            <input type="text" id="coupon_code" class="form-control" placeholder="Coupon Code">
                                            <button class="btn btn-outline-secondary" type="button" id="apply_coupon_btn">Apply</button>
                                        </div>
                                        <div id="coupon_message" class="mt-2 small"></div>
                                    </div>

                                    <ul>
                                        <li>Sub Total: <span>৳{{ number_format($course->price, 2) }}</span></li>
                                        <li id="discount_row" style="display: none;">Discount: <span id="discount_amount">-৳0.00</span></li>
                                        <li class="total">Total: <span id="final_total">৳{{ number_format($course->price, 2) }}</span></li>
                                    </ul>

                                    <div class="payment-sidebar mt-40">
                                        <h5>Payment Info</h5>
                                        <div class="checkout-payment">
                                            <ul class="nav nav-pills mb-3 d-flex flex-row" id="pills-tab" role="tablist">
                                                <li class="nav-item" role="presentation">
                                                    <a class="nav-link d-flex align-items-center justify-content-center border p-1 rounded me-0" id="pills-shurjopay-tab" data-bs-toggle="pill" data-bs-target="#pills-shurjopay" type="button" role="tab" aria-controls="pills-shurjopay" aria-selected="false" onclick="document.getElementById('selected_payment_method').value='ShurjoPay'">
                                                        <img src="https://www.bangladeshyp.com/img/bd/b/1468220741-97-shurjopay-online-payment-gateway-in-bangladesh.png" alt="shurjoPay" style="height: 60px;">
                                                    </a>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <a class="nav-link active d-flex align-items-center justify-content-center p-1 border rounded me-0 ms-0 ms-lg-1" id="pills-sslcommerz-tab" data-bs-toggle="pill" data-bs-target="#pills-sslcommerz" type="button" role="tab" aria-controls="pills-sslcommerz" aria-selected="true" onclick="document.getElementById('selected_payment_method').value='SSLCommerz'">
                                                        @if(isset($sslCommerzConfig->logo) && file_exists(public_path('uploads/sslcommerz/' . $sslCommerzConfig->logo)))
                                                            <img src="{{ asset('uploads/sslcommerz/' . $sslCommerzConfig->logo) }}" alt="SSLCommerz" style="height: 60px;">
                                                        @else
                                                            <img src="https://www.nop-station.com/images/uploaded/Marketplace/sslcommerz-banner.webp" alt="SSLCommerz" style="height: 60px;">
                                                        @endif
                                                    </a>
                                                </li>
                                            </ul>
                                            <div class="tab-content" id="pills-tabContent">
                                                <div class="tab-pane fade" id="pills-shurjopay" role="tabpanel" aria-labelledby="pills-shurjopay-tab">
                                                    <h5 style="color: #8e79f9">Pay with shurjoPay</h5>
                                                    <p class="small text-muted">You will be redirected to ShurjoPay gateway.</p>
                                                </div>
                                                <div class="tab-pane fade show active" id="pills-sslcommerz" role="tabpanel" aria-labelledby="pills-sslcommerz-tab">
                                                    <h5 style="color: #8e79f9">Pay with SSLCommerz</h5>
                                                    <p class="small text-muted">You will be redirected to SSLCommerz gateway.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" class="theme-btn w-100 mt-3">Pay Now ৳<span id="btn_total">{{ number_format($course->price, 2) }}</span></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>
@endsection

@push('frontend_script')
<script>
    $(document).ready(function() {
        $('#apply_coupon_btn').on('click', function() {
            const code = $('#coupon_code').val();
            if (!code) return;

            $.ajax({
                url: "{{ route('coupon.is_active.ajax', '') }}/" + code,
                type: 'GET',
                success: function(response) {
                    $('#coupon_message').html('<span class="text-success">Coupon applied successfully!</span>');
                    $('#applied_coupon_hidden').val(code);
                },
                error: function() {
                    $('#coupon_message').html('<span class="text-danger">Invalid or expired coupon.</span>');
                }
            });
        });
    });
</script>
@endpush
