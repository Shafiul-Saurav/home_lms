@extends('backend.layouts.master')

@section('title', 'Permission')

@push('backend_style')
    @include('backend.pages.common.style')
@endpush

@section('backend_content')

    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <h3 class="card-title">Permission Trashed List</h3>
                    <a href="{{ route('permissions.index') }}" class="btn btn-outline-info border"><i class="fa-solid fa-angles-left fa-fw"></i> Back</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive export-table">
                        <table id="file-datatable" class="table table-bordered text-nowrap key-buttons border-bottom w-100">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">Last Updated</th>
                                    <th class="border-bottom-0">Module Name</th>
                                    <th class="border-bottom-0">Permission Name</th>
                                    <th class="border-bottom-0">Permission Slug</th>
                                    {{-- @can('edit-permission') --}}
                                    <th class="border-bottom-0">Actions</th>
                                    {{-- @endcan --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permissions as $permission)
                                    <tr>
                                        <td>
                                            <strong>{{ $permissions->firstItem() + $loop->index }}</strong>
                                        </td>
                                        <td>{{ $permission->updated_at->format('d-M-Y') }}</td>
                                        <td>{{ $permission->module->module_name }}</td>
                                        <td>{{ $permission->permission_name }}</td>
                                        <td>{{ $permission->permission_slug }}</td>
                                        {{-- @can('delete-permission') --}}
                                    <td class="text-center">
                                        <div class="action-btns d-flex align-items-center">
                                            {{-- @can('delete-permission') --}}
                                            <div>
                                                <a href="{{ route('permissions.restore', ['permission_slug' => $permission->permission_slug]) }}"
                                                    class="btn btn-sm btn-outline-success border me-2" data-toggle="tooltip"
                                                    data-placement="top" data-bs-original-title="Restore"><i class="fa-solid fa-store"></i>
                                                </a>
                                            </div>
                                            {{-- @endcan
                                            @can('delete-permission') --}}
                                            <div>
                                                <form action="{{ route('permissions.forcedelete', ['permission_slug' => $permission->permission_slug]) }}"
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
