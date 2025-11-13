<!DOCTYPE html>

<html class="light" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Sun Rise Clinic - Patient Management</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet"/>
<script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#4A90E2", // Soft blue
                        "secondary": "#F5A623", // Warm yellow/orange
                        "background-light": "#F4F7F9",
                        "background-dark": "#1f2937", // A darker gray for dark mode
                        "text-light": "#4A4A4A",
                        "text-dark": "#E5E7EB",
                        "card-light": "#FFFFFF",
                        "card-dark": "#374151",
                        "border-light": "#E5E7EB",
                        "border-dark": "#4B5563"
                    },
                    fontFamily: {
                        "display": ["Manrope", "sans-serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
<style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            font-size: 24px;
        }
    </style>
</head>
<body class="font-display bg-background-light dark:bg-background-dark text-text-light dark:text-text-dark">
<div class="flex h-screen w-full">
<!-- Left Sidebar -->
<aside class="flex flex-col w-96 min-w-96 border-r border-border-light dark:border-border-dark bg-card-light dark:bg-card-dark">
<!-- Sidebar Header -->
<div class="p-4 border-b border-border-light dark:border-border-dark">
<div class="flex items-center gap-3">
<div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10" data-alt="Sunrise logo for the clinic" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuDw_2x2jjaL4OdGa6CDfWjOuah7ZDjJuPdEX3xLFnwxtyItnLE2jtE9eyyO3lVtNVuCYjTr93bnMHqBBo4umAQSh8mzc5jsITIxSvSlvHdQlT6DyvAKQRiBozb0Rr4AlgfEmd1KcHTmB4O2e4QZH9S6mm72Up9knxreU80CnTTFA7K7z7eygOZ3GjcS3qqnrLZoTErh2CcMerGQMbFcqqsflUQS8C0osjSHc_jyhbmV7mJ3VM2Tc0m1tohcTqZQEAVNYYB3NNqXbU4f');"></div>
<div class="flex flex-col">
<h1 class="text-text-light dark:text-text-dark text-base font-bold">Sun Rise Clinic</h1>
<p class="text-gray-500 dark:text-gray-400 text-sm font-normal">Staff Portal</p>
</div>
</div>
</div>
<!-- Search and Filters -->
<div class="p-4 space-y-4">
<div class="px-0 py-0">
<label class="flex flex-col min-w-40 h-12 w-full">
<div class="flex w-full flex-1 items-stretch rounded-lg h-full">
<div class="text-gray-500 dark:text-gray-400 flex border-none bg-background-light dark:bg-background-dark items-center justify-center pl-4 rounded-l-lg border-r-0">
<span class="material-symbols-outlined">search</span>
</div>
<input class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-text-light dark:text-text-dark focus:outline-0 focus:ring-0 border-none bg-background-light dark:bg-background-dark focus:border-none h-full placeholder:text-gray-500 dark:placeholder:text-gray-400 px-4 rounded-l-none border-l-0 pl-2 text-base font-normal" placeholder="Search by name, ID..." value=""/>
</div>
</label>
</div>
<div class="flex gap-2 flex-wrap">
<button class="flex h-8 shrink-0 items-center justify-center gap-x-2 rounded-lg bg-background-light dark:bg-background-dark pl-3 pr-2 border border-border-light dark:border-border-dark">
<p class="text-text-light dark:text-text-dark text-sm font-medium">Filter by Doctor</p>
<span class="material-symbols-outlined text-base">expand_more</span>
</button>
<button class="flex h-8 shrink-0 items-center justify-center gap-x-2 rounded-lg bg-background-light dark:bg-background-dark pl-3 pr-2 border border-border-light dark:border-border-dark">
<p class="text-text-light dark:text-text-dark text-sm font-medium">Sort by Name</p>
<span class="material-symbols-outlined text-base">expand_more</span>
</button>
</div>
</div>
<!-- Patient List -->
<div class="flex-1 overflow-y-auto px-2">
<div class="flex flex-col">
    @if(!empty($patients) && $patients->count())
        @foreach($patients as $patient)
            <div class="flex items-center gap-4 rounded-lg px-2 min-h-[72px] py-2 justify-between hover:bg-background-light dark:hover:bg-background-dark">
                <div class="flex items-center gap-4">
                      <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full h-12" data-alt="Profile picture" style="background-image: url('{{ $patient->avatar_url ?? "https://via.placeholder.com/48" }}');"></div>
                    <div class="flex flex-col justify-center">
                        <p class="text-text-light dark:text-text-dark text-base font-medium">{{ $patient->name }}</p>
                        <p class="text-gray-500 dark:text-gray-400 text-sm font-normal">ID: P{{ $patient->id }} | DOB: {{ $patient->dob ?? '-' }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <a href="{{ route('patients.edit', $patient) }}" class="px-3 py-2 rounded bg-background-light dark:bg-background-dark border border-border-light hover:bg-primary/10 text-sm">Edit</a>
                    <form action="{{ route('patients.destroy', $patient) }}" method="POST" onsubmit="return confirm('Delete this patient?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-3 py-2 rounded bg-red-50 text-red-600 text-sm">Delete</button>
                    </form>
                    <a href="{{ route('appointments.manage') }}?patient={{ $patient->id }}" class="px-3 py-2 rounded bg-primary text-white text-sm">Book</a>
                </div>
            </div>
        @endforeach
    @else
        <div class="p-4 text-center text-gray-500">No patients found. Run seeders to populate sample patients.</div>
    @endif
</div>
</div>
<!-- Sidebar Footer -->
<div class="p-4 mt-auto border-t border-border-light dark:border-border-dark">
<a href="{{ route('patients.create') }}" class="flex min-w-[84px] w-full cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 px-4 bg-primary text-white text-base font-bold leading-normal tracking-[0.015em] gap-2">
<span class="material-symbols-outlined">add</span>
<span class="truncate">Add New Patient</span>
</a>
</div>
</aside>
<!-- Main Content -->
<main class="flex-1 bg-background-light dark:bg-background-dark overflow-y-auto">
<div class="p-8">
<!-- Patient Header -->
<div class="flex p-4 @container bg-card-light dark:bg-card-dark rounded-xl shadow-sm">
<div class="flex w-full flex-col gap-4 @[520px]:flex-row @[520px]:justify-between @[520px]:items-center">
<div class="flex gap-6 items-center">
<div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full h-32 w-32" data-alt="Profile picture of Eleanor Pena" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuCP6pVg2gOS5dgofcL3RLDuH2I06XSuCY2oUMl6dk6vcffQXyej7A7qpW_bzBELCkUgKSGo0gMPSDirsu8EARZZ4BawxGWPZJqEEWncY43uDkL32TFyvQGgBqUwFwj690wDESeRRSFs4vhipLYkurifPT-HsU8eNb44Xd7Phbjm-Q2LwAuvlWo5m5mGbzSw-t4SLhrNHg5LfEYUtbAmrCTQaFxxP1M6zdx83slXCp8o_kiJtNIgV_ZPiKNRXmWoWMc6zfAMdXyQlpuk');"></div>
<div class="flex flex-col justify-center gap-1">
<p class="text-text-light dark:text-text-dark text-3xl font-bold">Eleanor Pena, 36</p>
<p class="text-gray-500 dark:text-gray-400 text-base font-normal">Patient ID: P12345</p>
<p class="text-gray-500 dark:text-gray-400 text-base font-normal">Last Visit: 03/20/2024 with Dr. Smith</p>
</div>
</div>
<div class="flex w-full max-w-[480px] gap-3 @[480px]:w-auto">
                <a href="{{ route('patients.edit', ['patient' => $patients->first() ?? 0]) }}" class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 bg-background-light dark:bg-background-dark text-text-light dark:text-text-dark text-sm font-bold tracking-[0.015em] flex-1 @[480px]:flex-auto border border-border-light dark:border-border-dark">
<span class="truncate">Edit Details</span>
</a>
                <a href="{{ route('appointments.manage') }}" class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 bg-primary text-white text-sm font-bold tracking-[0.015em] flex-1 @[480px]:flex-auto">
<span class="truncate">Book Appointment</span>
</a>
</div>
</div>
</div>
<!-- Tab Navigation & Content -->
<div class="mt-8">
<!-- Tabs -->
<div class="border-b border-border-light dark:border-border-dark">
<nav aria-label="Tabs" class="flex -mb-px space-x-6">
<a class="shrink-0 border-b-2 border-primary px-1 pb-3 text-base font-semibold text-primary" href="#">Profile</a>
<a class="shrink-0 border-b-2 border-transparent px-1 pb-3 text-base font-medium text-gray-500 hover:border-gray-300 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200" href="#">Medical History</a>
<a class="shrink-0 border-b-2 border-transparent px-1 pb-3 text-base font-medium text-gray-500 hover:border-gray-300 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200" href="#">Appointments</a>
<a class="shrink-0 border-b-2 border-transparent px-1 pb-3 text-base font-medium text-gray-500 hover:border-gray-300 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200" href="#">Notes</a>
</nav>
</div>
<!-- Tab Content: Profile -->
<div class="mt-6 grid grid-cols-1 lg:grid-cols-3 gap-6">
<!-- Personal Details Card -->
<div class="lg:col-span-2 bg-card-light dark:bg-card-dark rounded-xl shadow-sm p-6">
<h3 class="text-xl font-bold text-text-light dark:text-text-dark mb-4">Personal Details</h3>
<div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4">
<div>
<label class="text-sm font-medium text-gray-500 dark:text-gray-400">Full Name</label>
<p class="text-base text-text-light dark:text-text-dark">Eleanor Pena</p>
</div>
<div>
<label class="text-sm font-medium text-gray-500 dark:text-gray-400">Date of Birth</label>
<p class="text-base text-text-light dark:text-text-dark">May 15, 1988</p>
</div>
<div>
<label class="text-sm font-medium text-gray-500 dark:text-gray-400">Gender</label>
<p class="text-base text-text-light dark:text-text-dark">Female</p>
</div>
<div>
<label class="text-sm font-medium text-gray-500 dark:text-gray-400">Marital Status</label>
<p class="text-base text-text-light dark:text-text-dark">Single</p>
</div>
<div class="md:col-span-2">
<label class="text-sm font-medium text-gray-500 dark:text-gray-400">Address</label>
<p class="text-base text-text-light dark:text-text-dark">2715 Ash Dr. San Jose, South Dakota 83475</p>
</div>
</div>
</div>
<!-- Contact Info & Emergency Contact Card -->
<div class="space-y-6">
<div class="bg-card-light dark:bg-card-dark rounded-xl shadow-sm p-6">
<h3 class="text-xl font-bold text-text-light dark:text-text-dark mb-4">Contact Information</h3>
<div class="space-y-3">
<div>
<label class="text-sm font-medium text-gray-500 dark:text-gray-400">Email Address</label>
<p class="text-base text-text-light dark:text-text-dark">eleanor.pena@example.com</p>
</div>
<div>
<label class="text-sm font-medium text-gray-500 dark:text-gray-400">Phone Number</label>
<p class="text-base text-text-light dark:text-text-dark">(219) 555-0114</p>
</div>
</div>
</div>
<div class="bg-card-light dark:bg-card-dark rounded-xl shadow-sm p-6">
<h3 class="text-xl font-bold text-text-light dark:text-text-dark mb-4">Emergency Contact</h3>
<div class="space-y-3">
<div>
<label class="text-sm font-medium text-gray-500 dark:text-gray-400">Name</label>
<p class="text-base text-text-light dark:text-text-dark">Ronald Richards (Father)</p>
</div>
<div>
<label class="text-sm font-medium text-gray-500 dark:text-gray-400">Phone Number</label>
<p class="text-base text-text-light dark:text-text-dark">(308) 555-0121</p>
</div>
</div>
</div>
</div>
<!-- Alerts / Important Info Card -->
<div class="lg:col-span-3 bg-secondary/20 dark:bg-secondary/30 border-l-4 border-secondary rounded-r-lg p-6 flex items-start gap-4">
<span class="material-symbols-outlined text-secondary text-3xl mt-1">warning</span>
<div>
<h3 class="text-xl font-bold text-text-light dark:text-text-dark mb-2">Important Alerts</h3>
<ul class="list-disc list-inside space-y-1 text-text-light dark:text-text-dark">
<li>Allergy: Penicillin</li>
<li>Pre-existing condition: Mild Asthma</li>
<li>Patient has requested appointment reminders via SMS.</li>
</ul>
</div>
</div>
</div>
</div>
</div>
</main>
</div>
</body></html>