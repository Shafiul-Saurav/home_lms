<div class="col-md-6 col-lg-6 col-xl-4">
    <div class="course-item">
        <span class="course-tag c1">Book</span>
        <div class="course-img">
            <a href="{{ route('book.details', $book->id) }}">
                <img src="{{ asset('uploads/books/' . $book->image) }}" alt="{{ $book->name }}" />
            </a>
        </div>
        <div class="course-content">
            <div class="course-meta">
                <span class="category c1">
                    {{ $book->bookCategory->name ?? 'Uncategorized' }}
                </span>
            </div>
            <h4 class="course-title">
                <a href="{{ route('book.details', $book->id) }}">
                    {{ Str::limit($book->name, 50) }}
                </a>
            </h4>
            <div class="course-info">
                <p>{{ Str::limit(strip_tags($book->description), 80) }}</p>
            </div>
            <div class="course-bottom">
                <div class="course-price">
                    @if ($book->discount_amount)
                        <del class="text-muted">${{ number_format($book->price, 2) }}</del>
                        <span style="color: var(--theme-color2); font-weight: 700;">${{ number_format($book->price - $book->discount_amount, 2) }}</span>
                    @elseif($book->price > 0)
                        <span style="color: var(--theme-color2); font-weight: 700;">${{ number_format($book->price, 2) }}</span>
                    @else
                        <span class="text-success" style="font-weight: 700;">Free</span>
                    @endif
                </div>
            </div>
            <div class="hero-btn">
                <a href="{{ route('book.details', $book->id) }}" class="theme-btn btn-sm w-100 py-1 mt-2">Buy Now</a>
            </div>
        </div>
    </div>
</div>
