@extends('frontend.layouts.master')

@push('frontend_style')
    <link rel="stylesheet" href="https://cdn.plyr.io/3.7.8/plyr.css" />
    <style>
    /* Video Meta Table Styling */
    .video-container {
        position: relative;
        min-height: 420px;
        background: #000;
    }
    .plyr__video-embed {
        min-height: 420px;
        position: relative;
        z-index: 1;
    }
    .video-overlay {
        position: absolute;
        inset: 0;
        z-index: 20;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 1rem;
        padding: 1rem;
        pointer-events: none;
    }
    .video-overlay .live-countdown,
    .video-overlay .join-live-btn {
        pointer-events: auto;
    }
    .live-countdown {
        background: linear-gradient(90deg, #7c3aed 0%, #ec4899 100%);
        border: 1px solid rgba(255, 255, 255, 0.12);
        color: #fff;
        padding: 18px 24px;
        border-radius: 16px;
        text-align: center;
        min-width: 240px;
        animation: fadeInUp 0.5s ease;
        box-shadow: 0 20px 50px rgba(0,0,0,0.2);
    }
    .live-countdown .countdown-label {
        font-size: 0.95rem;
        opacity: 0.85;
        margin-bottom: 0.35rem;
    }
    .live-countdown .countdown-time {
        font-size: 1.75rem;
        font-weight: 700;
    }
    .join-live-btn {
        display: none;
        padding: 0.95rem 1.8rem;
        border-radius: 999px;
        font-size: 1rem;
        font-weight: 700;
        color: #fff;
        background: linear-gradient(90deg, #7c3aed 0%, #ec4899 100%);
        box-shadow: 0 18px 50px rgba(124, 58, 237, 0.25);
        text-decoration: none;
        transition: transform 0.25s ease, box-shadow 0.25s ease;
        animation: pulse 1.5s ease-in-out infinite;
    }
    .join-live-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 22px 60px rgba(124, 58, 237, 0.35);
    }
    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.03); }
    }
    @keyframes fadeInUp {
        0% { opacity: 0; transform: translateY(16px); }
        100% { opacity: 1; transform: translateY(0); }
    }

    .video-meta-container {
        width: 100%;
        margin-top: 20px;
    }
    .video-meta-table {
        width: 100%;
        border-collapse: collapse;
        background: #fff;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    .video-meta-table tbody tr {
        border-bottom: 1px solid #eee;
        transition: all 0.3s ease;
    }
    .video-meta-table tbody tr:last-child {
        border-bottom: none;
    }
    .video-meta-table tbody tr:hover {
        background-color: #f9f9f9;
    }
    .video-meta-table td {
        padding: 18px 20px;
        vertical-align: middle;
    }
    .video-meta-table td:first-child {
        font-weight: 600;
        color: #4f46e5;
        width: 30%;
        background-color: #f8f9fc;
    }
    .video-meta-table td:last-child {
        color: #333;
        word-break: break-word;
    }
    .video-meta-table .file-link {
        display: inline-flex;
        align-items: center;
        padding: 6px 12px;
        background-color: #eef2ff;
        color: #4f46e5;
        border-radius: 5px;
        text-decoration: none;
        margin-right: 10px;
        margin-top: 5px;
        font-size: 0.9rem;
        transition: all 0.3s ease;
    }
    .video-meta-table .file-link:hover {
        background-color: #4f46e5;
        color: #fff;
        text-decoration: none;
        box-shadow: 0 2px 6px rgba(79, 70, 229, 0.3);
    }
    .video-meta-table .file-link i {
        margin-right: 5px;
    }
    .no-files-text {
        color: #999;
        font-size: 0.9rem;
        font-style: italic;
    }
    </style>
@endpush

