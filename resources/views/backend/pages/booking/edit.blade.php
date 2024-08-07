@extends('backend.layouts.master')

@section('title', 'Booking Edit')

@push('backend_style')
    @include('backend.pages.common.style')
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Update Booking</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Booking</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <h3 class="card-title text-info">Customer: <span class="text-success"> {{ $booking->user->name }}</span></h3>
                    <a href="{{ route('bookings.index') }}" class="btn btn-outline-info border"><i class="fa-solid fa-angles-left fa-fw"></i> Back</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('bookings.update', $booking->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="checkin_date">Arrival Date</label>
                                    <input type="date" name="checkin_date" class="form-control @error('checkin_date')
                                        is-invalid
                                    @enderror" id="checkin_date"
                                        value="{{ $booking->checkin_date }}" required>
                                    @error('checkin_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="checkout_date">Departure Date</label>
                                    <input type="date" name="checkout_date" class="form-control @error('checkout_date')
                                        is-invalid
                                    @enderror" id="checkout_date"
                                        value="{{ $booking->checkout_date }}" required>
                                    @error('checkout_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="total_adults">Total Adult <span class="text-danger">*</span></label>
                                    <input type="number" name="total_adults"
                                        class="form-control @error('total_adults')
                                        is-invalid
                                    @enderror"
                                        id="total_adults" value="{{ $booking->total_adults }}">
                                    @error('total_adults')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="total_children">Total Children <span class="text-danger">*</span></label>
                                    <input type="number" name="total_children"
                                        class="form-control @error('total_children')
                                        is-invalid
                                    @enderror"
                                        id="total_children" value="{{ $booking->total_children }}">
                                    @error('total_children')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
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
