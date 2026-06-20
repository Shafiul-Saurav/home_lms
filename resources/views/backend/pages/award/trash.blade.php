@extends('backend.layouts.master')

@section('title', 'Award Trash')

@push('backend_style')
    @include('backend.pages.common.style')
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Award Trash</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('awards.index') }}">Award</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Trash</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <h3 class="card-title">Trashed Awards</h3>
                    <a href="{{ route('awards.index') }}" class="btn btn-outline-info border">
                        <i class="fa-solid fa-angles-left fa-fw"></i> Back
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive export-table">
                        <table id="file-datatable" class="table table-bordered text-nowrap key-buttons border-bottom w-100">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>File</th>
                                    <th>Year</th>
                                    <th>Deleted At</th>
                                    @can('delete-award')
                                        <th>Actions</th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($awards as $award)
                                    <tr>
                                        <td><strong>{{ $awards->firstItem() + $loop->index }}</strong></td>
                                        <td>{{ $award->name }}</td>
                                        <td>{{ $award->slug }}</td>
                                        <td>
                                            @if ($award->file)
                                                <a href="{{ asset('uploads/awards/' . $award->file) }}" target="_blank">View</a>
                                            @else
                                                <span>No File</span>
                                            @endif
                                        </td>
                                        <td>{{ $award->year ?? 'N/A' }}</td>
                                        <td>{{ $award->deleted_at?->format('d-M-Y') }}</td>
                                        @can('delete-award')
                                            <td class="text-center">
                                                <div class="action-btns d-flex align-items-center justify-content-center">
                                                    <div>
                                                        <a href="{{ route('awards.restore', $award->id) }}"
                                                            class="btn btn-sm btn-outline-success border me-1 show_confirm_restore"
                                                            title="Restore">
                                                            <i class="fa-solid fa-rotate-left fa-fw"></i>
                                                        </a>
                                                    </div>
                                                    <div>
                                                        <form action="{{ route('awards.forcedelete', $award->id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-sm btn-outline-danger border show_confirm_force_delete"
                                                                title="Permanent Delete">
                                                                <i class="fa-solid fa-radiation"></i>
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

    @push('backend_script')
        @include('backend.pages.common.script')
        <script>
            $(document).ready(function() {
                $('.show_confirm_restore').click(function(event) {
                    var href = $(this).attr("href");
                    event.preventDefault();
                    Swal.fire({
                        title: `Are you sure you want to restore this record?`,
                        text: "If you restore this, it will be visible in the main list.",
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
                        text: "If you delete this, it will be gone forever.",
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
@endsection
