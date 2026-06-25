@php
    $courseType = $course->live_or_record ?? 'course';
    $tagClass = $courseType === 'live' ? 'c1' : ($courseType === 'record' ? 'c2' : 'c1');
    $finalPrice = $course->price - ($course->discount ?? 0);
@endphp

<div class="col-xl-4 col-lg-6 col-md-6">
    <div class="course-card-dark h-100">
        <span class="course-tag {{ $tagClass }}">{{ ucfirst($courseType) }}</span>
        <div class="course-thumb">
            <img src="{{ asset('uploads/courses/' . $course->image) }}" alt="{{ $course->name }}">
        </div>
        <div class="course-content">
            <h3>{{ $course->name }}</h3>
            <p class="desc">{!! \Illuminate\Support\Str::words(strip_tags($course->short_description ?? $course->description), 16, '...') !!}</p>
            <div class="course-meta">
                <span><i class="fa-regular fa-star"></i> {{ $course->averageRating() }} ({{ $course->reviewCount() }})</span>
                <span><i class="fa-regular fa-user"></i> {{ $course->students_count ?? 0 }}</span>
                <span><i class="fa-regular fa-file-lines"></i> {{ $course->lessons()->count() }} lessons</span>
            </div>
            <div class="course-bottom">
                <div class="price-box">
                    @if($course->discount && $course->discount > 0)
                        <h4>{{ number_format($finalPrice, 2) }} Tk</h4>
                        <div class="price-old-row">
                            <del>{{ number_format($course->price, 2) }} Tk</del>
                            <span class="discount">{{ $course->price > 0 ? round(($course->discount / $course->price) * 100) : 0 }}% OFF</span>
                        </div>
                    @elseif($course->price > 0)
                        <h4>{{ number_format($course->price, 2) }} Tk</h4>
                    @else
                        <h4>Free</h4>
                    @endif
                </div>
                <a href="{{ route('course.details', $course->id) }}" class="enroll-btn">View Course <i class="fa-solid fa-arrow-right"></i></a>
            </div>
        </div>
    </div>
</div>
