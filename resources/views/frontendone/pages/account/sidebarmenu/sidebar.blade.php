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
                <span class="profile-img-btn"><i class="fa-solid fa-camera"></i></span>
                <input type="file" id="profileImageInput" name="profile_image" class="profile-img-trigger-input"
                    accept=".jpg,.jpeg,.png" />
            </div>
        </div>
        <h5>{{ auth()->user()->name ?? 'Guest' }}</h5>
        <p><a href="mailto:{{ auth()->user()->email }}">{{ auth()->user()->email ?? 'No email' }}</a></p>
    </div>
    <ul class="sidebar-list">
        <li>
            <a class="{{ $isDashboard ? 'active' : '' }}" href="{{ route('user.dashboard') }}">
                <i class="fa-solid fa-chart-line icon"></i> Dashboard
            </a>
        </li>
        <li>
            <a class="{{ $isGeneralSetting ? 'active' : '' }}" href="{{ route('general.setting') }}">
                <i class="fa-solid fa-sliders icon"></i> General Setting
            </a>
        </li>
        <li>
            <a class="{{ $isPersonalSetting ? 'active' : '' }}" href="{{ route('personal.setting') }}">
                <i class="fa-solid fa-user-gear icon"></i> Personal Setting
            </a>
        </li>
        @php
            $isOrdersSectionOpen = $isCourseOrders || $isBookOrders || $isPdfBookOrders;
        @endphp
        <li class="sidebar-menu">
            <a href="#sidebar-menu2" data-bs-toggle="collapse" class="{{ $isOrdersSectionOpen ? '' : 'collapsed' }}">
                <span><i class="fa-solid fa-bag-shopping icon"></i> Orders</span>
                <i class="fa-solid fa-angle-down um-angle"></i>
            </a>
            <div class="collapse {{ $isOrdersSectionOpen ? 'show' : '' }}" id="sidebar-menu2">
                <ul class="sidebar-menu-list">
                    <li><a class="{{ $isCourseOrders ? 'active' : '' }}"
                            href="{{ route('user.course.orders') }}">Course Orders</a></li>
                    {{-- <li><a class="{{ $isBookOrders ? 'active' : '' }}" href="{{ route('user.book.orders') }}">Book
                            Orders</a></li>
                    <li><a class="{{ $isPdfBookOrders ? 'active' : '' }}"
                            href="{{ route('user.pdf.book.orders') }}">PDF Book Orders</a></li> --}}
                </ul>
            </div>
        </li>
        <li>
            <a class="{{ $isMyCourses ? 'active' : '' }}" href="{{ route('my.courses') }}">
                <i class="fa-solid fa-book-open-reader icon"></i> My Courses
            </a>
        </li>
        {{-- <li>
            <a href="#">
                <i class="fa-solid fa-play icon"></i> Course Resume
            </a>
        </li>
        <li>
            <a href="#">
                <i class="fa-solid fa-heart icon"></i> Wishlist
            </a>
        </li>
        <li>
            <a href="#">
                <i class="fa-solid fa-certificate icon"></i> Certificate
            </a>
        </li>
        <li>
            <a href="#">
                <i class="fa-solid fa-credit-card icon"></i> Subscription
            </a>
        </li>
        <li class="sidebar-menu">
            <a href="#sidebar-menu3" data-bs-toggle="collapse" class="collapsed">
                <span><i class="fa-solid fa-map-location-dot icon"></i> Billing Address</span>
                <i class="fa-solid fa-angle-down um-angle"></i>
            </a>
            <div class="collapse" id="sidebar-menu3">
                <ul class="sidebar-menu-list">
                    <li><a href="#">Billing Address</a></li>
                    <li><a href="#">Address Add</a></li>
                </ul>
            </div>
        </li>
        <li class="sidebar-menu">
            <a href="#sidebar-menu4" data-bs-toggle="collapse" class="collapsed">
                <span><i class="fa-solid fa-headset icon"></i> Support Tickets</span>
                <i class="fa-solid fa-angle-down um-angle"></i>
            </a>
            <div class="collapse" id="sidebar-menu4">
                <ul class="sidebar-menu-list">
                    <li><a href="#">Support Tickets</a></li>
                    <li><a href="#">Support Ticket Details</a></li>
                </ul>
            </div>
        </li>
        <li class="sidebar-menu">
            <a href="#sidebar-menu5" data-bs-toggle="collapse" class="collapsed">
                <span><i class="fa-solid fa-wallet icon"></i> Payment</span>
                <i class="fa-solid fa-angle-down um-angle"></i>
            </a>
            <div class="collapse" id="sidebar-menu5">
                <ul class="sidebar-menu-list">
                    <li><a href="#">Transaction</a></li>
                    <li><a href="#">Payment Methods</a></li>
                    <li><a href="#">Payment Add</a></li>
                </ul>
            </div>
        </li>
        <li>
            <a href="#">
                <i class="fa-solid fa-bell icon"></i> Notification <span class="badge badge-danger ms-auto" style="background-color: #ef4444; font-size: 11px;">02</span>
            </a>
        </li>
        <li>
            <a href="#">
                <i class="fa-solid fa-envelope icon"></i> Messages <span class="badge badge-danger ms-auto" style="background-color: #ef4444; font-size: 11px;">02</span>
            </a>
        </li>
        <li>
            <a href="#">
                <i class="fa-solid fa-gear icon"></i> Settings
            </a>
        </li> --}}
        <li>
            <a href="#" onclick="event.preventDefault(); document.getElementById('logoutForm').submit()">
                <i class="fa-solid fa-right-from-bracket icon"></i> Logout
            </a>
            <form action="{{ route('user.logout') }}" id="logoutForm" method="POST">
                @csrf
            </form>
        </li>
    </ul>
