<!DOCTYPE html>

<html lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Sun Rise Clinic - Dashboard</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet"/>
<script>
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
            font-size: 20px;
        }
    </style>
</head>
<body class="font-display bg-background-light dark:bg-background-dark">
<div class="relative flex min-h-screen w-full">
<!-- SideNavBar -->
<aside class="flex flex-col w-64 bg-white dark:bg-gray-900 border-r border-gray-200 dark:border-gray-800">
<div class="flex flex-col flex-grow p-4">
<div class="flex items-center gap-3 mb-8">
<div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10" data-alt="Sun Rise Clinic Logo" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuCHANJAEHtt1jMBkCNON85o4mBXuGrwWTWw9XMkdwj_aSyrEf38IPyLNBsKvZq9FWFh3sUxX5OITkzLgPrZZxkTkLPl_0VIR1Gzys2z6qArOElIt0yp6lEEZYU3_rhdZLdfgDyvCXZ-ypFbqFN3T2QDAoHZnNnmSBKv6v-zNw1YosysgocRlTXFC-kEHxW536evxvuhBL5E6aRnmJSPi1t-OBZhtA4GJVqZdp1umGfMg9UxVcxIHSh5B4puW-FGQk8ZeteKX-WLBhfA");'></div>
<div class="flex flex-col">
<h1 class="text-gray-900 dark:text-white text-base font-bold leading-normal">Sun Rise Clinic</h1>
<p class="text-gray-500 dark:text-gray-400 text-sm font-normal leading-normal">Appointment System</p>
</div>
</div>
<nav class="flex flex-col gap-2">
<a class="flex items-center gap-3 px-3 py-2 rounded-lg bg-primary/20 dark:bg-primary/30" href="#">
<span class="material-symbols-outlined text-gray-900 dark:text-white">dashboard</span>
<p class="text-gray-900 dark:text-white text-sm font-medium leading-normal">Dashboard</p>
</a>
    <a class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800" href="{{ route('appointments.manage') }}">
<span class="material-symbols-outlined text-gray-700 dark:text-gray-300">calendar_month</span>
<p class="text-gray-700 dark:text-gray-300 text-sm font-medium leading-normal">Calendar</p>
</a>
    <a class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800" href="{{ route('patients.manage') }}">
<span class="material-symbols-outlined text-gray-700 dark:text-gray-300">groups</span>
<p class="text-gray-700 dark:text-gray-300 text-sm font-medium leading-normal">Patients</p>
</a>
    <a class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800" href="{{ route('reports') }}">
