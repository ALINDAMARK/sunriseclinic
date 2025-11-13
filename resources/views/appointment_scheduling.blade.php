@extends('layouts.app')

@section('title', 'Book Appointment - Sun Rise Clinic')

@section('content')
<div class="p-2">
  <form method="POST" action="{{ route('appointments.store') }}">
    @csrf
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
      <!-- Left Column: Form -->
      <div class="lg:col-span-2 flex flex-col gap-8">
        <!-- Page Heading -->
        <div class="flex flex-col gap-2">
          <h1 class="text-[#121811] dark:text-white text-4xl font-black leading-tight">Book New Appointment</h1>
          <p class="text-[#698863] dark:text-gray-400 text-base">Fill in the details below to schedule a new appointment.</p>
        </div>

        <!-- Form Sections -->
        <div class="flex flex-col gap-6 bg-white dark:bg-background-dark p-6 rounded-lg border border-[#dde5dc] dark:border-white/10">
          <!-- Patient Information -->
          <section>
            <h3 class="text-lg font-bold mb-4">Patient Information</h3>
            <div class="flex flex-col w-full">
              <div class="flex w-full items-stretch rounded-lg h-12 border border-[#dde5dc] bg-white dark:bg-background-dark">
                <div class="text-gray-500 flex items-center justify-center pl-4">
                  <span class="material-symbols-outlined">search</span>
                </div>
                <select id="patient-select" name="patient_id" class="form-select w-full rounded-lg px-4" onchange="document.getElementById('summary-patient').innerText = this.options[this.selectedIndex].text">
                  <option value="">Select patient...</option>
                  @if(!empty($patients))
                    @foreach($patients as $p)
                      @php $selectedPatient = request()->query('patient') ?? old('patient_id'); @endphp
                      <option value="{{ $p->id }}" data-contact="{{ $p->phone ?? $p->email ?? '' }}" {{ (string)$p->id === (string)$selectedPatient ? 'selected' : '' }}>{{ $p->name }} (ID: P{{ $p->id }})</option>
                    @endforeach
                  @endif
                </select>
                <a href="{{ route('patients.create') }}" class="text-primary font-semibold text-sm px-4">Add New</a>
              </div>
            </div>
          </section>

          <!-- Service & Provider -->
          <section>
            <h3 class="text-lg font-bold mb-4">Service & Provider</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div>
                <label class="text-sm font-medium text-gray-600">Service Category</label>
                <select class="form-select w-full rounded-lg border px-3 py-2" id="service-category">
                  <option>General Medicine</option>
                  <option>Pediatrics</option>
                  <option>Cardiology</option>
                </select>
              </div>
              <div>
                <label class="text-sm font-medium text-gray-600">Specific Service</label>
                <select name="service_id" id="service" class="form-select w-full rounded-lg border px-3 py-2" onchange="document.getElementById('summary-service').innerText = this.options[this.selectedIndex].text; document.getElementById('summary-cost').innerText = this.options[this.selectedIndex].dataset.cost ? '$'+parseFloat(this.options[this.selectedIndex].dataset.cost).toFixed(2) : '-'">
                  <option value="">Select a service</option>
                  @if(!empty($services))
                    @php $selectedService = request()->query('service') ?? old('service_id'); @endphp
                    @foreach($services as $s)
                      <option value="{{ $s->id }}" data-cost="{{ $s->cost }}" {{ (string)$s->id === (string)$selectedService ? 'selected' : '' }}>{{ $s->name }}</option>
                    @endforeach
                  @endif
                </select>
              </div>
            </div>
            <div class="mt-6">
              <label class="text-sm font-medium text-gray-600 block mb-2">Select a Doctor</label>
              @php $selectedDoctor = request()->query('doctor') ?? old('doctor_id'); @endphp
              <select id="doctor-select" name="doctor_id" class="form-select w-full rounded-lg border px-3 py-2" onchange="document.getElementById('summary-doctor').innerText = this.options[this.selectedIndex].text">
                <option value="">Select a doctor</option>
                @if(!empty($doctors))
                  @foreach($doctors as $d)
                    <option value="{{ $d->id }}" {{ (string)$d->id === (string)$selectedDoctor ? 'selected' : '' }}>{{ $d->name }} — {{ $d->specialty }}</option>
                  @endforeach
                @endif
              </select>
            </div>
          </section>

          <!-- Date & Time -->
          <section>
            <h3 class="text-lg font-bold mb-4">Date & Time</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
              <div class="p-4 rounded-lg bg-white dark:bg-background-dark border">
                <div class="flex items-center justify-between mb-4">
                  <button type="button" class="p-1 rounded-full hover:bg-gray-100">
                    <span class="material-symbols-outlined">chevron_left</span>
                  </button>
                  <p class="font-semibold">{{ now()->format('F Y') }}</p>
                  <button type="button" class="p-1 rounded-full hover:bg-gray-100">
                    <span class="material-symbols-outlined">chevron_right</span>
                  </button>
                </div>
                <div class="grid grid-cols-7 text-center text-xs text-gray-500">
                  <span>Su</span><span>Mo</span><span>Tu</span><span>We</span><span>Th</span><span>Fr</span><span>Sa</span>
                </div>
                <div class="grid grid-cols-7 text-center mt-2 text-sm gap-1">
                  {{-- lightweight calendar placeholder --}}
                  @for($i=1;$i<=28;$i++)
                    <span class="cursor-pointer hover:bg-gray-100 rounded-full py-1">{{ $i }}</span>
                  @endfor
                </div>
              </div>
              <div class="flex flex-col">
                <p class="font-semibold text-sm mb-4">Select date & time</p>
                <input type="datetime-local" id="starts_at" name="starts_at" value="{{ old('starts_at') }}" class="w-full rounded border px-3 py-2 mb-3" onchange="document.getElementById('summary-datetime').innerText = this.value" />
                <div class="grid grid-cols-2 gap-2">
                  <input type="number" name="duration_minutes" id="duration_minutes" value="{{ old('duration_minutes', 30) }}" class="rounded border px-3 py-2" placeholder="Duration (min)" onchange="document.getElementById('summary-duration').innerText = this.value+' min'" />
                </div>
              </div>
            </div>
          </section>

          <!-- Appointment Details -->
          <section>
            <h3 class="text-lg font-bold mb-4">Appointment Details</h3>
            <div class="flex flex-col gap-4">
              <textarea name="notes" class="w-full rounded-lg border px-3 py-2" placeholder="Add internal notes for the appointment..." rows="4">{{ old('notes') }}</textarea>
              <div class="flex items-center justify-between">
                <label class="text-sm font-medium text-gray-600" for="follow-up">Mark as a follow-up visit</label>
                <label class="relative inline-flex items-center cursor-pointer">
                  <input class="sr-only peer" id="follow-up" name="is_follow_up" type="checkbox" value="1" />
                  <div class="w-11 h-6 bg-gray-200 rounded-full peer-checked:bg-primary after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border after:rounded-full after:h-5 after:w-5 after:transition-all"></div>
                </label>
              </div>
            </div>
          </section>
        </div>
      </div>

      <!-- Right Column: Summary -->
      <div class="lg:col-span-1">
        <div class="sticky top-8 bg-white dark:bg-background-dark p-6 rounded-lg border border-[#dde5dc] dark:border-white/10 flex flex-col gap-6">
          <h3 class="text-xl font-bold">Appointment Summary</h3>
          <div class="border-b pb-4">
            <p class="text-sm text-gray-500 mb-1">Patient</p>
            <div class="flex items-center gap-3">
              <div class="w-10 h-10 rounded-full bg-gray-100"></div>
              <div>
                <p id="summary-patient" class="font-semibold">—</p>
                <p id="summary-patient-contact" class="text-sm text-gray-500">—</p>
              </div>
            </div>
          </div>
          <div class="border-b pb-4 flex flex-col gap-3">
            <div>
              <p class="text-sm text-gray-500 mb-1">Service</p>
              <p id="summary-service" class="font-semibold">—</p>
            </div>
            <div>
              <p class="text-sm text-gray-500 mb-1">Doctor</p>
              <p id="summary-doctor" class="font-semibold">—</p>
            </div>
          </div>
          <div class="border-b pb-4 flex flex-col gap-3">
            <div class="flex items-center gap-3">
              <span class="material-symbols-outlined text-gray-500">calendar_today</span>
              <p id="summary-datetime" class="font-semibold">—</p>
            </div>
            <div class="flex items-center gap-3">
              <span class="material-symbols-outlined text-gray-500">schedule</span>
              <p id="summary-duration" class="font-semibold">—</p>
            </div>
          </div>
          <div class="bg-gray-50 p-4 rounded-lg flex justify-between items-center">
            <p class="font-semibold text-gray-700">Estimated Cost</p>
            <p id="summary-cost" class="text-2xl font-bold">-</p>
          </div>
          <div class="flex flex-col gap-3 mt-auto">
            @if(session('success'))
              <div class="text-green-700">{{ session('success') }}</div>
            @endif
            @if($errors->any())
              <div class="text-red-600">{{ $errors->first() }}</div>
            @endif
            <button type="submit" class="w-full rounded-lg h-12 px-4 bg-primary text-white font-bold">Create Appointment</button>
            <a href="{{ route('appointments.manage') }}" class="w-full items-center justify-center rounded-lg h-12 border flex">Cancel</a>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
