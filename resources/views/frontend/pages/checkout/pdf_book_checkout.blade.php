@extends('frontend.layouts.master')

@section('title', 'PDF Book Checkout')

@push('frontend_style')
    <style>
        .checkout-area {
            padding: 120px 0;
            background-color: #f8f9fa;
        }
        .auth-form {
            background: #ffffff;
            padding: 50px;
            border-radius: 20px;
            box-shadow: 0 0 40px 5px rgba(0, 0, 0, 0.05);
            border: 1px solid #f1f1f1;
        }
        .auth-header {
            margin-bottom: 30px;
            text-align: center;
        }
        .auth-header h4 {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 10px;
            color: var(--color-dark);
        }
        .form-group {
            margin-bottom: 25px;
        }
        .form-icon i {
            top: 20px !important;
            transform: none !important;
            color: var(--theme-color);
        }
        .form-control {
            border-radius: 10px !important;
            padding: 15px 20px 15px 50px !important;
            height: auto !important;
            border: 1px solid #ececec !important;
        }
        .order-summary-card {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 0 40px 5px rgba(0, 0, 0, 0.05);
            border: 1px solid #f1f1f1;
            padding: 30px;
        }
        .order-summary-header {
            border-bottom: 1px solid #eee;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }
        .order-summary-header h5 {
            font-weight: 700;
            font-size: 20px;
        }
        .course-item-box {
            background: #f9f9ff;
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 20px;
            border: 1px solid #eee;
        }
        .summary-list li {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
            color: #666;
        }
        .summary-list li.total-row {
            border-top: 1px dashed #ddd;
            padding-top: 15px;
            margin-top: 15px;
            font-size: 18px;
            font-weight: 700;
            color: var(--color-dark);
        }
        .summary-list li.total-row span {
            color: var(--theme-color);
        }
        .payment-sidebar h5 {
            font-weight: 700;
            margin-bottom: 20px;
        }
        .nav-pills .nav-link {
            border: 2px solid #eee !important;
            transition: 0.3s;
            background: #fff !important;
        }
        .nav-pills .nav-link.active {
            border-color: var(--theme-color) !important;
            background: #f9f9ff !important;
        }
    </style>
@endpush

@section('frontend_content')
    <main class="main">
        <!-- breadcrumb -->
        <x-frontend.pages.common.breadcrumb :title="'PDF Book Checkout'" :breadcrumb="[['name' => 'Home', 'url' => route('home')], ['name' => 'PDF Book Checkout', 'url' => '#']]" />
        <!-- breadcrumb end -->

        <section class="checkout-area">
            <div class="container">
                <form id="checkout-form" method="POST" action="{{ route('pdf.book.payment.process') }}">
                    @csrf
                    <input type="hidden" name="book_id" value="{{ $book->id }}">
                    <input type="hidden" name="applied_coupon" id="applied_coupon_hidden">
                    <input type="hidden" name="payment_method" id="selected_payment_method" value="SSLCommerz">

                    <div class="row">
                        <div class="col-lg-7">
                            <div class="auth-form">
                                <div class="auth-header" style="text-align: left;">
                                    <h4>Billing Details</h4>
                                    <p>Fill out the information below to complete your purchase</p>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <div class="form-icon">
                                                <i class="far fa-user"></i>
                                                <input type="text" name="name" class="form-control" placeholder="Full Name" required value="{{ Auth::user()->name ?? '' }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <div class="form-icon">
                                                <i class="far fa-envelope"></i>
                                                <input type="email" name="email" class="form-control" placeholder="Email Address" required value="{{ Auth::user()->email ?? '' }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <div class="form-icon">
                                                <i class="far fa-phone"></i>
                                                <input type="text" name="phone" class="form-control" placeholder="Phone Number" required value="{{ Auth::user()->phone ?? '' }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-check mt-2">
                                            <input class="form-check-input" type="checkbox" name="agree" id="agree" required checked>
                                            <label class="form-check-label" for="agree">
                                                I agree to the <a href="#" class="text-primary">Terms and Conditions</a>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-5">
                            <div class="order-summary-card">
                                <div class="order-summary-header">
                                    <h5>Order Summary (PDF)</h5>
                                </div>

                                <div class="course-item-box d-flex align-items-center">
                                    <img src="{{ asset('uploads/pdfbooks/images/' . $book->image) }}" alt="{{ $book->name }}" style="width: 70px; height: 90px; object-fit: cover; border-radius: 10px; margin-right: 15px;">
                                    <div>
                                        <h6 class="mb-1" style="font-weight: 700;">{{ $book->name }}</h6>
                                        <p class="mb-0 text-muted small">Digital Delivery via Email</p>
                                    </div>
                                </div>

                                <div class="coupon-section mb-4">
                                    <div class="form-group mb-0">
                                        <div class="form-icon" style="position: relative;">
                                            <i class="far fa-tag" style="top: 18px !important; left: 20px !important; z-index: 10;"></i>
                                            <div class="d-flex">
                                                <input type="text" id="coupon_code" class="form-control" placeholder="Coupon Code" style="border-radius: 10px 0 0 10px !important; border-right: none !important; flex: 1; position: relative; z-index: 1;">
                                                <button class="theme-btn" type="button" id="apply_coupon_btn" style="border-radius: 0 10px 10px 0; padding: 0 25px; font-size: 14px; white-space: nowrap; height: 56px; margin-top: 0; position: relative; z-index: 2;">Apply</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="coupon_message" class="mt-2 small"></div>
                                </div>

                                <ul class="summary-list">
                                    <li>Sub Total <span>৳{{ number_format($book->price, 2) }}</span></li>
                                    @if($book->discount_amount > 0)
                                        <li class="item-discount">Book Discount <span class="text-success">-৳{{ number_format($book->discount_amount, 2) }}</span></li>
                                    @endif
                                    <li id="discount_row" style="display: none;">Coupon Discount <span id="discount_amount" class="text-success">-৳0.00</span></li>
                                    <li class="total-row">Total <span id="final_total">৳{{ number_format($book->price - $book->discount_amount, 2) }}</span></li>
                                </ul>

                                <div class="payment-sidebar mt-40">
                                    <h5>Select Payment Method</h5>
                                    <div class="checkout-payment">
                                        <ul class="nav nav-pills mb-3 d-flex flex-row gap-2" id="pills-tab" role="tablist">
                                            <li class="nav-item flex-grow-1" role="presentation">
                                                <a class="nav-link d-flex align-items-center justify-content-center p-3 rounded" id="pills-shurjopay-tab" data-bs-toggle="pill" data-bs-target="#pills-shurjopay" type="button" role="tab" aria-controls="pills-shurjopay" aria-selected="false" onclick="document.getElementById('selected_payment_method').value='ShurjoPay'">
                                                    <img src="https://www.bangladeshyp.com/img/bd/b/1468220741-97-shurjopay-online-payment-gateway-in-bangladesh.png" alt="shurjoPay" style="height: 40px;">
                                                </a>
                                            </li>
                                            <li class="nav-item flex-grow-1" role="presentation">
                                                <a class="nav-link active d-flex align-items-center justify-content-center p-3 rounded" id="pills-sslcommerz-tab" data-bs-toggle="pill" data-bs-target="#pills-sslcommerz" type="button" role="tab" aria-controls="pills-sslcommerz" aria-selected="true" onclick="document.getElementById('selected_payment_method').value='SSLCommerz'">
                                                    @if(isset($sslCommerzConfig->logo) && file_exists(public_path('uploads/sslcommerz/' . $sslCommerzConfig->logo)))
                                                        <img src="{{ asset('uploads/sslcommerz/' . $sslCommerzConfig->logo) }}" alt="SSLCommerz" style="height: 40px;">
                                                    @else
                                                        <img src="https://www.nop-station.com/images/uploaded/Marketplace/sslcommerz-banner.webp" alt="SSLCommerz" style="height: 40px;">
                                                    @endif
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <button type="submit" class="theme-btn w-100 mt-4 shadow-sm">
                                    <i class="fas fa-lock me-2"></i> Pay Now ৳<span id="btn_total">{{ number_format($book->price - $book->discount_amount, 2) }}</span>
                                </button>
                                <p class="text-center mt-3 small text-muted"><i class="fas fa-shield-alt me-1"></i> Secure Digital Transaction</p>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </main>
@endsection

@push('frontend_script')
<script>
    $(document).ready(function() {
        // Handle form submission based on payment method
        $('#checkout-form').on('submit', function(e) {
            e.preventDefault();
            const paymentMethod = $('#selected_payment_method').val();
            let action = $(this).attr('action');

            if (paymentMethod === 'ShurjoPay') {
                action = "{{ route('pdf.book.shurjopay.payment') }}";
            } else {
                action = "{{ route('pdf.book.payment.process') }}";
            }

            $(this).attr('action', action);
            this.submit();
        });

        $('#apply_coupon_btn').on('click', function() {
            const code = $('#coupon_code').val();
            const total = "{{ $book->price - $book->discount_amount }}";

            if (!code) return;

            $.ajax({
                url: "{{ route('coupon.validate') }}",
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    code: code,
                    total: total
                },
                success: function(response) {
                    if (response.success) {
                        $('#coupon_message').html('<span class="text-success">' + response.message + '</span>');
                        $('#applied_coupon_hidden').val(response.code);

                        // Update UI
                        $('#discount_row').show();
                        $('#discount_amount').text('-৳' + response.discount);
                        $('#final_total').text('৳' + response.new_total);
                        $('#btn_total').text(response.new_total);

                        // Disable input and button after success
                        $('#coupon_code').prop('readonly', true);
                        $('#apply_coupon_btn').prop('disabled', true).text('Applied');
                    }
                },
                error: function(xhr) {
                    const message = xhr.responseJSON ? xhr.responseJSON.message : 'Invalid or expired coupon.';
                    $('#coupon_message').html('<span class="text-danger">' + message + '</span>');
                }
            });
        });
    });
</script>
@endpush
