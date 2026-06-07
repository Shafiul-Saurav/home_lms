@extends('frontend.layouts.master')

@section('title', 'PDF Book Orders')

@push('frontend_style')
    <style>
        .user-table.table-responsive {
            overflow: visible !important;
        }

        .user-table .table .dropdown-menu {
            max-height: none !important;
            overflow: visible !important;
            z-index: 1055;
        }

        .user-table .table .dropdown-menu .dropdown-item {
            white-space: nowrap;
        }
    </style>
@endpush

@section('frontend_content')
    <main class="main">
        <!-- breadcrumb -->
        <x-frontend.pages.common.breadcrumb :title="'PDF Book Orders'" :breadcrumb="[['name' => 'Home', 'url' => route('home')], ['name' => 'PDF Book Orders', 'url' => '#']]" />
        <!-- breadcrumb end -->

        <!-- user dashboard -->
        <div class="user-account py-100">
            <div class="container">
                <div class="row g-4">
                    <div class="col-lg-4 col-xl-3">
                        @include('frontend.pages.account.sidebarmenu.sidebar')
                    </div>
                    <div class="col-lg-8 col-xl-9">
                        <div class="user-wrapper">
                            <div class="user-card">
                                <div class="header">
                                    <h4 class="title">PDF Book Orders</h4>
                                    <div class="right">
                                        <div class="filter">
                                            <select class="select">
                                                <option value="">Default</option>
                                                <option value="1">Pending</option>
                                                <option value="2">Processing</option>
                                                <option value="3">Completed</option>
                                                <option value="4">Cancelled</option>
                                            </select>
                                        </div>
                                        <div class="search">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Search..." />
                                                <i class="far fa-search"></i>
                                            </div>
                                        </div>
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
                                            @forelse($orders as $order)
                                                @php
                                                    $status = strtolower($order->payment_status ?: $order->status);
                                                    $badgeClass = match ($status) {
                                                        'completed', 'enrolled' => 'badge-success',
                                                        'pending' => 'badge-info',
                                                        'failed', 'cancelled' => 'badge-danger',
                                                        default => 'badge-primary',
                                                    };
                                                    $displayStatus = $order->payment_status ? ucfirst($order->payment_status) : ucfirst($order->status);
                                                @endphp
                                                <tr>
                                                    <td><span class="code">{{ $order->order_number ?? sprintf('#%s', str_pad($order->id, 6, '0', STR_PAD_LEFT)) }}</span></td>
                                                    <td>{{ $order->created_at?->format('F j, Y') ?? optional($order->date)->format('F j, Y') }}</td>
                                                    <td>{{ $order->currency ?? 'BDT' }}{{ number_format($order->amount, 2) }}</td>
                                                    <td><span class="badge {{ $badgeClass }}">{{ $displayStatus }}</span></td>
                                                    <td>
                                                        <div class="action-dropdown dropdown">
                                                            <button class="action-icon-btn" type="button" data-bs-toggle="dropdown">
                                                                <i class="far fa-ellipsis"></i>
                                                            </button>
                                                            <ul class="dropdown-menu dropdown-menu-end" style="max-height: none !important; overflow: visible !important;">
                                                                <li>
                                                                    <a class="dropdown-item" href="{{ route('pdf.book.order.details', $order) }}"><i class="far fa-file-alt"></i> Order Details</a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item" href="{{ route('pdf.book.details', $order->pdf_book_id) }}"><i class="far fa-eye"></i> View PDF Book</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5" class="text-center">You have no PDF book orders yet.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                <div class="pagination-area mt-4">
                                    <ul class="pagination mt-4">
                                        <li class="page-item {{ $orders->onFirstPage() ? 'disabled' : '' }}">
                                            <a class="page-link" href="{{ $orders->previousPageUrl() ?: '#' }}" aria-label="Previous">
                                                <span aria-hidden="true"><i class="far fa-angle-double-left"></i></span>
                                            </a>
                                        </li>

                                        @for ($i = 1; $i <= $orders->lastPage(); $i++)
                                            <li class="page-item {{ $orders->currentPage() == $i ? 'active' : '' }}">
                                                <a class="page-link" href="{{ $orders->url($i) }}">{{ $i }}</a>
                                            </li>
                                        @endfor

                                        <li class="page-item {{ $orders->hasMorePages() ? '' : 'disabled' }}">
                                            <a class="page-link" href="{{ $orders->nextPageUrl() ?: '#' }}" aria-label="Next">
                                                <span aria-hidden="true"><i class="far fa-angle-double-right"></i></span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
