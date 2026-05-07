@extends('backend.layouts.master')

@section('title', 'View Teacher')

@push('backend_style')
    @include('backend.pages.common.style')
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">View Teacher</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('users.teacher') }}">Teacher</a></li>
                        <li class="breadcrumb-item active" aria-current="page">View</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <h3 class="card-title">Teacher Details</h3>
                    <a href="{{ route('users.teacher') }}" class="btn btn-outline-info border"><i class="fa-solid fa-angles-left fa-fw"></i> Back</a>
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
                                    <th colspan="2" class="text-center">
                                        <h3>{{ $teacher->user->name }}</h3>
                                        <div class="mt-3">
                                            @if($teacher->profile_image && $teacher->profile_image !== 'default_profile_image.jpg')
                                                <img src="{{ asset('uploads/teachers/' . $teacher->profile_image) }}" alt="Profile Image" style="height: 200px; max-width: 200px; border-radius: 50%;">
                                            @else
                                                <div class="bg-light rounded-circle d-inline-block" style="width: 200px; height: 200px; line-height: 200px;">
                                                    <i class="fa-solid fa-user fa-3x text-muted"></i>
                                                </div>
                                            @endif
                                        </div>
                                    </th>
                                </tr>
                                <tr>
                                    <th>Name</th>
                                    <td width="80%">{{ $teacher->user->name }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td width="80%">{{ $teacher->user->email }}</td>
                                </tr>
                                <tr>
                                    <th>Qualification</th>
                                    <td width="80%">{{ $teacher->qualification ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Salary</th>
                                    <td width="80%">{{ $teacher->salary ? number_format($teacher->salary, 2) : 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Hire Date</th>
                                    <td width="80%">{{ $teacher->hire_date ? $teacher->hire_date->format('d-M-Y') : 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td width="80%">
                                        @if ($teacher->user->is_active == 1)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Created Date</th>
                                    <td>{{ $teacher->created_at->format('d-M-Y') }}</td>
                                </tr>
                                <tr>
                                    <th>Last Updated</th>
                                    <td>{{ $teacher->updated_at->format('d-M-Y') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Row -->

    <!-- Assigned Courses Row -->
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0">Assigned Courses</h3>
                    <a href="{{ route('teachers.edit', $teacher->user->id) }}" class="btn btn-sm btn-outline-primary border">
                        <i class="fa-solid fa-pen-to-square fa-fw"></i> Manage Courses
                    </a>
                </div>
                <div class="card-body">
                    @if($assignedCourses->count() > 0)
                        <div class="table-responsive export-table">
                            <table id="courses-datatable" class="table table-bordered text-nowrap key-buttons border-bottom w-100">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0">#</th>
                                        <th class="border-bottom-0">Course Name</th>
                                        <th class="border-bottom-0">Status</th>
                                        <th class="border-bottom-0">Assigned Date</th>
                                        <th class="border-bottom-0">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($assignedCourses as $course)
                                        @php
                                            $pivot = $course->pivot;
                                        @endphp
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="rounded-circle bg-info text-white d-flex align-items-center justify-content-center me-2" style="width: 35px; height: 35px;">
                                                        <i class="fa-solid fa-graduation-cap fa-fw"></i>
                                                    </div>
                                                    <strong>{{ $course->name }}</strong>
                                                </div>
                                            </td>
                                            <td>
                                                @if($pivot && $pivot->is_active == 1)
                                                    <span class="badge bg-success"><i class="fa-solid fa-check-circle fa-fw"></i> Active</span>
                                                @else
                                                    <span class="badge bg-warning text-dark"><i class="fa-solid fa-pause-circle fa-fw"></i> Inactive</span>
                                                @endif
                                            </td>
                                            <td>{{ $pivot->created_at ? $pivot->created_at->format('d-M-Y') : 'N/A' }}</td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-outline-danger border remove-course-btn" 
                                                        data-teacher-id="{{ $teacher->id }}" 
                                                        data-course-id="{{ $course->id }}"
                                                        data-course-name="{{ $course->name }}">
                                                    <i class="fa-solid fa-trash-can fa-fw"></i> Remove
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fa-solid fa-graduation-cap fa-4x text-muted mb-3"></i>
                            <h5 class="text-muted">No Courses Assigned</h5>
                            <p class="text-muted">This teacher hasn't been assigned any courses yet.</p>
                            <a href="{{ route('teachers.edit', $teacher->user->id) }}" class="btn btn-outline-primary">
                                <i class="fa-solid fa-plus fa-fw"></i> Assign Courses Now
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- End Assigned Courses Row -->
@endsection

@push('backend_script')
    @include('backend.pages.common.script')
    <script>
        $(document).ready(function() {
            // Initialize DataTable for courses
            $('#courses-datatable').DataTable({
                "paging": true,
                "lengthChange": true,
                "pageLength": 10,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true
            });

            // Handle course removal
            $(document).on('click', '.remove-course-btn', function() {
                const teacherId = $(this).data('teacher-id');
                const courseId = $(this).data('course-id');
                const courseName = $(this).data('course-name');

                Swal.fire({
                    title: 'Are you sure?',
                    html: `Do you want to remove <strong>${courseName}</strong> from this teacher?`,
                    text: "This action will detach the course from the teacher.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, remove it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        $.ajax({
                            url: `/admin/teachers/${teacherId}/remove-course/${courseId}`,
                            type: 'DELETE',
                            success: function(response) {
                                if (response.success) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Success!',
                                        text: response.message,
                                        confirmButtonColor: '#3085d6',
                                        confirmButtonText: 'OK'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            location.reload();
                                        }
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error!',
                                        text: response.message || 'An error occurred.',
                                        confirmButtonColor: '#d33',
                                        confirmButtonText: 'OK'
                                    });
                                }
                            },
                            error: function(xhr, status, error) {
                                console.log(xhr.responseText);
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error!',
                                    text: 'An error occurred while removing the course assignment.',
                                    confirmButtonColor: '#d33',
                                    confirmButtonText: 'OK'
                                });
                            }
                        });
                    }
                });
            });
        });
    </script>
@endpush
