@extends('backend.layouts.master')

@section('title', 'View Photo Gallery')

@push('backend_style')
    @include('backend.pages.common.style')
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">View Photo Gallery</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">View Photo Gallery</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <h3 class="card-title">Photo Gallery Details</h3>
                    <a href="{{ route('photogalleries.index') }}" class="btn btn-outline-info border"><i class="fa-solid fa-angles-left fa-fw"></i> Back</a>
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
                                <tr><th colspan="2"><h3>{{ $gallery->title }}</h3></th></tr>
                                <tr>
                                    <th>Category</th>
                                    <td width="80%">{{ $gallery->photoCategory->category_name }}</td>
                                </tr>
                                <tr>
                                    <th>Photo</th>
                                    <td width="80%">{{ $gallery->price }}</td>
                                </tr>
                                <tr>
                                    <th>Gallery Image</th>
                                    <td width="80%"><img src="{{ asset('uploads/photogalleries') }}/{{ $gallery->gall_image }}" alt=""
                                        style="height: 200px"></td>
                                </tr>
                                <tr>
                                    <th>Description</th>
                                    <td width="80%">{!! $gallery->description !!}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td width="80%">
                                        @if ($gallery->is_active == 1)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">In-active</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Show in Home Page</th>
                                    <td width="80%">
                                        @if ($gallery->is_home == 1)
                                            <span class="badge bg-success">Yes</span>
                                        @else
                                            <span class="badge bg-danger">No</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Created Date</th>
                                    <td>{{ $gallery->created_at->format('d-M-Y') }}</td>
                                </tr>
                                <tr>
                                    <th>Last Updated</th>
                                    <td>{{ $gallery->updated_at->format('d-M-Y') }}</td>
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
