<?php

use App\Http\Controllers\MedicineController;
use App\Http\Controllers\SaleController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MedicineController::class, 'index']);
Route::get('/sales/{medicine_id}', [SaleController::class, 'index']);

