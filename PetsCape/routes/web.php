<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnimalReportController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserSettingsController;
use App\Http\Controllers\HomeController;
use App\Models\Animal;
use App\Models\Appointment;
use Illuminate\Support\Carbon;
use App\Http\Controllers\AdoptionRequestController;
use App\Http\Controllers\FoundAnimalReportController;

Auth::routes(['verify' => true]);

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware('guest')->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::post('/logout', [LogoutController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// Route for user dashboard combining styles from user_dashboard and functionality from dashboard
Route::get('/user/dashboard', function () {
    // Get Reports data from AnimalReports only
    $myReports = \App\Models\AnimalReport::where('user_id', auth()->id())
        ->with('species')
        ->latest()
        ->take(5)
        ->get();

    // Get lost reports
    $lostReports = \App\Models\AnimalReport::where('is_found', false)
        ->with(['species', 'user'])
        ->latest()
        ->take(5)
        ->get();

    // Get found reports
    $foundReports = \App\Models\AnimalReport::where('is_found', true)
        ->with(['species', 'user'])
        ->latest()
        ->take(5)
        ->get();
    
    // Get user appointments
    $userAppointments = \App\Models\Appointment::where('user_id', auth()->id())
        ->with('animal')
        ->orderBy('date_time')
        ->get();

    return view('user.dashboard', [
        'myReports' => $myReports,
        'lostReports' => $lostReports,
        'foundReports' => $foundReports,
        'userAppointments' => $userAppointments
    ]);
})->middleware(['auth', 'verified'])->name('user.dashboard');

// Redirect old dashboard route to user.dashboard
Route::get('/dashboard', function () {
    return redirect()->route('user.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Routes de vérification d'email
Route::get('/email/verify', [VerificationController::class, 'notice'])
    ->middleware('auth')
    ->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])
    ->middleware(['auth', 'signed'])
    ->name('verification.verify');

Route::post('/email/verification-notification', [VerificationController::class, 'resend'])
    ->middleware(['auth', 'throttle:6,1'])
    ->name('verification.resend');

// Animal routes
Route::middleware(['auth'])->group(function () {
    Route::resource('animals', \App\Http\Controllers\AnimalController::class);
});

// Admin-only animal routes
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/animals', [\App\Http\Controllers\AnimalController::class, 'index'])->name('admin.animals');
    // You can add more admin-specific routes here
});

// Species routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('species', \App\Http\Controllers\SpeciesController::class);
});

// Admin routes
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [\App\Http\Controllers\AdminController::class, 'dashboard'])
        ->name('dashboard')
        ->middleware('can:admin');
    Route::get('/dashboard', [\App\Http\Controllers\AdminController::class, 'dashboard'])
        ->name('dashboard')
        ->middleware('can:admin');
    Route::get('/animals', [\App\Http\Controllers\AdminController::class, 'animals'])
        ->name('animals')
        ->middleware('can:admin');
    Route::get('/appointments', [\App\Http\Controllers\AdminController::class, 'appointments'])
        ->name('appointments')
        ->middleware('can:admin');
    Route::get('/adoptions', [\App\Http\Controllers\AdminController::class, 'adoptions'])
        ->name('adoptions')
        ->middleware('can:admin');
    Route::get('/users', [\App\Http\Controllers\AdminController::class, 'users'])
        ->name('users')
        ->middleware('can:admin');
    Route::get('/reports', [\App\Http\Controllers\AdminController::class, 'reports'])
        ->name('reports')
        ->middleware('can:admin');
    Route::get('/donations', [\App\Http\Controllers\AdminController::class, 'donations'])
        ->name('donations')
        ->middleware('can:admin');
    // Routes d'administration
});

Route::get('/adoption', [AnimalController::class, 'adoptionPage'])->name('animals.adoption');
Route::get('/adoption/{animal}', [AnimalController::class, 'show'])->name('animals.show');
Route::get('/adoption/{animal}/meeting', [AnimalController::class, 'meetingPage'])->name('animals.meeting');

// Routes pour les rendez-vous
Route::post('/appointment', [AppointmentController::class, 'store'])->name('appointments.store')->middleware('auth');
Route::patch('/appointment/{appointment}/status', [AppointmentController::class, 'updateStatus'])->name('appointments.update-status')->middleware('auth');
Route::delete('/appointment/{appointment}/cancel', [AppointmentController::class, 'cancel'])->name('appointments.cancel')->middleware('auth');

