@extends('backend.layouts.master')

@section('title', 'Childcategory')

@push('backend_style')
    @include('backend.pages.common.style')
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Childcategory</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Childcategory</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <h3 class="card-title">Create Childcategory</h3>
                    @can('delete-product-childcategory')
                    <a href="{{ route('childcategories.trash') }}" class="btn btn-sm btn-outline-warning border"><i
                            class="fa-solid fa-trash-can-arrow-up fa-fw"></i> View Trash</a>
                    @endcan
                </div>
                <div class="card-body">
                    <form action="{{ route('childcategories.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="category_id">Category</label>
                                    <select name="category_id" class="form-control @error('category_id')
                                        is-invalid
                                    @enderror" id="category_id" required>
                                        <option value="">Select Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="subcategory_id">Subcategory</label>
                                    <select name="subcategory_id" class="form-control @error('subcategory_id')
                                        is-invalid
                                    @enderror" id="subcategory_id" required disabled>
                                        <option value="">Select Subcategory</option>
                                    </select>
                                    @error('subcategory_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control @error('name')
                                        is-invalid
                                    @enderror" id="name"
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
                                    <input type="file" name="file" class="form-control @error('file')
                                        is-invalid
                                    @enderror" id="file">
                                    @error('file')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-check">
                                    <input type="checkbox" name="is_active" class="form-check-input" id="is_active" value="1" {{ old('is_active') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_active">Active</label>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary" type="submit">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h3 class="card-title">Childcategory List</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive export-table">
                        <table id="file-datatable" class="table table-bordered text-nowrap key-buttons border-bottom w-100">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">Last Updated</th>
                                    <th class="border-bottom-0">Category</th>
                                    <th class="border-bottom-0">Subcategory</th>
                                    <th class="border-bottom-0">Name</th>
                                    <th class="border-bottom-0">Slug</th>
                                    <th class="border-bottom-0">File</th>
                                    @can('edit-product-childcategory')
                                    <th class="border-bottom-0">Status</th>
                                    @endcan
                                    @canany(['edit-product-childcategory', 'delete-product-childcategory'])
                                    <th class="border-bottom-0">Actions</th>
                                    @endcanany
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($childcategories as $childcategory)
                                    <tr>
                                        <td>
                                            <strong>{{ $childcategories->firstItem() + $loop->index }}</strong>
                                        </td>
                                        <td>{{ $childcategory->updated_at->format('d-M-Y') }}</td>
                                        <td>{{ $childcategory->category->name ?? '-' }}</td>
                                        <td>{{ $childcategory->subcategory->name ?? '-' }}</td>
                                        <td>{{ $childcategory->name }}</td>
                                        <td>{{ $childcategory->slug }}</td>
                                        <td>
                                            @if($childcategory->file)
                                                <a href="{{ asset('uploads/childcategories/' . $childcategory->file) }}" target="_blank">View File</a>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        @can('edit-product-childcategory')
                                        <td>
                                            <div class="material-switch">
                                                <input id="active-{{ $childcategory->id }}" class="toggle-class-active" name="is_active"
                                                    type="checkbox" {{ $childcategory->is_active ? 'checked' : '' }}
                                                    data-id="{{ $childcategory->id }}">
                                                <label for="active-{{ $childcategory->id }}" class="label-success"></label>
                                            </div>
                                        </td>
                                        @endcan
                                        @canany(['edit-product-childcategory', 'delete-product-childcategory'])
                                        <td class="text-center">
                                            <div class="action-btns d-flex align-items-center">
                                                <div>
                                                    <a href="{{ route('childcategories.show', $childcategory->id) }}" class="btn btn-sm btn-outline-primary border me-2"
                                                        data-toggle="tooltip" data-placement="top"
                                                        data-bs-original-title="View">
                                                        <i class="fa-solid fa-eye"></i>
                                                    </a>
                                                </div>
                                                <div>
                                                    <a href="{{ route('childcategories.edit', $childcategory->slug) }}"
                                                        class="btn btn-sm btn-outline-secondary border me-2"
                                                        data-toggle="tooltip" data-placement="top"
                                                        data-bs-original-title="Edit">
                                                        <i class="fa-solid fa-edit"></i>
                                                    </a>
                                                </div>
                                                <div>
                                                    <form action="{{ route('childcategories.destroy', $childcategory->slug) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger border show_confirm"
                                                            data-toggle="tooltip" data-placement="top"
                                                            data-bs-original-title="Delete">
                                                            <i class="fa-solid fa-trash"></i>
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
    <!-- End Row -->
@endsection

@push('backend_script')
    @include('backend.pages.common.script')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Dependent dropdown functionality
            $('#category_id').on('change', function() {
                var categoryId = $(this).val();

                if(categoryId) {
                    $.ajax({
                        url: '/admin/get-subcategories/' + categoryId,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('#subcategory_id').empty();
                            $('#subcategory_id').append('<option value="">Select Subcategory</option>');

                            $.each(data, function(key, value) {
                                $('#subcategory_id').append('<option value="' + value.id + '">' + value.name + '</option>');
                            });

                            $('#subcategory_id').prop('disabled', false);
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                            alert('Error loading subcategories');
                        }
                    });
                } else {
                    $('#subcategory_id').empty();
                    $('#subcategory_id').append('<option value="">Select Subcategory</option>');
                    $('#subcategory_id').prop('disabled', true);
                }
            });

            // Toggle active status for table rows
            $('.toggle-class-active').change(function() {
                var is_active = $(this).prop('checked') ? 1 : 0;
                var childcategory_id = $(this).data('id');

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '/admin/check/childcategory/is_active/' + childcategory_id,
                    success: function(response) {
                        console.log(response);
                        if(response.type === 'success') {
                            // Success message can be shown here if needed
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function(err) {
                        if (err) {
                            console.log(err);
                            alert('Error updating status');
                        }
                    }
                });
            });
        });
    </script>
@endpush