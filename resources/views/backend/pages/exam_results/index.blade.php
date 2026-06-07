@extends('backend.layouts.master')
@section('title', 'Exam Results')

@push('backend_style')
    @include('backend.pages.common.style')
@endpush

@section('backend_content')
<div class="page-header">
    <div class="page-leftheader">
        <h4 class="page-title">Exam Results</h4>
    </div>
</div>

<div class="row row-sm">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                <h3 class="card-title mb-0">All Exam Results</h3>
            </div>

            <div class="card-body">
                <!-- Results Table -->
                <div class="table-responsive export-table">
                    <table id="file-datatable" class="table table-bordered text-nowrap key-buttons border-bottom w-100">
                        <thead class="bg-light">
                            <tr>
                                <th>ID</th>
                                <th>Student</th>
                                <th>Exam</th>
                                <th>Score</th>
                                <th>Status</th>
                                <th>Submitted</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($results as $result)
                                <tr>
                                    <td>#{{ $result->id }}</td>
                                    <td>
                                        <strong>{{ $result->user->name }}</strong>
                                        <br>
                                        <small class="text-muted">{{ $result->user->email }}</small>
                                    </td>
                                    <td>
                                        <strong>{{ $result->exam->name }}</strong>
                                        <br>
                                        <small class="text-muted">{{ ucfirst($result->exam->mcq_written) }}</small>
                                    </td>
                                    <td>
                                        <h5 class="mb-0">
                                            <span class="badge badge-success">{{ number_format($result->total_score, 2) }}</span>
                                        </h5>
                                    </td>
                                    <td>
                                        @if($result->status === 'completed')
                                            <span class="badge badge-success">Completed (MCQ)</span>
                                        @elseif($result->status === 'pending_review')
                                            <span class="badge badge-warning">Pending Review</span>
                                        @elseif($result->status === 'graded')
                                            <span class="badge badge-info">Graded</span>
                                        @endif
                                    </td>
                                    <td>{{ $result->completed_at?->format('d M, Y h:i A') ?? 'N/A' }}</td>
                                    <td class="text-center">
                                        <div class="action-btns d-flex align-items-center">
                                            <div>
                                                <a href="{{ route('exam_results.show', $result->id) }}"
                                                    class="btn btn-sm btn-outline-primary border me-2"
                                                    data-toggle="tooltip" data-placement="top"
                                                    title="View">
                                                    <i class="fa-solid fa-eye fa-fw"></i>
                                                </a>
                                            </div>
                                            @if($result->status === 'pending_review' && $result->exam->mcq_written === 'written')
                                                <div>
                                                    <a href="{{ route('exam_results.grade', $result->id) }}"
                                                        class="btn btn-sm btn-outline-secondary border me-2"
                                                        data-toggle="tooltip" data-placement="top"
                                                        title="Grade">
                                                        <i class="fa-solid fa-pen fa-fw"></i>
                                                    </a>
                                                </div>
                                            @endif
                                            <div>
                                                <a href="{{ route('exam_results.statistics', $result->exam->id) }}"
                                                    class="btn btn-sm btn-outline-info border me-2"
                                                    data-toggle="tooltip" data-placement="top"
                                                    title="Statistics">
                                                    <i class="fa-solid fa-chart-bar fa-fw"></i>
                                                </a>
                                            </div>
                                            <div>
                                                <form action="{{ route('exam_results.destroy', $result->id) }}" method="POST"
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
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4 text-muted">No exam results found.</td>
                                </tr>
                            @endforelse
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
@endpush
