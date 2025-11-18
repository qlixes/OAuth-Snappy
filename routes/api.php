<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:api');

// generate token password-grant
Route::post("/user/signin", [AuthController::class, "signin"]);

// must using signature for securiety
Route::post("/user/create", [UserController::class, "createUser"]);

// generate token client_credentials
Route::post("/oauth/token", [UserController::class, "createToken"]);

Route::middleware("auth:api")->group(function() {
    Route::post("/user/profile", [UserController::class, "verify"]);

    // revoked token password-grant
    Route::post("/user/signout", [UserController::class, "signout"]);
});
