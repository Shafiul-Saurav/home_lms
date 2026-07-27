@extends('frontendone.layouts.master')

@section('title', 'Gallery')

@push('frontendone_style')
    @include('frontend.pages.common.style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" />
    <style>
        .section-header-wrap {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 30px;
        }
        .view-all-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 22px;
            border-radius: 50px;
            background: #111827;
            color: #fff;
            font-weight: 700;
            font-size: 13px;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        .view-all-btn:hover {
            background: #76bd10;
            color: #fff;
            transform: translateY(-2px);
        }

        /* Photo Gallery Item Styles */
        .gallery-item-photo {
            position: relative;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.03);
            aspect-ratio: 4/3;
            cursor: pointer;
            background: #f3f4f6;
        }

        .gallery-item-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s cubic-bezier(0.25, 1, 0.5, 1);
        }

        .gallery-item-photo:hover img {
            transform: scale(1.08);
        }

        .gallery-overlay-photo {
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

        .gallery-item-photo:hover .gallery-overlay-photo {
            opacity: 1;
        }

        .gallery-overlay-photo h4 {
            color: #ffffff;
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 4px;
            transform: translateY(10px);
            transition: transform 0.4s ease;
        }

        .gallery-item-photo:hover .gallery-overlay-photo h4 {
            transform: translateY(0);
        }

        .gallery-icon-photo {
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

        .gallery-item-photo:hover .gallery-icon-photo {
            opacity: 1;
            transform: scale(1);
        }

        .gallery-icon-photo:hover {
            background: #76bd10;
            color: #ffffff;
        }

        /* Video Gallery Item Styles */
        .gallery-item-video {
            position: relative;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            background: #fff;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .gallery-item-video:hover {
            transform: translateY(-6px);
            box-shadow: 0 16px 40px rgba(0, 0, 0, 0.12);
        }

        .gallery-img-video {
            position: relative;
            width: 100%;
            aspect-ratio: 16/9;
            background: #000;
        }

        .gallery-img-video iframe {
            width: 100%;
            height: 100%;
            border: none;
            display: block;
        }

        .gallery-content-video {
            padding: 22px 20px 24px;
        }

        .gallery-content-video h4 {
            font-size: 18px;
            font-weight: 700;
            color: #111827;
            margin: 0;
            line-height: 1.4;
        }
    </style>
@endpush

@section('frontendone_content')
    <main class="main">
        <!-- breadcrumb -->
        <x-frontend.pages.common.breadcrumb
            :title="'Gallery'"
            :breadcrumb="[
                ['name' => 'Home', 'url' => route('home')],
                ['name' => 'Gallery', 'url' => '#']
            ]"
            bgImage="assets/frontend/img/breadcrumb/news-bg.png"
        />
        <!-- breadcrumb end -->

        <div class="gallery-area py-5">
            <div class="container">

                <!-- ══════════════════ SECTION 1: PHOTO GALLERY ══════════════════ -->
                <div class="photo-gallery-section mb-5" data-aos="fade-up">
                    <div class="section-heading">
                        <span class="sub-title">
                            <i class="fa-regular fa-images"></i>
                            Image Gallery
                        </span>
                        <h2>Training, Workshop &amp; <span>Moments</span></h2>
                    </div>

                    <div class="row g-4 id-gallery-popup-wrapper">
                        @forelse ($galleries as $gallery)
                            <div class="col-lg-4 col-md-6">
                                <a href="{{ asset('uploads/photogalleries/' . $gallery->gall_image) }}" class="gallery-popup-item" title="{{ $gallery->title ?: 'Practical Lab' }}">
                                    <div class="gallery-item-photo">
                                        <img src="{{ asset('uploads/photogalleries/' . $gallery->gall_image) }}" alt="{{ $gallery->title }}" class="img-fluid w-100">
                                        <div class="gallery-icon-photo">
                                            <i class="fa-solid fa-plus"></i>
                                        </div>
                                        <div class="gallery-overlay-photo">
                                            <div>
                                                <h4>{{ $gallery->title ?: 'Practical Lab' }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @empty
                            <div class="col-12 text-center py-4">
                                <p class="text-muted font-weight-bold">No photo gallery items found.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- ══════════════════ SECTION 2: VIDEO GALLERY ══════════════════ -->
                <div class="video-gallery-section pt-4" data-aos="fade-up">
                    <div class="section-heading">
                        <span class="sub-title">
                            <i class="fas fa-video"></i>
                            Video Gallery
                        </span>
                        <h2>Explore Our <span>Video Sessions</span></h2>
                    </div>

                    <div class="row g-4">
                        @forelse ($videos as $video)
                            <div class="col-lg-4 col-md-6">
                                <div class="gallery-item-video">
                                    <div class="gallery-img-video">
                                        {!! $video->description !!}
                                    </div>
                                    <div class="gallery-content-video">
                                        <h4>{{ $video->title }}</h4>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12 text-center py-4">
                                <p class="text-muted font-weight-bold">No videos found in the gallery.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </main>
@endsection

@push('frontendone_script')
    @include('frontend.pages.common.script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.id-gallery-popup-wrapper').magnificPopup({
                delegate: '.gallery-popup-item',
                type: 'image',
                gallery: {
                    enabled: true,
                    navigateByImgClick: true,
                    preload: [0, 1]
                },
                image: {
                    tError: '<a href="%url%">The image</a> could not be loaded.',
                    titleSrc: function(item) {
                        return item.el.attr('title');
                    }
                },
                removalDelay: 300,
                mainClass: 'mfp-fade'
            });
        });
    </script>
@endpush
