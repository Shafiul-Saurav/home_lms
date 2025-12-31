@extends('frontend.layouts.master')

@section('title', 'Register')

@push('frontend_style')
@endpush

@section('frontend_content')
    <!-- Start Sign Up Area -->

    <main class="main">
        <!-- breadcrumb -->
        <x-frontend.pages.common.breadcrumb
            :title="'Dashboard'"
            :breadcrumb="[
                ['name' => 'Home', 'url' => route('home')],
                ['name' => 'Register', 'url' => '#']
            ]"
        />
        <!-- breadcrumb end -->

        <!-- register area -->
        <div class="auth-area py-120">
            <div class="container">
                <div class="col-md-5 mx-auto">
                    <div class="auth-form">
                        <div class="auth-header">
                            <img src="{{ asset('assets/frontend') }}/img/logo/logo.png" alt="" />
                            <p>Create your free edubo account</p>
                        </div>
                        <form action="{{ route('register') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <div class="form-icon">
                                    <i class="far fa-user-tie"></i>
                                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Your Name" value="{{ old('name') }}" required autocomplete="name" autofocus />
                                </div>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="form-icon">
                                    <i class="far fa-envelope"></i>
                                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Your Email" value="{{ old('email') }}" required autocomplete="email" />
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
                                        placeholder="Your Password" required autocomplete="new-password" />
                                    <span class="password-view"><i class="far fa-eye-slash"></i></span>
                                </div>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="form-icon">
                                    <i class="fas fa-key"></i>
                                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control"
                                        placeholder="Confirm Password" required autocomplete="new-password" />
                                </div>
                            </div>
                            <div class="auth-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="terms" id="agree" {{ old('terms') ? 'checked' : '' }} required />
                                    <label class="form-check-label" for="agree">
                                        I agree with the <a href="" class="auth-group-link">Terms Of Service.</a>
                                    </label>
                                </div>
                            </div>
                            <div class="auth-btn">
                                <button type="submit" class="theme-btn"><span class="far fa-paper-plane"></span>
                                    Register</button>
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
                            <p class="auth-bottom-text">Already have an account? <a href="{{ route('login') }}">Login.</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- register area end -->
    </main>

@endsection

@push('frontend_script')
@endpush
