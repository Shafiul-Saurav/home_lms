@extends('frontend.layouts.master')

@section('title', 'Success')

@push('frontend_style')
    @include('frontend.pages.common.style')
@endpush

@section('frontend_content')
<!-- Start Page Title Area -->
<div class="page-title-area" style="background-image: url('{{ asset('assets/frontend/img/page-bg.jpg') }}')">
    <div class="container">
        <div class="page-title-content">
            <h2>{{ __('Success') }}</h2>
            <ul>
                <li>
                    <a href="{{ route('home') }}">
                        Home
                    </a>
                </li>
                <li>{{ __('Success') }}</li>
            </ul>
        </div>
    </div>
</div>
<!-- End Page Title Area -->

<!-- Start Book Table Area -->
<section class="" style="
background-image: url('{{ asset('mail/mail_bg.webp') }}');
background-repeat: no-repeat;
background-size: cover;
background-position: center;">
    <div class="container">
        <div class="row py-5">
            <div class="col-md-12">
                <div class="text-center">
                    <h1>CONGRATULATIONS {{ $booking->user->name }} !!</h1>
                    <h5>Your payment of <span style="color: #cc8c18;">${{ $booking->total_amount }}</span> has been successfully processed.</h5>
                </div>
                <div class="row py-5">
                    <div class="col-lg-6">
                        <h4>Your booking details:</h4>
                        <ul class="list-unstyle">
                            <li><strong>Room No:</strong> {{ $booking->room->title }}</li>
                            <li><strong>Check-in Date:</strong> {{ $booking->checkin_date }}</li>
                            <li><strong>Check-out Date:</strong> {{ $booking->checkout_date }}</li>
                            <li><strong>Total Payment Amount:</strong> ${{ $booking->total_amount }}</li>
                            <li><strong>Total Adults:</strong> {{ $booking->total_adults }}</li>
                            <li><strong>Total Children:</strong> {{ $booking->total_children }}</li>
                        </ul>
                        <p>Thank you for your payment and for choosing our services. We look forward to serving you during your stay.</p>
                    </div>
                    <div class="col-lg-6">
                        <p>Best regards,<br><h6>Royal Palace</h6></p>
                    </div>
                </div>

            </div>
        </div>

    </div>
</section>
<!-- End  Book Table Area -->
@endsection

@push('frontend_script')
    @include('frontend.pages.common.script')
@endpush
