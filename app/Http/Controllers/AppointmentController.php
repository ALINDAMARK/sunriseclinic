<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AppointmentController extends Controller
{
    public function index()
    {
        $q = Appointment::with(['patient','doctor','service'])->orderBy('starts_at');
        // optional date range filtering
        $start = request()->query('start_date');
        $end = request()->query('end_date');
        if ($start) {
            try { $startDt = \Carbon\Carbon::parse($start)->startOfDay(); } catch (\Exception $e) { $startDt = null; }
            if ($startDt) $q->where('starts_at', '>=', $startDt->toDateTimeString());
        }
        if ($end) {
            try { $endDt = \Carbon\Carbon::parse($end)->endOfDay(); } catch (\Exception $e) { $endDt = null; }
            if ($endDt) $q->where('starts_at', '<=', $endDt->toDateTimeString());
        }
        $appointments = $q->get();
        // normalize datetime fields to UTC Zulu ISO8601 and include computed end time
        $out = $appointments->map(function($a){
            $start = $a->starts_at ? \Carbon\Carbon::parse($a->starts_at) : null;
            if($start) $start = $start->setTimezone('UTC');
            $duration = $a->duration_minutes ? intval($a->duration_minutes) : 0;
            $end = $start ? $start->copy()->addMinutes($duration) : null;
            $formatIso = function($dt){ return $dt ? str_replace('+00:00','Z',$dt->toIso8601String()) : null; };
            // also include EAT-friendly formatted fields for clients
            $startEat = $start ? $start->copy()->setTimezone('Africa/Nairobi') : null;
            $endEat = $end ? $end->copy()->setTimezone('Africa/Nairobi') : null;
            return [
                'id' => $a->id,
                'patient' => $a->patient ? $a->patient->name : null,
                'patient_id' => $a->patient_id,
                'doctor_id' => $a->doctor_id,
                'service' => $a->service ? $a->service->name : null,
                'service_id' => $a->service_id,
                'starts_at' => $formatIso($start),
                'ends_at' => $formatIso($end),
                'starts_at_eat' => $startEat ? $startEat->format('Y-m-d\TH:i') : null,
                'ends_at_eat' => $endEat ? $endEat->format('Y-m-d\TH:i') : null,
                'starts_at_eat_display' => $startEat ? $startEat->format('g:i A').' EAT' : null,
                'ends_at_eat_display' => $endEat ? $endEat->format('g:i A').' EAT' : null,
                'duration_minutes' => $duration,
                'notes' => $a->notes,
            ];
        });
        return response()->json(['data' => $out]);
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

        // normalize incoming start time to UTC before storing
        if(!empty($data['starts_at'])){
            try{ $dt = \Carbon\Carbon::parse($data['starts_at'])->setTimezone('UTC'); $data['starts_at'] = $dt->toDateTimeString(); } catch(\Exception $e){}
        }
        $appt = Appointment::create($data);
        if ($request->wantsJson() || $request->ajax()) {
            $start = $appt->starts_at ? \Carbon\Carbon::parse($appt->starts_at)->setTimezone('UTC') : null;
            $end = $start ? $start->copy()->addMinutes(intval($appt->duration_minutes ?? 0)) : null;
            $formatIso = function($dt){ return $dt ? str_replace('+00:00','Z',$dt->toIso8601String()) : null; };
            $startEat = $start ? $start->copy()->setTimezone('Africa/Nairobi') : null;
            $endEat = $end ? $end->copy()->setTimezone('Africa/Nairobi') : null;
            $resp = [
                'id' => $appt->id,
                'patient_id' => $appt->patient_id,
                'doctor_id' => $appt->doctor_id,
                'service_id' => $appt->service_id,
                'starts_at' => $formatIso($start),
                'ends_at' => $formatIso($end),
                'starts_at_eat' => $startEat ? $startEat->format('Y-m-d\TH:i') : null,
                'ends_at_eat' => $endEat ? $endEat->format('Y-m-d\TH:i') : null,
                'starts_at_eat_display' => $startEat ? $startEat->format('g:i A').' EAT' : null,
                'ends_at_eat_display' => $endEat ? $endEat->format('g:i A').' EAT' : null,
                'duration_minutes' => $appt->duration_minutes,
                'notes' => $appt->notes,
            ];
            return response()->json(['success' => true, 'data' => $resp], 201);
        }

        return redirect()->route('appointments.manage')->with('success', 'Appointment created.');
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        return redirect()->route('appointments.manage')->with('success', 'Appointment cancelled.');
    }

    // API action endpoint for AJAX operations from the dashboard
    public function action(Request $request, Appointment $appointment)
    {
        $action = $request->input('action');
        if (!$action) {
            return response()->json(['error' => 'Action is required.'], 400);
        }

        switch ($action) {
            case 'checkin':
                $appointment->status = 'checked_in';
                $appointment->save();
                return response()->json(['success' => true, 'status' => 'checked_in']);
            case 'cancel':
                $appointment->status = 'cancelled';
                $appointment->save();
                return response()->json(['success' => true, 'status' => 'cancelled']);
            case 'delete':
                $appointment->delete();
                return response()->json(['success' => true, 'deleted' => true]);
            default:
                return response()->json(['error' => 'Unknown action.'], 400);
        }
    }
}
