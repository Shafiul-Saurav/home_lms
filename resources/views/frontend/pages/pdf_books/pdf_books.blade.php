@extends('frontend.layouts.master')

@section('title', 'PDF Books')

@push('frontend_style')
    <style>
        .course-sidebar .widget-title {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #f1f1f1;
        }

        .category-list li {
            margin-bottom: 12px;
        }

        .category-list li a {
            display: flex;
            justify-content: space-between;
            color: #666;
            transition: 0.3s;
        }

        .category-list li a:hover {
            color: var(--theme-color);
            padding-left: 5px;
        }

        .category-list li .count {
            background: #f8f9fa;
            padding: 2px 10px;
            border-radius: 10px;
            font-size: 12px;
        }

        .price-filter .form-check {
            margin-bottom: 10px;
        }

        /* Filter sidebar styles */
        .filter-widget {
            background: #fff;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.03);
            margin-bottom: 30px;
        }

        .search-form {
            position: relative;
        }

        .search-form input {
            width: 100%;
            padding: 12px 20px;
            border-radius: 10px;
            border: 1px solid #eee;
            outline: none;
        }

        .search-form button {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            border: none;
            background: none;
            color: var(--theme-color);
        }
    </style>
@endpush



@section('frontend_content')
    <main class="main">
        <!-- breadcrumb -->
        <x-frontend.pages.common.breadcrumb :title="'PDF Books'" :breadcrumb="[['name' => 'Home', 'url' => route('home')], ['name' => 'PDF Books', 'url' => '#']]" />
        <!-- breadcrumb end -->

        <!-- course-area -->
        <div class="course-area py-120">
            <div class="container">
                <div class="row">
                    <!-- Sidebar Filters -->
                    <div class="col-lg-3">
                        <div class="course-sidebar">
                            <!-- Search -->
                            <div class="filter-widget">
                                <h4 class="widget-title">Search</h4>
                                <form action="#" class="search-form">
                                    <input type="text" id="pdf-book-search" placeholder="Search books...">
                                    <button type="button"><i class="far fa-search"></i></button>
                                </form>
                            </div>

                            <!-- Categories -->
                            <div class="filter-widget">
                                <h4 class="widget-title">Categories</h4>
                                <div class="category-list">
                                    @foreach ($categories as $category)
                                        <div class="form-check mb-2">
                                            <input class="form-check-input pdf-category-filter" type="checkbox"
                                                value="{{ $category->id }}" id="cat{{ $category->id }}">
                                            <label class="form-check-label d-flex justify-content-between w-100"
                                                for="cat{{ $category->id }}">
                                                {{ $category->name }}
                                                <span class="count">{{ $category->pdf_books_count }}</span>
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Price -->
                            <div class="filter-widget">
                                <h4 class="widget-title">Price</h4>
                                <div class="price-filter">
                                    <div class="form-check">
                                        <input class="form-check-input pdf-price-filter" type="checkbox" value="free"
                                            id="priceFree">
                                        <label class="form-check-label" for="priceFree">Free Books</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input pdf-price-filter" type="checkbox" value="paid"
                                            id="pricePaid">
                                        <label class="form-check-label" for="pricePaid">Paid Books</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Books Grid -->
                    <div class="col-lg-9">
                        <div class="course-sort-bar mb-4" id="pdf-book-topfilter">
                            @include('frontend.pages.pdf_books.pdf_book_topfilter', ['pdf_books' => $pdf_books])
                        </div>

                        <div class="row g-4" id="pdf-book-list">
                            @include('frontend.pages.pdf_books.pdf_book_filter_list', ['pdf_books' => $pdf_books])
                        </div>

                        <!-- Pagination -->
                        <div class="pagination-area mt-50" id="pdf-book-pagination">
                            {{ $pdf_books->links('frontend.pages.pdf_books.partials.pagination') }}
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
            function filterPdfBooks(page = 1) {
                let search = $('#pdf-book-search').val();
                let categories = [];
                $('.pdf-category-filter:checked').each(function() {
                    categories.push($(this).val());
                });
                let prices = [];
                $('.pdf-price-filter:checked').each(function() {
                    prices.push($(this).val());
                });
                let sortBy = $('#pdf-sort-by').val();

                $.ajax({
                    url: "{{ route('pdf.books') }}",
                    type: 'GET',
                    data: {
                        page: page,
                        search: search,
                        category: categories.join(','),
                        price: prices.join(','),
                        sort_by: sortBy
                    },
                    beforeSend: function() {
                        $('#pdf-book-list').css('opacity', '0.5');
                    },
                    success: function(response) {
                        $('#pdf-book-list').html(response.html).css('opacity', '1');
                        $('#pdf-book-topfilter').html(response.topfilter);

                        // Scroll to top of list
                        $('html, body').animate({
                            scrollTop: $(".course-area").offset().top - 100
                        }, 500);
                    }
                });
            }

            // Event listeners
            $('#pdf-book-search').on('keyup', function() {
                filterPdfBooks();
            });

            $('.pdf-category-filter, .pdf-price-filter').on('change', function() {
                filterPdfBooks();
            });

            $(document).on('change', '#pdf-sort-by', function() {
                filterPdfBooks();
            });

            // Handle pagination clicks
            $(document).on('click', '.pagination a', function(e) {
                e.preventDefault();
                let page = $(this).attr('href').split('page=')[1];
                filterPdfBooks(page);
            });
        });
    </script>
@endpush
