@extends('backend.layouts.master')

@section('title', 'News Category')

@push('backend_style')
    @include('backend.pages.common.style')
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">News Category</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">News Category</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <h3 class="card-title">Create News Category</h3>
                    @can('delete-news-category')
                    <a href="{{ route('admin.newscategory.trash') }}" class="btn btn-sm btn-outline-warning border"><i
                            class="fa-solid fa-trash-can-arrow-up fa-fw"></i> View Trash</a>
                    @endcan
                </div>
                <div class="card-body">
                    <form action="{{ route('newscategories.store') }}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" name="title" class="form-control @error('title')
                                        is-invalid
                                    @enderror" id="title"
                                        value="{{ old('title') }}" required>
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary" type="submit">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h3 class="card-title">News Category List</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive export-table">
                        <table id="file-datatable" class="table table-bordered text-nowrap key-buttons border-bottom w-100">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">Last Updated</th>
                                    <th class="border-bottom-0">Category Name</th>
                                    {{-- @can('edit-news-category') --}}
                                    <th class="border-bottom-0">Status</th>
                                    {{-- @endcan
                                    @canany(['edit-news-category', 'delete-news-category']) --}}
                                    <th class="border-bottom-0">Actions</th>
                                    {{-- @endcanany --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td>
                                            <strong>{{ $loop->iteration }}</strong>
                                        </td>
                                        <td>{{ $category->updated_at->format('d-M-Y') }}</td>
                                        <td>{{ $category->title }}</td>
                                        {{-- @can('edit-news-category') --}}
                                        <td>
                                            <div class="material-switch">
                                                <input id="active-{{ $category->id }}" class="toggle-class-active" name="is_active"
                                                    type="checkbox" {{ $category->is_active ? 'checked' : '' }}
                                                    data-id="{{ $category->id }}">
                                                <label for="active-{{ $category->id }}" class="label-success"></label>
                                            </div>
                                        </td>
                                        {{-- @endcan --}}
                                        {{-- @canany(['edit-news-category', 'delete-news-category']) --}}
                                            <td class="text-center">
                                                <div class="action-btns d-flex align-items-center justify-content-center">
                                                    {{-- @can('edit-news-category') --}}
                                                        <a href="{{ route('newscategories.edit', $category->id) }}"
                                                            class="btn btn-sm btn-outline-secondary border me-2"
                                                            title="Edit">
                                                            <i class="fa-solid fa-pen fa-fw"></i>
                                                        </a>
                                                    {{-- @endcan --}}
                                                    {{-- @can('delete-news-category') --}}
                                                        <form action="{{ route('newscategories.destroy', $category->id) }}" method="POST"
                                                            class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-sm btn-outline-warning border show_confirm"
                                                                title="Delete">
                                                                <i class="fa-solid fa-trash-can fa-fw"></i>
                                                            </button>
                                                        </form>
                                                    {{-- @endcan --}}
                                                </div>
                                            </td>
                                        {{-- @endcanany --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
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
            $(document).on('change', '.toggle-class-active', function() {
                var item_id = $(this).data('id');

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: `/admin/check/newscategory/is_active/${item_id}`,
                    success: function(response) {
                        console.log(response);
                        Swal.fire({
                            title: response.message,
                            text: response.message,
                            icon: response.type,
                        });
                    },
                    error: function(err) {
                        console.error(err);
                    }
                });
            });
        });
    </script>
@endpush
