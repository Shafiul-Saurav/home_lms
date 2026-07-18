@extends('backend.layouts.master')

@section('title', 'Photo Gallery')

@push('backend_style')
    @include('backend.pages.common.style')
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Photo Gallery</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Photo Gallery</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <h3 class="card-title">Create Photo Gallery</h3>
                    @can('delete-photo-gallery')
                    <a href="{{ route('photogalleries.trash') }}" class="btn btn-sm btn-outline-warning border"><i
                            class="fa-solid fa-trash-can-arrow-up fa-fw"></i> View Trash</a>
                    @endcan
                </div>
                <div class="card-body">
                    <form action="{{ route('photogalleries.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{-- <div class="form-row">
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="category_id" class="form-label mb-3">Select Photo Category</label>
                                    <select id="category_id" name="category_id"
                                        class="form-control select2 form-select select2-hidden-accessible
                                    @error('category_id')
                                        is-invalid
                                    @enderror">
                                        <option value="" selected>Choose a Photo Category</option>
                                        @forelse ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                    @error('category_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div> --}}
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" name="title" class="form-control @error('title')
                                        is-invalid
                                    @enderror" id="title"
                                        value="{{ old('title') }}">
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            {{-- <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="number" name="price" class="form-control @error('price')
                                        is-invalid
                                    @enderror" id="price"
                                        value="{{ old('price') }}">
                                    @error('price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div> --}}
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="gall_image">Gallery Image <span class="text-danger">*</span></label>
                                    <input type="file" name="gall_image" class="dropify" data-default-file=""
                                        data-height="200" data-max-width="850" data-show-errors="true"
                                        data-errors-position="outside" data-max-height="850"
                                        data-allowed-file-extensions="png jpg jpeg webp" required/>
                                    @if ($errors->has('gall_image'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('gall_image') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            {{-- <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea name="description" id="summernote"
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
                            </div> --}}
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
                    <h3 class="card-title">Photo Gallery List</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive export-table">
                        <table id="file-datatable" class="table table-bordered text-nowrap key-buttons border-bottom w-100">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">Last Updated</th>
                                    <th class="border-bottom-0">Image</th>
                                    {{-- <th class="border-bottom-0">Category Name</th> --}}
                                    <th class="border-bottom-0">Title</th>
                                    @can('edit-photo-gallery')
                                    {{-- <th class="border-bottom-0">Home Page</th> --}}
                                    @endcan
                                    @can('edit-photo-gallery')
                                    <th class="border-bottom-0">Status</th>
                                    @endcan
                                    @canany(['edit-photo-gallery', 'delete-photo-gallery'])
                                    <th class="border-bottom-0">Actions</th>
                                    @endcanany
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($galleries as $gallery)
                                    <tr>
                                        <td>
                                            <strong>{{ $galleries->firstItem() + $loop->index }}</strong>
                                        </td>
                                        <td>{{ $gallery->updated_at->format('d-M-Y') }}</td>
                                        <td>
                                            <img src="{{ asset('uploads/photogalleries') }}/{{ $gallery->gall_image }}" alt=""
                                                style="height: 100px">
                                        </td>
                                        {{-- <td>{{ $gallery->photoCategory?->category_name ?? 'N/A' }}</td> --}}
                                        <td>{{ $gallery->title }}</td>
                                        @can('edit-photo-gallery')
                                        {{-- <td>
                                            <div class="material-switch">
                                                <input id="home-{{ $gallery->id }}" class="toggle-class-home" name="is_home"
                                                    type="checkbox" {{ $gallery->is_home ? 'checked' : '' }}
                                                    data-id="{{ $gallery->id }}">
                                                <label for="home-{{ $gallery->id }}" class="label-success"></label>
                                            </div>
                                        </td> --}}
                                        @endcan
                                        @can('edit-photo-gallery')
                                        <td>
                                            <div class="material-switch">
                                                <input id="active-{{ $gallery->id }}" class="toggle-class-active" name="is_active"
                                                    type="checkbox" {{ $gallery->is_active ? 'checked' : '' }}
                                                    data-id="{{ $gallery->id }}">
                                                <label for="active-{{ $gallery->id }}" class="label-success"></label>
                                            </div>
                                        </td>
                                        @endcan
                                        @canany(['edit-photo-gallery', 'delete-photo-gallery'])
                                        <td class="text-center">
                                            <div class="action-btns d-flex align-items-center">
                                                {{-- <div>
                                                    <a href="{{ route('photogalleries.show', $gallery->id) }}" class="btn btn-sm btn-outline-primary border me-2"
                                                        data-toggle="tooltip" data-placement="top"
                                                        data-bs-original-title="View">
                                                        <i class="fa-solid fa-eye"></i>
                                                    </a>
                                                </div> --}}
                                                <div>
                                                    <a href="{{ route('photogalleries.edit', $gallery->id) }}"
                                                        class="btn btn-sm btn-outline-secondary border me-2"
                                                        data-toggle="tooltip" data-placement="top"
                                                        data-bs-original-title="Edit"><i class="fa-solid fa-pen fa-fw"></i>
                                                    </a>
                                                </div>
                                                <div>
                                                    <form action="{{ route('photogalleries.destroy', $gallery->id) }}"
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
                    url: `/admin/check/photogallery/is_home/${item_id}`,
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
                    url: `/admin/check/photogallery/is_active/${item_id}`,
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
