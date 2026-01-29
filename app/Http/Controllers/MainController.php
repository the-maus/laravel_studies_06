<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class MainController extends Controller
{
    public function index()
    {
        // _______________________________
        // HARD DELETE
        // -------------------------------
        // $product = Product::find(10);
        // $product->delete();

        // cleans the table and resets auto increment
        // Product::truncate();

        // Product::destroy(1);
        // Product::destroy(1, 3, 5);
        // Product::destroy([2, 4, 6]);

        // Product::where('price', '>=', 70)->delete();

        // _______________________________
        // SOFT DELETE (needs "use SoftDeletes") on model
        // -------------------------------
        // $product = Product::find(15);
        // $product->delete();

        // fetch soft deleted model
        $product = Product::withTrashed()->find(15);
        $product->restore();

    }

    private function showData($data)
    {
        echo '<pre>';
        print_r($data);
    }

    private function arrayOfObjects($data)
    {
        $tmp = [];

        foreach ($data as $key => $value) {
            $tmp[] = (object) $value;
        }

        return $tmp;
    }
}
