<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
// Resource routes for controllers
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\AppointmentController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Root: if guest -> show register/login; if authenticated -> show landing
Route::get('/', function () {
    if (!auth()->check()) {
        return redirect()->route('register');
    }
    return view('welcome');
});

// Simple auth routes (lightweight) to support the custom auth views
use App\Http\Controllers\AuthController;
Route::get('login', [AuthController::class, 'showLogin'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('register', [AuthController::class, 'showRegister'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Protect application pages: require authentication before viewing these routes
Route::middleware('auth')->group(function () {
    
    // App pages for development / local preview
    Route::get('/dashboard', function () {
        // guard against missing tables when migrations haven't been run yet
        if (Schema::hasTable('appointments')) {
            $appointments_today = \App\Models\Appointment::whereDate('starts_at', \Carbon\Carbon::today())->count();
            $checked_in = \App\Models\Appointment::where('status', 'checked_in')->count();
            $pending_arrivals = \App\Models\Appointment::where('status', 'pending')->count();
        } else {
            $appointments_today = 0;
            $checked_in = 0;
            $pending_arrivals = 0;
        }
        return view('Dashboard', compact('appointments_today','checked_in','pending_arrivals'));
    });

    // Services resource (index + CRUD actions handled by controller)
    Route::resource('services', ServiceController::class)->only(['index','store','show','update','destroy']);
    // service edit route (show edit form)
    Route::get('services/{service}/edit', [ServiceController::class, 'edit'])->name('services.edit');

    // convenience redirects
    Route::get('/appointments', function () {
        return redirect()->route('appointments.manage');
    });

    Route::get('/doctor-schedule', function () {
        return redirect()->route('doctors.manage');
    });

    Route::get('/book', function () {
        return redirect()->route('appointments.manage');
    });

    Route::get('/patients', function () {
        return redirect()->route('patients.manage');
    });

    // small static pages
    Route::view('/settings', 'settings')->name('settings');
    Route::view('/help', 'help')->name('help');

    // Management pages
    Route::get('patients/manage', [PatientController::class, 'manage'])->name('patients.manage');
    Route::get('doctors/manage', [DoctorController::class, 'manage'])->name('doctors.manage');
    Route::get('appointments/manage', [AppointmentController::class, 'manage'])->name('appointments.manage');

    // Lightweight API endpoints used by dashboard polling (MVP)
    Route::get('api/dashboard/summary', function () {
        if (Schema::hasTable('appointments')) {
            $appointments_today = \App\Models\Appointment::whereDate('starts_at', \Carbon\Carbon::today())->count();
            $checked_in = \App\Models\Appointment::where('status', 'checked_in')->count();
            $pending_arrivals = \App\Models\Appointment::where('status', 'pending')->count();
        } else {
            $appointments_today = 0;
            $checked_in = 0;
            $pending_arrivals = 0;
        }
        return response()->json(compact('appointments_today','checked_in','pending_arrivals'));
    })->name('api.dashboard.summary');

    Route::get('api/appointments/recent', function () {
        if (!Schema::hasTable('appointments')) {
            return response()->json(['data' => []]);
        }
        $rows = \App\Models\Appointment::whereDate('starts_at', \Carbon\Carbon::today())
            ->orderBy('starts_at')
            ->take(10)
            ->get(['starts_at','patient_name','doctor_name','status'])
            ->map(function($a){
                return [
                    'time' => $a->starts_at->format('h:i A'),
                    'patient' => $a->patient_name ?? '—',
                    'doctor' => $a->doctor_name ?? '—',
                    'status' => $a->status ?? 'pending'
                ];
            });
        return response()->json(['data' => $rows]);
    })->name('api.appointments.recent');
    // Patient CRUD
    Route::get('patients/create', [PatientController::class, 'create'])->name('patients.create');
    Route::post('patients', [PatientController::class, 'store'])->name('patients.store');
    Route::get('patients/{patient}/edit', [PatientController::class, 'edit'])->name('patients.edit');
    Route::put('patients/{patient}', [PatientController::class, 'update'])->name('patients.update');
    Route::delete('patients/{patient}', [PatientController::class, 'destroy'])->name('patients.destroy');

    // API / list endpoints
    Route::resource('doctors', DoctorController::class)->only(['index']);
    Route::resource('appointments', AppointmentController::class)->only(['index','store','destroy']);
    Route::get('patients-list', [PatientController::class, 'index'])->name('patients.list');
});

