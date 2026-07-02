@extends('frontendone.layouts.master')

@section('title', 'My Certificates')

@push('frontendone_style')
    @include('frontend.pages.common.style')
    <style>
        .certificate-card {
            background: #fff;
            border-radius: 24px;
            box-shadow: 0 18px 50px rgba(8, 15, 30, 0.08);
            padding: 24px;
            margin-bottom: 24px;
        }

        .certificate-badge {
            display: inline-flex;
            gap: 0.5rem;
            align-items: center;
            padding: 10px 14px;
            border-radius: 999px;
            background: #f4f7ff;
            color: #102949;
            font-weight: 700;
        }

        .certificate-actions .btn {
            min-width: 140px;
        }
    </style>
@endpush

@section('frontendone_content')
    <main class="main">
        <x-frontend.pages.common.breadcrumb :title="'My Certificates'" :breadcrumb="[['name' => 'Home', 'url' => route('home')], ['name' => 'My Certificates', 'url' => '#']]" />

        <section class="section-padding py-5">
            <div class="container">
                <div class="row g-4">
                    <div class="col-lg-4 col-xl-3">
                        @include('frontendone.pages.account.sidebarmenu.sidebar')
                    </div>
                    <div class="col-lg-8 col-xl-9">
                        <div class="certificate-card">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div>
                                    <h3 class="mb-1">Certificate Requests</h3>
                                    <p class="text-muted mb-0">Track your pending and approved certificates.</p>
                                </div>
                                <a href="{{ route('my.courses') }}" class="enroll-btn">Find Completed Courses</a>
                            </div>

                            <div id="certificate-list-container">
                                @include('frontendone.pages.account.partials.certificates_list', ['certificates' => $certificates])
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
    @include('frontendone.pages.account.certificates_js')
@endpush
