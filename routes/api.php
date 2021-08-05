<?php

use App\Http\Controllers\Api\BikeController;
use App\Http\Controllers\Api\UserBikeReservationController;
use Illuminate\Http\Request;
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

// Bike REST API requests
Route::get('/bikes', [BikeController::class, 'index']);

// UserBikeReservation REST API requests
Route::get('/reservations', [UserBikeReservationController::class, 'index']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
