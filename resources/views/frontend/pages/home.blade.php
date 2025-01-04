@extends('frontend.layouts.master')

@section('title', 'Home')

@push('frontend_style')
<style>
    .single_testimonial ul li .text_warning{
        color: #f4a708;
    }
    .single_testimonial ul li .text_light{
        color: #ccc;
    }
</style>
@endpush

@section('frontend_content')
    <!-- Start Ecorik Slider Area -->
    @include('frontend.pages.widgets.hero_slider')
    <!-- End Ecorik Slider Area -->

    <!-- Start Check Area -->
    @include('frontend.pages.widgets.check_area') <!-- Panding -->
    <!-- End Check Section -->

    <!-- Start Explore Area -->
    @include('frontend.pages.widgets.explore_area')
    <!-- End Explore Area -->

    <!-- End Facilities Area -->
    @include('frontend.pages.widgets.facilities_area') <!-- Panding -->
    <!-- End Facilities Area -->

    <!-- End Incredible Area -->
    @include('frontend.pages.widgets.incredible_area') <!-- Panding -->
    <!-- End Incredible Area -->

    <!-- Start Our Rooms Area -->
    @include('frontend.pages.widgets.room_area')
    <!-- End Our Rooms Area -->

    <!-- Start City View Area -->
    @include('frontend.pages.widgets.city_view_area') <!-- Panding -->
    <!-- End City View Area -->

    <!-- Start Exclusive Area -->
    @include('frontend.pages.widgets.exclusive_area') <!-- Panding -->
    <!-- End Exclusive Area -->

    <!-- Start Booking Area -->
    @include('frontend.pages.widgets.booking_area') <!-- Panding -->
    <!-- End Booking Area -->

    <!-- Start Restaurants Area -->
    @include('frontend.pages.widgets.restaurant_area') <!-- Panding -->
    <!-- End Restaurants Area -->

    <!-- start Testimonials Area -->
    @include('frontend.pages.widgets.testimonial_area')
    <!-- End Testimonials Area -->

    <!-- End News Area -->
    @include('frontend.pages.widgets.news_area')
    <!-- End News Area -->
@endsection

@push('frontend_script')

@endpush
