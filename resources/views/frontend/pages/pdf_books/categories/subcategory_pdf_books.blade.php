@extends('frontend.layouts.master')

@section('title', 'PDF Books - ' . $subcategory->name)

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

        .category-list li a:hover,
        .category-list li a.active {
            color: var(--theme-color);
            padding-left: 5px;
            font-weight: 600;
        }

        .category-list li .count {
            background: #f8f9fa;
            padding: 2px 10px;
            border-radius: 10px;
            font-size: 12px;
        }

        .course-item {
            transition: 0.3s;
            border: 1px solid #f1f1f1;
            border-radius: 15px;
            overflow: hidden;
            background: #fff;
            height: 100%;
        }

        .course-item:hover {
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            transform: translateY(-5px);
        }

        .course-img img {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }

        .course-content {
            padding: 20px;
        }

        .course-title {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 10px;
            display: block;
            color: #222;
        }

        .course-price {
            font-weight: 700;
            color: var(--theme-color);
            font-size: 20px;
        }

        /* Filter sidebar styles */
        .filter-widget {
            background: #fff;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.03);
            margin-bottom: 30px;
        }
    </style>
@endpush

@section('frontend_content')
    <main class="main">
        <!-- breadcrumb -->
        <x-frontend.pages.common.breadcrumb :title="'PDF Subcategory: ' . $subcategory->name" :breadcrumb="[['name' => 'Home', 'url' => route('home')], ['name' => 'PDF Books', 'url' => route('pdf.books')], ['name' => $subcategory->name, 'url' => '#']]" />
        <!-- breadcrumb end -->

        <div class="course-area py-120">
            <div class="container">
                <div class="row">
                    <!-- Sidebar -->
                    <div class="col-lg-3">
                        <div class="course-sidebar">
                            <div class="filter-widget">
                                <h4 class="widget-title">All PDF Categories</h4>
                                <ul class="category-list list-unstyled">
                                    @foreach ($categories as $cat)
                                        <li>
                                            <a href="{{ route('pdf.book.category', $cat->slug) }}">
                                                {{ $cat->name }}
                                                <span class="count">{{ $cat->pdf_books_count }}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Books Grid -->
                    <div class="col-lg-9">
                        <div class="row g-4">
                            @forelse($pdf_books as $book)
                                <div class="col-md-6 col-lg-4">
                                    <div class="course-item">
                                        <div class="course-img">
                                            <a href="{{ route('pdf.book.details', $book->id) }}">
                                                <img src="{{ asset('uploads/pdfbooks/images/' . $book->image) }}" alt="{{ $book->name }}">
                                            </a>
                                        </div>
                                        <div class="course-content">
                                            <div class="course-meta">
                                                <span class="category"><i class="far fa-bookmark"></i> {{ $book->pdfBookCategory->name ?? 'PDF Book' }}</span>
                                            </div>
                                            <h4 class="course-title">
                                                <a href="{{ route('pdf.book.details', $book->id) }}">{{ Str::limit($book->name, 40) }}</a>
                                            </h4>
                                            <div class="course-bottom">
                                                <div class="course-price">
                                                    @if($book->price == 0)
                                                        <span class="free">Free</span>
                                                    @else
                                                        @if($book->discount_amount > 0)
                                                            <span class="price">৳{{ number_format($book->price - $book->discount_amount, 2) }}</span>
                                                            <del class="old-price">৳{{ number_format($book->price, 2) }}</del>
                                                        @else
                                                            <span class="price">৳{{ number_format($book->price, 2) }}</span>
                                                        @endif
                                                    @endif
                                                </div>
                                                <div class="course-btn">
                                                    @if ($book->price == 0 || (isset($purchasedBookIds) && in_array($book->id, $purchasedBookIds)))
                                                        <a href="{{ route('pdf.book.details', $book->id) }}?tab=download" class="btn btn-sm btn-danger" title="Download"><i class="far fa-download"></i></a>
                                                    @else
                                                        <a href="{{ route('pdf.book.details', $book->id) }}" class="btn btn-sm"><i class="far fa-arrow-right"></i></a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12 text-center py-5">
                                    <h4 class="text-muted">No PDF books found in this subcategory.</h4>
                                    <a href="{{ route('pdf.books') }}" class="theme-btn mt-3">Back to All PDF Books</a>
                                </div>
                            @endforelse
                        </div>

                        <!-- Pagination -->
                        <div class="pagination-area mt-50">
                            {{ $pdf_books->links('frontend.pages.pdf_books.partials.pagination') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
