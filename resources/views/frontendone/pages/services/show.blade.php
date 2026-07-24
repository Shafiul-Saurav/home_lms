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
                            <a href="{{ route('services') }}#serviceTabs" class="enroll-btn">Get Support</a>
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
