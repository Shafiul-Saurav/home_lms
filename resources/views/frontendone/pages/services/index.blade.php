@extends('frontendone.layouts.master')

@section('title', 'Services - CyberBD')

@push('frontendone_style')
    @include('frontend.pages.common.style')
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
            <div class="row mt-5">
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4">
                            <div class="row align-items-start g-4">
                                {{-- <div class="col-lg-5">
                                    <h3 class="mb-3">Request a consultation</h3>
                                    <p class="text-muted mb-0">
                                        Select a service, pick a time slot, and send your requirements. Our team will get
                                        back to you shortly.
                                    </p>
                                </div> --}}
                                <div class="col-lg-8 offset-lg-2">
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
        </div>
    @endsection

    @push('frontendone_script')
        @include('frontend.pages.common.script')
    @endpush
