<div class="sticky">
    <div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
    <div class="app-sidebar">
        <div class="side-header">
            <a class="header-brand1" href="{{ route('admin.dashboard') }}">
                <img src="{{ asset($logo_fav->logo ?? null) }}" class="header-brand-img desktop-logo pt-0" alt="logo"
                    style="width: 100%; height: 60px;">
                <img src="{{ asset($logo_fav->logo ?? null) }}" class="header-brand-img light-logo1" alt="logo"
                    style="width: 100%; height: 60px;">
            </a><!-- LOGO -->
        </div>
        <div class="main-sidemenu">
            <div class="slide-left disabled" id="slide-left"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191"
                    width="24" height="24" viewBox="0 0 24 24">
                    <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z" />
                </svg>
            </div>
            <ul class="side-menu">
                <li>
                    <h3>Menu</h3>
                </li>
                <li class="slide">
                    <a class="side-menu__item has-link {{ Request::routeIs('admin.dashboard') ? 'active' : '' }}"
                        data-bs-toggle="slide" href="{{ route('admin.dashboard') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon"
                            enable-background="new 0 0 24 24" viewBox="0 0 24 24">
                            <path
                                d="M19.9794922,7.9521484l-6-5.2666016c-1.1339111-0.9902344-2.8250732-0.9902344-3.9589844,0l-6,5.2666016C3.3717041,8.5219116,2.9998169,9.3435669,3,10.2069702V19c0.0018311,1.6561279,1.3438721,2.9981689,3,3h2.5h7c0.0001831,0,0.0003662,0,0.0006104,0H18c1.6561279-0.0018311,2.9981689-1.3438721,3-3v-8.7930298C21.0001831,9.3435669,20.6282959,8.5219116,19.9794922,7.9521484z M15,21H9v-6c0.0014038-1.1040039,0.8959961-1.9985962,2-2h2c1.1040039,0.0014038,1.9985962,0.8959961,2,2V21z M20,19c-0.0014038,1.1040039-0.8959961,1.9985962-2,2h-2v-6c-0.0018311-1.6561279-1.3438721-2.9981689-3-3h-2c-1.6561279,0.0018311-2.9981689,1.3438721-3,3v6H6c-1.1040039-0.0014038-1.9985962-0.8959961-2-2v-8.7930298C3.9997559,9.6313477,4.2478027,9.0836182,4.6806641,8.7041016l6-5.2666016C11.0455933,3.1174927,11.5146484,2.9414673,12,2.9423828c0.4853516-0.0009155,0.9544067,0.1751099,1.3193359,0.4951172l6,5.2665405C19.7521973,9.0835571,20.0002441,9.6313477,20,10.2069702V19z" />
                        </svg>
                        <span class="side-menu__label">Dashboard</span>
                    </a>
                </li>
                <li>
                    <h3>Pages</h3>
                </li>
                @can('index-general-setting')
                    <li
                        class="slide {{ Request::routeIs('logo_fav.index') ? 'is-expanded' : '' }}
                    {{ Request::routeIs('pages.index') ? 'is-expanded' : '' }} {{ Request::routeIs('breadcrumb.index') ? 'is-expanded' : '' }}
                    {{ Request::routeIs('website_link.index') ? 'is-expanded' : '' }} {{ Request::routeIs('home_slider.index') ? 'is-expanded' : '' }}
                    {{ Request::routeIs('copyright.index') ? 'is-expanded' : '' }}">
                        <a class="side-menu__item  {{ Request::routeIs('logo_fav.index') ? 'active' : '' }}
                    {{ Request::routeIs('pages.index') ? 'active' : '' }} {{ Request::routeIs('breadcrumb.index') ? 'active' : '' }}
                    {{ Request::routeIs('website_link.index') ? 'active' : '' }} {{ Request::routeIs('home_slider.index') ? 'active' : '' }}
                    {{ Request::routeIs('copyright.index') ? 'active' : '' }}"
                            data-bs-toggle="slide" href="#">
                            <i class="fa-solid fa-screwdriver-wrench fa-fw"></i>
                            <span class="side-menu__label ms-3">General Setting</span><i
                                class="fa-solid fa-angle-right"></i>
                        </a>
                        <ul class="slide-menu">
                            @can('index-logo-fav')
                                <li><a href="{{ route('logo_fav.index') }}"
                                        class="slide-item {{ Request::routeIs('logo_fav.index') ? 'active' : '' }}">Logo &
                                        Favicon Setting</a></li>
                            @endcan

                            @can('index-page')
                                <li><a href="{{ route('pages.index') }}"
                                        class="slide-item {{ Request::routeIs('pages.index') ? 'active' : '' }}">Page
                                        Create</a></li>
                            @endcan
                            @can('index-banner')
                                <li><a href="{{ route('breadcrumb.index') }}"
                                        class="slide-item {{ Request::routeIs('breadcrumb.index') ? 'active' : '' }}">Breadcrumb/Banner
                                        Setting</a></li>
                            @endcan
                            @can('index-weblink')
                                <li><a href="{{ route('website_link.index') }}"
                                        class="slide-item {{ Request::routeIs('website_link.index') ? 'active' : '' }}">Website
                                        Link Setting</a></li>
                            @endcan
                            @can('index-home-slider')
                                <li><a href="{{ route('home_slider.index') }}"
                                        class="slide-item {{ Request::routeIs('home_slider.index') ? 'active' : '' }}">Home
                                        Slider Setting</a></li>
                            @endcan
                            @can('index-copyright')
                                <li><a href="{{ route('copyright.index') }}"
                                        class="slide-item {{ Request::routeIs('copyright.index') ? 'active' : '' }}">Copyright
                                        Setting</a></li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('index-module')
                    <li
                        class="slide {{ Request::routeIs('modules.index') ? 'is-expanded' : '' }}
                    {{ Request::routeIs('modules.trash') ? 'is-expanded' : '' }}
                    {{ Request::routeIs('permissions.index') ? 'is-expanded' : '' }}
                    {{ Request::routeIs('permissions.trash') ? 'is-expanded' : '' }}
                    {{ Request::routeIs('roles.index') ? 'is-expanded' : '' }}
                    {{ Request::routeIs('roles.trash') ? 'is-expanded' : '' }}
                    {{ Request::routeIs('users.index') ? 'is-expanded' : '' }}
                    {{ Request::routeIs('users.trash') ? 'is-expanded' : '' }}">
                        <a class="side-menu__item {{ Request::routeIs('modules.index') ? 'active' : '' }}
                        {{ Request::routeIs('modules.trash') ? 'active' : '' }}
                        {{ Request::routeIs('permissions.index') ? 'active' : '' }}
                        {{ Request::routeIs('permissions.trash') ? 'active' : '' }}
                        {{ Request::routeIs('roles.index') ? 'active' : '' }}
                        {{ Request::routeIs('roles.trash') ? 'active' : '' }}
                        {{ Request::routeIs('users.index') ? 'active' : '' }}
                        {{ Request::routeIs('users.trash') ? 'active' : '' }}"
                            data-bs-toggle="slide" href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon"
                                enable-background="new 0 0 24 24" viewBox="0 0 24 24">
                                <path
                                    d="M19,2H9C7.3438721,2.0018311,6.0018311,3.3438721,6,5v1H5C3.3438721,6.0018311,2.0018311,7.3438721,2,9v10c0.0018311,1.6561279,1.3438721,2.9981689,3,3h10c1.6561279-0.0018311,2.9981689-1.3438721,3-3v-1h1c1.6561279-0.0018311,2.9981689-1.3438721,3-3V5C21.9981689,3.3438721,20.6561279,2.0018311,19,2z M17,19c-0.0014038,1.1040039-0.8959961,1.9985962-2,2H5c-1.1040039-0.0014038-1.9985962-0.8959961-2-2v-8h14V19z M17,10H3V9c0.0014038-1.1040039,0.8959961-1.9985962,2-2h10c1.1040039,0.0014038,1.9985962,0.8959961,2,2V10z M21,15c-0.0014038,1.1040039-0.8959961,1.9985962-2,2h-1V9c-0.0008545-0.7719116-0.3010864-1.4684448-0.7803345-2H21V15z M21,6H7V5c0.0014038-1.1040039,0.8959961-1.9985962,2-2h10c1.1040039,0.0014038,1.9985962,0.8959961,2,2V6z" />
                            </svg>
                            <span class="side-menu__label">Access Control</span><i class="fa-solid fa-angle-right"></i>
                        </a>
                        <ul class="slide-menu">
                            @can('index-module')
                                <li
                                    class="sub-slide {{ Request::routeIs('modules.index') ? 'is-expanded' : '' }}
                            {{ Request::routeIs('modules.trash') ? 'is-expanded' : '' }}">
                                    <a class="sub-side-menu__item {{ Request::routeIs('modules.index') ? 'active' : '' }}
                                {{ Request::routeIs('modules.trash') ? 'active' : '' }}"
                                        data-bs-toggle="sub-slide" href="#"><span class="sub-side-menu__label">Module
                                            Setting</span><i class="sub-angle fa fa-angle-right"></i></a>
                                    <ul class="sub-slide-menu">
                                        <li><a class="sub-slide-item {{ Request::routeIs('modules.index') ? 'active' : '' }}"
                                                href="{{ route('modules.index') }}">List</a></li>
                                        @can('delete-module')
                                            <li><a class="sub-slide-item {{ Request::routeIs('modules.trash') ? 'active' : '' }}"
                                                    href="{{ route('modules.trash') }}">Trash</a></li>
                                        @endcan
                                    </ul>
                                </li>
                            @endcan
                            @can('index-permission')
                                <li
                                    class="sub-slide {{ Request::routeIs('permissions.index') ? 'is-expanded' : '' }}
                        {{ Request::routeIs('permissions.trash') ? 'is-expanded' : '' }}">
                                    <a class="sub-side-menu__item {{ Request::routeIs('permissions.index') ? 'active' : '' }}
                        {{ Request::routeIs('permissions.trash') ? 'active' : '' }}"
                                        data-bs-toggle="sub-slide" href="#"><span class="sub-side-menu__label">Permission
                                            Setting</span><i class="sub-angle fa fa-angle-right"></i></a>
                                    <ul class="sub-slide-menu">
                                        <li><a class="sub-slide-item {{ Request::routeIs('permissions.index') ? 'active' : '' }}"
                                                href="{{ route('permissions.index') }}">List</a></li>
                                        @can('delete-permission')
                                            <li><a class="sub-slide-item {{ Request::routeIs('permissions.trash') ? 'active' : '' }}"
                                                    href="{{ route('permissions.trash') }}">Trash</a></li>
                                        @endcan
                                    </ul>
                                </li>
                            @endcan
                            @can('index-role')
                                <li
                                    class="sub-slide {{ Request::routeIs('roles.index') ? 'is-expanded' : '' }}
                        {{ Request::routeIs('roles.trash') ? 'is-expanded' : '' }}">
                                    <a class="sub-side-menu__item {{ Request::routeIs('roles.index') ? 'active' : '' }}
                        {{ Request::routeIs('roles.trash') ? 'active' : '' }}"
                                        data-bs-toggle="sub-slide" href="#"><span class="sub-side-menu__label">Role
                                            Setting</span><i class="sub-angle fa fa-angle-right"></i></a>
                                    <ul class="sub-slide-menu">
                                        <li><a class="sub-slide-item {{ Request::routeIs('roles.index') ? 'active' : '' }}"
                                                href="{{ route('roles.index') }}">List</a></li>
                                        @can('delete-role')
                                            <li><a class="sub-slide-item {{ Request::routeIs('roles.trash') ? 'active' : '' }}"
                                                    href="{{ route('roles.trash') }}">Trash</a></li>
                                        @endcan
                                    </ul>
                                </li>
                            @endcan
                            @can('index-user')
                                <li
                                    class="sub-slide {{ Request::routeIs('users.index') ? 'is-expanded' : '' }}
                        {{ Request::routeIs('users.trash') ? 'is-expanded' : '' }}">
                                    <a class="sub-side-menu__item {{ Request::routeIs('users.index') ? 'active' : '' }}
                        {{ Request::routeIs('users.trash') ? 'active' : '' }}"
                                        data-bs-toggle="sub-slide" href="#"><span class="sub-side-menu__label">User
                                            Setting</span><i class="sub-angle fa fa-angle-right"></i></a>
                                    <ul class="sub-slide-menu">
                                        <li><a class="sub-slide-item {{ Request::routeIs('users.index') ? 'active' : '' }}"
                                                href="{{ route('users.index') }}">List</a></li>
                                        @can('delete-user')
                                            <li><a class="sub-slide-item {{ Request::routeIs('users.trash') ? 'active' : '' }}"
                                                    href="{{ route('users.trash') }}">Trash</a></li>
                                        @endcan
                                    </ul>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                @can('index-about')
                    <li class="slide {{ Request::routeIs('about.index') ? 'is-expanded' : '' }}">
                        <a class="side-menu__item {{ Request::routeIs('about.index') ? 'active' : '' }}"
                            data-bs-toggle="slide" href="#">
                            <i class="fa-solid fa-user-pen"></i>
                            <span class="side-menu__label ms-3">About Us</span><i class="fa-solid fa-angle-right"></i></a>
                        <ul class="slide-menu">
                            <li><a href="{{ route('about.index') }}"
                                    class="slide-item {{ Request::routeIs('about.index') ? 'active' : '' }}">About Us
                                    Settings</a></li>
                        </ul>
                    </li>
                @endcan
                @can('index-product-category')
                    <li
                        class="slide {{ Request::routeIs('categories.index') ? 'is-expanded' : '' }}
                    {{ Request::routeIs('categories.trash') ? 'is-expanded' : '' }}">
                        <a class="side-menu__item {{ Request::routeIs('categories.index') ? 'active' : '' }}
                        {{ Request::routeIs('categories.trash') ? 'active' : '' }}"
                            data-bs-toggle="slide" href="#">
                            <i class="fa-solid fa-boxes-stacked"></i>
                            <span class="side-menu__label ms-3">Product Management</span><i class="fa-solid fa-angle-right"></i>
                        </a>
                        <ul class="slide-menu">
                            @can('index-product-category')
                                <li
                                    class="sub-slide {{ Request::routeIs('categories.index') ? 'is-expanded' : '' }}
                            {{ Request::routeIs('categories.trash') ? 'is-expanded' : '' }}">
                                    <a class="sub-side-menu__item {{ Request::routeIs('categories.index') ? 'active' : '' }}
                                {{ Request::routeIs('categories.trash') ? 'active' : '' }}"
                                        data-bs-toggle="sub-slide" href="#"><span class="sub-side-menu__label">Category
                                            Setting</span><i class="sub-angle fa fa-angle-right"></i></a>
                                    <ul class="sub-slide-menu">
                                        <li><a class="sub-slide-item {{ Request::routeIs('categories.index') ? 'active' : '' }}"
                                                href="{{ route('categories.index') }}">List</a></li>
                                        @can('delete-product-category')
                                            <li><a class="sub-slide-item {{ Request::routeIs('categories.trash') ? 'active' : '' }}"
                                                    href="{{ route('categories.trash') }}">Trash</a></li>
                                        @endcan
                                    </ul>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('index-service')
                    <li class="slide {{ Request::routeIs('services.index') ? 'is-expanded' : '' }}">
                        <a class="side-menu__item {{ Request::routeIs('services.index') ? 'active' : '' }}"
                            data-bs-toggle="slide" href="#">
                            <i class="fa-brands fa-servicestack"></i>
                            <span class="side-menu__label ms-3">Services</span><i class="fa-solid fa-angle-right"></i></a>
                        <ul class="slide-menu">
                            @can('index-service')
                                <li><a href="{{ route('services.index') }}"
                                        class="slide-item {{ Request::routeIs('services.index') ? 'active' : '' }}">Services
                                        Settings</a></li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('index-gallery-category')
                    <li
                        class="slide {{ Request::routeIs('photocategories.index') ? 'is-expanded' : '' }}
                    {{ Request::routeIs('photocategories.trash') ? 'is-expanded' : '' }}
                    {{ Request::routeIs('photogalleries.index') ? 'is-expanded' : '' }}
                    {{ Request::routeIs('photogalleries.trash') ? 'is-expanded' : '' }}
                    {{ Request::routeIs('videogalleries.index') ? 'is-expanded' : '' }}
                    {{ Request::routeIs('videogalleries.trash') ? 'is-expanded' : '' }}">
                        <a class="side-menu__item {{ Request::routeIs('photocategories.index') ? 'active' : '' }}
                        {{ Request::routeIs('photocategories.trash') ? 'active' : '' }}
                        {{ Request::routeIs('photogalleries.index') ? 'active' : '' }}
                        {{ Request::routeIs('photogalleries.trash') ? 'active' : '' }}
                        {{ Request::routeIs('videogalleries.index') ? 'active' : '' }}
                        {{ Request::routeIs('videogalleries.trash') ? 'active' : '' }}"
                            data-bs-toggle="slide" href="#">
                            <i class="fa-solid fa-table-cells"></i>
                            <span class="side-menu__label ms-3">Gallery</span><i class="fa-solid fa-angle-right"></i>
                        </a>
                        <ul class="slide-menu">
                            @can('index-gallery-category')
                                <li
                                    class="sub-slide {{ Request::routeIs('photocategories.index') ? 'is-expanded' : '' }}
                            {{ Request::routeIs('photocategories.trash') ? 'is-expanded' : '' }}">
                                    <a class="sub-side-menu__item {{ Request::routeIs('photocategories.index') ? 'active' : '' }}
                                {{ Request::routeIs('photocategories.trash') ? 'active' : '' }}"
                                        data-bs-toggle="sub-slide" href="#"><span class="sub-side-menu__label">Photo
                                            Category Setting</span><i class="sub-angle fa fa-angle-right"></i></a>
                                    <ul class="sub-slide-menu">
                                        <li><a class="sub-slide-item {{ Request::routeIs('photocategories.index') ? 'active' : '' }}"
                                                href="{{ route('photocategories.index') }}">List</a></li>
                                        @can('delete-gallery-category')
                                            <li><a class="sub-slide-item {{ Request::routeIs('photocategories.trash') ? 'active' : '' }}"
                                                    href="{{ route('photocategories.trash') }}">Trash</a></li>
                                        @endcan
                                    </ul>
                                </li>
                            @endcan
                            @can('index-photo-gallery')
                                <li
                                    class="sub-slide {{ Request::routeIs('photogalleries.index') ? 'is-expanded' : '' }}
                        {{ Request::routeIs('photogalleries.trash') ? 'is-expanded' : '' }}">
                                    <a class="sub-side-menu__item {{ Request::routeIs('photogalleries.index') ? 'active' : '' }}
                        {{ Request::routeIs('photogalleries.trash') ? 'active' : '' }}"
                                        data-bs-toggle="sub-slide" href="#"><span class="sub-side-menu__label">Photo
                                            Gallery Setting</span><i class="sub-angle fa fa-angle-right"></i></a>
                                    <ul class="sub-slide-menu">
                                        <li><a class="sub-slide-item {{ Request::routeIs('photogalleries.index') ? 'active' : '' }}"
                                                href="{{ route('photogalleries.index') }}">List</a></li>
                                        @can('delete-photo-gallery')
                                            <li><a class="sub-slide-item {{ Request::routeIs('photogalleries.trash') ? 'active' : '' }}"
                                                    href="{{ route('photogalleries.trash') }}">Trash</a></li>
                                        @endcan
                                    </ul>
                                </li>
                            @endcan
                            @can('index-video-gallery')
                                <li
                                    class="sub-slide {{ Request::routeIs('videogalleries.index') ? 'is-expanded' : '' }}
                        {{ Request::routeIs('videogalleries.trash') ? 'is-expanded' : '' }}">
                                    <a class="sub-side-menu__item {{ Request::routeIs('videogalleries.index') ? 'active' : '' }}
                        {{ Request::routeIs('videogalleries.trash') ? 'active' : '' }}"
                                        data-bs-toggle="sub-slide" href="#"><span class="sub-side-menu__label">Video
                                            Gallery Setting</span><i class="sub-angle fa fa-angle-right"></i></a>
                                    <ul class="sub-slide-menu">
                                        <li><a class="sub-slide-item {{ Request::routeIs('videogalleries.index') ? 'active' : '' }}"
                                                href="{{ route('videogalleries.index') }}">List</a></li>
                                        @can('delete-video-gallery')
                                            <li><a class="sub-slide-item {{ Request::routeIs('videogalleries.trash') ? 'active' : '' }}"
                                                    href="{{ route('videogalleries.trash') }}">Trash</a></li>
                                        @endcan
                                    </ul>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('index-testimonial')
                    <li
                        class="slide {{ Request::routeIs('testimonials.index') ? 'is-expanded' : '' }} {{ Request::routeIs('testimonials.trash') ? 'is-expanded' : '' }}">
                        <a class="side-menu__item {{ Request::routeIs('testimonials.index') ? 'active' : '' }} {{ Request::routeIs('testimonials.trash') ? 'active' : '' }}"
                            data-bs-toggle="slide" href="#">
                            <i class="fa-regular fa-comment-dots"></i>
                            <span class="side-menu__label ms-3">Testimonial Setting</span><i
                                class="fa-solid fa-angle-right"></i></a>
                        <ul class="slide-menu">
                            @can('index-testimonial')
                                <li><a href="{{ route('testimonials.index') }}"
                                        class="slide-item {{ Request::routeIs('testimonials.index') ? 'active' : '' }}">List</a>
                                </li>
                            @endcan
                            @can('delete-testimonial')
                                <li><a href="{{ route('testimonials.trash') }}"
                                        class="slide-item {{ Request::routeIs('testimonials.trash') ? 'active' : '' }}">Trash</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('index-blog')
                    <li
                        class="slide {{ Request::routeIs('postcategories.index') ? 'is-expanded' : '' }}
                    {{ Request::routeIs('postcategories.trash') ? 'is-expanded' : '' }}
                    {{ Request::routeIs('posts.index') ? 'is-expanded' : '' }}
                    {{ Request::routeIs('posts.trash') ? 'is-expanded' : '' }}">
                        <a class="side-menu__item {{ Request::routeIs('postcategories.index') ? 'active' : '' }}
                        {{ Request::routeIs('postcategories.trash') ? 'active' : '' }}
                        {{ Request::routeIs('posts.index') ? 'active' : '' }}
                        {{ Request::routeIs('posts.trash') ? 'active' : '' }}"
                            data-bs-toggle="slide" href="#">
                            <i class="fa-brands fa-blogger-b"></i>
                            <span class="side-menu__label ms-3">Blog</span><i class="fa-solid fa-angle-right"></i>
                        </a>
                        <ul class="slide-menu">
                            @can('index-post-category')
                                <li
                                    class="sub-slide {{ Request::routeIs('postcategories.index') ? 'is-expanded' : '' }}
                            {{ Request::routeIs('postcategories.trash') ? 'is-expanded' : '' }}">
                                    <a class="sub-side-menu__item {{ Request::routeIs('postcategories.index') ? 'active' : '' }}
                                {{ Request::routeIs('postcategories.trash') ? 'active' : '' }}"
                                        data-bs-toggle="sub-slide" href="#"><span class="sub-side-menu__label">Post
                                            Category Setting</span><i class="sub-angle fa fa-angle-right"></i></a>
                                    <ul class="sub-slide-menu">
                                        <li><a class="sub-slide-item {{ Request::routeIs('postcategories.index') ? 'active' : '' }}"
                                                href="{{ route('postcategories.index') }}">List</a></li>
                                        @can('delete-post-category')
                                            <li><a class="sub-slide-item {{ Request::routeIs('postcategories.trash') ? 'active' : '' }}"
                                                    href="{{ route('postcategories.trash') }}">Trash</a></li>
                                        @endcan
                                    </ul>
                                </li>
                            @endcan
                            @can('index-post')
                                <li
                                    class="sub-slide {{ Request::routeIs('posts.index') ? 'is-expanded' : '' }}
                        {{ Request::routeIs('posts.trash') ? 'is-expanded' : '' }}">
                                    <a class="sub-side-menu__item {{ Request::routeIs('posts.index') ? 'active' : '' }}
                        {{ Request::routeIs('posts.trash') ? 'active' : '' }}"
                                        data-bs-toggle="sub-slide" href="#"><span class="sub-side-menu__label">Post
                                            Setting</span><i class="sub-angle fa fa-angle-right"></i></a>
                                    <ul class="sub-slide-menu">
                                        <li><a class="sub-slide-item {{ Request::routeIs('posts.index') ? 'active' : '' }}"
                                                href="{{ route('posts.index') }}">List</a></li>
                                        @can('delete-post')
                                            <li><a class="sub-slide-item {{ Request::routeIs('posts.trash') ? 'active' : '' }}"
                                                    href="{{ route('posts.trash') }}">Trash</a></li>
                                        @endcan
                                    </ul>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                {{-- @can('index-order')
                    <li
                        class="slide {{ Request::routeIs('orders.index') ? 'is-expanded' : '' }} {{ Request::routeIs('orders.show') ? 'is-expanded' : '' }}">
                        <a class="side-menu__item {{ Request::routeIs('orders.index') ? 'active' : '' }} {{ Request::routeIs('orders.show') ? 'active' : '' }}"
                            data-bs-toggle="slide" href="#">
                            <i class="fa-solid fa-shopping-cart fa-fw"></i>
                            <span class="side-menu__label ms-3">Order Management</span><i
                                class="fa-solid fa-angle-right"></i></a>
                        <ul class="slide-menu">
                            @can('index-order')
                                <li><a href="{{ route('orders.index') }}"
                                        class="slide-item {{ Request::routeIs('orders.index') ? 'active' : '' }}">List</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan --}}
                @can('index-company-policy')
                    <li
                        class="slide {{ Request::routeIs('faqs.index') ? 'is-expanded' : '' }}
                    {{ Request::routeIs('faqs.trash') ? 'is-expanded' : '' }}
                    {{ Request::routeIs('posts.index') ? 'is-expanded' : '' }}
                    {{ Request::routeIs('posts.trash') ? 'is-expanded' : '' }}
                    {{ Request::routeIs('privacy_policy.index') ? 'is-expanded' : '' }}
                    {{ Request::routeIs('terms_and_conditions.index') ? 'is-expanded' : '' }}">
                        <a class="side-menu__item {{ Request::routeIs('faqs.index') ? 'active' : '' }}
                        {{ Request::routeIs('faqs.trash') ? 'active' : '' }}
                        {{ Request::routeIs('privacy_policy.index') ? 'active' : '' }}
                        {{ Request::routeIs('terms_and_conditions.index') ? 'active' : '' }}"
                            data-bs-toggle="slide" href="#">
                            <i class="fa-classic fa-solid fa-fan fa-fw"></i>
                            <span class="side-menu__label ms-3">Company Policy</span><i
                                class="fa-solid fa-angle-right"></i>
                        </a>
                        <ul class="slide-menu">
                            @can('index-faq')
                                <li
                                    class="sub-slide {{ Request::routeIs('faqs.index') ? 'is-expanded' : '' }}
                            {{ Request::routeIs('faqs.trash') ? 'is-expanded' : '' }}">
                                    <a class="sub-side-menu__item {{ Request::routeIs('faqs.index') ? 'active' : '' }}
                                {{ Request::routeIs('faqs.trash') ? 'active' : '' }}"
                                        data-bs-toggle="sub-slide" href="#"><span class="sub-side-menu__label">FAQ
                                            Setting</span><i class="sub-angle fa fa-angle-right"></i></a>
                                    <ul class="sub-slide-menu">
                                        <li><a class="sub-slide-item {{ Request::routeIs('faqs.index') ? 'active' : '' }}"
                                                href="{{ route('faqs.index') }}">List</a></li>
                                        @can('delete-faq')
                                            <li><a class="sub-slide-item {{ Request::routeIs('faqs.trash') ? 'active' : '' }}"
                                                    href="{{ route('faqs.trash') }}">Trash</a></li>
                                        @endcan
                                    </ul>
                                </li>
                            @endcan
                            @can('index-privacy')
                                <li><a class="slide-item {{ Request::routeIs('privacy_policy.index') ? 'active' : '' }}"
                                        href="{{ route('privacy_policy.index') }}">Privacy Policy Setting</a></li>
                            @endcan
                            @can('index-terms')
                                <li><a class="slide-item {{ Request::routeIs('terms_and_conditions.index') ? 'active' : '' }}"
                                        href="{{ route('terms_and_conditions.index') }}">Terms & Conditions Setting</a></li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('index-contact')
                    <li class="slide {{ Request::routeIs('contact.index') ? 'is-expanded' : '' }}">
                        <a class="side-menu__item {{ Request::routeIs('contact.index') ? 'active' : '' }}"
                            data-bs-toggle="slide" href="#">
                            <i class="fa-classic fa-solid fa-envelope fa-fw"></i>
                            <span class="side-menu__label ms-3">Contact</span><i class="fa-solid fa-angle-right"></i></a>
                        <ul class="slide-menu">
                            @can('index-contact')
                                <li><a href="{{ route('contact.index') }}"
                                        class="slide-item {{ Request::routeIs('contact.index') ? 'active' : '' }}">Contact
                                        Settings</a></li>
                            @endcan
                        </ul>
                    </li>
                @endcan
        </div>
    </div>
</div>
