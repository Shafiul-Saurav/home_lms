$(window).on("scroll", (function() {
    //$(this).scrollTop() > 130 ? $(".header-part").addClass("active") : $(".header-part").removeClass("active")
})), $(window).on("scroll", (function() {
    $(this).scrollTop() > 700 ? $(".backtop").show() : $(".backtop").hide()
})), $((function() {
    $(".dropdown-link").click((function() {
        $(this).next().toggle(), $(this).toggleClass("active"), $(".dropdown-list:visible").length > 1 && ($(".dropdown-list:visible").hide(), $(this).next().show(), $(".dropdown-link").removeClass("active"), $(this).addClass("active"))
    }))
})), $(".nav-link").on("click", (function() {
    $(".nav-list li a").removeClass("active"), $(this).addClass("active")
})), $(".header-cate, .cate-btn").on("click", (function() {
    $("body").css("overflow", "hidden"), $(".category-sidebar").addClass("active"), $(".category-close").on("click", (function() {
        $("body").css("overflow", "inherit"), $(".category-sidebar").removeClass("active"), $(".backdrop").fadeOut()
    }))
})), $(".header-user").on("click", (function() {
    $("body").css("overflow", "hidden"), $(".nav-sidebar").addClass("active"), $(".nav-close").on("click", (function() {
        $("body").css("overflow", "inherit"), $(".nav-sidebar").removeClass("active"), $(".backdrop").fadeOut()
    }))
})), $(".header-user, .header-cart, .header-cate, .cart-btn, .cate-btn").on("click", (function() {
    $(".backdrop").fadeIn(), $(".backdrop").on("click", (function() {
        $(this).fadeOut(), $("body").css("overflow", "inherit"), $(".nav-sidebar").removeClass("active"), $(".cart-sidebar").removeClass("active"), $(".category-sidebar").removeClass("active")
    }))
})), $(".coupon-btn").on("click", (function() {
    $(this).hide(), $(".coupon-form").css("display", "flex")
})), $(".header-src").on("click", (function() {

})), $(".wish").on("click", (function() {
    $(this).toggleClass("active")
})), $(".product-add").on("click", (function() {
    var e = $(this).next(".product-action");
    $(this).hide(), e.css("display", "flex")
})), $(".action-plus").on("click", (function() {
    var e = $(this).closest(".product-action").children(".action-input").get(0).value++,
        c = $(this).closest(".product-action").children(".action-minus");
    e > 0 && c.removeAttr("disabled")
})), $(".action-minus").on("click", (function() {
    2 == $(this).closest(".product-action").children(".action-input").get(0).value-- && $(this).attr("disabled", "disabled")
})), $(".review-widget-btn").on("click", (function() {
    $(this).next(".review-widget-list").toggle()
})), $(".offer-select").on("click", (function() {
    $(this).text("Copied!")
})), $(".modal").on("shown.bs.modal", (function(e) {
    $(".preview-slider, .thumb-slider").slick("setPosition", 0)
})), $(".profile-card.schedule").on("click", (function() {
    $(".profile-card.schedule").removeClass("active"), $(this).addClass("active")
})), $(".profile-card.contact").on("click", (function() {
    $(".profile-card.contact").removeClass("active"), $(this).addClass("active")
})), $(".profile-card.address").on("click", (function() {
    $(".profile-card.address").removeClass("active"), $(this).addClass("active")
})), $(".payment-card.payment").on("click", (function() {
    $(".payment-card.payment").removeClass("active"), $(this).addClass("active")
}));

$(".brand-slider").not('.slick-initialized').slick({
        dots: !1,
        infinite: !0,
        autoplay: true,
        arrows: false,
        speed: 500,
        prevArrow: '<i class="icofont-arrow-right dandik"></i>',
        nextArrow: '<i class="icofont-arrow-left bamdik"></i>',
        slidesToShow: 6,
        slidesToScroll: 1,
        responsive: [{
                breakpoint: 1200,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 4
                }
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                },
            },
        ],
    }),
    $(".new-slider").not('.slick-initialized').slick({
        dots: !1,
        infinite: !0,
        autoplay: !0,
        arrows: false,
        speed: 500,
        prevArrow: '<i class="icofont-arrow-right dandik"></i>',
        nextArrow: '<i class="icofont-arrow-left bamdik"></i>',
        slidesToShow: 6,
        slidesToScroll: 1,
        responsive: [{
                breakpoint: 1200,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                    arrows: !1,
                },
            },
        ],
    }),
    $(".home-index-slider").not('.slick-initialized').slick({
        dots: !1,
        fade: !0,
        infinite: !0,
        autoplay: !0,
        arrows: !0,
        speed: 600,
        prevArrow: '<i class="fa fa-arrow-right dandik"></i>',
        nextArrow: '<i class="fa fa-arrow-left bamdik"></i>',
        slidesToShow: 1,
        slidesToScroll: 1,
        responsive: [{
                breakpoint: 1200,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: !1
                },
            },
        ],
    });


var ph = "Search product name . . . . . . . ",
    searchBar = $('#search'),
    phCount = 0;

function placeholder() {
    $(searchBar).attr("placeholder", "");
    printLetter(ph, searchBar);
}
placeholder();
setInterval(function() {
    phCount = 0;
    placeholder();
}, 5000);



function printLetter(string, el) {
    // split string into character seperated array
    var arr = string.split(''),
        input = el,
        // store full placeholder
        origString = string,
        // get current placeholder value
        curPlace = $(input).attr("placeholder"),
        // append next letter to current placeholder
        placeholder = curPlace + arr[phCount];

    setTimeout(function() {
        // print placeholder text
        $(input).attr("placeholder", placeholder);
        // increase loop count
        phCount++;
        // run loop until placeholder is fully printed
        if (phCount < arr.length) {
            printLetter(origString, input);
        }
        // use random speed to simulate
        // 'human' typing
    }, 50);
}