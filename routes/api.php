<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CustomTemplateController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\MobAuthController;
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
        Route::group(["prefix" => "agen"], function () {
            Route::get("/{id}/detail", [UserController::class, "getDetail"]);
            Route::post("/create", [UserController::class, "createAgen"]);
            Route::post("/update", [UserController::class, "updateAgen"]);
            Route::post("/update-status", [UserController::class, "updateStatus"]);
            Route::delete("/delete", [UserController::class, "destroy"]);
        });

        Route::group(["prefix" => "user"], function () {
            Route::get("/{id}/detail", [UserController::class, "getDetail"]);
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

        Route::get("/{role}/datatable", [UserController::class, "dataTable"]);
    });
});
