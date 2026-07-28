@extends('frontendone.layouts.master')

@section('title', 'All Courses — Live, Recorded and Free')

@push('frontendone_style')
    @include('frontend.pages.common.style')
    <style>
        .course-filter-bar .filter-btn.mobile {
            display: none;
        }

        @media (max-width: 768px) {
            .course-filter-bar .filter-btn.desktop {
                display: none;
            }

            .course-filter-bar .filter-btn.mobile {
                display: inline-block;
            }
        }

        .all-courses-hero {
            background: linear-gradient(135deg, #0f172a 0%, #1a2744 100%);
            padding: 100px 0 50px;
        }

        .all-courses-hero h1 {
            color: #fff;
            font-size: 2.2rem;
            font-weight: 800;
            margin-bottom: 10px;
        }

        .all-courses-hero p {
            color: #94a3b8;
            font-size: 1rem;
            max-width: 640px;
        }

        .hero-breadcrumb a {
            color: #76bd10;
            text-decoration: none;
        }

        .hero-breadcrumb span {
            color: #94a3b8;
            margin: 0 6px;
        }

        .all-courses-hero .hero-tabs {
            display: flex;
            gap: 12px;
            margin-top: 28px;
            flex-wrap: wrap;
        }

        .all-courses-hero .hero-tab {
            padding: 8px 20px;
            border-radius: 25px;
            border: 2px solid transparent;
            font-weight: 700;
            font-size: 14px;
            text-decoration: none;
            transition: all .25s;
        }

        .all-courses-hero .hero-tab.live {
            background: #ff896f;
            color: #fff;
        }

        .all-courses-hero .hero-tab.recorded {
            background: #76bd10;
            color: #fff;
        }

        .all-courses-hero .hero-tab.free {
            background: #3b82f6;
            color: #fff;
        }

        .all-courses-hero .hero-tab:hover {
            opacity: .85;
            transform: translateY(-2px);
        }
    </style>
@endpush

@section('frontendone_content')
    <main class="main">

        <div class="all-courses-hero" data-aos="fade-down">
            <div class="container">
                <nav class="hero-breadcrumb mb-3">
                    <a href="{{ route('home') }}">Home</a>
                    <span>/</span>
                    <span style="color:#fff;">All Courses</span>
                </nav>
                <h1>Explore All Courses</h1>
                <p>Choose your learning path — join a live bootcamp, watch recorded sessions at your own pace, or start
                    completely free.</p>
                <div class="hero-tabs">
                    <a href="#live-courses" class="hero-tab live"> <i class="fa-solid fa-signal-stream me-1"></i> Live
                        Courses</a>
                    <a href="#recorded-courses" class="hero-tab recorded"><i class="fa-solid fa-circle-play me-1"></i>
                        Recorded Courses</a>
                    <a href="#free-courses" class="hero-tab free"> <i class="fa-solid fa-gift me-1"></i> Free Courses</a>
                </div>
            </div>
        </div>

        @php $googleFormUrl = config('services.google_form_url', '#'); @endphp

        {{-- LIVE COURSES --}}
        <section class="section-padding course-section" id="live-courses" data-aos="fade-up">
            <div class="container">
                <div class="row gx-0">
                    <div class="col-12">
                        <div class="section-heading">
                            <span class="sub-title">
                                <i class="fa-solid fa-signal-stream"></i>
                                Live Cyber Security Courses
                            </span>
                            <h2>Join Our Live Instructor-Led Cyber Security Bootcamps</h2>
                            <p>
                                Real-time, interactive cyber security training delivered by industry experts.
                                Attend live sessions, ask questions instantly, and accelerate your career with
                                hands-on labs in SOC Analysis, Ethical Hacking, and Penetration Testing.
                            </p>
                        </div>
                        {{-- <div class="course-filter-wrap">
                            <div class="course-filter-bar" id="liveFilterBar">
                                <button type="button" class="filter-btn active" data-filter="all">All Course</button>
                                <button type="button" class="filter-btn" data-filter="free">Free</button>
                                <button type="button" class="filter-btn" data-filter="live">Live</button>
                                <button type="button" class="filter-btn" data-filter="recorded">Recorded</button>
                                <button type="button" class="filter-btn desktop" data-filter="upcoming">Upcoming
                                    Webinar</button>
                                <button type="button" class="filter-btn mobile" data-filter="upcoming">Upc..Web.</button>
                            </div>
                        </div> --}}
                    </div>
                </div>
                <div class="mb-3 text-center">
                    <p class="google-form-info d-none" style="margin-bottom:12px;color:#374151;">You will be redirected to a
                        Google Form to complete your registration.</p>
                    <a href="{{ $googleFormUrl ?: '#' }}" class="enroll-btn google-form-btn d-none"
                        style="display:inline-flex;align-items:center;gap:10px;padding:10px 18px;">
                        <i class="fa-brands fa-google" style="color:#fff;font-size:18px;"></i><span>Register via Google
                            Form</span>
                    </a>
                </div>
                @if ($liveCourses->isNotEmpty())
                    <div class="row g-4" id="live-grid">
                        @foreach ($liveCourses as $course)
                            @php
                                $courseType = $course->live_or_record ?? 'recorded';
                                if ($courseType === 'record') {
                                    $courseType = 'recorded';
                                }
                                $priceType =
                                    $course->free_or_paid === 'free' || $course->price == 0 || $course->price === null
                                        ? 'free'
                                        : 'paid';
                                $dataType = trim($courseType . ' ' . $priceType);
                            @endphp
                            <div class="col-xl-3 col-lg-3 col-md-6 col-6 px-1 px-md-2"
                                data-course-type="{{ $dataType }}" data-aos="fade-up"
                                data-aos-delay="{{ ($loop->index % 4) * 60 }}">
                                <div class="course-card-modern">
                                    <div class="course-thumb"><img src="{{ asset('uploads/courses/' . $course->image) }}"
                                            alt="{{ $course->name }}"></div>
                                    <div class="course-content">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <h3 class="mb-0">{{ $course->name }}</h3>
                                            <span class="course-badge"
                                                style="background:{{ $courseType === 'live' ? '#ff896f' : '#76bd10' }};color:#fff;padding:3px 8px;border-radius:12px;font-weight:700;font-size:10px;text-transform:capitalize;">{{ ucfirst($courseType) }}</span>
                                        </div>
                                        <p class="desc">
                                            {{ \Illuminate\Support\Str::words(strip_tags($course->short_description ?? $course->description), 10, '...') }}
                                        </p>
                                        <div class="course-meta">
                                            <span><i class="fa-regular fa-star"></i> {{ $course->averageRating() ?? 0 }}
                                                ({{ $course->reviewCount() ?? 0 }})
                                            </span>
                                            <span><i class="fa-regular fa-user"></i>
                                                {{ $course->students_count ?? 0 }}</span>
                                            <span><i class="fa-regular fa-file-lines"></i>
                                                {{ $course->lessons_count ?? $course->courseModules()->count() }}
                                                lessons</span>
                                            @if ($course->duration)
                                                <span><i class="fa-regular fa-clock"></i> {{ $course->duration }}</span>
                                            @endif
                                        </div>
                                        @if ($course->live_or_record === 'live')
                                            <div class="live-info mt-2 mb-2" style="color:#6b7280;font-size:13px;">
                                                <i class="fa-solid fa-calendar-days"></i>
                                                {{ $course->start_date ? \Carbon\Carbon::parse($course->start_date)->format('d M, Y') : 'Starting date: TBA' }}
                                                @if ($course->live_schedule)
                                                    &nbsp;•&nbsp;{{ $course->live_schedule }}
                                                @endif
                                            </div>
                                        @endif
                                        <ul class="course-list">
                                            @foreach ($course->features ?? [] as $feature)
                                                <li><i class="fa-solid fa-check"></i> {{ $feature }}</li>
                                            @endforeach
                                        </ul>
                                        <div class="course-bottom">
                                            <div class="price-box">
                                                @if ($course->free_or_paid === 'free')
                                                    <h4>Free</h4>
                                                @elseif($course->discount && $course->discount > 0)
                                                    @php
                                                        $fp = $course->price - $course->discount;
                                                        $dp =
                                                            $course->price > 0
                                                                ? round(($course->discount / $course->price) * 100)
                                                                : 0;
                                                    @endphp
                                                    <h4>{{ $fp > 0 ? $fp . ' Tk' : 'Free' }}</h4>
                                                    <div class="price-old-row">
                                                        <del>{{ $course->price > 0 ? $course->price . ' Tk' : 'Free' }}</del><span
                                                            class="discount">{{ $dp }}% OFF</span>
                                                    </div>
                                                @else<h4>{{ $course->price > 0 ? $course->price . ' Tk' : 'Free' }}
                                                    </h4>
                                                @endif
                                            </div>
                                            @php
                                                $btnText = $course->button_type ?? 'Enroll Now';
                                                $isComingSoon = in_array($btnText, ['Comming Soon', 'Coming Soon']);
                                            @endphp
                                            <a href="{{ route('course.details', $course->id) }}"
                                                class="enroll-btn">{{ $btnText }} <i
                                                    class="fa-solid {{ $isComingSoon ? 'fa-clock' : 'fa-arrow-right' }}"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-4">
                        <p style="color:#6b7280;">No live courses available at the moment. Check back soon!</p>
                    </div>
                @endif
            </div>
        </section>

        {{-- RECORDED COURSES --}}
        <section class="section-padding course-section" id="recorded-courses" data-aos="fade-up">
            <div class="container">
                <div class="row gx-0">
                    <div class="col-12">
                        <div class="section-heading">
                            <span class="sub-title">
                                <i class="fa-solid fa-circle-play"></i>
                                Recorded Cyber Security Courses
                            </span>
                            <h2>Learn at Your Own Pace with Our On-Demand Video Courses</h2>
                            <p>
                                Access structured, self-paced cyber security video courses anytime, anywhere.
                                Master Web Security, Digital Forensics, Reverse Engineering, and more with lifetime access
                                to all content and updates.
                            </p>
                        </div>
                        {{-- <div class="course-filter-wrap">
                            <div class="course-filter-bar" id="recordedFilterBar">
                                <button type="button" class="filter-btn active" data-filter="all">All Course</button>
                                <button type="button" class="filter-btn" data-filter="free">Free</button>
                                <button type="button" class="filter-btn" data-filter="live">Live</button>
                                <button type="button" class="filter-btn" data-filter="recorded">Recorded</button>
                                <button type="button" class="filter-btn desktop" data-filter="upcoming">Upcoming
                                    Webinar</button>
                                <button type="button" class="filter-btn mobile" data-filter="upcoming">Upc..Web.</button>
                            </div>
                        </div> --}}
                    </div>
                </div>
                <div class="mb-3 text-center">
                    <p class="google-form-info d-none" style="margin-bottom:12px;color:#374151;">You will be redirected to
                        a Google Form to complete your registration.</p>
                    <a href="{{ $googleFormUrl ?: '#' }}" class="enroll-btn google-form-btn d-none"
                        style="display:inline-flex;align-items:center;gap:10px;padding:10px 18px;">
                        <i class="fa-brands fa-google" style="color:#fff;font-size:18px;"></i><span>Register via Google
                            Form</span>
                    </a>
                </div>
                @if ($recordedCourses->isNotEmpty())
                    <div class="row g-4" id="recorded-grid">
                        @foreach ($recordedCourses as $course)
                            @php
                                $courseType = $course->live_or_record ?? 'recorded';
                                if ($courseType === 'record') {
                                    $courseType = 'recorded';
                                }
                                $priceType =
                                    $course->free_or_paid === 'free' || $course->price == 0 || $course->price === null
                                        ? 'free'
                                        : 'paid';
                                $dataType = trim($courseType . ' ' . $priceType);
                            @endphp
                            <div class="col-xl-3 col-lg-3 col-md-6 col-6 px-1 px-md-2"
                                data-course-type="{{ $dataType }}" data-aos="fade-up"
                                data-aos-delay="{{ ($loop->index % 4) * 60 }}">
                                <div class="course-card-modern">
                                    <div class="course-thumb"><img src="{{ asset('uploads/courses/' . $course->image) }}"
                                            alt="{{ $course->name }}"></div>
                                    <div class="course-content">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <h3 class="mb-0">{{ $course->name }}</h3>
                                            <span class="course-badge"
                                                style="background:{{ $courseType === 'live' ? '#ff896f' : '#76bd10' }};color:#fff;padding:3px 8px;border-radius:12px;font-weight:700;font-size:10px;text-transform:capitalize;">{{ ucfirst($courseType) }}</span>
                                        </div>
                                        <p class="desc">
                                            {{ \Illuminate\Support\Str::words(strip_tags($course->short_description ?? $course->description), 10, '...') }}
                                        </p>
                                        <div class="course-meta">
                                            <span><i class="fa-regular fa-star"></i> {{ $course->averageRating() ?? 0 }}
                                                ({{ $course->reviewCount() ?? 0 }})
                                            </span>
                                            <span><i class="fa-regular fa-user"></i>
                                                {{ $course->students_count ?? 0 }}</span>
                                            <span><i class="fa-regular fa-file-lines"></i>
                                                {{ $course->lessons_count ?? $course->courseModules()->count() }}
                                                lessons</span>
                                            @if ($course->duration)
                                                <span><i class="fa-regular fa-clock"></i> {{ $course->duration }}</span>
                                            @endif
                                        </div>
                                        <ul class="course-list">
                                            @foreach ($course->features ?? [] as $feature)
                                                <li><i class="fa-solid fa-check"></i> {{ $feature }}</li>
                                            @endforeach
                                        </ul>
                                        <div class="course-bottom">
                                            <div class="price-box">
                                                @if ($course->free_or_paid === 'free')
                                                    <h4>Free</h4>
                                                @elseif($course->discount && $course->discount > 0)
                                                    @php
                                                        $fp = $course->price - $course->discount;
                                                        $dp =
                                                            $course->price > 0
                                                                ? round(($course->discount / $course->price) * 100)
                                                                : 0;
                                                    @endphp
                                                    <h4>{{ $fp > 0 ? $fp . ' Tk' : 'Free' }}</h4>
                                                    <div class="price-old-row">
                                                        <del>{{ $course->price > 0 ? $course->price . ' Tk' : 'Free' }}</del><span
                                                            class="discount">{{ $dp }}% OFF</span>
                                                    </div>
                                                @else<h4>{{ $course->price > 0 ? $course->price . ' Tk' : 'Free' }}
                                                    </h4>
                                                @endif
                                            </div>
                                            @php
                                                $btnText = $course->button_type ?? 'Enroll Now';
                                                $isComingSoon = in_array($btnText, ['Comming Soon', 'Coming Soon']);
                                            @endphp
                                            <a href="{{ route('course.details', $course->id) }}"
                                                class="enroll-btn">{{ $btnText }} <i
                                                    class="fa-solid {{ $isComingSoon ? 'fa-clock' : 'fa-arrow-right' }}"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-4">
                        <p style="color:#6b7280;">No recorded courses available at the moment. Check back soon!</p>
                    </div>
                @endif
            </div>
        </section>

        {{-- FREE COURSES --}}
        <section class="section-padding course-section" id="free-courses" data-aos="fade-up">
            <div class="container">
                <div class="row gx-0">
                    <div class="col-12">
                        <div class="section-heading">
                            <span class="sub-title">
                                <i class="fa-solid fa-gift"></i>
                                Free Cyber Security Courses
                            </span>
                            <h2>Start Your Cyber Security Journey — Completely Free</h2>
                            <p>
                                Explore our free introductory cyber security courses designed for beginners.
                                Get a solid foundation in IT security concepts, networking fundamentals, and
                                ethical hacking basics with zero cost, and upgrade whenever you are ready.
                            </p>
                        </div>
                        {{-- <div class="course-filter-wrap">
                            <div class="course-filter-bar" id="freeFilterBar">
                                <button type="button" class="filter-btn active" data-filter="all">All Course</button>
                                <button type="button" class="filter-btn" data-filter="free">Free</button>
                                <button type="button" class="filter-btn" data-filter="live">Live</button>
                                <button type="button" class="filter-btn" data-filter="recorded">Recorded</button>
                                <button type="button" class="filter-btn desktop" data-filter="upcoming">Upcoming
                                    Webinar</button>
                                <button type="button" class="filter-btn mobile"
                                    data-filter="upcoming">Upc..Web.</button>
                            </div>
                        </div> --}}
                    </div>
                </div>
                <div class="mb-3 text-center">
                    <p class="google-form-info d-none" style="margin-bottom:12px;color:#374151;">You will be redirected to
                        a Google Form to complete your registration.</p>
                    <a href="{{ $googleFormUrl ?: '#' }}" class="enroll-btn google-form-btn d-none"
                        style="display:inline-flex;align-items:center;gap:10px;padding:10px 18px;">
                        <i class="fa-brands fa-google" style="color:#fff;font-size:18px;"></i><span>Register via Google
                            Form</span>
                    </a>
                </div>
                @if ($freeCourses->isNotEmpty())
                    <div class="row g-4" id="free-grid">
                        @foreach ($freeCourses as $course)
                            @php
                                $courseType = $course->live_or_record ?? 'recorded';
                                if ($courseType === 'record') {
                                    $courseType = 'recorded';
                                }
                                $priceType =
                                    $course->free_or_paid === 'free' || $course->price == 0 || $course->price === null
                                        ? 'free'
                                        : 'paid';
                                $dataType = trim($courseType . ' ' . $priceType);
                            @endphp
                            <div class="col-xl-3 col-lg-3 col-md-6 col-6 px-1 px-md-2"
                                data-course-type="{{ $dataType }}" data-aos="fade-up"
                                data-aos-delay="{{ ($loop->index % 4) * 60 }}">
                                <div class="course-card-modern">
                                    <div class="course-thumb"><img src="{{ asset('uploads/courses/' . $course->image) }}"
                                            alt="{{ $course->name }}"></div>
                                    <div class="course-content">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <h3 class="mb-0">{{ $course->name }}</h3>
                                            <span class="course-badge"
                                                style="background:{{ $priceType === 'free' ? '#3b82f6' : '#76bd10' }};color:#fff;padding:3px 8px;border-radius:12px;font-weight:700;font-size:10px;">Free</span>
                                        </div>
                                        <p class="desc">
                                            {{ \Illuminate\Support\Str::words(strip_tags($course->short_description ?? $course->description), 10, '...') }}
                                        </p>
                                        <div class="course-meta">
                                            <span><i class="fa-regular fa-star"></i> {{ $course->averageRating() ?? 0 }}
                                                ({{ $course->reviewCount() ?? 0 }})
                                            </span>
                                            <span><i class="fa-regular fa-user"></i>
                                                {{ $course->students_count ?? 0 }}</span>
                                            <span><i class="fa-regular fa-file-lines"></i>
                                                {{ $course->lessons_count ?? $course->courseModules()->count() }}
                                                lessons</span>
                                            @if ($course->duration)
                                                <span><i class="fa-regular fa-clock"></i> {{ $course->duration }}</span>
                                            @endif
                                        </div>
                                        <ul class="course-list">
                                            @foreach ($course->features ?? [] as $feature)
                                                <li><i class="fa-solid fa-check"></i> {{ $feature }}</li>
                                            @endforeach
                                        </ul>
                                        <div class="course-bottom">
                                            <div class="price-box">
                                                <h4>Free</h4>
                                            </div>
                                            @php
                                                $btnText = $course->button_type ?? 'Enroll Now';
                                                $isComingSoon = in_array($btnText, ['Comming Soon', 'Coming Soon']);
                                            @endphp
                                            <a href="{{ route('course.details', $course->id) }}"
                                                class="enroll-btn">{{ $btnText }} <i
                                                    class="fa-solid {{ $isComingSoon ? 'fa-clock' : 'fa-arrow-right' }}"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-4">
                        <p style="color:#6b7280;">No free courses available at the moment. Check back soon!</p>
                    </div>
                @endif

                <div class="d-flex justify-content-center mt-5">
                    <a href="{{ route('courses') }}" class="enroll-btn px-4">View All Courses <i
                            class="fa-solid fa-arrow-right"></i></a>
                </div>
            </div>
        </section>

    </main>
@endsection

@push('frontendone_script')
    @include('frontend.pages.common.script')
@endpush
