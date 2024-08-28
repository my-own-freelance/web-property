<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CustomTemplateController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\FrontPage\HomeAgenController;
use App\Http\Controllers\FrontPage\HomeArticleController;
use App\Http\Controllers\FrontPage\HomeContactController;
use App\Http\Controllers\FrontPage\HomeController;
use App\Http\Controllers\FrontPage\HomeFaqController;
use App\Http\Controllers\FrontPage\HomePropertyController;
use App\Http\Controllers\PropertyCertificateController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\PropertyTranscationController;
use App\Http\Controllers\PropertyTypeController;
use App\Http\Controllers\ReviewController;
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
Route::get('/', [HomeController::class, 'index'])->name("home");
Route::get('/list-properti', [HomePropertyController::class, 'list'])->name('property.list');
Route::get('/list-artikel', [HomeArticleController::class, 'list'])->name('article.list');
Route::get('/list-agen', [HomeAgenController::class, 'list'])->name('agen.list');
Route::get('/faq', [HomeFaqController::class, 'list'])->name('faq.list');
Route::get('/contact', [HomeContactController::class, 'index'])->name('contact.view');
Route::get('/cari-properti/view/{code}/{slug}', [HomePropertyController::class, 'detail'])->name('property.detail');
Route::get('/cari-artikel/view/{code}/{slug}', [HomeArticleController::class, 'detail'])->name('article.detail');
Route::get('/cari-agen/view/{code}', [HomeAgenController::class, 'detail'])->name('agen.detail');

// AUTH
Route::group(["middleware" => "guest"], function () {
    Route::get('/kelola', [WebAuthController::class, 'login'])->name('login');
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
        Route::get('/review', [ReviewController::class, 'index'])->name('review');
        Route::get('/contact', [ContactController::class, 'index'])->name('contact');
    });

    Route::group(["prefix" => "property"], function () {
        Route::get('/', [PropertyController::class, 'index'])->name("property");
        Route::get('/pending', [PropertyController::class, 'pending'])->name("property.pending");
        Route::get('/approved', [PropertyController::class, 'approved'])->name("property.approved");
        Route::get('/rejected', [PropertyController::class, 'rejected'])->name("property.rejected");
        Route::get('/deleted', [PropertyController::class, 'deleted'])->name("property.deleted");
    });
});
