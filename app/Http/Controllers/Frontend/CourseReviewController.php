<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CourseReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseReviewController extends Controller
{
    public function index($course_id)
    {
        $reviews = CourseReview::with('user.profile.profileImage')
            ->where('course_id', $course_id)
            ->where('is_approved', 1)
            ->latest()
            ->paginate(5);

        if (request()->ajax()) {
            return response()->json([
                'html' => view('frontend.pages.courses.partials.review_items', compact('reviews'))->render(),
                'hasMore' => $reviews->hasMorePages(),
                'nextPage' => $reviews->currentPage() + 1,
                'total' => $reviews->total()
            ]);
        }

        return $reviews;
    }

    public function store(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Please login to give a review.'], 401);
        }

        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);

        // Check if user already reviewed this course
        $existingReview = CourseReview::where('course_id', $request->course_id)
            ->where('user_id', Auth::id())
            ->first();

        if ($existingReview) {
            return response()->json(['error' => 'You have already reviewed this course.'], 400);
        }

        $review = CourseReview::create([
            'course_id' => $request->course_id,
            'user_id' => Auth::id(),
            'rating' => $request->rating,
            'comment' => $request->comment,
            'is_approved' => 1, // Default approved as per user request
        ]);

        return response()->json([
            'success' => 'Review posted successfully!',
            'review' => view('frontend.pages.courses.partials.review_items', ['reviews' => collect([$review])])->render()
        ]);
    }
}
