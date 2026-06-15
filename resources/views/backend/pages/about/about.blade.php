@extends('backend.layouts.master')

@section('title', 'About Us')

@push('backend_style')
@include('backend.pages.common.style')
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">About Us</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">About Us</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <h3 class="card-title">About Setting</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('about.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="title">About Title</label>
                                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title" value="{{ old('title', $about->title ?? '') }}" required>
                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="sub_title">About Sub-title</label>
                                    <input type="text" name="sub_title" class="form-control @error('sub_title') is-invalid @enderror" id="sub_title" value="{{ old('sub_title', $about->sub_title ?? '') }}" required>
                                    @error('sub_title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="about_image">About Image <span class="text-danger">*</span></label>
                                    <input type="file" name="about_image" class="dropify" data-default-file="{{ asset($about->about_image??null) }}" data-height="200" data-max-width="650" data-max-height="810" data-allowed-file-extensions="png jpg webp"/>
                                </div>
                            </div>
                            <img src="{{ asset($about->about_image??null) }}" alt="Image" style="width: 200px;">
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea name="description" id="summernote"
                                        class="form-control @error('description')
                                        is-invalid
                                    @enderror"
                                        id="description" cols="30" rows="5">{{ old('description', $about->description ?? '') }}</textarea>
                                    @error('description')
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
    {{-- <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h3 class="card-title">Website Information</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive export-table">
                        <table id="file-datatable" class="table table-bordered text-nowrap key-buttons border-bottom w-100">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">S/N</th>
                                    <th class="border-bottom-0">Last Updated</th>
                                    <th class="border-bottom-0">Website Name</th>
                                    <th class="border-bottom-0">Logo</th>
                                    <th class="border-bottom-0">Favicon</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($logo_favs as $key => $logo_fav)
                                <tr>
                                    <td>
                                        <strong>{{ ++$key }}</strong>
                                    </td>
                                    <td>{{ $logo_fav->updated_at->format('d-M-Y') }}</td>
                                    <td>{{ $logo_fav->web_name??null }}</td>
                                    <td>
                                        <img src="{{ asset($logo_fav->logo??null) }}" alt="" style="height: 100px">
                                    </td>
                                    <td>
                                        <img src="{{ asset($logo_fav->favicon??null) }}" alt="" style="height: 100px">
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- End Row -->
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
