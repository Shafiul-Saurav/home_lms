@extends('frontend.layouts.master')

@section('title', 'Instructors')

@section('frontend_content')
    <main class="main">
        <x-frontend.pages.common.breadcrumb :title="'Instructors'" :breadcrumb="[['name' => 'Home', 'url' => route('home')], ['name' => 'Instructors', 'url' => '#']]" />

        <div class="course-area py-120">
            <div class="container">
                <div class="row g-4">
                    <div class="col-lg-4 col-xl-3">
                        <div class="course-sidebar">
                            <!-- search -->
                            <div class="widget mb-4">
                                <h4 class="title">Search Instructors</h4>
                                <div class="search-form">
                                    <form id="searchForm" action="{{ route('teachers') }}" method="GET">
                                        <div class="form-group mb-0">
                                            <input type="text" class="form-control" name="search" id="searchInput" placeholder="Search" value="{{ request('search', $selectedSearch ?? '') }}" />
                                            <button type="submit"><i class="far fa-search"></i></button>
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
                                                <input class="form-check-input category-filter" type="checkbox" name="category" value="" id="cat0" {{ empty(request('category')) ? 'checked' : '' }} />
                                                <label class="form-check-label" style="cursor: pointer;" for="cat0">
                                                    All Categories ({{ $totalInstructorsCount }})
                                                </label>
                                            </div>
                                        </li>
                                        @foreach($categories as $category)
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input category-filter" type="checkbox" name="category" value="{{ $category->id }}" id="cat{{ $category->id }}" {{ in_array($category->id, explode(',', request('category', ''))) ? 'checked' : '' }} />
                                                    <label class="form-check-label" style="cursor: pointer;" for="cat{{ $category->id }}">
                                                        {{ $category->name }} ({{ $category->instructors_count ?? 0 }})
                                                    </label>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>

                            <!-- course -->
                            <div class="widget mb-4">
                                <h4 class="title">Course</h4>
                                <div class="category">
                                    <select class="form-control course-select" id="course_select" name="course">
                                        <option value="">All Courses</option>
                                        @foreach($courses as $course)
                                            <option value="{{ $course->id }}" {{ request('course') == $course->id ? 'selected' : '' }}>{{ Str::limit($course->name, 60) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-xl-9">
                        <div id="top-filter-area">
                            @include('frontend.pages.teachers.teacher_topfilter')
                        </div>

                        <div id="teacher-grid">
                            @if($teachers->count() > 0)
                                <div class="row g-4 course-grid-area">
                                    @foreach($teachers as $teacher)
                                        @include('frontend.pages.teachers.teacher_filter')
                                    @endforeach
                                </div>

                                <div id="pagination-wrapper">
                                    @include('frontend.pages.teachers.partials.pagination')
                                </div>
                            @else
                                <div class="alert alert-danger text-center" role="alert">
                                    <h3>No Instructors Found</h3>
                                    <p>Sorry, we couldn\'t find any instructors matching your filters. Please try adjusting your search criteria.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>
@endsection

@push('frontend_script')
<script>
    $(document).ready(function() {

        function filterTeachers(url) {
            $('#teacher-grid').css('opacity', '0.5');

            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                success: function(response) {
                    $('#teacher-grid').html(response.html);
                    $('#top-filter-area').html(response.topfilter);
                    $('#teacher-grid').css('opacity', '1');

                    // Re-initialize nice select if it exists
                    if ($('select').length && typeof $.fn.niceSelect !== 'undefined') {
                        $('select').niceSelect('destroy');
                        $('select').niceSelect();
                    }

                    history.pushState({}, '', url);
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                    $('#teacher-grid').css('opacity', '1');
                    window.location.reload();
                }
            });
        }

        function buildFilterUrl(pageUrl = null) {
            let urlParams = new URLSearchParams(window.location.search);

            // Get search
            let search = $('#searchInput').val();
            if (search) {
                urlParams.set('search', search);
            } else {
                urlParams.delete('search');
            }

            // Get category
            let categories = [];
            let allCategoriesChecked = false;
            $('.category-filter:checked').each(function() {
                if ($(this).val() === "") {
                    allCategoriesChecked = true;
                } else {
                    categories.push($(this).val());
                }
            });

            if (allCategoriesChecked) {
                urlParams.delete('category');
            } else if (categories.length > 0) {
                urlParams.set('category', categories.join(','));
            } else {
                urlParams.delete('category');
            }

            // Get course
            let course = $('#course_select').val();
            if (course) {
                urlParams.set('course', course);
            } else {
                urlParams.delete('course');
            }

            // Get sort_by
            let sortBy = $('#sort_by').val();
            if (sortBy) {
                urlParams.set('sort_by', sortBy);
            } else {
                urlParams.delete('sort_by');
            }

            // Page handling
            if (pageUrl) {
                let pageParam = new URL(pageUrl, window.location.origin).searchParams.get('page');
                if (pageParam) {
                    urlParams.set('page', pageParam);
                }
            } else {
                urlParams.delete('page');
            }

            // Add debug flag when running on localhost to get server debug JSON
            if (window.location.hostname === 'localhost' || window.location.hostname === '127.0.0.1') {
                urlParams.set('debug_teachers', '1');
            }

            return window.location.pathname + '?' + urlParams.toString();
        }

        $(document).on('change', '.category-filter', function(e) {
            // If user clicked the All checkbox, uncheck others
            if ($(this).val() === "") {
                if ($(this).is(':checked')) {
                    $('.category-filter').not(this).prop('checked', false);
                } else {
                    let anyOther = $('.category-filter').not(this).filter(':checked').length;
                    if (anyOther === 0) {
                        $(this).prop('checked', true);
                    }
                }
            } else {
                // If a specific category is checked, uncheck All
                if ($(this).is(':checked')) {
                    $('#cat0').prop('checked', false);
                } else {
                    let anyOther = $('.category-filter').not('#cat0').filter(':checked').length;
                    if (anyOther === 0) {
                        $('#cat0').prop('checked', true);
                    }
                }
            }

            let newUrl = buildFilterUrl();
            filterTeachers(newUrl);
        });

        // On Course Change
        $(document).on('change', '#course_select', function() {
            let newUrl = buildFilterUrl();
            filterTeachers(newUrl);
        });

        // On Sort Change
        $(document).on('change', '.sort-by-select', function() {
            let newUrl = buildFilterUrl();
            filterTeachers(newUrl);
        });

        // On Search Submit
        $(document).on('submit', '#searchForm', function(e) {
            e.preventDefault();
            let newUrl = buildFilterUrl();
            filterTeachers(newUrl);
        });

        // On Pagination Click
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            let pageUrl = $(this).attr('href');
            let newUrl = buildFilterUrl(pageUrl);
            filterTeachers(newUrl);
        });
    });
</script>
@endpush
