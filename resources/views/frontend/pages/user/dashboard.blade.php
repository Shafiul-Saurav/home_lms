@extends('frontend.layouts.master')

@section('title', 'Dashboard')

@push('frontend_style')
@endpush

@section('frontend_content')
    <main class="main">
        <!-- breadcrumb -->
        <div class="site-breadcrumb" style="background: url({{ asset('assets/frontend') }}/img/breadcrumb/01.png)">
            <div class="container">
                <h2 class="breadcrumb-title">Dashboard</h2>
                <ul class="breadcrumb-menu">
                    <li><a href="route('home')">Home</a></li>
                    <li class="active">Dashboard</li>
                </ul>
            </div>
        </div>
        <!-- breadcrumb end -->

        <!-- user dashboard -->
        <div class="user-account py-100">
            <div class="container">
                <div class="row g-4">
                    <div class="col-lg-4 col-xl-3">
                        <div class="user-sidebar">
                            <div class="sidebar-top">
                                <div class="profile-img">
                                    <img src="{{ asset('assets/frontend') }}/img/account/03.jpg" alt="" />
                                    <button type="button" class="profile-img-btn"><i class="far fa-camera"></i></button>
                                    <input type="file" class="profile-img-file" />
                                </div>
                                <h5>Antoni Jonson</h5>
                                <p><a href="/cdn-cgi/l/email-protection" class="__cf_email__"
                                        data-cfemail="bddcd3c9d2d3d4fdd8c5dcd0cdd1d893ded2d0">[email&#160;protected]</a></p>
                            </div>
                            <ul class="sidebar-list">
                                <li>
                                    <a class="active" href="dashboard.html"><i class="far fa-gauge-high icon"></i>
                                        Dashboard</a>
                                </li>
                                <li class="sidebar-menu">
                                    <a href="#sidebar-menu1" data-bs-toggle="collapse" class="collapsed">
                                        <i class="far fa-chalkboard-user icon"></i> Instructor <i
                                            class="far fa-angle-down um-angle"></i>
                                    </a>
                                    <div class="collapse" id="sidebar-menu1">
                                        <ul class="sidebar-menu-list">
                                            <li><a href="instructor-profile.html">Instructor Profile</a></li>
                                            <li><a href="instructor-course.html">Instructor Course</a></li>
                                            <li><a href="instructor-course-add.html">Instructor Course Add</a></li>
                                            <li><a href="instructor-review.html">Instructor Review</a></li>
                                            <li><a href="instructor-student.html">Instructor Student</a></li>
                                            <li><a href="instructor-payout.html">Instructor Payout</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <a href="profile.html"><i class="far fa-user-tie-hair icon"></i> My Profile</a>
                                </li>
                                <li class="sidebar-menu">
                                    <a href="#sidebar-menu2" data-bs-toggle="collapse" class="collapsed">
                                        <i class="far fa-shopping-bag icon"></i> Orders <i
                                            class="far fa-angle-down um-angle"></i>
                                    </a>
                                    <div class="collapse" id="sidebar-menu2">
                                        <ul class="sidebar-menu-list">
                                            <li><a href="order-list.html">Orders List</a></li>
                                            <li><a href="order-detail.html">Order Details</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <a href="my-course.html"><i class="far fa-book-open-reader icon"></i> My Courses</a>
                                </li>
                                <li>
                                    <a href="my-course-resume.html"><i class="far fa-books icon"></i> Course Resume</a>
                                </li>
                                <li>
                                    <a href="wishlist.html"><i class="far fa-heart icon"></i> Wishlist</a>
                                </li>
                                <li>
                                    <a href="certificate.html"><i class="far fa-file-certificate icon"></i> Certificate</a>
                                </li>
                                <li>
                                    <a href="subscription.html"><i class="far fa-square-dollar icon"></i> Subscription</a>
                                </li>
                                <li class="sidebar-menu">
                                    <a href="#sidebar-menu3" data-bs-toggle="collapse" class="collapsed">
                                        <i class="far fa-location-dot icon"></i> Billing Address <i
                                            class="far fa-angle-down um-angle"></i>
                                    </a>
                                    <div class="collapse" id="sidebar-menu3">
                                        <ul class="sidebar-menu-list">
                                            <li><a href="billing-address.html">Billing Address</a></li>
                                            <li><a href="billing-address-add.html">Address Add</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="sidebar-menu">
                                    <a href="#sidebar-menu4" data-bs-toggle="collapse" class="collapsed">
                                        <i class="far fa-headset icon"></i> Support Tickets <i
                                            class="far fa-angle-down um-angle"></i>
                                    </a>
                                    <div class="collapse" id="sidebar-menu4">
                                        <ul class="sidebar-menu-list">
                                            <li><a href="support-ticket.html">Support Tickets</a></li>
                                            <li><a href="support-ticket-detail.html">Support Ticket Details</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="sidebar-menu">
                                    <a href="#sidebar-menu5" data-bs-toggle="collapse" class="collapsed">
                                        <i class="far fa-wallet icon"></i> Payment <i
                                            class="far fa-angle-down um-angle"></i>
                                    </a>
                                    <div class="collapse" id="sidebar-menu5">
                                        <ul class="sidebar-menu-list">
                                            <li><a href="transaction.html">Transaction</a></li>
                                            <li><a href="payment-method.html">Payment Methods</a></li>
                                            <li><a href="payment-add.html">Payment Add</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <a href="notification.html"><i class="far fa-bell icon"></i> Notification <span
                                            class="badge badge-danger">02</span></a>
                                </li>
                                <li>
                                    <a href="message.html"><i class="far fa-envelope icon"></i> Messages <span
                                            class="badge badge-danger">02</span></a>
                                </li>
                                <li>
                                    <a href="setting.html"><i class="far fa-gear icon"></i> Settings</a>
                                </li>
                                <li>
                                    <a href="#"><i class="far fa-sign-out icon"></i> Logout</a>
                                </li>
                            </ul>
                        </div>
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
                                                    <img src="{{ asset('assets/frontend') }}/img/country/US.svg" alt="" />
                                                    <h6>United States</h6>
                                                    <span>$150</span>
                                                </li>
                                                <li>
                                                    <img src="{{ asset('assets/frontend') }}/img/country/UK.svg" alt="" />
                                                    <h6>United Kingdom</h6>
                                                    <span>$220</span>
                                                </li>
                                                <li>
                                                    <img src="{{ asset('assets/frontend') }}/img/country/CA.svg" alt="" />
                                                    <h6>Canada</h6>
                                                    <span>$340</span>
                                                </li>
                                                <li>
                                                    <img src="{{ asset('assets/frontend') }}/img/country/JO.svg" alt="" />
                                                    <h6>Jordan</h6>
                                                    <span>$180</span>
                                                </li>
                                                <li>
                                                    <img src="{{ asset('assets/frontend') }}/img/country/BR.svg" alt="" />
                                                    <h6>Brazil</h6>
                                                    <span>$110</span>
                                                </li>
                                                <li>
                                                    <img src="{{ asset('assets/frontend') }}/img/country/UK.svg" alt="" />
                                                    <h6>United Kingdom</h6>
                                                    <span>$140</span>
                                                </li>
                                                <li>
                                                    <img src="{{ asset('assets/frontend') }}/img/country/CA.svg" alt="" />
                                                    <h6>Canada</h6>
                                                    <span>$550</span>
                                                </li>
                                                <li>
                                                    <img src="{{ asset('assets/frontend') }}/img/country/JO.svg" alt="" />
                                                    <h6>Jordan</h6>
                                                    <span>$270</span>
                                                </li>
                                                <li>
                                                    <img src="{{ asset('assets/frontend') }}/img/country/BR.svg" alt="" />
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
