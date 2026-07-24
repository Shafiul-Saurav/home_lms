@extends('frontendone.layouts.master')

@section('title', $subcategory->name . ' - Services')

@push('frontendone_style')
    @include('frontend.pages.common.style')
@endpush

@section('frontendone_content')
    <main class="main">
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
                        @php
                            $timeslots = App\Models\ServiceConsultationTimeslot::where('is_active', 1)->get();
                        @endphp
                        @include('frontendone.pages.services.consultation_form', [
                            'services' => $services,
                            'timeslots' => $timeslots,
                        ])
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('frontendone_script')
    @include('frontend.pages.common.script')
@endpush
