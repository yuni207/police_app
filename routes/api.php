<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\OfficerController; 

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Group endpoint yang perlu auth (Sanctum)
Route::group(['prefix' => 'panel-control', 'middleware' => ['auth:sanctum']], function () {
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // vehicles
    Route::get('/vehicles', [VehicleController::class, 'index']);
    Route::post('/vehicles', [VehicleController::class, 'store']);
    Route::get('/vehicles/{id}', [VehicleController::class, 'show']);
    Route::put('/vehicles/{id}', [VehicleController::class, 'update']);
    Route::delete('/vehicles/{id}', [VehicleController::class, 'destroy']);

    // officers
    Route::get('/officers', [OfficerController::class, 'index']);
    Route::post('/officers', [OfficerController::class, 'store']);
    Route::get('/officers/{id}', [OfficerController::class, 'show']);
    Route::put('/officers/{id}', [OfficerController::class, 'update']);
    Route::delete('/officers/{id}', [OfficerController::class, 'destroy']);
});
