@extends('backend.layouts.master')

@section('title', 'View Batch')

@push('backend_style')
    @include('backend.pages.common.style')
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">View Batch</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('batches.index') }}">Batches</a></li>
                        <li class="breadcrumb-item active" aria-current="page">View</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h3 class="card-title">{{ $batch->name }}</h3>
                </div>
                <div class="card-body">
                    <p>{{ $batch->description }}</p>

                    <h5>Assigned Courses</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Course Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($batch->courses as $course)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $course->name }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
