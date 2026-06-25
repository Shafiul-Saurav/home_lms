@extends('frontendone.layouts.master')

@section('title', 'Reset Password')

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

        /* Modern reset-password styling matching CyberBD style guidelines */
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
            right: 18px;
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
        <x-frontend.pages.common.breadcrumb :title="'Reset Password'" :breadcrumb="[['name' => 'Home', 'url' => route('home')], ['name' => 'Reset Password', 'url' => '#']]" />

        <!-- reset password area -->
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
                                <p>Reset your CyberBD account password</p>
                            </div>
                            <form action="{{ route('password.update') }}" method="POST">
                                @csrf
                                <input type="hidden" name="token" value="{{ $token }}">
                                <div class="form-group">
                                    <div class="form-icon">
                                        <i class="fa-regular fa-envelope"></i>
                                        <input type="email" name="email" id="email" class="form-control"
                                            placeholder="Your Email" value="{{ $email }}" readonly />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-icon">
                                        <i class="fa-regular fa-lock"></i>
                                        <input type="password" name="password" id="password"
                                            class="form-control @error('password') is-invalid @enderror"
                                            placeholder="New Password" required autocomplete="new-password" autofocus />
                                        <span class="password-view"><i class="fa-regular fa-eye-slash"></i></span>
                                    </div>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert" style="display: block; margin-top: 6px;">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <div class="form-icon">
                                        <i class="fa-regular fa-lock-keyhole"></i>
                                        <input type="password" name="password_confirmation" id="password_confirmation"
                                            class="form-control" placeholder="Confirm Password" required
                                            autocomplete="new-password" />
                                        <span class="password-view-confirm"
                                            style="position: absolute; right: 18px; top: 50%; transform: translateY(-50%); cursor: pointer; color: #9ca3af; font-size: 15px; transition: 0.3s;"><i
                                                class="fa-regular fa-eye-slash"></i></span>
                                    </div>
                                </div>
                                <div class="auth-btn">
                                    <button type="submit"><i class="fa-regular fa-key"></i> Reset Password</button>
                                </div>
                            </form>
                            <div class="auth-bottom">
                                <p class="auth-bottom-text">Back to <a href="{{ route('login') }}">Login.</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- reset password area end -->
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
