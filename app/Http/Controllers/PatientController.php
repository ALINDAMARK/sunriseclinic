<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Schema;

class PatientController extends Controller
{
    public function index()
    {
        $patients = Patient::orderBy('name')->get();
        return response()->json($patients);
    }

    // page view for staff portal patient management
    public function manage()
    {
        // Delegate filtering, sorting and pagination to this action using query params:
        // - search: string to match name, email, phone or id
        // - doctor_id: filter patients who have appointments with this doctor
        // - sort: name_asc (default), name_desc, id_asc
        $request = request();

        $doctors = \Illuminate\Support\Facades\Schema::hasTable('doctors') ? \App\Models\Doctor::orderBy('name')->get() : collect();

        $query = Patient::query();

        if ($request->filled('search')) {
            $s = $request->input('search');
            $query->where(function ($q) use ($s) {
                $q->where('name', 'like', "%{$s}%")
                  ->orWhere('email', 'like', "%{$s}%")
                  ->orWhere('phone', 'like', "%{$s}%")
                  ->orWhere('id', $s);
            });
        }

        if ($request->filled('doctor_id')) {
            $doctorId = $request->input('doctor_id');
            // only include patients who have at least one appointment with the selected doctor
            $query->whereHas('appointments', function ($q) use ($doctorId) {
                $q->where('doctor_id', $doctorId);
            });
        }

        // Sorting
        $sort = $request->input('sort', 'name_asc');
        switch ($sort) {
            case 'name_desc':
                $query->orderBy('name', 'desc');
                break;
            case 'id_asc':
                $query->orderBy('id', 'asc');
                break;
            default:
                $query->orderBy('name', 'asc');
                break;
        }

        // eager load appointment counts for display
        $patients = $query->withCount('appointments')->paginate(25)->appends($request->except('page'));

        return view('patient_management', compact('patients', 'doctors'));
    }

