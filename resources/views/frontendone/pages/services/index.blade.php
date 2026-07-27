@extends('frontendone.layouts.master')

@section('title', 'Services - CyberBD')

@push('frontendone_style')
    @include('frontend.pages.common.style')
    <style>
        .service-info-card {
            border-radius: 24px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(229, 231, 235, 0.5);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .service-info-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 25px 55px rgba(0, 0, 0, 0.08);
        }

        .service-info-card .card-body {
            padding: 30px;
        }

        .service-info-icon {
            width: 80px;
            height: 80px;
            background: #e8f5e9;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 36px;
            color: #76bd10;
            flex-shrink: 0;
        }

        .service-info-icon i {
            font-size: 1.8rem;
        }

        .service-info-area {
            position: relative;
            z-index: 1;
        }

        .sidebar_fixed {
            position: relative;
        }

        .consultation-sidebar {
            background: #fff;
            border-radius: 28px;
            box-shadow: 0 18px 50px rgba(8, 15, 30, .08);
            padding: 10px;
        }

        @media (min-width: 992px) {
            .consultation-sidebar {
                position: -webkit-sticky;
                position: sticky;
                top: 110px;
                max-height: calc(100vh - 140px);
                overflow-y: auto;
                scroll-behavior: smooth;
            }
        }

        @media (max-width: 991px) {
            .consultation-sidebar {
                position: static;
            }
        }
    </style>
@endpush

