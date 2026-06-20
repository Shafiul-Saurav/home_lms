@extends('backend.layouts.master')

@section('title', 'Question Management')

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
                    <h1 class="page-title">Question Management</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Questions</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <h3 class="card-title">Create Question</h3>
                    <div>
                        @can('create-question')
                            <a href="{{ route('questions.csv.import') }}" class="btn btn-sm btn-outline-info border me-2"><i
                                    class="fa-solid fa-file-csv fa-fw"></i> CSV Upload</a>
                        @endcan
                        @can('delete-question')
                            <a href="{{ route('questions.trash') }}" class="btn btn-sm btn-outline-warning border"><i
                                    class="fa-solid fa-trash-can-arrow-up fa-fw"></i> View Trash</a>
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    @can('create-question')
                        <form action="{{ route('questions.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                            <div class="col-md-3 mb-3">
                                <div class="form-group">
                                    <label for="type">Question Type <span class="text-danger">*</span></label>
                                    <select name="type" class="form-control @error('type') is-invalid @enderror" id="question_type" required>
                                        <option value="mcq" {{ old('type') == 'mcq' ? 'selected' : '' }}>MCQ</option>
                                        <option value="written" {{ old('type') == 'written' ? 'selected' : '' }}>Written</option>
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
                                        value="{{ old('mark', 1) }}" required>
                                    @error('mark')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="form-group">
                                    <label for="negative_mark">Negative Mark</label>
                                    <input type="number" step="0.01" name="negative_mark" class="form-control @error('negative_mark') is-invalid @enderror" id="negative_mark"
                                        value="{{ old('negative_mark', 0) }}">
                                    @error('negative_mark')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="question_text">Question Text <span class="text-danger">*</span></label>
                                    <textarea name="question_text" id="question_text" data-summernote class="form-control @error('question_text') is-invalid @enderror" rows="3" required>{{ old('question_text') }}</textarea>
                                    @error('question_text')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <!-- MCQ Fields -->
                            <div class="col-md-6 mb-3 mcq-field">
                                <div class="form-group">
                                    <label for="option_1">Option 1</label>
                                    <input type="text" name="option_1" class="form-control @error('option_1') is-invalid @enderror" id="option_1" value="{{ old('option_1') }}">
                                    @error('option_1') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 mcq-field">
                                <div class="form-group">
                                    <label for="option_2">Option 2</label>
                                    <input type="text" name="option_2" class="form-control @error('option_2') is-invalid @enderror" id="option_2" value="{{ old('option_2') }}">
                                    @error('option_2') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 mcq-field">
                                <div class="form-group">
                                    <label for="option_3">Option 3</label>
                                    <input type="text" name="option_3" class="form-control @error('option_3') is-invalid @enderror" id="option_3" value="{{ old('option_3') }}">
                                    @error('option_3') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 mcq-field">
                                <div class="form-group">
                                    <label for="option_4">Option 4</label>
                                    <input type="text" name="option_4" class="form-control @error('option_4') is-invalid @enderror" id="option_4" value="{{ old('option_4') }}">
                                    @error('option_4') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 mcq-field">
                                <div class="form-group">
                                    <label for="option_5">Option 5 (Optional)</label>
                                    <input type="text" name="option_5" class="form-control @error('option_5') is-invalid @enderror" id="option_5" value="{{ old('option_5') }}">
                                    @error('option_5') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span> @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3 mcq-field">
                                <div class="form-group">
                                    <label for="correct_option">Correct Option <span class="text-danger">*</span></label>
                                    <select name="correct_option" class="form-control @error('correct_option') is-invalid @enderror" id="correct_option">
                                        <option value="">Select Correct Option</option>
                                        <option value="1" {{ old('correct_option') == '1' ? 'selected' : '' }}>Option 1</option>
                                        <option value="2" {{ old('correct_option') == '2' ? 'selected' : '' }}>Option 2</option>
                                        <option value="3" {{ old('correct_option') == '3' ? 'selected' : '' }}>Option 3</option>
                                        <option value="4" {{ old('correct_option') == '4' ? 'selected' : '' }}>Option 4</option>
                                        <option value="5" {{ old('correct_option') == '5' ? 'selected' : '' }}>Option 5</option>
                                    </select>
                                    @error('correct_option') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span> @enderror
                                </div>
                            </div>

                            <!-- Written Fields -->
                            <div class="col-12 mb-3 written-field">
                                <div class="form-group">
                                    <label for="written_answer_guide">Answer Guide / Key (For Evaluator)</label>
                                    <textarea name="written_answer_guide" id="written_answer_guide" data-summernote class="form-control @error('written_answer_guide') is-invalid @enderror" rows="4">{{ old('written_answer_guide') }}</textarea>
                                    @error('written_answer_guide') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span> @enderror
                                </div>
                            </div>

                            </div>
                            <button type="submit" class="btn btn-primary">Create Question</button>
                        </form>
                    @endcan
                </div>
            </div>
        </div>
    </div>

    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h3 class="card-title">Question List</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive export-table">
                        <div class="table-container">
                            @can('edit-question')
                                <div class="table-header mb-2">
                                    <div class="">
                                        <div class="actions-buttons d-flex align-items-center gap-2">
                                            <select id="examAssignSelect" class="form-control select2-style1">
                                                <option value="">Select Exam (Course)</option>
                                                @if(isset($exams))
                                                    @foreach($exams as $exam)
                                                        <option value="{{ $exam->id }}">{{ $exam->title }} ({{ $exam->course->name ?? 'No Course' }})</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <button type="button" class="btn btn-success btn-sm" id="assignQuestionsBtn" disabled>
                                                <i class="fa-solid fa-check"></i> Assign Selected
                                            </button>
                                            <span id="selectedCount" class="text-muted text-nowrap" style="font-size: 13px;">0 items selected</span>
                                        </div>
                                    </div>
                                </div>
                            @endcan
                        </div>
                        <table id="file-datatable" class="table table-bordered text-nowrap key-buttons border-bottom w-100">
                            <thead>
                                <tr>
                                    @can('edit-question')
                                        <th class="border-bottom-0" width="5%">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input check_all" id="checkAllQuestions">
                                                <label class="form-check-label" for="checkAllQuestions"></label>
                                            </div>
                                        </th>
                                    @endcan
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">Question</th>
                                    <th class="border-bottom-0">Type</th>
                                    <th class="border-bottom-0">Mark</th>
                                    @if(request('type') != 'written')
                                        <th class="border-bottom-0">Correct Option</th>
                                    @endif
                                    @if(!request('type'))
                                        @can('edit-question')
                                            <th class="border-bottom-0">Status</th>
                                        @endcan
                                    @endif
                                    @canany(['edit-question', 'delete-question'])
                                        <th class="border-bottom-0">Actions</th>
                                    @endcanany
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($questions as $question)
                                    <tr>
                                        @can('edit-question')
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input question_checkbox" type="checkbox" value="{{ $question->id }}" id="qCheckbox{{ $question->id }}">
                                                    <label class="form-check-label" for="qCheckbox{{ $question->id }}"></label>
                                                </div>
                                            </td>
                                        @endcan
                                        <td><strong>{{ $questions->firstItem() + $loop->index }}</strong></td>
                                        <td>{!! Str::limit(strip_tags($question->question_text), 50) !!}</td>
                                        <td><span class="badge bg-{{ $question->type == 'mcq' ? 'info' : 'success' }}">{{ strtoupper($question->type) }}</span></td>
                                        <td>{{ $question->mark }}</td>
                                        @if(request('type') != 'written')
                                            <td>{{ $question->type == 'mcq' ? 'Option ' . $question->correct_option : 'N/A' }}</td>
                                        @endif
                                        @if(!request('type'))
                                            @can('edit-question')
                                                <td>
                                                    <div class="material-switch">
                                                        <input id="active-{{ $question->id }}" class="toggle-class-active" name="is_active"
                                                            type="checkbox" {{ $question->is_active ? 'checked' : '' }}
                                                            data-id="{{ $question->id }}">
                                                        <label for="active-{{ $question->id }}" class="label-success"></label>
                                                    </div>
                                                </td>
                                            @endcan
                                        @endif
                                        @canany(['edit-question', 'delete-question'])
                                            <td class="text-center">
                                                <div class="action-btns d-flex align-items-center">
                                                    @can('edit-question')
                                                        <div>
                                                            <a href="{{ route('questions.edit', $question->id) }}"
                                                                class="btn btn-sm btn-outline-secondary border me-2"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Edit">
                                                                <i class="fa-solid fa-pen fa-fw"></i>
                                                            </a>
                                                        </div>
                                                    @endcan
                                                    @can('delete-question')
                                                        <div>
                                                            <form action="{{ route('questions.destroy', $question->id) }}" method="POST"
                                                                class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-sm btn-outline-warning border show_confirm"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="Delete">
                                                                    <i class="fa-solid fa-trash-can fa-fw"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    @endcan
                                                </div>
                                            </td>
                                        @endcanany
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
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

            // Status Toggle
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.toggle-class-active').change(function() {
                var is_active = $(this).prop('checked') == true ? 1 : 0;
                var id = $(this).data('id');
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '{{ route('question.is_active.ajax', '') }}/' + id,
                    success: function(data) {
                        toastr.success('Status Changed Successfully');
                    },
                    error: function(xhr, status, error) {
                        toastr.error('Something went wrong');
                    }
                });
            });

            // Delete Confirm
            $('.show_confirm').click(function(event) {
                var form = $(this).closest("form");
                event.preventDefault();
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                })
            });

            // Check All / Uncheck All Questions
            $('#checkAllQuestions').on('change', function() {
                var is_checked = $(this).is(':checked');
                $('.question_checkbox:visible').prop('checked', is_checked);
                updateAssignButtonState();
            });

            // Handle individual question checkbox change
            $(document).on('change', '.question_checkbox', function() {
                var totalCheckboxes = $('.question_checkbox:visible').length;
                var checkedCheckboxes = $('.question_checkbox:visible:checked').length;

                if (totalCheckboxes > 0 && totalCheckboxes === checkedCheckboxes) {
                    $('#checkAllQuestions').prop('checked', true);
                } else {
                    $('#checkAllQuestions').prop('checked', false);
                }
                updateAssignButtonState();
            });

            // Handle exam dropdown change
            $('#examAssignSelect').on('change', function() {
                updateAssignButtonState();
            });

            function updateAssignButtonState() {
                var count = $('.question_checkbox:visible:checked').length;
                var examSelected = $('#examAssignSelect').val() !== '';

                // Update text
                $('#selectedCount').text(count + (count === 1 ? ' item selected' : ' items selected'));

                if (count > 0 && examSelected) {
                    $('#assignQuestionsBtn').prop('disabled', false);
                    $('#assignQuestionsBtn').html('<i class="fa-solid fa-check"></i> Assign Selected');
                } else {
                    $('#assignQuestionsBtn').prop('disabled', true);
                    $('#assignQuestionsBtn').html('<i class="fa-solid fa-check"></i> Assign Selected');
                }
            }

            // Assign Questions Button Click
            $('#assignQuestionsBtn').click(function() {
                var selectedQuestions = $('.question_checkbox:checked').map(function() {
                    return $(this).val();
                }).get();
                var examId = $('#examAssignSelect').val();

                if (selectedQuestions.length === 0 || !examId) {
                    toastr.warning('Please select questions and an exam to assign.');
                    return;
                }

                $.ajax({
                    url: '{{ route("questions.assign_to_exam") }}',
                    type: 'POST',
                    data: {
                        exam_id: examId,
                        question_ids: selectedQuestions
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                title: 'Success!',
                                text: response.message,
                                icon: 'success',
                                timer: 2000,
                                showConfirmButton: false
                            });
                            // Uncheck all
                            $('.question_checkbox').prop('checked', false);
                            $('#checkAllQuestions').prop('checked', false);
                            updateAssignButtonState();
                        } else {
                            Swal.fire('Notice', response.message, 'info');
                        }
                    },
                    error: function(xhr) {
                        Swal.fire('Error', 'An error occurred while assigning questions.', 'error');
                    }
                });
            });
        });
    </script>
@endpush
