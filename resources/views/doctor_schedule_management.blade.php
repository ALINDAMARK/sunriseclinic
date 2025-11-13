<!DOCTYPE html>

<html class="light" lang="en"><head>
<meta charset="utf-8"/>
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Doctor's Schedule - Sun Rise Clinic</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet"/>
<script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#4A90E2",
                        "secondary": "#F5A623",
                        "background-light": "#F4F7FA",
                        "background-dark": "#1a202c",
                        "neutral-light": "#F4F7FA",
                        "neutral-medium": "#AAB8C2",
                        "neutral-dark": "#2C3E50",
                        "status-green": "#2ECC71",
                        "status-yellow": "#F1C40F",
                        "status-red": "#E74C3C",
                        "status-gray": "#95A5A6"
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
        }
    </style>
</head>
<body class="font-display">
<div class="relative flex h-auto min-h-screen w-full flex-col bg-background-light dark:bg-background-dark group/design-root overflow-x-hidden">
<div class="flex h-full min-h-screen">
<!-- SideNavBar -->
<nav class="flex w-64 flex-col justify-between border-r border-neutral-light bg-white p-4 dark:border-neutral-dark/20 dark:bg-neutral-dark/50">
<div class="flex flex-col gap-8">
<div class="flex items-center gap-3">
<span class="material-symbols-outlined text-4xl text-secondary">
                            wb_sunny
                        </span>
<h2 class="text-xl font-bold text-neutral-dark dark:text-white">Sun Rise Clinic</h2>
</div>
<div class="flex flex-col gap-4">
<div class="flex flex-col gap-1">
            <a class="flex items-center gap-3 rounded-lg px-3 py-2 text-neutral-dark hover:bg-neutral-light dark:text-white dark:hover:bg-neutral-dark/40" href="{{ route('dashboard') ?? url('/dashboard') }}">
<span class="material-symbols-outlined text-2xl">
                                    dashboard
                                </span>
<p class="text-sm font-medium leading-normal">Dashboard</p>
</a>
            <a class="flex items-center gap-3 rounded-lg bg-primary/10 px-3 py-2 text-primary dark:bg-primary/20 dark:text-primary" href="{{ route('doctors.manage') }}">
<span class="material-symbols-outlined text-2xl">
                                    calendar_month
                                </span>
<p class="text-sm font-bold leading-normal">Schedule</p>
</a>
            <a class="flex items-center gap-3 rounded-lg px-3 py-2 text-neutral-dark hover:bg-neutral-light dark:text-white dark:hover:bg-neutral-dark/40" href="{{ route('patients.manage') }}">
<span class="material-symbols-outlined text-2xl">
                                    groups
                                </span>
<p class="text-sm font-medium leading-normal">Patients</p>
</a>
            <a class="flex items-center gap-3 rounded-lg px-3 py-2 text-neutral-dark hover:bg-neutral-light dark:text-white dark:hover:bg-neutral-dark/40" href="{{ route('messages.index') }}">
<span class="material-symbols-outlined text-2xl">
                                    chat
                                </span>
<p class="text-sm font-medium leading-normal">Messages</p>
</a>
</div>
</div>
</div>
<div class="flex flex-col gap-4">
            <a class="flex items-center gap-3 rounded-lg px-3 py-2 text-neutral-dark hover:bg-neutral-light dark:text-white dark:hover:bg-neutral-dark/40" href="{{ url('/settings') }}">
<span class="material-symbols-outlined text-2xl">
                            settings
                        </span>
<p class="text-sm font-medium leading-normal">Settings</p>
</a>
<div class="h-px bg-neutral-light dark:bg-neutral-dark/20"></div>
<div class="flex items-center gap-3">
<div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10" data-alt="Portrait of Dr. Emily Carter" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDhItJ4XA40IEFG8GaitJyhRxrU3gjobmiJSNaEgFuy6tLJrUC08rmq5rH1Zg6R62_IZZ9vdnxwJJyVlUwsOBLdfiuz1zMVe4cjXHRgAOY6Dyo5QuWc_YKYNUuCequNHbDZonAnvm3hdsXrhTeqZjR0yNWa16LWH31kMPwP3THPrMDtM4RZnoLaC2HYHg_DqHugyKXtEYXVjKWg5nY3yyb17KWJ9G1VgG_stpaDN2T1EmX4d3xxCuS7PbMeaFntsDC9o3kMxDfT-86p");'></div>
<div class="flex flex-col">
<h1 class="text-base font-medium leading-normal text-neutral-dark dark:text-white">Dr. Emily Carter</h1>
<p class="text-sm font-normal leading-normal text-neutral-medium dark:text-neutral-light/70">General Medicine</p>
</div>
</div>
</div>
</nav>
<!-- Main Content -->
<main class="flex flex-1 flex-col p-6 lg:p-8">
<!-- PageHeading -->
<header class="flex flex-wrap items-center justify-between gap-4">
<div class="flex flex-col gap-1">
<h1 class="text-3xl font-black leading-tight tracking-tight text-neutral-dark dark:text-white">My Schedule</h1>
<p class="text-base font-normal leading-normal text-neutral-medium dark:text-neutral-light/70">View and manage your appointments and availability.</p>
</div>
<div class="flex items-center gap-2">
                <button id="btn-block-time" class="flex min-w-[84px] cursor-pointer items-center justify-center gap-2 overflow-hidden rounded-lg h-10 px-4 bg-white text-neutral-dark shadow-sm border border-neutral-light hover:bg-neutral-light/50 dark:bg-neutral-dark/50 dark:text-white dark:border-neutral-dark/20 dark:hover:bg-neutral-dark/30">
<span class="material-symbols-outlined text-xl">block</span>
<span class="truncate text-sm font-bold">Block Time</span>
</button>
                <button id="btn-new-appointment" class="flex min-w-[84px] cursor-pointer items-center justify-center gap-2 overflow-hidden rounded-lg h-10 px-4 bg-primary text-white shadow-sm hover:bg-primary/90">
<span class="material-symbols-outlined text-xl">add</span>
<span class="truncate text-sm font-bold">New Appointment</span>
</button>
                <!-- Inline Add Doctor quick-action -->
                @can('create', \App\Models\Doctor::class)
                <button id="add-doctor-inline" class="flex min-w-[120px] cursor-pointer items-center justify-center gap-2 overflow-hidden rounded-lg h-10 px-4 bg-white text-neutral-dark shadow-sm border border-neutral-light hover:bg-neutral-light/50 dark:bg-neutral-dark/50 dark:text-white dark:border-neutral-dark/20 dark:hover:bg-neutral-dark/30">
                    <span class="material-symbols-outlined text-xl">person_add</span>
                    <span class="truncate text-sm font-bold">Add Doctor</span>
                </button>
                @endcan
</div>
</header>
<!-- Modals -->
<!-- Block Time Modal -->
<div id="modal-block" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40">
    <div class="w-full max-w-md rounded-lg bg-white p-6">
        <h3 class="text-lg font-bold mb-3">Block Time</h3>
        <div class="space-y-3">
            <label class="block text-sm">Doctor</label>
            <select id="block-doctor" class="w-full rounded border p-2">
                @foreach($doctors ?? [] as $d)
                    <option value="{{ $d->id }}">{{ $d->name }}</option>
                @endforeach
            </select>
            <label class="block text-sm">Starts at</label>
            <input id="block-starts" type="datetime-local" class="w-full rounded border p-2" />
            <label class="block text-sm">Duration (minutes)</label>
            <input id="block-duration" type="number" class="w-full rounded border p-2" value="60" />
            <label class="block text-sm">Notes (optional)</label>
            <textarea id="block-notes" class="w-full rounded border p-2" rows="2"></textarea>
            <div class="flex justify-end gap-2 mt-3">
                <button id="block-cancel" class="px-3 py-2 rounded border">Cancel</button>
                <button id="block-save" class="px-3 py-2 rounded bg-primary text-white">Save</button>
            </div>
            <div id="block-error" class="text-sm text-red-500 mt-2" style="display:none;"></div>
        </div>
    </div>
</div>

