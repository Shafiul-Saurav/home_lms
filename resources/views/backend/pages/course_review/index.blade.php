@extends('backend.layouts.master')

@section('title', 'Course Reviews')

@push('backend_style')
    @include('backend.pages.common.style')
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Course Reviews</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Course Reviews</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <h3 class="card-title">Review List</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive export-table">
                        <table id="file-datatable" class="table table-bordered text-nowrap key-buttons border-bottom w-100">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">Course</th>
                                    <th class="border-bottom-0">User Name</th>
                                    <th class="border-bottom-0">Rating</th>
                                    <th class="border-bottom-0">Comment</th>
                                    <th class="border-bottom-0">Status</th>
                                    <th class="border-bottom-0">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reviews as $review)
                                    <tr>
                                        <td>
                                            <strong>{{ $reviews->firstItem() + $loop->index }}</strong>
                                        </td>
                                        <td>{{ Str::limit($review->course->name, 30) }}</td>
                                        <td>{{ $review->user->name }}</td>
                                        <td>
                                            @for($i=1; $i<=5; $i++)
                                                <i class="fa{{ $i <= $review->rating ? 's' : 'r' }} fa-star text-warning"></i>
                                            @endfor
                                        </td>
                                        <td>{{ Str::limit($review->comment, 50) }}</td>
                                        <td>
                                            <div class="material-switch">
                                                <input id="active-{{ $review->id }}" class="toggle-class-approval" name="is_approved"
                                                    type="checkbox" {{ $review->is_approved ? 'checked' : '' }}
                                                    data-id="{{ $review->id }}">
                                                <label for="active-{{ $review->id }}" class="label-success"></label>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="action-btns d-flex align-items-center">
                                                <div>
                                                    <form action="{{ route('course-reviews.destroy', $review->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-sm btn-outline-warning border show_confirm"
                                                            data-toggle="tooltip" data-placement="top"
                                                            data-bs-original-title="Delete">
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
                    <div class="mt-3">
                        {{ $reviews->links() }}
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
            $(document).on('change', '.toggle-class-approval', function() {
                var item_id = $(this).data('id');

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: `/admin/course-reviews/toggle-approval/${item_id}`,
                    success: function(response) {
                        Swal.fire({
                            title: response.message,
                            icon: response.type,
                            timer: 1500,
                            showConfirmButton: false
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
