@extends('frontendone.layouts.master')

@section('title', 'About Me')

@push('frontendone_style')
    @include('frontend.pages.common.style')
    <style>
        .info-group {
            margin-bottom: 10px;
        }
        .info-label {
            font-weight: 700;
            color: #111827;
            font-size: 14px;
            margin-bottom: 8px;
        }
        .info-value {
            background: #f9fafb;
            border: 1px solid #edf0f5;
            border-radius: 14px;
            padding: 14px 20px;
            font-size: 14px;
            font-weight: 600;
            color: #374151;
            min-height: 54px;
            display: flex;
            align-items: center;
        }
        .info-icon {
            margin-right: 12px;
            color: #76bd10;
            font-size: 16px;
            width: 20px;
            text-align: center;
        }
        .social-link-btn {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 20px;
            border-radius: 14px;
            font-weight: 700;
            font-size: 14px;
            text-decoration: none;
            transition: 0.3s;
            border: 1px solid transparent;
        }
        .social-link-btn i {
            font-size: 16px;
            width: 20px;
            text-align: center;
        }
        .social-link-btn.facebook { background: #eff6ff; color: #1d4ed8; border-color: #dbeafe; }
        .social-link-btn.facebook:hover { background: #dbeafe; transform: translateY(-1px); }
        .social-link-btn.twitter { background: #f0f9ff; color: #0284c7; border-color: #e0f2fe; }
        .social-link-btn.twitter:hover { background: #e0f2fe; transform: translateY(-1px); }
        .social-link-btn.linkedin { background: #f0fdf4; color: #16a34a; border-color: #dcfce7; }
        .social-link-btn.linkedin:hover { background: #dcfce7; transform: translateY(-1px); }
        .social-link-btn.instagram { background: #fdf2f8; color: #db2777; border-color: #fce7f3; }
        .social-link-btn.instagram:hover { background: #fce7f3; transform: translateY(-1px); }
    </style>
@endpush

@section('frontendone_content')
    <main class="main">
        <x-frontend.pages.common.breadcrumb :title="'About Me'" :breadcrumb="[['name' => 'Home', 'url' => route('home')], ['name' => 'About Me', 'url' => '#']]" />

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
                                        <h4 class="title">About Me</h4>
                                        <div class="user-info-display">
                                            <div class="row g-4">
                                                <div class="col-md-6">
                                                    <div class="info-group">
                                                        <div class="info-label">Full Name</div>
                                                        <div class="info-value">
                                                            <i class="fa-solid fa-user info-icon"></i>
                                                            {{ $user->name ?? 'N/A' }}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="info-group">
                                                        <div class="info-label">Email Address</div>
                                                        <div class="info-value">
                                                            <i class="fa-solid fa-envelope info-icon"></i>
                                                            {{ $user->email ?? 'N/A' }}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="info-group">
                                                        <div class="info-label">Phone Number</div>
                                                        <div class="info-value">
                                                            <i class="fa-solid fa-phone info-icon"></i>
                                                            {{ $user->phone ?? 'N/A' }}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="info-group">
                                                        <div class="info-label">National ID Number</div>
                                                        <div class="info-value">
                                                            <i class="fa-solid fa-id-card info-icon"></i>
                                                            {{ $profile->nid_num ?? 'N/A' }}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="info-group">
                                                        <div class="info-label">Gender</div>
                                                        <div class="info-value">
                                                            <i class="fa-solid fa-venus-mars info-icon"></i>
                                                            {{ $profile->gender ? ucfirst($profile->gender) : 'N/A' }}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="info-group">
                                                        <div class="info-label">Address</div>
                                                        <div class="info-value">
                                                            <i class="fa-solid fa-map-marker-alt info-icon"></i>
                                                            {{ $profile->address ?? 'N/A' }}
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-12 mt-4">
                                                    <h5 style="font-size: 16px; font-weight: 800; color: #111827; margin-bottom: 15px;">Social Media Profiles</h5>
                                                    <div class="row g-3">
                                                        <div class="col-md-6">
                                                            @if(!empty($profile->facebook))
                                                                <a href="{{ $profile->facebook }}" target="_blank" class="social-link-btn facebook">
                                                                    <i class="fab fa-facebook-f"></i> Facebook Profile
                                                                </a>
                                                            @else
                                                                <div class="info-value text-muted" style="background: #f9fafb; border: 1px dashed #edf0f5;">
                                                                    <i class="fab fa-facebook-f text-muted me-2"></i> Facebook URL not added
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div class="col-md-6">
                                                            @if(!empty($profile->twitter))
                                                                <a href="{{ $profile->twitter }}" target="_blank" class="social-link-btn twitter">
                                                                    <i class="fab fa-twitter"></i> Twitter Profile
                                                                </a>
                                                            @else
                                                                <div class="info-value text-muted" style="background: #f9fafb; border: 1px dashed #edf0f5;">
                                                                    <i class="fab fa-twitter text-muted me-2"></i> Twitter URL not added
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div class="col-md-6">
                                                            @if(!empty($profile->linkedIn))
                                                                <a href="{{ $profile->linkedIn }}" target="_blank" class="social-link-btn linkedin">
                                                                    <i class="fab fa-linkedin-in"></i> LinkedIn Profile
                                                                </a>
                                                            @else
                                                                <div class="info-value text-muted" style="background: #f9fafb; border: 1px dashed #edf0f5;">
                                                                    <i class="fab fa-linkedin-in text-muted me-2"></i> LinkedIn URL not added
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div class="col-md-6">
                                                            @if(!empty($profile->instagram))
                                                                <a href="{{ $profile->instagram }}" target="_blank" class="social-link-btn instagram">
                                                                    <i class="fab fa-instagram"></i> Instagram Profile
                                                                </a>
                                                            @else
                                                                <div class="info-value text-muted" style="background: #f9fafb; border: 1px dashed #edf0f5;">
                                                                    <i class="fab fa-instagram text-muted me-2"></i> Instagram URL not added
                                                                </div>
                                                            @endif
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
                </div>
            </div>
        </div>
    </main>
@endsection

@push('frontendone_script')
    @include('frontend.pages.common.script')
@endpush
