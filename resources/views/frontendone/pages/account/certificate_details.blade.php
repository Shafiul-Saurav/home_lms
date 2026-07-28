@extends('frontendone.layouts.master')

@section('title', 'Certificate Details')

@push('frontendone_style')
    @include('frontend.pages.common.style')
    <link
        href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700&family=Inter:wght@300;400;500;600&display=swap"
        rel="stylesheet">
    <style>
        /* ── Panel Card ──────────────────────────────────────────────── */
        .panel-card {
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 18px 50px rgba(8, 15, 30, 0.10);
            padding: 32px;
        }

        .panel-card h3 {
            font-size: 1.5rem;
            font-weight: 700;
        }

        /* ── Certificate Preview ─────────────────────────────────────── */
        .cert-preview-wrapper {
            position: relative;
            width: 100%;
            aspect-ratio: 1.414 / 1;
            /* A4 landscape ratio */
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.55);
            background: #040d18;
            font-family: 'Inter', sans-serif;
        }

        .cert-bg {
            position: absolute;
            inset: 0;
            background-image: url('{{ asset('certificate.png') }}');
            background-size: cover;
            background-position: center;
        }

        .cert-bg::after {
            content: '';
            position: absolute;
            inset: 0;
            background: rgba(2, 14, 26, 0.48);
        }

        .cert-content {
            position: absolute;
            inset: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 3% 6%;
        }

        /* Gold outer border */
        .cert-border-outer {
            position: absolute;
            inset: 2%;
            border: 3px solid #76bd10;
            border-radius: 6px;
            pointer-events: none;
        }

        .cert-border-inner {
            position: absolute;
            inset: calc(2% + 10px);
            border: 1px solid #76bd10;
            border-radius: 4px;
            pointer-events: none;
        }

        /* Top & bottom gold bars */
        .cert-bar-top {
            position: absolute;
            left: calc(2% + 10px);
            right: calc(2% + 10px);
            top: calc(2% + 10px);
            height: 5px;
            background: #76bd10;
            border-radius: 2px;
        }

        .cert-bar-bottom {
            position: absolute;
            left: calc(2% + 10px);
            right: calc(2% + 10px);
            bottom: calc(2% + 10px);
            height: 5px;
            background: #76bd10;
            border-radius: 2px;
        }

        /* Brand header top center */
        .cert-brand {
            font-size: 2.2em;
            font-weight: 800;
            letter-spacing: 0.05em;
            margin-bottom: 1%;
            text-transform: uppercase;
            font-family: 'Inter', sans-serif;
            text-align: center;
        }

        .cert-brand-cyber {
            color: #ffffff;
        }

        .cert-brand-bd {
            color: #76bd10;
        }

        /* Title */
        .cert-title {
            font-family: 'Cinzel', serif;
            font-size: 1.9em;
            font-weight: 700;
            color: #fff;
            text-align: center;
            line-height: 1.15;
            margin-bottom: 1%;
        }

        .cert-title-line {
            width: 40%;
            height: 1px;
            background: linear-gradient(90deg, transparent, #76bd10, transparent);
            margin: 0 auto 2%;
        }

        .cert-subtitle {
            font-size: 0.65em;
            color: #b4cde6;
            margin-bottom: 1.5%;
        }

        .cert-name {
            font-family: 'Cinzel', serif;
            font-size: 1.6em;
            font-weight: 700;
            color: #76bd10;
            text-align: center;
            margin-bottom: 0.5%;
        }

        .cert-name-line {
            width: 50%;
            height: 1px;
            background: #76bd10;
            margin: 0 auto 1.5%;
            opacity: 0.6;
        }

        .cert-completed-text {
            font-size: 0.62em;
            color: #b4cde6;
            margin-bottom: 1%;
        }

        .cert-course {
            font-size: 1.1em;
            font-weight: 700;
            color: #fff;
            text-align: center;
            margin-bottom: 2%;
        }

        /* Divider */
        .cert-divider {
            display: flex;
            align-items: center;
            width: 70%;
            gap: 8px;
            margin-bottom: 2%;
        }

        .cert-divider-line {
            flex: 1;
            height: 1px;
            background: #76bd10;
            opacity: 0.6;
        }

        .cert-divider-dot {
            width: 7px;
            height: 7px;
            background: #76bd10;
            border-radius: 50%;
        }

        /* Info row */
        .cert-info-row {
            display: flex;
            justify-content: space-between;
            width: 78%;
            margin-bottom: 2.5%;
        }

        .cert-info-label {
            font-size: 0.48em;
            letter-spacing: 0.12em;
            color: #8caac8;
            text-transform: uppercase;
            margin-bottom: 2px;
        }

        .cert-info-value {
            font-size: 0.62em;
            font-weight: 700;
            color: #76bd10;
        }

        .cert-info-right {
            text-align: right;
        }

        /* Signatures */
        .cert-sig-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            width: 78%;
            position: relative;
        }

        .cert-sig {
            text-align: center;
            flex: 1;
        }

        .cert-sig-line {
            width: 80%;
            height: 1px;
            background: #76bd10;
            margin: 0 auto 4px;
        }

        .cert-sig-name {
            font-size: 0.55em;
            font-weight: 600;
            color: #fff;
        }

        .cert-sig-title {
            font-size: 0.45em;
            color: #8caac8;
        }

        /* Center seal */
        .cert-seal {
            position: absolute;
            bottom: 12%;
            left: 50%;
            transform: translateX(-50%);
            width: 62px;
            height: 62px;
        }

        .cert-seal-outer {
            width: 62px;
            height: 62px;
            border-radius: 50%;
            border: 2px solid #76bd10;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(212, 175, 55, 0.10);
        }

        .cert-seal-inner {
            width: 46px;
            height: 46px;
            border-radius: 50%;
            background: #76bd10;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            color: #040d18;
        }

        /* ── Download button ─────────────────────────────────────────── */
        .cert-download-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            margin-top: 24px;
            padding: 14px 32px;
            background: linear-gradient(135deg, #76bd10, #5ea00c);
            color: #040d18;
            font-weight: 700;
            border-radius: 50px;
            border: none;
            font-size: 0.95rem;
            letter-spacing: 0.03em;
            text-decoration: none;
            box-shadow: 0 8px 24px rgba(212, 175, 55, 0.35);
            transition: transform 0.2s, box-shadow 0.2s;
            cursor: pointer;
        }

        .cert-download-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 32px rgba(212, 175, 55, 0.5);
            color: #040d18;
        }

        .enroll-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 22px;
            background-color: #76bd10;
            border-color: #76bd10;
            color: #fff;
            border-radius: 8px;
            text-decoration: none;
            font-size: 0.9rem;
            transition: background 0.2s;
        }

        .enroll-btn:hover {
            background-color: #62a00d;
            color: #fff;
        }
    </style>
