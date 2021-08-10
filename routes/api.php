<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BikeController;
use App\Http\Controllers\Api\UserBikeReservationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Auth REST API public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Auth REST API protected
Route::middleware('auth:sanctum')->group(function () {
    // Bike resource routes
    Route::resource('bikes', BikeController::class);

    Route::resource('user-bike-reservations', UserBikeReservationController::class);

    // Auth routes
    Route::post('/logout', [AuthController::class, 'logout']);
});

// UserBikeReservation REST API routes
Route::get('/reservations', [UserBikeReservationController::class, 'index']);
