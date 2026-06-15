<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AwardStoreRequest;
use App\Http\Requests\AwardUpdateRequest;
use App\Models\Award;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AwardController extends Controller
{
    public function index()
    {
        $awards = Award::whereNull('deleted_at')->latest('id')->paginate(50);
        return view('backend.pages.award.award', compact('awards'));
    }

    public function create()
    {
        return redirect()->route('awards.index');
    }

    public function store(AwardStoreRequest $request)
    {
        $award = Award::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'year' => $request->year,
            'file' => null,
            'is_active' => $request->has('is_active') ? $request->is_active : 1,
        ]);

        $this->fileUpload($request, $award->id);

        return redirect()->back()->with('message', 'Award Created Successfully');
    }

    public function show(string $id)
    {
        $award = Award::findOrFail($id);
        return view('backend.pages.award.show', compact('award'));
    }

    public function edit(string $id)
    {
        $award = Award::findOrFail($id);
        return view('backend.pages.award.edit', compact('award'));
    }

    public function update(AwardUpdateRequest $request, string $id)
    {
        $award = Award::findOrFail($id);

        $award->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'year' => $request->year,
            'is_active' => $request->has('is_active') ? $request->is_active : 0,
        ]);

        $this->fileUpload($request, $award->id);

        return redirect()->back()->with('message', 'Award Updated Successfully');
    }

    public function destroy(string $id)
    {
        $award = Award::findOrFail($id);
        $award->delete();

        return redirect()->back()->with('warning', 'Award Moved to Trash Successfully');
    }

    public function fileUpload(Request $request, int $awardId): void
    {
        $award = Award::findOrFail($awardId);

        if ($request->hasFile('file')) {
            if ($award->file) {
                $oldFilePath = public_path('uploads/awards/' . $award->file);
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
            }

            $uploadLocation = public_path('uploads/awards/');
            $uploaded = $request->file('file');
            $newFileName = $award->id . '.' . $uploaded->getClientOriginalExtension();

            if (!file_exists($uploadLocation)) {
                mkdir($uploadLocation, 0755, true);
            }

            $uploaded->move($uploadLocation, $newFileName);

            $award->update(['file' => $newFileName]);
        }
    }

    public function checkActive($awardId)
    {
        $award = Award::find($awardId);

        if (! $award) {
            return response()->json(['type' => 'error', 'message' => 'Award not found'], 404);
        }

        $award->is_active = $award->is_active ? 0 : 1;
        $award->save();

        return response()->json(['type' => 'success', 'message' => 'Status Updated Successfully']);
    }
}
