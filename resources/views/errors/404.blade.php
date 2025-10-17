@extends('frontend.layouts.master')

@section('title', '404')

@push('frontend_style')
    @include('frontend.layouts.include.style')
@endpush

@section('frontend_content')
    <!-- Start Page Title Area -->
    <div class="page-title-area" style="background-image: url('{{ asset('assets/frontend/img/page-bg.jpg') }}')">
        <div class="container">
            <div class="page-title-content">
                <h2>404</h2>
                <ul>
                    <li>
                        <a href="{{ route('home') }}">
                            Home
                        </a>
                    </li>
                    <li>404</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- End Page Title Area -->

    <!-- Start 404 Error -->
    <div class="error-area">
        <div class="d-table">
            <div class="d-table-cell">
                <div class="error-content-wrap">
                    <h1>4 <span>0</span> 4</h1>
                    <h3>Oops! Page Not Found</h3>
                    <p>The page you were looking for could not be found.</p>
                    <a href="index.html" class="default-btn btn-two">
                        Return To Home Page
                        <i class="flaticon-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- End 404 Error -->

@endsection

@push('frontend_script')
    @include('frontend.layouts.include.script')
@endpush
