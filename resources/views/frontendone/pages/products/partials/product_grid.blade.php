@if(!empty($selectedCategoryName))
    <div class="mb-3">
        <h3 class="mb-2">{{ $selectedCategoryName }}</h3>
    </div>
@endif

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
        <p>We couldn't find any products right now. Please check back later or try a different search.</p>
    </div>
@endif
