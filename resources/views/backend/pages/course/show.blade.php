@extends('backend.layouts.master')

@section('title', 'Course Details')

@push('backend_style')
    @include('backend.pages.common.style')
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Course Details</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('courses.index') }}">Course</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Details</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <h3 class="card-title">Course Details</h3>
                    <a href="{{ route('courses.index') }}" class="btn btn-primary">Back to Courses</a>
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
                                <tr><th colspan="2"><h3>{{ $course->name }}</h3></th></tr>
                                <tr>
                                    <th>Category</th>
                                    <td width="80%">{{ $course->category ? $course->category->name : 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Subcategory</th>
                                    <td width="80%">{{ $course->subcategory ? $course->subcategory->name : 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Slug</th>
                                    <td width="80%">{{ $course->slug }}</td>
                                </tr>
                                <tr>
                                    <th>Price</th>
                                    <td width="80%">{{ $course->price }}</td>
                                </tr>
                                <tr>
                                    <th>Discount</th>
                                    <td width="80%">{{ $course->discount ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Course Type</th>
                                    <td width="80%">{{ $course->live_or_record ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Is Offline</th>
                                    <td width="80%">{{ $course->is_offline === null ? 'N/A' : ($course->is_offline ? 'Yes' : 'No') }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td width="80%">
                                        @if ($course->is_active)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Video Link</th>
                                    <td width="80%">
                                        @if ($course->video_link)
                                            <a href="{{ $course->video_link }}" target="_blank">{{ $course->video_link }}</a>
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Image</th>
                                    <td width="80%">
                                        @if ($course->image)
                                            <img src="{{ asset('uploads/courses/' . $course->image) }}" alt="{{ $course->name }}" class="img-fluid" style="max-height: 300px;">
                                        @else
                                            No image available
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>PDF</th>
                                    <td width="80%">
                                        @if ($course->pdf)
                                            <a href="{{ asset('uploads/courses/pdfs/' . $course->pdf) }}" target="_blank" class="btn btn-outline-primary">
                                                View PDF
                                            </a>
                                        @else
                                            No PDF available
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Description</th>
                                    <td width="80%">{!! $course->description ?: 'N/A' !!}</td>
                                </tr>
                                <tr>
                                    <th>Created Date</th>
                                    <td>{{ $course->created_at->format('d-M-Y') }}</td>
                                </tr>
                                <tr>
                                    <th>Last Updated</th>
                                    <td>{{ $course->updated_at->format('d-M-Y') }}</td>
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