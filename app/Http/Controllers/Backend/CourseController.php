<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourseStoreRequest;
use App\Http\Requests\CourseUpdateRequest;
use App\Models\Category;
use App\Models\Course;
use App\Models\CourseModule;
use App\Models\Lesson;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Intervention\Image\Facades\Image;

class CourseController extends Controller
{
    public function index()
    {
        Gate::authorize('index-course');

        $courses = Course::with('category', 'subcategory')->whereNull('deleted_at')->latest('id')->paginate(100);
        $categories = Category::where('is_active', 1)->get();

        return view('backend.pages.course.course', compact('courses', 'categories'));
    }

    public function create()
    {
        return redirect()->route('courses.index');
    }

    public function store(CourseStoreRequest $request)
    {
        Gate::authorize('create-course');

        $course = Course::create([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'name' => $request->name,
            'slug' => $request->slug ?? preg_replace('/\s+/u', '-', trim($request->name)),
            'free_or_paid' => $request->free_or_paid,
            'price' => $request->free_or_paid === 'paid' ? $request->price : null,
            'discount' => $request->free_or_paid === 'paid' ? $request->discount : null,
            'image' => 'default_course.jpg',
            'pdf' => null,
            'description' => $request->description,
            'full_description' => $request->full_description,
            'live_schedule' => $request->live_or_record === 'live' ? $request->live_schedule : null,
            'start_date' => $request->live_or_record === 'live' ? $request->start_date : null,
            'end_date' => $request->live_or_record === 'live' ? $request->end_date : null,
            'max_student' => $request->live_or_record === 'live' ? $request->max_student : null,
            'meeting_link' => $request->live_or_record === 'live' ? $request->meeting_link : null,
            'button_type' => $request->button_type,
            'learning_outcomes' => $request->learning_outcomes,
            'requirement' => $request->requirement,
            'tags' => $request->tags,
            'is_active' => $request->has('is_active') ? $request->is_active : 1,
            'live_or_record' => $request->live_or_record,
            'is_offline' => $request->is_offline,
            'video_link' => $request->video_link,
        ]);

        $this->imageUpload($request, $course->id);
        $this->pdfUpload($request, $course->id);

        // Store lessons and modules
        $this->storeLessons($request, $course->id);
        $this->storeModules($request, $course->id);

        return redirect()->back()->with('message', 'Course Created Successfully');
    }

    public function show(string $id)
    {
        $course = Course::with('category', 'subcategory')->findOrFail($id);

        return view('backend.pages.course.show', compact('course'));
    }

    public function edit(string $id)
    {
        Gate::authorize('edit-course');

        $course = Course::findOrFail($id);
        $categories = Category::where('is_active', 1)->get();
        $subcategories = [];

        if ($course->category_id) {
            $subcategories = Subcategory::where('category_id', $course->category_id)
                ->where('is_active', 1)
                ->get();
        }

        // Load lessons and modules for the form
        $lessons = $course->lessons()->orderBy('sort_order', 'asc')->orderBy('id', 'asc')->get(['id', 'name', 'description'])->map(function ($lesson) {
            return [
                'id' => $lesson->id,
                'ref' => 'existing:' . $lesson->id,
                'name' => $lesson->name,
                'description' => $lesson->description,
            ];
        })->toArray();

        $modules = $course->courseModules()->orderBy('sort_order', 'asc')->orderBy('id', 'asc')->get()->map(function ($module) {
            return [
                'id' => $module->id,
                'lesson_ref' => $module->lesson_id ? 'existing:' . $module->lesson_id : '',
                'title' => $module->title,
                'link' => $module->link,
                'free_paid' => $module->free_paid,
                'live_record' => $module->live_record,
                'pdf_file' => $module->pdf_file,
                'date' => $module->date,
                'time' => $module->time,
            ];
        })->toArray();

        return view('backend.pages.course.edit', compact('course', 'categories', 'subcategories', 'lessons', 'modules'));
    }

