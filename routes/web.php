<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UetApplicantController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OcDashboardController;
use App\Http\Controllers\ApplicantDashboardController;
use App\Http\Controllers\BafQ140Controller;

Route::get('/', function () {
    return view('welcome');
});

// Redirect default Breeze /dashboard directly to the UET Applicant Dashboard
Route::get('/dashboard', function () {
    return redirect()->route('uet.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Applicant UET System Routes
Route::middleware(['auth', 'verified'])->prefix('uet')->name('uet.')->group(function () {
    // List all applicant requests (Applicant Dashboard)
    Route::get('/dashboard', [UetApplicantController::class, 'index'])->name('dashboard');
    
    // Show the UET creation form
    Route::get('/create', [UetApplicantController::class, 'create'])->name('create');
    
    // Submit / Save draft UET form
    Route::post('/store', [UetApplicantController::class, 'store'])->name('store');

    // View specific UET request details & timeline
    Route::get('/show/{id}', [UetApplicantController::class, 'show'])->name('show');
});

// User Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('requests', App\Http\Controllers\BafRequestController::class)->except(['edit','destroy']);
});

Route::middleware(['auth', 'role:oc'])->prefix('oc')->name('oc.')->group(function () {
    Route::get('/dashboard', [OcDashboardController::class, 'index'])->name('dashboard');
    Route::get('/uet/{id}/review', [OcDashboardController::class, 'review'])->name('review');
    Route::put('/uet/{id}/review', [OcDashboardController::class, 'updateReview'])->name('updateReview');
});

// OC Routes
Route::middleware(['auth', 'role:oc'])->prefix('oc')->name('oc.')->group(function () {
    Route::get('/dashboard', [OcDashboardController::class, 'index'])->name('dashboard');
});

// Applicant Routes
Route::middleware(['auth', 'role:applicant'])->prefix('applicant')->name('applicant.')->group(function () {
    Route::get('/dashboard', [ApplicantDashboardController::class, 'index'])->name('dashboard');
});

Route::middleware(['auth', 'verified'])->group(function () {
    // Existing UET routes...
    Route::get('/uet/dashboard', [UetApplicantController::class, 'index'])->name('uet.dashboard');
    Route::get('/uet/create', [UetApplicantController::class, 'create'])->name('uet.create');

    // Add the missing BAF Q 140 route:
    Route::get('/bafq140/create', [BafQ140Controller::class, 'create'])->name('bafq140.create');
});

require __DIR__.'/auth.php';