@extends('frontend.layouts.master')

@section('title', 'Give Review')

@push('frontend_style')
    @include('frontend.pages.common.style')
    <style>
        .star-rating .star {
            font-size: 24px;
            color: #ccc;
            cursor: pointer;
        }
        .star-rating .star.filled {
            color: #f39c12;
        }
    </style>
@endpush

@section('frontend_content')
    <!-- Start Page Title Area -->
    <div class="page-title-area" style="background-image: url('{{ asset('assets/frontend/img/page-bg.jpg') }}')">
        <div class="container">
            <div class="page-title-content">
                <h2>Give Review</h2>
                <ul>
                    <li>
                        <a href="{{ route('home') }}">
                            Home
                        </a>
                    </li>
                    <li>Give Review</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- End Page Title Area -->

    <!-- Start Review Area -->
    <section class="user-area-all-style recover-password-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="contact-form-action">
                        <div class="form-heading text-center">
                            <h3 class="form-title">Your Feedback</h3>
                        </div>
                        <form action="{{ route('testimonial.store') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="rating" class="form-label">Your Rating</label>
                                        <div id="star-rating" class="star-rating">
                                            <span data-value="1" class="star">&#9733;</span>
                                            <span data-value="2" class="star">&#9733;</span>
                                            <span data-value="3" class="star">&#9733;</span>
                                            <span data-value="4" class="star">&#9733;</span>
                                            <span data-value="5" class="star">&#9733;</span>
                                        </div>
                                        <input type="hidden" class="form-control @error('rating')
                                        is-invalid
                                    @enderror" name="rating" id="rating-input">
                                    @error('rating')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="review" class="form-label">Your Review</label>
                                        <input class="form-control @error('review')
                                        is-invalid
                                    @enderror" type="text" name="review" placeholder="Your Review" value="{{ old('review') }}">
                                    @error('review')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="short_description" class="form-label">Shortly Describe Why?</label>
                                        <textarea class="form-control @error('short_description')
                                        is-invalid
                                    @enderror" name="short_description" id="" cols="3" rows="2">{{ old('short_description') }}</textarea>
                                    @error('short_description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="default-btn btn-two" type="submit">
                                        Your Review
                                        <i class="flaticon-right"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Review Area -->

@endsection

@push('frontend_script')
    @include('frontend.pages.common.script')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const stars = document.querySelectorAll('.star-rating .star');
            const ratingInput = document.getElementById('rating-input');
            let currentRating = 0;

            // Function to highlight stars up to a given index
            function highlightStars(rating) {
                stars.forEach((star, index) => {
                    star.classList.toggle('filled', index < rating);
                });
            }

            // Handle star click
            stars.forEach(star => {
                star.addEventListener('click', function() {
                    currentRating = this.getAttribute('data-value');
                    ratingInput.value = currentRating;
                    highlightStars(currentRating);
                });

                // Handle mouse hover
                star.addEventListener('mouseover', function() {
                    const hoverRating = this.getAttribute('data-value');
                    highlightStars(hoverRating);
                });

                // Reset stars to current rating on mouse leave
                star.addEventListener('mouseleave', function() {
                    highlightStars(currentRating);
                });
            });
        });
    </script>
@endpush
