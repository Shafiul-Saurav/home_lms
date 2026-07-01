@extends('backend.layouts.master')

@section('title', 'Service Click Tracking')

@push('backend_style')
    @include('backend.pages.common.style')
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Service Click Tracking</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Service Click Tracking</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h3 class="card-title">Service Clicks</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive export-table">
                        <table class="table table-bordered text-nowrap key-buttons border-bottom w-100">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Service Name</th>
                                    <th>Category</th>
                                    <th>Subcategory</th>
                                    <th>Visitor Count</th>
                                    <th>Last Updated</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($services as $service)
                                    <tr>
                                        <td>{{ $services->firstItem() + $loop->index }}</td>
                                        <td>{{ $service->title }}</td>
                                        <td>{{ $service->category->title ?? 'N/A' }}</td>
                                        <td>{{ $service->subcategory->name ?? 'N/A' }}</td>
                                        <td>{{ $service->visitor_count }}</td>
                                        <td>{{ $service->updated_at->format('d-M-Y') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">No services found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{ $services->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('backend_script')
    @include('backend.pages.common.script')
@endpush
