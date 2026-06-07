@extends('frontend.layouts.master')

@section('title', 'Courses')

@push('frontend_style')
    <style>
        .alert-bg {
            background: #f7921e25;
            color: #f7921e;
        }

        #reviewModal .review-modal-close {
            width: 36px;
            height: 36px;
            min-width: 36px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0;
            border: 0;
            border-radius: 50%;
            background: #f5f5f5;
            color: #333;
            font-size: 18px;
            line-height: 1;
            opacity: 1;
            transition: background 0.2s ease, color 0.2s ease;
        }

        #reviewModal .review-modal-close:hover {
            background: #dc3545;
            color: #fff;
        }

        #reviewModal .review-modal-close:focus {
            box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.2);
            outline: none;
        }

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
                            <span class="category c1">{{ $courseInfo->category->name ?? 'Uncategorized' }}</span>
                            <a href="#" class="bookmark" data-bs-toggle="tooltip" data-bs-title="Bookmark"><i
                                    class="far fa-bookmark"></i></a>
                        </div>
                        <h4 class="title">{{ $courseInfo->name }}</h4>
                        <p>
                            {!! Str::limit(strip_tags($courseInfo->description), 150) !!}
                        </p>
                        <div class="rating">
                            @php $avgRating = $courseInfo->averageRating(); @endphp
                            @for($i=1; $i<=5; $i++)
                                <i class="fa{{ $i <= round($avgRating) ? 's' : 'r' }} fa-star"></i>
                            @endfor
                            <span class="rating-avg">{{ $avgRating }}</span>
                            <span>({{ $courseInfo->reviewCount() }} Reviews)</span>
                        </div>
                        <div class="info">
                            <div class="instructor">
                                @php
                                    $mainTeacher = $courseInfo->teachers->first();
                                @endphp
                                @if($mainTeacher && $mainTeacher->profile_image && $mainTeacher->profile_image !== 'default_profile_image.jpg')
                                    <img src="{{ asset('uploads/teachers/' . $mainTeacher->profile_image) }}" alt="{{ $mainTeacher->user->name }}" />
                                @else
                                    <img src="{{ asset('assets/frontend') }}/img/instructor/01.jpg" alt="Instructor" />
                                @endif
                                <h6>{{ $mainTeacher->user->name ?? 'Instructor' }}</h6>
                            </div>
                            <div class="update-date">
                                <h6>Last Updated: <span>{{ $courseInfo->updated_at->format('M d, Y') }}</span></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- breadcrumb end -->

        <!-- course-single -->
        <div class="course-single pt-50 pb-80" style="position: relative;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 col-xl-8">
                        <div class="course-single-wrap">
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
                                    @if(isset($exams) && $exams->isNotEmpty())
                                    <li class="nav-item">
                                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#course-tab5"
                                            type="button">Exams</button>
                                    </li>
                                    @endif
                                </ul>

                                <div class="tab-content">
                                    <!-- tab 1 -->
                                    <div class="tab-pane fade" id="course-tab1">
                                        <div class="course-details mt-4">
                                            <div class="mb-4">

    @push('frontend_script')
        <script>
            $(function() {
                var msg = @json(session('error') ?? session('notification') ?? session('message') ?? '');

                if (msg) {
                    var already = $('.toast-message').filter(function() { return $(this).text().trim() === msg; }).length > 0;
                    if (!already) {
                        toastr.error(msg);
                    }
                }
            });
        </script>
    @endpush
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
                                                                    <a href="{{ route('course.video', ['course_id' => $courseInfo->id, 'module_id' => $module->id]) }}" class="text-decoration-none">
                                                                        <h6>
                                                                            @if($module->pdf_file)
                                                                                <i class="fad fa-file-alt"></i>
                                                                            @elseif($module->live_record == 'live')
                                                                                <i class="fad fa-video"></i>
                                                                            @else
                                                                                <i class="fad fa-play-circle"></i>
                                                                            @endif
                                                                            {{ $module->title }}
                                                                            @if(isset($completedModuleIds) && in_array($module->id, $completedModuleIds))
                                                                                <i class="fas fa-check-circle text-success ms-1"></i>
                                                                            @endif
                                                                        </h6>
                                                                    </a>
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
                                                <div class="alert-bg text-center py-2 rounded-3">Curriculum will be updated soon.</div>
                                                @endforelse
                                            </div>
                                        </div>
                                    </div>

                                    <!-- tab 3 -->
                                    <div class="tab-pane fade" id="course-tab3">
                                        <div class="course-instructor mt-4">
                                            @php
                                                $mainTeacher = $courseInfo->teachers->first();
                                            @endphp
                                            <div class="instructor-img">
                                                @if($mainTeacher && $mainTeacher->profile_image && $mainTeacher->profile_image !== 'default_profile_image.jpg')
                                                    <img src="{{ asset('uploads/teachers/' . $mainTeacher->profile_image) }}" alt="{{ $mainTeacher->user->name }}" />
                                                @else
                                                    <img src="{{ asset('assets/frontend') }}/img/instructor/01.jpg" alt="Instructor" />
                                                @endif
                                            </div>
                                            <div class="instructor-info">
                                                <h4>{{ $mainTeacher->user->name ?? 'Instructor' }}</h4>
                                                <div class="instructor-info-wrap">
                                                    <div class="rating">
                                                        @php $teacherRating = $mainTeacher ? $mainTeacher->averageRating() : 0; @endphp
                                                        @for($i=1; $i<=5; $i++)
                                                            <i class="fa{{ $i <= round($teacherRating) ? 's' : 'r' }} fa-star"></i>
                                                        @endfor
                                                        <span>({{ $teacherRating }})</span>
                                                    </div>
                                                    <span class="course"><i class="fad fa-book-open"></i> {{ $mainTeacher ? $mainTeacher->courses->count() : 0 }} Courses</span>
                                                    <span class="enrolled"><i class="fad fa-user-friends"></i> {{ $mainTeacher ? App\Models\CourseOrder::whereIn('course_id', $mainTeacher->courses->pluck('id'))->where('status', 'Enrolled')->count() : 0 }} Enrolled</span>
                                                </div>
                                                <p>
                                                    @if($mainTeacher)
                                                        {{ $mainTeacher->qualification ?? 'Qualified instructor with expertise in this field.' }}
                                                    @else
                                                        No instructor information available.
                                                    @endif
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
                                                    @php
                                                        $avgRating = $courseInfo->averageRating();
                                                        $totalReviews = $courseInfo->reviewCount();
                                                    @endphp
                                                    <div class="rating-count">
                                                        <h2>{{ $avgRating }}</h2>
                                                        <div class="rating-star">
                                                            @for($i=1; $i<=5; $i++)
                                                                <i class="fa{{ $i <= round($avgRating) ? 's' : 'r' }} fa-star"></i>
                                                            @endfor
                                                        </div>
                                                        <p>{{ $totalReviews }} Students Review</p>
                                                    </div>
                                                    <div class="rating-range">
                                                        @for($i=5; $i>=1; $i--)
                                                            @php
                                                                $count = $courseInfo->reviews()->where('is_approved', 1)->where('rating', $i)->count();
                                                                $percent = $totalReviews > 0 ? ($count / $totalReviews) * 100 : 0;
                                                            @endphp
                                                            <div class="rating-range-item">
                                                                <div class="rating-range-star">
                                                                    @for($j=1; $j<=5; $j++)
                                                                        <i class="fa{{ $j <= $i ? 's' : 'r' }} fa-star"></i>
                                                                    @endfor
                                                                </div>
                                                                <div class="rating-range-bar">
                                                                    <div class="progress">
                                                                        <div class="progress-width" style="width: {{ $percent }}%">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="rating-range-percentage">
                                                                    <span>{{ round($percent) }}%</span>
                                                                </div>
                                                            </div>
                                                        @endfor
                                                    </div>
                                                </div>

                                                <!-- review-content -->
                                                <div class="review-content">
                                                    @php
                                                        $reviews = $courseInfo->reviews()->where('is_approved', 1)->latest()->paginate(5);
                                                    @endphp
                                                    <h5 class="title">Reviews (<span id="review-count">{{ $reviews->total() }}</span>)</h5>
                                                    <div id="review-list">
                                                        @include('frontend.pages.courses.partials.review_items', ['reviews' => $reviews])
                                                    </div>

                                                    <div class="text-center mt-4 d-flex justify-content-center gap-3">
                                                        @if($reviews->hasMorePages())
                                                            <a href="javascript:void(0)" class="theme-btn" id="load-more-reviews" data-page="2">
                                                                <span class="fas fa-sync-alt"></span> Load More
                                                            </a>
                                                        @endif

                                                        @auth
                                                            @if(!$courseInfo->reviews()->where('user_id', auth()->id())->exists())
                                                                <a href="javascript:void(0)" class="theme-btn" data-bs-toggle="modal" data-bs-target="#reviewModal" id="give-review-btn">
                                                                    <i class="far fa-edit"></i> Give Review
                                                                </a>
                                                            @endif
                                                        @else
                                                            <a href="{{ route('login') }}" class="theme-btn">
                                                                <i class="far fa-sign-in"></i> Login to Review
                                                            </a>
                                                        @endauth
                                                    </div>
                                                </div>

                                                <!-- review-form removed since it's now in modal -->

                                            </div>
                                        </div>
                                    </div>

                                    <!-- tab 5 (Exams) -->
                                    @if(isset($exams) && $exams->isNotEmpty())
                                    <div class="tab-pane fade" id="course-tab5">
                                        <div class="course-curriculum mt-4">
                                            <div class="accordion accordion-flush" id="exam-accordion">
                                                @php
                                                    $groupedExams = $exams->groupBy('mcq_written');
                                                    $typeLabels = [
                                                        'mcq' => 'MCQ',
                                                        'written' => 'Written',
                                                        'both' => 'MCQ & Written'
                                                    ];
                                                @endphp
                                                @foreach($groupedExams as $type => $typeExams)
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header">
                                                        <button class="accordion-button {{ $loop->first ? '' : 'collapsed' }}" type="button"
                                                            data-bs-toggle="collapse" data-bs-target="#examCollapse{{ $type }}">
                                                            Course Exams ({{ $typeLabels[$type] ?? ucfirst($type) }})
                                                        </button>
                                                    </h2>
                                                    <div id="examCollapse{{ $type }}" class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}"
                                                        data-bs-parent="#exam-accordion">
                                                        <div class="accordion-body">
                                                            @foreach($typeExams as $exam)
                                                            <div class="curriculum-item {{ $isEnrolled || $exam->free_paid == 'free' ? 'unlock' : '' }}">
                                                                <div class="left">
                                                                    <a href="{{ route('frontend.exam.start', ['course_id' => $courseInfo->id, 'exam_id' => $exam->id]) }}" class="text-decoration-none">
                                                                        <h6>
                                                                            <i class="fad fa-clipboard-list-check"></i>
                                                                            {{ $exam->name }}
                                                                            <span class="badge bg-{{ $exam->free_paid == 'free' ? 'success' : 'warning' }} ms-2" style="font-size: 0.7rem;">{{ ucfirst($exam->free_paid) }}</span>
                                                                        </h6>
                                                                    </a>
                                                                </div>
                                                                <div class="right d-flex align-items-center">
                                                                    @if($exam->pdf_file && ($isEnrolled || $exam->free_paid == 'free'))
                                                                        <a href="{{ asset('uploads/exams/syllabus/' . $exam->pdf_file) }}" target="_blank" class="text-primary me-3"><i class="fad fa-file-pdf"></i> Syllabus</a>
                                                                    @endif
                                                                    <span class="duration me-3">{{ $exam->exam_time ?? '00:00' }}</span>
                                                                    <span class="lock"><i class="fad {{ $isEnrolled || $exam->free_paid == 'free' ? 'fa-unlock' : 'fa-lock' }}"></i></span>
                                                                </div>
                                                            </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    @endif
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
                                    @if($courseInfo->discount)
                                        <div class="price-amount">
                                            <span>${{ number_format($courseInfo->price - $courseInfo->discount, 2) }}</span>
                                            <del>${{ number_format($courseInfo->price, 2) }}</del>
                                        </div>
                                        <span class="price-off">{{ round(($courseInfo->discount / $courseInfo->price) * 100) }}% Off</span>
                                    @elseif($courseInfo->price > 0)
                                        <div class="price-amount"><span>${{ number_format($courseInfo->price, 2) }}</span></div>
                                    @else
                                        <div class="price-amount"><span class="text-success">Free</span></div>
                                    @endif
                                </div>
                            <div class="px-3">
                                @if(Auth::check() && Auth::user()->isEnrolledInCourse($courseInfo->id))
                                    <a href="javascript:void(0)" class="theme-btn2 w-100"> <span class="fas fa-check-circle"></span> Enrolled</a>
                                @else
                                    <a href="{{ route('checkout', $courseInfo->id) }}" class="theme-btn w-100"> <span class="far fa-shopping-bag"></span> Enroll Now</a>
                                @endif
                            </div>
                            <div class="more-info px-3">
                                <ul>
                                    <li><i class="fad fa-user"></i> Instructor: <span>{{ $courseInfo->teachers->first()->user->name ?? 'Instructor' }}</span></li>
                                    <li><i class="fad fa-layer-group"></i> Level : <span>{{ ucfirst($courseInfo->live_or_record ?? 'All Level') }}</span></li>
                                    <li><i class="fad fa-book"></i> Lectures : <span>{{ $courseInfo->lessons()->count() }} Lessons</span></li>
                                    <li><i class="fad fa-clock"></i> Modules: <span>{{ $courseInfo->courseModules()->count() }} Modules</span></li>
                                    {{-- <li><i class="fad fa-user-friends"></i> Enrolled: <span>{{ DB::table('courses_order')->where('course_id', $courseInfo->id)->count() }} Students</span></li> --}}
                                    <li><i class="fad fa-globe"></i> Language: <span>{{ $courseInfo->language ?? 'English' }}</span></li>
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
        <div id="related-courses-section" class="course-area pb-120">
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
                    @forelse($relatedCourses as $related)
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <div class="course-item">
                            <span class="course-tag {{ $related->live_or_record == 'live' ? 'c1' : ($related->live_or_record == 'record' ? 'c2' : 'c1') }}">{{ ucfirst($related->live_or_record ?? 'Course') }}</span>
                            <div class="course-img">
                                <a href="{{ route('course.details', $related->id) }}"><img src="{{ asset('uploads/courses/' . $related->image) }}"
                                        alt="{{ $related->name }}" /></a>
                            </div>
                            <div class="course-content">
                                <div class="course-meta">
                                    <span class="category c1">{{ $related->category->name ?? 'Uncategorized' }}</span>
                                    <div class="rating">
                                        <i class="fas fa-star"></i>
                                        <span>{{ $related->averageRating() }} ({{ $related->reviewCount() }})</span>
                                    </div>
                                </div>
                                <h4 class="course-title"><a href="{{ route('course.details', $related->id) }}">{{ Str::limit($related->name, 50) }}</a></h4>
                                <div class="course-info">
                                    <ul>
                                        <li class="lecture"><i class="fad fa-book-open-reader"></i>{{ $related->lessons()->count() }} Lectures</li>
                                        <li class="duration"><i class="fad fa-clock-rotate-left"></i>{{ $related->courseModules()->count() }} Modules</li>
                                    </ul>
                                </div>
                                <div class="course-bottom">
                                    <a href="{{ route('course.details', $related->id) }}">
                                        <div class="course-instructor">
                                            @php
                                                $relTeacher = $related->teachers->first();
                                            @endphp
                                            @if($relTeacher && $relTeacher->profile_image && $relTeacher->profile_image !== 'default_profile_image.jpg')
                                                <img src="{{ asset('uploads/teachers/' . $relTeacher->profile_image) }}" alt="{{ $relTeacher->user->name }}" />
                                            @else
                                                <img src="{{ asset('assets/frontend') }}/img/course/ins-1.jpg" alt="Instructor" />
                                            @endif
                                            <h6>{{ $relTeacher->user->name ?? 'Instructor' }}</h6>
                                        </div>
                                    </a>
                                    <div class="course-price">
                                        @if($related->discount)
                                            <del>${{ number_format($related->price, 2) }}</del>
                                            <span>${{ number_format($related->price - $related->discount, 2) }}</span>
                                        @elseif($related->price > 0)
                                            <span>${{ number_format($related->price, 2) }}</span>
                                        @else
                                            <span class="text-success">Free</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12">
                        <div class="alert-bg text-center py-2 rounded-3">No related courses found.</div>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
        <!-- related course end -->

        <!-- Review Modal -->
        <div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content" style="border-radius: 15px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
                    <div class="modal-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <h4 class="modal-title" style="font-weight: 700; color: #333;">Post a review for <span style="color: #00a0dc;">{{ $courseInfo->name }}</span></h4>
                            <button type="button" class="review-modal-close" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>

                        <form id="review-form">
                            @csrf
                            <input type="hidden" name="course_id" value="{{ $courseInfo->id }}">

                            <div class="mb-4">
                                <p class="mb-2" style="font-weight: 600; color: #555;">Give a rating</p>
                                <div class="star-rating d-flex gap-2">
                                    <i class="far fa-star fa-2x star-icon" data-value="1" style="cursor: pointer; color: #ccc;"></i>
                                    <i class="far fa-star fa-2x star-icon" data-value="2" style="cursor: pointer; color: #ccc;"></i>
                                    <i class="far fa-star fa-2x star-icon" data-value="3" style="cursor: pointer; color: #ccc;"></i>
                                    <i class="far fa-star fa-2x star-icon" data-value="4" style="cursor: pointer; color: #ccc;"></i>
                                    <i class="far fa-star fa-2x star-icon" data-value="5" style="cursor: pointer; color: #ccc;"></i>
                                    <input type="hidden" name="rating" id="rating-value" value="">
                                </div>
                                <span class="text-danger error-rating"></span>
                            </div>

                            <div class="mb-4">
                                <p class="mb-2" style="font-weight: 600; color: #555;">Leave your review</p>
                                <textarea name="comment" class="form-control" rows="4" style="border-radius: 10px; border: 1px solid #eee; padding: 15px;" placeholder="Write your thoughts about this course..."></textarea>
                                <span class="text-danger error-comment"></span>
                            </div>

                            <button type="submit" class="theme-btn w-100 py-3" style="background: #eee; color: #999; border: none; font-weight: 700; transition: all 0.3s;" id="submit-review-btn" disabled>
                                SEND REVIEW
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </main>
@endsection

