<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\HealthController;
use App\Http\Controllers\MetricsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RequestLogger;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware([RequestLogger::class])->middleware("throttle:contact")->group(function () {
    Route::post("/contact", ContactController::class);

    Route::get("/metrics", MetricsController::class);
    Route::get("/health", HealthController::class);
});
