<link rel="stylesheet" href="{{ asset('assets/frontend') }}/css/bootstrap.min.css" />
<link rel="stylesheet" href="{{ asset('assets/frontend') }}/css/all-fontawesome.min.css" />
<link rel="stylesheet" href="{{ asset('assets/frontend') }}/css/animate.min.css" />
<link rel="stylesheet" href="{{ asset('assets/frontend') }}/css/magnific-popup.min.css" />
<link rel="stylesheet" href="{{ asset('assets/frontend') }}/css/owl.carousel.min.css" />
<link rel="stylesheet" href="{{ asset('assets/frontend') }}/css/nice-select.min.css" />
<link rel="stylesheet" href="{{ asset('assets/frontend') }}/css/style.css" />
<link rel="stylesheet" href="{{ asset('ijaboCropTool/ijaboCropTool.min.css') }}">

@stack('frontend_style')
<style>

    /* Custom styles for the live class notification badge */
    @media (max-width: 768px) {
        .live-count-badge {
            top: -5px !important;
            left: 27px !important;
        }
    }
    .live-count-badge {
        position: absolute;
        top: 20px;
        left: 25px;
        min-width: 18px;
        height: 18px;
        padding: 0 6px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #ff4d4f;
        color: #fff;
        font-size: 0.72rem;
        font-weight: 700;
        border-radius: 999px;
        box-shadow: 0 0 0 rgba(255, 77, 79, 0.4);
        animation: liveBadgePulse 1.5s ease-in-out infinite;
        z-index: 2;
    }

    @keyframes liveBadgePulse {

        0%,
        100% {
            transform: scale(1);
            box-shadow: 0 0 0 rgba(255, 77, 79, 0.4);
        }

        50% {
            transform: scale(1.08);
            box-shadow: 0 0 14px rgba(255, 77, 79, 0.18);
        }
    }

    /*Custom styles for the course area and course cards */
    @media (max-width: 320px) {
        .course-item {
            padding: 5px;
        }

        .course-tag {
            font-size: 12px;
            padding: 1px 6px;
        }

        .course-content {
            padding-top: 8px;
        }

        .course-content .course-title {
            line-height: 0.4;
        }

        .course-content .course-title a {
            font-size: 14px !important;
        }

        .course-meta {
            margin-bottom: 5px;
        }

        .course-meta .rating{
            font-size: 10px;
        }

        .course-meta .category {
            padding: 0px 5px;
        }

        .course-meta .category.c1 {
            font-size: 10px;
        }

        .course-info ul li {
            font-size: 9px;
        }

        .course-bottom {
            padding-top: 5px;
            margin-top: 5px;
        }

        .course-instructor h6 {
            font-size: 12px;
        }

        .course-slider .course-instructor img {
            width: 22px !important;
        }

        .course-price del {
            display: none;
        }

        .course-price span {
            font-size: 10px;
            font-weight: 500;
        }

        .theme-border-btn, .theme-btn2, .theme-btn {
            font-size: 10px;
            padding: 6px 10px;
        }

    }

    @media (max-width: 575.98px) and (min-width: 375px) {
        .course-item {
            padding: 5px;
        }

        .course-tag {
            font-size: 12px;
            padding: 1px 6px;
        }

        .course-content {
            padding-top: 8px;
        }

        .course-content .course-title {
            line-height: 0.4;
        }

        .course-content .course-title a {
            font-size: 14px !important;
        }

        .course-meta {
            margin-bottom: 5px;
        }
        .course-meta .rating{
            font-size: 10px;
        }

        .course-meta .category {
            padding: 0px 5px;
        }

        .course-meta .category.c1 {
            font-size: 10px;
        }

        .course-info ul li {
            font-size: 10px;
        }

        .course-bottom {
            padding-top: 5px;
            margin-top: 5px;
        }

        .course-instructor h6 {
            font-size: 12px;
        }

        .course-slider .course-instructor img {
            width: 22px !important;
        }

        .course-price del {
            font-size: 8px;
            margin-right: 2px;
        }

        .course-price span {
            font-size: 10px;
            font-weight: 500;
        }

        .course-status span {
            font-size: 10px;
        }

        .theme-border-btn, .theme-btn2, .theme-btn {
            font-size: 12px;
            padding: 6px 12px;
        }

    }

    /* Custom styles for the book area and book cards */
    .book-area {
        background: #f8faff;
        position: relative;
        overflow: hidden;
    }

    .book-slider .owl-stage-outer {
        padding: 20px 0;
    }

    .book-card-horizontal {
        display: flex;
        background: #fff;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        transition: all 0.4s ease;
        margin: 10px;
        height: 220px;
        /* Fixed height for consistency */
        border: 1px solid rgba(0, 0, 0, 0.03);
    }

    .book-card-horizontal:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
    }

    .book-card-image {
        flex: 0 0 140px;
        position: relative;
        overflow: hidden;
    }

    .book-card-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
    }

    .book-card-horizontal:hover .book-card-image img {
        transform: scale(1.1);
    }

    .book-card-tag {
        position: absolute;
        top: 10px;
        left: 10px;
        background: var(--theme-color);
        color: #fff;
        padding: 2px 10px;
        border-radius: 20px;
        font-size: 10px;
        font-weight: 600;
        z-index: 1;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .book-card-content {
        flex: 1;
        padding: 20px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .book-card-category {
        font-size: 12px;
        font-weight: 600;
        color: var(--theme-color);
        text-transform: uppercase;
        margin-bottom: 5px;
        display: block;
    }

    .book-card-title {
        font-size: 16px;
        font-weight: 700;
        margin-bottom: 8px;
        line-height: 1.3;
    }

    .book-card-title a {
        color: #222;
        transition: color 0.3s;
    }

    .book-card-title a:hover {
        color: var(--theme-color);
    }

    .book-card-description {
        font-size: 14px;
        color: #666;
        margin-bottom: 15px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .book-card-bottom {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: auto;
    }

    .book-card-price {
        display: flex;
        flex-direction: column;
    }

    .book-card-price .original {
        font-size: 13px;
        text-decoration: line-through;
        color: #999;
    }

    .book-card-price .current {
        font-size: 20px;
        font-weight: 800;
        color: var(--theme-color2);
    }

    .book-card-price .free {
        font-size: 20px;
        font-weight: 800;
        color: #28a745;
    }

    @media (max-width: 576px) {
        .book-card-horizontal {
            height: 180px;
        }

        .book-card-image {
            flex: 0 0 120px;
        }

        .book-card-content {
            padding: 15px;
        }

        .book-card-title {
            font-size: 14px;
        }

        .book-card-description {
            -webkit-line-clamp: 1;
            margin-bottom: 10px;
            font-size: 12px;
        }

        .book-card-price .current,
        .book-card-price .free {
            font-size: 16px;
        }
    }
</style>
