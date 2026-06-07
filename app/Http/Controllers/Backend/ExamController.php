<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\ExamCategory;
use App\Models\Course;
use App\Http\Requests\ExamStoreRequest;
use App\Http\Requests\ExamUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ExamController extends Controller
{
    public function index()
    {
        $exams = Exam::with(['category', 'course', 'questions'])->latest('id')->paginate(30);
        $categories = ExamCategory::where('is_active', 1)->get();
        $courses = Course::where('is_active', 1)->get();
        return view('backend.pages.exam.index', compact('exams', 'categories', 'courses'));
    }

    public function create()
    {
        // $categories = ExamCategory::where('is_active', 1)->get();
        // $courses = Course::where('is_active', 1)->get();
        // return view('backend.pages.exam.create', compact('categories', 'courses'));
    }

    public function store(ExamStoreRequest $request)
    {
        $fileName = null;
        if ($request->hasFile('pdf_file')) {
            $file = $request->file('pdf_file');
            $fileName = Str::slug($request->name, '_') . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/exams/syllabus'), $fileName);
        }

        Exam::create([
            'category_id' => $request->category_id,
            'course_id' => $request->course_id,
            'mcq_written' => $request->mcq_written,
            'price' => $request->price,
            'discount' => $request->discount ?? 0,
            'free_paid' => $request->free_paid,
            'name' => $request->name,
            'slug' => $request->slug ?? preg_replace('/\s+/u', '-', trim($request->name)),
            'temporary_permanent' => $request->temporary_permanent,
            'date' => $request->date,
            'time' => $request->time,
            'exam_time' => $request->exam_time,
            'pdf_file' => $fileName,
            'written_paragraph' => $request->written_paragraph,
            'is_active' => 1,
        ]);

        return redirect()->route('exams.index')->with('message', 'Exam Created Successfully');
    }

    public function show(string $id)
    {
        // $exam = Exam::with(['category', 'course'])->findOrFail($id);
        // return view('backend.pages.exam.show', compact('exam'));
    }

    public function edit(string $id)
    {
        $exam = Exam::findOrFail($id);
        $categories = ExamCategory::where('is_active', 1)->get();
        $courses = Course::where('is_active', 1)->get();
        return view('backend.pages.exam.edit', compact('exam', 'categories', 'courses'));
    }

    public function update(ExamUpdateRequest $request, string $id)
    {
        $exam = Exam::findOrFail($id);

        $fileName = $exam->pdf_file;
        if ($request->hasFile('pdf_file')) {
            // Delete old file if exists
            if ($fileName && file_exists(public_path('uploads/exams/syllabus/' . $fileName))) {
                unlink(public_path('uploads/exams/syllabus/' . $fileName));
            }
            $file = $request->file('pdf_file');
            $fileName = Str::slug($request->name, '_') . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/exams/syllabus'), $fileName);
        }

        $exam->update([
            'category_id' => $request->category_id,
            'course_id' => $request->course_id,
            'mcq_written' => $request->mcq_written,
            'price' => $request->price,
            'discount' => $request->discount ?? 0,
            'free_paid' => $request->free_paid,
            'name' => $request->name,
            'slug' => $request->slug ?? preg_replace('/\s+/u', '-', trim($request->name)),
            'temporary_permanent' => $request->temporary_permanent,
            'date' => $request->date,
            'time' => $request->time,
            'exam_time' => $request->exam_time,
            'pdf_file' => $fileName,
            'written_paragraph' => $request->written_paragraph,
            'is_active' => 1,
        ]);

        return redirect()->back()->with('message', 'Exam Updated Successfully');
    }

    public function destroy(string $id)
    {
        $exam = Exam::findOrFail($id);
        $exam->delete();

        return redirect()->back()->with('warning', 'Exam Moved to Trash Successfully');
    }

    public function checkActive($id)
    {
        $exam = Exam::find($id);
        if (!$exam) {
            return response()->json(['type' => 'error', 'message' => 'Not found'], 404);
        }
        $exam->is_active = $exam->is_active ? 0 : 1;
        $exam->save();
        return response()->json(['type' => 'success', 'message' => 'Status Updated Successfully']);
    }

    public function assignedQuestions($id)
    {
        $exam = Exam::findOrFail($id);
        // Load questions paginated
        $questions = $exam->questions()->paginate(30);
        return view('backend.pages.exam.questions', compact('exam', 'questions'));
    }

    public function unassignQuestions(Request $request)
    {
        $request->validate([
            'exam_id' => 'required|exists:exams,id',
            'question_ids' => 'required|array',
            'question_ids.*' => 'exists:questions,id'
        ]);

        $exam = Exam::findOrFail($request->exam_id);
        $exam->questions()->detach($request->question_ids);

        return response()->json(['success' => true, 'message' => count($request->question_ids) . ' questions unassigned successfully.']);
    }

    public function examResults($id)
    {
        $exam = Exam::with(['results', 'results.user'])->findOrFail($id);
        $results = $exam->results()->paginate(30);

        return view('backend.pages.exam.results', compact('exam', 'results'));
    }
}
