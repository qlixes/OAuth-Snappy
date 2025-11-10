<?php

namespace App\Repositories;

use App\Models\Client;

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

    function setPlainSecret(string $plainSecret)
    {
        $this->client->plainSecret = $plainSecret;
    }

    function getPlainSecret()
    {
        return $this->client->plainSecret;
    }
}
