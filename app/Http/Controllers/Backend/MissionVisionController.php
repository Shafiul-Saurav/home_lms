<?php

namespace App\Http\Controllers\Backend;

use App\Models\MissionVision;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class MissionVisionController extends Controller
{
    public function index()
    {
        Gate::authorize('index-about');

        $missionVision = MissionVision::first();
        return view('backend.pages.mission_vision.mission_vision', compact('missionVision'));
    }

    public function store(Request $request)
    {
        Gate::authorize('edit-about');

        $missionVision = MissionVision::firstOrNew();
        $missionVision->title_one = $request->title_one;
        $missionVision->title_two = $request->title_two;
        $missionVision->description_one = $request->description_one;
        $missionVision->description_two = $request->description_two;
        $missionVision->save();

        return redirect()->back()->with('message', 'Mission & Vision updated successfully');
    }

    public function create() {}
    public function show(string $id) {}
    public function edit(string $id) {}
    public function update(Request $request, string $id) {}
    public function destroy(string $id) {}
}
