@extends('backend.layouts.master')

@section('title', 'Batch')

@push('backend_style')
    @include('backend.pages.common.style')
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Batch</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Batch</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <h3 class="card-title">Create Batch</h3>
                    @can('delete-batch')
                        <a href="{{ route('batches.trash') }}" class="btn btn-sm btn-outline-warning border"><i
                                class="fa-solid fa-trash-can-arrow-up fa-fw"></i> View Trash</a>
                    @endcan
                </div>
                <div class="card-body">
                    <form action="{{ route('batches.store') }}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name"
                                        class="form-control @error('name') is-invalid @enderror" id="name"
                                        value="{{ old('name') }}" required>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="4">{{ old('description') }}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h3 class="card-title">Batch List</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive export-table">
                        <table id="file-datatable" class="table table-bordered text-nowrap key-buttons border-bottom w-100">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">Last Updated</th>
                                    <th class="border-bottom-0">Name</th>
                                    <th class="border-bottom-0">Courses</th>
                                    {{-- <th class="border-bottom-0">File</th> --}}
                                    <th class="border-bottom-0">Status</th>
                                    <th class="border-bottom-0">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($batches as $batch)
                                    <tr>
                                        <td>
                                            <strong>{{ $batches->firstItem() + $loop->index }}</strong>
                                        </td>
                                        <td>{{ $batch->updated_at->format('d-M-Y') }}</td>
                                        <td>{{ $batch->name }}</td>
                                        <td>{{ $batch->courses()->count() }}</td>
                                        {{-- <td>
                                            @if ($batch->file)
                                                <img src="{{ asset('uploads/batches/' . $batch->file) }}" alt="{{ $batch->name }}"
                                                    style="width: 50px; height: 50px; object-fit: contain;">
                                            @else
                                                -
                                            @endif
                                        </td> --}}
                                        <td>
                                            <div class="material-switch">
                                                <input id="active-{{ $batch->id }}" class="toggle-class-active" name="is_active"
                                                    type="checkbox" {{ $batch->is_active ? 'checked' : '' }} data-id="{{ $batch->id }}">
                                                <label for="active-{{ $batch->id }}" class="label-success"></label>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="action-btns d-flex align-items-center">
                                                {{-- <div>
                                                    <a href="{{ route('batches.show', $batch->id) }}" class="btn btn-sm btn-outline-primary border me-2"
                                                        data-toggle="tooltip" data-placement="top" data-bs-original-title="View">
                                                        <i class="fa-solid fa-eye"></i>
                                                    </a>
                                                </div> --}}
                                                <div>
                                                    <a href="{{ route('batches.edit', $batch->id) }}" class="btn btn-sm btn-outline-secondary border me-2"
                                                        data-toggle="tooltip" data-placement="top" data-bs-original-title="Edit">
                                                        <i class="fa-solid fa-pen fa-fw"></i>
                                                    </a>
                                                </div>
                                                <div>
                                                    <form action="{{ route('batches.destroy', $batch->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-warning border show_confirm"
                                                            data-toggle="tooltip" data-placement="top" data-bs-original-title="Delete">
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

    <script type="text/javascript">
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Toggle active status
            $('.toggle-class-active').change(function() {
                var batch_id = $(this).data('id');
                var status = $(this).prop('checked') === true ? 1 : 0;

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '/admin/check/batch/is_active/' + batch_id,
                    data: {
                        'batch_id': batch_id,
                        '_token': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        console.log(data);
                        if (data.type === 'success') {
                            // Show success message
                            Swal.fire({
                                title: data.message,
                                text: data.message,
                                icon: data.type,
                            });
                        } else {
                            // Show error message
                            Swal.fire({
                                title: data.message,
                                text: data.message,
                                icon: data.type,
                            });
                        }
                    },
                    error: function(err) {
                        console.error(err);
                    }
                });
            });
        });
    </script>
@endpush
