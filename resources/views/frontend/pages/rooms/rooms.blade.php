@extends('frontend.layouts.master')

@section('title', 'Rooms')

@push('frontend_style')

@endpush

@section('frontend_content')
<!-- Start Page Title Area -->
<div class="page-title-area" style="background-image: url('{{ asset('assets/frontend/img/page-bg.jpg') }}')">
    <div class="container">
        <div class="page-title-content">
            <h2>Rooms</h2>
            <ul>
                <li>
                    <a href="index.html">
                        Home
                    </a>
                </li>
                <li>Pages</li>
                <li>Rooms</li>
            </ul>
        </div>
    </div>
</div>
<!-- End Page Title Area -->

<!-- Start Rooms Area -->
<section class="our-rooms-area ptb-100">
    <div class="container">
        <div class="section-title">
            <span>Our Rooms</span>
            <h2>Fascinating rooms & suites</h2>
        </div>
        <div class="row">
            <div class="col-lg-4 col-sm-6">
                <div class="single-rooms-three-wrap">
                    <div class="single-rooms-three">
                        <a href="{{ route('room.details') }}">
                            <img src="{{asset('assets/frontend')}}/img/rooms/5.jpg" alt="Image"></a>
                        <div class="single-rooms-three-content">
                            <h3>Deluxe Room for Relax</h3>
                            <ul class="rating">
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
                            <span class="price">From $50.6/night</span>
                            <a href="book-table.html" class="default-btn">
                                Book Online
                                <i class="flaticon-right"></i>
                            </a>
                            <span class="information" data-toggle="tooltip" data-placement="top" title="Swimming doller dolor sit aet odu tur adiing elitse">
                                <i class='bx bx-info-circle'></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6">
                <div class="single-rooms-three-wrap">
                    <div class="single-rooms-three">
                        <img src="{{asset('assets/frontend')}}/img/rooms/6.jpg" alt="Image">
                        <div class="single-rooms-three-content">
                            <h3>Double Room</h3>
                            <ul class="rating">
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
                            <span class="price">From $60.6/night</span>
                            <a href="book-table.html" class="default-btn">
                                Book Online
                                <i class="flaticon-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6">
                <div class="single-rooms-three-wrap">
                    <div class="single-rooms-three">
                        <img src="{{asset('assets/frontend')}}/img/rooms/7.jpg" alt="Image">
                        <div class="single-rooms-three-content">
                            <h3>Trippe Bed Room</h3>
                            <ul class="rating">
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
                            <span class="price">From $50.6/night</span>
                            <a href="book-table.html" class="default-btn">
                                Book Online
                                <i class="flaticon-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6">
                <div class="single-rooms-three-wrap">
                    <div class="single-rooms-three">
                        <img src="{{asset('assets/frontend')}}/img/rooms/8.jpg" alt="Image">
                        <div class="single-rooms-three-content">
                            <h3>Window Amenities Room</h3>
                            <ul class="rating">
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
                            <span class="price">From $50.6/night</span>
                            <a href="book-table.html" class="default-btn">
                                Book Online
                                <i class="flaticon-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6">
                <div class="single-rooms-three-wrap">
                    <div class="single-rooms-three">
                        <img src="{{asset('assets/frontend')}}/img/rooms/9.jpg" alt="Image">
                        <div class="single-rooms-three-content">
                            <h3>The royal room</h3>
                            <ul class="rating">
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
                            <span class="price">From $50.6/night</span>
                            <a href="book-table.html" class="default-btn">
                                Book Online
                                <i class="flaticon-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6">
                <div class="single-rooms-three-wrap">
                    <div class="single-rooms-three">
                        <img src="{{asset('assets/frontend')}}/img/rooms/10.jpg" alt="Image">
                        <div class="single-rooms-three-content">
                            <h3>Budget Room</h3>
                            <ul class="rating">
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
                            <span class="price">From $90.6/night</span>
                            <a href="book-table.html" class="default-btn">
                                Book Online
                                <i class="flaticon-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="page-navigation-area">
                    <nav aria-label="Page navigation example text-center">
                        <ul class="pagination">
                            <li class="page-item">
                                <a class="page-link page-links" href="room-grid-view.html">
                                    <i class='bx bx-chevrons-left'></i>
                                </a>
                            </li>
                            <li class="page-item active">
                                <a class="page-link" href="room-grid-view.html">1</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="room-grid-view.html">2</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="room-grid-view.html">3</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="room-grid-view.html">
                                    <i class='bx bx-chevrons-right'></i>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Rooms Area -->
@endsection

@push('frontend_script')

@endpush