@endpush

@section('frontendone_content')
    <main class="main">
        <x-frontend.pages.common.breadcrumb :title="'Certificate Details'" :breadcrumb="[
            ['name' => 'Home', 'url' => route('home')],
            ['name' => 'My Certificates', 'url' => route('user.certificates')],
            ['name' => 'Details', 'url' => '#'],
        ]" />

        <section class="section-padding py-5">
            <div class="container">
                <div class="row g-4">
                    <div class="col-lg-4 col-xl-3">
                        @include('frontendone.pages.account.sidebarmenu.sidebar')
                    </div>
                    <div class="col-lg-8 col-xl-9">
                        <div class="panel-card">
                            <h3 class="mb-4">Certificate Details</h3>

                            <div class="row g-3 mb-4">
                                <div class="col-sm-6">
                                    <p class="text-muted mb-1"
                                        style="font-size:0.82rem;font-weight:600;text-transform:uppercase;letter-spacing:.05em;">
                                        Course</p>
                                    <h6 class="mb-0">{{ $certificate->course->name ?? 'N/A' }}</h6>
                                </div>
                                <div class="col-sm-6">
                                    <p class="text-muted mb-1"
                                        style="font-size:0.82rem;font-weight:600;text-transform:uppercase;letter-spacing:.05em;">
                                        Status</p>
                                    @if ($certificate->status === 'pending')
                                        <span class="badge bg-warning text-dark px-3 py-2">⏳ Pending Review</span>
                                    @elseif($certificate->status === 'approved')
                                        <span class="badge bg-success px-3 py-2">✅ Approved</span>
                                    @else
                                        <span class="badge bg-danger px-3 py-2">❌ Rejected</span>
                                    @endif
                                </div>

                                @if ($certificate->status === 'approved')
                                    <div class="col-sm-6">
                                        <p class="text-muted mb-1"
                                            style="font-size:0.82rem;font-weight:600;text-transform:uppercase;letter-spacing:.05em;">
                                            Certificate No.</p>
                                        <h6 class="mb-0 text-warning" style="font-family:monospace;">
                                            {{ $certificate->certificate_number }}</h6>
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="text-muted mb-1"
                                            style="font-size:0.82rem;font-weight:600;text-transform:uppercase;letter-spacing:.05em;">
                                            Issued Date</p>
                                        <h6 class="mb-0">{{ $certificate->issued_date->format('d M, Y') }}</h6>
                                    </div>
                                @endif
                            </div>

                            @if ($certificate->status === 'rejected')
                                <div class="alert alert-danger">
                                    <strong>Rejection Reason:</strong>
                                    <p class="mb-0">{{ $certificate->rejection_reason }}</p>
                                </div>
                            @endif

                            {{-- ── CERTIFICATE VISUAL PREVIEW ───────────────────────── --}}
                            @if ($certificate->status === 'approved')
                                <hr class="my-4">
                                <h5 class="mb-3" style="font-weight:700;">📜 Certificate Preview</h5>

                                <div class="cert-preview-wrapper">
                                    <div class="cert-bg"></div>

                                    {{-- decorative borders --}}
                                    <div class="cert-border-outer"></div>
                                    <div class="cert-border-inner"></div>
                                    <div class="cert-bar-top"></div>
                                    <div class="cert-bar-bottom"></div>

                                    {{-- content --}}
                                    <div class="cert-content">
                                        {{-- Brand header top center --}}
                                        <div class="cert-brand">
                                            <span class="cert-brand-cyber">CYBER</span> <span class="cert-brand-bd">BD</span>
                                        </div>

                                        <div class="cert-title">Certificate of Completion</div>
                                        <div class="cert-title-line"></div>

                                        <div class="cert-subtitle">This is to certify that</div>

                                        <div class="cert-name">{{ $certificate->user->name ?? 'Student Name' }}</div>
                                        <div class="cert-name-line"></div>

                                        <div class="cert-completed-text">has successfully completed the course</div>

                                        <div class="cert-course">{{ $certificate->course->name ?? 'N/A' }}</div>

                                        <div class="cert-divider">
                                            <div class="cert-divider-line"></div>
                                            <div class="cert-divider-dot"></div>
                                            <div class="cert-divider-line"></div>
                                        </div>

                                        <div class="cert-info-row">
                                            <div>
                                                <div class="cert-info-label">Certificate No.</div>
                                                <div class="cert-info-value">{{ $certificate->certificate_number }}</div>
                                            </div>
                                            <div class="cert-info-right">
                                                <div class="cert-info-label">Date of Issue</div>
                                                <div class="cert-info-value">
                                                    {{ $certificate->issued_date->format('d M, Y') }}</div>
                                            </div>
                                        </div>

                                        <div class="cert-sig-row">
                                            <div class="cert-sig">
                                                <div class="cert-sig-line"></div>
                                                <div class="cert-sig-name">Authorized Signature</div>
                                                <div class="cert-sig-title">Director of Education</div>
                                            </div>
                                            <div style="flex:0.6;"></div>
                                            <div class="cert-sig">
                                                <div class="cert-sig-line"></div>
                                                <div class="cert-sig-name">Program Director</div>
                                                <div class="cert-sig-title">Academic Affairs</div>
                                            </div>
                                        </div>
                                    </div>


                                </div>

                                {{-- Download button --}}
                                <div class="text-center mt-2">
                                    <button type="button" class="cert-download-btn certificate-download-btn"
                                        data-certificate-number="{{ $certificate->certificate_number }}"
                                        data-course-name="{{ $certificate->course->name ?? 'N/A' }}"
                                        data-user-name="{{ $certificate->user->name ?? 'Student' }}"
                                        data-issued-date="{{ $certificate->issued_date->format('d M, Y') }}"
                                        data-company-name="{{ $companyName ?? '' }}">
                                        <i class="fa-solid fa-download"></i>
                                        Download PDF Certificate
                                    </button>
                                </div>
                            @endif

                            <div class="mt-4">
                                <a href="{{ route('user.certificates') }}" class="enroll-btn">
                                    <i class="fa-solid fa-arrow-left"></i> Back to Certificates
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@push('frontendone_script')
    @include('frontend.pages.common.script')
    @if ($certificate->status === 'approved')
        @include('frontendone.pages.account.certificates_js')
    @endif
@endpush
