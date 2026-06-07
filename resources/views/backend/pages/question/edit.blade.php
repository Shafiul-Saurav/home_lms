@extends('backend.layouts.master')

@section('title', 'Edit Question')

@push('backend_style')
    @include('backend.pages.common.style')
    <style>
        .mcq-field { display: block; }
        .written-field { display: none; }
    </style>
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Edit Question</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('questions.index') }}">Questions</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <h3 class="card-title">Edit Question</h3>
                    <a href="{{ route('questions.index') }}" class="btn btn-sm btn-outline-primary border"><i
                            class="fa-solid fa-arrow-left fa-fw"></i> Back to List</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('questions.update', $question->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <div class="form-group">
                                    <label for="type">Question Type <span class="text-danger">*</span></label>
                                    <select name="type" class="form-control @error('type') is-invalid @enderror" id="question_type" required>
                                        <option value="mcq" {{ (old('type', $question->type) == 'mcq') ? 'selected' : '' }}>MCQ</option>
                                        <option value="written" {{ (old('type', $question->type) == 'written') ? 'selected' : '' }}>Written</option>
                                    </select>
                                    @error('type')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="form-group">
                                    <label for="mark">Mark <span class="text-danger">*</span></label>
                                    <input type="number" step="0.01" name="mark" class="form-control @error('mark') is-invalid @enderror" id="mark"
                                        value="{{ old('mark', $question->mark) }}" required>
                                    @error('mark')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="form-group">
                                    <label for="negative_mark">Negative Mark</label>
                                    <input type="number" step="0.01" name="negative_mark" class="form-control @error('negative_mark') is-invalid @enderror" id="negative_mark"
                                        value="{{ old('negative_mark', $question->negative_mark) }}">
                                    @error('negative_mark')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="form-group">
                                    <label for="is_active">Status</label>
                                    <div class="material-switch">
                                        <input id="is_active" name="is_active" type="checkbox" {{ $question->is_active ? 'checked' : '' }}>
                                        <label for="is_active" class="label-success"></label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="question_text">Question Text <span class="text-danger">*</span></label>
                                    <textarea name="question_text" id="summernote" data-summernote class="form-control @error('question_text') is-invalid @enderror" rows="3" required>{{ old('question_text', $question->question_text) }}</textarea>
                                    @error('question_text')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <!-- MCQ Fields -->
                            <div class="col-md-6 mb-3 mcq-field">
                                <div class="form-group">
                                    <label for="option_1">Option 1</label>
                                    <input type="text" name="option_1" class="form-control @error('option_1') is-invalid @enderror" id="option_1" value="{{ old('option_1', $question->option_1) }}">
                                    @error('option_1') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 mcq-field">
                                <div class="form-group">
                                    <label for="option_2">Option 2</label>
                                    <input type="text" name="option_2" class="form-control @error('option_2') is-invalid @enderror" id="option_2" value="{{ old('option_2', $question->option_2) }}">
                                    @error('option_2') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 mcq-field">
                                <div class="form-group">
                                    <label for="option_3">Option 3</label>
                                    <input type="text" name="option_3" class="form-control @error('option_3') is-invalid @enderror" id="option_3" value="{{ old('option_3', $question->option_3) }}">
                                    @error('option_3') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 mcq-field">
                                <div class="form-group">
                                    <label for="option_4">Option 4</label>
                                    <input type="text" name="option_4" class="form-control @error('option_4') is-invalid @enderror" id="option_4" value="{{ old('option_4', $question->option_4) }}">
                                    @error('option_4') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 mcq-field">
                                <div class="form-group">
                                    <label for="option_5">Option 5 (Optional)</label>
                                    <input type="text" name="option_5" class="form-control @error('option_5') is-invalid @enderror" id="option_5" value="{{ old('option_5', $question->option_5) }}">
                                    @error('option_5') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span> @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3 mcq-field">
                                <div class="form-group">
                                    <label for="correct_option">Correct Option <span class="text-danger">*</span></label>
                                    <select name="correct_option" class="form-control @error('correct_option') is-invalid @enderror" id="correct_option">
                                        <option value="">Select Correct Option</option>
                                        <option value="1" {{ old('correct_option', $question->correct_option) == '1' ? 'selected' : '' }}>Option 1</option>
                                        <option value="2" {{ old('correct_option', $question->correct_option) == '2' ? 'selected' : '' }}>Option 2</option>
                                        <option value="3" {{ old('correct_option', $question->correct_option) == '3' ? 'selected' : '' }}>Option 3</option>
                                        <option value="4" {{ old('correct_option', $question->correct_option) == '4' ? 'selected' : '' }}>Option 4</option>
                                        <option value="5" {{ old('correct_option', $question->correct_option) == '5' ? 'selected' : '' }}>Option 5</option>
                                    </select>
                                    @error('correct_option') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span> @enderror
                                </div>
                            </div>

                            <!-- Written Fields -->
                            <div class="col-12 mb-3 written-field">
                                <div class="form-group">
                                    <label for="written_answer_guide">Answer Guide / Key (For Evaluator)</label>
                                    <textarea name="written_answer_guide" id="written_answer_guide" data-summernote class="form-control @error('written_answer_guide') is-invalid @enderror" rows="4">{{ old('written_answer_guide', $question->written_answer_guide) }}</textarea>
                                    @error('written_answer_guide') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span> @enderror
                                </div>
                            </div>

                        </div>
                        <button type="submit" class="btn btn-primary">Update Question</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('backend_script')
    @include('backend.pages.common.script')

    <script type="text/javascript">
        $(document).ready(function() {
            // Type Toggle
            function toggleFields() {
                var type = $('#question_type').val();
                if(type === 'mcq') {
                    $('.mcq-field').show();
                    $('.written-field').hide();
                    $('#correct_option').prop('required', true);
                } else {
                    $('.mcq-field').hide();
                    $('.written-field').show();
                    $('#correct_option').prop('required', false);
                }
            }

            $('#question_type').change(toggleFields);
            toggleFields(); // Init on load
        });
    </script>
@endpush
