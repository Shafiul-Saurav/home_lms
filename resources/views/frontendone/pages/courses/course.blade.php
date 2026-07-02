@extends('frontendone.layouts.master')

@section('title', 'Courses')

@push('frontendone_style')
    @include('frontend.pages.common.style')
    <style>
        .course-sidebar-modern .form-check label {
            font-size: 13px !important;
        }

        .form-check-input:checked {
            background-color: #74bd0d;
            border-color: #74bd0d;
        }

        .form-check-input:focus {
            border-color: #74bd0d;
            box-shadow: 0 0 0 0.25rem rgba(116, 189, 13, 0.25);
        }

        .course-hero {
            padding: 155px 0 85px;
            background: linear-gradient(135deg, #07111f 0%, #0d1f36 50%, #12345a 100%);
            color: #fff;
        }

        .course-hero .hero-kicker {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 14px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.12);
            font-weight: 700;
        }

        .course-hero h1 {
            font-size: clamp(2.2rem, 4vw, 4.2rem);
            line-height: 1.05;
            font-weight: 800;
            margin: 18px 0 14px;
        }

        .course-sidebar-modern,
        .course-grid-shell {
            background: #fff;
            border-radius: 28px;
            box-shadow: 0 18px 50px rgba(8, 15, 30, 0.08);
        }

        .course-sidebar-modern {
            position: sticky;
            top: 110px;
            padding: 24px;
        }

        .course-sidebar-modern .widget-title {
            font-size: 1.05rem;
            font-weight: 800;
            margin-bottom: 16px;
            color: #102949;
        }

        .course-sidebar-modern .form-control,
        .course-sidebar-modern .form-select {
            border-radius: 14px;
            min-height: 48px;
        }

        .filter-panel {
            border: 1px solid #e9ecef;
            border-radius: 18px;
            overflow: hidden;
        }

        .filter-panel-header {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            padding: 14px 16px;
            background: #f8f9fa;
            border: none;
            outline: none;
            cursor: pointer;
            font-size: 1rem;
            color: #102949;
        }

        .filter-panel-header .widget-title {
            margin-bottom: 0;
            font-size: 1.05rem;
            font-weight: 800;
        }

        .filter-panel-body {
            padding: 0 16px 16px;
            display: none;
        }

        .filter-panel-body.show {
            display: block;
        }

        .filter-toggle-icon {
            font-size: 0.85rem;
            transition: transform 0.2s ease;
        }

        .filter-panel-header[aria-expanded="false"] .filter-toggle-icon {
            transform: rotate(180deg);
        }

        .course-grid-shell {
            padding: 28px;
        }

        @media (max-width: 991px) {
            .course-hero {
                padding-top: 135px;
            }

            .course-sidebar-modern {
                position: static;
            }

            .course-grid-shell {
                padding: 20px;
            }
        }

        /*pagination style*/
        .active>.page-link,
        .page-link.active {
            z-index: 3;
            color: #fff;
            background-color: #76bd10;
            border-color: #76bd10;
        }

        .page-link,
        .page-link.active {
            z-index: 3;
            color: #76bd10;
            background-color: #ebebeb;
            border-color: #fff;
        }

        @media (max-width: 1443px) and (min-width: 1200px) {
            .course-card-modern .course-content {
                padding: 10px;
            }

            .course-card-modern .price-box h4 {
                font-size: 15px;
            }

            .course-card-modern .price-box .price-old-row del {
                font-size: 10px !important;
            }

            .enroll-btn {
                min-width: 90px;
                padding: 5px 5px;
                font-size: 12px;
                font-weight: 700;
            }
        }

        @media (max-width: 2520px) and (min-width: 1440px) {
            .course-card-modern .price-box h4 {
                font-size: 17px;
            }

            .course-card-modern .price-box .price-old-row del {
                font-size: 12px !important;
            }

            .enroll-btn {
                min-width: 90px;
                padding: 5px 6px;
                font-size: 12px;
                font-weight: 700;
            }
        }

        /* Categories marquee styles */
        .categories-marquee {
            overflow: hidden;
        }

        .marquee-track {
            display: flex;
            gap: 18px;
            align-items: center;
            will-change: transform;
        }

        .marquee-item {
            flex: 0 0 auto;
            display: flex;
            align-items: center;
            gap: 12px;
            background: #fff;
            padding: 8px 10px;
            border-radius: 10px;
            box-shadow: 0 6px 18px rgba(8, 15, 30, 0.06);
            min-width: 220px;
        }

        .marquee-thumb {
            width: 50px;
            height: 50px;
            border-radius: 8px;
            overflow: hidden;
            flex-shrink: 0;
            background: #f3f4f6;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .marquee-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .marquee-name {
            font-weight: 700;
            color: #102949;
        }

        @keyframes marquee-scroll {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-50%);
            }
        }

        .owl-carousel .owl-item .review-user img {
            width: 45px;
            height: 45px;
        }
    </style>
