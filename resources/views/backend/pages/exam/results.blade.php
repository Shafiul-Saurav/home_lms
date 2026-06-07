@extends('backend.layouts.master')

@section('title', 'Exam Results - ' . $exam->name)

@push('backend_style')
    @include('backend.pages.common.style')
    <style>
        .result-badge {
            padding: 6px 12px;
            border-radius: 4px;
            font-weight: 600;
            font-size: 12px;
        }

        .result-completed {
            background-color: #d4edda;
            color: #155724;
        }

        .result-pending {
            background-color: #fff3cd;
            color: #856404;
        }

        .result-graded {
            background-color: #d1ecf1;
            color: #0c5460;
        }
    </style>
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Exam Results</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('exams.index') }}">Exams</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Results</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <div>
                        <h3 class="card-title">Results for: <strong class="text-success">{{ $exam->name }}</strong></h3>
                        <p class="text-muted mt-2">Total Results: <span class="badge bg-info">{{ $results->total() }}</span>
                        </p>
                    </div>
                    <a href="{{ route('exams.index') }}" class="btn btn-info"><i class="fa-solid fa-angles-left fa-fw"></i>
                        Back</a>
                    {{-- <a href="javascript:history.back()" class="btn btn-info"><i class="fa-solid fa-angles-left fa-fw"></i>
                        Back</a> --}}
                </div>
                <div class="card-body">
                    <div class="table-responsive export-table">
                        <table id="file-datatable" class="table table-bordered text-nowrap key-buttons border-bottom w-100">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">Student Name</th>
                                    <th class="border-bottom-0">Email</th>
                                    <th class="border-bottom-0">Score</th>
                                    <th class="border-bottom-0">Total Marks</th>
                                    <th class="border-bottom-0">Percentage</th>
                                    <th class="border-bottom-0">Status</th>
                                    <th class="border-bottom-0">Submitted At</th>
                                    <th class="border-bottom-0">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($results as $result)
                                    <tr>
                                        <td><strong>{{ $results->firstItem() + $loop->index }}</strong></td>
                                        <td>{{ $result->user->name ?? 'N/A' }}</td>
                                        <td>{{ $result->user->email ?? 'N/A' }}</td>
                                        <td>
                                            <strong>{{ number_format($result->total_score, 2) }}</strong>
                                        </td>
                                        <td>
                                            {{ $exam->questions->sum('mark') }}
                                        </td>
                                        <td>
                                            @php
                                                $totalMarks = $exam->questions->sum('mark');
                                                $percentage =
                                                    $totalMarks > 0 ? ($result->total_score / $totalMarks) * 100 : 0;
                                            @endphp
                                            <strong>{{ number_format($percentage, 2) }}%</strong>
                                        </td>
                                        <td>
                                            @if ($result->status === 'completed')
                                                <span class="result-badge result-completed">Evaluated</span>
                                            @elseif($result->status === 'graded')
                                                <span class="result-badge result-graded">Graded</span>
                                            @else
                                                <span class="result-badge result-pending">Pending Review</span>
                                            @endif
                                        </td>
                                        <td>
                                            <small>{{ $result->completed_at?->format('d M, Y h:i A') ?? 'N/A' }}</small>
                                        </td>
                                        <td class="text-center">
                                            <div class="action-btns d-flex align-items-center">
                                                <div>
                                                    <a href="{{ route('exam_results.show', $result->id) }}"
                                                        class="btn btn-sm btn-outline-info border me-1"
                                                        data-toggle="tooltip" data-placement="top" title="View Result">
                                                        <i class="fa-solid fa-eye fa-fw"></i>
                                                    </a>
                                                </div>
                                                {{-- @if ($exam->mcq_written != 'mcq' && $result->status !== 'graded') --}}
                                                <div>
                                                    <a href="{{ route('exam_results.grade', $result->id) }}"
                                                        class="btn btn-sm btn-outline-warning border" data-toggle="tooltip"
                                                        data-placement="top" title="Grade">
                                                        <i class="fa-solid fa-marker fa-fw"></i>
                                                    </a>
                                                </div>
                                                {{-- @endif --}}
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center py-4">
                                            <p class="text-muted">No results found for this exam.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center mt-4">
                            {{ $results->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('backend_script')
    @include('backend.pages.common.script')
@endpush
