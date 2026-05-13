@extends('backend.layouts.master')

@section('title', 'Edit Book')

@push('backend_style')
    @include('backend.pages.common.style')
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Edit Book</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('books.index') }}">Book</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Book</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h3 class="card-title">Edit Book</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
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
                                    <label for="book_category_id">Category</label>
                                    <select name="book_category_id" id="book_category_id"
                                        class="form-control @error('book_category_id') is-invalid @enderror">
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('book_category_id', $book->book_category_id) == $category->id ? 'selected' : '' }}>
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
                                        class="form-control @error('book_subcategory_id') is-invalid @enderror" {{ empty($subcategories) ? 'disabled' : '' }}>
                                        <option value="">Select Subcategory</option>
                                        @foreach ($subcategories as $subcategory)
                                            <option value="{{ $subcategory->id }}" {{ old('book_subcategory_id', $book->book_subcategory_id) == $subcategory->id ? 'selected' : '' }}>
                                                {!! $subcategory->name !!}
                                            </option>
                                        @endforeach
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
                                    <img src="{{ asset('uploads/books/authors/' . $book->author_profile) }}" alt="Author Profile" style="height: 100px; border-radius: 5px;">
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
                                    <label for="image">Image (Leave empty to keep existing)</label>
                                    <input type="file" name="image" id="image"
                                        class="form-control @error('image') is-invalid @enderror">
                                    @error('image')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3 d-flex align-items-center">
                                @if($book->image)
                                    <img src="{{ asset('uploads/books/' . $book->image) }}" alt="Book Image" style="height: 100px; border-radius: 5px;">
                                @endif
                            </div>
                        </div>

                        <button class="btn btn-primary" type="submit">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('backend_script')
        @include('backend.pages.common.script')
        <script>
            $(document).ready(function() {
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
