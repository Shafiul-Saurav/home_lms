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
                @php
                    $avatar = data_get($testimonial, 'user.profile.profileImage.profile_image');
                @endphp
                <img src="{{ $avatar ? asset($avatar) : asset('assets/frontend/img/testimonial/images.png') }}" alt="{{ data_get($testimonial, 'user.name', 'Anonymous') }}" />
            </div>
            <div class="author-info">
                <h5>{{ data_get($testimonial, 'user.name', 'Anonymous') }}</h5>
                {!! data_get($testimonial, 'user.role_id') == 4 ? '<p>Student</p>' : '' !!}
            </div>
        </div>
    </div>
</div>
