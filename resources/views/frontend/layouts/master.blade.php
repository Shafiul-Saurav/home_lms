<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
    <title>@yield('title', $logo_fav->web_name ?? 'MeenaMart' . ' | Online Shopping In Bangladesh With Home Delivery')</title>
    
    <!-- Primary Meta Tags -->
    <meta name="robots" content="@yield('robots', 'all')" />
    <meta name="keywords" content="@yield('meta_keywords', 'Online Shopping, Bangladesh, Home Delivery, MeenaMart')" />
    <meta name="description" content="@yield('meta_description', 'Online Shopping In Bangladesh With Home Delivery')" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Canonical URL -->
    <link rel="canonical" href="@yield('canonical_url', url()->current())" />
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="@yield('og_type', 'website')" />
    <meta property="og:url" content="@yield('og_url', url()->current())" />
    <meta property="og:title" content="@yield('og_title', $logo_fav->web_name ?? 'MeenaMart')" />
    <meta property="og:description" content="@yield('og_description', 'Online Shopping In Bangladesh With Home Delivery')" />
    <meta property="og:image" content="@yield('og_image', asset($logo_fav->logo ?? 'uploads/logos/default.png'))" />
    <meta property="og:image:alt" content="@yield('og_image_alt', $logo_fav->web_name ?? 'MeenaMart')" />
    
    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="@yield('twitter_url', url()->current())">
    <meta property="twitter:title" content="@yield('twitter_title', $logo_fav->web_name ?? 'MeenaMart')">
    <meta property="twitter:description" content="@yield('twitter_description', 'Online Shopping In Bangladesh With Home Delivery')">
    <meta property="twitter:image" content="@yield('twitter_image', asset($logo_fav->logo ?? 'uploads/logos/default.png'))">
    
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon"
        href="{{ asset($logo_fav->favicon ?? 'uploads/favicons/default.png') }}" />
    <link rel="apple-touch-icon" href="{{ asset($logo_fav->favicon ?? 'uploads/favicons/default.png') }}" />
    
    <!-- Structured Data -->
    @hasSection('structured_data')
    <script type="application/ld+json">
        @yield('structured_data')
    </script>
    @endif
    
    <!-- Styles -->
    @include('frontend.layouts.include.style')

    <!-- Livewire Styles -->
    @livewireStyles

    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-MR3D333Z');</script>
    <!-- End Google Tag Manager -->

</head>

<body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MR3D333Z"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    
    <a class="backtop fas fa-arrow-up" href="#"></a>
    <div class="shadow-lg">
        <!-- Header -->
        @include('frontend.layouts.include.header')

        <!-- Navigation -->
        @include('frontend.layouts.include.navbar')
    </div>

    <!-- Mobile Sidebar -->
    @include('frontend.layouts.include.sidebar')

    <!-- Main Content -->
    @yield('frontend_content')

    <!-- Intro Section -->
    <section class="intro-part d-none d-lg-block">
        <div class="container">
            <div class="row intro-content">
                <div class="col-sm-6 col-lg-3">
                    <div class="intro-wrap">
                        <div class="intro-icon">
                            <i class="fas fa-thumbs-up"></i>
                        </div>
                        <div class="intro-content">
                            <h5>হাই-কোয়ালিটি পণ্য</h5>
                            <p>Enjoy top quality items for less</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="intro-wrap">
                        <div class="intro-icon">
                            <i class="fas fa-headset"></i>
                        </div>
                        <div class="intro-content">
                            <h5>24/7 লাইভ চ্যাট</h5>
                            <p>Get instant assistance whenever you need it</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="intro-wrap">
                        <div class="intro-icon">
                            <i class="fas fa-truck"></i>
                        </div>
                        <div class="intro-content">
                            <h5>এক্সপ্রেস শিপিং</h5>
                            <p>Fast & reliable delivery options</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="intro-wrap">
                        <div class="intro-icon">
                            <i class="fas fa-lock"></i>
                        </div>
                        <div class="intro-content">
                            <h5>সিকিউর পেমেন্ট</h5>
                            <p>Multiple safe payment methods</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    @include('frontend.layouts.include.footer')

    <!-- Scripts -->
    @include('frontend.layouts.include.script')

    @livewireScripts

    <script>
        window.addEventListener('swal:modal', event => {
            Swal.fire({
                title: event.detail.message ?? 'Product added to cart!',
                text: event.detail.text ?? '',
                icon: event.detail.type ?? 'success',
                timer: 800,
                showConfirmButton: false,
            });
        });
    </script>
</body>
</html>