<span class="material-symbols-outlined text-gray-700 dark:text-gray-300">bar_chart</span>
<p class="text-gray-700 dark:text-gray-300 text-sm font-medium leading-normal">Reports</p>
</a>
</nav>
</div>
<div class="p-4 border-t border-gray-200 dark:border-gray-800">
<a class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800" href="#">
<span class="material-symbols-outlined text-gray-700 dark:text-gray-300">settings</span>
<p class="text-gray-700 dark:text-gray-300 text-sm font-medium leading-normal">Settings</p>
</a>
</div>
</aside>
<!-- Main Content -->
<div class="flex-1 flex flex-col">
<!-- TopNavBar -->
<header class="flex items-center justify-between whitespace-nowrap border-b border-solid border-gray-200 dark:border-gray-800 px-10 py-3 bg-white dark:bg-gray-900">
<div class="flex items-center gap-8">
<h2 class="text-gray-900 dark:text-white text-lg font-bold leading-tight tracking-[-0.015em]">Dashboard</h2>
</div>
<div class="flex flex-1 justify-end items-center gap-4">
<label class="relative flex-col w-full max-w-sm">
<div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
<span class="material-symbols-outlined text-gray-500 dark:text-gray-400">search</span>
</div>
<input class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-gray-900 dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary/50 border-gray-200 dark:border-gray-700 bg-background-light dark:bg-background-dark h-10 placeholder:text-gray-500 dark:placeholder:text-gray-400 pl-10 pr-4 text-sm font-normal leading-normal" placeholder="Search patients or appointments..." value=""/>
</label>
<button class="flex items-center justify-center rounded-lg h-10 w-10 bg-background-light dark:bg-background-dark text-gray-700 dark:text-gray-300 border border-gray-200 dark:border-gray-700 hover:bg-gray-200 dark:hover:bg-gray-700">
<span class="material-symbols-outlined">notifications</span>
</button>
<div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10" data-alt="User profile picture" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDJOw4D3Mx6odu4g3aeEHr5qidtv76kwaTE5t6xt-X_DULpgAsanX6OPwf5OFF0G_3-2X7VS4vMkt2PTf8PSootoYB5u4esJGfJpBpXdyjVUiKjdXN4MCMDawrKEPIi0ny6wC33nNWKeabIfNPh0IaAGvzzYS_rZq2PHEBSLhHTxa9VxxNCLNJzJQIXiZa-x1VqOs7AQdZo9KMhWqXK9jjE6ayc2BoYq098cWeyf1vv93AoJiAfhb69ATuv3JtT_xKUcGHizWyPPyCO");'></div>
</div>
</header>
<!-- Page Content -->
<main class="flex-1 p-8 overflow-y-auto">
<!-- Stats & Actions -->
<div class="flex justify-between items-start mb-6">
<div class="flex flex-wrap gap-4">
<div class="flex min-w-[200px] flex-1 flex-col gap-2 rounded-lg p-6 border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900">
<p class="text-gray-600 dark:text-gray-400 text-sm font-medium leading-normal">Total Appointments Today</p>
<p id="appointments_today" class="text-gray-900 dark:text-white tracking-tight text-3xl font-bold leading-tight">{{ $appointments_today ?? 0 }}</p>
</div>
<div class="flex min-w-[200px] flex-1 flex-col gap-2 rounded-lg p-6 border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900">
<p class="text-gray-600 dark:text-gray-400 text-sm font-medium leading-normal">Checked-in Patients</p>
<p id="checked_in" class="text-gray-900 dark:text-white tracking-tight text-3xl font-bold leading-tight">{{ $checked_in ?? 0 }}</p>
</div>
<div class="flex min-w-[200px] flex-1 flex-col gap-2 rounded-lg p-6 border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900">
<p class="text-gray-600 dark:text-gray-400 text-sm font-medium leading-normal">Pending Arrivals</p>
<p id="pending_arrivals" class="text-gray-900 dark:text-white tracking-tight text-3xl font-bold leading-tight">{{ $pending_arrivals ?? 0 }}</p>
</div>
</div>
        <div class="flex gap-3 ml-4">
        <button id="open-add-patient" class="flex min-w-[84px] items-center justify-center overflow-hidden rounded-lg h-10 px-4 bg-gray-200 dark:bg-gray-800 text-gray-900 dark:text-white text-sm font-bold leading-normal tracking-[0.015em] hover:bg-gray-300 dark:hover:bg-gray-700">
            <span class="truncate">Add Patient</span>
        </button>
        <button id="open-new-appointment" class="flex min-w-[84px] items-center justify-center overflow-hidden rounded-lg h-10 px-4 bg-primary text-background-dark text-sm font-bold leading-normal tracking-[0.015em] hover:opacity-90">
            <span class="truncate">New Appointment</span>
        </button>
    </div>
