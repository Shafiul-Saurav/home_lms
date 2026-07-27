@extends('frontendone.layouts.master')

@section('title', $service->title . ' - Services')

@push('frontendone_style')
    @include('frontend.pages.common.style')
@endpush

@section('frontendone_content')
    <main class="main">
        <x-frontend.pages.common.breadcrumb :title="$service->title" :breadcrumb="[
            ['name' => 'Home', 'url' => route('home')],
            ['name' => 'Services', 'url' => route('services')],
            ['name' => $service->category->title ?? 'Service', 'url' => route('service.category', $service->servicetwocategory_id)],
            ['name' => $service->title, 'url' => '#'],
        ]" />

        <section class="service-area py-5">
            <div class="container">
                <div class="row g-4 align-items-start">
                    <div class="col-lg-7">
                        <div class="card border-0 shadow-sm rounded-4 p-4">
                            @if ($service->image && file_exists(public_path('uploads/servicetwos/' . $service->image)))
                                <img src="{{ asset('uploads/servicetwos/' . $service->image) }}"
                                    alt="{{ $service->title }}"
                                    class="img-fluid rounded-4 mb-4"
                                    style="width: 100%; max-height: 420px; object-fit: cover;">
                            @else
                                <img src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=700&q=80"
                                    alt="{{ $service->title }}"
                                    class="img-fluid rounded-4 mb-4"
                                    style="width: 100%; max-height: 420px; object-fit: cover;">
                            @endif

                            <div class="mb-3 d-flex align-items-center gap-2">
                                @if ($service->service_icon && file_exists(public_path('uploads/servicetwos/' . $service->service_icon)))
                                    <img src="{{ asset('uploads/servicetwos/' . $service->service_icon) }}"
                                        alt="{{ $service->title }} icon"
                                        style="width: 28px; height: 28px; object-fit: contain;">
                                @endif
                                <h2 class="mb-0">{{ $service->title }}</h2>
                            </div>

                            <div class="text-muted mb-4">
                                <span class="badge bg-light text-dark me-2">{{ $service->category->title ?? 'Service' }}</span>
                                @if ($service->subcategory)
                                    <span class="badge bg-light text-dark">{{ $service->subcategory->name }}</span>
                                @endif
                            </div>

                            <div class="service-detail-content">
                                {!! $service->description !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5">
                        <div class="card border-0 shadow-sm rounded-4 p-4">
                            <h4 class="mb-3">Need help with this service?</h4>
                            <p class="text-muted mb-4">Use the support action below to continue with a consultation request or service discussion.</p>
                            <a href="#start-consultation-section" class="enroll-btn">Get Support</a>
                        </div>
                    </div>
                </div>

                <div class="row mt-5" id="start-consultation-section">
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
                            <button type="button" class="enroll-btn border-0 px-4 py-3 rounded-pill" data-bs-toggle="modal" data-bs-target="#consultationModal">
                                <i class="fa-solid fa-comments"></i> Start Consultation
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        @php
            $services = App\Models\Servicetwo::where('is_active', 1)->get();
            $timeslots = App\Models\ServiceConsultationTimeslot::where('is_active', 1)->get();
            $selectedServiceId = $service->id;
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
                        @include('frontendone.pages.services.consultation_form', compact('services', 'timeslots', 'selectedServiceId'))
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('frontendone_script')
    @include('frontend.pages.common.script')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('a[href="#start-consultation-section"]').forEach(function (link) {
                link.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.getElementById('start-consultation-section');
                    if (target) {
                        target.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }
                });
            });
        });
    </script>
@endpush
