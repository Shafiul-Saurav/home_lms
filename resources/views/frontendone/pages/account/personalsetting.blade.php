@extends('frontendone.layouts.master')

@section('title', 'Personal Setting')

@push('frontendone_style')
    @include('frontend.pages.common.style')
@endpush

@section('frontendone_content')
    <main class="main">
        <!-- breadcrumb -->
        <x-frontend.pages.common.breadcrumb :title="'Personal Setting'" :breadcrumb="[['name' => 'Home', 'url' => route('home')], ['name' => 'Personal Setting', 'url' => '#']]" />
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
                                        <h4 class="title">Profile Info</h4>
                                        <div class="user-form">
                                            <form action="{{ route('personal.store') }}" method="POST" novalidate>
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label">National ID</label>
                                                            <input type="number" name="nid_num"
                                                                class="form-control @error('nid_num') is-invalid @enderror"
                                                                value="{{ old('nid_num', $profile->nid_num ?? '') }}"
                                                                placeholder="National ID Number" />
                                                            @error('nid_num')
                                                                <span class="invalid-feedback d-block" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Gender</label>
                                                            <select name="gender"
                                                                class="form-control @error('gender') is-invalid @enderror">
                                                                <option value="">Select Gender</option>
                                                                <option value="male" @selected(old('gender', $profile->gender ?? '') === 'male')>Male
                                                                </option>
                                                                <option value="female" @selected(old('gender', $profile->gender ?? '') === 'female')>Female
                                                                </option>
                                                                <option value="other" @selected(old('gender', $profile->gender ?? '') === 'other')>Other
                                                                </option>
                                                            </select>
                                                            @error('gender')
                                                                <span class="invalid-feedback d-block" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Facebook</label>
                                                            <input type="url" name="facebook"
                                                                class="form-control @error('facebook') is-invalid @enderror"
                                                                value="{{ old('facebook', $profile->facebook ?? '') }}"
                                                                placeholder="Facebook Profile URL" />
                                                            @error('facebook')
                                                                <span class="invalid-feedback d-block" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Twitter</label>
                                                            <input type="url" name="twitter"
                                                                class="form-control @error('twitter') is-invalid @enderror"
                                                                value="{{ old('twitter', $profile->twitter ?? '') }}"
                                                                placeholder="Twitter Profile URL" />
                                                            @error('twitter')
                                                                <span class="invalid-feedback d-block" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label">LinkedIn</label>
                                                            <input type="url" name="linkedIn"
                                                                class="form-control @error('linkedIn') is-invalid @enderror"
                                                                value="{{ old('linkedIn', $profile->linkedIn ?? '') }}"
                                                                placeholder="LinkedIn Profile URL" />
                                                            @error('linkedIn')
                                                                <span class="invalid-feedback d-block" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Instagram</label>
                                                            <input type="url" name="instagram"
                                                                class="form-control @error('instagram') is-invalid @enderror"
                                                                value="{{ old('instagram', $profile->instagram ?? '') }}"
                                                                placeholder="Instagram Profile URL" />
                                                            @error('instagram')
                                                                <span class="invalid-feedback d-block" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="form-label">Address</label>
                                                            <input type="text" name="address"
                                                                class="form-control @error('address') is-invalid @enderror"
                                                                value="{{ old('address', $profile->address ?? '') }}"
                                                                placeholder="Address" />
                                                            @error('address')
                                                                <span class="invalid-feedback d-block" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="submit" class="theme-btn"><span class="far fa-save"></span>
                                                    Save Changes</button>
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
        <!-- user profile end -->

    </main>
@endsection

@push('frontendone_script')
    @include('frontend.pages.common.script')
@endpush
