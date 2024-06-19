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
                        <li class="breadcrumb-item active" aria-current="page">Module Trash</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <h3 class="card-title">Module Trashed List</h3>
                    <a href="{{ route('modules.index') }}" class="btn btn-outline-info border"><i class="fa-solid fa-angles-left fa-fw"></i> Back</a>
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
                                    {{-- @can('delete-module') --}}
                                    <td class="text-center">
                                        <div class="action-btns d-flex align-items-center">
                                            {{-- @can('delete-module') --}}
                                            <div>
                                                <a href="{{ route('modules.restore', ['module_slug' => $module->module_slug]) }}"
                                                    class="btn btn-sm btn-outline-success border me-2" data-toggle="tooltip"
                                                    data-placement="top" data-bs-original-title="Restore"><i class="fa-solid fa-store"></i>
                                                </a>
                                            </div>
                                            {{-- @endcan
                                            @can('delete-module') --}}
                                            <div>
                                                <form action="{{ route('modules.forcedelete', ['module_slug' => $module->module_slug]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger border show_confirm" data-toggle="tooltip"
                                                    data-placement="top" data-bs-original-title="Force Delete">
                                                        <i class="fa-solid fa-radiation"></i>
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
