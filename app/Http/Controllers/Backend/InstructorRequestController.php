<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\InstructorRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class InstructorRequestController extends Controller
{
    /**
     * Display a listing of instructor requests
     */
    public function index()
    {
        Gate::authorize('index-user');

        $requests = InstructorRequest::with(['user:id,name,email,phone', 'approvedBy:id,name'])
            ->orderBy('requested_at', 'desc')
            ->paginate(20);

        return view('backend.pages.instructor-requests.index', compact('requests'));
    }

    /**
     * Show details of a specific instructor request
     */
    public function show($id)
    {
        Gate::authorize('edit-user');

        $request = InstructorRequest::with(['user', 'approvedBy'])->findOrFail($id);

        return view('backend.pages.instructor-requests.show', compact('request'));
    }

    /**
     * Approve an instructor request
     */
    public function approve(Request $request, $id)
    {
        Gate::authorize('edit-user');

        $instructorRequest = InstructorRequest::findOrFail($id);

        // Update the request status
        $instructorRequest->update([
            'status' => 'approved',
            'approved_by' => Auth::user()->id,
            'approved_at' => now(),
        ]);

        // Update user role to instructor (role_id = 7)
        $instructorRequest->user->update([
            'role_id' => 7,
        ]);

        return redirect()->back()->with('message', 'Instructor request approved successfully! User role has been changed to Instructor.');
    }

    /**
     * Reject an instructor request
     */
    public function reject(Request $request, $id)
    {
        Gate::authorize('edit-user');

        $request->validate([
            'rejection_reason' => 'required|string|max:500',
        ]);

        $instructorRequest = InstructorRequest::findOrFail($id);

        // Update the request status
        $instructorRequest->update([
            'status' => 'rejected',
            'rejection_reason' => $request->rejection_reason,
        ]);

        return redirect()->back()->with('message', 'Instructor request rejected.');
    }
}
