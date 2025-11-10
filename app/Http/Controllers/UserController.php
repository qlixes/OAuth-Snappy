<?php

namespace App\Http\Controllers;

use App\Http\Resources\SuccessCreateUserClientCredentialsGrantResource;
use App\Http\Resources\ValidationErrorResource;
use App\Rules\GrantTypeRule;
use App\Services\ClientService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    function __construct(
        protected UserService $user,
        protected ClientService $client
    ) {}

    /**
     * Create User & Client with default grant-types was password
     *
     * @param  mixed $request
     * @return void
     */
    function createUserClient(Request $request)
    {
        $validate = Validator::make($request->all(), [
            "name" => "required|string",
            "email" => "required|email",
            "password" => "required|string|confirmed",
        ]);

        if ($validate->fails()) {
            $response = new ValidationErrorResource(null);

            return response()->json($response);
        }

        $user = $this->user->createUserPasswordGrant($request);

        $resource = new SuccessCreateUserClientCredentialsGrantResource($user);

        return response()->json($resource);
    }

    function findUserClient(Request $request)
    {
        //
    }

    function createUserToken(Request $request)
    {
        $validate = Validator::make($request->all(), [
            "client_id" => "required|string",
            "client_secret" => "required|string",
            "grant_type" => [new GrantTypeRule()],
        ]);

        if ($validate->fails()) {
            $response = new ValidationErrorResource(null);

            return response()->json($validate->errors());
        }

        $client = $this->client->findClientCredentials($request);

        return response()->json($client);
    }
}
