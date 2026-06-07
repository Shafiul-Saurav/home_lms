@extends('backend.layouts.master')
@section('title', 'View Exam Result')

@push('backend_style')
    @include('backend.pages.common.style')
@endpush

@section('backend_content')
    <div class="row row-sm">
        <div class="col-lg-12">
            <!-- Student & Exam Info -->
            <div class="card overflow-hidden my-4">
                <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="card-title">Exam Result Details</h3>
                        <p class="text-muted mb-0">Result review for the student submission</p>
                    </div>
                    <a href="javascript:history.back()" class="btn btn-warning">
                        <i class="fa-solid fa-angles-left fa-fw"></i> Back
                    </a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="mb-2">{{ $result->user->name }}</h5>
                            <p class="text-muted mb-0">{{ $result->user->email }}</p>
                        </div>
                        <div class="col-md-6 text-end">
                            <h3 class="mb-2 text-secondary">{{ $result->exam->name }}</h3>
                            @if ($result->status === 'completed')
                                <span class="badge bg-success">Evaluated</span>
                            @elseif($result->status === 'graded')
                                <span class="badge bg-info">Graded</span>
                            @else
                                <span class="badge bg-warning">Pending
                                    Review</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Score & Details Cards -->
            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <div class="card overflow-hidden">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="mb-2">Total Score</h5>
                                    <h3 class="mb-0 fw-semibold" style="color: #00cccc;">
                                        {{ number_format($result->total_score, 2) }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="card overflow-hidden">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="mb-2">Exam Type</h5>
                                    @if ($result->exam->mcq_written === 'mcq')
                                        <p class="mb-0 fw-semibold badge bg-info">MCQ</p>
                                    @else
                                        <p class="mb-0 fw-semibold badge bg-success">
                                            {{ ucfirst($result->exam->mcq_written) }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="card overflow-hidden">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="mb-2">Total Questions</h5>
                                    <h3 class="mb-0 fw-semibold text-info">
                                        {{ $result->answers->count() }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="card overflow-hidden">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="mb-2">Duration</h5>
                                    <h3 class="mb-0 fw-semibold text-danger">
                                        {{ $result->exam->exam_time ?? 'N/A' }} min</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additional Info -->
            <div class="row mt-3">
                <div class="col-lg-6 col-sm-6">
                    <div class="card overflow-hidden">
                        <div class="card-body">
                            <h5 class="mb-2">Submitted At</h5>
                            <p class="mb-0">{{ $result->completed_at?->format('d M, Y h:i A') ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-6">
                    <div class="card overflow-hidden">
                        <div class="card-body">
                            <h5 class="mb-2">Student Email</h5>
                            <p class="mb-0">{{ $result->user->email ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Answers Review -->
            <div class="card mt-4">
                <div class="card-header border-bottom">
                    <h5 class="card-title mb-0">Answer Review</h5>
                </div>
                <div class="card-body">
                    @forelse($result->answers as $answer)
                        <div class="mb-4 p-3 border">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h4 class="mb-0 text-secondary">Q{{ $loop->iteration }}</h4>
                                @if ($result->exam->mcq_written === 'mcq')
                                    @if ($answer->is_correct)
                                        <span class="badge bg-success">✓ Correct</span>
                                    @else
                                        <span class="badge bg-danger">✗ Incorrect</span>
                                    @endif
                                @else
                                    <span
                                        class="badge {{ $answer->awarded_mark > 0 ? 'bg-success' : ($result->status === 'graded' ? 'bg-danger' : 'bg-warning') }}">
                                        {{ $answer->awarded_mark ?? 'Pending' }}
                                    </span>
                                @endif
                            </div>

                            <p class="mb-3 fw-semibold">{!! $answer->question->question_text !!}</p>

                            @if ($result->exam->mcq_written === 'mcq')
                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <small class="d-block mb-2 fw-semibold">Your Answer:</small>
                                        <div class="p-2 bg-light">
                                            @php
                                                $optionLabels = [
                                                    'option_1',
                                                    'option_2',
                                                    'option_3',
                                                    'option_4',
                                                    'option_5',
                                                ];
                                                $optionLabel = '';
                                                if ($answer->user_answer !== null) {
                                                    $optionLabel =
                                                        $answer->question->{$optionLabels[$answer->user_answer - 1]} ??
                                                        'N/A';
                                                }
                                            @endphp
                                            {{ $answer->user_answer !== null ? $optionLabel : 'Not answered' }}
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <small class="d-block mb-2 fw-semibold">Correct Answer:</small>
                                        <div class="p-2 bg-light">
                                            {{ $answer->question->{$optionLabels[$answer->question->correct_option - 1]} ?? 'N/A' }}
                                        </div>
                                    </div>
                                </div>
                                <p class="mb-0 mt-2">
                                    <span class="badge {{ $answer->awarded_mark > 0 ? 'bg-success' : 'bg-danger' }}">
                                        Marks: {{ $answer->awarded_mark > 0 ? '+' : '' }}{{ $answer->awarded_mark }}
                                    </span>
                                </p>
                            @else
                                <div class="mb-3">
                                    <small class="d-block mb-2 fw-semibold">Student's Answer:</small>
                                    <div class="p-2 bg-light" style="max-height: 150px; overflow-y: auto;">
                                        {!! $answer->user_answer ?? 'No answer provided' !!}
                                    </div>
                                </div>

                                @if ($result->status === 'graded')
                                    <p class="mb-2">
                                        <span class="badge bg-success">Marks: {{ $answer->awarded_mark }}</span>
                                    </p>
                                    @if (!empty($answer->feedback))
                                        <div class="p-2 bg-light">
                                            <small class="fw-semibold">Teacher Feedback:</small>
                                            <p class="mb-0 mt-1">{{ $answer->feedback }}</p>
                                        </div>
                                    @endif
                                @else
                                    <p class="text-warning mb-0">
                                        <i class="fa-solid fa-info-circle"></i> Awaiting teacher evaluation...
                                    </p>
                                @endif
                            @endif
                        </div>
                    @empty
                        <p class="text-muted">No answers found for this exam result.</p>
                    @endforelse
                </div>
            </div>

            <!-- Action Buttons -->
            @if ($result->status === 'pending_review' && $result->exam->mcq_written === 'written')
                <div class="mt-4">
                    <a href="{{ route('exam_results.grade', $result->id) }}" class="btn btn-warning btn-lg">
                        <i class="fa-solid fa-marker"></i> Grade This Exam
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection

@push('backend_script')
    @include('backend.pages.common.script')
@endpush