@endsection

@push('scripts')
<script>
  (function(){
    function qs(id){ return document.getElementById(id); }
    var patientSelect = qs('patient-select');
    var serviceSelect = qs('service');
    var doctorSelect = qs('doctor-select');
    var startsAt = qs('starts_at');
    var duration = qs('duration_minutes');

    function updateSummaryFromSelects(){
      if(patientSelect){
        var pText = patientSelect.options[patientSelect.selectedIndex] ? patientSelect.options[patientSelect.selectedIndex].text : '';
        qs('summary-patient').innerText = pText || '—';
        var pContact = patientSelect.options[patientSelect.selectedIndex] ? patientSelect.options[patientSelect.selectedIndex].dataset.contact : '';
        if(qs('summary-patient-contact')) qs('summary-patient-contact').innerText = pContact || '—';
      }
      if(serviceSelect){
        var sText = serviceSelect.options[serviceSelect.selectedIndex] ? serviceSelect.options[serviceSelect.selectedIndex].text : '';
        qs('summary-service').innerText = sText || '—';
        var cost = serviceSelect.options[serviceSelect.selectedIndex] ? serviceSelect.options[serviceSelect.selectedIndex].dataset.cost : null;
        qs('summary-cost').innerText = cost ? '$'+parseFloat(cost).toFixed(2) : '-';
      }
      if(doctorSelect){
        var dText = doctorSelect.options[doctorSelect.selectedIndex] ? doctorSelect.options[doctorSelect.selectedIndex].text : '';
        qs('summary-doctor').innerText = dText || '—';
      }
      if(startsAt){
        qs('summary-datetime').innerText = startsAt.value || '—';
      }
      if(duration){
        qs('summary-duration').innerText = (duration.value ? duration.value + ' min' : '—');
      }
    }

    [patientSelect, serviceSelect, doctorSelect, startsAt, duration].forEach(function(el){
      if(!el) return;
      el.addEventListener('change', updateSummaryFromSelects);
    });

    // initialize on load
    document.addEventListener('DOMContentLoaded', updateSummaryFromSelects);
    // Also run now in case DOMContentLoaded already fired
    updateSummaryFromSelects();
  })();
</script>
@endpush