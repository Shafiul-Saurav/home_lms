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
        height: 220px; /* Fixed height for consistency */
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
        .book-card-price .current, .book-card-price .free {
            font-size: 16px;
        }
    }
</style>
