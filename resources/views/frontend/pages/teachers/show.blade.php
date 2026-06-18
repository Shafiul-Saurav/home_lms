@extends('frontend.layouts.master')

@section('title', optional($teacher->user)->name ?? 'Instructor')

@push('frontend_style')
    <style>
        .instructor-social-links {
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .instructor-card .instructor-social-links a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: linear-gradient(to bottom right, #ff99ff 0%, #8e79f9 100%) !important;
            color: #ffffff !important;
            font-size: 14px;
            transition: all 0.5s ease !important;
            text-decoration: none;
        }

        .instructor-card .instructor-social-links a:hover {
            color: #ffffff !important;
            /* transform: translateY(-3px); */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        }

        .instructor-card .instructor-social-links a.facebook:hover {
            background: #1877f2 !important;
        }

        .instructor-card .instructor-social-links a.twitter:hover {
            background: #000000 !important;
        }

        .instructor-card .instructor-social-links a.linkedin:hover {
            background: #0a66c2 !important;
        }

        .instructor-card .instructor-social-links a.instagram:hover {
            background: #e1306c !important;
        }

        .instructor-card .instructor-social-links a.youtube:hover {
            background: #ff0000 !important;
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

                                <div class="instructor-social-links mb-3">
                                    <a href="{{ optional(optional($teacher->user)->profile)->facebook ?? '#' }}"
                                        target="_blank" class="facebook" title="Facebook"><i
                                            class="fab fa-facebook-f"></i></a>
                                    <a href="{{ optional(optional($teacher->user)->profile)->twitter ?? '#' }}"
                                        target="_blank" class="twitter" title="X (Twitter)"><i
                                            class="fab fa-x-twitter"></i></a>
                                    <a href="{{ optional(optional($teacher->user)->profile)->linkedIn ?? '#' }}"
                                        target="_blank" class="linkedin" title="LinkedIn"><i
                                            class="fab fa-linkedin-in"></i></a>
                                    <a href="{{ optional(optional($teacher->user)->profile)->instagram ?? '#' }}"
                                        target="_blank" class="instagram" title="Instagram"><i
                                            class="fab fa-instagram"></i></a>
                                    <a href="#" target="_blank" class="youtube" title="YouTube"><i
                                            class="fab fa-youtube"></i></a>
                                </div>

                                <h4>{{ optional($teacher->user)->name ?? 'Instructor' }}</h4>
                                <p class="text-muted">{{ $teacher->qualification ?? '' }}</p>

                                <div class="mt-3">
                                    <span class="d-block">Rating:
                                        <strong>{{ number_format($averageRating ?? 0, 1) }}</strong></span>
                                    <span class="d-block">Reviews: <strong>{{ $reviewCount ?? 0 }}</strong></span>
                                    <span class="d-block">Courses:
                                        <strong>{{ $teacher->courses->count() ?? 0 }}</strong></span>
                                </div>

                                <div class="mt-3">
                                    <a href="#" class="theme-btn">Contact</a>
                                </div>
                            </div>

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
                                        <div class="col-md-6">
                                            <div class="course-card p-3 border rounded">
                                                <h5><a
                                                        href="{{ route('course.details', $course->id) }}">{{ Str::limit($course->name, 80) }}</a>
                                                </h5>
                                                <p class="text-muted">
                                                    {{ Str::limit($course->short_description ?? ($course->description ?? ''), 140) }}
                                                </p>
                                                <div class="mt-2">
                                                    <a href="{{ route('course.details', $course->id) }}"
                                                        class="btn btn-outline-primary btn-sm">View Course</a>
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
