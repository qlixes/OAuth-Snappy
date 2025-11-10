<?php

namespace App\Services;

use App\Models\Client;
use App\Repositories\ClientRepository;
use App\Traits\ClientTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ClientService
{
    use ClientTrait;

    function __construct(
        protected ClientRepository $client
    ) {}

    function findClient(string $clientId)
    {
        $attributes = [
            "id" => $clientId,
        ];

        return $this->client->find($attributes);
    }

    function checkClientCredentials(Client $client, string $clientSecret)
    {
        return Hash::check($clientSecret, $client->secret);
    }

    function findClientCredentials(Request $request)
    {
        $client = $this->findClient($request->client_id);

        if(!$client)
        {
            return;
        }

        $checkCredentials = $this->checkClientCredentials($client, $request->client_secret);

        if(!$checkCredentials)
        {
            return ;
        }

        return $this->postOAuthServer($request->only("client_id", "client_secret", "grant_type"));
    }
}
