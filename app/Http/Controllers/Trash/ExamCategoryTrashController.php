<?php

namespace App\Http\Controllers\Trash;

use App\Http\Controllers\Controller;
use App\Models\ExamCategory;
use Illuminate\Http\Request;

class ExamCategoryTrashController extends Controller
{
    public function trash()
    {
        $categories = ExamCategory::onlyTrashed()->latest('id')->paginate(30);
        return view('backend.pages.exam_category.trash', compact('categories'));
    }

    public function restore($id)
    {
        $category = ExamCategory::onlyTrashed()->findOrFail($id);
        $category->restore();
        return redirect()->back()->with('message', 'Exam Category Restored Successfully');
    }

    public function forceDelete($id)
    {
        $category = ExamCategory::onlyTrashed()->findOrFail($id);
        if ($category->image && file_exists(public_path('uploads/exam_categories/' . $category->image))) {
            unlink(public_path('uploads/exam_categories/' . $category->image));
        }
        $category->forceDelete();
        return redirect()->back()->with('error', 'Exam Category Permanently Deleted');
    }
}
