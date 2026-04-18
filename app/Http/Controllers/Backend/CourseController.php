<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Models\Subcategory;
use Illuminate\Http\Request;
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

    public function store(Request $request)
    {
        Gate::authorize('create-product');

        $request->validate([
            'category_id' => 'nullable|exists:categories,id',
            'subcategory_id' => 'nullable|exists:subcategories,id',
            'name' => 'required|string|max:255|unique:courses,name',
            'slug' => 'nullable|string|max:255|unique:courses,slug',
            'price' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:2048',
            'pdf' => 'nullable|file|mimes:pdf|max:10240',
            'description' => 'nullable|string',
            'is_active' => 'nullable|boolean',
            'live_or_record' => 'nullable|string|max:255',
            'is_offline' => 'nullable|boolean',
            'video_link' => 'nullable|string|max:1000',
        ]);

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

        $course = Course::findOrFail($id);
        $categories = Category::where('is_active', 1)->get();
        $subcategories = [];

        if ($course->category_id) {
            $subcategories = Subcategory::where('category_id', $course->category_id)
                ->where('is_active', 1)
                ->get();
        }

        return view('backend.pages.course.edit', compact('course', 'categories', 'subcategories'));
    }

    public function update(Request $request, string $id)
    {
        Gate::authorize('edit-product');

        $request->validate([
            'category_id' => 'nullable|exists:categories,id',
            'subcategory_id' => 'nullable|exists:subcategories,id',
            'name' => 'required|string|max:255|unique:courses,name,' . $id,
            'slug' => 'nullable|string|max:255|unique:courses,slug,' . $id,
            'price' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:2048',
            'pdf' => 'nullable|file|mimes:pdf|max:10240',
            'description' => 'nullable|string',
            'is_active' => 'nullable|boolean',
            'live_or_record' => 'nullable|string|max:255',
            'is_offline' => 'nullable|boolean',
            'video_link' => 'nullable|string|max:1000',
        ]);

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

        return redirect()->route('courses.index')->with('message', 'Course Updated Successfully');
    }

    public function destroy(string $id)
    {
        Gate::authorize('delete-product');

        $course = Course::findOrFail($id);
        $course->delete();

        return redirect()->back()->with('error', 'Course moved to trash successfully');
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
                Image::make($uploadedImage)->resize(750, 420)->save($newImageLocation);
            } else {
                Image::make($uploadedImage)->resize(750, 420)->save($newImageLocation, 80);
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
}
