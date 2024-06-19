@extends('backend.layouts.master')

@section('title', 'Module')

@push('backend_style')
@include('backend.pages.common.style')
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Module</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Module</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <h3 class="card-title">Create Module</h3>
                    <a href="{{ route('modules.trash') }}" class="btn btn-sm btn-outline-warning border"><i class="fa-solid fa-trash-can-arrow-up fa-fw"></i> View Trash</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('modules.store') }}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="module_name">Module Name</label>
                                    <input type="text" name="module_name" class="form-control" id="module_name" value="{{ old('module_name') }}" required>
                                    @error('module_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
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
                    <h3 class="card-title">Module List</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive export-table">
                        <table id="file-datatable" class="table table-bordered text-nowrap key-buttons border-bottom w-100">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">S/N</th>
                                    <th class="border-bottom-0">Last Updated</th>
                                    <th class="border-bottom-0">Module Name</th>
                                    <th class="border-bottom-0">Module Slug</th>
                                    {{-- @can('edit-module') --}}
                                    <th class="border-bottom-0">Action</th>
                                    {{-- @endcan --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($modules as $module)
                                <tr>
                                    <td>
                                        <strong>{{ $modules->firstItem() + $loop->index }}</strong>
                                    </td>
                                    <td>{{ $module->updated_at->format('d-M-Y') }}</td>
                                    <td>{{ $module->module_name }}</td>
                                    <td>{{ $module->module_slug }}</td>
                                    {{-- @can('edit-module') --}}
                                    <td class="text-center">
                                        <div class="action-btns d-flex align-items-center">
                                            <div>
                                                <a href="" class="btn btn-sm btn-outline-primary border me-2" data-toggle="tooltip"
                                                    data-placement="top" data-bs-original-title="View">
                                                    <i class="fa-solid fa-eye"></i>
                                                </a>
                                            </div>
                                            {{-- @can('edit-module') --}}
                                            <div>
                                                <a href="{{ route('modules.edit', $module->module_slug) }}"
                                                    class="btn btn-sm btn-outline-secondary border me-2" data-toggle="tooltip"
                                                    data-placement="top" data-bs-original-title="Edit"><i class="fa-solid fa-pen fa-fw"></i>
                                                </a>
                                            </div>
                                            {{-- @endcan --}}
                                            {{-- @can('delete-module') --}}
                                            <div>
                                                <form action="{{ route('modules.destroy', $module->module_slug) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-warning border show_confirm" data-toggle="tooltip"
                                                    data-placement="top" data-bs-original-title="Delete">
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
