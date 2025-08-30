<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
    <title>Barggee | @yield('title', 'Online Shopping In Bangladesh With Home Delivery')</title>
    <meta name="robots" content="all" />
    <meta name="keywords" content="Online Shopping In Bangladesh With Home Delivery" />
    <meta name="description" content="Online Shopping In Bangladesh With Home Delivery" />
    <meta property="og:url" content="https://barggee.com" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Barggee" />
    <meta property="og:description" content="Online Shopping In Bangladesh With Home Delivery" />
    <meta property="og:image" content="https://barggee.com/uploads/1c05f672-b9b0-4839-838c-fecb72237370/logo.png" />
    <meta property="og:image:secure_url" content="https://barggee.com/uploads/1c05f672-b9b0-4839-838c-fecb72237370/logo.png" />
    <meta property="og:description" content="Online Shopping In Bangladesh With Home Delivery" />
    <link rel="icon" href="https://barggee.com/uploads/1c05f672-b9b0-4839-838c-fecb72237370/favicon.png" sizes="192x192" />
    <link rel="apple-touch-icon" href="https://barggee.com/favicon.png" />
    
    <!-- Styles -->
    @include('frontend.layouts.include.style')
    
    <!-- Livewire Styles -->
    @livewireStyles
    
    <style>
        [wire\:loading][wire\:loading],
        [wire\:loading\.delay][wire\:loading\.delay],
        [wire\:loading\.inline-block][wire\:loading\.inline-block],
        [wire\:loading\.inline][wire\:loading\.inline],
        [wire\:loading\.block][wire\:loading\.block],
        [wire\:loading\.flex][wire\:loading\.flex],
        [wire\:loading\.table][wire\:loading\.table],
        [wire\:loading\.grid][wire\:loading\.grid],
        [wire\:loading\.inline-flex][wire\:loading\.inline-flex] {
            display: none;
        }

        [wire\:loading\.delay\.none][wire\:loading\.delay\.none],
        [wire\:loading\.delay\.shortest][wire\:loading\.delay\.shortest],
        [wire\:loading\.delay\.shorter][wire\:loading\.delay\.shorter],
        [wire\:loading\.delay\.short][wire\:loading\.delay\.short],
        [wire\:loading\.delay\.default][wire\:loading\.delay\.default],
        [wire\:loading\.delay\.long][wire\:loading\.delay\.long],
        [wire\:loading\.delay\.longer][wire\:loading\.delay\.longer],
        [wire\:loading\.delay\.longest][wire\:loading\.delay\.longest] {
            display: none;
        }

        [wire\:offline][wire\:offline] {
            display: none;
        }

        [wire\:dirty]:not(textarea):not(input):not(select) {
            display: none;
        }

        :root {
            --livewire-progress-bar-color: #2299dd;
        }

        [x-cloak] {
            display: none !important;
        }

        [wire\:cloak] {
            display: none !important;
        }
    </style>
    
    <style>
        :root {
            --primary: #ec741f;
            --primary-hover: red;
            --secondary: green;
            --secondary-hover: #9828c7;
            --text2: white;
            --text: black;
        }

        .btn-jump {
            animation: pulse 2000ms infinite;
            font-size: 1.5em;
        }

        @keyframes pulse {
            0% {
                transform: scale(.9);
            }
            50% {
                transform: scale(1.05);
            }
            100% {
                transform: scale(.8);
            }
        }
    </style>
    
    <script>
        ! function(f, b, e, v, n, t, s) {
            if (f.fbq) return;
            n = f.fbq = function() {
                n.callMethod ?
                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '481472354618096');
    </script>
    <noscript><img height='1' width='1' style='display:none'
            src='https://www.facebook.com/tr?id=481472354618096&ev=PageView&noscript=1' /></noscript>
            
    <style>
        /* First-level dropdown */
        .navbar-list li {
            position: relative;
        }

        .navbar-list .dropdown-position-list {
            display: none;
            position: absolute;
            top: 100%;
            /* below parent */
            left: 0;
            background: #fff;
            list-style: none;
            padding: 0;
            margin: 0;
            min-width: 200px;
            z-index: 999;
            border: 1px solid #ddd;
        }

        .navbar-list li:hover>.dropdown-position-list {
            display: block;
        }

        /* Second-level dropdown (grandchild) */
        .navbar-list .dropdown-position-list li {
            position: relative;
        }

        .navbar-list .dropdown-position-list li .dropdown-position-list {
            display: none;
            position: absolute;
            top: 0;
            /* align with parent */
            left: 100%;
            /* show to the right of parent */
            background: #fff;
            min-width: 200px;
            border: 1px solid #ddd;
        }

        .navbar-list .dropdown-position-list li:hover>.dropdown-position-list {
            display: block;
        }

        /* Optional styling */
        .navbar-list a {
            display: block;
            padding: 10px 15px;
            text-decoration: none;
        }

        .navbar-list a:hover {
            background: #f0f0f0;
        }
    </style>

</head>

<body>
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
    <section class="intro-part  d-none d-lg-block">
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