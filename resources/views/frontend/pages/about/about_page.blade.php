@extends('frontend.layouts.master')

@section('title', $about->title ?? null)

@push('frontend_style')
    @include('frontend.pages.common.style')
@endpush

@section('frontend_content')
    <!-- Start Page Title Area -->
    <div class="page-title-area" style="background-image: url('{{ asset('assets/frontend/img/page-bg.jpg') }}')">
        <div class="container">
            <div class="page-title-content">
                <h2>{{ $about->title ?? null }}</h2>
                <ul>
                    <li>
                        <a href="index.html">
                            Home
                        </a>
                    </li>
                    <li>{{ $about->title ?? null }}</li>
                    <li>{{ $about->title ?? null }}</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- End Page Title Area -->

    <!-- Start Book Table Area -->
    <!-- Start Explore Area -->
    <section class="explore-area ptb-100">
        <div class="container">
            <div class="section-title">
                <span>Explore</span>
                <h2>{{ $about->sub_title ?? null }}</h2>
            </div>
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="explore-img">
                        <img src="{{ asset($about->about_image ?? null) }}" alt="Image">
                    </div>
                </div>
                <div class="col-lg-6">
                    {!! $about->description ?? null !!}
                </div>

            </div>
        </div>
    </section>
    <!-- End Explore Area -->

    <!-- Start Our Rooms Area -->
    <section class="our-rooms-area pb-100">
        <div class="container">
            <div class="section-title">
                <span>Our Rooms</span>
                <h2>Fascinating rooms & suites</h2>
            </div>
            <div class="tab industries-list-tab">
                <div class="row">
                    <div class="col-lg-4">
                        <ul class="tabs">
                            @foreach ($room_types as $room_type)
                                <li class="single-rooms">
                                    <img src="{{ asset('uploads/room_types') }}/{{ $room_type->sm_image }}" alt="Image">
                                    <div class="room-content">
                                        <h3>{{ $room_type->title }}</h3>
                                        <span>{{ $room_type->occupancy }}</span>
                                    </div>
                                </li>
                            @endforeach

                        </ul>
                    </div>
                    <div class="col-lg-8">
                        <div class="tab_content">
                            @foreach ($room_types as $room_type)
                                <div class="tabs_item">
                                    <div class="our-rooms-single-img room-bg-1"
                                        style="background-image: url('{{ asset('uploads/room_types') }}/{{ $room_type->lg_image }}')">
                                    </div>
                                    <span class="preview-item">The Preview Of Double Room</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Our Rooms Area -->

    <!-- Start City View Area -->
    <section class="city-view-area ptb-100"
        style="background-image: url('{{ asset('assets/frontend/img/city/city-bg.jpg') }}')">
        <div class="container">
            <div class="city-wrap">
                <div class="single-city-item owl-carousel owl-theme">
                    <div class="city-view-single-item">
                        <div class="city-content">
                            <span>The City View</span>
                            <h3>A charming view of the city town</h3>
                            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Consequuntur necessitatibus fugit
                                eligendi accusantium vel quos debitis cupiditate ducimus placeat explicabo distinctio,
                                consectetur eos animi, a voluptate delectus.
                                Id, explicabo saepe Consequuntur</p>

                            <p>The view onin wansis dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                incididunt ut labore et dolore magna aliqua. ad minim veniam, quis nostrud exercitation
                                consectetur.</p>
                        </div>
                    </div>
                    <div class="city-view-single-item">
                        <div class="city-content">
                            <span>The City View</span>
                            <h3>The charming view of the city</h3>
                            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Consequuntur necessitatibus fugit
                                eligendi accusantium vel quos debitis cupiditate ducimus placeat explicabo distinctio,
                                consectetur eos animi, a voluptate delectus.
                                Id, explicabo saepe Consequuntur</p>

                            <p>The view onin wansis dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                incididunt ut labore et dolore magna aliqua. ad minim veniam, quis nostrud exercitation
                                consectetur.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End City View Area -->

    <!-- Start Counter Area -->
    <section class="counter-area pt-100 pb-70 jarallax bg-dark">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <div class="single-counter">
                        <p>Beaches</p>
                        <h2>
                            <span class="odometer" data-count="50">00</span> <span class="target">+</span>
                        </h2>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="single-counter">
                        <p>Spa offers</p>
                        <h2>
                            <span class="odometer" data-count="95">00</span> <span class="target">+</span>
                        </h2>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="single-counter">
                        <p>Rooms</p>
                        <h2>
                            <span class="odometer" data-count="45">00</span> <span class="target">+</span>
                        </h2>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="single-counter">
                        <p>Happy client</p>
                        <h2>
                            <span class="odometer" data-count="20">00</span> <span class="target">K</span>
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Counter Area -->

    <!-- start Testimonials Area -->
    <section class="testimonials-area pt-100 pb-100">
        <div class="container">
            <div class="section-title">
                <span>Testimonials</span>
                <h2>What customers say</h2>
            </div>
            <div class="testimonials-wrap owl-carousel owl-theme">
                <div class="single-testimonials"
                    style="background-image: url('{{ asset('assets/frontend/img/testimonials/testimonials-bg.png') }}')">
                    <ul>
                        <li>
                            <i class="bx bxs-star"></i>
                        </li>
                        <li>
                            <i class="bx bxs-star"></i>
                        </li>
                        <li>
                            <i class="bx bxs-star"></i>
                        </li>
                        <li>
                            <i class="bx bxs-star"></i>
                        </li>
                        <li>
                            <i class="bx bxs-star"></i>
                        </li>
                    </ul>
                    <h3>Excellent Room</h3>
                    <p>“Awesome yksum dolor sit ametco elit, sed do eiusmod tempor incididunt et md do eiusmoeiusmod tempor
                        inte emamnsecacing eiusmoeiusmod”</p>
                    <div class="testimonials-content">
                        <img src="{{ asset('assets/frontend') }}/img/testimonials/2.jpg" alt="Image">
                        <h4>Ayman Jenis</h4>
                        <span>CEO@Leasuely</span>
                    </div>
                </div>
                <div class="single-testimonials"
                    style="background-image: url('{{ asset('assets/frontend/img/testimonials/testimonials-bg.png') }}')">
                    <ul>
                        <li>
                            <i class="bx bxs-star"></i>
                        </li>
                        <li>
                            <i class="bx bxs-star"></i>
                        </li>
                        <li>
                            <i class="bx bxs-star"></i>
                        </li>
                        <li>
                            <i class="bx bxs-star"></i>
                        </li>
                        <li>
                            <i class="bx bxs-star"></i>
                        </li>
                    </ul>
                    <h3>Excellent hotel</h3>
                    <p>“Awesome yksum dolor sit ametco elit, sed do eiusmod tempor incididunt et md do eiusmoeiusmod tempor
                        inte emamnsecacing eiusmoeiusmod”</p>
                    <div class="testimonials-content">
                        <img src="{{ asset('assets/frontend') }}/img/testimonials/3.jpg" alt="Image">
                        <h4>Ayman Jenis</h4>
                        <span>CEO@Leasuely</span>
                    </div>
                </div>
                <div class="single-testimonials"
                    style="background-image: url('{{ asset('assets/frontend/img/testimonials/testimonials-bg.png') }}')">
                    <ul>
                        <li>
                            <i class="bx bxs-star"></i>
                        </li>
                        <li>
                            <i class="bx bxs-star"></i>
                        </li>
                        <li>
                            <i class="bx bxs-star"></i>
                        </li>
                        <li>
                            <i class="bx bxs-star"></i>
                        </li>
                        <li>
                            <i class="bx bxs-star"></i>
                        </li>
                    </ul>
                    <h3>Excellent Swimming</h3>
                    <p>“Awesome yksum dolor sit ametco elit, sed do eiusmod tempor incididunt et md do eiusmoeiusmod tempor
                        inte emamnsecacing eiusmoeiusmod”</p>
                    <div class="testimonials-content">
                        <img src="{{ asset('assets/frontend') }}/img/testimonials/1.jpg" alt="Image">
                        <h4>Ayman Jenis</h4>
                        <span>CEO@Leasuely</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- End Testimonials Area -->

@endsection

@push('frontend_script')
    @include('frontend.pages.common.script')
@endpush
