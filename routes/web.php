<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;

// Movie routes
Route::get('/', [MovieController::class, 'index'])->name('movies.index');
Route::get('/movie/{id}', [MovieController::class, 'show'])->name('movies.show');
Route::post('/movie/{id}/comment', [MovieController::class, 'storeComment'])->name('movies.comment');
Route::get('/genre/{genre}', [MovieController::class, 'byGenre'])->name('movies.genre');
