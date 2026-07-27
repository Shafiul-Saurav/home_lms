<section class="section-padding service-dark" data-aos="fade-up">
    <div class="container">

        <div class="section-heading">
            <span class="sub-title">
                <i class="fa-solid fa-shield-halved"></i>
                Our Services and Solutions
            </span>
            <h2> <span style="color: #76bd10 !important;">Cyber Security Services, Solutions </span> & Professional Training</h2>
            <p>
                Bridging cybersecurity education and enterprise security, HackToLive provides professional training, penetration testing, phishing simulations, SOC implementation, vulnerability assessments, and strategic security audit & consultation.
            </p>
        </div>

        <div class="text-center">
            <ul class="nav nav-pills service-tabs" id="serviceTabs" role="tablist">
                @foreach ($serviceCategories as $index => $category)
                    <li class="nav-item">
                        <button class="nav-link {{ $index === 0 ? 'active' : '' }}" data-bs-toggle="pill" data-bs-target="#category-{{ $category->id }}">
                            {{ $category->title }}
                        </button>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="tab-content">
            @foreach ($serviceCategories as $index => $category)
                <div class="tab-pane fade {{ $index === 0 ? 'show active' : '' }}" id="category-{{ $category->id }}">
                    <div class="row g-4">
                        @foreach ($category->servicetwos as $service)
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
            @endforeach
        </div>

    </div>
</section>
