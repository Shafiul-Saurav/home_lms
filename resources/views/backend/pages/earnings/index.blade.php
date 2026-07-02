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

        @if (!$selectedTeacher)
            <div class="col-12">
                <div class="alert alert-warning" role="alert">
                    <i class="fa-solid fa-triangle-exclamation me-2"></i> No instructor selected or available.
                </div>
            </div>
        @else
            <!-- Commission Info Banner -->
            {{-- <div class="col-12 mb-4">
                <div class="card bg-light border-0 shadow-sm">
                    <div class="card-body d-flex flex-wrap align-items-center justify-content-between">
                        <div>
                            <h5 class="mb-1 fw-bold text-dark">
                                <i class="fa-solid fa-file-contract text-primary me-2"></i>
                                Commission Contract details for: <span
                                    class="text-primary">{{ $selectedTeacher->user->name }}</span>
                            </h5>
                            <p class="mb-0 text-muted text-wrap">
                                Platform share (Admin commission) and Gateway charges are deducted automatically from
                                successful transaction amounts.
                            </p>
                        </div>
                        <div class="d-flex flex-wrap gap-2 mt-2 mt-md-0">
                            <span class="rate-badge bg-info text-white">
                                <i class="fa-solid fa-shield fa-fw me-1"></i> Admin Share:
                                {{ number_format($commissionInfo['admin_percentage'], 2) }}%
                            </span>
                            <span class="rate-badge bg-secondary text-white">
                                <i class="fa-solid fa-credit-card fa-fw me-1"></i> Gateway Charge:
                                {{ number_format($commissionInfo['gateway_percentage'], 2) }}%
                            </span>
                            @if ($commissionInfo['status'] === 'approved')
                                <span class="rate-badge bg-success text-white">
                                    <i class="fa-solid fa-circle-check fa-fw me-1"></i> Contract Approved
                                </span>
                            @elseif($commissionInfo['status'] === 'pending')
                                <span class="rate-badge bg-warning text-dark">
                                    <i class="fa-solid fa-circle-notch fa-spin fa-fw me-1"></i> Pending Approval (Using
                                    Defaults)
                                </span>
                            @else
                                <span class="rate-badge bg-danger text-white">
                                    <i class="fa-solid fa-circle-xmark fa-fw me-1"></i> Default Rates Applied
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div> --}}

            @if (Auth::user()->role_id == 7 && isset($withdrawalSummary))
                <!-- Withdrawal Summary Banner -->
                <div class="col-12 mb-4">
                    <div class="card border-0 shadow-sm bg-light">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-md-7">
                                    <h5 class="mb-1 fw-bold text-dark">
                                        <i class="fa-solid fa-wallet text-primary me-2"></i>
                                        Withdrawal Balance Summary
                                    </h5>
                                    <p class="mb-0 text-muted">
                                        Available for Withdrawal: <strong class="text-success">{{ number_format($withdrawalSummary['available_balance'], 2) }} ৳</strong> |
                                        Pending: <strong class="text-warning">{{ number_format($withdrawalSummary['pending_amount'], 2) }} ৳</strong> |
                                        Approved: <strong class="text-primary">{{ number_format($withdrawalSummary['approved_amount'], 2) }} ৳</strong>
                                    </p>
                                </div>
                                <div class="col-md-5 text-md-end mt-3 mt-md-0">
                                    <button class="btn btn-primary me-1" data-bs-toggle="modal" data-bs-target="#requestWithdrawalModal">
                                        <i class="fa-solid fa-hand-holding-dollar me-1"></i> Request Withdrawal
                                    </button>
                                    <a href="{{ route('instructor.withdrawals.index') }}" class="btn btn-outline-primary">
                                        <i class="fa-solid fa-clock-rotate-left me-1"></i> View Request
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Stats Row -->
            <div class="col-lg-6 col-sm-12 col-md-6 col-xl-3 mb-4">
                <div class="card shadow-sm border-0 h-100">
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
                <div class="card shadow-sm border-0 h-100">
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
                <div class="card shadow-sm border-0 h-100">
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
                                    {{ number_format($totals['admin_shares'] + $totals['gateway_charges'], 2) }} ৳</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-sm-12 col-md-6 col-xl-3 mb-4">
                <div class="card shadow-sm border-0 h-100">
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
                                    {{ number_format($totals['instructor_earnings'], 2) }} ৳</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Course Breakdown Table -->
            <div class="col-12 mt-4">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h3 class="card-title"><i class="fa-solid fa-list-check me-2 text-primary"></i>Course Enrollment &
                            Income Breakdown</h3>
                    </div>
                    <div class="card-body">
                        @if ($coursesData->isEmpty())
                            <div class="alert alert-info py-4 text-center" role="alert">
                                <h4 class="alert-heading fw-bold"><i class="fa-solid fa-circle-info me-2"></i>No Courses
                                    Assigned</h4>
                                <p class="mb-0">There are no courses assigned to this instructor at the moment. Please
                                    link courses to the instructor profile.</p>
                            </div>
                        @else
                            @if (Auth::user()->role_id != 7)
                                <div class="table-responsive export-table">
                                    <table id="file-datatable"
                                        class="table table-bordered text-nowrap key-buttons border-bottom w-100">
                                        <thead>
                                            <tr>
                                                <th class="border-bottom-0">#</th>
                                                <th class="border-bottom-0">Instructor</th>
                                                <th class="border-bottom-0">Email</th>
                                                <th class="border-bottom-0">Courses</th>
                                                <th class="border-bottom-0">Enrolled Students</th>
                                                <th class="border-bottom-0">Gross Sales</th>
                                                <th class="border-bottom-0">Admin Share</th>
                                                <th class="border-bottom-0">Gateway Fee</th>
                                                <th class="border-bottom-0">Net Earnings</th>
                                                @can('view-earning')
                                                    <th class="border-bottom-0">Action</th>
                                                @endcan
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($instructorsData as $index => $data)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $data['teacher']->user->name }}</td>
                                                    <td>{{ $data['teacher']->user->email }}</td>
                                                    <td>{{ $data['totals']['courses_count'] }}</td>
                                                    <td>
                                                        {{ $data['totals']['enrolled_students'] }}</td>
                                                    <td>
                                                        {{ number_format($data['totals']['gross_sales'], 2) }} ৳</td>
                                                    <td class="text-danger">-
                                                        {{ number_format($data['totals']['admin_shares'], 2) }} ৳
                                                        <small class="text-muted">({{ number_format($data['commission']['admin_percentage'], 2) }}%)</small>
                                                    </td>
                                                    <td class="text-danger">-
                                                        {{ number_format($data['totals']['gateway_charges'], 2) }} ৳
                                                        <small class="text-muted">({{ number_format($data['commission']['gateway_percentage'], 2) }}%)</small>
                                                    </td>
                                                    <td class="text-success">
                                                        {{ number_format($data['totals']['instructor_earnings'], 2) }} ৳
                                                    </td>
                                                    @can('view-earning')
                                                        <td class="text-center"><a
                                                                href="{{ route('instructor.earnings.details', $data['teacher']->id) }}"
                                                                class="btn btn-sm btn-primary" title="View Details"><i
                                                                    class="fa-solid fa-eye"></i></a></td>
                                                    @endcan
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="table-responsive export-table">
                                    <table id="file-datatable"
                                        class="table table-bordered text-nowrap key-buttons border-bottom w-100">
                                        <thead>
                                            <tr>
                                                <th class="border-bottom-0">#</th>
                                                <th class="border-bottom-0">Course Name</th>
                                                <th class="border-bottom-0">Enrolled Students</th>
                                                <th class="border-bottom-0">Gross Sales</th>
                                                <th class="border-bottom-0">Admin Share</th>
                                                <th class="border-bottom-0">Gateway Fee</th>
                                                <th class="border-bottom-0 text-success fw-bold">Instructor Net Share</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($coursesData as $data)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td class="fw-semibold">
                                                        {{ $data['course']->name }}
                                                        @if (!$data['course']->is_active)
                                                            <span class="badge bg-danger ms-2">Inactive</span>
                                                        @endif
                                                    </td>
                                                    <td class="text-center fw-bold text-primary">
                                                        {{ $data['enrollment_count'] }}</td>
                                                    <td class="">{{ number_format($data['gross_sales'], 2) }} ৳
                                                    </td>
                                                    <td class="text-danger">-
                                                        {{ number_format($data['admin_share'], 2) }} ৳</td>
                                                    <td class="text-danger">-
                                                        {{ number_format($data['gateway_charge'], 2) }} ৳</td>
                                                    <td class="text-success fw-bold">
                                                        {{ number_format($data['instructor_earnings'], 2) }} ৳</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="2" class="text-end text-uppercase">Totals:</td>
                                                <td class="text-center text-primary text-decoration-underline">
                                                    {{ $totals['enrolled_students'] }}</td>
                                                <td class="text-end">{{ number_format($totals['gross_sales'], 2) }} ৳</td>
                                                <td class="text-end text-danger">-
                                                    {{ number_format($totals['admin_shares'], 2) }} ৳</td>
                                                <td class="text-end text-danger">-
                                                    {{ number_format($totals['gateway_charges'], 2) }} ৳</td>
                                                <td class="text-end text-success text-decoration-underline"
                                                    style="font-size: 1.15rem;">
                                                    {{ number_format($totals['instructor_earnings'], 2) }} ৳</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        @endif
    </div>

    @if (Auth::user()->role_id == 7 && isset($withdrawalSummary))
        <!-- Request Withdrawal Modal -->
        <div class="modal fade" id="requestWithdrawalModal" tabindex="-1" aria-labelledby="requestWithdrawalModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header border-bottom">
                        <h5 class="modal-title fw-bold text-dark" id="requestWithdrawalModalLabel">
                            <i class="fa-solid fa-hand-holding-dollar text-primary me-2"></i>Request Withdrawal
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('instructor.withdrawals.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3 bg-light p-3 text-center">
                                <span class="text-muted d-block small mb-1">Available for Withdrawal</span>
                                <h3 class="mb-0 fw-bold text-success">{{ number_format($withdrawalSummary['available_balance'], 2) }} ৳</h3>
                            </div>

                            <div class="form-group mb-3">
                                <label for="amount" class="form-label fw-semibold">Withdrawal Amount <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text">৳</span>
                                    <input type="number" step="0.01" min="0.01" max="{{ $withdrawalSummary['available_balance'] }}"
                                        name="amount" id="amount" class="form-control @error('amount') is-invalid @enderror"
                                        value="{{ old('amount', $withdrawalSummary['available_balance']) }}" required>
                                    @error('amount')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <small class="form-text text-muted">You can withdraw your entire net earning or a smaller amount.</small>
                            </div>

                            <div class="form-group mb-3">
                                <label for="account_name" class="form-label fw-semibold">Account Holder Name <span class="text-danger">*</span></label>
                                <input type="text" name="account_name" id="account_name" class="form-control @error('account_name') is-invalid @enderror"
                                    value="{{ old('account_name') }}" placeholder="e.g. John Doe" required>
                                @error('account_name')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="account_number" class="form-label fw-semibold">Account / Card / BKash Number <span class="text-danger">*</span></label>
                                <input type="text" name="account_number" id="account_number" class="form-control @error('account_number') is-invalid @enderror"
                                    value="{{ old('account_number') }}" placeholder="e.g. 017XXXXXXXX or Account No." required>
                                @error('account_number')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="account_details" class="form-label fw-semibold">Account/Bank Details <span class="text-danger">*</span></label>
                                <textarea name="account_details" id="account_details" rows="3" class="form-control @error('account_details') is-invalid @enderror"
                                    placeholder="e.g. Bank Name, Branch, Routing Number or Mobile Wallet Type (bKash/Nagad/Rocket)" required>{{ old('account_details') }}</textarea>
                                @error('account_details')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="form-group mb-0">
                                <label for="note" class="form-label fw-semibold">Note / Remarks (Optional)</label>
                                <textarea name="note" id="note" rows="2" class="form-control @error('note') is-invalid @enderror"
                                    placeholder="Any additional notes for the admin...">{{ old('note') }}</textarea>
                                @error('note')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer border-top">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit Request</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
@endsection

@push('backend_script')
    @include('backend.pages.common.script')
    @if ($errors->has('amount') || $errors->has('account_name') || $errors->has('account_number') || $errors->has('account_details'))
        <script>
            $(document).ready(function() {
                var requestModal = new bootstrap.Modal(document.getElementById('requestWithdrawalModal'));
                requestModal.show();
            });
        </script>
    @endif
@endpush
