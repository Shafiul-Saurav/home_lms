<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\InstructorCommission;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class InstructorCommissionController extends Controller
{
    /**
     * Display a listing of the commissions.
     */
    public function index()
    {
        // Gate::authorize('index-instructor-commission');

        $commissions = InstructorCommission::with('teacher.user')->latest('id')->paginate(30);
        return view('backend.pages.commission.index', compact('commissions'));
    }

    /**
     * Show the form for creating a new commission.
     */
    public function create()
    {
        // Gate::authorize('create-instructor-commission');

        $teachers = Teacher::with('user:id,name,email')->latest('id')->get();
        return view('backend.pages.commission.create', compact('teachers'));
    }

    /**
     * Store a newly created commission in storage.
     */
    public function store(Request $request)
    {
        // Gate::authorize('create-instructor-commission');

        $validated = $this->validatedData($request);

        InstructorCommission::create($validated);

        return redirect()->route('commissions.index')->with('message', 'Commission proposal created successfully');
    }

    /**
     * Show the form for editing the specified commission.
     */
    public function edit($id)
    {
        // Gate::authorize('edit-instructor-commission');

        $commission = InstructorCommission::with('teacher.user')->findOrFail($id);
        $teachers = Teacher::with('user:id,name,email')->latest('id')->get();

        return view('backend.pages.commission.edit', compact('commission', 'teachers'));
    }

    /**
     * Update the specified commission in storage.
     */
    public function update(Request $request, $id)
    {
        // Gate::authorize('edit-instructor-commission');

        $commission = InstructorCommission::findOrFail($id);
        $validated = $this->validatedData($request, $commission->id);

        $commission->update($validated);

        return redirect()->route('commissions.index')->with('message', 'Commission updated successfully');
    }

    /**
     * Remove the specified commission from storage.
     */
    public function destroy($id)
    {
        // Gate::authorize('delete-instructor-commission');

        $commission = InstructorCommission::findOrFail($id);
        $commission->delete();

        return redirect()->back()->with('warning', 'Commission proposal deleted');
    }

    private function validatedData(Request $request, ?int $commissionId = null): array
    {
        $validated = $request->validate([
            'teacher_id' => [
                'required',
                'exists:teachers,id',
                Rule::unique('instructor_commissions')->ignore($commissionId)->whereNull('deleted_at'),
            ],
            'admin_percentage' => 'required|numeric|min:0|max:100',
            'gateway_percentage' => 'required|numeric|min:0|max:100',
            'status' => 'required|in:pending,approved,rejected',
            'negotiation_note' => 'nullable|string|max:1000',
        ]);

        if (($validated['admin_percentage'] + $validated['gateway_percentage']) > 100) {
            redirect()->back()->withInput()->withErrors([
                'gateway_percentage' => 'Admin and gateway percentages cannot be more than 100%.',
            ])->throwResponse();
        }

        return $validated;
    }
}
