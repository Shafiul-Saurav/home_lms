@extends('backend.layouts.master')

@section('title', 'Role')

@push('backend_style')
    @include('backend.pages.common.style')
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Role</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Role</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <h3 class="card-title">Create Role</h3>
                    <a href="{{ route('roles.trash') }}" class="btn btn-sm btn-outline-warning border"><i
                            class="fa-solid fa-trash-can-arrow-up fa-fw"></i> View Trash</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('roles.store') }}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="role_name" class="form-label mb-2">Role Name</label>
                                    <input type="text"
                                        class="form-control @error('role_name')
                            is-invalid
                        @enderror"
                                        rows="5" name="role_name" value="{{ old('role_name') }}" id="role_name">
                                    @error('role_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label class="form-label" for="basic-icon-default-fullname">Role Note</label>
                                    <div class="input-group input-group-merge">
                                        <input type="text" name="role_note"
                                            class="form-control
                                @error('role_note')
                                    is-invalid
                                @enderror"
                                            value="{{ old('role_note') }}" placeholder="Enter Role Note">
                                        @error('role_note')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="">
                                    <strong class="@error('permissions') is-invalid

                                    @enderror">Manage Permission for role</strong>
                                    @error('permissions')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                {{-- <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="saurav">
                                        <label class="form-check-label" for="saurav">Select All</label>
                                      </div>
                                </div> --}}
                                <label class="colorinput mb-3">
                                    <input name="color" type="checkbox" value="pink" class="colorinput-input" id="saurav">
                                    <span class="colorinput-color bg-pink">Select All</span>
                                </label>
                            </div>
                            <div class="col-12">
                                @foreach ($modules->chunk(3) as $key => $chunks)
                                <div class="row">
                                    @foreach ($chunks as $module)
                                        <div class="col-lg-4 col-sm-6 mb-3">
                                            <h5 class="text-primary">Module: {{ $module->module_name }}</h5>
                                            <div class="mb-3">
                                                @foreach ($module->permissions as $permission)
                                                    {{-- <div class="form-check">
                                                        <input class="form-check-input" name="permissions[]" type="checkbox"
                                                            value="{{ $permission->id }}"
                                                            id="{{ $permission->id }}">
                                                        <label class="form-check-label"
                                                            for="{{ $permission->id }}">
                                                            {{ $permission->permission_name }} </label>
                                                    </div> --}}
                                                    <div class="col-auto ps-0 mb-3 d-flex align-items-center">
                                                        <label class="colorinput d-flex align-items-center">
                                                            <input name="permissions[]" id="{{ $permission->id }}" type="checkbox" value="{{ $permission->id }}" class="colorinput-input" />
                                                            <span class="colorinput-color bg-purple"></span>
                                                        </label>
                                                        <label class="form-check-label ms-2" for="{{ $permission->id }}">
                                                            {{ $permission->permission_name }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
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
                    <h3 class="card-title">Role List</h3>
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
                                        {{-- @can('edit-role') --}}
                                        <td class="text-center">
                                            <div class="action-btns d-flex align-items-center">
                                                <div>
                                                    <a href="" class="btn btn-sm btn-outline-primary border me-2"
                                                        data-toggle="tooltip" data-placement="top"
                                                        data-bs-original-title="View">
                                                        <i class="fa-solid fa-eye"></i>
                                                    </a>
                                                </div>
                                                {{-- @can('edit-role') --}}
                                                <div>
                                                    <a href="{{ route('roles.edit', $role->role_slug) }}"
                                                        class="btn btn-sm btn-outline-secondary border me-2"
                                                        data-toggle="tooltip" data-placement="top"
                                                        data-bs-original-title="Edit"><i class="fa-solid fa-pen fa-fw"></i>
                                                    </a>
                                                </div>
                                                {{-- @endcan
                                                @can('delete-role') --}}
                                                @if ($role->is_deletable && Auth::user()->hasPermission('delete-role'))
                                                <div>
                                                    <form
                                                        action="{{ route('roles.destroy', $role->role_slug) }}"
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
                                                @endif
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
    <script>
        //Listern for click on select all checkbox
        $('#saurav').click(function(event){
            if(this.checked){
                //Loop each checkbox
                $(':checkbox').each(function(){
                    this.checked = true;
                })
            }else{
                //Loop each checkbox
                $(':checkbox').each(function(){
                    this.checked = false;
                })
            }
        });
    </script>
@endpush
