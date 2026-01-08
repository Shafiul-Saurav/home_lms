@extends('backend.layouts.master')

@section('title', 'Childcategory Edit')

@push('backend_style')
    @include('backend.pages.common.style')
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Childcategory</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Childcategory Edit</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <h3 class="card-title">Update Childcategory</h3>
                    <a href="{{ route('childcategories.index') }}" class="btn btn-info"><i
                            class="fa-solid fa-angles-left fa-fw"></i>Back</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('childcategories.update', $childcategory->slug) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="category_id">Category</label>
                                    <select name="category_id" class="form-control @error('category_id')
                                        is-invalid
                                    @enderror" id="category_id" required>
                                        <option value="">Select Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id', $childcategory->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="subcategory_id">Subcategory</label>
                                    <select name="subcategory_id" class="form-control @error('subcategory_id')
                                        is-invalid
                                    @enderror" id="subcategory_id" required disabled>
                                        <option value="">Select Subcategory</option>
                                        @if(isset($subcategories_by_category))
                                            @foreach($subcategories_by_category as $subcategory)
                                                <option value="{{ $subcategory->id }}" {{ old('subcategory_id', $childcategory->subcategory_id) == $subcategory->id ? 'selected' : '' }}>{{ $subcategory->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('subcategory_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name"
                                        class="form-control @error('name')
                                        is-invalid
                                    @enderror"
                                        id="name" value="{{ old('name', $childcategory->name) }}" required>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="file">File</label>
                                    <input type="file" name="file" class="form-control @error('file')
                                        is-invalid
                                    @enderror" id="file">
                                    @error('file')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                    @if($childcategory->file)
                                        <div class="mt-2">
                                            <p>Current File:</p>
                                            <a href="{{ asset('uploads/childcategories/' . $childcategory->file) }}" target="_blank">View Current File</a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-check">
                                    <input type="checkbox" name="is_active" class="form-check-input" id="is_active" value="1" {{ old('is_active', $childcategory->is_active) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_active">Active</label>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-secondary" type="submit">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Row -->
@endsection

@push('backend_script')
    @include('backend.pages.common.script')
    <script>
        $(document).ready(function() {
            // Load subcategories based on selected category
            var selectedCategoryId = $('#category_id').val();
            var selectedSubcategoryId = '{{ old('subcategory_id', $childcategory->subcategory_id) }}';

            if(selectedCategoryId) {
                $.ajax({
                    url: '/admin/get-subcategories/' + selectedCategoryId,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('#subcategory_id').empty();
                        $('#subcategory_id').append('<option value="">Select Subcategory</option>');

                        $.each(data, function(key, value) {
                            var isSelected = (value.id == selectedSubcategoryId) ? 'selected' : '';
                            $('#subcategory_id').append('<option value="' + value.id + '" ' + isSelected + '>' + value.name + '</option>');
                        });

                        $('#subcategory_id').prop('disabled', false);
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        alert('Error loading subcategories');
                    }
                });
            }

            // Dependent dropdown functionality
            $('#category_id').on('change', function() {
                var categoryId = $(this).val();

                if(categoryId) {
                    $.ajax({
                        url: '/admin/get-subcategories/' + categoryId,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('#subcategory_id').empty();
                            $('#subcategory_id').append('<option value="">Select Subcategory</option>');

                            $.each(data, function(key, value) {
                                $('#subcategory_id').append('<option value="' + value.id + '">' + value.name + '</option>');
                            });

                            $('#subcategory_id').prop('disabled', false);
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                            alert('Error loading subcategories');
                        }
                    });
                } else {
                    $('#subcategory_id').empty();
                    $('#subcategory_id').append('<option value="">Select Subcategory</option>');
                    $('#subcategory_id').prop('disabled', true);
                }
            });
        });
    </script>
@endpush