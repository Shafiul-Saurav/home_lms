@if ($certificates->count() > 0)
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Course</th>
                    <th>Status</th>
                    <th>Requested</th>
                    <th>Issued</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($certificates as $certificate)
                    <tr>
                        <td>{{ $certificates->firstItem() + $loop->index }}</td>
                        <td>{{ $certificate->course->name ?? 'N/A' }}</td>
                        <td>
                            @if ($certificate->status === 'pending')
                                <span class="badge bg-warning text-dark">Pending</span>
                            @elseif($certificate->status === 'approved')
                                <span class="badge bg-success">Approved</span>
                            @else
                                <span class="badge bg-danger">Rejected</span>
                            @endif
                        </td>
                        <td>{{ $certificate->created_at->format('d M, Y') }}</td>
                        <td>{{ $certificate->issued_date ? $certificate->issued_date->format('d M, Y') : '-' }}</td>
                        <td>
                            @if ($certificate->status === 'approved')
                                <div class="d-flex gap-2 flex-wrap">
                                    {{-- <a href="{{ route('certificate.details', $certificate->id) }}"
                                       class="btn btn-sm btn-outline-success">
                                        <i class="fa-solid fa-eye"></i> View
                                    </a> --}}
                                    <button type="button" class="btn btn-sm btn-success certificate-download-btn"
                                        data-certificate-number="{{ $certificate->certificate_number }}"
                                        data-course-name="{{ $certificate->course->name ?? 'N/A' }}"
                                        data-user-name="{{ auth()->user()->name ?? 'Student' }}"
                                        data-issued-date="{{ $certificate->issued_date ? $certificate->issued_date->format('d M, Y') : now()->format('d M, Y') }}"
                                        data-company-name="{{ $companyName ?? '' }}">
                                        <i class="fa-solid fa-download"></i> Download
                                    </button>
                                </div>
                            @else
                                <button class="btn btn-sm btn-secondary" disabled>
                                    <i class="fa-solid fa-clock"></i> Not Ready
                                </button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $certificates->links() }}
    </div>
@else
    <div class="alert alert-info">You have not requested any certificates yet.</div>
@endif
