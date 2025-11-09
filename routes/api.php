<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:api');

// Route::group([
//     "as" => "passport.",
//     "prefix" => config("passport.path", "oauth"),
//     "namespace" => "\Laravel\Passport\Http\Controllers",
// ], function() {

// });

Route::post("/admin/create-token", [AdminController::class], "createPersonalToken");
Route::post("/client/create-token", [ClientController::class, "createClientToken"]);

Route::middleware("auth:api")->group(function () {

    Route::prefix("client")->group(function () {
        Route::get("/show-profile", [ClientController::class, "selectClientProfile"]);
        Route::post("/update-client", [ClientController::class, "updateClientProfile"]);
    });

    Route::prefix("admin")->group(function () {
        Route::post("/create-user", [AdminController::class, "createUserClient"]);
    });
});
