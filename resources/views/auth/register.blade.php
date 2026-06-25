@extends('frontendone.layouts.master')

@section('title', 'Register')

@push('frontendone_style')
    @include('frontend.pages.common.style')
    <style>
        /* Scoped styling for modernized breadcrumbs */
        .site-breadcrumb {
            padding: 120px 0 80px 0;
            text-align: center;
            background-size: cover !important;
            background-position: center !important;
            position: relative;
        }

        .site-breadcrumb::before {
            content: '';
            position: absolute;
            inset: 0;
            background: rgba(13, 15, 18, 0.75);
            /* Dark matching deep black */
        }

        .site-breadcrumb .container {
            position: relative;
            z-index: 2;
        }

        .breadcrumb-title {
            color: #fff;
            font-size: 32px;
            font-weight: 900;
            margin-bottom: 12px;
        }

        .breadcrumb-menu {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .breadcrumb-menu li,
        .breadcrumb-menu li a {
            color: #aeb5bf;
            font-size: 14px;
            font-weight: 700;
            text-decoration: none;
            transition: 0.3s;
        }

        .breadcrumb-menu li a:hover {
            color: var(--primary);
        }

        .breadcrumb-menu li.active {
            color: var(--primary);
        }

        .breadcrumb-menu li:not(:last-child)::after {
            content: '/';
            margin-left: 10px;
            color: #aeb5bf;
        }

        /* Modern registration styling matching CyberBD style guidelines */
        .auth-area {
            background: #f8fafc;
            padding: 90px 0;
        }

        .auth-form {
            background: #fff;
            border: 1px solid #edf0f5;
            border-radius: 24px;
            padding: 40px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.05);
            transition: 0.3s ease;
        }

        .auth-form:hover {
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.1);
        }

        .auth-header {
            text-align: center;
            margin-bottom: 35px;
        }

        .auth-header img {
            max-height: 52px;
            margin-bottom: 15px;
            object-fit: contain;
        }

        .auth-header p {
            color: var(--text);
            font-size: 14px;
            font-weight: 700;
            margin: 0;
        }

        .form-group {
            margin-bottom: 22px;
        }

        .form-icon {
            position: relative;
        }

        .form-icon i:first-child {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            font-size: 15px;
            transition: 0.3s;
        }

        .form-icon .form-control {
            padding-left: 50px;
            padding-right: 48px;
            height: 54px;
            border-radius: 14px;
            border: 1px solid #edf0f5;
            font-size: 14px;
            font-weight: 600;
            background: #fff;
            color: #111827;
            transition: 0.3s;
        }

        .form-icon .form-control::placeholder {
            color: #9ca3af;
        }

        .form-icon .form-control:focus {
            border-color: #76bd10;
            box-shadow: 0 0 0 4px rgba(118, 189, 16, 0.12);
            outline: none;
        }

        .form-icon .form-control:focus~i {
            color: #76bd10;
        }

        .password-view {
            position: absolute;
            right: 45px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #9ca3af;
            font-size: 15px;
            transition: 0.3s;
        }

        .password-view:hover {
            color: #111827;
        }

        .auth-group {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            font-size: 13px;
            font-weight: 700;
        }

        .form-check-input {
            cursor: pointer;
            width: 17px;
            height: 17px;
            border-radius: 4px !important;
            border: 1px solid #d1d5db;
        }

        .form-check-input:checked {
            background-color: #76bd10;
            border-color: #76bd10;
        }

        .form-check-input:focus {
            box-shadow: 0 0 0 3px rgba(118, 189, 16, 0.15);
            border-color: #76bd10;
        }

        .form-check-label {
            cursor: pointer;
            color: #4b5563;
        }

        .auth-group-link {
            color: #76bd10;
            text-decoration: none;
            transition: 0.3s;
        }

        .auth-group-link:hover {
            color: #5d9700;
            text-decoration: underline;
        }

        .auth-btn button {
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

        .auth-btn button:hover {
            background: var(--primary);
            color: #111827;
            box-shadow: 0 12px 35px rgba(166, 255, 52, 0.45);
            transform: translateY(-1px);
        }

        .auth-bottom {
            text-align: center;
            margin-top: 30px;
            border-top: 1px solid #edf0f5;
            padding-top: 24px;
        }

        .auth-social p {
            font-size: 13px;
            font-weight: 700;
            color: #6b7280;
            margin-bottom: 16px;
        }

        .auth-social-list {
            display: flex;
            justify-content: center;
            gap: 14px;
            margin-bottom: 24px;
        }

        .auth-social-list a {
            width: 46px;
            height: 46px;
            border-radius: 50%;
            border: 1px solid #edf0f5;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #111827;
            font-size: 16px;
            text-decoration: none;
            transition: 0.3s;
        }

        .auth-social-list a:hover {
            background: #111827;
            color: #fff;
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08);
        }

        .auth-bottom-text {
            font-size: 14px;
            font-weight: 700;
            color: #4b5563;
            margin: 0;
        }

        .auth-bottom-text a {
            color: #76bd10;
            text-decoration: none;
            transition: 0.3s;
        }

        .auth-bottom-text a:hover {
            color: #5d9700;
            text-decoration: underline;
        }
    </style>