@section('frontendone_content')
    <main class="main py-5 bg-light">
        <!-- breadcrumb -->
        {{-- <x-frontend.pages.common.breadcrumb :title="'Services'" :breadcrumb="[['name' => 'Home', 'url' => route('home')], ['name' => 'Services', 'url' => '#']]" /> --}}
        <!-- breadcrumb end -->

        <!-- Service Section -->
        @include('frontendone.pages.widgets.service_section', ['showConsultationBtn' => true])

        <!-- Services Grouped By Category -->
        <section class="section-padding" data-aos="fade-up">
            <div class="container">
                @foreach($serviceCategories as $category)
                    @if($category->servicetwos->isNotEmpty())
                        <div class="service-category-group mb-5">
                            <div class="section-heading text-center">
                                <span class="sub-title">
                                    <i class="fa-solid fa-layer-group"></i>
                                    {{ $category->title }}
                                </span>
                                <h2>{{ $category->title }} Services</h2>
                                <p>{{ $category->description ?? 'Browse all active services available in this category.' }}</p>
                            </div>
                            <div class="row g-4">
                                @foreach($category->servicetwos as $service)
                                    <div class="col-lg-6">
                                        <div class="service-grid-card">
                                            @if ($service->image && file_exists(public_path('uploads/servicetwos/' . $service->image)))
                                                <img src="{{ asset('uploads/servicetwos/' . $service->image) }}" alt="{{ $service->title }}">
                                            @else
                                                <img src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=700&q=80" alt="{{ $service->title }}">
                                            @endif
                                            <div class="service-grid-content">
                                                <h4>
                                                    @if ($service->service_icon && file_exists(public_path('uploads/servicetwos/' . $service->service_icon)))
                                                        <img src="{{ asset('uploads/servicetwos/' . $service->service_icon) }}" alt="" style="width: 24px; height: 24px; object-fit: contain; margin-right: 8px; vertical-align: middle;">
                                                    @endif
                                                    {{ $service->title }}
                                                </h4>
                                                <p>{{ \Illuminate\Support\Str::limit(strip_tags($service->description), 80, '...') }}</p>
                                                <a href="{{ route('service.details', ['id' => $service->id]) }}" class="">Get Support <i class="fa-solid fa-arrow-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </section>

        <div class="container">
            @php
                $howWeWorks = App\Models\Howwework::where('is_active', 1)->get();
                $whatYouGets = App\Models\Whatyouget::where('is_active', 1)->get();
            @endphp

            <section class="py-5 service-info-area" data-aos="fade-up">
                <div class="row gy-4">
                    <div class="col-12">
                        <div class="p-4">
                            <div class="section-heading">
                                <span class="sub-title">
                                    <i class="fa-solid fa-gears"></i>
                                    How We Work
                                </span>
                                <h2>Our Engagement Methodology</h2>
                                <p>
                                    Every HackToLive engagement follows a structured, transparent process from scoping to
                                    final
                                    sign-off.
                                </p>
                            </div>
                            <div class="row pb-5">
                                @forelse($howWeWorks as $item)
                                    <div class="col-md-6 col-lg-4">
                                        <div class="card service-info-card h-100">
                                            <div class="card-body">
                                                @php $howIcon = $item->service_icon ?: 'fa-solid fa-circle-check'; @endphp
                                                <div class="d-flex align-items-center gap-3 mb-3">
                                                    <div class="service-info-icon"><i class="{{ $howIcon }}"></i></div>
                                                    <h5 class="mb-0">{{ $item->title }}</h5>
                                                </div>
                                                <p class="text-muted" style="font-size: 14px;">{{ $item->description }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-12">
                                        <div class="alert alert-info mb-0">No active "How We Work" entries found.</div>
                                    </div>
                                @endforelse

                            </div>
                            <div class="row my-5">
                                <div class="col-12">
                                    <div class="section-heading">
                                        <span class="sub-title">
                                            <i class="fa-solid fa-award"></i>
                                            What You Get
                                        </span>
                                        <h2>What You Receive from Our Services</h2>
                                        <p>
                                            Discover the key benefits and outcomes included in every active service plan.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="row gy-4">
                                @forelse($whatYouGets as $item)
                                    <div class="col-md-6 col-lg-4">
                                        <div class="card service-info-card h-100">
                                            <div class="card-body">
                                                @php $whatIcon = $item->service_icon ?: 'fa-solid fa-circle-check'; @endphp
                                                <div class="d-flex align-items-center gap-3 mb-3">
                                                    <div class="service-info-icon"><i class="{{ $whatIcon }}"></i></div>
                                                    <h5 class="mb-0">{{ $item->title }}</h5>
                                                </div>
                                                <p class="text-muted" style="font-size: 14px;">{{ $item->description }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-12">
                                        <div class="alert alert-info mb-0">No active "What You Get" entries found.</div>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section data-aos="fade-up" id="start-consultation-section">
                <div class="row mt-5">
                    <div class="col-12">
                        <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between p-4 bg-white" style="border-radius: 24px; box-shadow: 0 15px 40px rgba(0,0,0,0.05);">
                            <div class="section-heading m-0 text-start">
                                <span class="sub-title" style="color: #76bd10;">
                                    <i class="fa-solid fa-headset"></i>
                                    Start Consultation
                                </span>
                                <h2>Need a tailored service proposal?</h2>
                                <p style="color: #4b5563;">
                                    Choose the service and share your project requirements with our team.
                                </p>
                            </div>
                            {{-- <div>
                                            <span class="sub-title mb-2 d-inline-block">
                                                <i class="fa-solid fa-headset"></i>
                                                Start Consultation
                                            </span>
                                            <h3 class="mb-1">Need a tailored service proposal?</h3>
                                            <p class="mb-0 text-muted">Choose the service and share your project requirements with our team.</p>
                                        </div> --}}
                            <button type="button" class="enroll-btn border-0 px-4 py-3 rounded-pill" data-bs-toggle="modal"
                                data-bs-target="#consultationModal">
                                <i class="fa-solid fa-comments"></i> Start Consultation
                            </button>
                        </div>
                    </div>
                </div>

            </section>

            @php
                $customerTestimonials = App\Models\Testimonial::with('user.profile.profileImage')
                    ->where('is_active', 1)
                    ->latest('id')
                    ->get();
            @endphp

            <section class="section-padding review-section" data-aos="fade-up">
                <div class="container">
                    <div class="section-heading text-center">
                        <span class="sub-title">
                            <i class="fa-solid fa-star"></i>
                            Testimonials
                        </span>
                        <h2>What Our Customers Say</h2>
                        <p>Hear from clients who trust us for enterprise-grade security services.</p>
                    </div>

                    <div class="review-carousel-wrap">
                        <div class="owl-carousel owl-theme review-carousel" id="service-review-list">
                            @forelse($customerTestimonials as $testimonial)
                                <div class="item">
                                    <div class="review-card">
                                        <div class="stars">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= (data_get($testimonial, 'rating', 0)))
                                                    <i class="fa-solid fa-star"></i>
                                                @else
                                                    <i class="fa-regular fa-star"></i>
                                                @endif
                                            @endfor
                                        </div>

                                        <p>{{ data_get($testimonial, 'review', '') }}</p>

                                        <div class="review-user">
                                            @php
                                                $avatar = data_get($testimonial, 'user.profile.profileImage.profile_image');
                                            @endphp
                                            <img src="{{ $avatar ? asset($avatar) : asset('assets/frontend/img/testimonial/images.png') }}"
                                                style="width: 45px; height:45px;" alt="">
                                            <div>
                                                <h5>{{ data_get($testimonial, 'user.name', data_get($testimonial, 'name', 'Anonymous')) }}</h5>
                                                <span>{{ data_get($testimonial, 'short_description') ?: 'Customer' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12 text-center py-5">
                                    <p class="text-muted">No customer reviews available yet.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </section>
        </div>

        @php
            $services = App\Models\Servicetwo::where('is_active', 1)->get();
            $timeslots = App\Models\ServiceConsultationTimeslot::where('is_active', 1)->get();
            $selectedServiceId = request('service_id');
        @endphp

        <div class="modal fade" id="consultationModal" tabindex="-1" aria-labelledby="consultationModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
                <div class="modal-content border-0 rounded-4 overflow-hidden">
                    <div class="modal-header border-0 pb-0">
                        <div>
                            <p class="mb-1 fw-bold" style="color: #76bd10;">Consultation Request</p>
                            <h5 class="modal-title" id="consultationModalLabel">Book a Consultation</h5>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body px-4 pb-4 pt-2">
                        @include(
                            'frontendone.pages.services.consultation_form',
                            compact('services', 'timeslots', 'selectedServiceId'))
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('frontendone_script')
    @include('frontend.pages.common.script')
@endpush
