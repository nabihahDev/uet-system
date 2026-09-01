<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UetApplicantController;
use App\Http\Controllers\OcDashboardController;
use App\Http\Controllers\ApplicantDashboardController;
use App\Http\Controllers\BafQ140Controller;
use App\Http\Controllers\BafRequestController;
use Illuminate\Support\Facades\Route;

// --------------------------------------------------------------------------
// Public Routes
// --------------------------------------------------------------------------
Route::get('/', function () {
    return view('welcome');
});

// --------------------------------------------------------------------------
// Authenticated General Routes
// --------------------------------------------------------------------------
Route::middleware(['auth', 'verified'])->group(function () {

    // Redirect default Breeze /dashboard ke uet.index atau uet.dashboard
    Route::get('/dashboard', function () {
        return auth()->user()->isOc()
            ? redirect()->route('oc.dashboard')
            : redirect()->route('applicant.dashboard');
    })->name('dashboard');

    // BAF Q140 Routes
    Route::get('/bafq140/create', [BafRequestController::class, 'create'])->name('bafq140.create');

    // BAF Routes (RESTful)
    Route::resource('baf', BafRequestController::class)->except(['edit', 'destroy']);
});

// --------------------------------------------------------------------------
// User Profile Routes
// --------------------------------------------------------------------------
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Signature & PIN Routes
    Route::patch('/profile/signature', [ProfileController::class, 'updateSignature'])->name('profile.signature.update');
    Route::delete('/profile/signature', [ProfileController::class, 'destroySignature'])->name('profile.signature.destroy');
});

// --------------------------------------------------------------------------
// UET System Routes
// --------------------------------------------------------------------------
Route::middleware(['auth', 'verified'])->prefix('uet')->name('uet.')->group(function () {
    Route::get('/', [UetApplicantController::class, 'index'])->name('index');
    Route::get('/dashboard', [UetApplicantController::class, 'index'])->name('dashboard');
    Route::get('/create', [UetApplicantController::class, 'create'])->name('create');
    Route::post('/store', [UetApplicantController::class, 'store'])->name('store');
    Route::get('/show/{id}', [UetApplicantController::class, 'show'])->name('show');
    
    // OC Approval Action
    Route::post('/{uetRequest}/approve-oc', [UetApplicantController::class, 'approveByOc'])->name('approve.oc');
});

// --------------------------------------------------------------------------
// Role-Based Routes
// --------------------------------------------------------------------------

// OC Role Routes (Prefix: 'oc.', URL: '/oc/...')
Route::middleware(['auth', 'role:oc'])->prefix('oc')->name('oc.')->group(function () {
    Route::get('/dashboard', [OcDashboardController::class, 'index'])->name('dashboard');
    Route::get('/uet/{id}/review', [OcDashboardController::class, 'review'])->name('review');
    Route::put('/uet/{id}/review', [OcDashboardController::class, 'updateReview'])->name('updateReview');
});

// Applicant Role Routes (Prefix: 'applicant.', URL: '/applicant/...')
Route::middleware(['auth', 'role:applicant'])->prefix('applicant')->name('applicant.')->group(function () {
    Route::get('/dashboard', [ApplicantDashboardController::class, 'index'])->name('dashboard');
});

require __DIR__.'/auth.php';