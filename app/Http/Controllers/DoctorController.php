<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::orderBy('name')->get();
        return response()->json($doctors);
    }

    // staff page view for doctor schedule
    public function manage()
    {
        $doctors = Doctor::orderBy('name')->get();
        // also include upcoming appointments for quick display
        // guard in case migrations haven't been run yet
        if (\Illuminate\Support\Facades\Schema::hasTable('appointments')) {
            $appointments = \App\Models\Appointment::with(['patient','service'])->orderBy('starts_at')->limit(12)->get();
        } else {
            $appointments = collect();
        }
        return view('doctor_schedule_management', compact('doctors','appointments'));
    }
}
