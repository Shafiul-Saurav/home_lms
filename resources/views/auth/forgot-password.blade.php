{{-- <x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="block">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button>
                    {{ __('Email Password Reset Link') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout> --}}


@extends('frontend.layouts.master')

@section('title', 'Forgot Password')

@push('frontend_style')

@endpush

@section('frontend_content')
<!-- Start Page Title Area -->
<div class="page-title-area" style="background-image: url('{{ asset('assets/frontend/img/page-bg.jpg') }}')">
    <div class="container">
        <div class="page-title-content">
            <h2>Forgot Password</h2>
            <ul>
                <li>
                    <a href="index.html">
                        Home
                    </a>
                </li>
                <li>Pages</li>
                <li>User</li>
                <li>Forgot Password</li>
            </ul>
        </div>
    </div>
</div>
<!-- End Page Title Area -->

<!-- Start Forgot Password Area -->
<section class="user-area-all-style log-in-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="contact-form-action">
                    <div class="form-heading text-center">
                        <h3 class="form-title">{{ __('Forgot your password?') }}</h3>
                        <p class="form-desc">{{ __('No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}</p>
                    </div>
                    @if (session('status'))
                        <div class="mb-4 text-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form action="{{ route('password.email') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <input type="email" name="email" id="email" class="form-control" placeholder="Username or Email" value="{{ old('email') }}" required autofocus autocomplete="username">
                                </div>

                            </div>
                            <div class="col-12">
                                <button class="default-btn btn-two" type="submit">
                                    {{ __('Email Password Reset Link') }}
                                    <i class="flaticon-right"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Forgot Password Area -->
@endsection

@push('frontend_script')

@endpush
