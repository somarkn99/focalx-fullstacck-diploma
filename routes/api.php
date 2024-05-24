<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\NewsLetterController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login')->middleware('can_login');
    Route::post('register', 'register');
    Route::post('logout', 'logout')->middleware('auth:api');
    Route::post('refresh', 'refresh')->middleware('auth:api');
});

Route::apiResource('brand',BrandController::class);
Route::apiResource('table',TableController::class);

Route::get('users',[UserController::class,'index']);
Route::post('users',[UserController::class,'store']);


Route::post('send',[NewsLetterController::class,'send']);

Route::post('/upload', [ImageController::class,'store']);


Route::get('authors',[AuthorController::class,'index']);
Route::post('authors',[AuthorController::class,'store']);
