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
    <div class="modal footer-lang-modal animated pulse" id="langModal" tabindex="-1" aria-labelledby="langModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
            <i class="far fa-xmark"></i>
          </button>
                <div class="modal-body">
                    <div class="lang-content">
                        <h4 class="modal-title" id="langModalLabel">Choose Your Language</h4>
                        <div class="lang-list">
                            <div class="row row-cols-2 row-cols-lg-3 g-2">
                                <a href="#">Arabic</a>
                                <a href="#">English</a>
                                <a href="#">Spanish</a>
                                <a href="#">German</a>
                                <a href="#">Portuguese</a>
                                <a href="#">Italian</a>
                                <a href="#">Japanese</a>
                                <a href="#">Chinese</a>
                                <a href="#">Swedish</a>
                                <a href="#">Turkish</a>
                                <a href="#">Czech</a>
                                <a href="#">Danish</a>
                                <a href="#">Greek</a>
                                <a href="#">Icelandic</a>
                                <a href="#">Irish</a>
                                <a href="#">Russian</a>
                                <a href="#">Korean</a>
                                <a href="#">Romanian</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- footer language modal end -->

    <!-- js -->
    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="{{asset('assets/frontend')}}/js/jquery-3.7.1.min.js"></script>
    <script src="{{asset('assets/frontend')}}/js/modernizr.min.js"></script>
    <script src="{{asset('assets/frontend')}}/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('assets/frontend')}}/js/imagesloaded.pkgd.min.js"></script>
    <script src="{{asset('assets/frontend')}}/js/jquery.magnific-popup.min.js"></script>
    <script src="{{asset('assets/frontend')}}/js/isotope.pkgd.min.js"></script>
    <script src="{{asset('assets/frontend')}}/js/jquery.appear.min.js"></script>
    <script src="{{asset('assets/frontend')}}/js/jquery.easing.min.js"></script>
    <script src="{{asset('assets/frontend')}}/js/owl.carousel.min.js"></script>
    <script src="{{asset('assets/frontend')}}/js/counter-up.js"></script>
    <script src="{{asset('assets/frontend')}}/js/jquery.nice-select.min.js"></script>
    <script src="{{asset('assets/frontend')}}/js/wow.min.js"></script>
    <script src="{{asset('assets/frontend')}}/js/main.js"></script>
    <script defer src="https://static.cloudflareinsights.com/beacon.min.js/vcd15cbe7772f49c399c6a5babf22c1241717689176015" integrity="sha512-ZpsOmlRQV6y907TI0dKBHq9Md29nnaEIPlkf84rnaERnq6zvWvPUqr2ft8M1aS28oN72PdrCzSjY4U6VaAw1EQ==" data-cf-beacon='{"version":"2024.11.0","token":"1190e059c5bc497bafd35e121aae37b1","r":1,"server_timing":{"name":{"cfCacheStatus":true,"cfEdge":true,"cfExtPri":true,"cfL4":true,"cfOrigin":true,"cfSpeedBrain":true},"location_startswith":null}}'
        crossorigin="anonymous"></script>
</body>

</html>
