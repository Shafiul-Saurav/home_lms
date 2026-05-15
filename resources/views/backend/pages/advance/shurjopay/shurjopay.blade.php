@extends('backend.layouts.master')

@section('title', 'Shurjopay Configuration')

@push('backend_style')
@include('backend.pages.common.style')
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Shurjopay Configuration</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Shurjopay Configuration</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <h3 class="card-title">Shurjopay Settings</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('shurjopay.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" name="username" class="form-control" id="username" value="{{ old('username', $shurjopay->username ?? '') }}">
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" class="form-control" id="password" value="{{ old('password', $shurjopay->password ?? '') }}">
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="store_id">Store ID</label>
                                    <input type="text" name="store_id" class="form-control" id="store_id" value="{{ old('store_id', $shurjopay->store_id ?? '') }}">
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="prefix">Prefix</label>
                                    <input type="text" name="prefix" class="form-control" id="prefix" value="{{ old('prefix', $shurjopay->prefix ?? '') }}">
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="logo">Logo</label>
                                    <input type="file" name="logo" class="form-control" id="logo">
                                    @if(isset($shurjopay->logo))
                                        <div class="mt-2">
                                            <img src="{{ asset('uploads/shurjopay/' . $shurjopay->logo) }}" alt="Logo" style="height: 50px;">
                                        </div>
                                    @endif
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
