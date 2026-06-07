@extends('frontend.layouts.master')
@section('title', $examInfo->name . ' - ' . $course->name)

@push('frontend_style')
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs5.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
<style>
    /* Premium Styling tweaks for Summernote to match your clean theme */
    .note-editor.note-frame {
        border: 1px solid #dee2e6 !important;
        border-radius: 8px !important;
        overflow: hidden;
        box-shadow: 0 2px 4px rgba(0,0,0,0.02);
    }
    .note-toolbar {
        background-color: #f8f9fa !important;
        border-bottom: 1px solid #dee2e6 !important;
        padding: 6px 10px !important;
    }
    .note-btn {
        background: #ffffff !important;
        border: 1px solid #e2e8f0 !important;
        color: #4a5568 !important;
        padding: 5px 10px !important;
        font-size: 13px !important;
    }
    .note-btn:hover {
        background: #8e79f9 !important;
        color: #ffffff !important;
    }
    .note-status-output {
        display: none !important; /* Hides distracting status bars */
    }
</style>
<style>
    #timerCount {
        position: fixed;
        top: 100px;
        right: 30px;
        background: #e6f9f9;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        border: 1px solid #bcf0f0;
        z-index: 9999;
    }
    #clockdiv {
        display: flex;
        gap: 12px;
        justify-content: center;
    }
    #clockdiv > div {
        display: flex;
        flex-direction: column;
        align-items: center;
        background: #ffffff;
        padding: 12px 10px 8px 10px;
        border-radius: 8px;
        min-width: 65px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.02);
    }
    #clockdiv span {
        background: #ff5454;
        color: #ffffff;
        font-size: 24px;
        font-weight: bold;
        padding: 5px 10px;
        border-radius: 4px;
        display: block;
        margin-bottom: 8px;
        line-height: 1.2;
    }
    #clockdiv .smalltext {
        font-size: 13px;
        color: #00cccc;
        text-transform: capitalize;
        letter-spacing: 0;
        font-weight: 600;
    }
    .question-card {
        margin-bottom: 25px;
        border: 1px solid #dee2e6;
        box-shadow: none;
        border-radius: 8px;
    }
    .question-header {
        background-color: #f8f9fa;
        padding: 15px 20px;
        border-bottom: 1px solid #dee2e6;
    }
    .question-body {
        padding: 20px;
    }
    .form-check-label {
        font-size: 16px;
        cursor: pointer;
        padding-left: 5px;
    }
</style>
@endpush

