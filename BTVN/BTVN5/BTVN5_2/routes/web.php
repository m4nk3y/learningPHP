<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaptopController;
use App\Http\Controllers\RenterController;

Route::get('/laptops/{renter_id}', [LaptopController::class, 'index']);
Route::get('/', [RenterController::class, 'index']);
