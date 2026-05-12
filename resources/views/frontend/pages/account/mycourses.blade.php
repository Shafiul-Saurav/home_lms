@extends('frontend.layouts.master')

@section('title', 'My Courses')

@push('frontend_style')
@endpush

@section('frontend_content')
    <main class="main">
        <!-- breadcrumb -->
        <x-frontend.pages.common.breadcrumb :title="'My Courses'" :breadcrumb="[['name' => 'Home', 'url' => route('home')], ['name' => 'My Courses', 'url' => '#']]" />
        <!-- breadcrumb end -->

        <!-- user profile -->
        <div class="user-account py-100">
            <div class="container">
                <div class="row g-4">
                    <div class="col-lg-4 col-xl-3">
                        @include('frontend.pages.account.sidebarmenu.sidebar')
                    </div>
                    <div class="col-lg-8 col-xl-9">
                        <div class="user-wrapper course-border">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="user-card user-course">
                                        <div class="header">
                                            <h4 class="title">My Courses</h4>
                                            <div class="right">
                                                <div class="filter">
                                                    <select class="select">
                                                        <option value="">Default</option>
                                                        <option value="1">Pending</option>
                                                        <option value="2">Completed</option>
                                                    </select>
                                                </div>
                                                <div class="search">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control"
                                                            placeholder="Search..." />
                                                        <i class="far fa-search"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row g-4 mt-2">
                                            @forelse ($enrolledCourses as $order)
                                                @php $course = $order->course; @endphp
                                                <div class="col-md-6 col-lg-6 col-xl-4">
                                                    <div class="course-item">
                                                        <span
                                                            class="course-tag {{ $course->live_or_record == 'live' ? 'c1' : ($course->live_or_record == 'record' ? 'c2' : 'c1') }}">{{ $course->live_or_record ? ucfirst($course->live_or_record) : 'Course' }}</span>
                                                        <div class="course-img">
                                                            <a href="{{ route('course.video', ['course_id' => $course->id]) }}">
                                                                <img src="{{ asset('uploads/courses/' . $course->image) }}"
                                                                    alt="{{ $course->name }}" />
                                                            </a>
                                                        </div>
                                                        <div class="course-content">
                                                            <div class="course-meta">
                                                                <span
                                                                    class="category c1">{{ $course->category->name ?? 'Category' }}</span>
                                                                <div class="rating">
                                                                    <i class="fas fa-star"></i>
                                                                    <span>{{ $course->averageRating() }} ({{ $course->reviewCount() }})</span>
                                                                </div>
                                                            </div>
                                                            <h4 class="course-title">
                                                                <a
                                                                    href="{{ route('course.video', ['course_id' => $course->id]) }}">{{ $course->name }}</a>
                                                            </h4>
                                                            <div class="course-info">
                                                                <ul>
                                                                    <li class="lecture"><i
                                                                            class="fad fa-book-open-reader"></i>{{ $course->lessons()->count() }}
                                                                        Lessons</li>
                                                                    <li class="duration"><i
                                                                            class="fad fa-clock-rotate-left"></i>{{ $course->courseModules()->count() }}
                                                                        Modules</li>
                                                                </ul>
                                                            </div>
                                                            <div class="course-progress" style="height: 6px; background: #f1f5f9; border-radius: 10px; margin: 15px 0; overflow: hidden;">
                                                                <div class="course-progress-width" style="width: {{ $order->progress ?? 0 }}%; height: 100%; background: linear-gradient(90deg, #4f46e5, #9333ea); transition: width 1s ease-in-out;"></div>
                                                            </div>
                                                            <div class="course-bottom">
                                                                <a href="#">
                                                                    <div class="course-instructor">
                                                                        @php $mainTeacher = $course->teachers->first(); @endphp
                                                                        @if ($mainTeacher && $mainTeacher->profile_image && $mainTeacher->profile_image !== 'default_profile_image.jpg')
                                                                            <img src="{{ asset('uploads/teachers/' . $mainTeacher->profile_image) }}"
                                                                                alt="{{ $mainTeacher->user->name }}" />
                                                                        @else
                                                                            <img src="{{ asset('assets/frontend/img/course/ins-1.jpg') }}"
                                                                                alt="Instructor" />
                                                                        @endif
                                                                        <h6>{{ $mainTeacher->user->name ?? 'Instructor' }}
                                                                        </h6>
                                                                    </div>
                                                                </a>
                                                                <div class="course-status">
                                                                    <span>{{ $order->progress ?? 0 }}% Finish</span>
                                                                </div>
                                                            </div>
                                                            <a href="{{ route('course.video', ['course_id' => $course->id]) }}"
                                                                class="theme-btn"><span
                                                                    class="far fa-circle-play"></span> Start Learning</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @empty
                                                <div class="col-12">
                                                    <div class="alert alert-info text-center">
                                                        You haven't enrolled in any courses yet.
                                                    </div>
                                                </div>
                                            @endforelse
                                        </div>
                                        <!-- pagination -->
                                        <div class="pagination-area mb-3">
                                            <div aria-label="Page navigation example">
                                                <ul class="pagination mt-5">
                                                    <li class="page-item">
                                                        <a class="page-link" href="#" aria-label="Previous">
                                                            <span aria-hidden="true"><i
                                                                    class="far fa-angle-double-left"></i></span>
                                                        </a>
                                                    </li>
                                                    <li class="page-item active"><a class="page-link"
                                                            href="#">1</a></li>
                                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                                    <li class="page-item">
                                                        <a class="page-link" href="#" aria-label="Next">
                                                            <span aria-hidden="true"><i
                                                                    class="far fa-angle-double-right"></i></span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <!-- pagination end -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- user profile end -->

    </main>
@endsection

@push('frontend_script')
@endpush
