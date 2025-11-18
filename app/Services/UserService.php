<?php

namespace App\Services;

use App\Repositories\Useruser;
use App\Traits\ClientTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\Clientuser;

class UserService
{
    use ClientTrait;

    function __construct(
        protected Useruser $user
    ) {}

    /**
     * create User & Client with client_credentials grant-type
     *
     * @param  mixed $request
     * @return void
     */
    function store($request)
    {
        $user = $this->findEmail($request);

        if($user)
        {
            die();
        }

        $password = Hash::make($request->password);

        $userAttributes = [
            "name" => $request->name,
            "email" => $request->email,
            "password" => $password,
            "channel_id" => json_encode('[]'),
        ];

        return $this->user->create($userAttributes);
    }

    function findEmail($request)
    {
        return $this->user->find($request->only('email'));
    }
}
