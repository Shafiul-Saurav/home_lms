<div class="testimonial-item">
    <div class="content">
        <div class="icon">
            <img src="{{ asset('assets/frontend') }}/img/icon/quote.svg" alt="" />
        </div>
        <div class="rating">
            @for ($i = 1; $i <= 5; $i++)
                <i class="fa{{ $i <= ($testimonial->rating ?? 0) ? 's' : 'r' }} fa-star"></i>
            @endfor
        </div>
        <div class="quote">
            <p>{{ $testimonial->review }}</p>
        </div>
        <div class="author">
            <div class="author-img">
                @if(optional($testimonial->user->profile->profileImage)->profile_image)
                    <img src="{{ asset(optional($testimonial->user->profile->profileImage)->profile_image) }}" alt="" />
                @else
                    <img src="{{ asset('assets/frontend/img/testimonial/01.jpg') }}" alt="" />
                @endif
            </div>
            <div class="author-info">
                <h5>{{ $testimonial->user->name ?? 'Anonymous' }}</h5>
                {!! optional($testimonial->user)->role_id == 4 ? '<p>Student</p>' : '' !!}
            </div>
        </div>
    </div>
</div>
