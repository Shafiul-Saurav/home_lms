<div class="col-md-6 col-lg-6 col-xl-4">
    <div class="course-item">
        <span class="course-tag c1">
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
                    <span>{{ $course->lessons_count ?? 0 }}</span>
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
                        <img src="{{ asset('assets/frontend') }}/img/course/ins-1.jpg" alt="Instructor" />
                        <h6>Instructor</h6>
                    </div>
                </a>
                <div class="course-price">
                    @if($course->discount)
                        <del>${{ number_format($course->price, 2) }}</del>
                        <span>${{ number_format($course->price - $course->discount, 2) }}</span>
                    @elseif($course->price > 0)
                        <span>${{ number_format($course->price, 2) }}</span>
                    @else
                        <span class="text-success">Free</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
