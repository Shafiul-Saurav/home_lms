<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ServiceConsultationTimeslot;
use Illuminate\Http\Request;

class ServiceConsultationTimeslotController extends Controller
{
    public function index()
    {
        $timeslots = ServiceConsultationTimeslot::latest('id')->paginate(50);
        return view('backend.pages.service_consultation_timeslots.index', compact('timeslots'));
    }

    public function create()
    {
        return view('backend.pages.service_consultation_timeslots.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'label' => 'required|string|max:255',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'is_active' => 'nullable|boolean',
        ]);

        $data['is_active'] = $request->has('is_active');
        ServiceConsultationTimeslot::create($data);

        return redirect()->route('service_consultation_timeslots.index')->with('message', 'Timeslot created successfully.');
    }

    public function edit(string $id)
    {
        $timeslot = ServiceConsultationTimeslot::findOrFail($id);
        return view('backend.pages.service_consultation_timeslots.edit', compact('timeslot'));
    }

    public function update(Request $request, string $id)
    {
        $timeslot = ServiceConsultationTimeslot::findOrFail($id);

        $data = $request->validate([
            'label' => 'required|string|max:255',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'is_active' => 'nullable|boolean',
        ]);

        $data['is_active'] = $request->has('is_active');
        $timeslot->update($data);

        return redirect()->route('service_consultation_timeslots.index')->with('message', 'Timeslot updated successfully.');
    }

    public function destroy(string $id)
    {
        $timeslot = ServiceConsultationTimeslot::findOrFail($id);
        $timeslot->delete();

        return redirect()->route('service_consultation_timeslots.index')->with('warning', 'Timeslot deleted successfully.');
    }

    public function checkActive($timeslot_id)
    {
        $timeslot = ServiceConsultationTimeslot::find($timeslot_id);
        if (! $timeslot) {
            return response()->json(['type' => 'error', 'message' => 'Timeslot not found'], 404);
        }

        $timeslot->is_active = ! $timeslot->is_active;
        $timeslot->save();

        return response()->json(['type' => 'success', 'message' => 'Status Updated']);
    }
}
