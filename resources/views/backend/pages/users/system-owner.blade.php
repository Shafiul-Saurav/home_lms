@extends('backend.layouts.master')

@section('title', 'System Owner Users')

@push('backend_style')
    @include('backend.pages.common.style')
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">System Owner Users</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">System Owner Users</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h3 class="card-title">System Owner User List</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive export-table">
                        <table id="file-datatable" class="table table-bordered text-nowrap key-buttons border-bottom w-100">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">Last Updated</th>
                                    <th class="border-bottom-0">User Name</th>
                                    <th class="border-bottom-0">User Email</th>
                                    <th class="border-bottom-0">Role</th>
                                    @can('edit-user')
                                    <th class="border-bottom-0">User Status</th>
                                    @endcan
                                    @canany(['edit-user', 'delete-user'])
                                    <th class="border-bottom-0">Actions</th>
                                    @endcanany
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>
                                            <strong>{{ $users->firstItem() + $loop->index }}</strong>
                                        </td>
                                        <td>{{ $user->updated_at->format('d-M-Y') }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            <span class="badge bg-primary">{{ $user->role->role_name ?? 'N/A' }}</span>
                                        </td>
                                        @can('edit-user')
                                        <td>
                                            <div class="material-switch">
                                                <input id="user-{{ $user->id }}" class="toggle-class" name="is_active" type="checkbox"
                                                       {{ $user->is_active ? 'checked' : '' }} data-id="{{ $user->id }}">
                                                <label for="user-{{ $user->id }}" class="label-success"></label>
                                            </div>
                                        </td>
                                        @endcan
                                        @canany(['edit-user', 'delete-user'])
                                        <td class="text-center">
                                            <div class="action-btns d-flex align-items-center">
                                                @if ($user->email != 'admin@admin.com')
                                                    <div>
                                                        <a href="{{ route('users.edit', $user->id) }}"
                                                            class="btn btn-sm btn-outline-secondary border me-2"
                                                            data-toggle="tooltip" data-placement="top"
                                                            data-bs-original-title="Edit"><i
                                                                class="fa-solid fa-pen fa-fw"></i>
                                                        </a>
                                                    </div>
                                                @endif
                                                @if ($user->email != 'admin@admin.com')
                                                    <div>
                                                        <form action="{{ route('users.destroy', $user->id) }}"
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
                                                @endif
                                            </div>
                                        </td>
                                        @endcanany
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
            // Check if the DataTable is already initialized and destroy it if necessary
            if ($.fn.DataTable.isDataTable('#file-datatable')) {
                $('#file-datatable').DataTable().destroy();
            }

            // Initialize the DataTable
            var table = $('#file-datatable').DataTable({
                // Your DataTable options here
            });

            // Use delegated event binding for dynamically created elements
            $(document).on('change', '.toggle-class', function() {
                var item_id = $(this).data('id');

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: `/admin/check/user/is_active/${item_id}`,
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
