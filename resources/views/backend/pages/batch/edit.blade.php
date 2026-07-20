@extends('backend.layouts.master')

@section('title', 'Edit Batch')

@push('backend_style')
    @include('backend.pages.common.style')
    <style>
        .course-list { max-height: 300px; overflow-y: auto; border: 1px solid #e9ebfa; padding: 15px; border-radius: 5px; }
    </style>
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Edit Batch</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('batches.index') }}">Batches</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <h3 class="card-title">Batch Information</h3>
                    <a href="{{ route('batches.index') }}" class="btn btn-outline-info border">Back</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('batches.update', $batch->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Name</label>
                                    <input type="text" name="name" class="form-control" value="{{ old('name', $batch->name) }}" required>
                                </div>
                            </div>
                            <div class="col-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Active</label>
                                    <select name="is_active" class="form-control">
                                        <option value="1" {{ $batch->is_active ? 'selected' : '' }}>Yes</option>
                                        <option value="0" {{ !$batch->is_active ? 'selected' : '' }}>No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Description</label>
                                    <textarea name="description" class="form-control" rows="4">{{ old('description', $batch->description) }}</textarea>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Update Batch</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Assign Courses -->
    <div class="row row-sm mt-3">
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
                                                value="{{ $course->id }}" id="course_{{ $course->id }}">
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
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($batch->courses as $course)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $course->name }}</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-outline-danger border remove-course-btn"
                                                    data-batch-id="{{ $batch->id }}"
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
@endsection

@push('backend_script')
    @include('backend.pages.common.script')
    <script>
        $(document).ready(function() {
            $('#courses-datatable').DataTable();

            // mark already assigned courses as checked
            const assignedCourseIds = @json($batch->courses->pluck('id'));
            $('.course-checkbox').each(function() {
                const val = parseInt($(this).val());
                if (assignedCourseIds.includes(val)) {
                    $(this).prop('checked', true);
                }
            });

            // select all toggle
            $('#select-all-courses').click(function() {
                $('.course-checkbox').prop('checked', this.checked);
            });

            // update Select All checkbox state on individual toggle
            $('.course-checkbox').on('change', function() {
                const total = $('.course-checkbox').length;
                const checked = $('.course-checkbox:checked').length;
                $('#select-all-courses').prop('checked', total === checked);
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
                    url: '{{ url("/admin/batches/".$batch->id."/assign-courses") }}',
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
                const batchId = $(this).data('batch-id');
                const courseId = $(this).data('course-id');
                const courseName = $(this).data('course-name');

                Swal.fire({
                    title: 'Are you sure?',
                    text: `Remove ${courseName} from this batch?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, remove it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `/admin/batches/${batchId}/remove-course/${courseId}`,
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
@endpush
