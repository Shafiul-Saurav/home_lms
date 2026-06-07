@extends('backend.layouts.master')

@section('title', 'Manual Course Enrollment')

@push('backend_style')
    @include('backend.pages.common.style')
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Course Enrollment</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('orders.course_enrollment') }}">Course Enrollment</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Manual Enroll</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h3 class="card-title">Enroll Student Manually</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('orders.course_enrollment.manual_confirm') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="user_id" class="form-label">Select Student <span class="text-danger">*</span></label>
                                    <select id="user_id" name="user_id"
                                        class="form-control select2 form-select
                                    @error('user_id')
                                        is-invalid
                                    @enderror" required>
                                        <option value="">Choose a Student</option>
                                        @forelse ($users as $user)
                                            @php
                                                $profileImage = $user->profile->profileImage->profile_image ?? null;
                                                $photoPath = $user->profile_photo_path ?? null;
                                                $avatarUrl = $profileImage
                                                    ? asset($profileImage)
                                                    : ($photoPath ? asset($photoPath) : '');
                                            @endphp
                                            <option value="{{ $user->id }}"
                                                    data-image="{{ $avatarUrl }}"
                                                    {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                                {{ $user->name }} ({{ $user->email }}) {{ $user->phone ? '- ' . $user->phone : '' }}
                                            </option>
                                        @empty
                                        @endforelse
                                    </select>
                                    @error('user_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="course_id" class="form-label">Select Course <span class="text-danger">*</span></label>
                                    <select id="course_id" name="course_id"
                                        class="form-control select2 form-select
                                    @error('course_id')
                                        is-invalid
                                    @enderror" required>
                                        <option value="">Choose a Course</option>
                                        @forelse ($courses as $course)
                                            <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>
                                                {{ $course->name }} - ৳{{ $course->price - $course->discount }}
                                            </option>
                                        @empty
                                        @endforelse
                                    </select>
                                    @error('course_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- <div class="alert alert-info mt-3" role="alert">
                            <i class="fa-solid fa-circle-info me-2"></i> This will create a manual enrollment record with status <b>Enrolled</b> and payment status <b>Completed</b>.
                        </div> --}}

                        <div class="mt-4">
                            <button class="btn btn-primary" type="submit">Enroll Student</button>
                            <a href="{{ route('orders.course_enrollment') }}" class="btn btn-light ms-2">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('backend_script')
    @include('backend.pages.common.script')
    <script>
        $(document).ready(function() {
            function formatStudent(user) {
                if (!user.id) {
                    return user.text;
                }

                var imageUrl = $(user.element).data('image');
                if (!imageUrl) {
                    return user.text;
                }

                var $container = $(
                    `<div class="d-flex align-items-center">
                        <img src="${imageUrl}" class="rounded-circle me-2" style="width:28px; height:28px; object-fit:cover;" />
                        <span></span>
                    </div>`
                );
                $container.find('span').text(user.text);
                return $container;
            }

            // Initialize user select with custom templates and course select separately
            $('#user_id').select2({
                width: '100%',
                minimumResultsForSearch: 0,
                templateResult: formatStudent,
                templateSelection: formatStudent,
                escapeMarkup: function(m) { return m; }
            });

            $('#course_id').select2({
                width: '100%',
                minimumResultsForSearch: 0
            });

            // Store original course option text to restore later
            $('#course_id option').each(function() {
                $(this).attr('data-original-text', $(this).text());
            });

            function markEnrolledCourses(enrolledIds) {
                $('#course_id option').each(function() {
                    var $opt = $(this);
                    var val = $opt.val();

                    // Skip placeholder
                    if (!val) return;

                    var original = $opt.attr('data-original-text') || $opt.text();

                    if (enrolledIds.includes(parseInt(val))) {
                        // mark disabled and append label if not already
                        $opt.prop('disabled', true);
                        if ($opt.text().indexOf('— Enrolled') === -1) {
                            $opt.text(original + ' — Enrolled');
                        }
                    } else {
                        $opt.prop('disabled', false);
                        $opt.text(original);
                    }
                });

                // If currently selected course is now disabled, clear selection
                var selected = $('#course_id').val();
                if (selected && $('#course_id option:selected').prop('disabled')) {
                    $('#course_id').val('');
                }

                // Reinitialize course select2 so it picks up disabled states and updated texts
                try {
                    $('#course_id').select2('destroy');
                } catch (e) {}
                $('#course_id').select2({
                    width: '100%',
                    minimumResultsForSearch: 0
                });
            }

            // Fetch enrolled courses for selected user
            function fetchEnrolled(userId) {
                if (!userId) {
                    // restore all
                    markEnrolledCourses([]);
                    return;
                }

                var url = "{{ route('orders.user.enrolled_courses', ':user_id') }}";
                url = url.replace(':user_id', userId);

                $.get(url).done(function(res) {
                    var enrolled = res.enrolled || [];
                    markEnrolledCourses(enrolled);
                }).fail(function() {
                    // on error, do nothing (keep all enabled)
                    markEnrolledCourses([]);
                });
            }

            // When user changes, update course dropdown
            $('#user_id').on('change', function() {
                var userId = $(this).val();
                fetchEnrolled(userId);
            });

            // On page load, if a user is preselected, fetch enrolled courses
            var initialUser = $('#user_id').val();
            if (initialUser) {
                fetchEnrolled(initialUser);
            }
        });
    </script>
@endpush
