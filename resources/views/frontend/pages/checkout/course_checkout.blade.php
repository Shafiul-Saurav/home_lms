@extends('frontend.layouts.master')

@section('title', 'Course Checkout')

@push('frontend_style')
@endpush

@section('frontend_content')
    <main class="main">
        <!-- breadcrumb -->
        <x-frontend.pages.common.breadcrumb :title="'Course Checkout'" :breadcrumb="[['name' => 'Home', 'url' => route('home')], ['name' => 'Course Checkout', 'url' => '#']]" />
        <!-- breadcrumb end -->

        <!-- checkout area -->
        <div class="checkout-area py-120">
            <div class="container">
                <div class="checkout-wrap">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="checkout-step">
                                <div class="accordion" id="checkout">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#checkoutStep1" aria-expanded="true"
                                                aria-controls="checkoutStep1">
                                                Your Billing Address
                                            </button>
                                        </h2>
                                        <div id="checkoutStep1" class="accordion-collapse collapse show"
                                            data-bs-parent="#checkout">
                                            <div class="accordion-body">
                                                <div class="checkout-form">
                                                    <form action="#">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label>Full Name</label>
                                                                    <input type="text" class="form-control"
                                                                        placeholder="Full Name" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label>Email</label>
                                                                    <input type="email" class="form-control"
                                                                        placeholder="Email Address" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label>Phone</label>
                                                                    <input type="text" class="form-control"
                                                                        placeholder="Phone Number" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label>Address</label>
                                                                    <input type="text" class="form-control"
                                                                        placeholder="Address" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <div class="form-group">
                                                                    <label>Your Message For Order</label>
                                                                    <textarea cols="30" rows="4" class="form-control" placeholder="Your Message"></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <button type="submit" class="theme-btn">Next Step<i
                                                                        class="fas fa-arrow-right"></i></button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="cart-summary mt-0">
                                <h5>Cart Summary</h5>
                                <ul>
                                    <li><strong>Sub Total:</strong> <span>$4,500.00</span></li>
                                    <li><strong>Discount:</strong> <span>$5.00</span></li>
                                    <li><strong>Shipping:</strong> <span>Free</span></li>
                                    <li><strong>Taxes:</strong> <span>$25.00</span></li>
                                    <li class="shop-cart-total"><strong>Total:</strong> <span>$4,520.00</span></li>
                                </ul>
                                <div class="payment-sidebar mt-40">
                                    <h5>Payment Info</h5>
                                    <div class="checkout-payment">
                                        <ul class="nav nav-pills mb-3 d-flex flex-row" id="pills-tab" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link active d-flex align-items-center justify-content-center border rounded me-0" id="pills-shurjopay-tab" data-bs-toggle="pill" data-bs-target="#pills-shurjopay" type="button" role="tab" aria-controls="pills-shurjopay" aria-selected="true">
                                                    <img src="https://www.bangladeshyp.com/img/bd/b/1468220741-97-shurjopay-online-payment-gateway-in-bangladesh.png" alt="shurjoPay" style="height: 30px;">
                                                </a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link d-flex align-items-center justify-content-center p-2 border rounded me-0 ms-0 ms-lg-1" id="pills-sslcommerz-tab" data-bs-toggle="pill" data-bs-target="#pills-sslcommerz" type="button" role="tab" aria-controls="pills-sslcommerz" aria-selected="false" tabindex="-1">
                                                    <img src="https://www.nop-station.com/images/uploaded/Marketplace/sslcommerz-banner.webp" alt="SSLCommerz" style="height: 30px;">
                                                </a>
                                            </li>
                                        </ul>
                                        <div class="tab-content" id="pills-tabContent">
                                            <div class="tab-pane fade show active" id="pills-shurjopay" role="tabpanel" aria-labelledby="pills-shurjopay-tab" tabindex="0">
                                                <h5 style="color: #8e79f9">Pay with shurjoPay</h5>
                                            </div>
                                            <div class="tab-pane fade" id="pills-sslcommerz" role="tabpanel" aria-labelledby="pills-sslcommerz-tab" tabindex="0">
                                                <h5 style="color: #8e79f9">Pay with SSLCommerz</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-end mt-40">
                                    <a href="#" class="theme-btn">Checkout Now<i
                                            class="fas fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- checkout area end -->

    </main>
@endsection

@push('frontend_script')
@endpush
