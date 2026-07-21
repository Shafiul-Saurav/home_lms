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
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <th>Name:</th>
                                    <td>{{ $course->name }}</td>
                                </tr>
                                <tr>
                                    <th>Slug:</th>
                                    <td>{{ $course->slug }}</td>
                                </tr>
                                <tr>
                                    <th>Category:</th>
                                    <td>{{ $course->category ? $course->category->name : 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Subcategory:</th>
                                    <td>{{ $course->subcategory ? $course->subcategory->name : 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Free or Paid:</th>
                                    <td>{{ $course->free_or_paid ? ucfirst($course->free_or_paid) : 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Price:</th>
                                    <td>{{ $course->price ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Discount:</th>
                                    <td>{{ $course->discount ?? 'N/A' }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <th>Course Type:</th>
                                    <td>{{ $course->live_or_record ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Is Offline:</th>
                                    <td>{{ $course->is_offline === null ? 'N/A' : ($course->is_offline ? 'Yes' : 'No') }}</td>
                                </tr>
                                <tr>
                                    <th>Live Schedule:</th>
                                    <td>{{ $course->live_schedule ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Start Date:</th>
                                    <td>{{ $course->start_date ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>End Date:</th>
                                    <td>{{ $course->end_date ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Max Student:</th>
                                    <td>{{ $course->max_student ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Meeting Link:</th>
                                    <td>
                                        @if ($course->meeting_link)
                                            <a href="{{ $course->meeting_link }}" target="_blank">{{ $course->meeting_link }}</a>
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Button Type:</th>
                                    <td>{{ $course->button_type ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Tags:</th>
                                    <td>{{ $course->tags ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Status:</th>
                                    <td>
                                        @if ($course->is_active)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Video Link:</th>
                                    <td>
                                        @if ($course->video_link)
                                            <a href="{{ $course->video_link }}" target="_blank">{{ $course->video_link }}</a>
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Created At:</th>
                                    <td>{{ $course->created_at->format('d M, Y h:i A') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-6">
                            <h5>Image</h5>
                            @if ($course->image)
                                <img src="{{ asset('uploads/courses/' . $course->image) }}" alt="{{ $course->name }}" class="img-fluid">
                            @else
                                <p>No image available</p>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <h5>PDF</h5>
                            @if ($course->pdf)
                                <a href="{{ asset('uploads/courses/pdfs/' . $course->pdf) }}" target="_blank" class="btn btn-outline-primary">
                                    View PDF
                                </a>
                            @else
                                <p>No PDF available</p>
                            @endif

                            <h5 class="mt-4">Description</h5>
                            {!! $course->description ?: 'N/A' !!}

                            <h5 class="mt-4">Full Description</h5>
                            {!! $course->full_description ?: 'N/A' !!}

                            <h5 class="mt-4">Learning Outcomes</h5>
                            {!! $course->learning_outcomes ?: 'N/A' !!}

                            <h5 class="mt-4">Requirement</h5>
                            {!! $course->requirement ?: 'N/A' !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
