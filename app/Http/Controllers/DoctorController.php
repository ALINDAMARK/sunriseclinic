<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::orderBy('name')->get();
        return view('doctors.index', compact('doctors'));
    }

    // show form to create new doctor
    public function create()
    {
        // policy will gate this
        $this->authorize('create', Doctor::class);
        return view('doctors.create');
    }

    // store new doctor
    public function store(Request $request)
    {
        // ensure authorized via policy
        $this->authorize('create', Doctor::class);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'specialty' => 'nullable|string|max:255',
            'avatar_url' => 'nullable|url|max:1024',
        ]);
        $doctor = \App\Models\Doctor::create($data);
        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['success' => true, 'data' => $doctor], 201);
        }
        return redirect()->route('doctors.manage')->with('success', 'Doctor added.');
    }

    // edit form
    public function edit(Doctor $doctor)
    {
        $this->authorize('update', $doctor);
        return view('doctors.edit', compact('doctor'));
    }

    // update doctor
    public function update(Request $request, Doctor $doctor)
    {
        $this->authorize('update', $doctor);
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'specialty' => 'nullable|string|max:255',
            'avatar_url' => 'nullable|url|max:1024',
        ]);
        $doctor->update($data);
        return redirect()->route('doctors.manage')->with('success', 'Doctor updated.');
    }

    // destroy
    public function destroy(Doctor $doctor)
    {
        $this->authorize('delete', $doctor);
        $doctor->delete();
        return redirect()->route('doctors.manage')->with('success', 'Doctor removed.');
    }

    // staff page view for doctor schedule
    public function manage()
    {
        // require permission to view/manage doctors
        $this->authorize('viewAny', Doctor::class);
        $doctors = Doctor::orderBy('name')->get();
        // also include upcoming appointments for quick display
        // guard in case migrations haven't been run yet
        if (\Illuminate\Support\Facades\Schema::hasTable('appointments')) {
            $appointments = \App\Models\Appointment::with(['patient','service'])->orderBy('starts_at')->limit(100)->get();
        } else {
            $appointments = collect();
        }
        // blocks
        $blocks = \Illuminate\Support\Facades\Schema::hasTable('blocks') ? \App\Models\Block::with('doctor')->orderBy('starts_at')->get() : collect();
        $patients = \Illuminate\Support\Facades\Schema::hasTable('patients') ? \App\Models\Patient::orderBy('name')->get() : collect();
        $services = \Illuminate\Support\Facades\Schema::hasTable('services') ? \App\Models\Service::orderBy('name')->get() : collect();
        $weekStart = \Carbon\Carbon::now()->startOfWeek()->toDateString();

        // Prepare JSON-ready arrays for the view to avoid inline closures in Blade
        $appointmentsJs = $appointments->map(function($a){
            return [
                'id' => $a->id,
                'patient' => optional($a->patient)->name,
                'service' => optional($a->service)->name,
                'doctor_id' => $a->doctor_id,
                'starts_at' => $a->starts_at ? $a->starts_at->format('Y-m-d H:i:s') : null,
                'duration_minutes' => $a->duration_minutes,
                'status' => $a->status,
                'notes' => $a->notes,
            ];
        })->toArray();

        $blocksJs = ($blocks ?? collect())->map(function($b){
            return [
                'id' => $b->id,
                'doctor_id' => $b->doctor_id,
                'starts_at' => $b->starts_at ? $b->starts_at->format('Y-m-d H:i:s') : null,
                'duration_minutes' => $b->duration_minutes,
                'notes' => $b->notes,
            ];
        })->toArray();

        $canManageBlocks = auth()->check() ? auth()->user()->can('create', \App\Models\Block::class) : false;

        return view('doctor_schedule_management', compact('doctors','appointments','patients','services','blocks','weekStart','appointmentsJs','blocksJs','canManageBlocks'));
    }
}
