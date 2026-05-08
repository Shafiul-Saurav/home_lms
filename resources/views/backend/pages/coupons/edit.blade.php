@extends('backend.layouts.master')

@section('title', 'Edit Coupon')

@push('backend_style')
    @include('backend.pages.common.style')
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Edit Coupon</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Coupons</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <h3 class="card-title">Update Coupon</h3>
                    <a href="{{ route('coupons.index') }}" class="btn btn-info"><i class="fa-solid fa-angles-left fa-fw"></i>
                        Back</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('coupons.update', $coupon->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="code">Coupon Code</label>
                                    <input type="text" name="code" class="form-control @error('code')
                                        is-invalid
                                    @enderror" id="code"
                                        value="{{ $coupon->code }}" required>
                                    @error('code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="discount_type">Discount Type</label>
                                    <select name="discount_type" id="discount_type" class="form-control @error('discount_type') is-invalid @enderror" required>
                                        <option value="">Select Discount Type</option>
                                        <option value="flat" {{ $coupon->discount_type == 'flat' ? 'selected' : '' }}>Flat Amount</option>
                                        <option value="percentage" {{ $coupon->discount_type == 'percentage' ? 'selected' : '' }}>Percentage</option>
                                    </select>
                                    @error('discount_type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="discount_value">Discount Value</label>
                                    <input type="number" step="0.01" name="discount_value" class="form-control @error('discount_value')
                                        is-invalid
                                    @enderror" id="discount_value"
                                        value="{{ $coupon->discount_value }}" required>
                                    @error('discount_value')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="start_date">Start Date</label>
                                    <input type="date" name="start_date" class="form-control @error('start_date')
                                        is-invalid
                                    @enderror" id="start_date"
                                        value="{{ $coupon->start_date->format('Y-m-d') }}" required>
                                    @error('start_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="end_date">End Date</label>
                                    <input type="date" name="end_date" class="form-control @error('end_date')
                                        is-invalid
                                    @enderror" id="end_date"
                                        value="{{ $coupon->end_date->format('Y-m-d') }}" required>
                                    @error('end_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="usage_limit">Usage Limit (Leave blank for unlimited)</label>
                                    <input type="number" name="usage_limit" class="form-control @error('usage_limit')
                                        is-invalid
                                    @enderror" id="usage_limit"
                                        value="{{ $coupon->usage_limit }}">
                                    @error('usage_limit')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="form-check">
                                    <input type="checkbox" name="is_active" class="form-check-input" id="is_active" value="1" {{ $coupon->is_active ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_active">Active</label>
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
@endpush
