<div class="row g-4 mt-2">
    @forelse ($enrolledCourses as $order)
        @php $course = $order->course; @endphp
        <div class="col-6 col-md-6 col-lg-6 col-xl-4 px-1 px-md-2 mt-2">
            <div class="course-item">
                <span
                    class="course-tag {{ $course->live_or_record == 'live' ? 'c1' : ($course->live_or_record == 'record' ? 'c2' : 'c1') }}">{{ $course->live_or_record ? ucfirst($course->live_or_record) : 'Course' }}</span>
                <div class="course-img">
                    <a href="{{ route('course.video', ['course_id' => $course->id]) }}">
                        <img src="{{ asset('uploads/courses/' . $course->image) }}"
                            alt="{{ $course->name }}" />
                    </a>
                </div>
                <div class="course-content">
                    <div class="course-meta">
                        <span
                            class="category c1">{{ $course->category->name ?? 'Category' }}</span>
                        <div class="rating">
                            <i class="fas fa-star"></i>
                            <span>{{ $course->averageRating() }} ({{ $course->reviewCount() }})</span>
                        </div>
                    </div>
                    <h4 class="course-title">
                        <a
                            href="{{ route('course.video', ['course_id' => $course->id]) }}">{{ $course->name }}</a>
                    </h4>
                    <div class="course-info">
                        <ul>
                            <li class="lecture"><i
                                    class="fad fa-book-open-reader"></i>{{ $course->lessons()->count() }}
                                Lessons</li>
                            <li class="duration"><i
                                    class="fad fa-clock-rotate-left"></i>{{ $course->courseModules()->count() }}
                                Modules</li>
                        </ul>
                    </div>
                    <div class="course-progress" style="height: 6px; background: #f1f5f9; border-radius: 10px; margin: 15px 0; overflow: hidden;">
                        <div class="course-progress-width" style="width: {{ $order->progress ?? 0 }}%; height: 100%; background: linear-gradient(90deg, #4f46e5, #9333ea); transition: width 1s ease-in-out;"></div>
                    </div>
                    <div class="course-bottom">
                        <a href="#">
                            <div class="course-instructor">
                                @php $mainTeacher = $course->teachers->first(); @endphp
                                @if ($mainTeacher && $mainTeacher->profile_image && $mainTeacher->profile_image !== 'default_profile_image.jpg')
                                    <img src="{{ asset('uploads/teachers/' . $mainTeacher->profile_image) }}"
                                        alt="{{ $mainTeacher->user->name }}" />
                                @else
                                    <img src="{{ asset('assets/frontend/img/course/ins-1.jpg') }}"
                                        alt="Instructor" />
                                @endif
                                <h6>{{ $mainTeacher->user->name ?? 'Instructor' }}
                                </h6>
                            </div>
                        </a>
                        <div class="course-status">
                            <span>{{ $order->progress ?? 0 }}% Finish</span>
                        </div>
                    </div>
                    <a href="{{ route('course.video', ['course_id' => $course->id]) }}"
                        class="theme-btn"><span
                            class="far fa-circle-play"></span> Start Learning</a>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="alert alert-info text-center">
                No enrolled courses found matching your criteria.
            </div>
        </div>
    @endforelse
</div>
<!-- pagination -->
@if($enrolledCourses->hasPages())
    @include('frontendone.pages.courses.partials.pagination', ['courses' => $enrolledCourses])
@endif
<!-- pagination end -->
