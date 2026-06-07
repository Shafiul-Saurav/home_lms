@extends('backend.layouts.master')

@section('title', 'Course Enrollment Orders')

@push('backend_style')
    @include('backend.pages.common.style')
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Course Enrollment Orders</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Course Enrollment</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <h3 class="card-title">Course Enrollment List</h3>
                    <a href="{{ route('orders.course_enrollment.manual') }}" class="btn btn-sm btn-primary">
                        <i class="fa-solid fa-plus fa-fw"></i> Manual Enroll Student
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive export-table">
                        <table id="file-datatable" class="table table-bordered text-nowrap key-buttons border-bottom w-100">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">Order No</th>
                                    <th class="border-bottom-0">User</th>
                                    <th class="border-bottom-0">Course</th>
                                    <th class="border-bottom-0">Amount</th>
                                    <th class="border-bottom-0">Status</th>
                                    <th class="border-bottom-0">Payment Status</th>
                                    <th class="border-bottom-0">Payment Method</th>
                                    <th class="border-bottom-0">Date</th>
                                    <th class="border-bottom-0">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td><strong>{{ $orders->firstItem() + $loop->index }}</strong></td>
                                        <td>{{ $order->order_number }}</td>
                                        <td>{{ optional($order->user)->name ?? $order->name }}</td>
                                        <td>{{ optional($order->course)->name ?? optional($order->course)->title ?? '-' }}</td>
                                        <td>{{ number_format($order->amount, 2) }}</td>
                                        @if ($order->status === 'pending')
                                            <td><span class="badge bg-warning">Pending</span></td>
                                        @elseif ($order->status === 'Enrolled')
                                            <td><span class="badge bg-success">Enrolled</span></td>
                                        @else
                                            <td><span class="badge bg-primary">Unknown</span></td>
                                        @endif

                                        @if ($order->payment_status === 'Pending')
                                            <td><span class="badge bg-warning">Pending</span></td>
                                        @elseif ($order->payment_status === 'Completed')
                                            <td><span class="badge bg-success">Completed</span></td>
                                        @elseif ($order->payment_status === 'Failed')
                                            <td><span class="badge bg-danger">Failed</span></td>
                                        @elseif ($order->payment_status === 'Cancelled')
                                            <td><span class="badge bg-secondary">Cancelled</span></td>
                                        @else
                                            <td><span class="badge bg-primary">Unknown</span></td>
                                        @endif

                                        @if ($order->payment_method === 'SSLCommerz')
                                            <td><span class="text-info">SSLCommerz</span></td>
                                        @elseif ($order->payment_method === 'ShurjoPay')
                                            <td><span class="text-success">ShurjoPay</span></td>
                                        @elseif ($order->payment_method === 'Stripe')
                                            <td><span class="text-info">Stripe</span></td>
                                        @elseif ($order->payment_method === 'PayPal')
                                            <td><span class="text-info">PayPal</span></td>
                                        @else
                                            <td><span class="text-warning">Manual</span></td>
                                        @endif

                                        <td>{{ $order->created_at?->format('d M Y') ?? '-' }}</td>
                                        <td class="text-center">
                                            <div class="action-btns d-flex align-items-center justify-content-center">
                                                <a href="{{ route('orders.course_enrollment.edit', $order->id) }}"
                                                    class="btn btn-sm btn-outline-secondary border me-2"
                                                    title="Edit">
                                                    <i class="fa-solid fa-pen fa-fw"></i>
                                                </a>
                                                <form action="{{ route('orders.course_enrollment.destroy', $order->id) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-sm btn-outline-warning border show_confirm"
                                                        title="Delete">
                                                        <i class="fa-solid fa-trash-can fa-fw"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3">
                        {{ $orders->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('backend_script')
    @include('backend.pages.common.script')
@endpush
