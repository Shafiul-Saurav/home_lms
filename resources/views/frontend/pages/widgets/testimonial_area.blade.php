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
                <a href="{{ route('login') }}" class="btn btn-outline-primary">Login to Give Review</a>
            @endauth
        </div>

        <!-- Testimonial Review Modal -->
        <style>
            /* Scoped styles for testimonial modal close button - positioned top-right */
            #testimonialModal .modal-header { position: relative; padding-right: 72px; }

            #testimonialModal .review-modal-close {
                position: absolute;
                right: 16px;
                top: 50%;
                transform: translateY(-50%);
                width: 36px;
                height: 36px;
                min-width: 36px;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                padding: 0;
                border: 0;
                border-radius: 50%;
                background: #f5f5f5;
                color: #333;
                font-size: 18px;
                line-height: 1;
                opacity: 1;
                transition: background 0.2s ease, color 0.2s ease;
                z-index: 10;
            }
            #testimonialModal .review-modal-close:hover {
                background: #ff4d4f;
                color: #fff;
            }
            #testimonialModal .review-modal-close:focus {
                box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.2);
                outline: none;
            }
        </style>

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

        @push('frontend_script')
        <script>
            $(function(){
                // Open modal
                $('#give-testimonial-btn').on('click', function(){
                    $('#testimonialModal').modal('show');
                });

                // Star interactions
                $('.star-icon').on('mouseover', function(){
                    var v = $(this).data('value');
                    $('.star-icon').each(function(){
                        if($(this).data('value') <= v) { $(this).removeClass('far').addClass('fas').css('color','#ffc107'); }
                        else { $(this).removeClass('fas').addClass('far').css('color','#ccc'); }
                    });
                }).on('mouseout', function(){
                    var sel = $('#testimonial-rating').val();
                    $('.star-icon').each(function(){
                        if(sel && $(this).data('value') <= sel) { $(this).removeClass('far').addClass('fas').css('color','#ffc107'); }
                        else { $(this).removeClass('fas').addClass('far').css('color','#ccc'); }
                    });
                }).on('click', function(){
                    var v = $(this).data('value');
                    $('#testimonial-rating').val(v);
                    validateTestimonialForm();
                });

                $('textarea[name="review"]').on('input', validateTestimonialForm);

                function validateTestimonialForm(){
                    var rating = $('#testimonial-rating').val();
                    var review = $('textarea[name="review"]').val().trim();
                    var btn = $('#submit-testimonial-btn');
                    if(rating && review.length > 0){
                        btn.prop('disabled', false).removeClass('disabled');
                    } else {
                        btn.prop('disabled', true).addClass('disabled');
                    }
                }

                // AJAX submit
                $('#testimonial-form').on('submit', function(e){
                    e.preventDefault();
                    var btn = $('#submit-testimonial-btn');
                    btn.prop('disabled', true).text('SENDING...');
                    var data = $(this).serialize();

                    $.ajax({
                        url: "{{ route('testimonial.store') }}",
                        method: 'POST',
                        data: data,
                        success: function(res){
                            $('#testimonialModal').modal('hide');
                            $('#testimonial-form')[0].reset();
                            $('.star-icon').removeClass('fas').addClass('far').css('color','#ccc');
                            // prepend new testimonial
                            $('.testimonial-slider').trigger('destroy.owl.carousel');
                            $('.testimonial-slider').prepend(res.testimonial);
                            // re-init carousel (simple approach)
                            setTimeout(function(){
                                $('.testimonial-slider').owlCarousel();
                            }, 200);
                            btn.prop('disabled', false).text('SEND REVIEW');
                            Swal.fire({icon: 'success', title: res.success, confirmButtonColor: 'var(--theme-color)'});
                            $('#give-testimonial-btn').remove();
                        },
                        error: function(xhr){
                            btn.prop('disabled', false).text('SEND REVIEW');
                            if(xhr.status === 422){
                                var errors = xhr.responseJSON.errors || {};
                                Swal.fire('Error', Object.values(errors).map(function(v){ return v[0]; }).join('\n'), 'error');
                            } else if(xhr.status === 401){
                                Swal.fire('Error', 'Please login to post a review.', 'error');
                            } else {
                                Swal.fire('Error', 'Failed to send review.', 'error');
                            }
                        }
                    });
                });
            });
        </script>
        @endpush
    </div>
</div>
