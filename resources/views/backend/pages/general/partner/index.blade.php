@extends('backend.layouts.master')

@section('title', 'Partners')

@push('backend_style')
@include('backend.pages.common.style')
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Partners</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Partners</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h3 class="card-title">Add New Partner</h3>
                </div>
                <div class="card-body">

                    <form action="{{ route('partners.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="partner_image">Partner Logo Image</label>
                                    <input type="file" name="partner_image" class="form-control" id="partner_image" required>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" checked>
                                    <label class="form-check-label" for="is_active">Active</label>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Add Partner</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h3 class="card-title">Partner List</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive export-table">
                        <table id="file-datatable" class="table table-bordered text-nowrap key-buttons border-bottom w-100">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">S/N</th>
                                    <th class="border-bottom-0">Last Updated</th>
                                    <th class="border-bottom-0">Logo</th>
                                    <th class="border-bottom-0">Status</th>
                                    <th class="border-bottom-0">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($partners as $partner)
                                <tr>
                                    <td><strong>{{ $partners->firstItem() + $loop->index }}</strong></td>
                                    <td>{{ $partner->updated_at->format('d-M-Y') }}</td>
                                    <td>
                                        @if($partner->partner_image && $partner->partner_image != 'default_partner.jpg')
                                            <img src="{{ asset('uploads/partners/' . $partner->partner_image) }}" alt="Partner" style="height:45px;">
                                        @else
                                            <span class="text-muted">No Image</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('partner.is_active.ajax', $partner->id) }}"
                                            class="btn btn-sm {{ $partner->is_active ? 'btn-success' : 'btn-danger' }} status-toggle"
                                            data-id="{{ $partner->id }}">
                                            {{ $partner->is_active ? 'Active' : 'Inactive' }}
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <div class="action-btns d-flex align-items-center">
                                            <div>
                                                <a href="{{ route('partners.edit', $partner->id) }}"
                                                    class="btn btn-sm btn-outline-secondary border me-2"
                                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                                    <i class="fa-solid fa-pen fa-fw"></i>
                                                </a>
                                            </div>
                                            <div>
                                                <form action="{{ route('partners.destroy', $partner->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-warning border show_confirm"
                                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
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
        </div>
    </div>
    <!-- End Row -->
@endsection

@push('backend_script')
@include('backend.pages.common.script')
@endpush
