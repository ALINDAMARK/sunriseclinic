<!DOCTYPE html>

<html class="light" lang="en"><head>
<meta charset="utf-8"/>
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
<a class="flex items-center gap-3 rounded-lg px-3 py-2 text-neutral-dark hover:bg-neutral-light dark:text-white dark:hover:bg-neutral-dark/40" href="#">
<span class="material-symbols-outlined text-2xl">
                                    dashboard
                                </span>
<p class="text-sm font-medium leading-normal">Dashboard</p>
</a>
<a class="flex items-center gap-3 rounded-lg bg-primary/10 px-3 py-2 text-primary dark:bg-primary/20 dark:text-primary" href="#">
<span class="material-symbols-outlined text-2xl">
                                    calendar_month
                                </span>
<p class="text-sm font-bold leading-normal">Schedule</p>
</a>
<a class="flex items-center gap-3 rounded-lg px-3 py-2 text-neutral-dark hover:bg-neutral-light dark:text-white dark:hover:bg-neutral-dark/40" href="#">
<span class="material-symbols-outlined text-2xl">
                                    groups
                                </span>
<p class="text-sm font-medium leading-normal">Patients</p>
</a>
<a class="flex items-center gap-3 rounded-lg px-3 py-2 text-neutral-dark hover:bg-neutral-light dark:text-white dark:hover:bg-neutral-dark/40" href="#">
<span class="material-symbols-outlined text-2xl">
                                    chat
                                </span>
