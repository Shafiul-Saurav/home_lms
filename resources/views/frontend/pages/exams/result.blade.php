@extends('frontend.layouts.master')
@section('title', 'Exam Result - ' . $result->exam->name)

@push('frontend_style')
<style>
    .result-container {
        background: #ffffff;
        padding: 40px;
        border-radius: 12px;
        margin-bottom: 30px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        border: 1px solid #dee2e6;
    }
    .result-header {
        border-left: 5px solid #8e79f9;
        padding-left: 20px;
        margin-bottom: 25px;
    }
    .result-header p {
        color: #999;
        font-size: 13px;
        margin-bottom: 8px;
    }
    .result-header h2 {
        color: #8e79f9;
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 0;
    }
    .score-display {
        font-size: 48px;
        font-weight: bold;
        margin: 0;
        color: #00cccc;
    }
    .result-status {
        display: inline-block;
        padding: 8px 16px;
        border-radius: 24px;
        font-weight: 600;
        margin-top: 10px;
    }
    .status-completed {
        background-color: #96ffff !important;
        color: #00cccc;
        border: 1px solid #00cccc;
    }
    .status-pending {
        background-color: rgba(255, 152, 0, 0.3);
        color: #ff9800;
        border: 1px solid #ff9800;
    }
    .status-graded {
        background-color: #96ffff !important;
        color: #00cccc;
        border: 1px solid #00cccc;
    }
    .result-info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 15px;
    }
    .result-info-item {
        padding: 15px;
        background: #f8f9fa;
        border-radius: 8px;
    }
    .result-info-label {
        font-size: 12px;
        color: #8e79f9;
        font-weight: 600;
        margin-bottom: 8px;
    }
    .result-info-value {
        font-size: 16px;
        font-weight: 600;
        color: #333;
    }
    .answer-card {
        border-left: 4px solid #667eea;
        margin-bottom: 20px;
        padding: 15px;
        background-color: #f8f9fa;
        border-radius: 8px;
    }
    .answer-correct {
        border-left-color: #00cccc;
    }
    .answer-incorrect {
        border-left-color: #ff5454;
    }
    .answer-pending {
        border-left-color: #ff9800;
    }
    .answer-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
    }
    .question-text {
        font-weight: 600;
        color: #333;
        margin-bottom: 10px;
    }
    .user-answer {
        background-color: #e3f2fd;
        padding: 10px;
        border-radius: 4px;
        margin: 10px 0;
    }
    .mark-badge {
        display: inline-block;
        padding: 5px 10px;
        border-radius: 4px;
        font-weight: 600;
        font-size: 14px;
    }
    .mark-positive {
        background-color: #deffff;
        color: #00cccc;
    }
    .mark-negative {
        background-color: #ffcdd2;
        color: #ff5454;
    }
    .mark-zero {
        background-color: #f5f5f5;
        color: #666;
    }
</style>
@endpush

