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
        <div class="about-area py-120">
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
                            <div class="about-experience">
                                <h5>30<span>+</span></h5>
                                <p>Years Of Experience</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="about-right wow fadeInUp" data-wow-delay=".25s">
                            <div class="site-heading mb-3">
                                <span class="site-title-tagline"><i class="far fa-lightbulb-on"></i> About Us</span>
                                {!! $about->description !!}
                            </div>
                            <div class="about-content">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="about-item">
                                            <div class="icon">
                                                <img src="{{ asset('assets/frontend') }}/img/icon/learn.svg" alt="" />
                                            </div>
                                            <div class="content">
                                                <h6>Flexible Learning</h6>
                                                <p>Take a look at our up of the round shows</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="about-item">
                                            <div class="icon">
                                                <img src="{{ asset('assets/frontend') }}/img/icon/support.svg" alt="" />
                                            </div>
                                            <div class="content">
                                                <h6>24/7 Live Support</h6>
                                                <p>Take a look at our up of the round shows</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a href="about.html" class="theme-btn">Discover More<i class="fas fa-arrow-right"></i></a>
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
