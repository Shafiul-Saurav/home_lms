@extends('backend.layouts.master')

@section('title', 'Home')

@push('backend_style')
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Dashboard</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 col-sm-12 col-md-6 col-xl-3">
                    <div class="card overflow-hidden">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="">Admin Roles</h4>
                                        <h3 class="mb-2 fw-semibold">{{ $roles }}</h3>
                                </div>
                                <div class="col col-auto top-icn dash">
                                    <div class="counter-icon bg-success dash ms-auto box-shadow-success">
                                        <i class="fa-solid fa-user-tie"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12 col-md-6 col-xl-3">
                    <div class="card overflow-hidden">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5>Room Types</h5>
                                    <h3 class="mb-2 fw-semibold">{{ $roomTypes }}</h3>
                                </div>
                                <div class="col col-auto top-icn dash">
                                    <div class="counter-icon bg-primary dash ms-auto box-shadow-primary">
                                        <i class="fa-regular fa-font-awesome"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12 col-md-6 col-xl-3">
                    <div class="card overflow-hidden">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5>Total Rooms</h5>
                                    <h3 class="mb-2 fw-semibold">{{ $rooms }}</h3>
                                </div>
                                <div class="col col-auto top-icn dash">
                                    <div class="counter-icon bg-secondary dash ms-auto box-shadow-secondary">
                                        <i class="fa-brands fa-buromobelexperte"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12 col-md-6 col-xl-3">
                    <div class="card overflow-hidden">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="">Departments</h5>
                                    <h3 class="mb-2 fw-semibold">{{ $departments }}</h3>
                                </div>
                                <div class="col col-auto top-icn dash">
                                    <div class="counter-icon bg-info dash ms-auto box-shadow-info">
                                        <i class="fa-solid fa-building-user"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12 col-md-6 col-xl-3">
                    <div class="card overflow-hidden">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="">Staffs</h5>
                                    <h3 class="mb-2 fw-semibold">{{ $stuffs }}</h3>
                                </div>
                                <div class="col col-auto top-icn dash">
                                    <div class="counter-icon bg-warning dash ms-auto box-shadow-warning">
                                        <i class="fa-solid fa-clipboard-user fa-fw"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12 col-md-6 col-xl-3">
                    <div class="card overflow-hidden">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="">Customer</h5>
                                    <h3 class="mb-2 fw-semibold">{{ $users }}</h3>
                                </div>
                                <div class="col col-auto top-icn dash">
                                    <div class="counter-icon bg-light dash ms-auto box-shadow-light">
                                        <i class="fa-solid fa-users"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12 col-md-6 col-xl-3">
                    <div class="card overflow-hidden">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="">Total Bookings</h5>
                                    <h3 class="mb-2 fw-semibold">{{ $totalBookings }}</h3>
                                </div>
                                <div class="col col-auto top-icn dash">
                                    <div class="counter-icon bg-danger dash ms-auto box-shadow-danger">
                                        <i class="fa-solid fa-building-circle-check"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ROW-1 OPEN -->
            {{-- <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header border-bottom">
                            <h3 class="card-title">Booking Chart(Week)</h3>
                        </div>
                        <div class="card-body">
                            <canvas id="myWeek"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header border-bottom">
                            <h3 class="card-title">Booking Chart(Year)</h3>
                        </div>
                        <div class="card-body">
                            <canvas id="myYear"></canvas>
                        </div>
                    </div>
                </div>
            </div> --}}
            <!-- ROW-1 CLOSED -->

        </div>
    </div>
@endsection
@push('backend_script')
    <!-- CHARTJS JS -->
    <script src="{{ asset('assets/backend') }}/plugins/chart/Chart.bundle.js"></script>
    <script src="{{ asset('assets/backend') }}/plugins/chart/utils.js"></script>
    <script src="{{ asset('assets/backend') }}/js/chart.js"></script>

    <!-- NVD3-CHARTS JS -->
    {{-- <script src="{{asset('assets/backend')}}/plugins/charts-nvd3/d3.min.js"></script>
    <script src="{{asset('assets/backend')}}/plugins/charts-nvd3/nv.d3.js"></script>
    <script src="{{asset('assets/backend')}}/plugins/charts-nvd3/stream_layers.js"></script>
    <script src="{{asset('assets/backend')}}/js/nvd3.js"></script> --}}

    <script>
        const ctx = document.getElementById('myWeek');

        // Get the data from the controller
        const labels = @json($dateLabels);
        const headings = @json($dateMonYear);
        const bookingData = @json($bookingCounts);

        // Get the current date
        const currentDate = new Date();
        const dayOfWeek = currentDate.getDay(); // 0 for Sunday, 1 for Monday, etc.

        // Calculate the date for the most recent Sunday
        const lastSunday = new Date(currentDate);
        lastSunday.setDate(currentDate.getDate() - dayOfWeek);

        // Generate background and border colors
        const backgroundColors = [];
        const borderColors = [];
        for (let i = 0; i < 7; i++) {
            const weekDay = new Date(lastSunday);
            weekDay.setDate(lastSunday.getDate() + i);
            if (weekDay.toDateString() === currentDate.toDateString()) {
                backgroundColors.push('rgba(255, 99, 132, 0.9)'); // Highlight color
                borderColors.push('rgb(255, 99, 132)'); // Highlight border
            } else {
                backgroundColors.push('rgba(63, 201, 183, 0.7)'); // Normal color
                borderColors.push('rgb(63, 201, 183)'); // Normal border
            }
        }

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels, // Use the dynamically generated labels based on dates
                datasets: [{
                    label: '# of Bookings',
                    data: bookingData, // Use the real data from the controller
                    backgroundColor: backgroundColors, // Use customized background colors
                    borderColor: borderColors, // Use customized border colors
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    title: {
                        display: true,
                        text: `Bookings for the Week (${headings[0]})`, // Title with the week range
                        font: {
                            size: 18
                        }
                    }
                }
            }
        });
    </script>
    <script>
        const yearCtx = document.getElementById('myYear');

        // Get the data for the yearly chart
        const monthLabels = @json($monthLabels);
        const bookingDataByMonth = @json($bookingCountsByMonth);

        new Chart(yearCtx, {
            type: 'bar',
            data: {
                labels: monthLabels, // Use the dynamically generated month labels
                datasets: [{
                    label: '# of Bookings',
                    data: bookingDataByMonth, // Use the real data from the controller
                    backgroundColor: 'rgba(63, 201, 183, 0.7)', // Normal color for all months
                    borderColor: 'rgb(63, 201, 183)', // Normal border color
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    title: {
                        display: true,
                        text: `Bookings for the Year (${headings[0]})`, // Title for the yearly chart
                        font: {
                            size: 18
                        }
                    }
                }
            }
        });
    </script>

@endpush
