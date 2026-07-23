@extends('backend.layouts.master')

@section('title', 'Edit Course')

@push('backend_style')
    @include('backend.pages.common.style')
    <style>
        .lesson_item {
            position: relative;
            display: inline-flex;
            align-items: center;
            min-height: 42px;
            padding: 8px 16px;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            /* background: #f8f9fa; */
        }

        .lesson_item:hover .remove_icon {
            opacity: 1;
        }

        .module_item {
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            margin-bottom: 12px;
            position: relative;
            overflow: hidden;
            background: #fff;
            box-shadow: 0 10px 25px rgba(15, 23, 42, 0.06);
        }

        .module_thumb {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            background: #f3f4f6;
        }

        .module_media {
            position: relative;
            width: 100%;
            padding-bottom: 56.25%;
            background: #f3f4f6;
            overflow: hidden;
        }

        .module_play_trigger {
            position: absolute;
            inset: 0;
            border: 0;
            background: transparent;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .module_play_icon {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            background: rgba(220, 38, 38, 0.92);
            color: #fff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.22);
        }

        .module_iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 0;
        }

        .module_body {
            padding: 14px 16px 16px;
        }

        .module_title {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 6px;
            color: #111827;
        }

        .module_meta {
            color: #6b7280;
            font-size: 13px;
            line-height: 1.5;
        }

        .module_actions {
            position: absolute;
            top: 12px;
            right: 12px;
            display: flex;
            gap: 8px;
            z-index: 2;
        }

        .module_grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
            gap: 16px;
        }

        /* Drag & Drop */
        .drag-handle {
            cursor: grab;
            color: #9ca3af;
            font-size: 14px;
            padding: 0 6px 0 0;
            flex-shrink: 0;
        }
        .drag-handle:active { cursor: grabbing; }
        .lesson_item.sortable-ghost {
            opacity: 0.4;
            background: #e0f2fe;
            border-color: #38bdf8;
        }
        .module_item.sortable-ghost {
            opacity: 0.35;
            background: #e0f2fe;
            border: 2px dashed #38bdf8;
        }
        .module_drag_handle {
            position: absolute;
            top: 8px;
            left: 8px;
            z-index: 3;
            cursor: grab;
            color: #9ca3af;
            font-size: 14px;
            background: rgba(255,255,255,0.85);
            border-radius: 4px;
            padding: 2px 5px;
            line-height: 1;
        }
        .module_drag_handle:active { cursor: grabbing; }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.2/Sortable.min.js"></script>
@endpush

