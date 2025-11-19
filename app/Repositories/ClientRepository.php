<?php

namespace App\Repositories;

use App\Models\User;
use Laravel\Passport\ClientRepository as PassportClientRepository;

class ClientRepository extends PassportClientRepository
{
    function storePersonalAccessGrantClient(User $user)
    {
        return $this->create($user->name, ["personal_access"], [], null, true, $user);
    }

    function storePasswordGrantClient(User $user)
    {
        return $this->create($user->name, ['password', 'refresh_token'], [], "users", true, $user);
    }

    function storeClientCredentialsGrantClient(User $user)
    {
        return $this->create($user->name, ['client_credentials'], [], null, true, $user);
    }
}
