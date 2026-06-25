@extends('frontendone.layouts.master')

@section('title', 'Contact')

@push('frontendone_style')
    @include('frontend.pages.common.style')
    <style>
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
            align-items: center; /* FIXED: Changed from flex-start to center for flawless vertical alignment */
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
            flex-grow: 1; /* Ensures text area manages space properly */
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
            word-break: break-word; /* Prevents overflow strings from breaking the structural column grid */
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

        .form-icon-contact .form-control:focus ~ i.input-icon {
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
        <x-frontend.pages.common.breadcrumb
            :title="'Contact Us'"
            :breadcrumb="[
                ['name' => 'Home', 'url' => route('home')],
                ['name' => 'Contact Us', 'url' => '#']
            ]"
        />
        <div class="contact-info-area">
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
        <div class="contact-area-wrap">
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
                                    content of a page randomised words which don't look even slightly when looking at its layout.
                                </p>
                            </div>

                            <div class="form-message">
                                @if(session('message'))
                                    <div class="alert alert-success mb-4" style="border-radius: 12px;">{{ session('message') }}</div>
                                @endif
                            </div>

                            <form method="post" action="{{ route('contacts.store') }}" id="contact-form">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group-contact">
                                            <div class="form-icon-contact">
                                                <input type="text" class="form-control" name="name" placeholder="Your Name" required />
                                                <i class="fa-solid fa-user input-icon"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group-contact">
                                            <div class="form-icon-contact">
                                                <input type="email" class="form-control" name="email" placeholder="Your Email" required />
                                                <i class="fa-solid fa-envelope input-icon"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group-contact">
                                            <div class="form-icon-contact">
                                                <input type="number" class="form-control" name="phone" placeholder="Your Phone" required />
                                                <i class="fa-solid fa-phone input-icon"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group-contact">
                                            <div class="form-icon-contact">
                                                <input type="text" class="form-control" name="subject" placeholder="Your Subject" required />
                                                <i class="fa-solid fa-pen input-icon"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group-contact">
                                    <div class="form-icon-contact is-textarea">
                                        <textarea name="message" cols="30" rows="5" class="form-control" placeholder="Write Your Message" required></textarea>
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
        <div class="contact-map-section">
            <div class="container">
                <div class="map-container-inner">
                    @if(isset($website_link->map_link) && str_contains($website_link->map_link, '<iframe'))
                        {!! $website_link->map_link !!}
                    @else
                        <iframe src="https://maps.google.com/maps?q=Savar%20DOHS&t=&z=13&ie=UTF8&iwloc=&output=embed" allowfullscreen="" loading="lazy"></iframe>
                    @endif
                </div>
            </div>
        </div>
        </main>
@endsection

@push('frontendone_script')
    @include('frontend.pages.common.script')
@endpush