@section('frontend_content')
<main class="main">
    <!-- breadcrumb -->
    <div class="site-breadcrumb" style="background: url({{ asset('assets/frontend') }}/img/breadcrumb/01.png)">
        <div class="container">
            <h2 class="breadcrumb-title">Exam Result</h2>
            <ul class="breadcrumb-menu">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
                <li class="active">Exam Result</li>
            </ul>
        </div>
    </div>
    <!-- breadcrumb end -->

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">

                <!-- Score Card -->
                <div class="result-container">
                    <div class="result-header">
                        <p>{{ $result->exam->course->name ?? 'Exam' }}</p>
                        <h2>{{ $result->exam->name }}</h2>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <p style="margin-bottom: 5px; color: #999; font-size: 13px;">Your Score</p>
                            <div class="score-display">{{ number_format($result->total_score, 2) }}</div>
                        </div>
                        <div class="col-md-6">
                            <p style="margin-bottom: 5px; color: #999; font-size: 13px;">Status</p>
                            @if($result->status === 'completed')
                                <div class="result-status status-completed">Evaluated</div>
                            @elseif($result->status === 'graded')
                                <div class="result-status status-graded">Graded</div>
                            @else
                                <div class="result-status status-pending">Pending Review</div>
                            @endif
                        </div>
                    </div>

                    <div class="result-info-grid" style="margin-top: 30px;">
                        <div class="result-info-item">
                            <p class="result-info-label">EXAM TYPE</p>
                            <p class="result-info-value">{{ ucfirst($result->exam->mcq_written) }}</p>
                        </div>
                        <div class="result-info-item">
                            <p class="result-info-label">TOTAL QUESTIONS</p>
                            <p class="result-info-value">{{ $result->answers->count() }}</p>
                        </div>
                        <div class="result-info-item">
                            <p class="result-info-label">SUBMITTED AT</p>
                            <p class="result-info-value">{{ $result->completed_at?->format('d M, Y h:i A') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Answers Section -->
                <div class="card shadow-lg border-0">
                    <div class="card-header bg-light py-3">
                        <h4 class="mb-0">Answer Review</h4>
                    </div>
                    <div class="card-body p-4">
                        @forelse($result->answers as $answer)
                            <div class="answer-card
                                @if($result->exam->mcq_written === 'mcq')
                                    {{ $answer->is_correct ? 'answer-correct' : 'answer-incorrect' }}
                                @else
                                    {{ $result->status === 'graded' ? ($answer->awarded_mark > 0 ? 'answer-correct' : 'answer-incorrect') : 'answer-pending' }}
                                @endif
                            ">
                                <div class="answer-header">
                                    <span style="color: #666;">Q{{ $loop->iteration }}</span>
                                    @if($result->exam->mcq_written === 'mcq')
                                        @if($answer->is_correct)
                                            <span class="mark-badge mark-positive">✓ Correct</span>
                                        @else
                                            <span class="mark-badge mark-negative">✗ Incorrect</span>
                                        @endif
                                    @else
                                        <span class="mark-badge {{ $answer->awarded_mark > 0 ? 'mark-positive' : ($result->status === 'graded' ? 'mark-negative' : 'mark-zero') }}">
                                            {{ $answer->awarded_mark ?? 'Pending' }}
                                        </span>
                                    @endif
                                </div>

                                <div class="question-text">{!! $answer->question->question_text !!}</div>

                                @if($result->exam->mcq_written === 'mcq')
                                    <div class="user-answer">
                                        <strong>Your Answer:</strong>
                                        @php
                                            $optionLabels = ['option_1', 'option_2', 'option_3', 'option_4', 'option_5'];
                                            $optionLabel = '';
                                            if ($answer->user_answer !== null) {
                                                $optionLabel = $answer->question->{$optionLabels[$answer->user_answer - 1]} ?? 'N/A';
                                            }
                                        @endphp
                                        {{ $answer->user_answer !== null ? $optionLabel : 'Not answered' }}
                                    </div>

                                    <div class="user-answer" style="background-color: #deffff;">
                                        <strong style="color: #00cccc;">Correct Answer:</strong>
                                        {{ $answer->question->{$optionLabels[$answer->question->correct_option - 1]} ?? 'N/A' }}
                                    </div>

                                    <div style="margin-top: 10px;">
                                        <span style="font-size: 14px; color: #666;">
                                            Marks:
                                            <span class="mark-badge {{ $answer->awarded_mark > 0 ? 'mark-positive' : 'mark-negative' }}">
                                                {{ $answer->awarded_mark > 0 ? '+' : '' }}{{ $answer->awarded_mark }}
                                            </span>
                                        </span>
                                    </div>
                                @else
                                    <div class="user-answer">
                                        <strong>Your Answer:</strong>
                                        <div style="margin-top: 8px; color: #333; white-space: pre-wrap;">
                                            {!! $answer->user_answer !!}
                                        </div>
                                    </div>

                                    @if($result->status === 'graded')
                                        <div style="margin-top: 10px;">
                                            <span style="font-size: 14px; color: #666;">
                                                Marks Awarded:
                                                <span class="mark-badge mark-positive">
                                                    {{ $answer->awarded_mark }}
                                                </span>
                                            </span>
                                        </div>
                                        @if(!empty($answer->feedback))
                                            <div style="background-color: #fff3cd; padding: 10px; border-radius: 4px; margin-top: 10px;">
                                                <strong style="color: #856404;">Teacher Feedback:</strong>
                                                <div>{!! $answer->feedback !!}</div>
                                            </div>
                                        @endif
                                    @else
                                        <p style="color: #ff9800; font-style: italic; margin-top: 10px;">
                                            Awaiting teacher evaluation...
                                        </p>
                                    @endif
                                @endif
                            </div>
                        @empty
                            <div class="alert alert-info">No answers found for this exam.</div>
                        @endforelse
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="mt-4 text-center">
                    <a href="{{ route('user.dashboard') }}" class="theme-btn">Back to Dashboard</a>
                </div>

            </div>
        </div>
    </div>
</main>
@endsection
