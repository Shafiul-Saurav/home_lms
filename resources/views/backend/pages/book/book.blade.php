@extends('backend.layouts.master')

@section('title', 'Book')

@push('backend_style')
    @include('backend.pages.common.style')
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Book</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Book</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <h3 class="card-title">Create Book</h3>
                    @can('delete-product')
                        <a href="{{ route('books.trash') }}" class="btn btn-sm btn-outline-warning border">
                            <i class="fa-solid fa-trash-can-arrow-up fa-fw"></i> View Trash
                        </a>
                    @endcan
                </div>
                <div class="card-body">
                    <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="name">Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" id="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name') }}" required>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="book_category_id">Category</label>
                                    <select name="book_category_id" id="book_category_id"
                                        class="form-control @error('book_category_id') is-invalid @enderror">
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('book_category_id') == $category->id ? 'selected' : '' }}>
                                                {!! $category->name !!}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('book_category_id')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="book_subcategory_id">Subcategory</label>
                                    <select name="book_subcategory_id" id="book_subcategory_id"
                                        class="form-control @error('book_subcategory_id') is-invalid @enderror" disabled>
                                        <option value="">Select Subcategory</option>
                                    </select>
                                    @error('book_subcategory_id')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="price">Price <span class="text-danger">*</span></label>
                                    <input type="number" step="0.01" name="price" id="price"
                                        class="form-control @error('price') is-invalid @enderror"
                                        value="{{ old('price') }}" required>
                                    @error('price')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="discount_amount">Discount</label>
                                    <input type="number" step="0.01" name="discount_amount" id="discount_amount"
                                        class="form-control @error('discount_amount') is-invalid @enderror"
                                        value="{{ old('discount_amount') }}">
                                    @error('discount_amount')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="is_active">Status</label>
                                    <select name="is_active" id="is_active"
                                        class="form-control @error('is_active') is-invalid @enderror">
                                        <option value="1" {{ old('is_active', '1') == '1' ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    @error('is_active')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea name="description" id="summernote"
                                        class="form-control @error('description') is-invalid @enderror"
                                        rows="4">{{ old('description') }}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label for="image">Image <span class="text-danger">*</span></label>
                                    <input type="file" name="image" id="image"
                                        class="form-control @error('image') is-invalid @enderror" required>
                                    @error('image')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <button class="btn btn-primary" type="submit">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h3 class="card-title">Book List</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive export-table">
                        <table id="file-datatable" class="table table-bordered text-nowrap key-buttons border-bottom w-100">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Subcategory</th>
                                    <th>Image</th>
                                    <th>Price</th>
                                    <th>Discount</th>
                                    @can('edit-product')
                                        <th>Status</th>
                                    @endcan
                                    @canany(['edit-product', 'delete-product'])
                                        <th>Actions</th>
                                    @endcanany
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($books as $book)
                                    <tr>
                                        <td><strong>{{ $books->firstItem() + $loop->index }}</strong></td>
                                        <td>{{ $book->name }}</td>
                                        <td>{{ $book->bookCategory ? $book->bookCategory->name : 'N/A' }}</td>
                                        <td>{{ $book->bookSubcategory ? $book->bookSubcategory->name : 'N/A' }}</td>
                                        <td>
                                            @if ($book->image)
                                                <img src="{{ asset('uploads/books/' . $book->image) }}" alt="" style="height: 50px">
                                            @else
                                                <span>No Image</span>
                                            @endif
                                        </td>
                                        <td>{{ $book->price }}</td>
                                        <td>{{ $book->discount_amount ?? 'N/A' }}</td>
                                        @can('edit-product')
                                            <td>
                                                <div class="material-switch">
                                                    <input id="book-{{ $book->id }}" class="toggle-class" name="is_active"
                                                        type="checkbox" {{ $book->is_active ? 'checked' : '' }}
                                                        data-id="{{ $book->id }}">
                                                    <label for="book-{{ $book->id }}" class="label-success"></label>
                                                </div>
                                            </td>
                                        @endcan
                                        @canany(['edit-product', 'delete-product'])
                                            <td class="text-center">
                                                <div class="action-btns d-flex align-items-center justify-content-center">
                                                    <div>
                                                        <a href="{{ route('books.show', $book->id) }}"
                                                            class="btn btn-sm btn-outline-primary border me-1">
                                                            <i class="fa-solid fa-eye"></i>
                                                        </a>
                                                    </div>
                                                    <div>
                                                        <a href="{{ route('books.edit', $book->id) }}"
                                                            class="btn btn-sm btn-outline-secondary border me-1">
                                                            <i class="fa-solid fa-pen fa-fw"></i>
                                                        </a>
                                                    </div>
                                                    <div>
                                                        <form action="{{ route('books.destroy', $book->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-outline-warning border show_confirm">
                                                                <i class="fa-solid fa-trash-can fa-fw"></i>
                                                            </button>
                                                        </form>
                                                    </div>
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

    @push('backend_script')
        @include('backend.pages.common.script')
        <script>
            $(document).ready(function() {
                $(document).on('change', '.toggle-class', function() {
                    var bookId = $(this).data('id');
                    var url = "{{ route('book.is_active.ajax', ':book_id') }}";
                    url = url.replace(':book_id', bookId);

                    $.ajax({
                        type: "GET",
                        url: url,
                        success: function(data) {
                            if (data.type === 'success') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success!',
                                    text: data.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            }
                        },
                        error: function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'Something went wrong!',
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
                    });
                });

                $('#book_category_id').on('change', function() {
                    var categoryId = $(this).val();

                    if (categoryId) {
                        $.ajax({
                            url: "{{ route('book.get.subcategories', ':category_id') }}".replace(':category_id', categoryId),
                            type: "GET",
                            dataType: "json",
                            success: function(data) {
                                $('#book_subcategory_id').empty();
                                $('#book_subcategory_id').append('<option value="">Select Subcategory</option>');

                                $.each(data, function(key, value) {
                                    $('#book_subcategory_id').append('<option value="' + value.id + '">' + value.name + '</option>');
                                });

                                $('#book_subcategory_id').prop('disabled', false);
                            }
                        });
                    } else {
                        $('#book_subcategory_id').empty();
                        $('#book_subcategory_id').append('<option value="">Select Subcategory</option>');
                        $('#book_subcategory_id').prop('disabled', true);
                    }
                });
            });
        </script>
    @endpush
@endsection
