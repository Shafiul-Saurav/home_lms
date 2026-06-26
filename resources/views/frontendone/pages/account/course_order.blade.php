@extends('frontendone.layouts.master')

@section('title', 'Course Orders')

@push('frontendone_style')
    @include('frontend.pages.common.style')
@endpush

@push('frontendone_style')
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

        .user-table .responsive-toggle-col {
            display: none;
            width: 44px;
            min-width: 44px;
        }

        .responsive-row-toggle {
            align-items: center;
            background: #edf8f3;
            border: 1px solid #d4efe3;
            border-radius: 50%;
            color: var(--theme-color);
            display: inline-flex;
            height: 30px;
            justify-content: center;
            transition: all .2s ease;
            width: 30px;
        }

        .responsive-row-toggle[aria-expanded="true"] {
            background: var(--theme-color);
            color: #fff;
        }

        .responsive-row-toggle .fa-minus {
            display: none;
        }

        .responsive-row-toggle[aria-expanded="true"] .fa-plus {
            display: none;
        }

        .responsive-row-toggle[aria-expanded="true"] .fa-minus {
            display: inline-block;
        }

        .responsive-child-row {
            display: none;
        }

        .responsive-child-row.is-open {
            display: table-row;
        }

        .responsive-child-list {
            display: grid;
            gap: 12px;
            padding: 8px 0;
        }

        .responsive-child-item {
            align-items: flex-start;
            display: flex;
            gap: 12px;
            justify-content: space-between;
        }

        .responsive-child-label {
            color: #6c757d;
            font-weight: 600;
        }

        .responsive-child-value {
            text-align: right;
            white-space: normal;
        }

        @media (max-width: 767.98px) {
            .user-table.table-responsive {
                overflow-x: visible !important;
            }

            .user-table .responsive-toggle-col {
                display: table-cell;
            }

            .order-responsive-table th.responsive-hidden,
            .order-responsive-table td.responsive-hidden {
                display: none;
            }

            .order-responsive-table {
                text-wrap: nowrap;
            }
        }
    </style>
@endpush

@section('frontendone_content')
    <main class="main">
        <x-frontend.pages.common.breadcrumb :title="'Course Orders'" :breadcrumb="[['name' => 'Home', 'url' => route('home')], ['name' => 'Course Orders', 'url' => '#']]" />

        <div class="user-account py-100">
            <div class="container">
                <div class="row g-4">
                    <div class="col-lg-4 col-xl-3">
                        @include('frontendone.pages.account.sidebarmenu.sidebar')
                    </div>
                    <div class="col-lg-8 col-xl-9">
                        <div class="user-wrapper">
                            <div class="user-card">
                                <div class="header">
                                    <h4 class="title">Orders List</h4>
                                    <div class="right">
                                        <div class="filter">
                                            <select class="select">
                                                <option value="">Default</option>
                                                <option value="1">Pending</option>
                                                <option value="2">Processing</option>
                                                <option value="3">Completed</option>
                                                <option value="3">Cancelled</option>
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
                                    <table class="table table-borderless text-nowrap order-responsive-table">
                                        <thead>
                                            <tr>
                                                <th class="responsive-toggle-col"></th>
                                                <th>#Order No</th>
                                                <th class="responsive-hidden">Purchased Date</th>
                                                <th class="responsive-hidden">Total</th>
                                                <th class="responsive-hidden">Status</th>
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
                                                    <td class="responsive-toggle-col">
                                                        <button class="responsive-row-toggle" type="button"
                                                            aria-expanded="false" aria-label="Show order details">
                                                            <i class="far fa-plus"></i><i class="far fa-minus"></i>
                                                        </button>
                                                    </td>
                                                    <td><span
                                                            class="code">{{ $order->order_number ?? sprintf('#%s', str_pad($order->id, 6, '0', STR_PAD_LEFT)) }}</span>
                                                    </td>
                                                    <td class="responsive-hidden">
                                                        {{ $order->created_at?->format('F j, Y') ?? optional($order->date)->format('F j, Y') }}
                                                    </td>
                                                    <td class="responsive-hidden">
                                                        {{ $order->currency ?? 'BDT' }}{{ number_format($order->amount, 2) }}
                                                    </td>
                                                    <td class="responsive-hidden"><span
                                                            class="badge {{ $badgeClass }}">{{ $displayStatus }}</span>
                                                    </td>
                                                    <td>
                                                        <div class="action-dropdown dropdown">
                                                            <button class="action-icon-btn" type="button"
                                                                data-bs-toggle="dropdown"><i
                                                                    class="far fa-ellipsis"></i></button>
                                                            <ul class="dropdown-menu dropdown-menu-end"
                                                                style="max-height: none !important; overflow: visible !important;">
                                                                <li><a class="dropdown-item"
                                                                        href="{{ route('course.details', $order->course_id) }}"><i
                                                                            class="far fa-eye"></i> View Course</a></li>
                                                                <li><a class="dropdown-item"
                                                                        href="{{ route('course.order.details', $order->id) }}"><i
                                                                            class="far fa-file-alt"></i> View Order
                                                                        Details</a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6" class="text-center">You have no course orders yet.
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="pagination-area mb-3">
                                <ul class="pagination mt-4">
                                    <li class="page-item {{ $orders->onFirstPage() ? 'disabled' : '' }}">
                                        <a class="page-link" href="{{ $orders->previousPageUrl() ?: '#' }}"
                                            aria-label="Previous"><span aria-hidden="true"><i
                                                    class="far fa-angle-double-left"></i></span></a>
                                    </li>
                                    @for ($i = 1; $i <= $orders->lastPage(); $i++)
                                        <li class="page-item {{ $orders->currentPage() == $i ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $orders->url($i) }}">{{ $i }}</a>
                                        </li>
                                    @endfor
                                    <li class="page-item {{ $orders->hasMorePages() ? '' : 'disabled' }}">
                                        <a class="page-link" href="{{ $orders->nextPageUrl() ?: '#' }}"
                                            aria-label="Next"><span aria-hidden="true"><i
                                                    class="far fa-angle-double-right"></i></span></a>
                                    </li>
                                </ul>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.order-responsive-table').forEach(function(table) {
                table.querySelectorAll('.responsive-row-toggle').forEach(function(button) {
                    button.addEventListener('click', function() {
                        var row = button.closest('tr');
                        var childRow = row.nextElementSibling;
                        var isOpen = button.getAttribute('aria-expanded') === 'true';
                        if (!childRow || !childRow.classList.contains(
                                'responsive-child-row')) {
                            childRow = document.createElement('tr');
                            childRow.className = 'responsive-child-row';
                            childRow.innerHTML = '<td colspan="' + row.children.length +
                                '"><div class="responsive-child-list"></div></td>';
                            row.querySelectorAll('td.responsive-hidden').forEach(function(
                                cell) {
                                var columnIndex = Array.prototype.indexOf.call(row
                                    .children, cell);
                                var label = table.querySelectorAll('thead th')[
                                    columnIndex].textContent.trim();
                                var item = document.createElement('div');
                                item.className = 'responsive-child-item';
                                item.innerHTML =
                                    '<span class="responsive-child-label">' +
                                    label +
                                    '</span><span class="responsive-child-value">' +
                                    cell.innerHTML + '</span>';
                                childRow.querySelector('.responsive-child-list')
                                    .appendChild(item);
                            });
                            row.parentNode.insertBefore(childRow, row.nextSibling);
                        }
                        button.setAttribute('aria-expanded', String(!isOpen));
                        childRow.classList.toggle('is-open', !isOpen);
                    });
                });
            });
        });
    </script>
@endpush
