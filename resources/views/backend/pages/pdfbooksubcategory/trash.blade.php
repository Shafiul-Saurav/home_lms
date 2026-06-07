@extends('backend.layouts.master')

@section('title', 'PDF Book Subcategory Trash')

@push('backend_style')
    @include('backend.pages.common.style')
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">PDF Book Subcategory Trash</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('pdf_book_subcategories.index') }}">PDF Book
                                Subcategory</a></li>
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
                    <h3 class="card-title">Trashed PDF Book Subcategory List</h3>
                    <a href="{{ route('pdf_book_subcategories.index') }}" class="btn btn-outline-info border"><i class="fa-solid fa-angles-left fa-fw"></i> Back</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive export-table">
                        <table id="file-datatable" class="table table-bordered text-nowrap key-buttons border-bottom w-100">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">Deleted At</th>
                                    <th class="border-bottom-0">Category</th>
                                    <th class="border-bottom-0">Name</th>
                                    <th class="border-bottom-0">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subcategories as $subcategory)
                                    <tr>
                                        <td><strong>{{ $subcategories->firstItem() + $loop->index }}</strong></td>
                                        <td>{{ $subcategory->deleted_at->format('d-M-Y') }}</td>
                                        <td>{{ $subcategory->pdfBookCategory ? $subcategory->pdfBookCategory->name : 'N/A' }}
                                        </td>
                                        <td>{{ $subcategory->name }}</td>
                                        <td class="text-center">
                                            <div class="action-btns d-flex align-items-center">
                                                <div>
                                                    <a href="{{ route('pdf_book_subcategories.restore', $subcategory->id) }}"
                                                        class="btn btn-sm btn-outline-success border me-2"
                                                        data-toggle="tooltip" data-placement="top" title="Restore">
                                                        <i class="fa-solid fa-rotate-left"></i>
                                                    </a>
                                                </div>
                                                <div>
                                                    <a href="{{ route('pdf_book_subcategories.forcedelete', $subcategory->id) }}"
                                                        class="btn btn-sm btn-outline-danger border show_confirm_permanent"
                                                        data-toggle="tooltip" data-placement="top" title="Permanent Delete">
                                                        <i class="fa-solid fa-radiation"></i>
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
@endsection

@push('backend_script')
    @include('backend.pages.common.script')
@endpush
