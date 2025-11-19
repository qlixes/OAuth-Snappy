<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\ClientRepository;

class ClientService
{
    function __construct(
        protected ClientRepository $repository
    ) {}

    function createPersonalAccessGrantClient(User $user)
    {
        return $this->repository->storePersonalAccessGrantClient($user);
    }

    function createPasswordGrantClient(User $user)
    {
        return $this->repository->storePasswordGrantClient($user);
    }

    function createClientCredentialsGrantClient(User $user)
    {
        return $this->repository->storeClientCredentialsGrantClient($user);
    }
}
