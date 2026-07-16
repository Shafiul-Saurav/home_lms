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
            position: fixed;
            top: 90%;
            width: inherit;
        }

        @media (min-width: 992px) {
            .consultation-sidebar {
                max-height: none;
                overflow-y: visible;
                scroll-behavior: smooth;
                padding-right: 0;
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
        </div>

    </main>
@endsection

@push('frontendone_script')
    @include('frontend.pages.common.script')
    <script>
        (function() {
            if (window.innerWidth < 992) return;

            var sidebar = document.querySelector('.consultation-sidebar');
            var sidebarCol = document.getElementById('sidebarCol');
            var serviceInfoArea = document.querySelector('.service-info-area');

            if (!sidebar || !sidebarCol || !serviceInfoArea) return;

            var TOP_OFFSET = 90;
            var GAP = 20;

            // Make the column a positioned container for absolute fallback
            sidebarCol.style.position = 'relative';

            function update() {
                if (window.innerWidth < 992) {
                    sidebar.style.cssText = '';
                    sidebarCol.style.position = '';
                    return;
                }

                var colWidth = sidebarCol.offsetWidth;
                var sidebarH = sidebar.offsetHeight;
                var sectionBottom = serviceInfoArea.getBoundingClientRect().bottom + window.pageYOffset;
                var colTop = sidebarCol.getBoundingClientRect().top + window.pageYOffset;
                var scrollY = window.pageYOffset;

                // Scroll position at which sidebar bottom would touch section end
                var unstickAt = sectionBottom - TOP_OFFSET - sidebarH - GAP;

                if (scrollY >= unstickAt) {
                    // Detach: position absolute inside column
                    sidebar.style.position = 'absolute';
                    sidebar.style.top = (unstickAt - colTop + TOP_OFFSET) + 'px';
                    sidebar.style.width = colWidth + 'px';
                } else {
                    // Fixed to viewport
                    sidebar.style.position = 'fixed';
                    sidebar.style.top = TOP_OFFSET + 'px';
                    sidebar.style.width = colWidth + 'px';
                }
            }

            window.addEventListener('scroll', update, {
                passive: true
            });
            window.addEventListener('resize', update);
            update();
        })();
    </script>
@endpush
