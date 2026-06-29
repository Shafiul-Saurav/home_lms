// owl carousel & initialization elements
$(document).ready(function () {
    $('.mentor-carousel').owlCarousel({
        loop: true,
        margin: 24,
        nav: false,
        dots: true,
        autoplay: true,
        autoplayTimeout: 2500,
        autoplayHoverPause: true,
        smartSpeed: 900,
        navText: [
            '<i class="fa-solid fa-arrow-left"></i>',
            '<i class="fa-solid fa-arrow-right"></i>'
        ],
        responsive: {
            0: { items: 1 },
            576: { items: 2 },
            768: { items: 3 },
            992: { items: 4 },
            1200: { items: 5 }
        }
    });

    // Integrated Review Carousel Setup
    $('.review-carousel').owlCarousel({
        loop: true,
        margin: 24,
        nav: false,
        dots: true,
        autoplay: true,
        autoplayTimeout: 3000,
        autoplayHoverPause: true,
        smartSpeed: 900,
        responsive: {
            0: { items: 1 },
            768: { items: 2 },
            1200: { items: 3 }
        }
    });

    $('#heroImageSlider').carousel({
        interval: 3500,
        ride: 'carousel',
        pause: false
    });

    $('.brand-carousel').owlCarousel({
        loop: true,
        margin: 24,
        nav: false,
        dots: false,
        autoplay: true,
        autoplayTimeout: 1700,
        smartSpeed: 900,
        responsive: {
            0: { items: 2 },
            576: { items: 3 },
            768: { items: 4 },
            992: { items: 5 },
            1200: { items: 6 }
        }
    });

    $('.mobile-dropdown-btn').on('click', function () {
        var $submenu = $(this).next('.mobile-submenu');
        var $parent = $(this).parent('li');
        var isOpen = $submenu.hasClass('active');

        // Close all sibling submenus
        $parent.siblings('li').find('.mobile-submenu.active').slideUp(250, function() {
            $(this).removeClass('active');
        });
        $parent.siblings('li').find('.mobile-dropdown-btn i').removeClass('fa-angle-up').addClass('fa-angle-down');

        // Toggle current submenu
        $submenu.slideToggle(250, function() {
            $(this).toggleClass('active');
        });
        $(this).find('i').toggleClass('fa-angle-down fa-angle-up');
    });

    $('#courseFilterBar .filter-btn').on('click', function () {
        var filter = $(this).data('filter');
        $('#courseFilterBar .filter-btn').removeClass('active');
        $(this).addClass('active');

        $('#courseGrid > [data-course-type]').each(function () {
            var type = $(this).data('course-type');
            var show = filter === 'all' || type === filter;
            $(this).toggle(show);
        });
    });

    $('#newsFilterBar .filter-btn').on('click', function () {
        var filter = $(this).data('filter');
        $('#newsFilterBar .filter-btn').removeClass('active');
        $(this).addClass('active');

        $('#newsGrid > [data-news-type]').each(function () {
            var type = $(this).data('news-type');
            $(this).toggle(type === filter);
        });
    });

    $('#newsFilterBar .filter-btn.active').trigger('click');
});

// counter animation
$(document).ready(function () {
    $('.stat-number').each(function () {
        var $this = $(this);
        var fullText = $this.text().trim();
        var targetNum = parseInt(fullText.match(/\d+/), 10);
        var suffix = fullText.replace(/[0-9]/g, '');

        $({ countNum: 0 }).animate({
            countNum: targetNum
        }, {
            duration: 2000,
            easing: 'swing',
            step: function () {
                $this.text(Math.floor(this.countNum) + suffix);
            },
            complete: function () {
                $this.text(targetNum + suffix);
            }
        });
    });
});

