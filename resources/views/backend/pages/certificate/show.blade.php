@extends('backend.layouts.master')

@section('title', 'Certificate Details')

@push('backend_style')
    @include('backend.pages.common.style')
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Certificate Request Details</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('certificates.index') }}">Certificates</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Details</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card">
                <div class="card-header border-bottom">
                    <h3 class="card-title">Certificate Information</h3>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p class="text-muted mb-1">Student Name</p>
                            <h5>{{ $certificate->user->name ?? 'N/A' }}</h5>
                        </div>
                        <div class="col-md-6">
                            <p class="text-muted mb-1">Student Email</p>
                            <h5>{{ $certificate->user->email ?? 'N/A' }}</h5>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p class="text-muted mb-1">Course Name</p>
                            <h5>{{ $certificate->course->title ?? 'N/A' }}</h5>
                        </div>
                        <div class="col-md-6">
                            <p class="text-muted mb-1">Course Category</p>
                            <h5>{{ $certificate->course->category->name ?? 'N/A' }}</h5>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p class="text-muted mb-1">Status</p>
                            <h5>
                                @if($certificate->status === 'pending')
                                    <span class="badge bg-warning">Pending</span>
                                @elseif($certificate->status === 'approved')
                                    <span class="badge bg-success">Approved</span>
                                @else
                                    <span class="badge bg-danger">Rejected</span>
                                @endif
                            </h5>
                        </div>
                        <div class="col-md-6">
                            <p class="text-muted mb-1">Requested On</p>
                            <h5>{{ $certificate->created_at->format('d M, Y H:i A') }}</h5>
                        </div>
                    </div>

                    @if($certificate->status === 'approved')
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p class="text-muted mb-1">Certificate Number</p>
                                <h5>{{ $certificate->certificate_number }}</h5>
                            </div>
                            <div class="col-md-6">
                                <p class="text-muted mb-1">Issued On</p>
                                <h5>{{ $certificate->issued_date->format('d M, Y') }}</h5>
                            </div>
                        </div>
                    @endif

                    @if($certificate->status === 'rejected')
                        <div class="alert alert-danger mb-3">
                            <h5 class="mb-2">Rejection Reason</h5>
                            <p class="mb-0">{{ $certificate->rejection_reason }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            @if($certificate->status === 'pending')
                <div class="card border-success">
                    <div class="card-header border-bottom bg-light">
                        <h3 class="card-title">Actions</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('certificates.approve', $certificate->id) }}" method="POST" class="mb-3">
                            @csrf
                            <button type="submit" class="btn btn-success w-100">
                                <i class="fa-solid fa-check"></i> Approve Certificate
                            </button>
                        </form>

                        <button type="button" class="btn btn-danger w-100" data-bs-toggle="modal" data-bs-target="#rejectModal">
                            <i class="fa-solid fa-times"></i> Reject Certificate
                        </button>
                    </div>
                </div>
            @else
                <div class="card border-secondary">
                    <div class="card-body text-center text-muted">
                        <i class="fa-solid fa-lock fa-2x mb-2"></i>
                        <p>This certificate has already been {{ $certificate->status }}.</p>
                    </div>
                </div>
            @endif

            <div class="card mt-3">
                <div class="card-header border-bottom">
                    <h3 class="card-title">Student Information</h3>
                </div>
                <div class="card-body">
                    <p class="mb-2"><strong>Name:</strong> {{ $certificate->user->name }}</p>
                    <p class="mb-2"><strong>Email:</strong> {{ $certificate->user->email }}</p>
                    <p class="mb-2"><strong>Phone:</strong> {{ $certificate->user->phone ?? 'N/A' }}</p>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header border-bottom">
                    <h3 class="card-title">Course Information</h3>
                </div>
                <div class="card-body">
                    <p class="mb-2"><strong>Title:</strong> {{ $certificate->course->title }}</p>
                    <p class="mb-2"><strong>Duration:</strong> {{ $certificate->course->duration ?? 'N/A' }}</p>
                    <p class="mb-2"><strong>Price:</strong> ${{ $certificate->course->price }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Reject Modal -->
    <div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="rejectModalLabel">Reject Certificate</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('certificates.reject', $certificate->id) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="rejection_reason" class="form-label">Reason for Rejection</label>
                            <textarea name="rejection_reason" id="rejection_reason"
                                class="form-control @error('rejection_reason') is-invalid @enderror"
                                rows="4" placeholder="Enter rejection reason..." required></textarea>
                            @error('rejection_reason')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Reject</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('backend_script')
        @include('backend.pages.common.script')
    @endpush
@endsection
