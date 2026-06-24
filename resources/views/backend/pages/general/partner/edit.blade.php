@extends('backend.layouts.master')

@section('title', 'Edit Partner')

@push('backend_style')
@include('backend.pages.common.style')
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Edit Partner</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('partners.index') }}">Partners</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h3 class="card-title">Edit Partner</h3>
                </div>
                <div class="card-body">

                    <form action="{{ route('partners.update', $partner->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="partner_image">Partner Logo Image</label>
                                    <input type="file" class="form-control" name="partner_image" id="partner_image">
                                    @if($partner->partner_image && $partner->partner_image != 'default_partner.jpg')
                                        <div class="mt-2">
                                            <img src="{{ asset('uploads/partners/' . $partner->partner_image) }}" alt="Current Logo" style="height:80px;">
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="is_active" id="is_active" {{ $partner->is_active ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_active">Active</label>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Partner</button>
                        <a href="{{ route('partners.index') }}" class="btn btn-secondary ms-2">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('backend_script')
@include('backend.pages.common.script')
@endpush
