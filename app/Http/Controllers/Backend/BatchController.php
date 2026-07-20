<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class BatchController extends Controller
{
    public function index()
    {
        // Gate::authorize('index-batch');
        $batches = Batch::orderBy('id', 'desc')->paginate(50);
        return view('backend.pages.batch.index', compact('batches'));
    }

    public function create()
    {
        // Gate::authorize('create-batch');
        return view('backend.pages.batch.create');
    }

    public function store(Request $request)
    {
        // Gate::authorize('create-batch');

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Batch::create($request->only(['name', 'description', 'is_active']));

        return redirect()->route('batches.index')->with('message', 'Batch created successfully');
    }

    public function show($id)
    {
        // Gate::authorize('index-batch');
        $batch = Batch::with(['courses'])->findOrFail($id);
        return view('backend.pages.batch.view', compact('batch'));
    }

    public function edit($id)
    {
        // Gate::authorize('edit-batch');
        $batch = Batch::with(['courses'])->findOrFail($id);
        // only show live courses for assignment
        $courses = Course::where('live_or_record', 'live')->get();
        return view('backend.pages.batch.edit', compact('batch', 'courses'));
    }

    public function update(Request $request, $id)
    {
        // Gate::authorize('edit-batch');
        $batch = Batch::findOrFail($id);
        $request->validate(['name' => 'required|string|max:255']);
        $batch->update($request->only(['name', 'description', 'is_active']));
        return redirect()->route('batches.index')->with('message', 'Batch updated');
    }

    public function destroy($id)
    {
        // Gate::authorize('delete-batch');
        $batch = Batch::findOrFail($id);
        $batch->delete();
        return redirect()->route('batches.index')->with('warning', 'Batch deleted');
    }

    public function assignCourses(Request $request, $id)
    {
        // Gate::authorize('edit-batch');
        $batch = Batch::findOrFail($id);

        $request->validate([
            'course_ids' => 'required|array',
            'course_ids.*' => 'exists:courses,id'
        ]);

        $syncData = [];
        foreach ($request->course_ids as $course_id) {
            $syncData[$course_id] = ['is_active' => true];
        }

        $batch->courses()->syncWithoutDetaching($syncData);

        return response()->json(['success' => true, 'message' => 'Courses assigned to batch successfully!']);
    }

    public function removeCourse($batch_id, $course_id)
    {
        // Gate::authorize('edit-batch');
        $batch = Batch::findOrFail($batch_id);
        $batch->courses()->detach($course_id);
        return response()->json(['success' => true, 'message' => 'Course removed from batch successfully!']);
    }

    public function checkActive($batch_id)
    {
        $batch = Batch::find($batch_id);
        if (!$batch) {
            return response()->json([
                'type' => 'error',
                'message' => 'Batch not found'
            ], 404);
        }

        $batch->is_active = $batch->is_active ? 0 : 1;
        $batch->save();

        return response()->json([
            'type' => 'success',
            'message' => 'Status Updated'
        ]);
    }
}
