<?php

namespace App\Services;

use App\Repositories\ClientRepository;
use App\Traits\ClientTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class ClientService
{
    use ClientTrait;

    function __construct(
        protected ClientRepository $client
    ) {}

    function findClient(Request $request)
    {
        $attributes = [
            "id" => $request->client_id,
        ];

        $client = $this->client->find($attributes);

        if (!$client) {
            return;
        }

        $checkCredentials = Hash::check($request->client_secret, $client->secret);

        if ($$checkCredentials) {
            return;
        }

        $response = Http::asForm()->post(url("/oaut/token"), [
            "grant_type" => "client_credentials",
            "client_id" => $request->client_id,
            "client_secret" => $request->client_secret,
        ]);

        return $response->json();
    }
}
