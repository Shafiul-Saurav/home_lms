<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\CourseReview;
use Illuminate\Http\Request;

class AdminReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Gate::authorize('index-course-review'); // Optional: check if you need to add this permission
        $reviews = CourseReview::with(['course', 'user'])->latest('id')->paginate(20);
        return view('backend.pages.course_review.index', compact('reviews'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Gate::authorize('update-course-review');
        $review = CourseReview::findOrFail($id);
        
        // If it's an AJAX request for status toggle
        if ($request->ajax() && $request->has('toggle_status')) {
            $review->is_approved = !$review->is_approved;
            $review->save();
            return response()->json([
                'type' => 'success',
                'message' => 'Review status updated successfully'
            ]);
        }

        // Handle regular update if needed (e.g. editing comment)
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string',
        ]);

        $review->update([
            'rating' => $request->rating,
            'comment' => $request->comment,
            'is_approved' => $request->has('is_approved') ? 1 : 0,
        ]);

        return redirect()->back()->with('message', 'Review Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Gate::authorize('delete-course-review');
        $review = CourseReview::findOrFail($id);
        $review->delete();

        return redirect()->back()->with('warning', 'Review Deleted Successfully');
    }

    /**
     * Toggle approval status via AJAX
     */
    public function toggleApproval($id)
    {
        $review = CourseReview::findOrFail($id);
        $review->is_approved = !$review->is_approved;
        $review->save();

        return response()->json([
            'type' => 'success',
            'message' => 'Status Updated'
        ]);
    }
}
