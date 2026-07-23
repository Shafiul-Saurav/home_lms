@extends('backend.layouts.master')

@section('title', 'Edit Why Choose Us')

@push('backend_style')
    @include('backend.pages.common.style')
@endpush

@section('backend_content')
    <div class="row"><div class="col-12"><div class="page-header"><div><h1 class="page-title">Edit Why Choose Us</h1></div><div class="ms-auto pageheader-btn"><ol class="breadcrumb"><li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li><li class="breadcrumb-item active" aria-current="page">Why Choose Us</li></ol></div></div></div>
        <div class="col-lg-12 col-md-12"><div class="card"><div class="card-header border-bottom d-flex justify-content-between"><h3 class="card-title">Update Why Choose Us</h3><a href="{{ route('whychooseuses.index') }}" class="btn btn-info"><i class="fa-solid fa-angles-left fa-fw"></i> Back</a></div><div class="card-body"><form action="{{ route('whychooseuses.update', $item->id) }}" method="POST">@csrf @method('PUT')
            <div class="form-row"><div class="col-12 mb-3"><div class="form-group"><label for="title">Title</label><input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title" value="{{ $item->title }}" required>@error('title')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror</div></div><div class="col-12 mb-3"><div class="form-group"><label for="service_icon">Icon</label><input type="text" name="service_icon" class="form-control @error('service_icon') is-invalid @enderror" id="service_icon" value="{{ $item->service_icon }}">@error('service_icon')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror</div></div><div class="col-12 mb-3"><div class="form-group"><label for="description">Description</label><textarea name="description" cols="30" rows="10" class="form-control @error('description') is-invalid @enderror">{{ $item->description }}</textarea>@error('description')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror</div></div><div class="col-12 mb-3"><div class="form-check"><input type="checkbox" name="is_active" class="form-check-input" id="is_active" value="1" {{ $item->is_active ? 'checked' : '' }}><label class="form-check-label" for="is_active">Active</label></div></div></div><button type="submit" class="btn btn-secondary">Update</button>
        </form></div></div></div>
    </div>
@endsection

@push('backend_script')
    @include('backend.pages.common.script')
@endpush
