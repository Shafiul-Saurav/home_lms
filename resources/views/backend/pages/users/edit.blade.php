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
                        <li class="breadcrumb-item active" aria-current="page">User Edit</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <h3 class="card-title">Update User</h3>
                    <a href="{{ route('users.index') }}" class="btn btn-info"><i class="fa-solid fa-angles-left fa-fw"></i> Back</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('users.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')
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
                                            <option value="{{ $role->id }}" @if ($user->role_id == $role->id)
                                                selected
                                            @endif>{{ $role->role_name }}</option>
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
                                        @enderror" value="{{ $user->name }}" placeholder="Enter User Name" disabled>
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
                                            value="{{ $user->email }}" placeholder="Enter User Email" disabled>
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
                                            aria-describedby="basic-default-password" disabled>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-secondary" type="submit">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Row -->
@endsection

@push('backend_script')
    @include('backend.pages.common.script')

@endpush
