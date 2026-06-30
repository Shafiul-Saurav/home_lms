@extends('backend.layouts.master')

@section('title', 'Consultation Timeslots')

@push('backend_style')
    @include('backend.pages.common.style')
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Consultation Timeslots</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Timeslots</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <h3 class="card-title">Timeslot List</h3>
                    <a href="{{ route('service_consultation_timeslots.create') }}" class="btn btn-primary">Add Timeslot</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive export-table">
                        <table class="table table-bordered text-nowrap key-buttons border-bottom w-100">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Label</th>
                                    <th>Start</th>
                                    <th>End</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($timeslots as $timeslot)
                                    <tr>
                                        <td>{{ $timeslots->firstItem() + $loop->index }}</td>
                                        <td>{{ $timeslot->label }}</td>
                                        <td>{{ \Carbon\Carbon::createFromFormat('H:i:s', $timeslot->start_time)->format('h:i A') }}</td>
                                        <td>{{ \Carbon\Carbon::createFromFormat('H:i:s', $timeslot->end_time)->format('h:i A') }}</td>
                                        <td>
                                            <div class="material-switch">
                                                <input id="active-{{ $timeslot->id }}" class="toggle-class-active" type="checkbox" {{ $timeslot->is_active ? 'checked' : '' }} data-id="{{ $timeslot->id }}">
                                                <label for="active-{{ $timeslot->id }}" class="label-success"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="action-btns d-flex align-items-center">
                                                <a href="{{ route('service_consultation_timeslots.edit', $timeslot->id) }}" class="btn btn-sm btn-outline-secondary border me-2">Edit</a>
                                                <form action="{{ route('service_consultation_timeslots.destroy', $timeslot->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-warning border show_confirm">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $timeslots->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('backend_script')
    @include('backend.pages.common.script')
    <script>
        $(function() {
            $(document).on('change', '.toggle-class-active', function() {
                var timeslotId = $(this).data('id');
                $.ajax({
                    type: 'GET',
                    url: '/admin/check/service-consultation-timeslot/is_active/' + timeslotId,
                    success: function(response) {
                        Swal.fire('Updated', response.message, 'success');
                    },
                    error: function() {
                        Swal.fire('Error', 'Unable to update status', 'error');
                    }
                });
            });
        });
    </script>
@endpush
