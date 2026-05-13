@extends('backend.layouts.master')

@section('title', 'Edit PDF Book')

@push('backend_style')
    @include('backend.pages.common.style')
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Edit PDF Book</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('pdf_books.index') }}">PDF Book</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h3 class="card-title">Edit PDF Book</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('pdf_books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="name">Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" id="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name', $book->name) }}" required>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="pdf_book_category_id">Category</label>
                                    <select name="pdf_book_category_id" id="pdf_book_category_id"
                                        class="form-control @error('pdf_book_category_id') is-invalid @enderror">
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('pdf_book_category_id', $book->pdf_book_category_id) == $category->id ? 'selected' : '' }}>
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
                                        class="form-control @error('pdf_book_subcategory_id') is-invalid @enderror">
                                        <option value="">Select Subcategory</option>
                                        @foreach ($subcategories as $subcategory)
                                            <option value="{{ $subcategory->id }}" {{ old('pdf_book_subcategory_id', $book->pdf_book_subcategory_id) == $subcategory->id ? 'selected' : '' }}>
                                                {!! $subcategory->name !!}
                                            </option>
                                        @endforeach
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
                                        value="{{ old('price', $book->price) }}" required>
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
                                        value="{{ old('discount_amount', $book->discount_amount) }}">
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
                                        <option value="1" {{ old('is_active', $book->is_active) == '1' ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ old('is_active', $book->is_active) == '0' ? 'selected' : '' }}>Inactive</option>
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
                                        rows="4">{{ old('description', $book->description) }}</textarea>
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
                                        value="{{ old('author_name', $book->author_name) }}">
                                    @error('author_name')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="author_profile">Author Profile</label>
                                    <input type="file" name="author_profile" id="author_profile"
                                        class="form-control @error('author_profile') is-invalid @enderror">
                                    @error('author_profile')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-2 mb-3 d-flex align-items-center">
                                @if($book->author_profile)
                                    <img src="{{ asset('uploads/pdfbooks/authors/' . $book->author_profile) }}" alt="Author Profile" style="height: 100px; border-radius: 5px;">
                                @endif
                            </div>

                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="author_description">Author Description</label>
                                    <textarea name="author_description" id="author_description" data-summernote
                                        class="form-control @error('author_description') is-invalid @enderror"
                                        rows="3">{{ old('author_description', $book->author_description) }}</textarea>
                                    @error('author_description')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="image">Cover Image</label>
                                    <input type="file" name="image" id="image"
                                        class="form-control @error('image') is-invalid @enderror">
                                    @if ($book->image)
                                        <div class="mt-2 text-center">
                                            <img src="{{ asset('uploads/pdfbooks/images/' . $book->image) }}" alt="" style="height: 100px">
                                        </div>
                                    @endif
                                    @error('image')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="pdf_file">PDF File</label>
                                    <input type="file" name="pdf_file" id="pdf_file"
                                        class="form-control @error('pdf_file') is-invalid @enderror">
                                    @if ($book->pdf_file)
                                        <div class="mt-2">
                                            <p>Current PDF: <a href="{{ asset('uploads/pdfbooks/files/' . $book->pdf_file) }}" target="_blank">View File</a></p>
                                        </div>
                                    @endif
                                    @error('pdf_file')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <button class="btn btn-primary" type="submit">Update</button>
                        <a href="{{ route('pdf_books.index') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('backend_script')
        @include('backend.pages.common.script')
        <script>
            $(document).ready(function() {
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
                            }
                        });
                    } else {
                        $('#pdf_book_subcategory_id').empty();
                        $('#pdf_book_subcategory_id').append('<option value="">Select Subcategory</option>');
                    }
                });
            });
        </script>
    @endpush
@endsection
