@extends('backend.layouts.master')

@section('title', 'Product Subcategory')

@push('backend_style')
    @include('backend.pages.common.style')
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Product Subcategory</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Product Subcategory</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h3 class="card-title">Create Product Subcategory</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('product_subcategories.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="product_category_id">Category</label>
                                    <select name="product_category_id" class="form-control @error('product_category_id') is-invalid @enderror" id="product_category_id" required>
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('product_category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('product_category_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name') }}" required>
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
                </div>
            </div>
        </div>
    </div>

    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h3 class="card-title">Product Subcategory List</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive export-table">
                        <table id="file-datatable" class="table table-bordered text-nowrap key-buttons border-bottom w-100">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">Last Updated</th>
                                    <th class="border-bottom-0">Category</th>
                                    <th class="border-bottom-0">Name</th>
                                    <th class="border-bottom-0">Slug</th>
                                    <th class="border-bottom-0">File</th>
                                    @can('edit-course-subcategory')
                                        <th class="border-bottom-0">Home Page</th>
                                    @endcan
                                    @can('edit-course-subcategory')
                                        <th class="border-bottom-0">Status</th>
                                    @endcan
                                    @canany(['edit-course-subcategory', 'delete-course-subcategory'])
                                        <th class="border-bottom-0">Actions</th>
                                    @endcanany
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subcategories as $subcategory)
                                    <tr>
                                        <td><strong>{{ $subcategories->firstItem() + $loop->index }}</strong></td>
                                        <td>{{ $subcategory->updated_at->format('d-M-Y') }}</td>
                                        <td>{{ $subcategory->category->name ?? 'N/A' }}</td>
                                        <td>{{ $subcategory->name }}</td>
                                        <td>{{ $subcategory->slug }}</td>
                                        <td>
                                            @if ($subcategory->file)
                                                <img src="{{ asset('uploads/product_subcategories/' . $subcategory->file) }}" alt="{{ $subcategory->name }}" style="width: 50px; height: 50px; object-fit: contain;">
                                            @else
                                                -
                                            @endif
                                        </td>
                                        @can('edit-course-subcategory')
                                            <td>
                                                <div class="material-switch">
                                                    <input id="home-{{ $subcategory->id }}" class="toggle-class-home" name="is_home" type="checkbox" {{ $subcategory->is_home ? 'checked' : '' }} data-id="{{ $subcategory->id }}">
                                                    <label for="home-{{ $subcategory->id }}" class="label-success"></label>
                                                </div>
                                            </td>
                                        @endcan
                                        @can('edit-course-subcategory')
                                            <td>
                                                <div class="material-switch">
                                                    <input id="active-{{ $subcategory->id }}" class="toggle-class-active" name="is_active" type="checkbox" {{ $subcategory->is_active ? 'checked' : '' }} data-id="{{ $subcategory->id }}">
                                                    <label for="active-{{ $subcategory->id }}" class="label-success"></label>
                                                </div>
                                            </td>
                                        @endcan
                                        @canany(['edit-course-subcategory', 'delete-course-subcategory'])
                                            <td class="text-center">
                                                <div class="action-btns d-flex align-items-center">
                                                    <div>
                                                        <a href="{{ route('product_subcategories.edit', $subcategory->slug) }}" class="btn btn-sm btn-outline-secondary border me-2" data-toggle="tooltip" data-placement="top" data-bs-original-title="Edit">
                                                            <i class="fa-solid fa-pen fa-fw"></i>
                                                        </a>
                                                    </div>
                                                    <div>
                                                        <form action="{{ route('product_subcategories.destroy', $subcategory->slug) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-outline-warning border show_confirm" data-toggle="tooltip" data-placement="top" data-bs-original-title="Delete">
                                                                <i class="fa-solid fa-trash-can fa-fw"></i>
                                                            </button>
                                                        </form>
                                                    </div>
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

            $('.toggle-class-home').change(function() {
                var subcategory_id = $(this).data('id');

                $.ajax({
                    type: 'GET',
                    dataType: 'json',
                    url: '/admin/check/product/subcategory/is_home/' + subcategory_id,
                    data: {
                        'subcategory_id': subcategory_id,
                        '_token': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        if (data.type === 'success') {
                            Swal.fire({
                                title: data.message,
                                text: data.message,
                                icon: data.type,
                            });
                        } else {
                            Swal.fire({
                                title: data.message,
                                text: data.message,
                                icon: data.type,
                            });
                        }
                    }
                });
            });

            $('.toggle-class-active').change(function() {
                var subcategory_id = $(this).data('id');

                $.ajax({
                    type: 'GET',
                    dataType: 'json',
                    url: '/admin/check/product/subcategory/is_active/' + subcategory_id,
                    data: {
                        'subcategory_id': subcategory_id,
                        '_token': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        if (data.type === 'success') {
                            Swal.fire({
                                title: data.message,
                                text: data.message,
                                icon: data.type,
                            });
                        } else {
                            Swal.fire({
                                title: data.message,
                                text: data.message,
                                icon: data.type,
                            });
                        }
                    }
                });
            });
        });
    </script>
@endpush
