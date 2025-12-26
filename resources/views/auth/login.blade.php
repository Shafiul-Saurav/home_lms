@extends('frontend.layouts.master')

@section('title', 'Login')

@push('frontend_style')
@endpush

@section('frontend_content')
    <!-- Start Page Title Area -->
    <main class="main">
        <!-- breadcrumb -->
        <x-frontend.pages.common.breadcrumb
            :title="'Dashboard'"
            :breadcrumb="[
                ['name' => 'Home', 'url' => route('home')],
                ['name' => 'Login', 'url' => '#']
            ]"
        />
        <!-- breadcrumb end -->

        <!-- login area -->
        <div class="auth-area py-120">
            <div class="container">
                <div class="col-md-5 mx-auto">
                    <div class="auth-form">
                        <div class="auth-header">
                            <img src="assets/img/logo/logo.png" alt="" />
                            <p>Login with your edubo account</p>
                        </div>
                        <form action="#">
                            <div class="form-group">
                                <div class="form-icon">
                                    <i class="far fa-envelope"></i>
                                    <input type="email" class="form-control" placeholder="Your Email" />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-icon">
                                    <i class="far fa-key"></i>
                                    <input type="password" id="password" class="form-control"
                                        placeholder="Your Password" />
                                    <span class="password-view"><i class="far fa-eye-slash"></i></span>
                                </div>
                            </div>
                            <div class="auth-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="remember" />
                                    <label class="form-check-label" for="remember"> Remember Me </label>
                                </div>
                                <a href="forgot-password.html" class="auth-group-link">Forgot Password?</a>
                            </div>
                            <div class="auth-btn">
                                <button type="submit" class="theme-btn"><span class="far fa-sign-in"></span> Login</button>
                            </div>
                        </form>
                        <div class="auth-bottom">
                            <div class="auth-social">
                                <p>Continue with social media</p>
                                <div class="auth-social-list">
                                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                                    <a href="#"><i class="fab fa-google"></i></a>
                                    <a href="#"><i class="fab fa-x-twitter"></i></a>
                                </div>
                            </div>
                            <p class="auth-bottom-text">Don't have an account? <a href="register.html">Register.</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- login area end -->
    </main>

    <!-- End Page Title Area -->

    <!-- Start Log In Area -->
    <section class="user-area-all-style log-in-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="contact-form-action">
                        <div class="form-heading text-center">
                            <h3 class="form-title">Login to your account!</h3>
                            <p class="form-desc">With your social network.</p>
                        </div>
                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <a href="{{ route('login.provider', ['provider' => 'google']) }}" class="default-btn"
                                        type="submit">
                                        Google
                                        <i class="bx bxl-google"></i>
                                    </a>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <a href="{{ route('login.provider', ['provider' => 'facebook']) }}" class="default-btn"
                                        type="submit">
                                        Facebook
                                        <i class="bx bxl-facebook"></i>
                                    </a>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <a href="{{ route('login.provider', ['provider' => 'twitter']) }}" class="default-btn"
                                        type="submit">
                                        Twitter
                                        <i class="bx bxl-twitter"></i>
                                    </a>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <input type="email" name="email" id="email"
                                            class="form-control @error('email') is-invalid @enderror"
                                            placeholder="Username or Email" value="{{ old('email') }}" required autofocus
                                            autocomplete="username">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <input id="password" type="password" name="password"
                                            class="form-control @error('password') is-invalid @enderror"
                                            placeholder="Password" required autocomplete="current-password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6 form-condition">
                                    <div class="agree-label">
                                        <input type="checkbox" id="remember_me" name="remember">
                                        <label for="remember_me">
                                            {{ __('Remember me') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6">
                                    @if (Route::has('password.request'))
                                        <a class="forget"
                                            href="{{ route('password.request') }}">{{ __('Forgot your password?') }}</a>
                                    @endif
                                </div>
                                <div class="col-12">
                                    <button class="default-btn btn-two" type="submit">
                                        Log In Now
                                        <i class="flaticon-right"></i>
                                    </button>
                                </div>
                                <div class="col-12">
                                    <p class="account-desc">
                                        Not a member?
                                        <a href="{{ route('register') }}">Register</a>
                                    </p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Log In Area -->
@endsection

@push('frontend_script')
@endpush
