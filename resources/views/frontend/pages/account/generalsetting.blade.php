@extends('frontend.layouts.master')

@section('title', 'Dashboard')

@push('frontend_style')
@endpush

@section('frontend_content')
    <main class="main">
        <!-- breadcrumb -->
        <x-frontend.pages.common.breadcrumb
            :title="'General Setting'"
            :breadcrumb="[
                ['name' => 'Home', 'url' => route('home')],
                ['name' => 'General Setting', 'url' => '#']
            ]"
        />
        <!-- breadcrumb end -->

        <!-- user profile -->
        <div class="user-account py-100">
            <div class="container">
                <div class="row g-4">
                    <div class="col-lg-4 col-xl-3">
                        @include('frontend.pages.account.sidebarmenu.sidebar')
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
                                                        <div class="form-group">
                                                            <label class="form-label">Full Name</label>
                                                            <input type="text" name="name" class="form-control"
                                                                value="{{ $user->name ?? auth()->user()->name ?? '' }}"
                                                                placeholder="Full Name" disabled />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Email</label>
                                                            <input type="text" name="email" class="form-control"
                                                                value="{{ $user->email ?? auth()->user()->email ?? '' }}"
                                                                placeholder="Email" disabled />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="form-label">Phone</label>
                                                            <input type="text" name="phone"
                                                                class="form-control @error('phone') is-invalid @enderror"
                                                                value="{{ old('phone', $user->phone ?? auth()->user()->phone ?? '') }}"
                                                                placeholder="Phone" />
                                                            @error('phone')
                                                                <span class="invalid-feedback d-block" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    {{-- <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Address</label>
                                                            <input type="text" class="form-control" value="{{ auth()->user()->address ?? '' }}" placeholder="Address" />
                                                        </div>
                                                    </div> --}}
                                                </div>
                                                <button type="submit" class="theme-btn"><span class="far fa-save"></span>
                                                    Save Changes</button>
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
                                                            <div class="form-group">
                                                                <label class="form-label">Old Password</label>
                                                                <input type="password" name="old_password"
                                                                    class="form-control @error('old_password') is-invalid @enderror"
                                                                    placeholder="Old Password" />
                                                                @error('old_password')
                                                                    <span class="invalid-feedback d-block" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="form-label">New Password</label>
                                                                <input type="password" name="password"
                                                                    class="form-control @error('password') is-invalid @enderror"
                                                                    placeholder="New Password" />
                                                                @error('password')
                                                                    <span class="invalid-feedback d-block" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="form-label">Re-Type Password</label>
                                                                <input type="password" name="password_confirmation"
                                                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                                                    placeholder="Re-Type Password" />
                                                                @error('password_confirmation')
                                                                    <span class="invalid-feedback d-block" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button type="submit" class="theme-btn"><span
                                                            class="far fa-key"></span> Change Password</button>
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

@push('frontend_script')
@endpush
