@extends('backend.layouts.master')

@section('title', 'View Testimonial')

@push('backend_style')
    @include('backend.pages.common.style')
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">View Testimonial</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">View Testimonial</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <h3 class="card-title">Testimonial Details</h3>
                    <a href="{{ route('testimonials.index') }}" class="btn btn-outline-info border"><i class="fa-solid fa-angles-left fa-fw"></i> Back</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive export-table">
                        <table class="table table-bordered text-nowrap key-buttons border-bottom w-100">
                            <tbody>
                                <tr>
                                    <th><h3>{{ $testimonial->user->name }}</h3></th>
                                    <td width="80%">
                                        @if ($testimonial->user->profile->profileImage??null)
                                            <div class="avatar-container">
                                                <img alt="avatar"
                                                    src="{{ asset($testimonial->user->profile->profileImage->profile_image??null) }}"
                                                    class="rounded-circle" style="width:50px; height: 50px">
                                            </div>
                                        @else
                                            <div class="avatar-container">
                                                <img alt="avatar" src="{{ asset('profile/default_profile.png') }}"
                                                class="rounded-circle" style="width:50px; height: 50px">
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Review</th>
                                    <td width="80%">{{ $testimonial->review }}</td>
                                </tr>
                                <tr>
                                    <th>Rating</th>
                                    <td width="80%">{{ $testimonial->rating }}</td>
                                </tr>
                                <tr>
                                    <th>Created Date</th>
                                    <td>{{ $testimonial->created_at->format('d-M-Y') }}</td>
                                </tr>
                                <tr>
                                    <th>Last Updated</th>
                                    <td>{{ $testimonial->updated_at->format('d-M-Y') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Row -->
@endsection

@push('backend_script')
    @include('backend.pages.common.script')
@endpush
