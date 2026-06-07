@extends('backend.layouts.master')

@section('title', 'Assigned Questions')

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Assigned Questions</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('exams.index') }}">Exams</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Assigned Questions</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h3 class="card-title">Assigned Questions for: <strong>{{ $exam->name }}</strong></h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive export-table">
                        <div class="table-container">
                            <div class="table-header mb-2">
                                <div class="d-flex justify-content-end align-items-center">
                                    <div class="actions-buttons d-flex align-items-center gap-2">
                                        <button type="button" class="btn btn-danger btn-sm" id="unassignQuestionsBtn"
                                            disabled>
                                            <i class="fa-solid fa-trash-can"></i> Unassign Selected
                                        </button>
                                        <span id="selectedCount" class="text-muted text-nowrap" style="font-size: 13px;">0
                                            items selected</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table id="file-datatable" class="table table-bordered text-nowrap key-buttons border-bottom w-100">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0" width="5%">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input check_all"
                                                id="checkAllQuestions">
                                            <label class="form-check-label" for="checkAllQuestions"></label>
                                        </div>
                                    </th>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">Question</th>
                                    <th class="border-bottom-0">Type</th>
                                    <th class="border-bottom-0">Mark</th>
                                    @if($exam->mcq_written != 'written')
                                        <th class="border-bottom-0">Correct Option</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($questions as $question)
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input question_checkbox" type="checkbox"
                                                    value="{{ $question->id }}" id="qCheckbox{{ $question->id }}">
                                                <label class="form-check-label" for="qCheckbox{{ $question->id }}"></label>
                                            </div>
                                        </td>
                                        <td><strong>{{ $questions->firstItem() + $loop->index }}</strong></td>
                                        <td>{!! Str::limit(strip_tags($question->question_text), 50) !!}</td>
                                        <td><span
                                                class="badge bg-{{ $question->type == 'mcq' ? 'info' : 'success' }}">{{ strtoupper($question->type) }}</span>
                                        </td>
                                        <td>{{ $question->mark }}</td>
                                        @if($exam->mcq_written != 'written')
                                            <td>{{ $question->type == 'mcq' ? 'Option ' . $question->correct_option : 'N/A' }}</td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center mt-4">
                            {{ $questions->links() }}
                        </div>
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

            function updateAssignButtonState() {
                var count = $('.question_checkbox:visible:checked').length;

                // Update text
                $('#selectedCount').text(count + (count === 1 ? ' item selected' : ' items selected'));

                if (count > 0) {
                    $('#unassignQuestionsBtn').prop('disabled', false);
                } else {
                    $('#unassignQuestionsBtn').prop('disabled', true);
                }
            }

            // Unassign Questions Button Click
            $('#unassignQuestionsBtn').click(function() {
                var selectedQuestions = $('.question_checkbox:checked').map(function() {
                    return $(this).val();
                }).get();
                var examId = '{{ $exam->id }}';

                if (selectedQuestions.length === 0) {
                    toastr.warning('Please select questions to unassign.');
                    return;
                }

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You are about to unassign these questions from the exam.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, unassign!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '{{ route('exams.questions.unassign') }}',
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
                                    }).then(() => {
                                        window.location.reload();
                                    });
                                } else {
                                    Swal.fire('Notice', response.message, 'info');
                                }
                            },
                            error: function(xhr) {
                                Swal.fire('Error',
                                    'An error occurred while unassigning questions.',
                                    'error');
                            }
                        });
                    }
                });
            });
        });
    </script>
@endpush
