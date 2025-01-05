@extends('frontend.layouts.master')

@section('title', $room->title)

@push('frontend_style')
    @include('frontend.pages.common.style')
@endpush

@section('frontend_content')
<!-- Start Page Title Area -->
<div class="page-title-area" style="background-image: url('{{ asset('assets/frontend/img/page-bg.jpg') }}')">
    <div class="container">
        <div class="page-title-content">
            <h2>{{ $room->title }}</h2>
            <ul>
                <li>
                    <a href="{{ route('home') }}">
                        Home
                    </a>
                </li>
                <li>{{ $room->roomtype->title }}</li>
                <li>{{ $room->title }}</li>
            </ul>
        </div>
    </div>
</div>
<!-- End Page Title Area -->

<!-- Start Book Table Area -->
<section class="book-table-area-three">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6 p-0">
                <div class="books-froms-wrap">
                    <div class="d-table">
                        <div class="d-table-cell">
                            <div class="book-from books-froms">
                                <h3>Book your Table</h3>
                                <form action="{{ url('user/stripe') }}">
                                    @csrf
                                    <input type="hidden" name="room_id" value="{{ $room->id }}">
                                    <input type="hidden" name="total_amount" value="{{ $room->price }}">
                                    <div class="form-group">
                                        <div class="select-box">
                                            <i class='bx bx-calendar'></i>
                                            <div class="input-group">
                                                <input type="date" name="checkin_date" class="form-control
                                                @error('checkin_date')
                                                    is-invalid
                                                @enderror" placeholder="Checkin Date">
                                                <span class="input-group-addon">
                                                    <i class="glyphicon glyphicon-th"></i>
                                                </span>
                                                @error('checkin_date')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="select-box">
                                            <i class='bx bx-calendar'></i>
                                            <div class="input-group"> <!-- public/assets/frontend/js/custom.js 380Line -->
                                                <input type="date" name="checkout_date" class="form-control
                                                @error('checkout_date')
                                                    is-invalid
                                                @enderror" placeholder="Checkout Date">
                                                <span class="input-group-addon">
                                                    <i class="glyphicon glyphicon-th"></i>
                                                </span>
                                                @error('checkout_date')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="select-box">
                                            <i class='bx bx-user'></i>
                                            <div class="input-group">
                                                <input type="text" name="total_adults" class="form-control
                                                @error('total_adults')
                                                    is-invalid
                                                @enderror" placeholder="Total Adult">
                                                <span class="input-group-addon">
                                                    <i class="glyphicon glyphicon-th"></i>
                                                </span>
                                                @error('total_adults')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="select-box">
                                            <i class='bx bx-group'></i>
                                            <div class="input-group">
                                                <input type="text" name="total_children" class="form-control
                                                @error('total_children')
                                                    is-invalid
                                                @enderror" placeholder="Total Children">
                                                <span class="input-group-addon">
                                                    <i class="glyphicon glyphicon-th"></i>
                                                </span>
                                                @error('total_children')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="default-btn">
                                        Book Now
                                        <i class="flaticon-right"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 p-0">
                <div class="contact-info-wrap">
                    <div class="contact-info">
                        <h3>Our Contract Info</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adip suspendisse ultrices gravida. Risus commodo svel facilisis.</p>
                        <ul>
                            <li>
                                <a href="tel:+800-987-65-43">
                                    <i class='bx bx-phone-call'></i>
                                    +800-987-65-43
                                </a>
                            </li>
                            <li>
                                <a href="tel:+800-987-65-43">
                                    <i class='bx bx-phone-call'></i>
                                    +800-987-65-40
                                </a>
                            </li>
                        </ul>
                        <ul>
                            <li>
                                <a href="/cdn-cgi/l/email-protection#335b565f5f5c7356505c415a581d505c5e">
                                    <i class='bx bx-envelope'></i>
                                    <span class="__cf_email__" data-cfemail="cba3aea7a7a48baea8a4b9a2a0e5a8a4a6">[email&#160;protected]</span>
                                </a>
                            </li>
                            <li>
                                <a href="/cdn-cgi/l/email-protection#771e19111837121418051e1c5914181a">
                                    <i class='bx bx-envelope'></i>
                                    <span class="__cf_email__" data-cfemail="0f666169604f6a6c607d6664216c6062">[email&#160;protected]</span>
                                </a>
                            </li>
                        </ul>
                        <span>
                            <i class='bx bx-location-plus'></i>
                            205 Fida Walinton, Tongo Street Front The USA
                        </span>
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
