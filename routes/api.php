<?php

use App\Http\Controllers\Api\SurveyApiController;
use Illuminate\Support\Facades\Route;

Route::prefix('surveys')->group(function () {
    Route::post('{survey}/responses', [SurveyApiController::class, 'storeResponse'])->name('api.surveys.responses.store');
});
