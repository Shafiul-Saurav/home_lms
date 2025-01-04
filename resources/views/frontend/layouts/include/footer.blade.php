<footer class="footer-top-area pt-140 jarallax" style="background-image: url('{{ asset('assets/frontend/img/footer-bg.jpg') }}')">
    <div class="container">
        <div class="section-title">
            <h2>Subscribe newsletter</h2>
            <p>Newsletr dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut laboreonsectetur adipiscinet dolore.</p>
        </div>
        <div class="footer-tops-area pb-60">
            <div class="row">
                <!-- Start Subscribe Area -->
                <div class="subscribe-wrap">
                    <form class="newsletter-form" data-toggle="validator">
                        <input type="email" class="input-tracking" placeholder="Your Email" name="EMAIL" required autocomplete="off">

                        <button class="default-btn active" type="submit">
                                Subscribe
                                <i class="flaticon-right"></i>
                            </button>

                        <div id="validator-newsletter" class="form-result"></div>
                    </form>
                </div>
                <!-- End Subscribe Area -->
            </div>
        </div>
        <div class="footer-middle-area pt-60">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="single-widget">
                        <a href="index.html">
                                <img src="{{ asset($logo_fav->logo??null) }}" alt="Image" style="width: 80px; height: 80px;">
                            </a>
                        <p>{{ $copyright->description??null }}</p>
                        <ul class="social-icon">
                            <li>
                                <a href="{{ $website_link->facebook??null }}" target="_blank">
                                        <i class="bx bxl-facebook"></i>
                                    </a>
                            </li>
                            <li>
                                <a href="{{ $website_link->twitter??null }}" target="_blank">
                                        <i class="bx bxl-twitter"></i>
                                    </a>
                            </li>
                            <li>
                                <a href="{{ $website_link->linkedIn??null }}" target="_blank">
                                        <i class="bx bxl-linkedin"></i>
                                    </a>
                            </li>
                            <li>
                                <a href="{{ $website_link->instagram??null }}" target="_blank">
                                        <i class="bx bxl-instagram"></i>
                                    </a>
                            </li>
                            <li>
                                <a href="{{ $website_link->youtube??null }}" target="_blank">
                                        <i class="bx bxl-youtube"></i>
                                    </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="single-widget">
                        <h3>Quick Links</h3>
                        <ul>
                            <li>
                                <a href="service-style-one.html">
                                        <i class="right-icon bx bx-chevrons-right"></i>
                                        Big Data
                                    </a>
                            </li>
                            <li>
                                <a href="service-style-two.html">
                                        <i class="right-icon bx bx-chevrons-right"></i>
                                        Wellness
                                    </a>
                            </li>
                            <li>
                                <a href="gallery-masonry.html">
                                        <i class="right-icon bx bx-chevrons-right"></i>
                                        Spa Gallery
                                    </a>
                            </li>
                            <li>
                                <a href="about.html">
                                        <i class="right-icon bx bx-chevrons-right"></i>
                                        Reservation
                                    </a>
                            </li>
                            <li>
                                <a href="{{ route('faq.page') }}">
                                        <i class="right-icon bx bx-chevrons-right"></i>
                                        FAQ
                                    </a>
                            </li>
                            <li>
                                <a href="contact-style-one.html">
                                        <i class="right-icon bx bx-chevrons-right"></i>
                                        Contact
                                    </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="single-widget">
                        <h3>Services</h3>
                        <ul>
                            <li>
                                <a href="service-style-one.html">
                                        <i class="right-icon bx bx-chevrons-right"></i>
                                        Restaurant
                                    </a>
                            </li>
                            <li>
                                <a href="service-style-one.html">
                                        <i class="right-icon bx bx-chevrons-right"></i>
                                        Swimming Pool
                                    </a>
                            </li>
                            <li>
                                <a href="service-style-one.html">
                                        <i class="right-icon bx bx-chevrons-right"></i>
                                        Wellness & Spa
                                    </a>
                            </li>
                            <li>
                                <a href="service-style-one.html">
                                        <i class="right-icon bx bx-chevrons-right"></i>
                                        Conference Room
                                    </a>
                            </li>
                            <li>
                                <a href="service-style-one.html">
                                        <i class="right-icon bx bx-chevrons-right"></i>
                                        Events
                                    </a>
                            </li>
                            <li>
                                <a href="service-style-one.html">
                                        <i class="right-icon bx bx-chevrons-right"></i>
                                        Adult Room
                                    </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="single-widget">
                        <h3>Contact Info</h3>
                        <ul class="information">
                            <li class="address">
                                <i class="flaticon-maps-and-flags"></i>
                                <span>Address</span> {{ $website_link->address??null }}
                            </li>
                            <li class="address">
                                <i class="flaticon-call"></i>
                                <span>Phone</span>
                                <a href="tel:{{ $website_link->number??null }}">
                                        {{ $website_link->number??null }}
                                    </a>
                            </li>
                            <li class="address">
                                <i class="flaticon-envelope"></i>
                                <span>Email</span>
                                <a href="mailto:{{ $website_link->email??null }}">
                                    {{ $website_link->email??null }}
                                    </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom-area">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="copy-right designed">
                        <p>© All Rights Reserved By <i class='bx bx-heart'></i> <a style="margin-left: 3px;" href="https://envytheme.com/" target="_blank">{{ $copyright->title??null }}</a></p>
                    </div>
                </div>
                {{-- <div class="col-lg-6">
                    <div class="designed">
                        <p>Designed By <i class='bx bx-heart'></i> <a href="https://envytheme.com/" target="_blank">EnvyTheme</a></p>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
    <div class="footer-shape">
        <img src="{{asset('assets/frontend')}}/img/shape/white-shape-bottom.png" alt="Image">
    </div>
</footer>
