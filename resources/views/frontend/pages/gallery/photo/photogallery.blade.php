@extends('frontend.layouts.master')

@section('title', 'Photo Gallery')

@push('frontend_style')
@endpush

@section('frontend_content')
    <main class="main">
        <!-- breadcrumb -->
        <x-frontend.pages.common.breadcrumb :title="'Photo Gallery'" :breadcrumb="[['name' => 'Home', 'url' => route('home')], ['name' => 'Photo Gallery', 'url' => '#']]" />
        <!-- breadcrumb end -->

        <!-- gallery-area -->
        <div class="gallery-area py-120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 mx-auto">
                        <div class="site-heading text-center wow fadeInDown" data-wow-delay=".25s">
                            <span class="site-title-tagline"><i class="far fa-lightbulb-on"></i>our Gallery</span>
                            <h2 class="site-title">Let's Check Our <span class="text-gradient">Photo Gallery</span></h2>
                        </div>
                    </div>
                </div>
                <div class="row g-4 popup-gallery">
                    @forelse($galleries as $gallery)
                    <div class="col-md-3">
                        <div class="gallery-item wow fadeInUp" data-wow-delay=".25s">
                            <div class="gallery-img">
                                <img src="{{ asset('uploads/photogalleries/' . $gallery->gall_image) }}" alt="{{ $gallery->title }}" />
                            </div>
                            <div class="gallery-content">
                                <a class="popup-img gallery-link" href="{{ asset('uploads/photogalleries/' . $gallery->gall_image) }}"><i
                                        class="fal fa-plus"></i></a>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12 text-center">
                        <p>No photos available in gallery.</p>
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
