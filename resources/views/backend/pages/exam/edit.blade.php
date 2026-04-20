@extends('backend.layouts.master')

@section('title', 'Edit Exam')

@push('backend_style')
    @include('backend.pages.common.style')
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Edit Exam</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('exams.index') }}">Exam List</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h3 class="card-title">Edit Exam</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('exams.update', $exam->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="name">Exam Name</label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name"
                                        value="{{ old('name', $exam->name) }}" required>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="slug">Slug</label>
                                    <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror" id="slug"
                                        value="{{ old('slug', $exam->slug) }}">
                                    @error('slug')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="category_id">Category</label>
                                    <select name="category_id" class="form-control @error('category_id') is-invalid @enderror" id="category_id" required>
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id', $exam->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="course_id">Course (Optional)</label>
                                    <select name="course_id" class="form-control @error('course_id') is-invalid @enderror" id="course_id">
                                        <option value="">Select Course</option>
                                        @foreach ($courses as $course)
                                            <option value="{{ $course->id }}" {{ old('course_id', $exam->course_id) == $course->id ? 'selected' : '' }}>{{ $course->name }}</option>
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
                                        <option value="mcq" {{ old('mcq_written', $exam->mcq_written) == 'mcq' ? 'selected' : '' }}>MCQ</option>
                                        <option value="written" {{ old('mcq_written', $exam->mcq_written) == 'written' ? 'selected' : '' }}>Written</option>
                                        <option value="both" {{ old('mcq_written', $exam->mcq_written) == 'both' ? 'selected' : '' }}>Both</option>
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
                                        value="{{ old('price', $exam->price) }}" required>
                                    @error('price')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="form-group">
                                    <label for="discount">Discount</label>
                                    <input type="number" step="0.01" name="discount" class="form-control @error('discount') is-invalid @enderror" id="discount"
                                        value="{{ old('discount', $exam->discount) }}">
                                    @error('discount')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="form-group">
                                    <label for="free_paid">Type</label>
                                    <select name="free_paid" class="form-control @error('free_paid') is-invalid @enderror" id="free_paid" required>
                                        <option value="free" {{ old('free_paid', $exam->free_paid) == 'free' ? 'selected' : '' }}>Free</option>
                                        <option value="paid" {{ old('free_paid', $exam->free_paid) == 'paid' ? 'selected' : '' }}>Paid</option>
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
                                        <option value="permanent" {{ old('temporary_permanent', $exam->temporary_permanent) == 'permanent' ? 'selected' : '' }}>Permanent</option>
                                        <option value="temporary" {{ old('temporary_permanent', $exam->temporary_permanent) == 'temporary' ? 'selected' : '' }}>Temporary</option>
                                    </select>
                                    @error('temporary_permanent')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="start_date">Start Date & Time</label>
                                    <input type="datetime-local" name="start_date" class="form-control @error('start_date') is-invalid @enderror" id="start_date"
                                        value="{{ old('start_date', $exam->start_date ? date('Y-m-d\TH:i', strtotime($exam->start_date)) : '') }}">
                                    @error('start_date')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="exam_time">Exam Duration (e.g. 60 min)</label>
                                    <input type="text" name="exam_time" class="form-control @error('exam_time') is-invalid @enderror" id="exam_time"
                                        value="{{ old('exam_time', $exam->exam_time) }}">
                                    @error('exam_time')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="pdf_file">Syllabus (PDF File)</label>
                                    <input type="file" name="pdf_file" class="form-control @error('pdf_file') is-invalid @enderror" id="pdf_file" accept=".pdf">
                                    @if($exam->pdf_file)
                                        <div class="mt-2">
                                            <a href="{{ asset('uploads/exams/syllabus/' . $exam->pdf_file) }}" target="_blank" class="text-primary">
                                                <i class="fa-solid fa-file-pdf"></i> View Current Syllabus
                                            </a>
                                        </div>
                                    @endif
                                    @error('pdf_file')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="written_paragraph">Written Paragraph</label>
                                    <textarea name="written_paragraph" id="summernote" class="form-control @error('written_paragraph') is-invalid @enderror" id="written_paragraph" rows="3">{{ old('written_paragraph', $exam->written_paragraph) }}</textarea>
                                    @error('written_paragraph')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="is_active" id="is_active" {{ $exam->is_active ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active">Is Active</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Exam</button>
                        <a href="{{ route('exams.index') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('backend_script')
    <script>
        $(document).ready(function() {
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
        });
    </script>
@endpush
