@extends('frontendone.layouts.master')

@section('title', 'Personal Setting')

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

        .form-icon-contact input.form-control,
        .form-icon-contact select.form-control {
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
        <x-frontend.pages.common.breadcrumb :title="'Personal Setting'" :breadcrumb="[['name' => 'Home', 'url' => route('home')], ['name' => 'Personal Setting', 'url' => '#']]" />
        <!-- breadcrumb end -->

        <!-- user profile -->
        <div class="user-account py-5">
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
                                                        <div class="form-group-contact">
                                                            <label class="form-label">National ID</label>
                                                            <div class="form-icon-contact">
                                                                <input type="number" name="nid_num"
                                                                    class="form-control @error('nid_num') is-invalid @enderror"
                                                                    value="{{ old('nid_num', $profile->nid_num ?? '') }}"
                                                                    placeholder="National ID Number" />
                                                                <i class="fa-solid fa-id-card input-icon"></i>
                                                            </div>
                                                            @error('nid_num')
                                                                <span class="invalid-feedback d-block" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group-contact">
                                                            <label class="form-label">Gender</label>
                                                            <div class="form-icon-contact">
                                                                <select name="gender"
                                                                    class="form-control @error('gender') is-invalid @enderror">
                                                                    <option value="">Select Gender</option>
                                                                    <option value="male" @selected(old('gender', $profile->gender ?? '') === 'male')>Male</option>
                                                                    <option value="female" @selected(old('gender', $profile->gender ?? '') === 'female')>Female</option>
                                                                    <option value="other" @selected(old('gender', $profile->gender ?? '') === 'other')>Other</option>
                                                                </select>
                                                                <i class="fa-solid fa-venus-mars input-icon"></i>
                                                            </div>
                                                            @error('gender')
                                                                <span class="invalid-feedback d-block" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group-contact">
                                                            <label class="form-label">Facebook</label>
                                                            <div class="form-icon-contact">
                                                                <input type="url" name="facebook"
                                                                    class="form-control @error('facebook') is-invalid @enderror"
                                                                    value="{{ old('facebook', $profile->facebook ?? '') }}"
                                                                    placeholder="Facebook Profile URL" />
                                                                <i class="fab fa-facebook-f input-icon"></i>
                                                            </div>
                                                            @error('facebook')
                                                                <span class="invalid-feedback d-block" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group-contact">
                                                            <label class="form-label">Twitter</label>
                                                            <div class="form-icon-contact">
                                                                <input type="url" name="twitter"
                                                                    class="form-control @error('twitter') is-invalid @enderror"
                                                                    value="{{ old('twitter', $profile->twitter ?? '') }}"
                                                                    placeholder="Twitter Profile URL" />
                                                                <i class="fab fa-twitter input-icon"></i>
                                                            </div>
                                                            @error('twitter')
                                                                <span class="invalid-feedback d-block" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group-contact">
                                                            <label class="form-label">LinkedIn</label>
                                                            <div class="form-icon-contact">
                                                                <input type="url" name="linkedIn"
                                                                    class="form-control @error('linkedIn') is-invalid @enderror"
                                                                    value="{{ old('linkedIn', $profile->linkedIn ?? '') }}"
                                                                    placeholder="LinkedIn Profile URL" />
                                                                <i class="fab fa-linkedin-in input-icon"></i>
                                                            </div>
                                                            @error('linkedIn')
                                                                <span class="invalid-feedback d-block" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group-contact">
                                                            <label class="form-label">Instagram</label>
                                                            <div class="form-icon-contact">
                                                                <input type="url" name="instagram"
                                                                    class="form-control @error('instagram') is-invalid @enderror"
                                                                    value="{{ old('instagram', $profile->instagram ?? '') }}"
                                                                    placeholder="Instagram Profile URL" />
                                                                <i class="fab fa-instagram input-icon"></i>
                                                            </div>
                                                            @error('instagram')
                                                                <span class="invalid-feedback d-block" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group-contact">
                                                            <label class="form-label">Address</label>
                                                            <div class="form-icon-contact">
                                                                <input type="text" name="address"
                                                                    class="form-control @error('address') is-invalid @enderror"
                                                                    value="{{ old('address', $profile->address ?? '') }}"
                                                                    placeholder="Address" />
                                                                <i class="fa-solid fa-map-marker-alt input-icon"></i>
                                                            </div>
                                                            @error('address')
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
