@extends('frontend.layouts.master')

@section('title', 'Courses')

@push('frontend_style')
@endpush

@section('frontend_content')
    <main class="main">
        <!-- breadcrumb -->
        <x-frontend.pages.common.breadcrumb :title="'Courses'" :breadcrumb="[['name' => 'Home', 'url' => route('home')], ['name' => 'Courses', 'url' => '#']]" />
        <!-- breadcrumb end -->

        <!-- course-area -->
        <div class="course-area py-120">
            <div class="container">
                <div class="row g-4">
                    <div class="col-lg-4 col-xl-3">
                        <div class="course-sidebar">
                            <!-- search -->
                            <div class="widget mb-4">
                                <h4 class="title">Search Courses</h4>
                                <div class="search-form">
                                    <form id="searchForm" action="{{ route('courses') }}" method="GET">
                                        <div class="form-group mb-0">
                                            <input type="text" class="form-control" name="search" id="searchInput" placeholder="Search" value="{{ request('search') }}" />
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
                                                    All Categories ({{ $categories->sum('courses_count') }})
                                                </label>
                                            </div>
                                        </li>
                                        @foreach($categories as $category)
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input category-filter" type="checkbox" name="category" value="{{ $category->id }}" id="cat{{ $category->id }}" {{ in_array($category->id, explode(',', request('category', ''))) ? 'checked' : '' }} />
                                                <label class="form-check-label" style="cursor: pointer;" for="cat{{ $category->id }}">
                                                    {{ $category->name }} ({{ $category->courses_count }})
                                                </label>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <!-- price -->
                            <div class="widget mb-4">
                                <h4 class="title">Course Price</h4>
                                <div class="price">
                                    <ul>
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input price-filter" type="checkbox" name="price" value="" id="price1" {{ empty(request('price')) ? 'checked' : '' }} />
                                                <label class="form-check-label" style="cursor: pointer;" for="price1"> All</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input price-filter" type="checkbox" name="price" value="free" id="price2" {{ in_array('free', explode(',', request('price', ''))) ? 'checked' : '' }} />
                                                <label class="form-check-label" style="cursor: pointer;" for="price2"> Free</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input price-filter" type="checkbox" name="price" value="paid" id="price3" {{ in_array('paid', explode(',', request('price', ''))) ? 'checked' : '' }} />
                                                <label class="form-check-label" style="cursor: pointer;" for="price3"> Paid</label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-xl-9">
                        <div id="top-filter-area">
                            @include('frontend.pages.courses.course_topfilter')
                        </div>

                        <div id="course-grid">
                            @if($courses->count() > 0)
                            <div class="row g-4 course-grid-area">
                                @foreach($courses as $course)
                                    @include('frontend.pages.courses.course_filter')
                                @endforeach
                            </div>

                            <div id="pagination-wrapper">
                                @include('frontend.pages.courses.partials.pagination')
                            </div>
                            @else
                            <div class="alert alert-danger text-center" role="alert">
                                <h3>No Courses Found</h3>
                                <p>Sorry, we couldn't find any courses matching your filters. Please try adjusting your search criteria.</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- course-area end -->

    </main>
@endsection

@push('frontend_script')
<script>
    $(document).ready(function() {

        function filterCourses(url) {
            // Show some loading indicator if desired
            $('#course-grid').css('opacity', '0.5');

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

                    // Re-initialize nice select if it exists
                    if ($('select').length && typeof $.fn.niceSelect !== 'undefined') {
                        $('select').niceSelect('destroy');
                        $('select').niceSelect();
                    }

                    // Update URL without page reload
                    history.pushState({}, '', url);
                },
                error: function(xhr, status, error) {
                    console.log('AJAX Error:', error);
                    $('#course-grid').css('opacity', '1');
                    // Fallback to reload if error
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

            // Get price
            let prices = [];
            let allPricesChecked = false;
            $('.price-filter:checked').each(function() {
                if ($(this).val() === "") {
                    allPricesChecked = true;
                } else {
                    prices.push($(this).val());
                }
            });

            if (allPricesChecked) {
                urlParams.delete('price');
            } else if (prices.length > 0) {
                urlParams.set('price', prices.join(','));
            } else {
                urlParams.delete('price');
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
                // If filters change, reset to page 1
                urlParams.delete('page');
            }

            return window.location.pathname + '?' + urlParams.toString();
        }

        // On Filter Change (Category, Price)
        $(document).on('change', '.category-filter, .price-filter', function() {
            let newUrl = buildFilterUrl();
            filterCourses(newUrl);
        });

        // On Sort Change
        $(document).on('change', '.sort-by-select', function() {
            let newUrl = buildFilterUrl();
            filterCourses(newUrl);
        });

        // On Search Submit
        $(document).on('submit', '#searchForm', function(e) {
            e.preventDefault();
            let newUrl = buildFilterUrl();
            filterCourses(newUrl);
        });

        // On Pagination Click
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            let pageUrl = $(this).attr('href');
            let newUrl = buildFilterUrl(pageUrl);
            filterCourses(newUrl);
        });
    });
</script>
@endpush
