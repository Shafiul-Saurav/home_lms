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
                                        <img class="img-1" src="{{ asset('assets/frontend') }}/img/about/01.jpg" alt="" />
                                    </div>
                                    <div class="col-6">
                                        <img class="img-2" src="{{ asset('assets/frontend') }}/img/about/02.jpg" alt="" />
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
                                <h2 class="site-title">Whether you want <span class="text-gradient">to learn or share</span>
                                    what you know</h2>
                            </div>
                            <p class="about-text">
                                There are many variations of passages of Lorem Ipsum available, but the majority have
                                suffered alteration in some form, by
                                injected humour, or randomised words which don't look even.
                            </p>
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
        <div class="counter-area">
            <div class="counter-wrap">
                <div class="col-lg-11 ms-lg-auto">
                    <div class="row g-4">
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="counter-box wow fadeInUp" data-wow-delay=".25s">
                                <div class="icon">
                                    <img src="{{ asset('assets/frontend') }}/img/icon/student.svg" alt="" />
                                </div>
                                <div class="content">
                                    <div class="info">
                                        <span class="counter" data-count="+" data-to="150" data-speed="3000">150</span>
                                        <span class="unit">k</span>
                                    </div>
                                    <h6 class="title">Students Enrolled</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="counter-box wow fadeInDown" data-wow-delay=".25s">
                                <div class="icon">
                                    <img src="{{ asset('assets/frontend') }}/img/icon/course-2.svg" alt="" />
                                </div>
                                <div class="content">
                                    <div class="info">
                                        <span class="counter" data-count="+" data-to="25" data-speed="3000">25</span>
                                        <span class="unit">K</span>
                                    </div>
                                    <h6 class="title">Total Courses</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="counter-box wow fadeInUp" data-wow-delay=".25s">
                                <div class="icon">
                                    <img src="{{ asset('assets/frontend') }}/img/icon/instructor-2.svg" alt="" />
                                </div>
                                <div class="content">
                                    <div class="info">
                                        <span class="counter" data-count="+" data-to="120" data-speed="3000">120</span>
                                        <span class="unit">+</span>
                                    </div>
                                    <h6 class="title">Expert Tutors</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="counter-box wow fadeInDown" data-wow-delay=".25s">
                                <div class="icon">
                                    <img src="{{ asset('assets/frontend') }}/img/icon/award.svg" alt="" />
                                </div>
                                <div class="content">
                                    <div class="info">
                                        <span class="counter" data-count="+" data-to="50" data-speed="3000">50</span>
                                        <span class="unit">+</span>
                                    </div>
                                    <h6 class="title">Win Awards</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                                <img src="{{ asset('assets/frontend') }}/img/team/01.jpg" alt="thumb" />
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
                                <img src="{{ asset('assets/frontend') }}/img/team/02.jpg" alt="thumb" />
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
                                <img src="{{ asset('assets/frontend') }}/img/team/03.jpg" alt="thumb" />
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
                                <img src="{{ asset('assets/frontend') }}/img/team/04.jpg" alt="thumb" />
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
        <div class="testimonial-area ts-bg pt-80 pb-70">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 mx-auto">
                        <div class="site-heading text-center wow fadeInDown" data-wow-delay=".25s">
                            <span class="site-title-tagline"><i class="far fa-lightbulb-on"></i> Testimonials</span>
                            <h2 class="site-title">What Our Client <span class="text-gradient">Say's About Us</span></h2>
                        </div>
                    </div>
                </div>
                <div class="testimonial-slider owl-carousel owl-theme wow fadeInUp" data-wow-delay=".25s">
                    <div class="testimonial-item">
                        <div class="content">
                            <div class="icon">
                                <img src="{{ asset('assets/frontend') }}/img/icon/quote.svg" alt="" />
                            </div>
                            <div class="rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <div class="quote">
                                <p>
                                    There are many variations of passage available the majority have suffered of alteration
                                    of the some humour words look
                                    even slightly form by the injected to default model believable.
                                </p>
                            </div>
                            <div class="author">
                                <div class="author-img">
                                    <img src="{{ asset('assets/frontend') }}/img/testimonial/01.jpg" alt="" />
                                </div>
                                <div class="author-info">
                                    <h5>Niesha Phips</h5>
                                    <p>Student</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-item">
                        <div class="content">
                            <div class="icon">
                                <img src="{{ asset('assets/frontend') }}/img/icon/quote.svg" alt="" />
                            </div>
                            <div class="rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <div class="quote">
                                <p>
                                    There are many variations of passage available the majority have suffered of alteration
                                    of the some humour words look
                                    even slightly form by the injected to default model believable.
                                </p>
                            </div>
                            <div class="author">
                                <div class="author-img">
                                    <img src="{{ asset('assets/frontend') }}/img/testimonial/02.jpg" alt="" />
                                </div>
                                <div class="author-info">
                                    <h5>Eugene Ivan</h5>
                                    <p>Student</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-item">
                        <div class="content">
                            <div class="icon">
                                <img src="{{ asset('assets/frontend') }}/img/icon/quote.svg" alt="" />
                            </div>
                            <div class="rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <div class="quote">
                                <p>
                                    There are many variations of passage available the majority have suffered of alteration
                                    of the some humour words look
                                    even slightly form by the injected to default model believable.
                                </p>
                            </div>
                            <div class="author">
                                <div class="author-img">
                                    <img src="{{ asset('assets/frontend') }}/img/testimonial/03.jpg" alt="" />
                                </div>
                                <div class="author-info">
                                    <h5>Martha Brown</h5>
                                    <p>Student</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-item">
                        <div class="content">
                            <div class="icon">
                                <img src="{{ asset('assets/frontend') }}/img/icon/quote.svg" alt="" />
                            </div>
                            <div class="rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <div class="quote">
                                <p>
                                    There are many variations of passage available the majority have suffered of alteration
                                    of the some humour words look
                                    even slightly form by the injected to default model believable.
                                </p>
                            </div>
                            <div class="author">
                                <div class="author-img">
                                    <img src="{{ asset('assets/frontend') }}/img/testimonial/04.jpg" alt="" />
                                </div>
                                <div class="author-info">
                                    <h5>Robert Dese</h5>
                                    <p>Student</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-item">
                        <div class="content">
                            <div class="icon">
                                <img src="{{ asset('assets/frontend') }}/img/icon/quote.svg" alt="" />
                            </div>
                            <div class="rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <div class="quote">
                                <p>
                                    There are many variations of passage available the majority have suffered of alteration
                                    of the some humour words look
                                    even slightly form by the injected to default model believable.
                                </p>
                            </div>
                            <div class="author">
                                <div class="author-img">
                                    <img src="{{ asset('assets/frontend') }}/img/testimonial/05.jpg" alt="" />
                                </div>
                                <div class="author-info">
                                    <h5>Buchan Conie</h5>
                                    <p>Student</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
