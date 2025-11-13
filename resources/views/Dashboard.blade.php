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
<a class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800" href="#">
<span class="material-symbols-outlined text-gray-700 dark:text-gray-300">calendar_month</span>
<p class="text-gray-700 dark:text-gray-300 text-sm font-medium leading-normal">Calendar</p>
</a>
<a class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800" href="#">
<span class="material-symbols-outlined text-gray-700 dark:text-gray-300">groups</span>
<p class="text-gray-700 dark:text-gray-300 text-sm font-medium leading-normal">Patients</p>
</a>
<a class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800" href="#">
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
<button class="flex min-w-[84px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 bg-gray-200 dark:bg-gray-800 text-gray-900 dark:text-white text-sm font-bold leading-normal tracking-[0.015em] hover:bg-gray-300 dark:hover:bg-gray-700">
<span class="truncate">Add Patient</span>
</button>
<button class="flex min-w-[84px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 bg-primary text-background-dark text-sm font-bold leading-normal tracking-[0.015em] hover:opacity-90">
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
            const html = rows.map(r => `
                <div class="grid grid-cols-10 gap-4 px-6 py-4 items-center hover:bg-gray-50 dark:hover:bg-gray-800/50">
                    <div class="col-span-1 text-sm font-medium text-gray-900 dark:text-white">${r.time}</div>
                    <div class="col-span-3 flex items-center gap-3">
                        <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-8" style="background-color:#eee;width:36px;height:36px;border-radius:9999px"></div>
                        <span class="text-sm font-medium text-gray-900 dark:text-white">${escapeHtml(r.patient)}</span>
                    </div>
                    <div class="col-span-2 text-sm text-gray-600 dark:text-gray-300">${escapeHtml(r.doctor)}</div>
                    <div class="col-span-2">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${statusClass(r.status)}">${escapeHtml(capitalize(r.status))}</span>
                    </div>
                    <div class="col-span-2 flex justify-end">
                        <button class="p-1 text-gray-500 dark:text-gray-400 rounded-full hover:bg-gray-200 dark:hover:bg-gray-700"><span class="material-symbols-outlined">more_horiz</span></button>
                    </div>
                </div>
            `).join('');
            container.innerHTML = html;
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
                const [sRes, rRes] = await Promise.all([fetch(summaryUrl, {credentials: 'same-origin'}), fetch(recentUrl, {credentials: 'same-origin'})]);
                if(sRes.ok){ const s = await sRes.json(); updateSummary(s); }
                if(rRes.ok){ const j = await rRes.json(); renderRows(j.data || []); }
            }catch(e){ console.error('Dashboard poll error', e); }
        }

        // initial poll and interval
        poll();
        setInterval(poll, 8000);
    })();
</script>
</body></html>