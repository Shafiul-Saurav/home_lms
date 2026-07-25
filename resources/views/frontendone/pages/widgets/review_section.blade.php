<section class="section-padding review-section" data-aos="fade-up">
    <div class="container">

        <div class="section-heading">
            <span class="sub-title">
                <i class="fa-solid fa-star"></i>
                Testimonials
            </span>
            <h2>What Our Students & Clients Say</h2>
            <p>Hear from students who built practical cyber security skills and clients who trust us for enterprise-grade security services.</p>
        </div>

        <div class="course-filter-wrap mb-3">
            <div class="course-filter-dots" aria-hidden="true">
                <span></span><span></span><span></span>
            </div>

            <div class="course-filter-bar" id="reviewFilterBar">
                <button type="button" class="filter-btn active" id="review-tab-customer" data-filter="customer">Customer</button>
                <button type="button" class="filter-btn" id="review-tab-student" data-filter="student">Student</button>
            </div>

            <div class="course-filter-dots" aria-hidden="true">
                <span></span><span></span><span></span>
            </div>
        </div>

        <div class="review-carousel-wrap">
            <div class="owl-carousel owl-theme review-carousel" id="review-list">
                {{-- Render customer testimonials by default --}}
                @forelse($customerTestimonials ?? collect() as $testimonial)
                    <div class="item">
                        <div class="review-card">
                            <div class="stars">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= (data_get($testimonial, 'rating', 0)))
                                        <i class="fa-solid fa-star"></i>
                                    @else
                                        <i class="fa-regular fa-star"></i>
                                    @endif
                                @endfor
                            </div>

                            <p>{{ data_get($testimonial, 'review', '') }}</p>

                            <div class="review-user">
                                @php
                                    $avatar = data_get($testimonial, 'user.profile.profileImage.profile_image');
                                @endphp
                                <img src="{{ $avatar ? asset($avatar) : asset('assets/frontend/img/testimonial/images.png') }}" alt="">
                                <div>
                                    <h5>{{ data_get($testimonial, 'user.name', data_get($testimonial, 'name', 'Anonymous')) }}</h5>
                                    <span>
                                        @if(data_get($testimonial, 'short_description'))
                                            {{ data_get($testimonial, 'short_description') }}
                                        @else
                                            {{ data_get($testimonial, 'user.role_id') == 4 ? 'Student' : 'Customer' }}
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <p class="text-muted">No customer reviews available yet.</p>
                    </div>
                @endforelse
            </div>

            {{-- Hidden container for customer items (used by JS to swap) --}}
            <div id="review-items-customers" style="display:none;">
                @forelse($customerTestimonials ?? collect() as $testimonial)
                    <div class="item">
                        <div class="review-card">
                            <div class="stars">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= (data_get($testimonial, 'rating', 0)))
                                        <i class="fa-solid fa-star"></i>
                                    @else
                                        <i class="fa-regular fa-star"></i>
                                    @endif
                                @endfor
                            </div>

                            <p>{{ data_get($testimonial, 'review', '') }}</p>

                            <div class="review-user">
                                @php
                                    $avatar = data_get($testimonial, 'user.profile.profileImage.profile_image');
                                @endphp
                                <img src="{{ $avatar ? asset($avatar) : asset('assets/frontend/img/testimonial/images.png') }}" alt="">
                                <div>
                                    <h5>{{ data_get($testimonial, 'user.name', data_get($testimonial, 'name', 'Anonymous')) }}</h5>
                                    <span>
                                        @if(data_get($testimonial, 'short_description'))
                                            {{ data_get($testimonial, 'short_description') }}
                                        @else
                                            {{ data_get($testimonial, 'user.role_id') == 4 ? 'Student' : 'Customer' }}
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <p class="text-muted">No customer reviews available yet.</p>
                    </div>
                @endforelse
            </div>

            {{-- Hidden container for student items (used by JS to swap) --}}
            <div id="review-items-students" style="display:none;">
                @forelse($studentTestimonials ?? collect() as $testimonial)
                    <div class="item">
                        <div class="review-card">
                            <div class="stars">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= (data_get($testimonial, 'rating', 0)))
                                        <i class="fa-solid fa-star"></i>
                                    @else
                                        <i class="fa-regular fa-star"></i>
                                    @endif
                                @endfor
                            </div>

                            <p>{{ data_get($testimonial, 'review', '') }}</p>

                            <div class="review-user">
                                @php
                                    $avatar = data_get($testimonial, 'user.profile.profileImage.profile_image');
                                @endphp
                                <img src="{{ $avatar ? asset($avatar) : asset('assets/frontend/img/testimonial/images.png') }}" alt="">
                                <div>
                                    <h5>{{ data_get($testimonial, 'user.name', data_get($testimonial, 'name', 'Anonymous')) }}</h5>
                                    <span>
                                        @if(data_get($testimonial, 'short_description'))
                                            {{ data_get($testimonial, 'short_description') }}
                                        @else
                                            Student
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <p class="text-muted">No student reviews available yet.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <div class="text-center mt-4">
            @auth
                @if(!auth()->user()->testimonial)
                    <button id="give-testimonial-btn" class="nav-action mt-5" style="border: none;">Give Review</button>
                @endif
            @else
                <a href="{{ route('login') }}" class="nav-action mt-5">Login to Give Review</a>
            @endauth
        </div>

        <!-- Give Review Modal -->
        <div class="modal fade" id="testimonialModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content" style="border-radius: 24px; border: 1px solid #edf0f5; background: #fff; color: #111827; box-shadow: 0 25px 70px rgba(0, 0, 0, 0.13);">
                    <div class="modal-header" style="border-bottom: 1px solid #edf0f5; padding: 24px; position: relative;">
                        <h5 class="modal-title" style="font-weight: 800; font-size: 18px;">Write a Testimonial</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="box-shadow: none;"></button>
                    </div>
                    <div class="modal-body" style="padding: 24px;">
                        <form id="testimonial-form">
                            @csrf
                            <div id="testimonial-validation-errors" class="text-danger mb-3" style="display:none; font-size: 14px; line-height: 1.4;"></div>
                            <div class="mb-4">
                                <label class="form-label" style="font-weight: 700; font-size: 14px; margin-bottom: 8px; display: block; color: #111827;">Rating</label>
                                <div class="rating-stars-container">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i class="star-icon fa-regular fa-star me-2" data-value="{{ $i }}" style="font-size:24px;cursor:pointer;color:#ccc; transition: 0.2s;"></i>
                                    @endfor
                                    <input type="hidden" name="rating" id="testimonial-rating" />
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="form-label" style="font-weight: 700; font-size: 14px; margin-bottom: 8px; display: block; color: #111827;">Short Title</label>
                                <input type="text" name="short_description" class="form-control" placeholder="e.g. SOC Student, Dhaka" maxlength="40" style="border-radius: 12px; border: 1px solid #edf0f5; height: 48px; padding: 10px 16px; font-size: 14px; font-weight: 600;">
                            </div>
                            <div class="mb-4">
                                <label class="form-label" style="font-weight: 700; font-size: 14px; margin-bottom: 8px; display: block; color: #111827;">Review</label>
                                <textarea name="review" class="form-control" rows="4" placeholder="Write your review here..." maxlength="150" style="border-radius: 12px; border: 1px solid #edf0f5; padding: 12px 16px; font-size: 14px; font-weight: 600;"></textarea>
                            </div>
                            <div class="text-end">
                                <button type="submit" id="submit-testimonial-btn" class="nav-action disabled" disabled style="border: none;">SEND REVIEW</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
