<?php

use App\Http\Controllers\HardwareDeviceController;
use App\Http\Controllers\ITCenterController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ITCenterController:: class, 'index']);
Route::get('/hardwareDevices/{center_id}', [HardwareDeviceController::class, 'index']);
