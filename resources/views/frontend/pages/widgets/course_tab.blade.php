<div class="course-tab pb-120">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="site-heading inline">
                    <div>
                        <span class="site-title-tagline"><i class="far fa-lightbulb-on"></i> Courses</span>
                        <h2 class="site-title">Courses By <span class="text-gradient">Category</span></h2>
                    </div>
                    <ul class="nav nav-pills" id="pills-tab">
                        @foreach($categories as $index => $category)
                            <li class="nav-item">
                                <a href="#" class="nav-link {{ $index == 0 ? 'active' : '' }}" id="pills-tab-btn-{{ $category->id }}" data-bs-toggle="pill"
                                    data-bs-target="#pills-tab-{{ $category->id }}">{{ $category->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="tab-content" id="pills-tabContent">
            @foreach($categories as $index => $category)
                <div class="tab-pane fade {{ $index == 0 ? 'show active' : '' }}" id="pills-tab-{{ $category->id }}">
                    <div class="row g-4">
                        @forelse($category->courses as $course)
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="course-item">
                                    <span class="course-tag c1">{{ $course->live_or_record ? ucfirst($course->live_or_record) : 'Course' }}</span>
                                    <div class="course-img">
                                        <a href="{{ route('course.details', $course->id) }}">
                                            <img src="{{ asset('uploads/courses/' . $course->image) }}" alt="{{ $course->name }}" />
                                        </a>
                                    </div>
                                    <div class="course-content">
                                        <div class="course-meta">
                                            <span class="category c1">{{ $category->name }}</span>
                                            <div class="rating">
                                                <i class="fas fa-star"></i>
                                                <span>{{ $course->averageRating() }} ({{ $course->reviewCount() }})</span>
                                            </div>
                                        </div>
                                        <h4 class="course-title">
                                            <a href="{{ route('course.details', $course->id) }}">{{ Str::limit($course->name, 50) }}</a>
                                        </h4>
                                        <div class="course-info">
                                            <ul>
                                                <li class="lecture"><i class="fad fa-book-open-reader"></i>{{ $course->lessons()->count() }} Lessons</li>
                                                <li class="duration"><i class="fad fa-clock-rotate-left"></i>{{ $course->courseModules()->count() }} Modules</li>
                                            </ul>
                                        </div>
                                        <div class="course-bottom">
                                            <a href="{{ route('course.details', $course->id) }}">
                                                <div class="course-instructor">
                                                    @php $mainTeacher = $course->teachers->first(); @endphp
                                                    @if($mainTeacher && $mainTeacher->profile_image && $mainTeacher->profile_image !== 'default_profile_image.jpg')
                                                        <img src="{{ asset('uploads/teachers/' . $mainTeacher->profile_image) }}" alt="{{ $mainTeacher->user->name }}" />
                                                    @else
                                                        <img src="{{ asset('assets/frontend') }}/img/course/ins-1.jpg" alt="Instructor" />
                                                    @endif
                                                    <h6>{{ $mainTeacher->user->name ?? 'Instructor' }}</h6>
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
                        @empty
                            <div class="col-12 text-center py-5">
                                <div class="alert alert-info">No courses found in this category.</div>
                            </div>
                        @endforelse
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
