@extends('backend.layouts.master')

@section('title', 'Edit Service Two')

@push('backend_style')
    @include('backend.pages.common.style')
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Edit Service Two</h1>
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
                    <h3 class="card-title">Update Service Two</h3>
                    <a href="{{ route('servicetwos.index') }}" class="btn btn-info"><i
                            class="fa-solid fa-angles-left fa-fw"></i> Back</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('servicetwos.update', $service->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="servicetwocategory_id">Category</label>
                                    <select name="servicetwocategory_id" id="servicetwocategory_id"
                                        class="form-control @error('servicetwocategory_id') is-invalid @enderror" required>
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ $service->servicetwocategory_id == $category->id ? 'selected' : '' }}>
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
                                        value="{{ $service->title }}" required>
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
                                    @if ($service->service_icon)
                                        <div class="mt-2">
                                            <img src="{{ asset('uploads/servicetwos/' . $service->service_icon) }}" alt="current icon" width="80" style="object-fit: contain;">
                                        </div>
                                    @endif
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
                                    @if ($service->image)
                                        <div class="mt-2">
                                            <img src="{{ asset('uploads/servicetwos/' . $service->image) }}"
                                                alt="current image" width="100" style="object-fit: cover;">
                                        </div>
                                    @endif
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
                                        value="{{ $service->service_type }}" required>
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
                                        value="{{ $service->url }}">
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
                                        class="form-control @error('description') is-invalid @enderror" required>{{ $service->description }}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-check">
                                    <input type="checkbox" name="is_active" class="form-check-input" id="is_active"
                                        value="1" {{ $service->is_active ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_active">Active</label>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-secondary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('backend_script')
    @include('backend.pages.common.script')
    <script>
        $(document).ready(function() {
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