    public function update(CourseUpdateRequest $request, string $id)
    {
        Gate::authorize('edit-course');

        $course = Course::findOrFail($id);

        $course->update([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'name' => $request->name,
            'slug' => $request->filled('slug') ? $request->slug : preg_replace('/\s+/u', '-', trim($request->name)),
            'free_or_paid' => $request->free_or_paid,
            'price' => $request->free_or_paid === 'paid' ? $request->price : null,
            'discount' => $request->free_or_paid === 'paid' ? $request->discount : null,
            'description' => $request->description,
            'full_description' => $request->full_description,
            'live_schedule' => $request->live_or_record === 'live' ? $request->live_schedule : null,
            'start_date' => $request->live_or_record === 'live' ? $request->start_date : null,
            'end_date' => $request->live_or_record === 'live' ? $request->end_date : null,
            'max_student' => $request->live_or_record === 'live' ? $request->max_student : null,
            'meeting_link' => $request->live_or_record === 'live' ? $request->meeting_link : null,
            'button_type' => $request->button_type,
            'learning_outcomes' => $request->learning_outcomes,
            'requirement' => $request->requirement,
            'tags' => $request->tags,
            'is_active' => $request->has('is_active') ? $request->is_active : 0,
            'live_or_record' => $request->live_or_record,
            'is_offline' => $request->is_offline,
            'video_link' => $request->video_link,
        ]);

        $this->imageUpload($request, $course->id);
        $this->pdfUpload($request, $course->id);

        // Update lessons and modules
        $this->updateLessons($request, $course->id);
        $this->updateModules($request, $course->id);

        return redirect()->back()->with('message', 'Course Updated Successfully');
    }

    public function destroy(string $id)
    {
        Gate::authorize('delete-course');

        $course = Course::findOrFail($id);
        $course->delete();

        return redirect()->back()->with('error', 'Course Moved to Trash Successfully');
    }

