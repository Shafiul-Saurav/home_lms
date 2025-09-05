<footer class="footer-part">
    <div class="container  d-block">
        <div class="row">
            <div class="col-sm-6 col-xl-3">
                <div class="footer-widget">
                    <a class="footer-logo" href="{{ route('home') }}"><img loading="lazy" src="{{ asset($logo_fav->logo?? null) }}" alt="logo" class="w-50"></a>
                    <p class="footer-desc">
                        {{ $logo_fav->web_name ?? null }} | Online Shopping In Bangladesh With Home Delivery
                    </p>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="footer-widget contact">
                    <h3 class="footer-title">contact us</h3>
                    <ul class="footer-contact">
                        <li>
                            <i class="fas fa-envelope"></i>
                            <p>
                                <span>{{ $website_link->email ?? null }}</span>
                            </p>
                        </li>
                        <li>
                            <i class="fas fa-phone"></i>
                            <p>
                                <span>{{ $website_link->number ?? null }}</span>
                            </p>
                        </li>
                        <li>
                            <i class="fas fa-map"></i>
                            <p><span>{{ $website_link->address ?? null }}</span></p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="footer-widget contact d-none d-lg-block">
                    <h3 class="footer-title">quick Links</h3>
                    <div class="footer-links">
                        <ul>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="footer-widget">
                    <h3 class="footer-title">Our Social Page</h3>
                    <ul class="footer-social">
                        <li> <a href="#"><i class="fab fa-facebook"></i> </a></li>
                        <li> <a href="#"><i class="fab fa-instagram"></i></a></li>
                        <li> <a href="#"><i class="fab fa-twitter"></i></a></li>
                        <li> <a href="#"><i class="fab fa-youtube"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-12">
            <div class="p-2 bg-primary text-center">
                <p class="footer-copytext">
                    All Rights Reserved {{ $logo_fav->web_name ?? null }} 2024 <span class="copy-tj"> | Designed and Developed by <a href="" target="_blank">Shaftech</a></span>
                </p>
            </div>
        </div>
    </div>
</footer>
