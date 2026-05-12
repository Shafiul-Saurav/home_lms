@extends('frontend.layouts.master')

@section('title', 'Book Details')

@push('frontend_style')
    <!-- <style>
        .specification-table th {
            width: 30%;
            background-color: #f8f9fa;
            font-weight: 600;
        }
        
        .book-details-img {
            transition: transform 0.3s ease;
        }
        
        .book-details-img:hover {
            transform: scale(1.02);
        }

        .related-books-sidebar {
            background: #fff;
            border-radius: 10px;
        }
    </style> -->
@endpush

@section('frontend_content')
    <main class="main">
        <!-- breadcrumb -->
        <div class="site-breadcrumb" style="background: url({{ asset('assets/frontend') }}/img/breadcrumb/01.png)">
            <div class="container">
                <h2 class="breadcrumb-title">Book Details</h2>
                <ul class="breadcrumb-menu">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li class="active">Book Details</li>
                </ul>
            </div>
        </div>
        <!-- breadcrumb end -->

        <!-- book-single -->
        <div class="course-single pt-50 pb-80">
            <div class="container">
                <div class="row g-4">
                    <!-- Left: Thumbnail -->
                    <div class="col-lg-4 col-md-5">
                        <div class="course-single-wrap p-0 border-0 shadow-none bg-transparent">
                            <div class="course-img m-0">
                                <img src="{{ asset('uploads/books/' . $bookInfo->image) }}" alt="{{ $bookInfo->name }}" class="w-100 rounded shadow-sm book-details-img">
                            </div>
                        </div>
                    </div>

                    <!-- Middle: Info -->
                    <div class="col-lg-5 col-md-7">
                        <div class="course-single-header mb-0 shadow-none p-0 bg-transparent border-0">
                            <div class="top mb-2">
                                <span class="category c1">{{ $bookInfo->bookCategory->name ?? 'Uncategorized' }}</span>
                            </div>
                            <h2 class="title mb-2" style="font-size: 30px; font-weight: 700;">{{ $bookInfo->name }}</h2>
                            <p class="mb-3" style="font-size: 18px;">by <span class="text-primary fw-bold">Reverant Lal Behari Day</span></p>
                            
                            <div class="course-details">
                                <p class="mb-3 text-muted" style="line-height: 1.6;">
                                    "{!! Str::limit(strip_tags($bookInfo->description), 280) !!}"
                                    <a href="#book-tab-section" class="text-primary fw-bold" id="scroll-to-tabs">See more</a>
                                </p>
                            </div>

                            <div class="course-price mb-4">
                                @if ($bookInfo->discount_amount)
                                    <div class="d-flex align-items-center gap-3">
                                        <h2 class="mb-0 text-primary fw-bold">${{ number_format($bookInfo->price - $bookInfo->discount_amount, 2) }}</h2>
                                        <del class="text-muted h4 mb-0">${{ number_format($bookInfo->price, 2) }}</del>
                                    </div>
                                @elseif($bookInfo->price > 0)
                                    <h2 class="mb-0 text-primary fw-bold">${{ number_format($bookInfo->price, 2) }}</h2>
                                @else
                                    <h2 class="mb-0 text-success fw-bold">Free</h2>
                                @endif
                            </div>

                            <div class="action-btns mt-4">
                                <a href="#" class="theme-btn py-3 px-5"> <span class="far fa-shopping-bag me-2"></span> Buy Now</a>
                            </div>
                        </div>
                    </div>

                    <!-- Right Side: Related products -->
                    <div class="col-lg-3 col-md-12">
                        <div class="shadow-sm p-4 rounded related-books-sidebar">
                            <h5 class="mb-4 fw-bold pb-2 border-bottom" style="font-size: 20px;">Related Books</h5>
                            <div class="related-list">
                                @forelse($relatedBooks as $related)
                                    <div class="d-flex gap-3 mb-3 pb-3 border-bottom align-items-center">
                                        <a href="{{ route('book.details', $related->id) }}" class="flex-shrink-0" style="width: 60px;">
                                            <img src="{{ asset('uploads/books/' . $related->image) }}" alt="{{ $related->name }}" class="rounded shadow-sm w-100" style="height: 80px; object-fit: cover;">
                                        </a>
                                        <div class="info">
                                            <h6 class="mb-1" style="font-size: 14px; line-height: 1.4;">
                                                <a href="{{ route('book.details', $related->id) }}" class="text-dark fw-bold">{{ Str::limit($related->name, 30) }}</a>
                                            </h6>
                                            <div class="price text-primary fw-bold" style="font-size: 13px;">
                                                ${{ number_format($related->price - $related->discount_amount, 2) }}
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
                                    <div class="mt-2">
                                        <table class="table table-bordered specification-table">
                                            <tbody>
                                                <tr>
                                                    <th>Title</th>
                                                    <td>{{ $bookInfo->name }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Author</th>
                                                    <td>Reverant Lal Behari Day</td>
                                                </tr>
                                                <tr>
                                                    <th>Category</th>
                                                    <td>{{ $bookInfo->bookCategory->name ?? 'N/A' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Publisher</th>
                                                    <td>Gazi Prokashoni</td>
                                                </tr>
                                                <tr>
                                                    <th>Language</th>
                                                    <td>English</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- Author Tab -->
                                <div class="tab-pane fade" id="tab2" role="tabpanel">
                                    <div class="course-instructor mt-2">
                                        <div class="instructor-img">
                                            <img src="{{ asset('assets/frontend/img/instructor/01.jpg') }}" alt="Author" class="rounded shadow-sm">
                                        </div>
                                        <div class="instructor-info">
                                            <h4 class="fw-bold mb-3">Reverant Lal Behari Day</h4>
                                            <p class="text-muted" style="line-height: 1.7;">Lal Behari Day was a Bengali Indian journalist, philosopher and Christian missionary. He was a student of the General Assembly's Institution and later taught there. He is best known for his work "Folk-Tales of Bengal" which captured the rich oral traditions of the region.</p>
                                        </div>
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
        });
    </script>
@endpush
