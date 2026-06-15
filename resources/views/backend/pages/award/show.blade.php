@extends('backend.layouts.master')

@section('title', 'Award Details')

@push('backend_style')
    @include('backend.pages.common.style')
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Award Details</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('awards.index') }}">Award</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Details</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4>{{ $award->name }}</h4>
                    <p><strong>Slug:</strong> {{ $award->slug }}</p>
                    <p><strong>Year:</strong> {{ $award->year ?? 'N/A' }}</p>
                    <p><strong>Description:</strong></p>
                    <div>{!! $award->description !!}</div>
                    <p class="mt-2"><strong>File:</strong>
                        @if ($award->file)
                            <a href="{{ asset('uploads/awards/' . $award->file) }}" target="_blank">Download</a>
                        @else
                            <span>No File</span>
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>

    @push('backend_script')
        @include('backend.pages.common.script')
    @endpush
@endsection
