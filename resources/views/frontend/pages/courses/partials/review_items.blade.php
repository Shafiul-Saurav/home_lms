@foreach($reviews as $review)
<div class="review-item">
    <div class="review-author">
        @if($review->user && $review->user->profile && $review->user->profile->profileImage)
            <img src="{{ asset($review->user->profile->profileImage->profile_image) }}" alt="{{ $review->user->name }}" />
        @else
            <img src="{{ asset('assets/frontend/img/instructor/rev-1.png') }}" alt="User" />
        @endif
        <div class="info">
            <div>
                <h6>{{ $review->user->name ?? 'User' }}</h6>
                <span><i class="far fa-clock"></i> {{ $review->created_at->diffForHumans() }}</span>
            </div>
            <div class="rating">
                @for($i=1; $i<=5; $i++)
                    <i class="fa{{ $i <= $review->rating ? 's' : 'r' }} fa-star"></i>
                @endfor
            </div>
        </div>
    </div>
    <p>
        {{ $review->comment }}
    </p>
</div>
@endforeach
