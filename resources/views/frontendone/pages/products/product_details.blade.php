@extends('frontendone.layouts.master')

@section('title', $productInfo->name . ' | Product')

@push('frontendone_style')
@include('frontend.pages.common.style')
    <style>
        .product-detail-hero {
            padding: 120px 0 70px;
            background: linear-gradient(135deg, #07111f 0%, #0d1f36 50%, #12345a 100%);
            color: #fff;
        }
        .product-detail-hero h1 {
            font-size: clamp(2.2rem, 4vw, 4.2rem);
            font-weight: 800;
            margin-bottom: 14px;
        }
        .product-detail-hero .meta-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 14px;
            border-radius: 999px;
            background: rgba(255,255,255,.12);
            margin-right: 10px;
            margin-bottom: 10px;
        }
        .product-detail-card,
        .product-aside-card,
        .product-tab-card {
            background: #fff;
            border-radius: 24px;
            box-shadow: 0 18px 50px rgba(8,15,30,.08);
        }
        .product-detail-card {
            padding: 28px;
        }
        .product-detail-card .price-box {
            margin-bottom: 20px;
        }
        .product-detail-card .price-box h2 {
            margin: 0;
            font-size: 2rem;
            color: #16335c;
            font-weight: 900;
        }
        .product-detail-card .price-old-row del {
            color: #9aa1af;
            font-size: 1rem;
        }
        .product-detail-tabs .nav-link {
            border-radius: 999px;
            padding: 10px 18px;
        }
        .product-detail-tabs .nav-link.active {
            background: #0d1f36;
            color: #fff;
        }
        .product-detail-tabs .tab-panel-box {
            background: #fff;
            border-radius: 24px;
            padding: 28px;
            box-shadow: 0 18px 50px rgba(8,15,30,.08);
        }
        .related-product-card {
            border-radius: 24px;
            overflow: hidden;
            background: #fff;
            box-shadow: 0 18px 50px rgba(8,15,30,.08);
        }
        .related-product-card img {
            width: 100%;
            height: 120px;
            object-fit: cover;
        }
        .product-gallery-main img {
            width: 100%;
            height: auto;
            object-fit: contain;
        }
        .product-gallery-thumbs button img {
            border: 2px solid transparent;
            transition: border-color 0.2s ease;
        }
        .product-gallery-thumbs button img.active {
            border-color: #76bd10;
        }
        @media (max-width: 991px) {
            .product-detail-hero {
                padding-top: 100px;
            }
        }
    </style>
@endpush

