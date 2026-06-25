@php
    $courseType = $course->live_or_record ?? 'recorded';
    if ($courseType === 'record') {
        $courseType = 'recorded';
    }
    $finalPrice = $course->price - ($course->discount ?? 0);
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
                @foreach($course->features ?? [] as $feature)
                    <li><i class="fa-solid fa-check"></i> {{ $feature }}</li>
                @endforeach
            </ul>
            <div class="course-bottom">
                <div class="price-box">
                    @if($course->discount && $course->discount > 0)
                        @php
                            $discountPercent = round(($course->discount / $course->price) * 100);
                        @endphp
                        <h4>{{ $finalPrice }} Tk</h4>
                        <div class="price-old-row">
                            <del>{{ $course->price }} Tk</del>
                            <span class="discount">{{ $discountPercent }}% OFF</span>
                        </div>
                    @elseif($course->price > 0)
                        <h4>{{ $course->price }} Tk</h4>
                    @else
                        <h4>Free</h4>
                    @endif
                </div>
                <a href="{{ route('course.details', $course->id) }}" class="enroll-btn">
                    Enroll Now <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</div>