<p class="text-sm font-medium leading-normal">Messages</p>
</a>
</div>
</div>
</div>
<div class="flex flex-col gap-4">
<a class="flex items-center gap-3 rounded-lg px-3 py-2 text-neutral-dark hover:bg-neutral-light dark:text-white dark:hover:bg-neutral-dark/40" href="#">
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
<button class="flex min-w-[84px] cursor-pointer items-center justify-center gap-2 overflow-hidden rounded-lg h-10 px-4 bg-white text-neutral-dark shadow-sm border border-neutral-light hover:bg-neutral-light/50 dark:bg-neutral-dark/50 dark:text-white dark:border-neutral-dark/20 dark:hover:bg-neutral-dark/30">
<span class="material-symbols-outlined text-xl">block</span>
<span class="truncate text-sm font-bold">Block Time</span>
</button>
<button class="flex min-w-[84px] cursor-pointer items-center justify-center gap-2 overflow-hidden rounded-lg h-10 px-4 bg-primary text-white shadow-sm hover:bg-primary/90">
<span class="material-symbols-outlined text-xl">add</span>
<span class="truncate text-sm font-bold">New Appointment</span>
</button>
</div>
</header>
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
<button class="flex size-10 items-center justify-center rounded-lg hover:bg-neutral-light dark:hover:bg-neutral-dark/40">
<span class="material-symbols-outlined text-2xl text-neutral-dark dark:text-white">chevron_left</span>
</button>
<p class="text-base font-bold leading-tight text-neutral-dark dark:text-white">October 20-26, 2024</p>
<button class="flex size-10 items-center justify-center rounded-lg hover:bg-neutral-light dark:hover:bg-neutral-dark/40">
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
<div class="absolute inset-0 grid grid-cols-5 pl-1 pt-1">
<!-- Mon -->
<div class="relative col-start-1 pr-1">
<div class="absolute w-full cursor-pointer rounded-lg border-l-4 border-status-green bg-status-green/20 p-2" style="top: 1rem; height: 5.5rem;"><p class="text-xs font-bold text-status-green">Michael P.</p><p class="text-xs text-status-green/80">Annual Checkup</p></div>
<div class="absolute w-full cursor-pointer rounded-lg border-l-4 border-status-yellow bg-status-yellow/20 p-2" style="top: 13rem; height: 5.5rem;"><p class="text-xs font-bold text-status-yellow">Jessica L.</p><p class="text-xs text-status-yellow/80">Follow-up</p></div>
</div>
<!-- Tue -->
<div class="relative col-start-2 pr-1">
<div class="absolute w-full cursor-pointer rounded-lg border-l-4 border-status-red bg-status-red/20 p-2" style="top: 7rem; height: 5.5rem;"><p class="text-xs font-bold text-status-red">David C.</p><p class="text-xs text-status-red/80">Cancelled</p></div>
</div>
<!-- Wed -->
<div class="relative col-start-3 pr-1">
<div class="absolute w-full cursor-pointer rounded-lg border-l-4 border-status-green bg-status-green/20 p-2" style="top: 1rem; height: 5.5rem;"><p class="text-xs font-bold text-status-green">Laura S.</p><p class="text-xs text-status-green/80">New Patient</p></div>
<div class="absolute w-full cursor-pointer rounded-lg border-l-4 border-status-green bg-status-green/20 p-2" style="top: 7rem; height: 2.5rem;"><p class="text-xs font-bold text-status-green">Robert K.</p><p class="text-xs text-status-green/80">Consultation</p></div>
<div class="absolute w-full cursor-pointer rounded-lg border-l-4 border-status-gray bg-status-gray/20 p-2" style="top: 10rem; height: 5.5rem;"><p class="text-xs font-bold text-status-gray">Lunch Break</p></div>
<div class="absolute w-full cursor-pointer rounded-lg border-l-4 border-status-green bg-status-green/20 p-2" style="top: 19rem; height: 5.5rem;"><p class="text-xs font-bold text-status-green">Olivia M.</p><p class="text-xs text-status-green/80">Follow-up</p></div>
</div>
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
<button class="flex size-8 items-center justify-center rounded-lg hover:bg-neutral-light dark:hover:bg-neutral-dark/40">
<span class="material-symbols-outlined text-lg text-neutral-dark dark:text-white">chevron_left</span>
</button>
<p class="flex-1 text-center text-base font-bold leading-tight text-neutral-dark dark:text-white">October 2024</p>
<button class="flex size-8 items-center justify-center rounded-lg hover:bg-neutral-light dark:hover:bg-neutral-dark/40">
<span class="material-symbols-outlined text-lg text-neutral-dark dark:text-white">chevron_right</span>
</button>
</div>
<div class="grid grid-cols-7">
<p class="flex h-10 w-full items-center justify-center pb-0.5 text-[13px] font-bold leading-normal text-neutral-medium">S</p>
<p class="flex h-10 w-full items-center justify-center pb-0.5 text-[13px] font-bold leading-normal text-neutral-medium">M</p>
<p class="flex h-10 w-full items-center justify-center pb-0.5 text-[13px] font-bold leading-normal text-neutral-medium">T</p>
<p class="flex h-10 w-full items-center justify-center pb-0.5 text-[13px] font-bold leading-normal text-neutral-medium">W</p>
<p class="flex h-10 w-full items-center justify-center pb-0.5 text-[13px] font-bold leading-normal text-neutral-medium">T</p>
<p class="flex h-10 w-full items-center justify-center pb-0.5 text-[13px] font-bold leading-normal text-neutral-medium">F</p>
<p class="flex h-10 w-full items-center justify-center pb-0.5 text-[13px] font-bold leading-normal text-neutral-medium">S</p>
<button class="col-start-3 h-10 w-full text-sm font-medium leading-normal text-neutral-dark dark:text-white"><div class="flex size-full items-center justify-center rounded-full">1</div></button>
<button class="h-10 w-full text-sm font-medium leading-normal text-neutral-dark dark:text-white"><div class="flex size-full items-center justify-center rounded-full">2</div></button>
<button class="h-10 w-full text-sm font-medium leading-normal text-neutral-dark dark:text-white"><div class="flex size-full items-center justify-center rounded-full">3</div></button>
<button class="h-10 w-full text-sm font-medium leading-normal text-neutral-dark dark:text-white"><div class="flex size-full items-center justify-center rounded-full">4</div></button>
<button class="h-10 w-full text-sm font-medium leading-normal text-neutral-dark dark:text-white"><div class="flex size-full items-center justify-center rounded-full">5</div></button>
<button class="h-10 w-full text-sm font-medium leading-normal text-neutral-dark dark:text-white"><div class="flex size-full items-center justify-center rounded-full">6</div></button>
<button class="h-10 w-full text-sm font-medium leading-normal text-neutral-dark dark:text-white"><div class="flex size-full items-center justify-center rounded-full">7</div></button>
<button class="h-10 w-full text-sm font-medium leading-normal text-neutral-dark dark:text-white"><div class="flex size-full items-center justify-center rounded-full">8</div></button>
<button class="h-10 w-full text-sm font-medium leading-normal text-neutral-dark dark:text-white"><div class="flex size-full items-center justify-center rounded-full">9</div></button>
<button class="h-10 w-full text-sm font-medium leading-normal text-neutral-dark dark:text-white"><div class="flex size-full items-center justify-center rounded-full">10</div></button>
<button class="h-10 w-full text-sm font-medium leading-normal text-neutral-dark dark:text-white"><div class="flex size-full items-center justify-center rounded-full">11</div></button>
<button class="h-10 w-full text-sm font-medium leading-normal text-neutral-dark dark:text-white"><div class="flex size-full items-center justify-center rounded-full">12</div></button>
<button class="h-10 w-full text-sm font-medium leading-normal text-neutral-dark dark:text-white"><div class="flex size-full items-center justify-center rounded-full">13</div></button>
<button class="h-10 w-full text-sm font-medium leading-normal text-neutral-dark dark:text-white"><div class="flex size-full items-center justify-center rounded-full">14</div></button>
<button class="h-10 w-full text-sm font-medium leading-normal text-neutral-dark dark:text-white"><div class="flex size-full items-center justify-center rounded-full">15</div></button>
<button class="h-10 w-full text-sm font-medium leading-normal text-neutral-dark dark:text-white"><div class="flex size-full items-center justify-center rounded-full">16</div></button>
<button class="h-10 w-full text-sm font-medium leading-normal text-neutral-dark dark:text-white"><div class="flex size-full items-center justify-center rounded-full">17</div></button>
<button class="h-10 w-full text-sm font-medium leading-normal text-neutral-dark dark:text-white"><div class="flex size-full items-center justify-center rounded-full">18</div></button>
<button class="h-10 w-full text-sm font-medium leading-normal text-neutral-dark dark:text-white"><div class="flex size-full items-center justify-center rounded-full">19</div></button>
<button class="h-10 w-full text-sm font-medium leading-normal text-neutral-dark dark:text-white"><div class="flex size-full items-center justify-center rounded-full">20</div></button>
<button class="h-10 w-full text-sm font-medium leading-normal text-neutral-dark dark:text-white"><div class="flex size-full items-center justify-center rounded-full">21</div></button>
<button class="h-10 w-full text-sm font-medium leading-normal text-neutral-dark dark:text-white"><div class="flex size-full items-center justify-center rounded-full">22</div></button>
<button class="h-10 w-full text-sm font-medium leading-normal text-primary"><div class="flex size-full items-center justify-center rounded-full bg-primary/20 ring-2 ring-primary">23</div></button>
<button class="h-10 w-full text-sm font-medium leading-normal text-neutral-dark dark:text-white"><div class="flex size-full items-center justify-center rounded-full">24</div></button>
<button class="h-10 w-full text-sm font-medium leading-normal text-neutral-dark dark:text-white"><div class="flex size-full items-center justify-center rounded-full">25</div></button>
<button class="h-10 w-full text-sm font-medium leading-normal text-neutral-dark dark:text-white"><div class="flex size-full items-center justify-center rounded-full">26</div></button>
<button class="h-10 w-full text-sm font-medium leading-normal text-neutral-dark dark:text-white"><div class="flex size-full items-center justify-center rounded-full">27</div></button>
<button class="h-10 w-full text-sm font-medium leading-normal text-neutral-dark dark:text-white"><div class="flex size-full items-center justify-center rounded-full">28</div></button>
<button class="h-10 w-full text-sm font-medium leading-normal text-neutral-dark dark:text-white"><div class="flex size-full items-center justify-center rounded-full">29</div></button>
<button class="h-10 w-full text-sm font-medium leading-normal text-neutral-dark dark:text-white"><div class="flex size-full items-center justify-center rounded-full">30</div></button>
<button class="h-10 w-full text-sm font-medium leading-normal text-neutral-dark dark:text-white"><div class="flex size-full items-center justify-center rounded-full">31</div></button>
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
                    <p class="text-sm font-bold text-status-green">{{ \Carbon\Carbon::parse($appt->starts_at)->format('g:i') }}</p>
                    <p class="text-xs text-status-green">{{ \Carbon\Carbon::parse($appt->starts_at)->format('A') }}</p>
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
</body></html>