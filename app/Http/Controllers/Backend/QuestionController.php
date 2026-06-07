<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index(Request $request)
    {
        $query = Question::latest('id');

        if ($request->has('type') && in_array($request->type, ['mcq', 'written'])) {
            $query->where('type', $request->type);
        }

        if ($request->has('exam_id') && $request->exam_id != '') {
            $query->whereHas('exams', function($q) use ($request) {
                $q->where('exams.id', $request->exam_id);
            });
        }

        $questions = $query->paginate(30);
        $exams = \App\Models\Exam::with('course')->latest()->get();
        return view('backend.pages.question.index', compact('questions', 'exams'));
    }

    public function create()
    {
        // return view('backend.pages.question.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:mcq,written',
            'question_text' => 'required|string',
            'mark' => 'required|numeric|min:0',
            'negative_mark' => 'nullable|numeric|min:0',
            'correct_option' => 'nullable|required_if:type,mcq|integer|min:1|max:5',
        ]);

        Question::create([
            'type' => $request->type,
            'question_text' => $request->question_text,
            'mark' => $request->mark,
            'negative_mark' => $request->negative_mark ?? 0.00,
            'option_1' => $request->type == 'mcq' ? $request->option_1 : null,
            'option_2' => $request->type == 'mcq' ? $request->option_2 : null,
            'option_3' => $request->type == 'mcq' ? $request->option_3 : null,
            'option_4' => $request->type == 'mcq' ? $request->option_4 : null,
            'option_5' => $request->type == 'mcq' ? $request->option_5 : null,
            'correct_option' => $request->type == 'mcq' ? $request->correct_option : null,
            'written_answer_guide' => $request->type == 'written' ? $request->written_answer_guide : null,
            'is_active' => 1,
        ]);

        return redirect()->route('questions.index')->with('message', 'Question Created Successfully');
    }

    public function show(string $id)
    {
        $question = Question::findOrFail($id);
        // return view('backend.pages.question.show', compact('question'));
    }

    public function edit(string $id)
    {
        $question = Question::findOrFail($id);
        return view('backend.pages.question.edit', compact('question'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'type' => 'required|in:mcq,written',
            'question_text' => 'required|string',
            'mark' => 'required|numeric|min:0',
            'negative_mark' => 'nullable|numeric|min:0',
            'correct_option' => 'nullable|required_if:type,mcq|integer|min:1|max:5',
        ]);

        $question = Question::findOrFail($id);

        $question->update([
            'type' => $request->type,
            'question_text' => $request->question_text,
            'mark' => $request->mark,
            'negative_mark' => $request->negative_mark ?? 0.00,
            'option_1' => $request->type == 'mcq' ? $request->option_1 : null,
            'option_2' => $request->type == 'mcq' ? $request->option_2 : null,
            'option_3' => $request->type == 'mcq' ? $request->option_3 : null,
            'option_4' => $request->type == 'mcq' ? $request->option_4 : null,
            'option_5' => $request->type == 'mcq' ? $request->option_5 : null,
            'correct_option' => $request->type == 'mcq' ? $request->correct_option : null,
            'written_answer_guide' => $request->type == 'written' ? $request->written_answer_guide : null,
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]);

        return redirect()->route('questions.index')->with('message', 'Question Updated Successfully');
    }

    public function destroy(string $id)
    {
        $question = Question::findOrFail($id);
        $question->delete();
        return redirect()->route('questions.index')->with('warning', 'Question Moved to Trash Successfully');
    }

    public function checkActive($id)
    {
        $question = Question::find($id);
        if ($question) {
            $question->is_active = !$question->is_active;
            $question->save();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false], 404);
    }
    public function csvImportForm()
    {
        return view('backend.pages.question.csv_upload');
    }

    public function csvImport(Request $request)
    {
        $request->validate(['csv_file' => 'required|file|mimes:csv,txt']);
        
        $file = $request->file('csv_file');
        $csvData = array_map('str_getcsv', file($file->getRealPath()));
        array_shift($csvData); // Remove header

        $successCount = 0;
        foreach ($csvData as $row) {
            $row = array_pad($row, 12, null);
            if (empty(trim($row[0]))) continue; // Skip if type is missing

            Question::create([
                'type'                 => strtolower(trim($row[0])),
                'question_text'        => $row[1],
                'mark'                 => is_numeric($row[2]) ? $row[2] : 1,
                'negative_mark'        => is_numeric($row[3]) ? $row[3] : 0,
                'option_1'             => $row[4],
                'option_2'             => $row[5],
                'option_3'             => $row[6],
                'option_4'             => $row[7],
                'option_5'             => $row[8],
                'correct_option'       => is_numeric($row[9]) ? $row[9] : null,
                'written_answer_guide' => $row[10],
                'is_active'            => isset($row[11]) && $row[11] !== '' ? (int)$row[11] : 1,
            ]);
            $successCount++;
        }

        return redirect()->route('questions.index')->with('message', "$successCount Questions imported successfully!");
    }

    public function csvSample()
    {
        $headers = [
            'type(mcq/written)', 'question_text', 'mark', 'negative_mark', 'option_1', 'option_2', 'option_3', 'option_4', 'option_5', 'correct_option(1-5)', 'written_answer_guide', 'is_active(1/0)'
        ];

        $callback = function() use ($headers) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $headers);
            fputcsv($file, ['mcq', 'What is 2+2?', '1', '0.25', '3', '4', '5', '6', '', '2', '', '1']);
            fputcsv($file, ['written', 'Explain Newton laws', '5', '0', '', '', '', '', '', '', 'It states that...', '1']);
            fclose($file);
        };

        return response()->stream($callback, 200, [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=question_sample.csv",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ]);
    }

    public function assignToExam(Request $request)
    {
        $request->validate([
            'exam_id' => 'required|exists:exams,id',
            'question_ids' => 'required|array',
            'question_ids.*' => 'exists:questions,id'
        ]);

        $exam = \App\Models\Exam::findOrFail($request->exam_id);
        
        $existingCount = \Illuminate\Support\Facades\DB::table('exam_question')
                            ->where('exam_id', $exam->id)
                            ->count();

        $attachData = [];
        $order = $existingCount + 1;
        
        $existingQuestionIds = \Illuminate\Support\Facades\DB::table('exam_question')
                                ->where('exam_id', $exam->id)
                                ->whereIn('question_id', $request->question_ids)
                                ->pluck('question_id')
                                ->toArray();

        foreach ($request->question_ids as $questionId) {
            if (!in_array($questionId, $existingQuestionIds)) {
                $attachData[$questionId] = ['order_num' => $order++];
            }
        }

        if (!empty($attachData)) {
            $exam->questions()->attach($attachData);
            return response()->json(['success' => true, 'message' => count($attachData) . ' questions successfully assigned to the exam.']);
        }

        return response()->json(['success' => false, 'message' => 'Selected questions are already assigned to this exam.']);
    }
}
