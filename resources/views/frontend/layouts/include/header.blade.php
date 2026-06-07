
<header class="header">
    @php
        $headerProfileImage = auth()->user()?->profile?->profileImage?->profile_image;
    @endphp
    <!-- navbar -->
    <div class="main-navigation">
        <nav class="navbar navbar-expand-lg">
            <div class="container position-relative">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <img src="{{ asset('assets/frontend') }}/img/logo/logo.png" alt="logo" />
                </a>
                <div class="mobile-menu-right">
                    <div class="mobile-menu-btn">
                        <button type="button" class="nav-right-link search-box-outer"><i
                                class="far fa-search"></i></button>
                    </div>
                    <a href="course-cart.html" class="nav-right-link course-cart">
                        <i class="far fa-shopping-bag"></i><span class="count">0</span>
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar"
                        aria-label="Toggle navigation">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                </div>
                <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar"
                    aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-header">
                        <a href="{{ route('home') }}" class="offcanvas-brand" id="offcanvasNavbarLabel">
                            <img src="{{ asset('assets/frontend') }}/img/logo/logo.png" alt="" />
                        </a>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close">
                            <i class="far fa-xmark"></i>
                        </button>
                    </div>
                    <div class="offcanvas-body gap-xl-4">
                        <ul class="navbar-nav justify-content-end flex-grow-1">
                            <li class="nav-item"><a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a></li>
                            <li class="nav-item"><a class="nav-link {{ request()->routeIs('courses', 'category.courses', 'subcategory.courses', 'course.details') ? 'active' : '' }}" href="{{ route('courses') }}">Courses</a></li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle {{ request()->routeIs('books', 'book.category', 'book.subcategory', 'book.details', 'pdf.books', 'pdf.book.category', 'pdf.book.subcategory', 'pdf.book.details') ? 'active' : '' }}" href="#" data-bs-toggle="dropdown">Books</a>
                                <ul class="dropdown-menu fade-down">
                                    <li><a class="dropdown-item" href="{{ route('books') }}">Physical Books</a></li>
                                    <li><a class="dropdown-item" href="{{ route('pdf.books') }}">PDF Books</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle {{ request()->routeIs('photo.gallery', 'video.gallery') ? 'active' : '' }}" href="#" data-bs-toggle="dropdown">Gallery</a>
                                <ul class="dropdown-menu fade-down">
                                    <li><a class="dropdown-item" href="{{ route('photo.gallery') }}">Photo Gallery</a></li>
                                    <li><a class="dropdown-item" href="{{ route('video.gallery') }}">Video Gallery</a></li>
                                </ul>
                            </li>

                            {{-- <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle {{ request()->routeIs('user.*') ? 'active' : '' }}" href="#"
                                    data-bs-toggle="dropdown">Account</a>
                                <ul class="dropdown-menu fade-down">
                                    <li><a class="dropdown-item" href="{{ route('user.dashboard') }}">Dashboard</a>
                                    </li>
                                    <li class="dropdown-submenu">
                                        <a class="dropdown-item dropdown-toggle" href="#">Instructor</a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="instructor-profile.html">Instructor
                                                    Profile</a></li>
                                            <li><a class="dropdown-item" href="instructor-course.html">Instructor
                                                    Courses</a></li>
                                            <li><a class="dropdown-item" href="instructor-course-add.html">Instructor
                                                    Course Add</a></li>
                                            <li><a class="dropdown-item" href="instructor-review.html">Instructor
                                                    Reviews</a></li>
                                            <li><a class="dropdown-item" href="instructor-student.html">Instructor
                                                    Students</a></li>
                                            <li><a class="dropdown-item" href="instructor-payout.html">Instructor
                                                    Payout</a></li>
                                        </ul>
                                    </li>
                                    <li><a class="dropdown-item" href="profile.html">My Profile</a></li>
                                    <li class="dropdown-submenu">
                                        <a class="dropdown-item dropdown-toggle" href="#">Orders</a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="order-list.html">Orders List</a></li>
                                            <li><a class="dropdown-item" href="order-detail.html">Order Details</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li><a class="dropdown-item" href="my-course.html">My Courses</a></li>
                                    <li><a class="dropdown-item" href="my-course-resume.html">Course Resume</a></li>
                                    <li><a class="dropdown-item" href="wishlist.html">My Wishlist</a></li>
                                    <li><a class="dropdown-item" href="certificate.html">Certificate</a></li>
                                    <li><a class="dropdown-item" href="subscription.html">Subscription</a></li>
                                    <li class="dropdown-submenu">
                                        <a class="dropdown-item dropdown-toggle" href="#">Billing Address</a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="billing-address.html">Billing
                                                    Address</a></li>
                                            <li><a class="dropdown-item" href="billing-address-add.html">Address
                                                    Add</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown-submenu">
                                        <a class="dropdown-item dropdown-toggle" href="#">Support Tickets</a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="support-ticket.html">Support
                                                    Tickets</a></li>
                                            <li><a class="dropdown-item" href="support-ticket-detail.html">Support
                                                    Ticket Details</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown-submenu">
                                        <a class="dropdown-item dropdown-toggle" href="#">Payment</a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="transaction.html">Transaction</a></li>
                                            <li><a class="dropdown-item" href="payment-method.html">Payment
                                                    Methods</a></li>
                                            <li><a class="dropdown-item" href="payment-add.html">Payment Add</a></li>
                                        </ul>
                                    </li>
                                    <li><a class="dropdown-item" href="notification.html">Notification</a></li>
                                    <li><a class="dropdown-item" href="message.html">Messages</a></li>
                                    <li><a class="dropdown-item" href="setting.html">Settings</a></li>
                                </ul>
                            </li> --}}
                            <li class="nav-item"><a class="nav-link {{ request()->routeIs('news.*') ? 'active' : '' }}" href="{{ route('news.search') }}">Blog</a></li>
                            <li class="nav-item"><a class="nav-link {{ request()->routeIs('contact.page') ? 'active' : '' }}" href="{{ route('contact.page') }}">Contact</a></li>
                        </ul>
                        <!-- nav-right -->
                        <div class="nav-right">
                            <div class="search-btn">
                                <button type="button" class="nav-right-link search-box-outer"><i
                                        class="far fa-search"></i></button>
                            </div>
                            <a href="course-cart.html" class="nav-right-link course-cart">
                                <i class="far fa-shopping-bag"></i><span class="count">0</span>
                            </a>
                            @guest('web')
                                <div class="nav-btn">
                                    <a href="{{ route('login') }}" class="theme-btn"><span class="far fa-sign-in"></span>
                                        Sign
                                        In</a>
                                </div>
                            @endguest

                            @auth('web')
                            <div class="account-profile">
                                <a href="{{ route('user.dashboard') }}">
                                    <img id="headerProfileImage"
                                        src="{{ $headerProfileImage ? asset($headerProfileImage) : asset('assets/frontend/img/account/03.jpg') }}"
                                        alt="{{ auth()->user()->name ?? 'User' }}" />
                                </a>
                            </div>
                            @endauth

                            <button type="button" class="sidebar-btn nav-right-link" data-bs-toggle="offcanvas"
                                data-bs-target="#sidebarPopup">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
    <!-- navbar end-->
</header>

@push('frontend_script')
    <script>
        $(function() {
            $(document).on('profile-image-updated', function(event, imagePath) {
                $('#headerProfileImage').attr('src', imagePath);
            });
        });
    </script>
@endpush
