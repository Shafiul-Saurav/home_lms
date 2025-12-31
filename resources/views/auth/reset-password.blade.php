@extends('frontend.layouts.master')

@section('title', 'Reset Password')

@push('frontend_style')
@endpush

@section('frontend_content')
    <main class="main">
        <!-- breadcrumb -->
        <x-frontend.pages.common.breadcrumb
            :title="'Dashboard'"
            :breadcrumb="[
                ['name' => 'Home', 'url' => route('home')],
                ['name' => 'Reset Password', 'url' => '#']
            ]"
        />
        <!-- breadcrumb end -->

        <!-- reset password area -->
        <div class="auth-area py-120">
            <div class="container">
                <div class="col-md-5 mx-auto">
                    <div class="auth-form">
                        <div class="auth-header">
                            <img src="{{ asset('assets/frontend') }}/img/logo/logo.png" alt="" />
                            <p>Reset your edubo account password</p>
                        </div>
                        <form action="{{ route('password.update') }}" method="POST">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
                            <div class="form-group">
                                <div class="form-icon">
                                    <i class="far fa-envelope"></i>
                                    <input type="email" name="email" id="email" class="form-control" placeholder="Your Email" value="{{ $email }}" readonly />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-icon">
                                    <i class="far fa-key"></i>
                                    <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="New Password" required autocomplete="new-password" />
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
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirm Password" required autocomplete="new-password" />
                                </div>
                            </div>
                            <div class="auth-btn">
                                <button type="submit" class="theme-btn"><span class="far fa-key"></span> Reset
                                    Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- reset password area end -->
    </main>
@endsection

@push('frontend_script')
@endpush
