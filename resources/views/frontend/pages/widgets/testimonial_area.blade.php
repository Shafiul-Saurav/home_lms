<div class="testimonial-area ts-bg pt-80 pb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 mx-auto">
                <div class="site-heading text-center wow fadeInDown" data-wow-delay=".25s">
                    <span class="site-title-tagline"><i class="far fa-lightbulb-on"></i> Testimonials</span>
                    <h2 class="site-title">What Our Client <span class="text-gradient">Say's About Us</span></h2>
                </div>
            </div>
        </div>
        <div class="testimonial-slider owl-carousel owl-theme wow fadeInUp" data-wow-delay=".25s">
            @foreach($testimonials ?? collect() as $testimonial)
                @include('frontend.pages.widgets.partials.testimonial_item', ['testimonial' => $testimonial])
            @endforeach
        </div>

        <div class="text-center mt-4">
            @auth
                @if(!auth()->user()->testimonial)
                    <button id="give-testimonial-btn" class="theme-btn mt-5">Give Review</button>
                @endif
            @else
                <a href="{{ route('login') }}" class="theme-btn2 mt-5">Login to Give Review</a>
            @endauth
        </div>

        <div class="modal fade" id="testimonialModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Write a Testimonial</h5>
                        <button type="button" class="review-modal-close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form id="testimonial-form">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Rating</label>
                                <div>
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i class="star-icon far fa-star me-1" data-value="{{ $i }}" style="font-size:20px;cursor:pointer;color:#ccc"></i>
                                    @endfor
                                    <input type="hidden" name="rating" id="testimonial-rating" />
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Short description</label>
                                <input type="text" name="short_description" class="form-control" maxlength="255">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Review</label>
                                <textarea name="review" class="form-control" rows="4" maxlength="255"></textarea>
                            </div>
                            <div class="text-end">
                                <button type="submit" id="submit-testimonial-btn" class="theme-btn mt-5" disabled>SEND REVIEW</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
