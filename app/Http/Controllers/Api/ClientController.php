<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use App\Http\Resources\Client\ClientResource;
use App\http\Requests\Client\StoreRequest;

use App\Models\Client;

class ClientController extends Controller
{
    //

    public function index() : AnonymousResourceCollection
    {
        $clients = Client::all();

        return  ClientResource::collection($clients);
    }
    public function store(StoreRequest $request) : ClientResource 
    {
         $fields = $request->post();

         $client = Client::create($fields); 

         return new ClientResource($client);
    }
}
