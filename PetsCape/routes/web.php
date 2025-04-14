<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AdminController;

Auth::routes(['verify' => true]);
Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Routes de vérification d'email
Route::get('/email/verify', [VerificationController::class, 'notice'])
    ->middleware(['auth'])
    ->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])
    ->middleware(['auth', 'signed'])
    ->name('verification.verify');

Route::post('/email/verification-notification', [VerificationController::class, 'resend'])
    ->middleware(['auth', 'throttle:6,1'])
    ->name('verification.resend');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

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

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/animals', [AdminController::class, 'animals'])->name('animals');
    Route::get('/appointments', [AdminController::class, 'appointments'])->name('appointments');
    Route::get('/adoptions', [AdminController::class, 'adoptions'])->name('adoptions');
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::get('/reports', [AdminController::class, 'reports'])->name('reports');
});

Route::get('/adoption', [AnimalController::class, 'adoptionPage'])->name('animals.adoption');
Route::get('/adoption/{animal}', [AnimalController::class, 'show'])->name('animals.show');
Route::get('/adoption/{animal}/meeting', [AnimalController::class, 'meetingPage'])->name('animals.meeting');

// Routes pour les rendez-vous
Route::post('/appointment', [AppointmentController::class, 'store'])->name('appointments.store')->middleware('auth');
Route::patch('/appointment/{appointment}/status', [AppointmentController::class, 'updateStatus'])->name('appointments.update-status')->middleware('auth');
Route::delete('/appointment/{appointment}/cancel', [AppointmentController::class, 'cancel'])->name('appointments.cancel')->middleware('auth');


