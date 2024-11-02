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
                    <h3 class="card-title">Testimonial List</h3>
                    <a href="{{ route('testimonials.trash') }}" class="btn btn-sm btn-outline-warning border"><i
                            class="fa-solid fa-trash-can-arrow-up fa-fw"></i> View Trash</a>
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
                                    <th class="border-bottom-0">Home Page</th>
                                    <th class="border-bottom-0">Status</th>
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
                                        <td>
                                            <div class="material-switch">
                                                <input id="home-{{ $testimonial->id }}" class="toggle-class-home" name="is_home"
                                                    type="checkbox" {{ $testimonial->is_home ? 'checked' : '' }}
                                                    data-id="{{ $testimonial->id }}">
                                                <label for="home-{{ $testimonial->id }}" class="label-success"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="material-switch">
                                                <input id="active-{{ $testimonial->id }}" class="toggle-class-active" name="is_active"
                                                    type="checkbox" {{ $testimonial->is_active ? 'checked' : '' }}
                                                    data-id="{{ $testimonial->id }}">
                                                <label for="active-{{ $testimonial->id }}" class="label-success"></label>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="action-btns d-flex align-items-center">
                                                <div>
                                                    <a href="{{ route('testimonials.show', $testimonial->id) }}" class="btn btn-sm btn-outline-primary border me-2"
                                                        data-toggle="tooltip" data-placement="top"
                                                        data-bs-original-title="View">
                                                        <i class="fa-solid fa-eye"></i>
                                                    </a>
                                                </div>
                                                <div>
                                                    <form action="{{ route('testimonials.destroy', $testimonial->id) }}"
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
