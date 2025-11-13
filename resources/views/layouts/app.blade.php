<!DOCTYPE html>
<html class="light" lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Sun Rise Clinic')</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet"/>
    <script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            colors: {
              "primary": "#3ce619",
              "background-light": "#f6f8f6",
              "background-dark": "#142111",
            },
            fontFamily: {
              "display": ["Manrope", "sans-serif"]
            },
            borderRadius: {"DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px"},
          },
        },
      }
    </script>
    <style>
      .material-symbols-outlined {
          font-variation-settings:
          'FILL' 0,
          'wght' 400,
          'GRAD' 0,
          'opsz' 24
      }
    </style>
    @stack('head')
  </head>
  <body class="font-display bg-background-light dark:bg-background-dark">
    <div class="relative flex min-h-screen w-full">
      <!-- SideNavBar -->
      <aside class="flex flex-col w-64 bg-white dark:bg-background-dark dark:border-r dark:border-white/10 p-4 shrink-0">
        <div class="flex flex-col grow justify-between">
          <div class="flex flex-col gap-4">
            <div class="flex items-center gap-3 p-2">
              <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10" data-alt="Profile picture" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuBZviud_nTyaAIGUCBfDhw2oyoL163dp3MEBZ0Utxx3r_8tA1Kl1RBXAf8KZ0uBXRl-wct___d4-WQMTyPELq7hqlP_Cw8q0LFBUH8zLFvNCI8dznnZpILrDJ_OI-q4W9XaPyzIFoSxS3VT8ojCk7hhzGpEaFtGBk5sJRClxmY8MyUBB_Vw_AVXGYXWNpoO0697DFDD16h7e5zfupYe8qvrYOJ4gqGHj813QNtVBfguiaJqx4o0HmyUYbTf4_qPaGFMpTQSZa0YFAxZ");'></div>
              <div class="flex flex-col">
                @auth
                  <h1 class="text-[#121811] dark:text-white text-base font-medium leading-normal">{{ auth()->user()->name }}</h1>
                  <p class="text-[#698863] dark:text-gray-400 text-sm font-normal leading-normal">@if(auth()->user()->is_admin) Administrator @else Staff @endif</p>
                @else
                  <h1 class="text-[#121811] dark:text-white text-base font-medium leading-normal">Dr. Evelyn Reed</h1>
                  <p class="text-[#698863] dark:text-gray-400 text-sm font-normal leading-normal">Administrator</p>
                @endauth
              </div>
            </div>
            <nav class="flex flex-col gap-2 mt-4">
              <a class="flex items-center gap-3 px-3 py-2 text-[#121811] dark:text-gray-300 {{ request()->is('dashboard') ? 'bg-primary/10 rounded-lg' : 'hover:bg-primary/10 rounded-lg' }}" href="{{ url('/dashboard') }}">
                <span class="material-symbols-outlined text-2xl">grid_view</span>
                <p class="text-sm font-medium leading-normal">Dashboard</p>
              </a>

              <a class="flex items-center gap-3 px-3 py-2 text-[#121811] dark:text-gray-300 {{ request()->is('appointments*') ? 'bg-primary/10 rounded-lg' : 'hover:bg-primary/10 rounded-lg' }}" href="{{ route('appointments.manage') }}">
                <span class="material-symbols-outlined text-2xl">calendar_month</span>
                <p class="text-sm font-medium leading-normal">Appointments</p>
              </a>

              <a class="flex items-center gap-3 px-3 py-2 text-[#121811] dark:text-gray-300 {{ request()->is('book') ? 'bg-primary/10 rounded-lg' : 'hover:bg-primary/10 rounded-lg' }}" href="{{ url('/book') }}">
                <span class="material-symbols-outlined text-2xl">event_available</span>
                <p class="text-sm font-medium leading-normal">Book Appointment</p>
              </a>

              <a class="flex items-center gap-3 px-3 py-2 text-[#121811] dark:text-gray-300 {{ request()->is('doctors*') || request()->is('doctor-schedule') ? 'bg-primary/10 rounded-lg' : 'hover:bg-primary/10 rounded-lg' }}" href="{{ url('/doctor-schedule') }}">
                <span class="material-symbols-outlined text-2xl">schedule</span>
                <p class="text-sm font-medium leading-normal">Doctor Schedule</p>
              </a>

              <a class="flex items-center gap-3 px-3 py-2 {{ request()->is('services*') ? 'bg-primary/20 text-primary dark:bg-primary/30 dark:text-white rounded-lg' : 'text-[#121811] dark:text-gray-300 hover:bg-primary/10 rounded-lg' }}" href="{{ route('services.index') }}">
                <span class="material-symbols-outlined text-2xl" style="font-variation-settings: 'FILL' 1;">list_alt</span>
                <p class="text-sm font-medium leading-normal">Services</p>
              </a>

              <a class="flex items-center gap-3 px-3 py-2 text-[#121811] dark:text-gray-300 {{ request()->is('patients*') ? 'bg-primary/10 rounded-lg' : 'hover:bg-primary/10 rounded-lg' }}" href="{{ route('patients.manage') }}">
                <span class="material-symbols-outlined text-2xl">group</span>
                <p class="text-sm font-medium leading-normal">Patients</p>
              </a>
            </nav>
          </div>
          <div class="flex flex-col gap-4">
            <div class="flex flex-col gap-1">
              <a class="flex items-center gap-3 px-3 py-2 text-[#121811] dark:text-gray-300 hover:bg-primary/10 rounded-lg" href="{{ url('/settings') }}">
                <span class="material-symbols-outlined text-2xl">settings</span>
                <p class="text-sm font-medium leading-normal">Settings</p>
              </a>
              <a class="flex items-center gap-3 px-3 py-2 text-[#121811] dark:text-gray-300 hover:bg-primary/10 rounded-lg" href="{{ url('/help') }}">
                <span class="material-symbols-outlined text-2xl">help_outline</span>
                <p class="text-sm font-medium leading-normal">Help Center</p>
              </a>
            </div>
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit" class="flex w-full cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 bg-primary text-background-dark text-sm font-bold leading-normal tracking-wide">
                <span class="truncate">Sign Out</span>
              </button>
            </form>
          </div>
        </div>
      </aside>
      <!-- Main Content -->
      <main class="flex-1 p-8">
        <div class="w-full max-w-7xl mx-auto">
          {{-- flash messages (success / error) --}}
          @if(session('success'))
            <div class="mb-4 p-3 rounded bg-green-50 border border-green-200 text-green-800">
              {{ session('success') }}
            </div>
          @endif
          @if(session('error'))
            <div class="mb-4 p-3 rounded bg-red-50 border border-red-200 text-red-800">
              {{ session('error') }}
            </div>
          @endif

          @yield('content')
        </div>
      </main>
    </div>
    @stack('scripts')
  </body>
</html>
