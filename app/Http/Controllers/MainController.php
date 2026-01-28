<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\TestModel;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        $results = TestModel::all()->toArray();
        dd($results);
    }
}
