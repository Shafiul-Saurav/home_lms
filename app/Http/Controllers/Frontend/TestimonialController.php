<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TestimonialController extends Controller
{
    public function testimonialView()
    {
        return view('frontend.pages.review.review');
    }

    public function testimonialStore(Request $request)
    {
        // dd($request->all());

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