@section('backend_content')
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Edit Course</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('courses.index') }}">Course</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between">
                    <h3 class="card-title">Edit Course</h3>
                    <a href="{{ route('courses.index') }}" class="btn btn-info">
                        <i class="fa-solid fa-angles-left fa-fw"></i> Back
                    </a>
                </div>
                <div class="card-body">
                    <form action="{{ route('courses.update', $course->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-row">
                            <div class="col-6 mb-3">
                                <div class="form-group">
                                    <label for="name">Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" id="name"
                                        class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $course->name) }}"
                                        required>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-6 mb-3">
                                <div class="form-group">
                                    <label for="slug">Slug (Optional - Auto-generated if left empty)</label>
                                    <input type="text" name="slug" id="slug"
                                        class="form-control @error('slug') is-invalid @enderror"
                                        value="{{ old('slug', $course->slug) }}">
                                    @error('slug')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
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
                                            <option value="{{ $category->id }}" {{ old('category_id', $course->category_id) == $category->id ? 'selected' : '' }}>
                                                {!! $category->name !!}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="subcategory_id">Subcategory</label>
                                    <select name="subcategory_id" id="subcategory_id"
                                        class="form-control select2-style1 @error('subcategory_id') is-invalid @enderror" {{ $course->category_id ? '' : 'disabled' }}>
                                        <option value="">Select Subcategory</option>
                                        @foreach ($subcategories as $subcategory)
                                            <option value="{{ $subcategory->id }}" {{ old('subcategory_id', $course->subcategory_id) == $subcategory->id ? 'selected' : '' }}>
                                                {!! $subcategory->name !!}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('subcategory_id')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="course_level">Course Level</label>
                                    <select name="course_level" id="course_level"
                                        class="form-control select2-style1 @error('course_level') is-invalid @enderror">
                                        <option value="">Select Level</option>
                                        <option value="beginner" {{ old('course_level', $course->course_level) == 'beginner' ? 'selected' : '' }}>Beginner</option>
                                        <option value="intermediate" {{ old('course_level', $course->course_level) == 'intermediate' ? 'selected' : '' }}>Intermediate</option>
                                        <option value="advance" {{ old('course_level', $course->course_level) == 'advance' ? 'selected' : '' }}>Advance</option>
                                    </select>
                                    @error('course_level')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12 my-3">
                                <div><h4 class="text-primary mb-3">Course Pricing</h4></div>
                                <hr>
                                <div class="form-group">
                                    <label for="free_or_paid">Pricing Type</label>
                                    <select name="free_or_paid" id="free_or_paid"
                                        class="form-control select2-style1 @error('free_or_paid') is-invalid @enderror">
                                        <option value="">Select Pricing</option>
                                        <option value="free" {{ old('free_or_paid', $course->free_or_paid) == 'free' ? 'selected' : '' }}>Free</option>
                                        <option value="paid" {{ old('free_or_paid', $course->free_or_paid) == 'paid' ? 'selected' : '' }}>Paid</option>
                                    </select>
                                    @error('free_or_paid')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3 price-fields" style="{{ old('free_or_paid', $course->free_or_paid) === 'paid' ? '' : 'display:none;' }}">
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="number" step="0.01" name="price" id="price"
                                        class="form-control @error('price') is-invalid @enderror"
                                        value="{{ old('price', $course->price) }}">
                                    @error('price')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3 price-fields" style="{{ old('free_or_paid', $course->free_or_paid) === 'paid' ? '' : 'display:none;' }}">
                                <div class="form-group">
                                    <label for="discount">Discount</label>
                                    <input type="number" step="0.01" name="discount" id="discount"
                                        class="form-control @error('discount') is-invalid @enderror"
                                        value="{{ old('discount', $course->discount) }}">
                                    @error('discount')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12 my-3">
                                <div><h4 class="text-primary mb-3">Course Type</h4></div>
                                <hr>
                                <div class="form-group">
                                    <label for="live_or_record">Live or Record</label>
                                    <select name="live_or_record" id="live_or_record"
                                        class="form-control select2-style1 @error('live_or_record') is-invalid @enderror">
                                        <option value="">Select Type</option>
                                        <option value="live" {{ old('live_or_record', $course->live_or_record) == 'live' ? 'selected' : '' }}>Live</option>
                                        <option value="record" {{ old('live_or_record', $course->live_or_record) == 'record' ? 'selected' : '' }}>Record</option>
                                    </select>
                                    @error('live_or_record')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4 mb-3 live-fields" style="{{ old('live_or_record', $course->live_or_record) === 'live' ? '' : 'display:none;' }}">
                                <div class="form-group">
                                    <label for="live_schedule">Live Schedule</label>
                                    <input type="text" name="live_schedule" id="live_schedule"
                                        class="form-control @error('live_schedule') is-invalid @enderror"
                                        value="{{ old('live_schedule', $course->live_schedule) }}">
                                    @error('live_schedule')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4 mb-3 live-fields" style="{{ old('live_or_record', $course->live_or_record) === 'live' ? '' : 'display:none;' }}">
                                <div class="form-group">
                                    <label for="start_date">Start Date</label>
                                    <div class="input-group">
                                        <div class="input-group-text bg-primary-transparent text-primary">
                                            <i class="fe fe-calendar text-20"></i>
                                        </div>
                                        <input class="form-control fc-datepicker @error('start_date') is-invalid @enderror"
                                            placeholder="DD/MM/YYYY" type="text" id="start_date"
                                            value="{{ old('start_date', $course->start_date) ? \Carbon\Carbon::parse(old('start_date', $course->start_date))->format('d/m/Y') : '' }}">
                                        <input type="hidden" name="start_date"
                                            value="{{ old('start_date', $course->start_date) }}">
                                    </div>
                                    @error('start_date')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4 mb-3 live-fields" style="{{ old('live_or_record', $course->live_or_record) === 'live' ? '' : 'display:none;' }}">
                                <div class="form-group">
                                    <label for="end_date">End Date</label>
                                    <div class="input-group">
                                        <div class="input-group-text bg-primary-transparent text-primary">
                                            <i class="fe fe-calendar text-20"></i>
                                        </div>
                                        <input class="form-control fc-datepicker @error('end_date') is-invalid @enderror"
                                            placeholder="DD/MM/YYYY" type="text" id="end_date"
                                            value="{{ old('end_date', $course->end_date) ? \Carbon\Carbon::parse(old('end_date', $course->end_date))->format('d/m/Y') : '' }}">
                                        <input type="hidden" name="end_date"
                                            value="{{ old('end_date', $course->end_date) }}">
                                    </div>
                                    @error('end_date')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4 mb-3 live-fields" style="{{ old('live_or_record', $course->live_or_record) === 'live' ? '' : 'display:none;' }}">
                                <div class="form-group">
                                    <label for="max_student">Maximum Students</label>
                                    <input type="number" name="max_student" id="max_student"
                                        class="form-control @error('max_student') is-invalid @enderror"
                                        value="{{ old('max_student', $course->max_student) }}">
                                    @error('max_student')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-8 mb-3 live-fields" style="{{ old('live_or_record', $course->live_or_record) === 'live' ? '' : 'display:none;' }}">
                                <div class="form-group">
                                    <label for="meeting_link">Meeting Link</label>
                                    <input type="text" name="meeting_link" id="meeting_link"
                                        class="form-control @error('meeting_link') is-invalid @enderror"
                                        value="{{ old('meeting_link', $course->meeting_link) }}">
                                    @error('meeting_link')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            {{-- <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="is_offline">Is Offline</label>
                                    <select name="is_offline" id="is_offline"
                                        class="form-control select2-style1 @error('is_offline') is-invalid @enderror">
                                        <option value="">Select Option</option>
                                        <option value="1" {{ old('is_offline', (string) $course->is_offline) == '1' ? 'selected' : '' }}>Yes</option>
                                        <option value="0" {{ old('is_offline', (string) $course->is_offline) == '0' ? 'selected' : '' }}>No</option>
                                    </select>
                                    @error('is_offline')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div> --}}

                            {{-- <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="is_active">Status</label>
                                    <select name="is_active" id="is_active"
                                        class="form-control select2-style1 @error('is_active') is-invalid @enderror">
                                        <option value="1" {{ old('is_active', (string) $course->is_active) == '1' ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ old('is_active', (string) $course->is_active) == '0' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    @error('is_active')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div> --}}

                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label for="button_type">Button Type</label>
                                    <select name="button_type" id="button_type"
                                        class="form-control select2-style1 @error('button_type') is-invalid @enderror">
                                        <option value="Enroll Now" {{ old('button_type', $course->button_type ?? 'Enroll Now') == 'Enroll Now' ? 'selected' : '' }}>Enroll Now</option>
                                        <option value="Comming Soon" {{ old('button_type', $course->button_type) == 'Comming Soon' ? 'selected' : '' }}>Comming Soon</option>
                                    </select>
                                    @error('button_type')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="video_link">Video Link</label>
                                    <input type="text" name="video_link" id="video_link"
                                        class="form-control @error('video_link') is-invalid @enderror"
                                        value="{{ old('video_link', $course->video_link) }}">
                                    @error('video_link')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea name="description"
                                        class="form-control @error('description') is-invalid @enderror"
                                        rows="4">{{ old('description', $course->description) }}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="full_description">Full Description</label>
                                    <textarea name="full_description" class="form-control @error('full_description') is-invalid @enderror" rows="5">{{ old('full_description', $course->full_description) }}</textarea>
                                    @error('full_description')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="learning_outcomes">Learning Outcomes</label>
                                    <textarea name="learning_outcomes" class="form-control @error('learning_outcomes') is-invalid @enderror" rows="4">{{ old('learning_outcomes', $course->learning_outcomes) }}</textarea>
                                    @error('learning_outcomes')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="requirement">Requirement</label>
                                    <textarea name="requirement" class="form-control @error('requirement') is-invalid @enderror" rows="4">{{ old('requirement', $course->requirement) }}</textarea>
                                    @error('requirement')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="tags">Tags</label>
                                    <input type="text" name="tags" id="tags"
                                        class="form-control @error('tags') is-invalid @enderror"
                                        value="{{ old('tags', $course->tags) }}">
                                    @error('tags')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <input type="file" name="image" id="image"
                                        class="form-control @error('image') is-invalid @enderror">
                                    @error('image')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                    @if ($course->image)
                                        <div class="mt-2">
                                            <img src="{{ asset('uploads/courses/' . $course->image) }}" alt="" style="height: 100px">
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="pdf">PDF</label>
                                    <input type="file" name="pdf" id="pdf"
                                        class="form-control @error('pdf') is-invalid @enderror">
                                    @error('pdf')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                    @if ($course->pdf)
                                        <div class="mt-2">
                                            <a href="{{ asset('uploads/courses/pdfs/' . $course->pdf) }}" target="_blank">View Current PDF</a>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label for="button_type">Button Type</label>
                                    <select name="button_type" id="button_type"
                                        class="form-control select2-style1 @error('button_type') is-invalid @enderror">
                                        <option value="">Select Button Type</option>
                                        <option value="Enroll Now" {{ old('button_type', $course->button_type) == 'Enroll Now' ? 'selected' : '' }}>Enroll Now</option>
                                        <option value="Comming Soon" {{ old('button_type', $course->button_type) == 'Comming Soon' ? 'selected' : '' }}>Comming Soon</option>
                                    </select>
                                    @error('button_type')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 mb-3">
                                <div><h4 class="text-primary mb-3">Create/Update Lesson</h4></div>
                                <hr>
                                <div class="form-group">
                                    <label for="lessons">Lessons</label>
                                    <div id="multipleLessonFields">
                                        @php
                                            $lessonValues = old('lessons', [
                                                ['id' => '', 'ref' => 'lesson_' . uniqid(), 'name' => ''],
                                            ]);
                                        @endphp
                                        @foreach ($lessonValues as $lessonIndex => $lesson)
                                            <div class="mb-2 lesson-row" id="multipleLessonField{{ $lessonIndex }}">
                                                <input type="hidden" name="lessons[{{ $lessonIndex }}][id]" class="lesson-id"
                                                    value="{{ $lesson['id'] ?? '' }}" />
                                                <input type="hidden" name="lessons[{{ $lessonIndex }}][ref]" class="lesson-ref"
                                                    value="{{ $lesson['ref'] ?? 'lesson_' . uniqid() }}" />
                                                <div class="d-flex justify-content-between">
                                                    <input type="text" name="lessons[{{ $lessonIndex }}][name]"
                                                        class="form-control me-4 lesson-name @error('lessons.' . $lessonIndex . '.name') is-invalid @enderror"
                                                        value="{{ $lesson['name'] ?? '' }}" placeholder="Enter lesson name" />
                                                    <button type="button"
                                                        class="btn {{ $loop->first ? 'btn-secondary addLessonField' : 'btn-danger removeLessonField' }}">
                                                        {{ $loop->first ? '+' : '-' }}
                                                    </button>
                                                </div>
                                                <textarea name="lessons[{{ $lessonIndex }}][description]"
                                                    class="form-control mt-2"
                                                    rows="2"
                                                    placeholder="Enter lesson description">{{ $lesson['description'] ?? '' }}</textarea>
                                            </div>
                                            @error('lessons.' . $lessonIndex . '.name')
                                                <span class="invalid-feedback d-block" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        @endforeach
                                    </div>
                                    <small class="form-text text-muted">Add new lessons here. Existing lessons can be deleted below.</small>

                                    @if ($course->lessons->count() > 0)
                                        <div class="d-flex align-items-center justify-content-between mt-3 mb-1">
                                            <small class="text-muted"><i class="fa-solid fa-grip-lines me-1"></i> Drag lessons to reorder</small>
                                            <span id="lessons-order-status" class="text-success small d-none"><i class="fa-solid fa-check-circle me-1"></i> Order saved!</span>
                                        </div>
                                        <ul class="list-inline mb-0" id="lessons-sortable-list" style="display:flex;flex-wrap:wrap;gap:8px;padding:0;">
                                            @foreach ($course->lessons()->orderBy('sort_order','asc')->orderBy('id','asc')->get() as $lesson)
                                                <li class="list-inline-item lesson_item mb-0 existing-lesson-item"
                                                    id="course-lesson-{{ $lesson->id }}" data-lesson-id="{{ $lesson->id }}"
                                                    data-lesson-name="{{ $lesson->name }}" style="list-style:none;margin:0;">
                                                    <span class="drag-handle"><i class="fa-solid fa-grip-vertical"></i></span>
                                                    <span>{{ $lesson->name }}</span>
                                                    <div class="remove_icon ms-2">
                                                        <button type="button"
                                                            class="btn btn-sm btn-outline-primary border edit-lesson"
                                                            data-id="{{ $lesson->id }}" data-name="{{ $lesson->name }}"
                                                            data-description="{{ $lesson->description }}"
                                                            data-toggle="tooltip" data-placement="top"
                                                            data-bs-original-title="Edit">
                                                            <i class="fa-solid fa-pen fa-fw"></i>
                                                        </button>
                                                        <button type="button"
                                                            class="btn btn-sm btn-outline-warning border show_confirm delete-lesson"
                                                            data-id="{{ $lesson->id }}" data-toggle="tooltip"
                                                            data-placement="top" data-bs-original-title="Delete">
                                                            <i class="fa-solid fa-trash-can fa-fw"></i>
                                                        </button>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            </div>

                            <div class="col-12 mb-3">
                                <div><h4 class="text-primary mb-3">Create/Update Modules</h4></div>
                                <hr>
                                <div class="form-group">
                                    <label for="modules">Modules</label>
                                    <div id="multipleModuleFields">
                                        @php
                                            $moduleValues = old('modules', [[
                                                'id' => '',
                                                'lesson_ref' => '',
                                                'title' => '',
                                                'link' => '',
                                                'free_paid' => '',
                                                'live_record' => '',
                                                'pdf_file' => '',
                                                'date' => '',
                                                'time' => '',
                                            ]]);

                                            if (count($moduleValues) === 0) {
                                                $moduleValues = [[
                                                    'id' => '',
                                                    'lesson_ref' => '',
                                                    'title' => '',
                                                    'link' => '',
                                                    'free_paid' => '',
                                                    'live_record' => '',
                                                    'pdf_file' => '',
                                                    'date' => '',
                                                    'time' => '',
                                                ]];
                                            }
                                        @endphp
                                        @foreach ($moduleValues as $moduleIndex => $module)
                                            <div class="border p-3 mb-3 module-row" id="multipleModuleField{{ $moduleIndex }}">
                                                <input type="hidden" name="modules[{{ $moduleIndex }}][id]" class="module-id"
                                                    value="{{ $module['id'] ?? '' }}">
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
                                                            value="{{ $module['title'] ?? '' }}" placeholder="Enter module title">
                                                        @error('modules.' . $moduleIndex . '.title')
                                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label">Module Type</label>
                                                        <select name="modules[{{ $moduleIndex }}][module_type]" class="form-control module-type-select">
                                                            <option value="">Select Type</option>
                                                            <option value="video" {{ ($module['module_type'] ?? '') === 'video' ? 'selected' : '' }}>Video</option>
                                                            <option value="article" {{ ($module['module_type'] ?? '') === 'article' ? 'selected' : '' }}>Article</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label">Duration</label>
                                                        <input type="text" name="modules[{{ $moduleIndex }}][duration]"
                                                            class="form-control" value="{{ $module['duration'] ?? '' }}"
                                                            placeholder="e.g. 15 min">
                                                    </div>
                                                    <div class="col-md-6 mb-3 module-content-field" data-module-type="video">
                                                        <label class="form-label">Video Link</label>
                                                        <input type="text" name="modules[{{ $moduleIndex }}][link]"
                                                            class="form-control" value="{{ $module['link'] ?? '' }}"
                                                            placeholder="Enter link">
                                                    </div>
                                                    <div class="col-md-6 mb-3 module-content-field" data-module-type="article">
                                                        <label class="form-label">Article</label>
                                                        <textarea name="modules[{{ $moduleIndex }}][article]" data-summernote class="form-control" rows="4" placeholder="Enter article content">{{ $module['article'] ?? '' }}</textarea>
                                                    </div>

                                                    <div class="col-md-5 mb-3 module-free-paid-field" style="{{ old('free_or_paid', $course->free_or_paid) === 'paid' ? '' : 'display:none;' }}">
                                                        <label class="form-label">Free / Paid</label>
                                                        <select name="modules[{{ $moduleIndex }}][free_paid]" class="form-control">
                                                            <option value="">Select Option</option>
                                                            <option value="free" {{ ($module['free_paid'] ?? '') === 'free' ? 'selected' : '' }}>Free</option>
                                                            <option value="paid" {{ ($module['free_paid'] ?? '') === 'paid' ? 'selected' : '' }}>Paid</option>
                                                        </select>
                                                    </div>

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

                                    @if ($course->lessons->count() > 0)
                                        <div class="d-flex align-items-center justify-content-between mb-2">
                                            <small class="text-muted"><i class="fa-solid fa-grip-lines me-1"></i> Drag modules to reorder within each lesson</small>
                                            <span id="modules-order-status" class="text-success small d-none"><i class="fa-solid fa-check-circle me-1"></i> Order saved!</span>
                                        </div>

                                        @foreach ($course->lessons()->orderBy('sort_order', 'asc')->orderBy('id', 'asc')->get() as $lesson)
                                            <div class="lesson-module-group mb-4">
                                                <div class="d-flex align-items-center justify-content-between mb-2">
                                                    <h5 class="mb-2">Lesson: {{ $lesson->name }}</h5>
                                                </div>
                                                <div class="module_grid lesson-module-grid" data-lesson-id="{{ $lesson->id }}">
                                                    @foreach ($lesson->courseModules()->orderBy('sort_order', 'asc')->orderBy('id', 'asc')->get() as $module)
                                                        @php
                                                            $youtubeId = null;
                                                            if (!empty($module->link)) {
                                                                preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/|youtube\.com\/embed\/)([^&\n?#]+)/', $module->link, $matches);
                                                                $youtubeId = $matches[1] ?? null;
                                                            }
                                                            $thumbnail = $youtubeId
                                                                ? 'https://img.youtube.com/vi/' . $youtubeId . '/hqdefault.jpg'
                                                                : 'https://placehold.co/640x360/e5e7eb/6b7280?text=Module+Preview';
                                                            $embedUrl = $youtubeId
                                                                ? 'https://www.youtube.com/embed/' . $youtubeId . '?autoplay=1&rel=0'
                                                                : null;
                                                        @endphp
                                                        <div class="module_item existing-module-item" id="course-module-{{ $module->id }}"
                                                            data-module-id="{{ $module->id }}"
                                                            data-lesson-id="{{ $lesson->id }}"
                                                            data-lesson-ref="{{ $module->lesson_id ? 'existing:' . $module->lesson_id : '' }}"
                                                            data-title="{{ $module->title }}"
                                                            data-link="{{ $module->link }}"
                                                            data-free-paid="{{ $module->free_paid }}"
                                                            data-live-record="{{ $module->live_record }}"
                                                            data-date="{{ $module->date }}"
                                                            data-time="{{ $module->time }}"
                                                            data-thumbnail="{{ $thumbnail }}"
                                                            data-video-id="{{ $youtubeId }}">
                                                            <span class="module_drag_handle" style="cursor:grab; position:absolute; top:5px; left:5px;"><i class="fa-solid fa-grip-vertical"></i></span>
                                                            <div class="module_actions">
                                                                <button type="button" class="btn btn-sm btn-outline-primary border edit-module"
                                                                    data-id="{{ $module->id }}">
                                                                    <i class="fa-solid fa-pen fa-fw"></i>
                                                                </button>
                                                                <button type="button"
                                                                    class="btn btn-sm btn-outline-warning border show_confirm delete-module"
                                                                    data-id="{{ $module->id }}">
                                                                    <i class="fa-solid fa-trash-can fa-fw"></i>
                                                                </button>
                                                            </div>
                                                            <div class="module_media">
                                                                <img src="{{ $thumbnail }}" alt="{{ $module->title }}" class="module_thumb module-thumbnail-preview">
                                                                @if ($embedUrl)
                                                                    <button type="button" class="module_play_trigger play-module-video"
                                                                        data-embed-url="{{ $embedUrl }}">
                                                                        <span class="module_play_icon">
                                                                            <i class="fa-solid fa-play"></i>
                                                                        </span>
                                                                    </button>
                                                                @endif
                                                            </div>
                                                            <div class="module_body">
                                                                <div class="module_title">{{ $module->title }}</div>
                                                                <div class="module_meta module-lesson-preview">
                                                                    Lesson: {{ $lesson->name }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>

                        <button class="btn btn-primary" type="submit">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @foreach ($course->lessons as $lesson)
        <div class="modal fade lesson-edit-modal" id="lessonEditModal{{ $lesson->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Lesson</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="lessons[existing_{{ $lesson->id }}][id]" value="{{ $lesson->id }}">
                        <input type="hidden" name="lessons[existing_{{ $lesson->id }}][ref]" value="existing:{{ $lesson->id }}">
                        <div class="form-group">
                            <label for="lesson_name_{{ $lesson->id }}">Lesson Name</label>
                            <input type="text" id="lesson_name_{{ $lesson->id }}"
                                name="lessons[existing_{{ $lesson->id }}][name]"
                                class="form-control lesson-modal-name"
                                data-lesson-id="{{ $lesson->id }}"
                                value="{{ old('lessons.existing_' . $lesson->id . '.name', $lesson->name) }}">
                        </div>
                        <div class="form-group mt-3">
                            <label for="lesson_description_{{ $lesson->id }}">Lesson Description</label>
                            <textarea id="lesson_description_{{ $lesson->id }}"
                                name="lessons[existing_{{ $lesson->id }}][description]"
                                class="form-control lesson-modal-description"
                                data-lesson-id="{{ $lesson->id }}"
                                rows="3">{{ old('lessons.existing_' . $lesson->id . '.description', $lesson->description) }}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary save-lesson-popup" data-lesson-id="{{ $lesson->id }}">Save</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    @foreach ($course->courseModules as $module)
        <div class="modal fade module-edit-modal" id="moduleEditModal{{ $module->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Module</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="modules[existing_{{ $module->id }}][id]" value="{{ $module->id }}">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Module Lesson</label>
                                <select name="modules[existing_{{ $module->id }}][lesson_ref]"
                                    class="form-control module-lesson-select module-modal-lesson"
                                    data-selected="{{ old('modules.existing_' . $module->id . '.lesson_ref', $module->lesson_id ? 'existing:' . $module->lesson_id : '') }}"
                                    data-module-id="{{ $module->id }}">
                                    <option value="">Select Lesson</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Title</label>
                                <input type="text" name="modules[existing_{{ $module->id }}][title]"
                                    class="form-control module-modal-title"
                                    data-module-id="{{ $module->id }}"
                                    value="{{ old('modules.existing_' . $module->id . '.title', $module->title) }}"
                                    placeholder="Enter module title">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Module Type</label>
                                <select name="modules[existing_{{ $module->id }}][module_type]"
                                    class="form-control module-modal-module-type" data-module-id="{{ $module->id }}">
                                    <option value="">Select Type</option>
                                    <option value="video" {{ old('modules.existing_' . $module->id . '.module_type', $module->module_type) === 'video' ? 'selected' : '' }}>Video</option>
                                    <option value="article" {{ old('modules.existing_' . $module->id . '.module_type', $module->module_type) === 'article' ? 'selected' : '' }}>Article</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Duration</label>
                                <input type="text" name="modules[existing_{{ $module->id }}][duration]"
                                    class="form-control module-modal-duration"
                                    data-module-id="{{ $module->id }}"
                                    value="{{ old('modules.existing_' . $module->id . '.duration', $module->duration) }}"
                                    placeholder="e.g. 15 min">
                            </div>
                            <div class="col-md-6 mb-3 module-modal-content-field" data-module-type="video">
                                <label class="form-label">Link</label>
                                <input type="text" name="modules[existing_{{ $module->id }}][link]"
                                    class="form-control module-modal-link"
                                    data-module-id="{{ $module->id }}"
                                    value="{{ old('modules.existing_' . $module->id . '.link', $module->link) }}"
                                    placeholder="Enter link">
                            </div>
                            <div class="col-md-6 mb-3 module-modal-content-field" data-module-type="article">
                                <label class="form-label">Article</label>
                                <textarea name="modules[existing_{{ $module->id }}][article]"
                                    data-summernote
                                    class="form-control module-modal-article"
                                    data-module-id="{{ $module->id }}"
                                    rows="4"
                                    placeholder="Enter article content">{{ old('modules.existing_' . $module->id . '.article', $module->article) }}</textarea>
                            </div>
                            <div class="col-md-6 mb-3 module-free-paid-field" style="{{ old('free_or_paid', $course->free_or_paid) === 'paid' ? '' : 'display:none;' }}">
                                <label class="form-label">Free / Paid</label>
                                <select name="modules[existing_{{ $module->id }}][free_paid]"
                                    class="form-control module-modal-free-paid" data-module-id="{{ $module->id }}">
                                    <option value="">Select Option</option>
                                    <option value="free" {{ old('modules.existing_' . $module->id . '.free_paid', $module->free_paid) === 'free' ? 'selected' : '' }}>Free</option>
                                    <option value="paid" {{ old('modules.existing_' . $module->id . '.free_paid', $module->free_paid) === 'paid' ? 'selected' : '' }}>Paid</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary save-module-popup" data-module-id="{{ $module->id }}">Save</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    @push('backend_script')
        @include('backend.pages.common.script')
        <script>
            $(document).ready(function() {
                function generateLessonRef() {
                    return 'lesson_' + Date.now() + '_' + Math.floor(Math.random() * 100000);
                }

                function escapeHtml(text) {
                    return $('<div>').text(text).html();
                }

                window.showPopupToastr = function(type, message) {
                    toastr.options = {
                        "closeButton": true,
                        "progressBar": true
                    };

                    if (typeof toastr[type] === 'function') {
                        toastr[type](message);
                    }
                };

                function getYoutubeThumbnail(link) {
                    if (!link) {
                        return 'https://placehold.co/640x360/e5e7eb/6b7280?text=Module+Preview';
                    }

                    var match = link.match(/(?:youtube\.com\/watch\?v=|youtu\.be\/|youtube\.com\/embed\/)([^&\n?#]+)/);
                    if (match && match[1]) {
                        return 'https://img.youtube.com/vi/' + match[1] + '/hqdefault.jpg';
                    }

                    return 'https://placehold.co/640x360/e5e7eb/6b7280?text=Module+Preview';
                }

                function getYoutubeVideoId(link) {
                    if (!link) {
                        return '';
                    }

                    var match = link.match(/(?:youtube\.com\/watch\?v=|youtu\.be\/|youtube\.com\/embed\/)([^&\n?#]+)/);
                    return match && match[1] ? match[1] : '';
                }

                function getYoutubeEmbedUrl(link) {
                    var videoId = getYoutubeVideoId(link);
                    return videoId ? 'https://www.youtube.com/embed/' + videoId + '?autoplay=1&rel=0' : '';
                }

                function getLessonOptionsHtml(selectedValue) {
                    var options = '<option value="">Select Lesson</option>';
                    var rowOverrides = {};

                    $('#multipleLessonFields .lesson-row').each(function() {
                        var lessonId = $(this).find('.lesson-id').val();

                        if (lessonId) {
                            rowOverrides['existing:' + lessonId] = true;
                        }
                    });

                    $('.existing-lesson-item').each(function() {
                        var lessonId = $(this).data('lesson-id');
                        var lessonName = $(this).data('lesson-name');
                        var optionValue = 'existing:' + lessonId;

                        if (rowOverrides[optionValue]) {
                            return;
                        }

                        var selected = optionValue === selectedValue ? 'selected' : '';
                        options += `<option value="${optionValue}" ${selected}>${escapeHtml(lessonName)}</option>`;
                    });

                    $('#multipleLessonFields .lesson-row').each(function() {
                        var lessonRef = $(this).find('.lesson-ref').val();
                        var lessonName = $(this).find('.lesson-name').val().trim();

                        if (lessonRef && lessonName) {
                            var optionValue = 'new:' + lessonRef;
                            var selected = optionValue === selectedValue ? 'selected' : '';
                            options += `<option value="${optionValue}" ${selected}>${escapeHtml(lessonName)}</option>`;
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
                            <input type="hidden" name="lessons[${fieldCount}][id]" class="lesson-id" value="" />
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

                $(document).on('click', '.edit-lesson', function() {
                    var lessonId = $(this).data('id');
                    var modalElement = document.getElementById('lessonEditModal' + lessonId);

                    if (modalElement) {
                        bootstrap.Modal.getOrCreateInstance(modalElement).show();
                    }
                });

                $(document).on('click', '.save-lesson-popup', function() {
                    var lessonId = $(this).data('lesson-id');
                    var modalElement = document.getElementById('lessonEditModal' + lessonId);
                    var lessonName = $('#lesson_name_' + lessonId).val();

                    if (!lessonName || !lessonName.trim()) {
                        showPopupToastr('warning', 'Lesson name is required.');
                        return;
                    }

                    $.ajax({
                        url: "{{ route('course.lesson.update.ajax', ':id') }}".replace(':id', lessonId),
                        type: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}",
                            name: lessonName
                        },
                        success: function(response) {
                            $('#course-lesson-' + lessonId).attr('data-lesson-name', response.lesson.name);
                            $('#course-lesson-' + lessonId).find('span').first().text(response.lesson.name);
                            refreshModuleLessonOptions();
                            showPopupToastr('success', response.success);

                            if (modalElement) {
                                bootstrap.Modal.getOrCreateInstance(modalElement).hide();
                            }
                        },
                        error: function(xhr) {
                            var message = 'Something went wrong. Please try again.';
                            if (xhr.responseJSON && xhr.responseJSON.errors && xhr.responseJSON.errors.name) {
                                message = xhr.responseJSON.errors.name[0];
                            }
                            showPopupToastr('error', message);
                        }
                    });
                });

                function togglePricingFields() {
                    if ($('#free_or_paid').val() === 'paid') {
                        $('.price-fields').show();
                        $('#price').attr('required', true);
                    } else {
                        $('.price-fields').hide();
                        $('#price').removeAttr('required');
                        $('#price').val('');
                        $('#discount').val('');
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
                $('#live_or_record').on('change', toggleLiveFields);
                togglePricingFields();
                toggleLiveFields();
                toggleModuleFreePaidFields();

                function initSummernote(container) {
                    var $targets = container ? $(container).find('textarea[data-summernote]') : $('textarea[data-summernote]');
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

                $(document).on('change', '.module-modal-module-type', function() {
                    var modalBody = $(this).closest('.modal-body');
                    var type = $(this).val() || 'video';
                    modalBody.find('.module-modal-content-field').each(function() {
                        var matches = $(this).data('module-type') === type;
                        $(this).toggle(matches);
                        if (matches && type === 'article') {
                            initSummernote($(this));
                        }
                    });
                });

                $(document).on('click', '.addModuleField', function() {
                    var fieldCount = $('#multipleModuleFields .module-row').length;
                    var newField = `
                        <div class="border rounded p-3 mb-3 module-row" id="multipleModuleField${fieldCount}">
                            <input type="hidden" name="modules[${fieldCount}][id]" class="module-id" value="">
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

                $(document).on('click', '.edit-module', function() {
                    var moduleId = $(this).data('id');
                    var modalElement = document.getElementById('moduleEditModal' + moduleId);

                    refreshModuleLessonOptions();

                    if (modalElement) {
                        bootstrap.Modal.getOrCreateInstance(modalElement).show();
                        $(modalElement).find('.module-modal-module-type').trigger('change');
                    }
                });

                $(document).on('click', '.save-module-popup', function() {
                    var moduleId = $(this).data('module-id');
                    var modalElement = document.getElementById('moduleEditModal' + moduleId);
                    var moduleModal = $('#moduleEditModal' + moduleId);
                    var moduleCard = $('#course-module-' + moduleId);
                    var title = moduleModal.find('.module-modal-title').val();
                    var link = moduleModal.find('.module-modal-link').val();
                    var freePaid = moduleModal.find('.module-modal-free-paid').val();
                    var liveRecord = moduleModal.find('.module-modal-live-record').val();
                    var date = moduleModal.find('.module-modal-date').siblings('input[type="hidden"]').val();
                    var time = moduleModal.find('.module-modal-time').val();
                    var lessonRef = moduleModal.find('.module-modal-lesson').val();
                    var lessonId = lessonRef && lessonRef.startsWith('existing:') ? lessonRef.replace('existing:', '') : '';
                    var moduleType = moduleModal.find('.module-modal-module-type').val();
                    var duration = moduleModal.find('.module-modal-duration').val();
                    var articleArea = moduleModal.find('.module-modal-article');
                    var article = articleArea.data('summernote-inited') ? articleArea.summernote('code') : articleArea.val();
                    var formData = new FormData();
                    var pdfInput = moduleModal.find('input[type="file"]')[0];

                    if (!title || !title.trim()) {
                        showPopupToastr('warning', 'Module title is required.');
                        return;
                    }

                    formData.append('_token', "{{ csrf_token() }}");
                    formData.append('lesson_id', lessonId);
                    formData.append('title', title);
                    formData.append('module_type', moduleType);
                    formData.append('link', link);
                    formData.append('article', article);
                    formData.append('duration', duration);
                    formData.append('free_paid', freePaid);
                    formData.append('live_record', liveRecord);
                    formData.append('date', date);
                    formData.append('time', time);

                    if (pdfInput && pdfInput.files.length > 0) {
                        formData.append('pdf_file', pdfInput.files[0]);
                    }

                    $.ajax({
                        url: "{{ route('course.module.update.ajax', ':id') }}".replace(':id', moduleId),
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            var selectedLessonText = moduleModal.find('.module-modal-lesson option:selected').text();
                            var thumbnail = getYoutubeThumbnail(response.module.link);
                            var embedUrl = getYoutubeEmbedUrl(response.module.link);
                            var videoId = getYoutubeVideoId(response.module.link);
                            moduleCard.attr('data-title', response.module.title || '');
                            moduleCard.attr('data-link', response.module.link || '');
                            moduleCard.attr('data-free-paid', response.module.free_paid || '');
                            moduleCard.attr('data-live-record', response.module.live_record || '');
                            moduleCard.attr('data-date', response.module.date || '');
                            moduleCard.attr('data-time', response.module.time || '');
                            moduleCard.attr('data-lesson-ref', lessonRef || '');
                            moduleCard.attr('data-thumbnail', thumbnail);
                            moduleCard.attr('data-video-id', videoId);

                            moduleCard.find('.module_title').first().text(response.module.title || 'Untitled Module');
                            moduleCard.find('.module-lesson-preview').first().text('Lesson: ' + (selectedLessonText && selectedLessonText !== 'Select Lesson' ? selectedLessonText : 'N/A'));
                            moduleCard.find('.module_media').html(
                                '<img src="' + thumbnail + '" alt="' + (response.module.title || 'Module Preview') + '" class="module_thumb module-thumbnail-preview">' +
                                (embedUrl ? '<button type="button" class="module_play_trigger play-module-video" data-embed-url="' + embedUrl + '"><span class="module_play_icon"><i class="fa-solid fa-play"></i></span></button>' : '')
                            );

                            if (pdfInput) {
                                pdfInput.value = '';
                            }

                            showPopupToastr('success', response.success);

                            if (modalElement) {
                                bootstrap.Modal.getOrCreateInstance(modalElement).hide();
                            }
                        },
                        error: function(xhr) {
                            var message = 'Something went wrong. Please try again.';
                            if (xhr.responseJSON && xhr.responseJSON.errors) {
                                var firstKey = Object.keys(xhr.responseJSON.errors)[0];
                                if (firstKey) {
                                    message = xhr.responseJSON.errors[firstKey][0];
                                }
                            }
                            showPopupToastr('error', message);
                        }
                    });
                });

                $(document).on('click', '.play-module-video', function() {
                    var embedUrl = $(this).data('embed-url');

                    if (!embedUrl) {
                        return;
                    }

                    $(this).closest('.module_media').html(
                        '<iframe class="module_iframe" src="' + embedUrl + '" title="YouTube video player" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>'
                    );
                });

                $(document).on('click', '.delete-lesson', function(e) {
                    e.preventDefault();

                    var lessonId = $(this).data('id');
                    var url = "{{ route('course.lesson.delete', ':id') }}";
                    url = url.replace(':id', lessonId);

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: url,
                                type: 'DELETE',
                                data: {
                                    "_token": "{{ csrf_token() }}",
                                },
                                success: function(response) {
                                    $('#course-lesson-' + lessonId).remove();
                                    $('#lessonEditModal' + lessonId).remove();
                                    $('#multipleLessonFields .lesson-row').filter(function() {
                                        return $(this).find('.lesson-id').val() == lessonId;
                                    }).remove();
                                    refreshModuleLessonOptions();
                                    Swal.fire(
                                        'Deleted!',
                                        'Your lesson has been deleted.',
                                        'success'
                                    );
                                },
                                error: function(xhr) {
                                    console.error(xhr.responseText);
                                    Swal.fire(
                                        'Error!',
                                        'Something went wrong. Please try again.',
                                        'error'
                                    );
                                }
                            });
                        }
                    });
                });

                $(document).on('click', '.delete-module', function(e) {
                    e.preventDefault();

                    var moduleId = $(this).data('id');
                    var url = "{{ route('course.module.delete', ':id') }}";
                    url = url.replace(':id', moduleId);

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: url,
                                type: 'DELETE',
                                data: {
                                    "_token": "{{ csrf_token() }}",
                                },
                                success: function(response) {
                                    $('#course-module-' + moduleId).remove();
                                    $('#moduleEditModal' + moduleId).remove();
                                    $('#multipleModuleFields .module-row').filter(function() {
                                        return $(this).find('.module-id').val() == moduleId;
                                    }).remove();
                                    Swal.fire(
                                        'Deleted!',
                                        'Your module has been deleted.',
                                        'success'
                                    );
                                },
                                error: function(xhr) {
                                    console.error(xhr.responseText);
                                    Swal.fire(
                                        'Error!',
                                        'Something went wrong. Please try again.',
                                        'error'
                                    );
                                }
                            });
                        }
                    });
                });

                refreshModuleLessonOptions();
                $('.module-row').each(function() {
                    toggleModuleContentFields($(this));
                });
                $('.module-modal-module-type').each(function() {
                    $(this).trigger('change');
                });

                $('#category_id').on('change', function() {
                    var categoryId = $(this).val();

                    if (categoryId) {
                        $.ajax({
                            url: "{{ route('course.get.subcategories', ':category_id') }}".replace(':category_id', categoryId),
                            type: "GET",
                            dataType: "json",
                            success: function(data) {
                                $('#subcategory_id').empty();
                                $('#subcategory_id').append('<option value="">Select Subcategory</option>');

                                $.each(data, function(key, value) {
                                    $('#subcategory_id').append('<option value="' + value.id + '">' + value.name + '</option>');
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

                var selectedCategoryId = $('#category_id').val();
                var selectedSubcategoryId = '{{ old('subcategory_id', $course->subcategory_id) }}';

                if (selectedCategoryId) {
                    $.ajax({
                        url: "{{ route('course.get.subcategories', ':category_id') }}".replace(':category_id', selectedCategoryId),
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('#subcategory_id').empty();
                            $('#subcategory_id').append('<option value="">Select Subcategory</option>');

                            $.each(data, function(key, value) {
                                var selected = value.id == selectedSubcategoryId ? 'selected' : '';
                                $('#subcategory_id').append('<option value="' + value.id + '" ' + selected + '>' + value.name + '</option>');
                            });

                            $('#subcategory_id').prop('disabled', false);
                        }
                    });
                }
            });
        </script>
        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        </script>

        <script>
            // ── Lessons drag-and-drop ──
            var lessonsList = document.getElementById('lessons-sortable-list');
            if (lessonsList) {
                Sortable.create(lessonsList, {
                    animation: 150,
                    handle: '.drag-handle',
                    ghostClass: 'sortable-ghost',
                    onEnd: function () {
                        var order = [];
                        lessonsList.querySelectorAll('[data-lesson-id]').forEach(function (el) {
                            order.push(el.getAttribute('data-lesson-id'));
                        });
                        $.ajax({
                            url: '{{ route("course.lessons.update_order") }}',
                            type: 'POST',
                            data: { order: order },
                            success: function () {
                                showPopupToastr('success', 'Lesson order updated successfully.');
                            },
                            error: function () {
                                Swal.fire('Error', 'Could not save lessons order.', 'error');
                            }
                        });
                    }
                });
            }

            // ── Modules drag-and-drop by lesson ──
            document.querySelectorAll('.lesson-module-grid').forEach(function (grid) {
                Sortable.create(grid, {
                    animation: 150,
                    handle: '.module_drag_handle',
                    draggable: '.module_item',
                    ghostClass: 'sortable-ghost',
                    onEnd: function () {
                        var lessonId = grid.dataset.lessonId;
                        var order = [];

                        grid.querySelectorAll('.module_item[data-module-id]').forEach(function (el) {
                            order.push(el.getAttribute('data-module-id'));
                        });

                        var data = { orders: {} };
                        data.orders[lessonId] = order;

                        $.ajax({
                            url: '{{ route("course.modules.update_order") }}',
                            type: 'POST',
                            data: data,
                            success: function () {
                                showPopupToastr('success', 'Module order updated successfully.');
                            },
                            error: function () {
                                Swal.fire('Error', 'Could not save modules order.', 'error');
                            }
                        });
                    }
                });
            });

            // ── Populate description in lesson edit modal ──
            $(document).on('click', '.edit-lesson', function () {
                var id = $(this).data('id');
                var name = $(this).data('name');
                var desc = $(this).data('description') || '';
                $('#lessonEditModal' + id + ' .lesson-modal-name').val(name);
                $('#lessonEditModal' + id + ' .lesson-modal-description').val(desc);
                $('#lessonEditModal' + id).modal('show');
            });

            // ── Save lesson from popup (send name + description via AJAX) ──
            $(document).on('click', '.save-lesson-popup', function () {
                var lessonId = $(this).data('lesson-id');
                var modal    = $('#lessonEditModal' + lessonId);
                var name     = modal.find('.lesson-modal-name').val();
                var desc     = modal.find('.lesson-modal-description').val();
                $.ajax({
                    url: '{{ route("course.lesson.update.ajax", ":id") }}'.replace(':id', lessonId),
                    type: 'POST',
                    data: { name: name, description: desc },
                    success: function (res) {
                        // Update visible lesson name in list
                        var li = $('#course-lesson-' + lessonId);
                        li.find('> span:not(.drag-handle)').text(name);
                        li.find('.edit-lesson').data('name', name).data('description', desc);
                        modal.modal('hide');
                        Swal.fire({ icon: 'success', title: 'Saved!', text: res.success, timer: 1500, showConfirmButton: false });
                    },
                    error: function () {
                        Swal.fire('Error', 'Could not update lesson.', 'error');
                    }
                });
            });
        </script>
    @endpush
@endsection
