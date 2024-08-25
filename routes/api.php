<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CustomTemplateController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\MobAuthController;
use App\Http\Controllers\PropertyCertificateController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\PropertyImageController;
use App\Http\Controllers\PropertyTranscationController;
use App\Http\Controllers\PropertyTypeController;
use App\Http\Controllers\ReviewController;
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
Route::group(["prefix" => "dropdown"], function () {
    Route::get("/property-transaction", [PropertyTranscationController::class, 'dropdown']);
    Route::get("/property-type", [PropertyTypeController::class, 'dropdown']);
    Route::get("/property-certificate", [PropertyCertificateController::class, 'dropdown']);

    Route::group(["prefix" => "location"], function () {
        Route::get("/provinces", [LocationController::class, "provinces"]);
        Route::get("/districts/{provinceId}", [LocationController::class, "districts"]);
        Route::get("/sub-districts/{districtId}", [LocationController::class, "subDistricts"]);
    });
});
Route::post("/contact/send-message", [ContactController::class, "create"]);

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
Route::get("/custom-template/detail", [CustomTemplateController::class, "detail"]);

Route::group(["middleware" => "check.auth", "prefix" => "admin"], function () {
    Route::post("/custom-template/create-update", [CustomTemplateController::class, "saveUpdateData"]);

    // OWNER AND AGEN ACCESS
    // PROPERTY
    Route::group(["prefix" => "property"], function () {
        Route::get("datatable", [PropertyController::class, "dataTable"]);
        Route::get("{id}/detail", [PropertyController::class, "getDetail"]);
        Route::post("create", [PropertyController::class, "create"]);
        Route::post("update", [PropertyController::class, "update"]);
        Route::post("update-status", [PropertyController::class, "updateStatus"]);
        Route::delete("delete", [PropertyController::class, "destroy"]);
    });

    // PROPERTY IMAGES
    Route::group(["prefix" => "property-image"], function () {
        Route::get("{property_id}/list", [PropertyImageController::class, 'list']);
        Route::post("create", [PropertyImageController::class, "create"]);
        Route::delete('delete', [PropertyImageController::class, 'destroy']);
    });

    // ACCOUNT
    Route::group(["prefix" => "account"], function () {
        Route::get("/detail", [AccountController::class, "detail"]);
        Route::post("/update-owner", [AccountController::class, "updateOwner"]);
        Route::post("/update-agen", [AccountController::class, "updateAgen"]);
    });


    // endpoint for role owner
    Route::group(["middleware" => "api.check.role:owner"], function () {
        // PROPERTY TRANSACTION
        Route::group(["prefix" => "property-transaction"], function () {
            Route::get("datatable", [PropertyTranscationController::class, "dataTable"]);
            Route::get("{id}/detail", [PropertyTranscationController::class, "getDetail"]);
            Route::post("create", [PropertyTranscationController::class, "create"]);
            Route::post("update", [PropertyTranscationController::class, "update"]);
            Route::delete("delete", [PropertyTranscationController::class, "destroy"]);
        });

        // PROPERTY TYPE
        Route::group(["prefix" => "property-type"], function () {
            Route::get("datatable", [PropertyTypeController::class, "dataTable"]);
            Route::get("{id}/detail", [PropertyTypeController::class, "getDetail"]);
            Route::post("create", [PropertyTypeController::class, "create"]);
            Route::post("update", [PropertyTypeController::class, "update"]);
            Route::delete("delete", [PropertyTypeController::class, "destroy"]);
        });

        // PROPERTY CERTIFICATE
        Route::group(["prefix" => "property-certificate"], function () {
            Route::get("datatable", [PropertyCertificateController::class, "dataTable"]);
            Route::get("{id}/detail", [PropertyCertificateController::class, "getDetail"]);
            Route::post("create", [PropertyCertificateController::class, "create"]);
            Route::post("update", [PropertyCertificateController::class, "update"]);
            Route::delete("delete", [PropertyCertificateController::class, "destroy"]);
        });

        // PROPERTY - ONLY OWNER CAN APPROVE
        Route::group(["prefix" => "property"], function () {
            Route::post("approve-status", [PropertyController::class, "approveStatus"]);
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
            Route::delete("delete", [ArticleController::class, "destroy"]);
        });

        // FAQ
        Route::group(["prefix" => "faq"], function () {
            Route::get("datatable", [FaqController::class, "dataTable"]);
            Route::get("{id}/detail", [FaqController::class, "getDetail"]);
            Route::post("create", [FaqController::class, "create"]);
            Route::post("update", [FaqController::class, "update"]);
            Route::delete("delete", [FaqController::class, "destroy"]);
        });

        // REVIEW
        Route::group(["prefix" => "review"], function () {
            Route::get("datatable", [ReviewController::class, "dataTable"]);
            Route::get("{id}/detail", [ReviewController::class, "getDetail"]);
            Route::post("create", [ReviewController::class, "create"]);
            Route::post("update", [ReviewController::class, "update"]);
            Route::delete("delete", [ReviewController::class, "destroy"]);
        });

        // CONTACT
        Route::group(["prefix" => "contact"], function () {
            Route::get("datatable", [ContactController::class, "dataTable"]);
            Route::get("{id}/detail", [ContactController::class, "getDetail"]);
            Route::delete("delete", [ContactController::class, "destroy"]);
        });

        Route::get("/{role}/datatable", [UserController::class, "dataTable"]);
    });
});
