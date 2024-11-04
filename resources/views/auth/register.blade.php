{{-- <x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-label for="name" value="{{ __('Name') }}" />
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />

                            <div class="ms-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>
                <x-button class="ms-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout> --}}

@extends('frontend.layouts.master')

@section('title', 'Register')

@push('frontend_style')

@endpush

@section('frontend_content')
<!-- Start Page Title Area -->
<div class="page-title-area" style="background-image: url('{{ asset('assets/frontend/img/page-bg.jpg') }}')">
    <div class="container">
        <div class="page-title-content">
            <h2>Sign Up</h2>
            <ul>
                <li>
                    <a href="index.html">
                        Home
                    </a>
                </li>
                <li>Pages</li>
                <li>User</li>
                <li>Sign Up</li>
            </ul>
        </div>
    </div>
</div>
<!-- End Page Title Area -->

<!-- Start Sign Up Area -->
<section class="user-area-all-style sign-up-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="contact-form-action">
                    <div class="form-heading text-center">
                        <h3 class="form-title">Create an account!</h3>
                        <p class="form-desc">With your social network.</p>
                    </div>
                    <form action="{{ route('register') }}" method="POST">
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
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <input id="name" type="text" name="name" placeholder="Name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required autofocus autocomplete="name">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <input id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email Address" value="{{ old('email') }}" required autocomplete="username">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <input id="password" class="form-control @error('password') is-invalid @enderror" type="password" name="password" placeholder="Password" required autocomplete="new-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 ">
                                <div class="form-group">
                                    <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password">
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="default-btn btn-two" type="submit">
                                    Register Account
                                    <i class="flaticon-right"></i>
                                </button>
                            </div>
                            <div class="col-12">
                                <p class="account-desc">
                                    Already have an account?
                                    <a href="{{ route('login') }}"> Login</a>
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Sign Up Area -->
@endsection

@push('frontend_script')

@endpush
