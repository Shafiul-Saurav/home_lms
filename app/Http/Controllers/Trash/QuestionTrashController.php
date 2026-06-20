<?php

namespace App\Http\Controllers\Trash;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class QuestionTrashController extends Controller
{
    public function trash()
    {
        Gate::authorize('delete-question');

        $questions = Question::onlyTrashed()->latest('deleted_at')->paginate(30);
        return view('backend.pages.question.trash', compact('questions'));
    }

    public function restore($id)
    {
        Gate::authorize('delete-question');

        $question = Question::onlyTrashed()->findOrFail($id);
        $question->restore();
        return redirect()->back()->with('message', 'Question Restored Successfully');
    }

    public function forceDelete($id)
    {
        Gate::authorize('delete-question');

        $question = Question::onlyTrashed()->findOrFail($id);
        $question->forceDelete();
        return redirect()->back()->with('message', 'Question Permanently Deleted');
    }
}
