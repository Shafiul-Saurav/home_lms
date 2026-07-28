@extends('backend.layouts.master')

@section('title', 'Edit Impact')

@push('backend_style')
    @include('backend.pages.common.style')
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <h1 class="page-title">Edit Impact</h1>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('impacts.update', $impact->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-row">
                            <div class="col-6 mb-3">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ $impact->name }}" required>
                            </div>
                            <div class="col-6 mb-3">
                                <label for="value">Value</label>
                                <input type="text" name="value" id="value" class="form-control" value="{{ $impact->value }}">
                            </div>
                        </div>
                        <button class="btn btn-secondary" type="submit">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('backend_script')
    @include('backend.pages.common.script')
@endpush
