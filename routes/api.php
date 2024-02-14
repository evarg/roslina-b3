<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\ProducerController;
use App\Http\Controllers\ContainerController;
use App\Http\Controllers\SeedController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::controller(LoginRegisterController::class)->group(function() {
    Route::post('/register', 'register');
    Route::post('/login', 'login');
});

Route::middleware('auth:sanctum')->group( function () {
    Route::apiResource('places', PlaceController::class);
    Route::apiResource('producers', ProducerController::class);
    Route::apiResource('containers', ContainerController::class);
    Route::apiResource('seeds', SeedController::class);
    
    Route::get('users/{id}', [UserController::class, "show"]);
    
    Route::post('/logout', [LoginRegisterController::class, 'logout']);
});