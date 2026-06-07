@extends('frontend.layouts.master')

@section('title', 'Video Gallery')

@push('frontend_style')
<style>
    .gallery-item .gallery-img iframe {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-radius: 10px;
        border: none;
    }
    .gallery-item:hover .gallery-content {
        pointer-events: none;
    }
</style>
@endpush

@section('frontend_content')
    <main class="main">
        <!-- breadcrumb -->
        <x-frontend.pages.common.breadcrumb :title="'Video Gallery'" :breadcrumb="[['name' => 'Home', 'url' => route('home')], ['name' => 'Video Gallery', 'url' => '#']]" />
        <!-- breadcrumb end -->

        <!-- gallery-area -->
        <div class="gallery-area py-120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 mx-auto">
                        <div class="site-heading text-center wow fadeInDown" data-wow-delay=".25s">
                            <span class="site-title-tagline"><i class="far fa-lightbulb-on"></i>our Gallery</span>
                            <h2 class="site-title">Let's Check Our <span class="text-gradient">Video Gallery</span></h2>
                        </div>
                    </div>
                </div>
                <div class="row g-4">
                    @forelse($videos as $video)
                    <div class="col-md-3">
                        <div class="gallery-item wow fadeInUp" data-wow-delay=".25s">
                            <div class="gallery-img">
                                {!! $video->description !!}
                            </div>
                            <div class="gallery-content">
                                <h5 class="text-white mb-0" style="font-size: 16px;">{{ $video->title }}</h5>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12 text-center">
                        <p>No videos available in gallery.</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
        <!-- gallery-area end -->
    </main>
@endsection

@push('frontend_script')
@endpush
