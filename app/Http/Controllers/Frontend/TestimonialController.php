<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TestimonialStoreRequest;
use Illuminate\Support\Facades\Auth;

class TestimonialController extends Controller
{
    public function testimonialView()
    {
        return view('frontend.pages.review.review');
    }

    public function testimonialStore(TestimonialStoreRequest $request)
    {
        // Support AJAX submission similar to course reviews
        if (request()->ajax()) {
            if (!Auth::check()) {
                return response()->json(['error' => 'Please login to give a review.'], 401);
            }

            $data = request()->validate([
                'rating' => 'required|integer|min:1|max:5',
                // Match FormRequest / DB limit
                'review' => 'required|string|max:255',
                'short_description' => 'nullable|string|max:255',
            ]);

            if (Auth::user()->testimonial) {
                return response()->json(['error' => 'You have already given a testimonial.'], 400);
            }

            $testimonial = Testimonial::create([
                'user_id' => Auth::id(),
                'rating' => $data['rating'],
                'review' => $data['review'],
                'short_description' => $data['short_description'] ?? null,
                'is_active' => false,
            ]);

            return response()->json([
                'success' => 'Thank you for your review!',
                'testimonial' => view('frontend.pages.widgets.partials.testimonial_item', compact('testimonial'))->render(),
            ]);
        }

        // Fallback for non-AJAX form submissions (existing behavior)
        if(Auth::user()->testimonial == null) {
            Testimonial::create([
                'user_id' => Auth::user()->id,
                'rating' => $request->rating,
                'review' => $request->review,
                'short_description' => $request->short_description,
            ]);
            return redirect()->back()->with('message', 'Thank You For Your Valuable Review 🙂');
        }

        return redirect()->back()->with('error', 'Sorry You Have Already Given a Review');
    }
}
