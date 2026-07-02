<div class="row g-4">
    @forelse ($enrolledCourses as $order)
        @php
            $course = $order->course;
            $courseType = $course->live_or_record ?? 'recorded';
            if ($courseType === 'record') {
                $courseType = 'recorded';
            }
        @endphp

        <div class="col-xl-6 col-lg-6 col-md-6" data-course-type="{{ $courseType }}">
            <div class="course-card-modern">
                <div class="course-thumb">
                    <img src="{{ asset('uploads/courses/' . $course->image) }}" alt="{{ $course->name }}">
                </div>
                <div class="course-content">
                    <h3>{{ $course->name }}</h3>
                    <p class="desc">{{ \Illuminate\Support\Str::words(strip_tags($course->short_description ?? $course->description), 10, '...') }}</p>
                    <div class="course-meta">
                        <span><i class="fa-regular fa-star"></i> {{ $course->averageRating() ?? 0 }} ({{ $course->reviewCount() ?? 0 }})</span>
                        <span><i class="fa-regular fa-user"></i> {{ $course->students_count ?? 0 }}</span>
                        <span><i class="fa-regular fa-file-lines"></i> {{ $course->lessons_count ?? $course->courseModules()->count() }} lessons</span>
                        @if($course->duration)
                            <span><i class="fa-regular fa-clock"></i> {{ $course->duration }}</span>
                        @endif
                    </div>
                    <ul class="course-list">
                        @foreach(($course->features ?? []) as $feature)
                            <li><i class="fa-solid fa-check"></i> {{ $feature }}</li>
                        @endforeach
                    </ul>
                    <div class="course-bottom">
                        <div class="price-box">
                            <h4>{{ $order->progress ?? 0 }}%</h4>
                            <div class="price-old-row">
                                <del>Progress</del>
                                <span class="discount">Learning</span>
                            </div>
                        </div>
                        @php
                            $courseModulesCount = $course->courseModules()->count();
                            $certificateStatus = $certificateRequests[$course->id] ?? null;
                        @endphp
                        @if(($order->progress ?? 0) >= 100 || $courseModulesCount === 0)
                            @if($certificateStatus)
                                <span class="badge bg-info text-white me-2">
                                    {{ ucfirst($certificateStatus) }}
                                </span>
                            @else
                                <form action="{{ route('certificates.apply') }}" method="POST" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="course_id" value="{{ $course->id }}">
                                    <button type="submit" class="enroll-btn border-0">Apply Certificate <i class="fa-solid fa-certificate"></i></button>
                                </form>
                            @endif
                        @else
                            <a href="{{ route('course.video', ['course_id' => $course->id]) }}" class="enroll-btn">
                                Continue Learning <i class="fa-solid fa-arrow-right"></i>
                            </a>
                        @endif
                    </div>
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
@if ($enrolledCourses->hasPages())
    @include('frontendone.pages.courses.partials.pagination', ['courses' => $enrolledCourses])
@endif
<!-- pagination end -->
