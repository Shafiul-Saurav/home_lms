<div class="row align-items-center">
    <div class="col-md-6 col-lg-6">
        <div class="course-sort-left">
            <p>Showing {{ $pdf_books->firstItem() }}-{{ $pdf_books->lastItem() }} of {{ $pdf_books->total() }} Results</p>
        </div>
    </div>
    <div class="col-md-6 col-lg-6">
        <div class="course-sort-right">
            <div class="row g-3 justify-content-md-end">
                <div class="col-md-6 col-lg-5">
                    <select class="form-select" id="pdf-sort-by">
                        <option value="latest" {{ request('sort_by') == 'latest' ? 'selected' : '' }}>Latest</option>
                        <option value="low_price" {{ request('sort_by') == 'low_price' ? 'selected' : '' }}>Price: Low to High</option>
                        <option value="high_price" {{ request('sort_by') == 'high_price' ? 'selected' : '' }}>Price: High to Low</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
