@extends('frontend.layouts.master')

@section('title', 'Contact')

@push('frontend_style')
@endpush

@section('frontend_content')
    <main class="main">
        <!-- breadcrumb -->
        <x-frontend.pages.common.breadcrumb :title="'Contact Us'" :breadcrumb="[['name' => 'Home', 'url' => route('home')], ['name' => 'Contact Us', 'url' => '#']]" />
        <!-- breadcrumb end -->

        <!-- contact area -->
        <div class="contact-area pt-120 pb-100">
            <div class="container">
                <div class="contact-content pb-80">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="contact-info">
                                <div class="icon">
                                    <i class="fas fa-map-marked-alt"></i>
                                </div>
                                <div class="content">
                                    <h5>Office Address</h5>
                                    <p>{{ $website_link->address ?? '25/B Milford, New York, USA' }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="contact-info">
                                <div class="icon">
                                    <i class="fas fa-phone-volume"></i>
                                </div>
                                <div class="content">
                                    <h5>Call Us</h5>
                                    <p>{{ $website_link->number ?? '+2 123 4565 789' }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="contact-info">
                                <div class="icon">
                                    <i class="fas fa-envelope-open-text"></i>
                                </div>
                                <div class="content">
                                    <h5>Email Us</h5>
                                    <p>{{ $website_link->email ?? 'info@example.com' }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="contact-info">
                                <div class="icon">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <div class="content">
                                    <h5>Open Time</h5>
                                    <p>Mon - Sat (10.00AM - 05.30PM)</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="contact-form-wrap">
                    <div class="row g-4">
                        <div class="col-lg-5">
                            <div class="contact-img">
                                <img src="{{ asset('assets/frontend') }}/img/contact/01.webp" alt="" />
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="contact-form">
                                <div class="contact-form-header">
                                    <h2>Get In Touch</h2>
                                    <p>
                                        It is a long established fact that a reader will be distracted by the readable
                                        content of a page randomised words
                                        which don't look even slightly when looking at its layout.
                                    </p>
                                </div>
                                <div class="form-message">
                                    @if(session('message'))
                                        <div class="alert alert-success">{{ session('message') }}</div>
                                    @endif
                                </div>
                                <form method="post" action="{{ route('contacts.store') }}" id="contact-form">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="form-icon">
                                                    <i class="far fa-user-tie"></i>
                                                    <input type="text" class="form-control" name="name"
                                                        placeholder="Your Name" required />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="form-icon">
                                                    <i class="far fa-envelope"></i>
                                                    <input type="email" class="form-control" name="email"
                                                        placeholder="Your Email" required />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="form-icon">
                                                    <i class="far fa-phone"></i>
                                                    <input type="number" class="form-control" name="phone"
                                                        placeholder="Your Phone" required />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="form-icon">
                                                    <i class="far fa-pen"></i>
                                                    <input type="text" class="form-control" name="subject"
                                                        placeholder="Your Subject" required />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-icon">
                                            <i class="fas fa-comments"></i>
                                            <textarea name="message" cols="30" rows="5" class="form-control" placeholder="Write Your Message" required></textarea>
                                        </div>
                                    </div>
                                    <button type="submit" class="theme-btn">Send Message <i
                                            class="far fa-paper-plane"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end contact area -->

        <!-- map -->
        <div class="contact-map pb-120">
            <div class="container">
                @if($website_link->map_link && str_contains($website_link->map_link, '<iframe'))
                    {!! $website_link->map_link !!}
                @else
                    <p>Map not available.</p>
                @endif
            </div>
        </div>
        <!-- map end -->


    </main>
@endsection

@push('frontend_script')
@endpush
