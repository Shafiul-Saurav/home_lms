@php
    $totalProductCount = 0;
    if (!empty($groupedProducts)) {
        foreach ($groupedProducts as $catId => $productsList) {
            $totalProductCount += $productsList->count();
        }
    }
@endphp

@if ($totalProductCount > 0)
    @foreach ($productCategories as $pc)
        @if (!empty($groupedProducts[$pc->id]) && $groupedProducts[$pc->id]->count() > 0)
            <div class="mb-5">
                <h3 class="mb-3" style="font-weight: 700; color:#76bd10;">{{ $pc->name }}</h3>
                <div class="row g-4 product-grid-area">
                    @foreach ($groupedProducts[$pc->id] as $product)
                        @include('frontendone.pages.products.product_item')
                    @endforeach
                </div>
            </div>
        @endif
    @endforeach
@else
    <div class="alert alert-warning text-center mb-0">
        <h3>No Products Found</h3>
        <p>We couldn't find any products right now. Please check back later or try a different search.</p>
    </div>
@endif
