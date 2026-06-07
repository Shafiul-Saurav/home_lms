@extends('backend.layouts.master')
@section('title', 'Exam Statistics - ' . $exam->name)

@push('backend_style')
<style>
    .stat-card {
        padding: 20px;
        border-radius: 8px;
        color: white;
        text-align: center;
    }
    .stat-card h5 {
        font-size: 24px;
        font-weight: bold;
        margin: 10px 0;
    }
    .stat-card p {
        margin: 5px 0;
        font-size: 13px;
        opacity: 0.9;
    }
    .bg-primary-stat {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    .bg-success-stat {
        background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
    }
    .bg-warning-stat {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    }
    .bg-info-stat {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    }
    .score-distribution {
        margin-top: 30px;
    }
    .result-row {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
        padding: 12px;
        background: #f8f9fa;
        border-radius: 4px;
    }
    .student-col {
        flex: 1;
    }
    .score-col {
        text-align: right;
        min-width: 100px;
    }
</style>
@endpush

@section('backend_content')
<div class="page-header">
    <div class="page-leftheader">
        <h4 class="page-title">Exam Statistics</h4>
    </div>
    <div class="page-rightheader">
        <a href="{{ route('exam_results.index') }}" class="btn btn-secondary btn-sm">
            <i class="fe fe-arrow-left"></i> Back
        </a>
    </div>
</div>

<div class="row row-sm">
    <!-- Exam Info -->
    <div class="col-lg-12 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="mb-2">{{ $exam->name }}</h5>
                        <p class="mb-1">
                            <strong>Type:</strong> {{ ucfirst($exam->mcq_written) }}
                        </p>
                        <p class="mb-0">
                            <strong>Duration:</strong> {{ $exam->exam_time ?? 'N/A' }} minutes
                        </p>
                    </div>
                    <div class="col-md-6 text-right">
                        <p class="mb-1">
                            <strong>Category:</strong> {{ $exam->category->name ?? 'N/A' }}
                        </p>
                        <p class="mb-0">
                            <strong>Course:</strong> {{ $exam->course->name ?? 'N/A' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="col-md-6 col-xl-3">
        <div class="stat-card bg-primary-stat">
            <p>Total Students</p>
            <h5>{{ $totalStudents }}</h5>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="stat-card bg-success-stat">
            <p>Average Score</p>
            <h5>{{ number_format($averageScore, 2) }}</h5>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="stat-card bg-info-stat">
            <p>Highest Score</p>
            <h5>{{ number_format($maxScore, 2) }}</h5>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="stat-card bg-warning-stat">
            <p>Lowest Score</p>
            <h5>{{ number_format($minScore, 2) }}</h5>
        </div>
    </div>

    <!-- Status Overview -->
    <div class="col-lg-12">
        <div class="card mt-4">
            <div class="card-header border-bottom">
                <h5 class="card-title mb-0">Result Status Overview</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <p class="mb-2">
                                <strong>Completed (MCQ)</strong>
                                <span class="float-right">
                                    <span class="badge badge-success">{{ $completedCount }}</span>
                                </span>
                            </p>
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar bg-success" style="width: {{ ($totalStudents > 0 ? ($completedCount / $totalStudents) * 100 : 0) }}%"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <p class="mb-2">
                                <strong>Pending Review</strong>
                                <span class="float-right">
                                    <span class="badge badge-warning">{{ $pendingCount }}</span>
                                </span>
                            </p>
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar bg-warning" style="width: {{ ($totalStudents > 0 ? ($pendingCount / $totalStudents) * 100 : 0) }}%"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <p class="mb-2">
                                <strong>Graded</strong>
                                <span class="float-right">
                                    <span class="badge badge-info">{{ $gradedCount }}</span>
                                </span>
                            </p>
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar bg-info" style="width: {{ ($totalStudents > 0 ? ($gradedCount / $totalStudents) * 100 : 0) }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Score Distribution -->
    <div class="col-lg-12">
        <div class="card mt-4">
            <div class="card-header border-bottom">
                <h5 class="card-title mb-0">Score Distribution</h5>
            </div>
            <div class="card-body">
                @php
                    // Sort results by score in descending order
                    $sortedResults = $results->sortByDesc('total_score');
                @endphp

                <div class="score-distribution">
                    @forelse($sortedResults as $result)
                        <div class="result-row">
                            <div class="student-col">
                                <strong>{{ $result->user->name }}</strong>
                                <br>
                                <small class="text-muted">{{ $result->user->email }}</small>
                                @if($result->status === 'pending_review')
                                    <br>
                                    <small class="text-warning">
                                        <i class="fe fe-alert-circle"></i> Pending Review
                                    </small>
                                @endif
                            </div>
                            <div class="score-col">
                                <h6 class="mb-0">
                                    <span class="badge {{ $result->total_score >= ($maxScore * 0.7) ? 'badge-success' : ($result->total_score >= ($maxScore * 0.5) ? 'badge-warning' : 'badge-danger') }}">
                                        {{ number_format($result->total_score, 2) }}
                                    </span>
                                </h6>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted text-center py-4">No results yet.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
