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
    })->name('dashboard');

    // Email verification helpers (optional): notice, verify link, and resend
    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->middleware('auth')->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (\Illuminate\Foundation\Auth\EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect()->route('dashboard');
    })->middleware(['auth','signed'])->name('verification.verify');

    Route::post('/email/verification-notification', function (\Illuminate\Http\Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('success', 'Verification link sent.');
    })->middleware(['auth','throttle:6,1'])->name('verification.send');

    // Services resource (index + CRUD actions handled by controller)
    Route::resource('services', ServiceController::class)->only(['index','store','show','update','destroy']);
    // service edit route (show edit form)
    Route::get('services/{service}/edit', [ServiceController::class, 'edit'])->name('services.edit');
        // JSON list endpoint for services
        Route::get('services-list', [ServiceController::class, 'list'])->name('services.list');

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
    // Reports page
    Route::get('reports', [\App\Http\Controllers\ReportController::class, 'index'])->name('reports');
    Route::get('api/reports/data', [\App\Http\Controllers\ReportController::class, 'data'])->name('api.reports.data');
    Route::get('api/reports/stream', [\App\Http\Controllers\ReportController::class, 'stream'])->name('api.reports.stream');
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
            ->get(['id','starts_at','patient_id','doctor_id','status'])
            ->map(function($a){
                $start = $a->starts_at ? \Carbon\Carbon::parse($a->starts_at)->setTimezone('UTC') : null;
                $startEat = $start ? $start->copy()->setTimezone('Africa/Nairobi') : null;
                return [
                    'id' => $a->id,
                    'time' => $start ? $start->format('h:i A') : null,
                    'starts_at' => $start ? str_replace('+00:00','Z',$start->toIso8601String()) : null,
                    'starts_at_eat_display' => $startEat ? $startEat->format('g:i A') . ' EAT' : null,
                    'patient' => optional($a->patient)->name ?? '—',
                    'doctor' => optional($a->doctor)->name ?? '—',
                    'status' => $a->status ?? 'pending'
                ];
            });
        return response()->json(['data' => $rows]);
    })->name('api.appointments.recent');

    // Very small messages area (MVP): list of conversations and a simple chat view.
    Route::get('messages', function () {
        // for now show recent patients as conversation starters
        $conversations = \Illuminate\Support\Facades\Schema::hasTable('patients') ? \App\Models\Patient::orderBy('name')->limit(30)->get() : collect();
        return view('messages.index', compact('conversations'));
    })->name('messages.index');

    Route::get('messages/{conversation}', function ($conversation) {
        // conversation may be a patient id; chat UI will be independent for now
        return view('messages.chat', ['conversationId' => $conversation]);
    })->name('messages.chat');

    // API for messages (basic)
    Route::get('api/messages', [\App\Http\Controllers\MessageApiController::class, 'index'])->name('api.messages.index');
    Route::post('api/conversations', [\App\Http\Controllers\MessageApiController::class, 'storeConversation'])->name('api.conversations.store');
    Route::get('api/conversations/{conversation}/messages', [\App\Http\Controllers\MessageApiController::class, 'messages'])->name('api.conversations.messages');
    Route::post('api/conversations/{conversation}/messages', [\App\Http\Controllers\MessageApiController::class, 'postMessage'])->name('api.conversations.messages.store');

    // Action endpoint for appointment operations (check-in, cancel, delete)
    Route::post('api/appointments/{appointment}/action', [\App\Http\Controllers\AppointmentController::class, 'action'])->name('api.appointments.action');
    // Patient CRUD
    Route::get('patients/create', [PatientController::class, 'create'])->name('patients.create');
    Route::post('patients', [PatientController::class, 'store'])->name('patients.store');
    Route::get('patients/{patient}/edit', [PatientController::class, 'edit'])->name('patients.edit');
    Route::put('patients/{patient}', [PatientController::class, 'update'])->name('patients.update');
    Route::delete('patients/{patient}', [PatientController::class, 'destroy'])->name('patients.destroy');

    // API / list endpoints
    // Doctors resource: expose index, and simple CRUD for managing providers
    Route::resource('doctors', DoctorController::class)->only(['index','create','store','edit','update','destroy']);
    Route::resource('appointments', AppointmentController::class)->only(['index','store','destroy']);
    Route::get('patients-list', [PatientController::class, 'index'])->name('patients.list');
    // AJAX endpoints for patient management
    Route::get('patients/data', [PatientController::class, 'dataJson'])->name('patients.data');
    Route::get('patients/export', [PatientController::class, 'exportCsv'])->name('patients.export');

    // Per-patient JSON endpoints used by the patient detail tabs
    Route::get('patients/{patient}/profile', [PatientController::class, 'profileJson'])->name('patients.profile');
    Route::get('patients/{patient}/appointments', [PatientController::class, 'appointmentsJson'])->name('patients.appointments');
    Route::get('patients/{patient}/history', [PatientController::class, 'historyJson'])->name('patients.history');
    Route::get('patients/{patient}/notes', [PatientController::class, 'notesJson'])->name('patients.notes');
    // Notes CRUD
    Route::post('patients/{patient}/notes', [\App\Http\Controllers\NoteController::class, 'store'])->name('notes.store');
    Route::put('notes/{note}', [\App\Http\Controllers\NoteController::class, 'update'])->name('notes.update');
    Route::delete('notes/{note}', [\App\Http\Controllers\NoteController::class, 'destroy'])->name('notes.destroy');
    // Blocks (doctor unavailable periods)
    Route::post('blocks', [\App\Http\Controllers\BlockController::class, 'store'])->name('blocks.store');
    Route::delete('blocks/{block}', [\App\Http\Controllers\BlockController::class, 'destroy'])->name('blocks.destroy');
    Route::get('blocks', [\App\Http\Controllers\BlockController::class, 'index'])->name('blocks.index');
    // AJAX endpoints for patient management
    Route::get('patients/data', [PatientController::class, 'dataJson'])->name('patients.data');
    Route::get('patients/export', [PatientController::class, 'exportCsv'])->name('patients.export');
});

