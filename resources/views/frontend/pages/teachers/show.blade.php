@extends('frontend.layouts.master')

@section('title', optional($teacher->user)->name ?? 'Instructor')

@push('frontend_style')
    <style>
        .instructor-social-links {
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .instructor-sidebar .instructor-social-links a {
            position: relative;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            color: #ffffff !important;
            font-size: 14px;
            text-decoration: none;
            overflow: hidden;
            z-index: 1;
            transition: transform 0.3s ease, box-shadow 0.3s ease !important;
        }

        /* Solid hover backgrounds on the anchor tags */
        .instructor-sidebar .instructor-social-links a.facebook {
            background-color: #1877f2 !important;
        }

        .instructor-sidebar .instructor-social-links a.twitter {
            background-color: #000000 !important;
        }

        .instructor-sidebar .instructor-social-links a.linkedin {
            background-color: #0a66c2 !important;
        }

        .instructor-sidebar .instructor-social-links a.instagram {
            background-color: #e1306c !important;
        }

        .instructor-sidebar .instructor-social-links a.youtube {
            background-color: #ff0000 !important;
        }

        /* Default gradient sits on top using ::before */
        .instructor-sidebar .instructor-social-links a::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to bottom right, #ff99ff 0%, #8e79f9 100%) !important;
            z-index: 2;
            opacity: 1;
            transition: opacity 0.3s ease !important;
        }

        /* Fade out the gradient on hover to reveal the solid background */
        .instructor-sidebar .instructor-social-links a:hover::before {
            opacity: 0 !important;
        }

        .instructor-sidebar .instructor-social-links a i {
            position: relative;
            z-index: 3;
            transition: color 0.3s ease;
        }

        /* Hover states */
        .instructor-sidebar .instructor-social-links a:hover {
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            color: #ffffff !important;
        }

        /* Horizontal Course Card Styles */
        .teacher-course-card {
            position: relative;
            display: flex;
            flex-direction: row;
            background: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: var(--box-shadow);
            transition: all 0.3s ease;
            height: 100%;
        }

        .teacher-course-card:hover {
            /* transform: translateY(-3px); */
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08);
            border-color: #d1d9e6;
        }

        .teacher-course-card .course-img-wrap {
            position: relative;
            width: 330px;
            min-height: 200px;
            flex-shrink: 0;
            overflow: hidden;
        }

        .teacher-course-card .course-img-wrap img {
            width: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .teacher-course-card:hover .course-img-wrap img {
            transform: scale(1.05);
        }

        .teacher-course-card .course-content-wrap {
            padding: 24px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            flex-grow: 1;
        }

        .teacher-course-card .course-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
        }

        .teacher-course-card .course-category {
            font-size: 13px;
            font-weight: 600;
            color: #8e79f9;
            text-transform: uppercase;
        }

        .teacher-course-card .course-rating {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
            color: #ffb606;
        }

        .teacher-course-card .course-rating span {
            color: #777777;
            font-weight: 500;
        }

        .teacher-course-card .course-title {
            font-size: 18px;
            font-weight: 700;
            line-height: 1.4;
            margin-bottom: 10px;
        }

        .teacher-course-card .course-title a {
            color: #2c2c2c;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .teacher-course-card .course-title a:hover {
            color: #8e79f9;
        }

        .teacher-course-card .course-desc {
            font-size: 14px;
            color: #666666;
            line-height: 1.6;
            margin-bottom: 15px;
        }

        .teacher-course-card .course-info-list {
            list-style: none;
            padding: 0;
            margin: 0 0 15px 0;
            display: flex;
            gap: 20px;
            font-size: 13px;
            color: #777777;
        }

        .teacher-course-card .course-info-list li {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .teacher-course-card .course-bottom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 15px;
            border-top: 1px solid #f1f3f7;
        }

        .teacher-course-card .instructor-info {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .teacher-course-card .instructor-info img {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            object-fit: cover;
        }

        .teacher-course-card .instructor-info span {
            font-size: 13px;
            font-weight: 600;
            color: #444444;
        }

        .teacher-course-card .course-price {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .teacher-course-card .course-price del {
            font-size: 13px;
            color: #999999;
        }

        .teacher-course-card .course-price span {
            font-size: 18px;
            font-weight: 700;
            color: #fd6a6a;
        }

        .teacher-course-card .course-price span.free {
            color: #28a745;
        }

        @media (max-width: 768px) {
            .teacher-course-card {
                flex-direction: column;
            }

            .teacher-course-card .course-img-wrap {
                width: 100%;
                height: 200px;
            }
        }
    </style>
@endpush

@section('frontend_content')
    <main class="main">
        <x-frontend.pages.common.breadcrumb :title="optional($teacher->user)->name ?? 'Instructor'" :breadcrumb="[
            ['name' => 'Home', 'url' => route('home')],
            ['name' => 'Instructors', 'url' => route('teachers')],
            ['name' => optional($teacher->user)->name ?? 'Instructor', 'url' => '#'],
        ]" />

        <div class="course-area py-120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="instructor-sidebar">
                            <div class="instructor-card mb-4 text-center">
                                @php
                                    $imgUrl = asset('assets/frontend/img/instructor/01.jpg');
                                    if (
                                        !empty($teacher->profile_image) &&
                                        $teacher->profile_image !== 'default_profile_image.jpg'
                                    ) {
                                        $imgUrl = asset('uploads/teachers/' . $teacher->profile_image);
                                    } elseif (
                                        optional(optional($teacher->user)->profile)->profileImage &&
                                        optional(optional($teacher->user->profile)->profileImage)->profile_image
                                    ) {
                                        $imgUrl = asset(
                                            optional(optional($teacher->user->profile)->profileImage)->profile_image,
                                        );
                                    }
                                @endphp
                                <img src="{{ $imgUrl }}" class="img-fluid rounded-circle mb-3"
                                    alt="{{ optional($teacher->user)->name }}" style="max-width:180px;" />
                            </div>
                            <hr>
                            <div class="instructor-social-links mb-3">
                                <a href="{{ optional(optional($teacher->user)->profile)->facebook ?? '#' }}" target="_blank"
                                    class="facebook" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                                <a href="{{ optional(optional($teacher->user)->profile)->twitter ?? '#' }}" target="_blank"
                                    class="twitter" title="X (Twitter)"><i class="fab fa-x-twitter"></i></a>
                                <a href="{{ optional(optional($teacher->user)->profile)->linkedIn ?? '#' }}" target="_blank"
                                    class="linkedin" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                                <a href="{{ optional(optional($teacher->user)->profile)->instagram ?? '#' }}"
                                    target="_blank" class="instagram" title="Instagram"><i class="fab fa-instagram"></i></a>
                                <a href="#" target="_blank" class="youtube" title="YouTube"><i
                                        class="fab fa-youtube"></i></a>
                            </div>
                            <h4>{{ optional($teacher->user)->name ?? 'Instructor' }}</h4>
                            <p class="text-muted">{{ $teacher->qualification ?? '' }}</p>

                            <div class="mt-3 d-inline-block text-start">
                                <span class="d-block mb-2"><i class="fas fa-star text-warning me-2"></i>Rating:
                                    <strong>{{ number_format($averageRating ?? 0, 1) }}</strong></span>
                                <span class="d-block mb-2"><i class="fas fa-comment-dots me-2"
                                        style="color: #fd6a6a;"></i>Reviews: <strong>{{ $reviewCount ?? 0 }}</strong></span>
                                <span class="d-block"><i class="fas fa-book-open me-2" style="color: #15d4c9"></i>Courses:
                                    <strong>{{ $teacher->courses->count() ?? 0 }}</strong></span>
                            </div>
                            <hr>
                            <div class="widget">
                                <h4 class="title">About</h4>
                                <p>{{ $teacher->about ?? 'No bio available.' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-8">
                        <div class="teacher-courses">
                            <h3>Courses by {{ optional($teacher->user)->name ?? 'Instructor' }}</h3>
                            @if ($courses->count())
                                <div class="row g-4 mt-3">
                                    @foreach ($courses as $course)
                                        <div class="col-12">
                                            <div class="teacher-course-card">
                                                <span
                                                    class="course-tag {{ $course->live_or_record == 'live' ? 'c1' : ($course->live_or_record == 'record' ? 'c2' : 'c1') }}">
                                                    {{ $course->live_or_record ? ucfirst($course->live_or_record) : 'Course' }}
                                                </span>
                                                <div class="course-img-wrap">
                                                    <a href="{{ route('course.details', $course->id) }}"
                                                        class="d-block h-100">
                                                        @if ($course->image)
                                                            <img src="{{ asset('uploads/courses/' . $course->image) }}"
                                                                alt="{{ $course->name }}" />
                                                        @else
                                                            <img src="{{ asset('assets/frontend/img/course/01.jpg') }}"
                                                                alt="{{ $course->name }}" />
                                                        @endif
                                                    </a>
                                                </div>
                                                <div class="course-content-wrap">
                                                    <div>
                                                        <div class="course-meta">
                                                            <span class="course-category">
                                                                {{ $course->category->name ?? 'Uncategorized' }}
                                                            </span>
                                                            <div class="course-rating mt-2">
                                                                <i class="fas fa-star"></i>
                                                                <span>{{ $course->averageRating() }}
                                                                    ({{ $course->reviewCount() }})
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <h4 class="course-title">
                                                            <a href="{{ route('course.details', $course->id) }}">
                                                                {{ Str::limit($course->name, 80) }}
                                                            </a>
                                                        </h4>
                                                        <p class="course-desc">
                                                            {!! Str::limit($course->short_description ?? ($course->description ?? ''), 150) !!}
                                                        </p>
                                                    </div>
                                                    <div>
                                                        <ul class="course-info-list">
                                                            <li>
                                                                <i class="fad fa-book-open-reader"
                                                                    style="color: #15d4c9"></i>
                                                                {{ $course->lessons()->count() }} Lessons
                                                            </li>
                                                            <li>
                                                                <i class="fad fa-clock-rotate-left"
                                                                    style="color: #fd6a6a"></i>
                                                                {{ $course->courseModules()->count() }} Modules
                                                            </li>
                                                        </ul>
                                                        <div class="course-bottom">
                                                            <div class="instructor-info">
                                                                @php
                                                                    $mainTeacher = $course->teachers->first();
                                                                @endphp
                                                                @if ($mainTeacher && $mainTeacher->profile_image && $mainTeacher->profile_image !== 'default_profile_image.jpg')
                                                                    <img src="{{ asset('uploads/teachers/' . $mainTeacher->profile_image) }}"
                                                                        alt="{{ $mainTeacher->user->name ?? 'Instructor' }}" />
                                                                @else
                                                                    <img src="{{ asset('assets/frontend') }}/img/course/ins-1.jpg"
                                                                        alt="Instructor" />
                                                                @endif
                                                                <span>{{ $mainTeacher->user->name ?? 'Instructor' }}</span>
                                                            </div>
                                                            <div class="course-price">
                                                                @if ($course->discount)
                                                                    <del>${{ number_format($course->price, 2) }}</del>
                                                                    <span>${{ number_format($course->price - $course->discount, 2) }}</span>
                                                                @elseif($course->price > 0)
                                                                    <span>${{ number_format($course->price, 2) }}</span>
                                                                @else
                                                                    <span class="free">Free</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="alert alert-info">No courses found for this instructor.</div>
                            @endif

                            <div class="mt-4">
                                <h4>Reviews</h4>
                                <div>
                                    {{-- Placeholder: course reviews listing could be added here later --}}
                                    <p class="text-muted">{{ $reviewCount ?? 0 }} approved reviews across instructor's
                                        courses.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </main>
@endsection
