@extends('backend.layouts.master')

@section('title', 'Exam Management')

@push('backend_style')
    @include('backend.pages.common.style')
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Exam Management</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Exam</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <h3 class="card-title">Create Exam</h3>
                    @can('delete-exam')
                        <a href="{{ route('exams.trash') }}" class="btn btn-sm btn-outline-warning border"><i
                                class="fa-solid fa-trash-can-arrow-up fa-fw"></i> View Trash</a>
                    @endcan
                </div>
                <div class="card-body">
                    @can('create-exam')
                        <form action="{{ route('exams.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="name">Exam Name</label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name"
                                        value="{{ old('name') }}" required>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="slug">Slug (Optional)</label>
                                    <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror" id="slug"
                                        value="{{ old('slug') }}">
                                    @error('slug')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="category_id">Category (Optional)</label>
                                    <select name="category_id" class="form-control select2-style1 @error('category_id') is-invalid @enderror" id="category_id">
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="course_id">Course</label>
                                    <select name="course_id" class="form-control select2-style1 @error('course_id') is-invalid @enderror" id="course_id" required>
                                        <option value="">Select Course</option>
                                        @foreach ($courses as $course)
                                            <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>{{ $course->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('course_id')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="mcq_written">Exam Type</label>
                                    <select name="mcq_written" class="form-control @error('mcq_written') is-invalid @enderror" id="mcq_written" required>
                                        <option value="mcq" {{ old('mcq_written') == 'mcq' ? 'selected' : '' }}>MCQ</option>
                                        <option value="written" {{ old('mcq_written') == 'written' ? 'selected' : '' }}>Written</option>
                                        <option value="both" {{ old('mcq_written') == 'both' ? 'selected' : '' }}>Both</option>
                                    </select>
                                    @error('mcq_written')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="number" step="0.01" name="price" class="form-control @error('price') is-invalid @enderror" id="price"
                                        value="{{ old('price', 0) }}" required>
                                    @error('price')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="form-group">
                                    <label for="discount">Discount</label>
                                    <input type="number" step="0.01" name="discount" class="form-control @error('discount') is-invalid @enderror" id="discount"
                                        value="{{ old('discount', 0) }}">
                                    @error('discount')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="form-group">
                                    <label for="free_paid">Type</label>
                                    <select name="free_paid" class="form-control @error('free_paid') is-invalid @enderror" id="free_paid" required>
                                        <option value="free" {{ old('free_paid') == 'free' ? 'selected' : '' }}>Free</option>
                                        <option value="paid" {{ old('free_paid') == 'paid' ? 'selected' : '' }}>Paid</option>
                                    </select>
                                    @error('free_paid')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="form-group">
                                    <label for="temporary_permanent">Time Type</label>
                                    <select name="temporary_permanent" class="form-control @error('temporary_permanent') is-invalid @enderror" id="temporary_permanent" required>
                                        <option value="permanent" {{ old('temporary_permanent') == 'permanent' ? 'selected' : '' }}>Permanent</option>
                                        <option value="temporary" {{ old('temporary_permanent') == 'temporary' ? 'selected' : '' }}>Temporary</option>
                                    </select>
                                    @error('temporary_permanent')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="form-group">
                                    <label for="date">Start Date</label>
                                    <div class="input-group">
                                        <div class="input-group-text bg-primary-transparent text-primary">
                                            <i class="fa-solid fa-calendar-days"></i>
                                        </div>
                                        <input class="form-control fc-datepicker @error('date') is-invalid @enderror" placeholder="DD/MM/YYYY" type="text"
                                            value="{{ old('date_display') }}">
                                        <input type="hidden" name="date" value="{{ old('date') }}">
                                    </div>
                                    @error('date')
                                        <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="form-group">
                                    <label for="time">Start Time</label>
                                    <div class="input-group">
                                        <div class="input-group-text bg-primary-transparent text-primary">
                                            <i class="fa-solid fa-clock"></i>
                                        </div>
                                        <input type="text" name="time" class="form-control tpicker @error('time') is-invalid @enderror"
                                            value="{{ old('time') }}" placeholder="HH:MM">
                                    </div>
                                    @error('time')
                                        <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="exam_time">Exam Duration (e.g. 60 min)</label>
                                    <input type="text" name="exam_time" class="form-control @error('exam_time') is-invalid @enderror" id="exam_time"
                                        value="{{ old('exam_time') }}">
                                    @error('exam_time')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="pdf_file">Syllabus (PDF File)</label>
                                    <input type="file" name="pdf_file" class="form-control @error('pdf_file') is-invalid @enderror" id="pdf_file" accept=".pdf">
                                    @error('pdf_file')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="written_paragraph">Written Paragraph</label>
                                    <textarea name="written_paragraph" id="summernote" data-summernote class="form-control @error('written_paragraph') is-invalid @enderror" id="written_paragraph" rows="3">{{ old('written_paragraph') }}</textarea>
                                    @error('written_paragraph')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Create Exam</button>
                        </form>
                    @endcan
                </div>
            </div>
        </div>
    </div>
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h3 class="card-title">Exam List</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive export-table">
                        <table id="file-datatable" class="table table-bordered text-nowrap key-buttons border-bottom w-100">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">Name</th>
                                    <th class="border-bottom-0">Course</th>
                                    {{-- <th class="border-bottom-0">Category</th> --}}
                                    <th class="border-bottom-0">Type</th>
                                    {{-- <th class="border-bottom-0">Price</th> --}}
                                    <th class="border-bottom-0">Schedule</th>
                                    <th class="border-bottom-0">Duration</th>
                                    @can('edit-exam')
                                        <th class="border-bottom-0">Status</th>
                                    @endcan
                                    @canany(['index-exam', 'index-results', 'edit-exam', 'delete-exam'])
                                        <th class="border-bottom-0">Actions</th>
                                    @endcanany
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($exams as $exam)
                                    <tr>
                                        <td><strong>{{ $exams->firstItem() + $loop->index }}</strong></td>
                                        <td>
                                            <strong>{{ $exam->name }}</strong><br>
                                            <small class="text-muted"><span class="text-info">Total Questions:</span> <span class="text-info">{{ $exam->questions->count() }}</span> | <span class="text-warning">Total Marks:</span> <span class="text-warning">{{ $exam->questions->sum('mark') }}</span></small>
                                        </td>
                                        <td>{{ $exam->course->name ?? 'N/A' }}</td>
                                        {{-- <td>{{ $exam->category->name ?? 'N/A' }}</td> --}}
                                        <td>
                                            @if($exam->mcq_written == 'mcq')
                                                <span class="badge bg-info">MCQ</span>
                                            @elseif($exam->mcq_written == 'written')
                                                <span class="badge bg-success">WRITTEN</span>
                                            @else
                                                <span class="badge bg-info">BOTH</span>
                                            @endif
                                        </td>
                                        {{-- <td>{{ $exam->price }}</td> --}}
                                        <td>
                                            @if($exam->date && $exam->time)
                                                {{ \Carbon\Carbon::parse($exam->date)->format('d M, Y') }} <br>
                                                <small class="text-muted">{{ \Carbon\Carbon::parse($exam->time)->format('h:i A') }}</small>
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td>{{ $exam->exam_time }}</td>
                                        @can('edit-exam')
                                            <td>
                                                <div class="material-switch">
                                                    <input id="active-{{ $exam->id }}" class="toggle-class-active" name="is_active"
                                                        type="checkbox" {{ $exam->is_active ? 'checked' : '' }}
                                                        data-id="{{ $exam->id }}">
                                                    <label for="active-{{ $exam->id }}" class="label-success"></label>
                                                </div>
                                            </td>
                                        @endcan
                                        @canany(['index-exam', 'index-results', 'edit-exam', 'delete-exam'])
                                            <td class="text-center">
                                                <div class="action-btns d-flex align-items-center">
                                                    @can('index-exam')
                                                        <div>
                                                            <a href="{{ route('exams.questions', $exam->id) }}"
                                                                class="btn btn-sm btn-outline-info border me-2"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Questions List">
                                                                <i class="fa-solid fa-list-check fa-fw"></i>
                                                            </a>
                                                        </div>
                                                    @endcan
                                                    @can('index-results')
                                                        <div>
                                                            <a href="{{ route('exams.results', $exam->id) }}"
                                                                class="btn btn-sm btn-outline-primary border me-2"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Exam Results">
                                                                <i class="fa-solid fa-chart-bar fa-fw"></i>
                                                            </a>
                                                        </div>
                                                    @endcan
                                                    @can('edit-exam')
                                                        <div>
                                                            <a href="{{ route('exams.edit', $exam->id) }}"
                                                                class="btn btn-sm btn-outline-secondary border me-2"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Edit">
                                                                <i class="fa-solid fa-pen fa-fw"></i>
                                                            </a>
                                                        </div>
                                                    @endcan
                                                    @can('delete-exam')
                                                        <div>
                                                            <form action="{{ route('exams.destroy', $exam->id) }}" method="POST"
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
                                                    @endcan
                                                </div>
                                            </td>
                                        @endcanany
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
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Auto-generate slug from name
            $('#name').on('input propertychange paste', function() {
                var name = $(this).val();
                var slugField = $('#slug');

                if (!slugField.attr('data-manual-edit')) {
                    if(name && name.trim() !== '') {
                        var generatedSlug = name.toLowerCase()
                            .replace(/[^\w\s\u0980-\u09FF-]/g, '')
                            .replace(/[\s_-]+/g, '-')
                            .replace(/^-+|-+$/g, '')
                            .trim();
                        slugField.val(generatedSlug);
                    } else {
                        slugField.val('');
                    }
                }
            });

            $('#slug').on('input focus', function() {
                $(this).attr('data-manual-edit', 'true');
            });

            $('#slug').on('input', function() {
                if ($(this).val() === '') {
                    $(this).removeAttr('data-manual-edit');
                }
            });

            $('#name').on('focus', function() {
                if ($('#slug').val() === '') {
                    $('#slug').removeAttr('data-manual-edit');
                }
            });

            // Toggle active status
            $('.toggle-class-active').change(function() {
                var id = $(this).data('id');
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '/admin/check/exam/is_active/' + id,
                    success: function(data) {
                        Swal.fire({ title: data.message, text: data.message, icon: data.type });
                    }
                });
            });
        });
    </script>
@endpush
