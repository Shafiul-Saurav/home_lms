@extends('backend.layouts.master')

@section('title', 'User')

@push('backend_style')
    @include('backend.pages.common.style')
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">User</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">User</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <h3 class="card-title">Create User</h3>
                    @can('delete-user')
                    <a href="{{ route('users.trash') }}" class="btn btn-sm btn-outline-warning border"><i
                            class="fa-solid fa-trash-can-arrow-up fa-fw"></i> View Trash</a>
                    @endcan
                </div>
                <div class="card-body">
                    <form action="{{ route('users.store') }}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="role_id" class="form-label">Select Role</label>
                                    <select id="role_id" name="role_id"
                                        class="form-control select2 form-select select2-hidden-accessible
                                    @error('role_id')
                                        is-invalid
                                    @enderror">
                                        <option selected>Choose a Role</option>
                                        @forelse ($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->role_name }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                    @error('role_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label class="form-label" for="name">User Name</label>
                                    <div class="input-group">
                                        <input type="text" name="name" class="form-control @error('name')
                                            is-invalid
                                        @enderror" value="{{ old('name') }}" placeholder="Enter User Name">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label class="form-label" for="email">User Email</label>
                                    <div class="input-group">
                                        <input type="text" name="email"
                                            class="form-control
                                    @error('email')
                                        is-invalid
                                    @enderror"
                                            value="{{ old('email') }}" placeholder="Enter User Email">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label class="form-label" for="basic-default-password">Password</label>
                                    <div class="input-group">
                                        <input type="password" name="password"
                                            class="form-control @error('password')
                                        is-invalid
                                    @enderror"
                                            id="basic-default-password" placeholder="************" value="{{ old('password') }}"
                                            aria-describedby="basic-default-password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h3 class="card-title">User List</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive export-table">
                        <table id="file-datatable" class="table table-bordered text-nowrap key-buttons border-bottom w-100">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">Last Updated</th>
                                    {{-- <th class="border-bottom-0">Profile</th> --}}
                                    <th class="border-bottom-0">User Name</th>
                                    <th class="border-bottom-0">User Email</th>
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
                                        {{-- <td>
                                            @if ($user->adminProfileImage)
                                                <div class="avatar-container">
                                                    <img alt="avatar"
                                                        src="{{ asset($user->adminProfileImage->admin_profile_image) }}"
                                                        class="rounded-circle" style="width:30px; height: 30px">
                                                </div>
                                            @elseif ($user->profile->profileImage??null)
                                                <div class="avatar-container">
                                                    <img alt="avatar"
                                                        src="{{ asset($user->profile->profileImage->profile_image??null) }}"
                                                        class="rounded-circle" style="width:30px; height: 30px">
                                                </div>
                                            @else
                                                <div class="avatar-container">
                                                    <img alt="avatar" src="{{ asset('profile/default_profile.png') }}"
                                                    class="rounded-circle" style="width:30px; height: 30px">
                                                </div>
                                            @endif
                                        </td> --}}
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
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
                                                {{-- @can('edit-user') --}}
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
                                                {{-- @endcan --}}
                                                {{-- @can('delete-user') --}}
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
                                                {{-- @endcan --}}
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
