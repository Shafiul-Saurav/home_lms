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
    </style>
@endpush

@section('frontendone_content')
    <main class="main">
        <!-- breadcrumb -->
        <x-frontend.pages.common.breadcrumb :title="'Services'" :breadcrumb="[['name' => 'Home', 'url' => route('home')], ['name' => 'Services', 'url' => '#']]" />
        <!-- breadcrumb end -->
        {{-- <section class="py-5" style="padding-top: 120px!important;">
            <div class="container">
                <div class="row justify-content-center text-center mb-5">
                    <div class="col-lg-8">
                        <span class="badge bg-primary-subtle text-primary mb-3">Consultation Services</span>
                        <h1 class="display-5 fw-bold">Choose the right service and book a consultation</h1>
                        <p class="text-muted mb-0">
                            Explore our service categories, review the options, and request a consultation with a preferred time slot.
                        </p>
                    </div>
                </div>

                <div class="row g-4">
                    @forelse($categories as $category)
                        <div class="col-lg-4">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-body p-4">
                                    <h4 class="card-title mb-2">{{ $category->title }}</h4>
                                    <p class="text-muted mb-3">
                                        {{ $category->description ?? 'Explore our service packages and book a consultation with our team.' }}
                                    </p>

                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <span class="small text-muted">{{ $category->servicetwos()->where('is_active', 1)->count() }} service(s)</span>
                                        <a href="{{ route('service.category', $category->id) }}" class="btn btn-outline-primary btn-sm">View Services</a>
                                    </div>

                                    @if ($category->servicetwos()->where('is_active', 1)->count())
                                        <ul class="list-unstyled mb-0">
                                            @foreach ($category->servicetwos()->where('is_active', 1)->take(3)->get() as $service)
                                                <li class="d-flex justify-content-between align-items-center py-2 border-top">
                                                    <span>{{ $service->title }}</span>
                                                    <a href="{{ route('service.track', ['service' => $service->id, 'category_id' => $category->id]) }}" class="small text-primary">Book</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="alert alert-info mb-0" role="alert">
                                No active service categories are available right now.
                            </div>
                        </div>
                    @endforelse
                </div>

                <div class="row mt-5">
                    <div class="col-12">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body p-4">
                                <div class="row align-items-start g-4">
                                    <div class="col-lg-5">
                                        <h3 class="mb-3">Request a consultation</h3>
                                        <p class="text-muted mb-0">
                                            Select a service, pick a time slot, and send your requirements. Our team will get back to you shortly.
                                        </p>
                                    </div>
                                    <div class="col-lg-7">
                                        @php
                                            $services = App\Models\Servicetwo::where('is_active', 1)->get();
                                            $timeslots = App\Models\ServiceConsultationTimeslot::where('is_active', 1)->get();
                                            $selectedServiceId = request('service_id');
                                        @endphp
                                        @include('frontendone.pages.services.consultation_form', compact('services', 'timeslots', 'selectedServiceId'))
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main> --}}
        <!-- Service Section -->
        @include('frontendone.pages.widgets.service_section')

        <div class="container">
            @php
                $howWeWorks = App\Models\Howwework::where('is_active', 1)->get();
                $whatYouGets = App\Models\Whatyouget::where('is_active', 1)->get();
            @endphp

            <section class="py-5">
                <div class="row mb-4">
                    <div class="section-heading">
                        <span class="sub-title">
                            <i class="fa-solid fa-gears"></i>
                            How We Work
                        </span>
                        <h2>Our Engagement Methodology</h2>
                        <p>
                            Every HackToLive engagement follows a structured, transparent process from scoping to final
                            sign-off.
                        </p>
                    </div>
                </div>
                <div class="row gy-4">
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
            </section>
        </div>
        <section class="py-5 bg-light">
            <div class="container">
                <div class="row mb-4">
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
        </section>

        <section class="py-5">
            <div class="container">
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="my-5">
                            <div class="row">
                                <div class="col-lg-10 offset-lg-1">
                                    @php
                                        $services = App\Models\Servicetwo::where('is_active', 1)->get();
                                        $timeslots = App\Models\ServiceConsultationTimeslot::where(
                                            'is_active',
                                            1,
                                        )->get();
                                        $selectedServiceId = request('service_id');
                                    @endphp
                                    @include(
                                        'frontendone.pages.services.consultation_form',
                                        compact('services', 'timeslots', 'selectedServiceId'))
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>

    </main>
@endsection

@push('frontendone_script')
    @include('frontend.pages.common.script')
@endpush
