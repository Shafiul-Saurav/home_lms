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
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <h3 class="card-title">Coupon Trashed List</h3>
                    <a href="{{ route('coupons.index') }}" class="btn btn-outline-info border"><i class="fa-solid fa-angles-left fa-fw"></i> Back</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive export-table">
                        <table id="file-datatable" class="table table-bordered text-nowrap key-buttons border-bottom w-100">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">Code</th>
                                    <th class="border-bottom-0">Discount</th>
                                    <th class="border-bottom-0">Valid Until</th>
                                    <th class="border-bottom-0">Actions</th>
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
                                        <td>{{ $coupon->end_date->format('d-M-Y') }}</td>
                                        <td class="text-center">
                                            <div class="action-btns d-flex align-items-center">
                                                @can('delete-coupon')
                                                    <div>
                                                        <a href="{{ route('coupons.restore', ['id' => $coupon->id]) }}"
                                                            class="btn btn-sm btn-outline-success border me-2" data-toggle="tooltip"
                                                            data-placement="top" data-bs-original-title="Restore"><i class="fa-solid fa-rotate-left fa-fw"></i>
                                                        </a>
                                                    </div>
                                                    <div>
                                                        <form action="{{ route('coupons.forcedelete', ['id' => $coupon->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-outline-danger border show_confirm" data-toggle="tooltip"
                                                            data-placement="top" data-bs-original-title="Force Delete">
                                                                <i class="fa-solid fa-radiation"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                @endcan
                                            </div>
                                        </td>
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
            $(document).on('change', '.toggle-class', function() {
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
