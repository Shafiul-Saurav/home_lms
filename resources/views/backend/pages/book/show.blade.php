@extends('backend.layouts.master')

@section('title', 'Book Details')

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Book Details</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('books.index') }}">Book</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Details</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h3 class="card-title">Book Details</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 text-center mb-4">
                            @if ($book->image)
                                <img src="{{ asset('uploads/books/' . $book->image) }}" alt="Book Image" class="img-fluid rounded border">
                            @else
                                <div class="p-5 border rounded bg-light">No Image</div>
                            @endif
                        </div>
                        <div class="col-md-8">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th width="30%">Name</th>
                                        <td>{{ $book->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Category</th>
                                        <td>{{ $book->bookCategory ? $book->bookCategory->name : 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Subcategory</th>
                                        <td>{{ $book->bookSubcategory ? $book->bookSubcategory->name : 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Price</th>
                                        <td>{{ $book->price }}</td>
                                    </tr>
                                    <tr>
                                        <th>Discount Amount</th>
                                        <td>{{ $book->discount_amount ?? '0' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td>
                                            @if($book->is_active)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-danger">Inactive</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Description</th>
                                        <td>{!! $book->description !!}</td>
                                    </tr>
                                    <tr>
                                        <th>Author Name</th>
                                        <td>{{ $book->author_name ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Author Profile</th>
                                        <td>
                                            @if($book->author_profile)
                                                <img src="{{ asset('uploads/books/authors/' . $book->author_profile) }}" alt="Author Profile" style="height: 50px; border-radius: 5px;">
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Author Description</th>
                                        <td>{{ $book->author_description ?? 'N/A' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
