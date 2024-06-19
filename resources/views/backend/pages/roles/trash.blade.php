@extends('backend.layouts.master')

@section('title', 'Role')

@push('backend_style')
    @include('backend.pages.common.style')
@endpush

@section('backend_content')
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <h3 class="card-title">Role List</h3>
                    <a href="{{ route('roles.index') }}" class="btn btn-info"><i class="fa-solid fa-angles-left fa-fw"></i> Back</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive export-table">
                        <table id="file-datatable" class="table table-bordered text-nowrap key-buttons border-bottom w-100">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">Last Updated</th>
                                    <th class="border-bottom-0">Role Name</th>
                                    <th class="border-bottom-0">Number off Permissions</th>
                                    <th class="border-bottom-0">Note</th>
                                    {{-- @can('edit-role') --}}
                                    <th class="border-bottom-0">Actions</th>
                                    {{-- @endcan --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $role)
                                @if ($role->id != 4)
                                    <tr>
                                        <td>
                                            <strong>{{ $roles->firstItem() + $loop->index }}</strong>
                                        </td>
                                        <td>{{ $role->updated_at->format('d-M-Y') }}</td>
                                        <td>{{ $role->role_name }}</td>
                                        <td>
                                            <span class="badge bg-success">{{ $role->permissions->count() }}</span>
                                        </td>
                                        <td>{{ $role->role_note }}</td>
                                        {{-- @can('delete-role') --}}
                                        <td class="text-center">
                                            <div class="action-btns d-flex align-items-center">
                                                {{-- @can('delete-role') --}}
                                                <div>
                                                    <a href="{{ route('roles.restore', ['role_slug' => $role->role_slug]) }}"
                                                        class="btn btn-sm btn-outline-success border me-2" data-toggle="tooltip"
                                                        data-placement="top" data-bs-original-title="Restore"><i class="fa-solid fa-store"></i>
                                                    </a>
                                                </div>
                                                {{-- @endcan
                                                @can('delete-role') --}}
                                                <div>
                                                    <form action="{{ route('roles.forcedelete', ['role_slug' => $role->role_slug]) }}"
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
                                    @endif
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
