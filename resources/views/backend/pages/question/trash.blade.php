@extends('backend.layouts.master')

@section('title', 'Question Trash')

@push('backend_style')
    @include('backend.pages.common.style')
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Question Trash</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('questions.index') }}">Questions</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Trash</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <h3 class="card-title">Deleted Questions</h3>
                    <a href="{{ route('questions.index') }}" class="btn btn-outline-info border"><i class="fa-solid fa-angles-left fa-fw"></i> Back</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive export-table">
                        <table id="file-datatable" class="table table-bordered text-nowrap key-buttons border-bottom w-100">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">Question</th>
                                    <th class="border-bottom-0">Type</th>
                                    <th class="border-bottom-0">Mark</th>
                                    <th class="border-bottom-0">Deleted At</th>
                                    @can('delete-question')
                                        <th class="border-bottom-0">Actions</th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($questions as $question)
                                    <tr>
                                        <td><strong>{{ $questions->firstItem() + $loop->index }}</strong></td>
                                        <td>{!! Str::limit(strip_tags($question->question_text), 50) !!}</td>
                                        <td><span class="badge bg-{{ $question->type == 'mcq' ? 'info' : 'success' }}">{{ strtoupper($question->type) }}</span></td>
                                        <td>{{ $question->mark }}</td>
                                        <td>{{ $question->deleted_at->format('d M, Y h:i A') }}</td>
                                        @can('delete-question')
                                            <td class="text-center">
                                                <div class="action-btns d-flex align-items-center">
                                                    <div>
                                                        <a href="{{ route('questions.restore', $question->id) }}"
                                                            class="btn btn-sm btn-outline-success border me-2"
                                                            data-toggle="tooltip" data-placement="top"
                                                            title="Restore">
                                                            <i class="fa-solid fa-rotate-left fa-fw"></i>
                                                        </a>
                                                    </div>
                                                    <div>
                                                        <form action="{{ route('questions.forceDelete', $question->id) }}" method="POST"
                                                            class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-sm btn-outline-danger border show_confirm"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Permanent Delete">
                                                                <i class="fa-solid fa-trash-can fa-fw"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                        @endcan
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
            // Delete Confirm
            $('.show_confirm').click(function(event) {
                var form = $(this).closest("form");
                event.preventDefault();
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this! This will permanently delete the question.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it permanently!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                })
            });
        });
    </script>
@endpush
