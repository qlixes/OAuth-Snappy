<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Laravel\Passport\ClientRepository;
use League\OAuth2\Server\AuthorizationServer;

class AuthController extends Controller
{
    function __construct(
        protected AuthorizationServer $server,
        protected ClientRepository $client,
        protected UserService $user
    ) {}

    function register(Request $request)
    {
        $validate = Validator::make($request->all(), [
            "name" => "required|string",
            "email" => "required|email|unique:users,email",
            "password" => "required|string|confirmed",
        ]);

        if($validate->fails())
        {
            die();
        }

        $user = $this->user->store($request);

        $this->client->createPasswordGrantClient()
    }
}
