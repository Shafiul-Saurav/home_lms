@extends('backend.layouts.master')

@section('title', 'Impact')

@push('backend_style')
    @include('backend.pages.common.style')
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header d-flex justify-content-between align-items-center">
                <h1 class="page-title">Impact</h1>
                <a href="{{ route('impacts.create') }}" class="btn btn-primary">Create Impact</a>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h3 class="card-title">Impact List</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered w-100">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Value</th>
                                    <th>Updated</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($impacts as $impact)
                                    <tr>
                                        <td>{{ $impacts->firstItem() + $loop->index }}</td>
                                        <td>{{ $impact->name }}</td>
                                        <td>{{ $impact->value }}</td>
                                        <td>{{ $impact->updated_at->format('d-M-Y') }}</td>
                                        <td>
                                            <a href="{{ route('impacts.edit', $impact->id) }}" class="btn btn-sm btn-secondary">Edit</a>
                                            <form action="{{ route('impacts.destroy', $impact->id) }}" method="POST" style="display:inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $impacts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('backend_script')
    @include('backend.pages.common.script')
@endpush
