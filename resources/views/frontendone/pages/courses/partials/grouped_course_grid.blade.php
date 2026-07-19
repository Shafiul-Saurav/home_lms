@php
    $totalCourseCount = 0;
    if (!empty($groupedCourses)) {
        foreach($groupedCourses as $catId => $coursesList) {
            $totalCourseCount += $coursesList->count();
        }
    }
@endphp

@if($totalCourseCount > 0)
    @foreach($categories as $category)
        @if(!empty($groupedCourses[$category->id]) && $groupedCourses[$category->id]->count() > 0)
            <div class="mb-4">
                <h3 class="mb-3">{{ $category->name }}</h3>
                <div class="row g-4 course-grid-area p-0 p-md-3">
                    @foreach($groupedCourses[$category->id] as $course)
                        @include('frontendone.pages.courses.partials.course_filter', compact('course'))
                    @endforeach
                </div>
            </div>
        @endif
    @endforeach
@else
    <div class="alert alert-warning text-center mb-0">
        <h3 class="mb-2">No Courses Found</h3>
        <p class="mb-0">Try adjusting your search, category or price filters.</p>
    </div>
@endif
