@extends('frontendone.layouts.master')

@section('title', $category->name . ' Courses')

@push('frontendone_style')
    @include('frontend.pages.common.style')
    <style>
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

        .course-sidebar-modern, .course-grid-shell {
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

        .course-sidebar-modern .form-control, .course-sidebar-modern .form-select {
            border-radius: 14px;
            min-height: 48px;
        }

        .course-grid-shell {
            padding: 28px;
        }

        @media (max-width: 991px) {
            .course-hero { padding-top: 135px; }
            .course-sidebar-modern { position: static; }
            .course-grid-shell { padding: 20px; }
        }

        /*pagination style*/
        .active>.page-link, .page-link.active {
            z-index: 3;
            color: #fff;
            background-color: #76bd10;
            border-color: #76bd10;
        }

        .page-link, .page-link.active {
            z-index: 3;
            color: #76bd10;
            background-color: #ebebeb;
            border-color: #fff;
        }
    </style>
@endpush

@section('frontendone_content')
    <main class="main">
        <section class="course-hero">
            <div class="container">
                <div class="row align-items-end g-4">
                    <div class="col-lg-8">
                        <span class="hero-kicker"><i class="fa-solid fa-graduation-cap"></i> Browse Category</span>
                        <h1>{{ $category->name }} Courses</h1>
                        <p class="mb-0" style="max-width:720px;color:rgba(255,255,255,.82)">Explore courses under the "{{ $category->name }}" category.</p>
                    </div>
                    <div class="col-lg-4 text-lg-end">
                        <a href="#courseGridSection" class="enroll-btn d-inline-flex align-items-center gap-2">Jump to Courses <i class="fa-solid fa-arrow-down"></i></a>
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
                                        <input type="text" class="form-control" name="search" id="searchInput" placeholder="Search course" value="{{ request('search') }}">
                                        <button class="btn btn-dark" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                                    </div>
                                </form>
                            </div>

                            <div class="mb-4">
                                <h4 class="widget-title">Category</h4>
                                <div>
                                    <div class="form-check">
                                        <input class="form-check-input category-filter" type="checkbox" value="" id="cat-all" {{ empty(request('category')) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="cat-all">All Categories ({{ $categories->sum('courses_count') }})</label>
                                    </div>
                                    @foreach ($categories as $cat)
                                        <div class="form-check">
                                            <input class="form-check-input category-filter" type="checkbox" value="{{ $cat->id }}" id="cat-{{ $cat->id }}" {{ in_array($cat->id, explode(',', request('category', ''))) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="cat-{{ $cat->id }}">{{ $cat->name }} ({{ $cat->courses_count }})</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div>
                                <h4 class="widget-title">Course Price</h4>
                                <div>
                                    <div class="form-check">
                                        <input class="form-check-input price-filter" type="checkbox" value="" id="price-all" {{ empty(request('price')) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="price-all">All</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input price-filter" type="checkbox" value="free" id="price-free" {{ in_array('free', explode(',', request('price', ''))) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="price-free">Free</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input price-filter" type="checkbox" value="paid" id="price-paid" {{ in_array('paid', explode(',', request('price', ''))) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="price-paid">Paid</label>
                                    </div>
                                </div>
                            </div>
                        </aside>
                    </div>

                    <div class="col-lg-8 col-xl-9">
                        <div class="course-grid-shell">
                            <div id="top-filter-area">
                                @include('frontendone.pages.courses.partials.course_topfilter', ['courses' => $courses])
                            </div>

                            <div id="course-grid">
                                @if ($courses->count() > 0)
                                    <div class="row g-4 course-grid-area p-0 p-md-3">
                                        @foreach ($courses as $course)
                                            @include('frontendone.pages.courses.partials.course_filter', ['course' => $course])
                                        @endforeach
                                    </div>

                                    <div id="pagination-wrapper">
                                        @include('frontendone.pages.courses.partials.pagination', ['courses' => $courses])
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
    </main>
@endsection

@push('frontendone_script')
    @include('frontend.pages.common.script')
    <script>
        $(function() {
            function filterCourses(url) {
                $('#course-grid').css('opacity', '0.55');
                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'json',
                    headers: { 'X-Requested-With': 'XMLHttpRequest' },
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

                let categories = [], allCategoriesChecked = false;
                $('.category-filter:checked').each(function() {
                    if ($(this).val() === '') allCategoriesChecked = true;
                    else categories.push($(this).val());
                });
                if (allCategoriesChecked) urlParams.delete('category');
                else if (categories.length > 0) urlParams.set('category', categories.join(','));
                else urlParams.delete('category');

                let prices = [], allPricesChecked = false;
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
