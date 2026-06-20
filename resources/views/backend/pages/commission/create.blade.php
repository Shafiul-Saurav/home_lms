@extends('backend.layouts.master')

@section('title', 'Create Instructor Commission')

@push('backend_style')
    @include('backend.pages.common.style')
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Instructor Commissions</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('commissions.index') }}">Instructor Commissions</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <h3 class="card-title">Create Commission Proposal</h3>
                    <a href="{{ route('commissions.index') }}" class="btn btn-info">
                        <i class="fa-solid fa-angles-left fa-fw"></i>Back
                    </a>
                </div>
                <div class="card-body">
                    <form action="{{ route('commissions.store') }}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="col-6 mb-3">
                                <div class="form-group">
                                    <label for="teacher_id">Instructor</label>
                                    <select name="teacher_id" id="teacher_id"
                                        class="form-control select2-style1 @error('teacher_id') is-invalid @enderror"
                                        required>
                                        <option value="">Select Instructor</option>
                                        @foreach ($teachers as $teacher)
                                            <option value="{{ $teacher->id }}"
                                                {{ old('teacher_id') == $teacher->id ? 'selected' : '' }}>
                                                {{ $teacher->user->name ?? 'N/A' }}{{ $teacher->user?->email ? ' - ' . $teacher->user->email : '' }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('teacher_id')
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6 mb-3">
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" id="status"
                                        class="form-control @error('status') is-invalid @enderror" required>
                                        @foreach (['pending' => 'Pending', 'approved' => 'Approved', 'rejected' => 'Rejected'] as $value => $label)
                                            <option value="{{ $value }}"
                                                {{ old('status', 'pending') === $value ? 'selected' : '' }}>
                                                {{ $label }}</option>
                                        @endforeach
                                    </select>
                                    @error('status')
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4 mb-3">
                                <div class="form-group">
                                    <label for="admin_percentage">Admin Percentage</label>
                                    <input type="number" name="admin_percentage"
                                        class="form-control @error('admin_percentage') is-invalid @enderror"
                                        id="admin_percentage" value="{{ old('admin_percentage', '30.00') }}" min="0"
                                        max="100" step="0.01" required>
                                    @error('admin_percentage')
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4 mb-3">
                                <div class="form-group">
                                    <label for="gateway_percentage">Gateway Percentage</label>
                                    <input type="number" name="gateway_percentage"
                                        class="form-control @error('gateway_percentage') is-invalid @enderror"
                                        id="gateway_percentage" value="{{ old('gateway_percentage', '2.50') }}"
                                        min="0" max="100" step="0.01" required>
                                    @error('gateway_percentage')
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4 mb-3">
                                <div class="form-group">
                                    <label for="instructor_percentage">Instructor Net Percentage</label>
                                    <input type="text" class="form-control" id="instructor_percentage" value="67.50%"
                                        readonly>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="negotiation_note">Negotiation Note</label>
                                    <textarea name="negotiation_note" id="negotiation_note" data-summernote rows="4"
                                        class="form-control @error('negotiation_note') is-invalid @enderror">{{ old('negotiation_note') }}</textarea>
                                    @error('negotiation_note')
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('backend_script')
    @include('backend.pages.common.script')
    @include('backend.pages.commission.script')
@endpush
