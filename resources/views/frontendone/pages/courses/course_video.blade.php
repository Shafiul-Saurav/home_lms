@extends('frontendone.layouts.master')

@push('frontendone_style')
    @include('frontend.pages.common.style')
    <link rel="stylesheet" href="https://cdn.plyr.io/3.7.8/plyr.css" />
    <style>
        .cv-page-wrap {
            background: #f8fafc;
            min-height: 60vh;
            padding: 36px 0 60px;
        }

        /* ---- Hero banner ---- */
        .cv-hero {
            background: #0d0f12;
            padding: 110px 0 36px;
            border-bottom: 3px solid #a6ff34;
        }

        .cv-hero .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: rgba(255, 255, 255, .55);
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 14px;
            transition: color .2s;
            text-decoration: none;
        }

        .cv-hero .back-btn:hover {
            color: #a6ff34;
        }

        .cv-hero h1 {
            font-size: clamp(1.4rem, 3vw, 2rem);
            font-weight: 900;
            color: #fff;
            margin: 0;
            line-height: 1.25;
        }

        /* ---- Video player container ---- */
        .video-container {
            position: relative;
            min-height: 420px;
            background: #0d0f12;
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid rgba(166, 255, 52, .18);
            box-shadow: 0 25px 70px rgba(0, 0, 0, .45);
        }

        .plyr__video-embed {
            min-height: 420px;
            position: relative;
            z-index: 1;
        }

        /* ---- Live overlay ---- */
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
            background: rgba(13, 15, 18, .55);
        }

        .video-overlay .live-countdown,
        .video-overlay .join-live-btn {
            pointer-events: auto;
        }

        .live-countdown {
            background: linear-gradient(90deg, #ff4d24 0%, #ff7849 100%);
            border: 1px solid rgba(255, 255, 255, .12);
            color: #fff;
            padding: 18px 28px;
            border-radius: 16px;
            text-align: center;
            min-width: 240px;
            animation: fadeInUp .5s ease;
            box-shadow: 0 20px 50px rgba(255, 77, 36, .35);
        }

        .live-countdown .countdown-label {
            font-size: .9rem;
            opacity: .8;
            margin-bottom: .3rem;
        }

        .live-countdown .countdown-time {
            font-size: 1.75rem;
            font-weight: 900;
        }

        .join-live-btn {
            display: none;
            padding: .9rem 2rem;
            border-radius: 999px;
            font-size: 1rem;
            font-weight: 900;
            color: #0d0f12;
            background: #a6ff34;
            box-shadow: 0 18px 50px rgba(166, 255, 52, .35);
            text-decoration: none;
            transition: transform .25s ease, box-shadow .25s ease;
            animation: lsPulse 1.5s ease-in-out infinite;
        }

        .join-live-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 24px 60px rgba(166, 255, 52, .5);
            color: #0d0f12;
        }

        @keyframes lsPulse {

            0%,
            100% {
                transform: scale(1)
            }

            50% {
                transform: scale(1.03)
            }
        }

        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(16px)
            }

            100% {
                opacity: 1;
                transform: translateY(0)
            }
        }

        /* ---- Video title + instructor ---- */
        .video-instructor {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 18px;
        }

        .video-instructor img {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #a6ff34;
        }

        .video-instructor h6 {
            font-weight: 800;
            color: #74bd0d;
            margin: 0;
            font-size: .95rem;
        }

        .video-title {
            font-size: 1.1rem;
            font-weight: 800;
            color: #111827;
            margin: 6px 0 20px;
            line-height: 1.4;
        }

        /* ---- Meta table ---- */
        .video-meta-container {
            width: 100%;
            margin-top: 4px;
        }

        .video-meta-table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 8px 30px rgba(0, 0, 0, .08);
            border: 1px solid #edf0f5;
        }

        .video-meta-table tbody tr {
            border-bottom: 1px solid #edf0f5;
            transition: background .2s;
        }

        .video-meta-table tbody tr:last-child {
            border-bottom: none;
        }

        .video-meta-table tbody tr:hover {
            background: #f8fafc;
        }

        .video-meta-table td {
            padding: 15px 20px;
            vertical-align: middle;
        }

        .video-meta-table td:first-child {
            font-weight: 700;
            color: #111827;
            width: 32%;
            background: #f2f4f8;
            font-size: .88rem;
        }

        .video-meta-table td:first-child i {
            color: #74bd0d;
            margin-right: 6px;
        }

        .video-meta-table td:last-child {
            color: #374151;
            word-break: break-word;
            font-size: .9rem;
        }

        .file-link {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 6px 13px;
            background: rgba(166, 255, 52, .15);
            color: #4a8500;
            border-radius: 6px;
            text-decoration: none;
            margin-right: 8px;
            margin-top: 4px;
            font-size: .85rem;
            font-weight: 700;
            border: 1px solid rgba(116, 189, 13, .3);
            transition: all .25s;
        }

        .file-link:hover {
            background: #74bd0d;
            color: #fff;
            border-color: #74bd0d;
            box-shadow: 0 4px 14px rgba(116, 189, 13, .35);
        }

        .no-files-text {
            color: #9ca3af;
            font-size: .85rem;
            font-style: italic;
        }

        /* ---- Toolbar (prev/next btns) ---- */
        .toolbar {
            display: flex;
            gap: 12px;
            margin-top: 20px;
        }

        .toolbar .nav-vid-btn {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 11px 22px;
            border-radius: 8px;
            background: #111827;
            color: #fff;
            font-weight: 800;
            font-size: 13px;
            border: none;
            cursor: pointer;
            transition: .3s;
            text-decoration: none;
        }

        .toolbar .nav-vid-btn:hover {
            background: #a6ff34;
            color: #0d0f12;
            box-shadow: 0 10px 28px rgba(166, 255, 52, .35);
        }

        /* ---- Sidebar / curriculum panel ---- */
        .course-single-tab {
            background: #fff;
            border-radius: 20px;
            overflow: hidden;
            border: 1px solid #edf0f5;
            box-shadow: 0 14px 45px rgba(0, 0, 0, .08);
            height: 100%;
        }

        .module-list-title {
            background: #0d0f12;
            padding: 20px 20px 18px;
            border-bottom: 2px solid #a6ff34;
        }

        .module-list-title h3 {
            color: #fff;
            font-size: 1rem;
            font-weight: 900;
            margin: 0 0 10px;
        }

        .module-list-title .small.text-muted {
            color: rgba(255, 255, 255, .55) !important;
        }

        .module-list-title #courseProgressText {
            color: #a6ff34 !important;
        }

        .module-list-title .progress {
            background: rgba(255, 255, 255, .1) !important;
        }

        .module-list-title #courseProgressBar {
            background: #a6ff34 !important;
        }

        .sidebar-scroll {
            max-height: 520px;
            overflow-y: auto;
        }

        .sidebar-scroll::-webkit-scrollbar {
            width: 4px;
        }

        .sidebar-scroll::-webkit-scrollbar-thumb {
            background: rgba(166, 255, 52, .4);
            border-radius: 4px;
        }

        /* Accordion overrides */
        .course-curriculum .accordion-item {
            border: none;
            border-bottom: 1px solid #edf0f5;
        }

        .course-curriculum .accordion-button {
            font-weight: 800;
            font-size: .9rem;
            color: #111827;
            background: #f8fafc;
            box-shadow: none;
        }

        .course-curriculum .accordion-button:not(.collapsed) {
            background: #0d0f12;
            color: #a6ff34;
        }

        .course-curriculum .accordion-button::after {
            filter: none;
        }

        .course-curriculum .accordion-button:not(.collapsed)::after {
            filter: invert(1) sepia(1) saturate(10) hue-rotate(52deg);
        }

        .course-curriculum .accordion-body {
            padding: 0;
        }

        /* Curriculum items */
        .curriculum-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 18px;
            border-bottom: 1px solid #f1f5f9;
            gap: 10px;
            transition: background .2s;
        }

        .curriculum-item:hover {
            background: #f8fafc;
        }

        .curriculum-item.active {
            background: rgba(166, 255, 52, .1);
            border-left: 3px solid #a6ff34;
        }

        .curriculum-item .left h6 {
            font-size: .83rem;
            font-weight: 700;
            color: #111827;
            margin: 0;
            line-height: 1.4;
        }

        .curriculum-item .left h6 i {
            color: #74bd0d;
            margin-right: 4px;
        }

        .curriculum-item .right {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-shrink: 0;
        }

        .curriculum-item .duration {
            font-size: .78rem;
            color: #6b7280;
            font-weight: 600;
        }

        .curriculum-item .lock i.fa-unlock {
            color: #74bd0d;
        }

        .curriculum-item .lock i.fa-lock {
            color: #ff4d24;
        }

        .curriculum-item.unlock .left h6 {
            cursor: pointer;
        }

        /* Progress bar colours inside sidebar */
        #courseProgressBar {
            background-color: #a6ff34 !important;
        }
    </style>
