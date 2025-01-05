@extends('frontend.layouts.master')

@section('title', $room->title)

@push('frontend_style')
@endpush

@section('frontend_content')
    <!-- Start Page Title Area -->
    <div class="page-title-area" style="background-image: url('{{ asset('assets/frontend/img/page-bg.jpg') }}')">
        <div class="container">
            <div class="page-title-content">
                <h2>{{ $room->title }}</h2>
                <ul>
                    <li>
                        <a href="{{ route('home') }}">
                            Home
                        </a>
                    </li>
                    <li>{{ $room->roomtype->title }}</li>
                    <li>{{ $room->title }}</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- End Page Title Area -->

    <!-- Start Room Details  Area -->
    <section class="service-details-area room-details-right-sidebar ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="service-details-wrap service-right">
                        <div class="service-img-wrap owl-carousel owl-theme mb-30">
                            @forelse ($room->roomImages as $roomImage)
                                <div class="single-services-imgs">
                                    <img src="{{ asset('uploads/rooms') }}/{{ $roomImage->multiple_image }}" alt="Image">
                                </div>
                            @empty
                                No Image Found
                            @endforelse
                        </div>
                        {!! $room->description !!}

                        <div class="ask-question">
                            <h3>Ask Questions</h3>
                            <form id="contactForm">
                                <div class="row">
                                    <div class="col-lg-6 col-sm-6">
                                        <div class="form-group">
                                            <input type="text" name="name" id="name" class="form-control"
                                                required data-error="Please enter your name" placeholder="Your Name">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-sm-6">
                                        <div class="form-group">
                                            <input type="email" name="email" id="email" class="form-control"
                                                required data-error="Please enter your email" placeholder="Your Email">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-sm-6">
                                        <div class="form-group">
                                            <input type="text" name="phone_number" id="phone_number" required
                                                data-error="Please enter your number" class="form-control"
                                                placeholder="Your Phone">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-sm-6">
                                        <div class="form-group">
                                            <input type="text" name="msg_subject" id="msg_subject" class="form-control"
                                                required data-error="Please enter your subject" placeholder="Your Subject">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <textarea name="message" class="form-control" id="message" cols="30" rows="5" required
                                                data-error="Write your message" placeholder="Your Message"></textarea>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12">
                                        <button type="submit" class="default-btn btn-two">
                                            <span class="label">
                                                Send Message
                                                <i class="flaticon-right"></i>
                                            </span>
                                        </button>
                                        <div id="msgSubmit" class="h3 text-center hidden"></div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="service-sidebar-area">
                        <div class="service-list service-card">
                            <h3 class="service-details-title">Facilities</h3>
                            <ul>
                                <li>
                                    {{ $room->roomtype->bed_type }}
                                    <i class='bx bx-check'></i>
                                </li>
                                <li>
                                    {{ $room->roomtype->occupancy }}
                                    <i class='bx bx-check'></i>
                                </li>
                                @if ($room->is_wifi == 1)
                                    <li>
                                        WiFi
                                        <i class='bx bx-check'></i>
                                    </li>
                                @endif
                                @if ($room->is_ac == 1)
                                    <li>
                                        AC
                                        <i class='bx bx-check'></i>
                                    </li>
                                @endif
                                @if ($room->is_tv == 1)
                                    <li>
                                        TV
                                        <i class='bx bx-check'></i>
                                    </li>
                                @endif
                                @if ($room->is_balcony == 1)
                                    <li>
                                        Balcony
                                        <i class='bx bx-check'></i>
                                    </li>
                                @endif
                                @if ($room->is_mini_fridge == 1)
                                    <li>
                                        Mini Fridge
                                        <i class='bx bx-check'></i>
                                    </li>
                                @endif
                                @if ($room->is_kitchenette == 1)
                                    <li>
                                        Kitchenette
                                        <i class='bx bx-check'></i>
                                    </li>
                                @endif
                                @if ($room->is_living_area == 1)
                                    <li>
                                        Living Area
                                        <i class='bx bx-check'></i>
                                    </li>
                                @endif
                            </ul>
                        </div>
                        <div class="service-faq service-card">
                            <h3 class="service-details-title">FAQ</h3>
                            <div class="faq-area">
                                <div class="questions-bg-area">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="faq-accordion">
                                                <ul class="accordion">
                                                    @foreach ($faqs as $index => $faq)
                                                        <li class="accordion-item">
                                                            <a class="accordion-title {{ $loop->first ? 'active' : '' }}" href="javascript:void(0)">
                                                                <i class='bx bx-chevron-down'></i>
                                                                {{ $faq->faq_question }}
                                                            </a>

                                                            <div class="accordion-content {{ $loop->first ? 'show' : '' }}">
                                                                <p>{{ $faq->faq_answer }}</p>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="service-list service-card">
                            <h3 class="service-details-title">Contact Info</h3>
                            <ul>
                                <li>
                                    <a href="tel:+8006036035">
                                        +800 603 6035
                                        <i class='bx bx-phone-call bx-rotate-270'></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="/cdn-cgi/l/email-protection#f199949d9d9eb194929e83989adf929e9c">
                                        <span class="__cf_email__"
                                            data-cfemail="650d0009090a2500060a170c0e4b060a08">[email&#160;protected]</span>
                                        <i class='bx bx-envelope'></i>
                                    </a>
                                </li>
                                <li>
                                    123, Western Road, Australia
                                    <i class='bx bx-location-plus'></i>
                                </li>
                                <li>
                                    9:00 AM – 8:00 PM
                                    <i class='bx bx-time'></i>
                                </li>
                            </ul>
                        </div>
                        <div class="service-list service-card">
                            <h3 class="service-details-title">Download Brochures</h3>
                            <ul>
                                <li>
                                    <a href="room-details-right-sidebar.html">
                                        PDF File (1)
                                        <i class='bx bxs-cloud-download'></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="room-details-right-sidebar.html">
                                        PDF File (2)
                                        <i class='bx bxs-cloud-download'></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="room-details-right-sidebar.html">
                                        PDF File (3)
                                        <i class='bx bxs-cloud-download'></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="room-details-right-sidebar.html">
                                        PDF File (4)
                                        <i class='bx bxs-cloud-download'></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Rooms Details Area -->
@endsection

@push('frontend_script')
@endpush
