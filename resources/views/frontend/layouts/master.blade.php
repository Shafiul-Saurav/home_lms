<!DOCTYPE html>
<html lang="en">

<head>
    <!-- meta tags -->
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />

    <!-- title -->
    <title>Edubo - LMS And Education Course HTML5 Template</title>

    <!-- favicon -->
    <link rel="icon" type="image/x-icon" href="{{asset('assets/frontend')}}/img/logo/favicon.png" />

    <!-- css -->
    @include('frontend.layouts.include.style')
    @include('frontend.pages.common.style')
</head>

<body>
    <!-- preloader -->
    @include('frontend.layouts.include.preloader')
    <!-- preloader end -->

    <!-- header area -->
    @include('frontend.layouts.include.header')
    <!-- header area end -->

    <!-- popup search -->
    @include('frontend.layouts.include.search-popup')
    <!-- popup search end -->

    <!-- sidebar-popup -->
    @include('frontend.layouts.include.sidebar-popup')
    <!-- sidebar-popup end -->

    @yield('frontend_content')

    <!-- footer area -->
    @include('frontend.layouts.include.footer')
    <!-- footer area end -->

    <!-- scroll-top -->
    <a href="#" id="scroll-top"><i class="far fa-arrow-up"></i></a>
    <!-- scroll-top end -->

    <!-- footer language modal -->
    @include('frontend.layouts.include.footer_language_modal')
    <!-- footer language modal end -->

    <!-- js -->
    @include('frontend.layouts.include.script')
    @include('frontend.pages.common.script')
</body>

</html>
