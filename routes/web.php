<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UetApplicantController;
use Illuminate\Support\Facades\Route;

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

require __DIR__.'/auth.php';