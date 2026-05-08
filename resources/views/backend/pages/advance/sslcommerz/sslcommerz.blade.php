@extends('backend.layouts.master')

@section('title', 'SSLCommerz Configuration')

@push('backend_style')
@include('backend.pages.common.style')
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">SSLCommerz Configuration</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">SSLCommerz Configuration</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <h3 class="card-title">SSLCommerz Settings</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('sslcommerz.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="store_id">Store ID</label>
                                    <input type="text" name="store_id" class="form-control" id="store_id" value="{{ old('store_id', $sslcommerz->store_id ?? '') }}">
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="store_password">Store Password</label>
                                    <input type="password" name="store_password" class="form-control" id="store_password" value="{{ old('store_password', $sslcommerz->store_password ?? '') }}">
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="sslcommerz_url">API URL</label>
                                    <input type="text" name="sslcommerz_url" class="form-control" id="sslcommerz_url" value="{{ old('sslcommerz_url', $sslcommerz->sslcommerz_url ?? '') }}">
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="sslcommerz_validation_url">Validation URL</label>
                                    <input type="text" name="sslcommerz_validation_url" class="form-control" id="sslcommerz_validation_url" value="{{ old('sslcommerz_validation_url', $sslcommerz->sslcommerz_validation_url ?? '') }}">
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="logo">Logo</label>
                                    <input type="file" name="logo" class="form-control" id="logo">
                                    @if(isset($sslcommerz->logo))
                                        <div class="mt-2">
                                            <img src="{{ asset('uploads/sslcommerz/' . $sslcommerz->logo) }}" alt="Logo" style="height: 50px;">
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
