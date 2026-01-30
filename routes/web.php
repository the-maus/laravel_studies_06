<?php

use App\Http\Controllers\MainController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::get('/', [MainController::class, 'index']);
Route::get('/one-to-one', [MainController::class, 'oneToOne']);
Route::get('/one-to-many', [MainController::class, 'oneToMany']);
Route::get('/belongs-to', [MainController::class, 'belongsTo']);
Route::get('/many-to-many', [MainController::class, 'manyToMany']);
Route::get('/queries', [MainController::class, 'runningQueries']);
Route::get('/same-results', [MainController::class, 'sameResults']);
Route::get('/collections', [MainController::class, 'collections']);
