@extends('frontendone.layouts.master')

@section('title', 'About')

@push('frontendone_style')
    @include('frontend.pages.common.style')
    <style>
        .about-area {
            padding: 150px 0 50px 0;
            background-color: #000;
        }

        .section-heading {
            max-width: 920px !important;
        }

        .about-area .section-heading {
            text-align: center;
            margin-bottom: 50px;
        }

        .about-area .section-heading .sub-title {
            font-size: 18px;
            color: #76bd10;
            display: inline-block;
            margin-bottom: 10px;
        }

        .about-area .section-heading h1 {
            font-size: 60px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #fff;
        }

        .about-area .section-heading p {
            font-size: 16px;
            color: #fff;
            max-width: 600px;
            margin: 0 auto;
        }

        .company_overview {
            padding: 100px 0;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
        }

        .stat-card {
            background: linear-gradient(135deg, rgba(117, 189, 16, 0) 0%, rgba(118, 189, 16, 0.05) 100%);
            border: 1px solid rgba(118, 189, 16, 0.3);
            border-radius: 16px;
            padding: 32px 24px;
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .stat-card:hover {
            background: linear-gradient(135deg, rgba(117, 189, 16, 0.021) 0%, rgba(117, 189, 16, 0.021) 100%);
            border-color: rgba(118, 189, 16, 0.6);
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(118, 189, 16, 0.2);
        }

        .stat-icon {
            font-size: 48px;
            color: #76bd10;
            margin-bottom: 16px;
            display: inline-block;
        }

        .stat-card h3 {
            font-size: 32px;
            font-weight: 800;
            color: #76bd10;
            margin: 0 0 8px 0;
        }

        .stat-card p {
            font-size: 14px;
            color: #999;
            margin: 0;
            font-weight: 500;
        }

        /* Mission Vision Section */
        .mission-vision {
            padding: 80px 0;
            background: #f8f9fa;
        }

        .mission-vision-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
        }

        .mission-card,
        .vision-card {
            background: #fff;
            border: 1px solid #e0e0e0;
            border-radius: 16px;
            padding: 40px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
            transition: all 0.3s ease;
        }

        .mission-card:hover,
        .vision-card:hover {
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
            transform: translateY(-3px);
        }

        .card-icon {
            width: 80px;
            height: 80px;
            background: #e8f5e9;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 24px;
            font-size: 36px;
            color: #76bd10;
        }

        .mission-card h3,
        .vision-card h3 {
            font-size: 28px;
            font-weight: 800;
            color: #76bd10;
            margin: 0 0 20px 0;
        }

        .mission-card p,
        .vision-card p {
            font-size: 15px;
            color: #666;
            line-height: 1.7;
            margin: 0 0 24px 0;
        }

        .card-benefits {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .card-benefits li {
            font-size: 14px;
            color: #333;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .card-benefits li:before {
            content: "✓";
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 20px;
            height: 20px;
            background: #76bd10;
            color: #fff;
            border-radius: 50%;
            font-size: 12px;
            font-weight: bold;
            flex-shrink: 0;
        }

        /* Core Values Section */
        .core-values {
            padding: 80px 0;
            background: #fff;
        }

        .values-header {
            text-align: center;
            margin-bottom: 60px;
        }

        .values-badge {
            display: inline-block;
            background: #c8e6c9;
            color: #2e7d32;
            padding: 10px 24px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 1px;
            margin-bottom: 20px;
        }

        .values-header h2 {
            font-size: 42px;
            /* font-weight: 900; */
            color: #111;
            margin: 0 0 16px 0;
        }

        .values-header p {
            font-size: 16px;
            color: #666;
            max-width: 700px;
            margin: 0 auto;
            line-height: 1.6;
        }

        .values-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
        }

        .value-card {
            background: #fff;
            border: 1px solid #e8e8e8;
            border-radius: 12px;
            padding: 32px;
            text-align: left;
            transition: all 0.3s ease;
        }

        .value-card:hover {
            border-color: #76bd10;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
            transform: translateY(-4px);
        }

        .value-icon {
            width: 70px;
            height: 70px;
            background: #e8f5e9;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            color: #76bd10;
            margin-bottom: 20px;
        }

        .value-card h3 {
            font-size: 20px;
            font-weight: 800;
            color: #111;
            margin: 0 0 12px 0;
        }

        .value-card p {
            font-size: 14px;
            color: #666;
            line-height: 1.6;
            margin: 0;
        }

        /* Journey Timeline Section */
        .journey-section {
            padding: 80px 0;
            background: #f8f9fa;
        }

        .journey-header {
            text-align: center;
            margin-bottom: 50px;
        }

        .journey-header .journey-badge {
            display: inline-block;
            background: #e8f5e9;
            color: #2e7d32;
            padding: 10px 24px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 1px;
            margin-bottom: 20px;
        }

        .journey-header h2 {
            font-size: 42px;
            /* font-weight: 900; */
            color: #111;
            margin: 0 0 16px 0;
        }

        .journey-header p {
            font-size: 16px;
            color: #666;
            max-width: 700px;
            margin: 0 auto;
            line-height: 1.6;
        }

        .timeline {
            position: relative;
            display: grid;
            grid-template-columns: minmax(0, 1fr) 90px minmax(0, 1fr);
            align-items: start;
        }

        .timeline::before {
            content: '';
            position: absolute;
            top: 20px;
            bottom: 20px;
            left: calc(50% - 2px);
            width: 4px;
            background: #76bd10;
            border-radius: 999px;
        }

        .timeline-item {
            position: relative;
            padding: 32px 28px 28px;
            background: #fff;
            border: 1px solid #eaf4ea;
            border-radius: 24px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.04);
            width: 100%;
        }

        .timeline-item:nth-child(odd) {
            grid-column: 1 / 2;
            justify-self: end;
            transform: translateX(12px);
            text-align: right;
        }

        .timeline-item:nth-child(even) {
            grid-column: 3 / 4;
            justify-self: start;
            transform: translateX(-12px);
        }

        /* Each item gets its own row so odd/even items never get
           auto-packed side by side into the same grid row */
        .timeline-item:nth-child(1) { grid-row: 1; }
        .timeline-item:nth-child(2) { grid-row: 2; }
        .timeline-item:nth-child(3) { grid-row: 3; }
        .timeline-item:nth-child(4) { grid-row: 4; }
        .timeline-item:nth-child(5) { grid-row: 5; }
        .timeline-item:nth-child(6) { grid-row: 6; }
        .timeline-item:nth-child(7) { grid-row: 7; }
        .timeline-item:nth-child(8) { grid-row: 8; }

        .timeline-item::before {
            content: '';
            position: absolute;
            top: 52px;
            width: 18px;
            height: 18px;
            background: #76bd10;
            border: 4px solid #f8f9fa;
            border-radius: 50%;
        }

        .timeline-item:nth-child(odd)::before {
            right: -43px;
        }

        .timeline-item:nth-child(even)::before {
            left: -43px;
        }

        .timeline-item .timeline-year {
            position: absolute;
            top: 20px;
            background: rgba(118, 189, 16, 0.15);
            color: #1f6d22;
            padding: 10px 16px;
            border-radius: 14px;
            font-size: 14px;
            font-weight: 800;
        }

        .timeline-item:nth-child(odd) .timeline-year {
            right: 24px;
        }

        .timeline-item:nth-child(even) .timeline-year {
            left: 24px;
        }

        .timeline-item h3 {
            font-size: 22px;
            font-weight: 900;
            color: #111;
            margin: 32px 0 16px 0;
        }

        .timeline-item p {
            font-size: 15px;
            color: #666;
            line-height: 1.9;
            margin: 0;
        }

        /* === Timeline slide-in animations === */
        .timeline-item {
            opacity: 0;
            transition: opacity 0.6s ease, transform 0.6s cubic-bezier(0.22, 1, 0.36, 1);
        }

        /* Odd items start off-screen to the LEFT, slide right */
        .timeline-item:nth-child(odd) {
            transform: translateX(-60px);
        }

        /* Even items start off-screen to the RIGHT, slide left */
        .timeline-item:nth-child(even) {
            transform: translateX(60px);
        }

        /* When AOS marks item as animated, snap to final position */
        .timeline-item.aos-animate {
            opacity: 1 !important;
        }

        .timeline-item.aos-animate:nth-child(odd) {
            transform: translateX(12px) !important;
        }

        .timeline-item.aos-animate:nth-child(even) {
            transform: translateX(-12px) !important;
        }

        @media (max-width: 768px) {
            .timeline-item.aos-animate:nth-child(odd),
            .timeline-item.aos-animate:nth-child(even) {
                transform: none !important;
            }
        }

        /* Milestones Section */
        .milestones-section {
            padding: 80px 0;
            background: #fff;
        }

        .milestones-header {
            display: flex;
            flex-direction: column;
            gap: 18px;
            margin-bottom: 40px;
            text-align: left;
        }

        .milestones-header .milestones-badge {
            display: inline-block;
            background: #d7f2d8;
            color: #227a28;
            padding: 10px 24px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 1px;
        }

        .milestones-header h2 {
            font-size: 42px;
            font-weight: 900;
            color: #111;
            margin: 0;
        }

        .milestones-header p {
            font-size: 16px;
            color: #666;
            max-width: 680px;
            margin: 0;
            line-height: 1.8;
        }

        .milestones-grid {
            display: grid;
            grid-template-columns: 1.2fr 0.8fr;
            gap: 32px;
            align-items: start;
        }

        .milestone-list {
            list-style: none;
            padding: 0;
            margin: 0;
            display: grid;
            gap: 18px;
        }

        .milestone-list li {
            display: flex;
            gap: 14px;
            align-items: flex-start;
            color: #1b1b1b;
            font-size: 15px;
            line-height: 1.8;
        }

        .milestone-list li::before {
            content: '\2713';
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 28px;
            height: 28px;
            background: #d7f2d8;
            color: #227a28;
            border-radius: 50%;
            font-size: 14px;
            flex-shrink: 0;
            margin-top: 4px;
        }

        .milestone-stats {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
        }

        .milestone-stat-card {
            background: #fff;
            border: 1px solid #eef4ef;
            border-radius: 20px;
            padding: 28px 22px;
            display: grid;
            gap: 18px;
            min-height: 180px;
            box-shadow: 0 12px 32px rgba(35, 91, 36, 0.06);
        }

        .milestone-stat-card .stat-icon {
            width: 62px;
            height: 62px;
            border-radius: 50%;
            background: #eaf7e8;
            display: grid;
            place-items: center;
            color: #4a9a1d;
            font-size: 28px;
        }

        .milestone-stat-card .stat-value {
            font-size: 32px;
            font-weight: 900;
            color: #111;
            margin: 0;
        }

        .milestone-stat-card .stat-label {
            font-size: 14px;
            color: #666;
            margin: 0;
            text-transform: capitalize;
        }

        .cta-banner {
            padding: 64px 0;
            background: #3f7a18;
            color: #fff;
            margin-top: 50px;
        }

        .cta-banner .cta-inner {
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 24px;
            align-items: center;
        }

        .cta-banner h2 {
            font-size: 36px;
            font-weight: 900;
            margin: 0 0 16px;
        }

        .cta-banner p {
            font-size: 16px;
            color: rgba(255, 255, 255, 0.9);
            margin: 0;
            max-width: 680px;
            line-height: 1.8;
        }

        .cta-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
            justify-content: flex-end;
        }

        .cta-actions .btn {
            min-width: 170px;
            padding: 14px 26px;
            border-radius: 10px;
            font-weight: 700;
            transition: all 0.2s ease;
        }

        .cta-actions .btn-primary {
            background: #fff;
            color: #3f7a18;
            border: none;
        }

        .cta-actions .btn-secondary {
            background: transparent;
            color: #fff;
            border: 1px solid rgba(255, 255, 255, 0.95);
        }

        .cta-actions .btn-secondary:hover,
        .cta-actions .btn-primary:hover {
            opacity: 0.95;
        }

        @media (max-width: 1024px) {
            .timeline {
                grid-template-columns: 1fr;
                padding-left: 36px;
                gap: 32px;
            }

            .timeline::before {
                left: 8px;
                width: 3px;
            }

            .timeline-item,
            .timeline-item:nth-child(odd),
            .timeline-item:nth-child(even) {
                grid-column: 1 / -1;
                justify-self: stretch;
                max-width: 100%;
                width: 100%;
                transform: none;
                padding: 24px 20px 20px;
                min-height: 0;
            }

            .timeline-item::before,
            .timeline-item:nth-child(odd)::before,
            .timeline-item:nth-child(even)::before {
                left: -34px;
                right: auto;
                top: 28px;
                width: 14px;
                height: 14px;
            }

            .timeline-item .timeline-year,
            .timeline-item:nth-child(odd) .timeline-year,
            .timeline-item:nth-child(even) .timeline-year {
                position: static;
                display: inline-block;
                margin-bottom: 14px;
                left: auto;
                right: auto;
                top: auto;
            }

            .milestones-grid {
                grid-template-columns: 1fr;
            }

            .milestone-stats {
                grid-template-columns: 1fr 1fr;
            }

            .values-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 24px;
            }
        }

        @media (max-width: 992px) {
            .timeline-item:nth-child(odd) {
                text-align: left;
            }
        }

        @media (max-width: 576px) {
            .about-area {
                padding: 100px 0 50px 0;
            }

            .about-area .section-heading h1 {
                font-size: 28px;
            }

            .company_overview {
                padding: 40px 0;
                margin-bottom: 20px;
            }

            .stats-grid {
                grid-template-columns: 1fr;
                gap: 16px;
                margin-top: 30px;
            }

            .stat-card {
                padding: 24px 20px;
            }

            .stat-icon {
                font-size: 36px;
            }

            .stat-card h3 {
                font-size: 24px;
            }

            .mission-vision {
                padding: 50px 0;
            }

            .mission-vision-container {
                grid-template-columns: 1fr;
                gap: 24px;
            }

            .mission-card,
            .vision-card {
                padding: 30px;
            }

            .mission-card h3,
            .vision-card h3 {
                font-size: 22px;
            }

            .card-icon {
                width: 60px;
                height: 60px;
                font-size: 28px;
                margin-bottom: 16px;
            }

            .core-values {
                padding: 50px 0;
            }

            .values-header h2 {
                font-size: 28px;
            }

            .values-grid {
                grid-template-columns: 1fr;
                gap: 16px;
            }

            .value-card {
                padding: 24px;
            }

            .value-icon {
                width: 56px;
                height: 56px;
                font-size: 26px;
                margin-bottom: 16px;
            }

            .value-card h3 {
                font-size: 18px;
            }

            .milestones-grid {
                gap: 24px;
            }

            .milestone-stats {
                grid-template-columns: 1fr;
            }

            .timeline-item .timeline-year, .timeline-item:nth-child(odd) .timeline-year, .timeline-item:nth-child(even) .timeline-year {
                margin-bottom: 4px;
                padding: 4px 10px;
            }

            .timeline-item, .timeline-item:nth-child(odd), .timeline-item:nth-child(even) {
                padding: 15px;
            }

            .timeline-item h3 {
                margin: 0;
                font-size: 18px;
            }

            .timeline-item p {
                font-size: 14px;
                line-height: 1.4;
            }

            .timeline-item:nth-child(odd) {
                text-align: left;
            }
        }

        /* Info Cards Modern Layout Styling matching Login Guidelines */
        .contact-info-area {
            background: #f8fafc;
            padding-top: 80px;
            padding-bottom: 40px;
        }

        .contact-info-card {
            background: #fff;
            border: 1px solid #edf0f5;
            border-radius: 20px;
            padding: 30px 24px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.03);
            transition: 0.3s ease;
            height: 100%;
            display: flex;
            align-items: center;
            /* FIXED: Changed from flex-start to center for flawless vertical alignment */
            gap: 20px;
        }

        .contact-info-card:hover {
            box-shadow: 0 20px 45px rgba(0, 0, 0, 0.08);
            transform: translateY(-2px);
        }

        .contact-info-card .icon-box {
            width: 54px;
            height: 54px;
            background: rgba(118, 189, 16, 0.1);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #76bd10;
            font-size: 22px;
            flex-shrink: 0;
            transition: 0.3s;
        }

        .contact-info-card:hover .icon-box {
            background: #111827;
            color: #fff;
        }

        .contact-info-card .info-content {
            flex-grow: 1;
            /* Ensures text area manages space properly */
        }

        .contact-info-card .info-content h5 {
            font-size: 16px;
            font-weight: 800;
            color: #111827;
            margin-bottom: 6px;
        }

        .contact-info-card .info-content p {
            font-size: 14px;
            font-weight: 600;
            color: #4b5563;
            margin: 0;
            line-height: 1.5;
            word-break: break-word;
            /* Prevents overflow strings from breaking the structural column grid */
        }

        /* Contact Form Layout styling carefully matched to Login Page */
        .contact-area-wrap {
            background: #f8fafc;
            padding-bottom: 90px;
        }

        .contact-img-box {
            height: 100%;
            min-height: 400px;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.05);
        }

        .contact-img-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .auth-form-contact {
            background: #fff;
            border: 1px solid #edf0f5;
            border-radius: 24px;
            padding: 40px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.05);
            transition: 0.3s ease;
        }

        .auth-form-contact:hover {
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.1);
        }

        .auth-header-contact {
            margin-bottom: 35px;
        }

        .auth-header-contact h2 {
            font-size: 28px;
            font-weight: 900;
            color: #111827;
            margin-bottom: 12px;
        }

        .auth-header-contact p {
            color: #4b5563;
            font-size: 14px;
            font-weight: 600;
            margin: 0;
            line-height: 1.6;
        }

        .form-group-contact {
            margin-bottom: 22px;
        }

        .form-icon-contact {
            position: relative;
        }

        .form-icon-contact i.input-icon {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            font-size: 15px;
            transition: 0.3s;
            z-index: 5;
        }

        /* Custom alignment for textarea icons */
        .form-icon-contact.is-textarea i.input-icon {
            top: 24px;
            transform: none;
        }

        .form-icon-contact .form-control {
            padding-left: 50px;
            border-radius: 14px;
            border: 1px solid #edf0f5;
            font-size: 14px;
            font-weight: 600;
            background: #fff;
            color: #111827;
            transition: 0.3s;
            box-shadow: none;
        }

        .form-icon-contact input.form-control {
            height: 54px;
        }

        .form-icon-contact textarea.form-control {
            padding-top: 15px;
        }

        .form-icon-contact .form-control::placeholder {
            color: #9ca3af;
        }

        .form-icon-contact .form-control:focus {
            border-color: #76bd10;
            box-shadow: 0 0 0 4px rgba(118, 189, 16, 0.12);
            outline: none;
        }

        .form-icon-contact .form-control:focus~i.input-icon {
            color: #76bd10;
        }

        .auth-btn-contact button {
            width: 100%;
            height: 54px;
            background: #111827;
            color: #fff;
            border: none;
            border-radius: 50px;
            font-weight: 800;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: 0.3s;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .auth-btn-contact button:hover {
            background: #76bd10;
            color: #111827;
            box-shadow: 0 12px 35px rgba(118, 189, 16, 0.45);
            transform: translateY(-1px);
        }

        /* Map styling wrap */
        .contact-map-section {
            background: #f8fafc;
            padding-bottom: 90px;
        }

        .map-container-inner {
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.05);
            border: 1px solid #edf0f5;
        }

        .map-container-inner iframe {
            width: 100% !important;
            height: 450px !important;
            display: block;
            border: 0;
        }
    </style>