<!-- New Appointment Modal -->
<div id="modal-appointment" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40">
    <div class="w-full max-w-lg rounded-lg bg-white p-6">
        <h3 class="text-lg font-bold mb-3">New Appointment</h3>
        <div class="grid grid-cols-2 gap-3">
            <div>
                <label class="block text-sm">Patient</label>
                <select id="appt-patient" class="w-full rounded border p-2">
                    @foreach($patients ?? [] as $p)
                        <option value="{{ $p->id }}">{{ $p->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm">Doctor</label>
                <select id="appt-doctor" class="w-full rounded border p-2">
                    @foreach($doctors ?? [] as $d)
                        <option value="{{ $d->id }}">{{ $d->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm">Service</label>
                <select id="appt-service" class="w-full rounded border p-2">
                    @foreach($services ?? [] as $s)
                        <option value="{{ $s->id }}">{{ $s->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm">Starts at</label>
                <input id="appt-starts" type="datetime-local" class="w-full rounded border p-2" />
            </div>
            <div>
                <label class="block text-sm">Duration (minutes)</label>
                <input id="appt-duration" type="number" class="w-full rounded border p-2" value="30" />
            </div>
            <div class="col-span-2">
                <label class="block text-sm">Notes</label>
                <textarea id="appt-notes" class="w-full rounded border p-2" rows="2"></textarea>
            </div>
        </div>
        <div class="flex justify-end gap-2 mt-3">
            <button id="appt-cancel" class="px-3 py-2 rounded border">Cancel</button>
            <button id="appt-save" class="px-3 py-2 rounded bg-primary text-white">Save</button>
        </div>
        <div id="appt-error" class="text-sm text-red-500 mt-2" style="display:none;"></div>
    </div>
</div>
@include('partials.add_doctor_modal')
<div class="mt-6 flex flex-1 gap-8">
<!-- Calendar and Appointments Section -->
<div class="flex flex-1 flex-col">
<div class="flex flex-wrap items-center justify-between gap-4 rounded-xl border border-neutral-light bg-white p-4 dark:border-neutral-dark/20 dark:bg-neutral-dark/50">
<!-- SegmentedButtons -->
<div class="flex h-10 items-center justify-center rounded-lg bg-neutral-light p-1 dark:bg-neutral-dark/40">
<label class="flex h-full cursor-pointer grow items-center justify-center overflow-hidden rounded-lg px-4 text-sm font-medium leading-normal text-neutral-medium has-[:checked]:bg-white has-[:checked]:text-neutral-dark has-[:checked]:shadow-sm dark:text-neutral-light/70 dark:has-[:checked]:bg-neutral-dark/60 dark:has-[:checked]:text-white">
<span class="truncate">Day</span>
<input class="invisible w-0" name="view-switcher" type="radio" value="Day"/>
</label>
<label class="flex h-full cursor-pointer grow items-center justify-center overflow-hidden rounded-lg px-4 text-sm font-medium leading-normal text-neutral-medium has-[:checked]:bg-white has-[:checked]:text-neutral-dark has-[:checked]:shadow-sm dark:text-neutral-light/70 dark:has-[:checked]:bg-neutral-dark/60 dark:has-[:checked]:text-white">
<span class="truncate">Week</span>
<input checked="" class="invisible w-0" name="view-switcher" type="radio" value="Week"/>
</label>
<label class="flex h-full cursor-pointer grow items-center justify-center overflow-hidden rounded-lg px-4 text-sm font-medium leading-normal text-neutral-medium has-[:checked]:bg-white has-[:checked]:text-neutral-dark has-[:checked]:shadow-sm dark:text-neutral-light/70 dark:has-[:checked]:bg-neutral-dark/60 dark:has-[:checked]:text-white">
<span class="truncate">Month</span>
<input class="invisible w-0" name="view-switcher" type="radio" value="Month"/>
</label>
</div>
<!-- Date Navigator -->
<div class="flex items-center gap-2">
                <button id="nav-prev" class="flex size-10 items-center justify-center rounded-lg hover:bg-neutral-light dark:hover:bg-neutral-dark/40">
                    <span class="material-symbols-outlined text-2xl text-neutral-dark dark:text-white">chevron_left</span>
                </button>
                <p id="date-range-label" class="text-base font-bold leading-tight text-neutral-dark dark:text-white">October 20-26, 2024</p>
                <button id="nav-next" class="flex size-10 items-center justify-center rounded-lg hover:bg-neutral-light dark:hover:bg-neutral-dark/40">
                    <span class="material-symbols-outlined text-2xl text-neutral-dark dark:text-white">chevron_right</span>
                </button>
</div>
</div>
<!-- Main Calendar Grid -->
<div class="mt-4 flex-1 overflow-auto rounded-xl border border-neutral-light bg-white p-4 dark:border-neutral-dark/20 dark:bg-neutral-dark/50">
<div class="grid grid-cols-8">
<!-- Time Column -->
<div class="col-span-1"></div>
<!-- Day Columns -->
<div class="col-span-1 border-l border-neutral-light pb-4 text-center dark:border-neutral-dark/20">
<p class="text-sm text-neutral-medium dark:text-neutral-light/70">Mon</p>
<p class="text-2xl font-bold text-neutral-dark dark:text-white">21</p>
</div>
<div class="col-span-1 border-l border-neutral-light pb-4 text-center dark:border-neutral-dark/20">
<p class="text-sm text-neutral-medium dark:text-neutral-light/70">Tue</p>
<p class="text-2xl font-bold text-neutral-dark dark:text-white">22</p>
</div>
<div class="col-span-1 border-l border-neutral-light pb-4 text-center dark:border-neutral-dark/20">
<p class="text-sm text-neutral-medium dark:text-neutral-light/70">Wed</p>
<p class="text-2xl font-bold text-primary">23</p>
</div>
<div class="col-span-1 border-l border-neutral-light pb-4 text-center dark:border-neutral-dark/20">
<p class="text-sm text-neutral-medium dark:text-neutral-light/70">Thu</p>
<p class="text-2xl font-bold text-neutral-dark dark:text-white">24</p>
</div>
<div class="col-span-1 border-l border-neutral-light pb-4 text-center dark:border-neutral-dark/20">
<p class="text-sm text-neutral-medium dark:text-neutral-light/70">Fri</p>
<p class="text-2xl font-bold text-neutral-dark dark:text-white">25</p>
</div>
</div>
<div class="relative grid grid-cols-8" style="height: 720px;">
<!-- Time Grid -->
<div class="col-span-1 pr-4 text-right">
<div class="h-24"><span class="relative -top-3 text-xs text-neutral-medium dark:text-neutral-light/70">9:00 AM</span></div>
<div class="h-24"><span class="relative -top-3 text-xs text-neutral-medium dark:text-neutral-light/70">10:00 AM</span></div>
<div class="h-24"><span class="relative -top-3 text-xs text-neutral-medium dark:text-neutral-light/70">11:00 AM</span></div>
<div class="h-24"><span class="relative -top-3 text-xs text-neutral-medium dark:text-neutral-light/70">12:00 PM</span></div>
<div class="h-24"><span class="relative -top-3 text-xs text-neutral-medium dark:text-neutral-light/70">1:00 PM</span></div>
<div class="h-24"><span class="relative -top-3 text-xs text-neutral-medium dark:text-neutral-light/70">2:00 PM</span></div>
<div class="h-24"><span class="relative -top-3 text-xs text-neutral-medium dark:text-neutral-light/70">3:00 PM</span></div>
<div class="h-24"><span class="relative -top-3 text-xs text-neutral-medium dark:text-neutral-light/70">4:00 PM</span></div>
</div>
<!-- Calendar Slots -->
<div class="col-span-7 grid grid-cols-5 border-t border-neutral-light dark:border-neutral-dark/20">
<!-- Background Grid Lines -->
<div class="col-span-1 border-l border-neutral-light dark:border-neutral-dark/20">
<div class="h-24 border-b border-neutral-light dark:border-neutral-dark/20"></div><div class="h-24 border-b border-neutral-light dark:border-neutral-dark/20"></div><div class="h-24 border-b border-neutral-light dark:border-neutral-dark/20"></div><div class="h-24 border-b border-neutral-light dark:border-neutral-dark/20"></div><div class="h-24 border-b border-neutral-light dark:border-neutral-dark/20"></div><div class="h-24 border-b border-neutral-light dark:border-neutral-dark/20"></div><div class="h-24 border-b border-neutral-light dark:border-neutral-dark/20"></div>
</div>
<div class="col-span-1 border-l border-neutral-light dark:border-neutral-dark/20">
<div class="h-24 border-b border-neutral-light dark:border-neutral-dark/20"></div><div class="h-24 border-b border-neutral-light dark:border-neutral-dark/20"></div><div class="h-24 border-b border-neutral-light dark:border-neutral-dark/20"></div><div class="h-24 border-b border-neutral-light dark:border-neutral-dark/20"></div><div class="h-24 border-b border-neutral-light dark:border-neutral-dark/20"></div><div class="h-24 border-b border-neutral-light dark:border-neutral-dark/20"></div><div class="h-24 border-b border-neutral-light dark:border-neutral-dark/20"></div>
</div>
<div class="col-span-1 border-l border-neutral-light dark:border-neutral-dark/20">
<div class="h-24 border-b border-neutral-light dark:border-neutral-dark/20"></div><div class="h-24 border-b border-neutral-light dark:border-neutral-dark/20"></div><div class="h-24 border-b border-neutral-light dark:border-neutral-dark/20"></div><div class="h-24 border-b border-neutral-light dark:border-neutral-dark/20"></div><div class="h-24 border-b border-neutral-light dark:border-neutral-dark/20"></div><div class="h-24 border-b border-neutral-light dark:border-neutral-dark/20"></div><div class="h-24 border-b border-neutral-light dark:border-neutral-dark/20"></div>
</div>
<div class="col-span-1 border-l border-neutral-light dark:border-neutral-dark/20">
<div class="h-24 border-b border-neutral-light dark:border-neutral-dark/20"></div><div class="h-24 border-b border-neutral-light dark:border-neutral-dark/20"></div><div class="h-24 border-b border-neutral-light dark:border-neutral-dark/20"></div><div class="h-24 border-b border-neutral-light dark:border-neutral-dark/20"></div><div class="h-24 border-b border-neutral-light dark:border-neutral-dark/20"></div><div class="h-24 border-b border-neutral-light dark:border-neutral-dark/20"></div><div class="h-24 border-b border-neutral-light dark:border-neutral-dark/20"></div>
</div>
<div class="col-span-1 border-l border-r border-neutral-light dark:border-neutral-dark/20">
<div class="h-24 border-b border-neutral-light dark:border-neutral-dark/20"></div><div class="h-24 border-b border-neutral-light dark:border-neutral-dark/20"></div><div class="h-24 border-b border-neutral-light dark:border-neutral-dark/20"></div><div class="h-24 border-b border-neutral-light dark:border-neutral-dark/20"></div><div class="h-24 border-b border-neutral-light dark:border-neutral-dark/20"></div><div class="h-24 border-b border-neutral-light dark:border-neutral-dark/20"></div><div class="h-24 border-b border-neutral-light dark:border-neutral-dark/20"></div>
</div>
<!-- Appointment Blocks -->
<div id="calendar-columns" class="absolute inset-0 grid grid-cols-5 pl-1 pt-1">
<!-- Calendar columns will be populated by JS using the server-provided data -->
</div>

<script>
    // initial data will be fetched from the API via refreshCalendar()
</script>
<script>
// Mini calendar wiring: update label and notify main calendar to show that month in Month view
(function(){
    const prev = document.getElementById('mini-prev');
    const next = document.getElementById('mini-next');
    const label = document.getElementById('mini-month-label');
    if(!label) return;
    // start with current month
    let current = new Date();
    function renderLabel(){ label.textContent = current.toLocaleDateString(undefined, { month: 'long', year: 'numeric' }); }
    function gotoMonth(){
        // dispatch event to main calendar
        const ev = new CustomEvent('calendar:goto', { detail: { view: 'Month', year: current.getFullYear(), month: current.getMonth(), day: 1 } });
        document.dispatchEvent(ev);
    }
    if(prev) prev.addEventListener('click', function(){ current.setMonth(current.getMonth()-1); renderLabel(); gotoMonth(); });
    if(next) next.addEventListener('click', function(){ current.setMonth(current.getMonth()+1); renderLabel(); gotoMonth(); });
    // initial render (in case label text differs)
    try{
        // try parse existing label like "October 2024"
        const parts = label.textContent.trim().split(' ');
        if(parts.length >= 2){ const yr = parseInt(parts[parts.length-1],10); const moName = parts.slice(0, parts.length-1).join(' '); const mo = new Date(moName + ' 1, ' + yr).getMonth(); if(!isNaN(mo) && !isNaN(yr)){ current = new Date(yr, mo, 1); }
        }
    }catch(e){}
    renderLabel();
})();
// render the mini-month grid under the label
(function(){
    const label = document.getElementById('mini-month-label');
    const grid = document.getElementById('mini-month-grid');
    if(!label || !grid) return;
    function parseLabel(){
        try{ const parts = label.textContent.trim().split(' '); const yr = parseInt(parts[parts.length-1],10); const moName = parts.slice(0, parts.length-1).join(' '); const mo = new Date(moName + ' 1, ' + yr).getMonth(); if(!isNaN(mo) && !isNaN(yr)) return { year: yr, month: mo }; }catch(e){}
        const d = new Date(); return { year: d.getFullYear(), month: d.getMonth() };
    }
    function render(){
        const info = parseLabel();
        const year = info.year; const month = info.month;
        grid.innerHTML = '';
        // week headers
        const headers = ['S','M','T','W','T','F','S'];
        headers.forEach(h => { const el = document.createElement('div'); el.className='flex h-10 items-center justify-center text-[13px] font-bold text-neutral-medium'; el.textContent = h; grid.appendChild(el); });
        // compute startCalendar
        const monthFirst = new Date(year, month, 1);
        const startDay = monthFirst.getDay();
        const startCal = new Date(monthFirst); startCal.setDate(monthFirst.getDate() - startDay);
        for(let i=0;i<42;i++){
            const d = new Date(startCal); d.setDate(startCal.getDate() + i);
            const cell = document.createElement('button');
            cell.className = 'h-10 w-full text-sm font-medium leading-normal text-neutral-dark';
            const inner = document.createElement('div'); inner.className='flex size-full items-center justify-center rounded-full'; inner.textContent = d.getDate();
            // dim days not in month
            if(d.getMonth() !== month) inner.classList.add('text-neutral-medium');
            // highlight today/selected
            const iso = d.toISOString().slice(0,10);
            if(window.__CALENDAR_FOCUSED_DATE === iso) inner.classList.add('bg-primary/20','ring-2','ring-primary','text-primary');
            cell.appendChild(inner);
            cell.addEventListener('click', function(e){
                try{
                    // Shift+click opens the Day view (legacy navigation). Single click opens booking modal.
                    if(e && e.shiftKey){
                        const ev = new CustomEvent('calendar:goto', { detail: { view: 'Day', year: d.getFullYear(), month: d.getMonth(), day: d.getDate() } });
                        document.dispatchEvent(ev);
                        return;
                    }
                    // open appointment modal prefilled to 09:00 on that day
                    const apptModal = document.getElementById('modal-appointment');
                    const apptStarts = document.getElementById('appt-starts');
                    const iso = toDateTimeLocalFromDayAndHour(d, 9, 0);
                    if(apptStarts) apptStarts.value = iso;
                    if(apptModal){ apptModal.classList.remove('hidden'); apptModal.classList.add('flex'); }
                }catch(err){ console.error('open appointment failed', err); }
            });
            // double-clicking a day cell opens the appointment modal prefilled to 09:00 on that day
            cell.addEventListener('dblclick', function(e){
                try{
                    const apptModal = document.getElementById('modal-appointment');
                    const apptStarts = document.getElementById('appt-starts');
                    const iso = toDateTimeLocalFromDayAndHour(d, 9, 0);
                    if(apptStarts) apptStarts.value = iso;
                    if(apptModal){ apptModal.classList.remove('hidden'); apptModal.classList.add('flex'); }
                }catch(err){ console.error('open appointment failed', err); }
            });
            grid.appendChild(cell);
        }
    }
    // observe label changes
    const mo = new MutationObserver(render);
    mo.observe(label, { childList: true, characterData: true, subtree: true });
    // also update on calendar:goto events
    document.addEventListener('calendar:goto', function(ev){ try{ if(ev && ev.detail){ const d = ev.detail; if(typeof d.year === 'number' && typeof d.month === 'number'){ label.textContent = new Date(d.year, d.month, 1).toLocaleDateString(undefined,{ month: 'long', year: 'numeric' }); } } }catch(e){} render(); });
    render();
})();

// Day drawer helper: render hourly grid and events for a selected date
function openDayDrawer(dateObj, events){
    try{
        const drawer = document.getElementById('day-drawer');
        const title = document.getElementById('day-drawer-title');
        const content = document.getElementById('day-drawer-content');
        if(!drawer || !title || !content) return;
        const d = new Date(dateObj);
        title.textContent = d.toLocaleDateString(undefined, { weekday:'long', month:'short', day:'numeric', year:'numeric' });
        // build hourly rows from 8:00 to 17:00
        content.innerHTML = '';
        const startHour = 8; const endHour = 18;
        const grid = document.createElement('div');
        grid.className = 'grid gap-2';
        for(let h=startHour; h<endHour; h++){
            const row = document.createElement('div');
            row.className = 'flex items-start gap-3';
            const hour = document.createElement('div'); hour.className = 'w-20 text-sm text-neutral-medium'; hour.textContent = formatToEAT(new Date(d.getFullYear(), d.getMonth(), d.getDate(), h).toISOString(), { hour: 'numeric', minute: '2-digit' });
            const slot = document.createElement('div'); slot.className = 'flex-1 rounded border p-2 min-h-[44px]';
            // clicking an empty slot opens the appointment modal at this date/time
            (function(slotDate, hourIndex){
                slot.addEventListener('click', function(e){
                    e.stopPropagation();
                    try{
                        const apptModal = document.getElementById('modal-appointment');
                        const apptStarts = document.getElementById('appt-starts');
                        const iso = toDateTimeLocalFromDayAndHour(slotDate, hourIndex, 0);
                        if(apptStarts) apptStarts.value = iso;
                        if(apptModal){ apptModal.classList.remove('hidden'); apptModal.classList.add('flex'); }
                    }catch(err){ console.error('open appointment failed', err); }
                });
            })(new Date(d.getFullYear(), d.getMonth(), d.getDate()), h);
            // find events for this hour
            const evsThisHour = (events || []).filter(e => {
                if(!e.starts_at) return false;
                const s = new Date(e.starts_at);
                return s.getFullYear() === d.getFullYear() && s.getMonth()===d.getMonth() && s.getDate()===d.getDate() && s.getHours() === h;
            });
            if(evsThisHour.length){
                evsThisHour.forEach(ev => {
                    const b = document.createElement('div');
                    b.className = 'flex items-center gap-2 p-1 rounded';
                    if(ev.type === 'block'){ b.classList.add('bg-gray-100','text-gray-700'); b.innerHTML = `<span class="w-2 h-2 rounded-full bg-gray-500"></span><strong>Blocked</strong><span class="text-xs text-neutral-medium"> ${ev.label || ''}</span>`; }
                    else { b.classList.add('bg-green-50','text-green-800'); const initials = (ev.label||'').split(' ').map(s=>s[0]||'').slice(0,2).join('').toUpperCase(); b.innerHTML = `<span class="w-6 h-6 rounded-full bg-green-200 flex items-center justify-center text-xs font-bold text-green-700">${initials}</span><div><div class="text-sm font-semibold">${ev.label||'Appointment'}</div><div class="text-xs text-neutral-medium">${ev.starts_at ? formatToEAT(ev.starts_at, {hour:'numeric', minute:'2-digit'}) : ''}</div></div>`; }
                    // attach click to open detail / delete (if block and allowed)
                    b.addEventListener('click', function(e){ e.stopPropagation(); if(ev.type==='block'){ if(window.__CAN_MANAGE_BLOCKS){ if(confirm('Delete block?')){ fetch('/blocks/'+ev.id, { method:'DELETE', credentials:'same-origin', headers:{ 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'), 'Accept':'application/json' } }).then(r=>{ if(r.ok) { drawer.classList.add('hidden'); refreshCalendar(); } else alert('Delete failed'); }); } } else { alert('No permission to modify blocks.'); } } else { // appointment
                            if(confirm('Delete appointment?')){
                                fetch('/api/appointments/'+ev.id+'/action', { method:'POST', credentials:'same-origin', headers:{ 'Content-Type':'application/json','X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') }, body: JSON.stringify({ action:'delete' }) }).then(r=>r.json()).then(j=>{ if(j.success){ drawer.classList.add('hidden'); refreshCalendar(); } else alert('Failed'); }).catch(()=> alert('Failed'));
                            }
                        });
                    slot.appendChild(b);
                });
            }
            row.appendChild(hour);
            row.appendChild(slot);
            grid.appendChild(row);
        }
        content.appendChild(grid);
        drawer.classList.remove('hidden');
        // close handler
        const close = document.getElementById('day-drawer-close'); if(close) close.onclick = function(){ drawer.classList.add('hidden'); };
    }catch(e){ console.error('openDayDrawer error', e); }
}
</script>
<script>
function parseISODateOnly(raw){
    if(!raw) return null;
    const parts = String(raw).split('-');
    if(parts.length < 3) return null;
    return new Date(parseInt(parts[0],10), parseInt(parts[1],10)-1, parseInt(parts[2],10));
}

// Compute minutes since display start in East Africa Time (UTC+3)
function minutesSinceDisplayStart(dtStr, displayStartHour){
    if(!dtStr) return 0;
    const dUTC = new Date(dtStr);
    // get EAT date components using Intl
    const fmt = (opt) => new Intl.DateTimeFormat('en-GB', Object.assign({ timeZone: 'Africa/Nairobi' }, opt));
    const year = parseInt(fmt({ year:'numeric' }).format(dUTC),10);
    const month = parseInt(fmt({ month:'numeric' }).format(dUTC),10);
    const day = parseInt(fmt({ day:'numeric' }).format(dUTC),10);
    const hour = parseInt(fmt({ hour:'numeric', hour12:false }).format(dUTC),10);
    const minute = parseInt(fmt({ minute:'numeric' }).format(dUTC),10);
    // East Africa Time is UTC+3; compute the UTC instant for displayStartHour in EAT
    const offsetHours = 3;
    const baseUtcMillis = Date.UTC(year, month-1, day, (displayStartHour || 9) - offsetHours, 0, 0);
    const mins = (dUTC.getTime() - baseUtcMillis) / 60000;
    return mins;
}

// Formats a given ISO instant according to the current display timezone setting.
// If window.__DISPLAY_TZ === 'LOCAL' the user's local timezone is used, otherwise EAT is used.
function formatToEAT(isoStr, options){
    if(!isoStr) return '';
    try{
        const d = new Date(isoStr);
        const opts = Object.assign({}, options || {});
        const useLocal = (window.__DISPLAY_TZ === 'LOCAL');
        if(!useLocal){ opts.timeZone = 'Africa/Nairobi'; }
        return new Intl.DateTimeFormat(undefined, opts).format(d);
    }catch(e){ return new Date(isoStr).toLocaleString(); }
}

// return a datetime-local formatted string (YYYY-MM-DDTHH:MM) for now+30min in EAT
function getDefaultEATLocalIso(){
    // Determine rounding from selector (10/15/30/60)
    const sel = document.getElementById('prefill-round');
    const roundTo = sel ? Math.max(1, parseInt(sel.value || '15', 10)) : 15;
    // If display is LOCAL, compute based on user's local time, otherwise compute using Africa/Nairobi
    const useLocal = (window.__DISPLAY_TZ === 'LOCAL');

    if(useLocal){
        const now = new Date();
        let minute = now.getMinutes();
        let hour = now.getHours();
        // add buffer equal to rounding interval then round up
        minute += roundTo;
        minute = Math.ceil(minute / roundTo) * roundTo;
        if(minute >= 60){ minute -= 60; hour += 1; }
        let year = now.getFullYear(); let month = now.getMonth() + 1; let day = now.getDate();
        if(hour >= 24){ hour -= 24; const next = new Date(now.getFullYear(), now.getMonth(), now.getDate()+1); year = next.getFullYear(); month = next.getMonth()+1; day = next.getDate(); }
        const pad = (n) => String(n).padStart(2,'0');
        return `${year}-${pad(month)}-${pad(day)}T${pad(hour)}:${pad(minute)}`;
    }

    // Compute in Africa/Nairobi using Intl to get EAT components
    const now = new Date();
    const tz = 'Africa/Nairobi';
    const fmt = (opt) => new Intl.DateTimeFormat('en-GB', Object.assign({ timeZone: tz }, opt));
    let year = parseInt(fmt({ year:'numeric' }).format(now),10);
    let month = parseInt(fmt({ month:'2-digit' }).format(now),10);
    let day = parseInt(fmt({ day:'2-digit' }).format(now),10);
    let hour = parseInt(fmt({ hour:'2-digit', hour12:false }).format(now),10);
    let minute = parseInt(fmt({ minute:'2-digit' }).format(now),10);
    // add buffer and round
    minute += roundTo;
    minute = Math.ceil(minute / roundTo) * roundTo;
    if(minute >= 60){ minute = minute - 60; hour += 1; }
    if(hour >= 24){ hour = hour - 24; // increment day in EAT
        const tmp = new Date(Date.UTC(year, month-1, day)); tmp.setUTCDate(tmp.getUTCDate()+1);
        const fmt2 = (opt) => new Intl.DateTimeFormat('en-GB', Object.assign({ timeZone: tz }, opt));
        year = parseInt(fmt2({ year:'numeric' }).format(tmp),10);
        month = parseInt(fmt2({ month:'2-digit' }).format(tmp),10);
        day = parseInt(fmt2({ day:'2-digit' }).format(tmp),10);
    }
    const pad = (n) => String(n).padStart(2,'0');
    return `${year}-${pad(month)}-${pad(day)}T${pad(hour)}:${pad(minute)}`;
}

// Build a datetime-local string (YYYY-MM-DDTHH:MM) for a given day and hour
// If display TZ is LOCAL we treat the inputs as local; otherwise treat them as EAT (UTC+3)
function toDateTimeLocalFromDayAndHour(dayDate, hour, minute){
    minute = typeof minute === 'number' ? minute : 0;
    const pad = (n) => String(n).padStart(2,'0');
    const useLocal = (window.__DISPLAY_TZ === 'LOCAL');
    if(useLocal){
        const d = new Date(dayDate.getFullYear(), dayDate.getMonth(), dayDate.getDate(), hour, minute, 0);
        return `${d.getFullYear()}-${pad(d.getMonth()+1)}-${pad(d.getDate())}T${pad(d.getHours())}:${pad(d.getMinutes())}`;
    }
    // interpret the requested components as East Africa Time (UTC+3) and convert to an instant,
    // then express that instant as the user's local datetime-local string
    const offsetHours = 3; // EAT is UTC+3
    // compute UTC millis for the EAT local components
    const utcMillis = Date.UTC(dayDate.getFullYear(), dayDate.getMonth(), dayDate.getDate(), hour - offsetHours, minute, 0);
    const local = new Date(utcMillis);
    return `${local.getFullYear()}-${pad(local.getMonth()+1)}-${pad(local.getDate())}T${pad(local.getHours())}:${pad(local.getMinutes())}`;
}

// Update upcoming appointment time displays based on the toggle
function updateUpcomingTimes(){
    const displays = document.querySelectorAll('.appt-time-display');
    displays.forEach(el => {
        const iso = el.dataset.starts;
        if(!iso) return;
        el.textContent = formatToEAT(iso, { hour:'numeric', minute:'2-digit' });
    });
    const ampm = document.querySelectorAll('.appt-time-ampm');
    ampm.forEach(el => {
        const iso = el.dataset.starts;
        if(!iso) return;
        // get meridiem
        el.textContent = formatToEAT(iso, { hour:'numeric', hour12:true }).split(' ').pop();
    });
}

function createTempTile({type, label, topPx, heightPx, colIndex, tempId}){
    const container = document.getElementById('calendar-columns');
    if(!container) return null;
    const cols = container.children;
    if(!cols[colIndex]) return null;
    const wrapper = document.createElement('div');
    wrapper.id = tempId;
    wrapper.dataset.temp = '1';
    wrapper.className = 'absolute w-full cursor-pointer rounded-lg p-2 opacity-80 animate-pulse bg-yellow-50 border-l-4 border-yellow-400';
    wrapper.style.top = (topPx)+'px';
    wrapper.style.height = (heightPx)+'px';
    wrapper.innerHTML = `<div class="text-xs font-bold text-yellow-700">${label}</div><div class="text-[11px] text-yellow-700">Saving…</div>`;
    cols[colIndex].appendChild(wrapper);
    return wrapper;
}

function renderCalendar(appts, blocks, rangeStart){
    const container = document.getElementById('calendar-columns');
    if(!container) return;
    // normalize arrays
    const apptArr = Array.isArray(appts) ? appts : (appts.data || appts || []);
    const blockArr = Array.isArray(blocks) ? blocks : (blocks.data || blocks || []);
    container.innerHTML = '';

    // If Month view is active, render a compact month grid instead of hourly columns
    if(window.__CURRENT_CALENDAR_VIEW === 'Month'){
        // group events by ISO date (YYYY-MM-DD)
        const eventsByDate = {};
        function pushEvent(dStr, ev){ eventsByDate[dStr] = eventsByDate[dStr] || []; eventsByDate[dStr].push(ev); }
        apptArr.forEach(a => { if(!a.starts_at) return; const d = new Date(a.starts_at); const dstr = d.toISOString().slice(0,10); pushEvent(dstr, { type:'appointment', id:a.id, label: a.patient || a.service || 'Appt' }); });
        blockArr.forEach(b => { if(!b.starts_at) return; const d = new Date(b.starts_at); const dstr = d.toISOString().slice(0,10); pushEvent(dstr, { type:'block', id:b.id, label: b.notes || 'Blocked' }); });

        // determine month to render: prefer focused date if present
        const focusIso = window.__CALENDAR_FOCUSED_DATE ? new Date(window.__CALENDAR_FOCUSED_DATE) : (rangeStart instanceof Date ? new Date(rangeStart) : new Date());
        const monthFirst = new Date(focusIso.getFullYear(), focusIso.getMonth(), 1);
        const startDay = monthFirst.getDay(); // 0=Sun
        const startCalendar = new Date(monthFirst);
        startCalendar.setDate(monthFirst.getDate() - startDay);

        // create 6 rows x 7 cols grid container
        const grid = document.createElement('div');
        grid.className = 'absolute inset-0 grid grid-cols-7 gap-0.5 p-1';
        // render 42 cells
        for(let i=0;i<42;i++){
            const cellDate = new Date(startCalendar);
            cellDate.setDate(startCalendar.getDate() + i);
            const dayNum = cellDate.getDate();
            const iso = cellDate.toISOString().slice(0,10);
            const cell = document.createElement('div');
            cell.className = 'min-h-[80px] rounded-lg p-2 border';
            cell.style.background = (cellDate.getMonth() === monthFirst.getMonth()) ? 'transparent' : 'rgba(240,240,240,0.6)';
            // highlight focused date
            if(window.__CALENDAR_FOCUSED_DATE === iso){ cell.classList.add('ring-2','ring-primary','bg-primary/5'); }
            const header = document.createElement('div');
            header.className = 'flex items-center justify-between';
            const num = document.createElement('div');
            num.className = 'text-sm font-medium';
            num.textContent = dayNum;
            header.appendChild(num);
            cell.dataset.iso = iso;
            cell.appendChild(inner);
            // single click selects the day and navigates to Day view; Shift+click keeps month navigation
            cell.addEventListener('click', function(e){
                try{
                    // store focused date for UI highlights
                    window.__CALENDAR_FOCUSED_DATE = iso;
                    // update month grid highlights by re-rendering the mini grid
                    try{ render(); }catch(err){}
                    // If user holds Shift, navigate to Day view (legacy behavior)
                    if(e && e.shiftKey){
                        const ev = new CustomEvent('calendar:goto', { detail: { view: 'Day', year: d.getFullYear(), month: d.getMonth(), day: d.getDate() } });
                        document.dispatchEvent(ev);
                        return;
                    }
                    // by default, navigate to Day view so the main calendar shows the selected date
                    const ev = new CustomEvent('calendar:goto', { detail: { view: 'Day', year: d.getFullYear(), month: d.getMonth(), day: d.getDate() } });
                    document.dispatchEvent(ev);
                }catch(err){ console.error('select day failed', err); }
            });
            if(evs.length > 3){ const more = document.createElement('div'); more.className='text-[11px] text-neutral-medium'; more.textContent = `+${evs.length-3} more`; evlist.appendChild(more); }
            cell.appendChild(evlist);
            // click to go to day view
            cell.addEventListener('click', function(){
                const evs = eventsByDate[iso] || [];
                if(typeof openDayDrawer === 'function'){
                    openDayDrawer(cellDate, evs);
                } else {
                    const ev = new CustomEvent('calendar:goto', { detail: { view: 'Day', year: cellDate.getFullYear(), month: cellDate.getMonth(), day: cellDate.getDate() } });
                    document.dispatchEvent(ev);
                }
            });
            grid.appendChild(cell);
        }
        container.appendChild(grid);
        return;
    }

    // initialize 5 columns for Mon-Fri
    for(let i=0;i<5;i++){
        const col = document.createElement('div');
        col.className = 'relative pr-1';
        container.appendChild(col);
    }
    const cols = container.children;

    // dynamic sizing: use available height and configured display window
    const displayStartHour = 9; // grid labels start at 9:00
    const displayHours = 8; // 9..16
    const containerHeight = container.getBoundingClientRect().height || 720;
    const pxPerHour = containerHeight / displayHours;

    // compute week start (rangeStart expected to be a Date pointing to the first visible day)
    const weekStart = (rangeStart instanceof Date) ? new Date(rangeStart.getFullYear(), rangeStart.getMonth(), rangeStart.getDate()) : null;

    function addTile(colIndex, elem){
        if(colIndex < 0 || colIndex >= cols.length) return;
        cols[colIndex].appendChild(elem);
    }

    function makeWrapper(type, id, html, topPx, heightPx, extraClass){
        const wrapper = document.createElement('div');
        wrapper.className = 'absolute w-full cursor-pointer rounded-lg p-2 '+(extraClass||'');
        wrapper.style.top = (topPx)+'px';
        wrapper.style.height = (heightPx)+'px';
        wrapper.dataset.type = type;
        wrapper.dataset.id = id;
        wrapper.innerHTML = html;
        // click handler: simple confirm/delete or view
        wrapper.addEventListener('click', function(e){
            e.stopPropagation();
            const type = this.dataset.type;
            const id = this.dataset.id;
            const csrf = document.querySelector('meta[name="csrf-token"]') ? document.querySelector('meta[name="csrf-token"]').getAttribute('content') : '';
            const isBlock = type === 'block';
            const canManageBlocks = !!window.__CAN_MANAGE_BLOCKS;
            if(isBlock && !canManageBlocks){
                alert('You do not have permission to modify blocks.');
                return;
            }
            const action = confirm('Open options for this '+type+'? Press OK to delete, Cancel to view details.');
            if(action){
                if(isBlock){
                    fetch('/blocks/'+id, { method: 'DELETE', credentials: 'same-origin', headers: { 'X-CSRF-TOKEN': csrf, 'Accept': 'application/json' } })
                        .then(r=>{ if(r.ok) return r.json(); throw new Error('Delete failed'); })
                        .then(()=> refreshCalendar())
                        .catch(()=> alert('Failed to delete block'));
                } else {
                    // appointment delete via action endpoint
                    fetch('/api/appointments/'+id+'/action', { method:'POST', credentials:'same-origin', headers: { 'Content-Type':'application/json', 'X-CSRF-TOKEN': csrf, 'Accept':'application/json' }, body: JSON.stringify({ action: 'delete' }) })
                        .then(r=> r.json())
                        .then(j=>{ if(j.success) refreshCalendar(); else alert('Failed to delete appointment'); })
                        .catch(()=> alert('Failed'));
                }
            } else {
                // view details (basic)
                if(isBlock){ alert('Block details:\n'+(this.innerText || '—')); }
                else { alert('Appointment details:\n'+(this.innerText || '—')); }
            }
        });
        return wrapper;
    }

    // appointments
    (Array.isArray(appts) ? appts : (appts.data || appts || [])).forEach(a => {
        if(!a.starts_at) return;
        const d = new Date(a.starts_at);
        if(!weekStart) return;
        const dateOnly = new Date(d.getFullYear(), d.getMonth(), d.getDate());
        const dayIndex = Math.round((dateOnly - weekStart) / (24*60*60*1000));
        if(dayIndex < 0 || dayIndex > 4) return;
        const mins = minutesSinceDisplayStart(a.starts_at, displayStartHour);
        const top = (mins/60) * pxPerHour + 6;
        const height = ((a.duration_minutes || 30)/60) * pxPerHour - 6;
        const html = `<div class=\"rounded-lg border-l-4 bg-status-green/20 p-2\"><p class=\"text-xs font-bold text-status-green\">${a.patient || '—'}</p><p class=\"text-xs text-status-green/80\">${a.service || ''}</p></div>`;
        const w = makeWrapper('appointment', a.id, html, top, Math.max(28, height), 'border-l-4');
        addTile(dayIndex, w);
    });

    // blocks
    (Array.isArray(blocks) ? blocks : (blocks.data || blocks || [])).forEach(b => {
        if(!b.starts_at) return;
        const d = new Date(b.starts_at);
        if(!weekStart) return;
        const dateOnly = new Date(d.getFullYear(), d.getMonth(), d.getDate());
        const dayIndex = Math.round((dateOnly - weekStart) / (24*60*60*1000));
        if(dayIndex < 0 || dayIndex > 4) return;
        const mins = minutesSinceDisplayStart(b.starts_at, displayStartHour);
        const top = (mins/60) * pxPerHour + 6;
        const height = ((b.duration_minutes || 60)/60) * pxPerHour - 6;
        const html = `<div class=\"rounded-lg border-l-4 border-status-gray bg-status-gray/20 p-2\"><p class=\"text-xs font-bold text-status-gray\">Blocked</p><p class=\"text-xs text-status-gray/80\">${b.notes || ''}</p></div>`;
        const w = makeWrapper('block', b.id, html, top, Math.max(28, height), 'border-l-4');
        addTile(dayIndex, w);
    });
}

async function refreshCalendar(startDate, endDate){
    try{
        const params = new URLSearchParams();
        if(startDate) params.set('start_date', startDate);
        if(endDate) params.set('end_date', endDate);
        const [ar, br] = await Promise.all([
            fetch('/api/appointments' + (params.toString() ? ('?' + params.toString()) : ''), {credentials:'same-origin', headers:{'Accept':'application/json'}}),
            fetch('/blocks' + (params.toString() ? ('?' + params.toString()) : ''), {credentials:'same-origin', headers:{'Accept':'application/json'}})
        ]);
        const apij = await ar.json();
        const blj = await br.json();
        // capture authorization flag from blocks endpoint
        if (blj && typeof blj.can_manage !== 'undefined') {
            window.__CAN_MANAGE_BLOCKS = !!blj.can_manage;
        }
    const appts = Array.isArray(apij.data)? apij.data : (Array.isArray(apij) ? apij : (apij.data || apij));
    const blocks = Array.isArray(blj.data)? blj.data : (Array.isArray(blj) ? blj : (blj.data || blj));
    // determine a rangeStart Date for render mapping: prefer startDate param if provided
    const rangeStart = startDate ? new Date(startDate) : (appts.length ? new Date(appts[0].starts_at) : new Date());
    // expose week start for optimistic inserts (YYYY-MM-DD)
    try{ const y = rangeStart.getFullYear(); const m = String(rangeStart.getMonth()+1).padStart(2,'0'); const d = String(rangeStart.getDate()).padStart(2,'0'); window.__WEEK_START = `${y}-${m}-${d}`; }catch(e){ window.__WEEK_START = null; }
    renderCalendar(appts, blocks, rangeStart);
    }catch(e){ console.error('Failed to refresh calendar', e); }
}

document.addEventListener('DOMContentLoaded', function(){
    // initial render: set up navigation and fetch current week
    try{
        // view switcher
        let currentView = 'Week';
        let currentDate = new Date();
        const prevBtn = document.getElementById('nav-prev');
        const nextBtn = document.getElementById('nav-next');
        const labelEl = document.getElementById('date-range-label');
        const viewRadios = document.querySelectorAll('input[name="view-switcher"]');

        function startOfWeekMon(d){ const clone = new Date(d.getFullYear(), d.getMonth(), d.getDate()); const day = clone.getDay(); const diff = (day + 6) % 7; clone.setDate(clone.getDate() - diff); return clone; }
        function endOfWeekMon(d){ const s = startOfWeekMon(d); s.setDate(s.getDate() + 6); return s; }
        function startOfMonth(d){ return new Date(d.getFullYear(), d.getMonth(), 1); }
        function endOfMonth(d){ return new Date(d.getFullYear(), d.getMonth() + 1, 0); }
        function formatRangeLabel(view, date){ if(view === 'Day'){ return date.toLocaleDateString(undefined, { month:'short', day:'numeric', year:'numeric' }); } if(view === 'Week'){ const s = startOfWeekMon(date); const e = new Date(s); e.setDate(e.getDate()+4); // Mon-Fri
                return s.toLocaleDateString(undefined,{month:'short', day:'numeric'}) + ' - ' + e.toLocaleDateString(undefined,{month:'short', day:'numeric', year:'numeric'});
            }
            if(view === 'Month'){ return date.toLocaleDateString(undefined,{ month:'long', year:'numeric'}); }
            return '';
        }

        function computeRange(view, date){ if(view === 'Day'){ const s = new Date(date.getFullYear(), date.getMonth(), date.getDate()); const e = new Date(s); e.setDate(e.getDate()); return { start: s, end: e }; } if(view === 'Week'){ const s = startOfWeekMon(date); const e = new Date(s); e.setDate(s.getDate()+6); return { start: s, end: e }; } if(view === 'Month'){ const s = startOfMonth(date); const e = endOfMonth(date); // extend to week boundaries
                const s2 = startOfWeekMon(s); const e2 = endOfWeekMon(e); return { start: s2, end: e2 } }
            return { start: new Date(), end: new Date() };
        }

        function updateAndRefresh(){ const range = computeRange(currentView, currentDate); labelEl.textContent = formatRangeLabel(currentView, currentDate); const startIso = range.start.toISOString().slice(0,10); const endIso = range.end.toISOString().slice(0,10); // expose current view for render
            window.__CURRENT_CALENDAR_VIEW = currentView;
            // expose focused date (ISO YYYY-MM-DD) for UI highlights
            try{ window.__CALENDAR_FOCUSED_DATE = new Date(currentDate.getFullYear(), currentDate.getMonth(), currentDate.getDate()).toISOString().slice(0,10); }catch(e){ window.__CALENDAR_FOCUSED_DATE = null; }
            refreshCalendar(startIso, endIso); }

        // wire nav
        if(prevBtn) prevBtn.addEventListener('click', function(){ if(currentView==='Day'){ currentDate.setDate(currentDate.getDate()-1); } else if(currentView==='Week'){ currentDate.setDate(currentDate.getDate()-7); } else { currentDate.setMonth(currentDate.getMonth()-1); } updateAndRefresh(); });
        if(nextBtn) nextBtn.addEventListener('click', function(){ if(currentView==='Day'){ currentDate.setDate(currentDate.getDate()+1); } else if(currentView==='Week'){ currentDate.setDate(currentDate.getDate()+7); } else { currentDate.setMonth(currentDate.getMonth()+1); } updateAndRefresh(); });
        viewRadios.forEach(r => r.addEventListener('change', function(){ currentView = this.value; updateAndRefresh(); }));

        // initial load
        labelEl.textContent = formatRangeLabel(currentView, currentDate);
        updateAndRefresh();
        // listen for external goto events (mini-calendar or other widgets)
        document.addEventListener('calendar:goto', function(ev){
            try{
                const d = ev && ev.detail ? ev.detail : null;
                if(!d) return;
                // set current date and view then refresh
                if(typeof d.year === 'number' && typeof d.month === 'number'){
                    currentDate = new Date(d.year, d.month, (typeof d.day === 'number' ? d.day : 1));
                }
                if(typeof d.view === 'string') currentView = d.view;
                // reflect view radio if present
                const radio = document.querySelector('input[name="view-switcher"][value="'+currentView+'"]');
                if(radio) radio.checked = true;
                updateAndRefresh();
            }catch(e){ console.error('calendar:goto handler failed', e); }
        });
    }catch(e){ console.error(e); }
});
</script>
</div>
</div>
</div>
</div>
</div>
<!-- Right Sidebar -->
<div class="w-80 flex-shrink-0">
<div class="flex flex-col gap-6">
<!-- CalendarPicker -->
<div class="flex flex-col gap-0.5 rounded-xl border border-neutral-light bg-white p-4 dark:border-neutral-dark/20 dark:bg-neutral-dark/50">
<div class="flex items-center justify-between p-1">
                <button id="mini-prev" class="flex size-8 items-center justify-center rounded-lg hover:bg-neutral-light dark:hover:bg-neutral-dark/40">
<span class="material-symbols-outlined text-lg text-neutral-dark dark:text-white">chevron_left</span>
</button>
                <p id="mini-month-label" class="flex-1 text-center text-base font-bold leading-tight text-neutral-dark dark:text-white">October 2024</p>
                <button id="mini-next" class="flex size-8 items-center justify-center rounded-lg hover:bg-neutral-light dark:hover:bg-neutral-dark/40">
<span class="material-symbols-outlined text-lg text-neutral-dark dark:text-white">chevron_right</span>
</button>
</div>
<div id="mini-month-grid" class="grid grid-cols-7 gap-0.5"></div>
</div>
<!-- Display controls: timezone toggle and prefill rounding -->
<div class="mt-3 p-3 border-t border-neutral-light dark:border-neutral-dark/20">
    <div class="flex items-center justify-between gap-3">
        <label class="flex items-center gap-2 text-sm">
            <input id="toggle-eat" type="checkbox" checked class="h-4 w-4" />
            <span class="text-sm">Show times in EAT</span>
        </label>
        <label class="flex items-center gap-2 text-sm">
            <span class="text-xs text-neutral-medium">Prefill round</span>
            <select id="prefill-round" class="rounded border p-1 text-sm">
                <option value="10">10m</option>
                <option value="15" selected>15m</option>
                <option value="30">30m</option>
                <option value="60">60m</option>
            </select>
        </label>
    </div>
</div>
<!-- Upcoming Appointments List -->
<div class="flex flex-col gap-4 rounded-xl border border-neutral-light bg-white p-4 dark:border-neutral-dark/20 dark:bg-neutral-dark/50">
<h3 class="text-lg font-bold leading-tight tracking-tight text-neutral-dark dark:text-white">Today's Appointments</h3>
<div class="flex flex-col gap-3">
    @if(!empty($appointments) && $appointments->count())
        @foreach($appointments as $appt)
            <div class="flex cursor-pointer gap-4 rounded-lg p-2 hover:bg-neutral-light dark:hover:bg-neutral-dark/40">
                <div class="flex w-14 flex-col items-center justify-center rounded-lg bg-status-green/20">
                    <p class="appt-time-display text-sm font-bold text-status-green" data-starts="{{ $appt->starts_at }}">{{ \Carbon\Carbon::parse($appt->starts_at)->setTimezone('Africa/Nairobi')->format('g:i') }}</p>
                    <p class="appt-time-ampm text-xs text-status-green" data-starts="{{ $appt->starts_at }}">{{ \Carbon\Carbon::parse($appt->starts_at)->setTimezone('Africa/Nairobi')->format('A') }}</p>
                </div>
                <div class="flex flex-col justify-center">
                    <p class="font-semibold text-neutral-dark dark:text-white">{{ $appt->patient->name ?? '—' }}</p>
                    <p class="text-sm text-neutral-medium dark:text-neutral-light/70">{{ $appt->service->name ?? $appt->notes ?? 'Appointment' }}</p>
                </div>
            </div>
        @endforeach
    @else
        <div class="p-2 text-gray-500">No appointments scheduled.</div>
    @endif
</div>
</div>
</div>
</div>
</div>
</main>
</div>
</div>
<!-- Day Drawer Modal -->
<div id="day-drawer" class="fixed inset-0 z-60 hidden items-end justify-center">
    <div class="w-full max-w-4xl rounded-t-xl bg-white p-4 shadow-xl">
        <div class="flex items-center justify-between">
            <h3 id="day-drawer-title" class="text-lg font-bold"></h3>
            <div class="flex gap-2">
                <button id="day-drawer-close" class="px-3 py-2 rounded border">Close</button>
            </div>
        </div>
        <div id="day-drawer-content" class="mt-4">
            <!-- hourly grid will be injected here -->
        </div>
    </div>
    <div class="fixed inset-0 bg-black/40" onclick="document.getElementById('day-drawer').classList.add('hidden')"></div>
</div>
<script>
(function(){
    const csrf = document.querySelector('meta[name="csrf-token"]') ? document.querySelector('meta[name="csrf-token"]').getAttribute('content') : '';
    // Block modal
    const btnBlock = document.getElementById('btn-block-time');
    const modalBlock = document.getElementById('modal-block');
    const blockCancel = document.getElementById('block-cancel');
    const blockSave = document.getElementById('block-save');
    const blockError = document.getElementById('block-error');

    if(btnBlock){ btnBlock.addEventListener('click', function(){ modalBlock.classList.remove('hidden'); modalBlock.classList.add('flex'); }); }
    if(btnBlock){ btnBlock.addEventListener('click', function(){
        // prefill block-starts to EAT-local ISO if empty
        try{
            const inp = document.getElementById('block-starts');
            if(inp && !inp.value){ inp.value = getDefaultEATLocalIso(); }
        }catch(e){}
        modalBlock.classList.remove('hidden'); modalBlock.classList.add('flex');
    }); }
    if(blockCancel){ blockCancel.addEventListener('click', function(){ modalBlock.classList.add('hidden'); modalBlock.classList.remove('flex'); blockError.style.display='none'; }); }
    if(blockSave){ blockSave.addEventListener('click', async function(){
        blockError.style.display='none'; blockSave.disabled = true;
        const doctor = document.getElementById('block-doctor').value;
        const starts = document.getElementById('block-starts').value;
        const duration = parseInt(document.getElementById('block-duration').value || '60', 10);
        const notes = document.getElementById('block-notes').value;
        // optimistic: insert a temporary tile
        let tempEl = null;
        try{
            // compute column index using week start
            const weekStart = (window.__WEEK_START) ? (function(){ const p=window.__WEEK_START.split('-'); return new Date(parseInt(p[0]), parseInt(p[1],10)-1, parseInt(p[2],10)); })() : null;
            if(weekStart && starts){
                const d = new Date(starts);
                const dateOnly = new Date(d.getFullYear(), d.getMonth(), d.getDate());
                const dayIndex = Math.round((dateOnly - weekStart) / (24*60*60*1000));
                if(dayIndex >=0 && dayIndex <=4){
                    const container = document.getElementById('calendar-columns');
                    const containerHeight = container ? container.getBoundingClientRect().height : 720;
                    const pxPerHour = containerHeight / 8;
                    const mins = minutesSinceDisplayStart(starts, 9);
                    const top = (mins/60) * pxPerHour + 6;
                    const height = ((duration || 60)/60) * pxPerHour - 6;
                    tempEl = createTempTile({ type:'block', label:'Blocked', topPx: top, heightPx: Math.max(28, height), colIndex: dayIndex, tempId: 'temp-block-'+Date.now() });
                }
            }

            const res = await fetch('/blocks', { method: 'POST', credentials: 'same-origin', headers: { 'Content-Type':'application/json', 'X-CSRF-TOKEN': csrf, 'Accept':'application/json' }, body: JSON.stringify({ doctor_id: doctor, starts_at: starts, duration_minutes: duration, notes: notes }) });
            if(res.status === 422){ const j = await res.json(); if(tempEl && tempEl.parentNode) tempEl.parentNode.removeChild(tempEl); blockError.textContent = (j.errors && j.errors.starts_at ? j.errors.starts_at.join(' ') : 'Validation error'); blockError.style.display=''; blockSave.disabled=false; return; }
            if(res.status === 403){ if(tempEl && tempEl.parentNode) tempEl.parentNode.removeChild(tempEl); blockError.textContent = 'Unauthorized'; blockError.style.display=''; blockSave.disabled=false; return; }
            if(!res.ok) throw new Error('Failed');
            // success - refresh calendar in-place
            modalBlock.classList.add('hidden'); modalBlock.classList.remove('flex');
            await refreshCalendar();
            // clear composer
            document.getElementById('block-notes').value = '';
            document.getElementById('block-starts').value = '';
            document.getElementById('block-duration').value = 60;
            blockError.style.display='none';
            blockSave.disabled = false;
            return;
        }catch(err){ console.error(err); if(tempEl && tempEl.parentNode) tempEl.parentNode.removeChild(tempEl); blockError.textContent = 'Failed to create block'; blockError.style.display=''; }
        blockSave.disabled = false;
    }); }

    // Appointment modal
    const btnAppt = document.getElementById('btn-new-appointment');
    const modalAppt = document.getElementById('modal-appointment');
    const apptCancel = document.getElementById('appt-cancel');
    const apptSave = document.getElementById('appt-save');
    const apptError = document.getElementById('appt-error');
    if(btnAppt){ btnAppt.addEventListener('click', function(){
        try{ const inp = document.getElementById('appt-starts'); if(inp && !inp.value){ inp.value = getDefaultEATLocalIso(); } }catch(e){}
        modalAppt.classList.remove('hidden'); modalAppt.classList.add('flex');
    }); }
    if(apptCancel){ apptCancel.addEventListener('click', function(){ modalAppt.classList.add('hidden'); modalAppt.classList.remove('flex'); apptError.style.display='none'; }); }
    if(apptSave){ apptSave.addEventListener('click', async function(){
        apptError.style.display='none'; apptSave.disabled=true;
        const patient = document.getElementById('appt-patient').value;
        const doctor = document.getElementById('appt-doctor').value;
        const service = document.getElementById('appt-service').value;
        const starts = document.getElementById('appt-starts').value;
        const duration = parseInt(document.getElementById('appt-duration').value || '30', 10);
        const notes = document.getElementById('appt-notes').value;
        let tempEl = null;
        try{
            // optimistic tile
            const weekStart = (window.__WEEK_START) ? (function(){ const p=window.__WEEK_START.split('-'); return new Date(parseInt(p[0]), parseInt(p[1],10)-1, parseInt(p[2],10)); })() : null;
            if(weekStart && starts){
                const d = new Date(starts);
                const dateOnly = new Date(d.getFullYear(), d.getMonth(), d.getDate());
                const dayIndex = Math.round((dateOnly - weekStart) / (24*60*60*1000));
                if(dayIndex >=0 && dayIndex <=4){
                    const container = document.getElementById('calendar-columns');
                    const containerHeight = container ? container.getBoundingClientRect().height : 720;
                    const pxPerHour = containerHeight / 8;
                    const mins = minutesSinceDisplayStart(starts, 9);
                    const top = (mins/60) * pxPerHour + 6;
                    const height = ((duration || 30)/60) * pxPerHour - 6;
                    tempEl = createTempTile({ type:'appointment', label:'Appointment', topPx: top, heightPx: Math.max(28, height), colIndex: dayIndex, tempId: 'temp-appt-'+Date.now() });
                }
            }

            const res = await fetch('/appointments', { method: 'POST', credentials: 'same-origin', headers: { 'Content-Type':'application/json', 'X-CSRF-TOKEN': csrf, 'Accept':'application/json' }, body: JSON.stringify({ patient_id: patient, doctor_id: doctor, service_id: service, starts_at: starts, duration_minutes: duration, notes: notes }) });
            if(res.status === 422){ const j = await res.json(); if(tempEl && tempEl.parentNode) tempEl.parentNode.removeChild(tempEl); apptError.textContent = (j.errors && Object.values(j.errors).flat().join(' ')) || 'Validation error'; apptError.style.display=''; apptSave.disabled=false; return; }
            if(!res.ok) throw new Error('Failed');
            // success - refresh calendar in-place
            modalAppt.classList.add('hidden'); modalAppt.classList.remove('flex');
            await refreshCalendar();
            document.getElementById('appt-notes').value = '';
            document.getElementById('appt-starts').value = '';
            document.getElementById('appt-duration').value = 30;
            apptError.style.display='none';
            apptSave.disabled=false;
            return;
        }catch(err){ console.error(err); if(tempEl && tempEl.parentNode) tempEl.parentNode.removeChild(tempEl); apptError.textContent='Failed to create appointment'; apptError.style.display=''; }
        apptSave.disabled=false;
    }); }
})();
</script>
<!-- Add Doctor quick-action wiring (uses shared modal partial IDs and emits `doctor:created`) -->
<script>
document.addEventListener('DOMContentLoaded', function(){
    const csrf = document.querySelector('meta[name="csrf-token"]') ? document.querySelector('meta[name="csrf-token"]').getAttribute('content') : '';
    const addBtn = document.getElementById('add-doctor-inline');
    const modal = document.getElementById('modal-add-doctor');
    const overlay = document.getElementById('modal-add-doctor-overlay');
    const form = document.getElementById('modal-add-doctor-form');
    const cancel = document.getElementById('ad-cancel');
    const save = document.getElementById('ad-submit');

    function showToast(message){
        let t = document.getElementById('sr-toast');
        const m = document.getElementById('sr-toast-message');
        if(!t){ t = document.createElement('div'); t.id = 'sr-toast'; t.className = 'sr-toast'; t.setAttribute('aria-live','polite'); t.style.display='block'; document.body.appendChild(t); }
        if(m) m.textContent = message; else { t.innerHTML = `<div class="panel">${message}</div>`; }
        try{ t.style.display = 'block'; setTimeout(()=>{ t.style.display='none'; }, 3200); }catch(e){}
    }

    if(addBtn){ addBtn.addEventListener('click', function(){ if(modal){ modal.classList.remove('hidden'); if(overlay) overlay.style.display = 'flex'; const name = document.getElementById('ad-name'); if(name) name.focus(); } }); }
    if(cancel){ cancel.addEventListener('click', function(){ if(modal){ modal.classList.add('hidden'); if(overlay) overlay.style.display = 'none'; } ['ad-name-error','ad-specialty-error','ad-avatar-error'].forEach(id=>{ const el=document.getElementById(id); if(el){ el.style.display='none'; el.textContent=''; } }); if(form) form.reset(); }); }

    if(form){ form.addEventListener('submit', async function(e){ e.preventDefault(); if(save) save.disabled = true; ['ad-name-error','ad-specialty-error','ad-avatar-error'].forEach(id=>{ const el=document.getElementById(id); if(el){ el.style.display='none'; el.textContent=''; } });
        const payload = { name: (document.getElementById('ad-name').value || '').trim(), specialty: (document.getElementById('ad-specialty').value || '').trim(), avatar_url: (document.getElementById('ad-avatar').value || '').trim() };
        try{
            const res = await fetch('/doctors', { method:'POST', credentials:'same-origin', headers:{ 'Content-Type':'application/json', 'X-CSRF-TOKEN': csrf, 'Accept':'application/json' }, body: JSON.stringify(payload) });
            if(res.status === 422){ const j = await res.json(); const errs = j.errors || {}; if(errs.name){ const el=document.getElementById('ad-name-error'); if(el){ el.textContent = errs.name.join(' '); el.style.display='block'; } } if(errs.specialty){ const el=document.getElementById('ad-specialty-error'); if(el){ el.textContent = errs.specialty.join(' '); el.style.display='block'; } } if(errs.avatar_url){ const el=document.getElementById('ad-avatar-error'); if(el){ el.textContent = errs.avatar_url.join(' '); el.style.display='block'; } } if(save) save.disabled=false; return; }
            if(res.status === 403){ showToast('You are not allowed to add doctors.'); if(save) save.disabled=false; return; }
            if(!res.ok) throw new Error('Failed');
            const jr = await res.json(); const doc = (jr && jr.data) ? jr.data : jr;
            // append to doctor selects on this page
            ['block-doctor','appt-doctor'].forEach(selId=>{ const s = document.getElementById(selId); if(s){ const opt = document.createElement('option'); opt.value = doc.id; opt.textContent = doc.name || ('Doctor '+doc.id); s.appendChild(opt); s.value = doc.id; } });
            // emit a global event so other components can react
            try{ document.dispatchEvent(new CustomEvent('doctor:created', { detail: { doctor: doc } })); }catch(e){}
            // close modal and clear
            if(modal){ modal.classList.add('hidden'); } if(overlay) overlay.style.display = 'none'; if(form) form.reset(); showToast('Doctor added');
        }catch(err){ console.error(err); const generalErr = document.getElementById('add-doctor-error'); if(generalErr){ generalErr.textContent = 'Failed to create doctor'; generalErr.style.display = 'block'; } }
        if(save) save.disabled = false;
    }); }
});
</script>
<script>
// Wire timezone toggle and initial update of upcoming appointment times
document.addEventListener('DOMContentLoaded', function(){
    // Initialize timezone display from persisted preference (localStorage) or toggle default
    const tog = document.getElementById('toggle-eat');
    const persisted = window.localStorage ? window.localStorage.getItem('srcln-display-eat') : null;
    if(persisted === 'LOCAL'){
        window.__DISPLAY_TZ = 'LOCAL';
        if(tog) tog.checked = false;
    } else if(persisted === 'EAT'){
        window.__DISPLAY_TZ = 'EAT';
        if(tog) tog.checked = true;
    } else {
        // default to EAT when no preference saved
        window.__DISPLAY_TZ = (tog && tog.checked) ? 'EAT' : 'LOCAL';
        // persist the default
        try{ if(window.localStorage) window.localStorage.setItem('srcln-display-eat', window.__DISPLAY_TZ); }catch(e){}
    }

    if(tog){
        tog.addEventListener('change', function(){
            window.__DISPLAY_TZ = this.checked ? 'EAT' : 'LOCAL';
            try{ if(window.localStorage) window.localStorage.setItem('srcln-display-eat', window.__DISPLAY_TZ); }catch(e){}
            try{ updateUpcomingTimes(); }catch(e){}
            // also update any open day drawer header
            try{ const title = document.getElementById('day-drawer-title'); if(title && title.textContent) { /* day drawer formatting will use formatToEAT on open */ } }catch(e){}
        });
    }
    // ensure upcoming times reflect current setting
    try{ updateUpcomingTimes(); }catch(e){}
});
</script>
</body></html>