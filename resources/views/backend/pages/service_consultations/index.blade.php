@extends('backend.layouts.master')

@section('title', 'Service Consultations')

@push('backend_style')
    @include('backend.pages.common.style')
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Service Consultations</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Service Consultations</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <h3 class="card-title">Consultation Requests</h3>
                    <a href="{{ route('service_consultations.create') }}" class="btn btn-primary">Add Consultation</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive export-table">
                        <table id="file-datatable" class="table table-bordered text-nowrap key-buttons border-bottom w-100">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Created</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Service</th>
                                    <th>Timeslot</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($consultations as $consultation)
                                    <tr>
                                        <td>{{ $consultations->firstItem() + $loop->index }}</td>
                                        <td>{{ $consultation->created_at->format('d-M-Y') }}</td>
                                        <td>{{ $consultation->name }}</td>
                                        <td>{{ $consultation->email }}</td>
                                        <td>{{ $consultation->phone }}</td>
                                        <td>{{ $consultation->service->title ?? 'N/A' }}</td>
                                        <td>{{ $consultation->timeslot->label ?? 'N/A' }}</td>
                                        <td>
                                            <div class="material-switch">
                                                <input id="active-{{ $consultation->id }}" class="toggle-class-active" type="checkbox" {{ $consultation->is_active ? 'checked' : '' }} data-id="{{ $consultation->id }}">
                                                <label for="active-{{ $consultation->id }}" class="label-success"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="action-btns d-flex align-items-center">
                                                <a href="{{ route('service_consultations.show', $consultation->id) }}" class="btn btn-sm btn-outline-primary border me-2">View</a>
                                                <a href="{{ route('service_consultations.edit', $consultation->id) }}" class="btn btn-sm btn-outline-secondary border me-2">Edit</a>
                                                <form action="{{ route('service_consultations.destroy', $consultation->id) }}" method="POST">
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
                    {{ $consultations->links() }}
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
                var consultationId = $(this).data('id');
                $.ajax({
                    type: 'GET',
                    url: '/admin/check/service-consultation/is_active/' + consultationId,
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
