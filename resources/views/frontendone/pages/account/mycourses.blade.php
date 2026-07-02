@extends('frontendone.layouts.master')

@section('title', 'My Courses')

@push('frontendone_style')
    @include('frontend.pages.common.style')
    <style>
        /* pagination style */
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

        /* @media (max-width: 1443px) and (min-width: 1200px) {
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
        } */
    </style>
@endpush

@section('frontendone_content')
    <main class="main">
        <!-- breadcrumb -->
        <x-frontend.pages.common.breadcrumb :title="'My Courses'" :breadcrumb="[['name' => 'Home', 'url' => route('home')], ['name' => 'My Courses', 'url' => '#']]" />
        <!-- breadcrumb end -->

        <!-- user profile -->
        <div class="user-account py-5">
            <div class="container">
                <div class="row g-4">
                    <div class="col-lg-4 col-xl-3">
                        @include('frontendone.pages.account.sidebarmenu.sidebar')
                    </div>
                    <div class="col-lg-8 col-xl-9">
                        <div class="user-wrapper course-border">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="user-card user-course">
                                        <div class="header">
                                            <h4 class="title">My Courses</h4>
                                            {{-- <div class="right">
                                                <div class="filter">
                                                    <select class="select" name="status" id="status-filter">
                                                        <option value="">Default</option>
                                                        <option value="1">Pending</option>
                                                        <option value="2">Completed</option>
                                                    </select>
                                                </div>
                                                <div class="search">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="search"
                                                            id="search-input" placeholder="Search..." />
                                                        <i class="far fa-search"></i>
                                                    </div>
                                                </div>
                                            </div> --}}
                                        </div>
                                        <div id="my-courses-container">
                                            @include('frontendone.pages.account.partials.mycourses_list')
                                        </div>
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

@push('frontendone_script')
    @include('frontend.pages.common.script')
    <script>
        $(document).ready(function() {
            let debounceTimer;

            function fetchCourses(url = null) {
                if (!url) {
                    let urlParams = new URLSearchParams();
                    let search = $('#search-input').val();
                    let status = $('#status-filter').val();

                    if (search) urlParams.set('search', search);
                    if (status) urlParams.set('status', status);

                    url = window.location.pathname + '?' + urlParams.toString();
                }

                $('#my-courses-container').css('opacity', '0.5');

                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'json',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    success: function(response) {
                        $('#my-courses-container').html(response.html);
                        $('#my-courses-container').css('opacity', '1');

                        // Update URL without page reload
                        history.pushState({}, '', url);
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', error);
                        $('#my-courses-container').css('opacity', '1');
                    }
                });
            }

            // Real-time search as user types with a 300ms debounce
            $(document).on('input', '#search-input', function() {
                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(function() {
                    fetchCourses();
                }, 300);
            });

            // Search when status filter changes
            $(document).on('change', '#status-filter', function() {
                fetchCourses();
            });

            // AJAX Pagination links click
            $(document).on('click', '#my-courses-container .pagination a', function(e) {
                e.preventDefault();
                let pageUrl = $(this).attr('href');
                fetchCourses(pageUrl);
            });
        });
    </script>
@endpush
