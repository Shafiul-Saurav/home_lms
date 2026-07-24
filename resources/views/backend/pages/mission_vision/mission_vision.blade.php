@extends('backend.layouts.master')

@section('title', 'Mission & Vision')

@push('backend_style')
@include('backend.pages.common.style')
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Mission & Vision</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Mission & Vision</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <h3 class="card-title">Mission & Vision Setting</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('mission_vision.store') }}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="title_one">Mission Title</label>
                                    <input type="text" name="title_one" class="form-control @error('title_one') is-invalid @enderror" id="title_one" value="{{ old('title_one', $missionVision->title_one ?? '') }}" required>
                                    @error('title_one')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="description_one">Mission Description</label>
                                    <textarea name="description_one" class="form-control @error('description_one') is-invalid @enderror" id="description_one" data-summernote cols="30" rows="5">{{ old('description_one', $missionVision->description_one ?? '') }}</textarea>
                                    @error('description_one')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="title_two">Vision Title</label>
                                    <input type="text" name="title_two" class="form-control @error('title_two') is-invalid @enderror" id="title_two" value="{{ old('title_two', $missionVision->title_two ?? '') }}" required>
                                    @error('title_two')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="description_two">Vision Description</label>
                                    <textarea name="description_two" class="form-control @error('description_two') is-invalid @enderror" id="description_two" data-summernote cols="30" rows="5">{{ old('description_two', $missionVision->description_two ?? '') }}</textarea>
                                    @error('description_two')
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
@endsection

@push('backend_script')
@include('backend.pages.common.script')
@endpush
