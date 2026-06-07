<?php

namespace App\Http\Controllers\Trash;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionTrashController extends Controller
{
    public function trash()
    {
        $questions = Question::onlyTrashed()->latest('deleted_at')->paginate(30);
        return view('backend.pages.question.trash', compact('questions'));
    }

    public function restore($id)
    {
        $question = Question::onlyTrashed()->findOrFail($id);
        $question->restore();
        return redirect()->back()->with('message', 'Question Restored Successfully');
    }

    public function forceDelete($id)
    {
        $question = Question::onlyTrashed()->findOrFail($id);
        $question->forceDelete();
        return redirect()->back()->with('message', 'Question Permanently Deleted');
    }
}
