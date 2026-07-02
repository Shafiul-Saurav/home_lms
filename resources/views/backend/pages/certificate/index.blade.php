@extends('backend.layouts.master')

@section('title', 'Certificates Management')

@push('backend_style')
    @include('backend.pages.common.style')
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Certificate Requests</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Certificates</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h3 class="card-title">All Certificate Requests</h3>
                </div>
                <div class="card-body">
                    @if($certificates->count() > 0)
                        <div class="table-responsive export-table">
                            <table id="file-datatable" class="table table-bordered text-nowrap key-buttons border-bottom w-100">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Student Name</th>
                                        <th>Course Name</th>
                                        <th>Status</th>
                                        <th>Certificate Number</th>
                                        <th>Issued Date</th>
                                        <th>Requested Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($certificates as $certificate)
                                        <tr>
                                            <td><strong>{{ $certificates->firstItem() + $loop->index }}</strong></td>
                                            <td>{{ $certificate->user->name ?? 'N/A' }}</td>
                                            <td>{{ $certificate->course->title ?? 'N/A' }}</td>
                                            <td>
                                                @if($certificate->status === 'pending')
                                                    <span class="badge bg-warning">Pending</span>
                                                @elseif($certificate->status === 'approved')
                                                    <span class="badge bg-success">Approved</span>
                                                @else
                                                    <span class="badge bg-danger">Rejected</span>
                                                @endif
                                            </td>
                                            <td>{{ $certificate->certificate_number ?? '-' }}</td>
                                            <td>{{ $certificate->issued_date ? $certificate->issued_date->format('d M, Y') : '-' }}</td>
                                            <td>{{ $certificate->created_at->format('d M, Y') }}</td>
                                            <td class="text-center">
                                                <div class="action-btns d-flex align-items-center justify-content-center gap-2">
                                                    <a href="{{ route('certificates.show', $certificate->id) }}"
                                                        class="btn btn-sm btn-outline-primary border">
                                                        <i class="fa-solid fa-eye"></i> View
                                                    </a>
                                                    @if($certificate->status === 'pending')
                                                        <form action="{{ route('certificates.approve', $certificate->id) }}" method="POST" style="display: inline;">
                                                            @csrf
                                                            <button type="submit" class="btn btn-sm btn-outline-success border">
                                                                <i class="fa-solid fa-check"></i> Approve
                                                            </button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-center mt-3">
                            {{ $certificates->links() }}
                        </div>
                    @else
                        <div class="alert alert-info text-center">
                            <h5>No Certificate Requests</h5>
                            <p>No certificate requests found at this time.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @push('backend_script')
        @include('backend.pages.common.script')
    @endpush
@endsection
