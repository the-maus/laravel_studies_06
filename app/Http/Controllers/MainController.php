<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class MainController extends Controller
{
    public function index()
    {
        // // SELECT * FROM products WHERE id = 10
        // $product = Product::find(10); 
        // // UPDATE products SET name = 'Changed product', price = 10 WHERE id = 10
        // // automatically updates updated_at column
        // $product->product_name = 'Changed product';
        // $product->price = 10;
        // $product->save();

        // // mass update
        // Product::where('price', '<=', 10)
        //         ->update([
        //             'price' => 150
        //         ]);

        // update (if it exists) or create
        Product::updateOrCreate(
            ['product_name' => 'Xarope'], // attributes to search by
            ['price' => 25] // values to update/create
        );
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
