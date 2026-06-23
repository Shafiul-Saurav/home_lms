@extends('backend.layouts.master')

@section('title', 'Instructor Withdrawal Requests')

@push('backend_style')
    @include('backend.pages.common.style')
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Instructor Withdrawal Requests</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Withdrawal Requests</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive export-table">
                        <table id="file-datatable" class="table table-bordered text-nowrap key-buttons border-bottom w-100">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Instructor</th>
                                    <th>Email</th>
                                    <th class="text-end">Amount</th>
                                    <th>Account Name</th>
                                    <th>Account Number</th>
                                    <th>Account Details</th>
                                    <th>Note</th>
                                    <th>Status</th>
                                    <th>Requested At</th>
                                    <th>Processed At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($withdrawals as $withdrawal)
                                    <tr>
                                        <td>{{ $loop->iteration + ($withdrawals->currentPage() - 1) * $withdrawals->perPage() }}</td>
                                        <td>{{ $withdrawal->teacher?->user?->name ?? 'N/A' }}</td>
                                        <td>{{ $withdrawal->user?->email ?? 'N/A' }}</td>
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
                                        <td>
                                            @if ($withdrawal->status === 'pending')
                                                <form action="{{ route('instructor.withdrawals.approve', $withdrawal->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-success">Approve</button>
                                                </form>
                                                <form action="{{ route('instructor.withdrawals.reject', $withdrawal->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-danger">Reject</button>
                                                </form>
                                            @else
                                                <span class="text-muted">No action</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="12" class="text-center">No withdrawal requests found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('backend_script')
    @include('backend.pages.common.script')
@endpush