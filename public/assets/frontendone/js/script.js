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

    // Review tab switching (Customer / Student)
    $(document).on('click', '#review-tab-customer, #review-tab-student', function() {
        var isCustomer = $(this).attr('id') === 'review-tab-customer';
        var $btn = $(this);
        $('#review-tab-customer, #review-tab-student').removeClass('active');
        $btn.addClass('active');

        var $carousel = $('.review-carousel');

        // choose the HTML source from hidden containers
        var newHtml = isCustomer ? $('#review-items-customers').html() : $('#review-items-students').html();

        // Replace carousel contents and reinit
        try {
            $carousel.trigger('destroy.owl.carousel');
        } catch (e) {}
        $carousel.html(newHtml || '');
        $carousel.owlCarousel({
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

    function bindCourseFilter(filterBarId, courseGridId) {
        $(filterBarId + ' .filter-btn').on('click', function () {
            var filter = $(this).data('filter');
            $(filterBarId + ' .filter-btn').removeClass('active');
            $(this).addClass('active');

            $(courseGridId).children('[data-course-type]').each(function () {
                var typeStr = $(this).attr('data-course-type') || '';
                var category = $(this).attr('data-course-category') || '';
                var tokens = typeStr.split(/\s+/).filter(Boolean);
                var show = false;
                if (filter === 'all') show = true;
                else if (filter === 'free') {
                    show = tokens.indexOf('free') !== -1;
                } else if (filter === 'paid') {
                    show = tokens.indexOf('paid') !== -1;
                } else if (filter.indexOf('category-') === 0) {
                    show = category === filter;
                } else {
                    show = tokens.indexOf(filter) !== -1;
                }
                $(this).toggle(show);
            });
            if (filter === 'upcoming') {
                $('.google-form-btn').removeClass('d-none');
                $('.google-form-info').removeClass('d-none');
            } else {
                $('.google-form-btn').addClass('d-none');
                $('.google-form-info').addClass('d-none');
            }
        });
    }

    bindCourseFilter('#courseFilterBarPopular', '#course-grid-popular');
    bindCourseFilter('#courseFilterBarType', '#course-grid-type');
    bindCourseFilter('#liveCoursesCategoryFilterBar', '#live-grid');
    bindCourseFilter('#recordedCoursesCategoryFilterBar', '#recorded-grid');
    bindCourseFilter('#freeCoursesCategoryFilterBar', '#free-grid');

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
    // trigger course filter active state on load so each widget initializes independently
    $('#courseFilterBarPopular .filter-btn.active').trigger('click');
    $('#courseFilterBarType .filter-btn.active').trigger('click');
    // Ensure category-based course lists show the first active category by default
    $('#liveCoursesCategoryFilterBar .filter-btn.active').trigger('click');
    $('#recordedCoursesCategoryFilterBar .filter-btn.active').trigger('click');
    $('#freeCoursesCategoryFilterBar .filter-btn.active').trigger('click');
    // AOS initialization temporarily removed for troubleshooting
});

// Google Form redirect (no popup) — show info above button and redirect when clicked
$(document).on('click', '.google-form-btn', function (e) {
    e.preventDefault();
    var url = $(this).attr('href') || '';
    if (!url || url === '#' || url.trim() === '') {
        alert('Google Form URL is not configured. Please contact the site administrator.');
        return;
    }
    // Redirect in the same tab
    window.location.href = url;
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


