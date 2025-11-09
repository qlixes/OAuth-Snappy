<?php

namespace App\Http\Controllers;

use App\Http\Resources\SuccessCreateUserClientCredentialsGrantResource;
use App\Services\ClientService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    function __construct(
        protected UserService $user,
        protected ClientService $client
    ) {}

    function createUserClient(Request $request)
    {
        $validate = Validator::make($request->all(), [
            "name" => "required|string",
            "email" => "required|email",
            "password" => "required|string|confirmed",
        ]);

        if ($validate->fails()) {
            //
        }

        $user = $this->user->createUserClientCredentialsGrant($request);

        $resource = new SuccessCreateUserClientCredentialsGrantResource($user);

        return response()->json($resource);
    }

    function createPersonalToken(Request $request)
    {
        //
    }
}
