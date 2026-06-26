@extends('frontendone.layouts.master')

@section('title', 'PDF Book Order Details')

@push('frontendone_style')
    @include('frontend.pages.common.style')
@endpush

@section('frontendone_content')
    <main class="main">
        <!-- breadcrumb -->
        <x-frontend.pages.common.breadcrumb :title="'PDF Book Order Details'" :breadcrumb="[
            ['name' => 'Home', 'url' => route('home')],
            ['name' => 'PDF Book Orders', 'url' => route('user.pdf.book.orders')],
            ['name' => 'Order Details', 'url' => '#'],
        ]" />
        <!-- breadcrumb end -->

        <div class="user-account py-100">
            <div class="container">
                <div class="row g-4">
                    <div class="col-lg-4 col-xl-3">
                        @include('frontendone.pages.account.sidebarmenu.sidebar')
                    </div>
                    <div class="col-lg-8 col-xl-9">
                        <div class="user-wrapper">
                            <div class="user-card">
                                <div class="header d-flex justify-content-between align-items-center">
                                    <h4 class="title">PDF Book Order Details</h4>
                                    <a href="{{ route('user.pdf.book.orders') }}" class="theme-btn">Back to Orders</a>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 user-table table-responsive">
                                        <table class="table table-borderless text-nowrap">
                                            <tbody>
                                                <tr>
                                                    <th width="30%">Order Number</th>
                                                    <td>{{ $order->order_number ?? sprintf('#%s', str_pad($order->id, 6, '0', STR_PAD_LEFT)) }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>PDF Book</th>
                                                    <td>
                                                        <a href="{{ route('pdf.book.details', $order->pdf_book_id) }}"
                                                            class="text-decoration-none">
                                                            {{ $order->pdfBook?->title ?? ($order->pdfBook?->name ?? 'PDF Book details') }}
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Purchased Date</th>
                                                    <td>{{ $order->created_at?->format('F j, Y') ?? optional($order->date)->format('F j, Y') }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Total Amount</th>
                                                    <td>{{ $order->currency ?? 'BDT' }}{{ number_format($order->amount, 2) }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Payment Method</th>
                                                    <td>
                                                        @php $pm = $order->payment_method ?? '' @endphp
                                                        @if (strtolower($pm) === 'sslcommerz')
                                                            <span class="text-info">SSLCommerz</span>
                                                        @elseif(strtolower($pm) === 'shurjopay')
                                                            <span class="text-success">ShurjoPay</span>
                                                        @elseif(strtolower($pm) === 'stripe')
                                                            <span class="text-info">Stripe</span>
                                                        @elseif(strtolower($pm) === 'paypal')
                                                            <span class="text-info">PayPal</span>
                                                        @else
                                                            <span
                                                                class="text-primary">{{ $order->payment_method ?? 'Unknown' }}</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Payment Status</th>
                                                    <td>
                                                        @php $pstat = strtolower($order->payment_status ?? 'pending') @endphp
                                                        @if ($pstat === 'pending')
                                                            <span class="badge badge-info">Pending</span>
                                                        @elseif($pstat === 'completed')
                                                            <span class="badge badge-success">Completed</span>
                                                        @elseif($pstat === 'failed')
                                                            <span class="badge badge-danger">Failed</span>
                                                        @elseif($pstat === 'cancelled')
                                                            <span class="badge badge-secondary">Cancelled</span>
                                                        @else
                                                            <span
                                                                class="badge badge-primary">{{ ucfirst($order->payment_status ?? 'Unknown') }}</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Order Status</th>
                                                    <td>
                                                        @php $ostat = strtolower($order->status ?? 'pending') @endphp
                                                        @if ($ostat === 'pending')
                                                            <span class="badge badge-info">Pending</span>
                                                        @elseif($ostat === 'processing')
                                                            <span class="badge badge-info">Processing</span>
                                                        @elseif($ostat === 'shipped')
                                                            <span class="badge badge-primary">Shipped</span>
                                                        @elseif($ostat === 'delivered')
                                                            <span class="badge badge-success">Delivered</span>
                                                        @elseif($ostat === 'cancelled')
                                                            <span class="badge badge-danger">Cancelled</span>
                                                        @elseif($ostat === 'enrolled' || $ostat === 'completed')
                                                            <span
                                                                class="badge badge-success">{{ ucfirst($order->status) }}</span>
                                                        @else
                                                            <span
                                                                class="badge badge-primary">{{ ucfirst($order->status ?? 'Unknown') }}</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                                @if ($order->transaction_id)
                                                    <tr>
                                                        <th>Transaction ID</th>
                                                        <td>{{ $order->transaction_id }}</td>
                                                    </tr>
                                                @endif
                                                <tr>
                                                    <th>Billing Name</th>
                                                    <td>{{ $order->name ?? 'N/A' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Billing Email</th>
                                                    <td>{{ $order->email ?? 'N/A' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Billing Phone</th>
                                                    <td>{{ $order->phone ?? 'N/A' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Billing Address</th>
                                                    <td>{{ $order->address ?? 'N/A' }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
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
@endpush
