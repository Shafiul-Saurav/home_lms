@extends('frontendone.layouts.master')

@section('title', 'About')

@push('frontendone_style')
    @include('frontend.pages.common.style')
    
@endpush

@section('frontendone_content')
    <main class="main">
        <!-- breadcrumb -->
        <x-frontend.pages.common.breadcrumb
            :title="'About Us'"
            :breadcrumb="[
                ['name' => 'Home', 'url' => route('home')],
                ['name' => 'About Us', 'url' => '#']
            ]"
        />
        <!-- breadcrumb end -->

        <!-- about area -->
        <div class="about-area py-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="about-left wow fadeInLeft" data-wow-delay=".25s">
                            <div class="about-img">
                                <div class="row g-0">
                                    <div class="col-6">
                                        <img class="img-1" src="{{ asset($about->about_image_2nd??null) }}" alt="" />
                                    </div>
                                    <div class="col-6">
                                        <img class="img-2" src="{{ asset($about->about_image??null) }}" alt="" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="about-right wow fadeInUp" data-wow-delay=".25s">
                            <div class="site-heading mb-3">
                                <span class="site-title-tagline"><i class="far fa-lightbulb-on"></i> About Us</span>
                                {!! $about->description !!}
                            </div>
                            <a href="{{ route('about') }}" class="enroll-btn">Discover More<i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- about area end -->
        
    </main>
@endsection

@push('frontendone_script')
    @include('frontend.pages.common.script')
@endpush
