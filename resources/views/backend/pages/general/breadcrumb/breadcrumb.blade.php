@extends('backend.layouts.master')

@section('title', 'Breadcrumb')

@push('backend_style')
    @include('backend.pages.common.style')
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Breadcrumb</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Breadcrumb</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <h3 class="card-title">Create Breadcrumb</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('breadcrumb.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="page_id" class="form-label mb-3">Select Page</label>
                                    <select id="page_id" name="page_id" class="form-control select2 form-select select2-hidden-accessible
                                    @error('page_id')
                                        is-invalid
                                    @enderror">
                                        <option selected>Choose a Page</option>
                                        @forelse ($pages as $page)
                                            <option value="{{ $page->id }}">{{ $page->page }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                    @error('page_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" name="title" class="form-control @error('title')
                                        is-invalid
                                    @enderror" id="title"
                                        value="{{ old('title') }}" required>
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="banner">Banner</label>
                                    <input type="file" name="banner" class="dropify" data-default-file=""
                                    data-height="200" data-max-width="1930" data-max-height="1090"
                                    data-allowed-file-extensions="png jpg"/>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h3 class="card-title">Breadcrumb List</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive export-table">
                        <table id="file-datatable" class="table table-bordered text-nowrap key-buttons border-bottom w-100">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">Last Updated</th>
                                    <th class="border-bottom-0">Page Name</th>
                                    <th class="border-bottom-0">Title</th>
                                    <th class="border-bottom-0">Banner</th>
                                    {{-- @can('edit-permission') --}}
                                    <th class="border-bottom-0">Actions</th>
                                    {{-- @endcan --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($breadcrumbs as $breadcrumb)
                                    <tr>
                                        <td>
                                            <strong>{{ $breadcrumbs->firstItem() + $loop->index }}</strong>
                                        </td>
                                        <td>{{ $breadcrumb->updated_at->format('d-M-Y') }}</td>
                                        <td>{{ $breadcrumb->pageName->page }}</td>
                                        <td>{{ $breadcrumb->title }}</td>
                                        <td>
                                            <img src="{{ asset('banner') }}/{{ $breadcrumb->banner }}" alt="" style="height: 100px">
                                        </td>
                                        {{-- @can('edit-permission') --}}
                                        <td class="text-center">
                                            <div class="action-btns d-flex align-items-center">
                                                <div>
                                                    <a href="" class="btn btn-sm btn-outline-primary border me-2"
                                                        data-toggle="tooltip" data-placement="top"
                                                        data-bs-original-title="View">
                                                        <i class="fa-solid fa-eye"></i>
                                                    </a>
                                                </div>
                                                {{-- @can('edit-permission') --}}
                                                <div>
                                                    <a href="{{ route('breadcrumb.edit', $breadcrumb->id) }}"
                                                        class="btn btn-sm btn-outline-secondary border me-2"
                                                        data-toggle="tooltip" data-placement="top"
                                                        data-bs-original-title="Edit"><i class="fa-solid fa-pen fa-fw"></i>
                                                    </a>
                                                </div>
                                                {{-- @endcan
                                                @can('delete-permission') --}}
                                                <div>
                                                    <form action="{{ route('breadcrumb.destroy', $breadcrumb->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-sm btn-outline-warning border show_confirm"
                                                            data-toggle="tooltip" data-placement="top"
                                                            data-bs-original-title="Delete">
                                                            <i class="fa-solid fa-trash-can fa-fw"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                                {{-- @endcan --}}
                                            </div>
                                        </td>
                                        {{-- @endcan --}}
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
@endpush
