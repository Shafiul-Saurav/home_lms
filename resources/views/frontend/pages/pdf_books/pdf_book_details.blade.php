@extends('frontend.layouts.master')

@section('title', $bookInfo->name)

@push('frontend_style')
    <style>
        .book-single {
            padding: 100px 0;
            background-color: #f8f9fa;
        }

        .book-img-wrapper {
            position: sticky;
            top: 100px;
        }

        .book-img {
            width: 100%;
            border-radius: 20px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
            transition: 0.4s;
        }

        .book-img:hover {
            transform: scale(1.02);
        }

        .book-info-header {
            margin-bottom: 35px;
        }

        .book-category {
            display: inline-block;
            background: rgba(142, 121, 249, 0.1);
            color: var(--theme-color);
            padding: 6px 18px;
            border-radius: 50px;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .book-title {
            font-size: 36px;
            font-weight: 800;
            color: #222;
            line-height: 1.3;
            margin-bottom: 20px;
        }

        .book-price-box {
            background: #fff;
            padding: 25px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 30px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.02);
        }

        .current-price {
            font-size: 32px;
            font-weight: 800;
            color: var(--theme-color);
        }

        .old-price {
            font-size: 18px;
            text-decoration: line-through;
            color: #999;
        }

        .discount-badge {
            background: #ff4d4d;
            color: #fff;
            padding: 4px 12px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 700;
        }

        .qty-selector {
            display: flex;
            align-items: center;
            background: #fff;
            border: 1px solid #eee;
            border-radius: 10px;
            overflow: hidden;
            width: fit-content;
        }

        .qty-btn {
            background: #f8f9fa;
            border: none;
            padding: 10px 15px;
            font-size: 18px;
            cursor: pointer;
            transition: 0.2s;
        }

        .qty-btn:hover {
            background: #eee;
        }

        .qty-input {
            width: 50px;
            text-align: center;
            border: none;
            font-weight: 700;
            font-size: 16px;
        }

        .user-table th {
            color: #777;
            font-weight: 600;
            padding: 12px 0;
        }

        .user-table td {
            color: #222;
            font-weight: 500;
            padding: 12px 0;
            text-align: right;
        }
    </style>
@endpush

