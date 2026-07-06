<aside class="product-sidebar-modern">
    <div class="mb-4">
        <h4 class="widget-title">Search Products</h4>
        <form id="searchForm" action="{{ route('products') }}" method="GET">
            <div class="input-group">
                <input type="text" class="form-control" name="search" id="searchInput"
                    placeholder="Search product" value="{{ request('search') }}">
                <button class="btn btn-dark" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>
        </form>
    </div>

    <div class="mb-4">
        <div class="filter-panel">
            <button type="button" class="filter-panel-header" data-target="#categoryFilterBody"
                aria-expanded="true">
                <span class="widget-title mb-0">Category</span>
                <i class="fa-solid fa-chevron-up filter-toggle-icon"></i>
            </button>
            <div class="filter-panel-body show" id="categoryFilterBody">
                <div class="form-check">
                    <input class="form-check-input category-filter" type="checkbox"
                        value="" id="cat-all"
                        {{ empty(request('category')) ? 'checked' : '' }}>
                    <label class="form-check-label" for="cat-all">All Categories</label>
                </div>
                @foreach($productCategories as $productCategory)
                    <div class="form-check">
                        <input class="form-check-input category-filter" type="checkbox"
                            value="{{ $productCategory->id }}" id="cat-{{ $productCategory->id }}"
                            {{ in_array($productCategory->id, explode(',', request('category', ''))) ? 'checked' : '' }}>
                        <label class="form-check-label" for="cat-{{ $productCategory->id }}">{{ $productCategory->name }} ({{ $productCategory->products_count }})</label>
                    </div>
                    @if($productCategory->subcategories && $productCategory->subcategories->isNotEmpty())
                        <div class="ms-3 mt-2">
                            @foreach($productCategory->subcategories as $subcat)
                                <div class="form-check">
                                    <input class="form-check-input subcategory-filter" type="checkbox"
                                        value="{{ $subcat->id }}" id="subcat-{{ $subcat->id }}"
                                        {{ in_array($subcat->id, explode(',', request('subcategory', ''))) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="subcat-{{ $subcat->id }}">{{ $subcat->name }} @if(isset($subcat->products_count))( {{ $subcat->products_count }} )@endif</label>
                                </div>
                            @endforeach
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>

    {{-- <hr>
    <div class="mb-4">
        <div class="filter-panel">
            <button type="button" class="filter-panel-header" data-target="#priceFilterBody"
                aria-expanded="true">
                <span class="widget-title mb-0">Price</span>
                <i class="fa-solid fa-chevron-up filter-toggle-icon"></i>
            </button>
            <div class="filter-panel-body show" id="priceFilterBody">
                <div class="form-check">
                    <input class="form-check-input price-filter" type="checkbox" value=""
                        id="price-all" {{ empty(request('price')) ? 'checked' : '' }}>
                    <label class="form-check-label" for="price-all">All</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input price-filter" type="checkbox" value="free"
                        id="price-free" {{ in_array('free', explode(',', request('price', ''))) ? 'checked' : '' }}>
                    <label class="form-check-label" for="price-free">Free</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input price-filter" type="checkbox" value="paid"
                        id="price-paid" {{ in_array('paid', explode(',', request('price', ''))) ? 'checked' : '' }}>
                    <label class="form-check-label" for="price-paid">Paid</label>
                </div>
            </div>
        </div>
    </div> --}}
</aside>