// Routes pour les demandes d'adoption
Route::middleware(['auth'])->group(function () {
    Route::post('/adoption-requests', [AdoptionRequestController::class, 'store'])->name('adoption-requests.store');
    Route::delete('/adoption-requests/{adoptionRequest}/cancel', [AdoptionRequestController::class, 'cancel'])->name('adoption-requests.cancel');
    Route::patch('/adoption-requests/{adoptionRequest}/status', [AdoptionRequestController::class, 'updateStatus'])
        ->name('adoption-requests.update-status')
        ->middleware('can:admin');
});

// Animal report routes
Route::middleware(['auth'])->group(function () {
    Route::get('/reports', [AnimalReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/create', [AnimalReportController::class, 'create'])->name('reports.create');
    Route::post('/reports', [AnimalReportController::class, 'store'])->name('reports.store');
    Route::get('/reports/{report}', [AnimalReportController::class, 'show'])->name('reports.show');
    Route::get('/reports/{report}/edit', [AnimalReportController::class, 'edit'])->name('reports.edit');
    Route::put('/reports/{report}', [AnimalReportController::class, 'update'])->name('reports.update');
    Route::delete('/reports/{report}', [AnimalReportController::class, 'destroy'])->name('reports.destroy');
    Route::patch('/reports/{report}/status', [AnimalReportController::class, 'changeStatus'])->name('reports.change-status');
    Route::get('/my-reports', [AnimalReportController::class, 'myReports'])->name('reports.my');
});

// Routes for user settings
Route::middleware(['auth'])->prefix('settings')->name('settings.')->group(function () {
    Route::get('/', [UserSettingsController::class, 'index'])->name('index');

    Route::get('/profile', [UserSettingsController::class, 'editProfile'])->name('profile');
    Route::post('/profile', [UserSettingsController::class, 'updateProfile'])->name('profile.update');

    Route::get('/password', [UserSettingsController::class, 'editPassword'])->name('password');
    Route::post('/password', [UserSettingsController::class, 'updatePassword'])->name('password.update');

    Route::get('/account', [UserSettingsController::class, 'editAccount'])->name('account');
    Route::delete('/account', [UserSettingsController::class, 'deleteAccount'])->name('account.delete');
});

// Donation routes
Route::middleware(['auth'])->prefix('donations')->name('donation.')->group(function () {
    Route::get('/', [\App\Http\Controllers\DonationController::class, 'showDonationForm'])->name('form');
    Route::post('/process', [\App\Http\Controllers\DonationController::class, 'createCheckoutSession'])->name('process');
    Route::get('/success', [\App\Http\Controllers\DonationController::class, 'success'])->name('success');
    Route::get('/cancel', [\App\Http\Controllers\DonationController::class, 'cancel'])->name('cancel');
});

// Temporary route to make admin user - REMOVE AFTER USE
Route::get('/make-admin/{email}', function($email) {
    $user = \App\Models\User::where('email', $email)->first();

    if (!$user) {
        return "User with email {$email} not found.";
    }

    $user->role = 'admin';
    $user->save();

    return "User {$email} is now an admin. You can log in with admin privileges.";
});

// Temporary direct route to admin dashboard - REMOVE AFTER TESTING
Route::get('/direct-admin', [\App\Http\Controllers\AdminController::class, 'dashboard'])
    ->middleware(['auth', 'can:admin']);

// Routes pour les signalements d'animaux trouvés
Route::middleware(['auth'])->prefix('found-reports')->name('found_reports.')->group(function () {
    Route::get('/select', [FoundAnimalReportController::class, 'selectLostAnimal'])->name('select');
    Route::get('/create/{animalReport}', [FoundAnimalReportController::class, 'create'])->name('create');
    Route::post('/store/{animalReport}', [FoundAnimalReportController::class, 'store'])->name('store');
    Route::get('/{foundReport}', [FoundAnimalReportController::class, 'show'])->name('show');
});

// Routes admin pour les signalements d'animaux trouvés
Route::middleware(['auth', 'can:admin'])->prefix('admin/found-reports')->name('admin.found_reports.')->group(function () {
    Route::get('/', [FoundAnimalReportController::class, 'index'])->name('index');
    Route::patch('/{foundReport}/status', [FoundAnimalReportController::class, 'updateStatus'])->name('update-status');
});


