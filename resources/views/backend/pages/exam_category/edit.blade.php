@extends('backend.layouts.master')

@section('title', 'Edit Exam Category')

@push('backend_style')
    @include('backend.pages.common.style')
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Edit Exam Category</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('exam_categories.index') }}">Exam Category</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h3 class="card-title">Edit Exam Category</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('exam_categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name"
                                        value="{{ old('name', $category->name) }}" required>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="slug">Slug</label>
                                    <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror" id="slug"
                                        value="{{ old('slug', $category->slug) }}">
                                    @error('slug')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="number" step="0.01" name="price" class="form-control @error('price') is-invalid @enderror" id="price"
                                        value="{{ old('price', $category->price) }}" required>
                                    @error('price')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="form-group">
                                    <label for="discount">Discount</label>
                                    <input type="number" step="0.01" name="discount" class="form-control @error('discount') is-invalid @enderror" id="discount"
                                        value="{{ old('discount', $category->discount) }}">
                                    @error('discount')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="free_paid">Type</label>
                                    <select name="free_paid" class="form-control @error('free_paid') is-invalid @enderror" id="free_paid" required>
                                        <option value="free" {{ old('free_paid', $category->free_paid) == 'free' ? 'selected' : '' }}>Free</option>
                                        <option value="paid" {{ old('free_paid', $category->free_paid) == 'paid' ? 'selected' : '' }}>Paid</option>
                                    </select>
                                    @error('free_paid')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" id="image">
                                    @if($category->image)
                                        <div class="mt-2">
                                            <img src="{{ asset('uploads/exam_categories/' . $category->image) }}" alt="" style="height: 100px">
                                        </div>
                                    @endif
                                    @error('image')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="is_active" id="is_active" {{ $category->is_active ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active">Is Active</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('exam_categories.index') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('backend_script')
    <script>
        $(document).ready(function() {
            // Auto-generate slug from name
            $('#name').on('input propertychange paste', function() {
                var name = $(this).val();
                var slugField = $('#slug');

                if (!slugField.attr('data-manual-edit')) {
                    if(name && name.trim() !== '') {
                        var generatedSlug = name.toLowerCase()
                            .replace(/[^\w\s\u0980-\u09FF-]/g, '')
                            .replace(/[\s_-]+/g, '-')
                            .replace(/^-+|-+$/g, '')
                            .trim();
                        slugField.val(generatedSlug);
                    } else {
                        slugField.val('');
                    }
                }
            });

            $('#slug').on('input focus', function() {
                $(this).attr('data-manual-edit', 'true');
            });

            $('#slug').on('input', function() {
                if ($(this).val() === '') {
                    $(this).removeAttr('data-manual-edit');
                }
            });

            $('#name').on('focus', function() {
                if ($('#slug').val() === '') {
                    $('#slug').removeAttr('data-manual-edit');
                }
            });
        });
    </script>
@endpush
