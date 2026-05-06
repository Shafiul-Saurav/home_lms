@extends('frontend.layouts.master')

@section('title', 'Courses')

@push('frontend_style')
    <style>
        @media (min-width: 992px) {
            .position_fixed {
                position: fixed;
                top: 60%;
                z-index: 1000;
                right: 4%;
            }

            .sidebar-scroll {
                max-height: calc(100vh - 160px - 220px);
                overflow-y: auto;
                scroll-behavior: smooth;
                padding-right: 4px;
                scrollbar-width: thin;
                scrollbar-color: transparent transparent;
            }

            .sidebar-scroll::-webkit-scrollbar {
                width: 7px;
            }

            .sidebar-scroll::-webkit-scrollbar-track {
                background: transparent;
                border-radius: 999px;
            }

            .sidebar-scroll::-webkit-scrollbar-thumb {
                background: transparent;
                border-radius: 999px;
                transition: background 0.2s ease;
            }

            .sidebar-scroll:hover::-webkit-scrollbar-track {
                background: rgba(0, 0, 0, 0.06);
            }

            .sidebar-scroll:hover::-webkit-scrollbar-thumb {
                background: rgba(79, 70, 229, 0.75);
            }

            .sidebar-scroll:hover {
                scrollbar-color: rgba(79, 70, 229, 0.75) rgba(0, 0, 0, 0.06);
            }
        }
    </style>
@endpush

