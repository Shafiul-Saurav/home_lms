@extends('backend.layouts.master')

@section('title', 'Website Name')

@push('backend_style')
@include('backend.pages.common.style')
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Website Name</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Website Name</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <h3 class="card-title">Website Setting</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('logo.fav.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="web_name">Website Name</label>
                                    <input type="text" name="web_name" class="form-control @error('web_name') is-invalid @enderror" id="web_name" value="{{ old('web_name', $logo_fav->web_name ?? '') }}" required>
                                    @error('web_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="logo">Website Logo</label>
                                    <input type="file" name="logo" class="dropify" data-default-file="{{ asset($logo_fav->logo??null) }}" data-height="200" data-max-width="400" data-max-height="400" data-allowed-file-extensions="png jpg"/>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="favicon">Website Favicon</label>
                                    <input type="file" name="favicon" class="dropify" data-default-file="{{ asset($logo_fav->favicon??null) }}" data-height="200" data-max-width="200" data-max-height="200" data-allowed-file-extensions="png jpg"/>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-secondary" type="submit">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row row-sm">
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
    </div>
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
