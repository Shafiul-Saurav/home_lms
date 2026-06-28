<section class="section-padding course-section">
    <div class="container">
        <div class="row gx-0">
            <div class="col-12">
                <div class="section-heading">
                    <span class="sub-title">
                        <i class="fa-solid fa-graduation-cap"></i>
                        Popular Courses
                    </span>
                    <h2>Bangladesh Cyber Security Courses</h2>
                    <p>
                        Practical cyber security, SOC analyst, ethical hacking and web security courses for students and
                        professionals.
                    </p>
                </div>

                <div class="course-filter-wrap">
                    {{-- <div class="course-filter-dots" aria-hidden="true">
                        <span></span><span></span><span></span>
                        <span></span><span></span><span></span>
                        <span></span><span></span><span></span>
                    </div> --}}

                    <div class="course-filter-bar" id="courseFilterBar">
                        <button type="button" class="filter-btn active" data-filter="all">All Course</button>
                        <button type="button" class="filter-btn" data-filter="live">Live</button>
                        <button type="button" class="filter-btn" data-filter="recorded">Recorded</button>
                    </div>

                    {{-- <div class="course-filter-dots" aria-hidden="true">
                        <span></span><span></span><span></span>
                        <span></span><span></span><span></span>
                        <span></span><span></span><span></span>
                    </div> --}}
                </div>

            </div>
        </div>

        <div class="row g-4" id="courseGrid">
            @foreach ($popularCourses as $course)
                @php
                    $courseType = $course->live_or_record ?? 'recorded';
                    if ($courseType === 'record') {
                        $courseType = 'recorded';
                    }
                @endphp
                <div class="col-xl-4 col-lg-4 col-md-6 col-6 px-1 px-md-2" data-course-type="{{ $courseType }}">
                    <div class="course-card-modern">
                        <div class="course-thumb">
                            <img src="{{ asset('uploads/courses/' . $course->image) }}" alt="{{ $course->title }}">
                        </div>
                        <div class="course-content">
                            <h3>{{ $course->name }}</h3>
                            <p class="desc">
                                {{ \Illuminate\Support\Str::words(strip_tags($course->short_description ?? $course->description), 10, '...') }}
                            </p>
                            <div class="course-meta">
                                <span><i class="fa-regular fa-star"></i> {{ $course->averageRating() ?? 0 }}
                                    ({{ $course->reviewCount() ?? 0 }})</span>
                                <span><i class="fa-regular fa-user"></i> {{ $course->students_count ?? 0 }}</span>
                                <span><i class="fa-regular fa-file-lines"></i>
                                    {{ $course->lessons_count ?? $course->courseModules()->count() }} lessons</span>
                                @if ($course->duration)
                                    <span><i class="fa-regular fa-clock"></i> {{ $course->duration }}</span>
                                @endif
                            </div>
                            <ul class="course-list">
                                @foreach ($course->features ?? [] as $feature)
                                    <li><i class="fa-solid fa-check"></i> {{ $feature }}</li>
                                @endforeach
                            </ul>
                            <div class="course-bottom">
                                <div class="price-box">
                                    @if ($course->discount && $course->discount > 0)
                                        @php
                                            $finalPrice = $course->price - $course->discount;
                                            $discountPercent = round(($course->discount / $course->price) * 100);
                                        @endphp
                                        <h4>{{ $finalPrice }} Tk</h4>
                                        <div class="price-old-row">
                                            <del>{{ $course->price }} Tk</del>
                                            <span class="discount">{{ $discountPercent }}% OFF</span>
                                        </div>
                                    @else
                                        <h4>{{ $course->price ?? '0' }} Tk</h4>
                                    @endif
                                </div>
                                <a href="{{ route('course.details', $course->id) }}" class="enroll-btn">
                                    Enroll Now <i class="fa-solid fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-5">
            <a href="{{ route('courses') }}" class="enroll-btn px-4">
                View All <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>

    </div>
</section>

