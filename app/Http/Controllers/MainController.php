<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        // fetch all data from products
        // $results = Product::all(); // SELECT * FROM products

        // foreach ($results as $product) {
        //     echo '<br>';
        //     echo $product->product_name;
        // }

        // echo $results[0]->product_name;


        // fetch all data as associative array
        // $results = Product::all()->toArray();
        // $this->showData($results);

        // get results as array of stdClass objects
        // $results = $this->arrayOfObjects(Product::all()->toArray());


        // fetch products ordered by name
        // $results = Product::orderBy('product_name')
        //     ->get()
        //     ->toArray();


        // get the first 3 products
        // $results = Product::limit(3)->get()->toArray();

        // find product by id
        // $results = Product::find(10)->toArray();

        // where clause
        // $results = Product::where('price', '>=', 70)->get()->toArray();

        // get only first result
        // $results = Product::where('price', '>=', 70)->first()->toArray();

        // get only first element if exists, otherwise return empty array
        // $results = Product::where('price', '>=', 190)
        //     ->firstOr(function () {
        //         return [];
        //     });

        // $product = Product::find(10);
        // echo $product->price;
        // echo '<br>';

        // $product->price = 200;
        // echo $product->price;
        // echo '<br>'; 

        // $product->refresh(); // get original data 
        // echo $product->price;
        // echo '<br>'; 

        // $this->showData($results);

        // $product = Product::find(10);
        // echo $product->product_name . '<br>';

        // $product = Product::where('price', '>=', 70)->first();
        // echo $product->product_name . ' costs $' . $product->price . '<br>';

        // $product = Product::firstWhere('price', '>=', 60);
        // echo $product->product_name . ' costs $' . $product->price . '<br>';

        // $product = Product::findOr(110, function () {
        //     echo 'Product not found';
        // });
        // if ($product) echo $product->product_name . ' costs $' . $product->price . '<br>';

        // $product = Product::findOrFail(120); // returns default laravel 404 page in case it doesnt exist
        // echo $product->product_name . ' costs $' . $product->price . '<br>';

        $total_products = Product::count();
        $product_max_price = Product::max('price');
        $product_min_price = Product::min('price');
        $product_avg_price = Product::avg('price');
        $product_sum_price = Product::sum('price');

        $results = [
            'total_products'    => $total_products,
            'product_max_price' => $product_max_price,
            'product_min_price' => $product_min_price,
            'product_avg_price' => $product_avg_price,
            'product_sum_price' => $product_sum_price
        ];

        $this->showData($results);
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
