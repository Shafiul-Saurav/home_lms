@extends('frontend.layouts.master')

@section('title', 'Courses')

@push('frontend_style')
@endpush

@section('frontend_content')
    <main class="main">
        <!-- breadcrumb -->
        <x-frontend.pages.common.breadcrumb :title="'Courses'" :breadcrumb="[['name' => 'Home', 'url' => route('home')], ['name' => 'Courses', 'url' => '#']]" />
        <!-- breadcrumb end -->

        <!-- course-area -->
        <div class="course-area py-120">
            <div class="container">
                <div class="row g-4">
                    <div class="col-lg-4 col-xl-3">
                        <div class="course-sidebar">
                            <!-- search -->
                            <div class="widget mb-4">
                                <h4 class="title">Search Courses</h4>
                                <div class="search-form">
                                    <form action="#">
                                        <div class="form-group mb-0">
                                            <input type="text" class="form-control" placeholder="Search" />
                                            <button type="search"><i class="far fa-search"></i></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- category -->
                            <div class="widget mb-4">
                                <h4 class="title">Category</h4>
                                <div class="category">
                                    <ul>
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="cat1" />
                                                <label class="form-check-label" for="cat1"> Art &amp; Design
                                                    (10)</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input" checked="" type="checkbox"
                                                    id="cat2" />
                                                <label class="form-check-label" for="cat2"> Development (15)</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="cat3" />
                                                <label class="form-check-label" for="cat3"> IT &amp; Software
                                                    (35)</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input" checked="" type="checkbox"
                                                    id="cat4" />
                                                <label class="form-check-label" for="cat4"> Digital Marketing
                                                    (25)</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="cat5" />
                                                <label class="form-check-label" for="cat5"> Health &amp; Fitness
                                                    (15)</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-check mb-0">
                                                <input class="form-check-input" type="checkbox" id="cat6" />
                                                <label class="form-check-label" for="cat6"> Offices Productivity
                                                    (09)</label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- level -->
                            <div class="widget mb-4">
                                <h4 class="title">Course Level</h4>
                                <div class="level">
                                    <ul>
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="lev1" />
                                                <label class="form-check-label" for="lev1"> Beginer (14)</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input" checked="" type="checkbox"
                                                    id="lev2" />
                                                <label class="form-check-label" for="lev2"> Intermediate (28)</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="lev3" />
                                                <label class="form-check-label" for="lev3"> Advanced (35)</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input" checked="" type="checkbox"
                                                    id="lev4" />
                                                <label class="form-check-label" for="lev4"> Expert (20)</label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- price -->
                            <div class="widget mb-4">
                                <h4 class="title">Course Price</h4>
                                <div class="price">
                                    <ul>
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="price1" />
                                                <label class="form-check-label" for="price1"> All</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input" checked type="checkbox" id="price2" />
                                                <label class="form-check-label" for="price2"> Free</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="price3" />
                                                <label class="form-check-label" for="price3"> Paid</label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- rating -->
                            <div class="widget">
                                <h4 class="title">Course Rating</h4>
                                <div class="rating">
                                    <ul>
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input" checked="" type="checkbox"
                                                    id="rat1" />
                                                <label class="form-check-label" for="rat1">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <span>(15)</span>
                                                </label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="rat2" />
                                                <label class="form-check-label" for="rat2">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="far fa-star"></i>
                                                    <span>(13)</span>
                                                </label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="rat3" />
                                                <label class="form-check-label" for="rat3">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="far fa-star"></i>
                                                    <i class="far fa-star"></i>
                                                    <span>(39)</span>
                                                </label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" checked=""
                                                    id="rat4" />
                                                <label class="form-check-label" for="rat4">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="far fa-star"></i>
                                                    <i class="far fa-star"></i>
                                                    <i class="far fa-star"></i>
                                                    <span>(22)</span>
                                                </label>
                                            </div>
                                        </li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="rat5" />
                                            <label class="form-check-label" for="rat5">
                                                <i class="fas fa-star"></i>
                                                <i class="far fa-star"></i>
                                                <i class="far fa-star"></i>
                                                <i class="far fa-star"></i>
                                                <i class="far fa-star"></i>
                                                <span>(18)</span>
                                            </label>
                                        </div>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-xl-9">
                        <div class="course-sort">
                            <div class="course-showing">Showing 1-10 of 50 Results</div>
                            <div class="col-12 col-md-5 col-lg-4 col-xl-3">
                                <select class="select">
                                    <option value="1">Sort By Default</option>
                                    <option value="5">Sort By Featured</option>
                                    <option value="2">Sort By Latest</option>
                                    <option value="3">Sort By Low Price</option>
                                    <option value="4">Sort By High Price</option>
                                </select>
                            </div>
                        </div>
                        <div class="row g-4">
                            <div class="col-md-6 col-lg-6 col-xl-4">
                                <div class="course-item">
                                    <span class="course-tag c1">Beginer</span>
                                    <div class="course-img">
                                        <a href="course-single.html"><img src="{{ asset('assets/frontend') }}/img/course/01.jpg"
                                                alt="" /></a>
                                    </div>
                                    <div class="course-content">
                                        <div class="course-meta">
                                            <span class="category c1">Development</span>
                                            <div class="rating">
                                                <i class="fas fa-star"></i>
                                                <span>3.5k</span>
                                            </div>
                                        </div>
                                        <h4 class="course-title"><a href="course-single.html">Advance PHP Knowledge and
                                                learn Laravel framework</a></h4>
                                        <div class="course-info">
                                            <ul>
                                                <li class="lecture"><i class="fad fa-book-open-reader"></i>64 Lectures
                                                </li>
                                                <li class="duration"><i class="fad fa-clock-rotate-left"></i>30 Hours</li>
                                            </ul>
                                        </div>
                                        <div class="course-bottom">
                                            <a href="#">
                                                <div class="course-instructor">
                                                    <img src="{{ asset('assets/frontend') }}/img/course/ins-1.jpg" alt="" />
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
                            <div class="col-md-6 col-lg-6 col-xl-4">
                                <div class="course-item">
                                    <span class="course-tag c2">Advance</span>
                                    <div class="course-img">
                                        <a href="course-single.html"><img src="{{ asset('assets/frontend') }}/img/course/02.jpg"
                                                alt="" /></a>
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
                                                <li class="lecture"><i class="fad fa-book-open-reader"></i>75 Lectures
                                                </li>
                                                <li class="duration"><i class="fad fa-clock-rotate-left"></i>58 Hours</li>
                                            </ul>
                                        </div>
                                        <div class="course-bottom">
                                            <a href="#">
                                                <div class="course-instructor">
                                                    <img src="{{ asset('assets/frontend') }}/img/course/ins-2.jpg" alt="" />
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
                            <div class="col-md-6 col-lg-6 col-xl-4">
                                <div class="course-item">
                                    <span class="course-tag c1">Beginer</span>
                                    <div class="course-img">
                                        <a href="course-single.html"><img src="{{ asset('assets/frontend') }}/img/course/03.jpg"
                                                alt="" /></a>
                                    </div>
                                    <div class="course-content">
                                        <div class="course-meta">
                                            <span class="category c2">Business</span>
                                            <div class="rating">
                                                <i class="fas fa-star"></i>
                                                <span>2.9k</span>
                                            </div>
                                        </div>
                                        <h4 class="course-title"><a href="course-single.html">Basic Knowledge About the
                                                UI/UX Design Pattern</a></h4>
                                        <div class="course-info">
                                            <ul>
                                                <li class="lecture"><i class="fad fa-book-open-reader"></i>59 Lectures
                                                </li>
                                                <li class="duration"><i class="fad fa-clock-rotate-left"></i>38 Hours</li>
                                            </ul>
                                        </div>
                                        <div class="course-bottom">
                                            <a href="#">
                                                <div class="course-instructor">
                                                    <img src="{{ asset('assets/frontend') }}/img/course/ins-3.jpg" alt="" />
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
                            <div class="col-md-6 col-lg-6 col-xl-4">
                                <div class="course-item">
                                    <span class="course-tag c2">Advance</span>
                                    <div class="course-img">
                                        <a href="course-single.html"><img src="{{ asset('assets/frontend') }}/img/course/04.jpg"
                                                alt="" /></a>
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
                                            <a href="course-single.html">The Complete Business Plan Course Includes 50
                                                Templates</a>
                                        </h4>
                                        <div class="course-info">
                                            <ul>
                                                <li class="lecture"><i class="fad fa-book-open-reader"></i>90 Lectures
                                                </li>
                                                <li class="duration"><i class="fad fa-clock-rotate-left"></i>125 Hours
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="course-bottom">
                                            <a href="#">
                                                <div class="course-instructor">
                                                    <img src="{{ asset('assets/frontend') }}/img/course/ins-4.jpg" alt="" />
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
                            <div class="col-md-6 col-lg-6 col-xl-4">
                                <div class="course-item">
                                    <span class="course-tag c1">Beginer</span>
                                    <div class="course-img">
                                        <a href="course-single.html"><img src="{{ asset('assets/frontend') }}/img/course/01.jpg"
                                                alt="" /></a>
                                    </div>
                                    <div class="course-content">
                                        <div class="course-meta">
                                            <span class="category c1">Development</span>
                                            <div class="rating">
                                                <i class="fas fa-star"></i>
                                                <span>3.5k</span>
                                            </div>
                                        </div>
                                        <h4 class="course-title"><a href="course-single.html">Advance PHP Knowledge and
                                                learn Laravel framework</a></h4>
                                        <div class="course-info">
                                            <ul>
                                                <li class="lecture"><i class="fad fa-book-open-reader"></i>64 Lectures
                                                </li>
                                                <li class="duration"><i class="fad fa-clock-rotate-left"></i>30 Hours</li>
                                            </ul>
                                        </div>
                                        <div class="course-bottom">
                                            <a href="#">
                                                <div class="course-instructor">
                                                    <img src="{{ asset('assets/frontend') }}/img/course/ins-1.jpg" alt="" />
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
                            <div class="col-md-6 col-lg-6 col-xl-4">
                                <div class="course-item">
                                    <span class="course-tag c2">Advance</span>
                                    <div class="course-img">
                                        <a href="course-single.html"><img src="{{ asset('assets/frontend') }}/img/course/02.jpg"
                                                alt="" /></a>
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
                                                <li class="lecture"><i class="fad fa-book-open-reader"></i>75 Lectures
                                                </li>
                                                <li class="duration"><i class="fad fa-clock-rotate-left"></i>58 Hours</li>
                                            </ul>
                                        </div>
                                        <div class="course-bottom">
                                            <a href="#">
                                                <div class="course-instructor">
                                                    <img src="{{ asset('assets/frontend') }}/img/course/ins-2.jpg" alt="" />
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
                            <div class="col-md-6 col-lg-6 col-xl-4">
                                <div class="course-item">
                                    <span class="course-tag c1">Beginer</span>
                                    <div class="course-img">
                                        <a href="course-single.html"><img src="{{ asset('assets/frontend') }}/img/course/03.jpg"
                                                alt="" /></a>
                                    </div>
                                    <div class="course-content">
                                        <div class="course-meta">
                                            <span class="category c2">Business</span>
                                            <div class="rating">
                                                <i class="fas fa-star"></i>
                                                <span>2.9k</span>
                                            </div>
                                        </div>
                                        <h4 class="course-title"><a href="course-single.html">Basic Knowledge About the
                                                UI/UX Design Pattern</a></h4>
                                        <div class="course-info">
                                            <ul>
                                                <li class="lecture"><i class="fad fa-book-open-reader"></i>59 Lectures
                                                </li>
                                                <li class="duration"><i class="fad fa-clock-rotate-left"></i>38 Hours</li>
                                            </ul>
                                        </div>
                                        <div class="course-bottom">
                                            <a href="#">
                                                <div class="course-instructor">
                                                    <img src="{{ asset('assets/frontend') }}/img/course/ins-3.jpg" alt="" />
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
                            <div class="col-md-6 col-lg-6 col-xl-4">
                                <div class="course-item">
                                    <span class="course-tag c2">Advance</span>
                                    <div class="course-img">
                                        <a href="course-single.html"><img src="{{ asset('assets/frontend') }}/img/course/04.jpg"
                                                alt="" /></a>
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
                                            <a href="course-single.html">The Complete Business Plan Course Includes 50
                                                Templates</a>
                                        </h4>
                                        <div class="course-info">
                                            <ul>
                                                <li class="lecture"><i class="fad fa-book-open-reader"></i>90 Lectures
                                                </li>
                                                <li class="duration"><i class="fad fa-clock-rotate-left"></i>125 Hours
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="course-bottom">
                                            <a href="#">
                                                <div class="course-instructor">
                                                    <img src="{{ asset('assets/frontend') }}/img/course/ins-4.jpg" alt="" />
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
                            <div class="col-md-6 col-lg-6 col-xl-4">
                                <div class="course-item">
                                    <span class="course-tag c1">Beginer</span>
                                    <div class="course-img">
                                        <a href="course-single.html"><img src="{{ asset('assets/frontend') }}/img/course/03.jpg"
                                                alt="" /></a>
                                    </div>
                                    <div class="course-content">
                                        <div class="course-meta">
                                            <span class="category c2">Business</span>
                                            <div class="rating">
                                                <i class="fas fa-star"></i>
                                                <span>2.9k</span>
                                            </div>
                                        </div>
                                        <h4 class="course-title"><a href="course-single.html">Basic Knowledge About the
                                                UI/UX Design Pattern</a></h4>
                                        <div class="course-info">
                                            <ul>
                                                <li class="lecture"><i class="fad fa-book-open-reader"></i>59 Lectures
                                                </li>
                                                <li class="duration"><i class="fad fa-clock-rotate-left"></i>38 Hours</li>
                                            </ul>
                                        </div>
                                        <div class="course-bottom">
                                            <a href="#">
                                                <div class="course-instructor">
                                                    <img src="{{ asset('assets/frontend') }}/img/course/ins-3.jpg" alt="" />
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
                        </div>
                        <!-- pagination -->
                        <div class="pagination-area">
                            <div aria-label="Page navigation example">
                                <ul class="pagination">
                                    <li class="page-item">
                                        <a class="page-link" href="#" aria-label="Previous">
                                            <span aria-hidden="true"><i class="fas fa-arrow-left"></i></span>
                                        </a>
                                    </li>
                                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="#" aria-label="Next">
                                            <span aria-hidden="true"><i class="fas fa-arrow-right"></i></span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- course-area end -->

    </main>
@endsection

@push('frontend_script')
@endpush
