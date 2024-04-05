<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::controller(AuthController::class)->group(function () {
//     Route::post('login', 'login');
//     Route::post('register', 'register');
//     Route::post('logout', 'logout')->middleware('auth:api');
//     Route::post('refresh', 'refresh')->middleware('auth:api');
// });

Route::apiResource('brand',BrandController::class);
