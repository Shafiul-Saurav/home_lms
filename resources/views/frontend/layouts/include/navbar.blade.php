<div class="eorik-nav-style fixed-top">
    <div class="navbar-area">
        <!-- Menu For Mobile Device -->
        <div class="mobile-nav">
            <a href="{{ route('home') }}" class="logo">
                <img src="{{ asset($logo_fav->logo??null) }}" alt="Logo" style="width: 60px; height: 60px;">
            </a>
        </div>
        <!-- Menu For Desktop Device -->
        <div class="main-nav">
            <nav class="navbar navbar-expand-md navbar-light">
                <div class="container">
                    <a class="navbar-brand" href="{{ route('home') }}">
                        <img src="{{ asset($logo_fav->logo??null) }}" alt="Logo" style="width: 80px; height: 80px;">
                    </a>
                    <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
                        <ul class="navbar-nav m-auto">
                            <li class="nav-item">
                                <a href="{{ route('home') }}" class="nav-link {{Request::routeIs('home') ? 'activePage' : ''}}">
                                    Home
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('about') }}" class="nav-link {{Request::routeIs('about') ? 'activePage' : ''}}">
                                    About Us
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('rooms') }}" class="nav-link {{Request::routeIs('rooms') ? 'activePage' : ''}}">
                                    Rooms
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('services') }}" class="nav-link {{Request::routeIs('services') ? 'activePage' : ''}}">
                                    Services
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link dropdown-toggle {{Request::routeIs('photo.gallery') ? 'activePage' : ''}} {{Request::routeIs('video.gallery') ? 'activePage' : ''}}">
                                        Gallery
                                        <i class='bx bx-chevron-down'></i>
                                    </a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item">
                                        <a href="{{ route('photo.gallery') }}" class="nav-link {{Request::routeIs('photo.gallery') ? 'activePage' : ''}}">Photo Gallery</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('video.gallery') }}" class="nav-link {{Request::routeIs('video.gallery') ? 'activePage' : ''}}">Video Gallery</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    Contacts
                                </a>
                            </li>
                            @auth('web')
                            <li class="nav-item">
                                <a href="javascript:void(0)" class="nav-link dropdown-toggle {{Request::routeIs('user.dashboard') ? 'activePage' : ''}}">
                                        My Account
                                        <i class='bx bx-chevron-down'></i>
                                    </a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item">
                                        <a href="{{ route('user.dashboard') }}" class="nav-link {{Request::routeIs('user.dashboard') ? 'activePage' : ''}}">Dashboard</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="" class="nav-link">Inbox</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutForm').submit()">Logout</a>
                                        <form action="{{route('user.logout')}}" id="logoutForm" method="POST">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </li>
                            @endauth
                            @guest('web')
                            <li class="nav-item">
                                <a href="{{ route('login') }}" class="nav-link">
                                    Login
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('register') }}" class="nav-link">
                                    Register
                                </a>
                            </li>
                            @endguest
                        </ul>
                        <!-- Start Other Option -->
                        <div class="others-option">
                            <a class="call-us" href="tel:{{ $website_link->number??null }}">
                                    <i class="bx bx-phone-call bx-tada"></i>
                                    {{ $website_link->number??null }}
                                </a>
                        </div>
                        <!-- End Other Option -->
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>
