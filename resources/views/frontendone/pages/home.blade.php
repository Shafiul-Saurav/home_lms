@extends('frontendone.layouts.master')

@section('title', 'Home')

@push('frontendone_style')
    @include('frontend.pages.common.style')
    <style>
        .owl-carousel .owl-item .review-user img {
            width: 45px;
            height: 45px;
        }
    </style>
@endpush

@section('frontendone_content')
    <main class="main">
        <!-- Hero Image Slider Only -->
        @include('frontendone.layouts.include.hero-slider')

        <!-- Service Section -->
        @include('frontendone.pages.widgets.service_section')

        <!-- Course Section -->
        @include('frontendone.pages.widgets.course_section')

        <!-- Mentor Section -->
        @include('frontendone.pages.widgets.mentor_section')

        <!-- News Section -->
        @include('frontendone.pages.widgets.news_section')

        <!-- achievement section  -->
        @include('frontendone.pages.widgets.achievement_section')

        <!-- Gallery Section -->
        @include('frontendone.pages.widgets.gallery_section')

        <!-- Brand Logo Carousel -->
        @include('frontendone.pages.widgets.brand_section')

        <!-- Student Review -->
        @include('frontendone.pages.widgets.review_section')

    </main>
@endsection

@push('frontendone_script')
    @include('frontend.pages.common.script')
    <script>
        $(function() {
            // Open modal
            $(document).on('click', '#give-testimonial-btn', function() {
                $('#testimonialModal').modal('show');
            });

            // Star interactions
            $(document).on('mouseover', '.star-icon', function() {
                var v = $(this).data('value');
                $('.star-icon').each(function() {
                    if ($(this).data('value') <= v) {
                        $(this).removeClass('fa-regular').addClass('fa-solid').css('color',
                            '#ffc107');
                    } else {
                        $(this).removeClass('fa-solid').addClass('fa-regular').css('color', '#ccc');
                    }
                });
            });

            $(document).on('mouseout', '.star-icon', function() {
                var sel = $('#testimonial-rating').val();
                $('.star-icon').each(function() {
                    if (sel && $(this).data('value') <= sel) {
                        $(this).removeClass('fa-regular').addClass('fa-solid').css('color',
                            '#ffc107');
                    } else {
                        $(this).removeClass('fa-solid').addClass('fa-regular').css('color', '#ccc');
                    }
                });
            });

            $(document).on('click', '.star-icon', function() {
                var v = $(this).data('value');
                $('#testimonial-rating').val(v);
                validateTestimonialForm();
            });

            $(document).on('input', 'textarea[name="review"]', validateTestimonialForm);
            $(document).on('input', 'input[name="short_description"]', validateTestimonialForm);

            function validateTestimonialForm() {
                var rating = $('#testimonial-rating').val();
                var reviewRaw = $('textarea[name="review"]').val();
                var review = reviewRaw.trim();
                var shortDescriptionRaw = $('input[name="short_description"]').val();
                var shortDescription = shortDescriptionRaw.trim();
                var btn = $('#submit-testimonial-btn');
                var errors = [];

                if (!rating) {
                    errors.push('Rating is required.');
                }

                if (!review.length) {
                    if (reviewRaw.length && review.length === 0) {
                        // whitespace-only input; do not show an error message
                    } else {
                        errors.push('Review is required.');
                    }
                } else if (review.length > 200) {
                    errors.push('Review cannot exceed 200 characters.');
                }

                if (shortDescription.length > 40) {
                    errors.push('Short title cannot exceed 40 characters.');
                }

                if (errors.length) {
                    $('#testimonial-validation-errors').html(errors.join('<br>')).show();
                } else {
                    $('#testimonial-validation-errors').hide().html('');
                }

                if (rating && review.length > 0 && review.length <= 150 && shortDescription.length <= 40) {
                    btn.prop('disabled', false).removeClass('disabled');
                    return true;
                }

                btn.prop('disabled', true).addClass('disabled');
                return false;
            }

            // AJAX submit
            $(document).on('submit', '#testimonial-form', function(e) {
                e.preventDefault();
                var btn = $('#submit-testimonial-btn');
                btn.prop('disabled', true).text('SENDING...');

                // Add theme parameter to request
                var data = $(this).serialize() + '&theme=frontendone';

                $.ajax({
                    url: "{{ route('testimonial.store') }}",
                    method: 'POST',
                    data: data,
                    success: function(res) {
                        $('#testimonialModal').modal('hide');
                        $('#testimonial-form')[0].reset();
                        $('.star-icon').removeClass('fa-solid').addClass('fa-regular').css(
                            'color', '#ccc');

                            // Check if the review list has the empty state
                        if ($('#review-list').find('.text-muted').closest('.col-12').length) {
                            $('#review-list').html(res.testimonial);
                        } else {
                            $('#review-list').prepend(res.testimonial);
                        }

                        btn.prop('disabled', false).text('SEND REVIEW');
                        Swal.fire({
                            icon: 'success',
                            title: res.success,
                            confirmButtonColor: '#76bd10'
                        }).then(function() {
                            window.location.reload();
                        });
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
