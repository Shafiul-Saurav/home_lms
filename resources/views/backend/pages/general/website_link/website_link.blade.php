@extends('backend.layouts.master')

@section('title', 'Website Links')

@push('backend_style')
@include('backend.pages.common.style')
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Website Links</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Website Links</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <h3 class="card-title">Website Links Setting</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('website_link.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" class="form-control" id="email" value="{{ old('email', $website_link->email ?? '') }}">
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="facebook">Facebook</label>
                                    <input type="text" name="facebook" class="form-control" id="facebook" value="{{ old('facebook', $website_link->facebook ?? '') }}">
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="instagram">Instagram</label>
                                    <input type="text" name="instagram" class="form-control" id="instagram" value="{{ old('instagram', $website_link->instagram ?? '') }}">

                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="linkedIn">LinkedIn</label>
                                    <input type="text" name="linkedIn" class="form-control" id="linkedIn" value="{{ old('linkedIn', $website_link->linkedIn ?? '') }}">
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="twitter">Twitter</label>
                                    <input type="text" name="twitter" class="form-control" id="twitter" value="{{ old('twitter', $website_link->twitter ?? '') }}">
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="youtube">Youtube</label>
                                    <input type="text" name="youtube" class="form-control" id="youtube" value="{{ old('youtube', $website_link->youtube ?? '') }}">
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="number">Phone Number</label>
                                    <input type="tel" name="number" class="form-control" id="number" value="{{ old('number', $website_link->number ?? '') }}">
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <textarea name="address" class="form-control" id="address" cols="30" rows="5">{{ old('address', $website_link->address ?? '') }}</textarea>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="map_link">Map Link</label>
                                    <textarea name="map_link" class="form-control" id="map_link" cols="30" rows="5">{{ old('map_link', $website_link->map_link ?? '') }}</textarea>
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
