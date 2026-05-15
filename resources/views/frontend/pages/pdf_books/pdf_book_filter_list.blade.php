@forelse($pdf_books as $book)
    <div class="col-md-12 col-lg-12 col-xl-6">
        <div class="book-card-horizontal">
            <div class="book-card-image">
                <span class="book-card-tag">PDF</span>
                <a href="{{ route('pdf.book.details', $book->id) }}">
                    <img src="{{ asset('uploads/pdfbooks/images/' . $book->image) }}" alt="{{ $book->name }}" />
                </a>
            </div>
            <div class="book-card-content">
                <div>
                    <span class="book-card-category">{{ $book->pdfBookCategory->name ?? 'Uncategorized' }}</span>
                    <h4 class="book-card-title">
                        <a href="{{ route('pdf.book.details', $book->id) }}">{{ Str::limit($book->name, 40) }}</a>
                    </h4>
                    <p class="book-card-description">{{ Str::limit(strip_tags($book->description), 70) }}</p>
                </div>
                <div class="book-card-bottom">
                    <div class="book-card-price">
                        @if ($book->price == 0)
                            <span class="free">Free</span>
                        @else
                            @if ($book->discount_amount > 0)
                                <span class="original">৳{{ number_format($book->price, 2) }}</span>
                                <span
                                    class="current">৳{{ number_format($book->price - $book->discount_amount, 2) }}</span>
                            @else
                                <span class="current">৳{{ number_format($book->price, 2) }}</span>
                            @endif
                        @endif
                    </div>
                    @if ($book->price == 0 || (isset($purchasedBookIds) && in_array($book->id, $purchasedBookIds)))
                        <a href="{{ route('pdf.book.details', $book->id) }}?tab=download" class="theme-btn py-1">Download</a>
                    @else
                        <a href="{{ route('pdf.book.details', $book->id) }}" class="theme-btn py-1">Buy Now</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@empty
    <div class="col-12 text-center py-5">
        <div class="alert alert-danger text-center" role="alert">
            <h3>No PDF Books Found</h3>
            <p>Sorry, we couldn't find any PDF books matching your filters. Please try adjusting your search criteria.</p>
        </div>
    </div>
@endforelse
