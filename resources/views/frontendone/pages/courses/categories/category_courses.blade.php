@extends('frontendone.layouts.master')

@section('title', $category->name . ' Courses')

@push('frontendone_style')
    @include('frontend.pages.common.style')
    <style>
        .course-sidebar-modern .form-check label {
            font-size: 13px !important;
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
    </style>
@endpush

@section('frontendone_content')
    <main class="main">
        <x-frontend.pages.common.breadcrumb :title="$category->name . ' Courses'" :breadcrumb="[['name' => 'Home', 'url' => route('home')], ['name' => $category->name . ' Courses', 'url' => '#']]" />
        <section class="section-padding py-5">
            <div class="container">
                <div class="row g-4">
                    <div class="section-heading">
                        <span class="sub-title">
                            <h2 class="mb-0"><i class="fa-solid fa-boxes-stacked"></i></h2>
                            <h2 class="mb-0">All Category Courses</h2>
                        </span>
                    </div>
                    <div class="col-lg-12 col-xl-12">
                        <div class="product-grid-shell p-4">
                            <div id="course-grid">
                                @if ($courses->count() > 0)
                                    <div class="row g-4 course-grid-area">
                                        @foreach ($courses as $course)
                                            @php
                                                $courseType = $course->live_or_record ?? 'recorded';
                                                if ($courseType === 'record') {
                                                    $courseType = 'recorded';
                                                }
                                                $finalPrice = $course->price - ($course->discount ?? 0);
                                            @endphp

                                            <div class="col-xl-3 col-lg-6 col-md-6 col-6 px-1 px-md-2"
                                                data-course-type="{{ $courseType }}">
                                                <div class="course-card-modern">
                                                    <div class="course-thumb">
                                                        <img src="{{ asset('uploads/courses/' . $course->image) }}"
                                                            alt="{{ $course->name }}">
                                                    </div>
                                                    <div class="course-content">
                                                        <div class="d-flex justify-content-between align-items-start">
                                                            <h3 class="mb-0">{{ $course->name }}</h3>
                                                            <span class="course-badge"
                                                                style="background: {{ $courseType === 'live' ? '#ff896f' : '#76bd10' }}; color: #fff; padding: 3px 8px; border-radius: 12px; font-weight: 700; font-size: 10px; text-transform: capitalize;">
                                                                {{ ucfirst($courseType) }}
                                                            </span>
                                                        </div>
                                                        <p class="desc">
                                                            {{ \Illuminate\Support\Str::words(strip_tags($course->short_description ?? $course->description), 10, '...') }}
                                                        </p>
                                                        <div class="course-meta">
                                                            <span><i class="fa-regular fa-star"></i>
                                                                {{ $course->averageRating() ?? 0 }}
                                                                ({{ $course->reviewCount() ?? 0 }})</span>
                                                            <span><i class="fa-regular fa-user"></i>
                                                                {{ $course->students_count ?? 0 }}</span>
                                                            <span><i class="fa-regular fa-file-lines"></i>
                                                                {{ $course->lessons_count ?? $course->courseModules()->count() }}
                                                                lessons</span>
                                                            @if ($course->duration)
                                                                <span><i class="fa-regular fa-clock"></i>
                                                                    {{ $course->duration }}</span>
                                                            @endif
                                                        </div>
                                                        <ul class="course-list">
                                                            @foreach ($course->features ?? [] as $feature)
                                                                <li><i class="fa-solid fa-check"></i> {{ $feature }}
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                        <div class="course-bottom">
                                                             <div class="price-box">
                                                                 @if ($course->free_or_paid === 'free')
                                                                     <h4>Free</h4>
                                                                 @elseif ($course->discount && $course->discount > 0)
                                                                     @php
                                                                         $discountPercent =
                                                                             $course->price > 0
                                                                                 ? round(
                                                                                     ($course->discount /
                                                                                         $course->price) *
                                                                                         100,
                                                                                 )
                                                                                 : 0;
                                                                     @endphp
                                                                     <h4>{{ $finalPrice > 0 ? $finalPrice . ' Tk' : 'Free' }}
                                                                     </h4>
                                                                     <div class="price-old-row">
                                                                         <del>{{ $course->price > 0 ? $course->price . ' Tk' : 'Free' }}</del>
                                                                         <span class="discount">{{ $discountPercent }}%
                                                                             OFF</span>
                                                                     </div>
                                                                 @elseif($course->price > 0)
                                                                     <h4>{{ $course->price }} Tk</h4>
                                                                 @else
                                                                     <h4>Free</h4>
                                                                 @endif
                                                             </div>
                                                             @php
                                                                 $btnText = $course->button_type ?? 'Enroll Now';
                                                                 $isComingSoon = in_array($btnText, ['Comming Soon', 'Coming Soon']);
                                                             @endphp
                                                             <a href="{{ route('course.details', $course->id) }}" class="enroll-btn">
                                                                 {{ $btnText }} <i class="fa-solid {{ $isComingSoon ? 'fa-clock' : 'fa-arrow-right' }}"></i>
                                                             </a>
                                                         </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <div class="col-12 mt-4" id="pagination-wrapper">
                                        @include('frontendone.pages.courses.partials.pagination', [
                                            'courses' => $courses,
                                        ])
                                    </div>
                                @else
                                    <div class="alert alert-warning text-center mb-0">
                                        <h3>No Courses Found</h3>
                                        <p>We couldn't find any courses in this category right now. Please check back later
                                            or browse another category.</p>
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
