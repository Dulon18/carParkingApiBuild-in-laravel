<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ParkingSlotController;

Route::prefix('v1/')->group(function () {

    Route::post('/bookings', [BookingController::class, 'store']);
    Route::post('{booking}/complete', [BookingController::class, 'complete']);
    Route::post('{booking}/cancel', [BookingController::class, 'cancel']);

    Route::post('/vehicle', [VehicleController::class, 'store']);
    Route::put('{vehicle}/update', [VehicleController::class, 'update']);
    Route::delete('{vehicle}/delete', [VehicleController::class, 'destroy']);

    Route::post('/payments', [PaymentController::class, 'store']);

});
