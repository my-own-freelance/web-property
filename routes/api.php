<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CustomTemplateController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\MobAuthController;
use App\Http\Controllers\PropertyCertificateController;
use App\Http\Controllers\PropertyTranscationController;
use App\Http\Controllers\PropertyTypeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WebAuthController;
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

// PUBLIC API
Route::group(["prefix" => "location"], function () {
    Route::get("/provinces", [LocationController::class, "provinces"]);
    Route::get("/districts/{provinceId}", [LocationController::class, "districts"]);
    Route::get("/sub-districts/{districtId}", [LocationController::class, "subDistricts"]);
});


// MOBILE API
Route::group(["middleware" => "api", "prefix" => "auth"], function () {
    Route::post('register', [MobAuthController::class, 'register']);
    Route::post('login', [MobAuthController::class, 'login']);
    Route::post('logout', [MobAuthController::class, 'logout']);
    Route::post('refresh', [MobAuthController::class, 'refresh']);
    Route::post('me', [MobAuthController::class, 'me']);
});

Route::group(["middleware" => ["api", "auth:api"], "prefix" => "mobile"], function () {
    // ARTICLE
    Route::group(["prefix" => "article"], function () {
        Route::get("datatable", [ArticleController::class, "dataTable"]);
        Route::get("{id}/detail", [ArticleController::class, "getDetail"]);
        Route::post("create", [ArticleController::class, "create"]);
        Route::post("update", [ArticleController::class, "update"]);
        Route::post("update-status", [ArticleController::class, "updateStatus"]);
        Route::delete("/", [ArticleController::class, "destroy"]);
    });
});

// WEB API
Route::post("/auth/login/validate", [WebAuthController::class, "validateLogin"]);

Route::group(["middleware" => "check.auth", "prefix" => "admin"], function () {
    Route::post("/custom_template/create-update", [CustomTemplateController::class, "saveUpdateData"]);

    // endpoint for role owner
    Route::group(["middleware" => "api.check.role:owner"], function () {
        // PROPERTY TRANSACTION
        Route::group(["prefix" => "prop-transaction"], function () {
            Route::get("datatable", [PropertyTranscationController::class, "dataTable"]);
            Route::get("{id}/detail", [PropertyTranscationController::class, "getDetail"]);
            Route::post("create", [PropertyTranscationController::class, "create"]);
            Route::post("update", [PropertyTranscationController::class, "update"]);
            Route::delete("/", [PropertyTranscationController::class, "destroy"]);
        });

        // PROPERTY TYPE
        Route::group(["prefix" => "prop-type"], function () {
            Route::get("datatable", [PropertyTypeController::class, "dataTable"]);
            Route::get("{id}/detail", [PropertyTypeController::class, "getDetail"]);
            Route::post("create", [PropertyTypeController::class, "create"]);
            Route::post("update", [PropertyTypeController::class, "update"]);
            Route::delete("/", [PropertyTypeController::class, "destroy"]);
        });

        // PROPERTY CERTIFICATE
        Route::group(["prefix" => "prop-certificate"], function () {
            Route::get("datatable", [PropertyCertificateController::class, "dataTable"]);
            Route::get("{id}/detail", [PropertyCertificateController::class, "getDetail"]);
            Route::post("create", [PropertyCertificateController::class, "create"]);
            Route::post("update", [PropertyCertificateController::class, "update"]);
            Route::delete("/", [PropertyCertificateController::class, "destroy"]);
        });

        Route::group(["prefix" => "agen"], function () {
            Route::get("/{id}/detail", [UserController::class, "getDetail"]);
            Route::post("/create", [UserController::class, "createAgen"]);
            Route::post("/update", [UserController::class, "updateAgen"]);
            Route::post("/update-status", [UserController::class, "updateStatus"]);
            Route::delete("/delete", [UserController::class, "destroy"]);
        });

        Route::group(["prefix" => "owner"], function () {
            Route::get("/{id}/detail", [UserController::class, "getDetail"]);
            Route::post("/create", [UserController::class, "createUser"]);
            Route::post("/update", [UserController::class, "updateUser"]);
            Route::post("/update-status", [UserController::class, "updateStatus"]);
            Route::delete("/delete", [UserController::class, "destroy"]);
        });

        // ARTICLE
        Route::group(["prefix" => "article"], function () {
            Route::get("datatable", [ArticleController::class, "dataTable"]);
            Route::get("{id}/detail", [ArticleController::class, "getDetail"]);
            Route::post("create", [ArticleController::class, "create"]);
            Route::post("update", [ArticleController::class, "update"]);
            Route::post("update-status", [ArticleController::class, "updateStatus"]);
            Route::delete("/", [ArticleController::class, "destroy"]);
        });

        // FAQ
        Route::group(["prefix" => "faq"], function () {
            Route::get("datatable", [FaqController::class, "dataTable"]);
            Route::get("{id}/detail", [FaqController::class, "getDetail"]);
            Route::post("create", [FaqController::class, "create"]);
            Route::post("update", [FaqController::class, "update"]);
            Route::delete("/", [FaqController::class, "destroy"]);
        });


        Route::get("/{role}/datatable", [UserController::class, "dataTable"]);
    });
});
