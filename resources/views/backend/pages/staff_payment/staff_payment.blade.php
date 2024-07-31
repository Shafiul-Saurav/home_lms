@extends('backend.layouts.master')

@section('title', 'Staff Payment')

@push('backend_style')
    @include('backend.pages.common.style')
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Staff Payment</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Staff Payment</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <h3 class="card-title">Create Staff</h3>
                    <a href="{{ route('staffs.index') }}" class="btn btn-outline-info border"><i class="fa-solid fa-angles-left fa-fw"></i> Back</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('staff.payment.save', $stuff->id) }}" method="POST">
                        @csrf
                        {{-- @method('PUT') --}}
                        <div class="form-row">
                            <input type="hidden" name="staff_id" value="{{ $stuff->id }}">
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="amount">Salary Amount</label>
                                    <input type="number" name="amount" class="form-control @error('amount')
                                        is-invalid
                                    @enderror" id="amount"
                                        value="{{ old('amount') }}" required>
                                    @error('amount')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="payment_date">Payment Date</label>
                                    <input type="date" name="payment_date" class="form-control @error('payment_date')
                                        is-invalid
                                    @enderror" id="payment_date"
                                        value="{{ old('payment_date') }}" required>
                                    @error('payment_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary" type="submit">Add Payment</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h3 class="card-title">Staff List</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive export-table">
                        <table id="file-datatable" class="table table-bordered text-nowrap key-buttons border-bottom w-100">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">Last Updated</th>
                                    <th class="border-bottom-0">Staff Name</th>
                                    <th class="border-bottom-0">Staff Image</th>
                                    <th class="border-bottom-0">Salary Amount</th>
                                    <th class="border-bottom-0">Payment Date</th>
                                    <th class="border-bottom-0">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($stuffPayments as $payment)
                                    <tr>
                                        <td>
                                            <strong>{{ $stuffPayments->firstItem() + $loop->index }}</strong>
                                        </td>
                                        <td>{{ $payment->updated_at->format('d-M-Y') }}</td>
                                        <td>{{ $payment->staff->full_name}}</td>
                                        <td>
                                            <img src="{{ asset('uploads/stuffs') }}/{{ $payment->staff->stuff_image }}" alt="" style="height: 100px">
                                        </td>
                                        <td>{{ $payment->amount }}</td>
                                        <td>{{ $payment->payment_date }}</td>
                                        <td class="text-center">
                                            <div class="action-btns d-flex align-items-center">
                                                <div>
                                                    <form action="{{ route('staff.payment.delete', ['id' => $payment->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-sm btn-outline-warning border show_confirm"
                                                            data-toggle="tooltip" data-placement="top"
                                                            data-bs-original-title="Delete">
                                                            <i class="fa-solid fa-trash-can fa-fw"></i>
                                                        </button>
                                                    </form>
                                                </div>
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
@endpush
