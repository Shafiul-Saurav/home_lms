@extends('backend.layouts.master')

@section('title', 'Course')

@push('backend_style')
    @include('backend.pages.common.style')
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Course</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Course</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <h3 class="card-title">Course Trashed List</h3>
                    <a href="{{ route('courses.index') }}" class="btn btn-info">
                        <i class="fa-solid fa-angles-left fa-fw"></i>Back
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive export-table">
                        <table id="file-datatable" class="table table-bordered text-nowrap key-buttons border-bottom w-100">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Last Updated</th>
                                    <th>Image</th>
                                    <th>Course Name</th>
                                    <th>Category</th>
                                    <th>Subcategory</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($courses as $course)
                                    <tr>
                                        <td><strong>{{ $courses->firstItem() + $loop->index }}</strong></td>
                                        <td>{{ $course->updated_at->format('d-M-Y') }}</td>
                                        <td>
                                            @if ($course->image)
                                                <img src="{{ asset('uploads/courses/' . $course->image) }}" alt="" style="height: 100px">
                                            @else
                                                No Image
                                            @endif
                                        </td>
                                        <td>{{ $course->name }}</td>
                                        <td>{{ $course->category ? $course->category->name : 'N/A' }}</td>
                                        <td>{{ $course->subcategory ? $course->subcategory->name : 'N/A' }}</td>
                                        <td class="text-center">
                                            <div class="action-btns d-flex align-items-center">
                                                <div>
                                                    <a href="{{ route('courses.restore', ['id' => $course->id]) }}"
                                                        class="btn btn-sm btn-outline-success border me-2">
                                                        <i class="fa-solid fa-store"></i>
                                                    </a>
                                                </div>
                                                <div>
                                                    <form action="{{ route('courses.forcedelete', ['id' => $course->id]) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger border show_confirm">
                                                            <i class="fa-solid fa-radiation"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $courses->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('backend_script')
    @include('backend.pages.common.script')
@endpush
