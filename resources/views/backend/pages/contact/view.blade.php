@extends('backend.layouts.master')

@section('title', 'Contact View')

@push('backend_style')
    @include('backend.pages.common.style')
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Contact View</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Contact View</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <h3 class="card-title">Contact Details</h3>
                    <a href="{{ route('contacts.index') }}" class="btn btn-outline-info border"><i class="fa-solid fa-angles-left fa-fw"></i> Back</a>
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
                                <tr>
                                    <th>Name</th>
                                    <td width="80%">{{ $contact->name }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td width="80%">{{ $contact->email }}</td>
                                </tr>
                                <tr>
                                    <th>Phone</th>
                                    <td width="80%">{{ $contact->phone }}</td>
                                </tr>
                                <tr>
                                    <th>Subject</th>
                                    <td width="80%">{{ $contact->subject }}</td>
                                </tr>
                                <tr>
                                    <th>Message</th>
                                    <td width="80%">{{ $contact->message }}</td>
                                </tr>
                                <tr>
                                    <th>Created Date</th>
                                    <td>{{ $contact->created_at->format('d-M-Y') }}</td>
                                </tr>
                                <tr>
                                    <th>Last Updated</th>
                                    <td>{{ $contact->updated_at->format('d-M-Y') }}</td>
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
