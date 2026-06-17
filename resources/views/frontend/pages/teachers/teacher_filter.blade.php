<div class="col-6 col-md-6 col-lg-4 col-xl-4 mt-2 mt-md-3 px-1 px-md-2">
    <div class="instructor-item">
        <div class="instructor-img">
            @php
                $imgUrl = asset('assets/frontend/img/instructor/01.jpg');
                if(!empty($teacher->profile_image) && $teacher->profile_image !== 'default_profile_image.jpg') {
                    $imgUrl = asset('uploads/teachers/' . $teacher->profile_image);
                } elseif(optional(optional($teacher->user)->profile)->profileImage && optional(optional($teacher->user->profile)->profileImage)->profile_image) {
                    $imgUrl = asset(optional(optional($teacher->user->profile)->profileImage)->profile_image);
                }
            @endphp
            <img src="{{ $imgUrl }}" alt="" />
        </div>
        <div class="instructor-content">
            <h5><a href="#">{{ optional($teacher->user)->name ?? 'Instructor' }}</a> <span class="far fa-badge-check"></span></h5>
            <p>{{ $teacher->qualification ?? 'Instructor' }}</p>
            <div class="info">
                <span class="course"><i class="fad fa-book-open-reader"></i> {{ $teacher->courses_count ?? ($teacher->courses->count() ?? 0) }} <span>Courses</span></span>
                <span class="enrolled"><i class="fad fa-user-tie-hair"></i> 0 <span>Enrolled</span></span>
                <span class="rating"><i class="fas fa-star"></i> {{ number_format($teacher->averageRating() ?? 0, 1) }} <span>{{ $teacher->reviewCount() ?? 0 }} Reviews</span></span>
            </div>
        </div>
        <div class="instructor-bottom">
            <a href="#" class="theme-border-btn w-100">Enroll<i class="fas fa-arrow-right"></i></a>
        </div>
    </div>
</div>
