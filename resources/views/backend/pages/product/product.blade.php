@extends('backend.layouts.master')

@section('title', 'Product')

@push('backend_style')
    @include('backend.pages.common.style')
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Product</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Product</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <h3 class="card-title">Create Product</h3>
                    @can('delete-product')
                        <a href="{{ route('products.trash') }}" class="btn btn-sm btn-outline-warning border"><i
                                class="fa-solid fa-trash-can-arrow-up fa-fw"></i> View Trash</a>
                    @endcan
                </div>
                <div class="card-body">
                    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="name">Name <span class="text-danger">*</span></label>
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

                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="slug">Slug (Optional - Auto-generated if left empty)</label>
                                    <input type="text" name="slug"
                                        class="form-control @error('slug') is-invalid @enderror" id="slug"
                                        value="{{ old('slug') }}">
                                    <small class="form-text text-muted">If left empty, a slug will be automatically
                                        generated from the product name.</small>
                                    @error('slug')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="category_id">Category</label>
                                    <select name="category_id"
                                        class="form-control select2-style1 @error('category_id') is-invalid @enderror"
                                        id="category_id">
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                {!! $category->name !!}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="subcategory_id">Subcategory</label>
                                    <select name="subcategory_id"
                                        class="form-control @error('subcategory_id') is-invalid @enderror"
                                        id="subcategory_id" disabled>
                                        <option value="">Select Subcategory</option>
                                    </select>
                                    @error('subcategory_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="childcategory_id">Child Category</label>
                                    <select name="childcategory_id"
                                        class="form-control @error('childcategory_id') is-invalid @enderror"
                                        id="childcategory_id" disabled>
                                        <option value="">Select Child Category</option>
                                    </select>
                                    @error('childcategory_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="short_description">Short Description</label>
                                    <textarea name="short_description" id="short_description" data-summernote
                                        class="form-control @error('short_description') is-invalid @enderror" rows="2">{{ old('short_description') }}</textarea>
                                    @error('short_description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea name="description" id="summernote" data-summernote
                                        class="form-control @error('description') is-invalid @enderror" rows="4">{{ old('description') }}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="long_description">Long Description</label>
                                    <textarea name="long_description" id="long_description" data-summernote
                                        class="form-control @error('long_description') is-invalid @enderror" rows="4">{{ old('long_description') }}</textarea>
                                    @error('long_description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="additional_info">Additional Information</label>
                                    <textarea name="additional_info" id="additional_info" data-summernote
                                        class="form-control @error('additional_info') is-invalid @enderror" rows="3">{{ old('additional_info') }}</textarea>
                                    @error('additional_info')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="product_quantity">Product Quantity <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="product_quantity"
                                        class="form-control @error('product_quantity') is-invalid @enderror"
                                        id="product_quantity" value="{{ old('product_quantity') }}" required>
                                    @error('product_quantity')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="is_home">Show on Home Page</label>
                                    <select name="is_home" class="form-control @error('is_home') is-invalid @enderror"
                                        id="is_home">
                                        <option value="0" {{ old('is_home') == '0' ? 'selected' : '' }}>No</option>
                                        <option value="1" {{ old('is_home') == '1' ? 'selected' : '' }}>Yes</option>
                                    </select>
                                    @error('is_home')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="type">Type</label>
                                    <select name="type" class="form-control @error('type') is-invalid @enderror"
                                        id="product_type">
                                        <option value="">Select Type</option>
                                        <option value="normal" {{ old('type') == 'normal' ? 'selected' : '' }}>Normal
                                        </option>
                                        <option value="variable" {{ old('type') == 'variable' ? 'selected' : '' }}>
                                            Variable</option>
                                    </select>
                                    @error('type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3" id="color_field"
                                style="display: {{ old('type') == 'variable' ? 'block' : 'none' }};">
                                <div class="form-group">
                                    <label for="color">Color</label>
                                    <input type="text" name="color"
                                        class="form-control @error('color') is-invalid @enderror" id="color"
                                        value="{{ old('color') }}">
                                    @error('color')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3" id="size_field"
                                style="display: {{ old('type') == 'variable' ? 'block' : 'none' }};">
                                <div class="form-group">
                                    <label for="size">Size</label>
                                    <input type="text" name="size"
                                        class="form-control @error('size') is-invalid @enderror" id="size"
                                        value="{{ old('size') }}">
                                    @error('size')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="purchase_price">Purchase Price <span class="text-danger">*</span></label>
                                    <input type="number" step="0.01" name="purchase_price"
                                        class="form-control @error('purchase_price') is-invalid @enderror"
                                        id="purchase_price" value="{{ old('purchase_price') }}" required>
                                    @error('purchase_price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="sell_price">Sell Price <span class="text-danger">*</span></label>
                                    <input type="number" step="0.01" name="sell_price"
                                        class="form-control @error('sell_price') is-invalid @enderror" id="sell_price"
                                        value="{{ old('sell_price') }}" required>
                                    @error('sell_price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="discount_type">Discount Type</label>
                                    <select name="discount_type"
                                        class="form-control @error('discount_type') is-invalid @enderror"
                                        id="discount_type">
                                        <option value="">No Discount</option>
                                        <option value="percentage"
                                            {{ old('discount_type') == 'percentage' ? 'selected' : '' }}>Percentage
                                        </option>
                                        <option value="fixed" {{ old('discount_type') == 'fixed' ? 'selected' : '' }}>
                                            Fixed Amount</option>
                                    </select>
                                    @error('discount_type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="discount_amount">Discount Amount</label>
                                    <input type="number" step="0.01" name="discount_amount"
                                        class="form-control @error('discount_amount') is-invalid @enderror"
                                        id="discount_amount" value="{{ old('discount_amount') }}">
                                    @error('discount_amount')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="is_stock">In Stock</label>
                                    <select name="is_stock" class="form-control @error('is_stock') is-invalid @enderror"
                                        id="is_stock" required>
                                        <option value="1" {{ old('is_stock') == '1' ? 'selected' : '' }}>Yes</option>
                                        <option value="0" {{ old('is_stock') == '0' ? 'selected' : '' }}>No</option>
                                    </select>
                                    @error('is_stock')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label for="image">Main Image</label>
                                    <input type="file" name="image"
                                        class="form-control @error('image') is-invalid @enderror" id="image">
                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label for="video">Product Video</label>
                                    <input type="file" name="video"
                                        class="form-control @error('video') is-invalid @enderror" id="video">
                                    @error('video')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <small class="form-text text-muted">Upload a product video (mp4, mov, avi, wmv, flv).
                                        Max size: 27MB</small>
                                </div>
                            </div>

                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="multiple_image">Multiple Images</label>
                                    <div id="multipleImageFields">
                                        <div class="d-flex justify-content-between mb-2" id="multipleImageField0">
                                            <input type="file" name="multiple_image[]" class="form-control me-4" />
                                            <button type="button" class="btn btn-secondary addImageField">+</button>
                                        </div>
                                    </div>
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
                    <h3 class="card-title">Product List</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive export-table">
                        <table id="file-datatable"
                            class="table table-bordered text-nowrap key-buttons border-bottom w-100">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0" width="5%">#</th>
                                    <th class="border-bottom-0" width="15%">Name</th>
                                    <th class="border-bottom-0" width="10%">Category</th>
                                    <th class="border-bottom-0" width="10%">Subcategory</th>
                                    <th class="border-bottom-0" width="10%">Child Category</th>
                                    <th class="border-bottom-0" width="10%">Image</th>
                                    <th class="border-bottom-0" width="10%">Purchase Price</th>
                                    <th class="border-bottom-0" width="10%">Sell Price</th>
                                    <th class="border-bottom-0" width="10%">In Stock</th>
                                    @can('edit-product')
                                        <th class="border-bottom-0" width="10%">Status</th>
                                    @endcan
                                    @canany(['edit-product', 'delete-product'])
                                        <th class="border-bottom-0" width="20%">Actions</th>
                                    @endcanany
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td width="5%">
                                            <strong>{{ $products->firstItem() + $loop->index }}</strong>
                                        </td>
                                        <td width="15%">{{ $product->name }}</td>
                                        <td width="10%">{!! $product->category ? $product->category->name : 'N/A' !!}</td>
                                        <td width="10%">{!! $product->subcategory ? $product->subcategory->name : 'N/A' !!}</td>
                                        <td width="10%">{!! $product->childcategory ? $product->childcategory->name : 'N/A' !!}</td>
                                        <td width="10%">
                                            @if ($product->image)
                                                <img src="{{ asset('uploads/products') }}/{{ $product->image }}"
                                                    alt="" style="height: 50px">
                                            @else
                                                <span>No Image</span>
                                            @endif
                                        </td>
                                        <td width="10%">{{ $product->purchase_price }}</td>
                                        <td width="10%">{{ $product->sell_price }}</td>
                                        <td width="10%">
                                            @if ($product->is_stock)
                                                <span class="badge bg-success">In Stock</span>
                                            @else
                                                <span class="badge bg-danger">Out of Stock</span>
                                            @endif
                                        </td>
                                        @can('edit-product')
                                            <td width="10%">
                                                <div class="material-switch">
                                                    <input id="product-{{ $product->id }}" class="toggle-class"
                                                        name="is_active" type="checkbox"
                                                        {{ $product->is_active ? 'checked' : '' }}
                                                        data-id="{{ $product->id }}">
                                                    <label for="product-{{ $product->id }}" class="label-success"></label>
                                                </div>
                                            </td>
                                        @endcan
                                        @canany(['edit-product', 'delete-product'])
                                            <td width="20%" class="text-center">
                                                <div class="action-btns d-flex align-items-center justify-content-center">
                                                    <div>
                                                        <a href="{{ route('products.show', $product->id) }}"
                                                            class="btn btn-sm btn-outline-primary border me-1"
                                                            data-toggle="tooltip" data-placement="top"
                                                            data-bs-original-title="View">
                                                            <i class="fa-solid fa-eye"></i>
                                                        </a>
                                                    </div>
                                                    <div>
                                                        <a href="{{ route('products.edit', $product->id) }}"
                                                            class="btn btn-sm btn-outline-secondary border me-1"
                                                            data-toggle="tooltip" data-placement="top"
                                                            data-bs-original-title="Edit">
                                                            <i class="fa-solid fa-pen fa-fw"></i>
                                                        </a>
                                                    </div>
                                                    <div>
                                                        <form action="{{ route('products.destroy', $product->id) }}"
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

    @push('backend_script')
        @include('backend.pages.common.script')
        <script>
            $(document).ready(function() {
                // Toggle active status using event delegation
                $(document).on('change', '.toggle-class', function() {
                    var is_active = $(this).prop('checked') ? 1 : 0;
                    var product_id = $(this).data('id');
                    var url = "{{ route('product.is_active.ajax', ':product_id') }}";
                    url = url.replace(':product_id', product_id);

                    $.ajax({
                        type: "GET",
                        url: url,
                        data: {
                            'is_active': is_active,
                            'product_id': product_id
                        },
                        success: function(data) {
                            if (data.type === 'success') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success!',
                                    text: data.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error!',
                                    text: data.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            }
                        },
                        error: function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'Something went wrong!',
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
                    });
                });

                // Add multiple image field
                $(document).on('click', '.addImageField', function() {
                    var fieldCount = $('#multipleImageFields .d-flex').length;
                    var newField = `
                        <div class="d-flex justify-content-between mb-2" id="multipleImageField${fieldCount}">
                            <input type="file" name="multiple_image[]" class="form-control me-4" />
                            <button type="button" class="btn btn-danger removeImageField">-</button>
                        </div>
                    `;
                    $('#multipleImageFields').append(newField);
                });

                // Remove multiple image field
                $(document).on('click', '.removeImageField', function() {
                    $(this).closest('.d-flex').remove();
                });

                // Handle product type change
                $('#product_type').change(function() {
                    if ($(this).val() === 'variable') {
                        $('#color_field').show();
                        $('#size_field').show();
                    } else {
                        $('#color_field').hide();
                        $('#size_field').hide();
                        // Clear values when hidden
                        $('#color').val('');
                        $('#size').val('');
                    }
                });

                // Dependent dropdown functionality
                $('#category_id').on('change', function() {
                    var categoryId = $(this).val();

                    if (categoryId) {
                        $.ajax({
                            url: '/admin/get-subcategories/' + categoryId,
                            type: "GET",
                            dataType: "json",
                            success: function(data) {
                                $('#subcategory_id').empty();
                                $('#subcategory_id').append(
                                    '<option value="">Select Subcategory</option>');

                                $.each(data, function(key, value) {
                                    $('#subcategory_id').append('<option value="' + value
                                        .id + '">' + value.name + '</option>');
                                });

                                $('#subcategory_id').prop('disabled', false);

                                // Also reset childcategory when category changes
                                $('#childcategory_id').empty();
                                $('#childcategory_id').append(
                                    '<option value="">Select Child Category</option>');
                                $('#childcategory_id').prop('disabled', true);
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

                        $('#childcategory_id').empty();
                        $('#childcategory_id').append('<option value="">Select Child Category</option>');
                        $('#childcategory_id').prop('disabled', true);
                    }
                });

                $('#subcategory_id').on('change', function() {
                    var subcategoryId = $(this).val();

                    if (subcategoryId) {
                        $.ajax({
                            url: '/admin/get-childcategories/' + subcategoryId,
                            type: "GET",
                            dataType: "json",
                            success: function(data) {
                                $('#childcategory_id').empty();
                                $('#childcategory_id').append(
                                    '<option value="">Select Child Category</option>');

                                $.each(data, function(key, value) {
                                    $('#childcategory_id').append('<option value="' + value
                                        .id + '">' + value.name + '</option>');
                                });

                                $('#childcategory_id').prop('disabled', false);
                            },
                            error: function(xhr, status, error) {
                                console.error(xhr.responseText);
                                alert('Error loading child categories');
                            }
                        });
                    } else {
                        $('#childcategory_id').empty();
                        $('#childcategory_id').append('<option value="">Select Child Category</option>');
                        $('#childcategory_id').prop('disabled', true);
                    }
                });
            });
        </script>
    @endpush
@endsection