</div>
<!-- Today's Schedule -->
<div class="bg-white dark:bg-gray-900 rounded-lg border border-gray-200 dark:border-gray-800">
<h2 class="text-gray-900 dark:text-white text-[22px] font-bold leading-tight tracking-[-0.015em] px-6 pb-4 pt-5 border-b border-gray-200 dark:border-gray-800">Today's Schedule</h2>
<!-- Table Header -->
<div class="grid grid-cols-10 gap-4 px-6 py-3 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
<div class="col-span-1">Time</div>
<div class="col-span-3">Patient</div>
<div class="col-span-2">Doctor</div>
<div class="col-span-2">Status</div>
<div class="col-span-2 text-right">Actions</div>
</div>
<!-- Table Rows -->
<div id="todays-schedule-rows" class="divide-y divide-gray-200 dark:divide-gray-800">
<!-- Row 1 -->
<div class="grid grid-cols-10 gap-4 px-6 py-4 items-center hover:bg-gray-50 dark:hover:bg-gray-800/50">
<div class="col-span-1 text-sm font-medium text-gray-900 dark:text-white">09:00 AM</div>
<div class="col-span-3 flex items-center gap-3">
<div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-8" data-alt="Patient avatar" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuBOak4GC-uS42FIICqVeFgToIpmRGrv5oa9Sj-lkvx2AoGnE-GxNJRflt_yMjR3v2oD2Y23wiEOBn7kun-wQEQ4ZN0cJofJ4e01Vx2dnBcXIQlE-qpmTVwVhvlH2hGimTuxoK8BG1ZY0NkWHsdPKr_RwGSpzQE5vXLVeJ_r_8S3O3jDvAKM0xvpfiOSDU4q4OGiRtxyiwAodbtKa6kBblnu-2657dLGelyLRYXYwrQk9HKUesLrgUMAj4SaViUJX7LWbQ8EbFI3GtDD");'></div>
<span class="text-sm font-medium text-gray-900 dark:text-white">Liam Johnson</span>
</div>
<div class="col-span-2 text-sm text-gray-600 dark:text-gray-300">Dr. Evelyn Reed</div>
<div class="col-span-2">
<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200">Checked-in</span>
</div>
<div class="col-span-2 flex justify-end">
<button class="p-1 text-gray-500 dark:text-gray-400 rounded-full hover:bg-gray-200 dark:hover:bg-gray-700"><span class="material-symbols-outlined">more_horiz</span></button>
</div>
</div>
<!-- Row 2 -->
<div class="grid grid-cols-10 gap-4 px-6 py-4 items-center hover:bg-gray-50 dark:hover:bg-gray-800/50">
<div class="col-span-1 text-sm font-medium text-gray-900 dark:text-white">09:30 AM</div>
<div class="col-span-3 flex items-center gap-3">
<div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-8" data-alt="Patient avatar" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuCVsp3X-Og3xcSU0ROlpL4RbCcHK6aI_JY0dNeMsmhF2CB6G3VN6Fp63PDWxmP8fA7z4c6jeXWu4PuRod6lIMH7dljA6_z7ROYwJHmwbr69-RXJVTkMeOiulf9R9Qa_Im8hNSXNtShcuQ9AvhKzNubnlzBzCwTWPeP_Cx0M9t_sSAjOmYxp1-Wd7JR5B7cxGCa1O92rnBp5bnsctgsajDzAVbISzI13KfnFYNsAPdX_0Sa-HBPqx7iaTCDI0kZ-0_up13ahEksDYWc-");'></div>
<span class="text-sm font-medium text-gray-900 dark:text-white">Noah Williams</span>
</div>
<div class="col-span-2 text-sm text-gray-600 dark:text-gray-300">Dr. Marcus Thorne</div>
<div class="col-span-2">
<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-200">Pending</span>
</div>
<div class="col-span-2 flex justify-end">
<button class="p-1 text-gray-500 dark:text-gray-400 rounded-full hover:bg-gray-200 dark:hover:bg-gray-700"><span class="material-symbols-outlined">more_horiz</span></button>
</div>
</div>
<!-- Row 3 -->
<div class="grid grid-cols-10 gap-4 px-6 py-4 items-center hover:bg-gray-50 dark:hover:bg-gray-800/50">
<div class="col-span-1 text-sm font-medium text-gray-900 dark:text-white">10:00 AM</div>
<div class="col-span-3 flex items-center gap-3">
<div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-8" data-alt="Patient avatar" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuBaLVIVp-nSu6hdFO8eAO0C3E2N02BriuW8SyY1V9xsW-1mjut2tQcSKoeuCLosYfpJKsmD4OpHncQhvIU_tCvMRwD74CQ26C2Kl_puvuBPZeV9Cb0qCkd0Unjlq6dNjqHeYixrFG-9qV92Ch9HzmGd1XrTA4KmyRLgbcYsvLUjumMu65Ns9YqyZpBr5CNkoOL41cAOFcsZCcuw5zpsDb05F4T51b3M9dY-cyVnaTU63vwrrfGEhonc7srE5euEzXgOET8-0msf_JoX");'></div>
<span class="text-sm font-medium text-gray-900 dark:text-white">Olivia Brown</span>
</div>
<div class="col-span-2 text-sm text-gray-600 dark:text-gray-300">Dr. Evelyn Reed</div>
<div class="col-span-2">
<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200">Checked-in</span>
</div>
<div class="col-span-2 flex justify-end">
<button class="p-1 text-gray-500 dark:text-gray-400 rounded-full hover:bg-gray-200 dark:hover:bg-gray-700"><span class="material-symbols-outlined">more_horiz</span></button>
</div>
</div>
<!-- Row 4 -->
<div class="grid grid-cols-10 gap-4 px-6 py-4 items-center hover:bg-gray-50 dark:hover:bg-gray-800/50">
<div class="col-span-1 text-sm font-medium text-gray-900 dark:text-white">10:15 AM</div>
<div class="col-span-3 flex items-center gap-3">
<div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-8" data-alt="Patient avatar" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuB-9KOpVm_DB-m-AxVUVnTNgsxFbhk2S37_48s6eJUngDbOvBVaeDEix-0gb52n3wSuTWkYt0i1rYlUibVrHTgzrLWmOLyED9jc8evJ7WFA-kudbyZxReY-L6AFiM3e-p2eKJ1ldZS1L_xbB7YysYKo2l-6wlZFWf5N_YkywzasYbSn7UHku8ul-E1SNozR3L3H8ptf10Kb7JwU7vOVRCvDejJ-3GYenT3tJY64f7CLkhw-mBwkCbt06PPdzO3DWaQ5xlOvZEK-1wMG");'></div>
<span class="text-sm font-medium text-gray-900 dark:text-white">Elijah Jones</span>
</div>
<div class="col-span-2 text-sm text-gray-600 dark:text-gray-300">Dr. Marcus Thorne</div>
<div class="col-span-2">
<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200">Cancelled</span>
</div>
<div class="col-span-2 flex justify-end">
<button class="p-1 text-gray-500 dark:text-gray-400 rounded-full hover:bg-gray-200 dark:hover:bg-gray-700"><span class="material-symbols-outlined">more_horiz</span></button>
</div>
</div>
<!-- Row 5 -->
<div class="grid grid-cols-10 gap-4 px-6 py-4 items-center hover:bg-gray-50 dark:hover:bg-gray-800/50">
<div class="col-span-1 text-sm font-medium text-gray-900 dark:text-white">11:00 AM</div>
<div class="col-span-3 flex items-center gap-3">
<div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-8" data-alt="Patient avatar" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDYJCpzfM2-t-X6JsUO98qXasrPoItscbrmmLNlKE-ePIxUygk9oJFconho225osmkJpfL1AUHQ211Mfk259r9g4YQ59Lu3rSDTkvGT5UpzGXS7k6TnF3C95gz33OGyDxT9Ps2-xBzWUDLbJaW_7dtBr4wzHC9jWoLIxXp9bjr8xJy16xyzg6Efw3PWQMtFE-Qb2S8uoo1zafsnxM4YLrEDA6PpVf4qMwjtwTpaNTYB0-5IIWUXmgkXQrn0eM4-WXaQ3h4abRA1HxSg");'></div>
<span class="text-sm font-medium text-gray-900 dark:text-white">Ava Miller</span>
</div>
<div class="col-span-2 text-sm text-gray-600 dark:text-gray-300">Dr. Evelyn Reed</div>
<div class="col-span-2">
<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-200">Pending</span>
</div>
<div class="col-span-2 flex justify-end">
<button class="p-1 text-gray-500 dark:text-gray-400 rounded-full hover:bg-gray-200 dark:hover:bg-gray-700"><span class="material-symbols-outlined">more_horiz</span></button>
</div>
</div>
</div>
</div>
</main>
</div>
</div>

