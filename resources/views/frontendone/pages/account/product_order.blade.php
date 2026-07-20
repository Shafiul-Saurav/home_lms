@extends('frontendone.layouts.master')

@section('title', 'Product Orders')

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

        .product-orders-card {
            border-radius: 18px;
            overflow: hidden;
        }

        .product-orders-card .header {
            padding-bottom: 18px;
        }

        .product-orders-card .header-right .theme-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 18px;
            border-radius: 10px;
        }

        .product-orders-card .user-table .table {
            margin-bottom: 0;
        }

        .product-orders-card .user-table .table tbody tr {
            transition: background-color 0.2s ease;
        }

        .product-orders-card .user-table .table tbody tr:hover {
            background: rgba(118, 189, 16, 0.04);
        }

        .product-orders-card .user-table .table td,
        .product-orders-card .user-table .table th {
            vertical-align: middle;
        }

        .product-orders-card .pagination-area {
            margin-top: 28px;
        }
    </style>
@endpush

@section('frontendone_content')
    <main class="main">
        <x-frontend.pages.common.breadcrumb :title="'Product Orders'" :breadcrumb="[['name' => 'Home', 'url' => route('home')], ['name' => 'Product Orders', 'url' => '#']]" />

        <div class="user-account py-5">
            <div class="container">
                <div class="row g-4">
                    <div class="col-lg-4 col-xl-3">
                        @include('frontendone.pages.account.sidebarmenu.sidebar')
                    </div>
                    <div class="col-lg-8 col-xl-9">
                        <div class="user-wrapper">
                            <div class="user-card product-orders-card mb-0">
                                <div class="header">
                                    <h4 class="title">Product Orders List</h4>
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
                                                <th>Product Name</th>
                                                {{-- <th>Purchased Date</th> --}}
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
                                                        'completed', 'delivered' => 'badge-success',
                                                        'pending', 'processing' => 'badge-info',
                                                        'shipped' => 'badge-warning',
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
                                                    <td>{{ $order->product->name ?? $order->name ?? 'N/A' }}</td>
                                                    {{-- <td>{{ $order->created_at?->format('F j, Y') ?? optional($order->date)->format('F j, Y') }}</td> --}}
                                                    <td>{{ $order->currency ?? 'BDT' }}{{ number_format($order->amount, 2) }}</td>
                                                    <td><span class="badge {{ $badgeClass }}">{{ $displayStatus }}</span></td>
                                                    <td>
                                                        <div class="action-dropdown dropdown">
                                                            <button class="action-icon-btn" type="button" data-bs-toggle="dropdown">
                                                                <i class="fa-solid fa-ellipsis"></i>
                                                            </button>
                                                            <ul class="dropdown-menu dropdown-menu-end" style="max-height: none !important; overflow: visible !important;">
                                                                {{-- <li>
                                                                    <a class="dropdown-item" href="{{ route('product.details', $order->product_id) }}"><i class="fa-solid fa-eye"></i> View Product</a>
                                                                </li> --}}
                                                                <li>
                                                                    <a class="dropdown-item" href="{{ route('product.order.details', $order->id) }}"><i class="fa-solid fa-file-lines"></i> View Order Details</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6" class="text-center py-5">
                                                        <div style="display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 16px;">
                                                            <i class="fa-solid fa-boxes-stacked" style="font-size: 48px; color: #d1d5db;"></i>
                                                            <p style="color: #6b7280; font-weight: 600; margin: 0;">No Product Orders Yet</p>
                                                            <a href="{{ route('products') ?? '#' }}" class="theme-btn" style="padding: 10px 24px; border-radius: 8px; background-color: #76bd10; color: #fff; text-decoration: none; font-weight: 700;">
                                                                <i class="fa-solid fa-shopping-bag"></i> Shop Products
                                                            </a>
                                                        </div>
                                                    </td>
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
