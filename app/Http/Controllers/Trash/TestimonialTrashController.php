<?php

namespace App\Http\Controllers\Trash;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class TestimonialTrashController extends Controller
{
    public function trash()
    {
        Gate::authorize('delete-testimonial');
        
        $testimonials = Testimonial::onlyTrashed()->with('user')->latest('id')->paginate(10000);
        return view('backend.pages.testimonial.trash', compact('testimonials'));
    }

    public function restore(string $id)
    {
        Gate::authorize('delete-testimonial');
        
        $testimonial = Testimonial::onlyTrashed()->findOrFail($id);
        $testimonial->restore();

        return redirect()->back()->with('info', 'Testimonial Restored Successfully 🙂');

    }

    public function forceDelete(string $id)
    {
        Gate::authorize('delete-testimonial');
        
        $testimonial = Testimonial::onlyTrashed()->findOrFail($id);
        $testimonial->forceDelete();

        return redirect()->back()->with('error', 'Testimonial Deleted Permanently');

    }
}
