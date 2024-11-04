{{-- <x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div class="block">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button>
                    {{ __('Reset Password') }}
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
            <h2>Reset Password</h2>
            <ul>
                <li>
                    <a href="index.html">
                        Home
                    </a>
                </li>
                <li>Pages</li>
                <li>User</li>
                <li>Reset Password</li>
            </ul>
        </div>
    </div>
</div>
<!-- End Page Title Area -->

<!-- Start Reset Password Area -->
<section class="user-area-all-style log-in-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="contact-form-action">
                    <div class="form-heading text-center">
                        <h3 class="form-title">{{ __('Reset your password') }}</h3>
                    </div>
                    <form action="{{ route('password.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" name="password" id="password" class="form-control" required autofocus autocomplete="new-password">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required autofocus autocomplete="new-password">
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="default-btn btn-two" type="submit">
                                    {{ __('Reset Password') }}
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
<!-- End Reset Password Area -->
@endsection

@push('frontend_script')

@endpush
