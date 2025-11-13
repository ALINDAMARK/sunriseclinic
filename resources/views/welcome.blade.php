@extends('layouts.app')

@section('title','Sun Rise Clinic — Clear Scheduling & Patient Management')

@section('content')
<!-- Full-viewport landing: locked to viewport height and prevents vertical scrolling -->
<div class="h-screen w-full overflow-hidden bg-gradient-to-b from-white to-green-50 flex items-center">
  <div class="max-w-6xl mx-auto w-full px-6">
    <div class="h-full flex flex-col md:flex-row items-center justify-between gap-8">
      <!-- Left / Hero (condensed to fit viewport) -->
      <div class="md:w-1/2 flex flex-col justify-center h-full">
        <h1 class="text-3xl md:text-5xl font-extrabold text-slate-900 leading-tight">Sun Rise Clinic</h1>
  @auth
  <div class="mt-2 text-sm text-green-700">Welcome, {{ auth()->user()->name }} — you're signed in</div>
  @endauth
        <p class="mt-4 text-base md:text-lg text-slate-600 max-w-xl">Smart, simple scheduling and patient records built for small clinics. Fast booking, clear calendars, and organized patient history — everything you need to run daily operations without ambiguity.</p>

        <div class="mt-6 flex flex-wrap gap-3">
          <a href="{{ route('appointments.manage') }}" class="inline-flex items-center justify-center px-4 py-2 rounded-lg text-gray-600 hover:bg-gray-50">View schedule</a>
        </div>

        <!-- Compact features row - hidden on very small screens to ensure no scroll -->
        <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 gap-3 max-w-md" aria-hidden="true">
          <div class="flex gap-3 items-start bg-white p-3 rounded-lg border">
            <div class="w-9 h-9 rounded-md bg-green-100 flex items-center justify-center text-green-600 font-bold">S</div>
            <div>
              <div class="font-semibold">Simple Scheduling</div>
              <div class="text-xs text-slate-500">Create and manage appointments in three clear steps.</div>
            </div>
          </div>

          <div class="flex gap-3 items-start bg-white p-3 rounded-lg border">
            <div class="w-9 h-9 rounded-md bg-green-100 flex items-center justify-center text-green-600 font-bold">P</div>
            <div>
              <div class="font-semibold">Patient Records</div>
              <div class="text-xs text-slate-500">Store contact info, notes and visit history without clutter.</div>
            </div>
          </div>
        </div>
      </div>

      <!-- Right / Compact preview card: sized to fit inside viewport -->
      <div class="md:w-1/2 flex items-center justify-center h-full">
        <div class="w-full max-w-md bg-white p-5 rounded-2xl shadow border">
          <div class="flex items-center justify-between mb-3">
            <div>
              <div class="text-sm text-slate-500">Today</div>
              <div class="font-semibold text-lg">Clinic Schedule</div>
            </div>
            <div class="text-sm text-slate-400">3 appointments</div>
          </div>

          <div class="space-y-2">
            <div class="flex items-center justify-between">
              <div>
                <div class="font-medium">John Doe</div>
                <div class="text-xs text-slate-400">09:30 — General Checkup</div>
              </div>
              <div class="text-sm text-slate-500">Dr. A</div>
            </div>

            <div class="flex items-center justify-between">
              <div>
                <div class="font-medium">Anna Smith</div>
                <div class="text-xs text-slate-400">10:15 — Follow-up</div>
              </div>
              <div class="text-sm text-slate-500">Dr. B</div>
            </div>

            <div class="flex items-center justify-between">
              <div>
                <div class="font-medium">Michael Lee</div>
                <div class="text-xs text-slate-400">11:00 — New Patient</div>
              </div>
              <div class="text-sm text-slate-500">Dr. C</div>
            </div>
          </div>

          <div class="mt-4 pt-3 border-t text-center">
            <a href="{{ route('appointments.manage') }}" class="text-sm text-green-600 font-semibold hover:underline">Open full schedule</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Small, condensed pillars row placed inside the same viewport and hidden on narrow screens -->
    <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4" style="transform: translateY(4px);"> <!-- tiny translate to keep within exact viewport if needed -->
      <div class="bg-white p-3 rounded-lg shadow border text-sm">
        <div class="font-semibold">Streamlined Booking</div>
        <div class="text-xs text-slate-500 mt-1">Triage, schedule and confirm in a single workflow.</div>
      </div>
      <div class="bg-white p-3 rounded-lg shadow border text-sm">
        <div class="font-semibold">Organized Records</div>
        <div class="text-xs text-slate-500 mt-1">Quick access to patient histories and contact details.</div>
      </div>
      <div class="bg-white p-3 rounded-lg shadow border text-sm">
        <div class="font-semibold">Clinician Calendars</div>
        <div class="text-xs text-slate-500 mt-1">See availability and avoid double-booking.</div>
      </div>
    </div>
  </div>
</div>
@endsection
