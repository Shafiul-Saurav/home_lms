<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<!-- Owl Carousel -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

<!-- Google Font -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

<!-- Custom CSS -->
<link rel="stylesheet" href="{{ asset('assets/frontendone') }}/css/style.css">
<link rel="stylesheet" href="{{ asset('ijaboCropTool/ijaboCropTool.min.css') }}">

@stack('frontendone_style')

<style>
    @media (max-width: 575.98px) {
        .enroll-btn {
            padding: 6px 10px !important;
            width: 100% !important;
            min-width: unset !important;
            display: block;
            text-align: center;
        }
        .course-card-modern .course-bottom form {
            width: 100%;
        }
    }

    .form-control:focus {
        border-color: #74bd0d;
        box-shadow: 0 0 0 0.25rem rgba(116, 189, 13, 0.25);
    }

    .form-select:focus {
        border-color: #74bd0d;
        box-shadow: 0 0 0 0.25rem rgba(116, 189, 13, 0.25);
    }

    .form-check-input:checked {
        background-color: #74bd0d;
        border-color: #74bd0d;
    }
    .form-check-input:focus {
        border-color: #74bd0d;
        box-shadow: 0 0 0 0.25rem rgba(116, 189, 13, 0.25);
    }

    @media (max-width: 575.98px) {
            .course-card-modern .course-content {
                padding: 10px;
            }

            .course-card-modern .course-content h3 {
                font-size: 14px;
                margin-bottom: 5px;
            }

            .course-card-modern .course-content .desc {
                display: none;
            }
            .course-card-modern .course-content .course-meta {
                gap: 10px;
                margin-bottom: 10px;
                font-size: 10px;
            }

            .course-card-modern .price-box h4 {
                font-size: 13px;
                margin-bottom: 0px;
            }

            .course-card-modern .course-bottom {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            .price-old-row {
                line-height: 6.2px;
            }

            .course-card-modern .price-box .price-old-row del {
                font-size: 10px !important;
            }
        }

        .course-card-modern .course-content h3 a {
            color: #000;
            transition: color 0.3s;
        }

        .course-card-modern .course-content h3 a:hover {
            color: #76bd10;
        }

        .course-card-modern .course-content .desc {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            margin-bottom: 12px;
        }

        @media (max-width: 2520px) and (min-width: 1200px) {
            .course-card-modern .course-content {
                padding: 10px;
            }
            .course-card-modern .price-box h4 {
                font-size: 15px !important;
            }
            .course-card-modern .price-box .price-old-row del {
                font-size: 10px !important;
            }
            .enroll-btn {
                min-width: 90px;
                padding: 5px 5px;
                font-size: 11px;
                font-weight: 700;
            }
        }
</style>
        <style>
            /* Use a deeper theme color for text selection across the site */
            ::selection { background: #76bd10; color: #fff; }
            ::-moz-selection { background: #76bd10; color: #fff; }
        </style>
