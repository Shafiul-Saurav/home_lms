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
                        <li class="breadcrumb-item active" aria-current="page">Room Edit</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <h3 class="card-title">Update Room</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('rooms.update', $room->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="roomtype_id" class="form-label mb-3">Select Room Type</label>
                                    <select id="roomtype_id" name="roomtype_id" class="form-control select2 form-select select2-hidden-accessible
                                    @error('roomtype_id')
                                        is-invalid
                                    @enderror">
                                        <option selected>Choose a Room Type</option>
                                        @forelse ($room_types as $room_type)
                                            <option value="{{ $room_type->id }}" @if ($room->roomtype_id == $room_type->id)
                                                selected
                                            @endif>{{ $room_type->title }}</option>
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
                                    <label for="title">Title</label>
                                    <input type="text" name="title" class="form-control @error('title')
                                        is-invalid
                                    @enderror" id="title"
                                        value="{{ $room->title }}" required>
                                    @error('title')
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
                                    @enderror" id="description" cols="30" rows="5">{!! $room->description !!}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <input type="file" name="image" class="dropify" data-default-file="{{ asset('uploads/rooms') }}/{{ $room->image }}"
                                    data-height="200" data-max-width="1930" data-max-height="1090"
                                    data-allowed-file-extensions="png jpg"/>
                                </div>
                            </div>
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
                            <div class="col-12 mb-3">
                                <ul class="list-inline">
                                    @foreach ($room->roomImages as $roomImage)
                                    <li class="list-inline-item">
                                        <img src="{{ asset('uploads/rooms') }}/{{ $roomImage->multiple_image }}" alt="" style="height: 100px">
                                    </li>
                                    @endforeach
                                </ul>
                            </div>

                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="number" name="price" class="form-control @error('price')
                                        is-invalid
                                    @enderror" id="price"
                                        value="{{ $room->price }}" required>
                                    @error('price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-secondary" type="submit">Update</button>
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
        });
    </script>
@endpush
