@extends('backend.layouts.master')

@section('title', 'Landing Page')

@push('backend_style')
    @include('backend.pages.common.style')
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Landing Page</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Landing Page</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <h3 class="card-title">Manage Landing Pages</h3>
                    <a href="{{ route('landingpages.create') }}" class="btn btn-primary"><i class="fa-solid fa-plus fa-fw"></i> Create New</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-nowrap mb-0">
                            <thead>
                                <tr>
                                    <th class="wd-15p border-bottom-0">ID</th>
                                    <th class="wd-15p border-bottom-0">Main Heading</th>
                                    <th class="wd-20p border-bottom-0">Status</th>
                                    <th class="wd-25p border-bottom-0">Created At</th>
                                    <th class="wd-25p border-bottom-0">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($landingPages as $landingPage)
                                    <tr>
                                        <td>{{ $loop->iteration + ($landingPages->currentPage() - 1) * $landingPages->perPage() }}</td>
                                        <td>{{ Str::limit($landingPage->main_heading, 30) }}</td>
                                        <td>
                                            @if ($landingPage->is_active)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>{{ $landingPage->created_at->format('d M, Y h:i A') }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('landingpages.show', $landingPage->id) }}" class="btn btn-sm btn-primary me-2" title="View">
                                                    <i class="fa-solid fa-eye"></i>
                                                </a>
                                                <a href="{{ route('landingpages.edit', $landingPage->id) }}" class="btn btn-sm btn-info me-2" title="Edit">
                                                    <i class="fa-solid fa-edit"></i>
                                                </a>
                                                <form action="{{ route('landingpages.destroy', $landingPage->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger delete-item" title="Delete">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">No Landing Pages found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $landingPages->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('backend_script')
    @include('backend.pages.common.script')
@endpush