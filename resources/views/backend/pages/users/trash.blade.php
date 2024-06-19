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
    </div>
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <h3 class="card-title">User List</h3>
                    <a href="{{ route('users.index') }}" class="btn btn-info"><i class="fa-solid fa-angles-left fa-fw"></i> Back</a>
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
                                    {{-- @can('edit-user') --}}
                                    {{-- @endcan
                                    @can('edit-user') --}}
                                    <th class="border-bottom-0">Actions</th>
                                    {{-- @endcan --}}
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
                                        {{-- @can('delete-user') --}}
                                        <td class="text-center">
                                            <div class="action-btns d-flex align-items-center">
                                                {{-- @can('delete-user') --}}
                                                <div>
                                                    <a href="{{ route('users.restore', ['id' => $user->id]) }}"
                                                        class="btn btn-sm btn-outline-success border me-2" data-toggle="tooltip"
                                                        data-placement="top" data-bs-original-title="Restore"><i class="fa-solid fa-store"></i>
                                                    </a>
                                                </div>
                                                {{-- @endcan
                                                @can('delete-user') --}}
                                                <div>
                                                    <form action="{{ route('users.forcedelete', ['id' => $user->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger border show_confirm" data-toggle="tooltip"
                                                        data-placement="top" data-bs-original-title="Force Delete">
                                                            <i class="fa-solid fa-radiation"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                                {{-- @endcan --}}
                                            </div>
                                        </td>
                                        {{-- @endcan --}}
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
@endpush
