<div class="user-sidebar">
    @php
        $isDashboard = request()->routeIs('user.dashboard');
        $isGeneralSetting = request()->routeIs('general.setting');
        $isPersonalSetting = request()->routeIs('personal.setting');
        $isMyCourses = request()->routeIs('my.courses');
        $isCourseOrders = request()->routeIs('user.course.orders');
        $isBookOrders = request()->routeIs('user.book.orders');
        $isPdfBookOrders = request()->routeIs('user.pdf.book.orders');
        $profileImage = auth()->user()?->profile?->profileImage?->profile_image;
    @endphp
    <div class="sidebar-top">
        <div class="profile-img">
            <img id="profileImagePreview"
                src="{{ $profileImage ? asset($profileImage) : asset('assets/frontend/img/testimonial/images.png') }}"
                alt="{{ auth()->user()->name ?? 'Guest' }}" />
            <div class="profile-img-upload">
                <span class="profile-img-btn"><i class="far fa-camera"></i></span>
                <input type="file" id="profileImageInput" name="profile_image" class="profile-img-trigger-input"
                    accept=".jpg,.jpeg,.png" />
            </div>
        </div>
        <h5>{{ auth()->user()->name ?? 'Guest' }}</h5>
        <p><a href="mailto:{{ auth()->user()->email }}">{{ auth()->user()->email ?? 'No email' }}</a></p>
        @php
            $profilePercentage = auth()->user()?->profileCompletionPercentage() ?? 0;
            if ($profilePercentage < 50) {
                $barColor = '#e05a2b';
            } elseif ($profilePercentage < 90) {
                $barColor = '#ffc107';
            } else {
                $barColor = '#68a900';
            }
        @endphp
        <div class="profile-completion-box mt-3" style="text-align: left; padding: 10px; background: #f8fafc; border-radius: 12px; border: 1px solid #edf0f5;">
            <div class="d-flex justify-content-between align-items-center mb-1" style="font-size: 11px; font-weight: 700; color: #4b5563;">
                <span>Profile Completion</span>
                <span style="color: {{ $barColor }}">{{ $profilePercentage }}%</span>
            </div>
            <div class="progress" style="height: 6px; border-radius: 3px; background-color: #e5e7eb; overflow: hidden; margin-bottom: 0;">
                <div class="progress-bar" role="progressbar" style="width: {{ $profilePercentage }}%; background-color: {{ $barColor }}; height: 100%;" aria-valuenow="{{ $profilePercentage }}" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            @if ($profilePercentage < 90)
                <div class="mt-1 text-danger" style="font-size: 9px; font-weight: 600; line-height: 1.2;">
                    * Complete 90% to finish courses.
                </div>
            @endif
        </div>
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
        @php
            $isOrdersSectionOpen = $isCourseOrders || $isBookOrders || $isPdfBookOrders;
        @endphp
        <li class="sidebar-menu">
            <a href="#sidebar-menu2" data-bs-toggle="collapse" class="{{ $isOrdersSectionOpen ? '' : 'collapsed' }}">
                <i class="far fa-shopping-bag icon"></i> Orders <i class="far fa-angle-down um-angle"></i>
            </a>
            <div class="collapse {{ $isOrdersSectionOpen ? 'show' : '' }}" id="sidebar-menu2">
                <ul class="sidebar-menu-list">
                    <li><a class="{{ $isCourseOrders ? 'active' : '' }}" href="{{ route('user.course.orders') }}">Course Orders</a></li>
                    <li><a class="{{ $isBookOrders ? 'active' : '' }}" href="{{ route('user.book.orders') }}">Book Orders</a></li>
                    <li><a class="{{ $isPdfBookOrders ? 'active' : '' }}" href="{{ route('user.pdf.book.orders') }}">PDF Book Orders</a></li>
                </ul>
            </div>
        </li>
        <li>
            <a class="{{ $isMyCourses ? 'active' : '' }}" href="{{ route('my.courses') }}"><i class="far fa-book-open-reader icon"></i> My Courses</a>
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

@push('frontend_style')
    <style>
        .user-sidebar .sidebar-top .profile-img-upload {
            position: absolute;
            right: 0;
            bottom: 0;
            width: 30px;
            height: 30px;
        }

        .user-sidebar .sidebar-top .profile-img-trigger-input {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
            z-index: 2;
        }

        .user-sidebar .sidebar-top .profile-img-upload .profile-img-btn {
            pointer-events: none;
            display: block;
            width: 100%;
            height: 100%;
        }
    </style>
@endpush
