@extends('frontendone.layouts.master')

@section('title', 'Photo Gallery')

@push('frontendone_style')
    @include('frontend.pages.common.style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" />
    <style>
        /* Section Heading Custom Styling */
        .section-heading {
            text-align: center;
            max-width: 650px;
            margin: 0 auto 50px auto;
        }
        .section-heading .sub-title {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #76bd10;
            background: rgba(118, 189, 16, 0.1);
            padding: 6px 16px;
            border-radius: 50px;
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
            margin-bottom: 15px;
        }
        .section-heading h2 {
            font-size: 32px;
            font-weight: 800;
            color: #111827;
            margin-bottom: 12px;
        }
        .section-heading p {
            color: #4b5563;
            font-size: 15px;
            line-height: 1.6;
            margin: 0;
        }

        /* Modern Premium Gallery Structure Custom Styles */
        .gallery-item {
            position: relative;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.03);
            aspect-ratio: 4/3;
            cursor: pointer;
            background: #f3f4f6;
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s cubic-bezier(0.25, 1, 0.5, 1);
        }

        /* Hover Interactive State Elements */
        .gallery-item:hover img {
            transform: scale(1.08);
        }

        .gallery-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(17, 24, 39, 0.85) 0%, rgba(17, 24, 39, 0.4) 60%, rgba(17, 24, 39, 0) 100%);
            display: flex;
            align-items: flex-end;
            padding: 24px;
            opacity: 0;
            transition: opacity 0.4s ease;
            z-index: 2;
        }

        .gallery-item:hover .gallery-overlay {
            opacity: 1;
        }

        .gallery-overlay h4 {
            color: #ffffff;
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 4px;
            transform: translateY(10px);
            transition: transform 0.4s ease;
        }

        .gallery-overlay p {
            color: rgba(255, 255, 255, 0.8);
            font-size: 13px;
            margin: 0;
            transform: translateY(10px);
            transition: transform 0.4s ease 0.05s;
        }

        .gallery-item:hover .gallery-overlay h4,
        .gallery-item:hover .gallery-overlay p {
            transform: translateY(0);
        }

        /* Interactive Plus Icon Styling Links */
        .gallery-icon {
            position: absolute;
            top: 20px;
            right: 20px;
            width: 44px;
            height: 44px;
            background: #ffffff;
            color: #111827;
            border-radius: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            opacity: 0;
            transform: scale(0.8);
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
            z-index: 3;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .gallery-item:hover .gallery-icon {
            opacity: 1;
            transform: scale(1);
        }

        .gallery-icon:hover {
            background: #76bd10;
            color: #ffffff;
        }
    </style>
@endpush

@section('frontendone_content')
    <main class="main" data-aos="fade-up">
        <x-frontend.pages.common.breadcrumb :title="'Photo Gallery'" :breadcrumb="[['name' => 'Home', 'url' => route('home')], ['name' => 'Photo Gallery', 'url' => '#']]" />
        <section class="section-padding gallery-section py-5">
            <div class="container">
                <div class="section-heading">
                    <span class="sub-title">
                        <i class="fa-regular fa-images"></i>
                        Image Gallery
                    </span>
                    <h2>Training, Workshop & Student Moments</h2>
                    <p>
                        Explore our class activities, cyber security workshops, mentor sessions and practical lab moments.
                    </p>
                </div>

                <div class="row g-4 id-gallery-popup-wrapper">
                    @forelse ($galleries as $gallery)
                        <div class="col-lg-4 col-md-6">
                            <a href="{{ asset('uploads/photogalleries/' . $gallery->gall_image) }}" class="gallery-popup-item" title="{{ $gallery->title ?: 'Practical Lab' }}">
                                <div class="gallery-item">
                                    <img src="{{ asset('uploads/photogalleries/' . $gallery->gall_image) }}" alt="{{ $gallery->title }}" class="img-fluid w-100">
                                    <div class="gallery-icon">
                                        <i class="fa-solid fa-plus"></i>
                                    </div>
                                    <div class="gallery-overlay">
                                        <div>
                                            <h4>{{ $gallery->title ?: 'Practical Lab' }}</h4>
                                            {{-- <p>{{ $gallery->photoCategory?->category_name ?: 'Hands-on hacking practice' }}</p> --}}
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @empty
                        <div class="col-12 text-center py-5">
                            <p class="text-muted font-weight-bold">No Images Found</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>
    </main>
@endsection

@push('frontendone_script')
    @include('frontend.pages.common.script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
    <script>
        $(document).ready(function() {
            // Initialize Magnific Popup for the gallery grid items seamlessly
            $('.id-gallery-popup-wrapper').magnificPopup({
                delegate: '.gallery-popup-item',
                type: 'image',
                gallery: {
                    enabled: true, // Enables native left/right arrow navigation carousel toggling
                    navigateByImgClick: true,
                    preload: [0, 1]
                },
                image: {
                    tError: '<a href="%url%">The image</a> could not be loaded.',
                    titleSrc: function(item) {
                        return item.el.attr('title'); // Pulls image title info straight into popup bottom line caption automatically
                    }
                },
                removalDelay: 300, // Smooth transition entry animation delays
                mainClass: 'mfp-fade'
            });
        });
    </script>
@endpush
