@extends('backend.layouts.master')

@section('title', 'My Withdrawal Requests')

@push('backend_style')
    @include('backend.pages.common.style')
@endpush

@section('backend_content')
    @php
        $availableBalance = $withdrawalSummary['available_balance'] ?? 0;
    @endphp

    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">My Withdrawal Requests</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('instructor.earnings') }}">My Earnings</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Withdrawal Requests</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <p class="text-muted mb-1">Available Balance</p>
                    <h3 class="mb-0 fw-bold text-success">{{ number_format($availableBalance, 2) }} ৳</h3>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <p class="text-muted mb-1">Pending Requests</p>
                    <h3 class="mb-0 fw-bold text-warning">{{ number_format($withdrawalSummary['pending_amount'] ?? 0, 2) }} ৳</h3>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <p class="text-muted mb-1">Requested Total</p>
                    <h3 class="mb-0 fw-bold text-primary">{{ number_format($withdrawalSummary['requested_amount'] ?? 0, 2) }} ৳</h3>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0"><i class="fa-solid fa-clock-rotate-left me-2 text-primary"></i>My Withdrawal Requests</h3>
                    <a href="{{ route('instructor.earnings') }}" class="btn btn-sm btn-outline-primary">
                        <i class="fa-solid fa-arrow-left me-1"></i>Back to Earnings
                    </a>
                </div>
                <div class="card-body">
                    @if ($withdrawals->count() > 0)
                        <div class="table-responsive export-table">
                            <table id="file-datatable" class="table table-bordered text-nowrap key-buttons border-bottom w-100">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th class="text-end">Amount</th>
                                        <th>Account Name</th>
                                        <th>Account Number</th>
                                        <th>Account Details</th>
                                        <th>Note</th>
                                        <th>Status</th>
                                        <th>Requested At</th>
                                        <th>Processed At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($withdrawals as $withdrawal)
                                        <tr>
                                            <td>{{ $loop->iteration + ($withdrawals->currentPage() - 1) * $withdrawals->perPage() }}</td>
                                            <td class="text-end fw-bold">{{ number_format($withdrawal->amount, 2) }} ৳</td>
                                            <td>{{ $withdrawal->account_name ?: '-' }}</td>
                                            <td>{{ $withdrawal->account_number ?: '-' }}</td>
                                            <td>{{ $withdrawal->account_details ?: '-' }}</td>
                                            <td>{{ $withdrawal->note ?: '-' }}</td>
                                            <td>
                                                @if ($withdrawal->status === 'pending')
                                                    <span class="badge bg-warning text-dark">Pending</span>
                                                @elseif ($withdrawal->status === 'approved')
                                                    <span class="badge bg-success">Approved</span>
                                                @else
                                                    <span class="badge bg-danger">Rejected</span>
                                                @endif
                                            </td>
                                            <td>{{ $withdrawal->requested_at?->format('Y-m-d H:i') ?? '-' }}</td>
                                            <td>{{ $withdrawal->processed_at?->format('Y-m-d H:i') ?? '-' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-3">
                            {{ $withdrawals->links() }}
                        </div>
                    @else
                        <div class="alert alert-info mb-0" role="alert">
                            <h5 class="alert-heading fw-bold"><i class="fa-solid fa-circle-info me-2"></i>No Withdrawal Requests Yet</h5>
                            <p class="mb-0">Once you submit a request, it will appear here with its status and processing history.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('backend_script')
    @include('backend.pages.common.script')
@endpush