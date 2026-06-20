@extends('backend.layouts.master')

@section('title', 'PDF Book')

@push('backend_style')
    @include('backend.pages.common.style')
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">PDF Book</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">PDF Book</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <h3 class="card-title">Create PDF Book</h3>
                    @can('delete-pdf-book')
                        <a href="{{ route('pdf_books.trash') }}" class="btn btn-sm btn-outline-warning border">
                            <i class="fa-solid fa-trash-can-arrow-up fa-fw"></i> View Trash
                        </a>
                    @endcan
                </div>
                <div class="card-body">
                    @can('create-pdf-book')
                        <form action="{{ route('pdf_books.store') }}" method="POST" enctype="multipart/form-data">
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
                                    <label for="pdf_book_category_id">Category</label>
                                    <select name="pdf_book_category_id" id="pdf_book_category_id"
                                        class="form-control select2-style1 @error('pdf_book_category_id') is-invalid @enderror">
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('pdf_book_category_id') == $category->id ? 'selected' : '' }}>
                                                {!! $category->name !!}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('pdf_book_category_id')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="pdf_book_subcategory_id">Subcategory</label>
                                    <select name="pdf_book_subcategory_id" id="pdf_book_subcategory_id"
                                        class="form-control select2-style1 @error('pdf_book_subcategory_id') is-invalid @enderror" disabled>
                                        <option value="">Select Subcategory</option>
                                    </select>
                                    @error('pdf_book_subcategory_id')
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
                                    <textarea name="description" id="description" data-summernote
                                        class="form-control @error('description') is-invalid @enderror"
                                        rows="4">{{ old('description') }}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="author_name">Author Name</label>
                                    <input type="text" name="author_name" id="author_name"
                                        class="form-control @error('author_name') is-invalid @enderror"
                                        value="{{ old('author_name') }}">
                                    @error('author_name')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="author_profile">Author Profile</label>
                                    <input type="file" name="author_profile" id="author_profile"
                                        class="form-control @error('author_profile') is-invalid @enderror">
                                    @error('author_profile')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="author_description">Author Description</label>
                                    <textarea name="author_description" id="author_description" data-summernote
                                        class="form-control @error('author_description') is-invalid @enderror"
                                        rows="3">{{ old('author_description') }}</textarea>
                                    @error('author_description')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="image">Cover Image <span class="text-danger">*</span></label>
                                    <input type="file" name="image" id="image"
                                        class="form-control @error('image') is-invalid @enderror" required>
                                    @error('image')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="pdf_file">PDF File <span class="text-danger">*</span></label>
                                    <input type="file" name="pdf_file" id="pdf_file"
                                        class="form-control @error('pdf_file') is-invalid @enderror" required>
                                    @error('pdf_file')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            </div>

                            <button class="btn btn-primary" type="submit">Create</button>
                        </form>
                    @endcan
                </div>
            </div>
        </div>
    </div>

    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h3 class="card-title">PDF Book List</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive export-table">
                        <table id="file-datatable" class="table table-bordered text-nowrap key-buttons border-bottom w-100">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Category</th>
                                    <th>Subcategory</th>
                                    <th>Image</th>
                                    <th>PDF</th>
                                    <th>Price</th>
                                    @can('edit-pdf-book')
                                        <th>Status</th>
                                    @endcan
                                    @canany(['index-pdf-book', 'edit-pdf-book', 'delete-pdf-book'])
                                        <th>Actions</th>
                                    @endcanany
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($books as $book)
                                    <tr>
                                        <td><strong>{{ $books->firstItem() + $loop->index }}</strong></td>
                                        <td>{{ $book->name }}</td>
                                        <td>{{ $book->slug }}</td>
                                        <td>{{ $book->pdfBookCategory ? $book->pdfBookCategory->name : 'N/A' }}</td>
                                        <td>{{ $book->pdfBookSubcategory ? $book->pdfBookSubcategory->name : 'N/A' }}</td>
                                        <td>
                                            @if ($book->image)
                                                <img src="{{ asset('uploads/pdfbooks/images/' . $book->image) }}" alt="" style="height: 50px">
                                            @else
                                                <span>No Image</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($book->pdf_file)
                                                <a href="{{ asset('uploads/pdfbooks/files/' . $book->pdf_file) }}" target="_blank" class="btn btn-sm btn-info">View PDF</a>
                                            @else
                                                <span>No File</span>
                                            @endif
                                        </td>
                                        <td>{{ $book->price }}</td>
                                        @can('edit-pdf-book')
                                            <td>
                                                <div class="material-switch">
                                                    <input id="book-{{ $book->id }}" class="toggle-class" name="is_active"
                                                        type="checkbox" {{ $book->is_active ? 'checked' : '' }}
                                                        data-id="{{ $book->id }}">
                                                    <label for="book-{{ $book->id }}" class="label-success"></label>
                                                </div>
                                            </td>
                                        @endcan
                                        @canany(['index-pdf-book', 'edit-pdf-book', 'delete-pdf-book'])
                                            <td class="text-center">
                                                <div class="action-btns d-flex align-items-center justify-content-center">
                                                    @can('index-pdf-book')
                                                        <div>
                                                            <a href="{{ route('pdf_books.show', $book->id) }}"
                                                                class="btn btn-sm btn-outline-primary border me-1">
                                                                <i class="fa-solid fa-eye"></i>
                                                            </a>
                                                        </div>
                                                    @endcan
                                                    @can('edit-pdf-book')
                                                        <div>
                                                            <a href="{{ route('pdf_books.edit', $book->id) }}"
                                                                class="btn btn-sm btn-outline-secondary border me-1">
                                                                <i class="fa-solid fa-pen fa-fw"></i>
                                                            </a>
                                                        </div>
                                                    @endcan
                                                    @can('delete-pdf-book')
                                                        <div>
                                                            <form action="{{ route('pdf_books.destroy', $book->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-sm btn-outline-warning border show_confirm">
                                                                    <i class="fa-solid fa-trash-can fa-fw"></i>
                                                                </button>
                                                            </form>
                                                        </div>
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

    @push('backend_script')
        @include('backend.pages.common.script')
        <script>
            $(document).ready(function() {
                $(document).on('change', '.toggle-class', function() {
                    var bookId = $(this).data('id');
                    var url = "{{ route('pdf_book.is_active.ajax', ':book_id') }}";
                    url = url.replace(':book_id', bookId);

                    $.ajax({
                        type: "GET",
                        url: url,
                        success: function(data) {
                            Swal.fire({ icon: data.type, title: 'Success!', text: data.message, showConfirmButton: false, timer: 1500 });
                        }
                    });
                });

                $('#pdf_book_category_id').on('change', function() {
                    var categoryId = $(this).val();
                    if (categoryId) {
                        $.ajax({
                            url: "{{ route('pdf_book.get.subcategories', ':category_id') }}".replace(':category_id', categoryId),
                            type: "GET",
                            dataType: "json",
                            success: function(data) {
                                $('#pdf_book_subcategory_id').empty();
                                $('#pdf_book_subcategory_id').append('<option value="">Select Subcategory</option>');
                                $.each(data, function(key, value) {
                                    $('#pdf_book_subcategory_id').append('<option value="' + value.id + '">' + value.name + '</option>');
                                });
                                $('#pdf_book_subcategory_id').prop('disabled', false);
                            }
                        });
                    } else {
                        $('#pdf_book_subcategory_id').empty();
                        $('#pdf_book_subcategory_id').append('<option value="">Select Subcategory</option>');
                        $('#pdf_book_subcategory_id').prop('disabled', true);
                    }
                });
            });
        </script>
    @endpush
@endsection
