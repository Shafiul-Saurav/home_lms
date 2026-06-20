<?php

namespace App\Http\Controllers\Trash;

use App\Http\Controllers\Controller;
use App\Models\ExamCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ExamCategoryTrashController extends Controller
{
    public function trash()
    {
        Gate::authorize('delete-exam-category');

        $categories = ExamCategory::onlyTrashed()->latest('id')->paginate(30);
        return view('backend.pages.exam_category.trash', compact('categories'));
    }

    public function restore($id)
    {
        Gate::authorize('delete-exam-category');

        $category = ExamCategory::onlyTrashed()->findOrFail($id);
        $category->restore();
        return redirect()->back()->with('message', 'Exam Category Restored Successfully');
    }

    public function forceDelete($id)
    {
        Gate::authorize('delete-exam-category');

        $category = ExamCategory::onlyTrashed()->findOrFail($id);
        if ($category->image && file_exists(public_path('uploads/exam_categories/' . $category->image))) {
            unlink(public_path('uploads/exam_categories/' . $category->image));
        }
        $category->forceDelete();
        return redirect()->back()->with('error', 'Exam Category Permanently Deleted');
    }
}
