@extends('frontend.layouts.master')

@section('title', 'Contacts')

@push('frontend_style')
    @include('frontend.pages.common.style')
@endpush

@section('frontend_content')
    <!-- Start Page Title Area -->
    <div class="page-title-area" style="background-image: url('{{ asset('assets/frontend/img/page-bg.jpg') }}')">
        <div class="container">
            <div class="page-title-content">
                <h2>{{ __('Contacts') }}</h2>
                <ul>
                    <li>
                        <a href="{{ route('home') }}">
                            Home
                        </a>
                    </li>
                    <li>{{ __('Contacts') }}</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- End Page Title Area -->

    <!-- Start Contact Info Area -->
    <section class="contact-info-area pt-100 pb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <div class="single-contact-info">
                        <i class="bx bx-envelope"></i>
                        <h3>Email Us:</h3>
                        <a href="/cdn-cgi/l/email-protection#0e666b6262614e6b6d617c6765206d6163"><span class="__cf_email__" data-cfemail="1179747d7d7e5174727e63787a3f727e7c">[email&#160;protected]</span></a>
                        <a href="/cdn-cgi/l/email-protection#335a5d555c7356505c415a581d505c5e"><span class="__cf_email__" data-cfemail="91f8fff7fed1f4f2fee3f8fabff2fefc">[email&#160;protected]</span></a>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="single-contact-info">
                        <i class="bx bx-phone-call"></i>
                        <h3>Call Us:</h3>
                        <a href="tel:+(123)1800-567-8990">Tel. + (123) 1800-567-8990</a>
                        <a href="tel:+(124)1523-567-9874">Tel. + (124) 1523-567-9874</a>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="single-contact-info">
                        <i class="bx bx-location-plus"></i>
                        <h3>Location</h3>
                        <a href="contact-style-one.html">205 Fida Walinton, Tongo Street Front The USA</a>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="single-contact-info">
                        <i class="bx bx-phone-call"></i>
                        <h3>Call Us:</h3>
                        <a href="tel:+(123)1800-567-8990">Tel. + (123) 1800-567-8990</a>
                        <a href="tel:+(124)1523-567-9874">Tel. + (124) 1523-567-9874</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Contact Info Area -->

    <!-- Start Contact Area -->
    <section class="main-contact-area contact-info-area contact-info-three pt-100 pb-70">
        <div class="container">
            <div class="section-title">
                <span>Contact Us</span>
                <h2>Drop us a message for any query</h2>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Eaque quibusdam deleniti porro praesentium. Aliquam minus quisquam velit in at nam.</p>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="contact-wrap contact-pages">
                        <div class="contact-form contact-form-mb">
                            <form action="{{ route('contact.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6 col-sm-6">
                                        <div class="form-group">
                                            <input type="text" name="name" id="name" class="form-control
                                            @error('name')
                                                is-invalid
                                            @enderror" required data-error="Please enter your name" placeholder="Your Name">
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-sm-6">
                                        <div class="form-group">
                                            <input type="email" name="email" id="email" class="form-control
                                            @error('email')
                                                is-invalid
                                            @enderror" placeholder="Your Email">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-sm-6">
                                        <div class="form-group">
                                            <input type="tel" name="phone" id="phone" class="form-control @error('phone')
                                                is-invalid
                                            @enderror" placeholder="Your Phone">
                                            @error('phone')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-sm-6">
                                        <div class="form-group">
                                            <input type="text" name="subject" id="subject" class="form-control
                                            @error('subject')
                                                is-invalid
                                            @enderror" placeholder="Your Subject">
                                            @error('subject')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <textarea name="message" class="form-control textarea-hight
                                            @error('message')
                                                is-invalid
                                            @enderror" id="message" cols="30" rows="4" placeholder="Your Message"></textarea>
                                            @error('message')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12">
                                        <button type="submit" class="default-btn btn-two">
                                            Send Message
                                            <i class="flaticon-right"></i>
                                        </button>
                                        <div id="msgSubmit" class="h3 text-center hidden"></div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="map-area">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d193595.15830869428!2d-74.119763973046!3d40.69766374874431!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew%20York%2C%20NY%2C%20USA!5e0!3m2!1sen!2sbd!4v1608494047082!5m2!1sen!2sbd"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Contact Area -->

@endsection

@push('frontend_script')
    @include('frontend.pages.common.script')
@endpush
