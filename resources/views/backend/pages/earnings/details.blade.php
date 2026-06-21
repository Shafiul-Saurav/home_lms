@extends('backend.layouts.master')

@section('title', 'Instructor Earnings Details')

@push('backend_style')
    @include('backend.pages.common.style')
    <style>
        .earnings-card {
            transition: all 0.3s ease;
        }
        .earnings-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1) !important;
        }
        .rate-badge {
            font-size: 0.9rem;
            padding: 0.4rem 0.8rem;
            border-radius: 6px;
        }
    </style>
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Instructor Earnings – Details</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        {{-- <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li> --}}
                        <li class="breadcrumb-item"><a href="https://wa.me/01732329071?text=hi">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('instructor.earnings') }}">All Instructors</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Details</li>
                    </ol>
                </div>
            </div>
        </div>

        {{-- Instructor Info Card --}}
        <div class="col-lg-6 col-sm-12 col-md-6 col-xl-3 mb-4">
            <div class="card shadow-sm border-0 h-100 earnings-card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <div class="bg-primary-transparent rounded-circle p-3 text-primary">
                                <i class="fa-solid fa-user fs-4"></i>
                            </div>
                        </div>
                        <div>
                            <p class="text-muted mb-0">Instructor</p>
                            <h3 class="mb-0 fw-bold">{{ $teacher->user->name }}</h3>
                            <p class="text-muted mb-0 small">{{ $teacher->user->email }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Stat Cards (same as index) --}}
        <div class="col-lg-6 col-sm-12 col-md-6 col-xl-3 mb-4">
            <div class="card shadow-sm border-0 h-100 earnings-card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <div class="bg-primary-transparent rounded-circle p-3 text-primary">
                                <i class="fa-solid fa-users fs-4"></i>
                            </div>
                        </div>
                        <div>
                            <p class="text-muted mb-0">Enrolled Students</p>
                            <h3 class="mb-0 fw-bold">{{ $totals['enrolled_students'] }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-sm-12 col-md-6 col-xl-3 mb-4">
            <div class="card shadow-sm border-0 h-100 earnings-card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <div class="bg-info-transparent rounded-circle p-3 text-info">
                                <i class="fa-solid fa-money-bill-wave fs-4"></i>
                            </div>
                        </div>
                        <div>
                            <p class="text-muted mb-0">Total Revenue</p>
                            <h3 class="mb-0 fw-bold">{{ number_format($totals['gross_sales'], 2) }} ৳</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-sm-12 col-md-6 col-xl-3 mb-4">
            <div class="card shadow-sm border-0 h-100 earnings-card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <div class="bg-danger-transparent rounded-circle p-3 text-danger">
                                <i class="fa-solid fa-scissors fs-4"></i>
                            </div>
                        </div>
                        <div>
                            <p class="text-muted mb-0">Deductions</p>
                            <h3 class="mb-0 fw-bold">
                                {{ number_format($totals['admin_shares'] + $totals['gateway_charges'], 2) }} ৳
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-sm-12 col-md-6 col-xl-3 mb-4">
            <div class="card shadow-sm border-0 h-100 earnings-card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <div class="bg-success-transparent rounded-circle p-3 text-success">
                                <i class="fa-solid fa-wallet fs-4"></i>
                            </div>
                        </div>
                        <div>
                            <p class="text-muted mb-0">Net Earnings</p>
                            <h3 class="mb-0 fw-bold text-success">
                                {{ number_format($totals['instructor_earnings'], 2) }} ৳
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Course Breakdown Table for this Instructor --}}
        <div class="col-12 mt-4">
            <div class="card">
                <div class="card-header border-bottom">
                    <h3 class="card-title"><i class="fa-solid fa-list-check me-2 text-primary"></i>Course Enrollment & Income Breakdown</h3>
                </div>
                <div class="card-body">
                    @if ($coursesData->isEmpty())
                        <div class="alert alert-info py-4 text-center" role="alert">
                            <h4 class="alert-heading fw-bold"><i class="fa-solid fa-circle-info me-2"></i>No Courses Assigned</h4>
                            <p class="mb-0">This instructor has no courses at the moment.</p>
                        </div>
                    @else
                        <div class="table-responsive export-table">
                            <table id="file-datatable" class="table table-bordered text-nowrap key-buttons border-bottom w-100">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0">#</th>
                                        <th class="border-bottom-0">Course Name</th>
                                        <th class="border-bottom-0 text-center">Enrolled Students</th>
                                        <th class="border-bottom-0 text-end">Gross Sales</th>
                                        <th class="border-bottom-0 text-end">Admin Share ({{ number_format($commissionInfo['admin_percentage'], 2) }}%)</th>
                                        <th class="border-bottom-0 text-end">Gateway Fee ({{ number_format($commissionInfo['gateway_percentage'], 2) }}%)</th>
                                        <th class="border-bottom-0 text-end text-success fw-bold">Instructor Net Share</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($coursesData as $data)
                                        <tr>
                                            <td class="text-center fw-bold">{{ $loop->iteration }}</td>
                                            <td class="fw-semibold">
                                                {{ $data['course']->name }}
                                                @if(!$data['course']->is_active)
                                                    <span class="badge bg-danger ms-2">Inactive</span>
                                                @endif
                                            </td>
                                            <td class="text-center fw-bold text-primary">{{ $data['enrollment_count'] }}</td>
                                            <td class="text-end">{{ number_format($data['gross_sales'], 2) }} ৳</td>
                                            <td class="text-end text-danger">- {{ number_format($data['admin_share'], 2) }} ৳</td>
                                            <td class="text-end text-danger">- {{ number_format($data['gateway_charge'], 2) }} ৳</td>
                                            <td class="text-end text-success fw-bold">{{ number_format($data['instructor_earnings'], 2) }} ৳</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="2" class="text-end text-uppercase">Totals:</td>
                                        <td class="text-center text-primary text-decoration-underline">{{ $totals['enrolled_students'] }}</td>
                                        <td class="text-end">{{ number_format($totals['gross_sales'], 2) }} ৳</td>
                                        <td class="text-end text-danger">- {{ number_format($totals['admin_shares'], 2) }} ৳</td>
                                        <td class="text-end text-danger">- {{ number_format($totals['gateway_charges'], 2) }} ৳</td>
                                        <td class="text-end text-success text-decoration-underline" style="font-size: 1.15rem;">{{ number_format($totals['instructor_earnings'], 2) }} ৳</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('backend_script')
    @include('backend.pages.common.script')
@endpush
