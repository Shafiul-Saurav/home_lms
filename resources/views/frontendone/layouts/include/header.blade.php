<!-- Navbar -->
<nav class="navbar navbar-expand-lg main-navbar fixed-top">
    @php
        use App\Models\Category;
        use App\Models\ProductCategory;
        use App\Models\Servicetwocategory;
        use App\Models\Servicetwosubcategory;

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

        // Fetch active categories with active subcategories for header menu
        $headerCategories = Category::where('is_active', 1)
            ->with(['subcategories' => function ($q) { $q->where('is_active', 1); }])
            ->orderBy('name')
            ->get();

        // Fetch active service two categories with active subcategories for header menu
        $headerServiceCategories = Servicetwocategory::where('is_active', 1)
            ->with(['subcategories' => function ($q) { $q->where('is_active', 1); }])
            ->orderBy('title')
            ->get();

        // Fetch active product categories with active subcategories for header menu
        $headerProductCategories = ProductCategory::where('is_active', 1)
            ->with(['subcategories' => function ($q) { $q->where('is_active', 1); }])
            ->orderBy('name')
            ->get();
    @endphp
    <div class="container">

        <a class="navbar-brand" href="{{ route('home') }}">
            Cyber<span>BD</span>
        </a>

        <!-- Desktop Menu -->
        <div class="desktop-menu d-flex align-items-center flex-grow-1">
            <ul class="navbar-nav mx-auto flex-row">

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">Home</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="{{ route('academy') }}">
                        Academy
                    </a>
                    <ul class="dropdown-menu">
                        @if($headerCategories->count())
                            @foreach($headerCategories as $hcat)
                                @if($hcat->subcategories && $hcat->subcategories->count())
                                    <li class="dropdown-submenu">
                                        <a class="dropdown-item dropdown-toggle" href="{{ route('category.courses', $hcat->id) }}">{{ $hcat->name }}</a>
                                        <ul class="dropdown-menu">
                                            @foreach($hcat->subcategories as $hsub)
                                                <li><a class="dropdown-item" href="{{ route('subcategory.courses', $hsub->id) }}">{{ $hsub->name }}</a></li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @else
                                    <li><a class="dropdown-item" href="{{ route('category.courses', $hcat->id) }}">{{ $hcat->name }}</a></li>
                                @endif
                            @endforeach
                        @else
                            <li><a class="dropdown-item" href="{{ route('courses') }}">All Courses</a></li>
                        @endif
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="{{ route('services') }}">
                        Services
                    </a>
                    <ul class="dropdown-menu">
                        @if($headerServiceCategories->count())
                            @foreach($headerServiceCategories as $scat)
                                @if($scat->subcategories && $scat->subcategories->count())
                                    <li class="dropdown-submenu">
                                        <a class="dropdown-item dropdown-toggle" href="{{ route('service.category', $scat->id) }}">{{ $scat->title }}</a>
                                        <ul class="dropdown-menu">
                                            @foreach($scat->subcategories as $ssub)
                                                <li><a class="dropdown-item" href="{{ route('service.subcategory', $ssub->id) }}">{{ $ssub->name }}</a></li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @else
                                    <li><a class="dropdown-item" href="{{ route('service.category', $scat->id) }}">{{ $scat->title }}</a></li>
                                @endif
                            @endforeach
                        @else
                            <li><a class="dropdown-item" href="#">No Services Available</a></li>
                        @endif
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="{{ route('products') }}">
                        Shop
                    </a>
                    <ul class="dropdown-menu">
                        @if($headerProductCategories->count())
                            @foreach($headerProductCategories as $pcat)
                                @if($pcat->subcategories && $pcat->subcategories->count())
                                    <li class="dropdown-submenu">
                                        <a class="dropdown-item dropdown-toggle" href="{{ route('category.products', $pcat->id) }}">{{ $pcat->name }}</a>
                                        <ul class="dropdown-menu">
                                            @foreach($pcat->subcategories as $psub)
                                                <li><a class="dropdown-item" href="{{ route('products', ['category' => $pcat->id, 'subcategory' => $psub->id]) }}">{{ $psub->name }}</a></li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @else
                                    <li><a class="dropdown-item" href="{{ route('category.products', $pcat->id) }}">{{ $pcat->name }}</a></li>
                                @endif
                            @endforeach
                        @else
                            <li><a class="dropdown-item" href="{{ route('products') }}">All Products</a></li>
                        @endif
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('news.search') }}">News & Blog</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('photo.gallery') }}">Gallery</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('contact.page') }}">About Us</a>
                </li>

            </ul>

            @guest('web')
                <a href="{{ route('login') }}" class="nav-action me-2">
                    Sign In
                </a>
                <a href="{{ route('register') }}" class="nav-action">
                    Sign Up
                </a>
            @endguest

            @auth('web')
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <img id="headerProfileImage"
                            src="{{ $headerProfileImage ? asset($headerProfileImage) : asset('assets/frontend/img/testimonial/images.png') }}"
                            alt="{{ auth()->user()->name ?? 'User' }}"
                            style="width: 35px; height: 35px; border-radius: 50%; object-fit: cover;" />
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" style="right: 0; left: auto;">
                        <li><a class="dropdown-item" href="{{ route('user.dashboard') }}">Dashboard</a></li>
                        <li><a class="dropdown-item" href="{{ route('general.setting') }}">Settings</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a href="#" class="dropdown-item"
                                onclick="event.preventDefault(); document.getElementById('logoutForm').submit()">
                                <i class="fa-solid fa-right-from-bracket"></i> Logout
                            </a>
                            <form action="{{ route('user.logout') }}" id="logoutForm" method="POST">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            @endauth


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
        <a href="{{ route('home') }}">
            <h5 class="offcanvas-title">Cyber<span>BD</span></h5>
        </a>
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
                    @if($headerCategories->count())
                        @foreach($headerCategories as $hcat)
                            <li>
                                @if($hcat->subcategories && $hcat->subcategories->count())
                                    <button class="mobile-dropdown-btn">
                                        {{ $hcat->name }} <i class="fa-solid fa-angle-down"></i>
                                    </button>
                                    <ul class="mobile-submenu">
                                        <li><a href="{{ route('category.courses', $hcat->id) }}">All {{ $hcat->name }}</a></li>
                                        @foreach($hcat->subcategories as $hsub)
                                            <li><a href="{{ route('subcategory.courses', $hsub->id) }}">{{ $hsub->name }}</a></li>
                                        @endforeach
                                    </ul>
                                @else
                                    <a href="{{ route('category.courses', $hcat->id) }}">{{ $hcat->name }}</a>
                                @endif
                            </li>
                        @endforeach
                    @else
                        <li><a href="{{ route('courses') }}">All Courses</a></li>
                    @endif
                </ul>
            </li>

            <li>
                <button class="mobile-nav-link mobile-dropdown-btn">
                    Services <i class="fa-solid fa-angle-down"></i>
                </button>
                <ul class="mobile-submenu">
                    @if($headerServiceCategories->count())
                        @foreach($headerServiceCategories as $scat)
                            <li>
                                @if($scat->subcategories && $scat->subcategories->count())
                                    <button class="mobile-dropdown-btn">
                                        {{ $scat->title }} <i class="fa-solid fa-angle-down"></i>
                                    </button>
                                    <ul class="mobile-submenu">
                                        @foreach($scat->subcategories as $ssub)
                                            <li><a href="{{ route('service.subcategory', $ssub->id) }}">{{ $ssub->name }}</a></li>
                                        @endforeach
                                    </ul>
                                @else
                                    <a href="{{ route('service.category', $scat->id) }}">{{ $scat->title }}</a>
                                @endif
                            </li>
                        @endforeach
                    @else
                        <li><a href="#">No Services Available</a></li>
                    @endif
                </ul>
            </li>

            <li>
                <button class="mobile-nav-link mobile-dropdown-btn">
                    Shop <i class="fa-solid fa-angle-down"></i>
                </button>
                <ul class="mobile-submenu">
                    @if($headerProductCategories->count())
                        @foreach($headerProductCategories as $pcat)
                            <li>
                                @if($pcat->subcategories && $pcat->subcategories->count())
                                    <button class="mobile-dropdown-btn">
                                        {{ $pcat->name }} <i class="fa-solid fa-angle-down"></i>
                                    </button>
                                    <ul class="mobile-submenu">
                                        <li><a href="{{ route('category.products', $pcat->id) }}">All {{ $pcat->name }}</a></li>
                                        @foreach($pcat->subcategories as $psub)
                                            <li><a href="{{ route('products', ['category' => $pcat->id, 'subcategory' => $psub->id]) }}">{{ $psub->name }}</a></li>
                                        @endforeach
                                    </ul>
                                @else
                                    <a href="{{ route('category.products', $pcat->id) }}">{{ $pcat->name }}</a>
                                @endif
                            </li>
                        @endforeach
                    @else
                        <li><a href="{{ route('products') }}">All Products</a></li>
                    @endif
                </ul>
            </li>

            <li>
                <a class="mobile-nav-link" href="{{ route('news.search') }}">News</a>
            </li>

            <li>
                <a class="mobile-nav-link" href="{{ route('photo.gallery') }}">Gallery</a>
            </li>

            <li>
                <a class="mobile-nav-link" href="#">Reviews</a>
            </li>

            <li>
                <a class="mobile-nav-link" href="{{ route('contact.page') }}">Contact</a>
            </li>

        </ul>

        <a href="{{ route('login') }}" class="mobile-join-btn">
            Enroll Now <i class="fa-solid fa-arrow-right"></i>
        </a>
    </div>
</div>
