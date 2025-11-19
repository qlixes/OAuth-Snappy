<?php

namespace App\Http\Controllers;

use App\Http\Resources\TokenInvalidResource;
use App\Http\Resources\UserCreatedResource;
use App\Http\Resources\UserNotFoundResource;
use App\Http\Resources\UserProfileResource;
use App\Http\Resources\UserSigninResource;
use App\Services\ClientService;
use App\Services\Responses;
use App\Services\TokenService;
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
        protected Responses $response,
        protected TokenService $token
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
        $clientPassword = $this->client->createPasswordGrantClient($user);
        // $clientPersonal = $this->client->createPersonalAccessGrantClient($user);

        return new UserCreatedResource($user);
    }

    function signin(Request $request)
    {
        $validate = Validator::make($request->all(), [
            "email" => "required|email",
            "password" => "required|string",
        ]);

        if ($validate->fails()) {
            return response()->json($validate->errors());
        }

        $user = $this->user->findEmail($request->only("email"));

        if(!$user)
        {
            return new UserNotFoundResource([]);
        }

        $checkCredentials = $this->user->checkCredentials($user, $request->password);

        if(!$checkCredentials)
        {
            return response()->json([], 403);
        }

        return new UserSigninResource($user->createToken("personal_access"));
    }

    function profile(Request $request)
    {
        $bearerToken = $request->bearerToken();

        [$checkToken, $ownerToken] = $this->token->verify($bearerToken);

        if($checkToken)
        {
            return new TokenInvalidResource([]);
        }

        return new UserProfileResource($ownerToken);
    }
}
