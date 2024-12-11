<?php

use App\Http\Controllers\CinemaController;
use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CinemaController::class, 'index']);
Route::get('/movies/{cinema_id}', [MovieController::class, 'index']);
