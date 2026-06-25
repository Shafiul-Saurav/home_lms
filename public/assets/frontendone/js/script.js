//owl carousel
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
            0: {
                items: 1
            },
            576: {
                items: 2
            },
            768: {
                items: 3
            },
            992: {
                items: 4
            },
            1200: {
                items: 5
            }
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
            0: {
                items: 2
            },
            576: {
                items: 3
            },
            768: {
                items: 4
            },
            992: {
                items: 5
            },
            1200: {
                items: 6
            }
        }
    });

    $('.mobile-dropdown-btn').on('click', function () {
        $(this).next('.mobile-submenu').slideToggle(250);
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

//counter animation
$(document).ready(function () {
    $('.stat-number').each(function () {
        var $this = $(this);
        var fullText = $this.text().trim();

        // Separate the numeric value from any string suffixes (e.g., "360K" -> 360 and "K")
        var targetNum = parseInt(fullText.match(/\d+/), 10);
        var suffix = fullText.replace(/[0-9]/g, '');

        // Start counting from 0
        $({
            countNum: 0
        }).animate({
            countNum: targetNum
        }, {
            duration: 2000, // Animation duration in milliseconds (2 seconds)
            easing: 'swing', // Smooth easing effect
            step: function () {
                // Update the text at each frame, rounding down to the nearest whole integer
                $this.text(Math.floor(this.countNum) + suffix);
            },
            complete: function () {
                // Ensure the final exact number and suffix are perfectly set at completion
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