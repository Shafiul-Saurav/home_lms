@extends('frontend.layouts.master')

@section('title', 'Home')

@push('frontend_style')
    <!-- Testimonial Review Modal -->
    <style>
        /* Scoped styles for testimonial modal close button - positioned top-right */
        #testimonialModal .modal-header {
            position: relative;
            padding-right: 72px;
        }

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
@endpush

@section('frontend_content')
    <main class="main">
        <!-- hero area -->
        @include('frontend.pages.widgets.hero_section')
        <!-- hero area end -->

        <!-- partner area -->
        @include('frontend.pages.widgets.partner_area')
        <!-- partner area end -->

        <!-- about area -->
        @include('frontend.pages.widgets.about_area')
        <!-- about area end -->

        <!-- category area -->
        @include('frontend.pages.widgets.category_area')
        <!-- category area end -->

        <!-- course area -->
        @include('frontend.pages.widgets.course_area')
        <!-- course area end -->

        <!-- book area -->
        @include('frontend.pages.widgets.book_area')
        <!-- book area end -->

        <!-- choose area -->
        @include('frontend.pages.widgets.choose_area')
        <!-- choose area end -->

        <!-- counter area -->
        @include('frontend.pages.widgets.counter_area')
        <!-- counter area end -->

        <!-- pricing area -->
        {{-- @include('frontend.pages.widgets.pricing_area') --}}
        <!-- pricing area end -->

        <!-- feature-area -->
        @include('frontend.pages.widgets.feature_area')
        <!-- feature-area end -->

        <!-- video-area -->
        @include('frontend.pages.widgets.video_area')
        <!-- video-area end -->

        <!-- instructor -->
        @include('frontend.pages.widgets.instructor')
        <!-- instructor end -->

        <!-- course tab -->
        @include('frontend.pages.widgets.course_tab')
        <!-- course tab end -->

        <!-- cta area -->
        @include('frontend.pages.widgets.cta_area')
        <!-- cta area end -->

        <!-- process area -->
        @include('frontend.pages.widgets.process_area')
        <!-- process area end -->

        <!-- skill-area -->
        @include('frontend.pages.widgets.skill_area')
        <!-- skill area end -->

        <!-- testimonial-area -->
        @include('frontend.pages.widgets.testimonial_area')
        <!-- testimonial-area end -->

        <!-- blog-area -->
        @include('frontend.pages.widgets.blog_area')
        <!-- blog-area end -->

        <!-- download area -->
        @include('frontend.pages.widgets.download_area')
        <!-- download end -->
    </main>
@endsection

@push('frontend_script')
    <script>
        $(function() {
            // Open modal
            $('#give-testimonial-btn').on('click', function() {
                $('#testimonialModal').modal('show');
            });

            // Star interactions
            $('.star-icon').on('mouseover', function() {
                var v = $(this).data('value');
                $('.star-icon').each(function() {
                    if ($(this).data('value') <= v) {
                        $(this).removeClass('far').addClass('fas').css('color', '#ffc107');
                    } else {
                        $(this).removeClass('fas').addClass('far').css('color', '#ccc');
                    }
                });
            }).on('mouseout', function() {
                var sel = $('#testimonial-rating').val();
                $('.star-icon').each(function() {
                    if (sel && $(this).data('value') <= sel) {
                        $(this).removeClass('far').addClass('fas').css('color', '#ffc107');
                    } else {
                        $(this).removeClass('fas').addClass('far').css('color', '#ccc');
                    }
                });
            }).on('click', function() {
                var v = $(this).data('value');
                $('#testimonial-rating').val(v);
                validateTestimonialForm();
            });

            $('textarea[name="review"]').on('input', validateTestimonialForm);

            function validateTestimonialForm() {
                var rating = $('#testimonial-rating').val();
                var review = $('textarea[name="review"]').val().trim();
                var btn = $('#submit-testimonial-btn');
                if (rating && review.length > 0) {
                    btn.prop('disabled', false).removeClass('disabled');
                } else {
                    btn.prop('disabled', true).addClass('disabled');
                }
            }

            // AJAX submit
            $('#testimonial-form').on('submit', function(e) {
                e.preventDefault();
                var btn = $('#submit-testimonial-btn');
                btn.prop('disabled', true).text('SENDING...');
                var data = $(this).serialize();

                $.ajax({
                    url: "{{ route('testimonial.store') }}",
                    method: 'POST',
                    data: data,
                    success: function(res) {
                        $('#testimonialModal').modal('hide');
                        $('#testimonial-form')[0].reset();
                        $('.star-icon').removeClass('fas').addClass('far').css('color', '#ccc');
                        // prepend new testimonial
                        $('.testimonial-slider').trigger('destroy.owl.carousel');
                        $('.testimonial-slider').prepend(res.testimonial);
                        // re-init carousel (simple approach)
                        setTimeout(function() {
                            $('.testimonial-slider').owlCarousel();
                        }, 200);
                        btn.prop('disabled', false).text('SEND REVIEW');
                        Swal.fire({
                            icon: 'success',
                            title: res.success,
                            confirmButtonColor: 'var(--theme-color)'
                        });
                        $('#give-testimonial-btn').remove();
                    },
                    error: function(xhr) {
                        btn.prop('disabled', false).text('SEND REVIEW');
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors || {};
                            Swal.fire('Error', Object.values(errors).map(function(v) {
                                return v[0];
                            }).join('\n'), 'error');
                        } else if (xhr.status === 401) {
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
