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

        .category-collapse-group {
            border-bottom: 1px solid #e9ecef;
            padding-bottom: 12px;
        }
        .category-collapse-group:last-child {
            border-bottom: none;
        }
        .category-collapse-header {
            cursor: default;
            gap: 10px;
        }
        .category-collapse-toggle {
            color: #102949;
            font-size: 0.95rem;
            border: none;
            background: transparent;
            cursor: pointer;
        }
        .category-collapse-toggle i {
            transition: transform 0.2s ease;
        }
        .category-collapse-toggle i.rotate-180 {
            transform: rotate(180deg);
        }
        .subcategory-list {
            display: none;
        }
        .subcategory-list.show {
            display: block;
        }

        .fixed-cart-panel {
            position: fixed;
            top: 50%;
            right: 24px;
            width: auto;
            z-index: 999;
        }
         .fixed-cart-card {
            border-radius: 18px;
            border: 1px solid rgba(118, 189, 16, 0.18);
            background: #97dd35;
            color: #fff;
            box-shadow: 0 18px 45px rgba(8, 15, 30, 0.14);
            cursor: pointer;
            min-width: 100px;
            padding: 14px 8px;
        }
        .fixed-cart-card:hover {
            transform: translateY(-1px);
            box-shadow: 0 22px 50px rgba(8, 15, 30, 0.18);
        }
        .fixed-cart-card .cart-card-icon-wrap {
            width: 30px;
            height: 30px;
            display: grid;
            place-items: center;
            border-radius: 10px;
            background: #76bd10;
            margin: 0 auto;
        }
        .fixed-cart-card .cart-card-icon {
            font-size: 14px;
            color: #fff;
        }
        .fixed-cart-card .cart-card-count {
            font-size: 15px;
            font-weight: 700;
            margin-bottom: 2px;
            color: #fff;
        }
        .fixed-cart-card .cart-card-total {
            font-size: 14px;
            color: #e8f1ff;
        }

        .cart-sidebar {
            background: #fff;
            color: #111827;
        }
        .cart-sidebar .offcanvas-header {
            padding: 1.25rem 1.5rem;
            background: #fff;
            color: #111827;
        }
        .cart-sidebar .offcanvas-body {
            padding: 1.5rem;
            background: #f8fafc;
        }
        .cart-sidebar .offcanvas-title {
            font-weight: 800;
            color: #0d0f12;
        }
        .cart-sidebar .btn-close {
            filter: invert(0);
        }
        .cart-sidebar-item .btn-outline-danger {
            min-width: 38px;
            min-height: 38px;
            border-radius: 10px;
        }
        .cart-sidebar-item .text-dark {
            color: #111827 !important;
        }
        .cart-sidebar-footer .btn.theme-btn {
            padding: 12px 18px;
        }
        .cart-sidebar-footer .btn-outline-secondary {
            padding: 12px 18px;
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

        @include('frontendone.pages.products.partials.fixed_cart_card')
    </main>
@endsection

@push('frontendone_script')
    @include('frontend.pages.common.script')
    <script>
        $(function() {
            function filterProducts(url) {
                $('#product-grid').css('opacity', '0.55');
                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'json',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    success: function(response) {
                        $('#product-grid').html(response.html);
                        $('#top-filter-area').html(response.topfilter);
                        $('#product-grid').css('opacity', '1');
                        history.pushState({}, '', url);
                    },
                    error: function() {
                        window.location.href = url;
                    }
                });
            }

            function buildFilterUrl(pageUrl = null) {
                let urlParams = new URLSearchParams(window.location.search);
                let search = $('#searchInput').val();
                search ? urlParams.set('search', search) : urlParams.delete('search');

                let categories = [];
                let allCategoriesChecked = false;
                $('.category-filter:checked').each(function() {
                    if ($(this).val() === '') allCategoriesChecked = true;
                    else categories.push($(this).val());
                });
                if (allCategoriesChecked) urlParams.delete('category');
                else if (categories.length > 0) urlParams.set('category', categories.join(','));
                else urlParams.delete('category');

                let subcategories = [];
                $('.subcategory-filter:checked').each(function() {
                    subcategories.push($(this).val());
                });
                if (allCategoriesChecked) urlParams.delete('subcategory');
                else if (subcategories.length > 0) urlParams.set('subcategory', subcategories.join(','));
                else urlParams.delete('subcategory');

                let prices = [];
                let allPricesChecked = false;
                $('.price-filter:checked').each(function() {
                    if ($(this).val() === '') allPricesChecked = true;
                    else prices.push($(this).val());
                });
                if (allPricesChecked) urlParams.delete('price');
                else if (prices.length > 0) urlParams.set('price', prices.join(','));
                else urlParams.delete('price');

                let sortBy = $('#sort_by').val();
                sortBy ? urlParams.set('sort_by', sortBy) : urlParams.delete('sort_by');

                if (pageUrl) {
                    let pageParam = new URL(pageUrl, window.location.origin).searchParams.get('page');
                    if (pageParam) urlParams.set('page', pageParam);
                } else {
                    urlParams.delete('page');
                }

                let query = urlParams.toString();
                return window.location.pathname + (query ? '?' + query : '');
            }

            function setFilterPanelState() {
                $('.filter-panel-header').each(function() {
                    let target = $($(this).data('target'));
                    let expanded = target.hasClass('show');
                    $(this).attr('aria-expanded', expanded ? 'true' : 'false');
                    let icon = $(this).find('.filter-toggle-icon');
                    if (expanded) {
                        icon.removeClass('fa-chevron-down').addClass('fa-chevron-up');
                    } else {
                        icon.removeClass('fa-chevron-up').addClass('fa-chevron-down');
                    }
                });
            }

            $(document).on('click', '.filter-panel-header', function() {
                let target = $($(this).data('target'));
                target.toggleClass('show');
                setFilterPanelState();
            });

            $(document).on('click', '.category-collapse-toggle', function() {
                let button = $(this);
                let target = $($(this).data('target'));
                target.stop(true, true).slideToggle(180, function() {
                    let visible = target.is(':visible');
                    target.toggleClass('show', visible);
                    button.attr('aria-expanded', visible ? 'true' : 'false');
                    button.find('i').toggleClass('rotate-180', visible);
                });
            });

            setFilterPanelState();

            $(document).on('change', '.category-filter, .subcategory-filter, .price-filter, #sort_by', function() {
                filterProducts(buildFilterUrl());
            });

            $(document).on('submit', '#searchForm', function(e) {
                e.preventDefault();
                filterProducts(buildFilterUrl());
            });

            $(document).on('click', '.pagination a', function(e) {
                e.preventDefault();
                filterProducts(buildFilterUrl($(this).attr('href')));
            });
        });
    </script>

@endpush
