@extends('backend.layouts.master')

@section('title', 'Book Subcategory Trash')

@push('backend_style')
    @include('backend.pages.common.style')
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Book Subcategory Trash</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('book_subcategories.index') }}">Book Subcategory</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Trash</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <h3 class="card-title">Trashed Book Subcategories</h3>
                    <a href="{{ route('book_subcategories.index') }}" class="btn btn-outline-info border"><i class="fa-solid fa-angles-left fa-fw"></i> Back</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive export-table">
                        <table id="file-datatable" class="table table-bordered text-nowrap key-buttons border-bottom w-100">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">Deleted At</th>
                                    <th class="border-bottom-0">Category</th>
                                    <th class="border-bottom-0">Name</th>
                                    <th class="border-bottom-0">Slug</th>
                                    <th class="border-bottom-0">File</th>
                                    @can('delete-book-subcategory')
                                        <th class="border-bottom-0">Actions</th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subcategories as $subcategory)
                                    <tr>
                                        <td><strong>{{ $subcategories->firstItem() + $loop->index }}</strong></td>
                                        <td>{{ $subcategory->deleted_at->format('d-M-Y') }}</td>
                                        <td>{{ $subcategory->bookCategory ? $subcategory->bookCategory->name : 'N/A' }}</td>
                                        <td>{{ $subcategory->name }}</td>
                                        <td>{{ $subcategory->slug }}</td>
                                        <td>
                                            @if ($subcategory->file)
                                                <a href="{{ asset('uploads/booksubcategories/' . $subcategory->file) }}"
                                                    target="_blank">View File</a>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        @can('delete-book-subcategory')
                                            <td class="text-center">
                                                <div class="action-btns d-flex align-items-center">
                                                    <div>
                                                        <a href="{{ route('book_subcategories.restore', $subcategory->id) }}"
                                                            class="btn btn-sm btn-outline-success border me-2 show_confirm_restore"
                                                            title="Restore">
                                                            <i class="fa-solid fa-rotate-left fa-fw"></i>
                                                        </a>
                                                    </div>
                                                    <div>
                                                        <form
                                                            action="{{ route('book_subcategories.forcedelete', $subcategory->id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-sm btn-outline-danger border show_confirm_force_delete"
                                                                title="Permanent Delete">
                                                                <i class="fa-solid fa-radiation fa-fw"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                        @endcan
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
    <script>
        $(document).ready(function() {
            $('.show_confirm_restore').click(function(event) {
                var href = $(this).attr("href");
                event.preventDefault();
                Swal.fire({
                    title: `Are you sure you want to restore this record?`,
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, restore it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = href;
                    }
                });
            });

            $('.show_confirm_force_delete').click(function(event) {
                var form = $(this).closest("form");
                event.preventDefault();
                Swal.fire({
                    title: `Are you sure you want to permanently delete this record?`,
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endpush
