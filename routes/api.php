<?php

use App\Http\Controllers\Mobile\MobAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// MOBILE API
Route::group(["middleware" => "api", "prefix" => "auth"], function () {
    Route::post('register', [MobAuthController::class, 'register']);
    Route::post('login', [MobAuthController::class, 'login']);
    Route::post('logout', [MobAuthController::class, 'logout']);
    Route::post('refresh', [MobAuthController::class, 'refresh']);
    Route::post('me', [MobAuthController::class, 'me']);
});

