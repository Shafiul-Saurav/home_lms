<?php

namespace App\Http\Controllers\Trash;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Support\Facades\Gate;

class CourseTrashController extends Controller
{
    public function trash()
    {
        Gate::authorize('delete-course');

        $courses = Course::onlyTrashed()->with('category', 'subcategory')->latest('id')->paginate(100);

        return view('backend.pages.course.trash', compact('courses'));
    }

    public function restore(string $id)
    {
        Gate::authorize('delete-course');

        $course = Course::onlyTrashed()->findOrFail($id);
        $course->restore();

        return redirect()->back()->with('info', 'Course Restored Successfully');
    }

    public function forceDelete(string $id)
    {
        Gate::authorize('delete-course');

        $course = Course::onlyTrashed()->findOrFail($id);

        if ($course->image && $course->image !== 'default_course.jpg') {
            $imagePath = public_path('uploads/courses/' . $course->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        if ($course->pdf) {
            $pdfPath = public_path('uploads/courses/pdfs/' . $course->pdf);
            if (file_exists($pdfPath)) {
                unlink($pdfPath);
            }
        }

        $course->forceDelete();

        return redirect()->back()->with('error', 'Course Permanently Deleted');
    }
}
