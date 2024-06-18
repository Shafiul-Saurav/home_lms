@extends('frontend.layouts.master')

@section('title', Auth::user()->name)

@push('frontend_style')

@endpush

@section('frontend_content')
<!-- Start Page Title Area -->
<div class="page-title-area" style="background-image: url('{{ asset('assets/frontend/img/page-bg.jpg') }}')">
    <div class="container">
        <div class="page-title-content">
            <h2>{{ Auth::user()->name }}</h2>
            <ul>
                <li>
                    <a href="index.html">
                        Home
                    </a>
                </li>
                <li>Pages</li>
                <li>User</li>
                <li>{{ Auth::user()->name }}</li>
            </ul>
        </div>
    </div>
</div>
<!-- End Page Title Area -->
{{ Auth::user()->name }}
@endsection

@push('frontend_script')

@endpush
