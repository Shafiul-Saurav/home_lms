@extends('frontend.layouts.master')

@push('frontend_style')
    <link rel="stylesheet" href="https://cdn.plyr.io/3.7.8/plyr.css" />
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
                                $module->live_record === 'live' && !empty($module->date) && !empty($module->time);
                            $startAt = $isScheduledLive
                                ? parseModuleDateTime($module->date ?? '', $module->time ?? '')
                                : null;
                            $endAt = $startAt ? (clone $startAt)->addMonthsNoOverflow(3) : null;
                        @endphp

                        {{-- <div id="bigCountdown" class="countdown-panel">
                             <div class="d-flex align-items-center justify-content-between">
                                 <div>
                                     <div style="font-size:16px; opacity:0.9;">Live session</div>
                                     <div class="countdown-time" id="bigCountdownTime">Starts soon…</div>
                                 </div>
                                 @php $showJoin = ($module->free_paid === 'free') || (!empty($isEnrolled)); @endphp
                                 <a id="bigJoinBtn" href="{{ $showJoin ? $module->link : '#' }}" target="_blank"
                                     class="btn btn-primary" style="display:none">Join Meeting</a>
                             </div>
                             @if ($startAt)
                                 <div class="small mt-2">Start: {{ $startAt->format('M d, Y h:i A') }} | Visible until:
                                     {{ $endAt->format('M d, Y h:i A') }}</div>
                             @endif
                         </div> --}}
                        <div class="video-container">
                            @php
                                $isRestricted = isset($notification);
                            @endphp
                            
                            <!-- Plyr Video Player Shell -->
                            <div class="plyr__video-embed" id="player" style="position: relative;">
                                <!-- Custom thumbnail overlay -->
                                <img id="thumbnail"
                                    src="https://cdn.prod.website-files.com/62d84e447b4f9e7263d31e94/6399a4d27711a5ad2c9bf5cd_ben-sweet-2LowviVHZ-E-unsplash-1.jpeg"
                                    style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; display: {{ $isRestricted ? 'block' : 'none' }}; object-fit: cover; z-index: 10; border-radius: 12px;">
                                
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
                        <div class="video-title">
                            {{ $module->title }}
                        </div>

                        <div class="video-meta">
                            <p><strong>Course:</strong> {{ $course->name ?? 'N/A' }}</p>
                            <p><strong>Date:</strong> {{ $module->date ?? 'N/A' }} |
                                <strong>Time:</strong> {{ $module->time ?? 'N/A' }}
                            </p>
                        </div>

                        <div class="toolbar">
                            <button class="btn btn-soft" id="prevVideoBtn" onclick="navigateVideo('prev')"><i
                                    class="feather-skip-back"></i> Previous</button>
                            <button class="btn btn-soft" id="nextVideoBtn" onclick="navigateVideo('next')">Next <i
                                    class="feather-skip-forward"></i></button>
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
                            <h3 class="mb-0">Course Curriculum</h3>
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
                                                                                <i class="fad fa-file-pdf"></i>
                                                                                <span>PDF:</span>
                                                                            @elseif($mod->live_record == 'live')
                                                                                <i class="fad fa-video"></i>
                                                                                <span>Live:</span>
                                                                            @else
                                                                                <i class="fad fa-play-circle"></i>
                                                                                <span>Video:</span>
                                                                            @endif
                                                                            {{ $mod->title }}
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
                                                                            <i class="fad fa-file-pdf"></i>
                                                                            <span>PDF:</span>
                                                                        @elseif($mod->live_record == 'live')
                                                                            <i class="fad fa-video"></i>
                                                                            <span>Live:</span>
                                                                        @else
                                                                            <i class="fad fa-play-circle"></i>
                                                                            <span>Video:</span>
                                                                        @endif
                                                                        {{ $mod->title }}
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

            const thumbnail = document.getElementById('thumbnail');

            window.plyrInstance.on('pause', () => {
                if (thumbnail) {
                    thumbnail.style.display = 'block';
                }
            });

            window.plyrInstance.on('play', () => {
                if (thumbnail) {
                    thumbnail.style.display = 'none';
                }
            });

            return window.plyrInstance;
        }

        window.addEventListener('load', function() {
            initializePlyrPlayer();

            // Large countdown (current module)
            (function() {
                const big = document.getElementById('bigCountdown');
                if (!big) return;
                const isLive = {{ $isScheduledLive ? 'true' : 'false' }};
                const canShowJoin =
                    {{ $module->free_paid === 'free' || !empty($isEnrolled) ? 'true' : 'false' }};
                @if ($startAt)
                    const startTs = new Date("{{ $startAt->format('Y-m-d H:i:s') }}").getTime();
                    const endTs = new Date("{{ $endAt->format('Y-m-d H:i:s') }}").getTime();
                    const joinBtn = document.getElementById('bigJoinBtn');
                    const timeEl = document.getElementById('bigCountdownTime');
                    const link = "{{ $module->link }}";
                    if (isLive) {
                        big.style.display = 'block';
                        const tick = setInterval(() => {
                            const now = new Date().getTime();
                            if (now < startTs) {
                                const diff = startTs - now;
                                const d = Math.floor(diff / (1000 * 60 * 60 * 24));
                                const h = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                const m = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                                const s = Math.floor((diff % (1000 * 60)) / 1000);
                                timeEl.innerText = `Starts in ${d}d ${h}h ${m}m ${s}s`;
                                joinBtn.style.display = canShowJoin ? 'none' : 'none';
                            } else if (now >= startTs && now < endTs) {
                                const left = endTs - now;
                                const d = Math.floor(left / (1000 * 60 * 60 * 24));
                                const h = Math.floor((left % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                timeEl.innerText = `Live • ${d}d ${h}h left`;
                                if (canShowJoin) {
                                    joinBtn.style.display = 'inline-block';
                                    joinBtn.onclick = () => window.open(link, '_blank');
                                } else {
                                    joinBtn.style.display = 'none';
                                }
                            } else {
                                timeEl.innerText = 'Expired';
                                joinBtn.style.display = 'none';
                                clearInterval(tick);
                            }
                        }, 1000);
                    }
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
                        updateVideoMeta(data.course, data.module);

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
            
            // Player Shell
            videoPlayerHtml += `
            <div class="plyr__video-embed" id="player" style="position: relative;">
                <img id="thumbnail"
                     src="https://cdn.prod.website-files.com/62d84e447b4f9e7263d31e94/6399a4d27711a5ad2c9bf5cd_ben-sweet-2LowviVHZ-E-unsplash-1.jpeg"
                     style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; display: ${isRestricted ? 'block' : 'none'}; object-fit: cover; z-index: 10; border-radius: 12px;">
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
                    const big = document.getElementById('bigCountdown');
                    if (big) {
                        const startTs = new Date(startAt).getTime();
                        const endAt = new Date(startAt);
                        endAt.setMonth(endAt.getMonth() + 3);
                        const endTs = endAt.getTime();
                        const joinBtn = document.getElementById('bigJoinBtn');
                        const timeEl = document.getElementById('bigCountdownTime');
                        const link = module.link || '#';
                        const canShowJoin = (module.free_paid === 'free') || data.isEnrolled;

                        if (joinBtn) {
                            if (canShowJoin) {
                                joinBtn.style.display = 'none';
                            }
                        }

                        // Start countdown
                        const tick = setInterval(() => {
                            const now = new Date().getTime();
                            if (now < startTs) {
                                const diff = startTs - now;
                                const d = Math.floor(diff / (1000 * 60 * 60 * 24));
                                const h = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                const m = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                                const s = Math.floor((diff % (1000 * 60)) / 1000);
                                timeEl.innerText = `Starts in ${d}d ${h}h ${m}m ${s}s`;
                                if (joinBtn && canShowJoin) {
                                    joinBtn.style.display = 'none';
                                }
                            } else if (now >= startTs && now < endTs) {
                                const left = endTs - now;
                                const d = Math.floor(left / (1000 * 60 * 60 * 24));
                                const h = Math.floor((left % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                timeEl.innerText = `Live • ${d}d ${h}h left`;
                                if (joinBtn && canShowJoin) {
                                    joinBtn.style.display = 'inline-block';
                                    joinBtn.onclick = (e) => {
                                        e.preventDefault();
                                        window.open(link, '_blank');
                                    };
                                } else if (joinBtn) {
                                    joinBtn.style.display = 'none';
                                }
                            } else {
                                timeEl.innerText = 'Expired';
                                if (joinBtn) joinBtn.style.display = 'none';
                                clearInterval(tick);
                            }
                        }, 1000);
                    }
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
                const moduleId = parseInt(item.getAttribute('data-module-id'));
                if (moduleId === currentModuleId) {
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

        function updateVideoMeta(course, module) {
            const metaElement = document.querySelector('.video-meta');
            if (metaElement) {
                metaElement.innerHTML = `
                <p><strong>Course:</strong> ${course ? (course.name || course['name'] || 'N/A') : 'N/A'}</p>
                <p><strong>Date:</strong> ${module.date || module['date'] || 'N/A'} |
                   <strong>Time:</strong> ${module.time || module['time'] || 'N/A'}</p>
            `;
            }
        }

        // Display notification if it exists (from redirect or direct pass)
        @if (session('notification'))
            toastr.error("{{ session('notification') }}");
        @elseif (isset($notification))
            toastr.error("{{ $notification }}");
        @endif

        // Keyboard navigation
        document.addEventListener('keydown', function(e) {
            // Add keyboard navigation support if needed
        });
    </script>
@endpush
