@extends('backend.layouts.master')

@section('title', 'Service Category')

@push('backend_style')
    @include('backend.pages.common.style')
    <style>
        .drag-handle {
            cursor: grab;
            color: #adb5bd;
            font-size: 1.1rem;
            padding: 0 6px;
            transition: color 0.2s;
        }
        .drag-handle:hover {
            color: #495057;
        }
        tbody tr.sortable-ghost {
            opacity: 0.4;
            background: #e9ecef;
        }
        tbody tr.sortable-chosen {
            box-shadow: 0 4px 16px rgba(0,0,0,.12);
            background: #fff8e1;
        }
        #sort-save-btn {
            display: none;
        }
        #sort-status {
            font-size: 0.85rem;
        }
    </style>
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Service Category</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Service Category</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <h3 class="card-title">Create Service Category</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('servicetwocategories.store') }}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="title">Category Name</label>
                                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title" value="{{ old('title') }}" required>
                                    @error('title')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-check">
                                    <input type="checkbox" name="is_active" class="form-check-input" id="is_active" value="1" {{ old('is_active') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_active">Active</label>
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
                <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0">Service Category List</h3>
                    <div class="d-flex align-items-center gap-2">
                        <span id="sort-status" class="text-muted me-2">
                            <i class="fa-solid fa-grip-lines me-1"></i> Drag rows to reorder
                        </span>
                        <button id="sort-save-btn" class="btn btn-sm btn-success">
                            <i class="fa-solid fa-floppy-disk me-1"></i> Save Order
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-nowrap border-bottom w-100">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0" style="width:40px;"></th>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">Last Updated</th>
                                    <th class="border-bottom-0">Category Name</th>
                                    <th class="border-bottom-0">Status</th>
                                    <th class="border-bottom-0">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="sortable-tbody">
                                @foreach ($categories as $index => $category)
                                    <tr data-id="{{ $category->id }}">
                                        <td class="text-center align-middle">
                                            <i class="fa-solid fa-grip-vertical drag-handle" title="Drag to reorder"></i>
                                        </td>
                                        <td><strong>{{ $index + 1 }}</strong></td>
                                        <td>{{ $category->updated_at->format('d-M-Y') }}</td>
                                        <td>{{ $category->title }}</td>
                                        <td>
                                            <div class="material-switch">
                                                <input id="active-{{ $category->id }}" class="toggle-class-active" name="is_active" type="checkbox" {{ $category->is_active ? 'checked' : '' }} data-id="{{ $category->id }}">
                                                <label for="active-{{ $category->id }}" class="label-success"></label>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="action-btns d-flex align-items-center">
                                                <div>
                                                    <a href="{{ route('servicetwocategories.edit', $category->id) }}" class="btn btn-sm btn-outline-secondary border me-2" data-toggle="tooltip" data-placement="top" data-bs-original-title="Edit">
                                                        <i class="fa-solid fa-pen fa-fw"></i>
                                                    </a>
                                                </div>
                                                <div>
                                                    <form action="{{ route('servicetwocategories.destroy', $category->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-warning border show_confirm" data-toggle="tooltip" data-placement="top" data-bs-original-title="Delete">
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
@endsection

@push('backend_script')
    {{-- SortableJS (CDN) --}}
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.2/Sortable.min.js"></script>

    <script>
        $(document).ready(function () {

            /* ── Active toggle ── */
            $(document).on('change', '.toggle-class-active', function () {
                var item_id = $(this).data('id');
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: `/admin/check/servicetwocategory/is_active/${item_id}`,
                    success: function (response) {
                        Swal.fire({
                            title: response.message,
                            text: response.message,
                            icon: response.type,
                        });
                    },
                    error: function (err) { console.error(err); }
                });
            });

            /* ── Drag & Drop ordering ── */
            var orderChanged = false;

            var sortable = Sortable.create(document.getElementById('sortable-tbody'), {
                handle: '.drag-handle',
                animation: 150,
                ghostClass: 'sortable-ghost',
                chosenClass: 'sortable-chosen',
                onEnd: function () {
                    orderChanged = true;
                    $('#sort-save-btn').fadeIn(200);
                    $('#sort-status').html('<i class="fa-solid fa-circle-exclamation me-1 text-warning"></i> <span class="text-warning">Unsaved changes</span>');

                    // Refresh the # column
                    $('#sortable-tbody tr').each(function (i) {
                        $(this).find('td:nth-child(2) strong').text(i + 1);
                    });
                }
            });

            /* ── Save order via AJAX ── */
            $('#sort-save-btn').on('click', function () {
                var order = [];
                $('#sortable-tbody tr').each(function () {
                    order.push($(this).data('id'));
                });

                var btn = $(this);
                btn.prop('disabled', true).html('<i class="fa-solid fa-spinner fa-spin me-1"></i> Saving…');

                $.ajax({
                    type: 'POST',
                    url: '{{ route('servicetwocategories.update_order') }}',
                    data: {
                        _token: '{{ csrf_token() }}',
                        order: order
                    },
                    success: function (response) {
                        orderChanged = false;
                        btn.fadeOut(200);
                        $('#sort-status').html('<i class="fa-solid fa-grip-lines me-1"></i> Drag rows to reorder');
                        Swal.fire({
                            title: 'Saved!',
                            text: 'Category order updated successfully.',
                            icon: 'success',
                            timer: 1500,
                            showConfirmButton: false
                        });
                    },
                    error: function (err) {
                        console.error(err);
                        Swal.fire('Error', 'Could not save order. Please try again.', 'error');
                    },
                    complete: function () {
                        btn.prop('disabled', false).html('<i class="fa-solid fa-floppy-disk me-1"></i> Save Order');
                    }
                });
            });

            /* ── Warn on page leave if unsaved ── */
            window.addEventListener('beforeunload', function (e) {
                if (orderChanged) {
                    e.preventDefault();
                    e.returnValue = '';
                }
            });
        });
    </script>
@endpush
