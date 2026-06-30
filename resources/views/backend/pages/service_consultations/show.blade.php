@extends('backend.layouts.master')

@section('title', 'Consultation Details')

@push('backend_style')
    @include('backend.pages.common.style')
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Consultation Details</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <a href="{{ route('service_consultations.index') }}" class="btn btn-info">Back</a>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr><th>Name</th><td>{{ $consultation->name }}</td></tr>
                        <tr><th>Email</th><td>{{ $consultation->email }}</td></tr>
                        <tr><th>Phone</th><td>{{ $consultation->phone }}</td></tr>
                        <tr><th>Company</th><td>{{ $consultation->company_name ?? 'N/A' }}</td></tr>
                        <tr><th>Service</th><td>{{ $consultation->service->title ?? 'N/A' }}</td></tr>
                        <tr><th>Timeslot</th><td>{{ $consultation->timeslot->label ?? 'N/A' }}</td></tr>
                        <tr><th>Timeline</th><td>{{ $consultation->expected_timeline ?? 'N/A' }}</td></tr>
                        <tr><th>Requirement</th><td>{!! nl2br(e($consultation->project_requirement)) !!}</td></tr>
                        <tr><th>Status</th><td>{{ $consultation->is_active ? 'Active' : 'Inactive' }}</td></tr>
                        <tr><th>Submitted</th><td>{{ $consultation->created_at->format('d-M-Y H:i') }}</td></tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
