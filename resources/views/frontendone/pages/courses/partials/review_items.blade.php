@forelse($reviews as $review)
    <div class="review-item-modern">
        <div class="review-author-modern">
            @if($review->user && $review->user->profile && $review->user->profile->profileImage)
                <img src="{{ asset($review->user->profile->profileImage->profile_image) }}" alt="{{ $review->user->name }}">
            @else
                <img src="{{ asset('assets/frontend/img/instructor/rev-1.png') }}" alt="User">
            @endif
            <div class="info">
                <div>
                    <h6 class="mb-1">{{ $review->user->name ?? 'User' }}</h6>
                    <small class="text-muted"><i class="fa-regular fa-clock me-1"></i>{{ $review->created_at->diffForHumans() }}</small>
                </div>
                <div class="review-stars">
                    @for($i = 1; $i <= 5; $i++)
                        <i class="fa-{{ $i <= $review->rating ? 'solid' : 'regular' }} fa-star"></i>
                    @endfor
                </div>
            </div>
        </div>
        <p class="mb-0 text-muted">{{ $review->comment }}</p>
    </div>
@empty
    <div class="alert alert-warning mb-0 text-center">No reviews yet. Be the first to review this course!</div>
@endforelse
