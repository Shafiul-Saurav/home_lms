<!DOCTYPE html>
<html lang="zxx">

<head>
    @php
        $logo_fav = App\Models\LogoFavicon::first();
        $copyright = App\Models\Copyright::first();
        $website_link = App\Models\WebsiteLink::first();
    @endphp
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- style -->
    @include('frontend.layouts.include.style')
    <!-- /style -->

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{asset('assets/frontend')}}/img/favicon.png">

    <!-- TITLE -->
    <title>Ecorik | @yield('title') </title>

    @livewireStyles
</head>

<body>
    <!-- Start Preloader Area -->
    @include('frontend.layouts.include.preloader')
    <!-- End Preloader Area -->

    <!-- Start Ecorik Navbar Area -->
    @include('frontend.layouts.include.navbar')
    <!-- End Ecorik Navbar Area -->

    <!-- Start Sidebar Modal -->
    @include('frontend.layouts.include.sidebar_modal')
    <!-- End Sidebar Modal -->

    @yield('frontend_content')

    <!-- Start Footer Area -->
    @include('frontend.layouts.include.footer')
    <!-- End Footer Area -->

    <!-- Start Go Top Area -->
    <div class="go-top">
        <i class='bx bx-chevrons-up bx-fade-up'></i>
        <i class='bx bx-chevrons-up bx-fade-up'></i>
    </div>
    <!-- End Go Top Area -->


    <!-- SCRIPT -->
    @include('frontend.layouts.include.script')
    <!-- /SCRIPT -->

    @livewireScripts
</body>

</html>
