<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ServiceConsultation;
use App\Models\Servicetwo;
use App\Models\ServiceConsultationTimeslot;
use Illuminate\Http\Request;

class ServiceConsultationController extends Controller
{
    public function index()
    {
        $consultations = ServiceConsultation::with(['service', 'timeslot'])->latest('id')->paginate(50);
        return view('backend.pages.service_consultations.index', compact('consultations'));
    }

    public function create()
    {
        $services = Servicetwo::where('is_active', 1)->get();
        $timeslots = ServiceConsultationTimeslot::where('is_active', 1)->get();
        return view('backend.pages.service_consultations.create', compact('services', 'timeslots'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:50',
            'company_name' => 'nullable|string|max:255',
            'service_id' => 'required|exists:servicetwos,id',
            'timeslot_id' => 'required|exists:service_consultation_timeslots,id',
            'expected_timeline' => 'nullable|string|max:255',
            'project_requirement' => 'required|string',
            'is_active' => 'nullable|boolean',
        ]);

        $data['is_active'] = $request->has('is_active');

        ServiceConsultation::create($data);

        return redirect()->route('service_consultations.index')->with('message', 'Consultation created successfully.');
    }

    public function show(string $id)
    {
        $consultation = ServiceConsultation::with(['service', 'timeslot'])->findOrFail($id);
        return view('backend.pages.service_consultations.show', compact('consultation'));
    }

    public function edit(string $id)
    {
        $consultation = ServiceConsultation::findOrFail($id);
        $services = Servicetwo::where('is_active', 1)->get();
        $timeslots = ServiceConsultationTimeslot::where('is_active', 1)->get();
        return view('backend.pages.service_consultations.edit', compact('consultation', 'services', 'timeslots'));
    }

    public function update(Request $request, string $id)
    {
        $consultation = ServiceConsultation::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:50',
            'company_name' => 'nullable|string|max:255',
            'service_id' => 'required|exists:servicetwos,id',
            'timeslot_id' => 'required|exists:service_consultation_timeslots,id',
            'expected_timeline' => 'nullable|string|max:255',
            'project_requirement' => 'required|string',
            'is_active' => 'nullable|boolean',
        ]);

        $data['is_active'] = $request->has('is_active');
        $consultation->update($data);

        return redirect()->route('service_consultations.index')->with('message', 'Consultation updated successfully.');
    }

    public function destroy(string $id)
    {
        $consultation = ServiceConsultation::findOrFail($id);
        $consultation->delete();

        return redirect()->route('service_consultations.index')->with('warning', 'Consultation deleted successfully.');
    }

    public function checkActive($consultation_id)
    {
        $consultation = ServiceConsultation::find($consultation_id);
        if (! $consultation) {
            return response()->json(['type' => 'error', 'message' => 'Consultation not found'], 404);
        }

        $consultation->is_active = ! $consultation->is_active;
        $consultation->save();

        return response()->json(['type' => 'success', 'message' => 'Status Updated']);
    }
}
