@extends('frontendone.layouts.master')

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
        .product-hero .product-kicker {
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
            height: 260px;
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
        .product-card-modern .price-box h4 {
            margin-bottom: 0;
            color: #16335c;
            font-size: 1.4rem;
            font-weight: 700;
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
        .product-card-modern .theme-btn {
            min-width: 120px;
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
            height: 260px;
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
        .product-card-modern .price-box h4 {
            margin-bottom: 0;
            color: #16335c;
            font-size: 1.4rem;
            font-weight: 700;
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
        .product-card-modern .theme-btn {
            min-width: 120px;
        }
        .product-sidebar-modern,
        .product-grid-shell {
            background: #fff;
            border-radius: 28px;
            box-shadow: 0 18px 50px rgba(8,15,30,0.08);
        }
        .product-sidebar-modern {
            position: sticky;
            top: 110px;
            padding: 24px;
        }
        .product-sidebar-modern .widget-title {
            font-size: 1.05rem;
            font-weight: 800;
            margin-bottom: 16px;
            color: #102949;
        }
        .product-sidebar-modern .form-control,
        .product-sidebar-modern .form-select {
            border-radius: 14px;
            min-height: 48px;
        }
        .filter-panel {
            border: 1px solid #e9ecef;
            border-radius: 18px;
            overflow: hidden;
        }
        .filter-panel-header {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            padding: 14px 16px;
            background: #f8f9fa;
            border: none;
            outline: none;
            cursor: pointer;
            font-size: 1rem;
            color: #102949;
        }
        .filter-panel-header .widget-title {
            margin-bottom: 0;
            font-size: 1.05rem;
            font-weight: 800;
        }
        .filter-panel-body {
            padding: 0 16px 16px;
            display: none;
        }
        .filter-panel-body.show {
            display: block;
        }

        .filter-panel-body .form-check-label {
            font-size: 13px;
        }

        .filter-panel-body button i{
            font-size: 12px;
        }
        @media (max-width: 991px) {
            .product-hero { padding-top: 100px; }
        }
    </style>
@endpush

@section('frontendone_content')
    <main class="main">
        <x-frontend.pages.common.breadcrumb
            :title="$category->name . ' Products'"
            :breadcrumb="[
                ['name' => 'Home', 'url' => route('home')],
                ['name' => $category->name . ' Products', 'url' => '#']
            ]"
        />
        <section class="section-padding py-5">
            <div class="container">
                <div class="row g-4">
                    <div class="col-lg-4 col-xl-3">
                        @include('frontendone.pages.products.partials.sidebar')
                    </div>

                    <div class="col-lg-8 col-xl-9">
                        <div class="product-grid-shell p-4">
                            <div id="top-filter-area">
                                @include('frontendone.pages.products.product_topfilter', [
                                    'products' => $products,
                                ])
                            </div>

                            <div id="product-grid">
                                @if($products->count() > 0)
                                    <div class="row g-4 product-grid-area">
                                        @foreach($products as $product)
                                            @include('frontendone.pages.products.product_item')
                                        @endforeach
                                    </div>

                                    <div class="col-12 mt-4" id="pagination-wrapper">
                                        @include('frontendone.pages.products.partials.pagination')
                                    </div>
                                @else
                                    <div class="alert alert-warning text-center mb-0">
                                        <h3>No Products Found</h3>
                                        <p>We couldn't find any products in this category right now. Please check back later or browse another category.</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@push('frontendone_script')
    @include('frontend.pages.common.script')

@endpush
