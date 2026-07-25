@extends('backend.layouts.master')

@section('title', 'Update Story of Growth')

@push('backend_style')
    @include('backend.pages.common.style')
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <h3 class="card-title">Update Story of Growth</h3>
                    <a href="{{ route('storyofgrowths.index') }}" class="btn btn-info"><i class="fa-solid fa-angles-left fa-fw"></i> Back</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('storyofgrowths.update', $item->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-row">
                            <div class="col-12 mb-3"><div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title" value="{{ old('title', $item->title) }}" required>
                                @error('title')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div></div>
                            <div class="col-12 mb-3"><div class="form-group">
                                <label for="year">Year</label>
                                <input type="text" name="year" class="form-control @error('year') is-invalid @enderror" id="year" value="{{ old('year', $item->year) }}" required>
                                @error('year')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div></div>
                            <div class="col-12 mb-3"><div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" cols="30" rows="8" class="form-control @error('description') is-invalid @enderror" required>{{ old('description', $item->description) }}</textarea>
                                @error('description')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div></div>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('backend_script')
    @include('backend.pages.common.script')
@endpush
