<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div class="text-muted fw-semibold">Showing {{ $courses->firstItem() ?? 0 }}-{{ $courses->lastItem() ?? 0 }} of {{ $courses->total() }} Results</div>
    <div style="min-width:220px;">
        <select class="form-select sort-by-select" name="sort_by" id="sort_by">
            <option value="latest" {{ request('sort_by', 'latest') === 'latest' ? 'selected' : '' }}>Sort By Latest</option>
            <option value="featured" {{ request('sort_by') === 'featured' ? 'selected' : '' }}>Sort By Featured</option>
            <option value="low_price" {{ request('sort_by') === 'low_price' ? 'selected' : '' }}>Sort By Low Price</option>
            <option value="high_price" {{ request('sort_by') === 'high_price' ? 'selected' : '' }}>Sort By High Price</option>
        </select>
    </div>
</div>
