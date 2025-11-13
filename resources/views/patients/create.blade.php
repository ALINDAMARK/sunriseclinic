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
      <input name="phone" value="{{ old('phone') }}" class="w-full rounded border px-3 py-2" />
    </div>
    <div>
      <label class="block text-sm font-medium">Date of birth</label>
      <input type="date" name="dob" value="{{ old('dob') }}" class="w-full rounded border px-3 py-2" />
    </div>
    <div class="flex gap-2">
      <button class="px-4 py-2 bg-primary text-white rounded">Create</button>
      <a href="{{ route('patients.manage') }}" class="px-4 py-2 border rounded">Cancel</a>
    </div>
  </form>
</div>
@endsection