<!-- Modals -->
<!-- Patient Modal -->
<div id="patient-modal" class="fixed inset-0 z-40 hidden items-center justify-center bg-black/40">
    <div class="bg-white dark:bg-gray-900 rounded-lg w-full max-w-lg p-6">
        <h3 class="text-lg font-semibold mb-4">Add Patient</h3>
        <div id="patient-modal-errors" class="mb-3 text-sm text-red-700"></div>
        <form id="patient-form">
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-sm">Full name</label>
                    <input name="name" class="w-full mt-1 rounded border px-3 py-2" required />
                </div>
                <div>
                    <label class="block text-sm">Email</label>
                    <input name="email" type="email" class="w-full mt-1 rounded border px-3 py-2" />
                </div>
                <div>
                    <label class="block text-sm">Phone</label>
                    <input name="phone" class="w-full mt-1 rounded border px-3 py-2" />
                </div>
                <div>
                    <label class="block text-sm">Date of birth</label>
                    <input name="dob" type="date" class="w-full mt-1 rounded border px-3 py-2" />
                </div>
            </div>
            <div class="mt-4 flex justify-end gap-2">
                <button type="button" id="patient-cancel" class="px-4 py-2 border rounded">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-primary text-black rounded">Save</button>
            </div>
        </form>
    </div>
