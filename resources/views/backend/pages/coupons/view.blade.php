@extends('backend.layouts.master')

@section('title', 'View Coupon')

@push('backend_style')
    @include('backend.pages.common.style')
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">View Coupon</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">View Coupon</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <h3 class="card-title">Coupon Details</h3>
                    <a href="{{ route('coupons.index') }}" class="btn btn-outline-info border"><i class="fa-solid fa-angles-left fa-fw"></i> Back</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive export-table">
                        <table class="table table-bordered text-nowrap key-buttons border-bottom w-100">
                            <tbody>
                                <tr><th colspan="2"><h3>{{ $coupon->code }}</h3></th></tr>
                                <tr>
                                    <th>Discount Type</th>
                                    <td width="80%">
                                        @if($coupon->discount_type === 'flat')
                                            Flat Amount
                                        @else
                                            Percentage
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Discount Value</th>
                                    <td width="80%">
                                        @if($coupon->discount_type === 'flat')
                                            ${{ number_format($coupon->discount_value, 2) }}
                                        @else
                                            {{ number_format($coupon->discount_value, 2) }}%
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Start Date</th>
                                    <td>{{ $coupon->start_date->format('d-M-Y') }}</td>
                                </tr>
                                <tr>
                                    <th>End Date</th>
                                    <td>{{ $coupon->end_date->format('d-M-Y') }}</td>
                                </tr>
                                <tr>
                                    <th>Usage Limit</th>
                                    <td>
                                        @if($coupon->usage_limit)
                                            {{ $coupon->usage_limit }}
                                        @else
                                            Unlimited
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Used Count</th>
                                    <td>{{ $coupon->used_count }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>
                                        @if($coupon->is_active)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Created Date</th>
                                    <td>{{ $coupon->created_at->format('d-M-Y') }}</td>
                                </tr>
                                <tr>
                                    <th>Last Updated</th>
                                    <td>{{ $coupon->updated_at->format('d-M-Y') }}</td>
                                </tr>
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
@endpush
