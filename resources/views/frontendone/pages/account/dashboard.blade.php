@extends('frontendone.layouts.master')

@section('title', 'Dashboard')

@push('frontendone_style')
    @include('frontend.pages.common.style')
    <style>
        /*pagination style*/
        .active>.page-link,
        .page-link.active {
            z-index: 3;
            color: #fff;
            background-color: #76bd10;
            border-color: #76bd10;
        }

        .page-link,
        .page-link.active {
            z-index: 3;
            color: #76bd10;
            background-color: #ebebeb;
            border-color: #fff;
        }

        .instructor-button-section {
            background: linear-gradient(135deg, #76bd10 0%, #a6ff34 100%);
            padding: 20px;
            border-radius: 8px;
            text-align: right;
            margin-bottom: 20px;
        }

        .instructor-btn {
            background-color: #fff;
            color: #76bd10;
            padding: 12px 24px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 700;
            font-size: 14px;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .instructor-btn:hover {
            background-color: #f0f0f0;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }

        .instructor-btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        .request-status-badge {
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 12px;
            display: inline-block;
            margin-top: 10px;
        }

        .request-status-pending {
            background-color: #fff3cd;
            color: #856404;
        }

        .request-status-approved {
            background-color: #d4edda;
            color: #155724;
        }

        .request-status-rejected {
            background-color: #f8d7da;
            color: #721c24;
        }

        .role-badge {
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 12px;
            display: inline-block;
            margin-top: 10px;
        }

        .role-badge-instructor {
            background-color: #d4edda;
            color: #155724;
        }

        .role-badge-student {
            background-color: #e2e3ff;
            color: #1e1fff;
        }
    </style>
@endpush

@section('frontendone_content')
    <main class="main">
        <!-- breadcrumb -->
        <x-frontend.pages.common.breadcrumb :title="'Dashboard'" :breadcrumb="[['name' => 'Home', 'url' => route('home')], ['name' => 'Dashboard', 'url' => '#']]" />
        <!-- breadcrumb end -->

        <!-- user dashboard -->
        <div class="user-account py-5">
            <div class="container">
                <div class="row g-4">
                    <div class="col-lg-4 col-xl-3">
                        @include('frontendone.pages.account.sidebarmenu.sidebar')
                    </div>
                    <div class="col-lg-8 col-xl-9">
                        <div class="user-wrapper">
                            <div class="user-card">
                                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-3">
                                    <h4 class="title mb-0">Summary</h4>
                                    <div class="d-flex align-items-center gap-2 flex-wrap">
                                        @if (auth()->user()->role_id == 7)
                                            <span class="role-badge role-badge-instructor">Instructor</span>
                                        @else
                                            <span class="role-badge role-badge-student">Student</span>
                                            @if (auth()->user()->role_id == 4)
                                                @if ($instructorRequest && $instructorRequest->status === 'pending')
                                                    <span class="request-status-badge request-status-pending">Request Pending</span>
                                                @elseif ($instructorRequest && $instructorRequest->status === 'approved')
                                                    <span class="request-status-badge request-status-approved">Request Approved</span>
                                                @elseif ($instructorRequest && $instructorRequest->status === 'rejected')
                                                    <span class="request-status-badge request-status-rejected">Request Rejected</span>
                                                @else
                                                    <button type="button" class="instructor-btn" id="openInstructorRequestModal">
                                                        <i class="fa-solid fa-chalkboard-user"></i> Become an Instructor
                                                    </button>
                                                @endif
                                            @endif
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-lg-6 col-xl-6 mb-2 mb-lg-0">
                                        <div class="user-widget c3">
                                            <div class="info">
                                                <h1>{{ auth()->user()->name ?? 'N/A' }}</h1>
                                                <span>Welcome</span>
                                            </div>
                                            <div class="icon">
                                                <i class="fa-solid fa-user"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-xl-6 mb-2 mb-lg-0">
                                        <div class="user-widget c3">
                                            <div class="info">
                                                <h1>{{ \Carbon\Carbon::parse(auth()->user()->created_at)->format('M Y') ?? 'N/A' }}
                                                </h1>
                                                <span>Member Since</span>
                                            </div>
                                            <div class="icon">
                                                <i class="fa-solid fa-calendar"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-lg-4">
                                    <div class="col-md-6 col-lg-6 col-xl-4 mb-2 mb-lg-0">
                                        <div class="user-widget c3">
                                            <div class="info">
                                                <h1>{{ $completedCount ?? 0 }}</h1>
                                                <span>Completed Courses</span>
                                            </div>
                                            <div class="icon">
                                                <i class="fa-solid fa-book-open-reader"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-xl-4 mb-2 mb-lg-0">
                                        <div class="user-widget c3">
                                            <div class="info">
                                                <h1>{{ $enrolledCount ?? 0 }}</h1>
                                                <span>Enrolled Courses</span>
                                            </div>
                                            <div class="icon">
                                                <i class="fa-solid fa-book"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-xl-4 mb-2 mb-lg-0">
                                        <div class="user-widget c3">
                                            <div class="info">
                                                <h1>{{ $purchasedPdfBooksCount ?? 0 }}</h1>
                                                <span>Purchased PDF Books</span>
                                            </div>
                                            <div class="icon">
                                                <i class="fa-solid fa-file-pdf"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="user-card mb-0">
                                        <div class="header">
                                            <h4 class="title">Recent Orders</h4>
                                            <div class="header-right">
                                                <a href="{{ route('user.course.orders') }}" class="theme-btn" style="color:#76bd10;">View All<i
                                                        class="fas fa-arrow-right"></i></a>
                                            </div>
                                        </div>
                                        <div class="user-table table-responsive">
                                            <table class="table table-borderless text-nowrap">
                                                <thead>
                                                    <tr>
                                                        <th>#Order No</th>
                                                        <th>Purchased Date</th>
                                                        <th>Total</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($recentOrders as $order)
                                                        @php
                                                            $status = strtolower(
                                                                $order->payment_status ?: $order->status,
                                                            );
                                                            $badgeClass = match ($status) {
                                                                'completed', 'enrolled' => 'badge-success',
                                                                'pending' => 'badge-info',
                                                                'failed', 'cancelled' => 'badge-danger',
                                                                default => 'badge-primary',
                                                            };
                                                            $displayStatus = $order->payment_status
                                                                ? ucfirst($order->payment_status)
                                                                : ucfirst($order->status);
                                                        @endphp
                                                        <tr>
                                                            <td>
                                                                <span
                                                                    class="code">{{ $order->order_number ?? sprintf('#%s', str_pad($order->id, 6, '0', STR_PAD_LEFT)) }}</span>
                                                            </td>
                                                            <td>{{ $order->created_at?->format('F j, Y') ?? optional($order->date)->format('F j, Y') }}
                                                            </td>
                                                            <td>{{ $order->currency ?? 'BDT' }}{{ number_format($order->amount, 2) }}
                                                            </td>
                                                            <td><span
                                                                    class="badge {{ $badgeClass }}">{{ $displayStatus }}</span>
                                                            </td>
                                                            <td>
                                                                <div class="action-dropdown dropdown">
                                                                    <button class="action-icon-btn" type="button"
                                                                        data-bs-toggle="dropdown">
                                                                        <i class="fa-solid fa-ellipsis"></i>
                                                                    </button>
                                                                    <ul class="dropdown-menu dropdown-menu-end"
                                                                        style="max-height: none !important; overflow: visible !important;">
                                                                        <li>
                                                                            <a class="dropdown-item"
                                                                                href="{{ route('course.order.details', $order->id) }}"><i
                                                                                    class="fa-solid fa-eye"></i> Order
                                                                                Details</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="5" class="text-center">No orders found.</td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                        @if ($recentOrders->hasPages())
                                            <div class="pagination-area mt-4 d-flex justify-content-center">
                                                <nav aria-label="Page navigation">
                                                    <ul class="pagination mb-0">
                                                        @if ($recentOrders->onFirstPage())
                                                            <li class="page-item disabled"><span class="page-link"><i
                                                                        class="fa-solid fa-arrow-left"></i></span></li>
                                                        @else
                                                            <li class="page-item"><a class="page-link"
                                                                    href="{{ $recentOrders->previousPageUrl() }}"
                                                                    aria-label="Previous"><i
                                                                        class="fa-solid fa-arrow-left"></i></a></li>
                                                        @endif

                                                        @foreach ($recentOrders->getUrlRange(1, $recentOrders->lastPage()) as $page => $url)
                                                            @if ($page == $recentOrders->currentPage())
                                                                <li class="page-item active"><span
                                                                        class="page-link">{{ $page }}</span></li>
                                                            @else
                                                                <li class="page-item"><a class="page-link"
                                                                        href="{{ $url }}">{{ $page }}</a>
                                                                </li>
                                                            @endif
                                                        @endforeach

                                                        @if ($recentOrders->hasMorePages())
                                                            <li class="page-item"><a class="page-link"
                                                                    href="{{ $recentOrders->nextPageUrl() }}"
                                                                    aria-label="Next"><i
                                                                        class="fa-solid fa-arrow-right"></i></a></li>
                                                        @else
                                                            <li class="page-item disabled"><span class="page-link"><i
                                                                        class="fa-solid fa-arrow-right"></i></span></li>
                                                        @endif
                                                    </ul>
                                                </nav>
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
        <!-- user dashboard end -->
    </main>

    @if (auth()->user()->role_id == 4 && !$instructorRequest)
        <div class="modal fade" id="instructorRequestModal" tabindex="-1" aria-labelledby="instructorRequestModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="instructorRequestModalLabel">Become an Instructor</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="instructorRequestForm" action="{{ route('instructor.request.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <p class="text-muted mb-3">Fill in your details below and submit your request for admin review.</p>
                            <div class="mb-3">
                                <label for="bio" class="form-label">Bio</label>
                                <textarea name="bio" id="bio" class="form-control" rows="4" placeholder="Write a short bio about yourself..." required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="qualification" class="form-label">Qualification</label>
                                <textarea name="qualification" id="qualification" class="form-control" rows="4" placeholder="Mention your academic or professional qualifications..." required></textarea>
                            </div>
                            <div class="alert alert-info mb-0">
                                <i class="fa-solid fa-circle-info me-2"></i>
                                Your profile must be 100% complete before sending the request.
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success" style="background-color: #76bd10; border-color: #76bd10;">
                                <i class="fa-solid fa-paper-plane me-2"></i>Send Request
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
@endsection

@push('frontendone_script')
    @include('frontend.pages.common.script')
    <script>
        $(document).ready(function () {
            $('#openInstructorRequestModal').on('click', function (e) {
                e.preventDefault();

                @if ($profileCompletionPercentage < 100)
                    Swal.fire({
                        icon: 'warning',
                        title: 'Profile Incomplete',
                        text: 'To make request you need to complete ur profile 100%.',
                        confirmButtonText: 'OK'
                    });
                @else
                    $('#instructorRequestModal').modal('show');
                @endif
            });

            $('#instructorRequestForm').on('submit', function (e) {
                e.preventDefault();

                const form = $(this);
                const submitBtn = form.find('button[type=submit]');
                submitBtn.prop('disabled', true).html('<i class="fa-solid fa-spinner fa-spin me-2"></i>Sending...');

                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    data: form.serialize(),
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    success: function (response) {
                        Swal.fire({
                            icon: response.type === 'success' ? 'success' : 'error',
                            title: response.type === 'success' ? 'Request Sent' : 'Request Failed',
                            text: response.message,
                            confirmButtonText: 'OK'
                        });

                        if (response.type === 'success') {
                            $('#instructorRequestModal').modal('hide');
                            form[0].reset();
                            setTimeout(function () {
                                window.location.reload();
                            }, 1200);
                        }
                    },
                    error: function (xhr) {
                        const message = xhr.responseJSON?.message || 'Something went wrong.';
                        Swal.fire({
                            icon: 'error',
                            title: 'Request Failed',
                            text: message,
                            confirmButtonText: 'OK'
                        });
                    },
                    complete: function () {
                        submitBtn.prop('disabled', false).html('<i class="fa-solid fa-paper-plane me-2"></i>Send Request');
                    }
                });
            });
        });
    </script>
@endpush
