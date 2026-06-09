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
                    <h3 class="card-title">Create Post</h3>
                    @can('delete-post')
                    <a href="{{ route('posts.trash') }}" class="btn btn-sm btn-outline-warning border"><i
                            class="fa-solid fa-trash-can-arrow-up fa-fw"></i> View Trash</a>
                    @endcan
                </div>
                <div class="card-body">
                    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
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
                                            <option value="{{ $category->id }}">{{ $category->title }}</option>
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
                                        value="{{ old('title') }}" required>
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
                                    <textarea name="description" id="description" data-summernote
                                        class="form-control @error('description')
                                        is-invalid
                                    @enderror"
                                        id="description" cols="30" rows="5">{{ old('description') }}</textarea>
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
                                    <textarea name="short_des" id="short_des"
                                        class="form-control @error('short_des')
                                        is-invalid
                                    @enderror"
                                        id="short_des" cols="30" rows="5">{{ old('short_des') }}</textarea>
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
                                    <textarea name="long_des" id="long_des" data-summernote
                                        class="form-control @error('long_des')
                                        is-invalid
                                    @enderror"
                                        id="long_des" cols="30" rows="5">{{ old('long_des') }}</textarea>
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
                                    <input type="file" name="post_image" class="dropify" data-default-file=""
                                        data-height="200" data-max-width="900" data-max-height="600" data-show-errors="true"
                                        data-errors-position="outside" data-allowed-file-extensions="png jpg" required/>
                                    @if ($errors->has('post_image'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('post_image') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary" type="submit">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h3 class="card-title">Photo Category List</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive export-table">
                        <table id="file-datatable" class="table table-bordered text-nowrap key-buttons border-bottom w-100">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">Last Updated</th>
                                    <th class="border-bottom-0">Category</th>
                                    <th class="border-bottom-0">Post Title</th>
                                    <th class="border-bottom-0">Image</th>
                                    @can('edit-post')
                                    <th class="border-bottom-0">Home Page</th>
                                    @endcan
                                    @can('edit-post')
                                    <th class="border-bottom-0">Status</th>
                                    @endcan
                                    @canany(['edit-post', 'delete-post'])
                                    <th class="border-bottom-0">Actions</th>
                                    @endcanany
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($posts as $post)
                                    <tr>
                                        <td>
                                            <strong>{{ $posts->firstItem() + $loop->index }}</strong>
                                        </td>
                                        <td>{{ $post->updated_at->format('d-M-Y') }}</td>
                                        <td>{{ $post->postCategory->title }}</td>
                                        <td>{{ $post->title }}</td>
                                        <td>
                                            <img src="{{ asset('uploads/posts') }}/{{ $post->post_image }}" alt=""
                                                style="height: 100px">
                                        </td>
                                        @can('edit-post')
                                        <td>
                                            <div class="material-switch">
                                                <input id="home-{{ $post->id }}" class="toggle-class-home" name="is_home"
                                                    type="checkbox" {{ $post->is_home ? 'checked' : '' }}
                                                    data-id="{{ $post->id }}">
                                                <label for="home-{{ $post->id }}" class="label-success"></label>
                                            </div>
                                        </td>
                                        @endcan
                                        @can('edit-post')
                                        <td>
                                            <div class="material-switch">
                                                <input id="active-{{ $post->id }}" class="toggle-class-active" name="is_active"
                                                    type="checkbox" {{ $post->is_active ? 'checked' : '' }}
                                                    data-id="{{ $post->id }}">
                                                <label for="active-{{ $post->id }}" class="label-success"></label>
                                            </div>
                                        </td>
                                        @endcan
                                        @canany(['edit-post', 'delete-post'])
                                        <td class="text-center">
                                            <div class="action-btns d-flex align-items-center">
                                                <div>
                                                    <a href="{{ route('posts.show', $post->id) }}" class="btn btn-sm btn-outline-primary border me-2"
                                                        data-toggle="tooltip" data-placement="top"
                                                        data-bs-original-title="View">
                                                        <i class="fa-solid fa-eye"></i>
                                                    </a>
                                                </div>
                                                <div>
                                                    <a href="{{ route('posts.edit', $post->id) }}"
                                                        class="btn btn-sm btn-outline-secondary border me-2"
                                                        data-toggle="tooltip" data-placement="top"
                                                        data-bs-original-title="Edit"><i class="fa-solid fa-pen fa-fw"></i>
                                                    </a>
                                                </div>
                                                <div>
                                                    <form action="{{ route('posts.destroy', $post->id) }}"
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
    <!-- End Row -->
@endsection

@push('backend_script')
    @include('backend.pages.common.script')
    <script>
        $(document).ready(function() {
            $(document).on('change', '.toggle-class-home', function() {
                var item_id = $(this).data('id');

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: `/admin/check/post/is_home/${item_id}`,
                    success: function(response) {
                        console.log(response);
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
            $(document).on('change', '.toggle-class-active', function() {
                var item_id = $(this).data('id');

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: `/admin/check/post/is_active/${item_id}`,
                    success: function(response) {
                        console.log(response);
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
        });
    </script>
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
