<?php

namespace App\Http\Controllers\Trash;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use Illuminate\Http\Request;

class ExamTrashController extends Controller
{
    public function trash()
    {
        $exams = Exam::onlyTrashed()->with(['category', 'course'])->latest('id')->paginate(30);
        return view('backend.pages.exam.trash', compact('exams'));
    }

    public function restore($id)
    {
        $exam = Exam::onlyTrashed()->findOrFail($id);
        $exam->restore();
        return redirect()->back()->with('message', 'Exam Restored Successfully');
    }

    public function forceDelete($id)
    {
        $exam = Exam::onlyTrashed()->findOrFail($id);
        
        // Delete PDF file if exists
        if ($exam->pdf_file && file_exists(public_path('uploads/exams/syllabus/' . $exam->pdf_file))) {
            unlink(public_path('uploads/exams/syllabus/' . $exam->pdf_file));
        }
        
        $exam->forceDelete();
        return redirect()->back()->with('error', 'Exam Permanently Deleted');
    }
}
