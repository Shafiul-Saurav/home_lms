<?php

namespace App\Http\Controllers;

use App\Models\Impact;
use Illuminate\Http\Request;

class ImpactController extends Controller
{
    public function index()
    {
        $impacts = Impact::orderBy('id', 'desc')->paginate(20);
        return view('backend.pages.impact.impact', compact('impacts'));
    }

    public function create()
    {
        return view('backend.pages.impact.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:191',
            'value' => 'nullable|string',
        ]);
        Impact::create($data);
        return redirect()->route('impacts.index')->with('success', 'Impact created.');
    }

    public function edit(Impact $impact)
    {
        return view('backend.pages.impact.edit', compact('impact'));
    }

    public function update(Request $request, Impact $impact)
    {
        $data = $request->validate([
            'name' => 'required|string|max:191',
            'value' => 'nullable|string',
        ]);
        $impact->update($data);
        return redirect()->route('impacts.index')->with('success', 'Impact updated.');
    }

    public function destroy(Impact $impact)
    {
        $impact->delete();
        return redirect()->route('impacts.index')->with('success', 'Impact deleted.');
    }
}