</div>

@push('frontendone_style')
    <style>
        /* Card-based Sidebar container */
        .user-sidebar {
            background: #fff;
            border: 1px solid #edf0f5;
            border-radius: 24px;
            padding: 30px 24px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.05);
            transition: 0.3s ease;
        }

        .user-sidebar:hover {
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.1);
        }

        .user-sidebar .sidebar-top {
            text-align: center;
            border-bottom: 1px solid #edf0f5;
            padding-bottom: 25px;
            margin-bottom: 25px;
        }

        .user-sidebar .sidebar-top .profile-img {
            width: 110px;
            height: 110px;
            border-radius: 50%;
            position: relative;
            margin: 0 auto 15px;
            border: 3px solid #76bd10;
            box-shadow: 0 8px 25px rgba(118, 189, 16, 0.15);
        }

        .user-sidebar .sidebar-top .profile-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }

        .user-sidebar .sidebar-top h5 {
            font-size: 18px;
            font-weight: 800;
            color: #111827;
            margin-bottom: 5px;
        }

        .user-sidebar .sidebar-top p a {
            font-size: 13px;
            color: #6b7280;
            font-weight: 600;
            text-decoration: none;
        }

        .user-sidebar .sidebar-list {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .user-sidebar .sidebar-list li {
            position: relative;
        }

        .user-sidebar .sidebar-list li a {
            display: flex;
            align-items: center;
            padding: 12px 18px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 700;
            color: #4b5563;
            transition: 0.3s;
            text-decoration: none;
            gap: 12px;
        }

        .user-sidebar .sidebar-list li a i.icon {
            font-size: 16px;
            color: #9ca3af;
            transition: 0.3s;
            width: 20px;
            text-align: center;
        }

        .user-sidebar .sidebar-list li a:hover,
        .user-sidebar .sidebar-list li a.active {
            background: rgba(118, 189, 16, 0.08);
            color: #76bd10;
        }

        .user-sidebar .sidebar-list li a:hover i.icon,
        .user-sidebar .sidebar-list li a.active i.icon {
            color: #76bd10;
        }

        .user-sidebar .sidebar-list li.sidebar-menu>a {
            justify-content: space-between;
        }

        .user-sidebar .sidebar-list li.sidebar-menu>a .um-angle {
            transition: 0.3s;
            font-size: 12px;
        }

        .user-sidebar .sidebar-list li.sidebar-menu>a.collapsed .um-angle {
            transform: rotate(-90deg);
        }

        .user-sidebar .sidebar-list li.sidebar-menu .sidebar-menu-list {
            list-style: none;
            padding-left: 32px;
            margin-top: 5px;
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .user-sidebar .sidebar-list li.sidebar-menu .sidebar-menu-list a {
            padding: 8px 12px;
            font-size: 13px;
            font-weight: 600;
        }

        .user-sidebar .sidebar-top .profile-img-upload {
            position: absolute;
            right: 0;
            bottom: 0;
            width: 32px;
            height: 32px;
            background: #111827;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            border: 2px solid #fff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
            transition: 0.3s;
        }

        .user-sidebar .sidebar-top .profile-img-upload:hover {
            background: #76bd10;
            color: #fff;
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
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
        }

        /* Modern Cards */
        .user-wrapper .user-card {
            background: #fff;
            border: 1px solid #edf0f5;
            border-radius: 24px;
            padding: 35px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.05);
            transition: 0.3s ease;
            margin-bottom: 30px;
        }



        .user-wrapper .user-card h4.title {
            font-size: 20px;
            font-weight: 800;
            color: #111827;
            margin-bottom: 25px;
            position: relative;
            padding-bottom: 12px;
            border-bottom: 1px solid #edf0f5;
        }

        /* Widgets/Summary Cards */
        .user-widget {
            background: #fff;
            border: 1px solid #edf0f5;
            border-radius: 20px;
            padding: 25px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.03);
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: 0.3s ease;
            height: 100%;
            margin-bottom: 20px;
        }



        .user-widget .info h1 {
            font-size: clamp(20px, 4vw, 26px);
            font-weight: 800;
            color: #111827;
            margin-bottom: 4px;
            word-break: break-word;
        }

        .user-widget .info span {
            font-size: 14px;
            font-weight: 600;
            color: #4b5563;
        }

        .user-widget .icon {
            width: 56px;
            height: 56px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            flex-shrink: 0;
        }

        .user-widget.c1 .icon {
            background: rgba(79, 70, 229, 0.1);
            color: #4f46e5;
        }

        .user-widget.c2 .icon {
            background: rgba(147, 51, 234, 0.1);
            color: #9333ea;
        }

        .user-widget.c3 .icon {
            background: rgba(118, 189, 16, 0.1);
            color: #76bd10;
        }

        /* Modern Tables */
        .user-table .table {
            border-collapse: separate;
            border-spacing: 0 10px;
            margin-top: 10px;
        }

        .user-table .table thead th {
            background: #f8fafc;
            border: none;
            color: #4b5563;
            font-weight: 700;
            padding: 15px 20px;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .user-table .table thead th:first-child {
            border-top-left-radius: 12px;
            border-bottom-left-radius: 12px;
        }

        .user-table .table thead th:last-child {
            border-top-right-radius: 12px;
            border-bottom-right-radius: 12px;
        }

        .user-table .table tbody tr {
            background: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.01);
            transition: 0.3s;
        }



        .user-table .table tbody td {
            padding: 18px 20px;
            vertical-align: middle;
            border-top: 1px solid #edf0f5;
            border-bottom: 1px solid #edf0f5;
            color: #111827;
            font-weight: 600;
            font-size: 14px;
        }

        .user-table .table tbody td:first-child {
            border-left: 1px solid #edf0f5;
            border-top-left-radius: 12px;
            border-bottom-left-radius: 12px;
        }

        .user-table .table tbody td:last-child {
            border-right: 1px solid #edf0f5;
            border-top-right-radius: 12px;
            border-bottom-right-radius: 12px;
        }

        /* Dropdowns & action buttons in tables */
        .user-table .action-icon-btn {
            background: #f3f4f6;
            color: #4b5563;
            border: none;
            width: 34px;
            height: 34px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: 0.3s;
        }

        .user-table .action-icon-btn:hover {
            background: #111827;
            color: #fff;
        }

        /* Badges */
        .user-table .badge {
            padding: 8px 12px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 12px;
        }

        .user-table .badge.badge-success {
            background: rgba(118, 189, 16, 0.1);
            color: #76bd10;
        }

        .user-table .badge.badge-info {
            background: rgba(59, 130, 246, 0.1);
            color: #3b82f6;
        }

        .user-table .badge.badge-danger {
            background: rgba(239, 68, 68, 0.1);
            color: #ef4444;
        }

        .user-table .badge.badge-primary {
            background: rgba(79, 70, 229, 0.1);
            color: #4f46e5;
        }

        .user-table .badge.badge-secondary {
            background: rgba(107, 114, 128, 0.1);
            color: #6b7280;
        }
    </style>
@endpush
