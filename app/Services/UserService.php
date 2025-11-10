<?php

namespace App\Services;

use App\Repositories\ClientRepository;
use App\Repositories\UserRepository;
use App\Traits\ClientTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserService
{
    use ClientTrait;

    function __construct(
        protected UserRepository $user,
        protected ClientRepository $client,
    ) {}

    /**
     * create User & Client with client_credentials grant-type
     *
     * @param  mixed $request
     * @return void
     */
    function createUserPasswordGrant(Request $request)
    {
        $password = Hash::make($request->password);

        $userAttributes = [
            "name" => $request->name,
            "email" => $request->email,
            "password" => $password,
            "channel_id" => json_encode('[]'),
        ];

        $user = $this->user->create($userAttributes);

        $this->client->setPlainSecret($this->createClientSecret());

        $clientCredentialsGrantAttributes = [
            "owner_id" => $user->id,
            "redirect_uris" => json_encode('[]'),
            "callback_uris" => json_encode('[]'),
            "grant_types" => json_encode('["password"]'),
        ];

        return $this->client->create($clientCredentialsGrantAttributes);
    }
}
