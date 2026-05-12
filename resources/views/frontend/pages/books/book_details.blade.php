@extends('frontend.layouts.master')

@section('title', 'Book Details')

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
        <div class="course-single pt-120 pb-80">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="course-single-wrap">
                            <div class="course-img">
                                <img src="{{ asset('uploads/books/' . $bookInfo->image) }}" alt="{{ $bookInfo->name }}">
                            </div>
                            <div class="course-content">
                                <div class="course-meta">
                                    <span class="category c1">{{ $bookInfo->bookCategory->name ?? 'Uncategorized' }}</span>
                                </div>
                                <h3 class="title">{{ $bookInfo->name }}</h3>
                                <div class="course-details mt-4">
                                    <div class="mb-4">
                                        <h5 class="mb-10">Description</h5>
                                        {!! $bookInfo->description !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="course-single-sidebar">
                            <div class="price-wrap">
                                @if ($bookInfo->discount_amount)
                                    <div class="price-amount">
                                        <span>${{ number_format($bookInfo->price - $bookInfo->discount_amount, 2) }}</span>
                                        <del>${{ number_format($bookInfo->price, 2) }}</del>
                                    </div>
                                    <span class="price-off">{{ round(($bookInfo->discount_amount / $bookInfo->price) * 100) }}% Off</span>
                                @elseif($bookInfo->price > 0)
                                    <div class="price-amount">
                                        <span>${{ number_format($bookInfo->price, 2) }}</span>
                                    </div>
                                @else
                                    <div class="price-amount">
                                        <span class="text-success">Free</span>
                                    </div>
                                @endif
                            </div>
                            <div class="px-3">
                                <a href="#" class="theme-btn w-100"> <span class="far fa-shopping-bag"></span> Buy Now</a>
                            </div>
                            <div class="more-info">
                                <h5>Book Information</h5>
                                <ul>
                                    <li><i class="fad fa-tag"></i> Category: <span>{{ $bookInfo->bookCategory->name ?? 'N/A' }}</span></li>
                                    <li><i class="fad fa-layer-group"></i> Subcategory: <span>{{ $bookInfo->bookSubcategory->name ?? 'N/A' }}</span></li>
                                    <li><i class="fad fa-clock"></i> Released: <span>{{ $bookInfo->created_at->format('M d, Y') }}</span></li>
                                    <li><i class="fad fa-globe"></i> Language: <span>English</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- book-single end -->

        <!-- related book -->
        <div class="course-area pb-120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 mx-auto">
                        <div class="site-heading text-center">
                            <span class="site-title-tagline"><i class="far fa-book"></i> Related Books</span>
                            <h2 class="site-title">Explore More <span class="text-gradient">Books</span></h2>
                        </div>
                    </div>
                </div>
                <div class="row g-4">
                    @forelse($relatedBooks as $related)
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="course-item">
                                <span class="course-tag c1">Book</span>
                                <div class="course-img">
                                    <a href="{{ route('book.details', $related->id) }}">
                                        <img src="{{ asset('uploads/books/' . $related->image) }}" alt="{{ $related->name }}" />
                                    </a>
                                </div>
                                <div class="course-content">
                                    <div class="course-meta">
                                        <span class="category c1">{{ $related->bookCategory->name ?? 'Uncategorized' }}</span>
                                    </div>
                                    <h4 class="course-title">
                                        <a href="{{ route('book.details', $related->id) }}">{{ Str::limit($related->name, 50) }}</a>
                                    </h4>
                                    <div class="course-bottom">
                                        <div class="course-price">
                                            @if ($related->discount_amount)
                                                <del>${{ number_format($related->price, 2) }}</del>
                                                <span>${{ number_format($related->price - $related->discount_amount, 2) }}</span>
                                            @elseif($related->price > 0)
                                                <span>${{ number_format($related->price, 2) }}</span>
                                            @else
                                                <span class="text-success">Free</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center">
                            <p>No related books found.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
        <!-- related book end -->
    </main>
@endsection
