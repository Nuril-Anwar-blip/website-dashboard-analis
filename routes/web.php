<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/**
 * =============================================
 * PINTU MASUK UTAMA (LOGIN LANGSUNG)
 * =============================================
 * 
 * Sesuai permintaan, halaman utama yang muncul pertama kali adalah LOGIN.
 * Jalur root (/) akan langsung menampilkan form login.
 */
Route::get('/', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'create'])
    ->name('login_root');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('surveys', \App\Http\Controllers\SurveyController::class);
    Route::get('surveys/{survey}/export', [\App\Http\Controllers\SurveyController::class, 'export'])->name('surveys.export');
    Route::post('surveys/{survey}/import', [\App\Http\Controllers\SurveyController::class, 'import'])->name('surveys.import');
    Route::post('surveys/{survey}/response', [\App\Http\Controllers\SurveyController::class, 'storeResponse'])->name('surveys.response.store');
});

require __DIR__.'/auth.php';