@section('frontend_content')
<main class="main">
    <!-- breadcrumb -->
    <div class="site-breadcrumb" style="background: url({{ asset('assets/frontend') }}/img/breadcrumb/01.png)">
        <div class="container">
            <h2 class="breadcrumb-title">{{ $examInfo->name }}</h2>
            <ul class="breadcrumb-menu">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('courses') }}">Courses</a></li>
                <li><a href="{{ route('course.details', $course->id) }}">{{ $course->name }}</a></li>
                <li class="active">{{ $examInfo->name }}</li>
            </ul>
        </div>
    </div>
    <!-- breadcrumb end -->

    <div class="container py-5">
        <input type="hidden" id="examTime" value="{{ $examTime }}">

        @if($startStatus == 1 || $startStatus == 3)
        <div id="timerCount">
            <div id="clockdiv">
                        <div>
                            <span class="hours">00</span>
                            <div class="smalltext">Hours</div>
                        </div>
                        <div>
                            <span class="minutes">00</span>
                            <div class="smalltext">Minutes</div>
                        </div>
                        <div>
                            <span class="seconds">00</span>
                            <div class="smalltext">Seconds</div>
                        </div>
                    </div>
                </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-lg-10">
                @if ($startStatus == 1)
                    <div class="card shadow-lg border-0 mb-4">
                        <div class="card-body p-4">
                            <!-- Header with theme color accent -->
                            <div style="border-left: 5px solid #8e79f9; padding-left: 20px; margin-bottom: 25px;">
                                <p class="text-muted mb-2" style="font-size: 13px;">{{ $course->name }}</p>
                                <h2 class="mb-3" style="color: #8e79f9; font-size: 28px; font-weight: 700;">{{ $examInfo->name }}</h2>
                            </div>

                            <!-- Exam Details Grid -->
                            <div class="row g-3">
                                <!-- Teachers/Mentors -->
                                @if($course->teachers->count() > 0)
                                <div class="col-md-6 col-lg-4">
                                    <div style="padding: 15px; background: #f8f9fa; border-radius: 8px;">
                                        <p style="font-size: 12px; color: #8e79f9; font-weight: 600; margin-bottom: 8px;">INSTRUCTOR(S)</p>
                                        @foreach($course->teachers as $teacher)
                                            <p class="mb-1" style="font-size: 14px; font-weight: 500;">
                                                {{ $teacher->user->name ?? $teacher->name ?? 'N/A' }}
                                            </p>
                                        @endforeach
                                    </div>
                                </div>
                                @endif

                                <!-- Total Questions -->
                                <div class="col-md-6 col-lg-4">
                                    <div style="padding: 15px; background: #f8f9fa; border-radius: 8px;">
                                        <p style="font-size: 12px; color: #8e79f9; font-weight: 600; margin-bottom: 8px;">TOTAL QUESTIONS</p>
                                        <p class="mb-0" style="color: #00cccc; font-size: 24px; font-weight: 700;">{{ $questions->count() }}</p>
                                    </div>
                                </div>

                                <!-- Total Marks -->
                                <div class="col-md-6 col-lg-4">
                                    <div style="padding: 15px; background: #f8f9fa; border-radius: 8px;">
                                        <p style="font-size: 12px; color: #8e79f9; font-weight: 600; margin-bottom: 8px;">TOTAL MARKS</p>
                                        <p class="mb-0" style="color: #ff5454; font-size: 24px; font-weight: 700;">{{ $questions->sum('mark') }}</p>
                                    </div>
                                </div>

                                <!-- Start Date & Time -->
                                <div class="col-md-6 col-lg-4">
                                    <div style="padding: 15px; background: #f8f9fa; border-radius: 8px;">
                                        <p style="font-size: 12px; color: #8e79f9; font-weight: 600; margin-bottom: 8px;">START DATE & TIME</p>
                                        @if($examInfo->date && $examInfo->time)
                                            <p class="mb-0" style="font-size: 14px; font-weight: 500; color: #00cccc;">{{ \Carbon\Carbon::parse($examInfo->date)->format('d M, Y') }}</p>
                                            <p class="mb-0" style="font-size: 13px; color: #ff5454">{{ \Carbon\Carbon::parse($examInfo->time)->format('h:i A') }}</p>
                                        @else
                                            <p class="mb-0" style="font-size: 14px; color: #00cccc;">N/A</p>
                                        @endif
                                    </div>
                                </div>

                                <!-- Duration -->
                                <div class="col-md-6 col-lg-4">
                                    <div style="padding: 15px; background: #f8f9fa; border-radius: 8px;">
                                        <p style="font-size: 12px; color: #8e79f9; font-weight: 600; margin-bottom: 8px;">EXAM DURATION</p>
                                        <p class="mb-0" style="font-size: 14px; font-weight: 500;">{{ $examInfo->exam_time ?? 'N/A' }}</p>
                                    </div>
                                </div>

                                <!-- Exam Type -->
                                <div class="col-md-6 col-lg-4">
                                    <div style="padding: 15px; background: #f8f9fa; border-radius: 8px;">
                                        <p style="font-size: 12px; color: #8e79f9; font-weight: 600; margin-bottom: 8px;">EXAM TYPE</p>
                                        @if($examInfo->mcq_written == 'mcq')
                                            <span style="background-color: #00cccc; color: #fff; padding: 2px 8px; border-radius: 5px;">MCQ</span>
                                        @elseif($examInfo->mcq_written == 'written')
                                            <span style="background-color: #ff5454; color: #fff; padding: 2px 8px; border-radius: 5px;">WRITTEN</span>
                                        @else
                                            <span style="background-color: #00cccc; color: #fff; padding: 2px 8px; border-radius: 5px;">BOTH</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow-lg border-0">
                        <div class="card-body p-4 p-md-5">

                            <form method="POST" action="{{ route('frontend.exam.submit', $examInfo->id) }}">
                                @csrf

                                @php $i = 1; @endphp
                                @foreach ($questions as $question)
                                    <div class="question-card">
                                        <div class="question-header d-flex justify-content-between align-items-center">
                                            <h6 class="mb-0 fw-bold">{{ $i }}. {!! $question->question_text !!}</h6>
                                            <span style="background-color: #8e79f9; color: #fff; padding: 2px 8px; border-radius: 5px;">Mark: {{ $question->mark }}</span>
                                        </div>
                                        <div class="question-body">
                                            <div class="form-group">
                                                <label for="answer_{{ $question->id }}" class="form-label fw-bold">Your Answer:</label>
                                                <textarea class="form-control summernote-editor" name="answer_{{ $question->id }}" id="answer_{{ $question->id }}" rows="8" placeholder="Write your answer here..."></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    @php $i++; @endphp
                                @endforeach

                                <div class="text-center mt-5">
                                    <button type="submit" class="theme-btn">Submit Exam <i class="fas fa-arrow-right"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>

                @elseif($startStatus == 0)
                    <div class="card shadow-sm border-0 text-center py-5">
                        <div class="card-body">
                            <i class="fad fa-clock fa-4x text-primary mb-4"></i>
                            <h3 class="mb-3">Exam Has Not Started Yet</h3>
                            <p class="text-muted fs-5 mb-4">It will begin on: <b>{{ date('d M, Y h:i A', strtotime($examInfo->date . ' ' . $examInfo->time)) }}</b></p>
                            <a href="{{ route('course.details', $course->id) }}" class="theme-btn border-btn">Go Back to Course</a>
                        </div>
                    </div>

                @elseif($startStatus == 3)
                    <div class="card shadow-sm border-0 text-center py-5">
                        <div class="card-body">
                            <i class="fad fa-times-circle fa-4x text-danger mb-4"></i>
                            <h3 class="text-danger mb-3">Exam Time is Over</h3>
                            <p class="text-muted mb-5">You can no longer submit answers for this exam.</p>

                            <div class="text-start mt-4">
                                <h5 class="mb-4 text-center border-bottom pb-3">Review Questions</h5>
                                @php $i = 1; @endphp
                                @foreach ($questions as $question)
                                    <div class="question-card">
                                        <div class="question-header">
                                            <h6 class="mb-0 fw-bold text-dark">{{ $i }}. {!! $question->question_text !!}</h6>
                                        </div>
                                        <div class="question-body">
                                            <ul class="list-unstyled text-dark mb-0">
                                                <li class="mb-2"><i>This exam is no longer accepting answers.</i></li>
                                            </ul>
                                        </div>
                                    </div>
                                    @php $i++; @endphp
                                @endforeach
                            </div>

                            <a href="{{ route('course.details', $course->id) }}" class="theme-btn border-btn mt-4">Go Back to Course</a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</main>
