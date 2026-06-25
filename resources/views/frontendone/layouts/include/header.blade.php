<!-- Navbar -->
<nav class="navbar navbar-expand-lg main-navbar fixed-top">
    <div class="container">

        <a class="navbar-brand" href="#">
            Cyber<span>BD</span>
        </a>

        <!-- Desktop Menu -->
        <div class="desktop-menu d-flex align-items-center flex-grow-1">
            <ul class="navbar-nav mx-auto flex-row">

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">Home</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="{{ route('courses') }}" data-bs-toggle="dropdown">
                        Courses
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">SOC Analyst Training</a></li>
                        <li><a class="dropdown-item" href="#">Ethical Hacking</a></li>
                        <li><a class="dropdown-item" href="#">Web Security</a></li>

                        <li class="dropdown-submenu">
                            <a class="dropdown-item dropdown-toggle" href="#">Advanced Security</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Penetration Testing</a></li>
                                <li><a class="dropdown-item" href="#">Malware Analysis</a></li>
                                <li><a class="dropdown-item" href="#">Network Defense</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                        Services
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Cyber Training</a></li>
                        <li><a class="dropdown-item" href="#">Security Consulting</a></li>
                        <li><a class="dropdown-item" href="#">Corporate Workshop</a></li>

                        <li class="dropdown-submenu">
                            <a class="dropdown-item dropdown-toggle" href="#">Solutions</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Website Security Audit</a></li>
                                <li><a class="dropdown-item" href="#">Server Security</a></li>
                                <li><a class="dropdown-item" href="#">Cloud Security</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">Mentors</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">News</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">Gallery</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                </li>

            </ul>

            <a href="#" class="nav-action">
                Enroll Now <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>

        <!-- Mobile Button -->
        <div class="mobile-header-actions">
            <button class="mobile-menu-btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileSideNav">
                <i class="fa-solid fa-bars"></i>
            </button>
        </div>

    </div>
</nav>


<!-- Mobile Side Nav -->
<div class="offcanvas offcanvas-start" tabindex="-1" id="mobileSideNav">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title">Cyber<span>BD</span></h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
    </div>

    <div class="offcanvas-body">
        <ul class="mobile-nav-list">

            <li>
                <a class="mobile-nav-link" href="{{ route('home') }}">Home</a>
            </li>

            <li>
                <button class="mobile-nav-link mobile-dropdown-btn">
                    Courses <i class="fa-solid fa-angle-down"></i>
                </button>
                <ul class="mobile-submenu">
                    <li><a href="#">SOC Analyst Training</a></li>
                    <li><a href="#">Ethical Hacking</a></li>
                    <li><a href="#">Web Security</a></li>
                    <li><a href="#">Penetration Testing</a></li>
                    <li><a href="#">Network Defense</a></li>
                </ul>
            </li>

            <li>
                <button class="mobile-nav-link mobile-dropdown-btn">
                    Services <i class="fa-solid fa-angle-down"></i>
                </button>
                <ul class="mobile-submenu">
                    <li><a href="#">Cyber Training</a></li>
                    <li><a href="#">Security Consulting</a></li>
                    <li><a href="#">Corporate Workshop</a></li>
                    <li><a href="#">Website Security Audit</a></li>
                    <li><a href="#">Server Security</a></li>
                </ul>
            </li>

            <li>
                <a class="mobile-nav-link" href="#">Mentors</a>
            </li>

            <li>
                <a class="mobile-nav-link" href="#">News</a>
            </li>

            <li>
                <a class="mobile-nav-link" href="#">Gallery</a>
            </li>

            <li>
                <a class="mobile-nav-link" href="#">Reviews</a>
            </li>

            <li>
                <a class="mobile-nav-link" href="#">Contact</a>
            </li>

        </ul>

        <a href="#" class="mobile-join-btn">
            Enroll Now <i class="fa-solid fa-arrow-right"></i>
        </a>
    </div>
</div>
