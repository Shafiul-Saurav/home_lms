@extends('backend.layouts.master')

@section('title', 'Service Subcategory')

@push('backend_style')
    @include('backend.pages.common.style')
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Service Subcategory</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Service Subcategory</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <h3 class="card-title">Create Service Subcategory</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('servicetwosubcategories.store') }}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="category_id">Category</label>
                                    <select name="category_id" id="category_id"
                                        class="form-control select2-style1 @error('category_id') is-invalid @enderror"
                                        required>
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->title }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name"
                                        class="form-control @error('name') is-invalid @enderror" id="name"
                                        value="{{ old('name') }}" required>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h3 class="card-title">Service Subcategory List</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive export-table">
                        <table id="file-datatable" class="table table-bordered text-nowrap key-buttons border-bottom w-100">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">Category</th>
                                    <th class="border-bottom-0">Name</th>
                                    {{-- <th class="border-bottom-0">Slug</th> --}}
                                    <th class="border-bottom-0">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subcategories as $subcategory)
                                    <tr>
                                        <td><strong>{{ $subcategories->firstItem() + $loop->index }}</strong></td>
                                        <td>{{ $subcategory->category->title ?? null }}</td>
                                        <td>{{ $subcategory->name }}</td>
                                        {{-- <td>{{ $subcategory->slug }}</td> --}}
                                        <td>
                                            <div class="material-switch">
                                                <input id="active-{{ $subcategory->id }}" class="toggle-class-active"
                                                    name="is_active" type="checkbox"
                                                    {{ $subcategory->is_active ? 'checked' : '' }}
                                                    data-id="{{ $subcategory->id }}">
                                                <label for="active-{{ $subcategory->id }}" class="label-success"></label>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="action-btns d-flex align-items-center">
                                                <div>
                                                    <a href="{{ route('servicetwosubcategories.edit', $subcategory->id) }}"
                                                        class="btn btn-sm btn-outline-secondary border me-2"
                                                        data-toggle="tooltip" data-placement="top" title="Edit">
                                                        <i class="fa-solid fa-pen fa-fw"></i>
                                                    </a>
                                                </div>
                                                <div>
                                                    <form
                                                        action="{{ route('servicetwosubcategories.destroy', $subcategory->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-sm btn-outline-warning border show_confirm"
                                                            data-toggle="tooltip" data-placement="top" title="Delete">
                                                            <i class="fa-solid fa-trash-can fa-fw"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
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
@endsection

@push('backend_script')
    @include('backend.pages.common.script')

    <script type="text/javascript">
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.toggle-class-active').change(function() {
                var id = $(this).data('id');
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '/admin/check/servicetwosubcategory/is_active/' + id,
                    success: function(data) {
                        Swal.fire({
                            title: data.message,
                            text: data.message,
                            icon: data.type
                        });
                    }
                });
            });
        });
    </script>
@endpush