// desktop navbar hover fix
$(document).ready(function () {
    var desktopMenuTimers = new WeakMap();

    $(document).on('mouseenter', '.desktop-menu .nav-item.dropdown', function () {
        var item = $(this);
        var timer = desktopMenuTimers.get(this);
        if (timer) clearTimeout(timer);
        item.addClass('show');
        item.children('.dropdown-menu').addClass('show');
    });

    $(document).on('mouseleave', '.desktop-menu .nav-item.dropdown', function () {
        var item = $(this);
        var timer = setTimeout(function () {
            item.removeClass('show');
            item.children('.dropdown-menu').removeClass('show');
            item.find('.dropdown-submenu').removeClass('show').children('.dropdown-menu').removeClass('show');
        }, 220);
        desktopMenuTimers.set(this, timer);
    });

    $(document).on('mouseenter', '.desktop-menu .dropdown-submenu', function () {
        var item = $(this);
        var parent = item.closest('.nav-item.dropdown');
        var timer = desktopMenuTimers.get(parent[0]);
        if (timer) clearTimeout(timer);
        parent.addClass('show');
        item.addClass('show');
        item.children('.dropdown-menu').addClass('show');
    });

    $(document).on('mouseleave', '.desktop-menu .dropdown-submenu', function () {
        $(this).removeClass('show').children('.dropdown-menu').removeClass('show');
    });
});

// Modal and Review Actions Interaction script logic
$(function() {
    $(document).on('click', '#give-testimonial-btn', function() {
        $('#testimonialModal').modal('show');
    });

    $(document).on('mouseover', '.star-icon', function() {
        var v = $(this).data('value');
        $('.star-icon').each(function() {
            if ($(this).data('value') <= v) {
                $(this).removeClass('fa-regular').addClass('fa-solid').css('color', '#ffc107');
            } else {
                $(this).removeClass('fa-solid').addClass('fa-regular').css('color', '#ccc');
            }
        });
    });

    $(document).on('mouseout', '.star-icon', function() {
        var sel = $('#testimonial-rating').val();
        $('.star-icon').each(function() {
            if (sel && $(this).data('value') <= sel) {
                $(this).removeClass('fa-regular').addClass('fa-solid').css('color', '#ffc107');
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

    $(document).on('submit', '#testimonial-form', function(e) {
        e.preventDefault();
        var btn = $('#submit-testimonial-btn');
        btn.prop('disabled', true).text('SENDING...');

        var data = $(this).serialize() + '&theme=frontendone';

        $.ajax({
            url: "{{ route('testimonial.store') }}",
            method: 'POST',
            data: data,
            success: function(res) {
                $('#testimonialModal').modal('hide');
                $('#testimonial-form')[0].reset();
                $('.star-icon').removeClass('fa-solid').addClass('fa-regular').css('color', '#ccc');

                // Clear empty template warnings if they exist before adding
                if ($('.review-carousel').find('.text-muted').length) {
                    $('.review-carousel').trigger('remove.owl.carousel', [0]).trigger('refresh.owl.carousel');
                }

                // Strip down bootstrap grids inside server response before adding element to the active stream
                var dynamicHtml = $(res.testimonial).removeClass('col-lg-4 col-md-6').prop('outerHTML');
                var newSlide = '<div class="item">' + dynamicHtml + '</div>';

                // Append element directly to Owl storage layer safely
                $('.review-carousel').trigger('add.owl.carousel', [newSlide, 0]).trigger('refresh.owl.carousel');

                btn.prop('disabled', false).text('SEND REVIEW');
                Swal.fire({
                    icon: 'success',
                    title: res.success,
                    confirmButtonColor: '#76bd10'
                });
                $('#give-testimonial-btn').remove();
            },
            error: function(xhr) {
                btn.prop('disabled', false).text('SEND REVIEW');
                if (xhr.status === 422) {
                    var errors = xhr.responseJSON.errors || {};
                    Swal.fire('Error', Object.values(errors).map(function(v) { return v[0]; }).join('\n'), 'error');
                } else if (xhr.status === 401) {
                    Swal.fire('Error', 'Please login to post a review.', 'error');
                } else {
                    Swal.fire('Error', 'Failed to send review.', 'error');
                }
            }
        });
    });
});
