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

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <h3 class="card-title">Create Course</h3>
                    @can('delete-product')
                        <a href="{{ route('courses.trash') }}" class="btn btn-sm btn-outline-warning border">
                            <i class="fa-solid fa-trash-can-arrow-up fa-fw"></i> View Trash
                        </a>
                    @endcan
                </div>
                <div class="card-body">
                    <form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="name">Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" id="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name') }}" required>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="slug">Slug (Optional - Auto-generated if left empty)</label>
                                    <input type="text" name="slug" id="slug"
                                        class="form-control @error('slug') is-invalid @enderror"
                                        value="{{ old('slug') }}">
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
                                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
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
                                        class="form-control @error('subcategory_id') is-invalid @enderror" disabled>
                                        <option value="">Select Subcategory</option>
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
                                        value="{{ old('price') }}" required>
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
                                        value="{{ old('discount') }}">
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
                                        <option value="live" {{ old('live_or_record') == 'live' ? 'selected' : '' }}>Live</option>
                                        <option value="record" {{ old('live_or_record') == 'record' ? 'selected' : '' }}>Record</option>
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
                                        <option value="1" {{ old('is_offline') == '1' ? 'selected' : '' }}>Yes</option>
                                        <option value="0" {{ old('is_offline') == '0' ? 'selected' : '' }}>No</option>
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
                                        <option value="1" {{ old('is_active', '1') == '1' ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Inactive</option>
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
                                        value="{{ old('video_link') }}">
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
                                        rows="4">{{ old('description') }}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="image">Image <span class="text-danger">*</span></label>
                                    <input type="file" name="image" id="image"
                                        class="form-control @error('image') is-invalid @enderror" required>
                                    @error('image')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
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
                                </div>
                            </div>
                        </div>

                        <button class="btn btn-primary" type="submit">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h3 class="card-title">Course List</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive export-table">
                        <table id="file-datatable" class="table table-bordered text-nowrap key-buttons border-bottom w-100">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Subcategory</th>
                                    <th>Image</th>
                                    <th>Price</th>
                                    <th>Discount</th>
                                    <th>Type</th>
                                    @can('edit-product')
                                        <th>Status</th>
                                    @endcan
                                    @canany(['edit-product', 'delete-product'])
                                        <th>Actions</th>
                                    @endcanany
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($courses as $course)
                                    <tr>
                                        <td><strong>{{ $courses->firstItem() + $loop->index }}</strong></td>
                                        <td>{{ $course->name }}</td>
                                        <td>{{ $course->category ? $course->category->name : 'N/A' }}</td>
                                        <td>{{ $course->subcategory ? $course->subcategory->name : 'N/A' }}</td>
                                        <td>
                                            @if ($course->image)
                                                <img src="{{ asset('uploads/courses/' . $course->image) }}" alt="" style="height: 50px">
                                            @else
                                                <span>No Image</span>
                                            @endif
                                        </td>
                                        <td>{{ $course->price }}</td>
                                        <td>{{ $course->discount ?? 'N/A' }}</td>
                                        <td>{{ $course->live_or_record ?? 'N/A' }}</td>
                                        @can('edit-product')
                                            <td>
                                                <div class="material-switch">
                                                    <input id="course-{{ $course->id }}" class="toggle-class" name="is_active"
                                                        type="checkbox" {{ $course->is_active ? 'checked' : '' }}
                                                        data-id="{{ $course->id }}">
                                                    <label for="course-{{ $course->id }}" class="label-success"></label>
                                                </div>
                                            </td>
                                        @endcan
                                        @canany(['edit-product', 'delete-product'])
                                            <td class="text-center">
                                                <div class="action-btns d-flex align-items-center justify-content-center">
                                                    <div>
                                                        <a href="{{ route('courses.show', $course->id) }}"
                                                            class="btn btn-sm btn-outline-primary border me-1">
                                                            <i class="fa-solid fa-eye"></i>
                                                        </a>
                                                    </div>
                                                    <div>
                                                        <a href="{{ route('courses.edit', $course->id) }}"
                                                            class="btn btn-sm btn-outline-secondary border me-1">
                                                            <i class="fa-solid fa-pen fa-fw"></i>
                                                        </a>
                                                    </div>
                                                    <div>
                                                        <form action="{{ route('courses.destroy', $course->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-outline-warning border show_confirm">
                                                                <i class="fa-solid fa-trash-can fa-fw"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                        @endcanany
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('backend_script')
        @include('backend.pages.common.script')
        <script>
            $(document).ready(function() {
                $(document).on('change', '.toggle-class', function() {
                    var courseId = $(this).data('id');
                    var url = "{{ route('course.is_active.ajax', ':course_id') }}";
                    url = url.replace(':course_id', courseId);

                    $.ajax({
                        type: "GET",
                        url: url,
                        success: function(data) {
                            if (data.type === 'success') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success!',
                                    text: data.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            }
                        },
                        error: function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'Something went wrong!',
                                showConfirmButton: false,
                                timer: 1500
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
            });
        </script>
    @endpush
@endsection
