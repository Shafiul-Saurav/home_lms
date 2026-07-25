<section class="section-padding course-section" id="courseGridSection">
    <div class="container">
        <div class="row gx-0">
            <div class="col-12">
                <div class="section-heading">
                    <span class="sub-title">
                        <i class="fa-solid fa-graduation-cap"></i>
                        Popular Courses
                    </span>
                    <h2>Hacktolive Practical Cyber Security Training Programs</h2>
                    <p>
                        Industry & International Certificate focused training in SOC Implementation & Analysis, Ethical Hacking, Penetration Testing, Web Security, Reverse Engineering & Digital Forensic, designed to take you from beginner to job-ready professional.
                    </p>
                </div>

                <div class="course-filter-wrap">
                    {{-- <div class="course-filter-dots" aria-hidden="true">
                        <span></span><span></span><span></span>
                        <span></span><span></span><span></span>
                        <span></span><span></span><span></span>
                    </div> --}}

                    @php $currentType = request()->get('type', 'all'); @endphp
                    <div class="course-filter-bar" id="courseFilterBar">
                        <button type="button" class="filter-btn {{ $currentType === 'all' ? 'active' : '' }}" data-filter="all">All Course</button>
                        <button type="button" class="filter-btn {{ $currentType === 'free' ? 'active' : '' }}" data-filter="free">Free</button>
                        <button type="button" class="filter-btn {{ $currentType === 'live' ? 'active' : '' }}" data-filter="live">Live</button>
                        <button type="button" class="filter-btn {{ $currentType === 'recorded' ? 'active' : '' }}" data-filter="recorded">Recorded</button>
                        <button type="button" class="filter-btn {{ $currentType === 'upcoming' ? 'active' : '' }}" data-filter="upcoming">Upcoming Webinar</button>
                    </div>

                    {{-- <div class="course-filter-dots" aria-hidden="true">
                        <span></span><span></span><span></span>
                        <span></span><span></span><span></span>
                        <span></span><span></span><span></span>
                    </div> --}}
                </div>

            </div>
        </div>

        @php $googleFormUrl = config('services.google_form_url', '#'); @endphp
        <div class="mb-3 text-center">
            <p class="google-form-info d-none" style="margin-bottom:12px;color:#374151;">
                You will be redirected to a Google Form to complete your registration. Please have your full name and email ready.
            </p>
            <a href="{{ $googleFormUrl ?: '#' }}" id="googleFormBtn" class="enroll-btn google-form-btn d-none" style="display:inline-flex;align-items:center;gap:10px;padding:10px 18px;">
                <i class="fa-brands fa-google" style="color:#fff;font-size:18px;"></i>
                <span>Register via Google Form</span>
            </a>
        </div>

        <div class="row g-4" id="course-grid">
            @foreach ($popularCourses as $course)
                @php
                    $courseType = $course->live_or_record ?? 'recorded';
                    if ($courseType === 'record') {
                        $courseType = 'recorded';
                    }
                    $priceType = ($course->free_or_paid === 'free' || $course->price == 0 || $course->price === null) ? 'free' : 'paid';
                    // allow multiple tokens in data attribute so client filter can match both type and price
                    $dataType = trim($courseType . ' ' . $priceType);
                @endphp
                <div class="col-xl-3 col-lg-3 col-md-6 col-6 px-1 px-md-2" data-course-type="{{ $dataType }}">
                    <div class="course-card-modern">
                        <div class="course-thumb">
                            <img src="{{ asset('uploads/courses/' . $course->image) }}" alt="{{ $course->title }}">
                        </div>
                        <div class="course-content">
                            <div class="d-flex justify-content-between align-items-start">
                                <h3 class="mb-0">{{ $course->name }}</h3>
                                <span class="course-badge" style="background: {{ $courseType === 'live' ? '#ff896f' : '#76bd10' }}; color: #fff; padding: 3px 8px; border-radius: 12px; font-weight: 700; font-size: 10px; text-transform: capitalize;">
                                    {{ ucfirst($courseType) }}
                                </span>
                            </div>
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
                            @if($course->live_or_record === 'live')
                                <div class="live-info mt-2 mb-2" style="color:#6b7280;font-size:13px;">
                                    <i class="fa-solid fa-calendar-days"></i>
                                    @if($course->start_date)
                                        {{ \Carbon\Carbon::parse($course->start_date)->format('d M, Y') }}
                                    @else
                                        Starting date: TBA
                                    @endif
                                    @if($course->live_schedule)
                                        &nbsp;•&nbsp;{{ $course->live_schedule }}
                                    @endif
                                </div>
                            @endif
                            <ul class="course-list">
                                @foreach ($course->features ?? [] as $feature)
                                    <li><i class="fa-solid fa-check"></i> {{ $feature }}</li>
                                @endforeach
                            </ul>
                            <div class="course-bottom">
                                <div class="price-box">
                                    @if ($course->free_or_paid === 'free')
                                        <h4>Free</h4>
                                    @elseif ($course->discount && $course->discount > 0)
                                        @php
                                            $finalPrice = $course->price - $course->discount;
                                            $discountPercent = $course->price > 0 ? round(($course->discount / $course->price) * 100) : 0;
                                        @endphp
                                        <h4>{{ $finalPrice > 0 ? $finalPrice . ' Tk' : 'Free' }}</h4>
                                        <div class="price-old-row">
                                            <del>{{ $course->price > 0 ? $course->price . ' Tk' : 'Free' }}</del>
                                            <span class="discount">{{ $discountPercent }}% OFF</span>
                                        </div>
                                    @else
                                        <h4>{{ $course->price > 0 ? $course->price . ' Tk' : 'Free' }}</h4>
                                    @endif
                                </div>
                                @php
                                    $btnText = $course->button_type ?? 'Enroll Now';
                                    $isComingSoon = in_array($btnText, ['Comming Soon', 'Coming Soon']);
                                @endphp
                                <a href="{{ route('course.details', $course->id) }}" class="enroll-btn">
                                    {{ $btnText }} <i class="fa-solid {{ $isComingSoon ? 'fa-clock' : 'fa-arrow-right' }}"></i>
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

