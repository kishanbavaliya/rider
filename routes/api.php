<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RideController;
use App\Http\Controllers\Api\VehicleTypeController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\NearbyDriverController;
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/ride/pick_up_location', [RideController::class, 'create']);
    Route::get('/rides', [RideController::class, 'index']);
    Route::get('/ride/vehicles', [VehicleTypeController::class, 'index']);

    Route::post('/nearby-drivers', [NearbyDriverController::class, 'getNearbyDrivers']);

});
    Route::post('/send-otp', [AuthController::class, 'sendOtp']);
    Route::post('/verify-otp', [AuthController::class, 'verifyOtp']);

    Route::get('/login', function () {
        return response()->json([
                'success' => false,
                'message' => 'Unauthenticated.'
            ], 401);
    })->name('login');
