<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserCreatedResource;
use App\Services\ClientService;
use App\Services\Responses;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use League\OAuth2\Server\AuthorizationServer;

class AuthController extends Controller
{
    function __construct(
        protected AuthorizationServer $server,
        protected UserService $user,
        protected ClientService $client,
        protected Responses $response
    ) {}

    function register(Request $request)
    {
        $validate = Validator::make($request->all(), [
            "name" => "required|string",
            "email" => "required|email|unique:users,email",
            "password" => "required|string|confirmed",
        ]);

        if ($validate->fails()) {
            return response()->json($validate->errors());
        }

        // create new user
        $user = $this->user->store($request);

        // create new password grant-type
        $client = $this->client->createPasswordGrantClient($user);

        $resource = new UserCreatedResource($client);

        return $resource;
    }
}
