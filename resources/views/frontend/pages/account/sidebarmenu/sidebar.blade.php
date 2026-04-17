<div class="user-sidebar">
    @php
        $isDashboard = request()->routeIs('user.dashboard');
        $isGeneralSetting = request()->routeIs('general.setting');
        $isPersonalSetting = request()->routeIs('personal.setting');
    @endphp
    <div class="sidebar-top">
        <div class="profile-img">
            <img src="{{ auth()->user()->profile_image ?? asset('assets/frontend/img/account/03.jpg') }}" alt="" />
            <button type="button" class="profile-img-btn"><i class="far fa-camera"></i></button>
            <input type="file" class="profile-img-file" />
        </div>
        <h5>{{ auth()->user()->name ?? 'Guest' }}</h5>
        <p><a href="mailto:{{ auth()->user()->email }}">{{ auth()->user()->email ?? 'No email' }}</a></p>
    </div>
    <ul class="sidebar-list">
        <li>
            <a class="{{ $isDashboard ? 'active' : '' }}" href="{{ route('user.dashboard') }}"><i class="far fa-gauge-high icon"></i>
                Dashboard</a>
        </li>
        {{-- <li class="sidebar-menu">
            <a href="#sidebar-menu1" data-bs-toggle="collapse" class="collapsed">
                <i class="far fa-chalkboard-user icon"></i> Instructor <i class="far fa-angle-down um-angle"></i>
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
        </li> --}}
        <li>
            <a class="{{ $isGeneralSetting ? 'active' : '' }}" href="{{ route('general.setting') }}"><i class="far fa-user-tie-hair icon"></i> General Setting</a>
        </li>
        <li>
            <a class="{{ $isPersonalSetting ? 'active' : '' }}" href="{{ route('personal.setting') }}"><i class="far fa-user-tie-hair icon"></i> Personal Setting</a>
        </li>
        <li class="sidebar-menu">
            <a href="#sidebar-menu2" data-bs-toggle="collapse" class="collapsed">
                <i class="far fa-shopping-bag icon"></i> Orders <i class="far fa-angle-down um-angle"></i>
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
                <i class="far fa-location-dot icon"></i> Billing Address <i class="far fa-angle-down um-angle"></i>
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
                <i class="far fa-headset icon"></i> Support Tickets <i class="far fa-angle-down um-angle"></i>
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
                <i class="far fa-wallet icon"></i> Payment <i class="far fa-angle-down um-angle"></i>
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
            <a href="#" onclick="event.preventDefault(); document.getElementById('logoutForm').submit()"><i
                    class="far fa-sign-out icon"></i> Logout</a>
            <form action="{{ route('user.logout') }}" id="logoutForm" method="POST">
                @csrf
            </form>
        </li>
    </ul>
</div>
