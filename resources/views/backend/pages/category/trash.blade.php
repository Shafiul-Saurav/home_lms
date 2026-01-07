@extends('backend.layouts.master')

@section('title', 'Category')

@push('backend_style')
    @include('backend.pages.common.style')
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Category</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Category</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <h3 class="card-title">Category Trashed List</h3>
                    <a href="{{ route('categories.index') }}" class="btn btn-info"><i class="fa-solid fa-angles-left fa-fw"></i>
                        Back</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive export-table">
                        <table id="file-datatable" class="table table-bordered text-nowrap key-buttons border-bottom w-100">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">Last Updated</th>
                                    <th class="border-bottom-0">Name</th>
                                    <th class="border-bottom-0">Slug</th>
                                    <th class="border-bottom-0">File</th>
                                    <th class="border-bottom-0">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td>
                                            <strong>{{ $categories->firstItem() + $loop->index }}</strong>
                                        </td>
                                        <td>{{ $category->updated_at->format('d-M-Y') }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->slug }}</td>
                                        <td>
                                            @if($category->file)
                                                <a href="{{ asset('uploads/categories/' . $category->file) }}" target="_blank">View File</a>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="action-btns d-flex align-items-center">
                                                <div>
                                                    <a href="{{ route('categories.restore', ['id' => $category->id]) }}"
                                                        class="btn btn-sm btn-outline-success border me-2" data-toggle="tooltip"
                                                        data-placement="top" data-bs-original-title="Restore"><i class="fa-solid fa-store"></i>
                                                    </a>
                                                </div>
                                                <div>
                                                    <form action="{{ route('categories.forcedelete', ['id' => $category->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger border show_confirm" data-toggle="tooltip"
                                                        data-placement="top" data-bs-original-title="Force Delete">
                                                            <i class="fa-solid fa-radiation"></i>
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
    <!-- End Row -->
@endsection

@push('backend_script')
    @include('backend.pages.common.script')
@endpush