@extends('layouts.app')

@section('title', 'Doctors - Sun Rise Clinic')

@section('content')
<div class="p-4">
  <div class="max-w-4xl mx-auto bg-white dark:bg-background-dark p-6 rounded-lg border">
      <div class="flex items-center justify-between mb-4">
      <h1 class="text-2xl font-bold">Doctors</h1>
      @can('create', \App\Models\Doctor::class)
        <a href="{{ route('doctors.create') }}" class="px-4 py-2 bg-primary text-white rounded">Add Doctor</a>
      @endcan
    </div>
    <table class="w-full table-auto">
      <thead>
        <tr class="text-left text-sm text-gray-600">
          <th>Name</th>
          <th>Specialty</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach(\App\Models\Doctor::orderBy('name')->get() as $d)
        <tr class="border-t">
          <td class="py-2">{{ $d->name }}</td>
          <td class="py-2">{{ $d->specialty }}</td>
          <td class="py-2 text-right">
            @can('update', $d)
              <a href="{{ route('doctors.edit', $d) }}" class="text-primary">Edit</a>
            @endcan
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection
