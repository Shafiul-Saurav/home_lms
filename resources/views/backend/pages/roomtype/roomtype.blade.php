@extends('backend.layouts.master')

@section('title', 'Room Type')

@push('backend_style')
    @include('backend.pages.common.style')
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Room Type</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Room Type</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <h3 class="card-title">Create Room Type</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('room_types.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="title">Title</label>
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
                                    <label for="occupancy">Occupancy</label>
                                    <input type="text" name="occupancy" class="form-control @error('occupancy')
                                        is-invalid
                                    @enderror" id="occupancy"
                                        value="{{ old('occupancy') }}" required>
                                    @error('occupancy')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="bed_type">Bed Type</label>
                                    <input type="text" name="bed_type" class="form-control @error('bed_type')
                                        is-invalid
                                    @enderror" id="bed_type"
                                        value="{{ old('bed_type') }}" required>
                                    @error('bed_type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea name="description" id="summernote" class="form-control @error('description')
                                        is-invalid
                                    @enderror" id="description" cols="30" rows="5">{{ old('description') }}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="sm_image">Small Image <span class="text-danger">*</span></label>
                                    <input type="file" name="sm_image" class="dropify" data-default-file=""
                                        data-max-width="400" data-show-errors="true"
                                        data-errors-position="outside" data-max-height="420"
                                        data-allowed-file-extensions="png jpg" required/>
                                    @if ($errors->has('sm_image'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('sm_image') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="lg_image">Large Image <span class="text-danger">*</span></label>
                                    <input type="file" name="lg_image" class="dropify" data-default-file=""
                                        data-max-width="740" data-show-errors="true"
                                        data-errors-position="outside" data-max-height="710"
                                        data-allowed-file-extensions="png jpg" required/>
                                    @if ($errors->has('lg_image'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('lg_image') }}</strong>
                                        </span>
                                    @endif
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
                    <h3 class="card-title">Room Type List</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive export-table">
                        <table id="file-datatable" class="table table-bordered text-nowrap key-buttons border-bottom w-100">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">Last Updated</th>
                                    <th class="border-bottom-0">Title</th>
                                    <th class="border-bottom-0">Occupancy</th>
                                    <th class="border-bottom-0">Bed Type</th>
                                    {{-- @can('edit-permission') --}}
                                    <th class="border-bottom-0">Actions</th>
                                    {{-- @endcan --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($room_types as $room_type)
                                    <tr>
                                        <td>
                                            <strong>{{ $room_types->firstItem() + $loop->index }}</strong>
                                        </td>
                                        <td>{{ $room_type->updated_at->format('d-M-Y') }}</td>
                                        <td>{{ $room_type->title }}</td>
                                        <td>{{ $room_type->occupancy }}</td>
                                        <td>{{ $room_type->bed_type }}</td>
                                        {{-- @can('edit-permission') --}}
                                        <td class="text-center">
                                            <div class="action-btns d-flex align-items-center">
                                                <div>
                                                    <a href="" class="btn btn-sm btn-outline-primary border me-2"
                                                        data-toggle="tooltip" data-placement="top"
                                                        data-bs-original-title="View">
                                                        <i class="fa-solid fa-eye"></i>
                                                    </a>
                                                </div>
                                                {{-- @can('edit-permission') --}}
                                                <div>
                                                    <a href="{{ route('room_types.edit', $room_type->id) }}"
                                                        class="btn btn-sm btn-outline-secondary border me-2"
                                                        data-toggle="tooltip" data-placement="top"
                                                        data-bs-original-title="Edit"><i class="fa-solid fa-pen fa-fw"></i>
                                                    </a>
                                                </div>
                                                {{-- @endcan
                                                @can('delete-permission') --}}
                                                <div>
                                                    <form action="{{ route('room_types.destroy', $room_type->id) }}"
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
                                                {{-- @endcan --}}
                                            </div>
                                        </td>
                                        {{-- @endcan --}}
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
