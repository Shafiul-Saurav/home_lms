@extends('frontend.layouts.master')

@section('title', 'Booking History')

@push('frontend_style')
@include('frontend.pages.common.style')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.1.3/css/dataTables.bootstrap5.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/3.0.2/css/responsive.bootstrap5.css">
<style>
    .active>.page-link, .page-link.active {
        /* z-index: 3;
        color: var(--bs-pagination-active-color); */
        background-color: #cc8c18;
        border-color: #cc8c18;
    }
</style>
@endpush

@section('frontend_content')
<!-- Start Page Title Area -->
<div class="page-title-area" style="background-image: url('{{ asset('assets/frontend/img/page-bg.jpg') }}')">
    <div class="container">
        <div class="page-title-content">
            <h2>Booking History</h2>
            <ul>
                <li>
                    <a href="{{ route('user.dashboard') }}">
                        User Dashboard
                    </a>
                </li>
                <li>Booking History</li>
            </ul>
        </div>
    </div>
</div>
<!-- End Page Title Area -->

<!-- Start Book History Area -->
<section class="checks-area ptb-100">
    <div class="container">
        <div class="row check-form">
            <div class="col-lg-12">
                <div class="d-flex justify-content-between align-items-center">
                    <h2>Booking History</h2>
                    <div>
                        <a href="{{ route('user.dashboard') }}" class="default-btn btn-sm">
                            Go Back
                            <i class="flaticon-right"></i>
                        </a>
                    </div>
                </div>

            </div>
            <div class="col-lg-12">
                <table id="example" class="table table-striped nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Last Updated</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Room Type</th>
                            <th>Room No.</th>
                            <th>Total Adults</th>
                            <th>Total Children</th>
                            <th>Arrival Date</th>
                            <th>Departure Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bookings as $booking)
                        <tr>
                            <td><strong>{{ $bookings->firstItem() + $loop->index }}</strong></td>
                            <td>{{ $booking->updated_at->format('d-M-Y') }}</td>
                            <td>{{ $booking->user->name??null }}</td>
                            <td>{{ $booking->user->email??null }}</td>
                            <td>{{ $booking->user->profile->phone??null }}</td>
                            <td>{{ $booking->room->roomtype->title??null }}</td>
                            <td>{{ $booking->room->title??null }}</td>
                            <td>{{ $booking->total_adults??null }}</td>
                            <td>{{ $booking->total_children??null }}</td>
                            <td>{{ $booking->checkin_date??null }}</td>
                            <td>{{ $booking->checkout_date??null }}</td>
                            <td class="text-center">
                                <div class="action-btns d-flex align-items-center">
                                    {{-- <div>
                                        <a href="" class="btn btn-sm btn-primary border me-2"
                                            data-toggle="tooltip" data-placement="top"
                                            data-bs-original-title="View">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                    </div>
                                    <div>
                                        <a href=""
                                            class="btn btn-sm btn-secondary border me-2"
                                            data-toggle="tooltip" data-placement="top"
                                            data-bs-original-title="Edit"><i
                                                class="fa-solid fa-pen fa-fw"></i>
                                        </a>
                                    </div> --}}
                                    <div>
                                        <form action="{{ route('booking.cancel', $booking->id) }}" method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="btn btn-sm btn-outline-primary show_confirm me-2"
                                                data-toggle="tooltip" data-placement="top"
                                                data-bs-original-title="Cancel">
                                                <i class="fa-solid fa-plane-slash"></i>
                                            </button>
                                        </form>
                                    </div>
                                    <div>
                                        <form action=""
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="btn btn-sm btn-outline-danger show_confirm"
                                                data-toggle="tooltip" data-placement="top"
                                                data-bs-original-title="Delete">
                                                <i class="fa-solid fa-trash-can fa-fw"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<!-- End Book History Area -->

@endsection

@push('frontend_script')
@include('frontend.pages.common.script')
<script src="https://cdn.datatables.net/2.1.3/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.1.3/js/dataTables.bootstrap5.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.2/js/dataTables.responsive.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.2/js/responsive.bootstrap5.js"></script>
<script>
    $(document).ready(function() {
        new DataTable('#example', {
    responsive: true
});
    });
</script>
@endpush