@section('frontend_content')
    <main class="main">

        <!-- breadcrumb -->
        <div class="site-breadcrumb" style="background: url({{ asset('assets/frontend') }}/img/breadcrumb/01.png)">
            <div class="container">
                <div class="col-lg-6">
                    <div class="course-single-header">
                        <h4 class="title">{{ $course->name ?? 'Course Video' }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <!-- breadcrumb end -->


        @php
            if (!function_exists('parseModuleDateTime')) {
                function parseModuleDateTime($date, $time)
                {
                    $date = trim((string) $date);
                    $time = trim((string) $time);
                    if ($date === '' || $time === '') {
                        return null;
                    }
                    // Normalize time like 08.00pm -> 08:00 pm
                    $time = preg_replace('/(\d{1,2})\.(\d{2})/i', '$1:$2', $time);
                    $time = preg_replace('/\s*(am|pm)\s*$/i', ' $1', $time);
                    // Normalize date like 16.10. 2025 -> 16.10.2025
                    $date = preg_replace('/\s*\.\s*/', '.', $date);
                    $date = preg_replace('/\.+$/', '.', $date); // ensure trailing dot handled
                    $date = preg_replace('/\.{2,}/', '.', $date);
                    $candidates = [
                        'd.m.Y h:i a',
                        'd.m.Y g:i a',
                        'd.m.Y h:i A',
                        'd.m.Y g:i A',
                        'd.m.Y h:iA',
                        'd.m.Y g:iA',
                        'd.m.Y h:ia',
                        'd.m.Y g:ia',
                        'd-m-Y h:i a',
                        'd/m/Y h:i a',
                        'Y-m-d H:i',
                        'Y-m-d H:i:s',
                        'M d, Y h:i A',
                    ];
                    foreach ($candidates as $fmt) {
                        try {
                            return \Carbon\Carbon::createFromFormat($fmt, $date . ' ' . $time);
                        } catch (\Exception $e) {
                        }
                    }
                    // Final fallback: let Carbon try best-effort parse on cleaned string
                    try {
                        return \Carbon\Carbon::parse($date . ' ' . $time);
                    } catch (\Exception $e) {
                        return null;
                    }
                }
            }
        @endphp


        <div class="container mt-4">
            <div class="row">
                <div class="col-12">
                    <a href="{{ url()->previous() }}" class="theme-btn mb-3">
                        <i class="feather-arrow-left"></i> Back to Course
                    </a>
                    <h4 class="title">{{ $course->name ?? 'Course Video' }}</h4>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <div class="video-player-section" data-aos="fade-right">

                        <!-- Video Player -->
                        @php
                            $isScheduledLive =
                                strtolower(trim($module->live_record ?? '')) === 'live' && !empty($module->date) && !empty($module->time);
                            $startAt = $isScheduledLive
                                ? parseModuleDateTime($module->date ?? '', $module->time ?? '')
                                : null;
                            $endAt = $startAt ? (clone $startAt)->addMonthsNoOverflow(3) : null;
                            $hasLiveMeetingLink = !empty(trim($module->link ?? '')) && (
                                strtolower(trim($module->live_record ?? '')) === 'live' ||
                                Str::contains(strtolower(trim($module->link)), ['zoom.us', 'zoom.com', 'meet.google.com', 'google.com'])
                            );
                        @endphp

                        <div class="video-container">
                            @if ($hasLiveMeetingLink)
                                <div class="video-overlay" id="liveOverlay">
                                    <div class="live-countdown" id="liveCountdownPanel">
                                        <div class="countdown-label">Live class starts in</div>
                                        <div class="countdown-time" id="liveCountdownTime">00:00:00</div>
                                    </div>
                                    <a href="{{ $module->link }}" target="_blank" rel="noopener noreferrer"
                                        id="bigJoinBtn"
                                        class="theme-btn join-live-btn">
                                        <i class="fas fa-video me-2"></i> Join Live Class
                                    </a>
                                </div>
                            @endif
                            @php
                                $isRestricted = isset($notification);
                            @endphp

                            <!-- Plyr Video Player Shell -->
                            <div class="plyr__video-embed" id="player" style="position: relative;">
                                <!-- Custom thumbnail overlay -->
                                <img id="thumbnail"
                                    src="{{ $course->image ? asset('uploads/courses/' . $course->image) : 'https://cdn.prod.website-files.com/62d84e447b4f9e7263d31e94/6399a4d27711a5ad2c9bf5cd_ben-sweet-2LowviVHZ-E-unsplash-1.jpeg' }}"
                                    style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; display: block; object-fit: cover; z-index: 5;">

                                @if (!$isRestricted && $module->link)
                                    @if (Str::contains($module->link, ['youtube.com', 'youtu.be']))
                                        <!-- Handle YouTube URLs -->
                                        @php
                                            $videoId = '';
                                            if (Str::contains($module->link, 'youtube.com')) {
                                                parse_str(parse_url($module->link, PHP_URL_QUERY), $params);
                                                $videoId = $params['v'] ?? '';
                                            } elseif (Str::contains($module->link, 'youtu.be')) {
                                                $videoId = substr(parse_url($module->link, PHP_URL_PATH), 1);
                                            }
                                        @endphp
                                        @if ($videoId)
                                            <iframe
                                                src="https://www.youtube.com/embed/{{ $videoId }}?origin=https://plyr.io&amp;iv_load_policy=3&amp;modestbranding=1&amp;playsinline=1&amp;showinfo=0&amp;rel=0&amp;enablejsapi=1&amp;endscreen=0"
                                                allowfullscreen allowtransparency allow="autoplay">
                                            </iframe>
                                        @else
                                            <div class="d-flex align-items-center justify-content-center h-100 text-white">
                                                <div class="text-center">
                                                    <i class="feather-play-circle" style="font-size: 3rem;"></i>
                                                    <p class="mt-3">Invalid YouTube URL</p>
                                                </div>
                                            </div>
                                        @endif
                                    @elseif(Str::contains($module->link, 'vimeo.com'))
                                        <!-- Handle Vimeo URLs -->
                                        @php
                                            $videoId = '';
                                            if (preg_match('/vimeo\\.com\\/(\\d+)/', $module->link, $matches)) {
                                                $videoId = $matches[1];
                                            }
                                        @endphp
                                        @if ($videoId)
                                            <iframe
                                                src="https://player.vimeo.com/video/{{ $videoId }}?loop=false&amp;byline=false&amp;portrait=false&amp;title=false&amp;speed=true&amp;transparent=0&amp;gesture=media"
                                                allowfullscreen allowtransparency allow="autoplay">
                                            </iframe>
                                        @else
                                            <div class="d-flex align-items-center justify-content-center h-100 text-white">
                                                <div class="text-center">
                                                    <i class="feather-play-circle" style="font-size: 3rem;"></i>
                                                    <p class="mt-3">Invalid Vimeo URL</p>
                                                </div>
                                            </div>
                                        @endif
                                    @else
                                        <!-- Try to handle as a direct video URL -->
                                        <video width="100%" height="100%" controls>
                                            <source src="{{ $module->link }}" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                    @endif
                                </div>
                            @else
                                <div class="d-flex align-items-center justify-content-center h-100 text-white">
                                    <div class="text-center">
                                        <i class="feather-play-circle" style="font-size: 3rem;"></i>
                                        <p class="mt-3">No video available for this module</p>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Video Title and Info -->
                        <div class="video-instructor mt-3 d-flex align-items-center mb-2">
                            @php
                                $mainTeacher = $course->teachers->first();
                            @endphp
                            @if($mainTeacher && $mainTeacher->profile_image && $mainTeacher->profile_image !== 'default_profile_image.jpg')
                                <img src="{{ asset('uploads/teachers/' . $mainTeacher->profile_image) }}" alt="{{ $mainTeacher->user->name }}" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover; margin-right: 10px;" />
                            @else
                                <img src="{{ asset('assets/frontend') }}/img/instructor/01.jpg" alt="Instructor" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover; margin-right: 10px;" />
                            @endif
                            <h6 class="mb-0" style="font-weight: 600; color: #4f46e5;">{{ $mainTeacher->user->name ?? 'Instructor' }}</h6>
                        </div>
                        <div class="video-title">
                            {{ $module->title }}
                        </div>

                        @php
                            $currentLesson = isset($lessons) && $module->lesson_id ? $lessons->firstWhere('id', $module->lesson_id) : null;

                            $currentLessonPdfs = [];
                            if ($currentLesson && isset($currentLesson->pdf_files) && $currentLesson->pdf_files) {
                                $decodedLessonPdfs = json_decode($currentLesson->pdf_files, true);
                                if (is_array($decodedLessonPdfs)) {
                                    $currentLessonPdfs = array_filter($decodedLessonPdfs, function($item) {
                                        return is_string($item) && trim($item) !== '';
                                    });
                                } elseif (is_string($currentLesson->pdf_files) && trim($currentLesson->pdf_files) !== '') {
                                    $currentLessonPdfs = [$currentLesson->pdf_files];
                                }
                            }

                            $courseRoutinePdfs = [];
                            if ($course && $course->pdf) {
                                $courseRoutinePdfs = ['uploads/courses/pdfs/' . $course->pdf];
                            }

                            $modulePdfs = [];
                            if ($module && $module->pdf_file) {
                                $modulePdfs = ['uploads/courses/modules/pdfs/' . $module->pdf_file];
                            }
                        @endphp

                        <div class="video-meta-container mb-4">
                            <table class="video-meta-table">
                                <tbody>
                                    <!-- Course Row -->
                                    <tr>
                                        <td><i class="feather-book me-2"></i>Course</td>
                                        <td class="course-name-cell">{{ $course->name ?? 'N/A' }}</td>
                                    </tr>

                                    <!-- Lesson Row -->
                                    <tr class="lesson-row" style="{{ $currentLesson ? '' : 'display: none;' }}">
                                        <td><i class="feather-layers me-2"></i>Lesson</td>
                                        <td class="lesson-name-cell">{{ $currentLesson->name ?? '' }}</td>
                                    </tr>

                                    <!-- Course Routine Row -->
                                    <tr>
                                        <td><i class="feather-calendar me-2"></i>Course Routine</td>
                                        <td class="course-routine-cell">
                                            @if(!empty($courseRoutinePdfs))
                                                @foreach($courseRoutinePdfs as $pdf)
                                                    <a href="{{ asset($pdf) }}" target="_blank" class="file-link">
                                                        <i class="feather-download"></i>Routine {{ $loop->iteration }}
                                                    </a>
                                                @endforeach
                                            @else
                                                <span class="no-files-text">No routine available</span>
                                            @endif
                                        </td>
                                    </tr>

                                    <!-- Lesson File Row -->
                                    <tr class="lesson-file-row" style="{{ !empty($currentLessonPdfs) ? '' : 'display: none;' }}">
                                        <td><i class="feather-file-text me-2"></i>Lesson File</td>
                                        <td class="lesson-file-cell">
                                            @if(!empty($currentLessonPdfs))
                                                @foreach($currentLessonPdfs as $pdf)
                                                    <a href="{{ asset($pdf) }}" target="_blank" class="file-link">
                                                        <i class="feather-download"></i>file {{ $loop->iteration }}
                                                    </a>
                                                @endforeach
                                            @else
                                                <span class="no-files-text">No files available</span>
                                            @endif
                                        </td>
                                    </tr>

                                    <!-- Module File Row -->
                                    <tr>
                                        <td><i class="feather-folder me-2"></i>Module File</td>
                                        <td class="module-file-cell">
                                            @if(!empty($modulePdfs))
                                                @foreach($modulePdfs as $pdf)
                                                    <a href="{{ asset($pdf) }}" target="_blank" class="file-link">
                                                        <i class="feather-download"></i>Lecture Sheet {{ $module->id }}
                                                    </a>
                                                @endforeach
                                            @else
                                                <span class="no-files-text">No files available</span>
                                            @endif
                                        </td>
                                    </tr>

                                    <!-- Date & Time Row -->
                                    <tr>
                                        <td><i class="feather-clock me-2"></i>Date & Time</td>
                                        <td class="date-time-cell">
                                            <span style="background-color: #00cccc; color: #fff; padding: 2px 8px; border-radius: 5px;">{{ $module->date ?? 'N/A' }}</span>
                                            <span style="background-color: #ff5454; color: #fff; padding: 2px 8px; border-radius: 5px;">{{ $module->time ?? 'N/A' }}</span>
                                        </td>
                                    </tr>
                                    @if ($hasLiveMeetingLink)
                                        <tr>
                                            <td><i class="feather-video me-2"></i>Live Class Link</td>
                                            <td>
                                                <a href="{{ $module->link }}" target="_blank" rel="noopener noreferrer" class="file-link">
                                                    <i class="feather-external-link"></i>
                                                    @if (Str::contains($module->link, ['zoom.us', 'zoom.com']))
                                                        Zoom Meeting
                                                    @elseif (Str::contains($module->link, ['meet.google.com', 'google.com']))
                                                        Google Meet
                                                    @else
                                                        Join Live Class
                                                    @endif
                                                </a>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>

                        <div class="toolbar">
                            <button class="theme-btn" id="prevVideoBtn" onclick="navigateVideo('prev')">
                                <i class="fas fa-chevron-left"></i> Previous
                            </button>
                            <button class="theme-btn" id="nextVideoBtn" onclick="navigateVideo('next')">
                                Next <i class="fas fa-chevron-right"></i>
                            </button>
                        </div>

                        {{-- @if (!empty($module->pdf_file))
                    <div class="resource-card">
                        <div class="card-header">
                            <i class="feather-file-text"></i>
                            Class Resources (PDF)
                            <a href="{{ \Illuminate\Support\Facades\Storage::url($module->pdf_file) }}" target="_blank" class="btn btn-sm btn-outline-primary ms-auto">Open in new tab</a>
                            <a href="{{ \Illuminate\Support\Facades\Storage::url($module->pdf_file) }}" download class="btn btn-sm btn-primary ms-2">Download</a>
                        </div>
                        <div class="card-body p-0">
                            <iframe class="pdf-embed" src="{{ \Illuminate\Support\Facades\Storage::url($module->pdf_file) }}#toolbar=1&navpanes=0&scrollbar=1"></iframe>
                        </div>
                    </div>
                @endif --}}
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="course-single-tab" data-aos="fade-left">
                        <div class="module-list-title px-3 pt-3">
                            <h3 class="mb-2">Course Curriculum</h3>
                            <div class="course-progress-container mb-3">
                                @php
                                    $totalModules = count($modules);
                                    $completedCount = count($completedModuleIds);
                                    $progress = $totalModules > 0 ? round(($completedCount / $totalModules) * 100) : 0;
                                @endphp
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <span class="small text-muted">Overall Progress</span>
                                    <span class="small fw-bold" id="courseProgressText">{{ $progress }}%</span>
                                </div>
                                <div class="progress" style="height: 8px; border-radius: 10px; background-color: #f1f5f9;">
                                    <div id="courseProgressBar" class="progress-bar" role="progressbar"
                                         style="width: {{ $progress }}%; background-color: #4f46e5; border-radius: 10px;"
                                         aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar-scroll">
                            <div class="course-curriculum mt-4">
                                <div class="accordion accordion-flush" id="courseLessonsAccordion">
                                    @if (isset($lessons) && $lessons->count() > 0)
                                        @foreach ($lessons as $index => $lesson)
                                            @php
                                                $lessonModules = $modules->filter(function ($mod) use ($lesson) {
                                                    return $mod->lesson_id == $lesson->id;
                                                });
                                                $isCurrentLesson = $lessonModules->contains('id', $module->id);
                                            @endphp
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="lessonHeading{{ $lesson->id }}">
                                                    <button
                                                        class="accordion-button {{ !$isCurrentLesson ? 'collapsed' : '' }}"
                                                        type="button" data-bs-toggle="collapse"
                                                        data-bs-target="#lessonCollapse{{ $lesson->id }}"
                                                        aria-expanded="{{ $isCurrentLesson ? 'true' : 'false' }}"
                                                        aria-controls="lessonCollapse{{ $lesson->id }}">
                                                        {{ $lesson->name }}
                                                    </button>
                                                </h2>
                                                <div id="lessonCollapse{{ $lesson->id }}"
                                                    class="accordion-collapse collapse {{ $isCurrentLesson ? 'show' : '' }}"
                                                    aria-labelledby="lessonHeading{{ $lesson->id }}"
                                                    data-bs-parent="#courseLessonsAccordion">
                                                    <div class="accordion-body">
                                                        @if ($lessonModules->count() > 0)
                                                            @foreach ($lessonModules as $mod)
                                                                <div class="curriculum-item {{ $isEnrolled || $mod->free_paid == 'free' ? 'unlock' : '' }} {{ $mod->id == $module->id ? 'active' : '' }}"
                                                                    data-module-id="{{ $mod->id }}"
                                                                    onclick="changeVideo(this, {{ $mod->id }})"
                                                                    style="cursor: pointer;">
                                                                    <div class="left">
                                                                        <h6>
                                                                            @if ($mod->pdf_file)
                                                                                <i class="fad fa-file-alt"></i>
                                                                            @elseif($mod->live_record == 'live')
                                                                                <i class="fad fa-video"></i>
                                                                            @else
                                                                                <i class="fad fa-play-circle"></i>
                                                                            @endif
                                                                            {{ $mod->title }}
                                                                            @if(in_array($mod->id, $completedModuleIds))
                                                                                <i class="fas fa-check-circle text-success ms-1 completion-icon" data-module-id="{{ $mod->id }}"></i>
                                                                            @else
                                                                                <i class="fas fa-check-circle text-muted ms-1 completion-icon" data-module-id="{{ $mod->id }}" style="opacity: 0.3;"></i>
                                                                            @endif
                                                                        </h6>
                                                                    </div>
                                                                    <div class="right">
                                                                        <span
                                                                            class="duration">{{ $mod->time ?? '00:00' }}</span>
                                                                        <span class="lock"><i
                                                                                class="fad {{ $isEnrolled || $mod->free_paid == 'free' ? 'fa-unlock' : 'fa-lock' }}"></i></span>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        @else
                                                            <div class="p-3 text-muted">
                                                                <i class="fad fa-info-circle me-1"></i>
                                                                No modules available for this lesson
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                        <!-- Show modules without lessons (if any) -->
                                        @php
                                            $modulesWithoutLessons = $modules->filter(function ($mod) {
                                                return empty($mod->lesson_id);
                                            });
                                            $isCurrentNoLesson = $modulesWithoutLessons->contains('id', $module->id);
                                        @endphp
                                        @if ($modulesWithoutLessons->count() > 0)
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingNoLesson">
                                                    <button
                                                        class="accordion-button {{ !$isCurrentNoLesson ? 'collapsed' : '' }}"
                                                        type="button" data-bs-toggle="collapse"
                                                        data-bs-target="#collapseNoLesson"
                                                        aria-expanded="{{ $isCurrentNoLesson ? 'true' : 'false' }}"
                                                        aria-controls="collapseNoLesson">
                                                        <i class="fad fa-folder me-2"></i>
                                                        Unclassified Modules
                                                    </button>
                                                </h2>
                                                <div id="collapseNoLesson"
                                                    class="accordion-collapse collapse {{ $isCurrentNoLesson ? 'show' : '' }}"
                                                    aria-labelledby="headingNoLesson"
                                                    data-bs-parent="#courseLessonsAccordion">
                                                    <div class="accordion-body">
                                                        @foreach ($modulesWithoutLessons as $mod)
                                                            <div class="curriculum-item {{ $isEnrolled || $mod->free_paid == 'free' ? 'unlock' : '' }} {{ $mod->id == $module->id ? 'active' : '' }}"
                                                                data-module-id="{{ $mod->id }}"
                                                                onclick="changeVideo(this, {{ $mod->id }})"
                                                                style="cursor: pointer;">
                                                                <div class="left">
                                                                    <h6>
                                                                        @if ($mod->pdf_file)
                                                                            {{-- <i class="fad fa-file-pdf"></i> --}}
                                                                            <span>PDF:</span>
                                                                        @elseif($mod->live_record == 'live')
                                                                            <i class="fad fa-video"></i>
                                                                            <span>Live:</span>
                                                                        @else
                                                                            <i class="fad fa-play-circle"></i>
                                                                            <span>Video:</span>
                                                                        @endif
                                                                        {{ $mod->title }}
                                                                        @if(in_array($mod->id, $completedModuleIds))
                                                                            <i class="fas fa-check-circle text-success ms-1 completion-icon" data-module-id="{{ $mod->id }}"></i>
                                                                        @else
                                                                            <i class="fas fa-check-circle text-muted ms-1 completion-icon" data-module-id="{{ $mod->id }}" style="opacity: 0.3;"></i>
                                                                        @endif
                                                                    </h6>
                                                                </div>
                                                                <div class="right">
                                                                    <span
                                                                        class="duration">{{ $mod->time ?? '00:00' }}</span>
                                                                    <span class="lock"><i
                                                                            class="fad {{ $isEnrolled || $mod->free_paid == 'free' ? 'fa-unlock' : 'fa-lock' }}"></i></span>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @else
                                        <div class="alert alert-info">Curriculum will be updated soon.</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>
@endsection

@push('frontend_script')
    <script src="https://cdn.plyr.io/3.7.8/plyr.polyfilled.js"></script>

    <script>
        let completedModuleIds = @json($completedModuleIds);
        let currentCourseId = {{ $course->id }};
        const assetBase = "{{ asset('') }}";
        const defaultCourseThumbnail = "{{ $course->image ? asset('uploads/courses/' . $course->image) : 'https://cdn.prod.website-files.com/62d84e447b4f9e7263d31e94/6399a4d27711a5ad2c9bf5cd_ben-sweet-2LowviVHZ-E-unsplash-1.jpeg' }}";

        (function protectCourseVideoFromInspection() {
            const isLoggedIn = {{ Auth::check() ? 'true' : 'false' }};

            if (!isLoggedIn) {
                return;
            }

            const logoutUrl = "{{ route('course.video.inspect-logout') }}";
            const loginUrl = "{{ route('login') }}";
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
            let logoutStarted = false;

            function forceLogout() {
                if (logoutStarted) {
                    return;
                }

                logoutStarted = true;

                fetch(logoutUrl, {
                    method: 'POST',
                    credentials: 'same-origin',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({ reason: 'course_video_inspection' })
                })
                .then(response => response.json().catch(() => ({})))
                .then(data => {
                    window.location.href = data.redirect || loginUrl;
                })
                .catch(() => {
                    window.location.href = loginUrl;
                });
            }

            document.addEventListener('keydown', function(event) {
                const key = (event.key || '').toLowerCase();
                const isInspectShortcut =
                    event.key === 'F12' ||
                    (event.ctrlKey && event.shiftKey && ['i', 'j', 'c'].includes(key)) ||
                    (event.metaKey && event.altKey && ['i', 'j', 'c'].includes(key)) ||
                    (event.ctrlKey && key === 'u') ||
                    (event.metaKey && key === 'u');

                if (isInspectShortcut) {
                    event.preventDefault();
                    forceLogout();
                }
            }, true);

            function detectOpenDevTools() {
                const widthGap = window.outerWidth - window.innerWidth;
                const heightGap = window.outerHeight - window.innerHeight;

                if (widthGap > 160 || heightGap > 160) {
                    forceLogout();
                    return;
                }

                const startedAt = performance.now();
                debugger;

                if (performance.now() - startedAt > 100) {
                    forceLogout();
                }
            }

            setInterval(detectOpenDevTools, 1000);
            window.addEventListener('focus', detectOpenDevTools);
            window.addEventListener('resize', detectOpenDevTools);
        })();

        function initializePlyrPlayer() {
            const playerElement = document.getElementById('player');
            if (!playerElement || typeof Plyr === 'undefined') {
                return null;
            }

            if (window.plyrInstance) {
                window.plyrInstance.destroy();
                window.plyrInstance = null;
            }

            window.plyrInstance = new Plyr('#player', {
                youtube: {
                    noCookie: true,
                    rel: 0,
                    showinfo: 0,
                    iv_load_policy: 3,
                    modestbranding: 1
                }
            });

            window.plyrInstance.on('pause', () => {
                const thumb = document.getElementById('thumbnail');
                if (thumb) thumb.style.display = 'block';
            });

            window.plyrInstance.on('play', () => {
                const thumb = document.getElementById('thumbnail');
                if (thumb) thumb.style.display = 'none';
            });

            window.plyrInstance.on('ended', () => {
                const moduleId = document.querySelector('.curriculum-item.active').getAttribute('data-module-id');
                markAsComplete(moduleId);
            });

            return window.plyrInstance;
        }

        window.addEventListener('load', function() {
            initializePlyrPlayer();

            // Live class countdown overlay
            (function() {
                const overlay = document.getElementById('liveOverlay');
                if (!overlay) return;

                const countdownPanel = document.getElementById('liveCountdownPanel');
                const countdownTimeEl = document.getElementById('liveCountdownTime');
                const joinBtn = document.getElementById('bigJoinBtn');
                const link = "{{ $module->link }}";

                const showJoinButton = () => {
                    if (joinBtn) {
                        joinBtn.style.display = 'inline-flex';
                    }
                    if (countdownPanel) {
                        countdownPanel.style.display = 'none';
                    }
                };

                const showCountdown = () => {
                    if (joinBtn) {
                        joinBtn.style.display = 'none';
                    }
                    if (countdownPanel) {
                        countdownPanel.style.display = 'block';
                    }
                };

                overlay.style.display = 'flex';

                @if ($startAt)
                    const startTs = new Date("{{ $startAt->format('Y-m-d H:i:s') }}").getTime();
                    const now = new Date().getTime();
                    if (now >= startTs) {
                        showJoinButton();
                        if (countdownTimeEl) {
                            countdownTimeEl.innerText = 'Live Now';
                        }
                    } else {
                        showCountdown();
                    }

                    const tick = setInterval(() => {
                        const now = new Date().getTime();
                        if (now < startTs) {
                            const diff = startTs - now;
                            const d = Math.floor(diff / (1000 * 60 * 60 * 24));
                            const h = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                            const m = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                            const s = Math.floor((diff % (1000 * 60)) / 1000);
                            if (countdownTimeEl) {
                                countdownTimeEl.innerText = `Starts in ${d}d ${h}h ${m}m ${s}s`;
                            }
                            showCountdown();
                        } else {
                            showJoinButton();
                            if (countdownTimeEl) {
                                countdownTimeEl.innerText = 'Live Now';
                            }
                            clearInterval(tick);
                        }
                    }, 1000);
                @else
                    // If no scheduled start time is available, show join button immediately.
                    showJoinButton();
                @endif
            })();

            // Inline module list countdown badges
            const badgeEls = document.querySelectorAll('[data-countdown]');
            badgeEls.forEach(badge => {
                const targetStr = badge.getAttribute('data-target');
                const endStr = badge.getAttribute('data-end');
                const active = badge.getAttribute('data-active') === '1';
                const link = badge.getAttribute('data-link');
                const targetTs = targetStr ? new Date(targetStr).getTime() : null;
                const endTs = endStr ? new Date(endStr).getTime() : null;

                const interval = setInterval(() => {
                    const now = new Date().getTime();

                    // If already active (within 3-month window)
                    if (active && endTs) {
                        const diffEnd = endTs - now;
                        if (diffEnd <= 0) {
                            clearInterval(interval);
                            badge.classList.remove('bg-success');
                            badge.classList.add('bg-secondary');
                            badge.innerText = 'Expired';
                            badge.style.cursor = 'default';
                            return;
                        }
                        const d = Math.floor(diffEnd / (1000 * 60 * 60 * 24));
                        const h = Math.floor((diffEnd % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                        badge.innerText = `Visible ${d}d ${h}h left`;
                        if (link) {
                            badge.style.cursor = 'pointer';
                            badge.onclick = () => window.open(link, '_blank');
                        }
                        return;
                    }

                    if (targetTs) {
                        const diffStart = targetTs - now;
                        if (diffStart <= 0) {
                            // Switch to active visibility window
                            badge.classList.remove('bg-light', 'text-dark');
                            badge.classList.add('bg-success');
                            if (endTs) {
                                const left = endTs - now;
                                const d = Math.floor(left / (1000 * 60 * 60 * 24));
                                const h = Math.floor((left % (1000 * 60 * 60 * 24)) / (1000 * 60 *
                                    60));
                                badge.innerText = `Join now • ${d}d ${h}h left`;
                            } else {
                                badge.innerText = 'Join now';
                            }
                            if (link) {
                                badge.style.cursor = 'pointer';
                                badge.onclick = () => window.open(link, '_blank');
                            }
                            return;
                        }
                        const d = Math.floor(diffStart / (1000 * 60 * 60 * 24));
                        const h = Math.floor((diffStart % (1000 * 60 * 60 * 24)) / (1000 * 60 *
                            60));
                        const m = Math.floor((diffStart % (1000 * 60 * 60)) / (1000 * 60));
                        badge.innerText = `Starts in ${d}d ${h}h ${m}m`;
                    }
                }, 1000);
            });

            // Initialize navigation buttons on load
            updateNavigationButtons();
        });
    </script>
    <script>
        function changeVideo(element, moduleId) {
            // If the element is provided, check if it's locked
            if (element && !element.classList.contains('unlock')) {
                toastr.error('Please enroll in this course to access this content');
                return;
            }

            // Show loading state
            const playerContainer = document.querySelector('.video-container');
            playerContainer.innerHTML = `
            <div class="d-flex align-items-center justify-content-center h-100 text-white">
                <div class="text-center">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="mt-3">Loading video...</p>
                </div>
            </div>
        `;

            // Prepare headers with CSRF token
            const headers = {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            };

            // Make AJAX request to get new video data
            fetch(`{{ route('ajax.course.video.data', '') }}/${moduleId}`, {
                    method: 'GET',
                    headers: headers
                })
                .then(response => {
                    if (!response.ok) {
                        // Log the specific response status and text for debugging
                        return response.text().then(text => {
                            throw new Error(`HTTP error! status: ${response.status}`);
                        });
                    }
                    return response.text().then(text => {
                        // Log raw response for debugging
                        try {
                            return JSON.parse(text);
                        } catch (e) {
                            console.error('JSON parse error:', e);
                            throw e;
                        }
                    });
                })
                .then(data => {
                    if (data.success) {
                        updateVideoPlayer(data);
                        updateModuleList(moduleId);
                        updateNavigationButtons();
                        updateVideoTitle(data.module.title);
                        updateVideoMeta(data.course, data.module, data.lesson);

                        completedModuleIds = data.completedModuleIds;

                        // Update browser history to reflect the new video
                        const newUrl = "{{ route('course.video', $course->id) }}/" + moduleId;
                        window.history.pushState({
                            moduleId: moduleId
                        }, '', newUrl);
                    } else {
                        // Handle access denied
                        playerContainer.innerHTML = `
                        <div class="d-flex align-items-center justify-content-center h-100 text-white">
                            <div class="text-center">
                                <i class="feather-lock" style="font-size: 3rem;"></i>
                                <p class="mt-3">Video content is restricted</p>
                                <p class="mt-2 small">Please enroll in this course to access this content</p>
                            </div>
                        </div>
                    `;
                        toastr.error(data.error || 'Access denied');
                    }
                })
                .catch(error => {
                    playerContainer.innerHTML = `
                    <div class="d-flex align-items-center justify-content-center h-100 text-white">
                        <div class="text-center">
                            <i class="feather-alert-triangle" style="font-size: 3rem;"></i>
                            <p class="mt-3">Failed to load video. Error: ${error.message}</p>
                        </div>
                    </div>
                `;
                    toastr.error('Failed to load video. Please try again. Error: ' + error.message);
                });
        }

        // Handle browser back/forward buttons
        window.addEventListener('popstate', function(event) {
            if (event.state && event.state.moduleId) {
                // If the user navigates back/forward, load that video
                changeVideo(event.state.moduleId);
            }
        });

        function updateVideoPlayer(data) {
            const isRestricted = !data.success || !data.hasAccess;
            const module = data.module;
            const playerContainer = document.querySelector('.video-container');

            // Build the video player HTML
            let videoPlayerHtml = '';

            // Live overlay for module with meeting link
            if (module.live_record === 'live' && module.link) {
                videoPlayerHtml += `
                <div class="video-overlay" id="liveOverlay">
                    <div class="live-countdown" id="liveCountdownPanel">
                        <div class="countdown-label">Live class starts in</div>
                        <div class="countdown-time" id="liveCountdownTime">00:00:00</div>
                    </div>
                    <a href="${module.link}" target="_blank" rel="noopener noreferrer"
                        id="bigJoinBtn"
                        class="theme-btn join-live-btn">
                        <i class="fas fa-video me-2"></i> Join Live Class
                    </a>
                </div>
                `;
            }

            // Player Shell
            const courseThumbSrc = (data.course && data.course.image)
                ? (data.course.image.startsWith('http') ? data.course.image : `${assetBase}uploads/courses/${data.course.image}`)
                : defaultCourseThumbnail;

            videoPlayerHtml += `
            <div class="plyr__video-embed" id="player" style="position: relative;">
                <img id="thumbnail"
                     src="${courseThumbSrc}"
                     style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; display: block; object-fit: cover; z-index: 1; pointer-events: none;">
        `;

            if (!isRestricted && module.link) {
                if (module.link.includes('youtube.com') || module.link.includes('youtu.be')) {
                    // Handle YouTube URLs
                    let videoId = '';
                    if (module.link.includes('youtube.com')) {
                        try {
                            const url = new URL(module.link);
                            const params = new URLSearchParams(url.search);
                            videoId = params.get('v') || '';
                        } catch (e) {
                            // If URL parsing fails, try regex
                            const match = module.link.match(/[?&]v=([^&]+)/);
                            videoId = match ? match[1] : '';
                        }
                    } else if (module.link.includes('youtu.be')) {
                        videoId = module.link.split('/').pop().split('?')[0];
                    }

                    if (videoId) {
                        videoPlayerHtml += `
                        <iframe
                            src="https://www.youtube.com/embed/${videoId}?origin=https://plyr.io&amp;iv_load_policy=3&amp;modestbranding=1&amp;playsinline=1&amp;showinfo=0&amp;rel=0&amp;enablejsapi=1&amp;endscreen=0"
                            allowfullscreen
                            allowtransparency
                            allow="autoplay">
                        </iframe>
                    `;
                    } else {
                        videoPlayerHtml += `
                        <div class="d-flex align-items-center justify-content-center h-100 text-white">
                            <div class="text-center">
                                <i class="feather-play-circle" style="font-size: 3rem;"></i>
                                <p class="mt-3">Invalid YouTube URL</p>
                            </div>
                        </div>
                    `;
                    }
                } else if (module.link.includes('vimeo.com')) {
                    // Handle Vimeo URLs
                    const match = module.link.match(/vimeo\.com\/(\d+)/);
                    let videoId = match ? match[1] : '';

                    if (videoId) {
                        videoPlayerHtml += `
                        <iframe
                            src="https://player.vimeo.com/video/${videoId}?loop=false&amp;byline=false&amp;portrait=false&amp;title=false&amp;speed=true&amp;transparent=0&amp;gesture=media"
                            allowfullscreen
                            allowtransparency
                            allow="autoplay">
                        </iframe>
                    `;
                    } else {
                        videoPlayerHtml += `
                        <div class="d-flex align-items-center justify-content-center h-100 text-white">
                            <div class="text-center">
                                <i class="feather-play-circle" style="font-size: 3rem;"></i>
                                <p class="mt-3">Invalid Vimeo URL</p>
                            </div>
                        </div>
                    `;
                    }
                } else {
                    // Handle direct video URL
                    videoPlayerHtml += `
                    <video width="100%" height="100%" controls>
                        <source src="${module.link}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                `;
                }
            } else {
                videoPlayerHtml += `
                <div class="d-flex align-items-center justify-content-center h-100 text-white">
                    <div class="text-center">
                        <i class="feather-play-circle" style="font-size: 3rem;"></i>
                        <p class="mt-3">No video available for this module</p>
                    </div>
                </div>
            `;
            }

            videoPlayerHtml += '</div>'; // Close plyr__video-embed div

            // Update the player container
            playerContainer.innerHTML = videoPlayerHtml;

            // Reinitialize Plyr player if needed
            initializePlyrPlayer();

            // Reinitialize the countdown functionality for the new video
            if (module.live_record === 'live' && module.date && module.time && data.success) {
                const startAt = parseModuleDateTime(module.date, module.time);
                if (startAt) {
                    const overlay = document.getElementById('liveOverlay');
                    const joinBtn = document.getElementById('bigJoinBtn');
                    const timeEl = document.getElementById('liveCountdownTime');
                    const canShowJoin = (module.free_paid === 'free') || data.isEnrolled;
                    const startTs = new Date(startAt).getTime();
                    const endAt = new Date(startAt);
                    endAt.setMonth(endAt.getMonth() + 3);
                    const endTs = endAt.getTime();
                    const link = module.link || '#';

                    if (overlay) {
                        overlay.style.display = 'flex';
                    }

                    if (joinBtn) {
                        joinBtn.href = link;
                        joinBtn.style.display = 'none';
                    }

                    const tick = setInterval(() => {
                        const now = new Date().getTime();
                        if (!timeEl) return;

                        if (now < startTs) {
                            const diff = startTs - now;
                            const d = Math.floor(diff / (1000 * 60 * 60 * 24));
                            const h = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                            const m = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                            const s = Math.floor((diff % (1000 * 60)) / 1000);
                            timeEl.innerText = `Starts in ${d}d ${h}h ${m}m ${s}s`;
                            if (joinBtn) {
                                joinBtn.style.display = 'none';
                            }
                            const countdownPanel = document.getElementById('liveCountdownPanel');
                            if (countdownPanel) {
                                countdownPanel.style.display = 'block';
                            }
                        } else if (now >= startTs && now < endTs) {
                            // Class is live: hide countdown, show button only
                            if (joinBtn && canShowJoin) {
                                joinBtn.style.display = 'inline-flex';
                            }
                            const countdownPanel = document.getElementById('liveCountdownPanel');
                            if (countdownPanel) {
                                countdownPanel.style.display = 'none';
                            }
                        } else {
                            // Session ended: hide both
                            if (joinBtn) {
                                joinBtn.style.display = 'none';
                            }
                            const countdownPanel = document.getElementById('liveCountdownPanel');
                            if (countdownPanel) {
                                countdownPanel.style.display = 'none';
                            }
                            if (overlay) {
                                overlay.style.display = 'none';
                            }
                            clearInterval(tick);
                        }
                    }, 1000);
                }
            }
        }

        // Parse module date time helper function
        function parseModuleDateTime(date, time) {
            date = (date || '').toString().trim();
            time = (time || '').toString().trim();

            if (!date || !time) return null;

            // Normalize time like 08.00pm -> 08:00 pm
            time = time.replace(/(\d{1,2})\.(\d{2})/gi, '$1:$2');
            time = time.replace(/\s*(am|pm)\s*$/i, ' $1');

            // Normalize date like 16.10. 2025 -> 16.10.2025
            date = date.replace(/\s*\.\s*/g, '.');
            date = date.replace(/\.+$/g, '.');
            date = date.replace(/\.{2,}/g, '.');

            // Try different date/time formats
            const candidates = [
                `${date} ${time}`
            ];

            for (let dt of candidates) {
                try {
                    return new Date(dt);
                } catch (e) {
                    // Try next format
                }
            }

            return null;
        }

        function navigateVideo(direction) {
            const currentActive = document.querySelector('.curriculum-item.active');
            if (!currentActive) return;

            const allItems = Array.from(document.querySelectorAll('.curriculum-item'));
            const currentIndex = allItems.indexOf(currentActive);

            let target;
            if (direction === 'next') {
                target = allItems[currentIndex + 1];
            } else {
                target = allItems[currentIndex - 1];
            }

            if (target) {
                const moduleId = target.getAttribute('data-module-id');
                changeVideo(target, moduleId);
            }
        }

        function updateModuleList(currentModuleId) {
            // Get all module items and update the active state
            const moduleItems = document.querySelectorAll('.curriculum-item');
            moduleItems.forEach(item => {
                const moduleId = item.getAttribute('data-module-id');
                // Use loose comparison to handle string vs integer
                if (moduleId == currentModuleId) {
                    item.classList.add('active');
                } else {
                    item.classList.remove('active');
                }
            });
        }

        function updateNavigationButtons() {
            const currentActive = document.querySelector('.curriculum-item.active');
            const prevBtn = document.getElementById('prevVideoBtn');
            const nextBtn = document.getElementById('nextVideoBtn');

            if (!currentActive || !prevBtn || !nextBtn) return;

            const allItems = Array.from(document.querySelectorAll('.curriculum-item'));
            const currentIndex = allItems.indexOf(currentActive);

            // Show/hide previous button
            if (currentIndex > 0) {
                prevBtn.style.display = 'inline-block';
            } else {
                prevBtn.style.display = 'none';
            }

            // Show/hide next button
            if (currentIndex < allItems.length - 1) {
                nextBtn.style.display = 'inline-block';
            } else {
                nextBtn.style.display = 'none';
            }
        }

        function updateVideoTitle(title) {
            const titleElement = document.querySelector('.video-title');
            if (titleElement) {
                titleElement.textContent = title;
            }
        }

        function updateVideoMeta(course, module, lesson) {
            const assetBase = "{{ asset('') }}";

            // 1. Course Row
            const courseCell = document.querySelector('.course-name-cell');
            if (courseCell) {
                courseCell.textContent = course ? (course.name || course['name'] || 'N/A') : 'N/A';
            }

            // 2. Lesson Row
            const lessonRow = document.querySelector('.lesson-row');
            const lessonNameCell = document.querySelector('.lesson-name-cell');
            if (lessonRow && lessonNameCell) {
                if (lesson) {
                    lessonNameCell.textContent = lesson.name || lesson['name'] || '';
                    lessonRow.style.display = '';
                } else {
                    lessonRow.style.display = 'none';
                }
            }

            // 3. Course Routine Row
            const routineCell = document.querySelector('.course-routine-cell');
            if (routineCell) {
                let html = '';
                const pdf = course ? (course.pdf || course['pdf']) : null;
                if (pdf) {
                    const fileUrl = pdf.startsWith('http') || pdf.startsWith('/') ? pdf : assetBase + 'uploads/courses/pdfs/' + pdf;
                    html = `
                        <a href="${fileUrl}" target="_blank" class="file-link">
                            <i class="feather-download"></i>Routine 1
                        </a>
                    `;
                } else {
                    html = '<span class="no-files-text">No routine available</span>';
                }
                routineCell.innerHTML = html;
            }

            // 4. Lesson File Row
            const lessonFileRow = document.querySelector('.lesson-file-row');
            const lessonFileCell = document.querySelector('.lesson-file-cell');
            if (lessonFileRow && lessonFileCell) {
                let html = '';
                let pdfs = [];
                const lessonPdfs = lesson ? (lesson.pdf_files || lesson['pdf_files']) : null;
                if (lessonPdfs) {
                    try {
                        const parsed = typeof lessonPdfs === 'string' ? JSON.parse(lessonPdfs) : lessonPdfs;
                        if (Array.isArray(parsed)) {
                            pdfs = parsed.filter(item => typeof item === 'string' && item.trim() !== '');
                        } else if (typeof lessonPdfs === 'string' && lessonPdfs.trim() !== '') {
                            pdfs = [lessonPdfs];
                        }
                    } catch (e) {
                        pdfs = [lessonPdfs];
                    }
                }
                if (pdfs.length > 0) {
                    pdfs.forEach((pdf, index) => {
                        const fileUrl = pdf.startsWith('http') || pdf.startsWith('/') ? pdf : assetBase + pdf;
                        html += `
                            <a href="${fileUrl}" target="_blank" class="file-link">
                                <i class="feather-download"></i>file ${index + 1}
                            </a>
                        `;
                    });
                    lessonFileRow.style.display = '';
                } else {
                    lessonFileRow.style.display = 'none';
                }
                lessonFileCell.innerHTML = html;
            }

            // 5. Module File Row
            const moduleFileCell = document.querySelector('.module-file-cell');
            if (moduleFileCell) {
                let html = '';
                const pdf = module ? (module.pdf_file || module['pdf_file']) : null;
                if (pdf) {
                    const fileUrl = pdf.startsWith('http') || pdf.startsWith('/') ? pdf : assetBase + 'uploads/courses/modules/pdfs/' + pdf;
                    const moduleId = module ? (module.id || module['id']) : '1';
                    html = `
                        <a href="${fileUrl}" target="_blank" class="file-link">
                            <i class="feather-download"></i>Lecture Sheet ${moduleId}
                        </a>
                    `;
                } else {
                    html = '<span class="no-files-text">No files available</span>';
                }
                moduleFileCell.innerHTML = html;
            }

            // 6. Date & Time Row
            const dateTimeCell = document.querySelector('.date-time-cell');
            if (dateTimeCell) {
                const date = module ? (module.date || module['date'] || 'N/A') : 'N/A';
                const time = module ? (module.time || module['time'] || 'N/A') : 'N/A';
                dateTimeCell.innerHTML = `
                    <span style="background-color: #00cccc; color: #fff; padding: 2px 8px; border-radius: 5px;">${date}</span>
                    <span style="background-color: #ff5454; color: #fff; padding: 2px 8px; border-radius: 5px;">${time}</span>
                `;
            }
        }

        // Display notification if it exists (from redirect or direct pass)
        @if (session('notification'))
            toastr.error("{{ session('notification') }}");
        @elseif (isset($notification))
            toastr.error("{{ $notification }}");
        @endif

        function markAsComplete(moduleId) {
            if (!{{ Auth::check() ? 'true' : 'false' }}) {
                toastr.warning('Please login to track your progress');
                return;
            }

            const btn = document.getElementById('markAsCompleteBtn');
            if (btn) btn.disabled = true;

            fetch("{{ route('course.mark-as-completed') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({
                    module_id: moduleId,
                    course_id: currentCourseId
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    if (data.status === 'completed') {
                        toastr.success('Lesson marked as completed!');
                    }

                    completedModuleIds = data.completedModuleIds;
                    updateModuleList(moduleId); // This will handle icons now
                    updateCourseProgressBar(data.progress);

                    // Update completion icons in sidebar
                    document.querySelectorAll(`.completion-icon[data-module-id="${moduleId}"]`).forEach(icon => {
                        icon.classList.remove('text-muted');
                        icon.classList.add('text-success');
                        icon.style.opacity = '1';
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
            })
            .finally(() => {
                if (btn) btn.disabled = false;
            });
        }

        function updateCourseProgressBar(progress) {
            const bar = document.getElementById('courseProgressBar');
            const text = document.getElementById('courseProgressText');
            if (bar) {
                bar.style.width = progress + '%';
                bar.setAttribute('aria-valuenow', progress);
            }
            if (text) {
                text.innerText = progress + '%';
            }
        }

        // Initialize button state on load
        window.addEventListener('load', function() {
            // No button to initialize anymore
        });

        // Keyboard navigation
        document.addEventListener('keydown', function(e) {
            // Add keyboard navigation support if needed
        });
    </script>
@endpush
