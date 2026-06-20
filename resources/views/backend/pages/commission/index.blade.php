@extends('backend.layouts.master')

@section('title', 'Instructor Commissions')

@push('backend_style')
    @include('backend.pages.common.style')
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Instructor Commissions</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Instructor Commissions</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <h3 class="card-title">Commission Negotiation List</h3>
                    {{-- @can('create-instructor-commission') --}}
                        <a href="{{ route('commissions.create') }}" class="btn btn-primary">
                            <i class="fa-solid fa-plus fa-fw"></i> Create
                        </a>
                    {{-- @endcan --}}
                </div>
                <div class="card-body">
                    <div class="table-responsive export-table">
                        <table id="file-datatable" class="table table-bordered text-nowrap key-buttons border-bottom w-100">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">Last Updated</th>
                                    <th class="border-bottom-0">Instructor</th>
                                    <th class="border-bottom-0">Admin</th>
                                    <th class="border-bottom-0">Gateway</th>
                                    <th class="border-bottom-0">Instructor Net</th>
                                    <th class="border-bottom-0">100 Taka Split</th>
                                    <th class="border-bottom-0">Status</th>
                                    {{-- @canany(['edit-instructor-commission', 'delete-instructor-commission']) --}}
                                        <th class="border-bottom-0">Actions</th>
                                    {{-- @endcanany --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($commissions as $commission)
                                    @php($shares = $commission->calculateShares(100))
                                    <tr>
                                        <td><strong>{{ $commissions->firstItem() + $loop->index }}</strong></td>
                                        <td>{{ $commission->updated_at->format('d-M-Y') }}</td>
                                        <td>
                                            {{ $commission->teacher->user->name ?? 'N/A' }}
                                            @if ($commission->teacher?->user?->email)
                                                <br><small>{{ $commission->teacher->user->email }}</small>
                                            @endif
                                        </td>
                                        <td>{{ number_format($commission->admin_percentage, 2) }}%</td>
                                        <td>{{ number_format($commission->gateway_percentage, 2) }}%</td>
                                        <td>{{ number_format($commission->instructor_percentage, 2) }}%</td>
                                        <td>
                                            Admin: {{ number_format($shares['admin'], 2) }},
                                            Gateway: {{ number_format($shares['gateway'], 2) }},
                                            Instructor: {{ number_format($shares['instructor'], 2) }}
                                        </td>
                                        <td>
                                            <span class="badge bg-{{ $commission->status === 'approved' ? 'success' : ($commission->status === 'rejected' ? 'danger' : 'warning') }}">
                                                {{ ucfirst($commission->status) }}
                                            </span>
                                        </td>
                                        {{-- @canany(['edit-instructor-commission', 'delete-instructor-commission']) --}}
                                            <td class="text-center">
                                                <div class="action-btns d-flex align-items-center">
                                                    {{-- @can('edit-instructor-commission') --}}
                                                        <div>
                                                            <a href="{{ route('commissions.edit', $commission->id) }}"
                                                                class="btn btn-sm btn-outline-secondary border me-2"
                                                                data-toggle="tooltip" data-placement="top"
                                                                data-bs-original-title="Edit">
                                                                <i class="fa-solid fa-pen fa-fw"></i>
                                                            </a>
                                                        </div>
                                                    {{-- @endcan --}}
                                                    {{-- @can('delete-instructor-commission') --}}
                                                        <div>
                                                            <form action="{{ route('commissions.destroy', $commission->id) }}" method="POST"
                                                                class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-sm btn-outline-warning border show_confirm"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    data-bs-original-title="Delete">
                                                                    <i class="fa-solid fa-trash-can fa-fw"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    {{-- @endcan --}}
                                                </div>
                                            </td>
                                        {{-- @endcanany --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $commissions->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('backend_script')
    @include('backend.pages.common.script')
@endpush
