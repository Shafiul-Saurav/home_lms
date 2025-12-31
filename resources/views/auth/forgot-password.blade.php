@extends('frontend.layouts.master')

@section('title', 'Forgot Password')

@push('frontend_style')
@endpush

@section('frontend_content')
    <main class="main">
        <!-- breadcrumb -->
        <x-frontend.pages.common.breadcrumb
            :title="'Dashboard'"
            :breadcrumb="[
                ['name' => 'Home', 'url' => route('home')],
                ['name' => 'Forgot Password', 'url' => '#']
            ]"
        />
        <!-- breadcrumb end -->

        <!-- forgot password area -->
        <div class="auth-area py-120">
            <div class="container">
                <div class="col-md-5 mx-auto">
                    <div class="auth-form">
                        <div class="auth-header">
                            <img src="{{ asset('assets/frontend') }}/img/logo/logo.png" alt="" />
                            <p>Reset your edubo account password</p>
                        </div>
                        @if (session('status'))
                            <div class="mb-4 text-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form action="{{ route('password.email') }}" method="POST">
                            @csrf
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
                            <div class="auth-btn">
                                <button type="submit" class="theme-btn"><span class="far fa-key"></span> Send OTP</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- forgot password area end -->
    </main>
@endsection

@push('frontend_script')
@endpush
