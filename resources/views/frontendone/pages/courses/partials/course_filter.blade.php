@php
    $courseType = $course->live_or_record ?? 'recorded';
    if ($courseType === 'record') {
        $courseType = 'recorded';
    }
    $finalPrice = $course->price - ($course->discount ?? 0);
@endphp

<div class="col-xl-4 col-lg-6 col-md-6 col-6 px-1 px-md-2" data-course-type="{{ $courseType }}">
    <div class="course-card-modern">
        <div class="course-thumb">
            <img src="{{ asset('uploads/courses/' . $course->image) }}" alt="{{ $course->name }}">
        </div>
        <div class="course-content">
                <div class="d-flex justify-content-between align-items-start">
                    <h3 class="mb-0">{{ $course->name }}</h3>
                    <span class="course-badge" style="background: {{ $courseType === 'live' ? '#ff896f' : '#76bd10' }}; color: #fff; padding: 3px 8px; border-radius: 12px; font-weight: 700; font-size: 10px; text-transform: capitalize;">
                        {{ ucfirst($courseType) }}
                    </span>
                </div>
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
                            $discountPercent = $course->price > 0 ? round(($course->discount / $course->price) * 100) : 0;
                        @endphp
                        <h4>{{ $finalPrice > 0 ? $finalPrice . ' Tk' : 'Free' }}</h4>
                        <div class="price-old-row">
                            <del>{{ $course->price > 0 ? $course->price . ' Tk' : 'Free' }}</del>
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
