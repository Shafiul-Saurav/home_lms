@extends('backend.layouts.master')

@section('title', 'Edit Product')

@push('backend_style')
    @include('backend.pages.common.style')
    <style>
        .multi_img {
            position: relative;
            width: 95px;
            height: 95px;
            overflow: hidden;
        }

        .remove_icon {
            position: absolute;
            top: 0;
            right: 1px;
            opacity: 0;
            z-index: 999;
        }
        .remove_icon .delete-image {
            width: 24px;
            height: 24px;
            line-height: 24px;
        }
        .remove_icon .delete-image i{
            font-size: 22px;
        }

        .multi_img:hover .remove_icon {
            opacity: 1;
            transition: all 0.5s ease;
        }

        .multi_img img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: opacity 0.5s ease;
        }

        .multi_img img:hover {
            opacity: 0.5;
        }
    </style>
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Edit Product</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Product</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <h3 class="card-title">Edit Product</h3>
                    <a href="{{ route('products.index') }}" class="btn btn-info"><i class="fa-solid fa-angles-left fa-fw"></i>
                        Back</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="name">Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name"
                                        value="{{ old('name', $product->name) }}" required>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="slug">Slug</label>
                                    <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror" id="slug"
                                        value="{{ old('slug', $product->slug) }}">
                                    <small class="form-text text-muted">Leave empty to keep the current slug or enter a new one.</small>
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
                                            <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
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
                                        @foreach ($subcategories as $subcategory)
                                            <option value="{{ $subcategory->id }}" {{ old('subcategory_id', $product->subcategory_id) == $subcategory->id ? 'selected' : '' }}>
                                                {!! $subcategory->name !!}
                                            </option>
                                        @endforeach
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
                                        @foreach ($childcategories as $childcategory)
                                            <option value="{{ $childcategory->id }}" {{ old('childcategory_id', $product->childcategory_id) == $childcategory->id ? 'selected' : '' }}>
                                                {!! $childcategory->name !!}
                                            </option>
                                        @endforeach
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
                                        rows="4">{{ old('description', $product->description) }}</textarea>
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
                                        <option value="normal" {{ old('type', $product->type) == 'normal' ? 'selected' : '' }}>Normal</option>
                                        <option value="variable" {{ old('type', $product->type) == 'variable' ? 'selected' : '' }}>Variable</option>
                                    </select>
                                    @error('type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3" id="color_field" style="display: {{ old('type', $product->type) == 'variable' ? 'block' : 'none' }};">
                                <div class="form-group">
                                    <label for="color">Color</label>
                                    <input type="text" name="color" class="form-control @error('color') is-invalid @enderror" id="color"
                                        value="{{ old('color', $product->color) }}">
                                    @error('color')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3" id="size_field" style="display: {{ old('type', $product->type) == 'variable' ? 'block' : 'none' }};">
                                <div class="form-group">
                                    <label for="size">Size</label>
                                    <input type="text" name="size" class="form-control @error('size') is-invalid @enderror" id="size"
                                        value="{{ old('size', $product->size) }}">
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
                                        id="purchase_price" value="{{ old('purchase_price', $product->purchase_price) }}" required>
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
                                        id="sell_price" value="{{ old('sell_price', $product->sell_price) }}" required>
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
                                        id="product_price" value="{{ old('product_price', $product->product_price) }}" required>
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
                                        id="product_discount" value="{{ old('product_discount', $product->product_discount) }}">
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
                                        id="product_quantity" value="{{ old('product_quantity', $product->product_quantity) }}" required>
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
                                        <option value="percentage" {{ old('discount_type', $product->discount_type) == 'percentage' ? 'selected' : '' }}>Percentage</option>
                                        <option value="fixed" {{ old('discount_type', $product->discount_type) == 'fixed' ? 'selected' : '' }}>Fixed Amount</option>
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
                                        id="discount_amount" value="{{ old('discount_amount', $product->discount_amount) }}">
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
                                        <option value="1" {{ old('is_stock', $product->is_stock) == '1' ? 'selected' : '' }}>Yes</option>
                                        <option value="0" {{ old('is_stock', $product->is_stock) == '0' ? 'selected' : '' }}>No</option>
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
                                        <option value="1" {{ old('is_active', $product->is_active) == '1' ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ old('is_active', $product->is_active) == '0' ? 'selected' : '' }}>Inactive</option>
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
                                        <option value="1" {{ old('is_home', $product->is_home) == '1' ? 'selected' : '' }}>Yes</option>
                                        <option value="0" {{ old('is_home', $product->is_home) == '0' ? 'selected' : '' }}>No</option>
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
                                    <label for="product_image">Product Image</label>
                                    <input type="file" name="product_image" class="form-control @error('product_image') is-invalid @enderror" id="product_image">
                                    @error('product_image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    @if($product->product_image && $product->product_image != 'default_product.webp')
                                        <div class="mt-2">
                                            <p>Current Product Image:</p>
                                            <img src="{{ asset('uploads/products/') }}/{{ $product->product_image }}" alt="{{ $product->name }}" style="max-width: 200px; max-height: 200px;">
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="short_description">Short Description</label>
                                    <textarea name="short_description" id="short_description" class="form-control @error('short_description') is-invalid @enderror" rows="3">{{ old('short_description', $product->short_description) }}</textarea>
                                    @error('short_description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="long_description">Long Description</label>
                                    <textarea name="long_description" id="long_description" class="form-control @error('long_description') is-invalid @enderror" rows="5">{{ old('long_description', $product->long_description) }}</textarea>
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
                                    <textarea name="additional_info" id="additional_info" class="form-control @error('additional_info') is-invalid @enderror" rows="5">{{ old('additional_info', $product->additional_info) }}</textarea>
                                    @error('additional_info')
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
                                    @if($product->image)
                                        <div class="mt-2">
                                            <p>Current Main Image:</p>
                                            <img src="{{ asset('uploads/products/' . $product->image) }}" alt="{{ $product->name }}" style="max-width: 200px; max-height: 200px;">
                                        </div>
                                    @endif
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
                                    @if($product->product_image && $product->product_image != 'default_product.webp')
                                        <div class="mt-2">
                                            <p>Current Product Image:</p>
                                            <img src="{{ asset('uploads/products/' . $product->product_image) }}" alt="{{ $product->name }}" style="max-width: 200px; max-height: 200px;">
                                        </div>
                                    @endif
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

                                    @if($product->productImages->count() > 0)
                                        <div class="mt-2">
                                            <p>Current Multiple Images:</p>
                                            <div class="row">
                                                @foreach($product->productImages as $image)
                                                    <div class="col-md-2 mb-2">
                                                        <img src="{{ asset('uploads/products/' . $image->multiple_image) }}" alt="Product Image" style="width: 100%; height: auto;">
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-secondary">Update</button>
                    </form>
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