    public function imageUpload(Request $request, int $courseId): void
    {
        $course = Course::findOrFail($courseId);

        if ($request->hasFile('image')) {
            if ($course->image && $course->image !== 'default_course.jpg') {
                $oldImagePath = public_path('uploads/courses/' . $course->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $imageLocation = public_path('uploads/courses/');
            $uploadedImage = $request->file('image');
            $newImageName = $course->id . '.' . $uploadedImage->getClientOriginalExtension();

            if (!file_exists($imageLocation)) {
                mkdir($imageLocation, 0755, true);
            }

            $newImageLocation = $imageLocation . $newImageName;

            if ($uploadedImage->getClientOriginalExtension() === 'webp') {
                Image::make($uploadedImage)->resize(600, 450)->save($newImageLocation);
            } else {
                Image::make($uploadedImage)->resize(600, 450)->save($newImageLocation, 80);
            }

            $course->update([
                'image' => $newImageName,
            ]);
        }
    }

    public function pdfUpload(Request $request, int $courseId): void
    {
        $course = Course::findOrFail($courseId);

        if ($request->hasFile('pdf')) {
            if ($course->pdf) {
                $oldPdfPath = public_path('uploads/courses/pdfs/' . $course->pdf);
                if (file_exists($oldPdfPath)) {
                    unlink($oldPdfPath);
                }
            }

            $pdfLocation = public_path('uploads/courses/pdfs/');
            $uploadedPdf = $request->file('pdf');
            $newPdfName = $course->id . '_course_pdf.' . $uploadedPdf->getClientOriginalExtension();

            if (!file_exists($pdfLocation)) {
                mkdir($pdfLocation, 0755, true);
            }

            $uploadedPdf->move($pdfLocation, $newPdfName);

            $course->update([
                'pdf' => $newPdfName,
            ]);
        }
    }

    public function modulePdfUpload(Request $request, int $moduleId, $moduleIndex = null): void
    {
        $module = CourseModule::findOrFail($moduleId);

        // Check for file using module index if provided (for bulk operations)
        $pdfFile = null;
        if ($moduleIndex !== null && $request->hasFile("modules.$moduleIndex.pdf_file")) {
            $pdfFile = $request->file("modules.$moduleIndex.pdf_file");
        } elseif ($request->hasFile('pdf_file')) {
            $pdfFile = $request->file('pdf_file');
        }

        if ($pdfFile) {
            if ($module->pdf_file) {
                $oldPdfPath = public_path('uploads/courses/modules/pdfs/' . $module->pdf_file);
                if (file_exists($oldPdfPath)) {
                    unlink($oldPdfPath);
                }
            }

            $pdfLocation = public_path('uploads/courses/modules/pdfs/');
            $newPdfName = $module->id . '_module_pdf.' . $pdfFile->getClientOriginalExtension();

            if (!file_exists($pdfLocation)) {
                mkdir($pdfLocation, 0755, true);
            }

            $pdfFile->move($pdfLocation, $newPdfName);

            $module->update([
                'pdf_file' => $newPdfName,
            ]);
        }
    }

    public function getSubcategories($categoryId)
    {
        $subcategories = Subcategory::where('category_id', $categoryId)
            ->where('is_active', 1)
            ->select('id', 'name')
            ->get();

        return response()->json($subcategories);
    }

    public function checkActive($courseId)
    {
        $course = Course::find($courseId);

        if (! $course) {
            return response()->json([
                'type' => 'error',
                'message' => 'Course not found',
            ], 404);
        }

        $course->is_active = $course->is_active ? 0 : 1;
        $course->save();

        return response()->json([
            'type' => 'success',
            'message' => 'Status Updated Successfully',
        ]);
    }

    public function storeLessons(Request $request, int $courseId): array
    {
        $lessonRefMap = [];

        if ($request->has('lessons') && is_array($request->lessons)) {
            foreach ($request->lessons as $lessonData) {
                if (isset($lessonData['name']) && !empty(trim($lessonData['name']))) {
                    $lesson = Lesson::create([
                        'course_id' => $courseId,
                        'name' => $lessonData['name'],
                        'description' => $lessonData['description'] ?? null,
                    ]);
                    if (isset($lessonData['ref'])) {
                        $lessonRefMap[$lessonData['ref']] = $lesson->id;
                    }
                }
            }
        }

        return $lessonRefMap;
    }

    public function storeModules(Request $request, int $courseId): void
    {
        // Get lesson refs map from existing lessons
        $lessonRefMap = [];
        $lessons = Lesson::where('course_id', $courseId)->get();
        foreach ($lessons as $lesson) {
            $lessonRefMap['existing:' . $lesson->id] = $lesson->id;
        }

        if ($request->has('modules') && is_array($request->modules)) {
            foreach ($request->modules as $moduleIndex => $moduleData) {
                if (isset($moduleData['title']) && !empty(trim($moduleData['title']))) {
                    $lessonId = null;

                    if (isset($moduleData['lesson_ref']) && !empty($moduleData['lesson_ref'])) {
                        $lessonRef = $moduleData['lesson_ref'];
                        if (strpos($lessonRef, 'new:') === 0) {
                            $ref = substr($lessonRef, 4);
                            $lessonId = $lessonRefMap[$ref] ?? null;
                        } else if (strpos($lessonRef, 'existing:') === 0) {
                            $lessonId = substr($lessonRef, 9);
                        } else if (!empty($lessonRef)) {
                            $lessonId = $lessonRef;
                        }
                    }

                    $module = CourseModule::create([
                        'course_id' => $courseId,
                        'lesson_id' => $lessonId,
                        'title' => $moduleData['title'],
                        'link' => $moduleData['link'] ?? null,
                        'free_paid' => $moduleData['free_paid'] ?? null,
                        'live_record' => $moduleData['live_record'] ?? null,
                        'date' => $moduleData['date'] ?? null,
                        'time' => $moduleData['time'] ?? null,
                    ]);

                    // Handle PDF upload for this module
                    $this->modulePdfUpload($request, $module->id, $moduleIndex);
                }
            }
        }
    }

    public function updateLessons(Request $request, int $courseId): array
    {
        $lessonRefMap = [];

        if ($request->has('lessons') && is_array($request->lessons)) {
            foreach ($request->lessons as $lessonData) {
                if (isset($lessonData['name']) && !empty(trim($lessonData['name']))) {
                    if (!empty($lessonData['id'])) {
                        // Update existing lesson
                        $lesson = Lesson::find($lessonData['id']);
                        if ($lesson) {
                            $lesson->update([
                                'name' => $lessonData['name'],
                                'description' => $lessonData['description'] ?? null,
                            ]);
                            $lessonRefMap[$lessonData['ref'] ?? $lessonData['id']] = $lesson->id;
                        }
                    } else {
                        // Create new lesson
                        $lesson = Lesson::create([
                            'course_id' => $courseId,
                            'name' => $lessonData['name'],
                            'description' => $lessonData['description'] ?? null,
                        ]);
                        if (isset($lessonData['ref'])) {
                            $lessonRefMap[$lessonData['ref']] = $lesson->id;
                        }
                    }
                }
            }
        }

        return $lessonRefMap;
    }

    public function updateModules(Request $request, int $courseId): void
    {
        $lessonRefMap = [];

        // First get all lesson refs
        $lessons = Lesson::where('course_id', $courseId)->get();
        foreach ($lessons as $lesson) {
            $lessonRefMap['existing:' . $lesson->id] = $lesson->id;
        }

        if ($request->has('modules') && is_array($request->modules)) {
            foreach ($request->modules as $moduleIndex => $moduleData) {
                if (isset($moduleData['title']) && !empty(trim($moduleData['title']))) {
                    $lessonId = null;

                    if (isset($moduleData['lesson_ref']) && !empty($moduleData['lesson_ref'])) {
                        $lessonRef = $moduleData['lesson_ref'];
                        if (strpos($lessonRef, 'new:') === 0) {
                            $ref = substr($lessonRef, 4);
                            $lessonId = $lessonRefMap[$ref] ?? null;
                        } else if (strpos($lessonRef, 'existing:') === 0) {
                            $lessonId = substr($lessonRef, 9);
                        } else if (!empty($lessonRef)) {
                            $lessonId = $lessonRef;
                        }
                    }

                    if (!empty($moduleData['id'])) {
                        // Update existing module
                        $module = CourseModule::find($moduleData['id']);
                        if ($module) {
                            $module->update([
                                'lesson_id' => $lessonId,
                                'title' => $moduleData['title'],
                                'link' => $moduleData['link'] ?? null,
                                'free_paid' => $moduleData['free_paid'] ?? null,
                                'live_record' => $moduleData['live_record'] ?? null,
                                'date' => $moduleData['date'] ?? null,
                                'time' => $moduleData['time'] ?? null,
                            ]);

                            // Handle PDF upload for this module
                            $this->modulePdfUpload($request, $module->id, $moduleIndex);
                        }
                    } else {
                        // Create new module
                        $module = CourseModule::create([
                            'course_id' => $courseId,
                            'lesson_id' => $lessonId,
                            'title' => $moduleData['title'],
                            'link' => $moduleData['link'] ?? null,
                            'free_paid' => $moduleData['free_paid'] ?? null,
                            'live_record' => $moduleData['live_record'] ?? null,
                            'date' => $moduleData['date'] ?? null,
                            'time' => $moduleData['time'] ?? null,
                        ]);

                        // Handle PDF upload for this module
                        $this->modulePdfUpload($request, $module->id, $moduleIndex);
                    }
                }
            }
        }
    }

    public function deleteLesson(string $id)
    {
        Gate::authorize('edit-course');

        $lesson = Lesson::findOrFail($id);
        $lesson->delete();

        return response()->json([
            'type' => 'success',
            'message' => 'Lesson moved to trash successfully',
        ]);
    }

    public function updateLessonAjax(Request $request, string $id)
    {
        Gate::authorize('edit-course');

        $lesson = Lesson::findOrFail($id);
        $lesson->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return response()->json([
            'success' => 'Lesson updated successfully',
            'lesson' => $lesson,
        ]);
    }

    public function deleteModule(string $id)
    {
        Gate::authorize('edit-course');

        $module = CourseModule::findOrFail($id);
        $module->delete();

        return response()->json([
            'type' => 'success',
            'message' => 'Module moved to trash successfully',
        ]);
    }

    public function updateModuleAjax(Request $request, string $id)
    {
        Gate::authorize('edit-course');

        $module = CourseModule::findOrFail($id);
        $module->update([
            'lesson_id' => $request->lesson_id,
            'title' => $request->title,
            'link' => $request->link,
            'free_paid' => $request->free_paid,
            'live_record' => $request->live_record,
            'date' => $request->date,
            'time' => $request->time,
        ]);

        // Handle PDF upload
        $this->modulePdfUpload($request, $module->id);

        // Refresh module data to get updated pdf_file
        $module->refresh();

        return response()->json([
            'success' => 'Module updated successfully',
            'module' => $module,
        ]);
    }

    public function updateLessonsOrder(Request $request)
    {
        $validated = $request->validate([
            'order'   => 'required|array',
            'order.*' => 'integer|exists:lessons,id',
        ]);

        foreach ($validated['order'] as $sortOrder => $id) {
            Lesson::where('id', $id)->update(['sort_order' => $sortOrder + 1]);
        }

        return response()->json(['type' => 'success', 'message' => 'Lessons Order Updated']);
    }

    public function updateModulesOrder(Request $request)
    {
        $validated = $request->validate([
            'order'   => 'required|array',
            'order.*' => 'integer|exists:course_modules,id',
        ]);

        foreach ($validated['order'] as $sortOrder => $id) {
            CourseModule::where('id', $id)->update(['sort_order' => $sortOrder + 1]);
        }

        return response()->json(['type' => 'success', 'message' => 'Modules Order Updated']);
    }
}

