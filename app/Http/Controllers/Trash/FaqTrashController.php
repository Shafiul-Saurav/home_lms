<?php

namespace App\Http\Controllers\Trash;

use App\Models\Faq;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FaqTrashController extends Controller
{
    public function trash()
    {
        $faqs = Faq::onlyTrashed()->latest('id')->paginate(100);
        return view('backend.pages.faq.trash', compact('faqs'));
    }

    public function restore(string $id)
    {
        $faq = Faq::onlyTrashed()->findOrFail($id);
        $faq->restore();

        return redirect()->back()->with('info', 'FAQ Restored Successfully 🙂');
    }

    public function forceDelete(string $id)
    {
        $faq = Faq::onlyTrashed()->findOrFail($id);
        $faq->forceDelete();

        return redirect()->back()->with('error', 'FAQ Deleted Permanently');
    }
}
