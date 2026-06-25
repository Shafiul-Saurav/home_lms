@extends('frontendone.layouts.master')

@section('title', $courseInfo->name . ' | Courses')

@push('frontendone_style')
    @include('frontend.pages.common.style')
    <style>
        .course-detail-hero {
            padding: 155px 0 90px;
            background: linear-gradient(135deg, #07111f 0%, #0d1f36 50%, #12345a 100%);
            color: #fff;
        }

        .course-detail-hero .course-label,
        .course-hero-meta .meta-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border-radius: 999px;
        }

        .course-detail-hero .course-label {
            padding: 8px 14px;
            background: rgba(255, 255, 255, .12);
            font-weight: 700;
        }

        .course-detail-hero h1 {
            font-size: clamp(2.2rem, 4vw, 4.1rem);
            line-height: 1.05;
            font-weight: 800;
            margin: 18px 0 14px;
        }

        .course-hero-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
            margin-top: 28px;
        }

        .course-hero-meta .meta-pill {
            padding: 10px 14px;
            background: rgba(255, 255, 255, .1);
        }

        .panel-card,
        .sidebar-card {
            background: #fff;
            border-radius: 28px;
            box-shadow: 0 18px 50px rgba(8, 15, 30, .08);
        }

        .panel-card {
            padding: 26px;
        }

        .sidebar-card {
            padding: 10px;
            position: fixed;
            top: 90px;
            width: inherit;
        }

        @media (min-width: 992px) {
            .sidebar-scroll {
                max-height: calc(100vh - 90px - 310px);
                overflow-y: auto;
                scroll-behavior: smooth;
                padding-right: 4px;
                scrollbar-width: thin;
                scrollbar-color: transparent transparent;
            }

            .sidebar-scroll::-webkit-scrollbar {
                width: 7px;
            }

            .sidebar-scroll::-webkit-scrollbar-track {
                background: transparent;
                border-radius: 999px;
            }

            .sidebar-scroll::-webkit-scrollbar-thumb {
                background: transparent;
                border-radius: 999px;
                transition: background 0.2s ease;
            }

            .sidebar-scroll:hover::-webkit-scrollbar-track {
                background: rgba(255, 255, 255, 0.1);
            }

            .sidebar-scroll:hover::-webkit-scrollbar-thumb {
                background: rgba(166, 255, 52, 0.65);
            }

            .sidebar-scroll:hover {
                scrollbar-color: rgba(166, 255, 52, 0.65) rgba(255, 255, 255, 0.1);
            }
        }

        .sidebar-card .thumb {
            border-radius: 20px;
            overflow: hidden;
            margin-bottom: 18px;
        }

        .sidebar-card .thumb img {
            width: 100%;
            height: 220px;
            object-fit: cover;
        }

        .course-price-box {
            background: linear-gradient(135deg, #0d1f36, #12345a);
            color: #fff;
            border-radius: 22px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .course-price-box .current-price {
            font-size: 16px;
            font-weight: 800;
            margin: 0;
        }

        .course-info-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .course-info-list li {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            padding: 12px 0;
            border-bottom: 1px solid rgba(16, 41, 73, .08);
        }

        .course-info-list li:last-child {
            border-bottom: 0;
        }

        .nav-tabs {
            border-bottom: 0;
        }

        .nav-tabs-clean .nav-link {
            border: 0;
            border-radius: 999px;
            padding: 10px 18px;
            background: #eef3fb;
            color: #102949;
            font-weight: 700;
        }

        .nav-tabs-clean .nav-link.active {
            background: linear-gradient(135deg, #0d1f36, #12345a);
            color: #fff;
        }

        .tab-panel-box {
            background: #fff;
            border-radius: 24px;
            padding: 24px;
            box-shadow: 0 12px 40px rgba(8, 15, 30, .05);
        }

        .curriculum-item {
            display: flex;
            justify-content: space-between;
            gap: 16px;
            align-items: center;
            padding: 14px 16px;
            border: 1px solid rgba(16, 41, 73, .08);
            border-radius: 16px;
            margin-bottom: 12px;
            background: #fdfefe;
        }

        .curriculum-item.unlock {
            background: #f2f8f4;
        }

        .review-item-modern {
            padding: 18px 0;
            border-bottom: 1px solid rgba(16, 41, 73, .08);
        }

        .review-item-modern:last-child {
            border-bottom: 0;
        }

        .review-author-modern {
            display: flex;
            gap: 14px;
            align-items: flex-start;
            margin-bottom: 10px;
        }

        .review-author-modern img {
            width: 54px;
            height: 54px;
            border-radius: 50%;
            object-fit: cover;
        }

        .review-author-modern .info {
            flex: 1;
            display: flex;
            justify-content: space-between;
            gap: 12px;
        }

        .review-stars i {
            color: #ffc107;
        }

        @media (max-width: 991px) {
            .course-detail-hero {
                padding-top: 135px;
            }

            .sidebar-card {
                position: static;
            }
        }
    </style>
@endpush

@section('frontendone_content')
    <main class="main">
        @php
            $mainTeacher = $courseInfo->teachers->first();
            $avgRating = $courseInfo->averageRating();
            $instructorName = optional(optional($mainTeacher)->user)->name ?? 'Instructor';
        @endphp
        <section class="course-detail-hero">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <span class="course-label">{{ $courseInfo->category->name ?? 'Uncategorized' }}</span>
                        <h1>{{ $courseInfo->name }}</h1>
                        <p class="mb-0" style="max-width:820px;color:rgba(255,255,255,.82)">{!! \Illuminate\Support\Str::limit(strip_tags($courseInfo->description), 180) !!}</p>
                        <div class="course-hero-meta">
                            <div class="meta-pill"><i class="fa-solid fa-star text-warning"></i> <span>{{ $avgRating }}
                                    ({{ $courseInfo->reviewCount() }} Reviews)</span></div>
                            <div class="meta-pill"><i class="fa-solid fa-user-tie"></i> <span>{{ $instructorName }}</span>
                            </div>
                            <div class="meta-pill"><i class="fa-solid fa-calendar-days"></i> <span>Last Updated:
                                    {{ optional($courseInfo->updated_at)->format('M d, Y') }}</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-padding py-5">
            <div class="container">
                <div class="row g-4">
                    <div class="col-lg-8 order-2 order-lg-1">
                        <div class="panel-card">
                            <ul class="nav nav-tabs nav-tabs-clean mb-4" role="tablist">
                                <li class="nav-item"><button class="nav-link active me-1" data-bs-toggle="pill"
                                        data-bs-target="#course-description" type="button">Description</button></li>
                                <li class="nav-item"><button class="nav-link me-1" data-bs-toggle="pill"
                                        data-bs-target="#course-curriculum" type="button">Curriculum</button></li>
                                <li class="nav-item"><button class="nav-link me-1" data-bs-toggle="pill"
                                        data-bs-target="#course-instructor" type="button">Instructor</button></li>
                                <li class="nav-item"><button class="nav-link" data-bs-toggle="pill"
                                        data-bs-target="#course-reviews" type="button">Reviews</button></li>
                                @if (isset($exams) && $exams->isNotEmpty())
                                    <li class="nav-item"><button class="nav-link" data-bs-toggle="pill"
                                            data-bs-target="#course-exams" type="button">Exams</button></li>
                                @endif
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="course-description">
                                    <div class="tab-panel-box">
                                        <h4 class="mb-3">About This Course</h4>
                                        <div>{!! $courseInfo->description !!}</div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="course-curriculum">
                                    <div class="tab-panel-box">
                                        <h4 class="mb-3">Course Curriculum</h4>
                                        <div class="accordion accordion-flush" id="courseAccordion">
                                            @forelse($lessons as $index => $lesson)
                                                <div class="accordion-item mb-3 border rounded-4 overflow-hidden">
                                                    <h2 class="accordion-header"><button
                                                            class="accordion-button {{ $index !== 0 ? 'collapsed' : '' }}"
                                                            type="button" data-bs-toggle="collapse"
                                                            data-bs-target="#lesson-{{ $lesson->id }}">{{ $lesson->name }}</button>
                                                    </h2>
                                                    <div id="lesson-{{ $lesson->id }}"
                                                        class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}"
                                                        data-bs-parent="#courseAccordion">
                                                        <div class="accordion-body">
                                                            @forelse($lesson->courseModules as $module)
                                                                <div
                                                                    class="curriculum-item {{ $isEnrolled || $module->free_paid === 'free' ? 'unlock' : '' }}">
                                                                    <div>
                                                                        <strong class="d-block mb-1">
                                                                            @if ($module->pdf_file)
                                                                                <i
                                                                                    class="fa-regular fa-file-lines me-1"></i>
                                                                            @elseif($module->live_record === 'live')
                                                                                <i
                                                                                class="fa-solid fa-video me-1"></i>@else<i
                                                                                    class="fa-solid fa-play me-1"></i>
                                                                            @endif
                                                                            {{ $module->title }}
                                                                            @if (isset($completedModuleIds) && in_array($module->id, $completedModuleIds))
                                                                                <i
                                                                                    class="fa-solid fa-circle-check text-success ms-1"></i>
                                                                            @endif
                                                                        </strong>
                                                                        <small
                                                                            class="text-muted">{{ $module->time ?? '00:00' }}</small>
                                                                    </div>
                                                                    <div><i
                                                                            class="fa-solid {{ $isEnrolled || $module->free_paid === 'free' ? 'fa-unlock' : 'fa-lock' }} me-1"></i>{{ ucfirst($module->free_paid ?? 'paid') }}
                                                                    </div>
                                                                </div>
                                                            @empty
                                                                <div class="alert alert-warning mb-0">Curriculum will be
                                                                    updated soon.</div>
                                                            @endforelse
                                                        </div>
                                                    </div>
                                                </div>
                                            @empty
                                                <div class="alert alert-warning mb-0">Curriculum will be updated soon.</div>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="course-instructor">
                                    <div class="tab-panel-box">
                                        <h4 class="mb-4">Instructor</h4>
                                        <div class="d-flex flex-column flex-md-row gap-4 align-items-start">
                                            <div>
                                                @if ($mainTeacher && $mainTeacher->profile_image && $mainTeacher->profile_image !== 'default_profile_image.jpg')
                                                    <img src="{{ asset('uploads/teachers/' . $mainTeacher->profile_image) }}"
                                                        alt="{{ $instructorName }}" class="rounded-4"
                                                        style="width:160px;height:160px;object-fit:cover;">
                                                @else
                                                    <img src="{{ asset('assets/frontend') }}/img/instructor/01.jpg"
                                                        alt="Instructor" class="rounded-4"
                                                        style="width:160px;height:160px;object-fit:cover;">
                                                @endif
                                            </div>
                                            <div class="flex-grow-1">
                                                <h5 class="mb-2">{{ $instructorName }}</h5>
                                                <div class="review-stars mb-3">
                                                    @php $teacherRating = $mainTeacher ? $mainTeacher->averageRating() : 0; @endphp
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <i
                                                            class="fa-{{ $i <= round($teacherRating) ? 'solid' : 'regular' }} fa-star"></i>
                                                    @endfor
                                                    <span class="ms-2">({{ $teacherRating }})</span>
                                                </div>
                                                <p class="mb-2">
                                                    {{ $mainTeacher ? $mainTeacher->qualification ?? 'Qualified instructor with expertise in this field.' : 'No instructor information available.' }}
                                                </p>
                                                <div class="d-flex flex-wrap gap-3 text-muted">
                                                    <span><i class="fa-solid fa-book-open me-1"></i>
                                                        {{ $mainTeacher ? $mainTeacher->courses->count() : 0 }}
                                                        Courses</span>
                                                    <span><i class="fa-solid fa-users me-1"></i>
                                                        {{ $mainTeacher? App\Models\CourseOrder::whereIn('course_id', $mainTeacher->courses->pluck('id'))->where('status', 'Enrolled')->count(): 0 }}
                                                        Enrolled</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="course-reviews">
                                    <div class="tab-panel-box">
                                        <div
                                            class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
                                            <div>
                                                <h4 class="mb-1">Student Reviews</h4>
                                                <p class="text-muted mb-0">Read feedback from learners who took this
                                                    course.</p>
                                            </div>
                                            @auth
                                                <button type="button" class="enroll-btn" id="give-review-btn">Give Review <i
                                                        class="fa-solid fa-pen-to-square"></i></button>
                                            @else
                                                <a href="{{ route('login') }}" class="enroll-btn">Login to Review <i
                                                        class="fa-solid fa-right-to-bracket"></i></a>
                                            @endauth
                                        </div>

                                        <div class="d-flex flex-wrap gap-3 mb-4">
                                            <div class="course-price-box flex-grow-1 mb-0" style="min-width:220px;">
                                                <div class="d-flex align-items-center gap-3">
                                                    <h2 class="mb-0" id="review-count">{{ $reviews->total() }}</h2>
                                                    <div>
                                                        <div class="review-stars">
                                                            @for ($i = 1; $i <= 5; $i++)
                                                                <i
                                                                    class="fa-{{ $i <= round($avgRating) ? 'solid' : 'regular' }} fa-star"></i>
                                                            @endfor
                                                        </div>
                                                        <small>{{ $avgRating }} out of 5</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="course-price-box flex-grow-1 mb-0" style="min-width:220px;">
                                                <div class="d-flex flex-row justify-content-between">
                                                    <div>
                                                        <p class="mb-1 text-uppercase small">Course Price</p>
                                                    </div>
                                                    <div>
                                                        @if ($courseInfo->discount)
                                                            <del>${{ number_format($courseInfo->price, 2) }}</del>
                                                            <h3 class="current-price">
                                                                ${{ number_format($courseInfo->price - $courseInfo->discount, 2) }}
                                                            </h3>
                                                        @elseif($courseInfo->price > 0)
                                                            <h3 class="current-price">
                                                                ${{ number_format($courseInfo->price, 2) }}
                                                            </h3>
                                                        @else
                                                            <h3 class="current-price">Free</h3>
                                                        @endif

                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <div id="review-list">@include('frontendone.pages.courses.partials.review_items', [
                                            'reviews' => $reviews,
                                        ])</div>

                                        @if ($reviews->hasMorePages())
                                            <div class="text-center mt-4"><button type="button" class="enroll-btn"
                                                    id="load-more-reviews" data-page="2">Load More Reviews <i
                                                        class="fa-solid fa-rotate-right"></i></button></div>
                                        @endif
                                    </div>
                                </div>

                                @if (isset($exams) && $exams->isNotEmpty())
                                    <div class="tab-pane fade" id="course-exams">
                                        <div class="tab-panel-box">
                                            <h4 class="mb-4">Exams</h4>
                                            <div class="row g-3">
                                                @foreach ($exams as $exam)
                                                    <div class="col-md-6">
                                                        <div class="border rounded-4 p-3 h-100">
                                                            <h5 class="mb-2">{{ $exam->title ?? $exam->name }}</h5>
                                                            <p class="text-muted mb-3">
                                                                {{ $exam->description ?? 'Take this exam to test your learning.' }}
                                                            </p>
                                                            <a href="{{ route('frontend.exam.start', ['course_id' => $courseInfo->id, 'exam_id' => $exam->id]) }}"
                                                                class="enroll-btn">Start Exam <i
                                                                    class="fa-solid fa-arrow-right"></i></a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 order-1 order-lg-2">
                        <div class="sidebar-card">
                            <div class="thumb"><img src="{{ asset('uploads/courses/' . $courseInfo->image) }}"
                                    alt="{{ $courseInfo->name }}"></div>
                            <div class="sidebar-scroll">
                            <div class="course-price-box">
                                <div class="d-flex flex-row justify-content-between">
                                    <div>
                                        <p class="mb-1 text-uppercase small">Course Price</p>
                                    </div>
                                    <div>
                                        @if ($courseInfo->discount)
                                            <del>${{ number_format($courseInfo->price, 2) }}</del>
                                            <h3 class="current-price">
                                                ${{ number_format($courseInfo->price - $courseInfo->discount, 2) }}
                                            </h3>
                                        @elseif($courseInfo->price > 0)
                                            <h3 class="current-price">
                                                ${{ number_format($courseInfo->price, 2) }}
                                            </h3>
                                        @else
                                            <h3 class="current-price">Free</h3>
                                        @endif

                                    </div>
                                </div>

                                <ul class="course-info-list mb-4">
                                <li><span><i
                                            class="fa-solid fa-layer-group me-2"></i>Level</span><strong>{{ ucfirst($courseInfo->live_or_record ?? 'All Level') }}</strong>
                                </li>
                                <li><span><i
                                            class="fa-solid fa-book-open me-2"></i>Lessons</span><strong>{{ $courseInfo->lessons()->count() }}</strong>
                                </li>
                                <li><span><i
                                            class="fa-solid fa-list-check me-2"></i>Modules</span><strong>{{ $courseInfo->courseModules()->count() }}</strong>
                                </li>
                                <li><span><i
                                            class="fa-solid fa-globe me-2"></i>Language</span><strong>{{ $courseInfo->language ?? 'English' }}</strong>
                                </li>
                                <li><span><i
                                            class="fa-solid fa-user-tie me-2"></i>Instructor</span><strong>{{ $instructorName }}</strong>
                                </li>
                            </ul>

                            </div>
                            </div>
                            <div class="px-2 pt-2 pb-1">
                                <a href="#course-reviews" class="enroll-btn w-100 justify-content-center d-flex">View
                                    Reviews
                                    <i class="fa-solid fa-comments"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
        </section>

        <section class="section-padding pt-0 pb-120">
            <div class="container">
                <div class="row mb-4">
                    <div class="col-lg-6 mx-auto text-center">
                        <span class="hero-kicker d-inline-flex mb-3"><i class="fa-solid fa-layer-group"></i> Related
                            Courses</span>
                        <h2 class="mb-2">Most Related Courses</h2>
                        <p class="text-muted mb-0">Continue exploring courses from the same category.</p>
                    </div>
                </div>

                <div class="row g-4">
                    @forelse($relatedCourses as $related)
                        <div class="col-md-6 col-xl-4">
                            <div class="course-card-dark h-100">
                                <div class="course-thumb"><img src="{{ asset('uploads/courses/' . $related->image) }}"
                                        alt="{{ $related->name }}"></div>
                                <div class="course-content">
                                    <h3>{{ $related->name }}</h3>
                                    <p class="desc">{!! \Illuminate\Support\Str::words(strip_tags($related->description), 16, '...') !!}</p>
                                    <div class="course-meta">
                                        <span><i class="fa-regular fa-star"></i> {{ $related->averageRating() }}
                                            ({{ $related->reviewCount() }})
                                        </span>
                                        <span><i class="fa-regular fa-file-lines"></i> {{ $related->lessons()->count() }}
                                            lessons</span>
                                        <span><i class="fa-regular fa-clock"></i> {{ $related->courseModules()->count() }}
                                            modules</span>
                                    </div>
                                    <div class="course-bottom">
                                        <div class="price-box">
                                            @if ($related->discount)
                                                @php $relatedFinalPrice = $related->price - $related->discount; @endphp
                                                <h4>{{ number_format($relatedFinalPrice, 2) }} Tk</h4>
                                                <div class="price-old-row"><del>{{ number_format($related->price, 2) }}
                                                        Tk</del></div>
                                            @elseif($related->price > 0)
                                                <h4>{{ number_format($related->price, 2) }} Tk</h4>
                                            @else
                                                <h4>Free</h4>
                                            @endif
                                        </div>
                                        <a href="{{ route('course.details', $related->id) }}" class="enroll-btn">View
                                            Course <i class="fa-solid fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="alert alert-warning text-center mb-0">No related courses found.</div>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>

        <div class="modal fade" id="reviewModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 rounded-4 shadow-lg">
                    <div class="modal-body p-4 p-md-5">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <p class="text-uppercase text-muted small mb-1">Student review</p>
                                <h4 class="mb-0">Post a review for {{ $courseInfo->name }}</h4>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>

                        <form id="review-form">
                            @csrf
                            <input type="hidden" name="course_id" value="{{ $courseInfo->id }}">
                            <div class="mb-4">
                                <label class="form-label fw-semibold">Give a rating</label>
                                <div class="d-flex gap-2 mb-2">
                                    <i class="fa-regular fa-star fa-2x star-icon" data-value="1"
                                        style="cursor:pointer;color:#ccc;"></i>
                                    <i class="fa-regular fa-star fa-2x star-icon" data-value="2"
                                        style="cursor:pointer;color:#ccc;"></i>
                                    <i class="fa-regular fa-star fa-2x star-icon" data-value="3"
                                        style="cursor:pointer;color:#ccc;"></i>
                                    <i class="fa-regular fa-star fa-2x star-icon" data-value="4"
                                        style="cursor:pointer;color:#ccc;"></i>
                                    <i class="fa-regular fa-star fa-2x star-icon" data-value="5"
                                        style="cursor:pointer;color:#ccc;"></i>
                                    <input type="hidden" name="rating" id="rating-value" value="">
                                </div>
                                <span class="text-danger error-rating"></span>
                            </div>
                            <div class="mb-4">
                                <label class="form-label fw-semibold">Leave your review</label>
                                <textarea name="comment" class="form-control" rows="4" placeholder="Write your thoughts about this course..."></textarea>
                                <span class="text-danger error-comment"></span>
                            </div>
                            <button type="submit" class="enroll-btn w-100 justify-content-center" id="submit-review-btn"
                                disabled>Send Review</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('frontendone_script')
    @include('frontend.pages.common.script')
    <script>
        $(function() {
            function setStars(value) {
                $('.star-icon').each(function() {
                    if ($(this).data('value') <= value) $(this).removeClass('fa-regular').addClass(
                        'fa-solid').css('color', '#ffc107');
                    else $(this).removeClass('fa-solid').addClass('fa-regular').css('color', '#ccc');
                });
            }

            function validateForm() {
                let rating = $('#rating-value').val();
                let comment = $('textarea[name="comment"]').val().trim();
                $('#submit-review-btn').prop('disabled', !(rating && comment.length > 0));
            }
            $(document).on('mouseover', '.star-icon', function() {
                setStars($(this).data('value'));
            });
            $(document).on('mouseout', '.star-icon', function() {
                setStars($('#rating-value').val() || 0);
            });
            $(document).on('click', '.star-icon', function() {
                $('#rating-value').val($(this).data('value'));
                validateForm();
            });
            $(document).on('input', 'textarea[name="comment"]', validateForm);
            $(document).on('click', '#give-review-btn', function() {
                $('#reviewModal').modal('show');
            });
            $(document).on('submit', '#review-form', function(e) {
                e.preventDefault();
                let btn = $('#submit-review-btn');
                btn.prop('disabled', true).html(
                    '<i class="fa-solid fa-spinner fa-spin me-2"></i>Sending...');
                $.ajax({
                    url: "{{ route('course.reviews.store') }}",
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#reviewModal').modal('hide');
                        $('#review-form')[0].reset();
                        $('.star-icon').removeClass('fa-solid').addClass('fa-regular').css(
                            'color', '#ccc');
                        $('#rating-value').val('');
                        validateForm();
                        if ($('#review-list .alert').length) $('#review-list').html(response
                            .review);
                        else $('#review-list').prepend(response.review);
                        $('#review-count').text((parseInt($('#review-count').text(), 10) || 0) +
                            1);
                        $('#give-review-btn').remove();
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.success,
                            confirmButtonColor: '#12345a'
                        });
                    },
                    error: function(xhr) {
                        btn.prop('disabled', false).text('Send Review');
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors || {};
                            $('.error-rating').text(errors.rating ? errors.rating[0] : '');
                            $('.error-comment').text(errors.comment ? errors.comment[0] : '');
                        } else if (xhr.status === 401) {
                            Swal.fire('Error', 'Please login to post a review.', 'error');
                        } else if (xhr.responseJSON && xhr.responseJSON.error) {
                            Swal.fire('Error', xhr.responseJSON.error, 'error');
                        } else {
                            Swal.fire('Error', 'Something went wrong. Please try again.',
                                'error');
                        }
                    }
                });
            });
            $(document).on('click', '#load-more-reviews', function() {
                let btn = $(this);
                let page = btn.data('page');
                let courseId = "{{ $courseInfo->id }}";
                btn.html('<i class="fa-solid fa-spinner fa-spin me-2"></i>Loading...');
                $.ajax({
                    url: `/course-reviews/${courseId}?page=${page}`,
                    type: 'GET',
                    success: function(response) {
                        $('#review-list').append(response.html);
                        if (response.hasMore) btn.data('page', response.nextPage).html(
                            'Load More Reviews <i class="fa-solid fa-rotate-right ms-2"></i>'
                        );
                        else btn.remove();
                    },
                    error: function() {
                        btn.html(
                            'Load More Reviews <i class="fa-solid fa-rotate-right ms-2"></i>'
                        );
                        Swal.fire('Error', 'Failed to load more reviews.', 'error');
                    }
                });
            });
        });
    </script>
@endpush
