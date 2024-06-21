@extends('backend.layouts.master')

@section('title', 'Copyright')

@push('backend_style')
@include('backend.pages.common.style')
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Copyright</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Copyright</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <h3 class="card-title">Copyright Setting</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('copyright.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="title">Copyright Title</label>
                                    <input type="text" name="title" class="form-control" id="title" value="{{ old('title', $copyright->title ?? '') }}">
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="description">Copyright Description</label>
                                    <textarea name="description" class="form-control" id="description" cols="30" rows="5">{{ old('description', $copyright->description ?? '') }}</textarea>
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
