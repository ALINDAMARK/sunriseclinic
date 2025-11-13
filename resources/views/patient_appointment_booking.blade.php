<!DOCTYPE html>

<html class="light" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Sun Rise Clinic - Book an Appointment</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet"/>
<script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#4A90E2",
                        "secondary": "#F5A623",
                        "background-light": "#F4F4F8",
                        "background-dark": "#121212",
                        "text-light": "#333333",
                        "text-dark": "#E0E0E0",
                        "border-light": "#EAEAEA",
                        "border-dark": "#333333",
                        "card-light": "#FFFFFF",
                        "card-dark": "#1E1E1E"
                    },
                    fontFamily: {
                        "display": ["Manrope", "sans-serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.5rem",
                        "lg": "0.75rem",
                        "xl": "1rem",
                        "full": "9999px"
                    },
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
</head>
<body class="font-display bg-background-light dark:bg-background-dark text-text-light dark:text-text-dark">
<div class="relative flex h-auto min-h-screen w-full flex-col group/design-root overflow-x-hidden">
<!-- TopNavBar -->
<header class="sticky top-0 z-50 w-full bg-card-light/80 dark:bg-card-dark/80 backdrop-blur-sm border-b border-border-light dark:border-border-dark">
<div class="container mx-auto px-6">
<div class="flex items-center justify-between h-20">
<div class="flex items-center gap-4">
<div class="text-primary size-7">
<svg fill="none" viewbox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
<path clip-rule="evenodd" d="M24 4H6V17.3333V30.6667H24V44H42V30.6667V17.3333H24V4Z" fill="currentColor" fill-rule="evenodd"></path>
</svg>
</div>
<h2 class="text-text-light dark:text-text-dark text-xl font-bold leading-tight tracking-[-0.015em]">Sun Rise Clinic</h2>
</div>
<nav class="hidden md:flex items-center gap-8">
<a class="text-text-light dark:text-text-dark text-base font-medium" href="#">Home</a>
<a class="text-primary text-base font-bold" href="#">Services</a>
<a class="text-text-light dark:text-text-dark text-base font-medium" href="#">Doctors</a>
<a class="text-text-light dark:text-text-dark text-base font-medium" href="#">About Us</a>
</nav>
<div class="flex items-center gap-4">
<button class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-11 px-5 bg-primary text-white text-sm font-bold leading-normal tracking-[0.015em]">
<span class="truncate">My Appointments</span>
</button>
<div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-11 border-2 border-primary" data-alt="User profile picture" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDCr6yQFWIY8NM-QS9K8WSlLnW9Qip0uFnVkovXHaU9ZK8aYnKSXo_g97_tbqq6gagulUH0PN4vnXZFvA7AOKF9pm_YcP2YzB5H-M6ujZcGMEZIkhfRcDgkA8p3t0bJzI-OV_maWXJJEJc59kyfZom_wkplrMYmrMj82Nr0wf87mnpHrnuV5JycabGtMAUBu7wLcohoCHUEI5sOOUekekDhIfDCclR6gKQrRzy-ym3s5JZgA3oziGE2Hyk4kBDzKHO_tCa_eBdp6MVg");'></div>
</div>
</div>
</div>
</header>
<main class="container mx-auto px-6 py-10">
<!-- PageHeading -->
<div class="flex flex-wrap justify-between gap-3 mb-6">
<div class="flex min-w-72 flex-col gap-2">
<p class="text-text-light dark:text-text-dark text-4xl font-black leading-tight tracking-[-0.033em]">Book an Appointment</p>
<p class="text-text-light/70 dark:text-text-dark/70 text-base font-normal leading-normal">Follow the steps below to book your appointment with us.</p>
</div>
</div>
<!-- SegmentedButtons as Progress Stepper -->
<div class="mb-10">
<div class="flex h-12 flex-1 items-center justify-center rounded-lg bg-background-light dark:bg-background-dark border border-border-light dark:border-border-dark p-1.5 shadow-sm">
<label class="flex cursor-pointer h-full grow items-center justify-center overflow-hidden rounded-md px-2 has-[:checked]:bg-primary has-[:checked]:text-white text-text-light dark:text-text-dark text-sm font-medium leading-normal has-[:checked]:shadow-md transition-colors duration-300">
<span class="truncate">1. Service</span>
<input checked="" class="invisible w-0" name="progress-stepper" type="radio" value="1. Service"/>
</label>
<label class="flex cursor-pointer h-full grow items-center justify-center overflow-hidden rounded-md px-2 has-[:checked]:bg-primary has-[:checked]:text-white text-text-light/60 dark:text-text-dark/60 text-sm font-medium leading-normal has-[:checked]:shadow-md transition-colors duration-300">
<span class="truncate">2. Time Slot</span>
<input class="invisible w-0" name="progress-stepper" type="radio" value="2. Time Slot"/>
</label>
<label class="flex cursor-pointer h-full grow items-center justify-center overflow-hidden rounded-md px-2 has-[:checked]:bg-primary has-[:checked]:text-white text-text-light/60 dark:text-text-dark/60 text-sm font-medium leading-normal has-[:checked]:shadow-md transition-colors duration-300">
<span class="truncate">3. Details</span>
<input class="invisible w-0" name="progress-stepper" type="radio" value="3. Details"/>
</label>
<label class="flex cursor-pointer h-full grow items-center justify-center overflow-hidden rounded-md px-2 has-[:checked]:bg-primary has-[:checked]:text-white text-text-light/60 dark:text-text-dark/60 text-sm font-medium leading-normal has-[:checked]:shadow-md transition-colors duration-300">
<span class="truncate">4. Confirmation</span>
<input class="invisible w-0" name="progress-stepper" type="radio" value="4. Confirmation"/>
</label>
</div>
</div>
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
<!-- Main Content Area -->
<div class="lg:col-span-2 space-y-10">
<!-- Step 1: Select Service -->
<section>
<h2 class="text-text-light dark:text-text-dark text-2xl font-bold leading-tight tracking-[-0.015em] mb-4">Select a Service</h2>
<div class="grid grid-cols-[repeat(auto-fill,minmax(180px,1fr))] gap-4">
<!-- Service Card: Selected -->
<div class="flex flex-col gap-3 p-4 rounded-lg border-2 border-primary bg-primary/10 cursor-pointer">
<div class="text-primary">
<span class="material-symbols-outlined text-4xl">medical_services</span>
</div>
<div>
<p class="text-text-light dark:text-text-dark text-base font-bold leading-normal">General Consultation</p>
<p class="text-text-light/70 dark:text-text-dark/70 text-sm font-normal leading-normal">Comprehensive health check-up</p>
</div>
</div>
<!-- Service Card -->
<div class="flex flex-col gap-3 p-4 rounded-lg border border-border-light dark:border-border-dark bg-card-light dark:bg-card-dark hover:border-primary/50 transition-colors duration-200 cursor-pointer">
<div class="text-secondary">
<span class="material-symbols-outlined text-4xl">dentistry</span>
</div>
<div>
<p class="text-text-light dark:text-text-dark text-base font-bold leading-normal">Dental Check-up</p>
<p class="text-text-light/70 dark:text-text-dark/70 text-sm font-normal leading-normal">Routine dental examination</p>
</div>
</div>
<!-- Service Card -->
<div class="flex flex-col gap-3 p-4 rounded-lg border border-border-light dark:border-border-dark bg-card-light dark:bg-card-dark hover:border-primary/50 transition-colors duration-200 cursor-pointer">
<div class="text-secondary">
<span class="material-symbols-outlined text-4xl">vaccines</span>
</div>
<div>
<p class="text-text-light dark:text-text-dark text-base font-bold leading-normal">Vaccination</p>
<p class="text-text-light/70 dark:text-text-dark/70 text-sm font-normal leading-normal">Get your required vaccines</p>
</div>
</div>
<!-- Service Card -->
<div class="flex flex-col gap-3 p-4 rounded-lg border border-border-light dark:border-border-dark bg-card-light dark:bg-card-dark hover:border-primary/50 transition-colors duration-200 cursor-pointer">
<div class="text-secondary">
<span class="material-symbols-outlined text-4xl">person_search</span>
</div>
<div>
<p class="text-text-light dark:text-text-dark text-base font-bold leading-normal">Specialist Visit</p>
<p class="text-text-light/70 dark:text-text-dark/70 text-sm font-normal leading-normal">Consult with a specialist</p>
</div>
</div>
</div>
</section>
</div>
<!-- Sidebar: Booking Summary -->
<aside class="lg:col-span-1">
<div class="sticky top-28 p-6 rounded-xl bg-card-light dark:bg-card-dark border border-border-light dark:border-border-dark shadow-lg space-y-6">
<h3 class="text-xl font-bold text-text-light dark:text-text-dark">Booking Summary</h3>
<div class="space-y-4 text-sm">
<div class="flex justify-between items-center">
<span class="text-text-light/70 dark:text-text-dark/70">Service</span>
<span class="font-semibold text-text-light dark:text-text-dark">General Consultation</span>
</div>
<div class="flex justify-between items-center">
<span class="text-text-light/70 dark:text-text-dark/70">Doctor</span>
<span class="text-text-light/50 dark:text-text-dark/50 italic">Not selected</span>
</div>
<div class="flex justify-between items-center">
<span class="text-text-light/70 dark:text-text-dark/70">Date &amp; Time</span>
<span class="text-text-light/50 dark:text-text-dark/50 italic">Not selected</span>
</div>
</div>
<div class="border-t border-border-light dark:border-border-dark pt-4">
<div class="flex justify-between items-baseline">
<span class="text-base font-semibold text-text-light dark:text-text-dark">Total</span>
<span class="text-xl font-bold text-primary">$75.00</span>
</div>
</div>
<button class="w-full flex items-center justify-center gap-2 rounded-lg h-12 px-6 bg-primary text-white text-base font-bold shadow-md hover:bg-primary/90 transition-colors duration-200">
<span>Next Step</span>
<span class="material-symbols-outlined">arrow_forward</span>
</button>
<div class="flex items-start gap-3 p-4 rounded-lg bg-secondary/10">
<span class="material-symbols-outlined text-secondary text-2xl mt-1">info</span>
<p class="text-sm text-text-light dark:text-text-dark">Please proceed to the next step to select your preferred doctor and time slot for the consultation.</p>
</div>
</div>
</aside>
</div>
</main>
</div>
</body></html>