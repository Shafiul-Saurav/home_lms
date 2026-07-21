@extends('backend.layouts.master')

@section('title', 'News Trash')

@push('backend_style')
    @include('backend.pages.common.style')
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">News Trash</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">News Trash</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <h3 class="card-title">Trashed News</h3>
                    <a href="{{ route('admin.news.index') }}" class="btn btn-sm btn-primary"><i
                            class="fa-solid fa-angles-left fa-fw"></i> Back</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive export-table">
                        <table id="file-datatable" class="table table-bordered text-nowrap key-buttons border-bottom w-100">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">Last Updated</th>
                                    <th class="border-bottom-0">Title</th>
                                    <th class="border-bottom-0">Category</th>
                                    <th class="border-bottom-0">Author</th>
                                    @canany(['delete-news'])
                                    <th class="border-bottom-0">Actions</th>
                                    @endcanany
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($news as $item)
                                    <tr>
                                        <td><strong>{{ $loop->iteration }}</strong></td>
                                        <td>{{ $item->updated_at->format('d-M-Y') }}</td>
                                        <td>{{ Str::limit($item->title, 30) }}</td>
                                        <td>{{ optional($item->newsCategory)->title ?? '-' }}</td>
                                        <td>{{ optional($item->user)->name ?? '-' }}</td>
                                        @canany(['delete-news'])
                                            <td class="text-center">
                                                <div class="action-btns d-flex align-items-center justify-content-center">
                                                    @can('delete-news')
                                                        <a href="{{ route('admin.news.restore', $item->id) }}"
                                                            class="btn btn-sm btn-outline-info border me-2"
                                                            title="Restore">
                                                            <i class="fa-solid fa-undo fa-fw"></i>
                                                        </a>
                                                        <form action="{{ route('admin.news.forcedelete', $item->id) }}" method="POST"
                                                            class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-sm btn-outline-danger border show_confirm"
                                                                title="Permanent Delete">
                                                                <i class="fa-solid fa-trash fa-fw"></i>
                                                            </button>
                                                        </form>
                                                    @endcan
                                                </div>
                                            </td>
                                        @endcanany
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('backend_script')
    @include('backend.pages.common.script')
@endpush
