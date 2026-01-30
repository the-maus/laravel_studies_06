<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Phone;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class MainController extends Controller
{
    public function index()
    {
        echo "Eloquent Relations";

    }

    public function oneToOne()
    {
        // // get a client's phone
        // $phone = Client::find(12)->phone;
        // echo "Client ID: $phone->client_id | Phone: $phone->phone_number";
        // echo "<hr>";

        // // get a client's data with their phone
        // $client = Client::find(12);
        // $phone = $client->phone->phone_number;
        // echo "<br>";
        // echo "Client Name: $client->client_name <br>";
        // echo "Client Phone: $phone";
        // echo "<hr>";

        // // get a client's data with their phone (using method with)
        // $client = Client::with('phone')->find(12);
        // echo "<br>";
        // echo "Client Name: $client->client_name <br>";
        // echo "Client Phone: {$client->phone->phone_number}";
        // echo "<hr>";

        // show all client's data with their phone
        $clients = Client::with('phone')->get();
        foreach ($clients as $client) {
            echo "<br>";
            echo "Client Name: $client->client_name - Phone: {$client->phone->phone_number}";
        }
    }

    public function OneToMany()
    {
        // // get client's id/name and all its phones
        // $client = Client::find(10);
        // $phones = $client->phones;
        // echo "Client: $client->client_name <br>";
        // echo "Phones: <br>";
        // foreach ($phones as $phone) {
        //     echo "$phone->phone_number <br>";
        // }

        // get client's id/name and all its phones (using with)
        $client = Client::with('phones')->find(10);
        echo "<br>";
        echo "Client: $client->client_name <br>";
        echo "Phones: <br>";
        foreach ($client->phones as $phone) {
            echo "$phone->phone_number <br>";
        }

        // show all client's data with their phones
        $clients = Client::with('phones')->get();
        foreach ($clients as $client) {
            echo "<br>";
            echo "Client: $client->client_name <br>";
            echo "Phones: <br>";
            foreach ($client->phones as $phone) {
                echo "$phone->phone_number <br>";
            }
        }
    }

    public function belongsTo()
    {
        // // find a phone and get the client it belongs to (inverse relation)
        // $phone = Phone::find(10);
        // $client = $phone->client;
        // echo "Phone: {$phone->phone_number} <br>";
        // echo "Client: {$client->client_name}";

        // find a phone and get the client it belongs to (using with)
        $phone = Phone::with('client')->find(10);
        echo "<br>";
        echo "Phone: {$phone->phone_number} <br>";
        echo "Client: {$phone->client->client_name}";
    }

    public function manyToMany()
    {
        // // find a client and all the products they bought
        // $client = Client::find(1);
        // $products = $client->products;
        // echo "Client: {$client->client_name}<br>";
        // echo "Products: <br>";
        // foreach($products as $product) {
        //     echo "{$product->product_name}<br>";
        // }

        // find all clients that bought a product
        $product = Product::find(1);
        $clients = $product->clients;
        echo "Product: {$product->product_name}<br>";
        echo "Clients: <br>";
        foreach($clients as $client) {
            echo "{$client->client_name}<br>";
        }
    }

    public function runningQueries()
    {
        // // get a client and its phones (only phones starting with an 8)
        // $client1 = Client::find(1);
        // $phones = $client1->phones()->where('phone_number', 'LIKE', '8%')->get();
        // echo "Client: {$client1->client_name}<br>";
        // echo "Phones: <br>";
        // foreach($phones as $phone) {
        //     echo $phone->phone_number . '<br>';
        // }

        // // get all product bought by a client, but only the ones that cost more than 50
        // $client2 = Client::find(1);
        // $products = $client2->products()->where('price', '>', 50)->get();
        // echo "Client: {$client2->client_name}<br>";
        // echo "Products: <br>";
        // foreach($products as $product) {
        //     echo "$product->product_name - $product->price <br>";
        // }


        // distinct() to avoid repeated products orderBy() to sort them
        $client2 = Client::find(1);
        $products = $client2->products()
                        ->where('price', '>', 50)
                        ->distinct()
                        ->orderBy('product_name')
                        ->get();

        echo "Client: {$client2->client_name}<br>";
        echo "Products: <br>";
        foreach($products as $product) {
            echo "$product->product_name - $product->price <br>";
        }
    }

    // same results as in runningQueries() without using the relations
    public function sameResults()
    {
        // // get a client and it's phones
        // $client1 = Client::find(1);
        // $phones = Phone::where('client_id', $client1->id)->get();
        // echo "Client: {$client1->client_name}<br>";
        // echo "Phones: <br>";
        // foreach($phones as $phone) {
        //     echo $phone->phone_number . '<br>';
        // }

        // get all products bought by a client
        $client2 = Client::find(1);
        $products = Product::join('orders', 'products.id', '=', 'orders.product_id')
                            ->where('orders.client_id', $client2->id)
                            ->get();
        echo "Client: {$client2->client_name}<br>";
        echo "Products: <br>";
        foreach($products as $product) {
            echo "$product->product_name - $product->price <br>";
        }
    }

    public function collections()
    {
        // // get first 5 clients
        // $clients = Client::take(5)->get();
        // foreach($clients as $client) {
        //     echo "$client->client_name<br>";
        // }

        // // APPEND
        // $clients = Client::take(5)->get();
        // $clients->each->append(['client_name_uppercase', 'email_domain']);

        // foreach($clients as $client) {
        //     $client->client_name_uppercase = strtoupper($client->client_name);
        //     $client->email_domain = explode('@', $client->email)[1];
        // }

        // foreach($clients as $client) {
        //     echo "$client->client_name - $client->client_name_uppercase - $client->email_domain<br>";
        // }

        // // CONTAINS
        // $clients = Client::take(5)->get();
        // // checks if the list contains any client with that client_name and returns a boolean
        // $results = $clients->contains('client_name', 'Mirela Alice Lopes'); 
        // dd($results);

        // DIFF (items from first array that aren't on the second one)
        // $clients1 = Client::take(5)->get();
        // $clients2 = Client::take(3)->get();
        // $results = $clients1->diff($clients2)->toArray(); 
        // $this->showData($results);

        // // INTERSECT (items that are in both arrays)
        // $clients1 = Client::take(5)->get();
        // $clients2 = Client::where('id', '>', 3)->take(5)->get();
        // $results = $clients1->intersect($clients2)->toArray(); 
        // $this->showData($results);

        // MAKEHIDDEN
        $clients = Client::take(15)->get();
        $clients->makeHidden(['id', 'updated_at', 'deleted_at', 'created_at']);
        $this->showData($clients->toArray());
    }

    public function serialization()
    {
        // // convert objects to ARRAY
        // $clients = Client::take(10)->get();
        // $clients = $clients->toArray();
        // $this->showData($clients);

        // $client = Client::find(1)->toArray();
        // $this->showData($client);

        // // convert objects to JSON
        // $clients = Client::take(10)->get()->toJson(JSON_PRETTY_PRINT);
        // echo '<pre>';
        // echo $clients;

        // $clients = Client::take(10)
        //                     ->get()
        //                     ->setHidden(['id', 'active', 'created_at', 'updated_at', 'deleted_at'])
        //                     ->toJson(JSON_PRETTY_PRINT);
        // $this->showData($clients);

        $clients = Client::take(10)
                            ->get()
                            ->setVisible(['client_name', 'email'])
                            ->toJson(JSON_PRETTY_PRINT);
        $this->showData($clients);
    }
    
    private function showData($data)
    {
        echo '<pre>';
        print_r($data);
    }

    private function arrayOfObjects($data)
    {
        $tmp = [];

        foreach ($data as $value) {
            $tmp[] = (object) $value;
        }

        return $tmp;
    }
}
