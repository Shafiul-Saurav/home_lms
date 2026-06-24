@extends('frontendone.layouts.master')

@section('title', 'Home')

@push('frontendone_style')
@endpush

@section('frontendone_content')
    <main class="main">
        <!-- Service Section -->
        @include('frontendone.pages.widgets.service_section')

        <!-- Course Section -->
        @include('frontendone.pages.widgets.course_section')

        <!-- Mentor Section -->
        @include('frontendone.pages.widgets.mentor_section')

        <!-- News Section -->
        @include('frontendone.pages.widgets.news_section')

        <!-- achievement section  -->
        @include('frontendone.pages.widgets.achievement_section')

        <!-- Gallery Section -->
        @include('frontendone.pages.widgets.gallery_section')

        <!-- Brand Logo Carousel -->
        @include('frontendone.pages.widgets.brand_section')

        <!-- Student Review -->
        @include('frontendone.pages.widgets.review_section')

    </main>
@endsection

@push('frontendone_script')
@endpush
