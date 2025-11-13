@extends('layouts.app')

@section('title', 'Add Doctor - Sun Rise Clinic')

@section('content')
<div class="p-4">
  <div class="max-w-2xl mx-auto bg-white dark:bg-background-dark p-6 rounded-lg border">
    <h1 class="text-2xl font-bold mb-4">Add New Doctor</h1>
    <form method="POST" action="{{ route('doctors.store') }}">
      @csrf
      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700">Full name</label>
        <input name="name" type="text" value="{{ old('name') }}" class="w-full rounded border px-3 py-2" required />
      </div>
      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700">Specialty</label>
        <input name="specialty" type="text" value="{{ old('specialty') }}" class="w-full rounded border px-3 py-2" />
      </div>
      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700">Avatar URL (optional)</label>
        <input name="avatar_url" type="url" value="{{ old('avatar_url') }}" class="w-full rounded border px-3 py-2" />
      </div>
      <div class="flex gap-2">
        <button class="px-4 py-2 bg-primary text-white rounded">Create</button>
        <a href="{{ route('doctors.manage') }}" class="px-4 py-2 border rounded">Cancel</a>
      </div>
    </form>
  </div>
</div>
@endsection
