@extends('backend.layouts.master')

@section('title', 'Exam Category')

@push('backend_style')
    @include('backend.pages.common.style')
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Exam Category</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Exam Category</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <h3 class="card-title">Create Exam Category</h3>
                    <a href="{{ route('exam_categories.trash') }}" class="btn btn-sm btn-outline-warning border"><i
                            class="fa-solid fa-trash-can-arrow-up fa-fw"></i> View Trash</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('exam_categories.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name"
                                        value="{{ old('name') }}" required>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="slug">Slug (Optional - Auto-generated if left empty)</label>
                                    <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror" id="slug"
                                        value="{{ old('slug') }}">
                                    @error('slug')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="number" step="0.01" name="price" class="form-control @error('price') is-invalid @enderror" id="price"
                                        value="{{ old('price', 0) }}" required>
                                    @error('price')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="form-group">
                                    <label for="discount">Discount</label>
                                    <input type="number" step="0.01" name="discount" class="form-control @error('discount') is-invalid @enderror" id="discount"
                                        value="{{ old('discount', 0) }}">
                                    @error('discount')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="free_paid">Type</label>
                                    <select name="free_paid" class="form-control @error('free_paid') is-invalid @enderror" id="free_paid" required>
                                        <option value="free" {{ old('free_paid') == 'free' ? 'selected' : '' }}>Free</option>
                                        <option value="paid" {{ old('free_paid') == 'paid' ? 'selected' : '' }}>Paid</option>
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
                                    @error('image')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h3 class="card-title">Exam Category List</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive export-table">
                        <table id="file-datatable" class="table table-bordered text-nowrap key-buttons border-bottom w-100">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">Image</th>
                                    <th class="border-bottom-0">Name</th>
                                    <th class="border-bottom-0">Price</th>
                                    <th class="border-bottom-0">Discount</th>
                                    <th class="border-bottom-0">Type</th>
                                    <th class="border-bottom-0">Status</th>
                                    <th class="border-bottom-0">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td><strong>{{ $categories->firstItem() + $loop->index }}</strong></td>
                                        <td>
                                            @if($category->image)
                                                <img src="{{ asset('uploads/exam_categories/' . $category->image) }}" alt="" style="height: 50px">
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->price }}</td>
                                        <td>{{ $category->discount }}</td>
                                        <td>{{ ucfirst($category->free_paid) }}</td>
                                        <td>
                                            <div class="material-switch">
                                                <input id="active-{{ $category->id }}" class="toggle-class-active" name="is_active"
                                                    type="checkbox" {{ $category->is_active ? 'checked' : '' }}
                                                    data-id="{{ $category->id }}">
                                                <label for="active-{{ $category->id }}" class="label-success"></label>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="action-btns d-flex align-items-center">
                                                <div>
                                                    <a href="{{ route('exam_categories.edit', $category->id) }}"
                                                        class="btn btn-sm btn-outline-secondary border me-2"
                                                        data-toggle="tooltip" data-placement="top"
                                                        title="Edit">
                                                        <i class="fa-solid fa-pen fa-fw"></i>
                                                    </a>
                                                </div>
                                                <div>
                                                    <form action="{{ route('exam_categories.destroy', $category->id) }}" method="POST"
                                                        class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-sm btn-outline-warning border show_confirm"
                                                            data-toggle="tooltip" data-placement="top"
                                                            title="Delete">
                                                            <i class="fa-solid fa-trash-can fa-fw"></i>
                                                        </button>
                                                    </form>
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
    
    <script type="text/javascript">
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

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

            // Toggle active status
            $('.toggle-class-active').change(function() {
                var id = $(this).data('id');
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '/admin/check/exam_category/is_active/' + id,
                    success: function(data) {
                        Swal.fire({ title: data.message, text: data.message, icon: data.type });
                    }
                });
            });
        });
    </script>
@endpush
