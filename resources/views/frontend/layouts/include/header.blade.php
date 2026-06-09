<header class="header">
    @php
        $headerProfileImage = auth()->user()?->profile?->profileImage?->profile_image;
        $liveClasses = collect();

        if (auth()->check()) {
            $user = auth()->user();
            $enrolledCourses = $user
                ->courseOrders()
                ->where('payment_status', 'Completed')
                ->where('status', 'Enrolled')
                ->pluck('course_id')
                ->toArray();

            if (!empty($enrolledCourses)) {
                $liveClasses = \App\Models\CourseModule::whereIn('course_id', $enrolledCourses)
                    ->where('live_record', 'live')
                    ->whereNotNull('date')
                    ->whereNotNull('time')
                    ->get()
                    ->map(function ($module) {
                        return [
                            'title' => $module->title,
                            'course_name' => optional(\App\Models\Course::find($module->course_id))->name ?? 'Course',
                            'link' => route('course.video', [$module->course_id, $module->id]),
                            'course_id' => $module->course_id,
                            'module_id' => $module->id,
                        ];
                    });
            }
        }
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
                    @auth('web')
                        <!-- Live Class Notification for Mobile -->
                        <div class="nav-right-link live-class-notification dropdown" id="liveClassNotificationMobile">
                            <a class="nav-link dropdown-toggle position-relative" href="#"
                                id="liveClassDropdownMobile" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Live
                                @if ($liveClasses->count())
                                    <span class="live-count-badge">{{ $liveClasses->count() }}</span>
                                @endif
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="liveClassDropdownMobile">
                                @forelse($liveClasses as $liveClass)
                                    <li>
                                        <a class="dropdown-item" href="{{ $liveClass['link'] }}">
                                            {{ $liveClass['course_name'] }} - {{ $liveClass['title'] }}
                                        </a>
                                    </li>
                                @empty
                                    <li><span class="dropdown-item text-muted">No live classes</span></li>
                                @endforelse
                            </ul>
                        </div>
                    @else
                        <a href="course-cart.html" class="nav-right-link course-cart">
                            <i class="far fa-shopping-bag"></i><span class="count">0</span>
                        </a>
                    @endauth
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
                            <li class="nav-item"><a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}"
                                    href="{{ route('home') }}">Home</a></li>
                            <li class="nav-item"><a
                                    class="nav-link {{ request()->routeIs('courses', 'category.courses', 'subcategory.courses', 'course.details') ? 'active' : '' }}"
                                    href="{{ route('courses') }}">Courses</a></li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle {{ request()->routeIs('books', 'book.category', 'book.subcategory', 'book.details', 'pdf.books', 'pdf.book.category', 'pdf.book.subcategory', 'pdf.book.details') ? 'active' : '' }}"
                                    href="#" data-bs-toggle="dropdown">Books</a>
                                <ul class="dropdown-menu fade-down">
                                    <li><a class="dropdown-item" href="{{ route('books') }}">Physical Books</a></li>
                                    <li><a class="dropdown-item" href="{{ route('pdf.books') }}">PDF Books</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle {{ request()->routeIs('photo.gallery', 'video.gallery') ? 'active' : '' }}"
                                    href="#" data-bs-toggle="dropdown">Gallery</a>
                                <ul class="dropdown-menu fade-down">
                                    <li><a class="dropdown-item" href="{{ route('photo.gallery') }}">Photo Gallery</a>
                                    </li>
                                    <li><a class="dropdown-item" href="{{ route('video.gallery') }}">Video Gallery</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item"><a class="nav-link {{ request()->routeIs('news.*') ? 'active' : '' }}"
                                    href="{{ route('news.search') }}">Blog</a></li>
                            <li class="nav-item"><a
                                    class="nav-link {{ request()->routeIs('contact.page') ? 'active' : '' }}"
                                    href="{{ route('contact.page') }}">Contact</a></li>
                        </ul>
                        <!-- nav-right -->
                        <div class="nav-right">
                            <div class="search-btn">
                                <button type="button" class="nav-right-link search-box-outer"><i
                                        class="far fa-search"></i></button>
                            </div>
                            @auth('web')
                                <div class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle position-relative" href="#"
                                        id="liveClassDropdown" role="button" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        Live
                                        @if ($liveClasses->count())
                                            <span class="live-count-badge">{{ $liveClasses->count() }}</span>
                                        @endif
                                    </a>
                                    <ul class="dropdown-menu fade-down" aria-labelledby="liveClassDropdown">
                                        @forelse($liveClasses as $liveClass)
                                            <li>
                                                <a class="dropdown-item" href="{{ $liveClass['link'] }}">
                                                    {{ $liveClass['course_name'] }} - {{ $liveClass['title'] }}
                                                </a>
                                            </li>
                                        @empty
                                            <li><span class="dropdown-item text-muted">No live classes</span></li>
                                        @endforelse
                                    </ul>
                                </div>
                            @else
                                <a href="course-cart.html" class="nav-right-link course-cart">
                                    <i class="far fa-shopping-bag"></i><span class="count">0</span>
                                </a>
                            @endauth
                            @guest('web')
                                <div class="nav-btn">
                                    <a href="{{ route('login') }}" class="theme-btn"><span
                                            class="far fa-sign-in"></span>
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

<style>
    .live-count-badge {
        position: absolute;
        top: 20px;
        left: 25px;
        min-width: 18px;
        height: 18px;
        padding: 0 6px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #ff4d4f;
        color: #fff;
        font-size: 0.72rem;
        font-weight: 700;
        border-radius: 999px;
        box-shadow: 0 0 0 rgba(255, 77, 79, 0.4);
        animation: liveBadgePulse 1.5s ease-in-out infinite;
        z-index: 2;
    }

    @keyframes liveBadgePulse {

        0%,
        100% {
            transform: scale(1);
            box-shadow: 0 0 0 rgba(255, 77, 79, 0.4);
        }

        50% {
            transform: scale(1.08);
            box-shadow: 0 0 14px rgba(255, 77, 79, 0.18);
        }
    }
</style>

@push('frontend_script')
    <script>
        $(function() {
            $(document).on('profile-image-updated', function(event, imagePath) {
                $('#headerProfileImage').attr('src', imagePath);
            });
        });
    </script>
@endpush
