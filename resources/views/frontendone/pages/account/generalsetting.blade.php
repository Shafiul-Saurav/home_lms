@extends('frontendone.layouts.master')

@section('title', 'General Setting')

@push('frontendone_style')
    @include('frontend.pages.common.style')
    <style>
        .form-group-contact {
            margin-bottom: 22px;
        }

        .form-group-contact label.form-label {
            font-weight: 700;
            color: #111827;
            margin-bottom: 8px;
            font-size: 14px;
            display: inline-block;
        }

        .form-icon-contact {
            position: relative;
        }

        .form-icon-contact i.input-icon {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            font-size: 15px;
            transition: 0.3s;
            z-index: 5;
        }

        .form-icon-contact .form-control {
            padding-left: 50px;
            border-radius: 14px;
            border: 1px solid #edf0f5;
            font-size: 14px;
            font-weight: 600;
            background: #fff;
            color: #111827;
            transition: 0.3s;
            box-shadow: none;
        }
        
        .form-icon-contact input.form-control {
            height: 54px;
        }

        .form-icon-contact .form-control::placeholder {
            color: #9ca3af;
        }

        .form-icon-contact .form-control:focus {
            border-color: #76bd10;
            box-shadow: 0 0 0 4px rgba(118, 189, 16, 0.12);
            outline: none;
        }

        .form-icon-contact .form-control:focus ~ i.input-icon {
            color: #76bd10;
        }

        .auth-btn-contact button {
            width: auto;
            min-width: 180px;
            padding: 0 25px;
            height: 50px;
            background: #111827;
            color: #fff;
            border: none;
            border-radius: 50px;
            font-weight: 800;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: 0.3s;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .auth-btn-contact button:hover {
            background: #76bd10;
            color: #111827;
            box-shadow: 0 8px 25px rgba(118, 189, 16, 0.35);
            transform: translateY(-1px);
        }
    </style>
@endpush

@section('frontendone_content')
    <main class="main">
        <!-- breadcrumb -->
        <x-frontend.pages.common.breadcrumb :title="'General Setting'" :breadcrumb="[['name' => 'Home', 'url' => route('home')], ['name' => 'General Setting', 'url' => '#']]" />
        <!-- breadcrumb end -->

        <!-- user profile -->
        <div class="user-account py-100">
            <div class="container">
                <div class="row g-4">
                    <div class="col-lg-4 col-xl-3">
                        @include('frontendone.pages.account.sidebarmenu.sidebar')
                    </div>
                    <div class="col-lg-8 col-xl-9">
                        <div class="user-wrapper">
                            <div class="row g-4">
                                <div class="col-lg-12">
                                    <div class="user-card">
                                        <h4 class="title">General Info</h4>
                                        <div class="user-form">
                                            <form action="{{ route('general.store') }}" method="POST" novalidate>
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group-contact">
                                                            <label class="form-label">Full Name</label>
                                                            <div class="form-icon-contact">
                                                                <input type="text" name="name" class="form-control"
                                                                    value="{{ $user->name ?? (auth()->user()->name ?? '') }}"
                                                                    placeholder="Full Name" disabled />
                                                                <i class="fa-solid fa-user input-icon"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group-contact">
                                                            <label class="form-label">Email</label>
                                                            <div class="form-icon-contact">
                                                                <input type="text" name="email" class="form-control"
                                                                    value="{{ $user->email ?? (auth()->user()->email ?? '') }}"
                                                                    placeholder="Email" disabled />
                                                                <i class="fa-solid fa-envelope input-icon"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group-contact">
                                                            <label class="form-label">Phone</label>
                                                            <div class="form-icon-contact">
                                                                <input type="text" name="phone"
                                                                    class="form-control @error('phone') is-invalid @enderror"
                                                                    value="{{ old('phone', $user->phone ?? (auth()->user()->phone ?? '')) }}"
                                                                    placeholder="Phone" />
                                                                <i class="fa-solid fa-phone input-icon"></i>
                                                            </div>
                                                            @error('phone')
                                                                <span class="invalid-feedback d-block" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="auth-btn-contact mt-3">
                                                    <button type="submit"><span class="far fa-save"></span> Save Changes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="user-card">
                                        <h4 class="title">Change Password</h4>
                                        <div class="col-lg-12">
                                            <div class="user-form">
                                                <form action="{{ route('mypostupdate.password') }}" method="POST"
                                                    novalidate>
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group-contact">
                                                                <label class="form-label">Old Password</label>
                                                                <div class="form-icon-contact">
                                                                    <input type="password" name="old_password"
                                                                        class="form-control @error('old_password') is-invalid @enderror"
                                                                        placeholder="Old Password" />
                                                                    <i class="fa-solid fa-lock input-icon"></i>
                                                                </div>
                                                                @error('old_password')
                                                                    <span class="invalid-feedback d-block" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group-contact">
                                                                <label class="form-label">New Password</label>
                                                                <div class="form-icon-contact">
                                                                    <input type="password" name="password"
                                                                        class="form-control @error('password') is-invalid @enderror"
                                                                        placeholder="New Password" />
                                                                    <i class="fa-solid fa-lock input-icon"></i>
                                                                </div>
                                                                @error('password')
                                                                    <span class="invalid-feedback d-block" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group-contact">
                                                                <label class="form-label">Re-Type Password</label>
                                                                <div class="form-icon-contact">
                                                                    <input type="password" name="password_confirmation"
                                                                        class="form-control @error('password_confirmation') is-invalid @enderror"
                                                                        placeholder="Re-Type Password" />
                                                                    <i class="fa-solid fa-lock input-icon"></i>
                                                                </div>
                                                                @error('password_confirmation')
                                                                    <span class="invalid-feedback d-block" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="auth-btn-contact mt-3">
                                                        <button type="submit"><span class="far fa-key"></span> Change Password</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- user profile end -->

    </main>
@endsection

@push('frontendone_script')
    @include('frontend.pages.common.script')
@endpush
