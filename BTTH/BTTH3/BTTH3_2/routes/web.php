<?php

use App\Http\Controllers\Class1Controller;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', [Class1Controller::class, 'index']);
Route::get('/students/{class_id}', [StudentController::class, 'index']);
