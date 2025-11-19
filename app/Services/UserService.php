<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use App\Traits\ClientTrait;
use Illuminate\Support\Facades\Hash;

class UserService
{
    use ClientTrait;

    function __construct(
        protected UserRepository $user
    ) {}

    /**
     * create User & Client with client_credentials grant-type
     *
     * @param  mixed $request
     * @return void
     */
    function store($request)
    {
        $password = Hash::make($request->password);

        $userAttributes = [
            "name" => $request->name,
            "email" => $request->email,
            "password" => $password,
            "channel_id" => json_encode('[]'),
        ];

        return $this->user->create($userAttributes);
    }

    function findEmail(array $email)
    {
        return $this->user->find($email);
    }

    function checkCredentials(User $user, string $password)
    {
        return Hash::check($password, $user->password);
    }
}
