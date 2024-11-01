@extends('backend.layouts.master')

@section('title', 'Video Gallery')

@push('backend_style')
    @include('backend.pages.common.style')
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Video Gallery</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Video Gallery</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <h3 class="card-title">Video Gallery Trashed List</h3>
                    <a href="{{ route('videogalleries.index') }}" class="btn btn-info"><i
                        class="fa-solid fa-angles-left fa-fw"></i>Back</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive export-table">
                        <table id="file-datatable" class="table table-bordered text-nowrap key-buttons border-bottom w-100">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">Last Updated</th>
                                    <th class="border-bottom-0">Title</th>
                                    <th class="border-bottom-0">Video</th>
                                    <th class="border-bottom-0">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($videos as $video)
                                    <tr>
                                        <td>
                                            <strong>{{ $videos->firstItem() + $loop->index }}</strong>
                                        </td>
                                        <td>{{ $video->updated_at->format('d-M-Y') }}</td>
                                        <td>{{ $video->title }}</td>
                                        <td>{!! $video->description !!}</td>
                                        <td class="text-center">
                                            <div class="action-btns d-flex align-items-center">
                                                <div>
                                                    <a href="{{ route('videogalleries.restore', ['id' => $video->id]) }}"
                                                        class="btn btn-sm btn-outline-success border me-2" data-toggle="tooltip"
                                                        data-placement="top" data-bs-original-title="Restore"><i class="fa-solid fa-store"></i>
                                                    </a>
                                                </div>
                                                <div>
                                                    <form action="{{ route('videogalleries.forcedelete', ['id' => $video->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger border show_confirm" data-toggle="tooltip"
                                                        data-placement="top" data-bs-original-title="Force Delete">
                                                            <i class="fa-solid fa-radiation"></i>
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