@endpush

@section('frontendone_content')
    <main class="main">
        <section class="course-hero">
            <div class="container">
                <div class="row align-items-end g-4">
                    <div class="col-lg-8">
                        <span class="hero-kicker"><i class="fa-solid fa-graduation-cap"></i> Browse All Courses</span>
                        <h1>Find the right cyber security course for your next step.</h1>
                        <p class="mb-0" style="max-width:720px;color:rgba(255,255,255,.82)">Explore live, recorded, free and
                            paid training built for learners who want practical skills, real-world labs and career-ready
                            guidance.</p>
                    </div>
                    <div class="col-lg-4 text-lg-end">
                        <a href="#courseGridSection" class="enroll-btn d-inline-flex align-items-center gap-2">Jump to
                            Courses <i class="fa-solid fa-arrow-down"></i></a>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-padding py-5">
            <div class="container">
                @php
                    use App\Models\CourseOrder;
                    use App\Models\CreateCertificate;
                    use App\Models\Course;

                    // Dynamic values (counts)
                    $enrolledCountDynamic = CourseOrder::where('status', 'Enrolled')
                        ->where('payment_status', 'Completed')
                        ->count();

                    $certificatesIssuedDynamic = CreateCertificate::where('status', 'approved')->count();

                    $expertCoursesCount = Course::count();

                    // Base offsets as requested
                    $enrolledBase = 3000;
                    $certificatesBase = 3000;

                    $enrolledDisplay = $enrolledBase + $enrolledCountDynamic;
                    $certificatesDisplay = $certificatesBase + $certificatesIssuedDynamic;
                @endphp

                <div class="row g-4 text-center">
                    <div class="col-md-4">
                        <div class="feature-card p-4 rounded-4 shadow-sm" style="background:#0f2344; color:#fff;">
                            <h2 class="mb-2"><span class="counter" data-from="0"
                                    data-to="{{ $enrolledDisplay }}">0</span>+</h2>
                            <p class="mb-0">Student Enrolled</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="feature-card p-4 rounded-4 shadow-sm" style="background:#142b56; color:#fff;">
                            <h2 class="mb-2">{{ $expertCoursesCount > 0 ? $expertCoursesCount : '50+' }}</h2>
                            <p class="mb-0">Expert Courses</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="feature-card p-4 rounded-4 shadow-sm" style="background:#183661; color:#fff;">
                            <h2 class="mb-2"><span class="counter" data-from="0"
                                    data-to="{{ $certificatesDisplay }}">0</span>+</h2>
                            <p class="mb-0">Certificate Issued</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Explore Course Categories Marquee -->
        <section class="section-padding py-5 bg-light">
            <div class="container">
                <div class="row mb-3">
                    <div class="col-12 text-center">
                        <h3 class="mb-2">Explore Course Categories</h3>
                        <p class="mb-0">Choose from our comprehensive range of cybersecurity specializations</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="categories-marquee py-2" style="background:transparent;">
                            <div class="marquee-wrap" style="overflow:hidden;">
                                <div class="marquee-track"
                                    style="animation: marquee-scroll linear infinite; animation-duration: {{ max(12, $categories->count() * 4) }}s;">
                                    @foreach ($categories as $category)
                                        <a href="{{ route('courses', array_merge(request()->all(), ['category' => $category->id])) }}"
                                            class="text-decoration-none">
                                            <div class="marquee-item">
                                                <div class="marquee-thumb">
                                                    @if ($category->file)
                                                        <img src="{{ asset('uploads/categories/' . $category->file) }}"
                                                            alt="{{ $category->name }}">
                                                    @else
                                                        <span style="font-size:12px;color:#6b7280;">No Image</span>
                                                    @endif
                                                </div>
                                                <div class="marquee-name">{{ $category->name }}</div>
                                            </div>
                                        </a>
                                    @endforeach

                                    {{-- duplicate items for seamless loop --}}
                                    @foreach ($categories as $category)
                                        <a href="{{ route('courses', array_merge(request()->all(), ['category' => $category->id])) }}"
                                            class="text-decoration-none">
                                            <div class="marquee-item">
                                                <div class="marquee-thumb">
                                                    @if ($category->file)
                                                        <img src="{{ asset('uploads/categories/' . $category->file) }}"
                                                            alt="{{ $category->name }}">
                                                    @else
                                                        <span style="font-size:12px;color:#6b7280;">No Image</span>
                                                    @endif
                                                </div>
                                                <div class="marquee-name">{{ $category->name }}</div>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-padding py-5" id="courseGridSection">
            <div class="container">
                <div class="row g-4">
                    <div class="col-lg-4 col-xl-3">
                        <aside class="course-sidebar-modern">
                            <div class="mb-4">
                                <h4 class="widget-title">Search Courses</h4>
                                <form id="searchForm" action="{{ route('courses') }}" method="GET">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="search" id="searchInput"
                                            placeholder="Search course" value="{{ request('search') }}">
                                        <button class="btn btn-dark" type="submit"><i
                                                class="fa-solid fa-magnifying-glass"></i></button>
                                    </div>
                                </form>
                            </div>

                            <div class="mb-4">
                                <div class="filter-panel">
                                    <button type="button" class="filter-panel-header" data-target="#categoryFilterBody"
                                        aria-expanded="true">
                                        <span class="widget-title mb-0">Category</span>
                                        <i class="fa-solid fa-chevron-up filter-toggle-icon"></i>
                                    </button>
                                    <div class="filter-panel-body show" id="categoryFilterBody">
                                        <div class="form-check">
                                            <input class="form-check-input category-filter" type="checkbox"
                                                value="" id="cat-all"
                                                {{ empty(request('category')) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="cat-all">All Categories
                                                ({{ $categories->sum('courses_count') }})</label>
                                        </div>
                                        @foreach ($categories as $category)
                                            <div class="form-check">
                                                <input class="form-check-input category-filter" type="checkbox"
                                                    value="{{ $category->id }}" id="cat-{{ $category->id }}"
                                                    {{ in_array($category->id, explode(',', request('category', ''))) ? 'checked' : '' }}>
                                                <label class="form-check-label"
                                                    for="cat-{{ $category->id }}">{{ $category->name }}
                                                    ({{ $category->courses_count }})
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="mb-4">
                                <div class="filter-panel">
                                    <button type="button" class="filter-panel-header" data-target="#priceFilterBody"
                                        aria-expanded="true">
                                        <span class="widget-title mb-0">Course Price</span>
                                        <i class="fa-solid fa-chevron-up filter-toggle-icon"></i>
                                    </button>
                                    <div class="filter-panel-body show" id="priceFilterBody">
                                        <div class="form-check">
                                            <input class="form-check-input price-filter" type="checkbox" value=""
                                                id="price-all" {{ empty(request('price')) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="price-all">All</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input price-filter" type="checkbox" value="free"
                                                id="price-free"
                                                {{ in_array('free', explode(',', request('price', ''))) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="price-free">Free</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input price-filter" type="checkbox" value="paid"
                                                id="price-paid"
                                                {{ in_array('paid', explode(',', request('price', ''))) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="price-paid">Paid</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </aside>
                    </div>

                    <div class="col-lg-8 col-xl-9">
                        <div class="course-grid-shell">
                            <div id="top-filter-area">
                                @include('frontendone.pages.courses.partials.course_topfilter', [
                                    'courses' => $courses,
                                ])
                            </div>

                            <div id="course-grid">
                                @if ($courses->count() > 0)
                                    <div class="row g-4 course-grid-area p-0 p-md-3">
                                        @foreach ($courses as $course)
                                            @include('frontendone.pages.courses.partials.course_filter', [
                                                'course' => $course,
                                            ])
                                        @endforeach
                                    </div>

                                    <div id="pagination-wrapper">
                                        @include('frontendone.pages.courses.partials.pagination', [
                                            'courses' => $courses,
                                        ])
                                    </div>
                                @else
                                    <div class="alert alert-warning text-center mb-0">
                                        <h3 class="mb-2">No Courses Found</h3>
                                        <p class="mb-0">Try adjusting your search, category or price filters.</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Student Review -->
        @include('frontendone.pages.widgets.review_section')
    </main>
@endsection

@push('frontendone_script')
    @include('frontend.pages.common.script')
    <script>
        (function() {
            function animateCounter(el, start, end, duration) {
                let startTime = null;
                const step = (timestamp) => {
                    if (!startTime) startTime = timestamp;
                    const progress = Math.min((timestamp - startTime) / duration, 1);
                    const value = Math.floor(progress * (end - start) + start);
                    el.textContent = value.toLocaleString();
                    if (progress < 1) {
                        requestAnimationFrame(step);
                    } else {
                        el.textContent = end.toLocaleString();
                    }
                };
                requestAnimationFrame(step);
            }

            function startCounters() {
                document.querySelectorAll('.counter').forEach(function(el) {
                    const from = parseInt(el.getAttribute('data-from') || '0', 10);
                    const to = parseInt(el.getAttribute('data-to') || '0', 10);
                    animateCounter(el, from, to, 1400);
                });
            }

            // Start when visible to the user
            if ('IntersectionObserver' in window) {
                const observer = new IntersectionObserver(function(entries, obs) {
                    entries.forEach(function(entry) {
                        if (entry.isIntersecting) {
                            startCounters();
                            obs.disconnect();
                        }
                    });
                }, {
                    threshold: 0.2
                });

                const target = document.querySelector('.feature-card .counter');
                if (target) observer.observe(target);
                else startCounters();
            } else {
                startCounters();
            }
        })();
    </script>
    <script>
        $(function() {
            function filterCourses(url) {
                $('#course-grid').css('opacity', '0.55');
                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'json',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    success: function(response) {
                        $('#course-grid').html(response.html);
                        $('#top-filter-area').html(response.topfilter);
                        $('#course-grid').css('opacity', '1');
                        history.pushState({}, '', url);
                    },
                    error: function() {
                        window.location.href = url;
                    }
                });
            }

            function buildFilterUrl(pageUrl = null) {
                let urlParams = new URLSearchParams(window.location.search);
                let search = $('#searchInput').val();
                search ? urlParams.set('search', search) : urlParams.delete('search');

                let categories = [],
                    allCategoriesChecked = false;
                $('.category-filter:checked').each(function() {
                    if ($(this).val() === '') allCategoriesChecked = true;
                    else categories.push($(this).val());
                });
                if (allCategoriesChecked) urlParams.delete('category');
                else if (categories.length > 0) urlParams.set('category', categories.join(','));
                else urlParams.delete('category');

                let prices = [],
                    allPricesChecked = false;
                $('.price-filter:checked').each(function() {
                    if ($(this).val() === '') allPricesChecked = true;
                    else prices.push($(this).val());
                });
                if (allPricesChecked) urlParams.delete('price');
                else if (prices.length > 0) urlParams.set('price', prices.join(','));
                else urlParams.delete('price');

                let sortBy = $('#sort_by').val();
                sortBy ? urlParams.set('sort_by', sortBy) : urlParams.delete('sort_by');

                if (pageUrl) {
                    let pageParam = new URL(pageUrl, window.location.origin).searchParams.get('page');
                    if (pageParam) urlParams.set('page', pageParam);
                } else {
                    urlParams.delete('page');
                }

                let query = urlParams.toString();
                return window.location.pathname + (query ? '?' + query : '');
            }

            function setFilterPanelState() {
                $('.filter-panel-header').each(function() {
                    let target = $($(this).data('target'));
                    let expanded = target.hasClass('show');
                    $(this).attr('aria-expanded', expanded ? 'true' : 'false');
                    let icon = $(this).find('.filter-toggle-icon');
                    if (expanded) {
                        icon.removeClass('fa-chevron-down').addClass('fa-chevron-up');
                    } else {
                        icon.removeClass('fa-chevron-up').addClass('fa-chevron-down');
                    }
                });
            }

            $(document).on('click', '.filter-panel-header', function() {
                let target = $($(this).data('target'));
                target.toggleClass('show');
                setFilterPanelState();
            });

            setFilterPanelState();

            $(document).on('change', '.category-filter, .price-filter, #sort_by', function() {
                filterCourses(buildFilterUrl());
            });

            $(document).on('submit', '#searchForm', function(e) {
                e.preventDefault();
                filterCourses(buildFilterUrl());
            });

            $(document).on('click', '.pagination a', function(e) {
                e.preventDefault();
                filterCourses(buildFilterUrl($(this).attr('href')));
            });
        });
    </script>
@endpush
