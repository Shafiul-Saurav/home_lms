@forelse($pdf_books as $book)
    <div class="col-md-6 col-lg-4">
        <div class="course-item">
            <div class="course-img">
                <a href="{{ route('pdf.book.details', $book->id) }}">
                    <img src="{{ asset('uploads/pdf_books/' . $book->image) }}" alt="{{ $book->name }}">
                </a>
            </div>
            <div class="course-content">
                <div class="course-meta">
                    <span class="category"><i class="far fa-bookmark"></i> {{ $book->pdfBookCategory->name ?? 'Uncategorized' }}</span>
                </div>
                <h4 class="course-title">
                    <a href="{{ route('pdf.book.details', $book->id) }}">{{ Str::limit($book->name, 40) }}</a>
                </h4>
                <div class="course-bottom">
                    <div class="course-price">
                        @if($book->price == 0)
                            <span class="free">Free</span>
                        @else
                            @if($book->discount_amount > 0)
                                <span class="price">৳{{ number_format($book->price - $book->discount_amount, 2) }}</span>
                                <del class="old-price">৳{{ number_format($book->price, 2) }}</del>
                            @else
                                <span class="price">৳{{ number_format($book->price, 2) }}</span>
                            @endif
                        @endif
                    </div>
                    <div class="course-btn">
                        <a href="{{ route('pdf.book.details', $book->id) }}" class="btn btn-sm"><i class="far fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@empty
    <div class="col-12 text-center py-5">
        <div class="no-results">
            <i class="far fa-book-open fa-3x mb-3 text-muted"></i>
            <h4 class="text-muted">No PDF books found matching your criteria.</h4>
        </div>
    </div>
@endforelse
