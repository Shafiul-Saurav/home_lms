@extends('backend.layouts.master')

@section('title', 'Instructor Request Details')

@push('backend_style')
    @include('backend.pages.common.style')
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Instructor Request Details</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('instructor-requests.index') }}">Instructor Requests</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Details</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row row-sm">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header border-bottom">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="card-title">Request Information</h3>
                        <span class="status-badge status-{{ $request->status }}">{{ ucfirst($request->status) }}</span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive export-table">
                        <table class="table table-bordered text-nowrap key-buttons border-bottom w-100">
                            <tbody>
                                <tr>
                                    <th>Name</th>
                                    <td>{{ $request->user->name }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ $request->user->email }}</td>
                                </tr>
                                <tr>
                                    <th>Phone</th>
                                    <td>{{ $request->user->phone ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Requested Date</th>
                                    <td>{{ $request->requested_at->format('d M Y, h:i A') }}</td>
                                </tr>
                                <tr>
                                    <th>Bio</th>
                                    <td style="white-space: pre-line; word-break: break-word; overflow-wrap: anywhere;">
                                        {{ $request->bio }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Qualification</th>
                                    <td style="white-space: pre-line; word-break: break-word; overflow-wrap: anywhere;">
                                        {{ $request->qualification }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>
                                        @if($request->status === 'pending')
                                            <span class="badge bg-warning">Pending</span>
                                        @elseif($request->status === 'approved')
                                            <span class="badge bg-success">Approved</span>
                                        @elseif($request->status === 'rejected')
                                            <span class="badge bg-danger">Rejected</span>
                                        @endif
                                    </td>
                                </tr>
                                @if($request->status === 'approved')
                                    <tr>
                                        <th>Approved By</th>
                                        <td>{{ $request->approvedBy->name ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Approved Date</th>
                                        <td>{{ $request->approved_at?->format('d M Y, h:i A') ?? 'N/A' }}</td>
                                    </tr>
                                @elseif($request->status === 'rejected')
                                    <tr>
                                        <th>Rejection Reason</th>
                                        <td>{{ $request->rejection_reason ?? 'No reason provided' }}</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                    @if($request->status === 'pending')
                        <div class="action-buttons">
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#approveModal">
                                <i class="fa-solid fa-check"></i> Approve Request
                            </button>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#rejectModal">
                                <i class="fa-solid fa-times"></i> Reject Request
                            </button>
                        </div>
                    @else
                        <div class="action-buttons">
                            <a href="{{ route('instructor-requests.index') }}" class="btn btn-secondary">
                                <i class="fa-solid fa-arrow-left"></i> Back to List
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header border-bottom">
                    <h3 class="card-title">Profile Completion</h3>
                </div>
                <div class="card-body">
                    @php
                        $completionPercentage = $request->user->profileCompletionPercentage();
                    @endphp
                    <div style="text-align: center;">
                        <div style="font-size: 32px; font-weight: bold; color: #76bd10; margin-bottom: 10px;">
                            {{ $completionPercentage }}%
                        </div>
                        <div style="width: 100%; height: 10px; background-color: #e0e0e0; border-radius: 5px; overflow: hidden;">
                            <div style="height: 100%; background-color: #76bd10; width: {{ $completionPercentage }}%;">
                            </div>
                        </div>
                        <p style="margin-top: 15px; color: #666;">Profile Completion</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Approve Modal -->
    <div class="modal fade" id="approveModal" tabindex="-1" role="dialog" aria-labelledby="approveModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="approveModalLabel">Approve Instructor Request</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('instructor-requests.approve', $request->id) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <p>Are you sure you want to approve this instructor request?</p>
                        <p style="color: #666; font-size: 14px; margin-top: 15px;">
                            <strong>{{ $request->user->name }}</strong> will be converted to an instructor and will have access to the admin dashboard with limited permissions.
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success" style="background-color: #76bd10; border-color: #76bd10;">
                            <i class="fa-solid fa-check"></i> Approve
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Reject Modal -->
    <div class="modal fade" id="rejectModal" tabindex="-1" role="dialog" aria-labelledby="rejectModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="rejectModalLabel">Reject Instructor Request</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('instructor-requests.reject', $request->id) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <p>Please provide a reason for rejecting this request:</p>
                        <textarea name="rejection_reason" class="form-control" rows="4" placeholder="Enter rejection reason..." required></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">
                            <i class="fa-solid fa-times"></i> Reject
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('backend_script')
    @include('backend.pages.common.script')
@endpush
