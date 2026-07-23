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
            background-color: #171a1d;
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
            font-weight: 900;
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

        @media (max-width: 1024px) {
            .values-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 24px;
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
                background-color: #171a1d;
                margin-bottom: 20px;
            }
            .company_overview .overview-content h1{
                color: #fff !important;
            }
            .company_overview .overview-content p{
                color: #999 !important;
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
        <div class="about-area">
            <div class="container">
                <div class="row">
                    <div class="section-heading">
                        <span class="sub-title">
                            <i class="fa-solid fa-building"></i>
                            About Us
                        </span>
                        <h1>Empowering Bangladesh Through Cybersecurity Excellence</h1>
                        <p>
                            Bridging cybersecurity education and enterprise security, HackToLive provides professional
                            training, penetration testing, phishing simulations, SOC implementation, vulnerability
                            assessments, and strategic security audit & consultation.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- about area end -->

        <!-- Company Overview -->
        <div class="company_overview">
            <div class="container">
                <div class="row">
                    <div class="section-heading text-start m-0">
                        <span class="sub-title">
                            Company Overview
                        </span>
                    </div>
                    <div class="col-lg-6">
                        <div class="overview-content">
                            <h1 class="mb-2 mb-md-4" style="color: #fff">Leading the Cybersecurity Revolution in Bangladesh</h1>
                            <p style="color: #999">
                                Founded in 2019, HackToLive (H4K2LIV3) has emerged as Bangladesh's most trusted cybersecurity platform. We bridge the gap between traditional education and industry needs by providing world-class security training in Bengali, making cybersecurity accessible to millions.
                            </p>
                            <p style="color: #999">
                                Our comprehensive approach combines professional security services, hands-on training programs, and a vibrant community of ethical hackers. We've trained over 5,000 professionals and conducted 500+ successful security audits for leading organizations across South Asia.
                            </p>
                            <p style="color: #999">
                                What sets us apart is our commitment to quality education in Bengali, practical hands-on training, and real-world experience through CTF challenges and live projects. We're not just teaching cybersecurity - we're building Bangladesh's digital defense force.
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="stats-grid">
                            <div class="stat-card">
                                <div class="stat-icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="stat-content">
                                    <h3>5,000+</h3>
                                    <p>Students</p>
                                </div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-icon">
                                    <i class="fas fa-shield-alt"></i>
                                </div>
                                <div class="stat-content">
                                    <h3>500+</h3>
                                    <p>Security Audits</p>
                                </div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-icon">
                                    <i class="fas fa-award"></i>
                                </div>
                                <div class="stat-content">
                                    <h3>50+</h3>
                                    <p>Courses</p>
                                </div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-icon">
                                    <i class="fas fa-globe"></i>
                                </div>
                                <div class="stat-content">
                                    <h3>10+</h3>
                                    <p>Countries</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Company Overview End -->

        <!-- mission vision -->
        <div class="mission-vision">
            <div class="container">
                <div class="mission-vision-container">
                    <div class="mission-card">
                        <div class="card-icon">
                            <i class="fas fa-bullseye"></i>
                        </div>
                        <h3>Our Mission</h3>
                        <p>
                            To empower individuals and organizations in Bangladesh with world-class cybersecurity knowledge and skills, making digital security accessible through education in Bengali. We strive to build a safer digital ecosystem by training the next generation of ethical hackers and providing professional security services that protect businesses from cyber threats.
                        </p>
                        <ul class="card-benefits">
                            <li>Provide quality cybersecurity education in Bengali</li>
                            <li>Deliver professional security services</li>
                            <li>Foster a community of security professionals</li>
                        </ul>
                    </div>
                    <div class="vision-card">
                        <div class="card-icon">
                            <i class="fas fa-eye"></i>
                        </div>
                        <h3>Our Vision</h3>
                        <p>
                            To become South Asia's leading cybersecurity platform, recognized globally for excellence in ethical hacking education and security services. We envision a future where Bangladesh is known for its cybersecurity expertise, with thousands of certified professionals protecting the digital infrastructure of businesses worldwide.
                        </p>
                        <ul class="card-benefits">
                            <li>Lead cybersecurity innovation in South Asia</li>
                            <li>Create 50,000+ certified security professionals</li>
                            <li>Build a safer digital Bangladesh</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- mission vision end -->

        <!-- Core Values Section -->
        <div class="core-values">
            <div class="container">
                <div class="values-header">
                    <span class="values-badge">OUR CORE VALUES</span>
                    <h2>What Drives Us Forward</h2>
                    <p>Our values guide every decision we make and shape the culture of our organization.</p>
                </div>

                <div class="values-grid">
                    <!-- Security First -->
                    <div class="value-card">
                        <div class="value-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h3>Security First</h3>
                        <p>We prioritize security in everything we do, ensuring the highest standards of protection for our clients and students.</p>
                    </div>

                    <!-- Integrity -->
                    <div class="value-card">
                        <div class="value-icon">
                            <i class="fas fa-heart"></i>
                        </div>
                        <h3>Integrity</h3>
                        <p>We maintain the highest ethical standards in all our operations, building trust through transparency and honesty.</p>
                    </div>

                    <!-- Community -->
                    <div class="value-card">
                        <div class="value-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h3>Community</h3>
                        <p>We foster a collaborative learning environment where knowledge sharing and mutual growth are encouraged.</p>
                    </div>

                    <!-- Excellence -->
                    <div class="value-card">
                        <div class="value-icon">
                            <i class="fas fa-arrow-up"></i>
                        </div>
                        <h3>Excellence</h3>
                        <p>We strive for excellence in our training programs, security services, and continuous innovation.</p>
                    </div>

                    <!-- Accessibility -->
                    <div class="value-card">
                        <div class="value-icon">
                            <i class="fas fa-globe"></i>
                        </div>
                        <h3>Accessibility</h3>
                        <p>We make cybersecurity education accessible to everyone through Bengali language content and affordable pricing.</p>
                    </div>

                    <!-- Innovation -->
                    <div class="value-card">
                        <div class="value-icon">
                            <i class="fas fa-bolt"></i>
                        </div>
                        <h3>Innovation</h3>
                        <p>We stay ahead of emerging threats and technologies, constantly updating our curriculum and methodologies.</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Core Values End -->
@endsection

@push('frontendone_script')
    @include('frontend.pages.common.script')
@endpush