@section('frontendone_content')
    <main class="main">
        <x-frontend.pages.common.breadcrumb
            :title="$productInfo->name"
            :breadcrumb="[
                ['name' => 'Home', 'url' => route('home')],
                ['name' => $productInfo->category->name ?? 'Products', 'url' => $productInfo->category_id ? route('category.products', $productInfo->category_id) : route('home')],
                ['name' => $productInfo->name, 'url' => '#']
            ]"
        />

        <section class="product-detail-hero">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <span class="meta-pill"><i class="fa-solid fa-tags"></i> {{ $productInfo->subcategory->name ?? $productInfo->category->name ?? 'Uncategorized' }}</span>
                        <h1>{{ $productInfo->name }}</h1>
                        <p class="mb-0" style="max-width:760px;color:rgba(255,255,255,.82);">{!! Str::limit(strip_tags($productInfo->long_description ?? $productInfo->description), 200) !!}</p>
                        <div class="mt-4">
                            <span class="meta-pill"><i class="fa-solid fa-box"></i> {{ $productInfo->product_quantity ?? 'Stock info unavailable' }}</span>
                            <span class="meta-pill"><i class="fa-solid fa-calendar-days"></i> Updated {{ optional($productInfo->updated_at)->format('M d, Y') }}</span>
                            <span class="meta-pill"><i class="fa-solid fa-circle-check"></i> {{ $productInfo->is_stock ? 'In Stock' : 'Out of Stock' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-padding py-5">
            <div class="container">
                <div class="row g-4">
                    <div class="col-lg-8">
                        <div class="product-detail-card mb-4">
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="product-gallery">
                                        <div class="product-gallery-main mb-3">
                                            @php
                                                $galleryImages = collect();
                                                if (!empty($productInfo->image)) {
                                                    $galleryImages->push('uploads/products/' . $productInfo->image);
                                                }
                                                $productInfo->productImages->each(function ($image) use ($galleryImages) {
                                                    $galleryImages->push('uploads/products/' . $image->multiple_image);
                                                });
                                                $galleryImages = $galleryImages->unique();
                                                $mainImage = $galleryImages->first() ? asset($galleryImages->first()) : asset('assets/frontend/img/default-product.png');
                                            @endphp
                                            <img id="mainProductImage" src="{{ $mainImage }}" alt="{{ $productInfo->name }}" class="img-fluid rounded-4">
                                        </div>

                                        @if($galleryImages->count() > 1)
                                            <div class="row g-2 product-gallery-thumbs">
                                                @foreach($galleryImages as $index => $galleryImage)
                                                    <div class="col-3">
                                                        <button type="button" class="product-gallery-thumb p-0 border-0 bg-transparent" data-image="{{ asset($galleryImage) }}">
                                                            <img src="{{ asset($galleryImage) }}" alt="{{ $productInfo->name }} thumbnail" class="img-fluid rounded-4{{ $index === 0 ? ' active' : '' }}">
                                                        </button>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="price-box mb-4">
                                        @if($productInfo->discount_amount && $productInfo->discount_amount > 0)
                                            <h2>${{ number_format($productInfo->sell_price - $productInfo->discount_amount, 2) }}</h2>
                                            <div class="price-old-row">
                                                <del>${{ number_format($productInfo->sell_price, 2) }}</del>
                                                <span class="discount">{{ round(($productInfo->discount_amount / max($productInfo->sell_price, 1)) * 100) }}% OFF</span>
                                            </div>
                                        @elseif($productInfo->sell_price > 0)
                                            <h2>${{ number_format($productInfo->sell_price, 2) }}</h2>
                                        @else
                                            <h2 class="text-success">Free</h2>
                                        @endif
                                    </div>
                                    <ul class="list-unstyled mb-4">
                                        <li><strong>Category:</strong> {{ $productInfo->category->name ?? 'Uncategorized' }}</li>
                                        <li><strong>Subcategory:</strong> {{ $productInfo->subcategory->name ?? 'N/A' }}</li>
                                        <li><strong>Available Quantity:</strong> {{ $productInfo->product_quantity ?? 'N/A' }}</li>
                                    </ul>
                                    <form action="{{ route('cart.add') }}" method="POST" class="d-flex gap-2 align-items-center flex-wrap">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $productInfo->id }}">
                                        <input type="number" name="qty" value="1" min="1" class="form-control form-control-sm" style="width:100px;">
                                        <button type="submit" class="theme-btn py-1">Add to Cart</button>
                                    </form>
                                    <a href="#product-description" class="theme-btn py-1 ms-2">See Details</a>
                                </div>
                            </div>
                        </div>

                        <div class="product-detail-tabs">
                            <ul class="nav nav-tabs mb-4" role="tablist">
                                <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#product-description" type="button">Description</button></li>
                                <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#product-additional" type="button">Additional Info</button></li>
                                <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#product-specs" type="button">Specifications</button></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="product-description">
                                    <div class="tab-panel-box">
                                        {!! $productInfo->long_description ?? $productInfo->description !!}
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="product-additional">
                                    <div class="tab-panel-box">
                                        {!! $productInfo->additional_info ?? '<p>No additional information available.</p>' !!}
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="product-specs">
                                    <div class="tab-panel-box">
                                        <dl class="row mb-0">
                                            <dt class="col-sm-4">Product Name</dt>
                                            <dd class="col-sm-8">{{ $productInfo->name }}</dd>
                                            <dt class="col-sm-4">Category</dt>
                                            <dd class="col-sm-8">{{ $productInfo->category->name ?? 'Uncategorized' }}</dd>
                                            <dt class="col-sm-4">Subcategory</dt>
                                            <dd class="col-sm-8">{{ $productInfo->subcategory->name ?? 'N/A' }}</dd>
                                            <dt class="col-sm-4">SKU</dt>
                                            <dd class="col-sm-8">{{ $productInfo->slug }}</dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="product-aside-card p-4 mb-4">
                            <h4 class="mb-4">Related Products</h4>
                            @forelse($relatedProducts as $related)
                                <div class="d-flex gap-3 mb-3 align-items-center">
                                    <a href="{{ route('product.details', $related->slug) }}" class="flex-shrink-0" style="width:80px;">
                                        @if(!empty($related->image))
                                            <img src="{{ asset('uploads/products/' . $related->image) }}" alt="{{ $related->name }}" class="rounded-4 w-100" style="height:80px;object-fit:cover;">
                                        @elseif($related->productImages->first())
                                            <img src="{{ asset('uploads/products/' . $related->productImages->first()->multiple_image) }}" alt="{{ $related->name }}" class="rounded-4 w-100" style="height:80px;object-fit:cover;">
                                        @else
                                            <img src="{{ asset('assets/frontend/img/default-product.png') }}" alt="{{ $related->name }}" class="rounded-4 w-100" style="height:80px;object-fit:cover;">
                                        @endif
                                    </a>
                                    <div>
                                        <h6 class="mb-1" style="font-size:14px;"><a href="{{ route('product.details', $related->slug) }}">{{ Str::limit($related->name, 40) }}</a></h6>
                                        <span class="text-muted" style="font-size:14px;">${{ number_format($related->sell_price - ($related->discount_amount ?? 0), 2) }}</span>
                                    </div>
                                </div>
                            @empty
                                <p class="text-muted mb-0">No related products available.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@push('frontendone_script')
    <script>
        $(function() {
            $(document).on('click', '.product-gallery-thumb', function() {
                var imageUrl = $(this).data('image');
                $('#mainProductImage').attr('src', imageUrl);
                $('.product-gallery-thumb img').removeClass('active');
                $(this).find('img').addClass('active');
            });
        });
    </script>
@endpush