@section('frontend_content')
    <main class="main">
        <!-- breadcrumb -->
        <div class="site-breadcrumb" style="background: url({{ asset('assets/frontend') }}/img/breadcrumb/01.png)">
            <div class="container">
                <div class="col-lg-6">
                    <div class="course-single-header">
                        <div class="top">
                            <span class="category c1">Development</span>
                            <a href="#" class="bookmark" data-bs-toggle="tooltip" data-bs-title="Bookmark"><i
                                    class="far fa-bookmark"></i></a>
                        </div>
                        <h4 class="title">Become a product Manager learn the skills & job</h4>
                        <p>
                            There are many variations of passages available but the majority have suffered alteration in
                            some form by injected humour
                            words even slightly believable.
                        </p>
                        <div class="rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                            <span class="rating-avg">4.5</span>
                            <span>(1.5k Reviews)</span>
                        </div>
                        <div class="info">
                            <div class="instructor">
                                <img src="{{ asset('assets/frontend') }}/img/instructor/01.jpg" alt="" />
                                <h6>Sara Wood</h6>
                            </div>
                            <div class="update-date">
                                <h6>Last Updated: <span>July 21, 2025</span></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- breadcrumb end -->

        <!-- course-single -->
        <div class="course-single pt-50 pb-80">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 col-xl-8">
                        <div class="course-single-wrap">
                            <!--  video area -->
                            <!-- <div class="video-area"
                                    style="background-image: url({{ asset('assets/frontend') }}/img/course/video.jpg)">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="video-wrap">
                                                <a class="video-btn popup-youtube"
                                                    href="https://www.youtube.com/watch?v=ckHzmP1evNU">
                                                    <i class="fas fa-play"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                            <!-- video area end -->

                            <!-- course single tab -->
                            <div class="course-single-tab">
                                <ul class="nav nav-underline">
                                    <li class="nav-item">
                                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#course-tab1"
                                            type="button">Description</button>
                                    </li>
                                    <li class="nav-item">
                                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#course-tab2"
                                            type="button">Curriculum</button>
                                    </li>
                                    <li class="nav-item">
                                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#course-tab3"
                                            type="button">Instructor</button>
                                    </li>
                                    <li class="nav-item">
                                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#course-tab4"
                                            type="button">Review</button>
                                    </li>
                                </ul>

                                <div class="tab-content">
                                    <!-- tab 1 -->
                                    <div class="tab-pane fade" id="course-tab1">
                                        <div class="course-details mt-4">
                                            <div class="mb-4">
                                                <h5 class="mb-10">Description</h5>
                                                {!! $courseInfo->description !!}
                                            </div>
                                        </div>
                                    </div>

                                    <!-- tab 2 -->
                                    <div class="tab-pane fade active show" id="course-tab2">
                                        <div class="course-curriculum mt-4">
                                            <div class="accordion accordion-flush" id="course-accordion">
                                                @forelse($lessons as $index => $lesson)
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header">
                                                        <button class="accordion-button {{ $index != 0 ? 'collapsed' : '' }}" type="button"
                                                            data-bs-toggle="collapse" data-bs-target="#curriculum{{ $index }}">
                                                            {{ $lesson->name }}
                                                        </button>
                                                    </h2>
                                                    <div id="curriculum{{ $index }}" class="accordion-collapse collapse {{ $index == 0 ? 'show' : '' }}"
                                                        data-bs-parent="#course-accordion">
                                                        <div class="accordion-body">
                                                            @foreach($lesson->courseModules as $module)
                                                            <div class="curriculum-item {{ $isEnrolled || $module->free_paid == 'free' ? 'unlock' : '' }}">
                                                                <div class="left">
                                                                    <h6>
                                                                        @if($module->pdf_file)
                                                                            <i class="fad fa-file-pdf"></i> <span>PDF:</span> 
                                                                        @elseif($module->live_record == 'live')
                                                                            <i class="fad fa-video"></i> <span>Live:</span> 
                                                                        @else
                                                                            <i class="fad fa-play-circle"></i> <span>Video:</span> 
                                                                        @endif
                                                                        {{ $module->title }}
                                                                    </h6>
                                                                </div>
                                                                <div class="right">
                                                                    <span class="duration">{{ $module->time ?? '00:00' }}</span>
                                                                    <span class="lock"><i class="fad {{ $isEnrolled || $module->free_paid == 'free' ? 'fa-unlock' : 'fa-lock' }}"></i></span>
                                                                </div>
                                                            </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                                @empty
                                                <div class="alert alert-info">Curriculum will be updated soon.</div>
                                                @endforelse
                                            </div>
                                        </div>
                                    </div>

                                    <!-- tab 3 -->
                                    <div class="tab-pane fade" id="course-tab3">
                                        <div class="course-instructor mt-4">
                                            <div class="instructor-img">
                                                <img src="{{ asset('assets/frontend') }}/img/instructor/01.jpg"
                                                    alt="" />
                                            </div>
                                            <div class="instructor-info">
                                                <h4>Sara Wood</h4>
                                                <div class="instructor-info-wrap">
                                                    <div class="rating">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <span>(4.5)</span>
                                                    </div>
                                                    <span class="course"><i class="fad fa-book-open"></i> 15
                                                        Courses</span>
                                                    <span class="enrolled"><i class="fad fa-user-friends"></i> 1.5k
                                                        Enrolled</span>
                                                </div>
                                                <p>
                                                    There are many variations of passages orem psum available but the
                                                    majority have suffered alteration in some
                                                    form, by injected humour.
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- tab 4 -->
                                    <div class="tab-pane fade" id="course-tab4">
                                        <div class="course-review">
                                            <div class="review-wrap mt-4">
                                                <!-- review-rating -->
                                                <div class="review-rating">
                                                    <div class="rating-count">
                                                        <h2>4.5</h2>
                                                        <div class="rating-star">
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="far fa-star"></i>
                                                        </div>
                                                        <p>15.5k Students Review</p>
                                                    </div>
                                                    <div class="rating-range">
                                                        <div class="rating-range-item">
                                                            <div class="rating-range-star">
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                            </div>
                                                            <div class="rating-range-bar">
                                                                <div class="progress">
                                                                    <div class="progress-width" style="width: 90%">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="rating-range-percentage">
                                                                <span>90%</span>
                                                            </div>
                                                        </div>
                                                        <div class="rating-range-item">
                                                            <div class="rating-range-star">
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="far fa-star"></i>
                                                            </div>
                                                            <div class="rating-range-bar">
                                                                <div class="progress">
                                                                    <div class="progress-width" style="width: 80%">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="rating-range-percentage">
                                                                <span>80%</span>
                                                            </div>
                                                        </div>
                                                        <div class="rating-range-item">
                                                            <div class="rating-range-star">
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="far fa-star"></i>
                                                                <i class="far fa-star"></i>
                                                            </div>
                                                            <div class="rating-range-bar">
                                                                <div class="progress">
                                                                    <div class="progress-width" style="width: 59%">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="rating-range-percentage">
                                                                <span>59%</span>
                                                            </div>
                                                        </div>
                                                        <div class="rating-range-item">
                                                            <div class="rating-range-star">
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="far fa-star"></i>
                                                                <i class="far fa-star"></i>
                                                                <i class="far fa-star"></i>
                                                            </div>
                                                            <div class="rating-range-bar">
                                                                <div class="progress">
                                                                    <div class="progress-width" style="width: 70%">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="rating-range-percentage">
                                                                <span>70%</span>
                                                            </div>
                                                        </div>
                                                        <div class="rating-range-item">
                                                            <div class="rating-range-star">
                                                                <i class="fas fa-star"></i>
                                                                <i class="far fa-star"></i>
                                                                <i class="far fa-star"></i>
                                                                <i class="far fa-star"></i>
                                                                <i class="far fa-star"></i>
                                                            </div>
                                                            <div class="rating-range-bar">
                                                                <div class="progress">
                                                                    <div class="progress-width" style="width: 49%">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="rating-range-percentage">
                                                                <span>49%</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- review-content -->
                                                <div class="review-content">
                                                    <h5 class="title">Reviews (1,500)</h5>
                                                    <div class="review-item">
                                                        <div class="review-author">
                                                            <img src="{{ asset('assets/frontend') }}/img/instructor/rev-1.png"
                                                                alt="" />
                                                            <div class="info">
                                                                <div>
                                                                    <h6>Erich T. Genao</h6>
                                                                    <span><i class="far fa-clock"></i> 1 day ago</span>
                                                                </div>
                                                                <div class="rating">
                                                                    <i class="fas fa-star"></i>
                                                                    <i class="fas fa-star"></i>
                                                                    <i class="fas fa-star"></i>
                                                                    <i class="fas fa-star"></i>
                                                                    <i class="fas fa-star"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <p>
                                                            There are many variations of passages available but the
                                                            majority have suffered alteration in some form by
                                                            injected humour randomised words. It is a long established
                                                            fact that reader will be distracted by the
                                                            readable content of web page editors now use page when
                                                            looking at its layout.
                                                        </p>
                                                    </div>
                                                    <div class="review-item">
                                                        <div class="review-author">
                                                            <img src="{{ asset('assets/frontend') }}/img/instructor/rev-2.png"
                                                                alt="" />
                                                            <div class="info">
                                                                <div>
                                                                    <h6>Erich T. Genao</h6>
                                                                    <span><i class="far fa-clock"></i> 1 day ago</span>
                                                                </div>
                                                                <div class="rating">
                                                                    <i class="fas fa-star"></i>
                                                                    <i class="fas fa-star"></i>
                                                                    <i class="fas fa-star"></i>
                                                                    <i class="fas fa-star"></i>
                                                                    <i class="fas fa-star"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <p>
                                                            There are many variations of passages available but the
                                                            majority have suffered alteration in some form by
                                                            injected humour randomised words. It is a long established
                                                            fact that reader will be distracted by the
                                                            readable content of web page editors now use page when
                                                            looking at its layout.
                                                        </p>
                                                    </div>
                                                    <div class="review-item">
                                                        <div class="review-author">
                                                            <img src="{{ asset('assets/frontend') }}/img/instructor/rev-1.png"
                                                                alt="" />
                                                            <div class="info">
                                                                <div>
                                                                    <h6>Erich T. Genao</h6>
                                                                    <span><i class="far fa-clock"></i> 1 day ago</span>
                                                                </div>
                                                                <div class="rating">
                                                                    <i class="fas fa-star"></i>
                                                                    <i class="fas fa-star"></i>
                                                                    <i class="fas fa-star"></i>
                                                                    <i class="fas fa-star"></i>
                                                                    <i class="fas fa-star"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <p>
                                                            There are many variations of passages available but the
                                                            majority have suffered alteration in some form by
                                                            injected humour randomised words. It is a long established
                                                            fact that reader will be distracted by the
                                                            readable content of web page editors now use page when
                                                            looking at its layout.
                                                        </p>
                                                    </div>
                                                    <div class="text-center mt-4">
                                                        <a href="#" class="theme-btn"> <span
                                                                class="fas fa-sync-alt"></span> Load More</a>
                                                    </div>
                                                </div>

                                                <!-- review-form -->
                                                <div class="review-form">
                                                    <h5>Leave A Review</h5>
                                                    <form action="#">
                                                        <div class="form-group">
                                                            <label class="form-label">Your Rating</label>
                                                            <select class="form-select">
                                                                <option value="">Choose Your Rating</option>
                                                                <option value="5">5 Stars</option>
                                                                <option value="4">4 Stars</option>
                                                                <option value="3">3 Stars</option>
                                                                <option value="2">2 Stars</option>
                                                                <option value="1">1 Star</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="form-label">Your Review</label>
                                                            <textarea class="form-control" cols="30" rows="5" placeholder="Write your review"></textarea>
                                                        </div>
                                                        <button class="theme-btn" type="button">Post Your Review<i
                                                                class="far fa-arrow-right"></i></button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- course single tab end -->
                        </div>
                    </div>
                    <div class="col-lg-5 col-xl-4 position_fixed">
                        <!-- course-single-sidebar -->
                        <div class="course-single-sidebar p-0">
                            <div class="video-area mb-4"
                                style="background-image: url({{ asset('uploads/courses/' . $courseInfo->image) }}); background-size: cover; background-position: center; height: 220px; border-top-left-radius: 15px; border-top-right-radius: 15px; position: relative; overflow: hidden;">
                                <div class="video-wrap"
                                    style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.2); display: flex; align-items: center; justify-content: center;">
                                    <a class="video-btn popup-youtube"
                                        href="{{ $courseInfo->video_link ?? 'https://www.youtube.com/watch?v=ckHzmP1evNU' }}"
                                        style="width: 60px; height: 60px; line-height: 60px; background: #fff; color: var(--theme-color2); border-radius: 50%; text-align: center; font-size: 20px; box-shadow: 0 0 20px rgba(0,0,0,0.2);">
                                        <i class="fas fa-play"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="sidebar-scroll">
                                <div class="price-wrap px-3">
                                    <div class="price-amount"><span>$120</span><del>$150</del></div>
                                    <span class="price-off">35% Off</span>
                                </div>
                            <div class="px-3">
                                <a href="#" class="theme-btn"> <span class="far fa-shopping-bag"></span> Add To
                                    Cart</a>
                            </div>
                            <div class="more-info px-3">
                                <ul>
                                    <li><i class="fad fa-user"></i> Instructor: <span>Sara Wood</span></li>
                                    <li><i class="fad fa-layer-group"></i> Level : <span>Expert</span></li>
                                    <li><i class="fad fa-book"></i> Lectures : <span>35 Lectures</span></li>
                                    <li><i class="fad fa-clock"></i> Duration: <span>03 Months</span></li>
                                    <li><i class="fad fa-user-friends"></i> Enrolled: <span>259 Students</span></li>
                                    <li><i class="fad fa-globe"></i> Language: <span>English</span></li>
                                </ul>
                            </div>
                            <div class="include px-3">
                                <h5>Course Includes</h5>
                                <ul>
                                    <li><i class="fad fa-check-circle"></i> Full Lifetime Access</li>
                                    <li><i class="fad fa-check-circle"></i> 35+ Downloadable Resources</li>
                                    <li><i class="fad fa-check-circle"></i> Certificate Of Completion</li>
                                    <li><i class="fad fa-check-circle"></i> Free Trial 7 Days</li>
                                    <li><i class="fad fa-check-circle"></i> 15 Days Money Back Guarantee</li>
                                </ul>
                            </div>
                            <div class="share px-3 pb-3">
                                <h5>Social Share</h5>
                                <div class="share-link">
                                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                                    <a href="#"><i class="fab fa-x-twitter"></i></a>
                                    <a href="#"><i class="fab fa-instagram"></i></a>
                                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                    <a href="#"><i class="fab fa-youtube"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- course-single end -->

        <!-- related course -->
        <div class="course-area pb-120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 mx-auto">
                        <div class="site-heading text-center">
                            <span class="site-title-tagline"><i class="far fa-lightbulb-on"></i> Courses</span>
                            <h2 class="site-title">Most Related <span class="text-gradient">Courses</span></h2>
                        </div>
                    </div>
                </div>
                <div class="row g-4">
                    <div class="col-md-6 col-lg-4 col-xl-3">
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
                                <h4 class="course-title"><a href="course-single.html">Advance PHP Knowledge and learn
                                        Laravel framework</a></h4>
                                <div class="course-info">
                                    <ul>
                                        <li class="lecture"><i class="fad fa-book-open-reader"></i>64 Lectures</li>
                                        <li class="duration"><i class="fad fa-clock-rotate-left"></i>30 Hours</li>
                                    </ul>
                                </div>
                                <div class="course-bottom">
                                    <a href="#">
                                        <div class="course-instructor">
                                            <img src="{{ asset('assets/frontend') }}/img/course/ins-1.jpg"
                                                alt="" />
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
                                        <li class="lecture"><i class="fad fa-book-open-reader"></i>75 Lectures</li>
                                        <li class="duration"><i class="fad fa-clock-rotate-left"></i>58 Hours</li>
                                    </ul>
                                </div>
                                <div class="course-bottom">
                                    <a href="#">
                                        <div class="course-instructor">
                                            <img src="{{ asset('assets/frontend') }}/img/course/ins-2.jpg"
                                                alt="" />
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
                                <h4 class="course-title"><a href="course-single.html">Basic Knowledge About the UI/UX
                                        Design Pattern</a></h4>
                                <div class="course-info">
                                    <ul>
                                        <li class="lecture"><i class="fad fa-book-open-reader"></i>59 Lectures</li>
                                        <li class="duration"><i class="fad fa-clock-rotate-left"></i>38 Hours</li>
                                    </ul>
                                </div>
                                <div class="course-bottom">
                                    <a href="#">
                                        <div class="course-instructor">
                                            <img src="{{ asset('assets/frontend') }}/img/course/ins-3.jpg"
                                                alt="" />
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
                                        <li class="lecture"><i class="fad fa-book-open-reader"></i>90 Lectures</li>
                                        <li class="duration"><i class="fad fa-clock-rotate-left"></i>125 Hours</li>
                                    </ul>
                                </div>
                                <div class="course-bottom">
                                    <a href="#">
                                        <div class="course-instructor">
                                            <img src="{{ asset('assets/frontend') }}/img/course/ins-4.jpg"
                                                alt="" />
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
        <!-- related course end -->

    </main>
@endsection

@push('frontend_script')
    {{-- <script src="https://cdn.plyr.io/3.7.8/plyr.polyfilled.js"></script> --}}
@endpush
