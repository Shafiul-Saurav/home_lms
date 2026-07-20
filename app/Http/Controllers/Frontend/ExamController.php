<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Exam;
use App\Models\ExamAnswer;
use App\Models\ExamResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ExamController extends Controller
{
    public function startExam($course_id, $exam_id)
    {
        $examInfo = Exam::with(['category', 'questions'])->where('id', $exam_id)->where('is_active', 1)->first();

        if (!$examInfo) {
            return redirect()->back()->with('notification', 'Exam not found or inactive.');
        }

        if (Auth::check() && Auth::user()->profileCompletionPercentage() < 90) {
            return redirect()->back()->with('error', 'You must complete at least 90% of your profile to participate in exams.');
        }

        $course = Course::with('teachers')->findOrFail($course_id);

        // Check Enrollment Logic
        $userId = Auth::id() ?? 0;
        $isEnrolled = false;

        if ($userId) {
            $isEnrolled = DB::table('course_orders')
                ->where('course_id', $course_id)
                ->where('user_id', $userId)
                ->where(function($q) {
                    $q->where('payment_status', 'Completed')
                      ->orWhere('payment_status', 'completed')
                      ->orWhere('payment_status', 'Paid')
                      ->orWhere('payment_status', 'paid');
                })
                ->where(function($q) {
                    $q->where('status', 'Enrolled')
                      ->orWhere('status', 'enrolled');
                })
                ->exists();
        }

            if ($examInfo->free_paid == 'paid' && !$isEnrolled) {
                return redirect()->back()->with('error', 'Please enroll in this course to access this content');
        }

        // Check if user has already taken the exam
        if ($userId) {
            $existingResult = ExamResult::where('user_id', $userId)->where('exam_id', $exam_id)->first();
            if ($existingResult) {
                // In a future step, redirect to results view.
                return redirect()->back()->with('notification', 'You have already taken this exam.');
            }
        } else {
             return redirect()->route('login')->with('notification', 'Please login to take the exam.');
        }

        $questions = $examInfo->questions;

        // Timer Calculation Logic (Based on nu_study)
        date_default_timezone_set("Asia/Dhaka");
        $examType = $examInfo->temporary_permanent;
        $startStatus = 1;
        $examTime = $examInfo->exam_time ?? 0;

        if ($examType == 'temporary') {
            $startTimesec = strtotime($examInfo->date . ' ' . $examInfo->time);
            $Upnow = strtotime(date('Y-m-d, h:i:sa'));

            if ($Upnow < $startTimesec) {
                $startStatus = 0;
            } elseif ($Upnow > $startTimesec) {
                $dbexamTime = $examInfo->exam_time;
                $examDateTime_with_eTime = strtotime($examInfo->date . ' ' . $examInfo->time . ' + ' . $dbexamTime . ' minute');
                $examTime1 = $examDateTime_with_eTime - $Upnow;
                $examTime = $examTime1 / 60;

                if ($Upnow > $examDateTime_with_eTime) {
                    $startStatus = 3; // Exam time is up
                } elseif ($Upnow < $examDateTime_with_eTime) {
                    $startStatus = 1;
                }
            }
        }

        if ($examInfo->mcq_written == 'written') {
            return view('frontend.pages.exams.start_written_exam', compact('examInfo', 'course', 'questions', 'startStatus', 'examTime'));
        } else {
            return view('frontend.pages.exams.start_mcq_exam', compact('examInfo', 'course', 'questions', 'startStatus', 'examTime'));
        }
    }

    public function submitExam(Request $request, $exam_id)
    {
        $userId = Auth::id();
        $exam = Exam::with('questions')->findOrFail($exam_id);

        // Validate request
        if (!$userId) {
            return redirect()->route('login')->with('notification', 'Please login to submit exam.');
        }

        if (Auth::user()->profileCompletionPercentage() < 90) {
            return redirect()->back()->with('error', 'You must complete at least 90% of your profile to submit exams.');
        }

        // Check if exam is still available
        $existingResult = ExamResult::where('user_id', $userId)->where('exam_id', $exam_id)->first();
        if ($existingResult) {
            return redirect()->back()->with('notification', 'You have already taken this exam.');
        }

        try {
            DB::beginTransaction();

            // Create exam result record
            $examResult = ExamResult::create([
                'user_id' => $userId,
                'exam_id' => $exam_id,
                'total_score' => 0,
                'status' => $exam->mcq_written == 'mcq' ? 'completed' : 'pending_review',
                'started_at' => now(),
                'completed_at' => now(),
            ]);

            $totalScore = 0;
            $exam->questions->each(function($question) use ($request, $examResult, $exam, &$totalScore) {
                $userAnswer = $request->input('answer_' . $question->id);

                $examAnswer = ExamAnswer::create([
                    'exam_result_id' => $examResult->id,
                    'question_id' => $question->id,
                    'user_answer' => $userAnswer,
                    'is_correct' => false,
                    'awarded_mark' => 0,
                ]);

                // Auto-grade MCQ questions
                if ($exam->mcq_written == 'mcq' && $userAnswer !== null) {
                    $isCorrect = (int)$userAnswer === (int)$question->correct_option;
                    $awardedMark = $isCorrect ? $question->mark : -$question->negative_mark;

                    $examAnswer->update([
                        'is_correct' => $isCorrect,
                        'awarded_mark' => $awardedMark,
                    ]);

                    $totalScore += $awardedMark;
                }
            });

            // Update total score for MCQ exams (written exams score updated by teacher)
            if ($exam->mcq_written == 'mcq') {
                $examResult->update(['total_score' => max(0, $totalScore)]);
            }

            DB::commit();

            if ($exam->mcq_written == 'mcq') {
                return redirect()->route('user.exam.result', $examResult->id)
                    ->with('message', 'Exam submitted successfully! Your score: ' . max(0, $totalScore));
            } else {
                return redirect()->route('user.dashboard')
                    ->with('message', 'Written exam submitted successfully! Awaiting teacher review.');
            }

        } catch (\Exception $e) {
            DB::rollBack();
            // \Log::error('Exam submission error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error submitting exam. Please try again.');
        }
    }

    public function viewResult($resultId)
    {
        $result = ExamResult::with(['exam', 'answers.question', 'user'])->findOrFail($resultId);

        // Authorization: User can only view their own results
        if ($result->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        // MCQ exams can always be viewed, written exams only after grading
        if ($result->exam->mcq_written == 'written' && $result->status !== 'graded') {
            return redirect()->back()->with('notification', 'This exam is pending teacher review.');
        }

        return view('frontend.pages.exams.result', compact('result'));
    }
}
