<?php

namespace App\Repositories;

use Laravel\Passport\Client;

class ClientRepository
{
    function __construct(
        private Client $client
    ) {}

    function create(array $attributes)
    {
        return $this->client->create($attributes);
    }

    function find(array $attributes)
    {
        return $this->client->where($attributes)->first();
    }

    function filter(array $attributes)
    {
        return $this->client->where($attributes)->get();
    }

    function update(array $condition, array $attributes)
    {
        return $this->client->where($condition)->update($attributes);
    }

    function delete(int $id)
    {
        return $this->client->delete($id);
    }
}
