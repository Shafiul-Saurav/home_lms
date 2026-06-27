@extends('frontendone.layouts.master')

@section('title', 'PDF Book Orders')

@push('frontendone_style')
    @include('frontend.pages.common.style')
    <style>
        /* pagination style */
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

        .orders-card {
            border-radius: 18px;
            overflow: hidden;
        }

        .orders-card .header {
            padding-bottom: 18px;
        }

        .orders-card .header-right .theme-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 18px;
            border-radius: 10px;
        }

        .orders-card .user-table .table {
            margin-bottom: 0;
        }

        .orders-card .user-table .table tbody tr {
            transition: background-color 0.2s ease;
        }

        .orders-card .user-table .table tbody tr:hover {
            background: rgba(118, 189, 16, 0.04);
        }

        .orders-card .user-table .table td,
        .orders-card .user-table .table th {
            vertical-align: middle;
        }

        .orders-card .pagination-area {
            margin-top: 28px;
        }
    </style>
@endpush

@section('frontendone_content')
    <main class="main">
        <x-frontend.pages.common.breadcrumb :title="'PDF Book Orders'" :breadcrumb="[['name' => 'Home', 'url' => route('home')], ['name' => 'PDF Book Orders', 'url' => '#']]" />

        <div class="user-account py-5">
            <div class="container">
                <div class="row g-4">
                    <div class="col-lg-4 col-xl-3">
                        @include('frontendone.pages.account.sidebarmenu.sidebar')
                    </div>
                    <div class="col-lg-8 col-xl-9">
                        <div class="user-wrapper">
                            <div class="user-card orders-card mb-0">
                                <div class="header">
                                    <h4 class="title">PDF Book Orders</h4>
                                    <div class="header-right">
                                        <a href="{{ route('user.dashboard') }}" class="theme-btn" style="color:#76bd10;">
                                            Back to Dashboard
                                            <i class="fas fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="user-table table-responsive">
                                    <table class="table table-borderless table-hover align-middle text-nowrap">
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
                                            @forelse($orders as $order)
                                                @php
                                                    $status = strtolower($order->payment_status ?: $order->status);
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
                                                        <span class="code">{{ $order->order_number ?? sprintf('#%s', str_pad($order->id, 6, '0', STR_PAD_LEFT)) }}</span>
                                                    </td>
                                                    <td>{{ $order->created_at?->format('F j, Y') ?? optional($order->date)->format('F j, Y') }}</td>
                                                    <td>{{ $order->currency ?? 'BDT' }}{{ number_format($order->amount, 2) }}</td>
                                                    <td><span class="badge {{ $badgeClass }}">{{ $displayStatus }}</span></td>
                                                    <td>
                                                        <div class="action-dropdown dropdown">
                                                            <button class="action-icon-btn" type="button" data-bs-toggle="dropdown">
                                                                <i class="fa-solid fa-ellipsis"></i>
                                                            </button>
                                                            <ul class="dropdown-menu dropdown-menu-end" style="max-height: none !important; overflow: visible !important;">
                                                                <li>
                                                                    <a class="dropdown-item" href="{{ route('pdf.book.order.details', $order) }}"><i class="fa-solid fa-eye"></i> Order Details</a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item" href="{{ route('pdf.book.details', $order->pdf_book_id) }}"><i class="fa-solid fa-file-pdf"></i> View PDF Book</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5" class="text-center py-4">You have no PDF book orders yet.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                @if ($orders->hasPages())
                                    <div class="pagination-area mt-4 d-flex justify-content-center">
                                        <nav aria-label="Page navigation">
                                            <ul class="pagination mb-0">
                                                @if ($orders->onFirstPage())
                                                    <li class="page-item disabled"><span class="page-link"><i class="fa-solid fa-arrow-left"></i></span></li>
                                                @else
                                                    <li class="page-item"><a class="page-link" href="{{ $orders->previousPageUrl() }}" aria-label="Previous"><i class="fa-solid fa-arrow-left"></i></a></li>
                                                @endif

                                                @foreach ($orders->getUrlRange(1, $orders->lastPage()) as $page => $url)
                                                    @if ($page == $orders->currentPage())
                                                        <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                                                    @else
                                                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                                    @endif
                                                @endforeach

                                                @if ($orders->hasMorePages())
                                                    <li class="page-item"><a class="page-link" href="{{ $orders->nextPageUrl() }}" aria-label="Next"><i class="fa-solid fa-arrow-right"></i></a></li>
                                                @else
                                                    <li class="page-item disabled"><span class="page-link"><i class="fa-solid fa-arrow-right"></i></span></li>
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
    </main>
@endsection

@push('frontendone_script')
    @include('frontend.pages.common.script')
@endpush