@section('frontend_content')
    <main class="main">
        <!-- breadcrumb -->
        <x-frontend.pages.common.breadcrumb :title="$bookInfo->name" :breadcrumb="[['name' => 'Home', 'url' => route('home')], ['name' => 'PDF Books', 'url' => route('pdf.books')], ['name' => 'Details', 'url' => '#']]" />
        <!-- breadcrumb end -->

        <!-- book-single -->
        <div class="book-single">
            <div class="container">
                <div class="row g-5">
                    <!-- Left Side: Book Image -->
                    <div class="col-lg-4 col-md-12">
                        <div class="book-img-wrapper">
                            <img src="{{ asset('uploads/pdfbooks/images/' . $bookInfo->image) }}" alt="{{ $bookInfo->name }}" class="book-img">
                        </div>
                    </div>

                    <!-- Middle Side: Book Details -->
                    <div class="col-lg-5 col-md-12">
                        <div class="book-info-header">
                            <span class="book-category">{{ $bookInfo->pdfBookCategory->name ?? 'PDF Book' }}</span>
                            <h1 class="book-title">{{ $bookInfo->name }}</h1>
                            <p class="mb-3" style="font-size: 18px;">by <span class="fw-bold" style="color: var(--theme-color);">{{ $bookInfo->author_name ?? 'Unknown Author' }}</span></p>
                            <div class="d-flex align-items-center gap-2 mb-4">
                                <div class="text-warning small">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                                <span class="text-muted small">(4.8 / 120 Reviews)</span>
                            </div>

                            <div class="book-price-box">
                                @if($bookInfo->price == 0)
                                    <span class="current-price">Free</span>
                                @else
                                    <span class="current-price">৳{{ number_format($bookInfo->price - $bookInfo->discount_amount, 2) }}</span>
                                    @if($bookInfo->discount_amount > 0)
                                        <span class="old-price">৳{{ number_format($bookInfo->price, 2) }}</span>
                                        <span class="discount-badge">-{{ round(($bookInfo->discount_amount / $bookInfo->price) * 100) }}% Off</span>
                                    @endif
                                @endif
                            </div>

                            <p class="text-muted mb-4" style="line-height: 1.8;">
                                {{ Str::limit(strip_tags($bookInfo->description), 250) }}
                                <a href="#book-tab-section" id="scroll-to-tabs" class="fw-bold" style="color: var(--theme-color);">Read More</a>
                            </p>

                            <div class="d-flex gap-3 align-items-center mt-5">
                                @if($bookInfo->price == 0 || $isPurchased)
                                    <a href="#book-tab-section" id="download-now-btn" class="theme-btn flex-grow-1 text-center"> <span class="far fa-download me-2"></span> Download Now (PDF)</a>
                                @else
                                    <a href="{{ route('pdf.book.checkout', $bookInfo->id) }}" class="theme-btn flex-grow-1 text-center" id="buy-now-btn"> <span class="far fa-shopping-bag me-2"></span> Buy Now (PDF)</a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Right Side: Related products -->
                    <div class="col-lg-3 col-md-12">
                        <div class="shadow-sm p-4 rounded related-books-sidebar bg-white">
                            <h5 class="mb-4 fw-bold pb-2 border-bottom" style="font-size: 20px;">Related PDF Books</h5>
                            <div class="related-list">
                                @forelse($relatedBooks as $related)
                                    <div class="d-flex gap-3 mb-3 pb-3 border-bottom align-items-center">
                                        <a href="{{ route('pdf.book.details', $related->id) }}" class="flex-shrink-0" style="width: 60px;">
                                            <img src="{{ asset('uploads/pdfbooks/images/' . $related->image) }}" alt="{{ $related->name }}" class="rounded shadow-sm w-100" style="height: 80px; object-fit: cover;">
                                        </a>
                                        <div class="info">
                                            <h6 class="mb-1" style="font-size: 14px; line-height: 1.4;">
                                                <a href="{{ route('pdf.book.details', $related->id) }}" class="text-dark fw-bold hover-primary">{{ Str::limit($related->name, 30) }}</a>
                                            </h6>
                                            <div class="price fw-bold" style="font-size: 13px; color: var(--theme-color2);">
                                                @if ($related->discount_amount)
                                                    <span>৳{{ number_format($related->price - $related->discount_amount, 2) }}</span>
                                                    <del class="text-muted ms-1" style="font-size: 11px;">৳{{ number_format($related->price, 2) }}</del>
                                                @else
                                                    <span>৳{{ number_format($related->price, 2) }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <p class="text-muted small">No related books found.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bottom: Tabs Section -->
                <div class="row mt-5" id="book-tab-section">
                    <div class="col-lg-9">
                        <div class="course-single-tab shadow-sm rounded bg-white p-4">
                            <ul class="nav nav-underline border-bottom mb-4" id="bookTab" role="tablist">
                                <li class="nav-item">
                                    <button class="nav-link active py-3 px-4 fw-bold" id="description-tab" data-bs-toggle="tab" data-bs-target="#tab1" type="button">Description</button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link py-3 px-4 fw-bold" id="specification-tab" data-bs-toggle="tab" data-bs-target="#tab3" type="button">Specification</button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link py-3 px-4 fw-bold" id="author-tab" data-bs-toggle="tab" data-bs-target="#tab2" type="button">Author</button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link py-3 px-4 fw-bold" id="download-tab" data-bs-toggle="tab" data-bs-target="#tab4" type="button">Download</button>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <!-- Description Tab -->
                                <div class="tab-pane fade show active" id="tab1" role="tabpanel">
                                    <div class="course-details mt-2">
                                        {!! $bookInfo->description !!}
                                    </div>
                                </div>
                                <!-- Specification Tab -->
                                <div class="tab-pane fade" id="tab3" role="tabpanel">
                                    <div class="mt-2 user-table table-responsive">
                                        <table class="table table-borderless">
                                            <tbody>
                                                <tr>
                                                    <th width="30%">Title</th>
                                                    <td>{{ $bookInfo->name }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Author</th>
                                                    <td>{{ $bookInfo->author_name ?? 'N/A' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Category</th>
                                                    <td>{{ $bookInfo->pdfBookCategory->name ?? 'N/A' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Subcategory</th>
                                                    <td>{{ $bookInfo->pdfBookSubcategory->name ?? 'N/A' }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- Author Tab -->
                                <div class="tab-pane fade" id="tab2" role="tabpanel">
                                    <div class="course-instructor mt-2">
                                        <div class="instructor-img">
                                            @if($bookInfo->author_profile)
                                                <img src="{{ asset('uploads/pdfbooks/authors/' . $bookInfo->author_profile) }}" alt="{{ $bookInfo->author_name }}" class="rounded shadow-sm" style="width: 150px; height: 150px; object-fit: cover;">
                                            @else
                                                <img src="{{ asset('assets/frontend/img/instructor/01.jpg') }}" alt="Author" class="rounded shadow-sm" style="width: 150px; height: 150px; object-fit: cover;">
                                            @endif
                                        </div>
                                        <div class="instructor-info">
                                            <h4 class="fw-bold mb-3">{{ $bookInfo->author_name ?? 'N/A' }}</h4>
                                            <p class="text-muted" style="line-height: 1.7;">{!! $bookInfo->author_description ?? 'No description available.' !!}</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Download Tab -->
                                <div class="tab-pane fade" id="tab4" role="tabpanel">
                                    <div class="mt-4">
                                        @if($bookInfo->price == 0 || $isPurchased)
                                            @if($bookInfo->pdf_file)
                                                <div class="alert alert-success d-flex align-items-center justify-content-between p-4 rounded-3 border-0 shadow-sm">
                                                    <div class="d-flex align-items-center gap-3">
                                                        <div class="bg-white p-2 rounded-circle shadow-sm">
                                                            <i class="fas fa-file-pdf text-danger fa-2x"></i>
                                                        </div>
                                                        <div>
                                                            <h5 class="mb-1 fw-bold">Ready to Download</h5>
                                                            <p class="mb-0 text-muted small">You can now access your PDF book.</p>
                                                        </div>
                                                    </div>
                                                    <a href="{{ asset('uploads/pdfbooks/files/' . $bookInfo->pdf_file) }}" class="btn btn-danger btn-lg px-4 rounded-pill" download>
                                                        <i class="fas fa-download me-2"></i> Download PDF
                                                    </a>
                                                </div>
                                            @else
                                                <div class="alert alert-warning p-4 rounded-3 border-0 shadow-sm">
                                                    <div class="d-flex align-items-center gap-3">
                                                        <i class="fas fa-exclamation-triangle fa-2x"></i>
                                                        <div>
                                                            <h5 class="mb-1 fw-bold">File Not Available</h5>
                                                            <p class="mb-0 text-muted">The PDF file has not been uploaded yet. Please contact support.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @else
                                            <div class="text-center py-5 border rounded-3 bg-light">
                                                <div class="mb-4">
                                                    <i class="fas fa-lock text-muted fa-4x opacity-25"></i>
                                                </div>
                                                <h4 class="fw-bold">Content Locked</h4>
                                                <p class="text-muted mb-4 mx-auto" style="max-width: 400px;">Please purchase this PDF book to gain access to the download section.</p>
                                                <a href="{{ route('pdf.book.checkout', $bookInfo->id) }}" class="theme-btn px-5">Buy Now to Unlock</a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- book-single end -->
    </main>
@endsection

@push('frontend_script')
    <script>
        $(document).ready(function() {
            // Smooth scroll to tabs and activate description
            $('#scroll-to-tabs').on('click', function(e) {
                e.preventDefault();
                $('html, body').animate({
                    scrollTop: $("#book-tab-section").offset().top - 100
                }, 600);
                $('#description-tab').tab('show');
            });

            // Smooth scroll to tabs and activate download tab
            $('#download-now-btn').on('click', function(e) {
                e.preventDefault();
                $('html, body').animate({
                    scrollTop: $("#book-tab-section").offset().top - 100
                }, 600);
                $('#download-tab').tab('show');
            });
        });
    </script>
@endpush
