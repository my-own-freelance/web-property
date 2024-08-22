<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CustomTemplateController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\PropertyCertificateController;
use App\Http\Controllers\PropertyController;
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
    Route::get('/account', [AccountController::class, 'index'])->name('account');

    // pages for role owner
    Route::group(["middleware" => "web.check.role:owner"], function () {
        Route::get('/property-transaction', [PropertyTranscationController::class, "index"])->name("property-transaction");
        Route::get('/property-type', [PropertyTypeController::class, "index"])->name("property-type");
        Route::get('/property-certificate', [PropertyCertificateController::class, "index"])->name("property-certificate");
        Route::get("/setting", [CustomTemplateController::class, "index"])->name("setting");
        Route::get("/agen", [UserController::class, "indexAgen"])->name("agen");
        Route::get("/owner", [UserController::class, "indexOwner"])->name("owner");
        Route::get('/article', [ArticleController::class, 'index'])->name("article");
        Route::get('/faq', [FaqController::class, 'index'])->name("faq");
    });

    Route::group(["prefix" => "property"], function () {
        Route::get('/', [PropertyController::class, 'index'])->name("property");
        Route::get('/pending', [PropertyController::class, 'pending'])->name("property.pending");
        Route::get('/approved', [PropertyController::class, 'approved'])->name("property.approved");
        Route::get('/rejected', [PropertyController::class, 'rejected'])->name("property.rejected");
    });
});
