<div class="col-md-6 col-lg-6 col-xl-4">
    <div class="course-item">
        <span class="course-tag {{ $course->live_or_record == 'live' ? 'c1' : ($course->live_or_record == 'record' ? 'c2' : 'c1') }}">
            {{ $course->live_or_record ? ucfirst($course->live_or_record) : 'Course' }}
        </span>
        <div class="course-img">
            <a href="{{ route('course.details', $course->id) }}">
                <img src="{{ asset('uploads/courses/' . $course->image) }}" alt="{{ $course->name }}" />
            </a>
        </div>
        <div class="course-content">
            <div class="course-meta">
                <span class="category c1">
                    {{ $course->category->name ?? 'Uncategorized' }}
                </span>
                <div class="rating">
                    <i class="fas fa-star"></i>
                    <span>{{ $course->averageRating() }} ({{ $course->reviewCount() }})</span>
                </div>
            </div>
            <h4 class="course-title">
                <a href="{{ route('course.details', $course->id) }}">
                    {{ Str::limit($course->name, 50) }}
                </a>
            </h4>
            <div class="course-info">
                <ul>
                    <li class="lecture">
                        <i class="fad fa-book-open-reader"></i>
                        {{ $course->lessons()->count() }} Lessons
                    </li>
                    <li class="duration">
                        <i class="fad fa-clock-rotate-left"></i>
                        {{ $course->courseModules()->count() }} Modules
                    </li>
                </ul>
            </div>
            <div class="course-bottom">
                <a href="{{ route('course.details', $course->id) }}">
                    <div class="course-instructor">
                        @php
                            $mainTeacher = $course->teachers->first();
                        @endphp
                        @if ($mainTeacher && $mainTeacher->profile_image && $mainTeacher->profile_image !== 'default_profile_image.jpg')
                            <img src="{{ asset('uploads/teachers/' . $mainTeacher->profile_image) }}"
                                alt="{{ $mainTeacher->user->name }}" />
                        @else
                            <img src="{{ asset('assets/frontend') }}/img/course/ins-1.jpg" alt="Instructor" />
                        @endif
                        <h6>{{ $mainTeacher->user->name ?? 'Instructor' }}</h6>
                    </div>
                </a>
                <div class="course-price">
                    @if ($course->discount)
                        <del>${{ number_format($course->price, 2) }}</del>
                        <span>${{ number_format($course->price - $course->discount, 2) }}</span>
                    @elseif($course->price > 0)
                        <span>${{ number_format($course->price, 2) }}</span>
                    @else
                        <span class="text-success">Free</span>
                    @endif
                </div>
            </div>
            <div class="hero-btn wow fadeInUp" data-delay="1s" style="visibility: visible; animation-name: fadeInUp;">
                @if(Auth::check() && Auth::user()->isEnrolledInCourse($course->id))
                    <a href="{{ route('course.details', $course->id) }}" class="theme-btn2 btn-sm w-100 py-1 mt-2">Enrolled</a>
                @else
                    <a href="{{ route('course.details', $course->id) }}" class="theme-btn btn-sm w-100 py-1 mt-2">Enroll Now</a>
                @endif
            </div>
        </div>
    </div>
</div>
