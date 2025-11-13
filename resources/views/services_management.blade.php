@extends('layouts.app')

@section('title', 'Manage Clinic Services - Sun Rise Clinic')

@section('content')
  <!-- PageHeading -->
  <div class="flex flex-wrap justify-between items-start gap-4 mb-8">
    <div class="flex flex-col gap-2">
      <h1 class="text-[#121811] dark:text-white text-4xl font-black leading-tight tracking-[-0.033em]">Manage Clinic Services</h1>
      <p class="text-[#698863] dark:text-gray-400 text-base font-normal leading-normal">Add, edit, and remove the types of services offered at Sun Rise Clinic.</p>
    </div>
    <div class="flex items-center gap-4">
      {{-- flash messages --}}
      @if(session('success'))
        <div class="px-4 py-2 rounded bg-green-100 text-green-800">{{ session('success') }}</div>
      @endif

      {{-- Simple inline create form --}}
      <form method="POST" action="{{ route('services.store') }}" class="flex items-center gap-2">
        @csrf
        <input name="name" value="{{ old('name') }}" placeholder="Service name" class="px-3 py-2 rounded border border-[#dde5dc]" />
        <input name="duration_minutes" value="{{ old('duration_minutes') }}" placeholder="Duration (min)" class="px-3 py-2 rounded border border-[#dde5dc] w-28" />
        <input name="cost" value="{{ old('cost') }}" placeholder="Cost" class="px-3 py-2 rounded border border-[#dde5dc] w-28" />
        <button type="submit" class="flex items-center justify-center gap-2 min-w-[84px] cursor-pointer overflow-hidden rounded-lg h-10 px-4 bg-primary text-[#121811] text-sm font-bold leading-normal tracking-wide">
          <span class="material-symbols-outlined text-xl">add</span>
          <span class="truncate">Add</span>
        </button>
      </form>
    </div>
    {{-- validation errors --}}
    @if($errors->any())
      <div class="mt-3 space-y-1">
        @foreach($errors->all() as $error)
          <div class="text-red-600 text-sm">{{ $error }}</div>
        @endforeach
      </div>
    @endif
  </div>

  <!-- SearchBar -->
  <div class="mb-6">
    <label class="flex flex-col min-w-40 h-12 w-full max-w-lg">
      <div class="flex w-full flex-1 items-stretch rounded-lg h-full">
        <div class="text-[#698863] dark:text-gray-400 flex bg-white dark:bg-background-dark dark:border dark:border-white/10 items-center justify-center pl-4 rounded-l-lg border-r-0">
          <span class="material-symbols-outlined text-2xl">search</span>
        </div>
        <input class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-[#121811] dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary/50 border-none bg-white dark:bg-background-dark dark:border dark:border-white/10 focus:border-none h-full placeholder:text-[#698863] dark:placeholder:text-gray-500 px-4 rounded-l-none border-l-0 pl-2 text-base font-normal leading-normal" placeholder="Search for a service by name" value=""/>
      </div>
    </label>
  </div>

  <!-- Table -->
  <div class="overflow-hidden rounded-lg border border-[#dde5dc] dark:border-white/10 bg-white dark:bg-background-dark">
    <div class="overflow-x-auto">
      <table class="w-full">
        <thead class="bg-background-light dark:bg-white/5">
          <tr>
            <th class="px-4 py-3 text-left text-[#121811] dark:text-gray-300 w-1/4 text-sm font-medium leading-normal">Service Name</th>
            <th class="px-4 py-3 text-left text-[#121811] dark:text-gray-300 w-1/6 text-sm font-medium leading-normal">Duration</th>
            <th class="px-4 py-3 text-left text-[#121811] dark:text-gray-300 w-1/6 text-sm font-medium leading-normal">Cost</th>
            <th class="px-4 py-3 text-left text-[#121811] dark:text-gray-300 w-1/3 text-sm font-medium leading-normal">Description</th>
            <th class="px-4 py-3 text-left text-[#121811] dark:text-gray-300 w-auto text-sm font-medium leading-normal">Actions</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-[#dde5dc] dark:divide-white/10">
          @forelse($services as $service)
            <tr>
              <td class="h-[72px] px-4 py-2 text-[#121811] dark:text-white text-sm font-normal leading-normal">{{ $service->name }}</td>
              <td class="h-[72px] px-4 py-2 text-[#698863] dark:text-gray-400 text-sm font-normal leading-normal">{{ $service->duration_minutes ? $service->duration_minutes . ' min' : '-' }}</td>
              <td class="h-[72px] px-4 py-2 text-[#698863] dark:text-gray-400 text-sm font-normal leading-normal">${{ number_format($service->cost, 2) }}</td>
              <td class="h-[72px] px-4 py-2 text-[#698863] dark:text-gray-400 text-sm font-normal leading-normal">{{ $service->description }}</td>
              <td class="h-[72px] px-4 py-2 text-sm">
                <div class="flex items-center gap-2">
                  <a href="javascript:void(0)" onclick="openServiceEdit({{ $service->id }})" class="p-2 text-[#698863] dark:text-gray-400 hover:text-primary dark:hover:text-primary rounded-md hover:bg-primary/10"><span class="material-symbols-outlined text-xl">edit</span></a>
                  <form action="{{ route('services.destroy', $service) }}" method="POST" onsubmit="return confirm('Delete this service?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="p-2 text-[#698863] dark:text-gray-400 hover:text-red-500 rounded-md hover:bg-red-500/10"><span class="material-symbols-outlined text-xl">delete</span></button>
                  </form>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="5" class="p-4 text-center text-gray-500">No services found. Run the database seeders to populate sample data.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
  <!-- Edit Service Modal (loaded via AJAX) -->
  <div id="service-edit-modal" class="fixed inset-0 hidden items-center justify-center bg-black/40">
    <div class="bg-white dark:bg-background-dark rounded-lg max-w-2xl w-full p-6">
      <div id="service-edit-content">Loading…</div>
      <div class="mt-4 text-right">
        <button onclick="closeServiceModal()" class="px-4 py-2 border rounded">Close</button>
      </div>
    </div>
  </div>

  @push('scripts')
  <script>
    function openServiceEdit(id){
      var modal = document.getElementById('service-edit-modal');
      var content = document.getElementById('service-edit-content');
      modal.classList.remove('hidden');
      content.innerHTML = 'Loading…';
      fetch('/services/' + id + '/edit?modal=1')
        .then(r => r.text())
        .then(html => content.innerHTML = html)
        .catch(err => content.innerHTML = '<div class="text-red-600">Error loading form</div>');
    }
    function closeServiceModal(){
      document.getElementById('service-edit-modal').classList.add('hidden');
    }
  </script>
  @endpush
  <!-- Pagination -->
  <div class="flex items-center justify-center mt-6">
    <a class="flex size-10 items-center justify-center text-[#121811] dark:text-gray-300" href="#">
      <span class="material-symbols-outlined text-xl">chevron_left</span>
    </a>
    <a class="text-sm font-bold leading-normal flex size-10 items-center justify-center text-background-dark bg-primary rounded-full" href="#">1</a>
    <a class="text-sm font-normal leading-normal flex size-10 items-center justify-center text-[#121811] dark:text-gray-300 rounded-full hover:bg-primary/20" href="#">2</a>
    <a class="text-sm font-normal leading-normal flex size-10 items-center justify-center text-[#121811] dark:text-gray-300 rounded-full hover:bg-primary/20" href="#">3</a>
    <span class="text-sm font-normal leading-normal flex size-10 items-center justify-center text-[#121811] dark:text-gray-300 rounded-full">...</span>
    <a class="text-sm font-normal leading-normal flex size-10 items-center justify-center text-[#121811] dark:text-gray-300 rounded-full hover:bg-primary/20" href="#">8</a>
    <a class="text-sm font-normal leading-normal flex size-10 items-center justify-center text-[#121811] dark:text-gray-300 rounded-full hover:bg-primary/20" href="#">9</a>
    <a class="text-sm font-normal leading-normal flex size-10 items-center justify-center text-[#121811] dark:text-gray-300 rounded-full hover:bg-primary/20" href="#">10</a>
    <a class="flex size-10 items-center justify-center text-[#121811] dark:text-gray-300" href="#">
      <span class="material-symbols-outlined text-xl">chevron_right</span>
    </a>
  </div>
@endsection