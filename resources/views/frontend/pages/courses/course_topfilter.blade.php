<div class="course-sort">
    <div class="course-showing">
        Showing {{ $courses->firstItem() ?? 0 }}-{{ $courses->lastItem() ?? 0 }} of {{ $courses->total() }} Results
    </div>
    <div class="sort-by-options" style="display: inline-block;">
        <select class="select sort-by-select" name="sort_by" id="sort_by">
            <option value="latest" {{ request('sort_by', 'latest') === 'latest' ? 'selected' : '' }}>Sort By Latest</option>
            <option value="featured" {{ request('sort_by') === 'featured' ? 'selected' : '' }}>Sort By Featured</option>
            <option value="low_price" {{ request('sort_by') === 'low_price' ? 'selected' : '' }}>Sort By Low Price</option>
            <option value="high_price" {{ request('sort_by') === 'high_price' ? 'selected' : '' }}>Sort By High Price</option>
        </select>
    </div>
</div>
