@extends('frontend.layouts.master')

@section('title', 'Video Gallery')

@push('frontend_style')
    @include('frontend.pages.common.style')
@endpush

@section('frontend_content')
    <!-- Start Page Title Area -->
    <div class="page-title-area" style="background-image: url('{{ asset('assets/frontend/img/page-bg.jpg') }}')">
        <div class="container">
            <div class="page-title-content">
                <h2>Video Gallery</h2>
                <ul>
                    <li>
                        <a href="index.html">
                            Home
                        </a>
                    </li>
                    <li>Video Gallery</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- End Page Title Area -->

    <!-- Start Gallery Area -->
    <section class="gallery-area ptb-100">
        <div class="container">
            <div class="gallery-wrap">
                <div class="row">
                    @foreach ($videos as $video)
                        <div class="col-lg-4">
                            {!! $video->description !!}
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- End Gallery Area -->

@endsection

@push('frontend_script')
    @include('frontend.pages.common.script')
@endpush
