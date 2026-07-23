@extends('frontendone.layouts.master')

@section('title', 'Video Gallery')

@push('frontendone_style')
    @include('frontend.pages.common.style')
    <style>
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

        .gallery-item {
            position: relative;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            background: #fff;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .gallery-item:hover {
            transform: translateY(-6px);
            box-shadow: 0 16px 40px rgba(0, 0, 0, 0.12);
        }

        .gallery-img {
            position: relative;
            width: 100%;
            aspect-ratio: 16/9;
            background: #000;
        }

        .gallery-img iframe {
            width: 100%;
            height: 100%;
            border: none;
            display: block;
        }

        .gallery-content {
            padding: 22px 20px 24px;
        }

        .gallery-content h4 {
            font-size: 18px;
            font-weight: 700;
            color: #111827;
            margin: 0;
            line-height: 1.4;
        }

        .gallery-content p {
            margin: 10px 0 0;
            color: #6b7280;
            font-size: 14px;
            line-height: 1.7;
        }
    </style>
@endpush

@section('frontendone_content')
    <main class="main">
        <x-frontend.pages.common.breadcrumb :title="'Video Gallery'" :breadcrumb="[['name' => 'Home', 'url' => route('home')], ['name' => 'Video Gallery', 'url' => '#']]" />

        <section class="section-padding gallery-section py-5">
            <div class="container">
                <div class="section-heading">
                    <span class="sub-title">
                        <i class="fa-regular fa-video"></i>
                        Video Gallery
                    </span>
                    <h2>Explore Our Training & Workshop Videos</h2>
                    <p>Watch highlights from our workshops, live sessions, and practical cybersecurity demonstrations.</p>
                </div>

                <div class="row g-4">
                    @forelse ($videos as $video)
                        <div class="col-lg-4 col-md-6">
                            <div class="gallery-item">
                                <div class="gallery-img">
                                    {!! $video->description !!}
                                </div>
                                <div class="gallery-content">
                                    <h4>{{ $video->title }}</h4>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center py-5">
                            <p class="text-muted font-weight-bold">No videos found in the gallery.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>
    </main>
@endsection
