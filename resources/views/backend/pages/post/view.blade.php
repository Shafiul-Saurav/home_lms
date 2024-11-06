@extends('backend.layouts.master')

@section('title', 'View Post')

@push('backend_style')
    @include('backend.pages.common.style')
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">View Post</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">View Post</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <h3 class="card-title">Post Details</h3>
                    <a href="{{ route('posts.index') }}" class="btn btn-outline-info border"><i class="fa-solid fa-angles-left fa-fw"></i> Back</a>
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
                                <tr><th colspan="2"><h3>{{ $post->title }}</h3></th></tr>
                                <tr>
                                    <th>Category</th>
                                    <td width="80%">{{ $post->postCategory->title }}</td>
                                </tr>
                                <tr>
                                    <th>Gallery Image</th>
                                    <td width="80%">
                                        <img src="{{ asset('uploads/posts') }}/{{ $post->post_image }}" alt=""
                                            style="height: 300px">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Description</th>
                                    <td width="80%">{{ $post->description }}</td>
                                </tr>
                                <tr>
                                    <th>Short Description</th>
                                    <td width="80%">{{ $post->short_des }}</td>
                                </tr>
                                <tr>
                                    <th>Long Description</th>
                                    <td width="80%">{{ $post->long_des }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td width="80%">
                                        @if ($post->is_active == 1)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">In-active</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Show in Home Page</th>
                                    <td width="80%">
                                        @if ($post->is_home == 1)
                                            <span class="badge bg-success">Yes</span>
                                        @else
                                            <span class="badge bg-danger">No</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Created Date</th>
                                    <td>{{ $post->created_at->format('d-M-Y') }}</td>
                                </tr>
                                <tr>
                                    <th>Last Updated</th>
                                    <td>{{ $post->updated_at->format('d-M-Y') }}</td>
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
