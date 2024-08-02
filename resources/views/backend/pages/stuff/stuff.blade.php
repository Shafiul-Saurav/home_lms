@extends('backend.layouts.master')

@section('title', 'Staff')

@push('backend_style')
    @include('backend.pages.common.style')
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Staff</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Staff</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <h3 class="card-title">Create Staff</h3>
                    <a href="{{ route('staffs.trash') }}" class="btn btn-sm btn-outline-warning border"><i
                            class="fa-solid fa-trash-can-arrow-up fa-fw"></i> View Trash</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('staffs.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="department_id" class="form-label mb-3">Select Department</label>
                                    <select id="department_id" name="department_id" class="form-control select2 form-select select2-hidden-accessible
                                    @error('department_id')
                                        is-invalid
                                    @enderror">
                                        <option selected>Choose a Department</option>
                                        @forelse ($departments as $department)
                                            <option value="{{ $department->id }}">{{ $department->dep_name }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                    @error('department_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="full_name">Staff Name</label>
                                    <input type="text" name="full_name" class="form-control @error('full_name')
                                        is-invalid
                                    @enderror" id="full_name"
                                        value="{{ old('full_name') }}" required>
                                    @error('full_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="image">Staff Image</label>
                                    <input type="file" name="stuff_image" class="dropify" data-default-file=""
                                    data-height="200" data-max-width="1930" data-max-height="1090"
                                    data-allowed-file-extensions="png jpg"/>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="bio">Bio</label>
                                    <textarea name="bio" id="summernote" cols="30" rows="10" required></textarea>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                  <div class="form-group">
                                    <label class="form-label">Salary Type</label>
                                    <select class="form-control select2 form-select select2-hidden-accessible" name="salary_type" data-placeholder="Choose one">
                                        <option selected>Choose Type</option>
                                        <option value="monthly">Monthly</option>
                                        <option value="daily">Daily</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="salary_amount">Salary Amount</label>
                                    <input type="text" name="salary_amount" class="form-control @error('salary_amount')
                                        is-invalid
                                    @enderror" id="salary_amount"
                                        value="{{ old('salary_amount') }}" required>
                                    @error('salary_amount')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary" type="submit">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h3 class="card-title">Staff List</h3>
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
                                                    <a href="{{ route('staff.payment', $stuff->id) }}" class="btn btn-sm btn-outline-info border me-2"
                                                        data-toggle="tooltip" data-placement="top"
                                                        data-bs-original-title="Payment">
                                                        <i class="fa-regular fa-credit-card"></i>
                                                    </a>
                                                    <a href="{{ route('staffs.show', $stuff->id) }}" class="btn btn-sm btn-outline-primary border me-2"
                                                        data-toggle="tooltip" data-placement="top"
                                                        data-bs-original-title="View">
                                                        <i class="fa-solid fa-eye"></i>
                                                    </a>
                                                </div>
                                                <div>
                                                    <a href="{{ route('staffs.edit', $stuff->id) }}"
                                                        class="btn btn-sm btn-outline-secondary border me-2"
                                                        data-toggle="tooltip" data-placement="top"
                                                        data-bs-original-title="Edit"><i class="fa-solid fa-pen fa-fw"></i>
                                                    </a>
                                                </div>
                                                <div>
                                                    <form action="{{ route('staffs.destroy', $stuff->id) }}"
                                                        method="POST">
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
    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                height: 300,
                callbacks: {
                    onImageUpload: function(files) {
                        var data = new FormData();
                        data.append('stuff_image', files[0]);
                        $.ajax({
                            url: '{{ route('staffs.upload-image') }}',
                            method: 'POST',
                            data: data,
                            processData: false,
                            contentType: false,
                            success: function(response) {
                                $('#summernote').summernote('insertImage', response.url);
                            }
                        });
                    }
                }
            });
        });
    </script>
@endpush
