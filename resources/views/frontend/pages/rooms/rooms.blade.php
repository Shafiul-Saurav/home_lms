@extends('frontend.layouts.master')

@section('title', 'Rooms')

@push('frontend_style')

@endpush

@section('frontend_content')
<!-- Start Page Title Area -->
<div class="page-title-area" style="background-image: url('{{ asset('assets/frontend/img/page-bg.jpg') }}')">
    <div class="container">
        <div class="page-title-content">
            <h2>Rooms</h2>
            <ul>
                <li>
                    <a href="index.html">
                        Home
                    </a>
                </li>
                <li>Rooms</li>
            </ul>
        </div>
    </div>
</div>
<!-- End Page Title Area -->

@livewire('rooms')
@endsection

@push('frontend_script')

@endpush
