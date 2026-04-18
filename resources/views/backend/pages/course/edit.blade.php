@extends('backend.layouts.master')

@section('title', 'Edit Course')

@push('backend_style')
    @include('backend.pages.common.style')
    <style>
        .lesson_item {
            position: relative;
            display: inline-flex;
            align-items: center;
            min-height: 42px;
            padding: 8px 16px;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            /* background: #f8f9fa; */
        }

        .lesson_item .remove_icon {
            position: absolute;
            font-size: 20px;
            top: -8px;
            right: -8px;
            opacity: 0;
            z-index: 2;
            transition: all 0.3s ease;
        }

        .lesson_item:hover .remove_icon {
            opacity: 1;
        }

        .lesson_item .delete-lesson {
            width: 22px;
            height: 22px;
            line-height: 22px;
            padding: 0;
            border-radius: 50%;
            /* background: #fff; */
        }
    </style>
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Edit Course</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('courses.index') }}">Course</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <h3 class="card-title">Edit Course</h3>
                    <a href="{{ route('courses.index') }}" class="btn btn-info">
                        <i class="fa-solid fa-angles-left fa-fw"></i> Back
                    </a>
                </div>
                <div class="card-body">
                    <form action="{{ route('courses.update', $course->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="name">Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" id="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name', $course->name) }}" required>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="slug">Slug</label>
                                    <input type="text" name="slug" id="slug"
                                        class="form-control @error('slug') is-invalid @enderror"
                                        value="{{ old('slug', $course->slug) }}">
                                    @error('slug')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="category_id">Category</label>
                                    <select name="category_id" id="category_id"
                                        class="form-control @error('category_id') is-invalid @enderror">
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id', $course->category_id) == $category->id ? 'selected' : '' }}>
                                                {!! $category->name !!}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="subcategory_id">Subcategory</label>
                                    <select name="subcategory_id" id="subcategory_id"
                                        class="form-control @error('subcategory_id') is-invalid @enderror" {{ $course->category_id ? '' : 'disabled' }}>
                                        <option value="">Select Subcategory</option>
                                        @foreach ($subcategories as $subcategory)
                                            <option value="{{ $subcategory->id }}" {{ old('subcategory_id', $course->subcategory_id) == $subcategory->id ? 'selected' : '' }}>
                                                {!! $subcategory->name !!}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('subcategory_id')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="price">Price <span class="text-danger">*</span></label>
                                    <input type="number" step="0.01" name="price" id="price"
                                        class="form-control @error('price') is-invalid @enderror"
                                        value="{{ old('price', $course->price) }}" required>
                                    @error('price')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="discount">Discount</label>
                                    <input type="number" step="0.01" name="discount" id="discount"
                                        class="form-control @error('discount') is-invalid @enderror"
                                        value="{{ old('discount', $course->discount) }}">
                                    @error('discount')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="live_or_record">Live or Record</label>
                                    <select name="live_or_record" id="live_or_record"
                                        class="form-control @error('live_or_record') is-invalid @enderror">
                                        <option value="">Select Type</option>
                                        <option value="live" {{ old('live_or_record', $course->live_or_record) == 'live' ? 'selected' : '' }}>Live</option>
                                        <option value="record" {{ old('live_or_record', $course->live_or_record) == 'record' ? 'selected' : '' }}>Record</option>
                                    </select>
                                    @error('live_or_record')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="is_offline">Is Offline</label>
                                    <select name="is_offline" id="is_offline"
                                        class="form-control @error('is_offline') is-invalid @enderror">
                                        <option value="">Select Option</option>
                                        <option value="1" {{ old('is_offline', (string) $course->is_offline) == '1' ? 'selected' : '' }}>Yes</option>
                                        <option value="0" {{ old('is_offline', (string) $course->is_offline) == '0' ? 'selected' : '' }}>No</option>
                                    </select>
                                    @error('is_offline')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="is_active">Status</label>
                                    <select name="is_active" id="is_active"
                                        class="form-control @error('is_active') is-invalid @enderror">
                                        <option value="1" {{ old('is_active', (string) $course->is_active) == '1' ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ old('is_active', (string) $course->is_active) == '0' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    @error('is_active')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="video_link">Video Link</label>
                                    <input type="text" name="video_link" id="video_link"
                                        class="form-control @error('video_link') is-invalid @enderror"
                                        value="{{ old('video_link', $course->video_link) }}">
                                    @error('video_link')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea name="description" id="summernote"
                                        class="form-control @error('description') is-invalid @enderror"
                                        rows="4">{{ old('description', $course->description) }}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <input type="file" name="image" id="image"
                                        class="form-control @error('image') is-invalid @enderror">
                                    @error('image')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                    @if ($course->image)
                                        <div class="mt-2">
                                            <img src="{{ asset('uploads/courses/' . $course->image) }}" alt="" style="height: 100px">
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="pdf">PDF</label>
                                    <input type="file" name="pdf" id="pdf"
                                        class="form-control @error('pdf') is-invalid @enderror">
                                    @error('pdf')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                    @if ($course->pdf)
                                        <div class="mt-2">
                                            <a href="{{ asset('uploads/courses/pdfs/' . $course->pdf) }}" target="_blank">View Current PDF</a>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="lessons">Lessons</label>
                                    <div id="multipleLessonFields">
                                        @php
                                            $lessonValues = old('lessons', ['']);
                                        @endphp
                                        @foreach ($lessonValues as $lessonIndex => $lesson)
                                            <div class="d-flex justify-content-between mb-2" id="multipleLessonField{{ $lessonIndex }}">
                                                <input type="text" name="lessons[]"
                                                    class="form-control me-4 @error('lessons.' . $lessonIndex) is-invalid @enderror"
                                                    value="{{ $lesson }}" placeholder="Enter lesson name" />
                                                <button type="button"
                                                    class="btn {{ $loop->first ? 'btn-secondary addLessonField' : 'btn-danger removeLessonField' }}">
                                                    {{ $loop->first ? '+' : '-' }}
                                                </button>
                                            </div>
                                            @error('lessons.' . $lessonIndex)
                                                <span class="invalid-feedback d-block" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        @endforeach
                                    </div>
                                    <small class="form-text text-muted">Add new lessons here. Existing lessons can be deleted below.</small>

                                    @if ($course->lessons->count() > 0)
                                        <ul class="list-inline mt-3 mb-0">
                                            @foreach ($course->lessons as $lesson)
                                                <li class="list-inline-item lesson_item mb-2" id="course-lesson-{{ $lesson->id }}">
                                                    <span>{{ $lesson->name }}</span>
                                                    <div class="remove_icon">
                                                        <button type="button"
                                                            class="btn-outline-warning border show_confirm delete-lesson"
                                                            data-id="{{ $lesson->id }}" data-toggle="tooltip"
                                                            data-placement="top" data-bs-original-title="Delete">
                                                            <i class="fa-regular fa-circle-xmark"></i>
                                                        </button>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <button class="btn btn-primary" type="submit">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('backend_script')
        @include('backend.pages.common.script')
        <script>
            $(document).ready(function() {
                $(document).on('click', '.addLessonField', function() {
                    var fieldCount = $('#multipleLessonFields .d-flex').length;
                    var newField = `
                        <div class="d-flex justify-content-between mb-2" id="multipleLessonField${fieldCount}">
                            <input type="text" name="lessons[]" class="form-control me-4" placeholder="Enter lesson name" />
                            <button type="button" class="btn btn-danger removeLessonField">-</button>
                        </div>
                    `;
                    $('#multipleLessonFields').append(newField);
                });

                $(document).on('click', '.removeLessonField', function() {
                    $(this).closest('.d-flex').remove();
                });

                $(document).on('click', '.delete-lesson', function(e) {
                    e.preventDefault();

                    var lessonId = $(this).data('id');
                    var url = "{{ route('course.lesson.delete', ':id') }}";
                    url = url.replace(':id', lessonId);

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: url,
                                type: 'DELETE',
                                data: {
                                    "_token": "{{ csrf_token() }}",
                                },
                                success: function(response) {
                                    $('#course-lesson-' + lessonId).remove();
                                    Swal.fire(
                                        'Deleted!',
                                        'Your lesson has been deleted.',
                                        'success'
                                    );
                                },
                                error: function(xhr) {
                                    console.error(xhr.responseText);
                                    Swal.fire(
                                        'Error!',
                                        'Something went wrong. Please try again.',
                                        'error'
                                    );
                                }
                            });
                        }
                    });
                });

                $('#category_id').on('change', function() {
                    var categoryId = $(this).val();

                    if (categoryId) {
                        $.ajax({
                            url: "{{ route('course.get.subcategories', ':category_id') }}".replace(':category_id', categoryId),
                            type: "GET",
                            dataType: "json",
                            success: function(data) {
                                $('#subcategory_id').empty();
                                $('#subcategory_id').append('<option value="">Select Subcategory</option>');

                                $.each(data, function(key, value) {
                                    $('#subcategory_id').append('<option value="' + value.id + '">' + value.name + '</option>');
                                });

                                $('#subcategory_id').prop('disabled', false);
                            }
                        });
                    } else {
                        $('#subcategory_id').empty();
                        $('#subcategory_id').append('<option value="">Select Subcategory</option>');
                        $('#subcategory_id').prop('disabled', true);
                    }
                });

                var selectedCategoryId = $('#category_id').val();
                var selectedSubcategoryId = '{{ old('subcategory_id', $course->subcategory_id) }}';

                if (selectedCategoryId) {
                    $.ajax({
                        url: "{{ route('course.get.subcategories', ':category_id') }}".replace(':category_id', selectedCategoryId),
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('#subcategory_id').empty();
                            $('#subcategory_id').append('<option value="">Select Subcategory</option>');

                            $.each(data, function(key, value) {
                                var selected = value.id == selectedSubcategoryId ? 'selected' : '';
                                $('#subcategory_id').append('<option value="' + value.id + '" ' + selected + '>' + value.name + '</option>');
                            });

                            $('#subcategory_id').prop('disabled', false);
                        }
                    });
                }
            });
        </script>
        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        </script>
    @endpush
@endsection
