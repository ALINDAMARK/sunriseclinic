<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with(['patient','doctor','service'])->orderBy('starts_at')->get();
        return response()->json($appointments);
    }

    // page view for scheduling/appointments UI
    public function manage()
    {
        // Guard queries in case migrations haven't been run
        if (\Illuminate\Support\Facades\Schema::hasTable('appointments')) {
            $appointments = Appointment::with(['patient','doctor','service'])->orderBy('starts_at')->get();
        } else {
            $appointments = collect();
        }
        $doctors = \Illuminate\Support\Facades\Schema::hasTable('doctors') ? \App\Models\Doctor::orderBy('name')->get() : collect();
        $patients = \Illuminate\Support\Facades\Schema::hasTable('patients') ? \App\Models\Patient::orderBy('name')->get() : collect();
        $services = \Illuminate\Support\Facades\Schema::hasTable('services') ? \App\Models\Service::orderBy('name')->get() : collect();
        return view('appointment_scheduling', compact('appointments','doctors','patients','services'));
    }

    // create appointment
    public function store(Request $request)
    {
        $data = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'service_id' => 'required|exists:services,id',
            'starts_at' => 'required|date',
            'duration_minutes' => 'nullable|integer',
            'notes' => 'nullable|string',
        ]);

        Appointment::create($data);
        return redirect()->route('appointments.manage')->with('success', 'Appointment created.');
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        return redirect()->route('appointments.manage')->with('success', 'Appointment cancelled.');
    }
}
