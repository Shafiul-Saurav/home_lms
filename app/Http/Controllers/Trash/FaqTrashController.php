<?php

namespace App\Http\Controllers\Trash;

use App\Models\Faq;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class FaqTrashController extends Controller
{
    public function trash()
    {
        Gate::authorize('delete-faq');
        
        $faqs = Faq::onlyTrashed()->latest('id')->paginate(100);
        return view('backend.pages.faq.trash', compact('faqs'));
    }

    public function restore(string $id)
    {
        Gate::authorize('delete-faq');
        
        $faq = Faq::onlyTrashed()->findOrFail($id);
        $faq->restore();

        return redirect()->back()->with('info', 'FAQ Restored Successfully 🙂');
    }

    public function forceDelete(string $id)
    {
        Gate::authorize('delete-faq');
        
        $faq = Faq::onlyTrashed()->findOrFail($id);
        $faq->forceDelete();

        return redirect()->back()->with('error', 'FAQ Deleted Permanently');
    }
}
