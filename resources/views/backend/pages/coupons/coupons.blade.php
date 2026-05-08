@extends('backend.layouts.master')

@section('title', 'Coupons')

@push('backend_style')
    @include('backend.pages.common.style')
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Coupons</h1>
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
                    <h3 class="card-title">Create Coupon</h3>
                    {{-- @can('delete-coupon') --}}
                    <a href="{{ route('coupons.trash') }}" class="btn btn-sm btn-outline-warning border"><i
                            class="fa-solid fa-trash-can-arrow-up fa-fw"></i> View Trash</a>
                    {{-- @endcan --}}
                </div>
                <div class="card-body">
                    <form action="{{ route('coupons.store') }}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="code">Coupon Code</label>
                                    <input type="text" name="code" class="form-control @error('code') is-invalid @enderror" id="code"
                                        value="{{ old('code') }}" required>
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
                                        <option value="flat" {{ old('discount_type') == 'flat' ? 'selected' : '' }}>Flat Amount</option>
                                        <option value="percentage" {{ old('discount_type') == 'percentage' ? 'selected' : '' }}>Percentage</option>
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
                                    <input type="number" step="0.01" name="discount_value" class="form-control @error('discount_value') is-invalid @enderror" id="discount_value"
                                        value="{{ old('discount_value') }}" required>
                                    @error('discount_value')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label" for="start_date">Start Date</label>
                                    <div class="input-group">
                                        <div class="input-group-text bg-primary-transparent text-primary">
                                            <i class="fa-solid fa-calendar-days"></i>
                                        </div>
                                        <input class="form-control fc-datepicker @error('start_date') is-invalid @enderror" placeholder="DD/MM/YYYY" type="text"
                                            value="{{ old('start_date_display') }}" id="start_date_display">
                                        <input type="hidden" name="start_date" id="start_date" value="{{ old('start_date') }}">
                                    </div>
                                    @error('start_date')
                                        <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label" for="end_date">End Date</label>
                                    <div class="input-group">
                                        <div class="input-group-text bg-primary-transparent text-primary">
                                            <i class="fa-solid fa-calendar-days"></i>
                                        </div>
                                        <input class="form-control fc-datepicker @error('end_date') is-invalid @enderror" placeholder="DD/MM/YYYY" type="text"
                                            value="{{ old('end_date_display') }}" id="end_date_display">
                                        <input type="hidden" name="end_date" id="end_date" value="{{ old('end_date') }}">
                                    </div>
                                    @error('end_date')
                                        <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="usage_limit">Usage Limit (Leave blank for unlimited)</label>
                                    <input type="number" name="usage_limit" class="form-control @error('usage_limit') is-invalid @enderror" id="usage_limit"
                                        value="{{ old('usage_limit') }}">
                                    @error('usage_limit')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            {{-- <div class="col-md-12 mb-3">
                                <div class="form-check">
                                    <input type="checkbox" name="is_active" class="form-check-input" id="is_active" value="1" {{ old('is_active') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_active">Active</label>
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
                    <h3 class="card-title">Coupon List</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive export-table">
                        <table id="file-datatable" class="table table-bordered text-nowrap key-buttons border-bottom w-100">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">Code</th>
                                    <th class="border-bottom-0">Discount</th>
                                    <th class="border-bottom-0">Valid From</th>
                                    <th class="border-bottom-0">Valid Until</th>
                                    <th class="border-bottom-0">Usage</th>
                                    <th class="border-bottom-0">Status</th>
                                    {{-- @canany(['edit-coupon', 'delete-coupon']) --}}
                                    <th class="border-bottom-0">Actions</th>
                                    {{-- @endcanany --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($coupons as $coupon)
                                    <tr>
                                        <td>
                                            <strong>{{ $coupons->firstItem() + $loop->index }}</strong>
                                        </td>
                                        <td>{{ $coupon->code }}</td>
                                        <td>
                                            @if($coupon->discount_type === 'flat')
                                                ${{ number_format($coupon->discount_value, 2) }}
                                            @else
                                                {{ number_format($coupon->discount_value, 2) }}%
                                            @endif
                                        </td>
                                        <td>{{ $coupon->start_date->format('d-M-Y') }}</td>
                                        <td>{{ $coupon->end_date->format('d-M-Y') }}</td>
                                        <td>
                                            @if($coupon->usage_limit)
                                                {{ $coupon->used_count }}/{{ $coupon->usage_limit }}
                                            @else
                                                {{ $coupon->used_count }}/Unlimited
                                            @endif
                                        </td>
                                        {{-- @can('edit-coupon') --}}
                                        <td>
                                            <div class="material-switch">
                                                <input id="active-{{ $coupon->id }}" class="toggle-class-active" name="is_active"
                                                    type="checkbox" {{ $coupon->is_active ? 'checked' : '' }}
                                                    data-id="{{ $coupon->id }}">
                                                <label for="active-{{ $coupon->id }}" class="label-success"></label>
                                            </div>
                                        </td>
                                        {{-- @endcan --}}
                                        {{-- @canany(['edit-coupon', 'delete-coupon']) --}}
                                        <td class="text-center">
                                            <div class="action-btns d-flex align-items-center">
                                                <div>
                                                    <a href="{{ route('coupons.show', $coupon->id) }}" class="btn btn-sm btn-outline-primary border me-2"
                                                        data-toggle="tooltip" data-placement="top"
                                                        data-bs-original-title="View">
                                                        <i class="fa-solid fa-eye"></i>
                                                    </a>
                                                </div>
                                                {{-- @can('edit-coupon') --}}
                                                <div>
                                                    <a href="{{ route('coupons.edit', $coupon->id) }}" class="btn btn-sm btn-outline-info border me-2"
                                                        data-toggle="tooltip" data-placement="top"
                                                        data-bs-original-title="Edit">
                                                        <i class="fa-solid fa-edit"></i>
                                                    </a>
                                                </div>
                                                {{-- @endcan --}}
                                                {{-- @can('delete-coupon') --}}
                                                <div>
                                                    <form action="{{ route('coupons.destroy', $coupon->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger border show_confirm" data-toggle="tooltip"
                                                        data-placement="top" data-bs-original-title="Delete">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                                {{-- @endcan --}}
                                            </div>
                                        </td>
                                        {{-- @endcanany --}}
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
            $(document).on('change', '.toggle-class-active', function() {
                var item_id = $(this).data('id');

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: `/admin/check/coupon/is_active/${item_id}`,
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
@endpush
