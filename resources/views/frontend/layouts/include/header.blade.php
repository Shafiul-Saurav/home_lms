<header class="header">
    <!-- navbar -->
    <div class="main-navigation">
        <nav class="navbar navbar-expand-lg">
            <div class="container position-relative">
                <a class="navbar-brand" href="index.html">
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
                        <a href="index.html" class="offcanvas-brand" id="offcanvasNavbarLabel">
                            <img src="{{ asset('assets/frontend') }}/img/logo/logo.png" alt="" />
                        </a>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close">
                            <i class="far fa-xmark"></i>
                        </button>
                    </div>
                    <div class="offcanvas-body gap-xl-4">
                        <ul class="navbar-nav justify-content-end flex-grow-1">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle active" href="#"
                                    data-bs-toggle="dropdown">Home</a>
                                <ul class="dropdown-menu fade-down">
                                    <li><a class="dropdown-item" href="index.html">Home Demo 01</a></li>
                                    <li><a class="dropdown-item" href="index-2.html">Home Demo 02</a></li>
                                    <li><a class="dropdown-item" href="index-3.html">Home Demo 03</a></li>
                                    <li><a class="dropdown-item" href="index-4.html">Home Demo 04</a></li>
                                    <li><a class="dropdown-item" href="index-5.html">Home Demo 05</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#"
                                    data-bs-toggle="dropdown">Category</a>
                                <ul class="dropdown-menu fade-down">
                                    <li class="dropdown-submenu">
                                        <a class="dropdown-item dropdown-toggle" href="#">Development</a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="course-category-single.html">Software
                                                    Development</a></li>
                                            <li><a class="dropdown-item" href="course-category-single.html">Web
                                                    Development</a></li>
                                            <li><a class="dropdown-item" href="course-category-single.html">App
                                                    Development</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown-submenu">
                                        <a class="dropdown-item dropdown-toggle" href="#">Design</a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="course-category-single.html">Graphics
                                                    Design</a></li>
                                            <li><a class="dropdown-item" href="course-category-single.html">UX / UI
                                                    Design</a></li>
                                            <li><a class="dropdown-item" href="course-category-single.html">Figma
                                                    Design</a></li>
                                            <li><a class="dropdown-item" href="course-category-single.html">Icon
                                                    Design</a></li>
                                            <li><a class="dropdown-item" href="course-category-single.html">Logo
                                                    Design</a></li>
                                        </ul>
                                    </li>
                                    <li><a class="dropdown-item" href="course-category-single.html">Motion Graphics</a>
                                    </li>
                                    <li><a class="dropdown-item" href="course-category-single.html">Digital
                                            Marketing</a></li>
                                    <li><a class="dropdown-item" href="course-category-single.html">Photography &
                                            Video</a></li>
                                    <li><a class="dropdown-item" href="course-category-single.html">Office
                                            Productivity</a></li>
                                    <li><a class="dropdown-item" href="course-category-single.html">Health & Fitness</a>
                                    </li>
                                    <li><a class="dropdown-item" href="course-category-single.html">Finance &
                                            Accounting</a></li>
                                    <li><a class="dropdown-item" href="course-category-single.html">Life Style</a></li>
                                    <li><a class="dropdown-item" href="course-category-single.html">Music</a></li>
                                    <li><a class="dropdown-item" href="course-category-single.html">English
                                            Learning</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#"
                                    data-bs-toggle="dropdown">Pages</a>
                                <ul class="dropdown-menu fade-down">
                                    <li><a class="dropdown-item" href="{{ route('about') }}">About Us</a></li>
                                    <li><a class="dropdown-item" href="team.html">Our Team</a></li>
                                    <li class="dropdown-submenu">
                                        <a class="dropdown-item dropdown-toggle" href="#">Instructor</a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="instructor.html">All Instructor</a>
                                            </li>
                                            <li><a class="dropdown-item" href="instructor-single.html">Instructor
                                                    Single</a></li>
                                            <li><a class="dropdown-item" href="become-instructor.html">Become
                                                    Instructor</a></li>
                                        </ul>
                                    </li>
                                    <li><a class="dropdown-item" href="pricing.html">Pricing Plan</a></li>
                                    <li class="dropdown-submenu">
                                        <a class="dropdown-item dropdown-toggle" href="#">Events</a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="event.html">Events</a></li>
                                            <li><a class="dropdown-item" href="event-single.html">Event Single</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="dropdown-submenu">
                                        <a class="dropdown-item dropdown-toggle" href="#">Career</a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="career.html">Career</a></li>
                                            <li><a class="dropdown-item" href="career-single.html">Career Single</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="dropdown-submenu">
                                        <a class="dropdown-item dropdown-toggle" href="#">Authentication</a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="login.html">Login</a></li>
                                            <li><a class="dropdown-item" href="register.html">Register</a></li>
                                            <li><a class="dropdown-item" href="forgot-password.html">Forgot
                                                    Password</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown-submenu">
                                        <a class="dropdown-item dropdown-toggle" href="#">Extra Pages</a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="coming-soon.html">Coming Soon</a></li>
                                            <li><a class="dropdown-item" href="return.html">Return Policy</a></li>
                                            <li><a class="dropdown-item" href="terms.html">Terms Of Service</a></li>
                                            <li><a class="dropdown-item" href="privacy.html">Privacy Policy</a></li>
                                            <li><a class="dropdown-item" href="mail-success.html">Mail Success</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li><a class="dropdown-item" href="gallery.html">Gallery</a></li>
                                    <li><a class="dropdown-item" href="affiliate.html">Affiliate</a></li>
                                    <li><a class="dropdown-item" href="help.html">Help Center</a></li>
                                    <li><a class="dropdown-item" href="invoice.html">Invoice</a></li>
                                    <li><a class="dropdown-item" href="faq.html">Faq's</a></li>
                                    <li><a class="dropdown-item" href="testimonial.html">Testimonials</a></li>
                                    <li><a class="dropdown-item" href="404.html">404 Error</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#"
                                    data-bs-toggle="dropdown">Course</a>
                                <ul class="dropdown-menu fade-down">
                                    <li><a class="dropdown-item" href="course.html">Course One</a></li>
                                    <li><a class="dropdown-item" href="course-2.html">Course Two</a></li>
                                    <li><a class="dropdown-item" href="course-3.html">Course Three</a></li>
                                    <li><a class="dropdown-item" href="course-4.html">Course Four</a></li>
                                    <li><a class="dropdown-item" href="course-search.html">Course Search</a></li>
                                    <li class="dropdown-submenu">
                                        <a class="dropdown-item dropdown-toggle" href="#">Course Category</a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="course-category.html">Category One</a>
                                            </li>
                                            <li><a class="dropdown-item" href="course-category-2.html">Category
                                                    Two</a></li>
                                            <li><a class="dropdown-item" href="course-category-single.html">Category
                                                    Single</a></li>
                                        </ul>
                                    </li>
                                    <li><a class="dropdown-item" href="course-cart.html">Course Cart</a></li>
                                    <li><a class="dropdown-item" href="course-checkout.html">Course Checkout</a></li>
                                    <li><a class="dropdown-item" href="course-checkout-complete.html">Checkout
                                            Complete</a></li>
                                    <li><a class="dropdown-item" href="course-single.html">Course Single One</a></li>
                                    <li><a class="dropdown-item" href="course-single-2.html">Course Single Two</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#"
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
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Blog</a>
                                <ul class="dropdown-menu fade-down">
                                    <li><a class="dropdown-item" href="blog.html">Blog</a></li>
                                    <li><a class="dropdown-item" href="blog-single.html">Blog Single</a></li>
                                </ul>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="contact.html">Contact</a></li>
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
                                <a href="{{ route('user.dashboard') }}"><img src="{{ asset('assets/frontend') }}/img/account/03.jpg" alt="" /></a>
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
