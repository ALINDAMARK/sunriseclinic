@extends('layouts.app')

@section('title','Edit Service - Sun Rise Clinic')

@section('content')
<div class="max-w-2xl mx-auto">
  <h1 class="text-2xl font-bold mb-4">Edit Service</h1>

  @if($errors->any())
    <div class="mb-4 text-red-600">
      <ul>
        @foreach($errors->all() as $err)
          <li>{{ $err }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form method="POST" action="{{ route('services.update', $service) }}">
    @csrf
    @method('PUT')
    <div class="space-y-4">
      <div>
        <label class="block text-sm font-medium">Name</label>
        <input name="name" value="{{ old('name', $service->name) }}" class="w-full rounded border px-3 py-2" />
      </div>
      <div>
        <label class="block text-sm font-medium">Duration (minutes)</label>
        <input name="duration_minutes" value="{{ old('duration_minutes', $service->duration_minutes) }}" class="w-full rounded border px-3 py-2" />
      </div>
      <div>
        <label class="block text-sm font-medium">Cost</label>
        <input name="cost" value="{{ old('cost', $service->cost) }}" class="w-full rounded border px-3 py-2" />
      </div>
      <div>
        <label class="block text-sm font-medium">Description</label>
        <textarea name="description" class="w-full rounded border px-3 py-2">{{ old('description', $service->description) }}</textarea>
      </div>
      <div class="flex gap-2">
        <button class="px-4 py-2 bg-primary text-white rounded">Save</button>
        <a href="{{ route('services.index') }}" class="px-4 py-2 border rounded">Cancel</a>
      </div>
    </div>
  </form>
</div>
@endsection
