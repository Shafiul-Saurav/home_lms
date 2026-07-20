<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\InstructorRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InstructorRequestController extends Controller
{
    /**
     * Store a new instructor request
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        // Check if user profile is 100% complete
        if ($user->profileCompletionPercentage() < 100) {
            return response()->json([
                'type' => 'error',
                'message' => 'Please complete your profile 100% before requesting to become an instructor.'
            ], 422);
        }

        // Check if user already has a pending request
        $existingRequest = InstructorRequest::where('user_id', $user->id)
            ->whereIn('status', ['pending', 'approved'])
            ->first();

        if ($existingRequest) {
            return response()->json([
                'type' => 'error',
                'message' => 'You already have an active instructor request.'
            ], 422);
        }

        // Validate input
        $validated = $request->validate([
            'bio' => 'required|string|min:50|max:1000',
            'qualification' => 'required|string|min:20|max:500',
        ]);

        // Create instructor request
        InstructorRequest::create([
            'user_id' => $user->id,
            'bio' => $validated['bio'],
            'qualification' => $validated['qualification'],
            'status' => 'pending',
        ]);

        return response()->json([
            'type' => 'success',
            'message' => 'Your request to become an instructor has been submitted. Our admin will review your request soon.'
        ]);
    }

    /**
     * Cancel the instructor request
     */
    public function cancel(Request $request)
    {
        $user = Auth::user();

        $instructorRequest = InstructorRequest::where('user_id', $user->id)
            ->where('status', 'pending')
            ->first();

        if (!$instructorRequest) {
            return response()->json([
                'type' => 'error',
                'message' => 'No pending request found.'
            ], 404);
        }

        $instructorRequest->delete();

        return response()->json([
            'type' => 'success',
            'message' => 'Your instructor request has been cancelled.'
        ]);
    }
}
