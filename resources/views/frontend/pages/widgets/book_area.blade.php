<div class="book-area py-80">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 mx-auto">
                <div class="site-heading text-center wow fadeInDown" data-wow-delay=".25s">
                    <span class="site-title-tagline"><i class="far fa-book"></i> Our Books</span>
                    <h2 class="site-title">Explore Our <span class="text-gradient">Book Collection</span></h2>
                </div>
            </div>
        </div>
        <div class="book-slider owl-carousel owl-theme wow fadeInUp" data-wow-delay=".25s">
            @forelse ($popularBooks as $book)
                <div class="book-card-horizontal">
                    <div class="book-card-image">
                        <span class="book-card-tag">Book</span>
                        <a href="{{ route('book.details', $book->id) }}">
                            <img src="{{ asset('uploads/books/' . $book->image) }}" alt="{{ $book->name }}" />
                        </a>
                    </div>
                    <div class="book-card-content">
                        <div>
                            <span class="book-card-category">{{ $book->bookCategory->name ?? 'Uncategorized' }}</span>
                            <h4 class="book-card-title">
                                <a href="{{ route('book.details', $book->id) }}">{{ Str::limit($book->name, 40) }}</a>
                            </h4>
                            <p class="book-card-description">{{ Str::limit(strip_tags($book->description), 70) }}</p>
                        </div>
                        <div class="book-card-bottom">
                            <div class="book-card-price">
                                @if ($book->discount_amount)
                                    <span class="original">${{ number_format($book->price, 2) }}</span>
                                    <span class="current">${{ number_format($book->price - $book->discount_amount, 2) }}</span>
                                @elseif($book->price > 0)
                                    <span class="current">${{ number_format($book->price, 2) }}</span>
                                @else
                                    <span class="free">Free</span>
                                @endif
                            </div>
                            <a href="{{ route('book.details', $book->id) }}" class="book-buy-btn">Buy Now</a>
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


