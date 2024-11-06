@extends('backend.layouts.master')

@section('title', 'Post')

@push('backend_style')
    @include('backend.pages.common.style')
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Post</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Post</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <h3 class="card-title">Update Post</h3>
                    <a href="{{ route('posts.index') }}" class="btn btn-info"><i class="fa-solid fa-angles-left fa-fw"></i>
                        Back</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
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
                                        <option selected>Choose a Category</option>
                                        @forelse ($postCategories as $category)
                                            <option value="{{ $category->id }}" @if ($category->id == $post->category_id)
                                                selected
                                            @endif>{{ $category->title }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                    @error('category_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="title">Post Title</label>
                                    <input type="text" name="title" class="form-control @error('title')
                                        is-invalid
                                    @enderror" id="title"
                                        value="{{ $post->title }}" required>
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="description">Description <span class="text-danger">*</span></label>
                                    <textarea name="description" id=""
                                        class="form-control @error('description')
                                        is-invalid
                                    @enderror"
                                        id="description" cols="30" rows="5">{{ $post->description }}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="short_des">Short Description <span class="text-danger">*</span></label>
                                    <textarea name="short_des" id=""
                                        class="form-control @error('short_des')
                                        is-invalid
                                    @enderror"
                                        id="short_des" cols="30" rows="5">{{ $post->short_des }}</textarea>
                                    @error('short_des')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="long_des">Long Description <span class="text-danger">*</span></label>
                                    <textarea name="long_des" id=""
                                        class="form-control @error('long_des')
                                        is-invalid
                                    @enderror"
                                        id="long_des" cols="30" rows="5">{{ $post->long_des }}</textarea>
                                    @error('long_des')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="post_image">Image <span class="text-danger">*</span></label>
                                    <input type="file" name="post_image" class="dropify" data-default-file="{{ asset('uploads/posts') }}/{{ $post->post_image }}"
                                        data-height="200" data-max-width="900" data-max-height="600" data-show-errors="true"
                                        data-errors-position="outside" data-allowed-file-extensions="png jpg"/>
                                    @if ($errors->has('post_image'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('post_image') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
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
