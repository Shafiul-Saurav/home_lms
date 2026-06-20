@extends('backend.layouts.master')

@section('title', 'Book Subcategory')

@push('backend_style')
    @include('backend.pages.common.style')
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Book Subcategory</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Book Subcategory</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <h3 class="card-title">Create Book Subcategory</h3>
                    @can('delete-book-subcategory')
                        <a href="{{ route('book_subcategories.trash') }}" class="btn btn-sm btn-outline-warning border"><i
                                class="fa-solid fa-trash-can-arrow-up fa-fw"></i> View Trash</a>
                    @endcan
                </div>
                <div class="card-body">
                    @can('create-book-subcategory')
                        <form action="{{ route('book_subcategories.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="book_category_id">Category</label>
                                    <select name="book_category_id" id="book_category_id" class="form-control select2-style1 @error('book_category_id') is-invalid @enderror" required>
                                        <option value="">Select Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('book_category_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('book_category_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name"
                                        value="{{ old('name') }}" required>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="file">File</label>
                                    <input type="file" name="file" class="form-control @error('file') is-invalid @enderror" id="file">
                                    @error('file')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Create</button>
                        </form>
                    @endcan
                </div>
            </div>
        </div>
    </div>
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h3 class="card-title">Book Subcategory List</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive export-table">
                        <table id="file-datatable" class="table table-bordered text-nowrap key-buttons border-bottom w-100">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">Category</th>
                                    <th class="border-bottom-0">Name</th>
                                    <th class="border-bottom-0">Slug</th>
                                    <th class="border-bottom-0">File</th>
                                    @can('edit-book-subcategory')
                                        <th class="border-bottom-0">Home Page</th>
                                        <th class="border-bottom-0">Status</th>
                                    @endcan
                                    @canany(['edit-book-subcategory', 'delete-book-subcategory'])
                                        <th class="border-bottom-0">Actions</th>
                                    @endcanany
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subcategories as $subcategory)
                                    <tr>
                                        <td><strong>{{ $subcategories->firstItem() + $loop->index }}</strong></td>
                                        <td>{{ $subcategory->bookCategory ? $subcategory->bookCategory->name : 'N/A' }}</td>
                                        <td>{{ $subcategory->name }}</td>
                                        <td>{{ $subcategory->slug }}</td>
                                        <td>
                                            @if($subcategory->file)
                                                <a href="{{ asset('uploads/booksubcategories/' . $subcategory->file) }}" target="_blank">View File</a>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        @can('edit-book-subcategory')
                                            <td>
                                                <div class="material-switch">
                                                    <input id="home-{{ $subcategory->id }}" class="toggle-class-home" name="is_home"
                                                        type="checkbox" {{ $subcategory->is_home ? 'checked' : '' }}
                                                        data-id="{{ $subcategory->id }}">
                                                    <label for="home-{{ $subcategory->id }}" class="label-success"></label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="material-switch">
                                                    <input id="active-{{ $subcategory->id }}" class="toggle-class-active" name="is_active"
                                                        type="checkbox" {{ $subcategory->is_active ? 'checked' : '' }}
                                                        data-id="{{ $subcategory->id }}">
                                                    <label for="active-{{ $subcategory->id }}" class="label-success"></label>
                                                </div>
                                            </td>
                                        @endcan
                                        @canany(['edit-book-subcategory', 'delete-book-subcategory'])
                                            <td class="text-center">
                                                <div class="action-btns d-flex align-items-center">
                                                    @can('edit-book-subcategory')
                                                        <div>
                                                            <a href="{{ route('book_subcategories.edit', $subcategory->id) }}"
                                                                class="btn btn-sm btn-outline-secondary border me-2"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Edit">
                                                                <i class="fa-solid fa-pen fa-fw"></i>
                                                            </a>
                                                        </div>
                                                    @endcan
                                                    @can('delete-book-subcategory')
                                                        <div>
                                                            <form action="{{ route('book_subcategories.destroy', $subcategory->id) }}" method="POST"
                                                                class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-sm btn-outline-warning border show_confirm"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="Delete">
                                                                    <i class="fa-solid fa-trash-can fa-fw"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    @endcan
                                                </div>
                                            </td>
                                        @endcanany
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

            // Toggle home status
            $('.toggle-class-home').change(function() {
                var subcategory_id = $(this).data('id');
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '/admin/check/book_subcategory/is_home/' + subcategory_id,
                    success: function(data) {
                        Swal.fire({ title: data.message, text: data.message, icon: data.type });
                    }
                });
            });

            // Toggle active status
            $('.toggle-class-active').change(function() {
                var subcategory_id = $(this).data('id');
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '/admin/check/book_subcategory/is_active/' + subcategory_id,
                    success: function(data) {
                        Swal.fire({ title: data.message, text: data.message, icon: data.type });
                    }
                });
            });
        });
    </script>
@endpush
