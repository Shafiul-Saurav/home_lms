@extends('frontend.layouts.master')

@section('title', 'Dashboard')

@push('frontend_style')
@endpush

@section('frontend_content')
    <main class="main">
        <!-- breadcrumb -->
        <x-frontend.pages.common.breadcrumb
            :title="'Dashboard'"
            :breadcrumb="[
                ['name' => 'Home', 'url' => route('home')],
                ['name' => 'Dashboard', 'url' => '#']
            ]"
        />
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
                                <h4 class="title">Summary</h4>
                                <div class="row">
                                    <div class="col-md-6 col-lg-6 col-xl-6">
                                        <div class="user-widget c1">
                                            <div class="info">
                                                <h1>{{ auth()->user()->name ?? 'N/A' }}</h1>
                                                <span>Welcome</span>
                                            </div>
                                            <div class="icon">
                                                <i class="fa-solid fa-user"></i>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-6 col-lg-6 col-xl-4">
                                        <div class="user-widget c2">
                                            <div class="info">
                                                <h6>{{ auth()->user()->email ?? 'N/A' }}</h6>
                                                <span>Your Email</span>
                                            </div>
                                            <div class="icon">
                                                <i class="fal fa-envelope"></i>
                                            </div>
                                        </div>
                                    </div> --}}
                                    <div class="col-md-6 col-lg-6 col-xl-6">
                                        <div class="user-widget c3">
                                            <div class="info">
                                                <h1>{{ \Carbon\Carbon::parse(auth()->user()->created_at)->format('M Y') ?? 'N/A' }}</h1>
                                                <span>Member Since</span>
                                            </div>
                                            <div class="icon">
                                                <i class="fa-solid fa-calendar"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-lg-6 col-xl-4">
                                        <div class="user-widget c1">
                                            <div class="info">
                                                <h1>{{ $completedCount ?? 0 }}</h1>
                                                <span>Completed Courses</span>
                                            </div>
                                            <div class="icon">
                                                <i class="fa-solid fa-book-open-reader"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-xl-4">
                                        <div class="user-widget c2">
                                            <div class="info">
                                                <h1>{{ $enrolledCount ?? 0 }}</h1>
                                                <span>Enrolled Courses</span>
                                            </div>
                                            <div class="icon">
                                                <i class="fa-solid fa-books"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-xl-4">
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
                                <div class="col-xl-8">
                                    <div class="user-card">
                                        <h4 class="title">Sales</h4>
                                        <div class="user-chart">
                                            <div id="chart"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4">
                                    <div class="user-card user-country">
                                        <h4 class="title">Top Countries</h4>
                                        <div class="country-list">
                                            <ul>
                                                <li>
                                                    <img src="{{ asset('assets/frontend') }}/img/country/US.svg"
                                                        alt="" />
                                                    <h6>United States</h6>
                                                    <span>$150</span>
                                                </li>
                                                <li>
                                                    <img src="{{ asset('assets/frontend') }}/img/country/UK.svg"
                                                        alt="" />
                                                    <h6>United Kingdom</h6>
                                                    <span>$220</span>
                                                </li>
                                                <li>
                                                    <img src="{{ asset('assets/frontend') }}/img/country/CA.svg"
                                                        alt="" />
                                                    <h6>Canada</h6>
                                                    <span>$340</span>
                                                </li>
                                                <li>
                                                    <img src="{{ asset('assets/frontend') }}/img/country/JO.svg"
                                                        alt="" />
                                                    <h6>Jordan</h6>
                                                    <span>$180</span>
                                                </li>
                                                <li>
                                                    <img src="{{ asset('assets/frontend') }}/img/country/BR.svg"
                                                        alt="" />
                                                    <h6>Brazil</h6>
                                                    <span>$110</span>
                                                </li>
                                                <li>
                                                    <img src="{{ asset('assets/frontend') }}/img/country/UK.svg"
                                                        alt="" />
                                                    <h6>United Kingdom</h6>
                                                    <span>$140</span>
                                                </li>
                                                <li>
                                                    <img src="{{ asset('assets/frontend') }}/img/country/CA.svg"
                                                        alt="" />
                                                    <h6>Canada</h6>
                                                    <span>$550</span>
                                                </li>
                                                <li>
                                                    <img src="{{ asset('assets/frontend') }}/img/country/JO.svg"
                                                        alt="" />
                                                    <h6>Jordan</h6>
                                                    <span>$270</span>
                                                </li>
                                                <li>
                                                    <img src="{{ asset('assets/frontend') }}/img/country/BR.svg"
                                                        alt="" />
                                                    <h6>Brazil</h6>
                                                    <span>$520</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="user-card mb-0">
                                        <div class="header">
                                            <h4 class="title">Recent Orders</h4>
                                            <div class="header-right">
                                                <a href="{{ route('user.course.orders') }}" class="theme-btn">View All<i
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
                                                                    <button class="action-icon-btn" type="button"
                                                                        data-bs-toggle="dropdown">
                                                                        <i class="far fa-ellipsis"></i>
                                                                    </button>
                                                                    <ul class="dropdown-menu dropdown-menu-end" style="max-height: none !important; overflow: visible !important;">
                                                                        <li>
                                                                            <a class="dropdown-item"
                                                                                href="{{ route('course.order.details', $order->id) }}"><i
                                                                                    class="far fa-eye"></i> Order Details</a>
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
@endsection

@push('frontend_script')
@endpush
