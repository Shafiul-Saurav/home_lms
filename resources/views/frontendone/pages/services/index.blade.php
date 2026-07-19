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
    <main class="main py-5">
        <!-- breadcrumb -->
        {{-- <x-frontend.pages.common.breadcrumb :title="'Services'" :breadcrumb="[['name' => 'Home', 'url' => route('home')], ['name' => 'Services', 'url' => '#']]" /> --}}
        <!-- breadcrumb end -->

        <!-- Service Section -->
        @include('frontendone.pages.widgets.service_section')

        <div class="container">
            @php
                $howWeWorks = App\Models\Howwework::where('is_active', 1)->get();
                $whatYouGets = App\Models\Whatyouget::where('is_active', 1)->get();
            @endphp

            <section class="py-5 service-info-area">
                <div class="row gy-4">
                    <div class="col-xl-8">
                        <div class="p-4" style="border-radius: 24px; box-shadow: 0 15px 40px rgba(0,0,0,0.05);">
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
                                                    <div class="fs-2 text-success"><i class="{{ $howIcon }}"></i></div>
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
                                                    <div class="fs-2 text-success"><i class="{{ $whatIcon }}"></i></div>
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
                    <div class="col-xl-4" id="sidebarCol">
                        <div class="consultation-sidebar">
                            <div class="mb-5">
                                {{-- <div class="row">
                                <div class="col-12"> --}}
                                @php
                                    $services = App\Models\Servicetwo::where('is_active', 1)->get();
                                    $timeslots = App\Models\ServiceConsultationTimeslot::where('is_active', 1)->get();
                                    $selectedServiceId = request('service_id');
                                @endphp
                                @include(
                                    'frontendone.pages.services.consultation_form',
                                    compact('services', 'timeslots', 'selectedServiceId'))
                                {{-- </div>
                            </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            @php
                $studentReviews = App\Models\CourseReview::with('user.profile.profileImage')
                    ->where('is_approved', 1)
                    ->latest('id')
                    ->get()
                    ->map(function ($review) {
                        return (object) [
                            'rating' => (int) ($review->rating ?? 5),
                            'review' => data_get($review, 'comment', ''),
                            'short_description' => $review->short_description,
                            'user' => $review->user,
                            'name' => $review->user?->name ?? 'Anonymous',
                        ];
                    });
            @endphp

            <section class="section-padding">
                <div class="container px-0">
                    <div class="section-heading text-center">
                        <span class="sub-title">
                            <i class="fa-solid fa-star"></i>
                            Student Reviews
                        </span>
                        <h2>What Our Students Say</h2>
                        <p>Hear from students who built practical cyber security skills through our training programs.</p>
                    </div>

                    <div class="review-carousel-wrap">
                        <div class="owl-carousel owl-theme review-carousel" id="review-list">
                            @forelse($studentReviews as $testimonial)
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
                                            <img src="{{ $avatar ? asset($avatar) : asset('assets/frontend/img/testimonial/images.png') }}" style="width: 45px; height:45px;" alt="">
                                            <div>
                                                <h5>{{ data_get($testimonial, 'user.name', data_get($testimonial, 'name', 'Anonymous')) }}</h5>
                                                <span>{{ data_get($testimonial, 'short_description') ?: 'Student' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12 text-center py-5">
                                    <p class="text-muted">No student reviews available yet.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </section>
        </div>

    </main>
@endsection

@push('frontendone_script')
    @include('frontend.pages.common.script')
@endpush
