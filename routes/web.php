<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VehicleController;
use GuzzleHttp\Middleware;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [AuthController::class, 'index'])->name('login');
Route::get('/register', [AuthController::class, 'registerPage']);
 
Route::group(['prefix' => 'panel-control'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/vehicles', [DashboardController::class, 'vehicles']);
    Route::post('/vehicles', [VehicleController::class, 'store'])->name('vehicles.store');
    
});