<?php

namespace App\Http\Controllers\Trash;

use App\Http\Controllers\Controller;
use App\Models\Award;
use Illuminate\Support\Facades\Gate;

class AwardTrashController extends Controller
{
    public function trash()
    {
        Gate::authorize('delete-award');

        $awards = Award::onlyTrashed()->latest('id')->paginate(50);

        return view('backend.pages.award.trash', compact('awards'));
    }

    public function restore($id)
    {
        Gate::authorize('delete-award');

        $award = Award::onlyTrashed()->findOrFail($id);
        $award->restore();

        return redirect()->back()->with('message', 'Award restored successfully');
    }

    public function forceDelete($id)
    {
        Gate::authorize('delete-award');

        $award = Award::onlyTrashed()->findOrFail($id);

        if ($award->file) {
            $filePath = public_path('uploads/awards/' . $award->file);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        $award->forceDelete();

        return redirect()->back()->with('error', 'Award permanently deleted');
    }
}