@endpush

@section('frontendone_content')
    <main class="main">

        <!-- breadcrumb -->
        <div
            style="padding: 120px 0 40px; background: linear-gradient(135deg, #07111f 0%, #0d1f36 50%, #12345a 100%); color: #fff;">
            <div class="container">
                <a href="{{ url()->previous() }}"
                    style="display:inline-flex;align-items:center;gap:8px;color:rgba(255,255,255,.7);text-decoration:none;font-size:.9rem;margin-bottom:12px;"
                    onmouseover="this.style.color='#fff'" onmouseout="this.style.color='rgba(255,255,255,.7)'">
                    <i class="fa-solid fa-arrow-left"></i> Back to Course
                </a>
                <h4 style="font-size:1.5rem;font-weight:700;margin:0;color:#fff;">{{ $course->name ?? 'Course Video' }}</h4>
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
                <div class="col-lg-8">
                    <div class="video-player-section" data-aos="fade-right">

                        <!-- Video Player -->
                        @php
                            $isScheduledLive =
                                strtolower(trim($module->live_record ?? '')) === 'live' &&
                                !empty($module->date) &&
                                !empty($module->time);
                            $startAt = $isScheduledLive
                                ? parseModuleDateTime($module->date ?? '', $module->time ?? '')
                                : null;
                            $endAt = $startAt ? (clone $startAt)->addMonthsNoOverflow(3) : null;
                            $hasLiveMeetingLink =
                                !empty(trim($module->link ?? '')) &&
                                (strtolower(trim($module->live_record ?? '')) === 'live' ||
                                    Str::contains(strtolower(trim($module->link)), [
                                        'zoom.us',
                                        'zoom.com',
                                        'meet.google.com',
                                        'google.com',
                                    ]));
                        @endphp

                        <div class="video-container">
                            @if ($hasLiveMeetingLink)
                                <div class="video-overlay" id="liveOverlay">
                                    <div class="live-countdown" id="liveCountdownPanel">
                                        <div class="countdown-label">Live class starts in</div>
                                        <div class="countdown-time" id="liveCountdownTime">00:00:00</div>
                                    </div>
                                    <a href="{{ $module->link }}" target="_blank" rel="noopener noreferrer" id="bigJoinBtn"
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
                            @if ($mainTeacher && $mainTeacher->profile_image && $mainTeacher->profile_image !== 'default_profile_image.jpg')
                                <img src="{{ asset('uploads/teachers/' . $mainTeacher->profile_image) }}"
                                    alt="{{ $mainTeacher->user->name }}"
                                    style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover; margin-right: 10px;" />
                            @else
                                <img src="{{ asset('assets/frontend') }}/img/instructor/01.jpg" alt="Instructor"
                                    style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover; margin-right: 10px;" />
                            @endif
                            <h6 class="mb-0" style="font-weight: 600; color: #74bd0d;">
                                {{ $mainTeacher->user->name ?? 'Instructor' }}</h6>
                        </div>
                        <div class="video-title">
                            {{ $module->title }}
                        </div>

                        @php
                            $currentLesson =
                                isset($lessons) && $module->lesson_id
                                    ? $lessons->firstWhere('id', $module->lesson_id)
                                    : null;

                            $currentLessonPdfs = [];
                            if ($currentLesson && isset($currentLesson->pdf_files) && $currentLesson->pdf_files) {
                                $decodedLessonPdfs = json_decode($currentLesson->pdf_files, true);
                                if (is_array($decodedLessonPdfs)) {
                                    $currentLessonPdfs = array_filter($decodedLessonPdfs, function ($item) {
                                        return is_string($item) && trim($item) !== '';
                                    });
                                } elseif (
                                    is_string($currentLesson->pdf_files) &&
                                    trim($currentLesson->pdf_files) !== ''
                                ) {
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
                                            @if (!empty($courseRoutinePdfs))
                                                @foreach ($courseRoutinePdfs as $pdf)
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
                                    <tr class="lesson-file-row"
                                        style="{{ !empty($currentLessonPdfs) ? '' : 'display: none;' }}">
                                        <td><i class="feather-file-text me-2"></i>Lesson File</td>
                                        <td class="lesson-file-cell">
                                            @if (!empty($currentLessonPdfs))
                                                @foreach ($currentLessonPdfs as $pdf)
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
                                            @if (!empty($modulePdfs))
                                                @foreach ($modulePdfs as $pdf)
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
                                            <span
                                                style="background-color: #a6ff3426; color: #4a8500; padding: 2px 8px; border-radius: 5px;">{{ $module->date ?? 'N/A' }}</span>
                                            <span
                                                style="background-color: #ff4d24; color: #fff; padding: 2px 8px; border-radius: 5px;">{{ $module->time ?? 'N/A' }}</span>
                                        </td>
                                    </tr>
                                    @if ($hasLiveMeetingLink)
                                        <tr>
                                            <td><i class="feather-video me-2"></i>Live Class Link</td>
                                            <td>
                                                <a href="{{ $module->link }}" target="_blank" rel="noopener noreferrer"
                                                    class="file-link">
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

                        <div class="toolbar mb-3">
                            <button class="nav-vid-btn" id="prevVideoBtn"
                                onclick="if(!this.disabled) navigateVideo('prev')">
                                <i class="fas fa-chevron-left"></i> Previous
                            </button>
                            <button class="nav-vid-btn" id="nextVideoBtn"
                                onclick="if(!this.disabled) navigateVideo('next')">
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
                            @if (Auth::check() && Auth::user()->profileCompletionPercentage() < 90)
                                <div class="alert alert-warning border-0 small mb-3 shadow-sm" style="background-color: #fffbeb; border-left: 4px solid #f59e0b; border-radius: 8px; padding: 12px;">
                                    <div class="d-flex align-items-start gap-2">
                                        <i class="fa-solid fa-triangle-exclamation text-warning mt-1" style="font-size: 14px;"></i>
                                        <div>
                                            <strong class="text-warning-dark d-block mb-1" style="color: #b45309; font-size: 12px; font-weight: 700;">Complete Your Profile ({{ Auth::user()->profileCompletionPercentage() }}%)</strong>
                                            <span style="color: #d97706; font-size: 11px; font-weight: 600; line-height: 1.3; display: block;">You must complete at least 90% of your profile to track progress and complete this course.</span>
                                            <a href="{{ route('personal.setting') }}" class="btn btn-warning btn-sm mt-2 px-3 fw-bold" style="background-color: #f59e0b; border: none; color: #fff; border-radius: 20px; font-size: 10px; padding: 4px 10px;">Update Profile</a>
                                        </div>
                                    </div>
                                </div>
                            @endif
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
                                <div class="progress"
                                    style="height: 8px; border-radius: 10px; background-color: #f1f5f9;">
                                    <div id="courseProgressBar" class="progress-bar" role="progressbar"
                                        style="width: {{ $progress }}%; background-color: #74bd0d; border-radius: 10px;"
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
                                                                            @if (in_array($mod->id, $completedModuleIds))
                                                                                <i class="fas fa-check-circle text-success ms-1 completion-icon"
                                                                                    data-module-id="{{ $mod->id }}"></i>
                                                                            @else
                                                                                <i class="fas fa-check-circle text-muted ms-1 completion-icon"
                                                                                    data-module-id="{{ $mod->id }}"
                                                                                    style="opacity: 0.3;"></i>
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
                                                                        @if (in_array($mod->id, $completedModuleIds))
                                                                            <i class="fas fa-check-circle text-success ms-1 completion-icon"
                                                                                data-module-id="{{ $mod->id }}"></i>
                                                                        @else
                                                                            <i class="fas fa-check-circle text-muted ms-1 completion-icon"
                                                                                data-module-id="{{ $mod->id }}"
                                                                                style="opacity: 0.3;"></i>
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

@push('frontendone_script')
    @include('frontend.pages.common.script')

    <script src="https://cdn.plyr.io/3.7.8/plyr.polyfilled.js"></script>

    <script>
        let completedModuleIds = @json($completedModuleIds);
        let currentCourseId = {{ $course->id }};
        const assetBase = "{{ asset('') }}";
        const defaultCourseThumbnail =
            "{{ $course->image ? asset('uploads/courses/' . $course->image) : 'https://cdn.prod.website-files.com/62d84e447b4f9e7263d31e94/6399a4d27711a5ad2c9bf5cd_ben-sweet-2LowviVHZ-E-unsplash-1.jpeg' }}";

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
                        body: JSON.stringify({
                            reason: 'course_video_inspection'
                        })
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
            const courseThumbSrc = (data.course && data.course.image) ?
                (data.course.image.startsWith('http') ? data.course.image :
                    `${assetBase}uploads/courses/${data.course.image}`) :
                defaultCourseThumbnail;

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
            const allItems = Array.from(document.querySelectorAll('.curriculum-item'));
            const currentActive = document.querySelector('.curriculum-item.active');
            if (!currentActive) {
                // fallback: treat first item as current
                if (direction === 'next' && allItems.length > 0) {
                    const first = allItems[0];
                    changeVideo(first, first.getAttribute('data-module-id'));
                }
                return;
            }

            const currentIndex = allItems.indexOf(currentActive);
            let target = (direction === 'next') ? allItems[currentIndex + 1] : allItems[currentIndex - 1];

            if (target) {
                const moduleId = target.getAttribute('data-module-id');
                changeVideo(target, moduleId);
            }
        }

        function updateModuleList(currentModuleId) {
            document.querySelectorAll('.curriculum-item').forEach(item => {
                if (item.getAttribute('data-module-id') == currentModuleId) {
                    item.classList.add('active');
                } else {
                    item.classList.remove('active');
                }
            });
        }

        function updateNavigationButtons() {
            const prevBtn = document.getElementById('prevVideoBtn');
            const nextBtn = document.getElementById('nextVideoBtn');
            if (!prevBtn || !nextBtn) return;

            const allItems = Array.from(document.querySelectorAll('.curriculum-item'));
            const currentActive = document.querySelector('.curriculum-item.active');
            const currentIndex = currentActive ? allItems.indexOf(currentActive) : -1;

            // Always show both buttons; disable when at the edges
            prevBtn.disabled = (currentIndex <= 0);
            prevBtn.style.opacity = (currentIndex <= 0) ? '0.45' : '1';
            prevBtn.style.cursor = (currentIndex <= 0) ? 'not-allowed' : 'pointer';

            nextBtn.disabled = (currentIndex < 0 || currentIndex >= allItems.length - 1);
            nextBtn.style.opacity = (currentIndex < 0 || currentIndex >= allItems.length - 1) ? '0.45' : '1';
            nextBtn.style.cursor = (currentIndex < 0 || currentIndex >= allItems.length - 1) ? 'not-allowed' : 'pointer';
        }

        function updateVideoTitle(title) {
            const titleElement = document.querySelector('.video-title');
            if (titleElement) titleElement.textContent = title;
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
                    const fileUrl = pdf.startsWith('http') || pdf.startsWith('/') ? pdf : assetBase +
                        'uploads/courses/pdfs/' + pdf;
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
                    const fileUrl = pdf.startsWith('http') || pdf.startsWith('/') ? pdf : assetBase +
                        'uploads/courses/modules/pdfs/' + pdf;
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
                    <span style="background-color: #a6ff3426; color: #4a8500; padding: 2px 8px; border-radius: 5px;">${date}</span>
                    <span style="background-color: #ff4d24; color: #fff; padding: 2px 8px; border-radius: 5px;">${time}</span>
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
                    } else {
                        toastr.error(data.message || 'Failed to mark lesson as completed.');
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

        /* ---- Navigation functions (Prev / Next) ---- */

        // updateNavigationButtons is already defined above — call it on load
        document.addEventListener('DOMContentLoaded', function() {
            updateNavigationButtons();
        });
    </script>
@endpush
