<?php

use App\Http\Controllers\ComputerController;
use App\Http\Controllers\IssueController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ComputerController::class, 'index']);
Route::get('/issues/{computer_id}', [IssueController::class, 'index']);
