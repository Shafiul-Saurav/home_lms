@extends('backend.layouts.master')

@section('title', 'Permission')

@push('backend_style')
    @include('backend.pages.common.style')
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Permission</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Permission Edit</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <h3 class="card-title">Update Permission</h3>
                    <a href="{{ route('permissions.index') }}" class="btn btn-outline-info border"><i class="fa-solid fa-angles-left fa-fw"></i> Back</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('permissions.update', $permission->permission_slug) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="module_id" class="form-label mb-3">Select Module</label>
                                    <select id="module_id" name="module_id" class="form-control select2 form-select select2-hidden-accessible
                                    @error('module_id')
                                        is-invalid
                                    @enderror">
                                        @forelse ($modules as $module)
                                            <option value="{{ $module->id }}" @if ($permission->module_id == $module->id)
                                                selected
                                            @endif>{{ $module->module_name }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                    @error('module_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="permission_name">Permission Name</label>
                                    <input type="text" name="permission_name" class="form-control" id="permission_name"
                                        value="{{ $permission->permission_name }}" required>
                                    @error('permission_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
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
