<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TravelRequestsController;
use App\Http\Controllers\AuthController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth.jwt'])->group(function () {
    Route::get('/travel-requests', [TravelRequestsController::class, 'index']);
    Route::post('/travel-requests', [TravelRequestsController::class, 'store']);
    Route::get('/travel-requests/{travelRequest}', [TravelRequestsController::class, 'show']);
    Route::put('/travel-requests/{travelRequest}', [TravelRequestsController::class, 'update']);
});
