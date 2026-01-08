@extends('backend.layouts.master')

@section('title', 'Product Details')

@push('backend_style')
    @include('backend.pages.common.style')
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Product Details</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Product</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Details</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <h3 class="card-title">Product Details</h3>
                    <a href="{{ route('products.index') }}" class="btn btn-primary">Back to Products</a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <th>Name:</th>
                                    <td>{{ $product->name }}</td>
                                </tr>
                                <tr>
                                    <th>Slug:</th>
                                    <td>{{ $product->slug }}</td>
                                </tr>
                                <tr>
                                    <th>Category:</th>
                                    <td>{{ $product->category ? $product->category->name : 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Subcategory:</th>
                                    <td>{{ $product->subcategory ? $product->subcategory->name : 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Child Category:</th>
                                    <td>{{ $product->childcategory ? $product->childcategory->name : 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Type:</th>
                                    <td>{{ $product->type ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Color:</th>
                                    <td>{{ $product->color ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Size:</th>
                                    <td>{{ $product->size ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Product Quantity:</th>
                                    <td>{{ $product->product_quantity ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Description:</th>
                                    <td>{{ $product->description ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Short Description:</th>
                                    <td>{{ $product->short_description ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Long Description:</th>
                                    <td>{{ $product->long_description ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Additional Info:</th>
                                    <td>{{ $product->additional_info ?? 'N/A' }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <th>Purchase Price:</th>
                                    <td>{{ $product->purchase_price }}</td>
                                </tr>
                                <tr>
                                    <th>Sell Price:</th>
                                    <td>{{ $product->sell_price }}</td>
                                </tr>
                                <tr>
                                    <th>Discount Type:</th>
                                    <td>{{ $product->discount_type ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Discount Amount:</th>
                                    <td>{{ $product->discount_amount ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>In Stock:</th>
                                    <td>
                                        @if ($product->is_stock)
                                            <span class="badge bg-success">Yes</span>
                                        @else
                                            <span class="badge bg-danger">No</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Status:</th>
                                    <td>
                                        @if ($product->is_active)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Show on Home:</th>
                                    <td>
                                        @if ($product->is_home)
                                            <span class="badge bg-success">Yes</span>
                                        @else
                                            <span class="badge bg-danger">No</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Created At:</th>
                                    <td>{{ $product->created_at->format('d M, Y h:i A') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-6">
                            <h5>Main Image</h5>
                            @if ($product->image)
                                <img src="{{ asset('uploads/products') }}/{{ $product->image }}" alt="{{ $product->name }}" class="img-fluid">
                            @else
                                <p>No main image available</p>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <h5>Additional Images</h5>
                            @if ($product->productImages->count() > 0)
                                <div class="row">
                                    @foreach ($product->productImages as $image)
                                        <div class="col-md-4 mb-3">
                                            <img src="{{ asset('uploads/products') }}/{{ $image->multiple_image }}" alt="" class="img-fluid">
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p>No additional images available</p>
                            @endif

                            <h5 class="mt-4">Product Video</h5>
                            @if ($product->video)
                                <video width="100%" height="240" controls>
                                    <source src="{{ asset('uploads/products/' . $product->video) }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            @else
                                <p>No product video available</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