</div>

<!-- Appointment Modal -->
<div id="appointment-modal" class="fixed inset-0 z-40 hidden items-center justify-center bg-black/40">
    <div class="bg-white dark:bg-gray-900 rounded-lg w-full max-w-2xl p-6">
        <h3 class="text-lg font-semibold mb-4">New Appointment</h3>
        <div id="appointment-modal-errors" class="mb-3 text-sm text-red-700"></div>
        <form id="appointment-form">
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-sm">Patient</label>
                    <select name="patient_id" id="appt-patient" class="w-full mt-1 rounded border px-3 py-2" required></select>
                </div>
                <div>
                    <label class="block text-sm">Doctor</label>
                    <select name="doctor_id" id="appt-doctor" class="w-full mt-1 rounded border px-3 py-2" required></select>
                </div>
                <div>
                    <label class="block text-sm">Service</label>
                    <select name="service_id" id="appt-service" class="w-full mt-1 rounded border px-3 py-2" required></select>
                </div>
                <div>
                    <label class="block text-sm">Starts at</label>
                    <input name="starts_at" id="appt-starts" type="datetime-local" class="w-full mt-1 rounded border px-3 py-2" required />
                </div>
                <div>
                    <label class="block text-sm">Duration (minutes)</label>
                    <input name="duration_minutes" type="number" class="w-full mt-1 rounded border px-3 py-2" />
                </div>
                <div class="col-span-2">
                    <label class="block text-sm">Notes</label>
                    <textarea name="notes" class="w-full mt-1 rounded border px-3 py-2" rows="3"></textarea>
                </div>
            </div>
            <div class="mt-4 flex justify-end gap-2">
                <button type="button" id="appointment-cancel" class="px-4 py-2 border rounded">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-primary text-black rounded">Save</button>
            </div>
        </form>
    </div>
</div>

<!-- Toast -->
<div id="toast" class="fixed bottom-6 right-6 z-50 hidden">
    <div class="bg-black/80 text-white px-4 py-2 rounded">Saved</div>
</div>

