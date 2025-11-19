<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:api');

// generate token password-grant
Route::post("/user/signin", [AuthController::class, "signin"]);

// must using signature for securiety
Route::post("/user/create", [AuthController::class, "register"]);

// generate token client_credentials
Route::post("/oauth/token", [AuthController::class, "token"]);

Route::middleware("auth:api")->group(function () {
    Route::post("/user/profile", [AuthController::class, "verify"]);

    // revoked token password-grant
    Route::post("/user/signout", [AuthController::class, "signout"]);
});
