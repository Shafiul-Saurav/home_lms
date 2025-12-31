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
                            <img src="{{ asset('assets/frontend') }}/img/logo/logo.png" alt="" />
                            <p>Login with your edubo account</p>
                        </div>
                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <div class="form-icon">
                                    <i class="far fa-envelope"></i>
                                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Your Email" value="{{ old('email') }}" required autocomplete="email" autofocus />
                                </div>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="form-icon">
                                    <i class="far fa-key"></i>
                                    <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror"
                                        placeholder="Your Password" required autocomplete="current-password" />
                                    <span class="password-view"><i class="far fa-eye-slash"></i></span>
                                </div>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="auth-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} />
                                    <label class="form-check-label" for="remember"> Remember Me </label>
                                </div>
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="auth-group-link">Forgot Password?</a>
                                @endif
                            </div>
                            <div class="auth-btn">
                                <button type="submit" class="theme-btn"><span class="far fa-sign-in"></span> Login</button>
                            </div>
                        </form>
                        <div class="auth-bottom">
                            <div class="auth-social">
                                <p>Continue with social media</p>
                                <div class="auth-social-list">
                                    <a href="{{ route('login.provider', ['provider' => 'google']) }}"><i class="fab fa-google"></i></a>
                                    <a href="{{ route('login.provider', ['provider' => 'facebook']) }}"><i class="fab fa-facebook-f"></i></a>
                                    <a href="{{ route('login.provider', ['provider' => 'twitter']) }}"><i class="fab fa-x-twitter"></i></a>
                                </div>
                            </div>
                            <p class="auth-bottom-text">Don't have an account? <a href="{{ route('register') }}">Register.</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- login area end -->
    </main>

@endsection

@push('frontend_script')
@endpush
