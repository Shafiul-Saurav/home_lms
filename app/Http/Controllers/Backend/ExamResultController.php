<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\ExamResult;
use App\Models\ExamAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class ExamResultController extends Controller
{
    /**
     * Display all exam results
     */
    public function index(Request $request)
    {
        Gate::authorize('index-results');

        $results = ExamResult::with(['exam', 'user'])->latest('id')->get();

        return view('backend.pages.exam_results.index', compact('results'));
    }

    /**
     * Show detailed exam result
     */
    public function show($id)
    {
        Gate::authorize('index-results');

        $result = ExamResult::with(['exam', 'user', 'answers.question'])->findOrFail($id);

        return view('backend.pages.exam_results.show', compact('result'));
    }

    /**
     * Show grading form for written exam
     */
    public function grade($id)
    {
        Gate::authorize('edit-results');

        $result = ExamResult::with(['exam', 'user', 'answers.question'])->findOrFail($id);

        // Only written exams can be graded
        if ($result->exam->mcq_written !== 'written') {
            return redirect()->route('exam_results.show', $result->id)
                ->with('error', 'Only written exam results can be graded.');
        }

        // Status must be pending_review
        // if ($result->status !== 'pending_review') {
        //     return redirect()->route('exam_results.show', $result->id)
        //         ->with('error', 'This result has already been graded.');
        // }

        // Filter only written questions
        $answers = $result->answers()->with('question')
            ->whereHas('question', function($q) {
                $q->where('type', 'written');
            })
            ->get();

        return view('backend.pages.exam_results.grade', compact('result', 'answers'));
    }

    /**
     * Save grades for written exam
     */
    public function updateGrades(Request $request, $id)
    {
        Gate::authorize('edit-results');

        $request->validate([
            'marks.*' => 'required|numeric|min:0',
            'feedback.*' => 'nullable|string',
        ]);

        try {
            DB::beginTransaction();

            // Lock the result row to prevent concurrent grading
            $result = ExamResult::with('exam')->lockForUpdate()->findOrFail($id);

            if ($result->exam->mcq_written !== 'written') {
                DB::rollBack();
                return redirect()->back()->with('error', 'Only written exam results can be graded.');
            }

            // if ($result->status !== 'pending_review') {
            //     DB::rollBack();
            //     return redirect()->back()->with('error', 'This result has already been graded.');
            // }

            $totalScore = 0;
            $marks = $request->input('marks', []);
            $feedbacks = $request->input('feedback', []);

            foreach ($marks as $answerId => $mark) {
                $answer = ExamAnswer::findOrFail($answerId);

                // Validate mark doesn't exceed question mark
                $maxMark = $answer->question->mark;
                $mark = min((float)$mark, $maxMark);

                $answer->update([
                    'awarded_mark' => $mark,
                    'is_correct' => $mark > 0,
                ]);

                // Store feedback if provided
                if (!empty($feedbacks[$answerId])) {
                    $answer->update([
                        'feedback' => $feedbacks[$answerId],
                    ]);
                }

                $totalScore += $mark;
            }

            // Update result status and total score
            $result->update([
                'total_score' => $totalScore,
                'status' => 'graded',
            ]);

            DB::commit();

            return redirect()->route('exam_results.show', $result->id)
                ->with('message', 'Exam graded successfully! Total Score: ' . $totalScore);

        } catch (\Exception $e) {
            DB::rollBack();
            // \Log::error('Exam grading error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error grading exam. Please try again.');
        }
    }



    /**
     * Delete exam result
     */
    public function destroy($id)
    {
        Gate::authorize('delete-results');

        $result = ExamResult::findOrFail($id);
        $result->delete();

        return redirect()->back()->with('success', 'Exam result moved to trash successfully.');
    }



    /**
     * Get exam statistics
     */
    public function statistics($examId)
    {
        Gate::authorize('index-results');

        $exam = Exam::findOrFail($examId);
        $results = $exam->results()->get();

        if ($results->isEmpty()) {
            return redirect()->back()->with('notification', 'No results found for this exam.');
        }

        $totalStudents = $results->count();
        $averageScore = $results->avg('total_score');
        $maxScore = $results->max('total_score');
        $minScore = $results->min('total_score');
        $completedCount = $results->where('status', 'completed')->count();
        $gradedCount = $results->where('status', 'graded')->count();
        $pendingCount = $results->where('status', 'pending_review')->count();

        return view('backend.pages.exam_results.statistics', compact(
            'exam',
            'totalStudents',
            'averageScore',
            'maxScore',
            'minScore',
            'completedCount',
            'gradedCount',
            'pendingCount',
            'results'
        ));
    }
}
