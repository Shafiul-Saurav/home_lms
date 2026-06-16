<div class="instructor bg-img pb-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mx-auto">
                <div class="site-heading text-center wow fadeInDown" data-wow-delay=".25s">
                    <span class="site-title-tagline"><i class="far fa-lightbulb-on"></i> Instructors</span>
                    <h2 class="site-title">Meet Our Best <span class="text-gradient">Instructors</span></h2>
                </div>
            </div>
        </div>
        <div class="instructor-slider owl-carousel owl-theme wow fadeInUp" data-wow-delay=".25s">
            @if(isset($teachers) && $teachers->count())
                @foreach($teachers as $teacher)
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
                                <span class="course"><i class="fad fa-book-open-reader"></i> {{ $teacher->courses_count ?? 0 }} <span>Courses</span></span>
                                <span class="enrolled"><i class="fad fa-user-tie-hair"></i> 0 <span>Enrolled</span></span>
                                <span class="rating"><i class="fas fa-star"></i> 0.0 <span>0 Reviews</span></span>
                            </div>
                        </div>
                        <div class="instructor-bottom">
                            <a href="#" class="theme-border-btn w-100">Enroll<i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

        <div class="row mt-4">
            <div class="col-12 text-center">
                <a href="{{ route('teachers') }}" class="theme-btn">View All Instructors</a>
            </div>
        </div>
    </div>
</div>
