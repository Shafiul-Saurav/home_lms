@extends('frontend.layouts.master')

@section('title', 'Photo Gallery')

@push('frontend_style')
    @include('frontend.pages.common.style')
@endpush

@section('frontend_content')
    <!-- Start Page Title Area -->
    <div class="page-title-area" style="background-image: url('{{ asset('assets/frontend/img/page-bg.jpg') }}')">
        <div class="container">
            <div class="page-title-content">
                <h2>Photo Gallery</h2>
                <ul>
                    <li>
                        <a href="index.html">
                            Home
                        </a>
                    </li>
                    <li>Photo Gallery</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- End Page Title Area -->

    <!-- Start Gallery Area -->
    <section class="gallery-area ptb-100">
        <div class="container">
            <div class="section-title">
                <span>Gallery</span>
                <h2>Our Specials Room</h2>
                <p>Lorem ipsum dolor sit amconsectetur Risus commodo viverra maecenas acumsan lacus vel facilisisLorem dolor
                    sitonsectetur Risus commodo.</p>
            </div>
            <div class="gallery-wrap">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="shorting-menu">
                            <button class="filter mixitup-control-active" data-filter="all">
                                All ({{ $galleries->count() }})
                            </button>
                            @foreach ($categories as $category)
                                <button class="filter" data-filter=".{{ $category->id }}">
                                    {{ $category->category_name }} ({{ $category->photoGalleries->where('is_active', 1)->count() }})
                                </button>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="shorting">
                    <div class="row">
                        @foreach ($galleries as $gallery)
                            <div class="col-lg-4 col-md-6 mix {{ $gallery->photoCategory->id }}">
                                <div class="single-gallery">
                                    <div class="gallery-image bg-1">
                                        <div class="gallery-image"
                                            style="background-image: url('{{ asset('uploads/photogalleries') }}/{{ $gallery->gall_image }}'); background-size: cover; background-position: center;">
                                            <div class="price-wrap">
                                                <span class="price-text">Price</span>
                                                <span class="price">${{ $gallery->price }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="gallery-content">
                                        <h3>
                                            <a href="javascript:void(0)">
                                                {{ $gallery->title }}
                                            </a>
                                        </h3>
                                        <a class="read-more" href="javascript:void(0)">
                                            View More
                                            <i class='bx bx-right-arrow-alt bx-fade-right'></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach


                        {{-- <div class="col-12">
                            <a class="default-btn" href="room-grid-view.html">
                                View More
                                <i class="flaticon-right"></i>
                            </a>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Gallery Area -->

@endsection

@push('frontend_script')
    @include('frontend.pages.common.script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var filterButtons = document.querySelectorAll('.filter');
            var allItems = document.querySelectorAll('.mix');

            filterButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    // Remove 'mixitup-control-active' class from all buttons
                    filterButtons.forEach(function(btn) {
                        btn.classList.remove('mixitup-control-active');
                    });

                    // Add 'mixitup-control-active' class to the clicked button
                    this.classList.add('mixitup-control-active');

                    // Get the filter value from the clicked button
                    var filter = this.getAttribute('data-filter');

                    // Show or hide items based on the selected filter
                    allItems.forEach(function(item) {
                        if (filter === 'all' || item.classList.contains(filter.substring(
                            1))) {
                            item.style.display = 'block'; // Show matched items
                        } else {
                            item.style.display = 'none'; // Hide unmatched items
                        }
                    });
                });
            });
        });
    </script>
@endpush
