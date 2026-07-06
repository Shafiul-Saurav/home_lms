@extends('backend.layouts.master')

@section('title', 'Product Subcategory Edit')

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
                        <li class="breadcrumb-item active" aria-current="page">Product Subcategory Edit</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <h3 class="card-title">Update Product Subcategory</h3>
                    <a href="{{ route('product_subcategories.index') }}" class="btn btn-info"><i class="fa-solid fa-angles-left fa-fw"></i> Back</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('product_subcategories.update', $subcategory->slug) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="product_category_id">Category</label>
                                    <select name="product_category_id" class="form-control @error('product_category_id') is-invalid @enderror" id="product_category_id" required>
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ $subcategory->product_category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
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
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ $subcategory->name }}" required>
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

                                    @if($subcategory->file)
                                        <div class="mt-2">
                                            <p>Current File:</p>
                                            <img src="{{ asset('uploads/product_subcategories/' . $subcategory->file) }}" alt="{{ $subcategory->name }}" style="width: 100px; height: 100px; object-fit: contain;" class="img-thumbnail mb-2">
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
@endsection

@push('backend_script')
    @include('backend.pages.common.script')
@endpush
