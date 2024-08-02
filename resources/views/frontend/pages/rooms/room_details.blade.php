@extends('frontend.layouts.master')

@section('title', 'Rooms')

@push('frontend_style')

@endpush

@section('frontend_content')
<!-- Start Page Title Area -->
<div class="page-title-area" style="background-image: url('{{ asset('assets/frontend/img/page-bg.jpg') }}')">
    <div class="container">
        <div class="page-title-content">
            <h2>Rooms</h2>
            <ul>
                <li>
                    <a href="index.html">
                        Home
                    </a>
                </li>
                <li>Pages</li>
                <li>Rooms</li>
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
                        <div class="single-services-imgs">
                            <img src="{{asset('assets/frontend')}}/img/services-details/1.jpg" alt="Image">
                        </div>
                        <div class="single-services-imgs">
                            <img src="{{asset('assets/frontend')}}/img/services-details/2.jpg" alt="Image">
                        </div>
                        <div class="single-services-imgs">
                            <img src="{{asset('assets/frontend')}}/img/services-details/3.jpg" alt="Image">
                        </div>
                        <div class="single-services-imgs">
                            <img src="{{asset('assets/frontend')}}/img/services-details/4.jpg" alt="Image">
                        </div>
                    </div>
                    <h3>The charming view of the city</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quas veritatis ducimus rerum sunt dignissimos libero et eum modi! Consequuntur rem incidunt et ducimus magnam sunt rerum hic beatae sed obcaecati. Lorem ipsum dolor sit amet consectetur, adipisicing elit. Laudantium asperiores eos obcaecati nostrum sed, corporis placeat quasi pariatur id, est iure, minus.</p>

                    <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words.</p>

                    <p class="mb-30">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem, you to be sure there.</p>
                    <div class="rooms-details mb-30">
                        <img src="{{asset('assets/frontend')}}/img/rooms/rooms-1.jpg" alt="Image">
                    </div>

                    <p class="mb-30">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Odit veritatis repellendus magnam tempora quibusdam dignissimos ab hic autem, dolore facere, soluta excepturi neque necessitatibus qui tenetur, ipsa quaerat nostrum eveniet? Lorem ipsum, dolor sit amet consectetur adipisicing elit. Odit veritatis repellendus magnam tempora quibusdam dignissimos ab hic autem, dolore facere, soluta excepturi neque necessitatibus qui tenetur, ipsa quaerat nostrum eveniet?</p>

                    <div class="ask-question">
                        <h3>Ask Questions</h3>
                        <form id="contactForm">
                            <div class="row">
                                <div class="col-lg-6 col-sm-6">
                                    <div class="form-group">
                                        <input type="text" name="name" id="name" class="form-control" required data-error="Please enter your name" placeholder="Your Name">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-sm-6">
                                    <div class="form-group">
                                        <input type="email" name="email" id="email" class="form-control" required data-error="Please enter your email" placeholder="Your Email">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-sm-6">
                                    <div class="form-group">
                                        <input type="text" name="phone_number" id="phone_number" required data-error="Please enter your number" class="form-control" placeholder="Your Phone">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-sm-6">
                                    <div class="form-group">
                                        <input type="text" name="msg_subject" id="msg_subject" class="form-control" required data-error="Please enter your subject" placeholder="Your Subject">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <textarea name="message" class="form-control" id="message" cols="30" rows="5" required data-error="Write your message" placeholder="Your Message"></textarea>
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
                                Luxury Room
                                <i class='bx bx-check'></i>
                            </li>
                            <li>
                                Tips
                                <i class='bx bx-check'></i>
                            </li>
                            <li>
                                Budget Room
                                <i class='bx bx-check'></i>
                            </li>
                            <li>
                                Ecorik
                                <i class='bx bx-check'></i>
                            </li>
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
                                                <li class="accordion-item">
                                                    <a class="accordion-title active" href="javascript:void(0)">
                                                        <i class='bx bx-chevron-down'></i>
                                                        Is Reception Open 24 Hours?
                                                    </a>
                                                    <p class="accordion-content show">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quis deleniti nisi necessitatibus, dolores voluptates quam blanditiis fugiat doloremque? Excepturi, minus rem error aut necessitatibus quasi voluptates assumenda ipsum provident tenetur? Lorem.</p>
                                                </li>
                                                <li class="accordion-item">
                                                    <a class="accordion-title" href="javascript:void(0)">
                                                        <i class='bx bx-chevron-down'></i>
                                                        Can I Leave My Luggage?
                                                    </a>
                                                    <p class="accordion-content">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quis deleniti nisi necessitatibus, dolores voluptates quam blanditiis fugiat doloremque? Excepturi, minus rem error aut necessitatibus quasi voluptates assumenda ipsum provident tenetur? Lorem.</p>
                                                </li>
                                                <li class="accordion-item">
                                                    <a class="accordion-title" href="javascript:void(0)">
                                                        <i class='bx bx-chevron-down'></i>
                                                        Which One Is The Nearest Airport?
                                                    </a>
                                                    <p class="accordion-content">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quis deleniti nisi necessitatibus, dolores voluptates quam blanditiis fugiat doloremque? Excepturi, minus rem error aut necessitatibus quasi voluptates assumenda ipsum provident tenetur? Lorem.</p>
                                                </li>
                                                <li class="accordion-item">
                                                    <a class="accordion-title" href="javascript:void(0)">
                                                        <i class='bx bx-chevron-down'></i>
                                                        Can I Rent A Car At The Hotel Nearby?
                                                    </a>
                                                    <p class="accordion-content">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quis deleniti nisi necessitatibus, dolores voluptates quam blanditiis fugiat doloremque? Excepturi, minus rem error aut necessitatibus quasi voluptates assumenda ipsum provident tenetur? Lorem.</p>
                                                </li>
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
                                    <span class="__cf_email__" data-cfemail="650d0009090a2500060a170c0e4b060a08">[email&#160;protected]</span>
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
