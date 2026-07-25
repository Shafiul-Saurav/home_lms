@extends('backend.layouts.master')

@section('title', 'Blocked Users')

@push('backend_style')
    @include('backend.pages.common.style')
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Blocked Users & IPs</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Users</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Blocked Users</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                    <h3 class="card-title"><i class="fa-solid fa-user-shield me-2 text-danger"></i> Blocked Accounts & IP List</h3>
                    <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#manualBlockModal">
                        <i class="fa-solid fa-ban me-1"></i> Block Email or IP Manually
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive export-table">
                        <table id="responsive-datatable" class="table table-bordered text-nowrap key-buttons border-bottom w-100">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">Type</th>
                                    <th class="border-bottom-0">Blocked Email / IP</th>
                                    <th class="border-bottom-0">Associated User</th>
                                    <th class="border-bottom-0">Date Blocked</th>
                                    <th class="border-bottom-0 text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($blockedEntities as $entity)
                                    <tr>
                                        <td><strong>{{ $loop->iteration }}</strong></td>
                                        <td>
                                            @if ($entity->type === 'email')
                                                <span class="badge bg-danger-transparent text-danger p-2 fs-12"><i class="fa-solid fa-envelope me-1"></i> Email</span>
                                            @else
                                                <span class="badge bg-warning-transparent text-warning p-2 fs-12"><i class="fa-solid fa-network-wired me-1"></i> IP Address</span>
                                            @endif
                                        </td>
                                        <td>
                                            <strong class="font-monospace fs-14 text-dark">{{ $entity->value }}</strong>
                                        </td>
                                        <td>
                                            @if ($entity->user)
                                                <div class="d-flex align-items-center">
                                                    <div>
                                                        <strong class="d-block text-primary">{{ $entity->user->name }}</strong>
                                                        <small class="text-muted">{{ $entity->user->email }}</small>
                                                    </div>
                                                </div>
                                            @else
                                                <span class="text-muted italic">Non-registered / Visitor</span>
                                            @endif
                                        </td>
                                        <td>{{ $entity->created_at ? $entity->created_at->format('d M Y, h:i A') : 'N/A' }}</td>
                                        <td class="text-center">
                                            <form action="{{ route('users.unblock', $entity->id) }}" method="POST" class="d-inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-success border show_confirm_unblock" 
                                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Unblock User">
                                                    <i class="fa-solid fa-lock-open me-1"></i> Unblock
                                                </button>
                                            </form>
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

    <!-- Modal for manual block -->
    <div class="modal fade" id="manualBlockModal" tabindex="-1" aria-labelledby="manualBlockModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="manualBlockModalLabel"><i class="fa-solid fa-ban text-danger me-2"></i> Block Email or IP Address</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('users.block-manual') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="block_type" class="form-label font-semibold">Block Type <span class="text-danger">*</span></label>
                            <select name="type" id="block_type" class="form-select" required>
                                <option value="email">Email Address</option>
                                <option value="ip">IP Address</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="block_value" class="form-label font-semibold">Target Value (Email or IP) <span class="text-danger">*</span></label>
                            <input type="text" name="value" id="block_value" class="form-control" placeholder="e.g. user@example.com or 192.168.1.1" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger"><i class="fa-solid fa-ban me-1"></i> Block Now</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('backend_script')
    @include('backend.pages.common.script')
    <script>
        $(document).on('click', '.show_confirm_unblock', function(e) {
            e.preventDefault();
            var form = $(this).closest('form');
            Swal.fire({
                title: 'Are you sure?',
                text: "Unblocking this email/IP will restore login access and reset failure counters.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#198754',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, Unblock!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    </script>
@endpush
