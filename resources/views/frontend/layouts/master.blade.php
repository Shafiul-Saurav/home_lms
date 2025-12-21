<!DOCTYPE html>
<html lang="en">

<head>
    <!-- meta tags -->
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />

    <!-- title -->
    <title>Edubo - LMS And Education Course HTML5 Template</title>

    <!-- favicon -->
    <link rel="icon" type="image/x-icon" href="{{asset('assets/frontend')}}/img/logo/favicon.png" />

    <!-- css -->
    @include('frontend.layouts.include.style')
</head>

<body>
    <!-- preloader -->
    @include('frontend.layouts.include.preloader')
    <!-- preloader end -->

    <!-- header area -->
    @include('frontend.layouts.include.header')
    <!-- header area end -->

    <!-- popup search -->
    @include('frontend.layouts.include.search-popup')
    <!-- popup search end -->

    <!-- sidebar-popup -->
    <div class="sidebar-popup offcanvas offcanvas-end" tabindex="-1" id="sidebarPopup">
        <div class="offcanvas-header">
            <a href="index.html" class="sidebar-popup-logo">
          <img src="{{asset('assets/frontend')}}/img/logo/logo.png" alt="" />
        </a>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close">
          <i class="far fa-xmark"></i>
        </button>
        </div>
        <div class="sidebar-popup-wrap offcanvas-body">
            <div class="sidebar-popup-content">
                <div class="sidebar-popup-about">
                    <h4>About Us</h4>
                    <p>
                        There are many variations of passages available sure there majority have suffered alteration in some form by inject humour or randomised words which don't look even slightly believable.
                    </p>
                </div>
                <div class="sidebar-popup-contact">
                    <h4>Contact Info</h4>
                    <ul>
                        <li>
                            <div class="icon">
                                <i class="far fa-envelope"></i>
                            </div>
                            <div class="content">
                                <h6>Email</h6>
                                <a href="/cdn-cgi/l/email-protection#a2cbccc4cde2c7dac3cfd2cec78cc1cdcf"><span class="__cf_email__" data-cfemail="a1c8cfc7cee1c4d9c0ccd1cdc48fc2cecc">[email&#160;protected]</span></a>
                            </div>
                        </li>
                        <li>
                            <div class="icon">
                                <i class="far fa-phone"></i>
                            </div>
                            <div class="content">
                                <h6>Phone</h6>
                                <a href="tel:+21236547898">+2 123 654 7898</a>
                            </div>
                        </li>
                        <li>
                            <div class="icon">
                                <i class="far fa-location-dot"></i>
                            </div>
                            <div class="content">
                                <h6>Address</h6>
                                <a href="#">25/B Milford Road, New York</a>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="sidebar-popup-social">
                    <h4>Follow Us</h4>
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-x-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin"></i></a>
                </div>
            </div>
        </div>
    </div>
    <!-- sidebar-popup end -->

    <main class="main">
        <!-- hero area -->
        <div class="hero-section hs-1">
            <div class="hero-single" style="background-image: url({{asset('assets/frontend')}}/img/shape/01.png)">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-lg-6">
                            <div class="hero-content">
                                <h6 class="hero-sub-title wow fadeInUp" data-delay=".25s"><i class="far fa-lightbulb-on"></i> Start To New Journey</h6>
                                <h1 class="hero-title wow fadeInRight" data-delay=".50s">Best learning <span class="text-gradient">platform that take</span> you next level</h1>
                                <p class="wow fadeInLeft" data-delay=".75s">
                                    There are many variations of passages orem psum available but the majority have suffered alteration in some form by injected humour.
                                </p>
                                <div class="hero-btn wow fadeInUp" data-delay="1s">
                                    <a href="about.html" class="theme-btn">About More<i class="fas fa-arrow-right"></i></a>
                                    <a href="contact.html" class="theme-btn2">Learn More<i class="fas fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6">
                            <div class="hero-info-wrap">
                                <div class="hero-avatar-group">
                                    <h6><span>250k +</span> Students</h6>
                                    <span class="avatar"><img src="{{asset('assets/frontend')}}/img/account/01.jpg" alt="" /></span>
                                    <span class="avatar"><img src="{{asset('assets/frontend')}}/img/account/02.jpg" alt="" /></span>
                                    <span class="avatar"><img src="{{asset('assets/frontend')}}/img/account/03.jpg" alt="" /></span>
                                    <span class="avatar"><img src="{{asset('assets/frontend')}}/img/account/04.jpg" alt="" /></span>
                                    <span class="avatar"><img src="{{asset('assets/frontend')}}/img/account/05.jpg" alt="" /></span>
                                </div>
                                <div class="hero-course-info">
                                    <div class="icon">
                                        <img src="{{asset('assets/frontend')}}/img/icon/course.svg" alt="" />
                                    </div>
                                    <h6 class="title"><span>160+</span> Courses</h6>
                                </div>
                            </div>
                            <div class="hero-img">
                                <img class="img-1" src="{{asset('assets/frontend')}}/img/hero/01.png" alt="" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- hero area end -->

        <!-- partner area -->
        <div class="partner-area2 negative">
            <div class="col-lg-10 col-xl-9 ms-auto">
                <div class="partner-wrapper">
                    <div class="row g-4 align-items-center">
                        <div class="col-lg-2">
                            <div class="partner-title">
                                <h5>Let's check our <span>350+</span> partners</h5>
                            </div>
                        </div>
                        <div class="col-lg-10">
                            <div class="partner-slider owl-carousel owl-theme">
                                <img src="{{asset('assets/frontend')}}/img/partner/01.png" alt="thumb" />
                                <img src="{{asset('assets/frontend')}}/img/partner/02.png" alt="thumb" />
                                <img src="{{asset('assets/frontend')}}/img/partner/03.png" alt="thumb" />
                                <img src="{{asset('assets/frontend')}}/img/partner/04.png" alt="thumb" />
                                <img src="{{asset('assets/frontend')}}/img/partner/05.png" alt="thumb" />
                                <img src="{{asset('assets/frontend')}}/img/partner/06.png" alt="thumb" />
                                <img src="{{asset('assets/frontend')}}/img/partner/07.png" alt="thumb" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- partner area end -->

        <!-- about area -->
        <div class="about-area py-120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="about-left wow fadeInLeft" data-wow-delay=".25s">
                            <div class="about-img">
                                <div class="row g-0">
                                    <div class="col-6">
                                        <img class="img-1" src="{{asset('assets/frontend')}}/img/about/01.jpg" alt="" />
                                    </div>
                                    <div class="col-6">
                                        <img class="img-2" src="{{asset('assets/frontend')}}/img/about/02.jpg" alt="" />
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
                                <h2 class="site-title">Whether you want <span class="text-gradient">to learn or share</span> what you know</h2>
                            </div>
                            <p class="about-text">
                                There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even.
                            </p>
                            <div class="about-content">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="about-item">
                                            <div class="icon">
                                                <img src="{{asset('assets/frontend')}}/img/icon/learn.svg" alt="" />
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
                                                <img src="{{asset('assets/frontend')}}/img/icon/support.svg" alt="" />
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

        <!-- category area -->
        <div class="category-area pb-120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 mx-auto">
                        <div class="site-heading text-center wow fadeInDown" data-wow-delay=".25s">
                            <span class="site-title-tagline"><i class="far fa-lightbulb-on"></i> Our Category</span>
                            <h2 class="site-title">Let's check our <span class="text-gradient">category</span></h2>
                        </div>
                    </div>
                </div>
                <div class="row g-4 justify-content-center wow fadeInUp" data-wow-delay=".25s">
                    <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                        <a href="course-category-single.html" class="category-item">
                            <div class="content">
                                <div class="icon">
                                    <img src="{{asset('assets/frontend')}}/img/icon/development.svg" alt="" />
                                </div>
                                <div class="info">
                                    <h6>Development</h6>
                                    <p>150 Courses</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                        <a href="course-category-single.html" class="category-item">
                            <div class="content">
                                <div class="icon">
                                    <img src="{{asset('assets/frontend')}}/img/icon/marketing.svg" alt="" />
                                </div>
                                <div class="info">
                                    <h6>Digital Marketing</h6>
                                    <p>45 Courses</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                        <a href="course-category-single.html" class="category-item">
                            <div class="content">
                                <div class="icon">
                                    <img src="{{asset('assets/frontend')}}/img/icon/design.svg" alt="" />
                                </div>
                                <div class="info">
                                    <h6>Design</h6>
                                    <p>60 Courses</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                        <a href="course-category-single.html" class="category-item">
                            <div class="content">
                                <div class="icon">
                                    <img src="{{asset('assets/frontend')}}/img/icon/office.svg" alt="" />
                                </div>
                                <div class="info">
                                    <h6>Office Productivity</h6>
                                    <p>36 Courses</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                        <a href="course-category-single.html" class="category-item">
                            <div class="content">
                                <div class="icon">
                                    <img src="{{asset('assets/frontend')}}/img/icon/health.svg" alt="" />
                                </div>
                                <div class="info">
                                    <h6>Health & Fitness</h6>
                                    <p>59 Courses</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                        <a href="course-category-single.html" class="category-item">
                            <div class="content">
                                <div class="icon">
                                    <img src="{{asset('assets/frontend')}}/img/icon/lifestyle.svg" alt="" />
                                </div>
                                <div class="info">
                                    <h6>Lifestyle</h6>
                                    <p>65 Courses</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                        <a href="course-category-single.html" class="category-item">
                            <div class="content">
                                <div class="icon">
                                    <img src="{{asset('assets/frontend')}}/img/icon/finance.svg" alt="" />
                                </div>
                                <div class="info">
                                    <h6>Finance</h6>
                                    <p>50 Courses</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                        <a href="course-category-single.html" class="category-item">
                            <div class="content">
                                <div class="icon">
                                    <img src="{{asset('assets/frontend')}}/img/icon/photo.svg" alt="" />
                                </div>
                                <div class="info">
                                    <h6>Photo & Video</h6>
                                    <p>92 Courses</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                        <a href="course-category-single.html" class="category-item">
                            <div class="content">
                                <div class="icon">
                                    <img src="{{asset('assets/frontend')}}/img/icon/motion.svg" alt="" />
                                </div>
                                <div class="info">
                                    <h6>Motion Graphics</h6>
                                    <p>39 Courses</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                        <a href="course-category-single.html" class="category-item">
                            <div class="content">
                                <div class="icon">
                                    <img src="{{asset('assets/frontend')}}/img/icon/music.svg" alt="" />
                                </div>
                                <div class="info">
                                    <h6>Music</h6>
                                    <p>87 Courses</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                        <a href="course-category-single.html" class="category-item">
                            <div class="content">
                                <div class="icon">
                                    <img src="{{asset('assets/frontend')}}/img/icon/learn-2.svg" alt="" />
                                </div>
                                <div class="info">
                                    <h6>English Learning</h6>
                                    <p>48 Courses</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-12 text-center">
                    <a href="course-category.html" class="theme-btn mt-5"><span class="fad fa-rotate"></span> All Category</a>
                </div>
            </div>
        </div>
        <!-- category area end -->

        <!-- course area -->
        <div class="course-area bg-img py-80">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 mx-auto">
                        <div class="site-heading text-center wow fadeInDown" data-wow-delay=".25s">
                            <span class="site-title-tagline"><i class="far fa-lightbulb-on"></i> Our Courses</span>
                            <h2 class="site-title">Our Most Popular <span class="text-gradient">Courses</span></h2>
                        </div>
                    </div>
                </div>
                <div class="course-slider owl-carousel owl-theme wow fadeInUp" data-wow-delay=".25s">
                    <div class="course-item">
                        <span class="course-tag c1">Beginer</span>
                        <div class="course-img">
                            <a href="course-single.html"><img src="{{asset('assets/frontend')}}/img/course/01.jpg" alt="" /></a>
                        </div>
                        <div class="course-content">
                            <div class="course-meta">
                                <span class="category c1">Development</span>
                                <div class="rating">
                                    <i class="fas fa-star"></i>
                                    <span>3.5k</span>
                                </div>
                            </div>
                            <h4 class="course-title"><a href="course-single.html">Advance PHP Knowledge and learn Laravel framework</a></h4>
                            <div class="course-info">
                                <ul>
                                    <li class="lecture"><i class="fad fa-book-open-reader"></i>64 Lectures</li>
                                    <li class="duration"><i class="fad fa-clock-rotate-left"></i>30 Hours</li>
                                </ul>
                            </div>
                            <div class="course-bottom">
                                <a href="#">
                                    <div class="course-instructor">
                                        <img src="{{asset('assets/frontend')}}/img/course/ins-1.jpg" alt="" />
                                        <h6>Sara Wood</h6>
                                    </div>
                                </a>
                                <div class="course-price">
                                    <del>$75</del>
                                    <span>$69</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="course-item">
                        <span class="course-tag c2">Advance</span>
                        <div class="course-img">
                            <a href="course-single.html"><img src="{{asset('assets/frontend')}}/img/course/02.jpg" alt="" /></a>
                        </div>
                        <div class="course-content">
                            <div class="course-meta">
                                <span class="category">Art & Design</span>
                                <div class="rating">
                                    <i class="fas fa-star"></i>
                                    <span>5.2k</span>
                                </div>
                            </div>
                            <h4 class="course-title">
                                <a href="course-single.html">Full Web Designing Course With 20 Web Template</a>
                            </h4>
                            <div class="course-info">
                                <ul>
                                    <li class="lecture"><i class="fad fa-book-open-reader"></i>75 Lectures</li>
                                    <li class="duration"><i class="fad fa-clock-rotate-left"></i>58 Hours</li>
                                </ul>
                            </div>
                            <div class="course-bottom">
                                <a href="#">
                                    <div class="course-instructor">
                                        <img src="{{asset('assets/frontend')}}/img/course/ins-2.jpg" alt="" />
                                        <h6>Michel Johny</h6>
                                    </div>
                                </a>
                                <div class="course-price">
                                    <span>$125</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="course-item">
                        <span class="course-tag c1">Beginer</span>
                        <div class="course-img">
                            <a href="course-single.html"><img src="{{asset('assets/frontend')}}/img/course/03.jpg" alt="" /></a>
                        </div>
                        <div class="course-content">
                            <div class="course-meta">
                                <span class="category c2">Business</span>
                                <div class="rating">
                                    <i class="fas fa-star"></i>
                                    <span>2.9k</span>
                                </div>
                            </div>
                            <h4 class="course-title"><a href="course-single.html">Basic Knowledge About the UI/UX Design Pattern</a></h4>
                            <div class="course-info">
                                <ul>
                                    <li class="lecture"><i class="fad fa-book-open-reader"></i>59 Lectures</li>
                                    <li class="duration"><i class="fad fa-clock-rotate-left"></i>38 Hours</li>
                                </ul>
                            </div>
                            <div class="course-bottom">
                                <a href="#">
                                    <div class="course-instructor">
                                        <img src="{{asset('assets/frontend')}}/img/course/ins-3.jpg" alt="" />
                                        <h6>Glines Joey</h6>
                                    </div>
                                </a>
                                <div class="course-price">
                                    <span>$130</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="course-item">
                        <span class="course-tag c2">Advance</span>
                        <div class="course-img">
                            <a href="course-single.html"><img src="{{asset('assets/frontend')}}/img/course/04.jpg" alt="" /></a>
                        </div>
                        <div class="course-content">
                            <div class="course-meta">
                                <span class="category c3">IT & Software</span>
                                <div class="rating">
                                    <i class="fas fa-star"></i>
                                    <span>9k</span>
                                </div>
                            </div>
                            <h4 class="course-title">
                                <a href="course-single.html">The Complete Business Plan Course Includes 50 Templates</a>
                            </h4>
                            <div class="course-info">
                                <ul>
                                    <li class="lecture"><i class="fad fa-book-open-reader"></i>90 Lectures</li>
                                    <li class="duration"><i class="fad fa-clock-rotate-left"></i>125 Hours</li>
                                </ul>
                            </div>
                            <div class="course-bottom">
                                <a href="#">
                                    <div class="course-instructor">
                                        <img src="{{asset('assets/frontend')}}/img/course/ins-4.jpg" alt="" />
                                        <h6>Nancy Alarcon</h6>
                                    </div>
                                </a>
                                <div class="course-price">
                                    <span>$142</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="course-item">
                        <span class="course-tag">All Level</span>
                        <div class="course-img">
                            <a href="course-single.html"><img src="{{asset('assets/frontend')}}/img/course/05.jpg" alt="" /></a>
                        </div>
                        <div class="course-content">
                            <div class="course-meta">
                                <span class="category c4">Lifestyle</span>
                                <div class="rating">
                                    <i class="fas fa-star"></i>
                                    <span>7.3k</span>
                                </div>
                            </div>
                            <h4 class="course-title"><a href="course-single.html">Become a product Manager learn the skills & job</a></h4>
                            <div class="course-info">
                                <ul>
                                    <li class="lecture"><i class="fad fa-book-open-reader"></i>35 Lectures</li>
                                    <li class="duration"><i class="fad fa-clock-rotate-left"></i>48 Hours</li>
                                </ul>
                            </div>
                            <div class="course-bottom">
                                <a href="#">
                                    <div class="course-instructor">
                                        <img src="{{asset('assets/frontend')}}/img/course/ins-5.jpg" alt="" />
                                        <h6>Heiner Tina</h6>
                                    </div>
                                </a>
                                <div class="course-price">
                                    <span>$84</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="course-item">
                        <span class="course-tag c2">Advance</span>
                        <div class="course-img">
                            <a href="course-single.html"><img src="{{asset('assets/frontend')}}/img/course/06.jpg" alt="" /></a>
                        </div>
                        <div class="course-content">
                            <div class="course-meta">
                                <span class="category c5">Marketing</span>
                                <div class="rating">
                                    <i class="fas fa-star"></i>
                                    <span>1.7k</span>
                                </div>
                            </div>
                            <h4 class="course-title">
                                <a href="course-single.html">Complete Digital Marketing Course - 12 Courses in 1</a>
                            </h4>
                            <div class="course-info">
                                <ul>
                                    <li class="lecture"><i class="fad fa-book-open-reader"></i>120 Lectures</li>
                                    <li class="duration"><i class="fad fa-clock-rotate-left"></i>150 Hours</li>
                                </ul>
                            </div>
                            <div class="course-bottom">
                                <a href="#">
                                    <div class="course-instructor">
                                        <img src="{{asset('assets/frontend')}}/img/course/ins-6.jpg" alt="" />
                                        <h6>Leo Hender</h6>
                                    </div>
                                </a>
                                <div class="course-price">
                                    <span>$98</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- course area end -->

        <!-- choose area -->
        <div class="choose-area py-120">
            <div class="container">
                <div class="row g-4">
                    <div class="col-lg-6">
                        <div class="choose-content wow fadeInLeft" data-wow-delay=".25s">
                            <div class="site-heading mb-0">
                                <span class="site-title-tagline"><i class="far fa-lightbulb-on"></i> Why Choose Us</span>
                                <h2 class="site-title">We deliver <span class="text-gradient">expertise you can trust</span> our service</h2>
                                <p>
                                    It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.
                                </p>
                                <div class="choose-img">
                                    <img src="{{asset('assets/frontend')}}/img/choose/01.jpg" alt="" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="row g-4 wow fadeInRight" data-wow-delay=".25s">
                            <div class="col-lg-6">
                                <div class="choose-item">
                                    <div class="icon">
                                        <img src="{{asset('assets/frontend')}}/img/icon/money.svg" alt="" />
                                    </div>
                                    <div class="info">
                                        <h5>Affordable Cost</h5>
                                        <p>There are many variations of have suffered alteration some layout by injected humour.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="choose-item">
                                    <div class="icon">
                                        <img src="{{asset('assets/frontend')}}/img/icon/instructor.svg" alt="" />
                                    </div>
                                    <div class="info">
                                        <h5>Expert Instructors</h5>
                                        <p>There are many variations of have suffered alteration some layout by injected humour.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="choose-item">
                                    <div class="icon">
                                        <img src="{{asset('assets/frontend')}}/img/icon/training.svg" alt="" />
                                    </div>
                                    <div class="info">
                                        <h5>Flexible Learning</h5>
                                        <p>There are many variations of have suffered alteration some layout by injected humour.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="choose-item">
                                    <div class="icon">
                                        <img src="{{asset('assets/frontend')}}/img/icon/community.svg" alt="" />
                                    </div>
                                    <div class="info">
                                        <h5>Supportive Community</h5>
                                        <p>There are many variations of have suffered alteration some layout by injected humour.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- choose area end -->

        <!-- counter area -->
        <div class="counter-area">
            <div class="counter-wrap">
                <div class="col-lg-11 ms-lg-auto">
                    <div class="row g-4">
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="counter-box wow fadeInUp" data-wow-delay=".25s">
                                <div class="icon">
                                    <img src="{{asset('assets/frontend')}}/img/icon/student.svg" alt="" />
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
                                    <img src="{{asset('assets/frontend')}}/img/icon/course-2.svg" alt="" />
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
                                    <img src="{{asset('assets/frontend')}}/img/icon/instructor-2.svg" alt="" />
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
                                    <img src="{{asset('assets/frontend')}}/img/icon/award.svg" alt="" />
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

        <!-- pricing area -->
        <div class="pricing-area py-120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 mx-auto">
                        <div class="site-heading text-center wow fadeInDown" data-wow-delay=".25s">
                            <span class="site-title-tagline"><i class="far fa-lightbulb-on"></i> Pricing Plan</span>
                            <h2 class="site-title">Let's Check Our <span class="text-gradient">Pricing Plan</span></h2>
                        </div>
                    </div>
                </div>
                <div class="row g-4 g-xl-5">
                    <div class="col-md-6 col-lg-4">
                        <div class="pricing-item wow fadeInUp" data-wow-delay=".25s">
                            <div class="pricing-header">
                                <h5>Basic</h5>
                            </div>
                            <div class="pricing-info">
                                <div class="pricing-icon">
                                    <img src="{{asset('assets/frontend')}}/img/icon/course.svg" alt="" />
                                </div>
                                <div class="pricing-amount"><strong>$359</strong><span class="pricing-amount-type">/Monthly</span></div>
                            </div>
                            <div class="pricing-btn">
                                <a href="pricing.html" class="theme-btn">Subscribe Now <i class="fas fa-arrow-right"></i></a>
                            </div>
                            <div class="pricing-feature">
                                <ul>
                                    <li><i class="fas fa-check-circle"></i>150 HD Videos</li>
                                    <li><i class="fas fa-check-circle"></i>10 Category Courses</li>
                                    <li><i class="fas fa-check-circle"></i>10 Personal Instructor</li>
                                    <li><i class="fas fa-check-circle"></i>Up To 05 Active Members</li>
                                    <li><i class="fas fa-check-circle"></i>24/7 dedicated Support</li>
                                    <li><i class="fas fa-xmark-circle not-include"></i>Unlimited Courses</li>
                                    <li><i class="fas fa-xmark-circle not-include"></i>Unlimited Updates</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="pricing-item active wow fadeInDown" data-wow-delay=".25s">
                            <div class="pricing-header">
                                <h5>Standard</h5>
                            </div>
                            <div class="pricing-info">
                                <div class="pricing-icon">
                                    <img src="{{asset('assets/frontend')}}/img/icon/course.svg" alt="" />
                                </div>
                                <div class="pricing-amount"><strong>$559</strong><span class="pricing-amount-type">/Monthly</span></div>
                            </div>
                            <div class="pricing-btn">
                                <a href="pricing.html" class="theme-btn">Subscribe Now <i class="fas fa-arrow-right"></i></a>
                            </div>
                            <div class="pricing-feature">
                                <ul>
                                    <li><i class="fas fa-check-circle"></i>150 HD Videos</li>
                                    <li><i class="fas fa-check-circle"></i>10 Category Courses</li>
                                    <li><i class="fas fa-check-circle"></i>10 Personal Instructor</li>
                                    <li><i class="fas fa-check-circle"></i>Up To 05 Active Members</li>
                                    <li><i class="fas fa-check-circle"></i>24/7 dedicated Support</li>
                                    <li><i class="fas fa-check-circle"></i>Unlimited Courses</li>
                                    <li><i class="fas fa-xmark-circle not-include"></i>Unlimited Updates</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="pricing-item wow fadeInUp" data-wow-delay=".25s">
                            <div class="pricing-header">
                                <h5>Premium</h5>
                            </div>
                            <div class="pricing-info">
                                <div class="pricing-icon">
                                    <img src="{{asset('assets/frontend')}}/img/icon/course.svg" alt="" />
                                </div>
                                <div class="pricing-amount"><strong>$959</strong><span class="pricing-amount-type">/Monthly</span></div>
                            </div>
                            <div class="pricing-btn">
                                <a href="pricing.html" class="theme-btn">Subscribe Now <i class="fas fa-arrow-right"></i></a>
                            </div>
                            <div class="pricing-feature">
                                <ul>
                                    <li><i class="fas fa-check-circle"></i>150 HD Videos</li>
                                    <li><i class="fas fa-check-circle"></i>10 Category Courses</li>
                                    <li><i class="fas fa-check-circle"></i>10 Personal Instructor</li>
                                    <li><i class="fas fa-check-circle"></i>Up To 05 Active Members</li>
                                    <li><i class="fas fa-check-circle"></i>24/7 dedicated Support</li>
                                    <li><i class="fas fa-check-circle"></i>Unlimited Courses</li>
                                    <li><i class="fas fa-check-circle"></i>Unlimited Updates</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- pricing area end -->

        <!-- feature-area -->
        <div class="feature-area pb-120">
            <div class="container">
                <div class="feature-wrap">
                    <div class="row g-4">
                        <div class="col-md-6 col-lg-4">
                            <div class="feature-item wow fadeInUp" data-wow-delay=".25s">
                                <div class="feature-content">
                                    <span class="count">01</span>
                                    <div class="feature-icon">
                                        <img src="{{asset('assets/frontend')}}/img/icon/course-3.svg" alt="" />
                                    </div>
                                    <div class="feature-info">
                                        <h4>25k Online Course</h4>
                                        <p>It is a long established fact that a reader will be distracted by the readable content layout.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="feature-item wow fadeInUp" data-wow-delay=".35s">
                                <div class="feature-content">
                                    <span class="count">02</span>
                                    <div class="feature-icon">
                                        <img src="{{asset('assets/frontend')}}/img/icon/instructor-3.svg" alt="" />
                                    </div>
                                    <div class="feature-info">
                                        <h4>Expert Instructors</h4>
                                        <p>It is a long established fact that a reader will be distracted by the readable content layout.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="feature-item wow fadeInUp" data-wow-delay=".45s">
                                <div class="feature-content">
                                    <span class="count">03</span>
                                    <div class="feature-icon">
                                        <img src="{{asset('assets/frontend')}}/img/icon/lifetime-course.svg" alt="" />
                                    </div>
                                    <div class="feature-info">
                                        <h4>Lifetime Access</h4>
                                        <p>It is a long established fact that a reader will be distracted by the readable content layout.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- feature-area end -->

        <!-- video-area -->
        <div class="video-area pb-120">
            <div class="container">
                <div class="row g-4 align-items-center">
                    <div class="col-lg-4">
                        <div class="site-heading mb-0 wow fadeInLeft" data-wow-delay=".25s">
                            <span class="site-title-tagline"><i class="far fa-lightbulb-on"></i> Latest Video</span>
                            <h2 class="site-title">What <span class="text-gradient">makes us different</span> check our video</h2>
                            <p>
                                There are many variations of passages available but the majority have suffered alteration in some form by even slightly you are going to believable.
                            </p>
                            <a href="about.html" class="theme-btn mt-20">Learn More <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="video-content wow fadeInRight" data-wow-delay=".25s" style="background-image: url('{{asset('assets/frontend')}}/img/video/01.jpg')">
                            <div class="row align-items-center">
                                <div class="col-lg-12">
                                    <div class="video-wrap">
                                        <a class="play-btn popup-youtube" href="https://www.youtube.com/watch?v=jLS3DrTJrpI">
                        <i class="fas fa-play"></i>
                      </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- video-area end -->

        <!-- instructor -->
        <div class="instructor pb-120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 mx-auto">
                        <div class="site-heading text-center wow fadeInDown" data-wow-delay=".25s">
                            <span class="site-title-tagline"><i class="far fa-lightbulb-on"></i> Instructors</span>
                            <h2 class="site-title">Meet Our Best <span class="text-gradient">Instructors</span></h2>
                        </div>
                    </div>
                </div>
                <div class="row g-4 wow fadeInUp" data-wow-delay=".25s">
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <div class="instructor-item">
                            <div class="instructor-img">
                                <img src="{{asset('assets/frontend')}}/img/instructor/01.jpg" alt="" />
                            </div>
                            <div class="instructor-content">
                                <h5><a href="instructor-single.html">Mary Dusser</a> <span class="far fa-badge-check"></span></h5>
                                <p>Software Engineer</p>
                                <div class="info">
                                    <span class="course"><i class="fad fa-book-open-reader"></i> 25 <span>Courses</span></span>
                                    <span class="enrolled"><i class="fad fa-user-tie-hair"></i> 120 <span>Enrolled</span></span>
                                    <span class="rating"><i class="fas fa-star"></i> 5.0 <span>1.5k Reviews</span></span>
                                </div>
                            </div>
                            <div class="instructor-bottom">
                                <div class="price">
                                    <span class="text">Start From</span>
                                    <span class="amount">$150</span>
                                </div>
                                <a href="instructor-single.html" class="theme-border-btn">Enroll<i class="fas fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <div class="instructor-item">
                            <div class="instructor-img">
                                <img src="{{asset('assets/frontend')}}/img/instructor/02.jpg" alt="" />
                            </div>
                            <div class="instructor-content">
                                <h5><a href="instructor-single.html">Hector Nickel</a> <span class="far fa-badge-check"></span></h5>
                                <p>UI/UX Designer</p>
                                <div class="info">
                                    <span class="course"><i class="fad fa-book-open-reader"></i> 25 <span>Courses</span></span>
                                    <span class="enrolled"><i class="fad fa-user-tie-hair"></i> 120 <span>Enrolled</span></span>
                                    <span class="rating"><i class="fas fa-star"></i> 5.0 <span>1.5k Reviews</span></span>
                                </div>
                            </div>
                            <div class="instructor-bottom">
                                <div class="price">
                                    <span class="text">Start From</span>
                                    <span class="amount">$150</span>
                                </div>
                                <a href="instructor-single.html" class="theme-border-btn">Enroll<i class="fas fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <div class="instructor-item">
                            <div class="instructor-img">
                                <img src="{{asset('assets/frontend')}}/img/instructor/03.jpg" alt="" />
                            </div>
                            <div class="instructor-content">
                                <h5><a href="instructor-single.html">Karin Chumley</a> <span class="far fa-badge-check"></span></h5>
                                <p>Business Analyst</p>
                                <div class="info">
                                    <span class="course"><i class="fad fa-book-open-reader"></i> 25 <span>Courses</span></span>
                                    <span class="enrolled"><i class="fad fa-user-tie-hair"></i> 120 <span>Enrolled</span></span>
                                    <span class="rating"><i class="fas fa-star"></i> 5.0 <span>1.5k Reviews</span></span>
                                </div>
                            </div>
                            <div class="instructor-bottom">
                                <div class="price">
                                    <span class="text">Start From</span>
                                    <span class="amount">$150</span>
                                </div>
                                <a href="instructor-single.html" class="theme-border-btn">Enroll<i class="fas fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <div class="instructor-item">
                            <div class="instructor-img">
                                <img src="{{asset('assets/frontend')}}/img/instructor/04.jpg" alt="" />
                            </div>
                            <div class="instructor-content">
                                <h5><a href="instructor-single.html">Avendano Kean</a> <span class="far fa-badge-check"></span></h5>
                                <p>Frontend Engineer</p>
                                <div class="info">
                                    <span class="course"><i class="fad fa-book-open-reader"></i> 25 <span>Courses</span></span>
                                    <span class="enrolled"><i class="fad fa-user-tie-hair"></i> 120 <span>Enrolled</span></span>
                                    <span class="rating"><i class="fas fa-star"></i> 5.0 <span>1.5k Reviews</span></span>
                                </div>
                            </div>
                            <div class="instructor-bottom">
                                <div class="price">
                                    <span class="text">Start From</span>
                                    <span class="amount">$150</span>
                                </div>
                                <a href="instructor-single.html" class="theme-border-btn">Enroll<i class="fas fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- instructor end -->

        <!-- course tab -->
        <div class="course-tab pb-120">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="site-heading inline">
                            <div>
                                <span class="site-title-tagline"><i class="far fa-lightbulb-on"></i> Courses</span>
                                <h2 class="site-title">Courses By <span class="text-gradient">Category</span></h2>
                            </div>
                            <ul class="nav nav-pills" id="pills-tab">
                                <li class="nav-item">
                                    <a href="#" class="nav-link active" id="pills1" data-bs-toggle="pill" data-bs-target="#pills-tab1">Development</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link" id="pills2" data-bs-toggle="pill" data-bs-target="#pills-tab2">Art & Design</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link" id="pills3" data-bs-toggle="pill" data-bs-target="#pills-tab3">Business</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link" id="pills4" data-bs-toggle="pill" data-bs-target="#pills-tab4">Lifestyle</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link" id="pills5" data-bs-toggle="pill" data-bs-target="#pills-tab5">Photo & Video</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-tab1">
                        <div class="row g-4">
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="course-item">
                                    <span class="course-tag c1">Beginer</span>
                                    <div class="course-img">
                                        <a href="course-single.html"><img src="{{asset('assets/frontend')}}/img/course/01.jpg" alt="" /></a>
                                    </div>
                                    <div class="course-content">
                                        <div class="course-meta">
                                            <span class="category c1">Development</span>
                                            <div class="rating">
                                                <i class="fas fa-star"></i>
                                                <span>3.5k</span>
                                            </div>
                                        </div>
                                        <h4 class="course-title"><a href="course-single.html">Advance PHP Knowledge and learn Laravel framework</a></h4>
                                        <div class="course-info">
                                            <ul>
                                                <li class="lecture"><i class="fad fa-book-open-reader"></i>64 Lectures</li>
                                                <li class="duration"><i class="fad fa-clock-rotate-left"></i>30 Hours</li>
                                            </ul>
                                        </div>
                                        <div class="course-bottom">
                                            <a href="#">
                                                <div class="course-instructor">
                                                    <img src="{{asset('assets/frontend')}}/img/course/ins-1.jpg" alt="" />
                                                    <h6>Sara Wood</h6>
                                                </div>
                                            </a>
                                            <div class="course-price">
                                                <del>$75</del>
                                                <span>$69</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="course-item">
                                    <span class="course-tag c2">Advance</span>
                                    <div class="course-img">
                                        <a href="course-single.html"><img src="{{asset('assets/frontend')}}/img/course/02.jpg" alt="" /></a>
                                    </div>
                                    <div class="course-content">
                                        <div class="course-meta">
                                            <span class="category">Art & Design</span>
                                            <div class="rating">
                                                <i class="fas fa-star"></i>
                                                <span>5.2k</span>
                                            </div>
                                        </div>
                                        <h4 class="course-title">
                                            <a href="course-single.html">Full Web Designing Course With 20 Web Template</a>
                                        </h4>
                                        <div class="course-info">
                                            <ul>
                                                <li class="lecture"><i class="fad fa-book-open-reader"></i>75 Lectures</li>
                                                <li class="duration"><i class="fad fa-clock-rotate-left"></i>58 Hours</li>
                                            </ul>
                                        </div>
                                        <div class="course-bottom">
                                            <a href="#">
                                                <div class="course-instructor">
                                                    <img src="{{asset('assets/frontend')}}/img/course/ins-2.jpg" alt="" />
                                                    <h6>Michel Johny</h6>
                                                </div>
                                            </a>
                                            <div class="course-price">
                                                <span>$125</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="course-item">
                                    <span class="course-tag c1">Beginer</span>
                                    <div class="course-img">
                                        <a href="course-single.html"><img src="{{asset('assets/frontend')}}/img/course/03.jpg" alt="" /></a>
                                    </div>
                                    <div class="course-content">
                                        <div class="course-meta">
                                            <span class="category c2">Business</span>
                                            <div class="rating">
                                                <i class="fas fa-star"></i>
                                                <span>2.9k</span>
                                            </div>
                                        </div>
                                        <h4 class="course-title"><a href="course-single.html">Basic Knowledge About the UI/UX Design Pattern</a></h4>
                                        <div class="course-info">
                                            <ul>
                                                <li class="lecture"><i class="fad fa-book-open-reader"></i>59 Lectures</li>
                                                <li class="duration"><i class="fad fa-clock-rotate-left"></i>38 Hours</li>
                                            </ul>
                                        </div>
                                        <div class="course-bottom">
                                            <a href="#">
                                                <div class="course-instructor">
                                                    <img src="{{asset('assets/frontend')}}/img/course/ins-3.jpg" alt="" />
                                                    <h6>Glines Joey</h6>
                                                </div>
                                            </a>
                                            <div class="course-price">
                                                <span>$130</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="course-item">
                                    <span class="course-tag c2">Advance</span>
                                    <div class="course-img">
                                        <a href="course-single.html"><img src="{{asset('assets/frontend')}}/img/course/04.jpg" alt="" /></a>
                                    </div>
                                    <div class="course-content">
                                        <div class="course-meta">
                                            <span class="category c3">IT & Software</span>
                                            <div class="rating">
                                                <i class="fas fa-star"></i>
                                                <span>9k</span>
                                            </div>
                                        </div>
                                        <h4 class="course-title">
                                            <a href="course-single.html">The Complete Business Plan Course Includes 50 Templates</a>
                                        </h4>
                                        <div class="course-info">
                                            <ul>
                                                <li class="lecture"><i class="fad fa-book-open-reader"></i>90 Lectures</li>
                                                <li class="duration"><i class="fad fa-clock-rotate-left"></i>125 Hours</li>
                                            </ul>
                                        </div>
                                        <div class="course-bottom">
                                            <a href="#">
                                                <div class="course-instructor">
                                                    <img src="{{asset('assets/frontend')}}/img/course/ins-4.jpg" alt="" />
                                                    <h6>Nancy Alarcon</h6>
                                                </div>
                                            </a>
                                            <div class="course-price">
                                                <span>$142</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-tab2">
                        <div class="row g-4">
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="course-item">
                                    <span class="course-tag c1">Beginer</span>
                                    <div class="course-img">
                                        <a href="course-single.html"><img src="{{asset('assets/frontend')}}/img/course/01.jpg" alt="" /></a>
                                    </div>
                                    <div class="course-content">
                                        <div class="course-meta">
                                            <span class="category c1">Development</span>
                                            <div class="rating">
                                                <i class="fas fa-star"></i>
                                                <span>3.5k</span>
                                            </div>
                                        </div>
                                        <h4 class="course-title"><a href="course-single.html">Advance PHP Knowledge and learn Laravel framework</a></h4>
                                        <div class="course-info">
                                            <ul>
                                                <li class="lecture"><i class="fad fa-book-open-reader"></i>64 Lectures</li>
                                                <li class="duration"><i class="fad fa-clock-rotate-left"></i>30 Hours</li>
                                            </ul>
                                        </div>
                                        <div class="course-bottom">
                                            <a href="#">
                                                <div class="course-instructor">
                                                    <img src="{{asset('assets/frontend')}}/img/course/ins-1.jpg" alt="" />
                                                    <h6>Sara Wood</h6>
                                                </div>
                                            </a>
                                            <div class="course-price">
                                                <del>$75</del>
                                                <span>$69</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="course-item">
                                    <span class="course-tag c2">Advance</span>
                                    <div class="course-img">
                                        <a href="course-single.html"><img src="{{asset('assets/frontend')}}/img/course/02.jpg" alt="" /></a>
                                    </div>
                                    <div class="course-content">
                                        <div class="course-meta">
                                            <span class="category">Art & Design</span>
                                            <div class="rating">
                                                <i class="fas fa-star"></i>
                                                <span>5.2k</span>
                                            </div>
                                        </div>
                                        <h4 class="course-title">
                                            <a href="course-single.html">Full Web Designing Course With 20 Web Template</a>
                                        </h4>
                                        <div class="course-info">
                                            <ul>
                                                <li class="lecture"><i class="fad fa-book-open-reader"></i>75 Lectures</li>
                                                <li class="duration"><i class="fad fa-clock-rotate-left"></i>58 Hours</li>
                                            </ul>
                                        </div>
                                        <div class="course-bottom">
                                            <a href="#">
                                                <div class="course-instructor">
                                                    <img src="{{asset('assets/frontend')}}/img/course/ins-2.jpg" alt="" />
                                                    <h6>Michel Johny</h6>
                                                </div>
                                            </a>
                                            <div class="course-price">
                                                <span>$125</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="course-item">
                                    <span class="course-tag c1">Beginer</span>
                                    <div class="course-img">
                                        <a href="course-single.html"><img src="{{asset('assets/frontend')}}/img/course/03.jpg" alt="" /></a>
                                    </div>
                                    <div class="course-content">
                                        <div class="course-meta">
                                            <span class="category c2">Business</span>
                                            <div class="rating">
                                                <i class="fas fa-star"></i>
                                                <span>2.9k</span>
                                            </div>
                                        </div>
                                        <h4 class="course-title"><a href="course-single.html">Basic Knowledge About the UI/UX Design Pattern</a></h4>
                                        <div class="course-info">
                                            <ul>
                                                <li class="lecture"><i class="fad fa-book-open-reader"></i>59 Lectures</li>
                                                <li class="duration"><i class="fad fa-clock-rotate-left"></i>38 Hours</li>
                                            </ul>
                                        </div>
                                        <div class="course-bottom">
                                            <a href="#">
                                                <div class="course-instructor">
                                                    <img src="{{asset('assets/frontend')}}/img/course/ins-3.jpg" alt="" />
                                                    <h6>Glines Joey</h6>
                                                </div>
                                            </a>
                                            <div class="course-price">
                                                <span>$130</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="course-item">
                                    <span class="course-tag c2">Advance</span>
                                    <div class="course-img">
                                        <a href="course-single.html"><img src="{{asset('assets/frontend')}}/img/course/04.jpg" alt="" /></a>
                                    </div>
                                    <div class="course-content">
                                        <div class="course-meta">
                                            <span class="category c3">IT & Software</span>
                                            <div class="rating">
                                                <i class="fas fa-star"></i>
                                                <span>9k</span>
                                            </div>
                                        </div>
                                        <h4 class="course-title">
                                            <a href="course-single.html">The Complete Business Plan Course Includes 50 Templates</a>
                                        </h4>
                                        <div class="course-info">
                                            <ul>
                                                <li class="lecture"><i class="fad fa-book-open-reader"></i>90 Lectures</li>
                                                <li class="duration"><i class="fad fa-clock-rotate-left"></i>125 Hours</li>
                                            </ul>
                                        </div>
                                        <div class="course-bottom">
                                            <a href="#">
                                                <div class="course-instructor">
                                                    <img src="{{asset('assets/frontend')}}/img/course/ins-4.jpg" alt="" />
                                                    <h6>Nancy Alarcon</h6>
                                                </div>
                                            </a>
                                            <div class="course-price">
                                                <span>$142</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-tab3">
                        <div class="row g-4">
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="course-item">
                                    <span class="course-tag c1">Beginer</span>
                                    <div class="course-img">
                                        <a href="course-single.html"><img src="{{asset('assets/frontend')}}/img/course/01.jpg" alt="" /></a>
                                    </div>
                                    <div class="course-content">
                                        <div class="course-meta">
                                            <span class="category c1">Development</span>
                                            <div class="rating">
                                                <i class="fas fa-star"></i>
                                                <span>3.5k</span>
                                            </div>
                                        </div>
                                        <h4 class="course-title"><a href="course-single.html">Advance PHP Knowledge and learn Laravel framework</a></h4>
                                        <div class="course-info">
                                            <ul>
                                                <li class="lecture"><i class="fad fa-book-open-reader"></i>64 Lectures</li>
                                                <li class="duration"><i class="fad fa-clock-rotate-left"></i>30 Hours</li>
                                            </ul>
                                        </div>
                                        <div class="course-bottom">
                                            <a href="#">
                                                <div class="course-instructor">
                                                    <img src="{{asset('assets/frontend')}}/img/course/ins-1.jpg" alt="" />
                                                    <h6>Sara Wood</h6>
                                                </div>
                                            </a>
                                            <div class="course-price">
                                                <del>$75</del>
                                                <span>$69</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="course-item">
                                    <span class="course-tag c2">Advance</span>
                                    <div class="course-img">
                                        <a href="course-single.html"><img src="{{asset('assets/frontend')}}/img/course/02.jpg" alt="" /></a>
                                    </div>
                                    <div class="course-content">
                                        <div class="course-meta">
                                            <span class="category">Art & Design</span>
                                            <div class="rating">
                                                <i class="fas fa-star"></i>
                                                <span>5.2k</span>
                                            </div>
                                        </div>
                                        <h4 class="course-title">
                                            <a href="course-single.html">Full Web Designing Course With 20 Web Template</a>
                                        </h4>
                                        <div class="course-info">
                                            <ul>
                                                <li class="lecture"><i class="fad fa-book-open-reader"></i>75 Lectures</li>
                                                <li class="duration"><i class="fad fa-clock-rotate-left"></i>58 Hours</li>
                                            </ul>
                                        </div>
                                        <div class="course-bottom">
                                            <a href="#">
                                                <div class="course-instructor">
                                                    <img src="{{asset('assets/frontend')}}/img/course/ins-2.jpg" alt="" />
                                                    <h6>Michel Johny</h6>
                                                </div>
                                            </a>
                                            <div class="course-price">
                                                <span>$125</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="course-item">
                                    <span class="course-tag c1">Beginer</span>
                                    <div class="course-img">
                                        <a href="course-single.html"><img src="{{asset('assets/frontend')}}/img/course/03.jpg" alt="" /></a>
                                    </div>
                                    <div class="course-content">
                                        <div class="course-meta">
                                            <span class="category c2">Business</span>
                                            <div class="rating">
                                                <i class="fas fa-star"></i>
                                                <span>2.9k</span>
                                            </div>
                                        </div>
                                        <h4 class="course-title"><a href="course-single.html">Basic Knowledge About the UI/UX Design Pattern</a></h4>
                                        <div class="course-info">
                                            <ul>
                                                <li class="lecture"><i class="fad fa-book-open-reader"></i>59 Lectures</li>
                                                <li class="duration"><i class="fad fa-clock-rotate-left"></i>38 Hours</li>
                                            </ul>
                                        </div>
                                        <div class="course-bottom">
                                            <a href="#">
                                                <div class="course-instructor">
                                                    <img src="{{asset('assets/frontend')}}/img/course/ins-3.jpg" alt="" />
                                                    <h6>Glines Joey</h6>
                                                </div>
                                            </a>
                                            <div class="course-price">
                                                <span>$130</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="course-item">
                                    <span class="course-tag c2">Advance</span>
                                    <div class="course-img">
                                        <a href="course-single.html"><img src="{{asset('assets/frontend')}}/img/course/04.jpg" alt="" /></a>
                                    </div>
                                    <div class="course-content">
                                        <div class="course-meta">
                                            <span class="category c3">IT & Software</span>
                                            <div class="rating">
                                                <i class="fas fa-star"></i>
                                                <span>9k</span>
                                            </div>
                                        </div>
                                        <h4 class="course-title">
                                            <a href="course-single.html">The Complete Business Plan Course Includes 50 Templates</a>
                                        </h4>
                                        <div class="course-info">
                                            <ul>
                                                <li class="lecture"><i class="fad fa-book-open-reader"></i>90 Lectures</li>
                                                <li class="duration"><i class="fad fa-clock-rotate-left"></i>125 Hours</li>
                                            </ul>
                                        </div>
                                        <div class="course-bottom">
                                            <a href="#">
                                                <div class="course-instructor">
                                                    <img src="{{asset('assets/frontend')}}/img/course/ins-4.jpg" alt="" />
                                                    <h6>Nancy Alarcon</h6>
                                                </div>
                                            </a>
                                            <div class="course-price">
                                                <span>$142</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-tab4">
                        <div class="row g-4">
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="course-item">
                                    <span class="course-tag c1">Beginer</span>
                                    <div class="course-img">
                                        <a href="course-single.html"><img src="{{asset('assets/frontend')}}/img/course/01.jpg" alt="" /></a>
                                    </div>
                                    <div class="course-content">
                                        <div class="course-meta">
                                            <span class="category c1">Development</span>
                                            <div class="rating">
                                                <i class="fas fa-star"></i>
                                                <span>3.5k</span>
                                            </div>
                                        </div>
                                        <h4 class="course-title"><a href="course-single.html">Advance PHP Knowledge and learn Laravel framework</a></h4>
                                        <div class="course-info">
                                            <ul>
                                                <li class="lecture"><i class="fad fa-book-open-reader"></i>64 Lectures</li>
                                                <li class="duration"><i class="fad fa-clock-rotate-left"></i>30 Hours</li>
                                            </ul>
                                        </div>
                                        <div class="course-bottom">
                                            <a href="#">
                                                <div class="course-instructor">
                                                    <img src="{{asset('assets/frontend')}}/img/course/ins-1.jpg" alt="" />
                                                    <h6>Sara Wood</h6>
                                                </div>
                                            </a>
                                            <div class="course-price">
                                                <del>$75</del>
                                                <span>$69</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="course-item">
                                    <span class="course-tag c2">Advance</span>
                                    <div class="course-img">
                                        <a href="course-single.html"><img src="{{asset('assets/frontend')}}/img/course/02.jpg" alt="" /></a>
                                    </div>
                                    <div class="course-content">
                                        <div class="course-meta">
                                            <span class="category">Art & Design</span>
                                            <div class="rating">
                                                <i class="fas fa-star"></i>
                                                <span>5.2k</span>
                                            </div>
                                        </div>
                                        <h4 class="course-title">
                                            <a href="course-single.html">Full Web Designing Course With 20 Web Template</a>
                                        </h4>
                                        <div class="course-info">
                                            <ul>
                                                <li class="lecture"><i class="fad fa-book-open-reader"></i>75 Lectures</li>
                                                <li class="duration"><i class="fad fa-clock-rotate-left"></i>58 Hours</li>
                                            </ul>
                                        </div>
                                        <div class="course-bottom">
                                            <a href="#">
                                                <div class="course-instructor">
                                                    <img src="{{asset('assets/frontend')}}/img/course/ins-2.jpg" alt="" />
                                                    <h6>Michel Johny</h6>
                                                </div>
                                            </a>
                                            <div class="course-price">
                                                <span>$125</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="course-item">
                                    <span class="course-tag c1">Beginer</span>
                                    <div class="course-img">
                                        <a href="course-single.html"><img src="{{asset('assets/frontend')}}/img/course/03.jpg" alt="" /></a>
                                    </div>
                                    <div class="course-content">
                                        <div class="course-meta">
                                            <span class="category c2">Business</span>
                                            <div class="rating">
                                                <i class="fas fa-star"></i>
                                                <span>2.9k</span>
                                            </div>
                                        </div>
                                        <h4 class="course-title"><a href="course-single.html">Basic Knowledge About the UI/UX Design Pattern</a></h4>
                                        <div class="course-info">
                                            <ul>
                                                <li class="lecture"><i class="fad fa-book-open-reader"></i>59 Lectures</li>
                                                <li class="duration"><i class="fad fa-clock-rotate-left"></i>38 Hours</li>
                                            </ul>
                                        </div>
                                        <div class="course-bottom">
                                            <a href="#">
                                                <div class="course-instructor">
                                                    <img src="{{asset('assets/frontend')}}/img/course/ins-3.jpg" alt="" />
                                                    <h6>Glines Joey</h6>
                                                </div>
                                            </a>
                                            <div class="course-price">
                                                <span>$130</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="course-item">
                                    <span class="course-tag c2">Advance</span>
                                    <div class="course-img">
                                        <a href="course-single.html"><img src="{{asset('assets/frontend')}}/img/course/04.jpg" alt="" /></a>
                                    </div>
                                    <div class="course-content">
                                        <div class="course-meta">
                                            <span class="category c3">IT & Software</span>
                                            <div class="rating">
                                                <i class="fas fa-star"></i>
                                                <span>9k</span>
                                            </div>
                                        </div>
                                        <h4 class="course-title">
                                            <a href="course-single.html">The Complete Business Plan Course Includes 50 Templates</a>
                                        </h4>
                                        <div class="course-info">
                                            <ul>
                                                <li class="lecture"><i class="fad fa-book-open-reader"></i>90 Lectures</li>
                                                <li class="duration"><i class="fad fa-clock-rotate-left"></i>125 Hours</li>
                                            </ul>
                                        </div>
                                        <div class="course-bottom">
                                            <a href="#">
                                                <div class="course-instructor">
                                                    <img src="{{asset('assets/frontend')}}/img/course/ins-4.jpg" alt="" />
                                                    <h6>Nancy Alarcon</h6>
                                                </div>
                                            </a>
                                            <div class="course-price">
                                                <span>$142</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-tab5">
                        <div class="row g-4">
                            <div class="col-lg-3">
                                <div class="course-item">
                                    <span class="course-tag c1">Beginer</span>
                                    <div class="course-img">
                                        <a href="course-single.html"><img src="{{asset('assets/frontend')}}/img/course/01.jpg" alt="" /></a>
                                    </div>
                                    <div class="course-content">
                                        <div class="course-meta">
                                            <span class="category c1">Development</span>
                                            <div class="rating">
                                                <i class="fas fa-star"></i>
                                                <span>3.5k</span>
                                            </div>
                                        </div>
                                        <h4 class="course-title"><a href="course-single.html">Advance PHP Knowledge and learn Laravel framework</a></h4>
                                        <div class="course-info">
                                            <ul>
                                                <li class="lecture"><i class="fad fa-book-open-reader"></i>64 Lectures</li>
                                                <li class="duration"><i class="fad fa-clock-rotate-left"></i>30 Hours</li>
                                            </ul>
                                        </div>
                                        <div class="course-bottom">
                                            <a href="#">
                                                <div class="course-instructor">
                                                    <img src="{{asset('assets/frontend')}}/img/course/ins-1.jpg" alt="" />
                                                    <h6>Sara Wood</h6>
                                                </div>
                                            </a>
                                            <div class="course-price">
                                                <del>$75</del>
                                                <span>$69</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="course-item">
                                    <span class="course-tag c2">Advance</span>
                                    <div class="course-img">
                                        <a href="course-single.html"><img src="{{asset('assets/frontend')}}/img/course/02.jpg" alt="" /></a>
                                    </div>
                                    <div class="course-content">
                                        <div class="course-meta">
                                            <span class="category">Art & Design</span>
                                            <div class="rating">
                                                <i class="fas fa-star"></i>
                                                <span>5.2k</span>
                                            </div>
                                        </div>
                                        <h4 class="course-title">
                                            <a href="course-single.html">Full Web Designing Course With 20 Web Template</a>
                                        </h4>
                                        <div class="course-info">
                                            <ul>
                                                <li class="lecture"><i class="fad fa-book-open-reader"></i>75 Lectures</li>
                                                <li class="duration"><i class="fad fa-clock-rotate-left"></i>58 Hours</li>
                                            </ul>
                                        </div>
                                        <div class="course-bottom">
                                            <a href="#">
                                                <div class="course-instructor">
                                                    <img src="{{asset('assets/frontend')}}/img/course/ins-2.jpg" alt="" />
                                                    <h6>Michel Johny</h6>
                                                </div>
                                            </a>
                                            <div class="course-price">
                                                <span>$125</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="course-item">
                                    <span class="course-tag c1">Beginer</span>
                                    <div class="course-img">
                                        <a href="course-single.html"><img src="{{asset('assets/frontend')}}/img/course/03.jpg" alt="" /></a>
                                    </div>
                                    <div class="course-content">
                                        <div class="course-meta">
                                            <span class="category c2">Business</span>
                                            <div class="rating">
                                                <i class="fas fa-star"></i>
                                                <span>2.9k</span>
                                            </div>
                                        </div>
                                        <h4 class="course-title"><a href="course-single.html">Basic Knowledge About the UI/UX Design Pattern</a></h4>
                                        <div class="course-info">
                                            <ul>
                                                <li class="lecture"><i class="fad fa-book-open-reader"></i>59 Lectures</li>
                                                <li class="duration"><i class="fad fa-clock-rotate-left"></i>38 Hours</li>
                                            </ul>
                                        </div>
                                        <div class="course-bottom">
                                            <a href="#">
                                                <div class="course-instructor">
                                                    <img src="{{asset('assets/frontend')}}/img/course/ins-3.jpg" alt="" />
                                                    <h6>Glines Joey</h6>
                                                </div>
                                            </a>
                                            <div class="course-price">
                                                <span>$130</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="course-item">
                                    <span class="course-tag c2">Advance</span>
                                    <div class="course-img">
                                        <a href="course-single.html"><img src="{{asset('assets/frontend')}}/img/course/04.jpg" alt="" /></a>
                                    </div>
                                    <div class="course-content">
                                        <div class="course-meta">
                                            <span class="category c3">IT & Software</span>
                                            <div class="rating">
                                                <i class="fas fa-star"></i>
                                                <span>9k</span>
                                            </div>
                                        </div>
                                        <h4 class="course-title">
                                            <a href="course-single.html">The Complete Business Plan Course Includes 50 Templates</a>
                                        </h4>
                                        <div class="course-info">
                                            <ul>
                                                <li class="lecture"><i class="fad fa-book-open-reader"></i>90 Lectures</li>
                                                <li class="duration"><i class="fad fa-clock-rotate-left"></i>125 Hours</li>
                                            </ul>
                                        </div>
                                        <div class="course-bottom">
                                            <a href="#">
                                                <div class="course-instructor">
                                                    <img src="{{asset('assets/frontend')}}/img/course/ins-4.jpg" alt="" />
                                                    <h6>Nancy Alarcon</h6>
                                                </div>
                                            </a>
                                            <div class="course-price">
                                                <span>$142</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- course tab end -->

        <!-- cta area -->
        <div class="cta-area pb-120">
            <div class="container">
                <div class="cta-wrap">
                    <div class="row align-items-center">
                        <div class="col-lg-6 col-xl-5">
                            <div class="cta-content wow fadeInUp" data-wow-delay=".25s">
                                <h1>Get access <span>2,550+</span> of our top courses</h1>
                                <p>It is long established fact that reader will by the content of page when looking at its layout.</p>
                                <a href="contact.html" class="theme-btn">Get Started<i class="fas fa-arrow-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xl-7">
                            <div class="cta-img">
                                <img src="{{asset('assets/frontend')}}/img/cta/01.jpg" alt="" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- cta area end -->

        <!-- process area -->
        <div class="process-area pb-120">
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
                                    <img src="{{asset('assets/frontend')}}/img/icon/learn.svg" alt="" />
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
                                    <img src="{{asset('assets/frontend')}}/img/icon/course-2.svg" alt="" />
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
                                    <img src="{{asset('assets/frontend')}}/img/icon/expert.svg" alt="" />
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

        <!-- skill-area -->
        <div class="skill-area pb-120">
            <div class="container">
                <div class="skill-wrap">
                    <div class="row g-4 align-items-center">
                        <div class="col-lg-6">
                            <div class="skill-img wow fadeInLeft" data-wow-delay=".25s">
                                <img src="{{asset('assets/frontend')}}/img/skill/01.jpg" alt="thumb" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="skill-content wow fadeInUp" data-wow-delay=".25s">
                                <div class="site-heading mb-4">
                                    <span class="site-title-tagline"><i class="far fa-lightbulb-on"></i> Our Skills</span>
                                    <h2 class="site-title">Getting Best <span class="text-gradient">Quality Education</span> Is More Easy</h2>
                                    <p class="skill-text">
                                        There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.
                                    </p>
                                </div>
                                <div class="skill-progress">
                                    <div class="progress-item">
                                        <h5>Happy Students <span class="percent">85%</span></h5>
                                        <div class="progress" data-value="85">
                                            <div class="progress-bar" role="progressbar"></div>
                                        </div>
                                    </div>
                                    <div class="progress-item">
                                        <h5>Students Engaging <span class="percent">65%</span></h5>
                                        <div class="progress" data-value="65">
                                            <div class="progress-bar" role="progressbar"></div>
                                        </div>
                                    </div>
                                    <div class="progress-item">
                                        <h5>Supportive Community <span class="percent">75%</span></h5>
                                        <div class="progress" data-value="75">
                                            <div class="progress-bar" role="progressbar"></div>
                                        </div>
                                    </div>
                                </div>
                                <a href="about.html" class="theme-btn mt-5">Learn More<i class="fas fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- skill area end -->

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
                                <img src="{{asset('assets/frontend')}}/img/icon/quote.svg" alt="" />
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
                                    There are many variations of passage available the majority have suffered of alteration of the some humour words look even slightly form by the injected to default model believable.
                                </p>
                            </div>
                            <div class="author">
                                <div class="author-img">
                                    <img src="{{asset('assets/frontend')}}/img/testimonial/01.jpg" alt="" />
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
                                <img src="{{asset('assets/frontend')}}/img/icon/quote.svg" alt="" />
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
                                    There are many variations of passage available the majority have suffered of alteration of the some humour words look even slightly form by the injected to default model believable.
                                </p>
                            </div>
                            <div class="author">
                                <div class="author-img">
                                    <img src="{{asset('assets/frontend')}}/img/testimonial/02.jpg" alt="" />
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
                                <img src="{{asset('assets/frontend')}}/img/icon/quote.svg" alt="" />
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
                                    There are many variations of passage available the majority have suffered of alteration of the some humour words look even slightly form by the injected to default model believable.
                                </p>
                            </div>
                            <div class="author">
                                <div class="author-img">
                                    <img src="{{asset('assets/frontend')}}/img/testimonial/03.jpg" alt="" />
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
                                <img src="{{asset('assets/frontend')}}/img/icon/quote.svg" alt="" />
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
                                    There are many variations of passage available the majority have suffered of alteration of the some humour words look even slightly form by the injected to default model believable.
                                </p>
                            </div>
                            <div class="author">
                                <div class="author-img">
                                    <img src="{{asset('assets/frontend')}}/img/testimonial/04.jpg" alt="" />
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
                                <img src="{{asset('assets/frontend')}}/img/icon/quote.svg" alt="" />
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
                                    There are many variations of passage available the majority have suffered of alteration of the some humour words look even slightly form by the injected to default model believable.
                                </p>
                            </div>
                            <div class="author">
                                <div class="author-img">
                                    <img src="{{asset('assets/frontend')}}/img/testimonial/05.jpg" alt="" />
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

        <!-- blog-area -->
        <div class="blog-area py-120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 mx-auto">
                        <div class="site-heading text-center wow fadeInDown" data-wow-delay=".25s">
                            <span class="site-title-tagline"><i class="far fa-lightbulb-on"></i> Our Blog</span>
                            <h2 class="site-title">Our Latest News <span class="text-gradient">And Blog</span></h2>
                        </div>
                    </div>
                </div>
                <div class="row g-4">
                    <div class="col-md-6 col-lg-4">
                        <div class="blog-item wow fadeInUp" data-wow-delay=".25s">
                            <div class="blog-date">Aug 20, 2025</div>
                            <div class="blog-img">
                                <img src="{{asset('assets/frontend')}}/img/blog/01.jpg" alt="Thumb" />
                            </div>
                            <div class="blog-meta">
                                <ul>
                                    <li>
                                        <a href="#"><i class="far fa-user-circle"></i> By Alicia Davis</a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="far fa-comments"></i> 2.5k Comments</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="blog-info">
                                <h4 class="blog-title">
                                    <a href="blog-single.html">There are many variations of passages orem available.</a>
                                </h4>
                                <p>It is a long established fact that a reader will majority have suffered distracted readable.</p>
                                <a class="theme-btn" href="blog-single.html">Read More<i class="fas fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="blog-item wow fadeInDown" data-wow-delay=".25s">
                            <div class="blog-date">Aug 23, 2025</div>
                            <div class="blog-img">
                                <img src="{{asset('assets/frontend')}}/img/blog/02.jpg" alt="Thumb" />
                            </div>
                            <div class="blog-meta">
                                <ul>
                                    <li>
                                        <a href="#"><i class="far fa-user-circle"></i> By Alicia Davis</a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="far fa-comments"></i> 1.2k Comments</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="blog-info">
                                <h4 class="blog-title">
                                    <a href="blog-single.html">Generator internet repeat tend word chunk necessary.</a>
                                </h4>
                                <p>It is a long established fact that a reader will majority have suffered distracted readable.</p>
                                <a class="theme-btn" href="blog-single.html">Read More<i class="fas fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="blog-item wow fadeInUp" data-wow-delay=".25s">
                            <div class="blog-date">Aug 25, 2025</div>
                            <div class="blog-img">
                                <img src="{{asset('assets/frontend')}}/img/blog/03.jpg" alt="Thumb" />
                            </div>
                            <div class="blog-meta">
                                <ul>
                                    <li>
                                        <a href="#"><i class="far fa-user-circle"></i> By Alicia Davis</a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="far fa-comments"></i> 2.8k Comments</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="blog-info">
                                <h4 class="blog-title">
                                    <a href="blog-single.html">Survived only five centuries but also the leap into.</a>
                                </h4>
                                <p>It is a long established fact that a reader will majority have suffered distracted readable.</p>
                                <a class="theme-btn" href="blog-single.html">Read More<i class="fas fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- blog-area end -->

        <!-- download area -->
        <div class="download-area mb-120">
            <div class="container">
                <div class="download-wrap wow fadeInUp" data-wow-delay=".25s">
                    <div class="row">
                        <div class="col-lg-6 align-self-center">
                            <div class="download-content">
                                <div class="site-heading mb-4">
                                    <span class="site-title-tagline justify-content-start"> <i class="far fa-lightbulb-on"></i> Download Our App </span>
                                    <h2 class="site-title mb-10">Edubo Android <span class="text-gradient">and IOS App is</span> Available!</h2>
                                    <p>
                                        There are many variations of passages available but the majority have suffered in some form going to use a passage by injected humour.
                                    </p>
                                </div>
                                <div class="download-btn">
                                    <a href="#" class="google-play">
                      <i class="fab fa-google-play"></i>
                      <div class="content">
                        <span>Get It On</span>
                        <h6>Google Play</h6>
                      </div>
                    </a>
                                    <a href="#" class="app-store">
                      <i class="fab fa-app-store"></i>
                      <div class="content">
                        <span>Get It On</span>
                        <h6>App Store</h6>
                      </div>
                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="download-img">
                                <img src="{{asset('assets/frontend')}}/img/download/01.png" alt="" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- download end -->
    </main>

    <!-- footer area -->
    <footer class="footer-area light">
        <div class="footer-shape">
            <img src="{{asset('assets/frontend')}}/img/shape/02.png" alt="" />
        </div>
        <div class="footer-widget">
            <div class="container">
                <div class="footer-widget-wrap pt-100 pb-50">
                    <div class="row g-4">
                        <div class="col-lg-5">
                            <div class="footer-widget-box about-us">
                                <a href="#" class="footer-logo">
                    <img src="{{asset('assets/frontend')}}/img/logo/logo.png" alt="" />
                  </a>
                                <p class="mb-3">
                                    We are many variations of passages available but the majority have suffered alteration some form by injected humour words believable.
                                </p>
                                <div class="footer-lang mb-4">
                                    <a href="#" class="lang-btn" data-bs-toggle="modal" data-bs-target="#langModal">
                      <span class="far fa-globe"></span>English
                    </a>
                                </div>
                                <div class="footer-newsletter">
                                    <h6>Subscribe Our Newsletter</h6>
                                    <div class="newsletter-form">
                                        <form action="#">
                                            <div class="form-group">
                                                <div class="form-icon">
                                                    <i class="far fa-envelopes"></i>
                                                    <input type="email" class="form-control" placeholder="Your Email" />
                                                    <button class="theme-btn" type="submit">Subscribe <span class="far fa-paper-plane"></span></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-lg-2">
                            <div class="footer-widget-box list">
                                <h4 class="footer-widget-title">Company</h4>
                                <ul class="footer-list">
                                    <li>
                                        <a href="about.html"><i class="far fa-angle-double-right"></i>About Us</a>
                                    </li>
                                    <li>
                                        <a href="blog.html"><i class="far fa-angle-double-right"></i>Update News</a>
                                    </li>
                                    <li>
                                        <a href="testimonial.html"><i class="far fa-angle-double-right"></i>Testimonials</a>
                                    </li>
                                    <li>
                                        <a href="contact.html"><i class="far fa-angle-double-right"></i>Contact Us</a>
                                    </li>
                                    <li>
                                        <a href="terms.html"><i class="far fa-angle-double-right"></i>Terms Of Service</a>
                                    </li>
                                    <li>
                                        <a href="privacy.html"><i class="far fa-angle-double-right"></i>Privacy policy</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-6 col-lg-2">
                            <div class="footer-widget-box list">
                                <h4 class="footer-widget-title">Quick Links</h4>
                                <ul class="footer-list">
                                    <li>
                                        <a href="course.html"><i class="far fa-angle-double-right"></i>Popular Courses</a>
                                    </li>
                                    <li>
                                        <a href="become-instructor.html"><i class="far fa-angle-double-right"></i>Become Instructor</a>
                                    </li>
                                    <li>
                                        <a href="help.html"><i class="far fa-angle-double-right"></i>Help & Support</a>
                                    </li>
                                    <li>
                                        <a href="event.html"><i class="far fa-angle-double-right"></i>Upcoming Events</a>
                                    </li>
                                    <li>
                                        <a href="affiliate.html"><i class="far fa-angle-double-right"></i>Our Affiliate</a>
                                    </li>
                                    <li>
                                        <a href="career.html"><i class="far fa-angle-double-right"></i>Join Our Team</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="footer-widget-box">
                                <h4 class="footer-widget-title">Get In Touch</h4>
                                <ul class="footer-contact">
                                    <li>
                                        <div class="icon">
                                            <i class="far fa-location-dot"></i>
                                        </div>
                                        <div class="content">
                                            <h6>Our Address</h6>
                                            <p>25/AB Milford Road, New York, USA</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="icon">
                                            <i class="far fa-phone"></i>
                                        </div>
                                        <div class="content">
                                            <h6>Call Us</h6>
                                            <a href="tel:+21236547898">+2 123 654 7898</a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="icon">
                                            <i class="far fa-envelope"></i>
                                        </div>
                                        <div class="content">
                                            <h6>Mail Us</h6>
                                            <a href="/cdn-cgi/l/email-protection#a0c9cec6cfe0c5d8c1cdd0ccc58ec3cfcd"><span class="__cf_email__" data-cfemail="5f363139301f3a273e322f333a713c3032">[email&#160;protected]</span></a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="footer-payment mt-4">
                        <h6>We Accept Payment Gateway</h6>
                        <div class="payment-img">
                            <img class="paypal" src="{{asset('assets/frontend')}}/img/payment/paypal.png" alt="" />
                            <img class="master" src="{{asset('assets/frontend')}}/img/payment/master-card.png" alt="" />
                            <img class="visa" src="{{asset('assets/frontend')}}/img/payment/visa.png" alt="" />
                            <img class="google" src="{{asset('assets/frontend')}}/img/payment/google-pay.png" alt="" />
                            <img class="apple" src="{{asset('assets/frontend')}}/img/payment/apple-pay.png" alt="" />
                            <img class="stripe" src="{{asset('assets/frontend')}}/img/payment/stripe.png" alt="" />
                            <img class="amex" src="{{asset('assets/frontend')}}/img/payment/american-express.png" alt="" />
                            <img class="discover" src="{{asset('assets/frontend')}}/img/payment/discover.png" alt="" />
                            <img class="amazon" src="{{asset('assets/frontend')}}/img/payment/amazon-pay.png" alt="" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="copyright">
                <div class="row">
                    <div class="col-md-6 align-self-center">
                        <p class="copyright-text">&copy; Copyright <span id="date"></span> <a href="#"> Edubo </a> All Rights Reserved.</p>
                    </div>
                    <div class="col-md-6 align-self-center">
                        <ul class="footer-social">
                            <li>
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fab fa-x-twitter"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fab fa-youtube"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer area end -->

    <!-- scroll-top -->
    <a href="#" id="scroll-top"><i class="far fa-arrow-up"></i></a>
    <!-- scroll-top end -->

    <!-- footer language modal -->
    <div class="modal footer-lang-modal animated pulse" id="langModal" tabindex="-1" aria-labelledby="langModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
            <i class="far fa-xmark"></i>
          </button>
                <div class="modal-body">
                    <div class="lang-content">
                        <h4 class="modal-title" id="langModalLabel">Choose Your Language</h4>
                        <div class="lang-list">
                            <div class="row row-cols-2 row-cols-lg-3 g-2">
                                <a href="#">Arabic</a>
                                <a href="#">English</a>
                                <a href="#">Spanish</a>
                                <a href="#">German</a>
                                <a href="#">Portuguese</a>
                                <a href="#">Italian</a>
                                <a href="#">Japanese</a>
                                <a href="#">Chinese</a>
                                <a href="#">Swedish</a>
                                <a href="#">Turkish</a>
                                <a href="#">Czech</a>
                                <a href="#">Danish</a>
                                <a href="#">Greek</a>
                                <a href="#">Icelandic</a>
                                <a href="#">Irish</a>
                                <a href="#">Russian</a>
                                <a href="#">Korean</a>
                                <a href="#">Romanian</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- footer language modal end -->

    <!-- js -->
    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="{{asset('assets/frontend')}}/js/jquery-3.7.1.min.js"></script>
    <script src="{{asset('assets/frontend')}}/js/modernizr.min.js"></script>
    <script src="{{asset('assets/frontend')}}/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('assets/frontend')}}/js/imagesloaded.pkgd.min.js"></script>
    <script src="{{asset('assets/frontend')}}/js/jquery.magnific-popup.min.js"></script>
    <script src="{{asset('assets/frontend')}}/js/isotope.pkgd.min.js"></script>
    <script src="{{asset('assets/frontend')}}/js/jquery.appear.min.js"></script>
    <script src="{{asset('assets/frontend')}}/js/jquery.easing.min.js"></script>
    <script src="{{asset('assets/frontend')}}/js/owl.carousel.min.js"></script>
    <script src="{{asset('assets/frontend')}}/js/counter-up.js"></script>
    <script src="{{asset('assets/frontend')}}/js/jquery.nice-select.min.js"></script>
    <script src="{{asset('assets/frontend')}}/js/wow.min.js"></script>
    <script src="{{asset('assets/frontend')}}/js/main.js"></script>
    <script defer src="https://static.cloudflareinsights.com/beacon.min.js/vcd15cbe7772f49c399c6a5babf22c1241717689176015" integrity="sha512-ZpsOmlRQV6y907TI0dKBHq9Md29nnaEIPlkf84rnaERnq6zvWvPUqr2ft8M1aS28oN72PdrCzSjY4U6VaAw1EQ==" data-cf-beacon='{"version":"2024.11.0","token":"1190e059c5bc497bafd35e121aae37b1","r":1,"server_timing":{"name":{"cfCacheStatus":true,"cfEdge":true,"cfExtPri":true,"cfL4":true,"cfOrigin":true,"cfSpeedBrain":true},"location_startswith":null}}'
        crossorigin="anonymous"></script>
</body>

</html>
