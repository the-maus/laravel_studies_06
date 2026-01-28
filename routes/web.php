<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::get('/test', function() {
    $products = Product::all();
    dd($products->toArray());
});
