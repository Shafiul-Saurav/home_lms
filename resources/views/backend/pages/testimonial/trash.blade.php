@extends('backend.layouts.master')

@section('title', 'Testimonials')

@push('backend_style')
    @include('backend.pages.common.style')
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Testimonials</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Testimonials</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <h3 class="card-title">Testimonials Trashed List</h3>
                    <a href="{{ route('testimonials.index') }}" class="btn btn-info"><i
                        class="fa-solid fa-angles-left fa-fw"></i>Back</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive export-table">
                        <table id="file-datatable" class="table table-bordered text-nowrap key-buttons border-bottom w-100">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">Last Updated</th>
                                    <th class="border-bottom-0">User Name</th>
                                    <th class="border-bottom-0">Profile</th>
                                    <th class="border-bottom-0">Review</th>
                                    <th class="border-bottom-0">Rating</th>
                                    <th class="border-bottom-0">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($testimonials as $testimonial)
                                    <tr>
                                        <td>
                                            <strong>{{ $testimonials->firstItem() + $loop->index }}</strong>
                                        </td>
                                        <td>{{ $testimonial->updated_at->format('d-M-Y') }}</td>
                                        <td>{{ $testimonial->user->name }}</td>
                                        <td>
                                            @if ($testimonial->user->profile->profileImage??null)
                                                <div class="avatar-container">
                                                    <img alt="avatar"
                                                        src="{{ asset($testimonial->user->profile->profileImage->profile_image??null) }}"
                                                        class="rounded-circle" style="width:30px; height: 30px">
                                                </div>
                                            @else
                                                <div class="avatar-container">
                                                    <img alt="avatar" src="{{ asset('profile/default_profile.png') }}"
                                                    class="rounded-circle" style="width:30px; height: 30px">
                                                </div>
                                            @endif
                                        </td>
                                        <td>{{ $testimonial->review }}</td>
                                        <td>{{ $testimonial->rating }}</td>
                                        <td class="text-center">
                                            <div class="action-btns d-flex align-items-center">
                                                <div>
                                                    <a href="{{ route('testimonials.restore', ['id' => $testimonial->id]) }}"
                                                        class="btn btn-sm btn-outline-success border me-2" data-toggle="tooltip"
                                                        data-placement="top" data-bs-original-title="Restore"><i class="fa-solid fa-store"></i>
                                                    </a>
                                                </div>
                                                <div>
                                                    <form action="{{ route('testimonials.forcedelete', ['id' => $testimonial->id]) }}"
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
    <script>
        $(document).ready(function() {
            $(document).on('change', '.toggle-class-home', function() {
                var item_id = $(this).data('id');

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: `/admin/check/testimonial/is_home/${item_id}`,
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
            $(document).on('change', '.toggle-class-active', function() {
                var item_id = $(this).data('id');

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: `/admin/check/testimonial/is_active/${item_id}`,
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
