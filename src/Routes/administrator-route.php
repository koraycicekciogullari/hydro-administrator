<?php

use Koraycicekciogullari\HydroAdministrator\Controllers\AdministratorController;
use Koraycicekciogullari\HydroAdministrator\Controllers\LoginController;
use Koraycicekciogullari\HydroAdministrator\Controllers\LogoutController;
use Koraycicekciogullari\HydroAdministrator\Controllers\PasswordController;
use Koraycicekciogullari\HydroAdministrator\Controllers\ProfileController;
use Koraycicekciogullari\HydroAdministrator\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('api')->post('api/login', LoginController::class);

Route::middleware('auth:sanctum')->post('api/logout', LogoutController::class);

Route::middleware(['auth:sanctum', 'api'])->prefix('api')->group(function(){
    Route::apiResource('user', UserController::class)->only('index');
    Route::prefix('admin')->middleware('api')->group(function(){
        Route::apiResource('profile', ProfileController::class)->only('index', 'update');
        Route::apiResource('administrator', AdministratorController::class)->except('edit', 'create');
        Route::post('password-update', PasswordController::class);
    });
});
