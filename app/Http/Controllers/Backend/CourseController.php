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
use Illuminate\Http\JsonResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class CourseController extends Controller
{
    public function index()
    {
        Gate::authorize('index-product');

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
        Gate::authorize('create-product');

        $course = Course::create([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'name' => $request->name,
            'slug' => !empty($request->slug) ? $request->slug : Str::slug($request->name), // Fixed: ensure slug is generated when empty
            'price' => $request->price,
            'discount' => $request->discount,
            'image' => 'default_course.jpg',
            'pdf' => null,
            'description' => $request->description,
            'is_active' => $request->has('is_active') ? $request->is_active : 1,
            'live_or_record' => $request->live_or_record,
            'is_offline' => $request->is_offline,
            'video_link' => $request->video_link,
        ]);

        $this->imageUpload($request, $course->id);
        $this->pdfUpload($request, $course->id);
        $lessonReferenceMap = $this->upsertLessons($request, $course->id);
        $this->upsertModules($request, $course->id, $lessonReferenceMap);

        return redirect()->back()->with('message', 'Course Created Successfully');
    }

    public function show(string $id)
    {
        $course = Course::with('category', 'subcategory')->findOrFail($id);

        return view('backend.pages.course.show', compact('course'));
    }

    public function edit(string $id)
    {
        Gate::authorize('edit-product');

        $course = Course::with(['lessons', 'courseModules'])->findOrFail($id);
        $categories = Category::where('is_active', 1)->get();
        $subcategories = [];

        if ($course->category_id) {
            $subcategories = Subcategory::where('category_id', $course->category_id)
                ->where('is_active', 1)
                ->get();
        }

        return view('backend.pages.course.edit', compact('course', 'categories', 'subcategories'));
    }

    public function update(CourseUpdateRequest $request, string $id)
    {
        Gate::authorize('edit-product');

        $course = Course::findOrFail($id);

        $course->update([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'name' => $request->name,
            'slug' => $request->filled('slug') ? $request->slug : Str::slug($request->name),
            'price' => $request->price,
            'discount' => $request->discount,
            'description' => $request->description,
            'is_active' => $request->has('is_active') ? $request->is_active : 0,
            'live_or_record' => $request->live_or_record,
            'is_offline' => $request->is_offline,
            'video_link' => $request->video_link,
        ]);

        $this->imageUpload($request, $course->id);
        $this->pdfUpload($request, $course->id);
        $lessonReferenceMap = $course->lessons()
            ->pluck('id', 'id')
            ->mapWithKeys(fn ($lessonId, $key) => ['existing:' . $key => $lessonId])
            ->toArray();

        $lessonReferenceMap = array_merge($lessonReferenceMap, $this->upsertLessons($request, $course->id));

        $this->upsertModules($request, $course->id, $lessonReferenceMap);

        return redirect()->route('courses.index')->with('message', 'Course Updated Successfully');
    }

    public function destroy(string $id)
    {
        Gate::authorize('delete-product');

        $course = Course::findOrFail($id);
        $course->delete();

        return redirect()->back()->with('error', 'Course moved to trash successfully');
    }

    public function imageUpload($request, int $courseId): void
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
                Image::make($uploadedImage)->resize(750, 420)->save($newImageLocation);
            } else {
                Image::make($uploadedImage)->resize(750, 420)->save($newImageLocation, 80);
            }

            $course->update([
                'image' => $newImageName,
            ]);
        }
    }

    public function pdfUpload($request, int $courseId): void
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

    public function deleteLesson($id)
    {
        $lesson = Lesson::findOrFail($id);
        $lesson->delete();

        return response()->json(['success' => 'Lesson deleted successfully.']);
    }

    public function updateLessonAjax($id): JsonResponse
    {
        Gate::authorize('edit-product');

        request()->validate([
            'name' => 'required|string|max:255',
        ]);

        $lesson = Lesson::findOrFail($id);
        $lesson->update([
            'name' => request('name'),
        ]);

        return response()->json([
            'success' => 'Lesson updated successfully.',
            'lesson' => [
                'id' => $lesson->id,
                'name' => $lesson->name,
            ],
        ]);
    }

    public function deleteModule($id)
    {
        $module = CourseModule::findOrFail($id);

        if ($module->pdf_file) {
            $oldPdfPath = public_path('uploads/courses/modules/pdfs/' . $module->pdf_file);
            if (file_exists($oldPdfPath)) {
                unlink($oldPdfPath);
            }
        }

        $module->delete();

        return response()->json(['success' => 'Module deleted successfully.']);
    }

    public function updateModuleAjax($id): JsonResponse
    {
        Gate::authorize('edit-product');

        request()->validate([
            'lesson_id' => 'nullable|exists:lessons,id',
            'title' => 'required|string',
            'link' => 'nullable|string',
            'free_paid' => 'nullable|string|max:255',
            'live_record' => 'nullable|string|max:255',
            'pdf_file' => 'nullable|file|mimes:pdf|max:10240',
            'date' => 'nullable|string|max:255',
            'time' => 'nullable|string|max:255',
        ]);

        $module = CourseModule::findOrFail($id);

        $module->update([
            'lesson_id' => request('lesson_id') ?: null,
            'title' => request('title'),
            'link' => request('link') ?: null,
            'free_paid' => request('free_paid') ?: null,
            'live_record' => request('live_record') ?: null,
            'date' => request('date') ?: '',
            'time' => request('time') ?: '',
        ]);

        if (request()->hasFile('pdf_file')) {
            $this->replaceModulePdf(request(), $module);
        }

        return response()->json([
            'success' => 'Module updated successfully.',
            'module' => [
                'id' => $module->id,
                'title' => $module->title,
                'link' => $module->link,
                'free_paid' => $module->free_paid,
                'live_record' => $module->live_record,
                'date' => $module->date,
                'time' => $module->time,
                'lesson_id' => $module->lesson_id,
                'pdf_file' => $module->pdf_file,
                'pdf_url' => $module->pdf_file ? asset('uploads/courses/modules/pdfs/' . $module->pdf_file) : null,
            ],
        ]);
    }

    public function upsertLessons($request, int $courseId): array
    {
        $lessonReferenceMap = [];

        foreach ($request->input('lessons', []) as $lessonData) {
            $lessonId = $lessonData['id'] ?? null;
            $lessonName = trim($lessonData['name'] ?? '');
            $lessonRef = trim($lessonData['ref'] ?? '');

            if ($lessonName === '') {
                continue;
            }

            if ($lessonId) {
                $lesson = Lesson::where('course_id', $courseId)->findOrFail($lessonId);
                $lesson->update([
                    'name' => $lessonName,
                ]);
                $lessonReferenceMap['existing:' . $lesson->id] = $lesson->id;
            } else {
                $lesson = Lesson::create([
                    'course_id' => $courseId,
                    'name' => $lessonName,
                ]);
            }

            if ($lessonRef !== '' && ! $lessonId) {
                $lessonReferenceMap['new:' . $lessonRef] = $lesson->id;
            }
        }

        return $lessonReferenceMap;
    }

    public function upsertModules($request, int $courseId, array $lessonReferenceMap = []): void
    {
        foreach ($request->input('modules', []) as $moduleIndex => $moduleData) {
            $moduleId = $moduleData['id'] ?? null;
            $title = trim($moduleData['title'] ?? '');
            $link = trim($moduleData['link'] ?? '');
            $freePaid = trim($moduleData['free_paid'] ?? '');
            $liveRecord = trim($moduleData['live_record'] ?? '');
            $uploadedPdf = $request->file("modules.$moduleIndex.pdf_file");
            $date = trim($moduleData['date'] ?? '');
            $time = trim($moduleData['time'] ?? '');
            $lessonRef = trim($moduleData['lesson_ref'] ?? '');

            if ($title === '' && $link === '' && $freePaid === '' && $liveRecord === '' && ! $uploadedPdf && $date === '' && $time === '' && $lessonRef === '') {
                continue;
            }

            if ($moduleId) {
                $module = CourseModule::where('course_id', $courseId)->findOrFail($moduleId);
                $module->update([
                    'lesson_id' => $lessonReferenceMap[$lessonRef] ?? null,
                    'title' => $title,
                    'link' => $link ?: null,
                    'free_paid' => $freePaid ?: null,
                    'live_record' => $liveRecord ?: null,
                    'date' => $date,
                    'time' => $time,
                ]);
            } else {
                $module = CourseModule::create([
                    'course_id' => $courseId,
                    'lesson_id' => $lessonReferenceMap[$lessonRef] ?? null,
                    'title' => $title,
                    'link' => $link ?: null,
                    'free_paid' => $freePaid ?: null,
                    'live_record' => $liveRecord ?: null,
                    'pdf_file' => null,
                    'date' => $date,
                    'time' => $time,
                    'created_at' => now(),
                ]);
            }

            $this->modulePdfUpload($request, $module->id, $moduleIndex);
        }
    }

    public function modulePdfUpload($request, int $moduleId, int $moduleIndex): void
    {
        $module = CourseModule::findOrFail($moduleId);
        $uploadedPdf = $request->file("modules.$moduleIndex.pdf_file");

        if ($uploadedPdf instanceof UploadedFile) {
            $this->replaceModulePdf($request, $module, "modules.$moduleIndex.pdf_file");
        }
    }

    public function replaceModulePdf($request, CourseModule $module, ?string $fileKey = 'pdf_file'): void
    {
        $uploadedPdf = $request->file($fileKey);

        if (! $uploadedPdf instanceof UploadedFile) {
            return;
        }

        if ($module->pdf_file) {
            $oldPdfPath = public_path('uploads/courses/modules/pdfs/' . $module->pdf_file);
            if (file_exists($oldPdfPath)) {
                unlink($oldPdfPath);
            }
        }

        $pdfLocation = public_path('uploads/courses/modules/pdfs/');
        $newPdfName = $module->id . '_module_pdf.' . $uploadedPdf->getClientOriginalExtension();

        if (! file_exists($pdfLocation)) {
            mkdir($pdfLocation, 0755, true);
        }

        $uploadedPdf->move($pdfLocation, $newPdfName);

        $module->update([
            'pdf_file' => $newPdfName,
        ]);
    }
}
