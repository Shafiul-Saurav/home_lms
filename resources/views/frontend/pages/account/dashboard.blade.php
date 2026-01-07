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
                                    <div class="col-md-6 col-lg-6 col-xl-4">
                                        <div class="user-widget c1">
                                            <div class="info">
                                                <h1>50</h1>
                                                <span>Pending Orders</span>
                                            </div>
                                            <div class="icon">
                                                <i class="fal fa-list"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-xl-4">
                                        <div class="user-widget c2">
                                            <div class="info">
                                                <h1>25k</h1>
                                                <span>Enrolled Students</span>
                                            </div>
                                            <div class="icon">
                                                <i class="fal fa-user-tie-hair"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-xl-4">
                                        <div class="user-widget c3">
                                            <div class="info">
                                                <h1>$900</h1>
                                                <span>My Balance</span>
                                            </div>
                                            <div class="icon">
                                                <i class="fal fa-wallet"></i>
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
                                                <a href="order-list.html" class="theme-btn">View All<i
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
                                                    <tr>
                                                        <td><span class="code">#35VR5K54</span></td>
                                                        <td>January 21, 2025</td>
                                                        <td>$3,650</td>
                                                        <td><span class="badge badge-info">Pending</span></td>
                                                        <td>
                                                            <div class="action-dropdown dropdown">
                                                                <button class="action-icon-btn" type="button"
                                                                    data-bs-toggle="dropdown">
                                                                    <i class="far fa-ellipsis"></i>
                                                                </button>
                                                                <ul class="dropdown-menu dropdown-menu-end">
                                                                    <li>
                                                                        <a class="dropdown-item"
                                                                            href="order-detail.html"><i
                                                                                class="far fa-eye"></i> Order Details</a>
                                                                    </li>
                                                                    <li>
                                                                        <a class="dropdown-item" href="#"><i
                                                                                class="far fa-pen-swirl"></i> Pending</a>
                                                                    </li>
                                                                    <li>
                                                                        <a class="dropdown-item" href="#"><i
                                                                                class="far fa-circle-dashed"></i>
                                                                            Processing</a>
                                                                    </li>
                                                                    <li>
                                                                        <a class="dropdown-item" href="#"><i
                                                                                class="far fa-check-circle"></i>
                                                                            Completed</a>
                                                                    </li>
                                                                    <li>
                                                                        <a class="dropdown-item" href="#"><i
                                                                                class="far fa-xmark-circle"></i> Cancel</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><span class="code">#35VR5K54</span></td>
                                                        <td>January 21, 2025</td>
                                                        <td>$3,650</td>
                                                        <td><span class="badge badge-primary">Processing</span></td>
                                                        <td>
                                                            <div class="action-dropdown dropdown">
                                                                <button class="action-icon-btn" type="button"
                                                                    data-bs-toggle="dropdown">
                                                                    <i class="far fa-ellipsis"></i>
                                                                </button>
                                                                <ul class="dropdown-menu dropdown-menu-end">
                                                                    <li>
                                                                        <a class="dropdown-item"
                                                                            href="order-detail.html"><i
                                                                                class="far fa-eye"></i> Order Details</a>
                                                                    </li>
                                                                    <li>
                                                                        <a class="dropdown-item" href="#"><i
                                                                                class="far fa-pen-swirl"></i> Pending</a>
                                                                    </li>
                                                                    <li>
                                                                        <a class="dropdown-item" href="#"><i
                                                                                class="far fa-circle-dashed"></i>
                                                                            Processing</a>
                                                                    </li>
                                                                    <li>
                                                                        <a class="dropdown-item" href="#"><i
                                                                                class="far fa-check-circle"></i>
                                                                            Completed</a>
                                                                    </li>
                                                                    <li>
                                                                        <a class="dropdown-item" href="#"><i
                                                                                class="far fa-xmark-circle"></i> Cancel</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><span class="code">#35VR5K54</span></td>
                                                        <td>January 21, 2025</td>
                                                        <td>$3,650</td>
                                                        <td><span class="badge badge-success">Completed</span></td>
                                                        <td>
                                                            <div class="action-dropdown dropdown">
                                                                <button class="action-icon-btn" type="button"
                                                                    data-bs-toggle="dropdown">
                                                                    <i class="far fa-ellipsis"></i>
                                                                </button>
                                                                <ul class="dropdown-menu dropdown-menu-end">
                                                                    <li>
                                                                        <a class="dropdown-item"
                                                                            href="order-detail.html"><i
                                                                                class="far fa-eye"></i> Order Details</a>
                                                                    </li>
                                                                    <li>
                                                                        <a class="dropdown-item" href="#"><i
                                                                                class="far fa-pen-swirl"></i> Pending</a>
                                                                    </li>
                                                                    <li>
                                                                        <a class="dropdown-item" href="#"><i
                                                                                class="far fa-circle-dashed"></i>
                                                                            Processing</a>
                                                                    </li>
                                                                    <li>
                                                                        <a class="dropdown-item" href="#"><i
                                                                                class="far fa-check-circle"></i>
                                                                            Completed</a>
                                                                    </li>
                                                                    <li>
                                                                        <a class="dropdown-item" href="#"><i
                                                                                class="far fa-xmark-circle"></i> Cancel</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><span class="code">#35VR5K54</span></td>
                                                        <td>January 21, 2025</td>
                                                        <td>$3,650</td>
                                                        <td><span class="badge badge-danger">Cancelled</span></td>
                                                        <td>
                                                            <div class="action-dropdown dropdown">
                                                                <button class="action-icon-btn" type="button"
                                                                    data-bs-toggle="dropdown">
                                                                    <i class="far fa-ellipsis"></i>
                                                                </button>
                                                                <ul class="dropdown-menu dropdown-menu-end">
                                                                    <li>
                                                                        <a class="dropdown-item"
                                                                            href="order-detail.html"><i
                                                                                class="far fa-eye"></i> Order Details</a>
                                                                    </li>
                                                                    <li>
                                                                        <a class="dropdown-item" href="#"><i
                                                                                class="far fa-pen-swirl"></i> Pending</a>
                                                                    </li>
                                                                    <li>
                                                                        <a class="dropdown-item" href="#"><i
                                                                                class="far fa-circle-dashed"></i>
                                                                            Processing</a>
                                                                    </li>
                                                                    <li>
                                                                        <a class="dropdown-item" href="#"><i
                                                                                class="far fa-check-circle"></i>
                                                                            Completed</a>
                                                                    </li>
                                                                    <li>
                                                                        <a class="dropdown-item" href="#"><i
                                                                                class="far fa-xmark-circle"></i> Cancel</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><span class="code">#35VR5K54</span></td>
                                                        <td>January 21, 2025</td>
                                                        <td>$3,650</td>
                                                        <td><span class="badge badge-success">Completed</span></td>
                                                        <td>
                                                            <div class="action-dropdown dropdown">
                                                                <button class="action-icon-btn" type="button"
                                                                    data-bs-toggle="dropdown">
                                                                    <i class="far fa-ellipsis"></i>
                                                                </button>
                                                                <ul class="dropdown-menu dropdown-menu-end">
                                                                    <li>
                                                                        <a class="dropdown-item"
                                                                            href="order-detail.html"><i
                                                                                class="far fa-eye"></i> Order Details</a>
                                                                    </li>
                                                                    <li>
                                                                        <a class="dropdown-item" href="#"><i
                                                                                class="far fa-pen-swirl"></i> Pending</a>
                                                                    </li>
                                                                    <li>
                                                                        <a class="dropdown-item" href="#"><i
                                                                                class="far fa-circle-dashed"></i>
                                                                            Processing</a>
                                                                    </li>
                                                                    <li>
                                                                        <a class="dropdown-item" href="#"><i
                                                                                class="far fa-check-circle"></i>
                                                                            Completed</a>
                                                                    </li>
                                                                    <li>
                                                                        <a class="dropdown-item" href="#"><i
                                                                                class="far fa-xmark-circle"></i> Cancel</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><span class="code">#35VR5K54</span></td>
                                                        <td>January 21, 2025</td>
                                                        <td>$3,650</td>
                                                        <td><span class="badge badge-success">Completed</span></td>
                                                        <td>
                                                            <div class="action-dropdown dropdown">
                                                                <button class="action-icon-btn" type="button"
                                                                    data-bs-toggle="dropdown">
                                                                    <i class="far fa-ellipsis"></i>
                                                                </button>
                                                                <ul class="dropdown-menu dropdown-menu-end">
                                                                    <li>
                                                                        <a class="dropdown-item"
                                                                            href="order-detail.html"><i
                                                                                class="far fa-eye"></i> Order Details</a>
                                                                    </li>
                                                                    <li>
                                                                        <a class="dropdown-item" href="#"><i
                                                                                class="far fa-pen-swirl"></i> Pending</a>
                                                                    </li>
                                                                    <li>
                                                                        <a class="dropdown-item" href="#"><i
                                                                                class="far fa-circle-dashed"></i>
                                                                            Processing</a>
                                                                    </li>
                                                                    <li>
                                                                        <a class="dropdown-item" href="#"><i
                                                                                class="far fa-check-circle"></i>
                                                                            Completed</a>
                                                                    </li>
                                                                    <li>
                                                                        <a class="dropdown-item" href="#"><i
                                                                                class="far fa-xmark-circle"></i> Cancel</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><span class="code">#35VR5K54</span></td>
                                                        <td>January 21, 2025</td>
                                                        <td>$3,650</td>
                                                        <td><span class="badge badge-success">Completed</span></td>
                                                        <td>
                                                            <div class="action-dropdown dropdown">
                                                                <button class="action-icon-btn" type="button"
                                                                    data-bs-toggle="dropdown">
                                                                    <i class="far fa-ellipsis"></i>
                                                                </button>
                                                                <ul class="dropdown-menu dropdown-menu-end">
                                                                    <li>
                                                                        <a class="dropdown-item"
                                                                            href="order-detail.html"><i
                                                                                class="far fa-eye"></i> Order Details</a>
                                                                    </li>
                                                                    <li>
                                                                        <a class="dropdown-item" href="#"><i
                                                                                class="far fa-pen-swirl"></i> Pending</a>
                                                                    </li>
                                                                    <li>
                                                                        <a class="dropdown-item" href="#"><i
                                                                                class="far fa-circle-dashed"></i>
                                                                            Processing</a>
                                                                    </li>
                                                                    <li>
                                                                        <a class="dropdown-item" href="#"><i
                                                                                class="far fa-check-circle"></i>
                                                                            Completed</a>
                                                                    </li>
                                                                    <li>
                                                                        <a class="dropdown-item" href="#"><i
                                                                                class="far fa-xmark-circle"></i> Cancel</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </td>
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
        </div>
        <!-- user dashboard end -->
    </main>
@endsection

@push('frontend_script')
@endpush
