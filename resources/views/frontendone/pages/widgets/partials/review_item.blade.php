<div class="item">
    <div class="review-card">
        <div class="stars">
            @for ($i = 1; $i <= 5; $i++)
                @if ($i <= ($testimonial->rating ?? 0))
                    <i class="fa-solid fa-star"></i>
                @else
                    <i class="fa-regular fa-star"></i>
                @endif
            @endfor
        </div>

        <p>{{ $testimonial->review }}</p>

        <div class="review-user">
            @php
                $avatar = data_get($testimonial, 'user.profile.profileImage.profile_image');
            @endphp
            <img src="{{ $avatar ? asset($avatar) : 'https://cdn-icons-png.flaticon.com/512/12965/12965382.png' }}" alt="">
            <div>
                <h5>{{ data_get($testimonial, 'user.name', 'Anonymous') }}</h5>
                <span>
                    @if(data_get($testimonial, 'short_description'))
                        {{ data_get($testimonial, 'short_description') }}
                    @elseif(data_get($testimonial, 'user.role_id') == 4)
                        Student
                    @endif
                </span>
            </div>
        </div>
    </div>
</div>
