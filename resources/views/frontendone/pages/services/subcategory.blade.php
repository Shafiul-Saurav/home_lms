@extends('frontendone.layouts.master')

@section('title', $subcategory->name . ' - Services')

@push('frontendone_style')
    @include('frontend.pages.common.style')
@endpush

@section('frontendone_content')
    <main class="main" data-aos="fade-up">
        <!-- breadcrumb -->
        <x-frontend.pages.common.breadcrumb :title="$subcategory->name" :breadcrumb="[
            ['name' => 'Home', 'url' => route('home')],
            ['name' => 'Services', 'url' => '#'],
            ['name' => $subcategory->category->title, 'url' => route('service.category', $subcategory->category->id)],
            ['name' => $subcategory->name, 'url' => '#'],
        ]" />
        <!-- breadcrumb end -->

        <div class="service-area py-5">
            <div class="container">
                <div class="row mb-4">
                    <div class="col-lg-8 mx-auto">
                        <div class="site-heading text-center wow fadeInDown" data-wow-delay=".25s">
                            <h2 class="site-title">{{ $subcategory->name }}</h2>
                            <p class="text-muted">{{ $subcategory->category->title }}</p>
                        </div>
                    </div>
                </div>

                <div class="row g-4">
                    @forelse($services as $service)
                        <div class="col-lg-6">
                            <div class="service-grid-card">
                                @if ($service->image && file_exists(public_path('uploads/servicetwos/' . $service->image)))
                                    <img src="{{ asset('uploads/servicetwos/' . $service->image) }}"
                                        alt="{{ $service->title }}" style="width: 100%; height: 300px; object-fit: cover;">
                                @else
                                    <img src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=700&q=80"
                                        alt="{{ $service->title }}" style="width: 100%; height: 300px; object-fit: cover;">
                                @endif
                                <div class="service-grid-content">
                                    <h4>
                                        @if ($service->service_icon && file_exists(public_path('uploads/servicetwos/' . $service->service_icon)))
                                            <img src="{{ asset('uploads/servicetwos/' . $service->service_icon) }}"
                                                alt=""
                                                style="width: 24px; height: 24px; object-fit: contain; margin-right: 8px; vertical-align: middle;">
                                        @endif
                                        {{ $service->title }}
                                    </h4>
                                    <p>{!! $service->description !!}</p>
                                    <a href="{{ route('service.details', ['id' => $service->id]) }}" class="">Get Support <i class="fa-solid fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="alert alert-info text-center" role="alert">
                                <i class="fa-solid fa-info-circle"></i> No services available in this subcategory.
                            </div>
                        </div>
                    @endforelse
                </div>

                <div class="row mt-5">
                    <div class="col-12">
                        <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3 p-4 border rounded-4 bg-light">
                            <div class="section-heading m-0 text-start" style="color: #76bd10;">
                                <span class="sub-title" style="color: #76bd10;">
                                    <i class="fa-solid fa-headset"></i>
                                    Start Consultation
                                </span>
                                <h2 style="color: #76bd10;">Need a tailored service proposal?</h2>
                                <p style="color: #4b5563;">
                                    Choose the service and share your project requirements with our team.
                                </p>
                            </div>
                            <button type="button" class="enroll-btn border-0 px-4 py-3 rounded-pill" data-bs-toggle="modal" data-bs-target="#consultationModal">
                                <i class="fa-solid fa-comments"></i> Start Consultation
                            </button>
                        </div>
                    </div>
                </div>

                @php
                    $timeslots = App\Models\ServiceConsultationTimeslot::where('is_active', 1)->get();
                @endphp

                <div class="modal fade" id="consultationModal" tabindex="-1" aria-labelledby="consultationModalLabel" aria-hidden="true">
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
                                @include('frontendone.pages.services.consultation_form', [
                                    'services' => $services,
                                    'timeslots' => $timeslots,
                                ])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('frontendone_script')
    @include('frontend.pages.common.script')
@endpush
