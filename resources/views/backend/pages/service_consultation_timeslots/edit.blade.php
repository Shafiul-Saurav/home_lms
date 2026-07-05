@extends('backend.layouts.master')

@section('title', 'Edit Timeslot')

@push('backend_style')
    @include('backend.pages.common.style')
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Edit Timeslot</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <a href="{{ route('service_consultation_timeslots.index') }}" class="btn btn-info">Back</a>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('service_consultation_timeslots.update', $timeslot->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Label</label>
                                <input type="text" name="label" value="{{ old('label', $timeslot->label) }}" class="form-control @error('label') is-invalid @enderror" required>
                                @error('label')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            {{-- <div class="col-md-3">
                                <label class="form-label">Start Time</label>
                                <input type="time" name="start_time" value="{{ old('start_time', $timeslot->start_time) }}" class="form-control @error('start_time') is-invalid @enderror" required>
                                @error('start_time')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">End Time</label>
                                <input type="time" name="end_time" value="{{ old('end_time', $timeslot->end_time) }}" class="form-control @error('end_time') is-invalid @enderror" required>
                                @error('end_time')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div> --}}
                            {{-- <div class="col-md-6 mt-4">
                                <div class="form-check">
                                    <input type="checkbox" name="is_active" class="form-check-input" id="is_active" value="1" {{ old('is_active', $timeslot->is_active) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_active">Active</label>
                                </div>
                            </div> --}}
                        </div>
                        <button type="submit" class="btn btn-primary mt-4">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
