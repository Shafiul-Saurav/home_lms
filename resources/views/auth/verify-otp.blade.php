@extends('frontend.layouts.master')

@section('title', 'Verify OTP')

@push('frontend_style')
<style>
    .otp-timer {
        text-align: center;
        margin: 20px 0;
        padding: 15px;
        background-color: #f8f9fa;
        border-radius: 8px;
        border: 1px solid #e9ecef;
    }

    .timer-text {
        font-weight: bold;
        font-size: 1.2em;
        color: #0d6efd;
        display: inline-block;
        padding: 5px 15px;
        background-color: white;
        border-radius: 20px;
        border: 2px solid #0d6efd;
        min-width: 80px;
        text-align: center;
    }
</style>
@endpush

@section('frontend_content')
    <main class="main">
        <!-- breadcrumb -->
        <x-frontend.pages.common.breadcrumb
            :title="'Dashboard'"
            :breadcrumb="[
                ['name' => 'Home', 'url' => route('home')],
                ['name' => 'Verify OTP', 'url' => '#']
            ]"
        />
        <!-- breadcrumb end -->

        <!-- verify otp area -->
        <div class="auth-area py-120">
            <div class="container">
                <div class="col-md-5 mx-auto">
                    <div class="auth-form">
                        <div class="auth-header">
                            <img src="{{ asset('assets/frontend') }}/img/logo/logo.png" alt="" />
                            <p>Enter the OTP sent to your email</p>
                        </div>
                        <form action="{{ route('otp.verify') }}" method="POST">
                            @csrf
                            <input type="hidden" name="email" value="{{ $email }}">
                            <div class="form-group">
                                <div class="form-icon">
                                    <i class="far fa-key"></i>
                                    <input type="text" name="otp" id="otp" class="form-control @error('otp') is-invalid @enderror" placeholder="6-Digit OTP" required maxlength="6" inputmode="numeric" pattern="[0-9]{6}" />
                                </div>
                                @error('otp')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="auth-btn">
                                <button type="submit" class="theme-btn"><span class="far fa-check-circle"></span> Verify OTP</button>
                            </div>
                        </form>
                        <div class="auth-bottom">
                            <p class="auth-bottom-text">
                                Didn't receive OTP?
                                <a href="{{ route('password.request') }}">Resend OTP</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- verify otp area end -->
    </main>
@endsection

@push('frontend_script')
    <script>
        // Auto format OTP input to only accept numbers
        document.getElementById('otp').addEventListener('input', function (e) {
            // Remove any non-digit characters
            this.value = this.value.replace(/\D/g, '');

            // Limit to 6 digits
            if (this.value.length > 6) {
                this.value = this.value.substring(0, 6);
            }
        });

        // Auto format OTP input to only accept numbers
        document.getElementById('otp').addEventListener('input', function (e) {
            // Remove any non-digit characters
            this.value = this.value.replace(/\D/g, '');

            // Limit to 6 digits
            if (this.value.length > 6) {
                this.value = this.value.substring(0, 6);
            }
        });
    </script>
@endpush
