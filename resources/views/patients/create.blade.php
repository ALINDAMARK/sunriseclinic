@extends('layouts.app')

@section('title','Add Patient - Sun Rise Clinic')

@section('content')
<div class="max-w-3xl mx-auto">
  <h1 class="text-2xl font-bold mb-4">Add New Patient</h1>

  @if($errors->any())
    <div class="mb-4 text-red-600">
      <ul>
        @foreach($errors->all() as $err)
          <li>{{ $err }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form method="POST" action="{{ route('patients.store') }}" class="space-y-4">
    @csrf
    <div id="client-errors" class="mb-4 text-red-600" style="display:none"></div>
    <div>
      <label class="block text-sm font-medium">Full name</label>
      <input name="name" value="{{ old('name') }}" class="w-full rounded border px-3 py-2" />
    </div>
    <div>
      <label class="block text-sm font-medium">Email</label>
      <input name="email" value="{{ old('email') }}" class="w-full rounded border px-3 py-2" />
    </div>
    <div>
      <label class="block text-sm font-medium">Phone</label>
      <input type="tel" name="phone" placeholder="+256700000000" value="{{ old('phone') }}" class="w-full rounded border px-3 py-2" />
      <p class="text-sm text-gray-500">Use international format, e.g. <code>+256700000000</code>.</p>
    </div>
    <div>
      <label class="block text-sm font-medium">Date of birth</label>
      <input type="date" name="dob" value="{{ old('dob') }}" class="w-full rounded border px-3 py-2" />
    </div>
    <div>
      <label class="block text-sm font-medium">Gender</label>
      <select name="gender" class="w-full rounded border px-3 py-2">
        <option value="" {{ old('gender') == '' ? 'selected' : '' }}>Select</option>
        <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
        <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
        <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other</option>
      </select>
    </div>
    <div>
      <label class="block text-sm font-medium">Marital Status</label>
      <select name="marital_status" class="w-full rounded border px-3 py-2">
        <option value="" {{ old('marital_status') == '' ? 'selected' : '' }}>Select</option>
        <option value="Single" {{ old('marital_status') == 'Single' ? 'selected' : '' }}>Single</option>
        <option value="Married" {{ old('marital_status') == 'Married' ? 'selected' : '' }}>Married</option>
        <option value="Other" {{ old('marital_status') == 'Other' ? 'selected' : '' }}>Other</option>
      </select>
    </div>
    <div>
      <label class="block text-sm font-medium">Address</label>
      <textarea name="address" class="w-full rounded border px-3 py-2">{{ old('address') }}</textarea>
    </div>
    <details class="p-3 border rounded" open>
      <summary class="font-medium">Emergency contact</summary>
      <div class="mt-3 space-y-3">
        <div>
          <label class="block text-sm font-medium">Emergency contact name</label>
          <input name="emergency_contact_name" value="{{ old('emergency_contact_name') }}" class="w-full rounded border px-3 py-2" />
        </div>
        <div>
          <label class="block text-sm font-medium">Emergency contact phone</label>
          <input type="tel" name="emergency_contact_phone" placeholder="+256700000000" value="{{ old('emergency_contact_phone') }}" class="w-full rounded border px-3 py-2" />
          <p class="text-sm text-gray-500">Provide a number we can call in an emergency (international format recommended).</p>
        </div>
      </div>
    </details>
    <details class="p-3 border rounded">
      <summary class="font-medium">Medical information</summary>
      <div class="mt-3 space-y-3">
        <div>
          <label class="block text-sm font-medium">Allergies</label>
          <textarea name="allergies" class="w-full rounded border px-3 py-2">{{ old('allergies') }}</textarea>
          <p class="text-sm text-gray-500">List any allergies separated by commas. e.g., <em>Penicillin, Peanuts</em>.</p>
        </div>
        <div>
          <label class="block text-sm font-medium">Pre-existing conditions</label>
          <textarea name="conditions" class="w-full rounded border px-3 py-2">{{ old('conditions') }}</textarea>
          <p class="text-sm text-gray-500">Chronic conditions or important medical notes (comma separated or short text).</p>
        </div>
      </div>
    </details>
    <div class="flex gap-2">
      <button class="px-4 py-2 bg-primary text-white rounded">Create</button>
      <a href="{{ route('patients.manage') }}" class="px-4 py-2 border rounded">Cancel</a>
    </div>
  </form>
</div>
<script>
(function(){
  function validPhone(v){ return /^\+?\d{7,15}$/.test((v||'').trim()); }
  function showError(msg){ var e=document.getElementById('client-errors'); e.style.display='block'; e.textContent=msg; }
  function clearError(){ var e=document.getElementById('client-errors'); e.style.display='none'; e.textContent=''; }
  var form=document.querySelector('form');
  if(!form) return;
  form.addEventListener('submit', function(ev){
    clearError();
    var phone = form.querySelector('[name=phone]') ? form.querySelector('[name=phone]').value : '';
    var ephone = form.querySelector('[name=emergency_contact_phone]') ? form.querySelector('[name=emergency_contact_phone]').value : '';
    if(phone && !validPhone(phone)){
      ev.preventDefault(); showError('Please enter a valid phone number (e.g. +256700000000).'); return false;
    }
    if(ephone && !validPhone(ephone)){
      ev.preventDefault(); showError('Please enter a valid emergency contact phone (e.g. +256700000000).'); return false;
    }
  });
})();
</script>
@endsection
