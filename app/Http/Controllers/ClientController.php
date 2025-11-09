<?php

namespace App\Http\Controllers;

use App\Services\ClientService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ClientController extends Controller
{
    function __construct(
        protected ClientService $client
    ) {}

    function createClientToken(Request $request)
    {
        $validate = Validator::make($request->all(), [
            "client_id" => "required|string",
            "client_secret" => "required|string",
        ]);

        if ($validate->fails()) {
            //
        }
    }

    function selectClientProfile(Request $request)
    {
        //
    }

    function updateClientProfile(Request $request)
    {
        $validate = Validator::make($request->all(), [
            "callback_uris" => "nullable|url",
            "redirect_uris" => "nullable|url",
        ]);

        if ($validate->fails()) {
            //
        }
    }
}
