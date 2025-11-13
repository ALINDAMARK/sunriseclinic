<!DOCTYPE html>

<html class="light" lang="en"><head>
<meta charset="utf-8"/>
<meta name="csrf-token" content="{{ csrf_token() }}">
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
        /* simple spinner */
        .spinner { display:inline-block; width:16px; height:16px; border:2px solid rgba(0,0,0,0.1); border-left-color:rgba(0,0,0,0.6); border-radius:50%; animation:spin 0.8s linear infinite; }
        @keyframes spin { to { transform: rotate(360deg); } }
    /* Modal and validation styles */
    .modal-overlay { position: fixed; inset: 0; background: rgba(0,0,0,0.4); display:flex; align-items:center; justify-content:center; z-index:50; }
    .modal-panel { background: var(--tw-bg-opacity, #fff); border-radius: 0.5rem; max-width: 520px; width: 100%; box-shadow: 0 10px 30px rgba(2,6,23,0.2); }
    .input-invalid { border-color: #ef4444 !important; background-color: rgba(254, 226, 226, 0.4); }
    .tooltip { position: relative; display:inline-block; }
    /* ARIA-friendly tooltip panel shown on hover/focus of the trigger button */
    .tooltip-panel { display: none; }
    .tooltip button:focus + .tooltip-panel,
    .tooltip button:hover + .tooltip-panel { display: block; }
    .tooltip-panel { position: absolute; bottom: calc(100% + 8px); right: 0; background: rgba(55,65,81,0.95); color:#fff; padding:6px 8px; font-size:12px; border-radius:6px; white-space:nowrap; z-index: 40; }

    /* Small toast */
    .sr-toast { position: fixed; right: 1rem; bottom: 1.25rem; z-index:60; min-width:180px; max-width:320px; }
    .sr-toast .panel { background: rgba(15,23,42,0.95); color: #fff; padding: 10px 14px; border-radius: 8px; box-shadow: 0 6px 20px rgba(2,6,23,0.3); }
    /* Responsive collapsible sidebar */
    .sidebar { transition: left .18s ease, width .18s ease; }
    .hide-when-collapsed { transition: opacity .12s linear; }
    /* When collapsed on desktop, hide elements marked and reduce width */
    .sidebar-collapsed .sidebar { width: 64px !important; min-width: 64px !important; }
    .sidebar-collapsed .hide-when-collapsed { display: none !important; opacity: 0 !important; }
    /* Mobile: off-canvas behavior */
    @media (max-width: 640px){
        .sidebar { position: fixed; left: -100%; top: 0; bottom: 0; z-index: 40; width: 72%; max-width: 320px; }
        .sidebar-open .sidebar { left: 0; }
        .content-overlay { display: none; }
        .sidebar-open .content-overlay { display: block; position: fixed; inset: 0; background: rgba(0,0,0,0.4); z-index: 30; }
    }
    </style>
</head>
<body class="font-display bg-background-light dark:bg-background-dark text-text-light dark:text-text-dark">
<div class="flex h-screen w-full">
<!-- Left Sidebar -->
<aside class="sidebar flex flex-col w-72 md:w-72 min-w-0 md:min-w-72 border-r border-border-light dark:border-border-dark bg-card-light dark:bg-card-dark" style="min-width:5rem;">
<!-- Sidebar Header (restored staff avatar) -->
<div class="p-4 border-b border-border-light dark:border-border-dark">
    <div class="flex items-center gap-3">
        <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10" data-alt="Profile picture" data-avatar="https://via.placeholder.com/80"></div>
        <div class="flex flex-col">
            <h1 class="text-text-light dark:text-text-dark text-base font-bold">Sun Rise Clinic</h1>
            <p class="text-gray-500 dark:text-gray-400 text-sm font-normal">Staff Portal</p>
        </div>
    </div>
</div>
<!-- Sidebar: only show search and the patient list -->
<!-- (Header and navigation removed to keep sidebar focused on patient discovery) -->
<!-- Primary navigation (Doctors) -->
<nav class="flex flex-col gap-1 p-3">
    <a class="flex items-center gap-3 px-3 py-2 text-text-light dark:text-text-dark hover:bg-primary/10 rounded-lg" href="{{ route('doctors.index') }}">
        <span class="material-symbols-outlined text-2xl">medical_services</span>
        <p class="text-sm font-medium">Doctors</p>
    </a>
</nav>
<!-- Search and Filters -->
<div class="p-4">
    <form id="patient-filters" method="GET" action="{{ route('patients.manage') }}" class="flex flex-col sm:flex-row sm:items-end gap-3">
        <!-- Search box -->
        <div class="flex-1 sm:flex-initial">
            <label class="sr-only" for="p-search">Search patients</label>
            <div class="flex items-center h-12 rounded-lg bg-background-light dark:bg-background-dark border border-border-light dark:border-border-dark overflow-hidden">
                <div class="text-gray-500 dark:text-gray-400 flex items-center justify-center pl-3 pr-2">
                    <span class="material-symbols-outlined">search</span>
                </div>
                <input id="p-search" name="search" value="{{ request('search') }}" class="flex-1 h-full bg-transparent px-3 text-sm text-text-light dark:text-text-dark placeholder:text-gray-500 dark:placeholder:text-gray-400 focus:outline-none" placeholder="Search by name, ID or email..." />
            </div>
        </div>

        <!-- Doctor select with inline Add action -->
        <div class="w-full sm:w-48">
            <label class="block text-sm text-gray-500 dark:text-gray-400 mb-1">Doctor</label>
            <div class="flex gap-2 items-center">
                <select id="p-doctor" name="doctor_id" class="flex-1 block w-full rounded-lg border border-border-light dark:border-border-dark bg-background-light dark:bg-background-dark text-text-light dark:text-text-dark px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary">
                    <option value="">All doctors</option>
                    @foreach($doctors ?? [] as $d)
                        <option value="{{ $d->id }}" {{ (string)request('doctor_id') === (string)$d->id ? 'selected' : '' }}>{{ $d->name }}</option>
                    @endforeach
                </select>
                <button id="add-doctor-inline" type="button" class="h-10 w-10 rounded-lg bg-white dark:bg-card-dark border border-border-light dark:border-border-dark flex items-center justify-center hover:bg-primary/10 focus:outline-none focus:ring-2 focus:ring-primary" aria-label="Add doctor">
                    <span class="material-symbols-outlined">add</span>
                </button>
            </div>
        </div>

        <!-- Sort select -->
        <div class="w-full sm:w-44">
            <label class="block text-sm text-gray-500 dark:text-gray-400 mb-1">Sort</label>
            <select id="p-sort" name="sort" class="block w-full rounded-lg border border-border-light dark:border-border-dark bg-background-light dark:bg-background-dark text-text-light dark:text-text-dark px-3 py-2 text-sm">
                <option value="name_asc" {{ request('sort') === 'name_asc' ? 'selected' : '' }}>Name ↑</option>
                <option value="name_desc" {{ request('sort') === 'name_desc' ? 'selected' : '' }}>Name ↓</option>
                <option value="id_asc" {{ request('sort') === 'id_asc' ? 'selected' : '' }}>ID ↑</option>
            </select>
        </div>

        <!-- Actions -->
        <div class="flex gap-2 ml-auto items-center">
            <button id="p-apply" type="submit" class="h-10 px-4 rounded-lg bg-primary text-white text-sm transition hover:brightness-95 focus:outline-none focus:ring-2 focus:ring-primary">Apply</button>
            <a id="p-reset" href="{{ route('patients.manage') }}" class="h-10 px-4 rounded-lg bg-white dark:bg-card-dark border border-border-light dark:border-border-dark text-sm flex items-center justify-center transition hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-primary">Reset</a>
        </div>
    </form>
</div>
<!-- Patient List -->
<div class="flex-1 overflow-y-auto px-2">
<div id="patient-list" class="flex flex-col">
    @if(!empty($patients) && $patients->count())
        @foreach($patients as $patient)
            <div class="flex items-center gap-4 rounded-lg px-2 min-h-[72px] py-2 justify-between hover:bg-background-light dark:hover:bg-background-dark">
                            <div class="flex items-center gap-4">
                                        <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full h-12" data-alt="Profile picture" data-avatar="{{ $patient->avatar_url ?? 'https://via.placeholder.com/48' }}"></div>
                                    <div class="flex flex-col justify-center">
                                            <p class="text-text-light dark:text-text-dark text-base font-medium">{{ $patient->name }}</p>
                                            <p class="text-gray-500 dark:text-gray-400 text-sm font-normal">ID: P{{ $patient->id }} | DOB: {{ $patient->dob ?? '-' }}</p>
                                                 <p class="text-gray-500 dark:text-gray-400 text-sm font-normal">Appointments: {{ $patient->appointments_count ?? 0 }}</p>
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
                        <button class="open-details px-3 py-2 rounded bg-background-light dark:bg-background-dark border border-border-light text-sm" data-patient-id="{{ $patient->id }}">Open details</button>
                    </div>
            </div>
        @endforeach
            <div id="patient-pagination" class="mt-4">
                {{ $patients->links() }}
            </div>
    @else
        <div class="p-4 text-center text-gray-500">No patients found. Run seeders to populate sample patients.</div>
    @endif
</div>
</div>
<!-- Sidebar Footer: Add New Patient (restored) -->
<div class="p-4 mt-auto border-t border-border-light dark:border-border-dark">
    <a href="{{ route('patients.create') }}" class="flex min-w-[84px] w-full cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 px-4 bg-primary text-white text-base font-bold leading-normal tracking-[0.015em] gap-2">
        <span class="material-symbols-outlined">add</span>
        <span class="truncate">Add New Patient</span>
    </a>
</div>
@include('partials.add_doctor_modal')
</aside>
<!-- simple accessible toast container -->
<div id="sr-toast" class="sr-toast" aria-live="polite" aria-atomic="true" style="display:none;">
    <div class="panel">
        <div id="sr-toast-message" class="text-sm">&nbsp;</div>
    </div>
</div>
<!-- Main Content -->
<main class="flex-1 bg-background-light dark:bg-background-dark overflow-y-auto">
<div class="p-8">
<!-- Patient Header -->
<div class="flex p-4 @container bg-card-light dark:bg-card-dark rounded-xl shadow-sm">
<div class="flex w-full flex-col gap-4 @[520px]:flex-row @[520px]:justify-between @[520px]:items-center">
<div id="selected-patient" class="flex gap-6 items-center">
    <div id="selected-avatar" class="bg-center bg-no-repeat aspect-square bg-cover rounded-full h-32 w-32" data-avatar="https://via.placeholder.com/160"></div>
    <div class="flex flex-col justify-center gap-1">
        <p id="selected-name" class="text-text-light dark:text-text-dark text-3xl font-bold">No patient selected</p>
        <p id="selected-id" class="text-gray-500 dark:text-gray-400 text-base font-normal">Patient ID: —</p>
        <p id="selected-last" class="text-gray-500 dark:text-gray-400 text-base font-normal">Last Visit: —</p>
    </div>
</div>
<!-- data hook for JS (avoid inline Blade in script) -->
<div id="patient-data" data-current-patient="{{ optional($patients->first())->id ?? '' }}" style="display:none;"></div>
    <div class="flex w-full max-w-[560px] gap-3 @[480px]:w-auto items-center justify-end">
                <a href="{{ route('patients.edit', ['patient' => $patients->first() ?? 0]) }}" class="flex min-w-[84px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 bg-background-light dark:bg-background-dark text-text-light dark:text-text-dark text-sm font-bold tracking-[0.015em] flex-none border border-border-light dark:border-border-dark">
<span class="truncate">Edit Details</span>
</a>
                <a href="{{ route('appointments.manage') }}" class="flex min-w-[84px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 bg-primary text-white text-sm font-bold tracking-[0.015em] flex-none">
<span class="truncate">Book Appointment</span>
</a>
                <!-- Moved Export action to header for clearer layout -->
                <button id="p-export-header" type="button" class="h-10 px-3 rounded-lg bg-white dark:bg-card-dark border border-border-light dark:border-border-dark text-sm flex items-center justify-center gap-2 transition hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-primary">
                    <span class="material-symbols-outlined">file_download</span>
                    <span>Export</span>
                </button>
    </div>
</div>
</div>
<!-- Tab Navigation & Content -->
<div class="mt-8">
<!-- Tabs -->
<div class="border-b border-border-light dark:border-border-dark">
<nav aria-label="Tabs" class="flex -mb-px space-x-6">
    <a class="patient-tab shrink-0 border-b-2 border-primary px-1 pb-3 text-base font-semibold text-primary" data-tab="profile" href="#">Profile</a>
    <a class="patient-tab shrink-0 border-b-2 border-transparent px-1 pb-3 text-base font-medium text-gray-500 hover:border-gray-300 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200" data-tab="history" href="#">Medical History</a>
    <a class="patient-tab shrink-0 border-b-2 border-transparent px-1 pb-3 text-base font-medium text-gray-500 hover:border-gray-300 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200" data-tab="appointments" href="#">Appointments</a>
    <a class="patient-tab shrink-0 border-b-2 border-transparent px-1 pb-3 text-base font-medium text-gray-500 hover:border-gray-300 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200" data-tab="notes" href="#">Notes</a>
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
<p id="pd-fullname" class="text-base text-text-light dark:text-text-dark">—</p>
</div>
<div>
<label class="text-sm font-medium text-gray-500 dark:text-gray-400">Date of Birth</label>
<p id="pd-dob" class="text-base text-text-light dark:text-text-dark">—</p>
</div>
<div>
<label class="text-sm font-medium text-gray-500 dark:text-gray-400">Gender</label>
<p id="pd-gender" class="text-base text-text-light dark:text-text-dark">—</p>
</div>
<div>
<label class="text-sm font-medium text-gray-500 dark:text-gray-400">Marital Status</label>
<p id="pd-marital" class="text-base text-text-light dark:text-text-dark">—</p>
</div>
<div class="md:col-span-2">
<label class="text-sm font-medium text-gray-500 dark:text-gray-400">Address</label>
<p id="pd-address" class="text-base text-text-light dark:text-text-dark">—</p>
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
<p id="pd-email" class="text-base text-text-light dark:text-text-dark">—</p>
</div>
<div>
<label class="text-sm font-medium text-gray-500 dark:text-gray-400">Phone Number</label>
<p id="pd-phone" class="text-base text-text-light dark:text-text-dark">—</p>
</div>
</div>
</div>
<div class="bg-card-light dark:bg-card-dark rounded-xl shadow-sm p-6">
<h3 class="text-xl font-bold text-text-light dark:text-text-dark mb-4">Emergency Contact</h3>
<div class="space-y-3">
<div>
<label class="text-sm font-medium text-gray-500 dark:text-gray-400">Name</label>
<p id="pd-emergency-name" class="text-base text-text-light dark:text-text-dark">—</p>
</div>
<div>
<label class="text-sm font-medium text-gray-500 dark:text-gray-400">Phone Number</label>
<p id="pd-emergency-phone" class="text-base text-text-light dark:text-text-dark">—</p>
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
<!-- Dynamic tab content container used by AJAX tab loader -->
<div id="patient-tab-content" class="mt-6"></div>
</div>
</div>
</div>
</main>
</div>
<script>
(function(){
    // Simple helper to escape HTML
    function escapeHtml(str){
        if(!str) return '';
        return String(str).replace(/[&<>"'`]/g, function (s) {
            return ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":"&#39;","`":"&#96;"})[s];
        });
    }

    const listEl = document.getElementById('patient-list');
    const paginationEl = document.getElementById('patient-pagination');
    const searchEl = document.getElementById('p-search');
    const doctorEl = document.getElementById('p-doctor');
    const sortEl = document.getElementById('p-sort');
    const exportBtn = document.getElementById('p-export') || document.getElementById('p-export-header');
    const form = document.getElementById('patient-filters');
    let debounceTimer = null;
    // current patient id used by the detail tabs. If there's a server-side selected patient, use its id from the DOM hook.
    let currentPatientId = '';
    const patientDataEl = document.getElementById('patient-data');
    if(patientDataEl){ currentPatientId = patientDataEl.dataset.currentPatient || ''; }
    const tabContentEl = document.getElementById('patient-tab-content');

    function getParams(page){
        const params = new URLSearchParams();
        if(searchEl && searchEl.value) params.set('search', searchEl.value);
        if(doctorEl && doctorEl.value) params.set('doctor_id', doctorEl.value);
        if(sortEl && sortEl.value) params.set('sort', sortEl.value);
        if(page) params.set('page', page);
        return params;
    }

    async function fetchData(page){
        const url = '/patients/data?' + getParams(page).toString();
        try{
            const res = await fetch(url, {credentials: 'same-origin', headers: {'Accept': 'application/json'}});
            if(!res.ok) throw new Error('Fetch failed');
            const json = await res.json();
            renderList(json.data);
            renderPagination(json.meta);
        } catch (e) {
            console.error('Failed to load patients', e);
        }
    }

    function renderList(items){
        if(!listEl) return;
        if(!items || items.length === 0){
            listEl.innerHTML = '<div class="p-4 text-center text-gray-500">No patients found.</div>';
            return;
        }
        const html = items.map(p => {
            return `
            <div data-patient-id="${p.id}" class="patient-row flex items-center gap-4 rounded-lg px-2 min-h-[72px] py-2 justify-between hover:bg-background-light dark:hover:bg-background-dark">
                <div class="flex items-center gap-4">
                    <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full h-12" data-avatar="${escapeHtml(p.avatar_url || 'https://via.placeholder.com/48')}"></div>
                    <div class="flex flex-col justify-center">
                        <p class="text-text-light dark:text-text-dark text-base font-medium">${escapeHtml(p.name)}</p>
                        <p class="text-gray-500 dark:text-gray-400 text-sm font-normal">ID: P${p.id} | DOB: ${escapeHtml(p.dob || '-')}</p>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <a href="/patients/${p.id}/edit" class="px-3 py-2 rounded bg-background-light dark:bg-background-dark border border-border-light hover:bg-primary/10 text-sm">Edit</a>
                    <a href="/appointments/manage?patient=${p.id}" class="px-3 py-2 rounded bg-primary text-white text-sm">Book</a>
                </div>
            </div>`;
        }).join('\n');
        listEl.innerHTML = html;
    // set avatar background images from data-avatar to avoid inline Blade-in-style issues
    listEl.querySelectorAll('[data-avatar]').forEach(function(el){ const url = el.getAttribute('data-avatar'); if(url) el.style.backgroundImage = `url('${url}')`; });
        // attach click handlers to each patient row to select patient and load profile
        listEl.querySelectorAll('.patient-row').forEach(function(row){
            row.addEventListener('click', function(e){
                // clicking the row should select; clicking action buttons should not bubble
                if(e.target.closest('a') || e.target.closest('button')) return;
                const id = this.getAttribute('data-patient-id');
                if(id){
                    selectPatientRow(id, this);
                    currentPatientId = id;
                    loadPatientTab('profile');
                }
            });
        });
        // attach handlers for 'Open details' buttons
        listEl.querySelectorAll('.open-details').forEach(function(btn){
            btn.addEventListener('click', function(e){
                e.preventDefault();
                const id = this.getAttribute('data-patient-id');
                if(!id) return;
                const row = listEl.querySelector(`[data-patient-id="${id}"]`);
                if(row) selectPatientRow(id, row);
                currentPatientId = id;
                loadPatientTab('profile');
            });
        });
    }

    function selectPatientRow(id, rowEl){
        // clear previous
        document.querySelectorAll('.patient-row.selected').forEach(function(r){ r.classList.remove('selected','bg-primary/10'); });
        rowEl.classList.add('selected','bg-primary/10');
    }

    function renderPagination(meta){
        if(!paginationEl) return;
        const current = meta.current_page || 1;
        const last = meta.last_page || 1;
        if(last <= 1){ paginationEl.innerHTML = ''; return; }
        let html = '<div class="flex gap-2">';
        if(current > 1){
            html += `<button data-page="${current-1}" class="px-3 py-1 rounded border">Prev</button>`;
        }
        // show up to 5 pages centered on current
        const start = Math.max(1, current - 2);
        const end = Math.min(last, start + 4);
        for(let p = start; p <= end; p++){
            html += `<button data-page="${p}" class="px-3 py-1 rounded ${p===current? 'bg-primary text-white':'border'}">${p}</button>`;
        }
        if(current < last){
            html += `<button data-page="${current+1}" class="px-3 py-1 rounded border">Next</button>`;
        }
        html += '</div>';
        paginationEl.innerHTML = html;
        // attach handlers
        paginationEl.querySelectorAll('button[data-page]').forEach(btn => {
            btn.addEventListener('click', function(e){
                const page = this.getAttribute('data-page');
                fetchData(page);
            });
        });
    }

    // debounce search
    if(searchEl){
        searchEl.addEventListener('input', function(){
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(function(){ fetchData(1); }, 350);
        });
    }

    if(form){
        form.addEventListener('submit', function(e){ e.preventDefault(); fetchData(1); });
    }

    if(exportBtn){
        exportBtn.addEventListener('click', function(){
            const url = '/patients/export?' + getParams().toString();
            window.location = url;
        });
    }

    // Inline Add Doctor modal behavior
    const addDoctorBtn = document.getElementById('add-doctor-inline');
    const modalOverlay = document.getElementById('modal-add-doctor-overlay');
    const modalRoot = document.getElementById('modal-add-doctor');
    const adForm = document.getElementById('modal-add-doctor-form');
    const adName = document.getElementById('ad-name');
    const adSpecialty = document.getElementById('ad-specialty');
    const adAvatar = document.getElementById('ad-avatar');
    const adSubmit = document.getElementById('ad-submit');
    const adCancel = document.getElementById('ad-cancel');

    function openAddDoctorModal(){
        if(modalRoot) modalRoot.classList.remove('hidden');
        if(modalOverlay) modalOverlay.style.display = 'flex';
        if(adName) adName.focus();
    }
    function closeAddDoctorModal(){
        if(modalRoot) modalRoot.classList.add('hidden');
        if(modalOverlay) modalOverlay.style.display = 'none';
        // clear errors and fields
        ['ad-name-error','ad-specialty-error','ad-avatar-error'].forEach(id => { const el = document.getElementById(id); if(el){ el.style.display='none'; el.textContent=''; } });
        [adName,adSpecialty,adAvatar].forEach(i=>{ if(i){ i.classList.remove('input-invalid'); } });
        if(adForm) adForm.reset();
    }

    // Small accessible toast helper
    function showToast(msg){
        try{
            const t = document.getElementById('sr-toast');
            const m = document.getElementById('sr-toast-message');
            if(!t || !m) return;
            m.textContent = msg;
            t.style.display = 'block';
            t.setAttribute('aria-hidden','false');
            // auto-hide after 3s
            setTimeout(function(){ t.style.display = 'none'; t.setAttribute('aria-hidden','true'); }, 3000);
        }catch(e){ console.warn('toast error', e); }
    }

    if(addDoctorBtn){ addDoctorBtn.addEventListener('click', function(e){ e.preventDefault(); openAddDoctorModal(); }); }
    if(adCancel){ adCancel.addEventListener('click', function(e){ e.preventDefault(); closeAddDoctorModal(); }); }
    if(modalOverlay){ modalOverlay.addEventListener('click', function(e){ if(e.target === modalOverlay){ closeAddDoctorModal(); } }); }

    if(adForm){
        adForm.addEventListener('submit', async function(e){
            e.preventDefault();
            // clear previous errors
            ['ad-name-error','ad-specialty-error','ad-avatar-error'].forEach(id => { const el = document.getElementById(id); if(el){ el.style.display='none'; el.textContent=''; } });
            [adName,adSpecialty,adAvatar].forEach(i=>{ if(i){ i.classList.remove('input-invalid'); } });
            adSubmit.disabled = true;
            const payload = { name: (adName.value||'').trim(), specialty: (adSpecialty.value||'').trim(), avatar_url: (adAvatar.value||'').trim() };
            const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            try{
                const res = await fetch('/doctors', { method: 'POST', credentials: 'same-origin', headers: { 'Content-Type':'application/json', 'X-CSRF-TOKEN': csrf, 'Accept':'application/json' }, body: JSON.stringify(payload) });
                if(res.status === 422){ const j = await res.json(); const errs = j.errors || {}; Object.keys(errs).forEach(f => { const el = document.getElementById('ad-'+f+'-error'); if(el){ el.textContent = errs[f].join(' '); el.style.display='block'; } const input = document.getElementById('ad-'+f); if(input) input.classList.add('input-invalid'); }); adSubmit.disabled = false; return; }
                if(res.status === 403){ showToast('Not authorized to add doctors'); adSubmit.disabled = false; return; }
                if(!res.ok) throw new Error('Failed to create doctor');
                const j = await res.json(); const doc = j.data;
                // append to doctor select and select it
                const opt = document.createElement('option'); opt.value = doc.id; opt.textContent = doc.name; opt.selected = true; if(doctorEl) { doctorEl.appendChild(opt); doctorEl.value = doc.id; doctorEl.focus(); }
                // close modal and show success toast
                closeAddDoctorModal();
                showToast('Doctor created');
            }catch(err){ console.error(err); alert('Failed to add doctor.'); }
            adSubmit.disabled = false;
        });
    }

    // Initial load: fetch filtered data to replace server render
    document.addEventListener('DOMContentLoaded', function(){ fetchData(); });
    // Tab click handling: load appropriate patient data
    document.querySelectorAll('.patient-tab').forEach(function(tab){
        tab.addEventListener('click', function(e){
            e.preventDefault();
            const which = this.getAttribute('data-tab');
            // mark selected
            document.querySelectorAll('.patient-tab').forEach(t => t.classList.remove('border-primary','text-primary'));
            this.classList.add('border-primary','text-primary');
            loadPatientTab(which);
        });
    });

    async function loadPatientTab(which){
        if(!currentPatientId){
            tabContentEl.innerHTML = '<div class="p-4 text-gray-500">Select a patient from the list to view details.</div>';
            return;
        }
        tabContentEl.innerHTML = '<div class="p-4 text-gray-500">Loading...</div>';
        let url = '/patients/' + encodeURIComponent(currentPatientId) + '/' + which;
        try{
            const res = await fetch(url, {credentials: 'same-origin', headers: {'Accept':'application/json'}});
            if(!res.ok) throw new Error('Fetch failed');
            const json = await res.json();
            renderTabContent(which, json);
        }catch(e){
            tabContentEl.innerHTML = '<div class="p-4 text-red-500">Failed to load '+which+'</div>';
            console.error(e);
        }
    }

    function renderTabContent(which, json){
        if(which === 'profile'){
            const p = json;
            tabContentEl.innerHTML = `
                <div class="bg-card-light dark:bg-card-dark rounded-xl shadow-sm p-6">
                    <h3 class="text-xl font-bold mb-2">${escapeHtml(p.name)}</h3>
                    <p class="text-sm text-gray-500">Email: ${escapeHtml(p.email || '-')}</p>
                    <p class="text-sm text-gray-500">Phone: ${escapeHtml(p.phone || '-')}</p>
                    <p class="text-sm text-gray-500">DOB: ${escapeHtml(p.dob || '-')}</p>
                    <p class="text-sm text-gray-500">Appointments: ${p.appointments_count || 0}</p>
                </div>`;
            // update header card
            const avatarEl = document.getElementById('selected-avatar');
            const nameEl = document.getElementById('selected-name');
            const idEl = document.getElementById('selected-id');
            const lastEl = document.getElementById('selected-last');
            if(avatarEl) avatarEl.style.backgroundImage = `url('${escapeHtml(p.avatar_url || 'https://via.placeholder.com/160')}')`;
            if(nameEl) nameEl.textContent = p.name || '—';
            if(idEl) idEl.textContent = 'Patient ID: P' + (p.id || '—');
            if(lastEl) lastEl.textContent = 'Last Visit: —';
            // populate personal details placeholders
            const setText = (id, value) => { const el = document.getElementById(id); if(el) el.textContent = value || '—'; };
            setText('pd-fullname', p.name);
            setText('pd-dob', p.dob);
            setText('pd-gender', p.gender);
            setText('pd-marital', p.marital_status);
            setText('pd-address', p.address);
            setText('pd-email', p.email);
            setText('pd-phone', p.phone);
            setText('pd-emergency-name', p.emergency_contact_name);
            setText('pd-emergency-phone', p.emergency_contact_phone);
            // Optional: populate alerts if provided
            if(p.allergies || p.conditions){
                const alertsEl = document.querySelector('.lg\\:col-span-3');
                if(alertsEl){
                    let items = [];
                    if(p.allergies) items.push('Allergy: ' + p.allergies);
                    if(p.conditions) items.push('Pre-existing condition: ' + p.conditions);
                    // replace list inside alerts card
                    const ul = alertsEl.querySelector('ul');
                    if(ul){ ul.innerHTML = items.map(i => `<li>${escapeHtml(i)}</li>`).join(''); }
                }
            }
        } else if(which === 'appointments'){
            const rows = json.data || [];
            if(rows.length === 0){ tabContentEl.innerHTML = '<div class="p-4 text-gray-500">No appointments found.</div>'; return; }
            const html = rows.map(a => `
                <div class="bg-card-light dark:bg-card-dark rounded-xl shadow-sm p-4 mb-2">
                    <div class="flex justify-between"><div><strong>${escapeHtml(a.service || '—')}</strong> with ${escapeHtml(a.doctor || '—')}</div><div class="text-sm text-gray-500">${escapeHtml(a.time || '')}</div></div>
                    <div class="text-sm text-gray-600 mt-2">Status: ${escapeHtml(a.status || '')}</div>
                    <div class="text-sm text-gray-700 mt-2">Notes: ${escapeHtml(a.notes || '')}</div>
                </div>
            `).join('');
            tabContentEl.innerHTML = html;
        } else if(which === 'history'){
            const rows = json.data || [];
            if(rows.length === 0){ tabContentEl.innerHTML = '<div class="p-4 text-gray-500">No medical history available.</div>'; return; }
            const html = rows.map(h => `
                <div class="bg-card-light dark:bg-card-dark rounded-xl shadow-sm p-4 mb-2">
                    <div class="text-sm text-gray-500">${escapeHtml(h.date || '')} — ${escapeHtml(h.service || '')} with ${escapeHtml(h.doctor || '')}</div>
                    <div class="text-sm text-gray-700 mt-2">${escapeHtml(h.notes || '')}</div>
                </div>
            `).join('');
            tabContentEl.innerHTML = html;
        } else if(which === 'notes'){
            const rows = json.data || [];
            // composer form
            let html = `
                <div class="bg-card-light dark:bg-card-dark rounded-xl shadow-sm p-4 mb-4">
                    <h4 class="text-lg font-semibold mb-2">Add Note</h4>
                    <div class="space-y-2">
                        <textarea id="note-composer" rows="3" class="w-full rounded border p-2" placeholder="Write a note..."></textarea>
                        <div class="flex gap-2">
                            <button id="note-add-btn" class="px-3 py-2 rounded bg-primary text-white">Add Note <span id="note-add-spinner" style="display:none;" class="ml-2 spinner"/></button>
                            <button id="note-clear-btn" class="px-3 py-2 rounded border">Clear</button>
                        </div>
                        <div id="note-composer-error" class="text-sm text-red-500 mt-2" style="display:none;"></div>
                    </div>
                </div>
            `;

            html += '<div id="notes-list">';
            if(rows.length === 0){
                html += '<div class="p-4 text-gray-500">No notes available.</div>';
            } else {
                html += rows.map(n => `
                <div class="bg-card-light dark:bg-card-dark rounded-xl shadow-sm p-4 mb-2" data-note-id="${n.id}">
                    <div class="flex justify-between items-start">
                        <div class="text-sm text-gray-500">${escapeHtml(n.date || '')} — ${escapeHtml(n.from || '')}</div>
                        <div class="flex gap-2">
                            <button class="note-edit text-sm px-2 py-1 rounded border" data-note-id="${n.id}">Edit</button>
                            <button class="note-delete text-sm px-2 py-1 rounded border text-red-600" data-note-id="${n.id}">Delete</button>
                        </div>
                    </div>
                    <div class="note-body text-sm text-gray-700 mt-2">${escapeHtml(n.note || '')}</div>
                </div>
            `).join('');
            }
            html += '</div>';

            tabContentEl.innerHTML = html;

            // attach composer handlers with optimistic UI
            const composer = document.getElementById('note-composer');
            const addBtn = document.getElementById('note-add-btn');
            const clearBtn = document.getElementById('note-clear-btn');
            const composerError = document.getElementById('note-composer-error');
            const addSpinner = document.getElementById('note-add-spinner');
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            if(addBtn){
                addBtn.addEventListener('click', async function(e){
                    e.preventDefault();
                    composerError.style.display = 'none';
                    const text = composer.value.trim();
                    if(!text){ composerError.textContent = 'Note cannot be empty.'; composerError.style.display = ''; return; }
                    // optimistic: insert temp note at top
                    const notesList = document.getElementById('notes-list');
                    const tempId = 'temp-' + Date.now();
                    const tempHtml = `<div class="bg-card-light dark:bg-card-dark rounded-xl shadow-sm p-4 mb-2 opacity-80" data-note-id="${tempId}"><div class="flex justify-between items-start"><div class="text-sm text-gray-500">Saving…</div><div class="flex gap-2"><span class=\"spinner\"></span></div></div><div class=\"note-body text-sm text-gray-700 mt-2\">${escapeHtml(text)}</div></div>`;
                    if(notesList) notesList.insertAdjacentHTML('afterbegin', tempHtml);
                    addBtn.disabled = true; if(addSpinner) addSpinner.style.display = '';
                    try{
                        const res = await fetch('/patients/' + encodeURIComponent(currentPatientId) + '/notes', {
                            method: 'POST',
                            credentials: 'same-origin',
                            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' },
                            body: JSON.stringify({ note: text })
                        });
                        if(res.status === 422){ const j = await res.json(); composerError.textContent = (j.errors && j.errors.note ? j.errors.note.join(' ') : 'Validation error'); composerError.style.display = ''; // remove temp
                            const tmp = document.querySelector(`[data-note-id=\"${tempId}\"]`); if(tmp) tmp.remove(); return; }
                        if(!res.ok) throw new Error('Failed to save note');
                        composer.value = '';
                        // reload notes to get canonical data (id, from, date)
                        loadPatientTab('notes');
                    }catch(err){ console.error(err); composerError.textContent = 'Failed to save note'; composerError.style.display = ''; const tmp = document.querySelector(`[data-note-id=\"${tempId}\"]`); if(tmp) tmp.remove(); }
                    addBtn.disabled = false; if(addSpinner) addSpinner.style.display = 'none';
                });
            }
            if(clearBtn){ clearBtn.addEventListener('click', function(e){ e.preventDefault(); composer.value = ''; composerError.style.display = 'none'; }); }

            // attach edit/delete handlers with spinners and optimistic update
            function attachNoteHandlers(){
                tabContentEl.querySelectorAll('.note-edit').forEach(btn => {
                    btn.addEventListener('click', function(e){
                        e.preventDefault();
                        const id = this.getAttribute('data-note-id');
                        const container = tabContentEl.querySelector(`[data-note-id=\"${id}\"]`);
                        if(!container) return;
                        const bodyEl = container.querySelector('.note-body');
                        const original = bodyEl.textContent || '';
                        // replace with editor
                        bodyEl.innerHTML = `\n                            <textarea class=\"note-edit-area w-full rounded border p-2\" rows=\"3\">${escapeHtml(original)}</textarea>\n                            <div class=\"flex gap-2 mt-2\">\n                                <button class=\"note-save px-3 py-1 rounded bg-primary text-white\">Save <span class=\"note-save-spinner ml-2 spinner\" style=\"display:none;\"></span></button>\n                                <button class=\"note-cancel px-3 py-1 rounded border\">Cancel</button>\n                                <div class=\"note-edit-error text-sm text-red-500 mt-2\" style=\"display:none;\"></div>\n                            </div>`;
                        // save/cancel handlers
                        const saveBtn = container.querySelector('.note-save');
                        const cancelBtn = container.querySelector('.note-cancel');
                        const editArea = container.querySelector('.note-edit-area');
                        const editError = container.querySelector('.note-edit-error');
                        const saveSpinner = container.querySelector('.note-save-spinner');
                        saveBtn.addEventListener('click', async function(ev){
                            ev.preventDefault(); editError.style.display = 'none';
                            const value = editArea.value.trim();
                            if(!value){ editError.textContent = 'Note cannot be empty.'; editError.style.display = ''; return; }
                            // optimistic: replace body with new text and show spinner
                            bodyEl.innerHTML = `<div class=\"note-body text-sm text-gray-700 mt-2\">${escapeHtml(value)} <span class=\"spinner ml-2\"></span></div>`;
                            saveBtn.disabled = true; if(saveSpinner) saveSpinner.style.display = '';
                            try{
                                const res = await fetch('/notes/' + encodeURIComponent(id), {
                                    method: 'PUT',
                                    credentials: 'same-origin',
                                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' },
                                    body: JSON.stringify({ note: value })
                                });
                                if(res.status === 422){ const j = await res.json(); // revert and show error
                                    loadPatientTab('notes'); // reload canonical
                                    return; }
                                if(res.status === 403){ alert('Not authorized to update this note.'); loadPatientTab('notes'); return; }
                                if(!res.ok) throw new Error('Failed to update');
                                // success: reload to get updated metadata
                                loadPatientTab('notes');
                            }catch(er){ console.error(er); alert('Failed to update note'); loadPatientTab('notes'); }
                            saveBtn.disabled = false; if(saveSpinner) saveSpinner.style.display = 'none';
                        });
                        cancelBtn.addEventListener('click', function(ev){ ev.preventDefault(); loadPatientTab('notes'); });
                    });
                });

                tabContentEl.querySelectorAll('.note-delete').forEach(btn => {
                    btn.addEventListener('click', async function(e){
                        e.preventDefault();
                        if(!confirm('Delete this note?')) return;
                        const id = this.getAttribute('data-note-id');
                        const container = tabContentEl.querySelector(`[data-note-id=\"${id}\"]`);
                        // optimistic: remove from DOM while deleting
                        if(container) container.style.opacity = '0.5';
                        try{
                            const res = await fetch('/notes/' + encodeURIComponent(id), { method: 'DELETE', credentials: 'same-origin', headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' } });
                            if(res.status === 403){ alert('Not authorized to delete this note.'); if(container) container.style.opacity = '1'; return; }
                            if(!res.ok) throw new Error('Failed to delete');
                            loadPatientTab('notes');
                        }catch(err){ console.error(err); alert('Failed to delete note.'); if(container) container.style.opacity = '1'; }
                    });
                });
            }

            attachNoteHandlers();
        }
    }

    // If a patient was present on load, load profile tab
    if(currentPatientId){ document.addEventListener('DOMContentLoaded', function(){ loadPatientTab('profile'); }); }
})();
</script>

</script>
<script>
// set initial avatars from data-avatar for server-rendered entries
document.addEventListener('DOMContentLoaded', function(){
    document.querySelectorAll('[data-avatar]').forEach(function(el){
        const url = el.getAttribute('data-avatar');
        if(url) el.style.backgroundImage = `url('${url}')`;
    });
});
</script>
</body></html>