@extends('backend.layouts.master')

@section('title', 'Create Consultation')

@push('backend_style')
    @include('backend.pages.common.style')
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Create Consultation</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <a href="{{ route('service_consultations.index') }}" class="btn btn-info">Back</a>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('service_consultations.store') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" required>
                                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" required>
                                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Phone</label>
                                <input type="text" name="phone" value="{{ old('phone') }}" class="form-control @error('phone') is-invalid @enderror" required>
                                @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Company Name</label>
                                <input type="text" name="company_name" value="{{ old('company_name') }}" class="form-control @error('company_name') is-invalid @enderror">
                                @error('company_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Service</label>
                                <select name="service_id" class="form-control @error('service_id') is-invalid @enderror" required>
                                    <option value="">Choose service</option>
                                    @foreach($services as $service)
                                        <option value="{{ $service->id }}" {{ old('service_id') == $service->id ? 'selected' : '' }}>{{ $service->title }}</option>
                                    @endforeach
                                </select>
                                @error('service_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Timeslot</label>
                                <select name="timeslot_id" class="form-control @error('timeslot_id') is-invalid @enderror" required>
                                    <option value="">Choose timeslot</option>
                                    @foreach($timeslots as $timeslot)
                                        <option value="{{ $timeslot->id }}" {{ old('timeslot_id') == $timeslot->id ? 'selected' : '' }}>{{ $timeslot->label }}</option>
                                    @endforeach
                                </select>
                                @error('timeslot_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Expected Timeline</label>
                                <input type="text" name="expected_timeline" value="{{ old('expected_timeline') }}" class="form-control @error('expected_timeline') is-invalid @enderror">
                                @error('expected_timeline')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <div class="form-check mt-4">
                                    <input type="checkbox" name="is_active" class="form-check-input" id="is_active" value="1" {{ old('is_active') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_active">Active</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Project Requirement</label>
                                <textarea name="project_requirement" rows="5" class="form-control @error('project_requirement') is-invalid @enderror" required>{{ old('project_requirement') }}</textarea>
                                @error('project_requirement')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-4">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
