@extends('frontendone.layouts.master')

@section('title', 'My Certificates')

@push('frontendone_style')
    @include('frontend.pages.common.style')
    <style>
        :root {
            --theme-color: #76bd10;
        }
        .course-orders-card {
            border-radius: 18px;
            overflow: hidden;
            background: #fff;
            box-shadow: 0 18px 50px rgba(8, 15, 30, 0.08);
        }

        .course-orders-card .header {
            padding: 24px;
            border-bottom: 1px solid #f1f3f6;
        }

        .course-orders-card .header-right .theme-btn,
        .course-orders-card .header-right .enroll-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 18px;
            border-radius: 10px;
        }

        .course-orders-card .user-table .table {
            margin-bottom: 0;
        }

        .course-orders-card .user-table .table tbody tr {
            transition: background-color 0.2s ease;
        }

        .course-orders-card .user-table .table tbody tr:hover {
            background: rgba(118, 189, 16, 0.04);
        }

        .course-orders-card .user-table .table td,
        .course-orders-card .user-table .table th {
            vertical-align: middle;
        }

        .course-orders-card .pagination-area {
            margin-top: 28px;
        }

        .certificate-actions .btn {
            min-width: 140px;
        }
        /* Theme-tint overrides for this page */
        .btn-success, .enroll-btn {
            background-color: var(--theme-color) !important;
            border-color: var(--theme-color) !important;
            color: #fff !important;
        }

        .badge.bg-success {
            background-color: var(--theme-color) !important;
            color: #fff !important;
        }
    </style>
@endpush

@section('frontendone_content')
    <main class="main">
        <x-frontend.pages.common.breadcrumb :title="'My Certificates'" :breadcrumb="[['name' => 'Home', 'url' => route('home')], ['name' => 'My Certificates', 'url' => '#']]" />

        <div class="user-account py-5">
            <div class="container">
                <div class="row g-4">
                    <div class="col-lg-4 col-xl-3">
                        @include('frontendone.pages.account.sidebarmenu.sidebar')
                    </div>
                    <div class="col-lg-8 col-xl-9">
                        <div class="user-wrapper">
                            <div class="user-card course-orders-card mb-0">
                                <div class="header d-flex justify-content-between align-items-center">
                                    <div>
                                        <h4 class="title">Certificate Requests</h4>
                                        <p class="text-muted mb-0">Track your pending and approved certificates.</p>
                                    </div>
                                    <div class="header-right">
                                        <a href="{{ route('my.courses') }}" class="enroll-btn">
                                            Find Completed Courses
                                            <i class="fas fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="user-table table-responsive px-4 pb-4">
                                    @include('frontendone.pages.account.partials.certificates_list', ['certificates' => $certificates])
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
    @include('frontendone.pages.account.certificates_js')
@endpush
