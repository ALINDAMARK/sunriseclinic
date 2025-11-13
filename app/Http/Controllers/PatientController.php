<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

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
        $patients = Patient::orderBy('name')->get();
        return view('patient_management', compact('patients'));
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
        ]);

        Patient::create($data);
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
        ]);

        $patient->update($data);
        return redirect()->route('patients.manage')->with('success', 'Patient updated.');
    }

    public function destroy(Patient $patient)
    {
        $patient->delete();
        return redirect()->route('patients.manage')->with('success', 'Patient deleted.');
    }
}
