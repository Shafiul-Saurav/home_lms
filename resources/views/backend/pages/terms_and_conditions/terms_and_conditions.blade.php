@extends('backend.layouts.master')

@section('title', 'Terms & Conditions')

@push('backend_style')
@include('backend.pages.common.style')
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Terms & Conditions</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Terms & Conditions</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <h3 class="card-title">Terms & Conditions Setting</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('terms_and_conditions.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="title">Terms & Conditions Title</label>
                                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title" value="{{ old('title', $termsAndConditions->title ?? '') }}" required>
                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="last_updated">Last Updated</label>
                                    <input type="date" name="last_updated" class="form-control @error('last_updated') is-invalid @enderror" id="last_updated" value="{{ old('last_updated', $termsAndConditions->last_updated ?? '') }}" required>
                                    @error('last_updated')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                                        <option value="active" {{ (old('status', $termsAndConditions->status ?? '') == 'active') ? 'selected' : '' }}>Active</option>
                                        <option value="inactive" {{ (old('status', $termsAndConditions->status ?? '') == 'inactive') ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="content">Content</label>
                                    <textarea name="content" id="summernote"
                                        class="form-control @error('content')
                                        is-invalid
                                    @enderror"
                                        id="content" cols="30" rows="10">{{ old('content', $termsAndConditions->content ?? '') }}</textarea>
                                    @error('content')
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
<script>
    $(document).ready(function() {
        $('.dropify').dropify({
            messages: {
                'default': 'Drag and drop a file here or click',
                'replace': 'Drag and drop or click to replace',
                'remove':  'Remove',
                'error':   'Ooops, something wrong happened.'
            },
            error: {
                'fileSize': 'The file size is too big (256K max).',
                'minWidth': 'The image width is too small (100px min).',
                'maxWidth': 'The image width is too big (600px max).',
                'minHeight': 'The image height is too small (100px min).',
                'maxHeight': 'The image height is too big (600px max).',
                'imageFormat': 'The image format is not allowed (jpg, png only).'
            }
        });
    });
</script>
@endpush