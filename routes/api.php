<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;
use App\Http\Controllers\vehicleController;
use App\Http\Controllers\UserVehicleController;



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/users', [userController::class, 'index']);
Route::put('/users/{userId}/update-cash', [userController::class, 'updateCash']);
Route::get('/vehicles', [vehicleController::class, 'index']);
Route::get('/vehicles/filter-by-price', [VehicleController::class, 'filterByPrice']);
Route::put('/vehicles/{vehicleId}/buy-or-sell', [VehicleController::class, 'buyOrSell']);
Route::get('/user-vehicles/{userId}', [UserVehicleController::class, 'getUserVehicles']);
Route::post('/user-vehicles/assign', [UserVehicleController::class, 'assignVehicleToUser']);


