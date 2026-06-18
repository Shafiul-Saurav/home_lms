<div class="course-sort">
    <div class="course-showing">
        Showing {{ $teachers->firstItem() ?? 0 }}-{{ $teachers->lastItem() ?? 0 }} of {{ $teachers->total() }} Results
    </div>
    <div class="sort-by-options" style="display: inline-block;">
        <select class="select sort-by-select" name="sort_order" id="sort_order" style="min-width:150px;">
            <option value="desc" {{ ($selectedOrder ?? request('sort_order', 'desc')) === 'desc' ? 'selected' : '' }}>Descending</option>
            <option value="asc" {{ ($selectedOrder ?? request('sort_order')) === 'asc' ? 'selected' : '' }}>Ascending</option>
        </select>
    </div>
</div>
