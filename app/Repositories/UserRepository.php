<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    function __construct(
        protected User $user
    ) {}

    function create(array $attributes)
    {
        return $this->user->create($attributes);
    }

    function find(array $attributes)
    {
        return $this->user->where($attributes)->first();
    }

    function filter(array $attributes)
    {
        return $this->user->where($attributes)->get();
    }

    function update(array $condition, array $attributes)
    {
        return $this->user->where($condition)->update($attributes);
    }

    function delete(int $id)
    {
        return $this->user->delete($id);
    }
}
