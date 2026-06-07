@extends('backend.layouts.master')

@section('title', 'CSV Question Upload')

@push('backend_style')
    @include('backend.pages.common.style')
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">CSV Question Upload</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('questions.index') }}">Questions</a></li>
                        <li class="breadcrumb-item active" aria-current="page">CSV Upload</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <h3 class="card-title">Upload Questions via CSV</h3>
                    <a href="{{ route('questions.index') }}" class="btn btn-sm btn-outline-primary border"><i class="fa-solid fa-arrow-left fa-fw"></i> Back to List</a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <form class="form" action="{{ route('questions.csv.import.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="csv-file">Upload CSV File <span class="text-danger">*</span></label>
                                    <input type="file" id="csv-file" class="form-control" name="csv_file" accept=".csv, .txt" required />
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success"><i class="fa-solid fa-upload fa-fw"></i> Upload Now</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6 border-start">
                            <a class="btn btn-info btn-lg w-100 mb-3 text-white" href="{{ route('questions.csv.sample') }}">
                                <i class="fa-solid fa-download fa-fw"></i> Download Sample CSV
                            </a>
                            <div class="mt-3">
                                <strong>CSV Format Requirements:</strong>
                                <ul class="mt-2 text-muted">
                                    <li>The file must have exactly the columns provided in the sample.</li>
                                    <li>First row must be the header.</li>
                                    <li><strong>type</strong> must be either <code>mcq</code> or <code>written</code>.</li>
                                    <li>For MCQ, <strong>correct_option</strong> must be a number from 1 to 5.</li>
                                    <li><strong>is_active</strong> should be 1 (Active) or 0 (Inactive).</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('backend_script')
    @include('backend.pages.common.script')
@endpush
