@extends('backend.layouts.master')

@section('title', 'Service Two')

@push('backend_style')
    @include('backend.pages.common.style')
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Service Two</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Service Two</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <h3 class="card-title">Create Service Two</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('servicetwos.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="servicetwocategory_id">Category</label>
                                    <select name="servicetwocategory_id" id="servicetwocategory_id"
                                        class="form-control @error('servicetwocategory_id') is-invalid @enderror" required>
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ old('servicetwocategory_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->title }}</option>
                                        @endforeach
                                    </select>
                                    @error('servicetwocategory_id')
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="title">Service Name</label>
                                    <input type="text" name="title"
                                        class="form-control @error('title') is-invalid @enderror" id="title"
                                        value="{{ old('title') }}" required>
                                    @error('title')
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            {{-- <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="service_icon">Service Icon</label>
                                    <input type="file" name="service_icon" class="form-control @error('service_icon') is-invalid @enderror" id="service_icon">
                                    @error('service_icon')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div> --}}
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="image">Service Image</label>
                                    <input type="file" name="image"
                                        class="form-control @error('image') is-invalid @enderror" id="image">
                                    @error('image')
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="service_type">Service Type</label>
                                    <input type="text" name="service_type"
                                        class="form-control @error('service_type') is-invalid @enderror" id="service_type"
                                        value="{{ old('service_type') }}" required>
                                    @error('service_type')
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="url">Service URL</label>
                                    <input type="url" name="url"
                                        class="form-control @error('url') is-invalid @enderror" id="url"
                                        value="{{ old('url') }}">
                                    @error('url')
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea name="description" id="summernote" cols="30" rows="10"
                                        class="form-control @error('description') is-invalid @enderror" required>{{ old('description') }}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h3 class="card-title">Service Two List</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive export-table">
                        <table id="file-datatable" class="table table-bordered text-nowrap key-buttons border-bottom w-100">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">Last Updated</th>
                                    <th class="border-bottom-0">Category</th>
                                    <th class="border-bottom-0">Service Name</th>
                                    <th class="border-bottom-0">Icon</th>
                                    <th class="border-bottom-0">Image</th>
                                    <th class="border-bottom-0">Type</th>
                                    <th class="border-bottom-0">Status</th>
                                    <th class="border-bottom-0">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($servicetwos as $service)
                                    <tr>
                                        <td><strong>{{ $servicetwos->firstItem() + $loop->index }}</strong></td>
                                        <td>{{ $service->updated_at->format('d-M-Y') }}</td>
                                        <td>{{ $service->category->title ?? 'N/A' }}</td>
                                        <td>{{ $service->title }}</td>
                                        <td>
                                            @if ($service->service_icon)
                                                <img src="{{ asset('uploads/servicetwos/' . $service->service_icon) }}"
                                                    alt="icon" width="40" height="40"
                                                    style="object-fit: contain;">
                                            @else
                                                <span class="text-muted">No Icon</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($service->image)
                                                <img src="{{ asset('uploads/servicetwos/' . $service->image) }}"
                                                    alt="image" width="50" height="35" style="object-fit: cover;">
                                            @else
                                                <span class="text-muted">No Image</span>
                                            @endif
                                        </td>
                                        <td>{{ $service->service_type }}</td>
                                        <td>
                                            <div class="material-switch">
                                                <input id="active-{{ $service->id }}" class="toggle-class-active"
                                                    name="is_active" type="checkbox"
                                                    {{ $service->is_active ? 'checked' : '' }}
                                                    data-id="{{ $service->id }}">
                                                <label for="active-{{ $service->id }}" class="label-success"></label>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="action-btns d-flex align-items-center">
                                                <div>
                                                    <a href="{{ route('servicetwos.edit', $service->id) }}"
                                                        class="btn btn-sm btn-outline-secondary border me-2"
                                                        data-toggle="tooltip" data-placement="top"
                                                        data-bs-original-title="Edit">
                                                        <i class="fa-solid fa-pen fa-fw"></i>
                                                    </a>
                                                </div>
                                                <div>
                                                    <form action="{{ route('servicetwos.destroy', $service->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-sm btn-outline-warning border show_confirm"
                                                            data-toggle="tooltip" data-placement="top"
                                                            data-bs-original-title="Delete">
                                                            <i class="fa-solid fa-trash-can fa-fw"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
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
            $(document).on('change', '.toggle-class-active', function() {
                var item_id = $(this).data('id');

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: `/admin/check/servicetwo/is_active/${item_id}`,
                    success: function(response) {
                        Swal.fire({
                            title: response.message,
                            text: response.message,
                            icon: response.type,
                        });
                    },
                    error: function(err) {
                        console.error(err);
                    }
                });
            });

            $('#summernote').summernote({
                height: 300,
                callbacks: {
                    onImageUpload: function(files) {
                        var data = new FormData();
                        data.append('image', files[0]);
                        $.ajax({
                            url: '{{ route('departments.upload-image') }}',
                            method: 'POST',
                            data: data,
                            processData: false,
                            contentType: false,
                            success: function(response) {
                                $('#summernote').summernote('insertImage', response.url);
                            }
                        });
                    }
                }
            });
        });
    </script>
@endpush
