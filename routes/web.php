<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('surveys', \App\Http\Controllers\SurveyController::class);
    Route::get('surveys/{survey}/export', [\App\Http\Controllers\SurveyController::class, 'export'])->name('surveys.export');
    Route::post('surveys/{survey}/import', [\App\Http\Controllers\SurveyController::class, 'import'])->name('surveys.import');
});

require __DIR__.'/auth.php';
