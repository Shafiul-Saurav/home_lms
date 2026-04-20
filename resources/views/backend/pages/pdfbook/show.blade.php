@extends('backend.layouts.master')

@section('title', 'PDF Book Details')

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">PDF Book Details</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('pdf_books.index') }}">PDF Book</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Details</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h3 class="card-title">{{ $book->name }}</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 text-center">
                            @if ($book->image)
                                <img src="{{ asset('uploads/pdfbooks/images/' . $book->image) }}" alt="" class="img-fluid rounded border shadow-sm">
                            @else
                                <img src="{{ asset('uploads/pdfbooks/images/default_book.jpg') }}" alt="" class="img-fluid rounded border shadow-sm">
                            @endif
                            <div class="mt-3">
                                @if ($book->pdf_file)
                                    <a href="{{ asset('uploads/pdfbooks/files/' . $book->pdf_file) }}" target="_blank" class="btn btn-primary btn-block">
                                        <i class="fa-solid fa-file-pdf"></i> Read PDF
                                    </a>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-8">
                            <table class="table table-bordered">
                                <tr>
                                    <th width="30%">Name</th>
                                    <td>{{ $book->name }}</td>
                                </tr>
                                <tr>
                                    <th>Slug</th>
                                    <td>{{ $book->slug }}</td>
                                </tr>
                                <tr>
                                    <th>Category</th>
                                    <td>{{ $book->pdfBookCategory ? $book->pdfBookCategory->name : 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Subcategory</th>
                                    <td>{{ $book->pdfBookSubcategory ? $book->pdfBookSubcategory->name : 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Price</th>
                                    <td>{{ $book->price }}</td>
                                </tr>
                                <tr>
                                    <th>Discount</th>
                                    <td>{{ $book->discount_amount ?? '0' }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>
                                        @if ($book->is_active)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Created At</th>
                                    <td>{{ $book->created_at->format('d-M-Y H:i A') }}</td>
                                </tr>
                            </table>

                            <div class="mt-4">
                                <h5>Description:</h5>
                                <div class="border p-3 rounded bg-light">
                                    {!! $book->description !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <a href="{{ route('pdf_books.index') }}" class="btn btn-secondary">Back to List</a>
                    <a href="{{ route('pdf_books.edit', $book->id) }}" class="btn btn-warning text-dark">Edit Book</a>
                </div>
            </div>
        </div>
    </div>
@endsection
