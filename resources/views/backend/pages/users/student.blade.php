@extends('backend.layouts.master')

@section('title', 'Student')

@push('backend_style')
    @include('backend.pages.common.style')
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Student</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Student</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h3 class="card-title">Student List</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive export-table">
                        <table id="file-datatable" class="table table-bordered text-nowrap key-buttons border-bottom w-100">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">Last Updated</th>
                                    <th class="border-bottom-0">Profile</th>
                                    <th class="border-bottom-0">Student Name</th>
                                    <th class="border-bottom-0">Student Email</th>
                                    <th class="border-bottom-0">Role</th>
                                    @can('edit-user')
                                    <th class="border-bottom-0">Status</th>
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
                                        <td>
                                            @if ($user->profile->profileImage ?? null)
                                                <img src="{{ asset($user->profile->profileImage->profile_image) }}"
                                                     alt="Profile Image"
                                                     style="height: 40px; width: 40px; border-radius: 50%; object-fit: cover;">
                                            @elseif ($user->profile_photo_path)
                                                <img src="{{ asset($user->profile_photo_path) }}"
                                                     alt="Profile Image"
                                                     style="height: 40px; width: 40px; border-radius: 50%; object-fit: cover;">
                                            @else
                                                <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center"
                                                     style="height: 40px; width: 40px;">
                                                    <i class="fa-solid fa-user text-muted"></i>
                                                </div>
                                            @endif
                                        </td>
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
                                                <div>
                                                    <a href="{{ route('users.edit', $user->id) }}"
                                                        class="btn btn-sm btn-outline-secondary border me-2"
                                                        data-toggle="tooltip" data-placement="top"
                                                        data-bs-original-title="Edit"><i
                                                            class="fa-solid fa-pen fa-fw"></i>
                                                    </a>
                                                </div>
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
            if ($.fn.DataTable.isDataTable('#file-datatable')) {
                $('#file-datatable').DataTable().destroy();
            }

            var table = $('#file-datatable').DataTable({
            });

            $(document).on('change', '.toggle-class', function() {
                var item_id = $(this).data('id');

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: `/admin/check/user/is_active/${item_id}`,
                    success: function(response) {
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
