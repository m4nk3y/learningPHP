<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\BookController;

Route::get('/books/{library_id}', [BookController::class, 'index']);
Route::get('/', [LibraryController::class, 'index']);
