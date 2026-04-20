@extends('backend.layouts.master')

@section('title', 'PDF Book Trash')

@push('backend_style')
    @include('backend.pages.common.style')
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">PDF Book Trash</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('pdf_books.index') }}">PDF Book</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Trash</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <h3 class="card-title">Trashed PDF Book List</h3>
                    <a href="{{ route('pdf_books.index') }}" class="btn btn-sm btn-outline-primary border">
                        <i class="fa-solid fa-list fa-fw"></i> View List
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive export-table">
                        <table id="file-datatable" class="table table-bordered text-nowrap key-buttons border-bottom w-100">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Deleted At</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($books as $book)
                                    <tr>
                                        <td><strong>{{ $books->firstItem() + $loop->index }}</strong></td>
                                        <td>{{ $book->deleted_at->format('d-M-Y') }}</td>
                                        <td>{{ $book->name }}</td>
                                        <td>{{ $book->pdfBookCategory ? $book->pdfBookCategory->name : 'N/A' }}</td>
                                        <td class="text-center">
                                            <div class="action-btns d-flex align-items-center justify-content-center">
                                                <div>
                                                    <a href="{{ route('pdf_books.restore', $book->id) }}"
                                                        class="btn btn-sm btn-outline-success border me-1">
                                                        <i class="fa-solid fa-rotate-left fa-fw"></i>
                                                    </a>
                                                </div>
                                                <div>
                                                    <a href="{{ route('pdf_books.forceDelete', $book->id) }}"
                                                        class="btn btn-sm btn-outline-danger border show_confirm_permanent">
                                                        <i class="fa-solid fa-trash-can fa-fw"></i>
                                                    </a>
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

    @push('backend_script')
        @include('backend.pages.common.script')
    @endpush
@endsection
