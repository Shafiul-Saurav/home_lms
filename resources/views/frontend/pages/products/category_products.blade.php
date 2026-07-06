@extends('frontend.layouts.master')

@section('title', $category->name . ' Products')

@push('frontendone_style')
    @include('frontend.pages.common.style')
    <style>
        .product-hero {
            padding: 120px 0 80px;
            background: linear-gradient(135deg, #07111f 0%, #0d1f36 50%, #12345a 100%);
            color: #fff;
        }
        .product-hero h1 {
            font-size: clamp(2.2rem, 4vw, 4.2rem);
            font-weight: 800;
            margin: 0;
        }
        .product-hero .breadcrumb-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 14px;
            border-radius: 999px;
            background: rgba(255,255,255,.12);
            font-weight: 700;
        }
        .product-card-modern {
            border-radius: 24px;
            overflow: hidden;
            transition: transform .25s ease, box-shadow .25s ease;
            background: #fff;
            box-shadow: 0 18px 50px rgba(8,15,30,.06);
        }
        .product-card-modern:hover {
            transform: translateY(-4px);
            box-shadow: 0 24px 60px rgba(8,15,30,.1);
        }
        .product-thumb img {
            width: 100%;
            height: 230px;
            object-fit: cover;
        }
        .product-card-modern .product-content {
            padding: 24px;
        }
        .product-card-modern h3 {
            font-size: 1.2rem;
            margin-bottom: 12px;
        }
        .product-card-modern .desc {
            margin-bottom: 16px;
            color: #556679;
        }
        .product-card-modern .price-box {
            margin-bottom: 18px;
        }
        .product-card-modern .price-box h4 {
            font-size: 1.4rem;
            margin-bottom: 0;
            color: #16335c;
        }
        .product-card-modern .price-old-row del {
            color: #9aa1af;
            font-size: .95rem;
        }
        .product-card-modern .price-old-row .discount {
            color: #74bd0d;
            font-weight: 700;
            margin-left: 10px;
        }
        .theme-btn.py-1 {
            padding: 9px 18px;
        }
        @media (max-width: 991px) {
            .product-hero {
                padding-top: 100px;
            }
        }
    </style>
@endpush

@section('frontend_content')
    <main class="main">
        <x-frontend.pages.common.breadcrumb
            :title="$category->name . ' Products'"
            :breadcrumb="[
                ['name' => 'Home', 'url' => route('home')],
                ['name' => $category->name . ' Products', 'url' => '#']
            ]"
        />

        <section class="product-hero">
            <div class="container">
                <div class="row align-items-end">
                    <div class="col-lg-8">
                        <span class="breadcrumb-pill"><i class="fa-solid fa-box-open"></i> {{ $category->name }}</span>
                        <h1 class="mt-3">{{ $category->name }} Products</h1>
                        <p class="mb-0" style="max-width:720px;color:rgba(255,255,255,.78)">Browse products in the {{ $category->name }} category. Discover featured items, fresh arrivals and best selling products.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-padding py-5">
            <div class="container">
                <div class="row g-4">
                    @if($products->count() > 0)
                        @foreach($products as $product)
                            @include('frontend.pages.products.product_item')
                        @endforeach

                        <div class="col-12 mt-4" id="pagination-wrapper">
                            @include('frontend.pages.products.partials.pagination')
                        </div>
                    @else
                        <div class="col-12">
                            <div class="alert alert-warning text-center mb-0">
                                <h3>No Products Found</h3>
                                <p>We couldn't find any products in this category right now. Please check back later or browse another category.</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    </main>
@endsection

@push('frontendone_script')
    @include('frontend.pages.common.script')
@endpush