@endsection

@push('frontend_script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs5.min.js"></script>

<script>
    $(document).ready(function() {
        // Initialize Premium Styled Summernote
        $('.summernote-editor').summernote({
            placeholder: 'Write your answer here...',
            tabsize: 2,
            height: 280,
            // Custom Toolbar layout built specifically for exams (Clean & Focused)
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'italic', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ],
            disableResizeEditor: true
        });

        // Handle auto-submit gracefully if time runs out
        var examTimeInput = document.getElementById('examTime');
        if(!examTimeInput) return;

        var totalMinutes = parseFloat(examTimeInput.value);
        if(isNaN(totalMinutes) || totalMinutes <= 0) return;

        var timeInSeconds = totalMinutes * 60;

        var hoursSpan = document.querySelector('.hours');
        var minutesSpan = document.querySelector('.minutes');
        var secondsSpan = document.querySelector('.seconds');

        function updateClock() {
            var h = Math.floor(timeInSeconds / 3600);
            var m = Math.floor((timeInSeconds % 3600) / 60);
            var s = Math.floor(timeInSeconds % 60);

            if(hoursSpan) hoursSpan.innerHTML = ('0' + h).slice(-2);
            if(minutesSpan) minutesSpan.innerHTML = ('0' + m).slice(-2);
            if(secondsSpan) secondsSpan.innerHTML = ('0' + s).slice(-2);

            if (timeInSeconds <= 0) {
                clearInterval(timeinterval);
                // Summernote syncs directly with the original textarea natively
                var form = document.querySelector('form');
                if(form) form.submit();
            }
            timeInSeconds--;
        }

        updateClock();
        var timeinterval = setInterval(updateClock, 1000);
    });
</script>
@endpush
