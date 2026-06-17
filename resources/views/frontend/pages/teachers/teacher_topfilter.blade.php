<div class="course-sort">
    <div class="course-showing">
        Showing {{ $teachers->firstItem() ?? 0 }}-{{ $teachers->lastItem() ?? 0 }} of {{ $teachers->total() }} Results
    </div>
    <div class="sort-by-options" style="display: inline-block;">
        <select class="select sort-by-select" name="sort_by" id="sort_by">
            <option value="latest" {{ ($selectedSort ?? request('sort_by', 'latest')) === 'latest' ? 'selected' : '' }}>Sort By Latest</option>
            <option value="featured" {{ ($selectedSort ?? request('sort_by')) === 'featured' ? 'selected' : '' }}>Sort By Featured</option>
        </select>
    </div>
</div>
