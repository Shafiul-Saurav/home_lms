@extends('frontend.layouts.master')

@section('title', 'Services')

@push('frontend_style')
    @include('frontend.pages.common.style')
@endpush

@section('frontend_content')
<!-- Start Page Title Area -->
<div class="page-title-area" style="background-image: url('{{ asset('assets/frontend/img/page-bg.jpg') }}')">
    <div class="container">
        <div class="page-title-content">
            <h2>Services</h2>
            <ul>
                <li>
                    <a href="{{ route('home') }}">
                        Home
                    </a>
                </li>
                <li>Services</li>
            </ul>
        </div>
    </div>
</div>
<!-- End Page Title Area -->
<!-- End Facilities Area -->
<section class="facilities-area pt-100 pb-70">
    <div class="container">
        <div class="section-title">
            <span>Services</span>
            <h2>Giving entirely awesome Services</h2>
        </div>
        <div class="row">
            @forelse ($services as $service)
            <div class="col-lg-3 col-sm-6">
                <div class="single-facilities-wrap">
                    <div class="single-facilities">
                        {!! $service->service_icon !!}
                        <h3> {{ $service->title }} ​</h3>
                        <p>{!! $service->description !!}</p>
                        <a href="service-details.html" class="icon-btn">
                            <i class="flaticon-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            @empty

            @endforelse

        </div>
    </div>
</section>
<!-- End Facilities Area -->

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
                            <div class="our-rooms-single-img room-bg-1" style="background-image: url('{{ asset('uploads/room_types') }}/{{ $room_type->lg_image }}')">
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
@endsection

@push('frontend_script')
    @include('frontend.pages.common.script')
@endpush