<script>
    // Simple polling for dashboard summary and recent appointments (MVP)
    (function(){
        const summaryUrl = '/api/dashboard/summary';
        const recentUrl = '/api/appointments/recent';

        function updateSummary(data){
            if(!data) return;
            const a = document.getElementById('appointments_today');
            const b = document.getElementById('checked_in');
            const c = document.getElementById('pending_arrivals');
            if(a) a.textContent = data.appointments_today ?? 0;
            if(b) b.textContent = data.checked_in ?? 0;
            if(c) c.textContent = data.pending_arrivals ?? 0;
        }

        function renderRows(rows){
            const container = document.getElementById('todays-schedule-rows');
            if(!container) return;
            if(!rows || rows.length === 0){
                container.innerHTML = '<div class="px-6 py-4 text-sm text-gray-500">No appointments for today.</div>';
                return;
            }
            // determine display preference (persisted in localStorage by schedule page)
            const displayPref = (window.localStorage && window.localStorage.getItem('srcln-display-eat')) ? window.localStorage.getItem('srcln-display-eat') : 'EAT';

            const fmtLocal = (iso) => {
                try{
                    if(!iso) return '';
                    const d = new Date(iso);
                    return new Intl.DateTimeFormat(undefined, { hour: 'numeric', minute: '2-digit' }).format(d);
                }catch(e){ return iso || ''; }
            };

            const html = rows.map(r => {
                const timeLabel = (displayPref === 'LOCAL') ? (r.starts_at ? fmtLocal(r.starts_at) : (r.time || '')) : (r.starts_at_eat_display || r.time || '');
                return `
                <div class="grid grid-cols-10 gap-4 px-6 py-4 items-center hover:bg-gray-50 dark:hover:bg-gray-800/50">
                    <div class="col-span-1 text-sm font-medium text-gray-900 dark:text-white">${timeLabel}</div>
                    <div class="col-span-3 flex items-center gap-3">
                        <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-8" style="background-color:#eee;width:36px;height:36px;border-radius:9999px"></div>
                        <span class="text-sm font-medium text-gray-900 dark:text-white">${escapeHtml(r.patient)}</span>
                    </div>
                    <div class="col-span-2 text-sm text-gray-600 dark:text-gray-300">${escapeHtml(r.doctor)}</div>
                    <div class="col-span-2">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${statusClass(r.status)}">${escapeHtml(capitalize(r.status))}</span>
                    </div>
                    <div class="col-span-2 flex justify-end">
                        <button data-id="${r.id}" class="appointment-actions-btn p-1 text-gray-500 dark:text-gray-400 rounded-full hover:bg-gray-200 dark:hover:bg-gray-700"><span class="material-symbols-outlined">more_horiz</span></button>
                    </div>
                </div>`;
            }).join('');
            container.innerHTML = html;

            // attach delegated click handler for action buttons — show a small popover menu
            container.querySelectorAll('.appointment-actions-btn').forEach(btn => {
                btn.addEventListener('click', (ev) => {
                    ev.stopPropagation();
                    const appointmentId = btn.getAttribute('data-id');
                    if(!appointmentId) return;
                    // create/populate popover
                    let pop = document.getElementById('appointment-action-popover');
                    if(!pop){
                        pop = document.createElement('div');
                        pop.id = 'appointment-action-popover';
                        pop.className = 'z-50 bg-white dark:bg-gray-800 rounded shadow-md ring-1 ring-black/5 p-1';
                        pop.style.position = 'absolute';
                        pop.style.minWidth = '140px';
                        pop.innerHTML = `
                            <button data-action="checkin" class="w-full text-left px-3 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-700">Check-in</button>
                            <button data-action="cancel" class="w-full text-left px-3 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-700">Cancel</button>
                            <button data-action="delete" class="w-full text-left px-3 py-2 text-sm text-red-600 hover:bg-red-50 dark:hover:bg-red-700">Delete</button>
                        `;
                        document.body.appendChild(pop);

                        // delegate clicks inside popover
                        pop.addEventListener('click', async (e) => {
                            const actionBtn = e.target.closest('button[data-action]');
                            if(!actionBtn) return;
                            const action = actionBtn.getAttribute('data-action');
                            // perform action and hide popover
                            await performAction(appointmentId, action);
                            hidePopover();
                        });
                    }

                    // position the popover next to the clicked button
                    const rect = btn.getBoundingClientRect();
                    const top = rect.top + window.scrollY + rect.height + 6; // below the button
                    let left = rect.left + window.scrollX - 10;
                    // ensure it's within viewport
                    const maxLeft = window.innerWidth - 180;
                    if(left > maxLeft) left = maxLeft;
                    pop.style.top = top + 'px';
                    pop.style.left = left + 'px';
                    pop.style.display = 'block';

                    // close on outside click
                    setTimeout(() => {
                        const onDoc = (ev2) => {
                            if(!pop.contains(ev2.target) && ev2.target !== btn) hidePopover();
                        };
                        document.addEventListener('click', onDoc, { once: true });
                        function hidePopover(){
                            pop.style.display = 'none';
                        }
                    }, 0);
                });
            });
        }

        function statusClass(status){
            if(!status) return 'bg-gray-100 text-gray-700';
            status = status.toLowerCase();
            if(status.includes('check')) return 'bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200';
            if(status.includes('pend')) return 'bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-200';
            if(status.includes('cancel')) return 'bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200';
            return 'bg-gray-100 text-gray-700';
        }

        function capitalize(s){ if(!s) return s; return s.charAt(0).toUpperCase() + s.slice(1); }

        function escapeHtml(unsafe){ return String(unsafe).replace(/[&<"'`=\/]/g, function (s) { return {'&':'&amp;','<':'&lt;','"':'&quot;',"'":'&#39;','/':'&#x2F;','`':'&#96;','=':'&#61;'}[s]; }); }

        async function poll(){
            try{
                const [sRes, rRes] = await Promise.all([
                    fetch(summaryUrl, {credentials: 'same-origin'}),
                    fetch(recentUrl, {credentials: 'same-origin'})
                ]);
                if(sRes.ok){ const s = await sRes.json(); updateSummary(s); }
                if(rRes.ok){ const j = await rRes.json(); renderRows(j.data || []); }
            }catch(e){ console.error('Dashboard poll error', e); }
        }

        async function performAction(appointmentId, action){
            try{
                const tokenMeta = document.querySelector('meta[name="csrf-token"]');
                const token = tokenMeta ? tokenMeta.getAttribute('content') : null;
                const res = await fetch(`/api/appointments/${appointmentId}/action`, {
                    method: 'POST',
                    credentials: 'same-origin',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    body: JSON.stringify({ action })
                });
                if(!res.ok){
                    const err = await res.text();
                    alert('Action failed: ' + err);
                    return;
                }
                const j = await res.json();
                // refresh summary and rows
                await poll();
                if(j && j.message) alert(j.message);
            }catch(e){ console.error('performAction error', e); alert('Action error'); }
        }

        // --- Modal & AJAX create handlers ---
        const csrfToken = document.querySelector('meta[name="csrf-token"]') ? document.querySelector('meta[name="csrf-token"]').getAttribute('content') : '';

        function showElement(el){ if(!el) return; el.classList.remove('hidden'); el.classList.add('flex'); }
        function hideElement(el){ if(!el) return; el.classList.add('hidden'); el.classList.remove('flex'); }

        // open patient modal
        const openPatientBtn = document.getElementById('open-add-patient');
        const patientModal = document.getElementById('patient-modal');
        const patientForm = document.getElementById('patient-form');
        const patientErrors = document.getElementById('patient-modal-errors');

        openPatientBtn && openPatientBtn.addEventListener('click', (e) => {
            e.preventDefault();
            patientForm.reset();
            patientErrors.innerHTML = '';
            showElement(patientModal);
        });
        document.getElementById('patient-cancel')?.addEventListener('click', () => hideElement(patientModal));

        patientForm && patientForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            patientErrors.innerHTML = '';
            const formData = new FormData(patientForm);
            const payload = {};
            formData.forEach((v,k)=> payload[k]=v);
            try{
                const res = await fetch('/patients', {
                    method: 'POST',
                    credentials: 'same-origin',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(payload)
                });
                if(res.status === 201){
                    const j = await res.json();
                    hideElement(patientModal);
                    showToast(j.message || 'Patient created');
                    await poll();
                } else if(res.status === 422){
                    const j = await res.json();
                    const errors = j.errors || {};
                    patientErrors.innerHTML = Object.values(errors).map(arr => '<div>'+escapeHtml(arr.join(', '))+'</div>').join('');
                } else {
                    const txt = await res.text();
                    patientErrors.innerHTML = '<div>'+escapeHtml(txt)+'</div>';
                }
            }catch(err){ console.error(err); patientErrors.innerHTML = '<div>Network error</div>'; }
        });

        // appointment modal handlers
        const openApptBtn = document.getElementById('open-new-appointment');
        const apptModal = document.getElementById('appointment-modal');
        const apptForm = document.getElementById('appointment-form');
        const apptErrors = document.getElementById('appointment-modal-errors');

        openApptBtn && openApptBtn.addEventListener('click', async (e) => {
            e.preventDefault();
            apptErrors.innerHTML = '';
            apptForm.reset();
            showElement(apptModal);
            // populate selects
            try{
                const [pRes, dRes, sRes] = await Promise.all([
                    fetch('/patients-list', {credentials: 'same-origin'}),
                    fetch('/doctors', {credentials: 'same-origin'}),
                    fetch('/services-list', {credentials: 'same-origin'})
                ]);
                const [pJson, dJson, sJson] = await Promise.all([pRes.json(), dRes.json(), sRes.json()]);
                const pSel = document.getElementById('appt-patient'); pSel.innerHTML = '';
                pJson.forEach(p => { const o = document.createElement('option'); o.value = p.id; o.text = p.name; pSel.appendChild(o); });
                const dSel = document.getElementById('appt-doctor'); dSel.innerHTML = '';
                dJson.forEach(d => { const o = document.createElement('option'); o.value = d.id; o.text = d.name; dSel.appendChild(o); });
                const sSel = document.getElementById('appt-service'); sSel.innerHTML = '';
                sJson.forEach(s => { const o = document.createElement('option'); o.value = s.id; o.text = s.name; sSel.appendChild(o); });
            }catch(err){ console.error('populate selects error', err); }
        });
        document.getElementById('appointment-cancel')?.addEventListener('click', () => hideElement(apptModal));

        apptForm && apptForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            apptErrors.innerHTML = '';
            const formData = new FormData(apptForm); const payload = {}; formData.forEach((v,k)=> payload[k]=v);
            try{
                const res = await fetch('/appointments', {
                    method: 'POST',
                    credentials: 'same-origin',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(payload)
                });
                if(res.status === 201){ const j = await res.json(); hideElement(apptModal); showToast(j.message || 'Appointment created'); await poll(); }
                else if(res.status === 422){ const j = await res.json(); const errors = j.errors||{}; apptErrors.innerHTML = Object.values(errors).map(arr=>'<div>'+escapeHtml(arr.join(', '))+'</div>').join(''); }
                else { const txt = await res.text(); apptErrors.innerHTML = '<div>'+escapeHtml(txt)+'</div>'; }
            }catch(err){ console.error(err); apptErrors.innerHTML = '<div>Network error</div>'; }
        });

        // toast
        function showToast(message, ms=2200){
            const t = document.getElementById('toast'); if(!t) return; t.firstElementChild.textContent = message || 'Saved'; t.classList.remove('hidden'); setTimeout(()=> t.classList.add('hidden'), ms);
        }

        // initial poll and interval
        poll();
        setInterval(poll, 8000);
    })();
</script>
</body></html>