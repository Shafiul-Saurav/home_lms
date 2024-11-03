<section class="testimonials-area pb-100">
    <div class="container">
        <div class="section-title">
            <span>Testimonials</span>
            <h2>What customers say</h2>
        </div>
        <div class="testimonials-wrap owl-carousel owl-theme">
            @forelse ($testimonials as $testimonial)
                <div class="single-testimonials single_testimonial"
                    style="background-image: url('{{ asset('assets/frontend/img/testimonials/testimonials-bg.png') }}')">
                    <ul>
                        @for ($i = 1; $i <= 5; $i++)
                            <li class=""><i
                                    class="bx bxs-star {{ $i <= $testimonial->rating ? 'text_warning' : 'text_light' }}"></i>
                            </li>
                        @endfor
                    </ul>
                    <h3>{{ $testimonial->review }}</h3>
                    <p>“{{ $testimonial->short_description }}”</p>
                    <div class="testimonials-content">
                        @if ($testimonial->user->profile->profileImage ?? null)
                            <img src="{{ asset($testimonial->user->profile->profileImage->profile_image ?? null) }}"
                                alt="Image">
                        @else
                            <img src="{{ asset('profile/default_profile.png') }}" alt="Image">
                        @endif
                        <h4>{{ $testimonial->user->name ?? null }}</h4>
                        <span>{{ $testimonial->user->email ?? null }}</span>
                    </div>
                </div>
            @empty

            @endforelse
        </div>
    </div>
</section>