@endpush

@section('frontendone_content')
    <main class="main">
        <!-- breadcrumb -->
        {{-- <x-frontend.pages.common.breadcrumb
            :title="'About Us'"
            :breadcrumb="[
                ['name' => 'Home', 'url' => route('home')],
                ['name' => 'About Us', 'url' => '#']
            ]"
        /> --}}
        <!-- breadcrumb end -->

        <!-- about area -->
        <div class="about-area" data-aos="fade-up">
            <div class="container">
                <div class="row">
                    <div class="section-heading">
                        <span class="sub-title">
                            <i class="fa-solid fa-building"></i>
                            {{ $about->sub_title ?? null }}
                        </span>
                        <h1>{{ $about->title ?? null }}</h1>
                        <p>
                            {!! $about->description ?? null !!}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- about area end -->

        <!-- Company Overview -->
        <div class="company_overview" data-aos="fade-up">
            <div class="container">
                <div class="row">
                    <div class="section-heading text-start m-0">
                        <span class="sub-title">
                            {{ $companyOverview->sub_title ?? 'Company Overview' }}
                        </span>
                    </div>
                    <div class="col-lg-6">
                        <div class="overview-content">
                            <h1 class="mb-2 mb-md-4">{{ $companyOverview->title ?? 'Leading the Cybersecurity Revolution in Bangladesh' }}</h1>
                            @if(!empty($companyOverview->description))
                                {!! $companyOverview->description !!}
                            @else
                                <p>
                                    Founded in 2019, HackToLive (H4K2LIV3) has emerged as Bangladesh's most trusted
                                    cybersecurity platform. We bridge the gap between traditional education and industry needs
                                    by providing world-class security training in Bengali, making cybersecurity accessible to
                                    millions.
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="stats-grid">
                            <div class="stat-card">
                                <div class="stat-icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="stat-content">
                                    <h3>{{ is_numeric($studentsCounter) ? number_format($studentsCounter) : $studentsCounter }}+</h3>
                                    <p>Students</p>
                                </div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-icon">
                                    <i class="fas fa-shield-alt"></i>
                                </div>
                                <div class="stat-content">
                                    <h3>{{ is_numeric($certificatesCounter) ? number_format($certificatesCounter) : $certificatesCounter }}+</h3>
                                    <p>Certificates</p>
                                </div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-icon">
                                    <i class="fas fa-award"></i>
                                </div>
                                <div class="stat-content">
                                    <h3>{{ ($coursesCounter['value'] ?? 0) }}{{ $coursesCounter['unit'] ?? '' }}+</h3>
                                    <p>Courses</p>
                                </div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-icon">
                                    <i class="fas fa-globe"></i>
                                </div>
                                <div class="stat-content">
                                    <h3>{{ ($tutorsCounter['value'] ?? 0) }}{{ $tutorsCounter['unit'] ?? '' }}+</h3>
                                    <p>Tutors</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Company Overview End -->

        <!-- mission vision -->
        <div class="mission-vision" data-aos="fade-up">
            <div class="container">
                <div class="mission-vision-container">
                    <div class="mission-card">
                        <div class="card-icon">
                            <i class="fas fa-bullseye"></i>
                        </div>
                        <h3>{{ $missionVision->title_one ?? 'Our Mission' }}</h3>
                        <p>
                            {!! $missionVision->description_one ?? 'To empower individuals and organizations in Bangladesh with world-class cybersecurity knowledge and skills, making digital security accessible through education in Bengali. We strive to build a safer digital ecosystem by training the next generation of ethical hackers and providing professional security services that protect businesses from cyber threats.' !!}
                        </p>
                    </div>
                    <div class="vision-card">
                        <div class="card-icon">
                            <i class="fas fa-eye"></i>
                        </div>
                        <h3>{{ $missionVision->title_two ?? 'Our Vision' }}</h3>
                        <p>
                            {!! $missionVision->description_two ?? null !!}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- mission vision end -->

        <!-- Core Values Section -->
        <div class="core-values" data-aos="fade-up">
            <div class="container">
                <div class="values-header">
                    <span class="values-badge">OUR CORE VALUES</span>
                    <h2>What Drives Us Forward</h2>
                    <p>Our values guide every decision we make and shape the culture of our organization.</p>
                </div>

                <div class="values-grid">
                    @forelse($values as $value)
                        <div class="value-card">
                            <div class="value-icon">
                                <i class="fas fa-shield-alt"></i>
                            </div>
                            <h3>{{ $value->title }}</h3>
                            <p>{{ $value->description }}</p>
                        </div>
                    @empty
                        <div class="value-card">
                            <div class="value-icon">
                                <i class="fas fa-info-circle"></i>
                            </div>
                            <h3>No Core Values Found</h3>
                            <p>Please check back later for our core values.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
        <!-- Core Values End -->

        <!-- Journey Timeline Section -->
        <div class="journey-section" data-aos="fade-up">
            <div class="container">
                <div class="journey-header">
                    <span class="journey-badge">OUR JOURNEY</span>
                    <h2>Our Story of Growth</h2>
                    <p>From a small initiative to Bangladesh's leading cybersecurity platform.</p>
                </div>

                <div class="timeline">
                    @forelse($storyOfGrowth as $story)
                        <div class="timeline-item"
                             data-aos="{{ $loop->iteration % 2 !== 0 ? 'fade-right' : 'fade-left' }}"
                             data-aos-duration="700"
                             data-aos-delay="{{ ($loop->index) * 100 }}"
                             data-aos-easing="ease-out-cubic">
                            <span class="timeline-year">{{ $story->year }}</span>
                            <h3>{{ $story->title }}</h3>
                            <p>{{ $story->description }}</p>
                        </div>
                    @empty
                        <div class="col-12">
                            <p class="mb-0 text-muted">No story of growth items found.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
        <!-- Journey Timeline Section End -->

        @include('frontendone.pages.widgets.mentor_section')

        <!-- Milestones Section -->
        <div class="milestones-section" data-aos="fade-up">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="section-heading text-start m-0">
                            <span class="sub-title">
                                {{ $achievementSection->sub_title ?? 'OUR ACHIEVEMENTS' }}
                            </span>
                            <h1>{{ $achievementSection->title ?? 'Milestones That Define Us' }}</h1>
                            @if(!empty($achievementSection->description))
                                {!! $achievementSection->description !!}
                            @else
                                <p>Over the years, HackToLive has achieved significant milestones that demonstrate our
                                    commitment to cybersecurity excellence and education in Bangladesh.</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="milestone-stats">
                            <div class="milestone-stat-card">
                                <div class="stat-icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <p class="stat-value">{{ is_numeric($studentsCounter) ? number_format($studentsCounter) : $studentsCounter }}+</p>
                                <p class="stat-label">Students</p>
                            </div>
                            <div class="milestone-stat-card">
                                <div class="stat-icon">
                                    <i class="fas fa-code"></i>
                                </div>
                                <p class="stat-value">{{ ($coursesCounter['value'] ?? 0) }}{{ $coursesCounter['unit'] ?? '' }}+</p>
                                <p class="stat-label">Courses</p>
                            </div>
                            <div class="milestone-stat-card">
                                <div class="stat-icon">
                                    <i class="fas fa-chalkboard-teacher"></i>
                                </div>
                                <p class="stat-value">{{ ($tutorsCounter['value'] ?? 0) }}{{ $tutorsCounter['unit'] ?? '' }}+</p>
                                <p class="stat-label">Tutors</p>
                            </div>
                            <div class="milestone-stat-card">
                                <div class="stat-icon">
                                    <i class="fas fa-award"></i>
                                </div>
                                <p class="stat-value">{{ $certificatesCounter ?? 0 }}+</p>
                                <p class="stat-label">Certificates</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Milestones Section End -->

        <!-- Why Choose Us Section -->
        <div class="core-values" data-aos="fade-up">
            <div class="container">
                <div class="values-header">
                    <span class="values-badge">WHY CHOOSE US</span>
                    <h2>What Makes Us Different</h2>
                    <p>We combine world-class training with practical experience and local expertise.</p>
                </div>

                <div class="values-grid">
                    @forelse($whyChooseUs as $item)
                        <div class="value-card">
                            <div class="value-icon">
                                <i class="fas fa-shield-alt"></i>
                            </div>
                            <h3>{{ $item->title }}</h3>
                            <p>{{ $item->description }}</p>
                        </div>
                    @empty
                        <div class="value-card">
                            <div class="value-icon">
                                <i class="fas fa-info-circle"></i>
                            </div>
                            <h3>No Items Found</h3>
                            <p>Please check back later for why you should choose us.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
        <!-- Why Choose Us Section End -->

        <!-- CTA Banner Section -->
        <div class="cta-banner" data-aos="fade-up">
            <div class="container">
                <div class="cta-inner">
                    <div>
                        <h2>Ready to Start Your Cybersecurity Journey?</h2>
                        <p>Join thousands of students and professionals who trust HackToLive for their cybersecurity
                            education and security needs.</p>
                    </div>
                    <div class="cta-actions">
                        <a href="{{ route('courses') }}" class="btn btn-primary">Explore Courses</a>
                        <a href="{{ route('contact.page') }}" class="btn btn-secondary">Contact Us</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- CTA Banner Section End -->

        <div class="contact-info-area" data-aos="fade-up">
            <div class="container">
                <div class="row g-4">
                    <div class="col-xl-3 col-md-6">
                        <div class="contact-info-card">
                            <div class="icon-box">
                                <i class="fas fa-map-marked-alt"></i>
                            </div>
                            <div class="info-content">
                                <h5>Office Address</h5>
                                <p>{{ $website_link->address ?? 'Savar DOHS, Ashulia, Savar, Dhaka-1344' }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="contact-info-card">
                            <div class="icon-box">
                                <i class="fas fa-phone-volume"></i>
                            </div>
                            <div class="info-content">
                                <h5>Call Us</h5>
                                <p>{{ $website_link->number ?? '01849382288' }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="contact-info-card">
                            <div class="icon-box">
                                <i class="fas fa-envelope-open-text"></i>
                            </div>
                            <div class="info-content">
                                <h5>Email Us</h5>
                                <p>{{ $website_link->email ?? 'meenamart25@gmail.com' }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="contact-info-card">
                            <div class="icon-box">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="info-content">
                                <h5>Open Time</h5>
                                <p>Mon - Sat (10.00AM - 05.30PM)</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="contact-area-wrap" data-aos="fade-up">
            <div class="container">
                <div class="row g-4 align-items-stretch">
                    <div class="col-lg-5">
                        <div class="contact-img-box">
                            <img src="{{ asset('assets/frontend/img/contact/01.webp') }}" alt="Contact Us Image" />
                        </div>
                    </div>

                    <div class="col-lg-7">
                        <div class="auth-form-contact">
                            <div class="auth-header-contact">
                                <h2>Get In Touch</h2>
                                <p>
                                    It is a long established fact that a reader will be distracted by the readable
                                    content of a page randomised words which don't look even slightly when looking at its
                                    layout.
                                </p>
                            </div>

                            <div class="form-message">
                                @if (session('message'))
                                    <div class="alert alert-success mb-4" style="border-radius: 12px;">
                                        {{ session('message') }}</div>
                                @endif
                            </div>

                            <form method="post" action="{{ route('contacts.store') }}" id="contact-form">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group-contact">
                                            <div class="form-icon-contact">
                                                <input type="text" class="form-control" name="name"
                                                    placeholder="Your Name" required />
                                                <i class="fa-solid fa-user input-icon"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group-contact">
                                            <div class="form-icon-contact">
                                                <input type="email" class="form-control" name="email"
                                                    placeholder="Your Email" required />
                                                <i class="fa-solid fa-envelope input-icon"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group-contact">
                                            <div class="form-icon-contact">
                                                <input type="number" class="form-control" name="phone"
                                                    placeholder="Your Phone" required />
                                                <i class="fa-solid fa-phone input-icon"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group-contact">
                                            <div class="form-icon-contact">
                                                <input type="text" class="form-control" name="subject"
                                                    placeholder="Your Subject" required />
                                                <i class="fa-solid fa-pen input-icon"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group-contact">
                                    <div class="form-icon-contact is-textarea">
                                        <textarea name="message" cols="30" rows="5" class="form-control" placeholder="Write Your Message"
                                            required></textarea>
                                        <i class="fa-solid fa-comment input-icon"></i>
                                    </div>
                                </div>
                                <div class="auth-btn-contact">
                                    <button type="submit">Send Message <i class="fa-solid fa-paper-plane"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="contact-map-section" data-aos="fade-up">
            <div class="container">
                <div class="map-container-inner">
                    @if (isset($website_link->map_link) && str_contains($website_link->map_link, '<iframe'))
                        {!! $website_link->map_link !!}
                    @else
                        <iframe src="https://maps.google.com/maps?q=Savar%20DOHS&t=&z=13&ie=UTF8&iwloc=&output=embed"
                            allowfullscreen="" loading="lazy"></iframe>
                    @endif
                </div>
            </div>
        </div>
    @endsection

    @push('frontendone_script')
        @include('frontend.pages.common.script')
    @endpush
