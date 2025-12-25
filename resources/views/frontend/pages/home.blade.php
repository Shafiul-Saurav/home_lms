@extends('frontend.layouts.master')

@section('title', 'Home')

@push('frontend_style')

@endpush

@section('frontend_content')
    <main class="main">
        <!-- hero area -->
        @include('frontend.pages.widgets.hero_section')
        <!-- hero area end -->

        <!-- partner area -->
        @include('frontend.pages.widgets.partner_area')
        <!-- partner area end -->

        <!-- about area -->
        @include('frontend.pages.widgets.about_area')
        <!-- about area end -->

        <!-- category area -->
        @include('frontend.pages.widgets.category_area')
        <!-- category area end -->

        <!-- course area -->
        @include('frontend.pages.widgets.course_area')
        <!-- course area end -->

        <!-- choose area -->
        @include('frontend.pages.widgets.choose_area')
        <!-- choose area end -->

        <!-- counter area -->
        @include('frontend.pages.widgets.counter_area')
        <!-- counter area end -->

        <!-- pricing area -->
        @include('frontend.pages.widgets.pricing_area')
        <!-- pricing area end -->

        <!-- feature-area -->
        @include('frontend.pages.widgets.feature_area')
        <!-- feature-area end -->

        <!-- video-area -->
        @include('frontend.pages.widgets.video_area')
        <!-- video-area end -->

        <!-- instructor -->
        @include('frontend.pages.widgets.instructor')
        <!-- instructor end -->

        <!-- course tab -->
        @include('frontend.pages.widgets.course_tab')
        <!-- course tab end -->

        <!-- cta area -->
        @include('frontend.pages.widgets.cta_area')
        <!-- cta area end -->

        <!-- process area -->
        @include('frontend.pages.widgets.process_area')
        <!-- process area end -->

        <!-- skill-area -->
        @include('frontend.pages.widgets.skill_area')
        <!-- skill area end -->

        <!-- testimonial-area -->
        @include('frontend.pages.widgets.testimonial_area')
        <!-- testimonial-area end -->

        <!-- blog-area -->
        @include('frontend.pages.widgets.blog_area')
        <!-- blog-area end -->

        <!-- download area -->
        @include('frontend.pages.widgets.download_area')
        <!-- download end -->
    </main>
@endsection

@push('frontend_script')

@endpush
