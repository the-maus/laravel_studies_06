<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class MainController extends Controller
{
    public function index()
    {
        // INSERT INTO products(product_name, price) VALUES ('New Product', 50)
        // automatically inserts values for created_at/updated_at
        // $new_product = new Product();
        // $new_product->product_name = 'New Product';
        // $new_product->price = 50;
        // $new_product->save();

        // INSERT INTO products(product_name, price) VALUES ('Other Product', 160)
        // automatically inserts values for created_at/updated_at
        // needs to set ($fillable = ['product_name', 'price']) on Model
        // Product::create([
        //     'product_name' => 'Other Product',
        //     'price' => 160
        // ]);


        // mass insertion
        // doesnt insert values for created_at/updated_at automatically
        Product::insert([
            [
                'product_name' => 'Product 6',
                'price' => 40,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'product_name' => 'Product 5',
                'price' => 60,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'product_name' => 'Product 4',
                'price' => 50,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ]);
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
