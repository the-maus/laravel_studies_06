<?php

use App\Http\Controllers\MainController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::get('/', [MainController::class, 'index']);
Route::get('/one-to-one', [MainController::class, 'oneToOne']);
Route::get('/one-to-many', [MainController::class, 'oneToMany']);
