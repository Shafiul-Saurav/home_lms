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
                                    <label for="slug">Slug (Optional - Auto-generated if left empty)</label>
                                    <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror" id="slug"
                                        value="{{ old('slug') }}">
                                    <small class="form-text text-muted">If left empty, a slug will be automatically generated from the product name.</small>
                                    @error('slug')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="category_id">Category</label>
                                    <select name="category_id" class="form-control @error('category_id') is-invalid @enderror" id="category_id">
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
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

                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="subcategory_id">Subcategory</label>
                                    <select name="subcategory_id" class="form-control @error('subcategory_id') is-invalid @enderror" id="subcategory_id">
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
                                    <label for="childcategory_id">Childcategory</label>
                                    <select name="childcategory_id" class="form-control @error('childcategory_id') is-invalid @enderror" id="childcategory_id">
                                        <option value="">Select Childcategory</option>
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
                                    <label for="description">Description</label>
                                    <textarea name="description" id="summernote" class="form-control @error('description') is-invalid @enderror"
                                        rows="4">{{ old('description') }}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="type">Type</label>
                                    <select name="type" class="form-control @error('type') is-invalid @enderror" id="product_type">
                                        <option value="">Select Type</option>
                                        <option value="normal" {{ old('type') == 'normal' ? 'selected' : '' }}>Normal</option>
                                        <option value="variable" {{ old('type') == 'variable' ? 'selected' : '' }}>Variable</option>
                                    </select>
                                    @error('type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3" id="color_field" style="display: {{ old('type') == 'variable' ? 'block' : 'none' }};">
                                <div class="form-group">
                                    <label for="color">Color</label>
                                    <input type="text" name="color" class="form-control @error('color') is-invalid @enderror" id="color"
                                        value="{{ old('color') }}">
                                    @error('color')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3" id="size_field" style="display: {{ old('type') == 'variable' ? 'block' : 'none' }};">
                                <div class="form-group">
                                    <label for="size">Size</label>
                                    <input type="text" name="size" class="form-control @error('size') is-invalid @enderror" id="size"
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
                                    <input type="number" step="0.01" name="purchase_price" class="form-control @error('purchase_price') is-invalid @enderror"
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
                                    <input type="number" step="0.01" name="sell_price" class="form-control @error('sell_price') is-invalid @enderror"
                                        id="sell_price" value="{{ old('sell_price') }}" required>
                                    @error('sell_price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="product_price">Product Price <span class="text-danger">*</span></label>
                                    <input type="number" step="0.01" name="product_price" class="form-control @error('product_price') is-invalid @enderror"
                                        id="product_price" value="{{ old('product_price') }}" required>
                                    @error('product_price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="product_discount">Product Discount</label>
                                    <input type="number" step="0.01" name="product_discount" class="form-control @error('product_discount') is-invalid @enderror"
                                        id="product_discount" value="{{ old('product_discount') }}">
                                    @error('product_discount')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="product_quantity">Product Quantity <span class="text-danger">*</span></label>
                                    <input type="text" name="product_quantity" class="form-control @error('product_quantity') is-invalid @enderror"
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
                                    <label for="discount_type">Discount Type</label>
                                    <select name="discount_type" class="form-control @error('discount_type') is-invalid @enderror" id="discount_type">
                                        <option value="">No Discount</option>
                                        <option value="percentage" {{ old('discount_type') == 'percentage' ? 'selected' : '' }}>Percentage</option>
                                        <option value="fixed" {{ old('discount_type') == 'fixed' ? 'selected' : '' }}>Fixed Amount</option>
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
                                    <input type="number" step="0.01" name="discount_amount" class="form-control @error('discount_amount') is-invalid @enderror"
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
                                    <select name="is_stock" class="form-control @error('is_stock') is-invalid @enderror" id="is_stock" required>
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

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="is_active">Active Status</label>
                                    <select name="is_active" class="form-control @error('is_active') is-invalid @enderror" id="is_active" required>
                                        <option value="1" {{ old('is_active') == '1' ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    @error('is_active')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="is_home">Show on Home</label>
                                    <select name="is_home" class="form-control @error('is_home') is-invalid @enderror" id="is_home" required>
                                        <option value="1" {{ old('is_home') == '1' ? 'selected' : '' }}>Yes</option>
                                        <option value="0" {{ old('is_home') == '0' ? 'selected' : '' }}>No</option>
                                    </select>
                                    @error('is_home')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="image">Main Image</label>
                                    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" id="image">
                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="product_image">Product Image</label>
                                    <input type="file" name="product_image" class="form-control @error('product_image') is-invalid @enderror" id="product_image">
                                    @error('product_image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
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
                    <h3 class="card-title">Product List</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive export-table">
                        <table id="file-datatable" class="table table-bordered text-nowrap key-buttons border-bottom w-100">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">Last Updated</th>
                                    <th class="border-bottom-0">Image</th>
                                    <th class="border-bottom-0">Product Name</th>
                                    <th class="border-bottom-0">Category</th>
                                    <th class="border-bottom-0">Subcategory</th>
                                    <th class="border-bottom-0">Childcategory</th>
                                    <th class="border-bottom-0">Price</th>
                                    @can('edit-product')
                                    <th class="border-bottom-0">Home Page</th>
                                    @endcan
                                    @can('edit-product')
                                    <th class="border-bottom-0">Status</th>
                                    @endcan
                                    @canany(['edit-product', 'delete-product'])
                                    <th class="border-bottom-0">Actions</th>
                                    @endcanany
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>
                                            <strong>{{ $products->firstItem() + $loop->index }}</strong>
                                        </td>
                                        <td>{{ $product->updated_at->format('d-M-Y') }}</td>
                                        <td>
                                            @if($product->image)
                                                <img src="{{ asset('uploads/products/'.$product->image) }}" alt=""
                                                    style="height: 100px">
                                            @else
                                                No Image
                                            @endif
                                        </td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->category ? $product->category->name : 'N/A' }}</td>
                                        <td>{{ $product->subcategory ? $product->subcategory->name : 'N/A' }}</td>
                                        <td>{{ $product->childcategory ? $product->childcategory->name : 'N/A' }}</td>
                                        <td>{{ $product->product_price }}৳</td>
                                        @can('edit-product')
                                        <td>
                                            <div class="material-switch">
                                                <input id="home-{{ $product->id }}" class="toggle-class-home" name="is_home"
                                                    type="checkbox" {{ $product->is_home ? 'checked' : '' }}
                                                    data-id="{{ $product->id }}">
                                                <label for="home-{{ $product->id }}" class="label-success"></label>
                                            </div>
                                        </td>
                                        @endcan
                                        @can('edit-product')
                                        <td>
                                            <div class="material-switch">
                                                <input id="active-{{ $product->id }}" class="toggle-class-active" name="is_active"
                                                    type="checkbox" {{ $product->is_active ? 'checked' : '' }}
                                                    data-id="{{ $product->id }}">
                                                <label for="active-{{ $product->id }}" class="label-success"></label>
                                            </div>
                                        </td>
                                        @endcan
                                        @canany(['edit-product', 'delete-product'])
                                        <td class="text-center">
                                            <div class="action-btns d-flex align-items-center">
                                                <div>
                                                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-sm btn-outline-primary border me-2"
                                                        data-toggle="tooltip" data-placement="top"
                                                        data-bs-original-title="View">
                                                        <i class="fa-solid fa-eye"></i>
                                                    </a>
                                                </div>
                                                <div>
                                                    <a href="{{ route('products.edit', $product->id) }}"
                                                        class="btn btn-sm btn-outline-secondary border me-2"
                                                        data-toggle="tooltip" data-placement="top"
                                                        data-bs-original-title="Edit">
                                                        <i class="fa-solid fa-pen fa-fw"></i>
                                                    </a>
                                                </div>
                                                <div>
                                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                                        class="d-inline">
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
                        {{ $products->links() }}
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
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                            alert('Error loading subcategories');
                        }
                    });
                } else {
                    $('#subcategory_id').empty();
                    $('#subcategory_id').append('<option value="">Select Subcategory</option>');
                }
            });

            $('#subcategory_id').on('change', function() {
                var subcategoryId = $(this).val();

                if(subcategoryId) {
                    $.ajax({
                        url: '/admin/get-childcategories/' + subcategoryId,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('#childcategory_id').empty();
                            $('#childcategory_id').append('<option value="">Select Childcategory</option>');

                            $.each(data, function(key, value) {
                                $('#childcategory_id').append('<option value="' + value.id + '">' + value.name + '</option>');
                            });
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                            alert('Error loading childcategories');
                        }
                    });
                } else {
                    $('#childcategory_id').empty();
                    $('#childcategory_id').append('<option value="">Select Childcategory</option>');
                }
            });

            // Toggle home status
            $('.toggle-class-home').change(function() {
                var product_id = $(this).data('id');
                var status = $(this).prop('checked') === true ? 1 : 0;

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '/admin/check/product/is_home/' + product_id,
                    data: {
                        'product_id': product_id,
                        '_token': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        console.log(data);
                        if (data.type === 'success') {
                            // Show success message
                            Swal.fire({
                                title: data.message,
                                text: data.message,
                                icon: data.type,
                            });
                        } else {
                            // Show error message
                            Swal.fire({
                                title: data.message,
                                text: data.message,
                                icon: data.type,
                            });
                        }
                    },
                    error: function(err) {
                        console.error(err);
                    }
                });
            });

            // Toggle active status
            $('.toggle-class-active').change(function() {
                var product_id = $(this).data('id');
                var status = $(this).prop('checked') === true ? 1 : 0;

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '/admin/check/product/is_active/' + product_id,
                    data: {
                        'product_id': product_id,
                        '_token': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        console.log(data);
                        if (data.type === 'success') {
                            // Show success message
                            Swal.fire({
                                title: data.message,
                                text: data.message,
                                icon: data.type,
                            });
                        } else {
                            // Show error message
                            Swal.fire({
                                title: data.message,
                                text: data.message,
                                icon: data.type,
                            });
                        }
                    },
                    error: function(err) {
                        console.error(err);
                    }
                });
            });

            // Variable product type handling
            $('#product_type').on('change', function() {
                var type = $(this).val();
                if(type === 'variable') {
                    $('#color_field').show();
                    $('#size_field').show();
                } else {
                    $('#color_field').hide();
                    $('#size_field').hide();
                }
            });

            // Dynamic multiple image fields
            let imageFieldCount = 1;
            $(document).on('click', '.addImageField', function() {
                const newField = `
                    <div class="d-flex justify-content-between mb-2" id="multipleImageField${imageFieldCount}">
                        <input type="file" name="multiple_image[]" class="form-control me-4" />
                        <button type="button" class="btn btn-danger removeImageField">-</button>
                    </div>
                `;
                $('#multipleImageFields').append(newField);
                imageFieldCount++;
            });

            $(document).on('click', '.removeImageField', function() {
                $(this).closest('.d-flex').remove();
            });
        });
    </script>
@endpush