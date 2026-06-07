@extends('frontend.layouts.master')

@section('title', 'PDF Books')

@push('frontend_style')
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
                            <!-- search -->
                            <div class="widget mb-4">
                                <h4 class="title">Search PDF Books</h4>
                                <div class="search-form">
                                    <form id="searchForm" action="javascript:void(0);">
                                        <div class="form-group mb-0">
                                            <input type="text" class="form-control" id="pdf-book-search" placeholder="Search" />
                                            <button type="button"><i class="far fa-search"></i></button>
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
                                                <input class="form-check-input pdf-category-filter" type="checkbox" value="" id="cat0" checked />
                                                <label class="form-check-label" style="cursor: pointer;" for="cat0">
                                                    All Categories ({{ $categories->sum('pdf_books_count') }})
                                                </label>
                                            </div>
                                        </li>
                                        @foreach($categories as $category)
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input pdf-category-filter" type="checkbox" value="{{ $category->id }}" id="cat{{ $category->id }}" />
                                                <label class="form-check-label" style="cursor: pointer;" for="cat{{ $category->id }}">
                                                    {{ $category->name }} ({{ $category->pdf_books_count }})
                                                </label>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>

                            <!-- price -->
                            <div class="widget mb-4">
                                <h4 class="title">Book Price</h4>
                                <div class="price">
                                    <ul>
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input pdf-price-filter" type="checkbox" value="" id="price1" checked />
                                                <label class="form-check-label" style="cursor: pointer;" for="price1"> All</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input pdf-price-filter" type="checkbox" value="free" id="price2" />
                                                <label class="form-check-label" style="cursor: pointer;" for="price2"> Free</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input pdf-price-filter" type="checkbox" value="paid" id="price3" />
                                                <label class="form-check-label" style="cursor: pointer;" for="price3"> Paid</label>
                                            </div>
                                        </li>
                                    </ul>
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

                        if ($('select').length && typeof $.fn.niceSelect !== 'undefined') {
                            $('select').niceSelect('destroy');
                            $('select').niceSelect();
                        }

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
