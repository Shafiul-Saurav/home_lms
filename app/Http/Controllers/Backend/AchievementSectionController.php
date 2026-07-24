<?php

namespace App\Http\Controllers\Backend;

use App\Models\AchievementSection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class AchievementSectionController extends Controller
{
    public function index()
    {
        Gate::authorize('index-about');

        $achievementSection = AchievementSection::first();
        return view('backend.pages.achievement_section.achievement_section', compact('achievementSection'));
    }

    public function store(Request $request)
    {
        Gate::authorize('edit-about');

        $achievementSection = AchievementSection::firstOrNew();
        $achievementSection->title = $request->title;
        $achievementSection->sub_title = $request->sub_title;
        $achievementSection->description = $request->description;
        $achievementSection->save();

        return redirect()->back()->with('message', 'Achievement section updated successfully');
    }

    public function create() {}
    public function show(string $id) {}
    public function edit(string $id) {}
    public function update(Request $request, string $id) {}
    public function destroy(string $id) {}
}