@push('frontend_script')
    <script>
        $(window).on('scroll', function() {
            if ($(window).width() >= 992) {
                var sidebar = $('.position_fixed');
                var relatedSection = $('#related-courses-section');
                var container = $('.course-single');

                if (sidebar.length && relatedSection.length) {
                    var scrollPos = $(window).scrollTop();
                    var relatedTop = relatedSection.offset().top;
                    var sidebarHeight = sidebar.outerHeight();
                    var stopPoint = relatedTop - sidebarHeight - 50;

                    if (scrollPos >= stopPoint) {
                        sidebar.css({
                            'position': 'absolute',
                            'top': (stopPoint - container.offset().top + 100) + 'px',
                            'right': '4%' // Align to column gutter
                        });
                    } else {
                        sidebar.css({
                            'position': 'fixed',
                            'top': '60%',
                            'right': '4%'
                        });
                    }
                }
            }
        });

        // Review & Star Rating Logic
        $(document).ready(function() {
            // Star hover and click logic
            $('.star-icon').on('mouseover', function() {
                var value = $(this).data('value');
                $('.star-icon').each(function() {
                    if ($(this).data('value') <= value) {
                        $(this).removeClass('far').addClass('fas').css('color', '#ffc107');
                    } else {
                        $(this).removeClass('fas').addClass('far').css('color', '#ccc');
                    }
                });
            }).on('mouseout', function() {
                var selectedValue = $('#rating-value').val();
                $('.star-icon').each(function() {
                    if (selectedValue && $(this).data('value') <= selectedValue) {
                        $(this).removeClass('far').addClass('fas').css('color', '#ffc107');
                    } else {
                        $(this).removeClass('fas').addClass('far').css('color', '#ccc');
                    }
                });
            }).on('click', function() {
                var value = $(this).data('value');
                $('#rating-value').val(value);
                validateForm();
            });

            // Enable/Disable submit button based on validation
            $('textarea[name="comment"]').on('input', function() {
                validateForm();
            });

            function validateForm() {
                var rating = $('#rating-value').val();
                var comment = $('textarea[name="comment"]').val().trim();
                var submitBtn = $('#submit-review-btn');

                if (rating && comment.length > 0) {
                    submitBtn.prop('disabled', false).css({
                        'background': 'var(--theme-color)',
                        'color': '#fff'
                    });
                } else {
                    submitBtn.prop('disabled', true).css({
                        'background': '#eee',
                        'color': '#999'
                    });
                }
            }

            // AJAX Submission
            $('#review-form').on('submit', function(e) {
                e.preventDefault();
                var formData = $(this).serialize();
                var submitBtn = $('#submit-review-btn');

                submitBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> SENDING...');

                $.ajax({
                    url: "{{ route('course.reviews.store') }}",
                    type: "POST",
                    data: formData,
                    success: function(response) {
                        $('#reviewModal').modal('hide');
                        $('#review-form')[0].reset();
                        $('.star-icon').removeClass('fas').addClass('far').css('color', '#ccc');
                        $('#rating-value').val('');
                        validateForm();

                        // Prepend the new review
                        $('.no-reviews-msg').remove();
                        $('#review-list').prepend(response.review);

                        // Update review count
                        var currentCount = parseInt($('#review-count').text());
                        $('#review-count').text(currentCount + 1);

                        // Hide the Give Review button
                        $('#give-review-btn').remove();

                        Swal.fire({
                            title: 'Success!',
                            text: response.success,
                            icon: 'success',
                            confirmButtonColor: 'var(--theme-color)'
                        });
                    },
                    error: function(xhr) {
                        submitBtn.prop('disabled', false).text('SEND REVIEW');
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;
                            if (errors.rating) $('.error-rating').text(errors.rating[0]);
                            if (errors.comment) $('.error-comment').text(errors.comment[0]);
                        } else if (xhr.status === 401) {
                            Swal.fire('Error', 'Please login to post a review.', 'error');
                        } else {
                            Swal.fire('Error', 'Something went wrong. Please try again.', 'error');
                        }
                    }
                });
            });

            // AJAX Load More
            $('#load-more-reviews').on('click', function() {
                var btn = $(this);
                var page = btn.data('page');
                var courseId = "{{ $courseInfo->id }}";

                btn.html('<i class="fas fa-spinner fa-spin"></i> Loading...');

                $.ajax({
                    url: `/course-reviews/${courseId}?page=${page}`,
                    type: "GET",
                    success: function(response) {
                        $('#review-list').append(response.html);
                        if (response.hasMore) {
                            btn.data('page', response.nextPage).html('<span class="fas fa-sync-alt"></span> Load More');
                        } else {
                            btn.remove();
                        }
                    },
                    error: function() {
                        btn.html('<span class="fas fa-sync-alt"></span> Load More');
                        Swal.fire('Error', 'Failed to load more reviews.', 'error');
                    }
                });
            });
        });
    </script>
@endpush
