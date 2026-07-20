@extends('backend.layouts.master')

@section('title', 'Instructor Requests')

@push('backend_style')
    @include('backend.pages.common.style')
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Instructor Requests</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Instructor Requests</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h3 class="card-title">Pending Instructor Requests</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive export-table">
                        <table id="file-datatable" class="table table-bordered text-nowrap key-buttons border-bottom w-100">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">Requested Date</th>
                                    <th class="border-bottom-0">Student Name</th>
                                    <th class="border-bottom-0">Student Email</th>
                                    <th class="border-bottom-0">Phone</th>
                                    <th class="border-bottom-0">Status</th>
                                    <th class="border-bottom-0">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($requests as $request)
                                    <tr>
                                        <td>
                                            <strong>{{ $requests->firstItem() + $loop->index }}</strong>
                                        </td>
                                        <td>{{ $request->requested_at->format('d-M-Y') }}</td>
                                        <td>{{ $request->user->name }}</td>
                                        <td>{{ $request->user->email }}</td>
                                        <td>{{ $request->user->phone ?? 'N/A' }}</td>
                                        <td>
                                            @if($request->status === 'pending')
                                                <span class="badge bg-warning">Pending</span>
                                            @elseif($request->status === 'approved')
                                                <span class="badge bg-success">Approved</span>
                                            @elseif($request->status === 'rejected')
                                                <span class="badge bg-danger">Rejected</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="action-btns d-flex align-items-center">
                                                <div>
                                                    <a href="{{ route('instructor-requests.show', $request->id) }}"
                                                        class="btn btn-sm btn-outline-info border me-2"
                                                        data-toggle="tooltip" data-placement="top"
                                                        data-bs-original-title="View Details"><i class="fa-solid fa-eye"></i>
                                                    </a>
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
    <script>
        $(document).ready(function() {
            if ($.fn.DataTable.isDataTable('#file-datatable')) {
                $('#file-datatable').DataTable().destroy();
            }

            var table = $('#file-datatable').DataTable({
            });
        });
    </script>
@endpush
