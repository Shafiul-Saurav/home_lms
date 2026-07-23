@extends('backend.layouts.master')

@section('title', 'Course')

@push('backend_style')
    @include('backend.pages.common.style')
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Course</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Course</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <h3 class="card-title">Create Course</h3>
                    @can('delete-course')
                        <a href="{{ route('courses.trash') }}" class="btn btn-sm btn-outline-warning border">
                            <i class="fa-solid fa-trash-can-arrow-up fa-fw"></i> View Trash
                        </a>
                    @endcan
                </div>
                <div class="card-body">
                    <form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="col-6 mb-3">
                                <div class="form-group">
                                    <label for="name">Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" id="name"
                                        class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                                        required>
                                    @error('name')
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-6 mb-3">
                                <div class="form-group">
                                    <label for="slug">Slug (Optional - Auto-generated if left empty)</label>
                                    <input type="text" name="slug" id="slug"
                                        class="form-control @error('slug') is-invalid @enderror"
                                        value="{{ old('slug') }}">
                                    @error('slug')
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="category_id">Category</label>
                                    <select name="category_id" id="category_id"
                                        class="form-control select2-style1 @error('category_id') is-invalid @enderror">
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                {!! $category->name !!}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="subcategory_id">Subcategory</label>
                                    <select name="subcategory_id" id="subcategory_id"
                                        class="form-control select2-style1 @error('subcategory_id') is-invalid @enderror"
                                        disabled>
                                        <option value="">Select Subcategory</option>
                                    </select>
                                    @error('subcategory_id')
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="course_level">Course Level</label>
                                    <select name="course_level" id="course_level"
                                        class="form-control select2-style1 @error('course_level') is-invalid @enderror">
                                        <option value="">Select Level</option>
                                        <option value="beginner" {{ old('course_level') == 'beginner' ? 'selected' : '' }}>
                                            Beginner</option>
                                        <option value="intermediate"
                                            {{ old('course_level') == 'intermediate' ? 'selected' : '' }}>Intermediate
                                        </option>
                                        <option value="advance" {{ old('course_level') == 'advance' ? 'selected' : '' }}>
                                            Advance</option>
                                    </select>
                                    @error('course_level')
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12 my-3">
                                <div>
                                    <h4 class="text-primary mb-3">Course Pricing</h4>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label for="free_or_paid">Pricing Type</label>
                                    <select name="free_or_paid" id="free_or_paid"
                                        class="form-control select2-style1 @error('free_or_paid') is-invalid @enderror">
                                        <option value="">Select Pricing</option>
                                        <option value="free" {{ old('free_or_paid') == 'free' ? 'selected' : '' }}>Free
                                        </option>
                                        <option value="paid" {{ old('free_or_paid') == 'paid' ? 'selected' : '' }}>Paid
                                        </option>
                                    </select>
                                    @error('free_or_paid')
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3 price-fields"
                                style="{{ old('free_or_paid') === 'paid' ? '' : 'display:none;' }}">
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="number" step="0.01" name="price" id="price"
                                        class="form-control @error('price') is-invalid @enderror"
                                        value="{{ old('price') }}">
                                    @error('price')
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3 price-fields"
                                style="{{ old('free_or_paid') === 'paid' ? '' : 'display:none;' }}">
                                <div class="form-group">
                                    <label for="discount">Discount</label>
                                    <input type="number" step="0.01" name="discount" id="discount"
                                        class="form-control @error('discount') is-invalid @enderror"
                                        value="{{ old('discount') }}">
                                    @error('discount')
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12 my-3">
                                <div>
                                    <h4 class="text-primary mb-3">Course Type</h4>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label for="live_or_record">Live or Record</label>
                                    <select name="live_or_record" id="live_or_record"
                                        class="form-control select2-style1 @error('live_or_record') is-invalid @enderror">
                                        <option value="">Select Type</option>
                                        <option value="live" {{ old('live_or_record') == 'live' ? 'selected' : '' }}>
                                            Live</option>
                                        <option value="record" {{ old('live_or_record') == 'record' ? 'selected' : '' }}>
                                            Record</option>
                                    </select>
                                    @error('live_or_record')
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4 mb-3 live-fields"
                                style="{{ old('live_or_record') === 'live' ? '' : 'display:none;' }}">
                                <div class="form-group">
                                    <label for="live_schedule">Live Schedule</label>
                                    <input type="text" name="live_schedule" id="live_schedule"
                                        class="form-control @error('live_schedule') is-invalid @enderror"
                                        value="{{ old('live_schedule') }}">
                                    @error('live_schedule')
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4 mb-3 live-fields"
                                style="{{ old('live_or_record') === 'live' ? '' : 'display:none;' }}">
                                <div class="form-group">
                                    <label for="start_date">Start Date</label>
                                    <div class="input-group">
                                        <div class="input-group-text bg-primary-transparent text-primary">
                                            <i class="fe fe-calendar text-20"></i>
                                        </div>
                                        <input
                                            class="form-control fc-datepicker @error('start_date') is-invalid @enderror"
                                            placeholder="DD/MM/YYYY" type="text" id="start_date"
                                            value="{{ old('start_date') ? \Carbon\Carbon::parse(old('start_date'))->format('d/m/Y') : '' }}">
                                        <input type="hidden" name="start_date" value="{{ old('start_date') }}">
                                    </div>
                                    @error('start_date')
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4 mb-3 live-fields"
                                style="{{ old('live_or_record') === 'live' ? '' : 'display:none;' }}">
                                <div class="form-group">
                                    <label for="end_date">End Date</label>
                                    <div class="input-group">
                                        <div class="input-group-text bg-primary-transparent text-primary">
                                            <i class="fe fe-calendar text-20"></i>
                                        </div>
                                        <input class="form-control fc-datepicker @error('end_date') is-invalid @enderror"
                                            placeholder="DD/MM/YYYY" type="text" id="end_date"
                                            value="{{ old('end_date') ? \Carbon\Carbon::parse(old('end_date'))->format('d/m/Y') : '' }}">
                                        <input type="hidden" name="end_date" value="{{ old('end_date') }}">
                                    </div>
                                    @error('end_date')
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4 mb-3 live-fields"
                                style="{{ old('live_or_record') === 'live' ? '' : 'display:none;' }}">
                                <div class="form-group">
                                    <label for="max_student">Maximum Students</label>
                                    <input type="number" name="max_student" id="max_student"
                                        class="form-control @error('max_student') is-invalid @enderror"
                                        value="{{ old('max_student') }}">
                                    @error('max_student')
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-8 mb-3 live-fields"
                                style="{{ old('live_or_record') === 'live' ? '' : 'display:none;' }}">
                                <div class="form-group">
                                    <label for="meeting_link">Meeting Link</label>
                                    <input type="text" name="meeting_link" id="meeting_link"
                                        class="form-control @error('meeting_link') is-invalid @enderror"
                                        value="{{ old('meeting_link') }}">
                                    @error('meeting_link')
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            {{-- <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="is_offline">Is Offline</label>
                                    <select name="is_offline" id="is_offline"
                                        class="form-control @error('is_offline') is-invalid @enderror">
                                        <option value="">Select Option</option>
                                        <option value="1" {{ old('is_offline') == '1' ? 'selected' : '' }}>Yes
                                        </option>
                                        <option value="0" {{ old('is_offline') == '0' ? 'selected' : '' }}>No
                                        </option>
                                    </select>
                                    @error('is_offline')
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div> --}}

                            {{-- <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="is_active">Status</label>
                                    <select name="is_active" id="is_active"
                                        class="form-control @error('is_active') is-invalid @enderror">
                                        <option value="1" {{ old('is_active', '1') == '1' ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Inactive
                                        </option>
                                    </select>
                                    @error('is_active')
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div> --}}

                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label for="button_type">Button Type</label>
                                    <select name="button_type" id="button_type"
                                        class="form-control select2-style1 @error('button_type') is-invalid @enderror">
                                        <option value="Enroll Now"
                                            {{ old('button_type', 'Enroll Now') == 'Enroll Now' ? 'selected' : '' }}>Enroll
                                            Now</option>
                                        <option value="Comming Soon"
                                            {{ old('button_type') == 'Comming Soon' ? 'selected' : '' }}>Comming Soon
                                        </option>
                                    </select>
                                    @error('button_type')
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="video_link">Video Link</label>
                                    <input type="text" name="video_link" id="video_link"
                                        class="form-control @error('video_link') is-invalid @enderror"
                                        value="{{ old('video_link') }}">
                                    @error('video_link')
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="4">{{ old('description') }}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="full_description">Full Description</label>
                                    <textarea name="full_description" class="form-control @error('full_description') is-invalid @enderror"
                                        rows="5">{{ old('full_description') }}</textarea>
                                    @error('full_description')
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="learning_outcomes">Learning Outcomes</label>
                                    <textarea name="learning_outcomes" class="form-control @error('learning_outcomes') is-invalid @enderror"
                                        rows="4">{{ old('learning_outcomes') }}</textarea>
                                    @error('learning_outcomes')
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="requirement">Requirement</label>
                                    <textarea name="requirement" class="form-control @error('requirement') is-invalid @enderror" rows="4">{{ old('requirement') }}</textarea>
                                    @error('requirement')
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="tags">Tags</label>
                                    <input type="text" name="tags" id="tags"
                                        class="form-control @error('tags') is-invalid @enderror"
                                        value="{{ old('tags') }}">
                                    @error('tags')
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="image">Image <span class="text-danger">*</span></label>
                                    <input type="file" name="image" id="image"
                                        class="form-control @error('image') is-invalid @enderror" required>
                                    @error('image')
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="pdf">PDF</label>
                                    <input type="file" name="pdf" id="pdf"
                                        class="form-control @error('pdf') is-invalid @enderror">
                                    @error('pdf')
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label for="button_type">Button Type</label>
                                    <select name="button_type" id="button_type"
                                        class="form-control @error('button_type') is-invalid @enderror">
                                        <option value="">Select Button Type</option>
                                        <option value="Enroll Now"
                                            {{ old('button_type') == 'Enroll Now' ? 'selected' : '' }}>Enroll Now</option>
                                        <option value="Comming Soon"
                                            {{ old('button_type') == 'Comming Soon' ? 'selected' : '' }}>Comming Soon
                                        </option>
                                    </select>
                                    @error('button_type')
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 mb-3">
                                <div>
                                    <h4 class="text-primary mb-3">Create Lesson</h4>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label for="lessons">Lessons</label>
                                    <div id="multipleLessonFields">
                                        @php
                                            $oldLessons = old('lessons', [
                                                ['ref' => 'lesson_' . uniqid(), 'name' => ''],
                                            ]);
                                        @endphp
                                        @foreach ($oldLessons as $lessonIndex => $lesson)
                                            <div class="mb-2 lesson-row" id="multipleLessonField{{ $lessonIndex }}">
                                                <input type="hidden" name="lessons[{{ $lessonIndex }}][ref]"
                                                    class="lesson-ref"
                                                    value="{{ $lesson['ref'] ?? 'lesson_' . uniqid() }}" />
                                                <div class="d-flex justify-content-between">
                                                    <input type="text" name="lessons[{{ $lessonIndex }}][name]"
                                                        class="form-control me-4 lesson-name @error('lessons.' . $lessonIndex . '.name') is-invalid @enderror"
                                                        value="{{ $lesson['name'] ?? '' }}"
                                                        placeholder="Enter lesson name" />
                                                    <button type="button"
                                                        class="btn {{ $loop->first ? 'btn-secondary addLessonField' : 'btn-danger removeLessonField' }}">
                                                        {{ $loop->first ? '+' : '-' }}
                                                    </button>
                                                </div>
                                                <textarea name="lessons[{{ $lessonIndex }}][description]" class="form-control mt-2" rows="3"
                                                    placeholder="Enter lesson description">{{ $lesson['description'] ?? '' }}</textarea>
                                            </div>
                                            @error('lessons.' . $lessonIndex . '.name')
                                                <span class="invalid-feedback d-block" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 mb-3">
                                <div>
                                    <h4 class="text-primary mb-3">Course Module</h4>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label for="modules">Modules</label>
                                    <div id="multipleModuleFields">
                                        @php
                                            $oldModules = old('modules', [
                                                [
                                                    'lesson_ref' => '',
                                                    'title' => '',
                                                    'link' => '',
                                                    'free_paid' => '',
                                                    'live_record' => '',
                                                    'pdf_file' => '',
                                                    'date' => '',
                                                    'time' => '',
                                                ],
                                            ]);
                                        @endphp
                                        @foreach ($oldModules as $moduleIndex => $module)
                                            <div class="border p-3 mb-3 module-row"
                                                id="multipleModuleField{{ $moduleIndex }}">
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label">Module Lesson</label>
                                                        <select name="modules[{{ $moduleIndex }}][lesson_ref]"
                                                            class="form-control module-lesson-select"
                                                            data-selected="{{ $module['lesson_ref'] ?? '' }}">
                                                            <option value="">Select Lesson</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label">Title</label>
                                                        <input type="text" name="modules[{{ $moduleIndex }}][title]"
                                                            class="form-control @error('modules.' . $moduleIndex . '.title') is-invalid @enderror"
                                                            value="{{ $module['title'] ?? '' }}"
                                                            placeholder="Enter module title">
                                                        @error('modules.' . $moduleIndex . '.title')
                                                            <span class="invalid-feedback"
                                                                role="alert"><strong>{{ $message }}</strong></span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label">Module Type</label>
                                                        <select name="modules[{{ $moduleIndex }}][module_type]"
                                                            class="form-control module-type-select">
                                                            <option value="">Select Type</option>
                                                            <option value="video"
                                                                {{ ($module['module_type'] ?? '') === 'video' ? 'selected' : '' }}>
                                                                Video</option>
                                                            <option value="article"
                                                                {{ ($module['module_type'] ?? '') === 'article' ? 'selected' : '' }}>
                                                                Article</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label">Duration</label>
                                                        <input type="text"
                                                            name="modules[{{ $moduleIndex }}][duration]"
                                                            class="form-control" value="{{ $module['duration'] ?? '' }}"
                                                            placeholder="e.g. 15 min">
                                                    </div>
                                                    <div class="col-md-6 mb-3 module-content-field"
                                                        data-module-type="video">
                                                        <label class="form-label">Video Link</label>
                                                        <input type="text" name="modules[{{ $moduleIndex }}][link]"
                                                            class="form-control" value="{{ $module['link'] ?? '' }}"
                                                            placeholder="Enter link">
                                                    </div>
                                                    <div class="col-md-6 mb-3 module-content-field"
                                                        data-module-type="article">
                                                        <label class="form-label">Article</label>
                                                        <textarea name="modules[{{ $moduleIndex }}][article]" data-summernote class="form-control" rows="4"
                                                            placeholder="Enter article content">{{ $module['article'] ?? '' }}</textarea>
                                                    </div>
                                                     <div class="col-md-5 mb-3 module-free-paid-field" style="{{ old('free_or_paid') === 'paid' ? '' : 'display:none;' }}">
                                                         <label class="form-label">Free / Paid</label>
                                                         <select name="modules[{{ $moduleIndex }}][free_paid]"
                                                             class="form-control">
                                                             <option value="">Select Option</option>
                                                             <option value="free"
                                                                 {{ ($module['free_paid'] ?? '') === 'free' ? 'selected' : '' }}>
                                                                 Free</option>
                                                             <option value="paid"
                                                                 {{ ($module['free_paid'] ?? '') === 'paid' ? 'selected' : '' }}>
                                                                 Paid</option>
                                                         </select>
                                                     </div>
                                                    {{-- <div class="col-md-4 mb-3">
                                                        <label class="form-label">PDF File</label>
                                                        <input type="file"
                                                            name="modules[{{ $moduleIndex }}][pdf_file]"
                                                            class="form-control" value="{{ $module['pdf_file'] ?? '' }}"
                                                            placeholder="Enter PDF file path or name">
                                                    </div> --}}
                                                    {{-- <div class="col-md-3 mb-3">
                                                        <label class="form-label">Date</label>
                                                        <div class="input-group">
                                                            <div
                                                                class="input-group-text bg-primary-transparent text-primary">
                                                                <i class="fe fe-calendar text-20"></i>
                                                            </div>
                                                            <input class="form-control fc-datepicker"
                                                                placeholder="DD/MM/YYYY" type="text"
                                                                value="{{ !empty($module['date']) ? \Carbon\Carbon::parse($module['date'])->format('d/m/Y') : '' }}">
                                                            <input type="hidden"
                                                                name="modules[{{ $moduleIndex }}][date]"
                                                                value="{{ $module['date'] ?? '' }}">
                                                        </div>
                                                    </div> --}}
                                                    {{-- <div class="col-md-3 mb-3">
                                                        <label class="form-label">Time</label>
                                                        <div class="input-group">
                                                            <div
                                                                class="input-group-text bg-primary-transparent text-primary">
                                                                <i class="fe fe-clock text-20"></i>
                                                            </div>
                                                            <input type="text"
                                                                name="modules[{{ $moduleIndex }}][time]"
                                                                class="form-control tpicker"
                                                                value="{{ $module['time'] ?? '' }}"
                                                                placeholder="Enter time">
                                                        </div>
                                                    </div> --}}
                                                    <div class="col-md-1 mb-3 d-flex align-items-end">
                                                        <button type="button"
                                                            class="btn w-100 {{ $loop->first ? 'btn-secondary addModuleField' : 'btn-danger removeModuleField' }}">
                                                            {{ $loop->first ? '+' : '-' }}
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button class="btn btn-primary" type="submit">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h3 class="card-title">Course List</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive export-table">
                        <table id="file-datatable"
                            class="table table-bordered text-nowrap key-buttons border-bottom w-100">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Subcategory</th>
                                    <th>Image</th>
                                    <th>Price</th>
                                    <th>Discount</th>
                                    <th>Type</th>
                                    @can('edit-course')
                                        <th>Status</th>
                                    @endcan
                                    @canany(['edit-course', 'delete-course'])
                                        <th>Actions</th>
                                    @endcanany
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($courses as $course)
                                    <tr>
                                        <td><strong>{{ $courses->firstItem() + $loop->index }}</strong></td>
                                        <td>{{ $course->name }}</td>
                                        <td>{{ $course->category ? $course->category->name : 'N/A' }}</td>
                                        <td>{{ $course->subcategory ? $course->subcategory->name : 'N/A' }}</td>
                                        <td>
                                            @if ($course->image)
                                                <img src="{{ asset('uploads/courses/' . $course->image) }}"
                                                    alt="" style="height: 50px">
                                            @else
                                                <span>No Image</span>
                                            @endif
                                        </td>
                                        <td>{{ $course->price }}</td>
                                        <td>{{ $course->discount ?? 'N/A' }}</td>
                                        <td>{{ $course->live_or_record ?? 'N/A' }}</td>
                                        @can('edit-course')
                                            <td>
                                                <div class="material-switch">
                                                    <input id="course-{{ $course->id }}" class="toggle-class"
                                                        name="is_active" type="checkbox"
                                                        {{ $course->is_active ? 'checked' : '' }}
                                                        data-id="{{ $course->id }}">
                                                    <label for="course-{{ $course->id }}" class="label-success"></label>
                                                </div>
                                            </td>
                                        @endcan
                                        @canany(['edit-course', 'delete-course'])
                                            <td class="text-center">
                                                <div class="action-btns d-flex align-items-center justify-content-center">
                                                    <div>
                                                        <a href="{{ route('courses.show', $course->id) }}"
                                                            class="btn btn-sm btn-outline-primary border me-1">
                                                            <i class="fa-solid fa-eye"></i>
                                                        </a>
                                                    </div>
                                                    <div>
                                                        <a href="{{ route('courses.edit', $course->id) }}"
                                                            class="btn btn-sm btn-outline-secondary border me-1">
                                                            <i class="fa-solid fa-pen fa-fw"></i>
                                                        </a>
                                                    </div>
                                                    <div>
                                                        <form action="{{ route('courses.destroy', $course->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-sm btn-outline-warning border show_confirm">
                                                                <i class="fa-solid fa-trash-can fa-fw"></i>
                                                            </button>
                                                        </form>
                                                    </div>
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

    @push('backend_script')
        @include('backend.pages.common.script')
        <script>
            $(document).ready(function() {
                // Auto-generate slug from name when slug field is empty
                $('#name').on('input propertychange paste', function() {
                    var name = $(this).val();
                    var slugField = $('#slug');
                    var currentSlug = slugField.val();

                    // Only auto-generate if slug field is empty or hasn't been manually edited
                    if (!slugField.attr('data-manual-edit')) {
                        if (name && name.trim() !== '') {
                            // Handle both Latin and non-Latin characters (like Bangla)
                            var generatedSlug = name.toLowerCase()
                                .replace(/[^\w\s\u0980-\u09FF-]/g,
                                    '') // Allow Bangla Unicode range along with alphanumeric and spaces/hyphens
                                .replace(/[\s_-]+/g,
                                    '-') // Replace spaces, underscores, or multiple hyphens with single hyphen
                                .replace(/^-+|-+$/g, '') // Remove leading/trailing hyphens
                                .trim();
                            slugField.val(generatedSlug);
                        } else {
                            // Clear slug if name is empty
                            slugField.val('');
                        }
                    }
                });

                // Mark slug field as manually edited when user modifies it
                $('#slug').on('input focus', function() {
                    $(this).attr('data-manual-edit', 'true');
                });

                // If user clears the slug field, allow auto-generation again
                $('#slug').on('input', function() {
                    if ($(this).val() === '') {
                        $(this).removeAttr('data-manual-edit');
                    }
                });

                // Reset manual edit flag when name field gets focus and slug is empty
                $('#name').on('focus', function() {
                    if ($('#slug').val() === '') {
                        $('#slug').removeAttr('data-manual-edit');
                    }
                });

                function togglePricingFields() {
                    if ($('#free_or_paid').val() === 'paid') {
                        $('.price-fields').show();
                        $('#price').attr('required', true);
                    } else {
                        $('.price-fields').hide();
                        $('#price').removeAttr('required');
                        $('#discount').val('');
                        $('#price').val('');
                    }
                }

                function toggleLiveFields() {
                    if ($('#live_or_record').val() === 'live') {
                        $('.live-fields').show();
                        $('#start_date').attr('required', true);
                        $('#end_date').attr('required', true);
                        $('#max_student').attr('required', true);
                        $('#meeting_link').attr('required', true);
                    } else {
                        $('.live-fields').hide();
                        $('#start_date').removeAttr('required');
                        $('#end_date').removeAttr('required');
                        $('#max_student').removeAttr('required');
                        $('#meeting_link').removeAttr('required');
                        $('#live_schedule').val('');
                        $('#start_date').val('');
                        $('#end_date').val('');
                        $('#max_student').val('');
                        $('#meeting_link').val('');
                    }
                }

                function toggleModuleFreePaidFields() {
                    if ($('#free_or_paid').val() === 'paid') {
                        $('.module-free-paid-field').show();
                    } else {
                        $('.module-free-paid-field').hide();
                    }
                }

                $('#free_or_paid').on('change', function() {
                    togglePricingFields();
                    toggleModuleFreePaidFields();
                });

                $('#live_or_record').on('change', function() {
                    toggleLiveFields();
                });

                togglePricingFields();
                toggleLiveFields();
                toggleModuleFreePaidFields();

                function generateLessonRef() {
                    return 'lesson_' + Date.now() + '_' + Math.floor(Math.random() * 100000);
                }

                function escapeHtml(text) {
                    return $('<div>').text(text).html();
                }

                function getLessonOptionsHtml(selectedValue) {
                    var options = '<option value="">Select Lesson</option>';

                    $('#multipleLessonFields .lesson-row').each(function() {
                        var lessonRef = $(this).find('.lesson-ref').val();
                        var lessonName = $(this).find('.lesson-name').val().trim();

                        if (lessonRef && lessonName) {
                            var optionValue = 'new:' + lessonRef;
                            var selected = optionValue === selectedValue ? 'selected' : '';
                            options +=
                                `<option value="${optionValue}" ${selected}>${escapeHtml(lessonName)}</option>`;
                        }
                    });

                    return options;
                }

                function refreshModuleLessonOptions() {
                    $('.module-lesson-select').each(function() {
                        var currentValue = $(this).val() || $(this).data('selected') || '';
                        $(this).html(getLessonOptionsHtml(currentValue));

                        if (currentValue) {
                            $(this).val(currentValue);
                        }

                        if ($(this).val() !== currentValue) {
                            $(this).val('');
                        }

                        $(this).removeData('selected');
                    });
                }

                $(document).on('click', '.addLessonField', function() {
                    var fieldCount = $('#multipleLessonFields .lesson-row').length;
                    var lessonRef = generateLessonRef();
                    var newField = `
                        <div class="mb-2 lesson-row" id="multipleLessonField${fieldCount}">
                            <input type="hidden" name="lessons[${fieldCount}][ref]" class="lesson-ref" value="${lessonRef}" />
                            <div class="d-flex justify-content-between">
                                <input type="text" name="lessons[${fieldCount}][name]" class="form-control me-4 lesson-name" placeholder="Enter lesson name" />
                                <button type="button" class="btn btn-danger removeLessonField">-</button>
                            </div>
                            <textarea name="lessons[${fieldCount}][description]" class="form-control mt-2" rows="3" placeholder="Enter lesson description"></textarea>
                        </div>
                    `;
                    $('#multipleLessonFields').append(newField);
                    refreshModuleLessonOptions();
                });

                $(document).on('click', '.removeLessonField', function() {
                    $(this).closest('.lesson-row').remove();
                    refreshModuleLessonOptions();
                });

                $(document).on('input', '.lesson-name', function() {
                    refreshModuleLessonOptions();
                });

                function initSummernote(container) {
                    var $targets = container ? $(container).find('textarea[data-summernote]') : $(
                        'textarea[data-summernote]');
                    $targets.each(function() {
                        var $this = $(this);
                        if (!$this.data('summernote-inited') && $this.is(':visible')) {
                            $this.summernote({
                                height: 180,
                                callbacks: {
                                    onChange: function(contents) {
                                        $this.val(contents);
                                    }
                                }
                            });
                            $this.data('summernote-inited', true);
                        }
                    });
                }

                function toggleModuleContentFields(container) {
                    container.find('.module-type-select').each(function() {
                        var type = $(this).val() || 'video';
                        var row = $(this).closest('.module-row');
                        // toggle content fields (video/article)
                        row.find('.module-content-field').each(function() {
                            var matches = $(this).data('module-type') === type;
                            $(this).toggle(matches);
                            if (matches && type === 'article') {
                                initSummernote($(this));
                            }
                        });
                        // hide auxiliary fields (free/paid, live/record, pdf, date, time)
                        row.find('.module-aux-field').hide();
                    });
                }

                $(document).on('change', '.module-type-select', function() {
                    toggleModuleContentFields($(this).closest('.module-row'));
                });

                $(document).on('click', '.addModuleField', function() {
                    var fieldCount = $('#multipleModuleFields .module-row').length;
                    var newField = `
                        <div class="p-3 mb-3 module-row" id="multipleModuleField${fieldCount}">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Module Lesson</label>
                                    <select name="modules[${fieldCount}][lesson_ref]" class="form-control module-lesson-select">
                                        <option value="">Select Lesson</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Title</label>
                                    <input type="text" name="modules[${fieldCount}][title]" class="form-control" placeholder="Enter module title">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Module Type</label>
                                    <select name="modules[${fieldCount}][module_type]" class="form-control module-type-select">
                                        <option value="">Select Type</option>
                                        <option value="video" selected>Video</option>
                                        <option value="article">Article</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Duration</label>
                                    <input type="text" name="modules[${fieldCount}][duration]" class="form-control" placeholder="e.g. 15 min">
                                </div>
                                <div class="col-md-6 mb-3 module-content-field" data-module-type="video">
                                    <label class="form-label">Video Link</label>
                                    <input type="text" name="modules[${fieldCount}][link]" class="form-control" placeholder="Enter link">
                                </div>
                                <div class="col-md-6 mb-3 module-content-field" data-module-type="article" style="display:none;">
                                    <label class="form-label">Article</label>
                                    <textarea name="modules[${fieldCount}][article]" data-summernote class="form-control" rows="4" placeholder="Enter article content"></textarea>
                                </div>
                                <div class="col-md-5 mb-3 module-free-paid-field" style="${$('#free_or_paid').val() === 'paid' ? '' : 'display:none;'}">
                                    <label class="form-label">Free / Paid</label>
                                    <select name="modules[${fieldCount}][free_paid]" class="form-control">
                                        <option value="">Select Option</option>
                                        <option value="free">Free</option>
                                        <option value="paid">Paid</option>
                                    </select>
                                </div>

                                <div class="col-md-1 mb-3 d-flex align-items-end">
                                    <button type="button" class="btn btn-danger w-100 removeModuleField">-</button>
                                </div>
                            </div>
                        </div>
                    `;
                    $('#multipleModuleFields').append(newField);
                    refreshModuleLessonOptions();
                    // Ensure lesson options and type toggles run for new row
                    var $newRow = $('#multipleModuleField' + fieldCount);
                    $newRow.find('.module-lesson-select').trigger('change');
                    $newRow.find('.module-type-select').trigger('change');
                    toggleModuleContentFields($newRow);
                    window.initDatepicker();
                    window.initTimepicker();
                });

                $(document).on('click', '.removeModuleField', function() {
                    $(this).closest('.module-row').remove();
                });

                refreshModuleLessonOptions();
                $('.module-row').each(function() {
                    toggleModuleContentFields($(this));
                });

                $(document).on('change', '.toggle-class', function() {
                    var courseId = $(this).data('id');
                    var url = "{{ route('course.is_active.ajax', ':course_id') }}";
                    url = url.replace(':course_id', courseId);

                    $.ajax({
                        type: "GET",
                        url: url,
                        success: function(data) {
                            if (data.type === 'success') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success!',
                                    text: data.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            }
                        },
                        error: function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'Something went wrong!',
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
                    });
                });

                $('#category_id').on('change', function() {
                    var categoryId = $(this).val();

                    if (categoryId) {
                        $.ajax({
                            url: "{{ route('course.get.subcategories', ':category_id') }}".replace(
                                ':category_id', categoryId),
                            type: "GET",
                            dataType: "json",
                            success: function(data) {
                                $('#subcategory_id').empty();
                                $('#subcategory_id').append(
                                    '<option value="">Select Subcategory</option>');

                                $.each(data, function(key, value) {
                                    $('#subcategory_id').append('<option value="' + value
                                        .id + '">' + value.name + '</option>');
                                });

                                $('#subcategory_id').prop('disabled', false);
                            }
                        });
                    } else {
                        $('#subcategory_id').empty();
                        $('#subcategory_id').append('<option value="">Select Subcategory</option>');
                        $('#subcategory_id').prop('disabled', true);
                    }
                });
            });
        </script>
    @endpush
@endsection
