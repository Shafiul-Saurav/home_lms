@extends('backend.layouts.master')

@section('title', 'View Service')

@push('backend_style')
    @include('backend.pages.common.style')
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">View Service</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">View Service</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <h3 class="card-title">Service Details</h3>
                    <a href="{{ route('services.index') }}" class="btn btn-outline-info border"><i class="fa-solid fa-angles-left fa-fw"></i> Back</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive export-table">
                        <table class="table table-bordered text-nowrap key-buttons border-bottom w-100">
                            <tbody>
                                <tr><th colspan="2"><h3>{{ $service->title }}</h3></th></tr>
                                <tr>
                                    <th>Service Icon</th>
                                    <td width="80%">{!! $service->service_icon !!}</td>
                                </tr>
                                <tr>
                                    <th>Description</th>
                                    <td width="80%">{!! $service->description !!}</td>
                                </tr>
                                <tr>
                                    <th>Created Date</th>
                                    <td>{{ $service->created_at->format('d-M-Y') }}</td>
                                </tr>
                                <tr>
                                    <th>Last Updated</th>
                                    <td>{{ $service->updated_at->format('d-M-Y') }}</td>
                                </tr>
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
