@extends('backend.layouts.master')

@section('title', 'Booking')

@push('backend_style')
    @include('backend.pages.common.style')
@endpush

@section('backend_content')
    <div class="row row-sm">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Booking</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Booking</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <h3 class="card-title">Booking Trashed List</h3>
                    <a href="{{ route('bookings.index') }}" class="btn btn-info"><i class="fa-solid fa-angles-left fa-fw"></i> Back</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive export-table">
                        <table id="file-datatable" class="table table-bordered text-nowrap key-buttons border-bottom w-100">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">Last Updated</th>
                                    <th class="border-bottom-0">Name</th>
                                    <th class="border-bottom-0">Email</th>
                                    <th class="border-bottom-0">Phone</th>
                                    <th class="border-bottom-0">Room Type</th>
                                    <th class="border-bottom-0">Room No.</th>
                                    <th class="border-bottom-0">Total Adults</th>
                                    <th class="border-bottom-0">Total Children</th>
                                    <th class="border-bottom-0">Arrival Date</th>
                                    <th class="border-bottom-0">Departure Date</th>
                                    <th class="border-bottom-0">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bookings as $booking)
                                    <tr>
                                        <td>
                                            <strong>{{ $bookings->firstItem() + $loop->index }}</strong>
                                        </td>
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
                                                    <a href="{{ route('bookings.restore', ['id' => $booking->id]) }}"
                                                        class="btn btn-sm btn-outline-success border me-2" data-toggle="tooltip"
                                                        data-placement="top" data-bs-original-title="Restore"><i class="fa-solid fa-store"></i>
                                                    </a>
                                                </div> --}}
                                                <div>
                                                    <form action="{{ route('bookings.forcedelete', ['id' => $booking->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger border show_confirm" data-toggle="tooltip"
                                                        data-placement="top" data-bs-original-title="Force Delete">
                                                            <i class="fa-solid fa-radiation"></i>
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
        </div>
    </div>
    <!-- End Row -->
@endsection

@push('backend_script')
    @include('backend.pages.common.script')
@endpush
