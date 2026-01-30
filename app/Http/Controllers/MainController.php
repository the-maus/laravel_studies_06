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
