{{-- <x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-button class="ms-4">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout> --}}

@extends('frontend.layouts.master')

@section('title', 'Home')

@push('frontend_style')

@endpush

@section('frontend_content')
<!-- Start Page Title Area -->
<div class="page-title-area" style="background-image: url('{{ asset('assets/frontend/img/page-bg.jpg') }}')">
    <div class="container">
        <div class="page-title-content">
            <h2>Log In</h2>
            <ul>
                <li>
                    <a href="index.html">
                        Home
                    </a>
                </li>
                <li>Pages</li>
                <li>User</li>
                <li>Log In</li>
            </ul>
        </div>
    </div>
</div>
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
                                <button class="default-btn" type="submit">
                                    Google
                                    <i class="bx bxl-google"></i>
                                </button>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <button class="default-btn" type="submit">
                                    Facebook
                                    <i class="bx bxl-facebook"></i>
                                </button>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <button class="default-btn" type="submit">
                                    Twitter
                                    <i class="bx bxl-twitter"></i>
                                </button>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Username or Email" value="{{ old('email') }}" required autofocus autocomplete="username">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <input id="password" type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" required autocomplete="current-password">
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
                                    <a class="forget" href="{{ route('password.request') }}">{{ __('Forgot your password?') }}</a>
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