    /**
     * Return patients as JSON for AJAX filtering/sorting/pagination.
     */
    public function dataJson(Request $request)
    {
        $doctors = \Illuminate\Support\Facades\Schema::hasTable('doctors') ? \App\Models\Doctor::orderBy('name')->get() : collect();

        $query = Patient::query();

        $search = $request->input('search');
        if ($search) {
            // Use a simple LIKE-based search to be compatible across database drivers
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('id', $search);
            });
        }

        if ($request->filled('doctor_id')) {
            $doctorId = $request->input('doctor_id');
            $query->whereHas('appointments', function ($q) use ($doctorId) {
                $q->where('doctor_id', $doctorId);
            });
        }

        // Sorting
        $sort = $request->input('sort', 'name_asc');
        switch ($sort) {
            case 'name_desc':
                $query->orderBy('name', 'desc');
                break;
            case 'id_asc':
                $query->orderBy('id', 'asc');
                break;
            default:
                $query->orderBy('name', 'asc');
                break;
        }

        $perPage = (int) $request->input('per_page', 25);
        $patients = $query->withCount('appointments')->paginate($perPage)->appends($request->except('page'));

        // Return summarized JSON to reduce payload
        $items = collect($patients->items())->map(function ($p) {
            return [
                'id' => $p->id,
                'name' => $p->name,
                'email' => $p->email,
                'phone' => $p->phone,
                'dob' => $p->dob,
                'appointments_count' => $p->appointments_count ?? 0,
            ];
        });

        return response()->json([
            'data' => $items->values(),
            'meta' => [
                'current_page' => $patients->currentPage(),
                'last_page' => $patients->lastPage(),
                'per_page' => $patients->perPage(),
                'total' => $patients->total(),
            ],
        ]);
    }

    /**
     * Stream CSV of filtered patients using the same query logic.
     */
    public function exportCsv(Request $request)
    {
        $query = Patient::query();

        $search = $request->input('search');
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('id', $search);
            });
        }

        if ($request->filled('doctor_id')) {
            $doctorId = $request->input('doctor_id');
            $query->whereHas('appointments', function ($q) use ($doctorId) {
                $q->where('doctor_id', $doctorId);
            });
        }

        $patients = $query->withCount('appointments')->orderBy('name')->get();

        $filename = 'patients_export_' . date('Ymd_His') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        // Build CSV in-memory so test clients can read the response body reliably.
        $fp = fopen('php://temp', 'r+');
        fputcsv($fp, ['ID', 'Name', 'Email', 'Phone', 'DOB', 'Appointments']);
        foreach ($patients as $p) {
            fputcsv($fp, [$p->id, $p->name, $p->email, $p->phone, $p->dob, $p->appointments_count]);
        }
        rewind($fp);
        $csv = stream_get_contents($fp);
        fclose($fp);

        return response($csv, 200, $headers);
    }

    public function create()
    {
        return view('patients.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:40',
            'dob' => 'nullable|date',
            // optional extended fields
            'gender' => 'nullable|string|max:32',
            'marital_status' => 'nullable|string|max:32',
            'address' => 'nullable|string',
            'emergency_contact_name' => 'nullable|string|max:255',
            'emergency_contact_phone' => 'nullable|string|max:40',
            'allergies' => 'nullable|string',
            'conditions' => 'nullable|string',
        ]);

        Patient::create($data);
        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Patient created successfully.'], 201);
        }

        return redirect()->route('patients.manage')->with('success', 'Patient created successfully.');
    }

    public function edit(Patient $patient)
    {
        return view('patients.edit', compact('patient'));
    }

    public function update(Request $request, Patient $patient)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:40',
            'dob' => 'nullable|date',
            // optional extended fields
            'gender' => 'nullable|string|max:32',
            'marital_status' => 'nullable|string|max:32',
            'address' => 'nullable|string',
            'emergency_contact_name' => 'nullable|string|max:255',
            'emergency_contact_phone' => 'nullable|string|max:40',
            'allergies' => 'nullable|string',
            'conditions' => 'nullable|string',
        ]);

        $patient->update($data);
        return redirect()->route('patients.manage')->with('success', 'Patient updated.');
    }

    public function destroy(Patient $patient)
    {
        $patient->delete();
        return redirect()->route('patients.manage')->with('success', 'Patient deleted.');
    }

    /**
     * Return basic profile data for the given patient.
     */
    public function profileJson(Patient $patient)
    {
        $patient->loadCount('appointments');
        return response()->json([
            'id' => $patient->id,
            'name' => $patient->name,
            'email' => $patient->email,
            'phone' => $patient->phone,
            'dob' => $patient->dob,
            // include optional attributes if present on the model/table
            'gender' => $patient->gender ?? null,
            'marital_status' => $patient->marital_status ?? null,
            'address' => $patient->address ?? null,
            'emergency_contact_name' => $patient->emergency_contact_name ?? null,
            'emergency_contact_phone' => $patient->emergency_contact_phone ?? null,
            'allergies' => $patient->allergies ?? null,
            'conditions' => $patient->conditions ?? null,
            'appointments_count' => $patient->appointments_count ?? 0,
        ]);
    }

    /**
     * Return appointments for a given patient.
     */
    public function appointmentsJson(Patient $patient)
    {
        $appointments = $patient->appointments()->with(['doctor','service'])->orderBy('starts_at','desc')->get()->map(function($a){
            // compute canonical starts_at/ends_at in UTC (ISO8601 Z) and EAT helper fields
            $start = $a->starts_at ? \Carbon\Carbon::parse($a->starts_at)->setTimezone('UTC') : null;
            $duration = $a->duration_minutes ? intval($a->duration_minutes) : 0;
            $end = $start ? $start->copy()->addMinutes($duration) : null;
            $formatIso = function($dt){ return $dt ? str_replace('+00:00','Z',$dt->toIso8601String()) : null; };
            $startEat = $start ? $start->copy()->setTimezone('Africa/Nairobi') : null;
            $endEat = $end ? $end->copy()->setTimezone('Africa/Nairobi') : null;
            return [
                'id' => $a->id,
                'doctor' => optional($a->doctor)->name,
                'service' => optional($a->service)->name,
                'status' => $a->status,
                'notes' => $a->notes,
                'duration_minutes' => $duration,
                'starts_at' => $formatIso($start),
                'ends_at' => $formatIso($end),
                'starts_at_eat' => $startEat ? $startEat->format('Y-m-d\TH:i') : null,
                'ends_at_eat' => $endEat ? $endEat->format('Y-m-d\TH:i') : null,
                'starts_at_eat_display' => $startEat ? $startEat->format('g:i A').' EAT' : null,
                'ends_at_eat_display' => $endEat ? $endEat->format('g:i A').' EAT' : null,
            ];
        });
        return response()->json(['data' => $appointments]);
    }

    /**
     * For now, use appointments as "medical history" entries.
     */
    public function historyJson(Patient $patient)
    {
        $history = $patient->appointments()->with(['doctor','service'])->whereDate('starts_at','<', now())->orderBy('starts_at','desc')->get()->map(function($a){
            return [
                'date' => $a->starts_at ? $a->starts_at->format('Y-m-d') : null,
                'doctor' => optional($a->doctor)->name,
                'service' => optional($a->service)->name,
                'notes' => $a->notes,
            ];
        });
        return response()->json(['data' => $history]);
    }

    /**
     * Gather notes for the patient. Currently pulled from appointment notes.
     */
    public function notesJson(Patient $patient)
    {
        // Read notes from notes table (new model) when available
        if (\Illuminate\Support\Facades\Schema::hasTable('notes')) {
            $notes = \App\Models\Note::where('patient_id', $patient->id)->orderBy('created_at', 'desc')->get()->map(function($n){
                return [
                    'id' => $n->id,
                    'date' => $n->created_at ? $n->created_at->format('Y-m-d') : null,
                    'note' => $n->note,
                    'from' => optional($n->user)->name ?? null,
                ];
            });
            return response()->json(['data' => $notes]);
        }

        // fallback to appointment.notes if notes table doesn't exist yet
        $notes = $patient->appointments()->whereNotNull('notes')->orderBy('starts_at','desc')->get()->map(function($a){
            return [
                'date' => $a->starts_at ? $a->starts_at->format('Y-m-d') : null,
                'note' => $a->notes,
                'from' => optional($a->doctor)->name,
            ];
        });
        return response()->json(['data' => $notes]);
    }
}
