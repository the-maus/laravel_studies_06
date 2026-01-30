<?php

namespace App\Http\Controllers;

use App\Models\Client;
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
