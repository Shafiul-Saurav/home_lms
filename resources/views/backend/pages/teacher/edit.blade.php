@extends('backend.layouts.master')

@section('title', 'Edit Teacher')

@push('backend_style')
    @include('backend.pages.common.style')
    <style>
        .course-list {
            max-height: 300px;
            overflow-y: auto;
            border: 1px solid #e9ebfa;
            padding: 15px;
            border-radius: 5px;
        }
    </style>
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Edit Teacher</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('users.teacher') }}">Teacher</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Teacher Information Card -->
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <h3 class="card-title">Teacher Information</h3>
                    <a href="{{ route('users.teacher') }}" class="btn btn-outline-info border"><i class="fa-solid fa-angles-left fa-fw"></i> Back</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('teachers.update-or-create', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label" for="name">Teacher Name</label>
                                    <input type="text" class="form-control" value="{{ $user->name }}" readonly>
                                </div>
                            </div>
                            <div class="col-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label" for="email">Teacher Email</label>
                                    <input type="text" class="form-control" value="{{ $user->email }}" readonly>
                                </div>
                            </div>
                            <div class="col-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label" for="qualification">Qualification</label>
                                    <input type="text" name="qualification" class="form-control @error('qualification') is-invalid @enderror" value="{{ old('qualification', $user->teacher ? $user->teacher->qualification : '') }}" placeholder="Enter Qualification">
                                    @error('qualification')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label" for="salary">Salary</label>
                                    <input type="number" name="salary" step="0.01" class="form-control @error('salary') is-invalid @enderror" value="{{ old('salary', $user->teacher ? $user->teacher->salary : '') }}" placeholder="Enter Salary">
                                    @error('salary')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label" for="hire_date">Hire Date</label>
                                    <div class="input-group">
                                        <div class="input-group-text bg-primary-transparent text-primary">
                                            <i class="fa-solid fa-calendar-days"></i>
                                        </div>
                                        <input class="form-control fc-datepicker @error('hire_date') is-invalid @enderror" placeholder="DD/MM/YYYY" type="text"
                                            value="{{ old('hire_date_display', ($user->teacher && $user->teacher->hire_date) ? \Carbon\Carbon::parse($user->teacher->hire_date)->format('d/m/Y') : '') }}">
                                        <input type="hidden" name="hire_date" value="{{ old('hire_date', ($user->teacher && $user->teacher->hire_date) ? \Carbon\Carbon::parse($user->teacher->hire_date)->format('Y-m-d') : '') }}">
                                    </div>
                                    @error('hire_date')
                                        <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label" for="profile_image">Profile Image</label>
                                    <input type="file" name="profile_image" class="form-control @error('profile_image') is-invalid @enderror">
                                    @error('profile_image')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                    @if($user->teacher && $user->teacher->profile_image && $user->teacher->profile_image !== 'default_profile_image.jpg')
                                        <div class="mt-2 text-center">
                                            <p>Current Image:</p>
                                            <img src="{{ asset('uploads/teachers/' . $user->teacher->profile_image) }}" alt="Profile Image" style="height: 100px; width: 100px; border-radius: 50%; object-fit: cover;">
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">
                            {{ $user->teacher ? 'Update Teacher Information' : 'Create Teacher Information' }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if($user->teacher)
    <!-- Assigned Courses Card -->
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h3 class="card-title">Assign Courses</h3>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <label class="form-label">Select Courses</label>
                        <div class="mb-3">
                            <label class="colorinput mb-3">
                                <input name="color" type="checkbox" value="pink" class="colorinput-input" id="select-all-courses">
                                <span class="colorinput-color bg-pink"></span>
                                <span class="ms-2 align-self-center">Select All</span>
                            </label>
                        </div>
                        <div class="course-list">
                            <div class="row">
                                @foreach ($courses as $course)
                                    <div class="col-md-4 mb-3 d-flex align-items-center">
                                        <label class="colorinput d-flex align-items-center">
                                            <input class="colorinput-input course-checkbox" type="checkbox"
                                                value="{{ $course->id }}" id="course_{{ $course->id }}"
                                                {{ $user->teacher->courses->contains($course->id) ? 'checked' : '' }}>
                                            <span class="colorinput-color bg-info"></span>
                                        </label>
                                        <label class="form-check-label ms-2" for="course_{{ $course->id }}">
                                            {{ $course->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <button type="button" class="btn btn-success mt-3" id="assign-courses-btn">
                            <i class="fa-solid fa-check fa-fw"></i> Assign Selected Courses
                        </button>
                    </div>

                    <!-- Assigned Courses Table -->
                    <div class="table-responsive">
                        <table id="courses-datatable" class="table table-bordered text-nowrap border-bottom w-100">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Course Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($user->teacher->courses as $course)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $course->name }}</td>
                                        <td>
                                            <span class="badge bg-success">Active</span>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-outline-danger border remove-course-btn"
                                                    data-teacher-id="{{ $user->teacher->id }}"
                                                    data-course-id="{{ $course->id }}"
                                                    data-course-name="{{ $course->name }}">
                                                <i class="fa-solid fa-trash-can"></i> Remove
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection

@push('backend_script')
    @include('backend.pages.common.script')
    @if($user->teacher)
    <script>
        $(document).ready(function() {
            $('#courses-datatable').DataTable();

            $('#select-all-courses').click(function() {
                $('.course-checkbox').prop('checked', this.checked);
            });

            $('#assign-courses-btn').click(function() {
                const selectedCourses = [];
                $('.course-checkbox:checked').each(function() {
                    selectedCourses.push($(this).val());
                });

                if (selectedCourses.length === 0) {
                    Swal.fire('Warning', 'Please select at least one course.', 'warning');
                    return;
                }

                $.ajax({
                    url: '{{ route('teachers.assign-courses', $user->teacher->id) }}',
                    type: 'POST',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'course_ids': selectedCourses
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire('Success', response.message, 'success').then(() => location.reload());
                        }
                    },
                    error: function() {
                        Swal.fire('Error', 'Failed to assign courses.', 'error');
                    }
                });
            });

            $(document).on('click', '.remove-course-btn', function() {
                const teacherId = $(this).data('teacher-id');
                const courseId = $(this).data('course-id');
                const courseName = $(this).data('course-name');

                Swal.fire({
                    title: 'Are you sure?',
                    text: `Remove ${courseName} from this teacher?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, remove it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `/admin/teachers/${teacherId}/remove-course/${courseId}`,
                            type: 'DELETE',
                            data: { '_token': '{{ csrf_token() }}' },
                            success: function(response) {
                                if (response.success) {
                                    Swal.fire('Deleted!', response.message, 'success').then(() => location.reload());
                                }
                            }
                        });
                    }
                });
            });
        });
    </script>
    @endif
@endpush
