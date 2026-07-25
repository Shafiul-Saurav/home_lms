@extends('backend.layouts.master')

@section('title', 'Story of Growth')

@push('backend_style')
    @include('backend.pages.common.style')
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div><h1 class="page-title">Story of Growth</h1></div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Story of Growth</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between"><h3 class="card-title">Create Story Item</h3></div>
                <div class="card-body">
                    <form action="{{ route('storyofgrowths.store') }}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="col-12 mb-3"><div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title" value="{{ old('title') }}" required>
                                @error('title')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div></div>
                            <div class="col-12 mb-3"><div class="form-group">
                                <label for="year">Year</label>
                                <input type="text" name="year" class="form-control @error('year') is-invalid @enderror" id="year" value="{{ old('year') }}" required>
                                @error('year')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div></div>
                            <div class="col-12 mb-3"><div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" cols="30" rows="8" class="form-control @error('description') is-invalid @enderror" required>{{ old('description') }}</textarea>
                                @error('description')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div></div>
                        </div>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row row-sm"><div class="col-lg-12"><div class="card">
        <div class="card-header border-bottom"><h3 class="card-title">Story of Growth List</h3></div>
        <div class="card-body"><div class="table-responsive export-table"><table id="file-datatable" class="table table-bordered text-nowrap key-buttons border-bottom w-100">
            <thead><tr><th class="border-bottom-0">#</th><th class="border-bottom-0">Last Updated</th><th class="border-bottom-0">Title</th><th class="border-bottom-0">Year</th><th class="border-bottom-0">Description</th><th class="border-bottom-0">Actions</th></tr></thead>
            <tbody>
                @foreach ($items as $item)
                    <tr>
                        <td><strong>{{ $items->firstItem() + $loop->index }}</strong></td>
                        <td>{{ $item->updated_at->format('d-M-Y') }}</td>
                        <td>{{ $item->title }}</td>
                        <td>{{ $item->year }}</td>
                        <td>{{ Str::limit($item->description, 80) }}</td>
                        <td class="text-center"><div class="action-btns d-flex align-items-center"><div><a href="{{ route('storyofgrowths.edit', $item->id) }}" class="btn btn-sm btn-outline-secondary border me-2"><i class="fa-solid fa-pen fa-fw"></i></a></div><div><form action="{{ route('storyofgrowths.destroy', $item->id) }}" method="POST">@csrf @method('DELETE')<button type="submit" class="btn btn-sm btn-outline-warning border show_confirm"><i class="fa-solid fa-trash-can fa-fw"></i></button></form></div></div></td>
                    </tr>
                @endforeach
            </tbody>
        </table></div></div>
    </div></div></div>
@endsection

@push('backend_script')
    @include('backend.pages.common.script')
@endpush
