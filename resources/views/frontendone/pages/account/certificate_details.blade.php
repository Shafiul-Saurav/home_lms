@extends('frontendone.layouts.master')

@section('title', 'Certificate Details')

@push('frontendone_style')
    @include('frontend.pages.common.style')
    {{-- <style>
        .panel-card {
            background: #fff;
            border-radius: 24px;
            box-shadow: 0 18px 50px rgba(8, 15, 30, 0.08);
            padding: 24px;
        }

        .panel-card h3 {
            font-size: 1.5rem;
            font-weight: 700;
        }

        .panel-card h5 {
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .panel-card p {
            font-size: 0.9rem;
            color: #6c757d;
        }

        .enroll-btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border-radius: 4px;
            text-decoration: none;
        }
    </style> --}}

@endpush

@section('frontendone_content')
    <main class="main">
        <x-frontend.pages.common.breadcrumb :title="'Certificate Details'" :breadcrumb="[['name' => 'Home', 'url' => route('home')], ['name' => 'My Certificates', 'url' => route('user.certificates')], ['name' => 'Details', 'url' => '#']]" />

        <section class="section-padding py-5">
            <div class="container">
                <div class="row g-4">
                    <div class="col-lg-4 col-xl-3">
                        @include('frontendone.pages.account.sidebarmenu.sidebar')
                    </div>
                    <div class="col-lg-8 col-xl-9">
                        <div class="panel-card">
                            <h3 class="mb-4">Certificate Request</h3>

                            <div class="mb-4">
                                <h5>Course</h5>
                                <p>{{ $certificate->course->name ?? 'N/A' }}</p>
                            </div>

                            <div class="mb-4">
                                <h5>Status</h5>
                                @if($certificate->status === 'pending')
                                    <span class="badge bg-warning">Pending</span>
                                @elseif($certificate->status === 'approved')
                                    <span class="badge bg-success">Approved</span>
                                @else
                                    <span class="badge bg-danger">Rejected</span>
                                @endif
                            </div>

                            @if($certificate->status === 'approved')
                                <div class="mb-4">
                                    <h5>Certificate Number</h5>
                                    <p>{{ $certificate->certificate_number }}</p>
                                </div>
                                <div class="mb-4">
                                    <h5>Issued Date</h5>
                                    <p>{{ $certificate->issued_date->format('d M, Y') }}</p>
                                </div>
                            @endif

                            @if($certificate->status === 'rejected')
                                <div class="alert alert-danger">
                                    <strong>Rejection Reason:</strong>
                                    <p class="mb-0">{{ $certificate->rejection_reason }}</p>
                                </div>
                            @endif

                            <a href="{{ route('user.certificates') }}" class="enroll-btn">Back to Certificates</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@push('frontendone_script')
    @include('frontend.pages.common.script')
@endpush
