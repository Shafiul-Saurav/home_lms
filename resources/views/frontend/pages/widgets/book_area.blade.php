<div class="course-area bg-img py-80">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 mx-auto">
                <div class="site-heading text-center wow fadeInDown" data-wow-delay=".25s">
                    <span class="site-title-tagline"><i class="far fa-book"></i> Our Books</span>
                    <h2 class="site-title">Explore Our <span class="text-gradient">Book Collection</span></h2>
                </div>
            </div>
        </div>
        <div class="course-slider owl-carousel owl-theme wow fadeInUp" data-wow-delay=".25s">
            @forelse ($popularBooks as $book)
                <div class="course-item">
                    <span class="course-tag c1">Book</span>
                    <div class="course-img">
                        <a href="{{ route('book.details', $book->id) }}">
                            <img src="{{ asset('uploads/books/' . $book->image) }}" alt="{{ $book->name }}" />
                        </a>
                    </div>
                    <div class="course-content">
                        <div class="course-meta">
                            <span class="category c1">{{ $book->bookCategory->name ?? 'Uncategorized' }}</span>
                        </div>
                        <h4 class="course-title">
                            <a href="{{ route('book.details', $book->id) }}">{{ Str::limit($book->name, 50) }}</a>
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
            @empty
                <div class="col-12 text-center">
                    <p>No books available at the moment.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
