@extends('backend.layouts.master')

@section('title', 'Edit News')

@push('backend_style')
    @include('backend.pages.common.style')
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">News</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">News</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <h3 class="card-title">Update News</h3>
                    <a href="{{ route('admin.news.index') }}" class="btn btn-info"><i class="fa-solid fa-angles-left fa-fw"></i>
                        Back</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.news.update', $news->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="category_id" class="form-label mb-3">Select Category <span class="text-danger">*</span></label>
                                    <select id="category_id" name="category_id"
                                        class="form-control select2 form-select select2-hidden-accessible
                                    @error('category_id')
                                        is-invalid
                                    @enderror">
                                        <option value="">Select Category</option>
                                        @foreach ($newsCategories as $category)
                                            <option value="{{ $category->id }}" {{ $news->category_id == $category->id ? 'selected' : '' }}>
                                                {{ $category->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="title">News Title</label>
                                    <input type="text" name="title" class="form-control @error('title')
                                        is-invalid
                                    @enderror" id="title"
                                        value="{{ $news->title }}" required>
                                    @error('title')
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="description">Description <span class="text-danger">*</span></label>
                                    <textarea name="description" id="description" data-summernote
                                        class="form-control
                                    @error('description')
                                        is-invalid
                                    @enderror"
                                        id="description" cols="30" rows="5">{{ $news->description }}</textarea>
                                    @error('description')
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="short_des">Short Description <span class="text-danger">*</span></label>
                                    <textarea name="short_des" id="short_des"
                                        class="form-control
                                    @error('short_des')
                                        is-invalid
                                    @enderror"
                                        id="short_des" cols="30" rows="5">{{ $news->short_des }}</textarea>
                                    @error('short_des')
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="long_des">Long Description <span class="text-danger">*</span></label>
                                    <textarea name="long_des" id="long_des" data-summernote
                                        class="form-control
                                    @error('long_des')
                                        is-invalid
                                    @enderror"
                                        id="long_des" cols="30" rows="10">{{ $news->long_des }}</textarea>
                                    @error('long_des')
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="news_image">News Image</label>
                                    <input type="file" name="news_image" class="form-control dropify" id="news_image"
                                        data-default-file="{{ asset('uploads/news/' . $news->news_image) }}">
                                </div>
                            </div>
                            {{-- <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label>Status</label>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                                            {{ $news->is_active ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active">Active</label>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                        <button type="submit" class="btn btn-secondary" type="submit">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Row -->
@endsection

@push('backend_script')
    @include('backend.pages.common.script')
    <script>
        var drEvent = $('.dropify').dropify();

        drEvent.on('dropify.error.fileSize', function(event, element) {
            // alert('Filesize error message!');
        });
        drEvent.on('dropify.error.minWidth', function(event, element) {
            // alert('Min width error message!');
        });
        drEvent.on('dropify.error.maxWidth', function(event, element) {
            // alert('Max width error message!');
        });
        drEvent.on('dropify.error.minHeight', function(event, element) {
            // alert('Min height error message!');
        });
        drEvent.on('dropify.error.maxHeight', function(event, element) {
            // alert('Max height error message!');
        });
        drEvent.on('dropify.error.imageFormat', function(event, element) {
            // alert('Image format error message!');
        });
    </script>
@endpush
