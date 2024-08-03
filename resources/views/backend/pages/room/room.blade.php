@extends('backend.layouts.master')

@section('title', 'Room')

@push('backend_style')
    @include('backend.pages.common.style')
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Room</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Room</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <h3 class="card-title">Create Room</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('rooms.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="roomtype_id" class="form-label mb-3">Select Room Type <span class="text-danger">*</span></label>
                                    <select id="roomtype_id" name="roomtype_id"
                                        class="form-control select2 form-select select2-hidden-accessible
                                    @error('roomtype_id')
                                        is-invalid
                                    @enderror">
                                        <option selected>Choose a Room Type</option>
                                        @forelse ($room_types as $room_type)
                                            <option value="{{ $room_type->id }}">{{ $room_type->title }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                    @error('roomtype_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="title">Title <span class="text-danger">*</span></label>
                                    <input type="text" name="title"
                                        class="form-control @error('title')
                                        is-invalid
                                    @enderror"
                                        id="title" value="{{ old('title') }}">
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
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="image">Image <span class="text-danger">*</span></label>
                                    <input type="file" name="image" class="dropify" data-default-file=""
                                        data-height="200" data-max-width="400" data-show-errors="true"
                                        data-errors-position="outside" data-max-height="420"
                                        data-allowed-file-extensions="png jpg" required/>
                                    @if ($errors->has('image'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('image') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Image fields for multiple images -->
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="multiple_image">Multiple Images</label>
                                    <div id="multipleImageFields">
                                        <div class="d-flex justify-content-between mb-2" id="multipleImageField0">
                                            <input type="file" name="multiple_image[]" class="form-control me-4" />
                                            <button type="button" class="btn btn-secondary addImageField">+</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Existing form fields here -->

                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="price">Price <span class="text-danger">*</span></label>
                                    <input type="number" name="price"
                                        class="form-control @error('price')
                                        is-invalid
                                    @enderror"
                                        id="price" value="{{ old('price') }}">
                                    @error('price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
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
                    <h3 class="card-title">Room Type List</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive export-table">
                        <table id="file-datatable" class="table table-bordered text-nowrap key-buttons border-bottom w-100">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">Title</th>
                                    <th class="border-bottom-0">Type</th>
                                    <th class="border-bottom-0">Image</th>
                                    <th class="border-bottom-0">price</th>
                                    <th class="border-bottom-0">Wifi</th>
                                    <th class="border-bottom-0">AC</th>
                                    <th class="border-bottom-0">TV</th>
                                    <th class="border-bottom-0">Mini Fridge</th>
                                    <th class="border-bottom-0">Balcony</th>
                                    <th class="border-bottom-0">Kitchenette</th>
                                    <th class="border-bottom-0">Living Area</th>
                                    {{-- @can('edit-permission') --}}
                                    <th class="border-bottom-0">Actions</th>
                                    {{-- @endcan --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rooms as $room)
                                    <tr>
                                        <td>
                                            <strong>{{ $rooms->firstItem() + $loop->index }}</strong>
                                        </td>
                                        <td>{{ $room->title }}</td>
                                        <td>{{ $room->roomtype->title }}</td>
                                        <td>
                                            <img src="{{ asset('uploads/rooms') }}/{{ $room->image }}" alt=""
                                                style="height: 100px">
                                        </td>
                                        <td>{{ $room->price }}</td>
                                        <td>
                                            <div class="material-switch">
                                                <input id="user-{{ $room->id }}" class="toggle-class" name="is_wifi"
                                                    type="checkbox" {{ $room->is_wifi ? 'checked' : '' }}
                                                    data-id="{{ $room->id }}">
                                                <label for="user-{{ $room->id }}" class="label-success"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="material-switch">
                                                <input id="ac-{{ $room->id }}" class="toggle-class-ac"
                                                    name="is_ac" type="checkbox" {{ $room->is_ac ? 'checked' : '' }}
                                                    data-id="{{ $room->id }}">
                                                <label for="ac-{{ $room->id }}" class="label-success"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="material-switch">
                                                <input id="tv-{{ $room->id }}" class="toggle-class-tv"
                                                    name="is_tv" type="checkbox" {{ $room->is_tv ? 'checked' : '' }}
                                                    data-id="{{ $room->id }}">
                                                <label for="tv-{{ $room->id }}" class="label-success"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="material-switch">
                                                <input id="mini-fridge-{{ $room->id }}"
                                                    class="toggle-class-mini-fridge" name="is_mini_fridge"
                                                    type="checkbox" {{ $room->is_mini_fridge ? 'checked' : '' }}
                                                    data-id="{{ $room->id }}">
                                                <label for="mini-fridge-{{ $room->id }}"
                                                    class="label-success"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="material-switch">
                                                <input id="balcony-{{ $room->id }}" class="toggle-class-balcony"
                                                    name="is_balcony" type="checkbox"
                                                    {{ $room->is_balcony ? 'checked' : '' }}
                                                    data-id="{{ $room->id }}">
                                                <label for="balcony-{{ $room->id }}" class="label-success"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="material-switch">
                                                <input id="kitchenette-{{ $room->id }}"
                                                    class="toggle-class-kitchenette" name="is_kitchenette"
                                                    type="checkbox" {{ $room->is_kitchenette ? 'checked' : '' }}
                                                    data-id="{{ $room->id }}">
                                                <label for="kitchenette-{{ $room->id }}"
                                                    class="label-success"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="material-switch">
                                                <input id="living-area-{{ $room->id }}"
                                                    class="toggle-class-living-area" name="is_living_area"
                                                    type="checkbox" {{ $room->is_living_area ? 'checked' : '' }}
                                                    data-id="{{ $room->id }}">
                                                <label for="living-area-{{ $room->id }}"
                                                    class="label-success"></label>
                                            </div>
                                        </td>
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
                                                    <a href="{{ route('rooms.edit', $room->id) }}"
                                                        class="btn btn-sm btn-outline-secondary border me-2"
                                                        data-toggle="tooltip" data-placement="top"
                                                        data-bs-original-title="Edit"><i
                                                            class="fa-solid fa-pen fa-fw"></i>
                                                    </a>
                                                </div>
                                                {{-- @endcan
                                                @can('delete-permission') --}}
                                                <div>
                                                    <form action="{{ route('rooms.destroy', $room->id) }}"
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
        $(document).ready(function() {
            // Check if the DataTable is already initialized and destroy it if necessary
            if ($.fn.DataTable.isDataTable('#file-datatable')) {
                $('#file-datatable').DataTable().destroy();
            }

            // Initialize the DataTable
            var table = $('#file-datatable').DataTable({
                // Your DataTable options here
            });

            // Use delegated event binding for dynamically created elements
            $(document).on('change', '.toggle-class', function() {
                var item_id = $(this).data('id');

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: `/admin/check/room/is_wifi/${item_id}`,
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

            $(document).on('change', '.toggle-class-ac', function() {
                var item_id = $(this).data('id');

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: `/admin/check/room/is_ac/${item_id}`,
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

            $(document).on('change', '.toggle-class-tv', function() {
                var item_id = $(this).data('id');

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: `/admin/check/room/is_tv/${item_id}`,
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

            $(document).on('change', '.toggle-class-balcony', function() {
                var item_id = $(this).data('id');

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: `/admin/check/room/is_balcony/${item_id}`,
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

            $(document).on('change', '.toggle-class-mini-fridge', function() {
                var item_id = $(this).data('id');

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: `/admin/check/room/is_mini_fridge/${item_id}`,
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

            $(document).on('change', '.toggle-class-kitchenette', function() {
                var item_id = $(this).data('id');

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: `/admin/check/room/is_kitchenette/${item_id}`,
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

            $(document).on('change', '.toggle-class-living-area', function() {
                var item_id = $(this).data('id');

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: `/admin/check/room/is_living_area/${item_id}`,
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
        $(document).ready(function() {
            let imageFieldIndex = 1;

            // Add new image input field
            $(document).on('click', '.addImageField', function() {
                const newField = `
                    <div class="d-flex justify-content-between mb-2" id="multipleImageField${imageFieldIndex}">
                        <input type="file" name="multiple_image[]" class="form-control me-4" />
                        <button type="button" class="btn btn-danger removeImageField" data-id="${imageFieldIndex}">-</button>
                    </div>`;
                $('#multipleImageFields').append(newField);
                imageFieldIndex++;
            });

            // Remove image input field
            $(document).on('click', '.removeImageField', function() {
                const id = $(this).data('id');
                $(`#multipleImageField${id}`).remove();
            });

            // Handle form submission with AJAX
            $('#roomForm').on('submit', function(event) {
                event.preventDefault();

                let formData = new FormData(this);

                $.ajax({
                    url: '{{ route('rooms.store') }}',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $('#response').html(
                            '<p class="alert alert-success">Room created successfully!</p>');
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        $('#response').html(
                            '<p class="alert alert-danger">Error creating room: ' +
                            errorThrown + '</p>');
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
