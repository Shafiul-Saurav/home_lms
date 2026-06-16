@extends('frontend.layouts.master')

@section('title', 'About')

@push('frontend_style')
@endpush

@section('frontend_content')
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

        <!-- counter area -->
        @include('frontend.pages.widgets.counter_area')
        <!-- counter area end -->

        <!-- team-area -->
        <div class="team-area py-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 mx-auto">
                        <div class="site-heading text-center wow fadeInDown" data-wow-delay=".25s">
                            <span class="site-title-tagline"><i class="far fa-lightbulb-on"></i> Our Team</span>
                            <h2 class="site-title">Meet With Our <span class="text-gradient">Experts</span></h2>
                        </div>
                    </div>
                </div>
                <div class="row g-4 g-lg-5">
                    <div class="col-md-6 col-lg-3">
                        <div class="team-item wow fadeInUp" data-wow-delay=".25s">
                            <div class="team-img">
                                <img src="{{ asset('assets/frontend') }}/img/team/01.webp" alt="thumb" />
                                <div class="team-social-wrap">
                                    <div class="team-social-btn">
                                        <button type="button"><i class="far fa-share-alt"></i></button>
                                    </div>
                                    <div class="team-social">
                                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                                        <a href="#"><i class="fab fa-x-twitter"></i></a>
                                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                        <a href="#"><i class="fab fa-youtube"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="team-content">
                                <h4><a href="team.html">Rodrigues Christy</a></h4>
                                <span>Project Manager</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="team-item wow fadeInDown" data-wow-delay=".25s">
                            <div class="team-img">
                                <img src="{{ asset('assets/frontend') }}/img/team/02.webp" alt="thumb" />
                                <div class="team-social-wrap">
                                    <div class="team-social-btn">
                                        <button type="button"><i class="far fa-share-alt"></i></button>
                                    </div>
                                    <div class="team-social">
                                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                                        <a href="#"><i class="fab fa-x-twitter"></i></a>
                                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                        <a href="#"><i class="fab fa-youtube"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="team-content">
                                <h4><a href="team.html">Matthew Hong</a></h4>
                                <span>CEO & Founder</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="team-item wow fadeInUp" data-wow-delay=".25s">
                            <div class="team-img">
                                <img src="{{ asset('assets/frontend') }}/img/team/03.webp" alt="thumb" />
                                <div class="team-social-wrap">
                                    <div class="team-social-btn">
                                        <button type="button"><i class="far fa-share-alt"></i></button>
                                    </div>
                                    <div class="team-social">
                                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                                        <a href="#"><i class="fab fa-x-twitter"></i></a>
                                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                        <a href="#"><i class="fab fa-youtube"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="team-content">
                                <h4><a href="team.html">Anita Bentley</a></h4>
                                <span>Marketing Manager</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="team-item wow fadeInDown" data-wow-delay=".25s">
                            <div class="team-img">
                                <img src="{{ asset('assets/frontend') }}/img/team/04.webp" alt="thumb" />
                                <div class="team-social-wrap">
                                    <div class="team-social-btn">
                                        <button type="button"><i class="far fa-share-alt"></i></button>
                                    </div>
                                    <div class="team-social">
                                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                                        <a href="#"><i class="fab fa-x-twitter"></i></a>
                                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                        <a href="#"><i class="fab fa-youtube"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="team-content">
                                <h4><a href="team.html">Beverly Dyer</a></h4>
                                <span>System Engineer</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- team-area end -->

        <!-- testimonial-area -->
        @include('frontend.pages.widgets.testimonial_area')
        <!-- testimonial-area end -->

        <!-- process area -->
        <div class="process-area py-120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 mx-auto">
                        <div class="site-heading text-center wow fadeInDown" data-wow-delay=".25s">
                            <span class="site-title-tagline"><i class="far fa-lightbulb-on"></i> Working Process</span>
                            <h2 class="site-title">Easy steps for <span class="text-gradient">start Learning</span></h2>
                        </div>
                    </div>
                </div>
                <div class="process-wrap wow fadeInUp" data-wow-delay=".25s">
                    <div class="row g-4">
                        <div class="col-md-6 col-xl-4">
                            <div class="process-item">
                                <span class="count">01</span>
                                <div class="icon">
                                    <img src="{{ asset('assets/frontend') }}/img/icon/learn.svg" alt="" />
                                </div>
                                <div class="content">
                                    <h4>Find & Enroll Course</h4>
                                    <p>It is a long established fact the readable content of a page.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-4">
                            <div class="process-item">
                                <span class="count">02</span>
                                <div class="icon">
                                    <img src="{{ asset('assets/frontend') }}/img/icon/course-2.svg" alt="" />
                                </div>
                                <div class="content">
                                    <h4>Start Your Course</h4>
                                    <p>It is a long established fact the readable content of a page.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-4">
                            <div class="process-item">
                                <span class="count">03</span>
                                <div class="icon">
                                    <img src="{{ asset('assets/frontend') }}/img/icon/expert.svg" alt="" />
                                </div>
                                <div class="content">
                                    <h4>Become Master</h4>
                                    <p>It is a long established fact the readable content of a page.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- process area end -->

        <!-- cta area -->
        <div class="cta-area pb-120">
            <div class="container">
                <div class="cta-wrap">
                    <div class="row align-items-center">
                        <div class="col-lg-6 col-xl-5">
                            <div class="cta-content wow fadeInUp" data-wow-delay=".25s">
                                <h1>Get access <span>2,550+</span> of our top courses</h1>
                                <p>It is long established fact that reader will by the content of page when looking at its
                                    layout.</p>
                                <a href="contact.html" class="theme-btn">Get Started<i
                                        class="fas fa-arrow-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xl-7">
                            <div class="cta-img">
                                <img src="{{ asset('assets/frontend') }}/img/cta/01.jpg" alt="" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('frontend_script')
@endpush
