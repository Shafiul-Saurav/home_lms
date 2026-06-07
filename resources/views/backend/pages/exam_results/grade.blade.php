@extends('backend.layouts.master')
@section('title', 'Grade Exam - ' . $result->exam->name)

@push('backend_style')
    @include('backend.pages.common.style')
@endpush

@section('backend_content')
    <div class="row row-sm">
        <div class="col-lg-12">
            <!-- Student & Exam Info -->
            <div class="card overflow-hidden my-4">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <h3 class="card-title">Grade Written Exam</h3>
                    <a href="{{ route('exam_results.show', $result->id) }}" class="btn btn-warning"> <i
                            class="fa-solid fa-eye fa-fw"></i>
                        View Result</a>
                    {{-- <a href="javascript:history.back()" class="btn btn-info"><i class="fa-solid fa-angles-left fa-fw"></i>
                        Back</a> --}}
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="mb-2">{{ $result->user->name }}</h5>
                            <p class="text-muted mb-0">{{ $result->user->email }}</p>
                        </div>
                        <div class="col-md-6 text-end">
                            <h3 class="mb-2 text-secondary">{{ $result->exam->name }}</h3>
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
                                    <h5 class="mb-2">Total Marks</h5>
                                    <h3 class="mb-0 fw-semibold text-warning">
                                        {{ $answers->sum(fn($a) => $a->question->mark) }}</h3>
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
                                        {{ $answers->count() }}</h3>
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
                <div class="col-lg-3 col-sm-6">
                    <div class="card overflow-hidden">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="mb-2">Submitted At</h5>
                                    <h3 class="mb-0 fw-semibold text-primary">
                                        {{ $result->completed_at?->format('d M, Y') ?? 'N/A' }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Grading Form -->
            <div class="card mt-4">
                <div class="card-header border-bottom">
                    <h5 class="card-title mb-0">Grade Answers</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('exam_results.update_grades', $result->id) }}" method="POST" id="gradingForm">
                        @csrf

                        @forelse($answers as $answer)
                            <div class="mb-4 p-3 border" style="border-radius: 4px;">
                                <!-- Question Number and Title -->
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <div>
                                        <h4 class="mb-0 text-secondary">Q{{ $loop->iteration }}</h4>
                                    </div>
                                    <span class="badge bg-info">Max:
                                        {{ $answer->question->mark }} Marks</span>
                                </div>

                                <p class="mb-3 fw-semibold">{!! $answer->question->question_text !!}</p>

                                <!-- Student Answer -->
                                <div class="mb-3">
                                    <h5 class="d-block mb-2 fw-semibold text-success">Student's Answer</h5>

                                    @php
                                        $plainAnswer = trim(strip_tags($answer->user_answer ?? ''));
                                    @endphp

                                    @if (empty($plainAnswer))
                                        <div class="student-answer-display p-3 border"
                                            style="border-radius: 20px; background-color: #6bf5fa46; max-height: 300px; overflow-y: auto;">
                                            <em>No answer has been given.</em>
                                        </div>
                                    @else
                                        <div class="student-answer-display p-3 border"
                                            style="border-radius: 20px; background-color: #6bf5fa46;">
                                            {!! $answer->user_answer !!}
                                        </div>
                                    @endif

                                    <div aria-multiselectable="true" class="accordion-primary mb-2 mt-2"
                                        id="answerGuideAccordion-{{ $answer->id }}" role="tablist">
                                        <div class="card mb-0">
                                            <div class="card-header border-bottom-0" id="heading-{{ $answer->id }}"
                                                role="tab">
                                                <a class="accor-style2 collapsed"
                                                    aria-controls="collapse-{{ $answer->id }}" aria-expanded="false"
                                                    data-bs-toggle="collapse" href="#collapse-{{ $answer->id }}">
                                                    <i class="fe fe-plus-circle me-2"></i>Correct Answer / Answer Guide
                                                </a>
                                            </div>
                                            <div aria-labelledby="heading-{{ $answer->id }}" class="collapse"
                                                data-bs-parent="#answerGuideAccordion-{{ $answer->id }}"
                                                id="collapse-{{ $answer->id }}" role="tabpanel">
                                                <div class="card-body student-answer-display"
                                                    style="white-space: pre-wrap;">
                                                    {!! $answer->question->written_answer_guide ?? '<em>No model answer provided.</em>' !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <!-- Marks to Award -->
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label fw-bold">Marks to Award</label>
                                        <div class="input-group">
                                            <input type="number" name="marks[{{ $answer->id }}]"
                                                class="form-control marks-input" placeholder="0" step="0.5"
                                                min="0" max="{{ $answer->question->mark }}"
                                                value="{{ $answer->awarded_mark }}" required>
                                            <span class="input-group-text">/ {{ $answer->question->mark }}</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Feedback with Summernote -->
                                <div>
                                    <label class="form-label fw-bold">Teacher Feedback (Optional)</label>
                                    <textarea name="feedback[{{ $answer->id }}]" class="form-control" id="feedback[{{ $answer->id }}]"
                                        data-summernote placeholder="Provide constructive feedback for the student...">{{ $answer->feedback ?? '' }}</textarea>
                                </div>
                            </div>
                        @empty
                            <div class="alert alert-info">
                                <i class="fa-solid fa-info-circle"></i> No questions to grade.
                            </div>
                        @endforelse

                        @if ($answers->count() > 0)
                            <!-- Submit Buttons -->
                            <div class="mt-4 d-flex gap-2">
                                <button type="submit" class="btn btn-secondary">
                                    <i class="fa-solid fa-check"></i> Submit Grades
                                </button>
                                {{-- <a href="{{ route('exam_results.show', $result->id) }}" class="btn btn-secondary">
                                    <i class="fa-solid fa-times"></i> Cancel
                                </a> --}}
                            </div>
                        @endif
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('backend_script')
    @include('backend.pages.common.script')
    <script>
        // Form validation before submission
        document.getElementById('gradingForm').addEventListener('submit', function(e) {
            let isValid = true;
            const marks = document.querySelectorAll('input[name^="marks"]');

            marks.forEach(input => {
                const maxMarks = parseFloat(input.getAttribute('max'));
                const value = parseFloat(input.value) || 0;

                if (value > maxMarks) {
                    isValid = false;
                    input.classList.add('is-invalid');
                    alert('Marks cannot exceed the maximum marks (' + maxMarks + ') for this question');
                } else {
                    input.classList.remove('is-invalid');
                }
            });

            if (!isValid) {
                e.preventDefault();
            }
        });

        // Add validation styling
        const style = document.createElement('style');
        style.textContent = `
        .is-invalid {
            border-color: #dc3545 !important;
        }
    `;
        document.head.appendChild(style);
    </script>
@endpush
