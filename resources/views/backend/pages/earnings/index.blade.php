@extends('backend.layouts.master')

@section('title', 'Instructor Earnings')

@push('backend_style')
    @include('backend.pages.common.style')
    <style>
        .earnings-card {
            transition: all 0.3s ease;
        }
        .earnings-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.1) !important;
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
                    <h1 class="page-title">Instructor Earnings & Enrollments</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">My Earnings</li>
                    </ol>
                </div>
            </div>
        </div>

        @if(Auth::user()->role_id != 7)
            <!-- Admin Filter Panel -->
            <div class="col-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('instructor.earnings') }}" method="GET" class="row align-items-center">
                            <div class="col-md-6 col-sm-12">
                                <label for="teacher_id" class="form-label fw-bold">Select Instructor to View Earnings:</label>
                                <select name="teacher_id" id="teacher_id" class="form-control select2-style1" onchange="this.form.submit()">
                                    @foreach($teachers as $teacher)
                                        <option value="{{ $teacher->id }}" {{ $selectedTeacher && $selectedTeacher->id == $teacher->id ? 'selected' : '' }}>
                                            {{ $teacher->user->name }} ({{ $teacher->user->email }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2 mt-4">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fa-solid fa-filter fa-fw"></i> Filter
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif

        @if(!$selectedTeacher)
            <div class="col-12">
                <div class="alert alert-warning" role="alert">
                    <i class="fa-solid fa-triangle-exclamation me-2"></i> No instructor selected or available.
                </div>
            </div>
        @else
            <!-- Commission Info Banner -->
            <div class="col-12 mb-4">
                <div class="card bg-light border-0 shadow-sm">
                    <div class="card-body d-flex flex-wrap align-items-center justify-content-between">
                        <div>
                            <h5 class="mb-1 fw-bold text-dark">
                                <i class="fa-solid fa-file-contract text-primary me-2"></i>
                                Commission Contract details for: <span class="text-primary">{{ $selectedTeacher->user->name }}</span>
                            </h5>
                            <p class="mb-0 text-muted text-wrap">
                                Platform share (Admin commission) and Gateway charges are deducted automatically from successful transaction amounts.
                            </p>
                        </div>
                        <div class="d-flex flex-wrap gap-2 mt-2 mt-md-0">
                            <span class="rate-badge bg-info text-white">
                                <i class="fa-solid fa-shield fa-fw me-1"></i> Admin Share: {{ number_format($commissionInfo['admin_percentage'], 2) }}%
                            </span>
                            <span class="rate-badge bg-secondary text-white">
                                <i class="fa-solid fa-credit-card fa-fw me-1"></i> Gateway Charge: {{ number_format($commissionInfo['gateway_percentage'], 2) }}%
                            </span>
                            @if($commissionInfo['status'] === 'approved')
                                <span class="rate-badge bg-success text-white">
                                    <i class="fa-solid fa-circle-check fa-fw me-1"></i> Contract Approved
                                </span>
                            @elseif($commissionInfo['status'] === 'pending')
                                <span class="rate-badge bg-warning text-dark">
                                    <i class="fa-solid fa-circle-notch fa-spin fa-fw me-1"></i> Pending Approval (Using Defaults)
                                </span>
                            @else
                                <span class="rate-badge bg-danger text-white">
                                    <i class="fa-solid fa-circle-xmark fa-fw me-1"></i> Default Rates Applied
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Row -->
            <div class="col-lg-6 col-sm-12 col-md-6 col-xl-3 mb-4">
                <div class="card overflow-hidden earnings-card shadow-sm border-0 bg-primary text-white mb-0 h-100">
                    <div class="card-body">
                        <div class="row">
                            <div class="col col-8">
                                <h5 class="opacity-75">Enrolled Students</h5>
                                <h3 class="mb-2 fw-semibold">{{ $totals['enrolled_students'] }}</h3>
                                <p class="mb-0 opacity-75">Total enrollments count</p>
                            </div>
                            <div class="col col-4 top-icn dash">
                                <div class="counter-icon bg-white text-primary dash ms-auto">
                                    <i class="fa-solid fa-users"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-sm-12 col-md-6 col-xl-3 mb-4">
                <div class="card overflow-hidden earnings-card shadow-sm border-0 bg-info text-white mb-0 h-100">
                    <div class="card-body">
                        <div class="row">
                            <div class="col col-8">
                                <h5 class="opacity-75">Total Revenue (Gross)</h5>
                                <h3 class="mb-2 fw-semibold">{{ number_format($totals['gross_sales'], 2) }} ৳</h3>
                                <p class="mb-0 opacity-75">Sales before deductions</p>
                            </div>
                            <div class="col col-4 top-icn dash">
                                <div class="counter-icon bg-white text-info dash ms-auto">
                                    <i class="fa-solid fa-money-bill-wave"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-sm-12 col-md-6 col-xl-3 mb-4">
                <div class="card overflow-hidden earnings-card shadow-sm border-0 bg-danger text-white mb-0 h-100">
                    <div class="card-body">
                        <div class="row">
                            <div class="col col-8">
                                <h5 class="opacity-75">Platform Deductions</h5>
                                <h3 class="mb-2 fw-semibold">{{ number_format($totals['admin_shares'] + $totals['gateway_charges'], 2) }} ৳</h3>
                                <p class="mb-0 opacity-75">Admin + Gateway charges</p>
                            </div>
                            <div class="col col-4 top-icn dash">
                                <div class="counter-icon bg-white text-danger dash ms-auto">
                                    <i class="fa-solid fa-scissors"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-sm-12 col-md-6 col-xl-3 mb-4">
                <div class="card overflow-hidden earnings-card shadow-sm border-0 bg-success text-white mb-0 h-100">
                    <div class="card-body">
                        <div class="row">
                            <div class="col col-8">
                                <h5 class="opacity-75">Withdrawable Earnings</h5>
                                <h3 class="mb-2 fw-semibold text-white">{{ number_format($totals['instructor_earnings'], 2) }} ৳</h3>
                                <p class="mb-0 opacity-75">Net income to withdraw</p>
                            </div>
                            <div class="col col-4 top-icn dash">
                                <div class="counter-icon bg-white text-success dash ms-auto">
                                    <i class="fa-solid fa-wallet"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Course Breakdown Table -->
            <div class="col-12 mt-4">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h3 class="card-title"><i class="fa-solid fa-list-check me-2 text-primary"></i>Course Enrollment & Income Breakdown</h3>
                    </div>
                    <div class="card-body">
                        @if($coursesData->isEmpty())
                            <div class="alert alert-info py-4 text-center" role="alert">
                                <h4 class="alert-heading fw-bold"><i class="fa-solid fa-circle-info me-2"></i>No Courses Assigned</h4>
                                <p class="mb-0">There are no courses assigned to this instructor at the moment. Please link courses to the instructor profile.</p>
                            </div>
                        @else
                            <div class="table-responsive">
                                <table class="table table-bordered text-nowrap key-buttons border-bottom w-100 table-striped align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th style="width: 5%">#</th>
                                            <th>Course Name</th>
                                            <th class="text-center">Enrolled Students</th>
                                            <th class="text-end">Gross Sales</th>
                                            <th class="text-end">Admin Share ({{ number_format($commissionInfo['admin_percentage'], 2) }}%)</th>
                                            <th class="text-end">Gateway Fee ({{ number_format($commissionInfo['gateway_percentage'], 2) }}%)</th>
                                            <th class="text-end text-success fw-bold">Instructor Net Share</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($coursesData as $data)
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
                                    <tfoot class="table-light fw-bold border-top-2">
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
        @endif
    </div>
@endsection

@push('backend_script')
    @include('backend.pages.common.script')
@endpush
