<?php

use Koraycicekciogullari\HydroAdministrator\Controllers\AdministratorController;
use Koraycicekciogullari\HydroAdministrator\Controllers\LogoutController;
use Koraycicekciogullari\HydroAdministrator\Controllers\PasswordController;
use Koraycicekciogullari\HydroAdministrator\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->post('api/logout', LogoutController::class);

Route::middleware(['auth:sanctum'])->prefix('api')->group(function(){
    Route::prefix('admin')->middleware('api')->group(function(){
        Route::apiResource('profile', ProfileController::class)->only('index', 'update');
        Route::apiResource('administrator', AdministratorController::class)->except('edit', 'create');
        Route::post('password-update', PasswordController::class);
    });
});
