<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ServiceConsultation;
use App\Models\ServiceConsultationTimeslot;
use Illuminate\Http\Request;

class ServiceConsultationController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:50',
            'company_name' => 'nullable|string|max:255',
            'service_id' => 'required|exists:servicetwos,id',
            'timeslot_id' => 'nullable|exists:service_consultation_timeslots,id',
            'expected_timeline' => 'nullable|string|max:255',
            'project_requirement' => 'required|string',
        ]);

        if ($request->filled('timeslot_id')) {
            $data['timeslot_id'] = $request->timeslot_id;
        } else {
            $timeslot = ServiceConsultationTimeslot::where('is_active', 1)->first();

            if (! $timeslot) {
                $timeslot = ServiceConsultationTimeslot::create([
                    'label' => 'Default Consultation Slot',
                    'start_time' => '09:00',
                    'end_time' => '10:00',
                    'is_active' => true,
                ]);
            }

            $data['timeslot_id'] = $timeslot->id;
        }

        ServiceConsultation::create($data);

        return redirect()->back()->with('message', 'Consultation request sent successfully.');
    }
}
