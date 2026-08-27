<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UetApplicantController;
use App\Http\Controllers\OcDashboardController;
use App\Http\Controllers\ApplicantDashboardController;
use App\Http\Controllers\BafQ140Controller;
use App\Http\Controllers\BafRequestController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Redirect default Breeze /dashboard to UET Applicant Dashboard
Route::get('/dashboard', function () {
    return redirect()->route('uet.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Applicant UET System Routes
Route::middleware(['auth', 'verified'])->prefix('uet')->name('uet.')->group(function () {
    Route::get('/dashboard', [UetApplicantController::class, 'index'])->name('dashboard');
    Route::get('/create', [UetApplicantController::class, 'create'])->name('create');
    Route::post('/store', [UetApplicantController::class, 'store'])->name('store');
    Route::get('/show/{id}', [UetApplicantController::class, 'show'])->name('show');
});

// BAF Q 140 Routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/bafq140/create', [BafRequestController::class, 'create'])->name('bafq140.create');
});

// User Profile & BAF Request Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('requests', BafRequestController::class)->except(['edit','destroy']);
});

// OC Role Routes
Route::middleware(['auth', 'role:oc'])->prefix('oc')->name('oc.')->group(function () {
    Route::get('/dashboard', [OcDashboardController::class, 'index'])->name('dashboard');
    Route::get('/uet/{id}/review', [OcDashboardController::class, 'review'])->name('review');
    Route::put('/uet/{id}/review', [OcDashboardController::class, 'updateReview'])->name('updateReview');
});

// Applicant Role Routes
Route::middleware(['auth', 'role:applicant'])->prefix('applicant')->name('applicant.')->group(function () {
    Route::get('/dashboard', [ApplicantDashboardController::class, 'index'])->name('dashboard');
});

require __DIR__.'/auth.php';