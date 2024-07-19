@extends('backend.layouts.master')

@section('title', 'Staff')

@push('backend_style')
    @include('backend.pages.common.style')
@endpush

@section('backend_content')
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <h3 class="card-title">Staff Trashed List</h3>
                    <a href="{{ route('staffs.index') }}" class="btn btn-info"><i class="fa-solid fa-angles-left fa-fw"></i> Back</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive export-table">
                        <table id="file-datatable" class="table table-bordered text-nowrap key-buttons border-bottom w-100">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">Last Updated</th>
                                    <th class="border-bottom-0">Department Name</th>
                                    <th class="border-bottom-0">Staff Name</th>
                                    <th class="border-bottom-0">Staff Image</th>
                                    <th class="border-bottom-0">Salary Type</th>
                                    <th class="border-bottom-0">Salary Amount</th>
                                    <th class="border-bottom-0">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($stuffs as $stuff)
                                    <tr>
                                        <td>
                                            <strong>{{ $stuffs->firstItem() + $loop->index }}</strong>
                                        </td>
                                        <td>{{ $stuff->updated_at->format('d-M-Y') }}</td>
                                        <td>{{ $stuff->department->dep_name }}</td>
                                        <td>{{ $stuff->full_name }}</td>
                                        <td>
                                            <img src="{{ asset('uploads/stuffs') }}/{{ $stuff->stuff_image }}" alt="" style="height: 100px">
                                        </td>
                                        <td>{{ $stuff->salary_type }}</td>
                                        <td>{{ $stuff->salary_amount }}</td>
                                        <td class="text-center">
                                            <div class="action-btns d-flex align-items-center">
                                                <div>
                                                    <a href="{{ route('staffs.restore', ['id' => $stuff->id]) }}"
                                                        class="btn btn-sm btn-outline-success border me-2" data-toggle="tooltip"
                                                        data-placement="top" data-bs-original-title="Restore"><i class="fa-solid fa-store"></i>
                                                    </a>
                                                </div>
                                                <div>
                                                    <form action="{{ route('staffs.forcedelete', ['id' => $stuff->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger border show_confirm" data-toggle="tooltip"
                                                        data-placement="top" data-bs-original-title="Force Delete">
                                                            <i class="fa-solid fa-radiation"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Row -->
@endsection

@push('backend_script')
    @include('backend.pages.common.script')
@endpush