@endpush

@section('frontendone_content')
    <main class="main">
        <!-- Breadcrumb section -->
        <x-frontend.pages.common.breadcrumb :title="'Sign Up'" :breadcrumb="[['name' => 'Home', 'url' => route('home')], ['name' => 'Register', 'url' => '#']]" />

        <!-- register area -->
        <div class="auth-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 col-md-8 mx-auto">
                        <div class="auth-form">
                            <div class="auth-header">
                                @if (isset($logo_fav->logo))
                                    <img src="{{ asset($logo_fav->logo) }}" alt="Logo" />
                                @else
                                    <h3 class="navbar-brand" style="font-size:32px; font-weight:900;">Cyber<span
                                            style="color:#76bd10;">BD</span></h3>
                                @endif
                                <p>Create your free CyberBD account</p>
                            </div>
                            <form action="{{ route('register') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <div class="form-icon">
                                        <i class="fa-solid fa-user"></i>
                                        <input type="text" name="name" id="name"
                                            class="form-control @error('name') is-invalid @enderror" placeholder="Your Name"
                                            value="{{ old('name') }}" required autocomplete="name" autofocus />
                                    </div>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert" style="display: block; margin-top: 6px;">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <div class="form-icon">
                                        <i class="fa-solid fa-envelope"></i>
                                        <input type="email" name="email" id="email"
                                            class="form-control @error('email') is-invalid @enderror"
                                            placeholder="Your Email" value="{{ old('email') }}" required
                                            autocomplete="email" />
                                    </div>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert" style="display: block; margin-top: 6px;">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <div class="form-icon">
                                        <i class="fa-solid fa-lock"></i>
                                        <input type="password" id="password" name="password"
                                            class="form-control @error('password') is-invalid @enderror"
                                            placeholder="Your Password" required autocomplete="new-password" />
                                        <span class="password-view"><i class="fa-solid fa-eye-slash"></i></span>
                                    </div>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert" style="display: block; margin-top: 6px;">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <div class="form-icon">
                                        <i class="fa-solid fa-lock"></i>
                                        <input type="password" id="password_confirmation" name="password_confirmation"
                                            class="form-control" placeholder="Confirm Password" required
                                            autocomplete="new-password" />
                                        <span class="password-view-confirm"
                                            style="position: absolute; right: 45px; top: 50%; transform: translateY(-50%); cursor: pointer; color: #9ca3af; font-size: 15px; transition: 0.3s;"><i
                                                class="fa-solid fa-eye-slash"></i></span>
                                    </div>
                                </div>
                                <div class="auth-group">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="terms" id="agree"
                                            {{ old('terms') ? 'checked' : '' }} required />
                                        <label class="form-check-label" for="agree">
                                            I agree with the <a href="" class="auth-group-link">Terms Of Service.</a>
                                        </label>
                                    </div>
                                </div>
                                <div class="auth-btn">
                                    <button type="submit"><i class="fa-solid fa-paper-plane"></i> Register</button>
                                </div>
                            </form>
                            <div class="auth-bottom">
                                <div class="auth-social">
                                    <p>Continue with social media</p>
                                    <div class="auth-social-list">
                                        <a href="{{ route('login.provider', ['provider' => 'google']) }}"><i
                                                class="fa-brands fa-google"></i></a>
                                        <a href="{{ route('login.provider', ['provider' => 'facebook']) }}"><i
                                                class="fa-brands fa-facebook-f"></i></a>
                                        <a href="{{ route('login.provider', ['provider' => 'twitter']) }}"><i
                                                class="fa-brands fa-x-twitter"></i></a>
                                    </div>
                                </div>
                                <p class="auth-bottom-text">Already have an account? <a
                                        href="{{ route('login') }}">Login.</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- register area end -->
    </main>
@endsection

@push('frontendone_script')
    @include('frontend.pages.common.script')
    <script>
        $(function() {
            // Password toggle view
            $('.password-view').on('click', function() {
                var input = $(this).siblings('input');
                var icon = $(this).find('i');
                if (input.attr('type') === 'password') {
                    input.attr('type', 'text');
                    icon.removeClass('fa-eye-slash').addClass('fa-eye');
                } else {
                    input.attr('type', 'password');
                    icon.removeClass('fa-eye').addClass('fa-eye-slash');
                }
            });

            // Password confirmation toggle view
            $('.password-view-confirm').on('click', function() {
                var input = $(this).siblings('input');
                var icon = $(this).find('i');
                if (input.attr('type') === 'password') {
                    input.attr('type', 'text');
                    icon.removeClass('fa-eye-slash').addClass('fa-eye');
                } else {
                    input.attr('type', 'password');
                    icon.removeClass('fa-eye').addClass('fa-eye-slash');
                }
            });
        });
    </script>
@endpush
