<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Landing utama langsung ke dashboard analisis
Route::get('/', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard.home');

// Route khusus untuk preview komponen (misalnya sidebar saja)
Route::get('/preview', function (Request $request) {
    // contoh: /preview?component=dashboard-sidebar
    $component = $request->query('component');

    return view('component-preview', compact('component'));
})->name('components.preview');

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
});

require __DIR__.'/auth.php';
