@extends('backend.layouts.master')

@section('title', 'PDF Book Order')

@push('backend_style')
    @include('backend.pages.common.style')
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">PDF Book Order</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">PDF Book Order Edit</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <h3 class="card-title">Update PDF Book Order</h3>
                    <a href="{{ route('orders.pdfbookorders') }}" class="btn btn-outline-info border"><i class="fa-solid fa-angles-left fa-fw"></i> Back</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('orders.pdfbookorders.update', $order->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Order Number</label>
                                    <input type="text" class="form-control" value="{{ $order->order_number }}" readonly>
                                </div>
                            </div>

                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label class="form-label">User</label>
                                    <input type="text" class="form-control" value="{{ optional($order->user)->name ?? $order->name }}" readonly>
                                </div>
                            </div>

                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label class="form-label">PDF Book</label>
                                    <input type="text" class="form-control" value="{{ optional($order->pdfBook)->name ?? optional($order->pdfBook)->title ?? '-' }}" readonly>
                                </div>
                            </div>

                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label class="form-label" for="payment_status">Payment Status</label>
                                    <select id="payment_status" name="payment_status" class="form-control @error('payment_status') is-invalid @enderror" required>
                                        <option value="Pending" {{ $order->payment_status === 'Pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="Completed" {{ $order->payment_status === 'Completed' ? 'selected' : '' }}>Completed</option>
                                        <option value="Failed" {{ $order->payment_status === 'Failed' ? 'selected' : '' }}>Failed</option>
                                        <option value="Cancelled" {{ $order->payment_status === 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                    @error('payment_status')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
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
@endpush
