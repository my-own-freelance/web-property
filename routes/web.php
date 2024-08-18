<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\PropertyCertificateController;
use App\Http\Controllers\PropertyTranscationController;
use App\Http\Controllers\PropertyTypeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WebAuthController;
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

Route::get('/logout', [WebAuthController::class, 'logout'])->name('logout');
// AUTH
Route::group(["middleware" => "guest"], function () {
    Route::get('/', [WebAuthController::class, 'login'])->name('login');
});

Route::group(["middleware" => "auth:web", "prefix" => "admin"], function () {
    Route::get("/", [DashboardController::class, "index"])->name("dashboard");

    // pages for role owner
    Route::group(["middleware" => "web.check.role:owner"], function () {
        Route::get('/prop-transaction', [PropertyTranscationController::class, "index"])->name("prop-transaction");
        Route::get('/prop-type', [PropertyTypeController::class, "index"])->name("prop-type");
        Route::get('/prop-certificate', [PropertyCertificateController::class, "index"])->name("prop-certificate");
        Route::get("/agen", [UserController::class, "indexAgen"])->name("agen");
        Route::get("/owner", [UserController::class, "indexOwner"])->name("owner");
        Route::get('/article', [ArticleController::class, 'index'])->name("article");
        Route::get('/faq', [FaqController::class, 'index'])->name("faq");
    });
});
